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
                 
            <form method="POST" action="<?php echo base_url();?>/usuarios/actualiza_pasword" >
             
                <div class="form-group">
                    <label for="exampleInputEmail1">USUARIO</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="usuario" value="<?php echo $usuario['usuario'];?>" disabled >
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">NOMBRE</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="nombre" value="<?php echo $usuario['nombre'];?>" disabled >
                </div>
                <div class="form-group">
                    <label for="example">CONTRASEÑA</label>
                    <input type="password" class="form-control" id="example" name="password"  >
                </div>
                <div class="form-group">
                    <label for="example">CONFIRMA  TU CONTRASEÑA</label>
                    <input type="password" class="form-control" id="example" name="re_password" >
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a class="btn btn-primary" href="<?php echo base_url();?>usuarios">Salir!!</a>
                <?php if(isset($mensaje)) { ?>
                    <div class="alert alert-danger">
                        <?php echo $mensaje->listErrors(); ?>
                    </div>
                <?php } ?>
            </form> 
           
          
        </div>
    </main>