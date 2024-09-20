<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\APIController;
use MVC\Router;
use Controllers\AuthController;
use Controllers\CitasController;
use Controllers\CitasProfesionalController;
use Controllers\DashboardController;
use Controllers\DisciplinaController;
use Controllers\PaginasController;
use Controllers\ProfesionalesController;
use Controllers\RegistradosController;
use Controllers\UsuariosController;

$router = new Router();


// ÁREA DE AUTENTIFICACIÓN Y REGISTRO USUARIOS
//Login y logout
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);
$router->post('/logout', [AuthController::class, 'logout']);

// Crear Cuenta
$router->get('/registro', [AuthController::class, 'registro']);
$router->post('/registro', [AuthController::class, 'registro']);

// Formulario de olvide mi password
$router->get('/olvide', [AuthController::class, 'olvide']);
$router->post('/olvide', [AuthController::class, 'olvide']);

// Colocar el nuevo password
$router->get('/reestablecer', [AuthController::class, 'reestablecer']);
$router->post('/reestablecer', [AuthController::class, 'reestablecer']);

// Confirmación de Cuenta
$router->get('/mensaje', [AuthController::class, 'mensaje']);
$router->get('/confirmar-cuenta', [AuthController::class, 'confirmar']);


//ÁREA DE ADMINISTRACIÓN
//Inicio panel de administación
$router->get('/admin/dashboard', [DashboardController::class, 'index']);

//Parte de los profesionales
$router->get('/admin/profesionales', [ProfesionalesController::class, 'index']);
$router->get('/admin/profesionales/crear', [ProfesionalesController::class, 'crear']);
$router->post('/admin/profesionales/crear', [ProfesionalesController::class, 'crear']);
$router->get('/admin/profesionales/editar', [ProfesionalesController::class, 'editar']);
$router->post('/admin/profesionales/editar', [ProfesionalesController::class, 'editar']);
$router->post('/admin/profesionales/eliminar', [ProfesionalesController::class, 'eliminar']);

//Parte de las disciplinas
$router->get('/admin/disciplinas', [DisciplinaController::class, 'index']);
$router->get('/admin/disciplinas/crear', [DisciplinaController::class, 'crear']);
$router->post('/admin/disciplinas/crear', [DisciplinaController::class, 'crear']);
$router->get('/admin/disciplinas/editar', [DisciplinaController::class, 'editar']);
$router->post('/admin/disciplinas/editar', [DisciplinaController::class, 'editar']);
$router->post('/admin/disciplinas/eliminar', [DisciplinaController::class, 'eliminar']);

//Parte de los usuarios
$router->get('/admin/registrados', [RegistradosController::class, 'index']);
$router->get('/admin/registrados/editar', [RegistradosController::class, 'editar']);
$router->post('/admin/registrados/editar', [RegistradosController::class, 'editar']);
$router->post('/admin/registrados/eliminar', [RegistradosController::class, 'eliminar']);

//Parte de los citas
$router->get('/admin/citas', [CitasController::class, 'inicio']);
$router->get('/admin/citas/editar', [CitasController::class, 'editar']);
$router->post('/admin/citas/editar', [CitasController::class, 'editar']);
$router->post('/admin/citas/eliminar', [CitasController::class, 'eliminar']);

//ÁREA PÚBLICA
$router->get('/', [PaginasController::class, 'index']);
$router->get('/snoezelen', [PaginasController::class, 'hacemos']);
$router->get('/disciplinas', [PaginasController::class, 'disciplinas']);
$router->get('/registrarse', [PaginasController::class, 'registrarse']);

//Registro Profesionales
$router->get('/profesionales/profesionales', [PaginasController::class, 'profesionales']);

$router->get('/profesionales/registro-profesionales', [PaginasController::class, 'regprof']);
$router->post('/profesionales/registro-profesionales', [PaginasController::class, 'regprof']);

$router->get('/profesionales/mensaje-profesionales', [PaginasController::class, 'mensajeprof']);
$router->get('/profesionales/confirmar-profesionales', [PaginasController::class, 'confirmarprof']);

$router->get('/profesionales/finRegistro', [PaginasController::class, 'finalizar']);
$router->post('/profesionales/finRegistro', [PaginasController::class, 'finalizar']);

$router->get('/profesionales/login-profesionales', [PaginasController::class, 'loginprof']);
$router->post('/profesionales/login-profesionales', [PaginasController::class, 'loginprof']);
$router->post('/profesionales/logout-profesionales', [PaginasController::class, 'logoutprof']);

$router->get('/profesionales/olvide-profesionales', [PaginasController::class, 'olvideprof']);
$router->post('/profesionales/olvide-profesionales', [PaginasController::class, 'olvideprof']);

$router->get('/profesionales/reestablecer-profesionales', [PaginasController::class, 'reestablecerprof']);
$router->post('/profesionales/reestablecer-profesionales', [PaginasController::class, 'reestablecerprof']);

//ÁREA USUARIOS
$router->get('/citas/index', [CitasController::class, 'index']);
$router->get('/usuarios/index', [UsuariosController::class, 'index']);
$router->get('/usuarios/citasConfirmadas', [UsuariosController::class, 'citasConfirmadas']);
$router->get('/usuarios/datos', [UsuariosController::class, 'datos']);
$router->post('/usuarios/datos', [UsuariosController::class, 'datos']);
$router->post('/usuarios/citasConfirmadas/eliminar', [UsuariosController::class, 'eliminar']);


//AREA PROFESIONALES
$router->get('/profesionales/index', [CitasProfesionalController::class, 'index']);
$router->get('/profesionales/citas', [CitasProfesionalController::class, 'citas']);
$router->get('/profesionales/citas-total', [CitasProfesionalController::class, 'citasTotal']);
$router->get('/profesionales/datos', [CitasProfesionalController::class, 'datos']);
$router->post('/profesionales/datos', [CitasProfesionalController::class, 'datos']);
$router->post('/profesionales/citas-total/eliminar', [CitasProfesionalController::class, 'eliminar']);

//API
$router->get('/api/profesionales', [APIController::class, 'index']);
$router->get('/api/disciplinas', [APIController::class, 'disciplinas']);
$router->post('/api/citas', [APIController::class, 'guardar']);

$router->comprobarRutas();