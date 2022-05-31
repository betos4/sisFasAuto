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
    <h1 class="h3 mb-2 text-gray-800">Estado Civiles</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">

            <a class="btn btn-primary" href="{{route('estadoCiviles.create')}}" title="Crear" role="button"><i class="fas fa-file" aria-hidden="true"></i> Crear</a>
            <hr>
            
            <table class="table table-bordered table-striped dt-responsive" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($estadoCiviles as $estadoCivil)
                    <tr>
                        <td>{{$estadoCivil->nombre}}</td>
                        <td>
                        @if($estadoCivil->estado_activo)
                            <button class="btn btn-success btn-sm">Activado</button>
                        @else
                            <button class="btn btn-danger btn-sm">Desactivado</button>
                        @endif
                        </td>
                        <td>
                            <a href="{{route('estadoCiviles.edit', ['estadoCivil' => $estadoCivil->id])}}" class="btn btn-warning btn-sm" role="button" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                            
                            <form method="POST" class="d-inline" action="{{ route('estadoCiviles.destroy', ['estadoCivil' => $estadoCivil->id]) }}">
                                @csrf    
                                @method('DELETE')
                                @if($estadoCivil->estado_activo)
                                    <button type="submit" class="btn btn-danger btn-sm" title="Desactivar"><i class="fas fa-trash"></i></button>
                                @else
                                    <button type="submit" class="btn btn-success btn-sm" title="Activar"><i class="fas fa-check"></i></button>
                                @endif
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
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
	<script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
@endpush