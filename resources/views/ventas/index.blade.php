@extends('layouts.plantilla')

@section('title', 'Registrar Venta')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('pdf_url'))
        <script>
            window.open('{{ session('pdf_url') }}', '_blank');
        </script>
    @endif


    <div class="container">
        <!-- Main Section -->
        <div class="main-section">
            <h1>Registrar Venta</h1>

            <form action="{{ route('ventas.agregarProductoTemporal') }}" method="POST">
                @csrf
                <div class="search-bar">
                    <label for="product-search">Seleccionar Productos</label>
                    <input type="text" id="product-search"
                        placeholder="Ingrese el código de barras o el nombre del producto">
                    <div id="suggestions"
                        style="border: 1px solid #ccc; background: #fff; display: none; position: absolute; z-index: 1000;">

                    </div>

                </div>
                <div class="form-group-row">
                    <label for="precio_venta">Precio de Venta</label>
                    <input type="number" id="precio_venta" name="precio_venta" class="input-text" readonly>
                    <label for="cantidad">Ingresar Cantidad</label>
                    <input type="number" id="cantidad" name="cantidad" class="input-text" placeholder="Ingrese cantidad">
                </div>
                <input type="hidden" id="id_producto" name="id_producto">
                <div class="buttons">
                    <button type="submit" class="btn-primary">Agregar Producto</button>
                    <button type="reset" class="btn-danger">Vaciar Listado</button>
                </div>
            </form>

            <table>
                <thead>
                    <tr>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Sub Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productosTemporales as $productoTemporal)
                        <tr>
                            <td>{{ $productoTemporal->producto->descripcion }}</td>
                            <td>{{ $productoTemporal->cantidad }}</td>
                            <td>{{ $productoTemporal->precio }}</td>
                            <td>{{ $productoTemporal->sub_total }}</td>
                            <td>
                                <form action="{{ route('ventas.eliminarProductoTemporal', $productoTemporal->id) }}"
                                    method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <form>
                <div class="form-group mb-4">
                    <label for="received" class="form-label">Efectivo recibido</label>
                    <input type="text" id="received" class="form-control" placeholder="Cantidad de efectivo recibida"
                        oninput="calcularVuelto()">
                </div>

                <div class="totals mb-4">
                    <p><strong>Monto Efectivo: S/. <span id="monto-efectivo">0.00</span></strong></p>
                    <p><strong>Vuelto: S/. <span id="vuelto">0.00</span></strong></p>
                    <p><strong>TOTAL: S/. <span id="total">0.00</span></strong></p>
                </div>
            </form>
        </div>

        <!-- Summary Section -->
        <div class="summary-section">
            <h2>Total Venta: S/. {{ number_format($totalVenta), 2 }}</h2>
            <form action="{{ route('ventas.guardarVenta') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="codigo">Nro Venta</label>
                    <input type="text" id="codigo" name="codigo" value="{{ $nuevoCodigo }}" readonly>
                </div>

                <div class="form-group">
                    <label for="id_cliente" class="form-label">Cliente</label>
                    <select name="id_cliente" id="id_cliente" class="form-control" required>
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="document">Documento</label>
                    <select id="document" name="id_documento" required>
                        @foreach ($documento as $doc)
                            <option value="{{ $doc->id }}">{{ $doc->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="payment-type">Tipo de Pago</label>
                    <select id="payment-type" name="id_pago" required>
                        @foreach ($tipopago as $tpago)
                            <option value="{{ $tpago->id }}">{{ $tpago->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-success mt-4">Realizar Venta</button>
            </form>
        </div>
    </div>

    <style>
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

        .main-section .search-bar {
            margin-bottom: 10px;
        }

        .main-section input[type="text"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .main-section .form-group-row {
            display: flex;
            gap: 10px;
            margin-bottom: 10px
        }

        .main-section .input-text {
            width: 50%;
            height: 45px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 8px;
            font-size: 16px;
        }

        .main-section .buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-bottom: 20px;
        }

        .main-section .buttons button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            font-size: 14px;
        }

        .main-section .buttons .btn-primary {
            background-color: #007bff;
        }

        .main-section .buttons .btn-danger {
            background-color: #dc3545;
        }

        .main-section table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
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

        .summary-section {
            flex: 1;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .summary-section h2 {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border-radius: 5px;
            font-size: 18px;
        }

        .summary-section .form-group {
            margin-bottom: 15px;
        }

        .summary-section .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .summary-section .form-group input,
        .summary-section .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .summary-section .totals {
            margin-top: 20px;
        }

        .summary-section .totals p {
            margin: 5px 0;
            font-size: 16px;
        }

        .summary-section .totals p strong {
            color: #dc3545;
        }

        #suggestions {
            max-height: 200px;
            overflow-y: auto;
            width: 100%;
        }

        .suggestion-item {
            padding: 10px;
            cursor: pointer;
        }

        .suggestion-item:hover {
            background-color: #f0f0f0;
        }
    </style>

    <script>
        $(document).ready(function() {
            // Evento de escritura en el campo de búsqueda
            $('#product-search').on('input', function() {
                let query = $(this).val(); // Obtener el texto ingresado

                if (query.length > 2) { // Buscar solo si hay al menos 3 caracteres
                    $.ajax({
                        url: '{{ route('ventas.autocompletar') }}', // Ruta del backend
                        method: 'GET',
                        data: {
                            query: query
                        },
                        success: function(response) {
                            let suggestions = '';
                            response.forEach(producto => {
                                suggestions += `
                        <div class="suggestion-item" 
                             data-id="${producto.id}" 
                             data-descripcion="${producto.descripcion}" 
                             data-precio="${producto.precio_venta}"> <!-- Asegúrate de usar 'precio_venta' aquí -->
                            ${producto.descripcion}
                        </div>`;
                            });

                            $('#suggestions').html(suggestions).show(); // Mostrar sugerencias
                        }
                    });
                } else {
                    $('#suggestions').hide(); // Ocultar si no hay suficiente texto
                }
            });

            // Manejar clic en una sugerencia
            $(document).on('click', '.suggestion-item', function() {
                const id_producto = $(this).data('id');
                const descripcion = $(this).data('descripcion');
                const precio = $(this).data('precio');

                console.log("Descripción seleccionada:", descripcion);
                console.log("Precio seleccionado:", precio);

                $('#product-search').val(descripcion); // Opcional: completar el campo de búsqueda
                $('#descripcion').val(descripcion);
                $('#precio_venta').val(precio);
                $('#id_producto').val(id_producto);
                $('#suggestions').hide(); // Ocultar las sugerencias

                console.log("Descripción actualizada:", $('#descripcion').val());
                console.log("Precio actualizado:", $('#precio_venta').val());
            });

            // Opcional: cerrar sugerencias al hacer clic fuera
            $(document).click(function(e) {
                if (!$(e.target).closest('.search-bar').length) {
                    $('#suggestions').hide();
                }
            });
        });

        function calcularVuelto(){

            let efectivoRecibido = parseFloat(document.getElementById('received').value);
            let 

        }
    </script>
@endsection
