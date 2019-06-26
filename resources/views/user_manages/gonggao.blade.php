@extends('layouts.app')

@section('css')
<style type="text/css">
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
        <h1 class="pull-left">组织管理 <span class="zuzhi-manage"><a href="{!! route('userManages.index') !!}">员工</a><a href="{!! route('usermanage.job.index') !!}">职位</a><a href="{!! route('usermanage.gonggao.index') !!}">公告</a></span></h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('usermanage.gonggao.add') !!}">添加公告</a>
        </h1>
   
    </section>
    <div class="content">
        <div class="clearfix"></div>
        <div class="page-heading" style="margin-bottom:15px;">
            <ul class="breadcrumb pull-left">
                <li> <a href="/home">主页</a> </li>
                <li> <a href="{!! route('userManages.index') !!}">组织管理</a> </li>
                <li class="active">公告管理</li>
            </ul>
        </div>
        @include('flash::message')

        <div class="clearfix"></div>
             <div class="row">
        <div class="col-sm-12">
          <section class="panel">
            <header class="panel-heading"> 公告管理 / 总数：<span id="team_total">{!! $gonggao->count() !!}</span><span class="tools pull-right"><a href="javascript:;"  id="table-list" data-function="switch-table" data-type="team-table" class="fa fa-chevron-down"></a>
              
              </span> </header>
            <div class="panel-body" style="display: block;" id="team-table" data-status="show">
              <section id="unseen">
                <form id="project-form-list">
                  <table class="table table-bordered table-striped table-condensed">
                    <thead>
                      <tr>
                        <th>公告名称</th>
                        <th>公告描述</th>
                        <th>创建时间</th>
                        <th>操作</th>
                      </tr>
                    </thead>
                    <tbody>
                    
                    @foreach($gonggao as $gonggao)
                    <tr>
                      <td>{!! $gonggao->name !!}</td>
                      <td>{!! $gonggao->desc !!}</td>
                      <td>{!! $gonggao->created_at !!}</td>
                      <td><a href="{!! route('article.gonggao', [$gonggao->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a><a href="javascript:;" class="btn btn-danger btn-xs"  title="删除" id="del_gonggao" data-type="gonggao" data-usersid="{!! $gonggao->id !!}"><i class="fa fa-trash-o"></i></a></td>
                    </tr>
                    @endforeach
                    
                    </tbody>
                    
                  </table>
                </form>
                
                 </section>
            </div>
          </section>
        </div>
  
    </div>
    </div>
@endsection

