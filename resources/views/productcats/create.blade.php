@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            添加产品分类
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'productcats.store']) !!}

                        @include('productcats.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
