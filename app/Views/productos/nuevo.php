<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?php echo $titulo; ?></h1>
            <!-- ESTO ES PARA LISTAR LOS ERRORES DE LA PÁGINA  -->
            <?php if (isset($validation)) { ?>
                <div class="alert alert-danger">
                    <?php echo $validation->listErrors(); ?>
                </div>
            <?php } ?>


            <form method="POST" action="<?php echo base_url(); ?>/productos/insertar">

                <div class="form-group">
                    <label for="exampleInputEmail1">Codigo</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="codigo">
                </div>
                <div class="form-group">
                    <label for="example">Nombre</label>
                    <input type="text" class="form-control" id="example" name="nombre">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Unidad</label>
                    <select class="form-control" id="id_unidad" name="id_unidad">
                        <option value="">Seleccionar unidad</option>
                        <?php foreach ($unidades as $unidad) { ?>
                            <option value="<?php echo $unidad['id']; ?>"><?php echo $unidad['nombre']; ?></option>
                        <?php } ?>

                    </select>
                </div>
                <div class="form-group">
                    <label for="example">Categorias</label>
                    <select class="form-control" id="id_categoria" name="id_categoria">
                        <option value="">Seleccionar categoria</option>
                        <?php foreach ($categorias as $categoria) { ?>
                            <option value="<?php echo $categoria['id']; ?>"> <?php echo $categoria['nombre']; ?> </option>
                        <?php } ?>

                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Precio Venta</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="precio_venta">
                </div>


                <div class="form-group">
                    <label for="exampleInputEmail1">Cantidad</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="stock_minimo">
                </div>

                <br>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a class="btn btn-primary" href="<?php echo base_url(); ?>/productos">Salir!!</a>
            </form>


        </div>
    </main>