<!--
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
        .table th, .table td {
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
-->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Voucher de Venta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 12px;
        }

        .container {
            width: 80mm;
            margin: 0 auto;
            padding: 10px;
            border: 1px solid #ddd;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .header img {
            max-width: 100px;
        }

        .section {
            margin-bottom: 10px;
        }

        .section p {
            margin: 2px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        table th,
        table td {
            text-align: left;
            padding: 4px;
            border-bottom: 1px solid #ddd;
        }

        table th {
            font-weight: bold;
        }

        .totals {
            text-align: right;
        }

        .totals p {
            margin: 2px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Cabecera -->
        <div class="header">
            <img src="" alt="">
            <p>RUC: 20511200909</p>
            <p>CENTRAL: Calle Victor Alzamora Nro. 144 Urb. Santa Catalina</p>
            <p>TRUJILLO - LA ESPERANZA</p>
        </div>

        <!-- Datos de la transacción -->
        <div class="section">
            <p><strong>Boleta Electrónica:</strong> B123-00093115</p>
            <p><strong>Fecha de Emisión:</strong> {{ $venta->fecha }}</p>
            <p><strong>N° Pedido de Venta:</strong> 00034312</p>
            <p><strong>Turno:</strong> 24/1</p>
            <p><strong>Cliente:</strong> {{ $venta->cliente->nombre }}</p>
        </div>

        <!-- Tabla de productos -->
        <table>
            <thead>
                <tr>
                    <th>Descripción</th>
                    <th>Cant.</th>
                    <th>P. Unit</th>
                    <th>Importe</th>
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

        <!-- Totales -->
        <div class="totals">
            <p><strong>Total a pagar:</strong> S/ {{ number_format($venta->total, 2) }}</p>
        </div>

        <!-- Pie de página -->
        <div class="footer">
            <p style="text-align: center;">Gracias por su compra</p>
        </div>
    </div>
</body>

</html>
