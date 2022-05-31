@extends('layouts.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Buscar</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" class="form-control" id="search" name="search" placeholder="Identificación" required>
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" id="btnSearch">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <hr>

            <table class="table table-striped table-inverse table-responsive d-table">
                <thead>
                    <tr>
                        <th>Identificación</th>
                        <th>Nombre</th>
                        <th>Operación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="4">No existen registros</td>
                    </tr>
                </tbody>
            </table>

            <hr>
            <a href="{{route('contratos.index')}}" class="btn btn-danger">Cancelar</a>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection

@push('scripts')
    <!-- Mi Script -->
    <script>
        $('#btnSearch').click(function() {
            search();
        });
        
        function search(){
            var keyword = $('#search').val();
            $.post('{{ route("contratos.search") }}',
            {
                _token: $('meta[name="csrf-token"]').attr('content'),
                keyword:keyword
            },
            function(data){
                table_post_row(data);
            });
        }

        // table row with ajax
        function table_post_row(res){
            let htmlView = '';
            
            if(res.registros == null || res.registros.length <= 0){
                toastr.error('No se encontraron resultados');
                htmlView+= `
                <tr>
                    <td colspan="4">No existen registros</td>
                </tr>`;
            } else {
                toastr.success('Consulta realizada');
                for(let i = 0; i < res.registros.length; i++){
                    htmlView += `
                        <tr>
                            <td>`+res.registros[i].identificacion+`</td>
                            <td>`+res.registros[i].nombre+`</td>
                            <td>`+res.registros[i].operacion+`</td>
                            <td>
                                <a href="{{route('contratos.create', ['credito' => 'miIdCredito'])}}" class="btn btn-primary btn-sm" role="button" title="Contrato"><i class="fas fa-file-contract"></i></a>
                            </td>
                        </tr>`;

                    htmlView = htmlView.replace('miIdCredito', res.registros[i].id);
                }
            }
            $('tbody').html(htmlView);
        }
    </script>
@endpush