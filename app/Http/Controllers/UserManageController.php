<?php

namespace App\Http\Controllers;


use App\Http\Controllers\AppBaseController;
use App\User;
use App\Models\gonggao;
use App\Models\job_type;
use App\Models\project;
use Illuminate\Http\Request;
use Flash;
use Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserManageController extends AppBaseController
{


    /**
     * Display a listing of the UserManage.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $userManages=User::where('is_admin','否')->get();
        return view('user_manages.index')
            ->with('userManages', $userManages);
    }

    //职位管理
    public function jobsIndex(){
        $jobs=job_type::all();
        return view('user_manages.job')->with('jobs',$jobs);
    }


    //公告管理
    public function gonggaoIndex(){
        $gonggao=gonggao::all();
        return view('user_manages.gonggao')->with('gonggao',$gonggao);
    }

    //添加公告页面显示
    public  function  gonggaoAdd(){
        return view('user_manages.gonggao_add');
    }

    //添加公告接口
    public function gonggaoAddApi(Request $request){
        $gonggao_name=$request->get('gonggao_name');
        $gonggao_desc=$request->get('gonggao_desc');
        $author=Auth::user()->name;
        $count=gonggao::where('name',$gonggao_name)->get();
        if(count($count)>0){
            return ['status' => false, 'msg' => '该公告已被添加过'];
        }else {
            gonggao::create([
                'name' => $gonggao_name,
                'desc' => $gonggao_desc,
                'author'=>$author
            ]);
            return ['status' => true, 'msg' => '添加公告成功', 'result_url' => route('usermanage.gonggao.index')];
        }
    }

    //删除公告接口
    public function gonggaoDelApi($id){
        $count=count(gonggao::all());
        gonggao::find($id)->delete();
        $count--;
        return ['status'=>true,'msg'=>'删除公告成功','result_total'=>$count];
    }

    //添加职位页面显示
    public function jobsAdd(){
        return view('user_manages.job_add');
    }

    //添加职位接口
    public function jobsAddApi(Request $request){
        $job_name=$request->get('job_name');
        $job_desc=$request->get('job_desc');
        $count=job_type::where('name',$job_name)->get();
        if(count($count)>0){
            return ['status' => false, 'msg' => '该职位已被添加过'];
        }else {
            job_type::create([
                'name' => $job_name,
                'desc' => $job_desc
            ]);
            return ['status' => true, 'msg' => '添加职位成功', 'result_url' => route('usermanage.job.index')];
        }
    }

    //删除职位接口
    public function jobsDelApi($id){
        $count=count(job_type::all());
        job_type::find($id)->delete();
        $count--;
        return ['status'=>true,'msg'=>'删除职位成功','result_total'=>$count];
    }

    //修改职位
    public  function jobsEditApi($id,Request $request){
        $name=$request->get('name');
        $desc=$request->get('desc');
        job_type::find($id)->update([
            'name'=>$name,
            'desc'=>$desc
        ]);
        return ['status'=>true,'msg'=>'更新职位成功'];
    }
    /**
     * Show the form for creating a new UserManage.
     *
     * @return Response
     */
    public function create()
    {
        $cats=job_type::all();
        return view('user_manages.create')->with('cats',$cats);
    }

    /**
     * Store a newly created UserManage in storage.
     *
     * @param CreateUserManageRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $request['password'] =bcrypt($request->input('password'));
        $input = $request->all();

        $userManage = User::create($input);

        Flash::success('用户信息保存成功.');

        return redirect(route('userManages.index'));
    }

    /**
     * Display the specified UserManage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userManage=User::find($id);
        if (empty($userManage)) {
            Flash::error('User Manage not found');

            return redirect(route('userManages.index'));
        }

        return view('user_manages.show')->with('userManage', $userManage);
    }

    /**
     * Show the form for editing the specified UserManage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
 
        $userManage=User::find($id);
        $userManage_id=$userManage->id;
        $cats=job_type::all();
        if (empty($userManage)) {
            Flash::error('User Manage not found');

            return redirect(route('userManages.index'));
        }
 
        return view('user_manages.edit')
                ->with('userManage', $userManage)
                ->with('cats',$cats)
                ->with('userManage_id',$userManage_id);
    }

    /**
     * Update the specified UserManage in storage.
     *
     * @param  int              $id
     * @param UpdateUserManageRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {

        $userManage=User::find($id);
        if (empty($userManage)) {
            Flash::error('User Manage not found');

            return redirect(route('userManages.index'));
        }
        unset($request['_method']);
        unset($request['_token']);
        $request['password'] =bcrypt($request->input('password'));

        $userManage=User::where('id', $id)->update($request->all());
        Flash::success('用户信息修改成功');

        return redirect(route('userManages.index'));
    }

    /**
     * Remove the specified UserManage from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userManage=User::find($id);
        if (empty($userManage)) {
            Flash::error('User Manage not found');

            return redirect(route('userManages.index'));
        }

        User::destroy($id);
        Flash::success('用户信息删除成功.');

        return redirect(route('userManages.index'));
    }
}
