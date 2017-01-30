@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-header">
                        <div class="col col-md-12">

                            <h3>{{$report->operador->name}} - {{$report->created_at->format('d-m-Y H:i')}} - {{number($report->total)}}</h3>
                            <a href="{{route('admin.lider')}}" class="btn btn-default pull-right">Voltar</a>
                        </div>
                       <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                            @include('admin.reports._view')
                        <div class="row">
                            <div class="col col-md-12">
                            <h4>Observações:</h4>
                            <p>{{$report->obs}}</p>
                                </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
