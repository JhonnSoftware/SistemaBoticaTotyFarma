@extends('layouts.plantilla') <!-- Esto extiende la plantilla base -->

@section('title', 'Modulo Productos') <!-- Cambia el título de la página -->

@section('content')
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Productos</li>
    </ol>

    <a href="{{ route('productos.registrar') }}" class="btn btn-primary mb-2">
        <i class="fas fa-plus"></i> Nuevo Producto
    </a>
    <table class="table" id="tblProductos">
        <thead class="thead-dark">
            <tr class="bg-dark">
                <th class="text-white">Id</th>
                <th class="text-white">Codigo</th>
                <th class="text-white">Descripcion</th>
                <th class="text-white">P.Compra</th>
                <th class="text-white">P.Venta</th>
                <th class="text-white">Stock</th>
                <th class="text-white">Estado</th>
                <th class="text-white">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($productos as $producto)
                <tr>
                    <td>{{ $producto->id }}</td>
                    <td>{{ $producto->codigo }}</td>
                    <td>{{ $producto->descripcion }}</td>
                    <td>{{ $producto->precio_compra }}</td>
                    <td>{{ $producto->precio_venta }}</td>
                    <td>{{ $producto->cantidad }}</td>
                    <td>{{ $producto->estado }}</td>
                    <td>
                        @if($producto->estado == 'Activo')
                            <a href="{{ route('productos.editar', $producto->id) }}" class="btn btn-sm btn-warning">Editar</a>
                            <a href="{{ route('productos.eliminar', $producto->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que quieres marcar este producto como inactivo?');">Eliminar</a>
                        @else
                            <a href="{{ route('productos.reingresar', $producto->id) }}" class="btn btn-sm btn-success">Reingresar</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection