@extends('layouts.app')

@section('contenido')

<div class="card">

    <div class="card-header d-flex justify-content-between">

        <h3>Planes y Servicios Funerarios</h3>

        <a href="{{ route('productos.create') }}"
           class="btn btn-success">

           Nuevo Servicio

        </a>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead>

                <tr>

                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Estado</th>

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

                    <td>

                        @if($producto->estado)

                            Activo

                        @else

                            Inactivo

                        @endif

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection