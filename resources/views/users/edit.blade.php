@extends('layouts.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Datos del usuario</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{route('users.update', ['user' => $user->id])}}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="identification_user">Identificación</label>
                            <input type="text" class="form-control" id="identification_user" name="identification_user" placeholder="Identificación" disabled value="{{$user->identification_user}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name_user">Nombre</label>
                            <input type="text" class="form-control @error('name_user') is-invalid @enderror" id="name_user" name="name_user" placeholder="Nombre" required value="{{old('name_user') ?? $user->name_user}}">
                        @error('name_user')
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
                            <label for="lastname_user">Apellido</label>
                            <input type="text" class="form-control @error('lastname_user') is-invalid @enderror" id="lastname_user" name="lastname_user" placeholder="Apellido" required value="{{old('lastname_user') ?? $user->lastname_user}}">
                        @error('lastname_user')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email_user">Email</label>
                            <input type="email" class="form-control @error('email_user') is-invalid @enderror" id="email_user" name="email_user" placeholder="Email" required value="{{old('email_user') ?? $user->email_user}}">
                        @error('email_user')
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
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" disabled value="{{$user->username}}">
                            <input type="hidden" name="status_user" value="{{$user->status_user}}"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="rol">Rol</label>
                            <select class="form-control @error('rol') is-invalid @enderror" id="rol" name="rol">
                                <option value="">SELECCIONE</option>
                            @foreach($roles as $rol)
                                <option {{(collect($user->roles->firstWhere('id',$rol->id))->contains($rol->id)) ? 'selected' : ''}} value="{{$rol->id}}">{{$rol->name_rol}}</option>
                            @endforeach
                            </select>
                        @error('rol')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                </div>
                <hr>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{route('users.index')}}" class="btn btn-danger">Cancelar</a>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection