@extends('layouts.app')

@push('css')

@endpush

@section('content')
<!-- Content Row -->
    <div class="row">
        <!-- Cartera Propia -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Emitidos hoy</div>
                            <div id="contratosDia" class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cartera Gail -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Emitidos Periodo</div>
                            <div id="contratosMes" class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cartera Anita -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Plazo Promedio (años)
                            </div>
                            <div id="plazoAnios" class="h5 mb-0 mr-3 font-weight-bold text-gray-800">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-calendar-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cartera Armando -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Crédito Promedio</div>
                            <div id="creditoPromedio" class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Emitidos por día</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myBarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Top marcas</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Propia
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Gail
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> Anita
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-warning"></i> Armando
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Page level plugins -->
    <script src="/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/js/demo/chart-bar-demo.js"></script>
    <script src="/js/demo/chart-pie-demo.js"></script>

    <!-- Mi Script -->
    <script>
       consultarDataContratos();
        
        function consultarDataContratos(){
            var keyword = '';

            $.post('{{ route("contratos.consult") }}',
            {
                _token: $('meta[name="csrf-token"]').attr('content'),
                keyword:keyword
            },
            function(data){
                dataConsult(data);
            });
        }

        function dataConsult(res){
            let contratosDia = res.actuales;
            let contratosMes = res.mensuales;
            let plazoAnios = res.plazo / contratosMes;
            let creditoPromedio = res.valorCredito / contratosMes;

            //seteo los valores contratoDias
            let div = document.getElementById('contratosDia');
            div.innerHTML = contratosDia;

            //seteo los valores contratoMes
            div = document.getElementById('contratosMes');
            div.innerHTML = contratosMes;

            //seteo los valores plazoAnios
            div = document.getElementById('plazoAnios');
            div.innerHTML = round(plazoAnios);

            //seteo los valores creditoPromedio
            div = document.getElementById('creditoPromedio');
            div.innerHTML = round(creditoPromedio);

            myBarChartDraw(res.contratosPorDia);
            myPieChartDraw(res.marcas);
            //console.log(myBarChartData);
        }

        //funcion para redondear un valor
        function round(num) {
            return +(Math.round(num + "e+2")  + "e-2");
        }
    </script>
@endpush
