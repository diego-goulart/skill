@extends('layouts.app')

@section('content')

    <div class="container">
        <h2>Editing group: {{$group->name}}</h2>

        {!! Form::model($group, ['route'=>['admin.groups.update', $group->id], 'method'=>'put']) !!}

        @include('admin.groups._form')


        {!! Form::close() !!}




    </div>

@endsection