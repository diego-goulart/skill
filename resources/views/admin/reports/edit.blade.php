@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar Monitoria de: {{$operador->name}}</div>
                    <div class="panel-body">
                        {!! Form::model( $report,['route' => ['admin.reports.update', $report->id],
                        'method' => 'PUT', 'class'=> 'form-horizontal']) !!}
                            @include('admin.reports._form')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
