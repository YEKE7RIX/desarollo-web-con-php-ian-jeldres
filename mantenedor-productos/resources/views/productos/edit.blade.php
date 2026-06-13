@extends('layouts.app')

@section('contenido')

<div class="card">

    <div class="card-header">

        <h3>Editar Producto</h3>

    </div>

    <div class="card-body">

        <form
        action="{{ route('productos.update',$producto->id) }}"
        method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label>Nombre</label>

                <input
                type="text"
                name="nombre"
                class="form-control"
                value="{{ $producto->nombre }}">

            </div>

            <div class="mb-3">

                <label>Categoría</label>

                <input
                type="text"
                name="categoria"
                class="form-control"
                value="{{ $producto->categoria }}">

            </div>

            <div class="mb-3">

                <label>Precio</label>

                <input
                type="number"
                name="precio"
                class="form-control"
                value="{{ $producto->precio }}">

            </div>

            <div class="mb-3">

                <label>Stock</label>

                <input
                type="number"
                name="stock"
                class="form-control"
                value="{{ $producto->stock }}">

            </div>

            <div class="mb-3">

                <label>Descripción</label>

                <textarea
                name="descripcion"
                class="form-control">{{ $producto->descripcion }}</textarea>

            </div>

            <button
            class="btn btn-success">

            Guardar Cambios

            </button>

        </form>

    </div>

</div>

@endsection