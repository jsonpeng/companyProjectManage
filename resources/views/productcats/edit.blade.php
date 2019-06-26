@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            编辑产品分类
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($productcats, ['route' => ['productcats.update', $productcats->id], 'method' => 'patch']) !!}

                        @include('productcats.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection