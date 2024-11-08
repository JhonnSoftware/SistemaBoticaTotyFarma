@extends('layouts.plantilla') <!-- Esto extiende la plantilla base -->

@section('title', 'Modulo Usuarios') <!-- Cambia el título de la página -->

@section('content')
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Usuarios</li>
    </ol>
    <a href="{{ route('users.registrar') }}" class="btn btn-primary mb-2">
        <i class="fas fa-plus"></i> Nuevo Usuario
    </a>

    <table class="table" id="tblUsuarios">
        <thead class="thead-dark">
            <tr class="bg-dark">
                <th class="text-white">Id</th>
                <th class="text-white">Nombre</th>
                <th class="text-white">Email</th>
                <th class="text-white">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route('users.editar', $user->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <a href="{{ route('users.eliminar', $user->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que quieres marcar este usuario como inactivo?');">Eliminar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection