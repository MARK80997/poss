<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <!-- ESTO ES PARA LISTAR LOS ERRORES DE LA PÁGINA  -->

            <form method="POST" action="<?php echo base_url(); ?>/usuarios/correo">

                <div class="form-group">
                    <label for="exampleInputEmail1">Correo electrónico</label>
                    <input type="text" class="form-control" id="usuario" name="usuario">
                </div>
               
                <div class="form-group">
                    <label for="example">Pasword</label>
                    <input type="text" class="form-control" id="genaraInput" name="password">
                </div>
                <div class="form-group">
                    <label for="example">nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre">
                </div>
          
                <br>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a class="btn btn-primary" href="<?php echo base_url(); ?>/usuarios">Salir!!</a>
            </form>

        </div>
    </main>
