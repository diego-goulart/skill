@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">
            <div class="panel panel-default">


                <div class="panel-body">
                    <h3 class="pull-left">Criar nova permissão</h3>
                    <div class="clearfix"></div>
                    <hr>
                    {!! Form::open(['route'=>'admin.permissions.store']) !!}

                    @include('admin.permissions._form')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>

@endsection