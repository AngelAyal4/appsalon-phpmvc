<h1 class="nombre-pagina">Panel de administracion</h1>

<?php
include_once __DIR__ . '/../templates/barra.php'
?>

<H2>Buscar Citas</H2>
<div class="busqueda">
    <form class="formulario">
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input
                type="date"
                id="fecha"
                name="fecha"
                value="<?php echo $fecha; ?>">
        </div>
    </form>
</div>

<?php
if (count($citas) === 0) {
    echo "<h2>No hay citas para esta fecha</h2>";
}
?>

<div id="citas-admin">
    <ul class="citas">
        <?php
        $idCita = 0;
        // Itera sobre el array de citas y muestra la información de cada cita
        foreach ($citas as $key => $cita) {
            // Si el ID de la cita actual es diferente al ID de la cita anterior
            if ($idCita !== $cita->id) {
                $total = 0;
        ?>
                <li>
                    <p>ID: <span><?php echo $cita->id ?></span></p>
                    <p>Hora: <span><?php echo $cita->hora ?></span></p>
                    <p>Cliente: <span><?php echo $cita->cliente ?></span></p>
                    <p>Email: <span><?php echo $cita->email ?></span></p>
                    <p>Telefono: <span><?php echo $cita->telefono ?></span></p>

                    <h3>Servicios</h3>

                <?php
                // Actualiza el ID de la cita actual
                $idCita = $cita->id;
            } // Fin del if 
            $total += $cita->precio;

                ?>
                <?php //Muestra los servicios correspondientes al id de la cita
                ?>
                <p class="servicio"><?php echo $cita->servicio . " " . $cita->precio; ?></p>


                <?php
                $actual = $cita->id;
                $proximo = $citas[$key + 1]->id ?? 0;
                if (esUltimo($actual, $proximo)) { ?>
                    <p class="servicio total">Total: <span><?php echo $total; ?></span></p>

                    <form action="/api/eliminar" method="POST">
                        <input type="hidden" name="id" value="<?php echo $cita->id; ?>">
                        <input type="submit" value="Eliminar" class="boton-eliminar">
                    </form>
            <?php }
            } // Fin del foreach 
            ?>
    </ul>
</div>

<?php
$script = "<script src='build/js/buscador.js'></script>";
?>