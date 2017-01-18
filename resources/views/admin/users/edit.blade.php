@extends('layouts.app')

@section('content')

    <div class="container">
        <h2>Editing user: {{$user->name}}</h2>

        {!! Form::model($user, ['route'=>['admin.users.update', $user->id], 'method'=>'put']) !!}

        @include('admin.users._form')


        {!! Form::close() !!}




    </div>

@endsection