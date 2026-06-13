@extends('layouts.app')

@section('contenido')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h3 class="mb-0">
            Catálogo de Productos y Planes Funerarios
        </h3>

        <a href="{{ route('productos.create') }}"
           class="btn btn-success">

            Nuevo Producto

        </a>

    </div>

    <div class="card-body">

        {{-- Mensaje después de crear o actualizar --}}
        @if (session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @endif

        {{-- Buscador --}}
        <form method="GET"
              action="{{ route('productos.index') }}"
              class="mb-3">

            <div class="row">

                <div class="col-md-9">

                    <input
                        type="text"
                        name="buscar"
                        class="form-control"
                        placeholder="Buscar producto o plan funerario..."
                        value="{{ $buscar ?? '' }}">

                </div>

                <div class="col-md-2">

                    <button
                        type="submit"
                        class="btn btn-primary w-100">

                        Buscar

                    </button>

                </div>

                <div class="col-md-1">

                    <a href="{{ route('productos.index') }}"
                       class="btn btn-secondary w-100">

                        Limpiar

                    </a>

                </div>

            </div>

        </form>

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Acciones</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse ($productos as $producto)

                        <tr>

                            <td>
                                {{ $producto->id }}
                            </td>

                            <td>
                                {{ $producto->nombre }}
                            </td>

                            <td>
                                {{ $producto->categoria }}
                            </td>

                            <td>
                                {{ number_format(
                                    (float) $producto->precio,
                                    0,
                                    ',',
                                    '.'
                                ) }} CLP
                            </td>

                            <td>
                                {{ $producto->stock }}
                            </td>

                            <td>
                                {{ $producto->descripcion }}
                            </td>

                            <td>

                                @if ($producto->estado)

                                    <span class="badge bg-success">
                                        Activo
                                    </span>

                                @else

                                    <span class="badge bg-danger">
                                        Inactivo
                                    </span>

                                @endif

                            </td>

                            <td>

                                <div class="d-flex gap-1 flex-wrap">

                                    <button
                                        type="button"
                                        class="btn btn-sm cambiar-estado
                                        {{ $producto->estado
                                            ? 'btn-danger'
                                            : 'btn-success' }}"
                                        data-id="{{ $producto->id }}"
                                        data-estado="{{ $producto->estado }}">

                                        {{ $producto->estado
                                            ? 'Desactivar'
                                            : 'Activar' }}

                                    </button>

                                    <a
                                        href="{{ route(
                                            'productos.edit',
                                            $producto->id
                                        ) }}"
                                        class="btn btn-primary btn-sm">

                                        Editar

                                    </a>

                                    <a
                                        href="{{ route(
                                            'precios.index',
                                            $producto->id
                                        ) }}"
                                        class="btn btn-info btn-sm">

                                        Precios

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8"
                                class="text-center py-4">

                                No se encontraron productos o planes funerarios.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection