<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Venta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
        }

        .header p {
            margin: 5px 0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: #f4f4f4;
        }

        .total {
            text-align: right;
            font-size: 1.2em;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Detalle de Venta</h1>
        <p><strong>Cliente:</strong> {{ $venta->cliente->nombre }}</p>
        <p><strong>Fecha:</strong> {{ $venta->fecha->format('d/m/Y') }}</p>
        <p><strong>ID de Venta:</strong> {{ $venta->id }}</p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productosTemporales as $producto)
                <tr>
                    <td>{{ $producto->producto->descripcion }}</td>
                    <td>{{ $producto->cantidad }}</td>
                    <td>S/ {{ number_format($producto->precio, 2) }}</td>
                    <td>S/ {{ number_format($producto->sub_total, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        <p><strong>Total:</strong> S/ {{ number_format($venta->total, 2) }}</p>
    </div>
</body>

</html>
