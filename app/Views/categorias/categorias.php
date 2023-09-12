<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?php echo $titulo;?></h1>
            <div>
                <p>
                    <a href="<?php base_url();?>categorias/nuevo" class="btn btn-info">Agregar</a>
                    <a href="<?php base_url();?>categorias/eliminados" class="btn btn-warning">Eliminados</a>
                </p>
            </div>
          
            <div class="card mb-4">
               
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                              
                                <th>Nombre</th>
                                
                                <th></th>
                                <th></th>
                                <th></th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($datos as $dato) { ?>
                                <tr>
                                   
                                    <td> <?php echo $dato['nombre']; ?></td>
                                   
                                    <td>  <a href="<?php echo base_url().'categorias/editar/'.$dato['id'];?>" class="btn btn-warning" > Editar</a> </td>
                                    <td>  <a href="<?php echo base_url().'categorias/eliminar/'.$dato['id'];?>" class="btn btn-danger">Eliminar</a></td>
                                    <td> </td>
                                </tr>

                            <?php } ?>



                           

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

