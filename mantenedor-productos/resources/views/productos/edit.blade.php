@extends('layouts.app')

@section('contenido')

<div class="card">

    <div class="card-header">

        <h3>Editar Producto</h3>

    </div>

    <div class="card-body">

        @if ($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form
        action="{{ route('productos.update', $producto->id) }}"
        method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label class="form-label">

                    Nombre

                </label>

                <input
                type="text"
                name="nombre"
                class="form-control"
                value="{{ $producto->nombre }}"
                required>

            </div>

            <div class="mb-3">

                <label class="form-label">

                    Categoría

                </label>

                <select
                name="categoria"
                class="form-control"
                required>

                    <option value="Planes"
                    {{ $producto->categoria == 'Planes' ? 'selected' : '' }}>
                        Planes
                    </option>

                    <option value="Urnas"
                    {{ $producto->categoria == 'Urnas' ? 'selected' : '' }}>
                        Urnas
                    </option>

                    <option value="Lápidas"
                    {{ $producto->categoria == 'Lápidas' ? 'selected' : '' }}>
                        Lápidas
                    </option>

                    <option value="Flores"
                    {{ $producto->categoria == 'Flores' ? 'selected' : '' }}>
                        Flores
                    </option>

                    <option value="Accesorios"
                    {{ $producto->categoria == 'Accesorios' ? 'selected' : '' }}>
                        Accesorios
                    </option>

                </select>

            </div>

            <div class="mb-3">

                <label class="form-label">

                    Precio

                </label>

                <input
                type="number"
                name="precio"
                class="form-control"
                value="{{ $producto->precio }}"
                min="0"
                required>

            </div>

            <div class="mb-3">

                <label class="form-label">

                    Stock

                </label>

                <input
                type="number"
                name="stock"
                class="form-control"
                value="{{ $producto->stock }}"
                min="0"
                required>

            </div>

            <div class="mb-3">

                <label class="form-label">

                    Descripción

                </label>

                <textarea
                name="descripcion"
                class="form-control"
                rows="3"
                required>{{ $producto->descripcion }}</textarea>

            </div>

            <button
            type="submit"
            class="btn btn-success">

                Guardar Cambios

            </button>

            <a
            href="{{ route('productos.index') }}"
            class="btn btn-secondary">

                Volver

            </a>

        </form>

    </div>

</div>

@endsection