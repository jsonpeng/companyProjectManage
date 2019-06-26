<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateproductsRequest;
use App\Http\Requests\UpdateproductsRequest;
use App\Repositories\productsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use App\User;
use App\Models\products;
use App\Models\productcats;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class productsController extends AppBaseController
{
    /** @var  productsRepository */
    private $productsRepository;

    public function __construct(productsRepository $productsRepo)
    {
        $this->productsRepository = $productsRepo;
    }

    /**
     * Display a listing of the products.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->is_admin!='是'){
          return redirect('/403');
        }
        $input=$request->all();
        $products=products::where('id','>',0);
        if (array_key_exists('cats', $input) && $input['cats'] !='全部') {
            $products = productcats::where('name',$input['cats'])->first()->cats();
        }
        $products=$products->orderBy('created_at','desc')->paginate(10);
        $cats=productcats::all();
        return view('products.index')
                ->with('products', $products)
                ->with('cats',$cats)
                ->withInput(Input::all());
    }

    /**
     * Show the form for creating a new products.
     *
     * @return Response
     */
    public function create()
    {
        $user=User::all();
        $cats=productcats::all();
        return view('products.create')->with('cats',$cats)->with('user',$user);
    }

    /**
     * Store a newly created products in storage.
     *
     * @param CreateproductsRequest $request
     *
     * @return Response
     */
    public function store(CreateproductsRequest $request)
    {
        $input = $request->all();
        $products = $this->productsRepository->create($input);
        if ( array_key_exists('cats', $input) ) {
            $products->cats()->sync($input['cats']);
        }
        if ( array_key_exists('users', $input) ) {
            $products->users()->sync($input['users']);
        }
        Flash::success('产品保存成功.');

        return redirect(route('products.index'));
    }

    /**
     * Display the specified products.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $products = $this->productsRepository->findWithoutFail($id);

        if (empty($products)) {
            Flash::error('Products not found');

            return redirect(route('products.index'));
        }

        return view('products.show')->with('products', $products);
    }


    //团队成员主页
    public function teamIndex($id){
        $products=products::find($id);
        return view('products.team')
                ->with('products',$products);
    }

    //团队成员添加
    public function teamAdd($id){
        $users=User::where('is_admin','否')->get();
        $products=products::find($id);
        return view('products.team_add')
                ->with('users',$users)
                ->with('products',$products);
    }

    //团队成员添加接口
    public function teamAddApi(Request $request,$id){
        $users_id=$request->get('users');
        $prop=$request->get('prop');
        $products=products::find($id);
        $products_users_arr=$products->users()->get();
        $users_arr=[];
        $prop_all=$prop;
        for($i =0;$i<count($products_users_arr);$i++){
            Array_push($users_arr,$products_users_arr[$i]->id);
            $prop_all +=$products_users_arr[$i]->pivot->prop;
        }
        if($prop_all>100){
            return ['status' => false, 'msg' => '成员比例已达到上限,请调整成员比例'];
        }
        if(in_array($users_id,$users_arr)){
            return ['status' => false, 'msg' => '该成员已经被添加过'];
        }else {
            products::find($id)->users()->attach($users_id, ['prop' => $prop]);
            return ['status' => true, 'msg' => '添加团队成员成功','result_url'=>route('products.team', [$products->id])];
        }
    }

    //团队成员删除接口
    public function teamDelApi(Request $request,$id){
        $users_id=$request->get('users_id');
        $products=products::find($id);
        $products_users_arr=$products->users()->get();
        $users_arr=[];
        for($i =0;$i<count($products_users_arr);$i++){
          if($products_users_arr[$i]->id!=$users_id){
              Array_push($users_arr,$products_users_arr[$i]->id);
          }
        }
        $products->users()->sync($users_arr);
        return ['status'=>true,'msg'=>'删除团队成员成功','result_total'=>count($users_arr)];
    }

    //团队成员比例修改接口
    public function teamEditApi(Request $request,$id){
        $users_id=$request->get('users_id');
        $prop=$request->get('prop');
        $products=products::find($id);
        $products_users_arr=$products->users()->get();

        $prop_all=$prop;
        for($i =0;$i<count($products_users_arr);$i++){
            if( $products_users_arr[$i]->id!=$users_id) {
            $prop_all +=$products_users_arr[$i]->pivot->prop;
            }
        }
        if($prop_all>100){
            return ['status' => false, 'msg' => '成员比例已达到上限,请重新调整该成员比例'];
        }
        $products->users()->updateExistingPivot($users_id, ['prop' => $prop]);

        return ['status' => true, 'msg' => '团队成员比例修改成功'];
    }

    /**
     * Show the form for editing the specified products.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $products = $this->productsRepository->findWithoutFail($id);

        if (empty($products)) {
            Flash::error('Products not found');

            return redirect(route('products.index'));
        }
        $cats=productcats::all();
        $selectedcats=[];
        $select_cat=products::find($id)->cats()->get();
        for($i =0;$i<count($select_cat);$i++){
            Array_push($selectedcats,$select_cat[$i]->id);
        }
        $user=User::all();
        $selectedusers=[];
        $select_user=products::find($id)->users()->get();
        for($i =0;$i<count($select_user);$i++){
            Array_push($selectedusers,$select_user[$i]->id);
        }

        return view('products.edit')
                ->with('products', $products)
                ->with('cats',$cats)
                ->with('selectedcats',$selectedcats)
                ->with('user',$user)
                ->with('selectedusers',$selectedusers);
    }

    /**
     * Update the specified products in storage.
     *
     * @param  int              $id
     * @param UpdateproductsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateproductsRequest $request)
    {
        $products = $this->productsRepository->findWithoutFail($id);
        $input = $request->all();
        if (empty($products)) {
            Flash::error('Products not found');

            return redirect(route('products.index'));
        }

        $products = $this->productsRepository->update($request->all(), $id);
        if ( array_key_exists('cats', $input) ) {
            $products->cats()->sync($input['cats']);
        }else{
            $products->cats()->sync([]);
        }
        Flash::success('产品更新成功.');

        return redirect(route('products.index'));
    }

    /**
     * Remove the specified products from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $products = $this->productsRepository->findWithoutFail($id);

        if (empty($products)) {
            Flash::error('Products not found');

            return redirect(route('products.index'));
        }

        $this->productsRepository->delete($id);
        $products->cats()->sync([]);
        $products->users()->sync([]);
        Flash::success('产品删除成功.');

        return redirect(route('products.index'));
    }
}
