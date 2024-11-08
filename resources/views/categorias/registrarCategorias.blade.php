@extends('layouts.plantilla') <!-- Esto extiende la plantilla base -->

@section('title', 'Registrar Categoria') <!-- Cambia el título de la página -->

@section('content')
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="container mt-5">
    <h1 class="text-center mb-4">CRUD de Categorias</h1>

    <!-- Formulario para crear o editar un cliente -->
    <div class="card mb-4">
        <div class="card-header">Agregar Categoria</div>
        
        <div class="card-body">
            <form action="{{ route('categorias.store') }}" method="POST">
                @csrf <!-- Token de seguridad para los formularios en Laravel -->
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="mb-3">
                    <label for="estado" class="form-label">Estado</label>
                    <select class="form-control" id="estado" name="estado" required>
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Guardar Categoria</button>
                <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Volver</a>
            </form>
        </div>
    </div>
@endsection