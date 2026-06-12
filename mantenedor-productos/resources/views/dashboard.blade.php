<!DOCTYPE html>
<html>
<head>

    <title>Dashboard</title>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

</head>
<body>

<h1>Dashboard</h1>

<p>
Bienvenido {{ session('usuario') }}
</p>

<a href="{{ route('productos.index') }}">
    Mantenedor Productos
</a>

<form action="{{ route('logout') }}" method="POST">

    @csrf

    <button type="submit">
        Cerrar Sesión
    </button>

</form>

</body>
</html>