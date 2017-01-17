@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Cadastrar Role</div>

                    <div class="panel-body">
                        {!! Form::open(['route' => 'admin.role.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}

                        @include('admin.role._form')

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection