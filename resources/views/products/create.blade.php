@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            添加产品
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    <?php $products=["main_man"=>'',"whether_project"=>'create'];$products=json_decode(json_encode($products));?>
                    {!! Form::open(['route' => 'products.store']) !!}

                        @include('products.fields',['cats'=>$cats,'selectedcats'=>['0'],'selectedusers'=>[],'user'=>$user])

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@include('vendor.js')
