@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            创建项目
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                       <?php $project=["status"=>'挂起',];$project=json_decode(json_encode($project));?>
                    {!! Form::open(['route' => 'projects.store']) !!}

                        @include('projects.fields',['user'=>$user,'selectedusers'=>[]])

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@include('vendor.js')
