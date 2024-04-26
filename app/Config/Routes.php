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