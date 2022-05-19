@extends('layouts.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Datos del usuario</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{route('users.store')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="identification_user">Identificación</label>
                            <input type="text" class="form-control @error('identification_user') is-invalid @enderror" id="identification_user" name="identification_user" placeholder="Identificación" required="required" value="{{old('identification_user')}}">
                        @error('identification_user')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name_user">Nombre</label>
                            <input type="text" class="form-control @error('name_user') is-invalid @enderror" id="name_user" name="name_user" placeholder="Nombre" required="required" value="{{old('name_user')}}">
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
                            <input type="text" class="form-control @error('lastname_user') is-invalid @enderror" id="lastname_user" name="lastname_user" placeholder="Apellido" required="required" value="{{old('lastname_user')}}">
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
                            <input type="email" class="form-control @error('email_user') is-invalid @enderror" id="email_user" name="email_user" placeholder="Email" required="required" value="{{old('email_user')}}">
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
                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Username" required="required" value="{{old('username')}}">
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required value="{{old('password')}}">
                            <input type="hidden" name="status_user" value="1"/>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="rol">Rol</label>
                            <select class="form-control @error('rol') is-invalid @enderror" id="rol" name="rol">
                                <option value="">SELECCIONE</option>
                            @foreach($roles as $rol)
                                <option value="{{$rol->id}}">{{$rol->name_rol}}</option>
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