@extends('layouts.plantilla')

@section('title', 'Lista de Ventas')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Lista de Ventas</h1>

        <!-- Tabla de ventas -->
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
                @foreach($ventas as $venta)
                    <tr>
                        <td>{{ $venta->id }}</td>
                        <td>{{ $venta->total }}</td>
                        <td>{{ $venta->fecha }}</td>
                        <td>{{ $venta->estado }}</td>
                        <td>
                            <!-- Acción para anular la venta -->
                            <form action="{{ route('ventas.anular', $venta->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas anular esta venta?')">
                                    <i class="fas fa-times-circle"></i> Anular
                                </button>
                            </form>

                            <!-- Acción para descargar el PDF -->
                            <a href="#" class="btn btn-secondary btn-sm">
                                <i class="fas fa-file-pdf"></i> PDF
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
