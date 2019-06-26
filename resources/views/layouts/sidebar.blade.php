<aside class="main-sidebar" id="sidebar-wrapper">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
<!--         <div class="user-panel">
            <div class="pull-left image">
                <img src="{!! Auth::user()->head_img !!}" class="img-circle"
                     alt="User Image"/>
            </div>
            <div class="pull-left info">
                @if (Auth::guest())
                <p>InfyOm</p>
                @else
                    <p>{{ Auth::user()->name}}</p>
                @endif
            
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>-->


    <div class="user-panel">
            <div class="pull-left image">
                <img src="{!! Auth::user()->head_img !!}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                @if (Auth::guest())
                <p>项目管理系统</p>
                @else
                    <p>{{ Auth::user()->name}}</p>
                @endif
                                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> 在线</a>
            </div>
        </div>





        <ul class="sidebar-menu">
            @include('layouts.menu')
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>