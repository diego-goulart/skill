@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-header">
                        <div class="col col-md-12">
                            <div class="clearfix"></div>
                            <br>
                            <a href="{{route('admin.lider')}}" class="btn btn-default pull-right">Voltar</a>
                            <div class="clearfix"></div>
                            <br>
                           <table class="table table-bordered">
                               <tbody>
                               <tr>
                                   <th width="20%">Operador</th>
                                   <td class="text-uppercase">{{$report->operador->name}}</td>
                               </tr>
                               <tr>
                                   <th width="20%">Data da Monitoria</th>
                                   <td>{{$report->created_at->format('d/m/Y H:i')}}</td>
                               </tr>
                               <tr>
                                   <th width="20%">Data da ligação</th>
                                   <td>{{date('d/m/Y H:i', strtotime($report->dt_call .' '. $report->tm_call ))}}</td>
                               </tr>
                               <tr>
                                   <th width="20%">Cliente</th>
                                   <td class="text-uppercase">{{$report->ctm_name}}</td>
                               </tr>
                               <tr>
                                   <th width="20%">Nota Final</th>
                                   <td class="text-uppercase">{{$report->total}}</td>
                               </tr>
                               </tbody>
                           </table>

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
-  - {{number($report->total)}}