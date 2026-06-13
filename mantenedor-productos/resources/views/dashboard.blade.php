@extends('layouts.app')

@section('contenido')

<div class="row">

    <div class="col-lg-4">

        <div class="small-box text-bg-primary">

            <div class="inner">

                <h3>{{ \App\Models\Producto::count() }}</h3>

                <p>Total Productos y Planes</p>

            </div>

        </div>

    </div>

    <div class="col-lg-4">

        <div class="small-box text-bg-success">

            <div class="inner">

                <h3>{{ \App\Models\Producto::where('estado',1)->count() }}</h3>

                <p>Activos</p>

            </div>

        </div>

    </div>

    <div class="col-lg-4">

        <div class="small-box text-bg-danger">

            <div class="inner">

                <h3>{{ \App\Models\Producto::where('estado',0)->count() }}</h3>

                <p>Inactivos</p>

            </div>

        </div>

    </div>

</div>

@endsection