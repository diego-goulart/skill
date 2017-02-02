@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">

                        <div class="col col-sm-12">
                            <h3>Resumo do mês</h3>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th class="text-center">Objetivo no mês</th>
                                    <th class="text-center">Meta p/ Período</th>
                                    <th class="text-center">Realizado</th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">{{ getenv('META_MONITORIA') * (diasUteis() -1) }}</td>
                                        <td class="text-center">
                                            {{ getenv('META_MONITORIA') * (diasUteis(true) -1) }}
                                        </td>
                                        <td class="text-center">
                                            {{auth()->user()->reports()->count()}}
                                            @if(auth()->user()->reports()->count() > 0)
                                            ({{ toPercentual ( (auth()->user()->reports()->count()) / ( 2  * (diasUteis(true))) )}})
                                                @endif
                                        </td>
                                        <td class="text-center"></td>
                                    </tr>
                                </tbody>
                            </table>


                            <div class="clearfix"></div>

                            <h3>Resumo dos operadores</h3>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Operador</th>
                                    <th>Equipe</th>
                                    <th class="text-center">Monitorias</th>
                                    <th class="text-center">Ultima Monitoria</th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($operadores as $operador)
                                    <tr>
                                        <td>
                                            <a href="{{route('admin.lider.operador',['id' => $operador->id])}}" class="btn btn-link">
                                                {{$operador->name}} - {{ number($operador->reportsAboutMe()->avg('total'), 0) }}
                                            </a>
                                        </td>
                                        <td>{{$operador->groups()->first()->name}}</td>

                                        <td class="text-center">
                                            {{ $operador->reportsAboutMe()->count() }}
                                        </td>
                                        <td class="text-center">
                                            @if($operador->reportsAboutMe()->count() > 0)
                                            {{ toDate($operador->reportsAboutMe()->get()->last()->created_at) }}
                                                @endif()
                                        </td>
                                        <td class="text-center">
                                            <a href="{{route('admin.lider.reports.create',['id' => $operador->id])}}" class="btn btn-link">
                                                Nova Monitoria
                                            </a>
                                        </td>
                                    </tr>

                                @endforeach
                                </tbody>
                            </table>

                            <div class="clearfix"></div>

                            <h3>Monitorias sem feedback</h3>

                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Operador</th>
                                    <th>Equipe</th>
                                    <th class="text-center">Atraso</th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($operadores as $operador)
                                    @foreach($operador->groups as $group )
                                        @foreach($group->delayed() as $report )
                                            @if($report->atrazo >= 1)
                                                <tr>
                                                    <td>{{$operador->name}} - {{number($group->delayed()->avg('total'), 0)}}</td>
                                                    <td>{{$group->name}}</td>
                                                    <td class="text-center">{{$report->atrazo}} dia (s)</td>
                                                    <td><a href="{{route('admin.reports.view',['id' => $report->id])}}" class="btn btn-link">Ver</a></td>
                                                    <td>
                                                            @if($report->owner_signature == false || $report->operador_signature == false)
                                                                {!! link_to_route('admin.lider.reports.edit',
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


                                                        @if($report->operador_signature == false
                                                            && $report->operador_id === auth()->user()->id)
                                                            {!! link_to_route('admin.reports.sign',
                                                               $title = 'Assinar',
                                                               $parameters = ['id' => $report->id ],
                                                               $attributes = ['class'=>"btn btn-sm btn-success"]) !!}
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endif
                                        @endforeach
                                    @endforeach
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
