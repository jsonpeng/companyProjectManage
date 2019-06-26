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
            产品详情
        </h1>
  @if(Auth::user()->is_admin=="是")
  <div class="page-heading">
      <ul class="breadcrumb pull-left">
        <li> <a href="/home">主页</a> </li>
        <li> <a href="/products">产品列表</a> </li>
        <li class="active"> {!! $products->name !!} </li>
      </ul>
      <div class="pull-right"><a href="{!! route('products.team', [$products->id]) !!}" class="btn btn-primary">团队</a> <a href="javascript:;" class="btn btn-primary">需求</a> <a href="javascript:;" class="btn btn-primary">任务</a> <a href="javascript:;" class="btn btn-primary">Bug</a><a href="javascript:;" class="btn btn-warning">报表</a></div>
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
                    <h1>产品介绍</h1>
                    <span class="designation">{!! $products->name !!}</span>
                    <div class="content"> {!! $products->des !!} </div>
                    @if(Auth::user()->is_admin=="是")<a class="btn p-follow-btn" href="{!! route('products.edit', [$products->id]) !!}"> <i class="fa fa-check"></i> 编辑</a>&nbsp; <a href="javascript:;" class="btn p-follow-btn js-project-single" data-productid="{!! $products->id !!}" id="productToProject">转化为项目</a>@else
  <div >
我的在该产品中的比例:{!! $products->users()->find(Auth::user()->id)->pivot->prop !!}%
  </div>@endif
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
    </div>


      <div class="row">
          <section class="panel">
            <header class="panel-heading"> 团队 / 总数：<span id="team_total">{!! $products->users()->count() !!}</span><span class="tools pull-right"><a href="javascript:;"  id="table-list" data-function="switch-table" data-type="team-table" class="fa fa-chevron-down"></a>
              </span> </header>
            <div class="panel-body" style="display: block;"  id="team-table" data-status="show">
              <section id="unseen">
                <form id="project-form-list">
                  <table class="table table-bordered table-striped table-condensed">
                    <thead>
                      <tr>
                        <th>成员</th>
                        <th>职位类型</th>
                  @if(Auth::user()->is_admin=="是")<th>产品比例</th>@endif
                        <th>加入时间</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($products->users()->get() as $users)
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


   <div class="row">
        <div class="">
          <section class="panel">
            <header class="panel-heading"> 转化为项目(分支)总数：<span id="team_total">{!! $products->projects()->count() !!}</span><span class="tools pull-right">
              <a href="javascript:;"  id="table-list" data-type="project-table" data-function="switch-table" class="fa fa-chevron-down"></a>
              </span> </header>
            <div class="panel-body" style="display: block;" id="project-table" data-status="show">
              <section id="unseen">
                <form id="project-form-list">
                  <table class="table table-bordered table-striped table-condensed">
                    <thead>
                      <tr>
                        <th>项目名称</th>
                        <th>项目类型</th>
                        <th>项目参与人</th>
                        <th>转化时间</th>
                      </tr>
                    </thead>
                    <tbody>
                    
                    @foreach($products->projects()->get() as $projects)
                    <tr>
                        <td> <a href="{!! route('projects.show', [$projects->id]) !!}" >{!! $projects->name !!}</a></td>
                        <td>{!! $projects->type !!}</td>
                        @if($projects->users()->count()>0)
                        <td>@foreach($projects->users()->get() as $users)<a style="margin-left:5px;" href="{!! route('users.info', [$users->id]) !!}">{!! $users->name !!}</a>@endforeach</td>
                        @else
                        <td>--</td>
                        @endif
                        <td>{!! $projects->created_at !!}</td>
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
}
@endsection
