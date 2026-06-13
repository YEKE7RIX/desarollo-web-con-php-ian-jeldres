@extends('layouts.app')

@section('contenido')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <div>
            <h3 class="mb-1">Historial de Precios</h3>
            <strong>{{ $producto->nombre }}</strong>
        </div>

        <a href="{{ route('productos.index') }}"
           class="btn btn-secondary">

            Volver al Catálogo

        </a>

    </div>

    <div class="card-body">

        @if (session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @endif

        @if ($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <div class="alert alert-info">

            <strong>Precio vigente:</strong>

            {{ number_format((float) $producto->precio, 0, ',', '.') }} CLP

        </div>

        <form
            action="{{ route('precios.store', $producto->id) }}"
            method="POST">

            @csrf

            <div class="row align-items-end">

                <div class="col-md-6">

                    <label class="form-label">
                        Nuevo precio
                    </label>

                    <input
                        type="number"
                        name="precio"
                        class="form-control"
                        min="0"
                        step="0.01"
                        value="{{ old('precio') }}"
                        placeholder="Ingrese el nuevo precio"
                        required>

                </div>

                <div class="col-md-3">

                    <button
                        type="submit"
                        class="btn btn-success w-100">

                        Registrar Nuevo Precio

                    </button>

                </div>

            </div>

        </form>

        <hr>

        <div class="table-responsive">

            <table class="table table-bordered table-hover">

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Precio</th>
                        <th>Fecha de Inicio</th>
                        <th>Fecha de Término</th>
                        <th>Estado</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse ($precios as $precio)

                        <tr>

                            <td>{{ $precio->id }}</td>

                            <td>
                                {{ number_format((float) $precio->precio, 0, ',', '.') }} CLP
                            </td>

                            <td>
                                {{ $precio->fecha_inicio->format('d-m-Y') }}
                            </td>

                            <td>
                                {{ $precio->fecha_fin
                                    ? $precio->fecha_fin->format('d-m-Y')
                                    : '—' }}
                            </td>

                            <td>

                                @if (is_null($precio->fecha_fin))

                                    <span class="badge bg-success">
                                        Vigente
                                    </span>

                                @else

                                    <span class="badge bg-secondary">
                                        Histórico
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="text-center">

                                Este producto todavía no tiene precios
                                registrados en el historial.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection