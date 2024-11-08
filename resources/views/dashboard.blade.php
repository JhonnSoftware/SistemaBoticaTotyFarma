@extends('layouts.plantilla')

@section('title', 'Home')

@section('content')
    <div class="row pt-3">

        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="fw-bold mb-0"><span class="text-white"></span></h3>
                            <p class="mb-0">Usuarios</p>
                        </div>
                        <i class="fas fa-user fa-3x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center text-white-50">
                    <a href="" class="text-white">Ver Detalle</a>
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="fw-bold mb-0"><span class="text-white"></span></span></h3>
                            <p class="mb-0">Clientes</p>
                        </div>
                        <i class="fas fa-users fa-3x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center text-white-50">
                    <a href="" class="text-white">Ver Detalle</a>
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card card bg-danger text-white">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="fw-bold mb-0"><span class="text-white"></span></span></h3>
                            <p class="mb-0">Productos</p>
                        </div>
                        <i class="fab fa-product-hunt fa-3x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center text-white-50">
                    <a href="" class="text-white">Ver Detalle</a>
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="fw-bold mb-0"><span class="text-white"></span></span></h3>
                            <p class="mb-0">Ventas del Día</p>
                        </div>
                        <i class="fas fa-shopping-cart fa-3x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center text-white-50">
                    <a href="" class="text-white">Ver Detalle</a>
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 pt-2">
            <div class="card text-white" style="background-color: #28a745;"> <!-- Cambié bg-warning por un estilo en línea -->
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="fw-bold mb-0"><span class="text-white">---</span></h3>
                            <p class="mb-0">Opción</p>
                        </div>
                        <i class="fas fa-shopping-cart fa-3x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center text-white-50">
                    <a href="" class="text-white">Ver Detalle</a>
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
        </div>
        

        <div class="col-xl-3 col-md-6 pt-2">
            <div class="card text-white" style="background-color: #ff5722;">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="fw-bold mb-0"><span class="text-white">---</span></span></h3>
                            <p class="mb-0">Opcion</p>
                        </div>
                        <i class="fas fa-shopping-cart fa-3x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center text-white-50">
                    <a href="" class="text-white">Ver Detalle</a>
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 pt-2">
            <div class="card text-white" style="background-color: #9c27b0;">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="fw-bold mb-0"><span class="text-white">---</span></span></h3>
                            <p class="mb-0">Opcion</p>
                        </div>
                        <i class="fas fa-shopping-cart fa-3x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center text-white-50">
                    <a href="" class="text-white">Ver Detalle</a>
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 pt-2">
            <div class="card text-white" style="background-color: #f44336;">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="fw-bold mb-0"><span class="text-white">---</span></span></h3>
                            <p class="mb-0">Opcion</p>
                        </div>
                        <i class="fas fa-shopping-cart fa-3x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center text-white-50">
                    <a href="" class="text-white">Ver Detalle</a>
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
            </div>
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


