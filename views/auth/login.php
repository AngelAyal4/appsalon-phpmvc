<h1 class="nombre-pagina">LOGIN</h1>
<p class="descripcion-pagina">Iniciar sesion con tus datos</p>

<?php include_once __DIR__ . '/../templates/alertas.php' ?>

<form method="POST" class="formulario" action="/">
    <div class="campo">
        <label for="email">E-mail:</label>
        <input
            type="email"
            id="email"
            placeholder="Tu e-mail"
            name="email">
    </div>
    <div class="campo">
        <label for="password">Contraseña:</label>
        <input
            type="password"
            id="password"
            placeholder="Tu contraseña"
            name="password">
    </div>
    <input type="submit" class="boton boton-verde" value="Iniciar Sesion">
</form>

<div class="acciones">
    <a href="/create-account">¿Aun no tienes una cuenta? Crea una nueva</a>
    <a href="/forget">¿Olvidaste tu contraseña?</a>
</div>