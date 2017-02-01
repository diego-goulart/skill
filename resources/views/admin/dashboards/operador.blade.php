@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Dashboard
                        <a href="{{route('admin.lider')}}" class="btn btn-default pull-right">Voltar</a>
                        <div class="clearfix"></div>
                    </div>

                    <div class="panel-body">

                        <div class="col col-sm-12">
                            <h3 class="text-uppercase">{{$operador->name}} - {{number($reports->avg('total'), 0)}}</h3>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Data</th>
                                    <th class="text-center">Nota</th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>

                                    @foreach($reports as $report)
                                        <tr class="{{$report->total <= 0 ? 'danger text-danger': ''}}">
                                            <td>
                                                {{$report->created_at->format('Y-m-d H:i')}}&nbsp;
                                            </td>
                                            <td class="text-center">
                                                @if($report->total <= 0)
                                                    <span class="text-danger text-uppercase">ERRO FATAL</span>
                                                    @else
                                                {{ number($report->total, 0) }}
                                                    @endif
                                            </td>
                                            <td class="text-center"></td>
                                            <td class="text-right">
                                                <a href="{{route('admin.reports.view',['id' => $report->id])}}" class="btn btn-sm btn-info">Ver</a>
                                                @if($report->owner_signature == false || $report->operador_signature == false)
                                                    {!! link_to_route('admin.lider.reports.edit',
                                                                $title = 'Editar',
                                                                $parameters = ['id' => $report->id ],
                                                                $attributes = ['class'=>"btn btn-sm btn-default"]) !!}

                                                    {!! link_to_route('admin.lider.reports.delete',
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
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
