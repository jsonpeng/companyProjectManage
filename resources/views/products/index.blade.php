@extends('layouts.app')
@section('search_form')
<form class="searchform" action="" method="get">
        <select name="cats" class="form-control">
          <option value="全部" @if(array_key_exists('cats', $input)){!! $input['cats']=="全部"?'selected':'' !!}@endif>全部</option>
         @foreach($cats as $cat)
          <option value="{!! $cat->name !!}"  @if(array_key_exists('cats', $input)){!! $input['cats']==$cat->name?'selected':'' !!}@endif>{!! $cat->name !!}</option>
          @endforeach
        </select>
     
        <button type="submit" class="btn btn-primary">搜索</button>
</form>
@endsection
@section('content')
    <section class="content-header">
        <h1 class="pull-left">产品列表</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('products.create') !!}">添加产品</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('products.table')
            </div>
        </div>
           {!! $products->appends($input)->links() !!}
    </div>
@endsection

