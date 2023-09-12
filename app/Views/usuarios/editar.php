<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?php echo $titulo; ?></h1>
            <!-- ESTO ES PARA LISTAR LOS ERRORES DE LA PÁGINA  -->
            <?php if(isset($validation)) { ?>
                    <div class="alert alert-danger">
                        <?php echo $validation->listErrors(); ?>
                    </div>
            <?php } ?>

            <form method="POST" action="<?php echo base_url(); ?>/usuarios/actualizar">
                
                <input type="hidden" id="id" name="id"  value="<?php echo $datos['id']; ?>" /> 
              
                <div class="form-group">
                    <label for="example">Nombre</label>
                    <input type="text" class="form-control" id="example" name="nombre" value="<?php echo $datos['nombre'];?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Dirección</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="direccion" value="<?php echo $datos['direccion'];?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Teléfono</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="telefono" value="<?php echo $datos['telefono'];?>">
                </div>
                <div class="form-group">
                    <label for="example">Correo</label>
                    <input type="text" class="form-control" id="example" name="correo" value="<?php echo $datos['correo'];?>">
                </div>       
                <br>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a class="btn btn-primary" href="<?php echo base_url(); ?>/usuarios">Salir!!</a>
            </form>

        </div>
    </main>