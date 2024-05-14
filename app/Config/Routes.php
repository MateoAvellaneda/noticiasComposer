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
$routes->get('/editarnoticia/(:num)', 'editor\EditarNoticia::index/$1');
$routes->post('/editarnoticia/editar/(:num)', 'editor\EditarNoticia::editar/$1');
$routes->get('/deshacer/(:num)', 'editor\DeshacerCambio::deshacerCambio/$1');
$routes->get('/descartar/(:num)', 'editor\DescartarNoticia::descartar/$1');
$routes->get('/enviarValidar/(:num)', 'editor\EnviarValidar::enviarValidar/$1');
$routes->get('/noticiasValidar', 'validador\NoticiasParaValidar::noticiasParaValidar');
$routes->get('/publicar/(:num)', 'validador\PublicarNoticia::publicarNoticia/$1');
$routes->get('/misValidaciones', 'validador\MisValidaciones::misValidaciones');