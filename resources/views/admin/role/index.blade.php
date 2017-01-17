@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Roles</div>

                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th width="20%">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{$role->name}}</td>
                                    <td>{{$role->description}}</td>
                                    <td>
                                        {!! link_to_route('admin.role.edit',
                                        $title = 'Editar',
                                        ['id' => $role->id],
                                        ['class' => 'btn btn-sm btn-link']) !!}

                                        {!! link_to_route('admin.role.destroy',
                                        $title = 'Excluir',
                                        ['id' => $role->id],
                                        ['class' => 'btn btn-sm btn-link']) !!}
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
    </div>
@endsection