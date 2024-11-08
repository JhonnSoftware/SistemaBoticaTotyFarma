@extends('layouts.plantilla')

@section('title', 'Editar Categoria')

@section('content')
    <h2>Editar Categoria</h2>

    <form action="{{ route('categorias.actualizar', $categoria->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ $categoria->nombre }}" required>
        </div>
        
        <div class="form-group">
            <label for="estado">Estado</label>
            <input type="text" name="estado" class="form-control" value="{{ $categoria->estado }}" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Actualizar Categoria</button>
    </form>
@endsection
