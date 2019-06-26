
@extends('layouts.app')

@section('css')

@endsection

@section('content')
    <div class="page-heading">
      <h3> 公告 </h3>
    </div>
    <div class="clearfix"></div>

      <div class="row" style="padding:15px;">
        <div class="row">
          <div class="blog">
            <div class="col-md-12">
              <div class="panel">
                <div class="panel-body">
                  <div class="single-blog">
                    <h1 class="text-center mtop35"><a>{!! $gonggao->name !!}</a></h1>
                    <p class="text-center auth-row"> By <a href="javascript:;">{!! $gonggao->author !!}</a> |   {!! $gonggao->created_at !!} </p>
                    <div> {!! $gonggao->desc !!} </div>
                    <br>
                     <a class="btn p-follow-btn js-knowledge-laud" href="javascript:;" target="_blank">源地址</a> <a class="btn p-follow-btn js-knowledge-laud" id="dianzan_gonggao" href="javascript:;" data-id="{!! $gonggao->id !!}"> <i class="fa fa-heart"></i><span id="dianzan_gonggao_total">{!! $gonggao->dianzan !!}</span></a>&nbsp; <a class="btn p-follow-btn" href="#commenta"> <i class="fa fa-envelope-o"></i><span id="comment_gonggao_total">{!! $gonggao->comment()->count() !!}</span></a>&nbsp; <a class="btn p-follow-btn" href="javascript:;"> <i class="fa fa-eye"></i>{!! $gonggao->watch !!}</a>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="panel">
              <header class="panel-heading"> 精彩点评 <span class="tools pull-right"> <a class="fa fa-chevron-down" id="table-list" data-function="switch-table" data-type="team-table"  href="javascript:;"></a> </span> </header>
              <div class="panel-body" style="display: block;" id="team-table" data-status="show">
                <ul class="activity-list">

                  @foreach($gonggao->comment()->get() as $comment)
                  <li>
                    <div class="avatar"> <a href="javascript:;"><img src="{!! $comment->userobj->head_img !!}"></a> </div>
                    <div class="activity-desk">
                      <h5><a href="javascript:;">{!! $comment->userobj->name !!}:</a> <span>{!! $comment->content !!}</span></h5>
                      <p class="text-muted">{!! $comment->created_at !!}</p>
                    </div>
                  </li>
                  @endforeach
                
                  
                </ul>
                <form class="form-horizontal" id="knowledge-comment-form" action="" novalidate="novalidate">
                  <a name="commenta"></a>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <textarea name="comment" id="content" rows="6" class="form-control" placeholder="精彩评论不断……"></textarea>
                      <br>
                  
                      <button type="button" id="gonggao_comment_add" data-id="{!! $gonggao->id !!}" class="btn btn-primary pull-right">我来点评</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
 
    

  @endsection