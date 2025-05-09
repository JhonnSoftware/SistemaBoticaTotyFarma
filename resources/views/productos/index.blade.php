@extends('layouts.plantilla') <!-- Esto extiende la plantilla base -->

@section('title', 'Modulo Productos') <!-- Cambia el título de la página -->

@section('content')
    <ol class="breadcrumb mb-4 pt-3">
        <li class="breadcrumb-item active">Productos</li>
    </ol>

    <div class="row pb-3">
        <!-- Total de productos registrados -->
        <div class="col-xl-3 col-md-6">
            <div class="card custom-bg-purple text-white">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="fw-bold mb-0">{{ $productosEnStock }}</h3>
                            <p class="mb-0">Productos en Stock</p>
                        </div>
                        <i class="fas fa-box fa-3x"></i> <!-- Ícono de caja para productos en stock -->
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center text-white-50">
                    <span>More info</span>
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
        </div>
    
        <!-- Productos sin stock -->
        <div class="col-xl-3 col-md-6">
            <div class="card custom-bg-purple text-white">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="fw-bold mb-0">{{ $productosSinStock }}</h3>
                            <p class="mb-0">Productos Sin Stock</p>
                        </div>
                        <i class="fas fa-exclamation-circle fa-3x"></i> <!-- Ícono de advertencia para sin stock -->
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center text-white-50">
                    <span>More info</span>
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
        </div>
    
        <!-- Producto más vendido -->
        <div class="col-xl-3 col-md-6">
            <div class="card custom-bg-purple text-white">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="fw-bold mb-0 text-truncate" style="max-width: 200px;">
                                {{ $productoMasVendido->descripcion ?? 'N/A' }}
                            </h3>
                            <p class="mb-0">Producto Más Vendido</p>
                        </div>
                        <i class="fas fa-star fa-3x"></i> <!-- Ícono de estrella para producto más vendido -->
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center text-white-50">
                    <span>More info</span>
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
        </div>
    
        <!-- Productos inactivos -->
        <div class="col-xl-3 col-md-6">
            <div class="card custom-bg-purple text-white">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="fw-bold mb-0 text-truncate" style="max-width: 200px;">
                                {{ $productosInactivos }}
                            </h3>
                            <p class="mb-0">Productos Inactivos</p>
                        </div>
                        <i class="fas fa-ban fa-3x"></i> <!-- Ícono de prohibición para productos inactivos -->
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center text-white-50">
                    <span>More info</span>
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
        </div>
    </div>

    <a href="{{ route('productos.registrar') }}" class="btn btn-primary mb-2">
        <i class="fas fa-plus"></i> Nuevo Producto
    </a>
    <a href="{{ route('productos.detalles') }}" class="btn btn-primary mb-2">
        <i class="fas fa-eye"></i> Ver Detalles
    </a>

    <table class="table" id="tblProductos">
        <thead class="thead-dark">
            <tr class="bg-dark">
                <th class="text-white">Id</th>
                <th class="text-white">Codigo</th>
                <th class="text-white">Descripcion</th>
                <th class="text-white">Stock Minimo</th>
                <th class="text-white">P.Compra</th>
                <th class="text-white">P.Venta</th>
                <th class="text-white">Stock</th>
                <th class="text-white">Foto</th>
                <th class="text-white">Estado</th>
                <th class="text-white">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($productos as $producto)
                <tr>
                    <td>{{ $producto->id }}</td>
                    <td>{{ $producto->codigo }}</td>
                    <td>{{ $producto->descripcion }}</td>
                    <td>{{ $producto->stock_minimo}}</td>
                    <td>{{ $producto->precio_compra }}</td>
                    <td>{{ $producto->precio_venta }}</td>
                    <td>{{ $producto->cantidad }}</td>
                    <td>
                        @if($producto->foto)
                            <img src="{{ asset('storage/' . $producto->foto) }}" alt="Foto de Producto" width="50" height="50">
                        @else
                            <span>No disponible</span>
                        @endif
                    </td>
                    <td>{{ $producto->estado }}</td>
                    <td>
                        @if($producto->estado == 'Activo')
                            <a href="{{ route('productos.editar', $producto->id) }}" class="btn btn-sm btn-warning">Editar</a>
                            <a href="{{ route('productos.eliminar', $producto->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que quieres marcar este producto como inactivo?');">Eliminar</a>
                        @else
                            <a href="{{ route('productos.reingresar', $producto->id) }}" class="btn btn-sm btn-success">Reingresar</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Incluir jQuery y DataTables con Bootstrap 5 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#tblProductos').DataTable({
                paging: true,
                lengthChange: true,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/Spanish.json' // Para español
                },
                dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                     "<'row'<'col-sm-12'tr>>" +
                     "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                buttons: [
                    {
                        extend: 'copy',
                        text: '<span><i class="fas fa-copy"></i> Copiar</span>',
                        attr: { class: 'btn btn-primary d-flex align-items-center' }
                    },
                    {
                        extend: 'excelHtml5',
                        title: 'Clientes',
                        text: '<span><i class="fas fa-file-excel"></i> Excel</span>',
                        attr: { class: 'btn btn-success d-flex align-items-center' }
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'Clientes',
                        text: '<span><i class="fas fa-file-pdf"></i> PDF</span>',
                        attr: { class: 'btn btn-danger d-flex align-items-center' }
                    },
                    {
                        extend: 'print',
                        text: '<span><i class="fas fa-print"></i> Imprimir</span>',
                        attr: { class: 'btn btn-light d-flex align-items-center' }
                    }
                ]
            });
        });
    </script>

    <style>
        .dt-buttons {
            display: flex;
            gap: 10px; /* Espacio entre botones */
            margin-left: 10px;
        }

        .custom-bg-purple {
            background-color: #6f42c1; /* Morado (puedes ajustar el código de color si es necesario) */
        }
    </style>
@endsection