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
<!--
  <div class="form-group col-sm-12 mb0">{!! Form::label('zhipai', '指派给:') !!}</div>
    <div class="form-group " >

    @if(count($user)==0)
     <div class=" col-sm-12">
       <a href="{!! route('userManages.create') !!}" class="btn btn-primary">添加团队用户</a>
     </div>
    @endif

 <div class=" col-sm-12">
        @foreach ($user as $users)
           
                <label style="margin-right:15px;">
                    {!! Form::checkbox('users[]',$users->id, in_array($users->id, $selectedusers), ['class' => 'field minimal']) !!}
                    {!! $users->name !!}
                </label>
         
        @endforeach
 </div>
    </div>

  <div class="form-group col-sm-8">
      {!! Form::label('main_man', '产品负责人:') !!}
    <select class="form-control col-sm-8" id="main_man" name="main_man">
             @foreach($user as $users)
                    <option value="{!! $users->name !!}"  @if($users->name==$products->main_man) selected @endif>{!! $users->name !!}</option>
             @endforeach
      </select>   
  </div>-->

  <!-- Submit Field -->
  <div class="form-group col-sm-12">
      {!! Form::button('保存', ['class' => 'btn btn-primary','id'=>'save_product']) !!}
      <!--<a href="javascript:;" id="productToProject" class="btn btn-{!! $products->whether_project=='create'?'default':'success' !!}" data-status="{!! $products->whether_project !!}"> {!! $products->whether_project=='是'?'已':'' !!}转化为项目</a>-->
      <a href="{!! route('products.index') !!}" class="btn btn-default">返回</a>
  </div>
