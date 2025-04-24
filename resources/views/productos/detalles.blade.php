@extends('layouts.plantilla')

@section('tittle', 'Ver Detalles Productos')

@section('content')
    <div class="container my-4">
        <div class="row">
            @foreach($productos as $producto)
            <div class="col-md-4 mb-3">
                <!-- Tarjeta del producto -->
                <div class="card" style="border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    <div class="card-body">
                        <!-- Encabezado con código y stock -->
                        <div class="d-flex justify-content-between align-items-start">
                            <h5 class="card-title">Código {{ $producto->codigo }}</h5>
                            <p class="text-muted"><i class="fas fa-box"></i> {{$producto->cantidad }}</p>
                        </div>

                        <!-- Contenido principal: Datos a la izquierda, imagen a la derecha -->
                        <div class="d-flex">
                            <!-- Datos del producto -->
                            <div class="me-3" style="flex: 1;">
                                <h6 class="card-subtitle mb-2 text-muted fw-bold">{{ $producto->descripcion }}</h6>
                                <ul class="list-unstyled">
                                    <li>Presentacion: {{ $producto->presentacion }}</li>
                                    <li>Categoria: {{ $producto->categoria->nombre }} </li>
                                    <li>Laboratorio: {{ $producto->laboratorio}} </li>
                                    <li>Proveedor: {{ $producto->proveedor->nombre }} </li>
                                    <li>Vencimiento: {{ $producto->fecha_vencimiento }} </li>
                                    <li>P. Venta: S/.{{ $producto->precio_venta }} </li>
                                    <li>Estado: {{ $producto->estado }} </li>
                                </ul>
                            </div>

                            <!-- Imagen del producto -->
                            <div class="text-end">
                                <img src="{{ asset('storage/' . $producto->foto) }}" alt=""
                                    class="rounded-circle" style="width: 80px; height: 80px;">
                            </div>
                        </div>
                    </div>

                    <!-- Botones de acción -->
                    <div class="card-footer text-end">
                        <button class="btn btn-success rounded-circle"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger rounded-circle"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

@endsection
