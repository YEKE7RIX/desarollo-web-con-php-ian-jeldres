@extends('layouts.app')

@section('contenido')

<div class="card">

    <div class="card-header">

        <h3>Nuevo Producto o Plan Funerario</h3>

    </div>

    <div class="card-body">

        <form action="{{ route('productos.store') }}"
              method="POST">

            @csrf

            <div class="mb-3">

                <label class="form-label">

                    Nombre

                </label>

                <input
                    type="text"
                    name="nombre"
                    class="form-control"
                    required>

            </div>

            <div class="mb-3">

                <label class="form-label">

                    Categoría

                </label>

                <select
                    name="categoria"
                    class="form-control">

                    <option>Planes</option>
                    <option>Urnas</option>
                    <option>Lápidas</option>
                    <option>Flores</option>
                    <option>Accesorios</option>

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
                    required>

            </div>

            <div class="mb-3">

                <label class="form-label">

                    Descripción

                </label>

                <textarea
                    name="descripcion"
                    class="form-control"></textarea>

            </div>

            <button
                type="submit"
                class="btn btn-success">

                Guardar

            </button>

            <a href="{{ route('productos.index') }}"
               class="btn btn-secondary">

               Volver

            </a>

        </form>

    </div>

</div>

@endsection