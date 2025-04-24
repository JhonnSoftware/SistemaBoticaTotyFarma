@extends('layouts.plantilla')

@section('title', 'Registrar Usuario')

@section('content')
    <h1 class="mb-4">Registrar Usuario</h1>

    <!-- Mensaje de éxito -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulario de creación de usuario -->
    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf <!-- Token de seguridad obligatorio en Laravel -->

        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" name="password" id="password" class="form-control" required>
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-control" name="role" id="role" required>
                <option value="admin">Administrador</option>
                <option value="user">Usuario</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="foto">Foto</label>
            <input type="file" class="form-control" name="foto" id="foto" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">Registrar Usuario</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Volver</a>
    </form>
@endsection
