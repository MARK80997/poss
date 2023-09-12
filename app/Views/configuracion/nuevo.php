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
                 
            <form method="POST" action="<?php echo base_url();?>/unidades/insertar" >
                <?php csrf_field();?>
                <div class="form-group">
                    <label for="exampleInputEmail1">NOMBRE</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="nombre" value="<?php echo set_value('nombre');?>" >
                </div>
                <div class="form-group">
                    <label for="example">NOMBBRE CORTO</label>
                    <input type="text" class="form-control" id="example" name="nombre_corto" value="<?php echo set_value('nombre_corto');?>"  >
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a class="btn btn-primary" href="<?php echo base_url();?>/unidades">Salir!!</a>
            </form> 
           
          
        </div>
    </main>