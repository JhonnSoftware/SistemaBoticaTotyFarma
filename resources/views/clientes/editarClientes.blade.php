@extends('layouts.plantilla')

@section('title', 'Editar Cliente')

@section('content')
    <h2>Editar Cliente</h2>

    <form action="{{ route('clientes.actualizar', $cliente->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="dni">DNI</label>
            <input type="text" name="dni" class="form-control" value="{{ $cliente->dni }}" required>
        </div>
        
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ $cliente->nombre }}" required>
        </div>
        
        <div class="form-group">
            <label for="telefono">Telefono</label>
            <input type="text" name="telefono" class="form-control" value="{{ $cliente->telefono }}" required>
        </div>

        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" class="form-control" value="{{ $cliente->direccion }}" required>
        </div>

        <div class="form-group">
            <label for="estado">Estado</label>
            <input type="text" name="estado" class="form-control" value="{{ $cliente->estado }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Cliente</button>
    </form>
@endsection
