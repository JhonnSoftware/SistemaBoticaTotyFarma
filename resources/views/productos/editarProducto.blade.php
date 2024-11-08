@extends('layouts.plantilla')

@section('title', 'Editar Producto')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Editar Producto</h1>

        <div class="card mb-4">
            <div class="card-header">Actualizar Producto</div>
            
            <div class="card-body">
                <form action="{{ route('productos.actualizar', $producto->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="codigo" class="form-label">Código</label>
                        <input type="text" class="form-control" id="codigo" name="codigo" value="{{ $producto->codigo }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{ $producto->descripcion }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="precio_compra" class="form-label">Precio Compra</label>
                        <input type="number" step="0.01" class="form-control" id="precio_compra" name="precio_compra" value="{{ $producto->precio_compra }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="precio_venta" class="form-label">Precio Venta</label>
                        <input type="number" step="0.01" class="form-control" id="precio_venta" name="precio_venta" value="{{ $producto->precio_venta }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="id_proveedor" class="form-label">Proveedor</label>
                        <select class="form-control" id="id_proveedor" name="id_proveedor" required>
                            @foreach($proveedores as $proveedor)
                                <option value="{{ $proveedor->id }}" {{ $producto->id_proveedor == $proveedor->id ? 'selected' : '' }}>
                                    {{ $proveedor->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="id_categoria" class="form-label">Categoría</label>
                        <select class="form-control" id="id_categoria" name="id_categoria" required>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ $producto->id_categoria == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="estado" class="form-label">Estado</label>
                        <select class="form-control" id="estado" name="estado" required>
                            <option value="Activo" {{ $producto->estado == 'Activo' ? 'selected' : '' }}>Activo</option>
                            <option value="Inactivo" {{ $producto->estado == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Actualizar Producto</button>
                </form>
            </div>
        </div>
    </div>
@endsection
