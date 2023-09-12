<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?php echo $titulo; ?></h1>

            <form method="POST" action="<?php echo base_url();?>/categorias/insertar" >
                <div class="form-group">
                    <label for="exampleInputEmail1">NOMBRE</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="nombre" autofocus required>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a class="btn btn-primary" href="<?php echo base_url();?>/categorias">Salir!!</a>
            </form> 
           
          
        </div>
    </main>