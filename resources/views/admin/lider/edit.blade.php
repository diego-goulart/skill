@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Monitoria do Operador - {{$operador->name}}</div>
                    <div class="panel-body">
                        {!! Form::model( $report,['route' => ['admin.lider.reports.update', $report->id],
                        'method' => 'PUT', 'class'=> 'form-horizontal']) !!}
                        {!! Form::hidden('id', $operador->id) !!}
                            @include('admin.lider._form')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
