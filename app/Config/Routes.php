<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/iniciarsesion', 'anonimo\IniciarSesion::index');
$routes->get('/registrarse', 'anonimo\Registrarse::index');
$routes->post('/iniciarsesion/iniciarsesion', 'anonimo\IniciarSesion::iniciarSesion');
$routes->post('/registrarse/registrarusuario', 'anonimo\Registrarse::registrarUsuario');
$routes->get('/crearnoticia', 'editor\CrearNoticia::index');
$routes->post('/crearnoticia/guardar', 'editor\CrearNoticia::guardar');
$routes->get('/cerrarsesion', 'CerrarSesion::cerrarSesion');
$routes->get('/misnoticias', 'editor\MisNoticias::index');
$routes->get('/misnoticias/(:any)', 'editor\MisNoticias::index/$1');
$routes->get('/editarnoticia/(:num)', 'editor\EditarNoticia::index/$1');
$routes->post('/editarnoticia/editar/(:num)', 'editor\EditarNoticia::editar/$1');
$routes->get('/deshacer/(:num)', 'editor\DeshacerCambio::deshacerCambio/$1');
$routes->get('/descartar/(:num)', 'editor\DescartarNoticia::descartar/$1');
$routes->get('/enviarValidar/(:num)', 'editor\EnviarValidar::enviarValidar/$1');
$routes->get('/enviarCorreccion/(:num)', 'editor\EnviarCorreccion::enviarCorreccion/$1');
$routes->get('/noticiasValidar', 'validador\NoticiasParaValidar::noticiasParaValidar');
$routes->get('/publicar/(:num)', 'validador\PublicarNoticia::publicarNoticia/$1');
$routes->post('/rechazar', 'validador\RechazarNoticia::rechazarNoticia');
$routes->get('/misValidaciones', 'validador\MisValidaciones::misValidaciones');
$routes->get('/listarNoticias/(:num)', 'ListarNoticias::vistaNoticias/$1');
$routes->get('/verNoticia/(:num)', 'VerNoticia::verNoticia/$1');
$routes->get('/verHistorial/(:num)', 'editor\VerHistorial::VerHistorial/$1');
$routes->get('/activar/(:num)', 'editor\ActivarNoticia::activar/$1');
$routes->get('/desactivar/(:num)', 'editor\DesactivarNoticia::desactivar/$1');