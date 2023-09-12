<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?php echo $titulo;?></h1>
            <div>
                <p>
                    <a href="<?php echo base_url(); ?>unidadesDos/" class="btn btn-warning" >Volver a Unidades</a>
                </p>
            </div>
          
            <div class="card mb-4">
               
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Nombre</th>
                                <th>Nombre Corto</th>
                                <th></th>
                                <th></th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($datos as $dato) { ?>
                                <tr>
                                    <td> <?php echo $dato['id']; ?></td>
                                    <td> <?php echo $dato['nombre']; ?></td>
                                    <td> <?php echo $dato['nombre_corto']; ?></td>
                                    <td>  <a disabled class="btn btn-warning" disabled>Reactivar!!</a> </td>
                                   
                                </tr>

                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

