<!--Para implementar AJAX en CodeIgniter 4, puedes utilizar las funciones
 y clases nativas de JavaScript para las solicitudes (como XMLHttpRequest 
 o fetch) o utilizar bibliotecas de JavaScript más avanzadas como 
 jQuery para facilitar el manejo de las solicitudes AJAX.-->

<!-- Además, en CodeIgniter 4, puedes crear controladores y rutas específicas
 para manejar las solicitudes AJAX y devolver respuestas en formato JSON, XML
  o cualquier otro formato que necesites.

En resumen, AJAX en CodeIgniter 4 te permite mejorar la interactividad 
y la usabilidad de tu aplicación al permitirte realizar operaciones asíncronas
 entre el cliente y el servidor, sin recargar la página completa.
Es una herramienta poderosa para crear aplicaciones web modernas y dinámicas.  -->

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?php echo $titulo; ?></h1>
            <div>
                <p>
                    <a href="<?php base_url(); ?>compras/nuevo" class="btn btn-info">Agregar</a>
                    <a href="<?php base_url(); ?>/compras" class="btn btn-warning">Eliminados</a>
                </p>
            </div>

            <div class="card mb-4">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Nombre</th>
                            <th>Nombre Corto</th>
                            <th></th>
                            <th></th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($datos as $dato) { ?>
                            <tr>
                                <td> <?php echo $dato['id']; ?></td>
                                <td> <?php echo $dato['nombre']; ?></td>
                                <td> <?php echo $dato['nombre_corto']; ?></td>
                                <td> <a href="<?php echo base_url() . 
                                    'compras/editar/' . $dato['id']; ?>" class="btn btn-warning"> Editar</a></td>

                                <td> <a href="<?php echo base_url() .
                                    'compras/eliminar/' . $dato['id']; ?>" class="btn btn-danger">Eliminar</a></td>
                                <td>

                                </td>
                            </tr>

                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>


    <!-- Si O SI SE TIENE QUE CREAR UNA VISTA  Y UN CONTROLADOR PARA UN AVENTANA MODAL
        COMO INDICA EN CODEIGNITER -->