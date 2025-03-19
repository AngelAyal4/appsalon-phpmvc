<?php

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\LoginController;
use Controllers\CitaController;
use Controllers\APIController;
use Controllers\AdminController;
use Controllers\ServicioController;
use Model\Servicio;

$router = new Router();

//Iniciar Sesion
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

//Recuperar Contraseña
$router->get('/forget', [LoginController::class, 'forget']);
$router->post('/forget', [LoginController::class, 'forget']);
$router->get('/recover', [LoginController::class, 'recover']);
$router->post('/recover', [LoginController::class, 'recover']);

//Crear Cuentas
$router->get('/create-account', [LoginController::class, 'create']);
$router->post('/create-account', [LoginController::class, 'create']);

//Confirmar Cuenta
$router->get('/confirmar-cuenta', [LoginController::class, 'confirmar']);
$router->get('/mensaje', [LoginController::class, 'mensaje']);

//Panel de Control
$router->get('/cita', [CitaController::class, 'cita']);
$router->get('/admin', [AdminController::class, 'index']);

//API de citas
$router->get('/api/servicios', [APIController::class, 'index']); //Definde la ruta del endpoint de la API
$router->post('/api/citas', [APIController::class, 'guardar']);
$router->post('/api/eliminar', [APIController::class, 'eliminar']);

//CRUD de servicios
$router->get('/servicios', [ServicioController::class, 'index']);
$router->get('/servicios/crear', [ServicioController::class, 'crear']);
$router->post('/servicios/crear', [ServicioController::class, 'crear']);
$router->get('/servicios/actualizar', [ServicioController::class, 'actualizar']);
$router->post('/servicios/actualizar', [ServicioController::class, 'actualizar']);
$router->post('/servicios/eliminar', [ServicioController::class, 'eliminar']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
