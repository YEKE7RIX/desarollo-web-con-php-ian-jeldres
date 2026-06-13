@extends('layouts.app')

@section('contenido')

<div class="row">

    <div class="col-lg-4">

        <div class="small-box text-bg-primary">

            <div class="inner">

                <h3>{{ $totalProductos }}</h3>

                <p>Total Productos</p>

            </div>

        </div>

    </div>

    <div class="col-lg-4">

        <div class="small-box text-bg-success">

            <div class="inner">

                <h3>{{ $productosActivos }}</h3>

                <p>Productos Activos</p>

            </div>

        </div>

    </div>

    <div class="col-lg-4">

        <div class="small-box text-bg-danger">

            <div class="inner">

                <h3>{{ $productosInactivos }}</h3>

                <p>Productos Inactivos</p>

            </div>

        </div>

    </div>

</div>

@endsection