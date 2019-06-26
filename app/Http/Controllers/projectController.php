<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateprojectRequest;
use App\Http\Requests\UpdateprojectRequest;
use App\Models\project;
use App\Repositories\projectRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use App\User;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;

class projectController extends AppBaseController
{
    /** @var  projectRepository */
    private $projectRepository;

    public function __construct(projectRepository $projectRepo)
    {
        $this->projectRepository = $projectRepo;
    }

    /**
     * Display a listing of the project.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $projects = project::where('id','>',0);
        $input=$request->all();
        $input = array_filter( $input, function($v, $k) {
            return $v != '';
        }, ARRAY_FILTER_USE_BOTH );

        if (array_key_exists('start_time', $input)) {
            $projects = $projects->where('end_time', '>=', Carbon::createFromFormat('Y-m-d', $input['start_time'])->setTime(0, 0, 0));
        }
        if (array_key_exists('end_time', $input)) {
            $projects = $projects->where('end_time', '<', Carbon::createFromFormat('Y-m-d', $input['end_time'])->addDay()->setTime(0, 0, 0));
        }
        if (array_key_exists('status', $input)) {
            $projects = $projects->where('status', $input['status']);
        }
        $projects=$projects->orderBy('created_at','desc')->paginate(10);
        return view('projects.index')
                ->with('projects', $projects)
                ->withInput(Input::all());
        }



    //团队成员主页
    public function teamIndex($id){
        $projects=project::find($id);
        return view('projects.team')
             ->with('projects',$projects);
    }

    //团队成员添加
    public function teamAdd($id){
        $users=User::where('is_admin','否')->get();
        $projects=project::find($id);
        return view('projects.team_add')
            ->with('users',$users)
            ->with('projects',$projects);
    }


    //团队成员添加接口
    public function teamAddApi(Request $request,$id){
        $users_id=$request->get('users');
        $prop=$request->get('prop');
        $projects=project::find($id);
        $projects_users_arr=$projects->users()->get();
        $users_arr=[];
        $prop_all=$prop;
        for($i =0;$i<count($projects_users_arr);$i++){
            Array_push($users_arr,$projects_users_arr[$i]->id);
            $prop_all +=$projects_users_arr[$i]->pivot->prop;
        }
        if($prop_all>100){
            return ['status' => false, 'msg' => '成员比例已达到上限,请调整成员比例'];
        }
        if(in_array($users_id,$users_arr)){
            return ['status' => false, 'msg' => '该成员已经被添加过'];
        }else {
            project::find($id)->users()->attach($users_id, ['prop' => $prop]);
            return ['status' => true, 'msg' => '添加团队成员成功','result_url'=>route('projects.team', [$projects->id])];
        }
    }

    //团队成员删除接口
    public function teamDelApi(Request $request,$id){
        $users_id=$request->get('users_id');
        $projects=project::find($id);
        $projects_users_arr=$projects->users()->get();
        $users_arr=[];
        for($i =0;$i<count($projects_users_arr);$i++){
            if($projects_users_arr[$i]->id!=$users_id){
                Array_push($users_arr,$projects_users_arr[$i]->id);
            }
        }
        $projects->users()->sync($users_arr);
        return ['status'=>true,'msg'=>'删除团队成员成功','result_total'=>count($users_arr)];
    }

    //团队成员比例修改接口
    public function teamEditApi(Request $request,$id){
        $users_id=$request->get('users_id');
        $prop=$request->get('prop');
        $products=project::find($id);
        $products_users_arr=$products->users()->get();

        $prop_all=$prop;
        for($i =0;$i<count($products_users_arr);$i++){
          if( $products_users_arr[$i]->id!=$users_id) {
              $prop_all += $products_users_arr[$i]->pivot->prop;
          }
        }

        if($prop_all>100){
            return ['status' => false, 'msg' => '成员比例已达到上限,请重新调整该成员比例'];
        }
        $products->users()->updateExistingPivot($users_id, ['prop' => $prop]);

        return ['status' => true, 'msg' => '团队成员比例修改成功'];
    }

    /**
     * Show the form for creating a new project.
     *
     * @return Response
     */
    public function create()
    {
        $user=User::all();
        return view('projects.create')->with('user',$user);
    }

    /**
     * Store a newly created project in storage.
     *
     * @param CreateprojectRequest $request
     *
     * @return Response
     */
    public function store(CreateprojectRequest $request)
    {
        $request['des']=str_replace('../','/',$request['des']);
        $input = $request->all();

        $project = $this->projectRepository->create($input);
        if ( array_key_exists('users', $input) ) {
            $project->users()->sync($input['users']);
        }
        if($input['status']=='结束'){
            project::find($project->id)->update(['basic_time'=>Carbon::now()]);
        }
        Flash::success('项目信息保存成功.');

        return redirect(route('projects.index'));
    }

    /**
     * Display the specified project.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $project = $this->projectRepository->findWithoutFail($id);

        if (empty($project)) {
            Flash::error('Project not found');
            return redirect(route('projects.index'));
        }

        return view('projects.show')->with('project', $project);
    }

    /**
     * Show the form for editing the specified project.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $project = $this->projectRepository->findWithoutFail($id);

        if (empty($project)) {
            Flash::error('Project not found');

            return redirect(route('projects.index'));
        }
        $user=User::all();
        $selectedusers=[];
        $select_user=project::find($id)->users()->get();
        for($i =0;$i<count($select_user);$i++){
            Array_push($selectedusers,$select_user[$i]->id);
        }
        return view('projects.edit')
            ->with('project', $project)
            ->with('user',$user)
            ->with('selectedusers',$selectedusers);
    }

    /**
     * Update the specified project in storage.
     *
     * @param  int              $id
     * @param UpdateprojectRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateprojectRequest $request)
    {
        $project = $this->projectRepository->findWithoutFail($id);
        $input = $request->all();
        if (empty($project)) {
            Flash::error('Project not found');

            return redirect(route('projects.index'));
        }

        $project = $this->projectRepository->update($request->all(), $id);
        if($input['status']=='结束'){
            project::find($id)->update(['basic_time'=>Carbon::now()]);
        }
        Flash::success('项目信息更新成功');

        return redirect(route('projects.index'));
    }

    /**
     * Remove the specified project from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $project = $this->projectRepository->findWithoutFail($id);

        if (empty($project)) {
            Flash::error('Project not found');

            return redirect(route('projects.index'));
        }

        $this->projectRepository->delete($id);
        $project->users()->sync([]);
        Flash::success('项目信息删除成功.');

        return redirect(route('projects.index'));
    }
}
