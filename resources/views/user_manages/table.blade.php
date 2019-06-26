<table class="table table-responsive" id="userManages-table">
    <thead>
        <th>用户名</th>
        <th>邮箱</th>
        <th>是否授权为管理员</th>
        <th>职位类型</th>
       <!--  <th>基本工资</th> -->
     <!--    <th>当月项目奖金</th> -->
        <th>创建时间</th>
        <th>修改时间</th>
        <th colspan="3">操作</th>
    </thead>

    <tbody>
    @foreach($userManages as $userManage)
        <tr>
            <td>{!! $userManage->name !!}</td>
            <td>{!! $userManage->email !!}</td>
            <td>{!! $userManage->is_admin=='是'?'是':'否' !!}</td>
            <td>{!! $userManage->type !!}</td>
          <!--   <td>{!! $userManage->wages !!} </td> -->
           <!--  <td>{!! $userManage->projectprice !!}</td> -->
            <td> {!! $userManage->created_at !!}</td>
            <td> {!! $userManage->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['userManages.destroy', $userManage->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('users.info', [$userManage->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('userManages.edit', [$userManage->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确定删除此用户吗?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
    
</table>