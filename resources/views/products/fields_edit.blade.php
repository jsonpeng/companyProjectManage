  <!-- Name Field -->
  <div class="form-group col-sm-8">
       {!! Form::text('id', null,['style'=>'display:none;','id'=>'products_id']) !!}
      {!! Form::label('name', '产品名称:') !!}
      {!! Form::text('name', null, ['class' => 'form-control']) !!}
  </div>


   <div class="form-group col-sm-8 ">
      {!! Form::label('cats', '所在分类:') !!}

      @if(count($cats)==0)
   
         <a href="{!! route('productcats.create') !!}" class="btn btn-primary">创建分类</a>
      @else
      <select class="form-control col-sm-8" id="cats" name="cats[]">
             @foreach($cats as $cat)
                    <option value="{!! $cat->id !!}"  @if($cat->id==$selectedcats[0]) selected @endif>{!! $cat->name !!}</option>
             @endforeach
      </select>   
      @endif
   
    
   </div>

  <!-- Des Field -->
  <div class="form-group col-sm-8">
      {!! Form::label('des', '产品描述:') !!}
      {!! Form::textarea('des', null, ['class' => 'form-control intro','id'=>'des']) !!}
  </div>


  <!-- Submit Field -->
  <div class="form-group col-sm-12">
      {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}

      <a href="{!! route('products.index') !!}" class="btn btn-default">返回</a>
  </div>
