<h1 class="nombre-pagina">Recupera tu contraseña</h1>
<p class="descripcion-pagina">Coloca tu nueva contraseña a continuacion</p>

<?php include_once __DIR__ . '/../templates/alertas.php' ?>

<?php if($error) return ?>

<form method="POST" class="formulario">
    
    <div class="campo">
        <label for="password">Contraseña:</label>
        <input
            type="password"
            id="password"
            placeholder="Tu nueva contraseña"
            name="password">
    </div>
    <div class="campo">
        <label for="confirmar">Confirmar Contraseña:</label>
        <input
            type="password"
            id="confirmar"
            placeholder="Confirma tu nueva contraseña"
            name="confirmar">
    </div>
    <input type="submit" class="boton boton-verde" value="Guardar Contraseña">

    <div class="acciones">
    <a href="/">Volver al inicio</a>
    
    </div>

</form>