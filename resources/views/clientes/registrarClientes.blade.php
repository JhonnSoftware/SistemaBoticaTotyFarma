@extends('layouts.plantilla') <!-- Esto extiende la plantilla base -->

@section('title', 'Registrar Cliente') <!-- Cambia el título de la página -->

@section('content')
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Mostrar errores de validación, incluyendo el mensaje de error personalizado para el DNI -->
    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="container mt-5">
    <h1 class="text-center mb-4">CRUD de Clientes</h1>

    <!-- Formulario para crear o editar un cliente -->
    <div class="card mb-4">
        <div class="card-header">Agregar Cliente</div>
        
        <div class="card-body">
            <form action="{{ route('clientes.store') }}" method="POST">
                @csrf <!-- Token de seguridad para los formularios en Laravel -->
                <div class="mb-3">
                    <label for="dni" class="form-label">DNI</label>
                    <input type="text" class="form-control" id="dni" name="dni" placeholder="Maximo 8 numeros"  required>
                </div>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" required>
                </div>
                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" required>
                </div>
                <div class="mb-3">
                    <label for="estado" class="form-label">Estado</label>
                    <select class="form-control" id="estado" name="estado" required>
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Guardar Cliente</button>
                <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Volver</a>
            </form>
        </div>
    </div>
</div>
@endsection
