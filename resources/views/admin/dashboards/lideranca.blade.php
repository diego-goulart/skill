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
                                    <th>%</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">{{ config('app.meta_monitoria') * (diasUteis() -1) }}</td>
                                        <td class="text-center">
                                            {{ config('app.meta_monitoria') * (diasUteis(true) -1) }}
                                        </td>
                                        <td class="text-center">
                                            {{auth()->user()->reports()->count()}}
                                        </td>
                                        <td class="text-center">
                                            @if(auth()->user()->reports()->count() > 0)
                                                ({{ toPercentual ( (auth()->user()->reports()->count()) / ( config('app.meta_monitoria')  * (diasUteis(true) -1)) )}})
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>


                            <div class="clearfix"></div>

                            <h3>Resumo dos operadores</h3>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Operador</th>
                                    <th>Média</th>
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
                                            <a href="{{route('admin.lider.operador',['id' => $operador->id])}}" class="btn btn-link">{{$operador->name}}</a>
                                        </td>
                                        <td>
                                            {{ number($operador->reportsAboutMe()->avg('total'), 0) }}
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
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
