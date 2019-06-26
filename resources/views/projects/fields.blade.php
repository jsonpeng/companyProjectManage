<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', '项目名称:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', '项目类型:') !!}
    {!! Form::text('type', null, ['class' => 'form-control']) !!}
</div>

<!-- Main Man Field -->
<div class="form-group col-sm-6">
    {!! Form::label('main_man', '主要负责人:') !!}
    {!! Form::text('main_man', null, ['class' => 'form-control']) !!}
</div>



<!-- Start Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('start_time', '开始时间:') !!}
    {!! Form::text('start_time', null, ['class' => 'form-control','id'=>'create_start']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('end_time', '结束时间:') !!}
    {!! Form::text('end_time', null, ['class' => 'form-control','id'=>'create_end']) !!}
</div>
<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', '状态:') !!}
  <select class="form-control col-sm-8"  name="status">
           
         <option value="挂起"  @if($project->status=='挂起') selected @endif>挂起</option>
         <option value="进行"  @if($project->status=='进行') selected @endif>进行</option>
         <option value="结束"  @if($project->status=='结束') selected @endif>结束</option>
         <option value="延期"  @if($project->status=='延期') selected @endif>延期</option>
       
      </select> 
</div>

<!-- Des Field -->
<div class="form-group col-sm-8">
    {!! Form::label('des', '项目描述(说明):') !!}
    {!! Form::textarea('des', null, ['class' => 'form-control intro']) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', '项目金额:') !!}
    {!! Form::text('price', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('projects.index') !!}" class="btn btn-default">返回</a>
</div>
