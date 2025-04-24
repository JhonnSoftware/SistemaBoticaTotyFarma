<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title', 'Dashboard - SB Admin')</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" /> -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS (Bundle incluye Popper.js) -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- (Nombre de la empresa) -->
        <a class="navbar-brand ps-3" href="index.html">Boticas D'Toty Farma</a>

        <!-- (Esta son las tres barritas)-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Div para alinear las ul a la derecha -->
        <div class="ms-auto d-flex align-items-center me-5">
            <!-- Ícono de notificaciones -->
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link text-white dropdown-toggle" href="#" id="notificationsIcon" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-bell"></i>
                        <span class="badge bg-danger">{{ $notificaciones->count() }}</span> <!-- Cantidad de notificaciones -->
                    </a>
                    <div class="dropdown-menu dropdown-menu-end p-2 shadow-lg" aria-labelledby="notificationsIcon" style="min-width: 300px;">
                        <h6 class="dropdown-header text-danger">Notificaciones de Advertencia</h6>
                        <hr class="dropdown-divider">
                        @if ($notificaciones->isEmpty())
                            <div class="text-center text-muted">No hay notificaciones</div>
                        @else
                            @foreach ($notificaciones as $notificacion)
                                <a href="#" class="dropdown-item d-flex align-items-start">
                                    <i class="fas fa-exclamation-triangle text-danger me-2"></i>
                                    <span>{{ $notificacion->message }}</span>
                                </a>
                            @endforeach
                        @endif
                        <hr class="dropdown-divider">
                        <a href="{{ route('productos.notificaciones.leer') }}" class="dropdown-item text-center text-primary">
                            Marcar todas como leídas
                        </a>
                    </div>
                </li>
            </ul>

            <!-- Menú de usuario (con imagen y nombre) -->
            <ul class="navbar-nav ms-3">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" id="userDropdown" href="#"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('storage/' . auth()->user()->foto) }}" alt="Usuario" class="rounded-circle"
                            style="width: 40px; height: 40px; object-fit: cover;">
                        <span class="text-white ms-2 ">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar
                                Sesión</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

        <!-- Formulario oculto para cerrar sesión -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </nav>

    <style>
        .dropdown-menu-custom {
            transform: translateX(-150px); /* Ajusta este valor según lo que necesites */
        }
    </style>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">ADMINISTRACION</div>
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt text-primary"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-cogs text-primary"></i></div>
                            Administracion
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('users.index') }}"><i
                                        class="fas fa-user mr-2 text-primary"></i>Usuarios</a>
                                <a class="nav-link" href="{{ route('arqueos.index') }}"><i
                                        class="fas fa-box mr-2 text-primary"></i>Cajas</a>
                            </nav>
                        </div>

                        <div class="sb-sidenav-menu-heading">VENTAS Y COMPRAS</div>

                        <a class="nav-link" href="{{ route('clientes.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-users text-primary"></i></div>
                            Clientes
                        </a>
                        <a class="nav-link" href="{{ route('proveedores.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-truck text-primary"></i></div>
                            Proveedores
                        </a>
                        <a class="nav-link" href="{{ route('categorias.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-cubes text-primary"></i></div>
                            Categorias
                        </a>
                        <a class="nav-link" href="{{ route('productos.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-boxes text-primary"></i></div>
                            Productos
                        </a>

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseCompras" aria-expanded="false" aria-controls="collapseCompras">
                            <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart text-primary"></i></div>
                            Entradas
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseCompras" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('compras.index') }}"><i
                                        class="fas fa-tag mr-2 text-primary"></i>Nueva Compra</a>
                                <a class="nav-link" href="{{ route('compras.lista') }}"><i
                                        class="fas fa-list mr-2 text-primary"></i>Historial Compras</a>
                            </nav>
                        </div>

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseVentas" aria-expanded="false" aria-controls="collapseCompras">
                            <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart text-primary"></i></div>
                            Salidas
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseVentas" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('ventas.index') }}"><i
                                        class="fas fa-shopping-cart mr-2 text-primary"></i>Nueva Venta</a>
                                <a class="nav-link" href="{{ route('ventas.lista') }}"><i
                                        class="fas fa-list mr-2 text-primary"></i>Historial Ventas</a>
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">CONTROL DE INVENTARIO</div>
                        <a class="nav-link" href="{{ route('movimientos.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tasks text-primary"></i></div>
                            Movimientos
                        </a>
                        <a class="nav-link" href="">
                            <div class="sb-nav-link-icon"><i class="fas fa-tasks text-primary"></i></div>
                            Reportes
                        </a>
                    </div>
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    @yield('content') <!-- Aquí se incluirá el contenido específico de cada vista -->
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Sistema de Gestion de Ventas y Compras</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
</body>


</html>
