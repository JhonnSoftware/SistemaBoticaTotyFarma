@extends('layouts.plantilla')

@section('title', 'Editar Proveedor')

@section('content')
    <h2>Editar Proveedor</h2>

    <form action="{{ route('proveedores.actualizar', $proveedor->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="ruc">RUC</label>
            <input type="text" name="ruc" class="form-control" value="{{ $proveedor->ruc }}" required>
        </div>
        
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ $proveedor->nombre }}" required>
        </div>
        
        <div class="form-group">
            <label for="telefono">Telefono</label>
            <input type="text" name="telefono" class="form-control" value="{{ $proveedor->telefono }}" required>
        </div>

        <div class="form-group">
            <label for="correo">Correo</label>
            <input type="email" name="correo" class="form-control" value="{{ $proveedor->correo }}" required>
        </div>

        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" class="form-control" value="{{ $proveedor->direccion }}" required>
        </div>

        <div class="form-group">
            <label for="estado">Estado</label>
            <input type="text" name="estado" class="form-control" value="{{ $proveedor->estado }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Proveedor</button>
    </form>
@endsection
