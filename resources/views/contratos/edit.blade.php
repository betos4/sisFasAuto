@extends('layouts.app')

@push('css')
    <!-- Custom styles for this page -->
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
	<link href="{{ asset('vendor/datatables/responsive.bootstrap.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Datos del contrato</h1>

    <form action="{{route('contratos.update', ['contrato' => $contrato->id])}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card p-3 mb-4">
            <div class="row">
                <div class="col-12">
                    <h4>
                        <i class="fas fa-file-contract"></i> Información contrato
                    </h4>
                </div>
            </div>
            <hr/>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="numcontrato">Número de contrato</label>
                            <input type="text" class="form-control @error('numcontrato') is-invalid @enderror" id="numcontrato" name="numcontrato" placeholder="Número contrato" required="required" value="{{old('numcontrato') ?? $contrato->numcontrato}}">
                        @error('numcontrato')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tipocontrato">Tipo contrato</label>
                            <input type="text" class="form-control @error('tipocontrato') is-invalid @enderror" id="tipocontrato" name="tipocontrato" placeholder="Tipo contrato" required="required" value="{{old('tipocontrato') ?? $contrato->tipocontrato}}">
                        @error('tipocontrato')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="valorgarantia">Valor garantía</label>
                            <input type="text" class="form-control @error('valorgarantia') is-invalid @enderror" id="valorgarantia" name="valorgarantia" placeholder="Valor garantía" required="required" value="{{old('valorgarantia') ?? round($contrato->valorgarantia, 2)}}">
                        @error('valorgarantia')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="fechainicio" class="col-md-6">Fecha inicio</label>
                        <input id="fechainicio" type="date" class="form-control @error('fechainicio') is-invalid @enderror" name="fechainicio" value="{{$contrato->fechainicio}}">
                        @error('fechainicio')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="fechafin" class="col-md-6">Fecha fin</label>
                        <input id="fechafin" type="date" class="form-control @error('fechafin') is-invalid @enderror" name="fechafin" value="{{$contrato->fechafin}}">
                        @error('fechafin')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>

            <hr>
                
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="pathidentificacion">Adjuntar indentificación</label>
                @if($contrato->pathidentificacion != '')
                    <a href="/{{$contrato->pathidentificacion}}" class="btn btn-info btn-circle btn-sm" target="_black">
                        <i class="fas fa-download"></i>
                    </a>
                @endif
                    <input type="file" class="form-control @error('pathidentificacion') is-invalid @enderror" id="pathidentificacion" name="pathidentificacion" value="{{old('pathidentificacion')}}">
                    @error('pathidentificacion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="pathplanilla">Adjuntar planilla</label>
                @if($contrato->pathplanilla != '')
                    <a href="/{{$contrato->pathplanilla}}" class="btn btn-info btn-circle btn-sm" target="_black">
                        <i class="fas fa-download"></i>
                    </a>
                @endif
                    <input type="file" class="form-control @error('pathplanilla') is-invalid @enderror" id="pathplanilla" name="pathplanilla" value="{{old('pathplanilla')}}">
                    @error('pathplanilla')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="pathfacturavehiculo">Adjuntar factura vehículo</label>
                @if($contrato->pathfacturavehiculo != '')
                    <a href="/{{$contrato->pathfacturavehiculo}}" class="btn btn-info btn-circle btn-sm" target="_black">
                        <i class="fas fa-download"></i>
                    </a>
                @endif
                    <input type="file" class="form-control @error('pathfacturavehiculo') is-invalid @enderror" id="pathfacturavehiculo" name="pathfacturavehiculo" value="{{old('pathfacturavehiculo')}}">
                    @error('pathfacturavehiculo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-4">
                    <label for="pathtablaamortizacion">Adjuntar tabla amortización</label>
                @if($contrato->pathtablaamortizacion != '')
                    <a href="/{{$contrato->pathtablaamortizacion}}" class="btn btn-info btn-circle btn-sm" target="_black">
                        <i class="fas fa-download"></i>
                    </a>
                @endif
                    <input type="file" class="form-control @error('pathtablaamortizacion') is-invalid @enderror" id="pathtablaamortizacion" name="pathtablaamortizacion" value="{{old('pathtablaamortizacion')}}">
                    @error('pathtablaamortizacion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="pathpagare">Adjuntar pagaré</label>
                @if($contrato->pathpagare != '')
                    <a href="/{{$contrato->pathpagare}}" class="btn btn-info btn-circle btn-sm" target="_black">
                        <i class="fas fa-download"></i>
                    </a>
                @endif
                    <input type="file" class="form-control @error('pathpagare') is-invalid @enderror" id="pathpagare" name="pathpagare" value="{{old('pathpagare')}}">
                    @error('pathpagare')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
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
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="rut">Identificación</label>
                        <input type="text" class="form-control" id="rut" name="rut" placeholder="Identificación" disabled value="{{$cliente->rut}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" disabled value="{{$cliente->nombre}}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" required value="{{old('email') ?? $cliente->email}}">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" placeholder="Teléfono" required value="{{old('telefono') ?? $cliente->telefono}}">
                    @error('telefono')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="celular">Celular</label>
                        <input type="text" class="form-control @error('celular') is-invalid @enderror" id="celular" name="celular" placeholder="Celular" required value="{{old('celular') ?? $cliente->celular}}">
                        <input type="hidden" name="estado_activo" value="{{$cliente->estado_activo}}"/>
                        <input type="hidden" name="creditoid" value="{{$credito->id}}"/>
                        <input type="hidden" name="clienteid" value="{{$cliente->id}}"/>
                    @error('celular')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="estado_civil">Estado civil</label>
                        <select class="form-control @error('estado_civil') is-invalid @enderror" id="estado_civil" name="estado_civil">
                            <option value="">SELECCIONE</option>
                        @foreach($estadoCiviles as $estadoCivil)
                            <option value="{{ $estadoCivil->id}}" {{  $cliente->estadocivilid == $estadoCivil->id ? 'selected' : '' }}>
                                {{ $estadoCivil->nombre }}
                            </option>
                        @endforeach
                        </select>
                    @error('estado_civil')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <!-- Custom Tabs -->
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs mt-3 mb-3">
                            <li class="nav-item"><a href="#tab_1" class="nav-link active"
                                    data-toggle="tab">Info direcciones</a></li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <div class="row">
                                    <div class="col-12">
                                        <table class="table table-bordered table-striped dt-responsive" id="dataTable" width="100%"
                                            cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Dirección</th>
                                                    <th>Sector</th>
                                                    <th>Tipo</th>
                                                    <th>Provincia</th>
                                                    <th>Canton</th>
                                                    <th>Estado</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($direcciones as $direccion)
                                                <tr>
                                                    <td>{{$direccion->direccion}}</td>
                                                    <td>{{$direccion->sector}}</td>
                                                    <td>{{$direccion->tipodireccion}}</td>
                                                    <td>{{$direccion->provincia}}</td>
                                                    <td>{{$direccion->canton}}</td>
                                                @if($direccion->estado_activo)
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
                    <b>Monto total: </b><span>{{round($credito->montototal, 2)}}</span>
                </div>
                <div class="col-sm-4">
                    <b>Fecha otorgamiento: </b><span>{{date('Y-m-d', strtotime($credito->fechaotorgamiento))}}</span><br>
                    <b>Saldo insoluto: </b><span>{{round($credito->saldoinsoluto, 2)}}</span>
                </div>
                <div class="col-sm-4">
                    <b>Fecha vencimiento: </b><span>{{date('Y-m-d', strtotime($credito->fechavencimiento))}}</span><br>
                    <b>Valor cuota: </b><span>{{round($credito->valorcuota, 2)}}</span>
                </div>
            </div>  
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <!-- Custom Tabs -->
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs mt-3 mb-3">
                            <li class="nav-item"><a href="#tab_11" class="nav-link active"
                                data-toggle="tab">Info vehículo</a></li>
                            <li class="nav-item"><a href="#tab_21" class="nav-link"
                                data-toggle="tab">Info dispositivos</a></li>
                            <li class="nav-item"><a href="#tab_31" class="nav-link"
                                data-toggle="tab">Info seguros</a></li>
                        </ul>
    
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_11">
                                <div class="row">
                                    <div class="col-12">
                                        <table class="table table-bordered table-striped dt-responsive" id="dataTable" width="100%"
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
                            <div class="tab-pane" id="tab_21">
                                <div class="row">
                                    <div class="col-12">
                                        <table class="table table-bordered table-striped dt-responsive" id="dataTable2" width="100%"
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
                            <div class="tab-pane" id="tab_31">
                                <div class="row">
                                    <div class="col-12">
                                        <table class="table table-bordered table-striped dt-responsive" id="dataTable3" width="100%"
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
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{route('contratos.index')}}" class="btn btn-danger">Cancelar</a>      
            </div>
        </div> 
    </form>
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