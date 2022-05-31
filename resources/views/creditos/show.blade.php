@extends('layouts.app')

@push('css')
    <!-- Custom styles for this page -->
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
	<link href="{{ asset('vendor/datatables/responsive.bootstrap.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <!-- Monto total -->
        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div
                                class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Monto total</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <span>{{round($credito->montototal, 2)}}</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Saldo insoluto -->
        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div
                                class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Saldo insoluto</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <span>{{round($credito->saldoinsoluto, 2)}}</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Valor cuota -->
        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div
                                class="text-xs font-weight-bold text-primary text-uppercase mb-1">Valor cuota</div>
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                <span>{{round($credito->valorcuota, 2)}}</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card p-3 mb-4">
        <div class="row">
            <div class="col-12">
                <h4>
                    <i class="fas fa-user"></i> Información cliente
                </h4>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-sm-4">
                <b>Identificación: </b><span>{{$credito->rut}}</span><br>
                <b>Teléfono: </b><span>{{$credito->telefono}}</span>
            </div>
            <div class="col-sm-4">
                <b>Nombre: </b><span>{{$credito->cliente}}</span><br>
                <b>Celular: </b><span>{{$credito->celular}}</span>
            </div>
            <div class="col-sm-4">
                <b>Email: </b><span>{{$credito->email}}</span>
            </div>
        </div>
    </div>   
    
    <div class="card p-3 mb-4">
        <div class="row">
            <div class="col-12">
                <h4>
                    <i class="fa fa-coins"></i> Información crédito
                </h4>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-sm-4">
                <b>Operación: </b><span>{{$credito->noperacion}}</span><br>
                <b>Fecha otorgamiento: </b><span>{{date('Y-m-d', strtotime($credito->fechaotorgamiento))}}</span>
            </div>
            <div class="col-sm-4">
                <b>Segmento: </b><span>{{$credito->segmento}}</span><br>
                <b>Fecha vencimiento: </b><span>{{date('Y-m-d', strtotime($credito->fechavencimiento))}}</span>
            </div>
            <div class="col-sm-4">
                <b>Estado crédito: </b><span>{{$credito->estadoCredito}}</span>
                
            </div>
        </div>  
        <hr>
        <div class="row">
            <div class="col-md-12">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs mt-3 mb-3">
                        <li class="nav-item"><a href="#tab_1" class="nav-link active"
                                data-toggle="tab">Info cuotas</a></li>
                        <li class="nav-item"><a href="#tab_2" class="nav-link"
                                data-toggle="tab">Info vehículo</a></li>
                        <li class="nav-item"><a href="#tab_3" class="nav-link"
                            data-toggle="tab">Info dispositivos</a></li>
                        <li class="nav-item"><a href="#tab_4" class="nav-link"
                            data-toggle="tab">Info seguros</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-bordered table-striped dt-responsive" id="dataTable" width="100%"
                                        cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Número cuota</th>
                                                <th>Saldo insoluto</th>
                                                <th>Valor cuota</th>
                                                <th>Fecha vencimiento</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($cuotas as $cuota)
                                            <tr>
                                                <td>{{round($cuota->numerocuota, 2)}}</td>
                                                <td>{{round($cuota->saldoinsoluto, 2)}}</td>
                                                <td>{{round($cuota->valorcuota, 2)}}</td>
                                                <td>{{date('Y-m-d', strtotime($cuota->fechavencimientocuota))}}</td>
                                                <td>{{$cuota->nombre}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>    
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_2">
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-bordered table-striped dt-responsive" id="dataTable2" width="100%"
                                        cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Marca</th>
                                                <th>Modelo</th>
                                                <th>Color</th>
                                                <th>Motor</th>
                                                <th>Chasis</th>
                                                <th>Año</th>
                                                <th>Placa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{$vehiculo->marca}}</td>
                                                <td>{{$vehiculo->modelo}}</td>
                                                <td>{{$vehiculo->color}}</td>
                                                <td>{{$vehiculo->motor}}</td>
                                                <td>{{$vehiculo->chasis}}</td>
                                                <td>{{$vehiculo->anio}}</td>
                                                <td>{{$vehiculo->placa}}</td>
                                            </tr>
                                        </tbody>
                                    </table>    
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_3">
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-bordered table-striped dt-responsive" id="dataTable3" width="100%"
                                        cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Device id</th>
                                                <th>Proveedor</th>
                                                <th>Odometro</th>
                                                <th>Fecha inicio</th>
                                                <th>Fecha fin</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($dispositivos as $dispositivo)
                                            <tr>
                                                <td>{{$dispositivo->deviceid}}</td>
                                                <td>{{$dispositivo->proveedor}}</td>
                                                <td>{{round($dispositivo->odometer, 2)}}</td>
                                                <td>{{$dispositivo->fechainicio ? date('Y-m-d', strtotime($dispositivo->fechainicio)) : ''}}</td>
                                                <td>{{$dispositivo->fechafin ? date('Y-m-d', strtotime($dispositivo->fechafin)) : ''}}</td>
                                            @if($dispositivo->estado_activo)
                                                <td>ACTIVO</td>
                                            @else
                                                <td>INACTIVO</td>
                                            @endif
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>    
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_4">
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-bordered table-striped dt-responsive" id="dataTable4" width="100%"
                                        cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Aseguradora</th>
                                                <th>Num seguro</th>
                                                <th>Fecha inicio</th>
                                                <th>Fecha fin</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($seguros as $seguro)
                                            <tr>
                                                <td>{{$seguro->nombre}}</td>
                                                <td>{{$seguro->numseguro}}</td>
                                                <td>{{$seguro->fechainicio ? date('Y-m-d', strtotime($seguro->fechainicio)) : ''}}</td>
                                                <td>{{$seguro->fechafin ? date('Y-m-d', strtotime($seguro->fechafin)) : ''}}</td>
                                            @if($seguro->estado_activo)
                                                <td>ACTIVO</td>
                                            @else
                                                <td>INACTIVO</td>
                                            @endif
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
        </div>
        <hr>
        <div class="card-body">
            <a href="{{route('creditos.index')}}" class="btn btn-danger">Cancelar</a>      
        </div>
    </div>    
</div>
<!-- /.container-fluid -->
@endsection

@push('scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('vendor/datatables/dataTables.responsive.min.js') }}"></script>
	<script src="{{ asset('vendor/datatables/responsive.bootstrap.min.js') }}"></script>

	<!-- Page level custom scripts -->
	<script src="{{ asset('js/demo/datatables-demo-with-out-filter.js') }}"></script>
@endpush