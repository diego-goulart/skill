@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Cadastrar Avaliação</div>

                    <div class="panel-body">
                        {!! Form::open(['route' => 'admin.questions.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}

                        @include('admin.questions._form')

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection