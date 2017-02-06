@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Dashboard
                        <a href="{{route('admin.supervisors')}}" class="btn btn-default pull-right">Voltar</a>
                        <div class="clearfix"></div>
                    </div>

                    <div class="panel-body">
                        @foreach($teams as $team)
                            <div class="col col-sm-12">
                                <h3 class="text-uppercase">{{$team->name}}</h3>
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Agente</th>
                                        <th class="text-center">Nota Média</th>
                                        <th class="text-center">Monitorias</th>
                                        <th class="text-center">Ultima Monitoria</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($team->users()->get() as $user)

                                        @if($user->isOperador())

                                            <tr>
                                                <td>
                                                    {{$user->name}}&nbsp
                                                </td>
                                                <td class="text-center">
                                                    {{ number($user->reportsAboutMe()->avg('total')) }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $user->reportsAboutMe()->count() }}
                                                </td>
                                                <td class="text-center">
                                                    @if($user->reportsAboutMe()->count() > 0)
                                                    {{ toDate($user->reportsAboutMe()->get()->last()->created_at) }}
                                                    @endif
                                                </td>
                                                <td class="text-center"></td>
                                            </tr>
                                        @endif()

                                    @endforeach
                                    </tbody>
                                </table>

                                @if($team->delayed()->count() > 0)
                                <h3>Feedback em atrazo ({{$team->delayed()->count()}})</h3>
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Equipe</th>
                                        <th>Operador</th>
                                        <th>Atrazo</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($team->delayed() as $report)
                                    <tr>
                                        <td>{{$report->owner->name}}</td>
                                        <td>{{$report->operador->name}}</td>
                                        <td>{{$report->atrazo}}</td>
                                        <td><a href="{{route('admin.reports.view',['id' => $report->id])}}" class="btn btn-link">Ver</a></td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                @endif
                            </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
