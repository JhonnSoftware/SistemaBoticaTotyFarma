<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Compra #{{ $compra->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table, .table th, .table td {
            border: 1px solid black;
        }
        .table th, .table td {
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Detalles de la Compra #{{ $compra->id }}</h1>
    <p><strong>Proveedor:</strong> {{ $compra->proveedor->nombre }}</p>
    <p><strong>Total:</strong> S/ {{ number_format($compra->total, 2) }}</p>
    <p><strong>Fecha:</strong> {{ $compra->fecha->format('d/m/Y') }}</p>

    <h2>Productos</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Sub Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productosTemporales as $productoTemporal)
                <tr>
                    <td>{{ $productoTemporal->producto->descripcion }}</td>
                    <td>{{ $productoTemporal->cantidad }}</td>
                    <td>S/ {{ number_format($productoTemporal->precio, 2) }}</td>
                    <td>S/ {{ number_format($productoTemporal->sub_total, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
