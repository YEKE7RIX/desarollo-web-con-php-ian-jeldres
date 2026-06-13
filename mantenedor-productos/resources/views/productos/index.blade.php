@extends('layouts.app')

@section('contenido')

<div class="card">

    <div class="card-header d-flex justify-content-between">

        <h3>Catálogo de Productos y Planes Funerarios</h3>

        <a href="{{ route('productos.create') }}"
           class="btn btn-success">

           Nuevo Producto

        </a>

    </div>

    <div class="card-body">

    <form method="GET" action="{{ route('productos.index') }}" class="mb-3">

        <div class="row">

            <div class="col-md-10">

                <input
                    type="text"
                    name="buscar"
                    class="form-control"
                    placeholder="Buscar producto o plan funerario..."
                    value="{{ $buscar ?? '' }}">

            </div>

            <div class="col-md-2">

                <button class="btn btn-primary w-100">
                    Buscar
                </button>

            </div>

        </div>

    </form>

        <table class="table table-bordered">

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

            @foreach($productos as $producto)

                <tr>

                    <td>{{ $producto->id }}</td>

                    <td>{{ $producto->nombre }}</td>

                    <td>{{ $producto->categoria }}</td>

                    <td>${{ $producto->precio }}</td>

                    <td>{{ $producto->stock }}</td>

                    <td>{{ $producto->descripcion }}</td>

                    <td>

                        @if($producto->estado)

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

                    <button
                    class="btn btn-sm cambiar-estado
                    {{ $producto->estado ? 'btn-danger' : 'btn-success' }}"
                    data-id="{{ $producto->id }}"
                    data-estado="{{ $producto->estado }}">
                    
                    {{ $producto->estado ? 'Desactivar' : 'Activar' }}
                </button>

                <a 
                href="{{ route('productos.edit', $producto->id) }}"
                class="btn btn-primary btn-sm">
                    Editar
                </a>

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection