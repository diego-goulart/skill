@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">

                        <div class="col col-sm-12">
                            <h3>Resumo das equipes</h3>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Lider</th>
                                    <th class="text-center">Objetivo no mês</th>
                                    <th class="text-center">Meta p/ Período</th>
                                    <th class="text-center">Realizado</th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($lideres as $lider)
                                    <tr>
                                        <td>
                                            <a href="{{route('admin.supervisors.lider', ['id' => $lider->id])}}">
                                                {{$lider->name}}&nbsp;
                                                ({{$lider->groups()->count()}})
                                            </a>
                                        </td>
                                        <td class="text-center">{{ 2 * diasUteis() }}</td>
                                        <td class="text-center">
                                            {{ 2 * (diasUteis(true)) }}
                                        </td>
                                        <td class="text-center">
                                            {{$lider->reports()->count()}}
                                            @if($lider->reports()->count() > 0)
                                                ({{ toPercentual ( ($lider->reports()->count()) / ( 2  * (diasUteis(true))) )}})
                                            @endif

                                        </td>
                                        <td class="text-center"></td>
                                    </tr>

                                @endforeach
                                </tbody>
                            </table>

                            <div class="clearfix"></div>

                            <h3>Monitorias com feedback atrazado</h3>

                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Lider - Equipe</th>
                                        <th>Operador</th>
                                        <th class="text-center">Realização da Monitoria</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($lideres as $lider)
                                        @foreach($lider->groups as $group )
                                            @foreach($group->delayed() as $report )
                                                @if($report->atrazo > 0)
                                                <tr>
                                                    <td>{{$lider->name}} - {{$group->name}}</td>
                                                    <td>{{$report->operador->name}}</td>
                                                    <td class="text-center">{{$report->atrazo}}</td>
                                                    <td><a href="#" class="btn btn-link">Ver</a></td>
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
