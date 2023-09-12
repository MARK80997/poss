<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?php echo $titulo; ?></h1>
            <div>
                <?php if (isset($validation)) { ?>
                    <div class="alert alert-danger">
                        <?php echo $validation->listErrors(); ?>
                    </div>
                <?php } ?>

                <form method="POST" action="<?php echo base_url(); ?>/configuracion/insertar">
                    <?php csrf_field(); ?>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> TIENDA NOMBRE</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="tienda_nombre" value="<?php echo set_value('tienda_nombre'); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="example">TIENDA RFC</label>
                        <input type="text" class="form-control" id="example" name="tienda_rfc" value="<?php echo set_value('tienda_rfc'); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="example">TIENDA TELEFONO</label>
                        <input type="text" class="form-control" id="example" name="tienda_telefono" value="<?php echo set_value('tienda_telefono'); ?>"  required>
                    </div>
                    <div class="form-group">
                        <label for="example">TIENDA EMAIL</label>
                        <input type="text" class="form-control" id="example" name="tienda_email" value="<?php echo set_value('tienda_email'); ?>" required >
                    </div>
                    <div class="form-group">
                        <label for="example">TIENDA DIRECCION</label>
                        <div>
                            <textarea class="form-control" id="tienda_direccion" name="tienda_direccion"  value="<?php echo set_value('tienda_direccion'); ?>" required > </textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="example">TICKED LEYENDA</label>
                        <textarea class="form-control" id="ticket_leyenda" name="ticket_leyenda" value="<?php echo set_value('ticket_leyenda'); ?>" > </textarea>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>/configuracion">Salir!!</a>
                </form>

            </div>
        </div>
    </main>


    <!-- Si O SI SE TIENE QUE CREAR UNA VISTA  Y UN CONTROLADOR PARA UN AVENTANA MODAL
        COMO INDICA EN CODEIGNITER -->