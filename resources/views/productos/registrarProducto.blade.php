@extends('layouts.plantilla')

@section('title', 'Registrar Producto')

@section('content')
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="container mt-5">
        <h1 class="text-center mb-4">Registrar Producto</h1>

        <div class="card mb-4">
            <div class="card-header">Agregar Producto</div>
            <div class="card-body">
                <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="codigo" class="form-label">Código</label>
                        <input type="text" class="form-control" id="codigo" name="codigo" value="{{ $nuevoCodigo }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                    </div>

                    <div class="mb-3">
                        <label for="presentacion" class="form-label">Presentacion</label>
                        <input type="text" class="form-control" id="presentacion" name="presentacion" required>
                    </div>

                    <div class="mb-3">
                        <label for="stock_minimo" class="form-label">Stock Minimo</label>
                        <input type="number" class="form-control" name="stock_minimo" id="stock_minimo" required>
                    </div>

                    <div class="mb-3">
                        <label for="precio_compra" class="form-label">Precio Compra</label>
                        <input type="number" step="0.01" class="form-control" id="precio_compra" name="precio_compra" required>
                    </div>

                    <div class="mb-3">
                        <label for="precio_venta" class="form-label">Precio Venta</label>
                        <input type="number" step="0.01" class="form-control" id="precio_venta" name="precio_venta" required>
                    </div>

                    <div class="mb-3">
                        <label for="laboratorio" class="form-label">Laboratorio</label>
                        <input type="text" class="form-control" id="laboratorio" name="laboratorio" required>
                    </div>

                    <div class="mb-3">
                        <label for="fecha_vencimiento">Fecha de Vencimiento</label>
                        <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" required>
                    </div>

                    <div class="mb-3">
                        <label for="id_proveedor" class="form-label">Proveedor</label>
                        <select class="form-control" id="id_proveedor" name="id_proveedor" required>
                            @foreach($proveedores as $proveedor)
                                <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="id_categoria" class="form-label">Categoría</label>
                        <select class="form-control" id="id_categoria" name="id_categoria" required>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="foto">Foto</label>
                        <input type="file" class="form-control" name="foto" id="foto" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label for="estado" class="form-label">Estado</label>
                        <select class="form-control" id="estado" name="estado" required>
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar Producto</button>
                    <a href="{{ route('productos.index') }}" class="btn btn-secondary">Volver</a>
                </form>
            </div>
        </div>
    </div>
@endsection
