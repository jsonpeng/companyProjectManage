@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            添加员工
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
  <?php $userManage=["type"=>'',"head_img"=>''];$userManage=json_decode(json_encode($userManage));?>
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'userManages.store']) !!}

                        @include('user_manages.fields',['userManage_id'=>null])

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
          @include('vendor.imagemodel')
@endsection
