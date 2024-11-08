@extends('layouts.plantilla') <!-- Esto extiende la plantilla base -->

@section('title', 'Enviar Mensaje a Proveedor') <!-- Cambia el título de la página -->

@section('content')
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="container mt-5">
        <h1 class="text-center mb-4">Enviar Mensaje a Proveedor</h1>

        <!-- Formulario para enviar un mensaje al proveedor -->
        <div class="card mb-4">
            <div class="card-header">Formulario de Mensaje</div>
            
            <div class="card-body">
                <form action="{{route('proveedores.storeContactanos')}}" method="POST">
                    @csrf <!-- Token de seguridad para los formularios en Laravel -->
                    
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo</label>
                        <input type="email" class="form-control" id="correo" name="correo" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="mensaje" class="form-label">Mensaje</label>
                        <textarea class="form-control" id="mensaje" name="mensaje" rows="4" required></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Enviar Mensaje</button>
                </form>
            </div>
        </div>
    </div>

    @if (session('info'))
        <script>
            alert("{{session('info')}}");
        </script>
    @endif

@endsection
