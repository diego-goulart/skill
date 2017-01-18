@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">
            <div class="panel panel-default">


                <div class="panel-body">
                    <h3 class="pull-left">Editando permissão: {{$permission->name}}</h3>
                    <div class="clearfix"></div>
                    <hr>
                    {!! Form::model($permission, ['route'=>['admin.permissions.update', $permission->id], 'method'=>'put']) !!}

                    @include('admin.permissions._form')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>

@endsection