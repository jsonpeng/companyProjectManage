<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>项目管理系统</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/select2/4.0.3/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/iCheck/1.0.2/skins/all.css">
    
    <link rel="stylesheet" href="{{ asset('vendor/adminLTE/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminLTE/css/skins/skin-blue.min.css') }}">
    <link rel="stylesheet" href="https://cdn.bootcss.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}" >
    <style>
    .content-wrapper, .right-side,.main-footer {
    background-color: #eff0f4;
    }
    .skin-blue .main-header li.user-header, .skin-blue .main-header .navbar  {
    background-color: #fff;
    }
    .skin-blue .main-header .navbar .sidebar-toggle,.navbar-nav>.user-menu>.dropdown-menu>li.user-header>p,.skin-blue .main-header .navbar .nav>li>a{
    color: black;
    }
    </style>
    @yield('css')
</head>

<body class="skin-blue sidebar-mini">
@if (!Auth::guest())
    <div class="wrapper">
        <!-- Main Header -->
        <header class="main-header">

            <!-- Logo -->
            <a href="#" class="logo">
                <b>项目管理系统</b>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                   @yield('search_form')
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <img src="{!! Auth::user()->head_img !!}"
                                     class="user-image" alt="User Image"/>
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs">{!! Auth::user()->name !!}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    <img src="{!! Auth::user()->head_img !!}"
                                         class="img-circle" alt="User Image"/>
                                    <p>
                                        武汉智琛佳源科技有限公司
                                        <small>{!! Auth::user()->type !!}</small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="{!! route('users.info', [Auth::user()->id]) !!}" class="btn btn-default btn-flat">个人主页</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{!! url('/logout') !!}" class="btn btn-default btn-flat"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                         退出
                                        </a>
                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Left side column. contains the logo and sidebar -->
        @include('layouts.sidebar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>

        <!-- Main Footer -->
        <footer class="main-footer" style="max-height: 100px;text-align: center">
            <strong>Copyright © 2017 <a href="#">武汉智琛佳源科技有限公司</a>.</strong> All rights reserved.
        </footer>

    </div>
@else
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{!! url('/') !!}">
                    InfyOm Generator
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{!! url('/home') !!}">Home</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    <li><a href="{!! url('/login') !!}">Login</a></li>
                    <li><a href="{!! url('/register') !!}">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @endif
    <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdn.bootcss.com/select2/4.0.3/js/select2.min.js"></script>
    <script src="https://cdn.bootcss.com/iCheck/1.0.2/icheck.min.js"></script>
    
    <script type="text/javascript" src="{{ asset('vendor/tinymce/jquery.tinymce.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/multisel/js/bootstrap-multiselect.js') }}"></script>

    <script type="text/javascript" src="{{ asset('vendor/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="https://cdn.bootcss.com/admin-lte/2.3.11/js/app.min.js"></script>
    <script type="text/javascript" src="{!! asset('/js/layer/layer.js')!!}"></script>
    <script type="text/javascript">
    $(function(){
        //强制转换为密码输入框
        $('#pwd').attr('type','password');
        $("#create_start,#create_end").datetimepicker({
            format: 'yyyy-mm-dd',
            language: "zh-CN",
            minView: "month",
            autoclose: true,  
            });
               $("#month_end").datetimepicker({
            format: 'yyyy-mm',  
             weekStart: 1,  
             autoclose: true,  
             startView: 3,  
             minView: 3,  
             forceParse: false,  
             language: 'zh-CN'  
            });

    });

    //保存产品信息
    $('#save_product').click(function(){
        var name=$('input[name="name"]').val();
        var cats=$('#cats option:selected').val();
        var des=tinyMCE.activeEditor.getContent();
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
         $.ajax({
                    url: '/save_product',
                    type: 'POST',
                    data: "name="+name+"&cats="+cats+"&des="+des,
                    success:function(data){
                        if(data.status){
                    layer.open({
                      type: 1,
                      area: ['680px', '250px'], 
                      content: '<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button><h4 class="modal-title">新建产品成功，请先按产品流程设置</h4></div><div class="modal-body"><a href="'+data.result_team_url+'" class="btn btn-success">添加团队成员</a><a href="javascript:;" class="btn btn-warning">建立需求</a><a href="javascript:;" class="btn btn-info">建立任务</a></div><div class="modal-footer"><a href="'+data.result_manage_url+'" class="btn btn-primary">去设置管理</a></div>'
                    });
                        }

                    }
                });

    });

    //表格隐藏与显示
    $('.fa').click(function(){
       var type=$(this).data('type');
        var status= $('#'+type).data('status');
        var functions =$(this).data('function');
        if(functions =='switch-table'){
       if(status=="show"){
            $('#'+type).hide();
            $('#'+type).data('status','hide');
       }else{
        $('#'+type).show();
        $('#'+type).data('status','show');
       }
   }else{
    return false;
   }
    });

    //组织管理下添加职位及公告
    $('#add_job,#add_gonggao').click(function(){
        var type=$(this).data('type');
        var name=$('input[name="'+type+'_name"]').val();
        var desc=tinyMCE.activeEditor.getContent();
        if(name !='' && desc !=''){
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
         $.ajax({
                        url: '/api/userManages/'+type+'/add',
                        type: 'POST',
                        data: type+"_name="+name+"&"+type+"_desc="+desc,
                        success: function(data) {
                                 //添加成功
                            if(data.status){
                            layer.alert(data.msg, {
                                  icon: 1,
                                  skin: 'layer-ext-moon' 
                                },function(){
                                      window.location.href=data.result_url;
                                });
                            }else{
                               layer.alert(data.msg, {
                                  icon: 2,
                                  skin: 'layer-ext-moon' 
                                });
                            }
                        }
                    });
     }else{
           layer.alert('请输入完整参数', {
                                  icon: 2,
                                  skin: 'layer-ext-moon' 
                                });
     }
    });




    //组织管理下删除职位及公告
    $('#del_job,#del_gonggao').click(function(){
        var type=$(this).data('type');
        console.log(type);
        var id=$(this).data('usersid');
        var that=this;
         $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
         $.ajax({
                        url: '/api/userManages/'+type+'/'+id+'/del',
                        type: 'POST',
                        success:function(data){
                                if(data.status){
                                 layer.alert(data.msg, {
                                  icon: 1,
                                  skin: 'layer-ext-moon' 
                                });
                          $(that).parent().parent().parent().remove();
                          $('#team_total').text(data.result_total);
                        }

                        }
                    });
    });

    //产品及项目下添加团队成员
    $('#add_team').click(function(){
     var type=$(this).data('type');
     var id=$(this).data(type+'id');
     var users=$('#users option:selected').val();
     var prop=$('input[name="prop"]').val();
          $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
         $.ajax({
                        url: '/api/'+type+'/'+id+'/team/add',
                        type: 'POST',
                        data: "users="+users+"&prop="+prop,
                        success: function(data) {
                            //添加成功
                            if(data.status){
                            layer.alert(data.msg, {
                                  icon: 1,
                                  skin: 'layer-ext-moon' 
                                },function(){
                                      window.location.href=data.result_url;
                                });
                          
                            //添加失败
                            }else{
                               layer.alert(data.msg, {
                                  icon: 2,
                                  skin: 'layer-ext-moon' 
                                });
                            }
                        }
                    });

    });

    //产品及项目下删除团队成员
    $('.js-team-single').click(function(){
        var type=$(this).data('type');

        var id=$(this).data(type+'id');
        var users_id=$(this).data('usersid');
        var that=this;
         $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
         $.ajax({
                    url: '/api/'+type+'/'+id+'/team/del',
                    type: 'POST',
                    data: "users_id="+users_id,
                    success: function(data) {
                        if(data.status){
                                 layer.alert(data.msg, {
                                  icon: 1,
                                  skin: 'layer-ext-moon' 
                                });
                          $(that).parent().parent().remove();
                          $('#team_total').text(data.result_total);
                        }
                    }
                });
    });

    //产品转化为项目
    $('#productToProject').click(function(){
    var products_id=$(this).data('productid');

        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
         $.ajax({
                    url: '/product_to_project',
                    type: 'POST',
                    data: "products_id="+products_id,
                    success: function(data) {
                           if(data.status){
                                       layer.alert('转换项目成功!', {
                                  icon: 1,
                                  skin: 'layer-ext-moon' 
                                }, function(){
                                   window.location.reload();
                                });
                           }
                    }
                });

    });

//快速切换项目状态
$('.btn').click(function(){
    var id=$(this).data('id');
    var status=$(this).data('status');
    if(id !=undefined && status !=undefined){
         $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
         $.ajax({
                        url: '/update_project_state',
                        type: 'POST',
                        data: "project_id="+id+"&status="+status,
                        success: function(data) {
                            if(data.status){
                                  layer.alert(data.msg, {
                          icon: 1,
                          skin: 'layer-ext-moon' 
                        });
                                window.location.reload();
                            }
                        }
                    });
    }

});

//添加公告评论
$('#gonggao_comment_add').click(function(){
    var gonggao_id=$(this).data('id');
    var content=$('#content').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                        url: '/api/add_gonggao_comment/'+gonggao_id,
                        type: 'POST',
                        data: "content="+content,
                        success:function(data){
                            if(data.status){
                                var imgurl=data.result.userinfo.head_img.replace(' ','/');
                                var created_at=data.result.created_at.date.substring(0,data.result.created_at.date.length-7);
                                $('.activity-list').append('<li><div class="avatar"><a href="javascript:;"><img src="'+imgurl+'" /></a></div><div class="activity-desk"><h5><a href="javascript:;">'+data.result.userinfo.name+':</a><span>'+content+'</span></h5><p class="text-muted">'+created_at+'</p></div></li>');
                                $('#comment_gonggao_total').text(data.result.comment_count);
                            layer.alert(data.msg, {
                              icon: 1,
                              skin: 'layer-ext-moon' 
                            });
                            }
                        }
                    });
});

