@extends('layouts.app')
@section('search_form')
<form class="searchform" action="" method="get">
        <select name="status" class="form-control">
          <option value="">项目状态</option>
          <option value="挂起"  @if(array_key_exists('status', $input)){!! $input['status']=="挂起"?'selected':'' !!}@endif>挂起</option>
          <option value="延期" @if(array_key_exists('status', $input)) {!! $input['status']=="延期"?'selected':'' !!}@endif>延期</option>
          <option value="进行" @if(array_key_exists('status', $input)) {!! $input['status']=="进行"?'selected':'' !!}@endif>进行</option>
          <option value="结束" @if(array_key_exists('status', $input)){!! $input['status']=="结束"?'selected':'' !!}@endif>结束</option>
        </select>
        <input type="text" class="form-control" name="start_time" id="create_start" placeholder="开始时间段(以项目状态结束为准)" @if(array_key_exists('start_time', $input))value="{{$input['start_time']}}"@endif >
        <input type="text" class="form-control" name="end_time" id="create_end" placeholder="结束时间段(以项目状态结束为准)" @if (array_key_exists('end_time', $input))value="{{$input['end_time']}}"@endif >
        <button type="submit" class="btn btn-primary">搜索</button>
</form>
@endsection
@section('content')
    <section class="content-header">
        <h1 class="pull-left">项目管理</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('projects.create') !!}">添加一个新的项目</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('projects.table')
            </div>
        </div>
        {!! $projects->appends($input)->links() !!}
    </div>
@endsection

