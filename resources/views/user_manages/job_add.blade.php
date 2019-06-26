@extends('layouts.app')

@section('css')
<style>
tr>th{
    text-align:center;
}
.zuzhi-manage a{
    font-size: 16px;
    padding-left: 10px;
}
</style>
@endsection

@section('content')
    <section class="content-header">
        <h1>
            职位管理<span class="zuzhi-manage"><a href="{!! route('userManages.index') !!}">员工</a><a href="{!! route('usermanage.job.index') !!}">职位</a><a href="{!! route('usermanage.gonggao.index') !!}">公告</a></span>
        </h1>
 
    <div class="page-heading">
      <ul class="breadcrumb pull-left">
                <li> <a href="/home">主页</a> </li>
                <li> <a href="{!! route('userManages.index') !!}">组织管理</a> </li>
                <li ><a href="{!! route('usermanage.job.index') !!}">职位管理</a></li>
                <li class="active">添加职位</li>
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
                  <label class="col-sm-2 col-sm-2 control-label">职位名称</label>
                  <div class="col-sm-10">
                  <input type="text" name="job_name"  class="form-control js-search-username" placeholder="请输入职位名称">
                
                  </div>
                </div>
                   <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">职位描述</label>
                  <div class="col-sm-10">
                    <textarea  id="job_desc" class="form-control intro" placeholder="请输入职位描述"></textarea> 
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-2 col-sm-2 control-label"></label>
                  <div class="col-lg-10">
                    <button type="button" id="add_job" data-type="job" class="btn btn-primary">添加职位</button>
                  </div>
                </div>
              </form>
            </div>
          </section>
        </div>
      </div>
    </div>
@endsection
@include('vendor.js')