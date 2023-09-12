<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?php echo $titulo; ?></h1>
            <div>
                <p>
                    <a href="<?php base_url(); ?>productosDos/nuevo" class="btn btn-info">Agregar</a>
                    <a href="<?php base_url(); ?>productosDos/eliminados" class="btn btn-warning">Eliminados</a>
                </p>
            </div>

            <div class="card mb-4">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Precio Venta</th>
                            <th>Precio Compra</th>
                            
                            <th></th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($datos as $dato) { ?>
                            <tr>
                                <td> <?php echo $dato['id']; ?></td>
                                <td> <?php echo $dato['codigo']; ?></td>
                                <td> <?php echo $dato['nombre']; ?></td>
                                <td> <?php echo $dato['precio_venta']; ?></td>
                                <td> <?php echo $dato['precio_compra']; ?></td>
                                
                                <td> <a href="<?php echo base_url() . 
                                    'productosDos/editar/' . $dato['id']; ?>" class="btn btn-warning"> Editar</a> </td>

                                <td> <a href="" class="btn btn-danger" >Eliminar</a></td>
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

