    <!-- Name Field -->
    <div class="form-group col-sm-8">
        {!! Form::label('name', '姓名:') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
    
    <div class="form-group col-sm-8">
        {!! Form::label('head_img', '头像:') !!}
         <div class="input-append">
                        {!! Form::text('head_img', null, ['class' => 'form-control', 'id' => 'image']) !!}
                        <a data-toggle="modal" href="javascript:;" data-target="#myModal" class="btn" type="button">更改</a>
                        <img src="@if($userManage) {{$userManage->head_img}}
                        @endif" style="max-width: 100%; max-height: 28px; display: block;">
         </div>
       
    </div>

    <div class="form-group col-sm-8">
        {!! Form::label('gender', '性别:') !!}
        <label class="radio-inline">
            {!! Form::radio('gender', "男", null) !!} 男
        </label>

        <label class="radio-inline">
            {!! Form::radio('gender', "女", null) !!} 女
        </label>
    </div>

    <!-- Email Field -->
    <div class="form-group col-sm-8">
        {!! Form::label('email', '邮箱:') !!}
        {!! Form::text('email', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Password Field -->
    <div class="form-group col-sm-8">
        {!! Form::label('password', '密码:') !!}
        {!! Form::text('password', null, ['class' => 'form-control','id' => 'pwd']) !!}
    </div>

    <!-- Is Admin Field -->
    <div class="form-group col-sm-8">
        {!! Form::label('is_admin', '是否授权为管理员:') !!}
        <label class="radio-inline">
            {!! Form::radio('is_admin', "是", null) !!} 是
        </label>

        <label class="radio-inline">
            {!! Form::radio('is_admin', "否", null) !!} 否
        </label>
    </div>


   <div class="form-group col-sm-8 ">
      {!! Form::label('type', '职位类型:') !!}

      @if(count($cats)==0)
         <a href="{!! route('usermanage.job.index') !!}" class="btn btn-primary">创建职位</a>
      @else
      <select class="form-control col-sm-8"  name="type">
             @foreach($cats as $cat)
                    <option value="{!! $cat->name !!}"  @if($cat->name== $userManage->type) selected @endif>{!! $cat->name !!}</option>
             @endforeach
      </select>   
      @endif 
   </div>


   <div class="form-group col-sm-8">
    {!! Form::label('birthday', '生日:') !!}
    {!! Form::text('birthday', null, ['class' => 'form-control','id'=>'create_start']) !!}
   </div>
    

    <div class="form-group col-sm-8">
    {!! Form::label('wechat', '微信号:') !!}
    {!! Form::number('wechat', null, ['class' => 'form-control']) !!}
    </div>


    <div class="form-group col-sm-8">
    {!! Form::label('qq', 'qq号:') !!}
    {!! Form::number('qq', null, ['class' => 'form-control']) !!}
    </div>
    

     <div class="form-group col-sm-8">
    {!! Form::label('tel', '手机号:') !!}
    {!! Form::number('tel', null, ['class' => 'form-control']) !!}
    </div>


    <div class="form-group col-sm-8">
    {!! Form::label('wages', '工资:') !!}
    {!! Form::number('wages', null, ['class' => 'form-control']) !!}
    </div>


    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('userManages.index') !!}" class="btn btn-default">返回</a>
    </div>
