<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?php echo $titulo; ?></h1>
            <div>
                <p>
                    <a href="<?php base_url(); ?>usuarios/nuevo" class="btn btn-info">Agregar</a>
                    <a href="<?php base_url(); ?>usuarios/eliminados" class="btn btn-warning">Eliminados</a>
                    <a href="<?php base_url(); ?>usuarios/excel" class="btn btn-warning">Excel</a>
                    <a href="<?php base_url(); ?>usuarios/pdf" class="btn btn-warning">PDF</a>
           
                </p>
            </div>

            <div class="card mb-4">
                <table id="datatablesSimple">
                    <thead>
                        <tr>


                            <th>Usuario</th>
                            <th>Nombre</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($datos as $dato) { ?>
                            <tr>

                                <td> <?php echo $dato['usuario']; ?></td>
                                <td> <?php echo $dato['nombre']; ?></td>

                                <td> <a href="<?php echo base_url() .
                                                    'usuarios/editar/' . $dato['id']; ?>" class="btn btn-warning"> Editar</a></td>

                                <td> <a href="<?php echo base_url() .
                                                    'usuarios/eliminar/' . $dato['id']; ?>" class="btn btn-danger">Eliminar</a></td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>


    <!-- Si O SI SE TIENE QUE CREAR UNA VISTA  Y UN CONTROLADOR PARA UN AVENTANA MODAL
        COMO INDICA EN CODEIGNITER -->