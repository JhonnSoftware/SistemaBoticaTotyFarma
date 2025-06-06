@extends('layouts.plantilla') <!-- Esto extiende la plantilla base -->

@section('title', 'Modulo Clientes') <!-- Cambia el título de la página -->

@section('content')
    <ol class="breadcrumb mb-4 pt-3">
        <li class="breadcrumb-item active">Modulo Clientes</li>
    </ol>

    <div class="row pb-3">

        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="fw-bold mb-0">{{ $clientesNuevos }}</h3>
                            <p class="mb-0">Nuevos Clientes</p>
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

        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="fw-bold mb-0">{{ $clientesActivos }}</h3>
                            <p class="mb-0">Clientes Activos</p>
                        </div>
                        <i class="fas fa-users fa-3x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center text-white-50">
                    <span>More info</span>
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="fw-bold mb-0">{{ $clientesInactivos }}</h3>
                            <p class="mb-0">Clientes Inactivos</p>
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

        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="fw-bold mb-0 text-truncate" style="max-width: 150px;">
                                {{ $clientesConMasVentas->nombre ?? 'N/A' }}
                            </h3>
                            <p class="mb-0">Clientes con mas ventas</p>
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

    <a href="{{ route('clientes.registrar') }}" class="btn btn-primary mb-2">
        <i class="fas fa-plus"></i> Nuevo Cliente
    </a>
 
    <table class="table pt-2 table-striped table-bordered" id="tblClientes">
        <thead class="thead-dark">
            <tr class="bg-dark">
                <th class="text-white">Id</th>
                <th class="text-white">DNI</th>
                <th class="text-white">Nombre</th>
                <th class="text-white">Teléfono</th>
                <th class="text-white">Dirección</th>
                <th class="text-white">Estado</th>
                <th class="text-white">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id }}</td>
                    <td>{{ $cliente->dni }}</td>
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>{{ $cliente->direccion }}</td>
                    <td>{{ $cliente->estado }}</td>
                    <td>
                        @if ($cliente->estado == 'Activo')
                            <a href="{{ route('clientes.editar', $cliente->id) }}"
                                class="btn btn-primary"><i class="fas fa-edit"></i>
                            </a>
                            <a href="{{ route('clientes.eliminar', $cliente->id) }}" class="btn btn-danger"
                                onclick="return confirm('¿Estás seguro de que quieres marcar este cliente como inactivo?');"><i class="fas fa-trash-alt"></i>
                            </a>
                        @else
                            <a href="{{ route('clientes.reingresar', $cliente->id) }}"
                                class="btn btn-success"><i class="fas fa-redo"></i>
                            </a>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        $(document).ready(function() {
            $('#tblClientes').DataTable({
                paging: true,
                lengthChange: true,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/Spanish.json' // Para español
                },
                dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                buttons: [{
                        extend: 'copy',
                        text: '<span><i class="fas fa-copy"></i> Copiar</span>',
                        attr: {
                            class: 'btn btn-primary d-flex align-items-center'
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        title: 'Clientes',
                        text: '<span><i class="fas fa-file-excel"></i> Excel</span>',
                        attr: {
                            class: 'btn btn-success d-flex align-items-center'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'Clientes',
                        text: '<span><i class="fas fa-file-pdf"></i> PDF</span>',
                        attr: {
                            class: 'btn btn-danger d-flex align-items-center'
                        }
                    },
                    {
                        extend: 'print',
                        text: '<span><i class="fas fa-print"></i> Imprimir</span>',
                        attr: {
                            class: 'btn btn-light d-flex align-items-center'
                        }
                    }
                ]
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            // Obtener el mensaje de éxito si existe
            var successMessage = document.getElementById('success-message').getAttribute('data-message');
            
            if (successMessage) {
                // Mostrar la alerta de SweetAlert2 si hay un mensaje
                Swal.fire({
                    title: "¡Exito!",
                    text: successMessage,
                    icon: "success",
                    draggable: true
                });
            }
        });
    </script>

    <style>
        .dt-buttons {
            display: flex;
            gap: 10px;
            /* Espacio entre botones */
            margin-left: 10px;
        }

        .text-truncate {
            white-space: nowrap;
            /* Evita que el texto se divida en varias líneas */
            overflow: hidden;
            /* Oculta el contenido que exceda el ancho */
            text-overflow: ellipsis;
            /* Agrega "..." al final del texto truncado */
            max-width: 100%;
            /* Asegura que el ancho máximo respete el contenedor */
            display: block;
            /* Asegura el comportamiento como un bloque */
        }
    </style>
    @if ($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var modal = new bootstrap.Modal(document.getElementById('agregarClienteModal'));
                modal.show();
            });
        </script>
    @endif


@endsection
