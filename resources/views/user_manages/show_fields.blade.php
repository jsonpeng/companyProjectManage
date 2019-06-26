<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $userManage->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', '用户名:') !!}
    <p>{!! $userManage->name !!}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', '邮箱:') !!}
    <p>{!! $userManage->email !!}</p>
</div>

<!-- Password Field -->
<div class="form-group">
    {!! Form::label('password', '密码:') !!}
    <p>{!! $userManage->password !!}</p>
</div>

<!-- Is Admin Field -->
<div class="form-group">
    {!! Form::label('is_admin', '是否授权为管理员:') !!}
    <p>{!! $userManage->is_admin !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', '创建于:') !!}
    <p>{!! $userManage->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', '更新于:') !!}
    <p>{!! $userManage->updated_at !!}</p>
</div>

