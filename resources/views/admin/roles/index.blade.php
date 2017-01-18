@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">


                <div class="panel-body">
                    <h3 class="pull-left">Roles</h3>
                    <a href="{{route('admin.roles.create')}}"
                       class="btn btn-sm btn-primary pull-right">
                        Novo</a>

                    <div class="clearfix"></div>
                    <hr>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th width="30%">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>{{$role->name}}</td>
                                <td>{{$role->description}}</td>
                                <td>
                                    {!! link_to_route('admin.roles.edit',
                                    $title = 'Editar',
                                    ['id' => $role->id],
                                    ['class' => 'btn btn-sm btn-default']) !!}

                                    <a href="{{route('admin.roles.permissions',['id'=>$role->id])}}"
                                       class="btn btn-sm btn-default">
                                        Permissões
                                    </a>

                                    {!! link_to_route('admin.roles.destroy',
                                    $title = 'Excluir',
                                    ['id' => $role->id],
                                    ['class' => 'btn btn-sm btn-danger']) !!}


                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$roles->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection