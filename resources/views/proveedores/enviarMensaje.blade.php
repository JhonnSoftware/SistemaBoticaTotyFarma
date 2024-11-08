@extends('layouts.plantilla')

@section('title', 'Enviar Mensaje a Proveedor')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Enviar Mensaje a Proveedor</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('proveedores.enviarMensaje') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="proveedor_id" class="form-label">Seleccionar Proveedor</label>
                <select name="proveedor_id" id="proveedor_id" class="form-control" required>
                    <option value="">Seleccione un proveedor</option>
                    @foreach($proveedores as $proveedor)
                        <option value="{{ $proveedor->id }}" 
                                data-correo="{{ $proveedor->correo }}" 
                                data-telefono="{{ $proveedor->telefono }}">
                            {{ $proveedor->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="correo" class="form-label">Correo</label>
                <input type="text" class="form-control" id="correo" name="correo" readonly>
            </div>

            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" readonly>
            </div>

            <div class="mb-3">
                <label for="mensaje" class="form-label">Mensaje</label>
                <textarea class="form-control" id="mensaje" name="mensaje" rows="5" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
            <a href="{{ route('proveedores.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <script>
        // Obtener elementos del DOM
        const proveedorSelect = document.getElementById('proveedor_id');
        const correoInput = document.getElementById('correo');
        const telefonoInput = document.getElementById('telefono');

        // Añadir evento al cambiar el proveedor seleccionado
        proveedorSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const correo = selectedOption.getAttribute('data-correo');
            const telefono = selectedOption.getAttribute('data-telefono');

            // Actualizar los campos de correo y teléfono
            correoInput.value = correo ? correo : '';
            telefonoInput.value = telefono ? telefono : '';
        });
    </script>
@endsection
