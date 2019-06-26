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
            团队成员管理
        </h1>
 
<div class="page-heading">
      <ul class="breadcrumb pull-left">
        <li> <a href="/home">主页</a> </li>
        <li> <a href="/projects">项目列表</a> </li>
        <li ><a href="{!! route('projects.show', [$projects->id]) !!}"> {!! $projects->name !!} </a></li>
        <li ><a href="{!! route('projects.team', [$projects->id]) !!}"> 团队成员 </a></li>
        <li class="active">添加团队成员</li>
      </ul>
    </div>

    </section>

    <div class="content" style="margin-left:15px;">
        <div class="row">
        <div class="col-lg-12">
          <section class="panel">
            <header class="panel-heading"></header>
            <div class="panel-body">
              <form class="form-horizontal adminex-form" id="team-form" novalidate="novalidate">
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">请选择一个用户添加到该项目</label>
                  <div class="col-sm-10">
                     <select class="form-control col-sm-8"  id="users">
                             @foreach($users as $users)
                                    <option value="{!! $users->id !!}">{!! $users->name !!}</option>
                             @endforeach
                      </select>
                
                  </div>
                </div>
                   <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">该成员比例</label>
                  <div class="col-sm-10">
                    <input type="number" name="prop"  class="form-control js-search-username" placeholder="请输入比例(100分比例,1=1%)">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-2 col-sm-2 control-label"></label>
                  <div class="col-lg-10">
                    <button type="button" id="add_team" data-projectsid="{!! $projects->id !!}" data-type="projects" class="btn btn-primary">添加成员</button>
                  </div>
                </div>
              </form>
            </div>
          </section>
        </div>
      </div>
    </div>
@endsection
