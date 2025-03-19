<h1 class="nombre-pagina">CREAR CUENTA</h1>
<p class="descripcion-pagina">Llena el siguiente formulario para crear una cuenta</p>

<?php include_once __DIR__ . '/../templates/alertas.php' ?>

<form action="/create-account" class="formulario" method="POST">
    <div class="campo">
        <label for="name">Nombre:</label>
        <input
            type="text"
            id="name"
            placeholder="Tu nombre"
            name="nombre"
            value="<?php echo s($usuario->nombre); ?>">
    </div>
    <div class="campo">
        <label for="lastname">Apellido:</label>
        <input
            type="text"
            id="lastname"
            placeholder="Tu apellido"
            name="apellido"
            value="<?php echo s($usuario->apellido); ?>">
    </div>

    <div class="campo">
        <label for="phone">Telefono:</label>
        <input
            type="tel"
            id="phone"
            placeholder="Tu telefono"
            name="telefono"
            value="<?php echo s($usuario->telefono); ?>">
    </div>

    <div class="campo">
        <label for="email">E-mail:</label>
        <input
            type="email"
            id="email"
            placeholder="Tu e-mail"
            name="email"
            value="<?php echo s($usuario->email); ?>">
    </div>
    <div class="campo">
        <label for="password">Contraseña:</label>
        <input
            type="password"
            id="password"
            placeholder="Tu contraseña"
            name="password">
    </div>
    <input type="submit" class="boton boton-verde" value="Crear Cuenta">
</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia Sesion</a>
    <a href="/forget">¿Olvidaste tu contraseña?</a>
</div>