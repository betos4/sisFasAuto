@extends('layouts.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Datos del cliente</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
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
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" disabled value="{{old('nombre') ?? $cliente->nombre}}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email" disabled value="{{old('email') ?? $cliente->email}}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="created_at">Fecha creación</label>
                        <input type="text" class="form-control" id="created_at" name="created_at" placeholder="Fecha creación" disabled value="{{old('created_at') ?? $cliente->created_at}}">
                    </div>
                </div>
            </div>

            <hr>
            <a href="{{route('clientes.index')}}" class="btn btn-danger">Cancelar</a>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection