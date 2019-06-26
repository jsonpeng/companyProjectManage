<?php

namespace App\Http\Controllers;
use App\Models\job_type;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Models\project;
use App\Models\products;
use App\Models\gonggao;
use App\Models\comment_gonggao;
use App\User;
use App\Models\project_rules;
use Illuminate\Support\Facades\Auth;
use Flash;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    //首页
    public function index()
    {
        $gonggao=gonggao::all();
        $user=Auth::user();
        //取出最近5个产品和项目
        $products=$user->products()->orderBy('created_at','desc')->take(5)->get();
        $projects=$user->projects()->orderBy('created_at','desc')->take(5)->get();
        return view('home')
                ->with('id',$user->id)
                ->with('user',$user)
                ->with('products',$products)
                ->with('projects',$projects)
                ->with('gonggao',$gonggao);
        }

    public function userAll(){
        $user=User::where('is_admin','否')->get();
        return ['status'=>true,'msg'=>$user];
    }

    //用户个人主页
    public function userInfo($id)
    {
        $gonggao=gonggao::all();
        $user=User::find($id);
        //取出最近5个产品和项目
        $products=$user->products()->orderBy('created_at','desc')->take(5)->get();
        $projects=$user->projects()->orderBy('created_at','desc')->take(5)->get();
        return view('home')
                ->with('id',$id)
                ->with('user',$user)
                ->with('gonggao',$gonggao)
                ->with('products',$products)
                ->with('projects',$projects);
    }

    //用户个人修改基本信息
    public function userEdit($id){
        $userManage=User::find($id);
        $userManage_id=$userManage->id;
        return view('user_manages.user_edit')
            ->with('userManage', $userManage)
            ->with('userManage_id',$userManage_id);
    }

    //修改接口
    public function userUpdate($id, Request $request)
    {

        $userManage=User::find($id);

        unset($request['_method']);
        unset($request['_token']);
        $request['password'] =bcrypt($request->input('password'));

        $userManage=User::where('id', $id)->update($request->all());
        Flash::success('用户信息修改成功');

        return redirect(route('users.edit',[$id]));
    }

    //用户参与到的产品开发
    public function list_product($id){
        $products=User::find($id)->products()->get();
        return view('list.product')
                ->with('id',$id)
                ->with('products',$products);
    }

    //用户项目金额结算
    public function project_price(Request $request){
        $input=$request->all();
        $input = array_filter( $input, function($v, $k) {
            return $v != '';
        }, ARRAY_FILTER_USE_BOTH );
        $users=User::where('is_admin','否')->get();
        $project_price_all=0;
        $all_price=0;
        foreach ($users as $user){
            $all_price +=$user->projectprice+$user->wages;
            $project_price_all +=$user->projectprice;
        }
        return view('list.project_price')
                ->with('users',$users)
                ->with('project_price_all',$project_price_all)
                ->with('all_price',$all_price)
                ->withInput(Input::all());

    }

    //用户个人参与到的项目开发
    public function list_project(Request $request,$id){
        $user=User::find($id);
        $projects=get_project_by_user($user,'');
        $input=$request->all();
        $input = array_filter( $input, function($v, $k) {
            return $v != '';
        }, ARRAY_FILTER_USE_BOTH );

        $price=get_project_price_by_pra($user,'');
        if (array_key_exists('month_end', $input)) {
            $date=$input['month_end'].'-01';
            $projects = get_project_by_user($user,$input['month_end']);
            $price=get_project_price_by_pra($user,$input['month_end']);
        }


        return view('list.project')
                ->with('user',$user)
                ->with('id',$id)
                ->with('projects',$projects)
                ->with('price',$price)
                ->withInput(Input::all());
    }



    //公告详情及评论
    public function article_gonggao($id){
        $gonggao=gonggao::find($id);
        $watch= $gonggao->watch;
        $watch++;
        $gonggao->update([
            'watch'=>$watch
        ]);

        return view('article')->with('gonggao',$gonggao)->with('watch',$watch);
    }

    //添加公告评论
    public function add_gonggao_comment(Request $request,$id){
        $gonggao=gonggao::find($id);
        $content=$request->get('content');
        $user=Auth::user();
        $create= comment_gonggao::create([
           'user_id'=> $user->id,
            'gonggao_id'=>$id,
            'content'=>$content
        ]);
        $comment_count=$gonggao->comment()->count();

        return ['status'=>true,'msg'=>'添加评论成功','result'=>['userinfo'=>$user,'comment_count'=>$comment_count,'created_at'=>$create->created_at]];


    }

    //公告点赞
    public function dianzan_gonggao($id){
        $gonggao=gonggao::find($id);
        $dianzan=$gonggao->dianzan;
        $dianzan++;
        $gonggao->update([
           'dianzan'=>$dianzan
        ]);
        return ['msg'=>$dianzan,'status'=>true];
    }


    //保存产品
    public function save_product(Request $request){
        $input=$request->all();
        $name=$request->get('name');
        $des=str_replace('../','/',$request->get('des'));
        $products= products::create([
            'name'=>$name,
            'des'=>$des,
            ]);
        if ( array_key_exists('cats', $input) ) {
            $products->cats()->sync($input['cats']);
        }
        return ['status'=>true,'result_manage_url'=>route('products.show', [$products->id]),'result_team_url'=>route('products.team', [$products->id])];
    }

    //转化为产品
    public function product_to_project(Request $request){
        $id=$request->get('products_id');
        $products=products::find($id);
        $name=$products->name;
        $cats=$products->cats()->first()->name;
        $des=$products->des;
        $project = project::create([
            'name' => $name,
            'type' => $cats,
            'des' => $des,
            'products_id' => $id,
        ]);
        $join_man=[];
        $users=$products->users()->get();
       if(count($users)>0) {
           for($i=0;$i<count($users);$i++){
               Array_push($join_man,$users[$i]->id);
               $project->users()->attach($users[$i]->id, ['prop' => $users[$i]->pivot->prop]);
           }

       }
        $products->update(['whether_project'=>'是']);
        return ['status'=>true,'msg'=>route('projects.show', [$project->id])];

    }

    //快速更新项目状态
    public function update_project_state(Request $request){
        $id=$request->get('project_id');
        $status=$request->get('status');
        project::find($id)->update(['status'=>$status]);
        if($status=='结束'){
            project::find($id)->update(['basic_time'=>Carbon::now()]);
        }
        return ['status'=>true,'msg'=>'更新项目状态成功'];
    }

    //上传图片
    public function  uploadimg(){
        $file = Input::file('thumbnail');;
        $allowed_extensions = ["png", "jpg", "gif"];
//        return response()->json([
//            'error' => false,
//            'path' => $file,
//        ]);

        if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
            return ['error' => 'You may only upload png, jpg or gif.'];
        }

        $destinationPath = 'uploads/images/';
        $extension = $file->getClientOriginalExtension();
        $fileName = str_random(10).'.'.$extension;
        $file->move($destinationPath, $fileName);
        $host="/";
        // DB::insert('insert into articles (load_url) VALUES (?)',[$host.$destinationPath.$fileName]);

        return response()->json([
            'error' => false,
            'path' => $host.$destinationPath.$fileName,
        ]);

    }




}
