@extends('layouts.plantilla')

@section('title', 'Arqueo de Caja')

@section('content')
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Listado de Arqueos de Caja</li>
    </ol>
    <a href="{{ route('arqueos.create') }}" class="btn btn-primary mb-2">
        <i class="fas fa-plus"></i> Nuevo Arqueo
    </a>

    <table class="table">
        <thead class="thead-dark">
            <tr class="bg-dark">
                <th class="text-white">ID</th>
                <th class="text-white">Saldo Inicial</th>
                <th class="text-white">Ingresos</th>
                <th class="text-white">Egresos</th>
                <th class="text-white">Saldo Final Esperado</th>
                <th class="text-white">Saldo Real</th>
                <th class="text-white">Diferencia</th>
                <th class="text-white">Estado</th>
                <th class="text-white">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($arqueos as $arqueo)
            <tr>
                <td>{{ $arqueo->id }}</td>
                <td>{{ $arqueo->saldo_inicial }}</td>
                <td>{{ $arqueo->ingresos }}</td>
                <td>{{ $arqueo->egresos }}</td>
                <td>{{ $arqueo->saldo_final_esperado }}</td>
                <td>{{ $arqueo->saldo_real ?? 'Pendiente' }}</td>
                <td>{{ $arqueo->diferencia ?? 'Pendiente' }}</td>
                <td>{{ $arqueo->estado }}</td>
                <td>
                    @if($arqueo->estado == 'Abierto')
                        <form action="{{ route('arqueos.cerrar', $arqueo->id) }}" method="POST">
                            @csrf
                            <input type="number" name="saldo_real" placeholder="Saldo Real" required>
                            <button type="submit" class="btn btn-success">Cerrar Arqueo</button>
                        </form>
                    @else
                        <span class="badge bg-success">Cerrado</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
