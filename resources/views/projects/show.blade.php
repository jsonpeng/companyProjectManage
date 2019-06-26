@extends('layouts.app')

@section('css')
<style>
tr>th{
    text-align:center;
}
</style>
@endsection

@section('content')
    <section class="content-header">
        <h1>
        项目详情
        </h1>
 @if(Auth::user()->is_admin=="是")
        <div class="page-heading">
      <ul class="breadcrumb pull-left">
        <li> <a href="/home">主页</a> </li>
        <li> <a href="{!! route('projects.index') !!}">项目列表</a> </li>
        <li class="active"> {!! $project->name !!} </li>
      </ul>
      <div class="pull-right"><a href="{!! route('projects.team', [$project->id]) !!}" class="btn btn-primary">团队</a> <a href="javascript:;" class="btn btn-primary">需求</a> <a href="javascript:;" class="btn btn-primary">任务</a> <a href="javascript:;" class="btn btn-primary">Bug</a> <a href="javascript:;" class="btn btn-warning">报表</a></div>
    </div>
    @endif
    </section>
    <div class="content" style="margin-left:15px;">
       <div class="row" >
    <div class="wrapper" style="background:none;">
      <div class="row">
        <div class="col-md-8">
          <div class="row">
            <div class="col-md-12">
              <div class="panel">
                <div class="panel-body">
                  <div class="profile-desk">
                    <h1>项目介绍</h1>
                    <span class="designation">{!! $project->name !!}</span>
                    <div class="content"> {!! $project->des !!} </div>
                    
                    @if(Auth::user()->is_admin=="是")<a class="btn p-follow-btn" href="{!! route('projects.edit', [$project->id]) !!}"> <i class="fa fa-check"></i> 编辑</a>&nbsp;<a href="javascript:;" class="btn p-follow-btn js-project-single {!! $project->status=='挂起'?'active':'' !!}" data-id="{!! $project->id !!}" data-status="挂起">挂起</a><a href="javascript:;" class="btn p-follow-btn js-project-single {!! $project->status=='进行'?'active':'' !!}" data-id="{!! $project->id !!}" data-status="进行">进行</a> <a href="javascript:;" class="btn p-follow-btn js-project-single {!! $project->status=='延期'?'active':'' !!}" data-id="{!! $project->id !!}" data-status="延期">延期</a>  <a href="javascript:;" class="btn p-follow-btn js-project-single {!! $project->status=='结束'?'active':'' !!}" data-id="{!! $project->id !!}" data-status="结束">结束</a>@endif
                    
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="panel">
            <div class="panel-body">
              <ul class="p-info">
                <li>
                  <div class="title">项目名称</div>
                  <div class="desk">{!! $project->name !!}</div>
                </li>
                <li>
                  <div class="title">项目类型</div>
                  <div class="desk">{!! $project->type !!}</div>
                </li>
                <li>
                  <div class="title">起止时间</div>
                  <div class="desk">{!! $project->start_time !!}至{!! $project->end_time !!}</div>
                </li>
                <li>
                  <div class="title">可用工作日</div>
                  <div class="desk js-workday">{!! $project->canusetime !!}</div>
                </li>
                <li>
                  <div class="title">项目负责人</div>
                  <div class="desk">{!! $project->main_man !!}</div>
                </li>
            
                <li>
                  <div class="title">项目状态</div>
                  <div class="desk">{!! $project->status !!}</div>
                </li>
                 @if(Auth::user()->is_admin!="是")
                <li> 
                <div class="title">我在此项目中的比例</div>
                <div class="desk">{!! $project->users()->find(Auth::user()->id)->pivot->prop !!} %</div>
                </li>
                @endif
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>


      <div class="row">
          <section class="panel">
            <header class="panel-heading"> 团队 / 总数：<span id="team_total">{!! $project->users()->count() !!}</span><span class="tools pull-right"><a href="javascript:;"  id="table-list" data-function="switch-table" data-type="team-table" class="fa fa-chevron-down"></a>
              </span> </header>
            <div class="panel-body" style="display: block;"  id="team-table" data-status="show">
              <section id="unseen">
                <form id="project-form-list">
                  <table class="table table-bordered table-striped table-condensed">
                    <thead>
                      <tr>
                        <th>成员</th>
                        <th>职位类型</th>
                        @if(Auth::user()->is_admin=="是")<th>项目比例</th>@endif
                        <th>加入时间</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($project->users()->get() as $users)
                    <tr>
                      <td><a href="@if(Auth::user()->is_admin=='是'){!! route('users.info', [$users->id]) !!} @else javascript:; @endif">{!! $users->name !!}</a></td>
                      <td>{!! $users->type !!}</td>
                     @if(Auth::user()->is_admin=="是")<td>{!! $users->pivot->prop !!}</td>@endif
                      <td>{!! $users->pivot->created_at !!}</td>
                 @endforeach 
                    </tbody>
                    
                  </table>
                </form>
                
                 </section>
            </div>
          </section>
    </div>

 
    </div>
@endsection
