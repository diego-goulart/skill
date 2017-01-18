@extends('layouts.app')

@section('content')

    <div class="container">
        <h2>Create new User</h2>

        {!! Form::open(['route'=>'admin.users.store']) !!}

        @include('admin.users._form')


        {!! Form::close() !!}




    </div>

@endsection