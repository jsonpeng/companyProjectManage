@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
          员工信息修改
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($userManage, ['route' => ['userManages.update', $userManage->id], 'method' => 'patch']) !!}

                        @include('user_manages.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
      @include('vendor.imagemodel')
@endsection