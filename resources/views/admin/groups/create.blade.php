@extends('layouts.app')

@section('content')

    <div class="container">
        <h2>Create new Group</h2>

        {!! Form::open(['route'=>'admin.groups.store']) !!}

        @include('admin.groups._form')


        {!! Form::close() !!}




    </div>

@endsection