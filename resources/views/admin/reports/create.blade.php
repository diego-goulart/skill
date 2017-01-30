@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Monitoria do Operador - {{$operador->name}}</div>
                    <div class="panel-body">
                        {!! Form::open(['route' => 'admin.reports.store', 'method' => 'post', 'class'=> 'form-horizontal']) !!}
                        {!! Form::hidden('operador_id', $operador->id) !!}
                            @include('admin.reports._form')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
