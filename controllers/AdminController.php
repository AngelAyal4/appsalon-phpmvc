<?php

namespace Controllers;

use MVC\Router;
use Model\AdminCita;


class AdminController
{
    public static function index(Router $router)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        isAdmin(); //Verfifica si el usuario es administrador

        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        $fechas = explode('-', $fecha);
        if (!checkdate($fechas[1], $fechas[2], $fechas[0])) {
            header('Location: /ERROR404');
        }

        //Consulta a la BD para traer la info a mostrar
        $consulta = "SELECT citas.id, citas.hora, CONCAT( usuarios.nombre, ' ', usuarios.apellido) as cliente, ";
        $consulta .= " usuarios.email, usuarios.telefono, servicios.nombre as servicio, servicios.precio  ";
        $consulta .= " FROM citas  ";
        $consulta .= " LEFT OUTER JOIN usuarios ";
        $consulta .= " ON citas.usuarioId=usuarios.id  ";
        $consulta .= " LEFT OUTER JOIN citasServicios ";
        $consulta .= " ON citasServicios.citaId=citas.id ";
        $consulta .= " LEFT OUTER JOIN servicios ";
        $consulta .= " ON servicios.id=citasServicios.servicioId ";
        $consulta .= " WHERE fecha = '" . $fecha . "' ";

        $cita = AdminCita::SQL($consulta);

        //debuguear($cita);

        // Lógica para la vista de administración
        $router->render('admin/index', [
            // Datos a pasar a la vista
            'nombre' => $_SESSION['nombre'],
            'citas' => $cita,
            'idCita' => $idCita ?? null, // Asegúrate de definir $idCita o pasar null si no está definido
            'fecha' => $fecha
        ]);
    }
}
