@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>Permissões para: {{$role->name}}</h2>
                </div>

                <div class="panel-body">
                    <h3>Add new permission</h3>
                    {!! Form::open(['route'=>['admin.roles.permissions.store', $role->id]]) !!}
                    <select name="permission_id" class="form-control">
                        @foreach($permissions as $permission)
                            <option value="{{$permission->id}}">{{$permission->name}}</option>
                        @endforeach
                    </select>
                    <br>
                    {!! Form::submit('Adicionar Permissão', ['class'=>'btn btn-primary']) !!}

                    {!! Form::close() !!}
                </div>
            </div>

        </div>

        <div class="row">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>Permissões para: {{$role->name}}</h2>
                </div>

                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Action</th>
                        </thead>
                        <tbody>
                        @foreach($role->permissions as $permission)
                            <tr>
                                <td>{{$permission->name}}</td>
                                <td>{{$permission->description}}</td>
                                <td>

                                    <a href="{{route('admin.roles.permissions.revoke', ['id'=>$role->id, 'permission_id'=>$permission->id])}}"
                                       class="btn btn-danger">Revogar</a>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <a href="{{route('admin.roles.index')}}" class="btn btn-default">Voltar</a>
                </div>
            </div>

        </div>
    </div>

@endsection