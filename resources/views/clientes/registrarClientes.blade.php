@extends('layouts.plantilla') <!-- Esto extiende la plantilla base -->

@section('title', 'Registrar Proveedor') <!-- Cambia el título de la página -->

@section('content')
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="container mt-5">
    <h1 class="text-center mb-4">CRUD de Clientes</h1>

    <!-- Formulario para crear o editar un proveedor -->
    <div class="card mb-4">
        <div class="card-header">Agregar Proveedor</div>
        
        <div class="card-body">
            <form action="{{ route('clientes.store') }}" method="POST">
                @csrf
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
                    <input type="text" class="form-control" id="telefono" name="telefono">
                </div>
                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="direccion" name="direccion">
                </div>
                <div class="mb-3">
                    <label for="estado" class="form-label">Estado</label>
                    <select class="form-control" id="estado" name="estado" required>
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Guardar Cliente</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Volver</button>
            </form>
        </div>
    </div>
</div>

<script>
    function validarFormulario() {
        var ruc = document.getElementById('ruc').value;
        if (ruc.length !== 11 || isNaN(ruc)) {
            alert('El RUC debe tener exactamente 11 dígitos numéricos.');
            return false; // Evita que el formulario se envíe
        }
        return true; // Permite que el formulario se envíe
    }
</script>

@endsection
