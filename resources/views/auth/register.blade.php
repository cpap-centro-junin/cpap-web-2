<h2>Crear cuenta</h2>

<form action="/register" method="POST">
    @csrf

    <label>Nombre</label><br>
    <input type="text" name="name" required><br><br>

    <label>Email</label><br>
    <input type="email" name="email" required><br><br>

    <label>Contraseña</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Registrarse</button>
</form>
