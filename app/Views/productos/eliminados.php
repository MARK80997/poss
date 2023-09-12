<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?php echo $titulo;?></h1>
            <div>
                <p>
                    <a href="<?php echo base_url();?>productos" class="btn btn-warning">Volver a Unidades</a>
                </p>
            </div>
          
            <div class="card mb-4">
               
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                            <th>id</th>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Precio Venta</th>
                            <th>Existencias</th>
                            <th></th>
                            <th></th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($datos as $dato) { ?>
                                <tr>
                                    <td> <?php echo $dato['id']; ?></td>
                                    <td> <?php echo $dato['codigo']; ?></td>
                                    <td> <?php echo $dato['nombre']; ?></td>
                                    <td> <?php echo $dato['precio_venta']; ?></td>
                                    <td> <?php echo $dato['existencias']; ?></td>
                                    <td>  <a href="<?php echo base_url().'productos/reingresar/'.$dato['id'];?>" class="btn btn-warning" >Reactivar!!</a> </td>
                                   
                                </tr>

                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

