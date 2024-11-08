@extends('layouts.plantilla')

@section('title', 'Registrar Venta')

@section('content')
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="container mt-5">
        <h1 class="text-center mb-4">Registrar Venta</h1>

        <form action="{{ route('ventas.agregarProductoTemporal') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="id_producto" class="form-label">Producto</label>
                <select name="id_producto" id="id_producto" class="form-control" required>
                    <option value="" selected disabled>Seleccionar Producto</option>
                    @foreach($productos as $producto)
                        <option value="{{ $producto->id }}" data-descripcion="{{ $producto->descripcion }}" data-precio="{{ $producto->precio_venta }}">
                            {{ $producto->descripcion }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text" name="descripcion" id="descripcion" class="form-control" readonly>
            </div>

            <div class="mb-3">
                <label for="precio_venta" class="form-label">Precio de Venta</label>
                <input type="number" name="precio_venta" id="precio_venta" class="form-control" readonly>
            </div>

            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" name="cantidad" id="cantidad" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Agregar Producto</button>
        </form>

        <h3 class="mt-4">Productos Temporales</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Sub Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productosTemporales as $productoTemporal)
                    <tr>
                        <td>{{ $productoTemporal->producto->descripcion }}</td>
                        <td>{{ $productoTemporal->cantidad }}</td>
                        <td>{{ $productoTemporal->precio }}</td>
                        <td>{{ $productoTemporal->sub_total }}</td>
                        <td>
                            <form action="{{ route('ventas.eliminarProductoTemporal', $productoTemporal->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <form action="{{ route('ventas.guardarVenta') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="id_cliente" class="form-label">Cliente</label>
                <select name="id_cliente" id="id_cliente" class="form-control" required>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">Finalizar Venta</button>
        </form>
    </div>

    <script>
        document.getElementById('id_producto').addEventListener('change', function() {
            var selected = this.options[this.selectedIndex];
            var descripcion = selected.getAttribute('data-descripcion');
            var precio = selected.getAttribute('data-precio');
            document.getElementById('descripcion').value = descripcion;
            document.getElementById('precio_venta').value = precio;
        });
    </script>
@endsection