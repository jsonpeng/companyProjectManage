@extends('layouts.app')

@section('css')
<style>
tr>th{
    text-align:center;
}
</style>
@endsection

@section('content')

<div class="page-heading">
      <ul class="breadcrumb pull-left">
        <li><a href="{!! route('users.info', [$id]) !!}">我的首页</a> </li>
        <li class="active"> <a href="{!! route('user.list.product',[$id]) !!}">我参与的产品</a> </li>
        <li><a href="{!! route('user.list.project',[$id]) !!}">我参与的项目</a> </li>
      </ul>
</div>

      <div class="row" style="margin-left:15px;margin-top:20px;">
        <div class="col-sm-12">
          <section class="panel">
            <header class="panel-heading"> 产品 / 总数：{!! count($products) !!}<span class="tools pull-right"><a href="javascript:;" class="fa fa-chevron-down" data-function="switch-table" data-type="team-table"></a>
              </span> </header>
            <div class="panel-body" id="team-table" data-status="show">
              <section id="unseen">
                <form id="project-form-list">
                  <table class="table table-bordered table-striped table-condensed">
                    <thead>
                      <tr>
                        <th>产品名称</th>
                        <th>产品类型</th>
                        <th>参与人</th>
                        <th>我的比例</th>
                        <th>创建时间</th>
                      </tr>
                    </thead>
                    <tbody>
                    
                    
                    
                      @foreach($products as $products)
                      <tr>
                        <td><a href="{!! route('products.show', [$products->id]) !!}">{!! $products->name !!}</a></td>
                        <td>{!! $products->cats()->first()->name !!}</td>
                        @if($products->users()->count()>0)
                        <td>@foreach($products->users()->get() as $users)<a style="margin-left:5px;" href="{!! route('users.info', [$users->id]) !!}">{!! $users->name !!}</a>@endforeach</td>
                        @else
                        <td>--</td>
                        @endif
                        <td>{!! $products->users()->find($id)->pivot->prop !!} </td>
                        <td>{!! $products->created_at !!} </td>
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
@endsection