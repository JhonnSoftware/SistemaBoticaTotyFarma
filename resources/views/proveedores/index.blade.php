@extends('layouts.plantilla') <!-- Esto extiende la plantilla base -->

@section('title', 'Modulo Proveedores') <!-- Cambia el título de la página -->

@section('content')
    <ol class="breadcrumb mb-4 pt-3">
        <li class="breadcrumb-item active">Modulo Proveedores</li>
    </ol>

    <div class="row pb-3">
        <!-- Proveedores nuevos -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="fw-bold mb-0">{{ $proveedoresNuevos }}</h3>
                            <p class="mb-0">Proveedores nuevos</p>
                        </div>
                        <i class="fas fa-user-plus fa-3x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center text-white-50">
                    <span>More info</span>
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
        </div>
    
        <!-- Proveedores activos -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="fw-bold mb-0">{{ $proveedoresActivos }}</h3>
                            <p class="mb-0">Proveedores activos</p>
                        </div>
                        <i class="fas fa-handshake fa-3x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center text-white-50">
                    <span>More info</span>
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
        </div>
    
        <!-- Proveedores inactivos -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="fw-bold mb-0">{{ $proveedoresInactivos }}</h3>
                            <p class="mb-0">Proveedores inactivos</p>
                        </div>
                        <i class="fas fa-user-slash fa-3x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center text-white-50">
                    <span>More info</span>
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
        </div>
    
        <!-- Proveedor más recurrente -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="fw-bold mb-0 text-truncate" style="max-width: 200px;">
                                {{ $proveedorRecurrente->nombre ?? 'N/A' }}
                            </h3>
                            <p class="mb-0">Proveedor recurrente</p>
                        </div>
                        <i class="fas fa-chart-line fa-3x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center text-white-50">
                    <span>More info</span>
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
        </div>
    </div>

    <a href="{{ route('proveedores.registrar') }}" class="btn btn-primary mb-2">
        <i class="fas fa-plus"></i> Nuevo Proveedor
    </a>

    <a href="{{ route('proveedores.seleccionarMensaje') }}" class="btn btn-primary mb-2">
        <i class="fas fa-envelope"></i> Enviar mensaje a proveedor
    </a>

    <!--
    <a href="{{ route('proveedores.enviarMensajeProveedor') }}" class="btn btn-primary mb-2">
        Enviar mensaje de prueba
    </a>-->
    
    <table class="table" id="tblProveedores">
        <thead class="thead-dark">
            <tr class="bg-dark">
                <th class="text-white">Id</th>
                <th class="text-white">RUC</th>
                <th class="text-white">Nombre</th>
                <th class="text-white">Telefono</th>
                <th class="text-white">Correo</th>
                <th class="text-white">Direccion</th>
                <th class="text-white">Estado</th>
                <th class="text-white">Acciones</th>
            </tr>
        </thead>

        <tbody>

            @foreach($proveedores as $proveedor)
            <tr>
                <td>{{ $proveedor->id }}</td>
                <td>{{ $proveedor->ruc }}</td>
                <td>{{ $proveedor->nombre }}</td>
                <td>{{ $proveedor->telefono }}</td>
                <td>{{ $proveedor->correo }}</td>
                <td>{{ $proveedor->direccion }}</td>
                <td>{{ $proveedor->estado }}</td>
                <td>
                    @if($proveedor->estado == 'Activo')
                        <a href="{{ route('proveedores.editar', $proveedor->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <a href="{{ route('proveedores.eliminar', $proveedor->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que quieres marcar este proveedor como inactivo?');">Eliminar</a>
                    @else
                        <a href="{{ route('proveedores.reingresar', $proveedor->id) }}" class="btn btn-sm btn-success">Reingresar</a>
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
            $('#tblProveedores').DataTable({
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
    </style>

@endsection