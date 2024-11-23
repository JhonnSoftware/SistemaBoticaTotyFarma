
@extends('layouts.plantilla')

@section('title', 'Home')

@section('content')
    <div class="row pt-3">

        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="fw-bold mb-0"><span class="text-white">{{ $totalUsuarios }}</span></h3>
                            <p class="mb-0">Total Usuarios</p>
                        </div>
                        <i class="fas fa-user fa-3x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center text-white-50">
                    <a href="{{ route('users.index') }}" class="text-white">Ver Detalle</a>
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="fw-bold mb-0"><span class="text-white"></span>{{ $totalClientes }}</span></h3>
                            <p class="mb-0">Total Clientes</p>
                        </div>
                        <i class="fas fa-users fa-3x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center text-white-50">
                    <a href="{{ route('clientes.index') }}" class="text-white">Ver Detalle</a>
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card card bg-danger text-white">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="fw-bold mb-0"><span class="text-white"></span>{{ $totalProductos }}</span></h3>
                            <p class="mb-0">Total Productos</p>
                        </div>
                        <i class="fab fa-product-hunt fa-3x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center text-white-50">
                    <a href="{{ route('productos.index') }}" class="text-white">Ver Detalle</a>
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="fw-bold mb-0"><span class="text-white">S/. {{ number_format($ventasHoy, 2) }}</span></span></h3>
                            <p class="mb-0">Ventas del Día</p>
                        </div>
                        <i class="fas fa-shopping-cart fa-3x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center text-white-50">
                    <a href="{{ route('ventas.index') }}" class="text-white">Ver Detalle</a>
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 pt-2">
            <div class="card text-white" style="background-color: #28a745;"> <!-- Cambié bg-warning por un estilo en línea -->
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="fw-bold mb-0"><span class="text-white">{{ $totalCategorias }}</span></h3>
                            <p class="mb-0">Total Categorias</p>
                        </div>
                        <i class="fas fa-tags fa-3x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center text-white-50">
                    <a href="{{ route('categorias.index') }}" class="text-white">Ver Detalle</a>
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 pt-2">
            <div class="card text-white" style="background-color: #ff5722;">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="fw-bold mb-0"><span class="text-white">S/. {{ number_format($totalVentasAnuladas, 2) }}</span></span></h3>
                            <p class="mb-0">Ventas Anuladas</p>
                        </div>
                        <i class="fas fa-ban fa-3x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center text-white-50">
                    <a href="{{ route('ventas.lista') }}" class="text-white">Ver Detalle</a>
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 pt-2">
            <div class="card text-white" style="background-color: #9c27b0;">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="fw-bold mb-0"><span class="text-white">S/. {{ number_format($totalComprasAnuladas, 2) }}</span></span></h3>
                            <p class="mb-0">Compras Anuladas</p>
                        </div>
                        <i class="fas fa-times-circle fa-3x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center text-white-50">
                    <a href="{{ route('compras.lista') }}" class="text-white">Ver Detalle</a>
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 pt-2">
            <div class="card text-white" style="background-color: #f44336;">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="fw-bold mb-0"><span class="text-wite">S/. {{ number_format($comprasMes, 2) }}</span></span></h3>
                            <p class="mb-0">Compras del Mes</p>
                        </div>
                        <i class="fas fa-shopping-bag fa-3x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center text-white-50">
                    <a href="{{ route('compras.lista') }}" class="text-white">Ver Detalle</a>
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
        </div>

    </div>
    
    <div class="row mt-2">
        <!-- Productos con Stock Minimo -->
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    Productos con Stock Minimo
                </div>
                <div class="card-body">
                    <canvas id="stockMinimo"></canvas>
                </div>
            </div>h
        </div>

        <!-- Productos Mas Vendidos -->
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    Productos Mas Vendidos
                </div>
                <div class="card-body">
                    <canvas id="ProductosMasVendidos"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

 <script>
     document.addEventListener('DOMContentLoaded', function () {
            // Gráfico de Productos con Stock Mínimo - Tipo Pie
            var ctxStockMinimo = document.getElementById('stockMinimo');
            if (ctxStockMinimo) {
                var stockMinimoChart = new Chart(ctxStockMinimo.getContext('2d'), {
                    type: 'pie',
                    data: {
                        labels: [
                            @foreach($productosStockMinimo as $producto)
                                '{{ $producto->descripcion  }}',
                            @endforeach
                        ],
                        datasets: [{
                            label: 'Cantidad',
                            data: [
                                @foreach($productosStockMinimo as $producto)
                                    {{ $producto->cantidad }},
                                @endforeach
                            ],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    }
                });
            }

            var ctxProductosMasVendidos = document.getElementById('ProductosMasVendidos');
            if (ctxProductosMasVendidos) {
                var productosMasVendidosChart = new Chart(ctxProductosMasVendidos.getContext('2d'), {
                    type: 'pie',
                    data: {
                        labels: [
                            @foreach($productosMasVendidos as $detalle)
                                '{{ $detalle->producto->descripcion  }}',
                            @endforeach
                        ],
                        datasets: [{
                            label: 'Cantidad Vendida',
                            data: [
                                @foreach($productosMasVendidos as $detalle)
                                    {{ $detalle->total_vendido }},
                                @endforeach
                            ],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    }
                });
            }
        });
 </script>

