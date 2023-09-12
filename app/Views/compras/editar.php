<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?php echo $titulo; ?></h1>

            <?php if(isset($validation)) { ?>
                    <div class="alert alert-danger">
                        <?php echo $validation->listErrors(); ?>
                    </div>
            <?php } ?>

            <form method="POST" action="<?php echo base_url();?>unidades/actualizar" >
                <input type="hidden" name="id" value="<?php echo $datos['id']?>"/>
             
                <div class="form-group">
                    <label for="exampleInputEmail1">NOMBRE</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="nombre" autofocus  value="<?php echo $datos['nombre']?> " >
                </div>
                <div class="form-group">
                    <label for="example">NOMBBRE CORTO</label>
                    <input type="text" class="form-control" id="example" name="nombre_corto"  value="<?php echo $datos['nombre_corto']?>" required >
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a class="btn btn-primary" href="<?php echo base_url();?>unidades">Salir!!</a>
            </form>
           
          
        </div>
    </main>