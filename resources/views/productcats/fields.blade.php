<!-- Name Field -->
<div class="form-group col-sm-8">
    {!! Form::label('name', '产品分类名称:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Des Field -->
<div class="form-group col-sm-8">
    {!! Form::label('des', '产品分类描述:') !!}
    {!! Form::textarea('des', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('productcats.index') !!}" class="btn btn-default">返回</a>
</div>
