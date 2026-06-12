<!DOCTYPE html>
<html>
<head>

    <title>Login</title>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

</head>
<body>

<div class="container">

    <h1>CRM Productos</h1>

    @if(session('error'))
        <p>{{ session('error') }}</p>
    @endif

    <form action="{{ route('auth') }}" method="POST">

        @csrf

        <input
            type="email"
            name="correo"
            placeholder="Correo"
            required>

        <input
            type="password"
            name="password"
            placeholder="Contraseña"
            required>

        <button type="submit">
            Ingresar
        </button>

    </form>

</div>

</body>
</html>