<h1 class="nombre-pagina">Crear nueva cita</h1>
<p class="descripcion-pagina">Elige tus servicios y coloca tus datos</p>

<?php
    include_once __DIR__ . '/../templates/barra.php'
?>

<div id="app">
    <nav class="tabs">
        <button class="actual" type="button" data-paso="1">Servicios</button>
        <button type="button" data-paso="2">Informacion Cita</button>
        <button type="button" data-paso="3">Resumen</button>
    </nav>
    <div class="seccion" id="paso-1">
        <h2>Servicios</h2>
        <p class="text-center">Elige tus servicios a continuacion</p>
        <div class="listado-servicios" id="servicios"></div>
    </div>
    <div class="seccion" id="paso-2">
        <h2>Tus Datos y Cita</h2>
        <p class="text-center">Coloca tus datos y fecha de tu cita</p>

        <form action="/cita" method="POST" class="formulario
        formulario-cita">
            <div class="campo">
                <label for="nombre">Nombre:</label>
                <input
                    type="text"
                    id="nombre"
                    placeholder="Tu nombre"
                    name="nombre"
                    value="<?php echo $nombre; ?>"
                    disabled>
            </div>
            <div class="campo">
                <label for="telefono">Telefono:</label>
                <input
                    type="tel"
                    id="telefono"
                    placeholder="Tu telefono"
                    name="telefono">
            </div>
            <div class="campo">
                <label for="fecha">Fecha:</label>
                <input
                    type="date"
                    id="fecha"
                    name="fecha"
                    min="<?php echo date('Y-m-d', strtotime('+1 day')/*en el caso de que el cliente solicite que no se pueda reservar el dia actual*/); ?>">

            </div>
            <div class="campo">
                <label for="hora">Hora:</label>
                <input
                    type="time"
                    id="hora"
                    name="hora">
            </div>
            <input type="hidden" id="id" value="<?php echo $id; ?>">
    </div>
    <div class="seccion contenido-resumen" id="paso-3">
        <h2>Resumen</h2>
        <p class="text-center">Verifica tu cita y confirma</p>
    </div>
    <div class="paginacion">
        <button
            id="anterior"
            class="boton boton-verde"
            type="button"
            data-paso="1">&laquo; Anterior</button>

        <button
            id="siguiente"
            class="boton boton-verde"
            type="button"
            data-paso="1">Siguiente &raquo;</button>
    </div>
</div>

<?php
$script = '
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="build/js/app.js"></script>';
?>