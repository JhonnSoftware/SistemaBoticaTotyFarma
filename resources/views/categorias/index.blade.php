@extends('layouts.plantilla') <!-- Esto extiende la plantilla base -->

@section('title', 'Modulo Categorias') <!-- Cambia el título de la página -->

@section('content')
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Categorias</li>
    </ol>

    <a href="{{ route('categorias.registrar') }}" class="btn btn-primary mb-2">
        <i class="fas fa-plus"></i> Nuevo Categoria
    </a>
    <table class="table" id="tblCategorias">
        <thead class="thead-dark">
            <tr class="bg-dark">
                <th class="text-white">Id</th>
                <th class="text-white">Nombre</th>
                <th class="text-white">Estado</th>
                <th class="text-white">Acciones</th>
            </tr>
        </thead>

        <tbody>

            @foreach($categorias as $categoria)
            <tr>
                <td>{{ $categoria->id }}</td>
                <td>{{ $categoria->nombre }}</td>
                <td>{{ $categoria->estado }}</td>
                <td>
                    @if($categoria->estado == 'Activo')
                        <a href="{{ route('categorias.editar', $categoria->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <a href="{{ route('categorias.eliminar', $categoria->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que quieres marcar esta categoria como inactivo?');">Eliminar</a>
                    @else
                        <a href="{{ route('categorias.reingresar', $categoria->id) }}" class="btn btn-sm btn-success">Reingresar</a>
                    @endif
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
@endsection