//公告点赞
$('#dianzan_gonggao').click(function(){
    var id=$(this).data('id');
 $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    $.ajax({
                        url: '/api/gonggao/dianzan/'+id,
                        type: 'POST',
                        success:function(data){
                            if(data.status){
                                $('#dianzan_gonggao_total').text(data.msg);
                            }
                        }
                    });
});

//修改职位
$('.edit_job').click(function(){
    var id=$(this).data('id');
    var name=$(this).data('name');
    var desc=$(this).data('desc');
   layer.open({
        type: 1,
        closeBtn: false,
        shift: 7,
        shadeClose: true,
        content: "<div style='width:350px;'><div style='width:320px;margin-left: 3%;' class='form-group has-feedback'><p>请输入新职位名</p><input  class='form-control' type='text'  name='job_name' value='"+name+"'/></div>" +
        "<div style='width:320px;margin-left: 3%;' class='form-group has-feedback'><p>请输入新描述</p><input class='form-control' type='text' name='job_desc' value='"+desc+"' /></div>"+
        "<button style='margin-top:5%;width:80%;margin:0 auto;margin-bottom:5%;' type='button' class='btn btn-block btn-primary btn-lg' onclick='updateJob("+id+")'>修改</button></div>"
    });
});

//产品中修改团队成员
$('.edit_team_product').click(function(){
    var id=$(this).data('id');
    var name=$(this).data('name');
    var prop=$(this).data('prop');
     $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
     $.ajax({
                    url: '/api/userAll',
                    type: 'POST',
                    success: function(data) {
            var status=data.status;
            var userinfo=data.msg;
            if(status){
                var html='';
                for(var i=0;i<userinfo.length;i++){
                    if(name==userinfo[i].name){
                    html +='<option class="form-control" value='+userinfo[i].id+' selected>'+userinfo[i].name+'</option>';
                }else{
        html +='<option class="form-control" value='+userinfo[i].id+'>'+userinfo[i].name+'</option>';

                }
            }
   layer.open({
        type: 1,
        closeBtn: false,
        shift: 7,
        shadeClose: true,
        content: "<div style='width:350px;'><div style='width:320px;margin-left: 3%;' class='form-group has-feedback'><p>当前团队成员</p><select class='form-control has-feedback'  name='name' disabled='disabled'>"+html+"</select></div>" +
        "<div style='width:320px;margin-left: 3%;' class='form-group has-feedback'><p>请输入新比例</p><input  class='form-control' type='number' name='prop' value='"+prop+"' /></div>"+
        "<button style='margin-top:5%;width:80%;margin:0 auto;margin-bottom:5%;' type='button' class='btn btn-block btn-primary btn-lg' onclick='updateTeamProduct("+id+")'>修改</button></div>"
    });
           }
        }
    });
});



//项目中修改团队成员
$('.edit_team_project').click(function(){
    var id=$(this).data('id');
    var name=$(this).data('name');
    var prop=$(this).data('prop');
     $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
     $.ajax({
                    url: '/api/userAll',
                    type: 'POST',
                    success: function(data) {
            var status=data.status;
            var userinfo=data.msg;
            if(status){
                var html='';
                for(var i=0;i<userinfo.length;i++){
                    if(name==userinfo[i].name){
                    html +='<option class="form-control" value='+userinfo[i].id+' selected>'+userinfo[i].name+'</option>';
                }else{
        html +='<option class="form-control" value='+userinfo[i].id+'>'+userinfo[i].name+'</option>';

                }
            }
   layer.open({
        type: 1,
        closeBtn: false,
        shift: 7,
        shadeClose: true,
        content: "<div style='width:350px;'><div style='width:320px;margin-left: 3%;' class='form-group has-feedback'><p>当前团队成员</p><select class='form-control has-feedback'  name='name' disabled='disabled'>"+html+"</select></div>" +
        "<div style='width:320px;margin-left: 3%;' class='form-group has-feedback'><p>请输入新比例</p><input  class='form-control' type='number' name='prop' value='"+prop+"' /></div>"+
        "<button style='margin-top:5%;width:80%;margin:0 auto;margin-bottom:5%;' type='button' class='btn btn-block btn-primary btn-lg' onclick='updateTeamProject("+id+")'>修改</button></div>"
    });
           }
        }
    });
});



//产品中修改团队成员交互
function updateTeamProduct(id){
var users_id=$('select[name="name"]').val();
var prop=$('input[name="prop"]').val();
 $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    $.ajax({
                        url: '/api/products/'+id+'/team/edit',
                        type: 'POST',
                        data:'users_id='+users_id+'&prop='+prop,
                        success:function(data){
                            if(data.status){
                                 layer.alert(data.msg, {
                              icon: 1,
                              skin: 'layer-ext-moon' 
                            });
                            window.location.reload();
                            }else{
                                  layer.alert(data.msg, {
                              icon: 2,
                              skin: 'layer-ext-moon' 
                            });
                            }
                        }
                    });
}

//项目中修改团队成员交互
function updateTeamProject(id){
var users_id=$('select[name="name"]').val();
var prop=$('input[name="prop"]').val();
 $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
 $.ajax({
                        url: '/api/projects/'+id+'/team/edit',
                        type: 'POST',
                        data:'users_id='+users_id+'&prop='+prop,
                        success:function(data){
                            if(data.status){
                                 layer.alert(data.msg, {
                              icon: 1,
                              skin: 'layer-ext-moon' 
                            });
                            window.location.reload();
                            }else{
                                  layer.alert(data.msg, {
                              icon: 2,
                              skin: 'layer-ext-moon' 
                            });
                            }
                        }
                    });
}



//修改职位接口交互
function updateJob(id){
var name=$('input[name="job_name"]').val();
var desc=$('input[name="job_desc"]').val();
 $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    $.ajax({
                        url: '/api/userManages/job/'+id+'/edit',
                        type: 'POST',
                        data:'name='+name+'&desc='+desc,
                        success:function(data){
                            if(data.status){
                                 layer.alert(data.msg, {
                              icon: 1,
                              skin: 'layer-ext-moon' 
                            });
                            window.location.reload();
                            }else{
                                  layer.alert(data.msg, {
                              icon: 2,
                              skin: 'layer-ext-moon' 
                            });
                            }
                        }
                    });
}

    </script>
    @yield('scripts')

</body>
</html>