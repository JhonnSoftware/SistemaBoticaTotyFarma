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
                <form action="{{ route('productos.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="codigo" class="form-label">Código</label>
                        <input type="text" class="form-control" id="codigo" name="codigo" required>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" required>
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
