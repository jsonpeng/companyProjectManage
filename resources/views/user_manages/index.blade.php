@extends('layouts.app')

@section('css')
<style type="text/css">
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
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('userManages.create') !!}">添加员工</a>
        </h1>
   
    </section>
    <div class="content">
        <div class="clearfix"></div>
        <div class="page-heading" style="margin-bottom:15px;">
            <ul class="breadcrumb pull-left">
                <li> <a href="/home">主页</a> </li>
                <li> <a href="{!! route('userManages.index') !!}">组织管理</a> </li>
                <li class="active">员工管理</li>
            </ul>
        </div>
        @include('flash::message')

        <div class="clearfix"></div>
        <header class="panel-heading"> 员工总数：{!! $userManages->count() !!}</header>
        <div class="box box-primary">
            <div class="box-body">
                    @include('user_manages.table')
            </div>
        </div>
    </div>
@endsection

