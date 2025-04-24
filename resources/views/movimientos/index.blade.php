@extends('layouts.plantilla')
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <div class="main-section">
        <h1>Movimientos</h1>

        <!-- Filtros -->
        <form method="GET" action="">
            <div class="filters">
                <div class="form-group">
                    <label for="fecha_inicio">Fecha Inicio:</label>
                    <input type="date" id="fecha_inicio" name="fecha_inicio" value="{{ request('fecha_inicio') }}">
                </div>
                <div class="form-group">
                    <label for="fecha_fin">Fecha Fin:</label>
                    <input type="date" id="fecha_fin" name="fecha_fin" value="{{ request('fecha_fin') }}">
                </div>
                <div class="form-group">
                    <label for="tipo">Tipo:</label>
                    <select id="tipo" name="tipo">
                        <option value="">-- Seleccionar --</option>
                        <option value="entrada" {{ request('tipo') == 'entrada' ? 'selected' : '' }}>Entrada</option>
                        <option value="salida" {{ request('tipo') == 'salida' ? 'selected' : '' }}>Salida</option>
                        <option value="devolucion_cliente" {{ request('tipo') == 'devolucion_cliente' ? 'selected' : '' }}>
                            Devolución Cliente</option>
                        <option value="devolucion_proveedor"
                            {{ request('tipo') == 'devolucion_proveedor' ? 'selected' : '' }}>
                            Devolución Proveedor</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="usuario">Usuario:</label>
                    <input type="text" id="usuario" name="usuario" placeholder="Nombre del usuario"
                        value="{{ request('usuario') }}">
                </div>
                <a href="{{ url()->current() }}" class="btn btn-secondary btnLimpiar">
                    <i class="fas fa-eraser"></i> Limpiar
                </a>
                <button type="submit">
                    <i class="fas fa-filter"></i> Filtrar
                </button>
            </div>
        </form>

        <!-- Tabla -->
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>Movimiento ID</th>
                    <th>Fecha y Hora</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Tipo</th>
                    <th>Usuario</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí iteras los movimientos desde el controlador -->
                @foreach ($movimientos as $movimiento)
                    <tr>
                        <td>{{ $movimiento->id }}</td>
                        <td>{{ \Carbon\Carbon::parse($movimiento->fecha)->format('d/m/Y - H\h:i\m:s\s') }}</td>
                        <td>{{ $movimiento->cantidad }}</td> <!-- Aquí es donde aparece "venta" o "compra" -->
                        <td>S/. {{ $movimiento->total }}</td>
                        <td>
                            <span class="{{ $movimiento->tipo == 'Entrada' ? 'tipo-entrada' : '' }} {{ $movimiento->tipo == 'Salida' ? 'tipo-salida' : '' }}">
                            {{ $movimiento->tipo }}
                            </span>
                        </td>
                        <td>{{ $movimiento->usuario->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <style>
        /* Estilos previos */
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: space-between;
            padding: 20px;
        }

        .main-section {
            flex: 2;
            margin-right: 20px;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .main-section h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .filters {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }

        .filters .form-group {
            flex: 1;
            min-width: 200px;
        }

        .filters label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .filters input,
        .filters select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .filters button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .main-section table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .main-section table th,
        .main-section table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .main-section table th {
            background-color: #17a2b8;
            color: white;
        }
        .tipo-entrada{
            display: flex;
            align-content: center;
            justify-content: center;
            background-color: rgb(75, 189, 75);
            color: white;
            padding:  4px 0px;
            border-radius: 5px;
        }
        .tipo-salida{
            display: flex;
            align-content: center;
            justify-content: center;
            background-color: rgb(243, 81, 81);
            color: white;
            padding: 4px 0px;
            border-radius: 5px;
        }

        .btnLimpiar{
            display: flex;
            align-content: center;
            align-items: center;
        }

    </style>

    </html>
@endsection
