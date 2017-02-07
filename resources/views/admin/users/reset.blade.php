@extends('layouts.app')

@section('content')

    <div class="container">
        <h2>{{$user->name}}, para sua segurança altere sua senha.</h2>

        {!! Form::model($user, ['route'=>['admin.users.savepwd', $user->id], 'method'=>'put']) !!}
        {!! Form::hidden('confirmed', true) !!}
        @include('admin.users._form_reset')


        {!! Form::close() !!}

    </div>

@endsection