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
        <li> <a href="/products">产品列表</a> </li>
        <li ><a href="{!! route('products.show', [$products->id]) !!}"> {!! $products->name !!} </a></li>
        <li class="active">团队成员</li>
      </ul>
      <div class="pull-right"><a href="{!! route('products.team.add',[$products->id]) !!}" class="btn btn-primary">添加新成员</a></div>
    </div>

    </section>

    <div class="content" style="margin-left:15px;">

      <div class="row">
        <div class="col-sm-12">
          <section class="panel">
            <header class="panel-heading"> 团队 / 总数：<span id="team_total">{!! $products->users()->count() !!}</span><span class="tools pull-right"><a href="javascript:;"  id="table-list" data-function="switch-table" data-type="team-table" class="fa fa-chevron-down"></a>
              
              </span> </header>
            <div class="panel-body" style="display: block;" id="team-table" data-status="show">
              <section id="unseen">
                <form id="project-form-list">
                  <table class="table table-bordered table-striped table-condensed">
                    <thead>
                      <tr>
                        <th>成员</th>
                        <th>职位类型</th>
                        <th>产品比例</th>
                        <th>加入时间</th>
                        <th>操作</th>
                      </tr>
                    </thead>
                    <tbody>
                    
                    @foreach($products->users()->get() as $users)
                    <tr>
                      <td><a href="@if(Auth::user()->is_admin=='是'){!! route('users.info', [$users->id]) !!} @else javascript:; @endif">{!! $users->name !!}</a></td>
                      <td>{!! $users->type !!}</td>
                      <td>{!! $users->pivot->prop !!}</td>
                      <td>{!! $users->pivot->created_at !!}</td>
                      <td> <a href="javascript:;"  data-id="{!! $products->id !!}" data-name="{!! $users->name !!}" data-prop="{!! $users->pivot->prop !!}" class='edit_team_product btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a><a href="javascript:;" class="js-team-single btn btn-danger btn-xs" data-type="products" data-productsid="{!! $products->id !!}" data-usersid="{!! $users->id !!}" title="删除"><i class="fa fa-trash-o"></i> </a></td>
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
