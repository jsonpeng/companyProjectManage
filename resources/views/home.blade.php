@extends('layouts.app')

@section('css')
<style>
tr>th{
    text-align:center;
}
</style>
@endsection

@section('content')

      <div class="row" style="padding:20px">
        <div class="col-md-4">
          <div class="row">
          
            <div class="col-md-12">
              <div class="panel">
                <div class="panel-body">
                  <div class="profile-pic text-center"><img alt="{!! $user->name !!}" src="{!! $user->head_img !!}"> </div>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="panel">
                <div class="panel-body">
                  <ul class="p-info">
                    <li>
                      <div class="title">姓名</div>
                      <div class="desk">{!! $user->name !!}</div>
                    </li>
                    <li>
                      <div class="title">性别</div>
                      <div class="desk">{!! $user->gender !!}</div>
                    </li>
                    <li>
                      <div class="title">生日</div>
                      <div class="desk">{!! $user->birthday !!}</div>
                    </li>
                    <li>
                      <div class="title">电话</div>
                      <div class="desk">{!! $user->tel !!}</div>
                    </li>
                    <li>
                      <div class="title">职位</div>
                      <div class="desk">{!! $user->type !!}</div>
                    </li>
                      <!--li>
                      <div class="title">基本工资</div>
                      <div class="desk">{!! $user->wages !!}</div>
                    </li-->
                     <li>
                      <div class="title">本月项目奖金</div>
                      <div class="desk">{!! $user->projectprice !!}</div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            
            <div class="col-md-12">
              <div class="panel">

                       <div class="panel-body">
                  <div class="profile-desk">
                    <h1>我参与到的产品<a class="pull-right" style="font-size:16px;" href="{!! route('user.list.product',[$id]) !!}">更多</a></h1>
                    <table class="table table-bordered table-striped table-condensed cf">
                      <thead class="cf">
                        <tr>
                          <th>产品名称</th>
                          <th>产品类型</th>
                          <th class="numeric">产品参与人员</th>
                        </tr>
                      </thead>

                      <tbody>
                      @foreach($products as $products)
                      <tr>
                        <td><a href="{!! route('products.show', [$products->id]) !!}">{!! $products->name !!}</a></td>
                        <td>{!! $products->cats()->first()->name !!}</td>
                        @if($products->users()->count()>0)
                        <td>@foreach($products->users()->get() as $users)<a style="margin-left:5px;" href="@if(Auth::user()->is_admin=='是'){!! route('users.info', [$users->id]) !!} @else javascript:; @endif">{!! $users->name !!}</a>@endforeach</td>
                        @else
                        <td>--</td>
                        @endif
                      </tr>
                      @endforeach
                      </tbody>
                      
                    </table>
                  </div>
                </div>

              </div>
            </div>   

    
          </div>
        </div>
        <div class="col-md-8">

          

          <div class="row">
            <div class="col-md-12">
              <div class="panel">
                <div class="panel-body">
                  <div class="profile-desk">
                    <h1>我参与到的项目<a class="pull-right" style="font-size:16px;" href="{!! route('user.list.project',[$id]) !!}">更多</a></h1>
                    <table class="table table-bordered table-striped table-condensed cf">
                      <thead class="cf">
                        <tr>
                          <th>项目名称</th>
                          <th>计划结束日期</th>
                          <th>实际结束日期</th>
                          <th class="numeric">状态</th>
                          <th class="numeric">项目参与人员</th>
                        </tr>
                      </thead>
                      <tbody>
                      
                      @foreach($projects as $projects)
                      <tr>
                        <td><a href="{!! route('projects.show', [$projects->id]) !!}">{!! $projects->name !!}</a></td>
                        <td>{!! $projects->end_time !!}</td>
                        <td>{!! $projects->basic_time !!}</td>
                        <td>{!! $projects->status !!}</td>
                        @if($projects->users()->count()>0)
                        <td>@foreach($projects->users()->get() as $users)<a style="margin-left:5px;" href="@if(Auth::user()->is_admin=='是'){!! route('users.info', [$users->id]) !!} @else javascript:; @endif">{!! $users->name !!}</a>@endforeach</td>
                        @else
                        <td>--</td>
                        @endif
                      </tr>
                      @endforeach
                      
                      </tbody>   
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="panel">
                <div class="panel-body">
                  <div class="profile-desk">
                    <h1>我的任务<a class="pull-right" style="font-size:16px;" href="javascript:;">更多</a></h1>
                    <table class="table table-bordered table-striped table-condensed cf">
                      <thead class="cf">
                        <tr>
                          <th>任务名称</th>
                          <th>结束日期</th>
                          <th class="numeric">状态</th>
                          <th class="numeric">预计工作日</th>
                        </tr>
                      </thead>
                      <tbody>
                      
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="panel">
                <div class="panel-body">
                  <div class="profile-desk">
                    <h1>我的Bug<a class="pull-right" style="font-size:16px;" href="javascript:;">更多</a></h1>
                    <table class="table table-bordered table-striped table-condensed cf">
                      <thead class="cf">
                        <tr>
                          <th>Bug标题</th>
                          <th>创建日期</th>
                          <th class="numeric">状态</th>
                          <th>创建人</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr> 
                      </tr></tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-12">
              <div class="panel">
                <header class="panel-heading">公告<span class="pull-right"> <a href="javascript:;"></a></span></header>
                <div class="panel-body">
                  <ul class="activity-list">
                  
                  @foreach($gonggao as $gonggao)
                  <li>
                  <a href="{!! route('article.gonggao',[$gonggao->id]) !!}" >
                      <div class="avatar"> <img src="{!! $gonggao->userobj->head_img !!}" alt="{!! $gonggao->author !!}"></div>
                      <div class="activity-desk">
                        <h5><span href="javascript:;">{!! $gonggao->author !!}</span> <span><span  style="color:#2a323f">{!! $gonggao->name !!}</span></span></h5>
                        <p class="text-muted">{!! $gonggao->desc !!}</p>
                        <p class="pull-right text-muted"><i class="fa fa-eye"></i>{!! $gonggao->watch !!}&nbsp;&nbsp;&nbsp;<i class="fa fa-heart"></i>{!! $gonggao->dianzan !!}&nbsp;&nbsp;&nbsp;<i class="fa fa-envelope-o"></i>{!! $gonggao->comment()->count() !!}&nbsp;&nbsp;&nbsp;{!! $gonggao->created_at !!}</p>
                      </div>
                    </a>
                    </li>
                @endforeach

                  </ul>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>

@endsection
