<h1 class="nombre-pagina">OLVIDE MI CONTRASEÑA</h1>
<p class="descripcion-pagina">Ingresa tu e-mail para recuperar tu contraseña</p>

<?php include_once __DIR__ . '/../templates/alertas.php' ?>

<form method="POST" class="formulario" action="/forget">
    <div class="campo">
        <label for="email">E-mail:</label>
        <input
            type="email"
            id="email"
            placeholder="Tu e-mail"
            name="email">
    </div>
    <input type="submit" class="boton boton-verde" value="Recuperar Contraseña">
</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia Sesion</a>
    <a href="/create-account">¿Aun no tienes una cuenta? Crea una nueva</a>
</div>