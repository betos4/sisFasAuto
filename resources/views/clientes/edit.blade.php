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
    <h1 class="h3 mb-2 text-gray-800">Datos del cliente</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{route('clientes.update', ['cliente' => $cliente->id])}}" method="POST">
                @csrf
                @method('PUT')

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
                                <li class="nav-item"><a href="#tab_2" class="nav-link"
                                        data-toggle="tab">Info referencias</a></li>
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
                                <div class="tab-pane" id="tab_2">
                                    <div class="row">
                                        <div class="col-12">
                                            <table class="table table-bordered table-striped dt-responsive" id="dataTable2" width="100%"
                                                cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>Identificación</th>
                                                        <th>Nombre</th>
                                                        <th>Email</th>
                                                        <th>Teléfono</th>
                                                        <th>Celular</th>
                                                        <th>Tipo</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($referencias as $referencia)
                                                    <tr>
                                                        <td>{{$referencia->rut}}</td>
                                                        <td>{{$referencia->nombre}}</td>
                                                        <td>{{$referencia->email}}</td>
                                                        <td>{{$referencia->telefono}}</td>
                                                        <td>{{$referencia->celular}}</td>
                                                        <td>{{$referencia->tipo}}</td>
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
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{route('clientes.index')}}" class="btn btn-danger">Cancelar</a>
            </form>
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