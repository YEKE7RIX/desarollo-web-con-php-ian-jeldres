<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CRM Funeraria</title>

    <link rel="stylesheet"
          href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">

</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">

<div class="app-wrapper">

    <nav class="app-header navbar navbar-expand bg-body">

        <ul class="navbar-nav">

            <li class="nav-item">

                <a class="nav-link">
                    CRM Funeraria
                </a>

            </li>

        </ul>

        <ul class="navbar-nav ms-auto">

            <li class="nav-item">

                <form action="{{ route('logout') }}"
                      method="POST">

                    @csrf

                    <button class="btn btn-danger btn-sm">

                        Cerrar Sesión

                    </button>

                </form>

            </li>

        </ul>

    </nav>

    <aside class="app-sidebar bg-body-secondary shadow">

        <div class="sidebar-brand">

            <a href="#" class="brand-link">

                <span class="brand-text">

                    Funeraria

                </span>

            </a>

        </div>

        <div class="sidebar-wrapper">

            <nav>

                <ul class="nav sidebar-menu flex-column">

                    <li class="nav-item">

                        <a href="{{ route('dashboard') }}"
                           class="nav-link">

                            Dashboard

                        </a>

                    </li>

                    <li class="nav-item">

                        <a href="{{ route('productos.index') }}"
                           class="nav-link">

                            Planes y Servicios

                        </a>

                    </li>

                </ul>

            </nav>

        </div>

    </aside>

    <main class="app-main">

        <div class="app-content">

            <div class="container-fluid mt-3">

                @yield('contenido')

            </div>

        </div>

    </main>

</div>

<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('js/productos.js') }}"></script>

</body>
</html>