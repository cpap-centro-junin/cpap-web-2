<h1>Bienvenido, {{ auth()->user()->name }}</h1>

<form action="/logout" method="POST">
    @csrf
    <button type="submit">Cerrar sesión</button>
</form>
