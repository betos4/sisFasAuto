@extends('layouts.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Datos del menú</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{route('menus.store')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name_menu">Nombre</label>
                            <input type="text" class="form-control @error('name_menu') is-invalid @enderror" id="name_menu" name="name_menu" placeholder="Nombre" required value="{{old('name_menu')}}">
                        @error('name_menu')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="url_menu">URL</label>
                            <input type="text" class="form-control @error('url_menu') is-invalid @enderror" id="url_menu" name="url_menu" placeholder="URL" required value="{{old('url_menu')}}">
                        @error('url_menu')
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
                            <label for="icon_menu">Ícono</label>
                            <div class="input-group-prepend">
                                <input type="text" class="form-control @error('icon_menu') is-invalid @enderror" id="icon_menu" name="icon_menu" placeholder="Icono" required value="{{old('icon_menu')}}" onblur="blurFunction()">
                                <div class="input-group-text"><i id="mostrar-icono" class="fas fa-angle-double-right{{ old('icon_menu') }}"></i></div>
                            </div>
                        @error('icon_menu')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                </div>
                <hr>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{route('menus.index')}}" class="btn btn-danger">Cancelar</a>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection

@push('scripts')
    <script>
        function blurFunction() {
            $('#mostrar-icono').removeClass().addClass($('#icon_menu').val());
        }
    </script>
@endpush