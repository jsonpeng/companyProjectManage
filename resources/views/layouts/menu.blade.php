@if(Auth::user()->is_admin=='是')
<li class="{{ Request::is('userManages*') ? 'active' : '' }}">
    <a href="{!! route('userManages.index') !!}"><i class="fa fa-user"></i><span>组织管理</span></a>
<li class="{{ Request::is('productcats*') || Request::is('products*') ? 'active' : '' }}">
 <a href="#"><i class="fa fa-bars"></i> <span>产品</span>
                <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
                </span>
 </a>
    <ul class="treeview-menu">
      <li class="{{ Request::is('productcats*') ? 'active' : '' }}">
         <a href="{!! route('productcats.index') !!}">产品分类管理</a>
      </li>

      <li class="{{ Request::is('products*') ? 'active' : '' }}">
            <a href="{!! route('products.index') !!}">产品管理</a>
      </li>
    </ul>
</li>
<li class="{{ Request::is('projects*') ? 'active' : '' }}">
    <a href="{!! route('projects.index') !!}"><i class="fa fa-book"></i><span>项目管理</span></a>
</li>
<li class="{{ Request::is('projectRules*') ? 'active' : '' }}">
    <a href="{!! route('projectRules.edit', [1]) !!}"><i class="fa fa-edit"></i><span>规则管理</span></a>
</li>
<li class="{{ Request::is('project_price*') ? 'active' : '' }}">
    <a href="{!! route('user.project.index') !!}"><i class="fa fa-money"></i><span>工资结算</span></a>
</li>
@else
<li class="{{ Request::is('userInfo*') && !Request::is('userInfo/edit*') ? 'active' : '' }}">
    <a href="{!! route('users.info', [Auth::user()->id]) !!}"><i class="fa fa-home"></i><span>个人中心</span></a>
</li>
<li class="{{ Request::is('userInfo/edit*') ? 'active' : '' }}">
    <a href="{!! route('users.edit', [Auth::user()->id]) !!}"><i class="fa fa-edit"></i><span>基本信息</span></a>
</li>
<?php $id=Auth::user()->id;?>
<li class="{{ Request::is($id.'/list/product*') ? 'active' : '' }}">
    <a href="{!! route('user.list.product',[$id]) !!}"><i class="fa fa-bars"></i><span>我参与的产品</span></a>
</li>
<li class="{{ Request::is($id.'/list/project*') ? 'active' : '' }}">
    <a href="{!! route('user.list.project',[$id]) !!}"><i class="fa fa-book"></i><span>我参与的项目</span></a>
</li>
@endif
