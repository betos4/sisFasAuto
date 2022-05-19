@extends('layouts.app')

@push('css')
    <!-- Custom styles for this page -->
    <link rel="stylesheet" href="{{ asset('css/nestable/jquery.nestable.css') }}">
@endpush

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Menú</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">

            <a class="btn btn-primary" href="{{route('menus.create')}}" title="Crear" role="button"><i class="fas fa-file" aria-hidden="true"></i> Crear</a>
            <hr>

            <table style="width: 100%" >
            <tr>
                <th>
                    <div class="dd" id="nestable">
                        <ol class="dd-list">
                            @foreach($menus as $menu)

                                @if($menu['menu_id'] != 0)
                                    @break
                                @endif

                                @include("menus.menu-item",[ "menu" => $menu ])

                            @endforeach
                        </ol>
                    </div>
                </th>
            </tr>
        </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection

@push('scripts')
	<!-- Page level custom scripts -->
    <script src="{{ asset('js/nestable/jquery.nestable.js') }}"></script>

    <script>
        $(document).ready(function()
        {
            // activate Nestable for list 1
            $('#nestable').nestable({
                group: 1
            })

            $('#nestable-menu').on('click', function(e)
            {
                var target = $(e.target),
                    action = target.data('action');
                if (action === 'expand-all') {
                    $('.dd').nestable('expandAll');
                }
                if (action === 'collapse-all') {
                    $('.dd').nestable('collapseAll');
                }
            });
        });

        $(document).ready(function () {
            $('#nestable').nestable().on('change', function () {
                const data = {
                    menu: window.JSON.stringify($('#nestable').nestable('serialize')),
                    _token: '{{ csrf_token() }}',
                };
                $.ajax({
                    url: '{{ route("save_order") }}',
                    type: 'POST',
                    dataType: 'JSON',
                    data: data,
                    success: function (respuesta) {
                    }
                });
            });
        });

    </script>
@endpush