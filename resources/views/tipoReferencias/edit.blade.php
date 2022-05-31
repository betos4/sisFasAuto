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
    <h1 class="h3 mb-2 text-gray-800">Datos del tipo referencia</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{route('tipoReferencias.update', ['tipoReferencia' => $tipoReferencia->id])}}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="hidden" name="estado_activo" value="{{$tipoReferencia->estado_activo}}"/>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" placeholder="Tipo referencia" required value="{{old('nombre') ?? $tipoReferencia->nombre}}">
                        @error('nombre')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                </div>
                <hr>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{route('tipoReferencias.index')}}" class="btn btn-danger">Cancelar</a>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection