@extends('layouts.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <!-- Monto total -->
        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div
                                class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Monto total</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <span>{{round($credito->montototal, 2)}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Saldo insoluto -->
        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div
                                class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Saldo insoluto</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <span>{{round($credito->saldoinsoluto, 2)}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Valor cuota -->
        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div
                                class="text-xs font-weight-bold text-info text-uppercase mb-1">Valor cuota</div>
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                <span>{{round($credito->valorcuota, 2)}}</span>
                            </div>
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
                <b>Identificación: </b><span>{{$credito->rut}}</span>
            </div>
            <div class="col-sm-4">
                <b>Nombre: </b><span>{{$credito->cliente}}</span>
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
                <b>Marca: </b><span>{{$credito->marca}}</span><br>
                <b>Proveedor: </b><span>{{$credito->proveedor}}</span>
            </div>
            <div class="col-sm-4">
                <b>Fecha vencimiento: </b><span>{{$credito->fechavencimiento}}</span><br>
                <b>Modelo: </b><span>{{$credito->modelo}}</span><br>
                <b>Aseguradora: </b><span>{{$credito->aseguradora}}</span>
            </div>
            <div class="col-sm-4">
                <b>Tasa interes: </b><span>{{$credito->tasainteres}}</span><br>
                <b>Tipo uso: </b><span>{{$credito->tipouso}}</span><br>
                <b>Fecha otorgamiento: </b><span>{{$credito->fechaotorgamiento}}</span>
            </div>
        </div>        
    </div>   

    <div class="card p-3 mb-4">
        <div class="row">
            <div class="col-12">
                <h4>
                    <i class="fa fa-coins"></i> Información cuotas
                </h4>
            </div>
        </div>
        <hr/>
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
                            <td>{{$cuota->fechavencimientocuota}}</td>
                            <td>{{$cuota->nombre}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>    
            </div>
        </div>  
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