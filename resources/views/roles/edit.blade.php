@extends('layouts.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Datos del usuario</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{route('roles.update', ['rol' => $rol->id])}}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name_rol">Nombre</label>
                            <input type="text" class="form-control @error('name_rol') is-invalid @enderror" id="name_rol" name="name_rol" placeholder="Identificación" required value="{{old('name_rol') ?? $rol->name_rol}}">
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
                            <textarea class="form-control @error('description_rol') is-invalid @enderror" id="description_rol" name="description_rol" placeholder="Descripción" rows="2" required >{{old('description_rol')  ?? $rol->description_rol}}</textarea>
                            <input type="hidden" name="status_rol" value="{{$rol->status_rol}}"/>
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
                            <input class="custom-control-input" type="checkbox" id="is_superadministrator_rol" name="is_superadministrator_rol" value="1" {{$rol->is_superadministrator_rol == 1 ? 'checked' : ''}}/>
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