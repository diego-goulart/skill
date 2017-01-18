@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="panel panel-default">


                <div class="panel-body">
                    <h3 class="pull-left">Permissões</h3>
                    <a href="{{route('admin.permissions.create')}}"
                       class="btn btn-sm btn-primary pull-right">
                        Novo</a>
                    <div class="clearfix"></div>
                    <hr>
                    <table class="table table-bordered">
                        <thead>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Action</th>
                        </thead>
                        <tbody>
                        @foreach($permissions as $permission)
                            <tr>
                                <td>{{$permission->name}}</td>
                                <td>{{$permission->description}}</td>
                                <td>

                                    <a href="{{route('admin.permissions.edit',['id'=>$permission->id])}}"
                                       class="btn btn-default">
                                        Edit
                                    </a>

                                    <a href="{{route('admin.permissions.destroy',['id'=>$permission->id])}}"
                                       class="btn btn-danger">
                                        Destroy
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$permissions->links()}}
                </div>
            </div>
        </div>

    </div>

@endsection