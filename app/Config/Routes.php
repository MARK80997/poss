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
$routes->setDefaultController('Usuarios');
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
$routes->get('/', 'Usuarios::login');
//$routes->get('/usuarios/valida', 'usuarios::login');

$routes->get('/usuarios', 'usuarios::index');
$routes->get('/usuarios/nuevo', 'usuarios::nuevo');
$routes->post('/usuarios/insertar', 'usuarios::insertar');
$routes->get('/usuarios/editar/(:any)', 'usuarios::editar/$1');
$routes->post('/usuarios/actualizar', 'usuarios::actualizar');
$routes->get('/usuarios/eliminar/(:any)', 'usuarios::eliminar/$1');
$routes->get('/usuarios/eliminados', 'usuarios::eliminados');
$routes->get('/usuarios/reingresar/(:any)', 'usuarios::reingresar/$1');
$routes->post('/usuarios/valida', 'usuarios::valida');
$routes->get('/usuarios/logout', 'usuarios::logout');
$routes->get('/usuarios/cambia_pasword', 'usuarios::cambia_pasword');
$routes->post('/usuarios/actualiza_pasword', 'usuarios::actualiza_pasword');
//RUTAS AJAX
$routes->get('/usuarios', 'usuarios::index'); //SE DEBE VOLVER A UN ENLACE NAVEGABLE SIN RECARGAR LA PÁGINA
$routes->post('/usuarios/insertar', 'usuarios::insertar');
$routes->post('/usuarios/buscar', 'usuarios::buscar');
$routes->post('/usuarios/actualizar', 'usuarios::actualizar');
$routes->post('/usuarios/eliminar', 'usuarios::eliminar');
$routes->get('/usuarios/obtenerDatos', 'usuarios::obtenerDatos');
$routes->get('/usuarios/obtenerDatosEliminados', 'usuarios::obtenerDatosEliminados');
$routes->post('/usuarios/reingresarDatosEliminados', 'usuarios::reingresarDatosEliminados');
//ACTUALIZANDO PASSWORD
$routes->post('/usuarios/actualizaPas', 'usuarios::actualizaPas');
$routes->post('/usuarios/actualizaPasUsu', 'usuarios::actualizaPasUsu');
//LECTURAQR
$routes->post('/usuarios/buscar', 'usuarios::buscar');



//RUTAS ANTIGUAS DEL SISTEMA (REALIZABA LOS CRUDS PERO RECARGANDO LA PÁGINA)
$routes->get('/productos/nuevo', 'productos::nuevo');
$routes->get('/productos/editar/(:any)', 'productos::editar/$1');
$routes->get('/productos/eliminar/(:any)', 'productos::eliminar/$1');
$routes->get('/productos/reingresar/(:any)', 'productos::reingresar/$1');
//RUTAS AJAX!!
$routes->get('/productos', 'productos::index'); //SE DEBE VOLVER A UN ENLACE NAVEGABLE SIN RECARGAR LA PÁGINA
$routes->post('/productos/insertar', 'productos::insertar');
$routes->post('/productos/buscar', 'productos::buscar');
$routes->post('/productos/actualizar', 'productos::actualizar');
$routes->post('/productos/eliminar', 'productos::eliminar');
$routes->get('/productos/obtenerDatos', 'productos::obtenerDatos');
$routes->get('/productos/obtenerDatosEliminados', 'productos::obtenerDatosEliminados');
$routes->post('/productos/reingresarDatosEliminados', 'productos::reingresarDatosEliminados');
//LECTURAQR
$routes->post('/productos/lecturaqr', 'productos::lecturaqr');




// RUTAS AJAX
$routes->get('/categorias', 'categorias::index'); //SE DEBE VOLVER A UN ENLACE NAVEGABLE SIN RECARGAR LA PÁGINA
$routes->post('/categorias/insertar', 'categorias::insertar');
$routes->post('/categorias/buscar', 'categorias::buscar');
$routes->post('/categorias/actualizar', 'categorias::actualizar');
$routes->post('/categorias/eliminar', 'categorias::eliminar');
$routes->get('/categorias/obtenerDatos', 'categorias::obtenerDatos');
$routes->get('/categorias/obtenerDatosEliminados', 'categorias::obtenerDatosEliminados');
$routes->post('/categorias/reingresarDatosEliminados', 'categorias::reingresarDatosEliminados');
//LECTURAQR
$routes->get('/categorias/obtenerCategorias', 'categorias::obtenerCategorias');




// RUTAS AJAX!!
$routes->get('/clientes', 'clientes::index'); //SE DEBE VOLVER A UN ENLACE NAVEGABLE SIN RECARGAR LA PÁGINA
$routes->post('/clientes/insertar', 'clientes::insertar');
$routes->post('/clientes/buscar', 'clientes::buscar');
$routes->post('/clientes/actualizar', 'clientes::actualizar');
$routes->post('/clientes/eliminar', 'clientes::eliminar');
$routes->get('/clientes/obtenerDatos', 'clientes::obtenerDatos');
$routes->get('/clientes/obtenerDatosEliminados', 'clientes::obtenerDatosEliminados');
$routes->post('/clientes/reingresarDatosEliminados', 'clientes::reingresarDatosEliminados');





$routes->get('/ventas', 'ventas::index');
$routes->get('/ventas/nuevo', 'ventas::nuevo');
$routes->post('/ventas/insertar', 'ventas::insertar');
$routes->get('/ventas/editar/(:any)', 'ventas::editar/$1');
$routes->post('/ventas/actualizar', 'ventas::actualizar');
$routes->get('/ventas/eliminar/(:any)', 'ventas::eliminar/$1');
$routes->get('/ventas/eliminados', 'ventas::eliminados');
$routes->get('/ventas/reingresar/(:any)', 'ventas::reingresar/$1');
//RUTAS AJAX
$routes->post('/ventas/prueba', 'ventas::prueba'); //SIN USO!!
$routes->post('/ventas/transaccion', 'ventas::transaccion');
$routes->get('/ventas/pdf', 'ventas::pdf');


//RUTAS ESPECÍFICAS PARA REPORTES DE TODO TIPO
$routes->get('/reportes', 'reportes::index');
//RUTA AJAX PARA BUSCAR PRODUCTO ATRAVÉZ DE UN RANGO DE FECHAS 
$routes->post('/reportes/buscarProductoFecha', 'reportes::buscarProductoFecha');
$routes->post('/reportes/generarReporte', 'reportes::generarReporte');
$routes->post('/reportes/literalTotal', 'reportes::literalTotal');
$routes->post('/reportes/productoMasVendido', 'reportes::productoMasVendido');
$routes->post('/reportes/verDetalleVenta', 'reportes::verDetalleVenta');




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
