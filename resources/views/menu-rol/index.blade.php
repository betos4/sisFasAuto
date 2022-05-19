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
    <h1 class="h3 mb-2 text-gray-800">Menú-Rol</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">

            <table class="table table-bordered table-striped table-hover dt-responsive" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Menú</th>
                        @foreach($roles as $id => $name_rol)
                            <th class="text-center">{{$name_rol}}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                @foreach($menus as $key => $menu)
                    @if ($menu["menu_id"] != 0)
                        @break
                    @endif
                    <tr>
                        <td class="font-weight-bold"><i class="fa fa-arrows-alt"></i> {{$menu["name_menu"]}}</td>
                        @foreach($roles as $id => $name_rol)
                            <td class="text-center">
                                <input type="checkbox" class="menu_rol" name="menu_rol[]" data-menuid="{{$menu['id']}}" value="{{$id}}" {{in_array($id, array_column($menusRoles[$menu['id']], 'id'))? 'checked' : ''}}>
                            </td>
                        @endforeach
                    </tr>
                    @foreach($menu["submenu"] as $key => $hijo)
                        <tr>
                            <td class="pl-20"><i class="fa fa-arrow-right"></i> {{ $hijo["name_menu"] }}</td>
                            @foreach($roles as $id => $name_rol)
                                <td class="text-center">
                                    <input type="checkbox" class="menu_rol" name="menu_rol[]" data-menuid="{{$hijo['id']}}" value="{{$id}}" {{in_array($id, array_column($menusRoles[$hijo['id']], 'id'))? 'checked' : ''}}>
                                </td>
                            @endforeach
                        </tr>
                        @foreach ($hijo["submenu"] as $key => $hijo2)
                            <tr>
                                <td class="pl-30"><i class="fa fa-arrow-right"></i> {{$hijo2["name_menu"]}}</td>
                                @foreach($roles as $id => $name_rol)
                                    <td class="text-center">
                                        <input type="checkbox" class="menu_rol" name="menu_rol[]" data-menuid="{{$hijo2['id']}}" value="{{$id}}" {{in_array($id, array_column($menusRoles[$hijo2['id']], 'id'))? 'checked' : ''}}>
                                    </td>
                                @endforeach
                            </tr>
                            @foreach ($hijo2["submenu"] as $key => $hijo3)
                                <tr>
                                    <td class="pl-40"><i class="fa fa-arrow-right"></i> {{$hijo3["name_menu"]}}</td>
                                    @foreach($roles as $id => $name_rol)
                                        <td class="text-center">
                                            <input type="checkbox" class="menu_rol" name="menu_rol[]" data-menuid="{{$hijo3['id']}}" value="{{$id}}" {{in_array($id, array_column($menusRoles[$hijo3['id']], 'id'))? 'checked' : ''}}>
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        @endforeach
                    @endforeach
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

    <script>
        $('.menu_rol').on('change', function () {
            //console.log('cambio');
            var data = {
                menu_id: $(this).data('menuid'),
                rol_id: $(this).val(),
                _token: '{{ csrf_token() }}',
            };
            if ($(this).is(':checked')) {
                data.estado = 1
            } else {
                data.estado = 0
            }
            ajaxRequest("{{route('guardar_menu_rol')}}", data);
        });

        function ajaxRequest (url, data) {
            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                success: function (respuesta) {
                    console.log(respuesta);
                    toastr.success(respuesta.respuesta);
                }, error: function () {
                    toastr.warning('ERROR');
                }
            });
        }
    </script>
@endpush