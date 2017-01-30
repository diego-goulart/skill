@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
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
                                        <tr>
                                            <td>
                                                {{$report->created_at->format('Y-m-d H:i')}}&nbsp;
                                            </td>
                                            <td class="text-center">
                                                {{ number($report->total, 0) }}
                                            </td>
                                            <td class="text-center"></td>
                                            <td class="text-right">
                                                <a href="{{route('admin.operador.reports.view',['id' => $report->id])}}" class="btn btn-sm btn-info">Ver</a>

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
