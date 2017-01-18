@extends('layouts.app')

@section('content')

    <div class="container">
        <h2>Managing Groups for the User: {{$user->name}}</h2>


            {!! Form::open(['route'=>['admin.users.groups.store', $user->id]]) !!}
            <select name="group_id" class="form-control">
                @foreach($groups as $group)
                    @if(!$user->hasGroup($group->name))
                        <option value="{{$group->id}}">{{$group->name}}</option>
                    @endif
                @endforeach
            </select>
            <br>
            {!! Form::submit('Add Group', ['class'=>'btn btn-primary']) !!}

            {!! Form::close() !!}

        <br>

        <h3>Listing Groups:</h3>
        <table class="table table-bordered">
            <thead>
            <th>Group</th>
                <th>Action</th>
            </thead>
            <tbody>
            @foreach($user->groups as $group)
                <tr>
                    <td>{{$group->name}}</td>

                        <td>
                            <a href="{{route('admin.users.groups.unsubscribe',['id'=>$user->id, 'group_id'=>$group->id])}}"
                               class="btn btn-danger">
                                Unsubscribe
                            </a>
                        </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <a href="{{route('admin.users.index')}}">Back</a>

    </div>

@endsection