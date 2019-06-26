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
        
          <input type="text" class="form-control" name="month_end" id="month_end" placeholder="根据月份查询" @if(array_key_exists('month_end', $input))value="{{$input['month_end']}}"@endif >
    
        <button type="submit" class="btn btn-primary">查询</button>
    </form>
@endsection

@section('content')

<div class="page-heading">
</div>
      <div class="row" style="margin-left:15px;">
        <div class="col-sm-12">
          <section class="panel">
            <header class="panel-heading">(默认是当月)人数/总数 {!! count($users) !!}<span class="tools pull-right"><a href="javascript:;" class="fa fa-chevron-down" data-function="switch-table" data-type="team-table"></a>
              </span> </header>
            <div class="panel-body" id="team-table" data-status="show">
              <section id="unseen">
                <form id="project-form-list">
                  <table class="table table-bordered table-striped table-condensed">
                    <thead>
                      <tr>
                        <th>姓名</th>
                        <th>涉及项目</th>
                        <th>项目奖金</th>
                        <th>基本工资</th>
                        <th>合计</th>
                      </tr>
                    </thead>
                    <tbody>
                    
                      @foreach($users as $user)
                      <tr>
                        <td>{!! $user->name !!}</td>
                        <td><?php if(array_key_exists('month_end', $input)){
                            $project=get_project_by_pra($user,$input['month_end']);
                          }else{
                            $project=get_project_by_pra($user,'');
                            }?>
                        @if($project!='--')
                          @foreach($project as $projects)
                            <a href="{!! route('projects.show', [$projects->id]) !!}" target="_blank">
                              {!! $projects->name !!}
                            </a>
                          @endforeach
                          @else
                          {!! $project !!}
                          @endif
                        </td>
                        <td>@if(array_key_exists('month_end', $input)){!! get_project_price_by_pra($user,$input['month_end']) !!}@else{!! $user->projectprice !!}@endif</td>
                        <td>{!! $user->wages !!}</td>
                        <td>@if(array_key_exists('month_end', $input)){!! get_project_price_by_pra($user,$input['month_end'])+$user->wages !!} @else{!! $user->projectprice+$user->wages!!}@endif</td>
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