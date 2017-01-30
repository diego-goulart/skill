@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar Avaliação</div>

                    <div class="panel-body">
                        {!! Form::model($question, ['route' => ['admin.questions.update', $question->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}

                        @include('admin.questions._form')

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection