@extends('layouts.plantilla')

@section('title', 'Nuevo Arqueo de Caja')

@section('content')
    <h1>Nuevo Arqueo de Caja</h1>

    <form action="{{ route('arqueos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="saldo_inicial">Saldo Inicial</label>
            <input type="number" name="saldo_inicial" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="ingresos">Ingresos</label>
            <input type="number" name="ingresos" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="egresos">Egresos</label>
            <input type="number" name="egresos" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Registrar Arqueo</button>
    </form>
@endsection
