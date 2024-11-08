<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .total {
            text-align: right;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Compra Realizada</h1>
        <p><strong>Nombre de la Empresa: XYZ</strong></p>
        <p><strong>Fecha:</strong> {{ $compra->fecha }}</p>
        <p><strong>Proveedor:</strong> {{ $compra->proveedor->nombre }}</p>
    </div>

    <h2>Detalles de la Compra</h2>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Sub Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productosTemporales as $productoTemporal)
            <tr>
                <td>{{ $productoTemporal->producto->descripcion }}</td>
                <td>{{ $productoTemporal->cantidad }}</td>
                <td>{{ number_format($productoTemporal->precio, 2) }}</td>
                <td>{{ number_format($productoTemporal->sub_total, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p class="total"><strong>Total Compra:</strong> {{ number_format($compra->total, 2) }}</p>
</body>
</html>
