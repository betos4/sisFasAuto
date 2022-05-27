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
    <h1 class="h3 mb-2 text-gray-800">Usuarios</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">

            <a class="btn btn-primary" href="{{route('users.create')}}" title="Crear" role="button"><i class="fas fa-file" aria-hidden="true"></i> Crear</a>
            <hr>
            
            <table class="table table-bordered table-striped dt-responsive" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Identificación</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <!--<th>Email</th>-->
                        <th>Username</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->identification_user}}</td>
                        <td>{{$user->name_user}}</td>
                        <td>{{$user->lastname_user}}</td>
                        <!--<td>{{$user->email_user}}</td>-->
                        <td>{{$user->username}}</td>
                        <td>{{$user->name_rol}}</td>
                        <td>
                        @if($user->status_user)
                            <button class="btn btn-success btn-sm">Activado</button>
                        @else
                            <button class="btn btn-danger btn-sm">Desactivado</button>
                        @endif
                        </td>
                        <td>
                            <a href="{{route('users.edit', ['user' => $user->id])}}" class="btn btn-info btn-sm" role="button" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                            <a class="btn btn-warning btn-sm" href="#" role="button" title="Password" data-toggle="modal" data-target="#passwordModal" data-userid="{{ $user->id }}" data-username="{{ $user->username }}"><i class="fas fa-key"></i></a>
                            
                            <form method="POST" class="d-inline" action="{{ route('users.destroy', ['user' => $user->id]) }}">
                                @csrf    
                                @method('DELETE')
                                @if($user->status_user)
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

<!-- Password Modal-->
<div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Resetear contraseña</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form action="{{route('users.password')}}" method="POST">
                @csrf
                
                <div class="modal-body">
                    Seguro que deseas resetear la constraseña del usuario <p></p>
                    <input type="hidden" name="user_id" id="user_id"  value="{{old('user_id')}}" >
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Resetear</a>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Password Modal-->
@endsection

@push('scripts')
    <!-- Mis scripts --> 
    <script>
        $('#passwordModal').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget)
            let user_id = button.data('userid');
            let username = button.data('username') + ' a Sis2022$$';

            let modal = $(this);
            modal.find('.modal-body #user_id').val(user_id);
            modal.find('.modal-body p').text(username);
        })
    </script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('vendor/datatables/dataTables.responsive.min.js') }}"></script>
	<script src="{{ asset('vendor/datatables/responsive.bootstrap.min.js') }}"></script>

	<!-- Page level custom scripts -->
	<script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
@endpush