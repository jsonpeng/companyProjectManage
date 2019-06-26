@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            项目规则
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($projectRules, ['route' => ['projectRules.update', $projectRules->id], 'method' => 'patch']) !!}

                        @include('project_rules.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection