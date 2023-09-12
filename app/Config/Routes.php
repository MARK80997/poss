<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
//$routes->setDefaultController('Home');
$routes->setDefaultController('usuarios');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//$routes->get('/', 'Home::index');
$routes->get('/', 'usuarios::login');
//$routes->get('/usuarios/valida', 'usuarios::login');

$routes->get('/unidades', 'Unidades::index');
$routes->get('/unidades/nuevo', 'Unidades::nuevo');
$routes->post('/unidades/insertar', 'Unidades::insertar');
$routes->get('/unidades/editar/(:any)', 'Unidades::editar/$1');
$routes->post('/unidades/actualizar', 'Unidades::actualizar');
$routes->get('/unidades/eliminar/(:any)', 'Unidades::eliminar/$1');
$routes->get('/unidades/eliminados', 'Unidades::eliminados');
$routes->get('/unidades/reingresar/(:any)', 'Unidades::reingresar/$1');


$routes->get('/unidadesDos', 'unidadesDos::index');
$routes->get('/unidadesDos/nuevo', 'unidadesDos::nuevo');
$routes->post('/unidadesDos/insertar', 'unidadesDos::insertar');
$routes->get('/unidadesDos/editar/(:any)', 'unidadesDos::editar/$1');
$routes->post('/unidadesDos/actualizar', 'unidadesDos::actualizar');
$routes->get('/unidadesDos/eliminar/(:any)', 'unidadesDos::eliminar/$1');
$routes->get('/unidadesDos/eliminados', 'unidadesDos::eliminados');
$routes->get('/unidadesDos/reingresar/(:any)', 'unidadesDos::reingresar/$1');




$routes->get('/categorias', 'Categorias::index');
$routes->get('/categorias/nuevo', 'Categorias::nuevo');
$routes->post('/categorias/insertar', 'Categorias::insertar');
$routes->get('/categorias/editar/(:any)', 'Categorias::editar/$1');
$routes->post('/categorias/actualizar', 'Categorias::actualizar');
$routes->get('/categorias/eliminar/(:any)', 'Categorias::eliminar/$1');
$routes->get('/categorias/eliminados', 'Categorias::eliminados');
$routes->get('/categorias/reingresar/(:any)', 'Categorias::reingresar/$1');



$routes->get('/productos', 'Productos::index');
$routes->get('/productos/nuevo', 'Productos::nuevo');
$routes->post('/productos/insertar', 'Productos::insertar');
$routes->get('/productos/editar/(:any)', 'Productos::editar/$1');
$routes->post('/productos/actualizar', 'Productos::actualizar');
$routes->get('/productos/eliminar/(:any)', 'Productos::eliminar/$1');
$routes->get('/productos/eliminados', 'Productos::eliminados');
$routes->get('/productos/reingresar/(:any)', 'Productos::reingresar/$1');

    
$routes->get('/productosDos', 'productosDos::index');
$routes->get('/productosDos/nuevo', 'productosDos::nuevo');
$routes->post('/productosDos/insertar', 'productosDos::insertar');
$routes->get('/productosDos/editar/(:any)', 'productosDos::editar/$1');
$routes->post('/productosDos/actualizar', 'productosDos::actualizar');
$routes->get('/productosDos/eliminar/(:any)', 'productosDos::eliminar/$1');
$routes->get('/productosDos/eliminados', 'productosDos::eliminados');
$routes->get('/productosDos/reingresar/(:any)', 'productosDos::reingresar/$1');



   
$routes->get('/clientes', 'Clientes::index');
$routes->get('/clientes/nuevo', 'Clientes::nuevo');
$routes->post('/clientes/insertar', 'Clientes::insertar');
$routes->get('/clientes/editar/(:any)', 'Clientes::editar/$1');
$routes->post('/clientes/actualizar', 'Clientes::actualizar');
$routes->get('/clientes/eliminar/(:any)', 'Clientes::eliminar/$1');
$routes->get('/clientes/eliminados', 'Clientes::eliminados');
$routes->get('/clientes/reingresar/(:any)', 'Clientes::reingresar/$1');




$routes->get('/configuracion', 'Configuracion::index');
$routes->get('/configuracion/nuevo', 'Configuracion::nuevo');
$routes->post('/configuracion/insertar', 'Configuracion::insertar');
$routes->get('/configuracion/editar/(:any)', 'Configuracion::editar/$1');
$routes->post('/configuracion/actualizar', 'Configuracion::actualizar');
$routes->get('/configuracion/eliminar/(:any)', 'Configuracion::eliminar/$1');
$routes->get('/configuracion/eliminados', 'Configuracion::eliminados');
$routes->get('/configuracion/reingresar/(:any)', 'Configuracion::reingresar/$1');






$routes->get('/usuarios', 'Usuarios::index');
$routes->get('/usuarios/nuevo', 'Usuarios::nuevo');
$routes->post('/usuarios/insertar', 'Usuarios::insertar');
$routes->get('/usuarios/editar/(:any)', 'Usuarios::editar/$1');
$routes->post('/usuarios/actualizar', 'Usuarios::actualizar');
$routes->get('/usuarios/eliminar/(:any)', 'Usuarios::eliminar/$1');
$routes->get('/usuarios/eliminados', 'Usuarios::eliminados');
$routes->get('/usuarios/reingresar/(:any)', 'Usuarios::reingresar/$1');
$routes->post('/usuarios/valida', 'Usuarios::valida');
$routes->get('/usuarios/logout', 'Usuarios::logout');
$routes->get('/usuarios/cambia_pasword', 'Usuarios::cambia_pasword');
$routes->post('/usuarios/actualiza_pasword', 'Usuarios::actualiza_pasword');
$routes->get('/usuarios/excel', 'Usuarios::excel');

$routes->get('/usuarios/pdf', 'Usuarios::pdf');



$routes->get('/compras', 'Compras::index');
$routes->get('/compras/nuevo', 'Compras::nuevo');
$routes->post('/compras/insertar', 'Compras::insertar');
$routes->get('/compras/editar/(:any)', 'Compras::editar/$1');
$routes->post('/compras/actualizar', 'Compras::actualizar');
$routes->get('/compras/eliminar/(:any)', 'Compras::eliminar/$1');
$routes->get('/compras/eliminados', 'Compras::eliminados');
$routes->get('/compras/reingresar/(:any)', 'Compras::reingresar/$1');



//$routes->get('/compras', 'compras::index');


//$routes->get('/', 'Crud::index');
//$routes->get('/obtenerNombre/(:any)', 'Crud::obtenerNombre/$1');
//$routes->get('/eliminar/(:any)', 'Crud::eliminar/$1');
//$routes->post('/crear', 'Crud::crear');
//$routes->post('/actualizar', 'Crud::actualizar');



/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
