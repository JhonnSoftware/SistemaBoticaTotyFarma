@extends('layouts.plantilla')

@section('title', 'Lista de Compras')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Lista de Compras</h1>

        <!-- Tabla de compras -->
        <table class="table table-striped table-hover table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Total</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($compras as $compra)
                    <tr>
                        <td>{{ $compra->id }}</td>
                        <td>{{ $compra->total }}</td>
                        <td>{{ $compra->fecha }}</td>
                        <td>{{ $compra->estado }}</td>
                        <td>
                            <!-- Acción para anular la compra -->
                            <form action="{{ route('compras.anular', $compra->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas anular esta compra?')">
                                    <i class="fas fa-times-circle"></i> Anular
                                </button>
                            </form>

                            <!-- Acción para descargar el PDF -->
                            <a href="" class="btn btn-secondary btn-sm">
                                <i class="fas fa-file-pdf"></i> PDF
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
