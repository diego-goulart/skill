@extends('layouts.app')

@section('content')

    <div class="container">
        <h2>Groups</h2>

        <a href="{{route('admin.groups.create')}}">Create</a>

        <br>
        <br>

        <table class="table table-bordered">
            <thead>
            <th>Nome</th>
            <th>Ações</th>
            </thead>
            <tbody>
            @foreach($groups as $group)
                <tr>
                    <td>{{$group->name}}</td>
                    <td>
                        <a href="{{route('admin.groups.edit',['id'=>$group->id])}}" class="btn btn-link">
                            Editar
                        </a>
                        <a href="{{route('admin.groups.destroy',['id'=>$group->id])}}" class="btn btn-link">
                            Excluir
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection