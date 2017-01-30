@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">


                <div class="panel-body">
                    <h3 class="pull-left">Avaliações</h3>
                    <a href="{{route('admin.questions.create')}}"
                       class="btn btn-sm btn-primary pull-right">
                        Novo</a>

                    <div class="clearfix"></div>
                    <hr>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Valor</th>
                            <th width="30%">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($questions as $question)
                            <tr>
                                <td>{{$question->subject}}</td>
                                <td>{{$question->description}}</td>
                                <td>{{$question->value}}</td>
                                <td>
                                    {!! link_to_route('admin.questions.edit',
                                    $title = 'Editar',
                                    ['id' => $question->id],
                                    ['class' => 'btn btn-sm btn-default']) !!}



                                    {!! link_to_route('admin.questions.destroy',
                                    $title = 'Excluir',
                                    ['id' => $question->id],
                                    ['class' => 'btn btn-sm btn-danger']) !!}


                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="">
                                <td colspan="2" class="text-right text-uppercase"><strong>Total</strong></td>
                                <td colspan="2"><strong>{{$questions->sum('value')}}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                    {{$questions->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection