@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Usuários
                        @can('user_manager')
                            <a href="{{route('admin.users.create')}}"
                               class="btn btn-sm btn-primary pull-right">
                                 Novo</a>
                        @endcan
                    </div>

                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                            <th>Nome</th>
                            <th>Matricula</th>
                            <th>Ativo</th>
                            <th>Ações</th>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->matricula}}</td>
                                    <td>
                                        <a href="{{route('admin.users.active',['id'=>$user->id])}}"
                                           class="btn btn-link">
                                            {{$user->active == 1? 'Ativo': 'Inativo'}}
                                        </a>
                                    </td>
                                    <td>

                                        <a href="{{route('admin.users.edit',['id'=>$user->id])}}" class="btn btn-link">
                                            Editar
                                        </a>

                                        <a href="{{route('admin.users.roles',['id'=>$user->id])}}" class="btn btn-link">
                                            Permissões
                                        </a>

                                        <a href="{{route('admin.users.groups',['id'=>$user->id])}}"
                                           class="btn btn-link">
                                            Equipe
                                        </a>

                                        @can('user_admin')
                                            <a href="{{route('admin.users.destroy',['id'=>$user->id])}}"
                                               class="btn btn-link">
                                                Excluir
                                            </a>
                                        @endcan

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$users->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection