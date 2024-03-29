@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            编辑产品
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($products, ['route' => ['products.update', $products->id], 'method' => 'patch']) !!}

                        @include('products.fields_edit',['user'=>$user,'selectedusers'=>$selectedusers])

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
@include('vendor.js')