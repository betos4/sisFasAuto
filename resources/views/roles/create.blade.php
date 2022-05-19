@extends('layouts.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Datos del rol</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{route('roles.store')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name_rol">Nombre</label>
                            <input type="text" class="form-control @error('name_rol') is-invalid @enderror" id="name_rol" name="name_rol" placeholder="Nombre" required value="{{old('name_rol')}}">
                        @error('name_rol')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description_rol">Descripción</label>
                            <textarea class="form-control @error('description_rol') is-invalid @enderror" id="description_rol" name="description_rol" placeholder="Descripción" rows="2" required >{{old('description_rol')}}</textarea>
                            <input type="hidden" name="status_rol" value="1"/>
                        @error('description_rol')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="custom-control custom-checkbox pmd-checkbox">
                            <input type="hidden" name="is_superadministrator_rol" value="0"/>
                            <input class="custom-control-input" type="checkbox" id="is_superadministrator_rol" name="is_superadministrator_rol" value="1"/>
                            <label class="custom-control-label pmd-checkbox-ripple-effect" for="is_superadministrator_rol">SUPERADMINISTRADOR</label>
                        </div>
                    </div>
                </div>

                <hr>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{route('roles.index')}}" class="btn btn-danger">Cancelar</a>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection