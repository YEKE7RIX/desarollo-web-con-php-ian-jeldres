@extends('layouts.app')

@section('contenido')

<div class="card">

    <div class="card-header">
        Nuevo Producto
    </div>

    <div class="card-body">

        <form action="{{ route('productos.store') }}"
              method="POST">

            @csrf

            <div class="mb-3">

                <label>Nombre</label>

                <input
                    type="text"
                    name="nombre"
                    class="form-control"
                    required>

            </div>

            <div class="mb-3">

                <label>Categoría</label>

                <input
                    type="text"
                    name="categoria"
                    class="form-control"
                    required>

            </div>

            <div class="mb-3">

                <label>Precio</label>

                <input
                    type="number"
                    name="precio"
                    class="form-control"
                    required>

            </div>

            <div class="mb-3">

                <label>Stock</label>

                <input
                    type="number"
                    name="stock"
                    class="form-control"
                    required>

            </div>

            <div class="mb-3">

                <label>Descripción</label>

                <textarea
                    name="descripcion"
                    class="form-control"></textarea>

            </div>

            <button
                type="submit"
                class="btn btn-primary">

                Guardar

            </button>

        </form>

    </div>

</div>

@endsection