@extends('layouts.app')

@section('css')
<style>
tr>th{
    text-align:center;
}
</style>
@endsection


@section('search_form')
<form class="searchform" action="" method="get">
    <!--     <select name="status" class="form-control">
          <option value="">项目状态</option>
          <option value="挂起"  @if(array_key_exists('status', $input)){!! $input['status']=="挂起"?'selected':'' !!}@endif>挂起</option>
          <option value="延期" @if(array_key_exists('status', $input)) {!! $input['status']=="延期"?'selected':'' !!}@endif>延期</option>
          <option value="进行" @if(array_key_exists('status', $input)) {!! $input['status']=="进行"?'selected':'' !!}@endif>进行</option>
          <option value="结束" @if(array_key_exists('status', $input)){!! $input['status']=="结束"?'selected':'' !!}@endif>结束</option>
        </select> -->
        <input type="text" class="form-control" name="month_end" id="month_end" placeholder="根据月份查询" @if(array_key_exists('month_end', $input))value="{{$input['month_end']}}"@endif >
     
        <button type="submit" class="btn btn-primary">搜索</button>
    </form>
@endsection

@section('content')
<div class="page-heading">



      <ul class="breadcrumb pull-left">
        <li><a href="{!! route('users.info', [$id]) !!}">我的首页</a> </li>
        <li > <a href="{!! route('user.list.product',[$id]) !!}">我参与的产品</a> </li>
        <li class="active"><a href="{!! route('user.list.project',[$id]) !!}">我参与的项目</a> </li>
      </ul>
</div>

      <div class="row" style="margin-left:15px;margin-top:20px;">
        <div class="col-sm-12">
          <section class="panel">
            <header class="panel-heading"> 项目 / 总数：{!! count($projects) !!},我的项目奖金(默认是当月):{!! $price !!}<span class="tools pull-right"><a href="javascript:;" class="fa fa-chevron-down" data-function="switch-table" data-type="team-table"></a>
              </span> </header>
            <div class="panel-body" id="team-table" data-status="show">
              <section id="unseen">
                <form id="project-form-list">
                  <table class="table table-bordered table-striped table-condensed">
                    <thead>
                      <tr>
                        <th>项目名称</th>
                        <th>参与人</th>
                        <th>我的比例</th>
                        <th>项目金额</th>
                        <th>项目计划开始时间</th>
                        <th>项目计划结束时间</th>
                        <th>项目实际结束时间</th>
                        <th>项目状态</th>
                        <th>当前可用时间</th>
                      </tr>
                    </thead>
                    <tbody>
                    
                      @foreach($projects as $projects)
                      <tr>
                        <td><a href="{!! route('projects.show', [$projects->id]) !!}">{!! $projects->name !!}</a></td>
                        @if($projects->users()->count()>0)
                        <td>@foreach($projects->users()->get() as $users)<a style="margin-left:5px;" href="{!! route('users.info', [$users->id]) !!}">{!! $users->name !!}</a>@endforeach</td>
                        @else
                        <td>--</td>
                        @endif
                        <td>{!! $projects->users()->find($id)->pivot->prop !!} </td>
                        <td>{!! $projects->price !!} </td>
                        <td>{!! $projects->start_time !!}</td>
                        <td>{!! $projects->end_time !!}</td>
                        <td>{!! $projects->basic_time !!} </td>
                        <td>{!! $projects->status !!} </td>
                        <td>{!! $projects->canusetime !!} </td>
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