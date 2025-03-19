<?php

namespace Controllers;

use MVC\Router;
use Model\Servicio;
use Model\Cita;
use Model\CitaServicio;

class APIController
{
    public static function index()
    {
        //Obtener todos los servicios y transformarlos a JSON (estos pueden ser visibles entrando al enlace /api/servicios)

        $servicio = Servicio::all();

        echo json_encode($servicio);
    }

    public static function guardar()
    {
        // Almacenar un servicio enviado mediante POST
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();

        $id = $resultado['id'];

        // Almacena los Servicios con el ID de la Cita
        $idServicios = explode(",", $_POST['servicios']);
        foreach ($idServicios as $idServicio) {
            $args = [
                'citaId' => $id,
                'servicioId' => $idServicio
            ];
            $citaServicio = new CitaServicio($args);
            $citaServicio->guardar();
        }


        // Devolver la respuesta como JSON
        echo json_encode(['resultado' => $resultado]);
    }

    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener el ID de la cita a eliminar
            $id = $_POST['id'];

            // Eliminar la cita
            $cita = Cita::find($id);
            $cita->eliminar();


            header('Location:' . $_SERVER['HTTP_REFERER']);
            // Devolver la respuesta como JSON
            //echo json_encode(['resultado' => 'Cita eliminada']);
        }
    }
}
