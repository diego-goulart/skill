@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Monitorias
                    </div>
                    <div class="panel-body">
                        <table class="table table-condensed table-bordered">
                            <thead>
                            <tr>
                                <th>Data</th>
                                <th>Avaliador</th>
                                <th>Atendente</th>
                                <th>Nota</th>
                                <th>Assinaturas</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reports as $report)
                                <tr>
                                    <td>{{$report->created_at}}</td>
                                    <td>{{$report->owner->name}}</td>
                                    <td>{{$report->operador->name}}</td>
                                    <td>{{$report->total}}</td>
                                    <td><b>Lider:</b>
                                        @if($report->owner_signature == 1)
                                        <span class='text-success'><b>Sim</b></span>
                                        @else
                                         <span class='text-danger'><b>N&atilde;o</b></span>
                                        @endif
                                        <b>Operador:</b>
                                        @if($report->operador_signature == 1)
                                            <span class='text-success'><b>Sim</b></span>
                                        @else
                                            <span class='text-danger'><b>N&atilde;o</b></span>
                                        @endif

                                    <td>
                                        @can('report_manager', $report)
                                            @if($report->owner_signature == false || $report->operador_signature == false)
                                                {!! link_to_route('admin.reports.edit',
                                                $title = 'Editar',
                                                $parameters = ['id' => $report->id ],
                                                $attributes = ['class'=>"btn btn-sm btn-default"]) !!}

                                                {!! link_to_route('admin.reports.destroy',
                                                $title = 'Excluir',
                                                $parameters = ['id' => $report->id ],
                                                $attributes = ['class'=>"btn btn-sm btn-danger"]) !!}
                                            @endif

                                                @if($report->owner_signature == false
                                                        && $report->owner_id === auth()->user()->id)
                                                    {!! link_to_route('admin.reports.sign',
                                                       $title = 'Assinar',
                                                       $parameters = ['id' => $report->id ],
                                                       $attributes = ['class'=>"btn btn-sm btn-success"]) !!}
                                                @endif
                                        @endcan

                                            @if($report->operador_signature == false
                                                && $report->operador_id === auth()->user()->id)
                                                {!! link_to_route('admin.reports.sign',
                                                   $title = 'Assinar',
                                                   $parameters = ['id' => $report->id ],
                                                   $attributes = ['class'=>"btn btn-sm btn-success"]) !!}
                                            @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$reports->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
