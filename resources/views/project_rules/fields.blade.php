<!-- Basic Cost Field -->
<div class="form-group col-sm-6">
    {!! Form::label('basic_cost', '员工成本(社保等):') !!}
    {!! Form::text('basic_cost', null, ['class' => 'form-control']) !!}
</div>

<!-- First Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('first_price', '第一阶段金额限度:') !!}
    {!! Form::text('first_price', null, ['class' => 'form-control']) !!}
</div>

<!-- First Prop Field -->
<div class="form-group col-sm-6">
    {!! Form::label('first_prop', '第一阶段比例:') !!}
    {!! Form::text('first_prop', null, ['class' => 'form-control']) !!}
</div>

<!-- Second Prop Field -->
<div class="form-group col-sm-6">
    {!! Form::label('second_prop', '第二阶段比例(超过第一限度后设定的比例):') !!}
    {!! Form::text('second_prop', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('man_prop', '个人额外系数(基于工资和成本):') !!}
    {!! Form::text('man_prop', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
  <!--   <a href="{!! route('projectRules.index') !!}" class="btn btn-default">返回</a> -->
</div>
