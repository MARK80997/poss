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

            <form method="POST" action="<?php echo base_url(); ?>/productos/actualizar">
                <?php csrf_field(); ?>
                <input type="hidden" id="id" name="id"  value="<?php echo $producto['id'];?>" /> 
                <div class="form-group">
                    <label for="exampleInputEmail1">Codigo</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="codigo" value="<?php echo $producto['codigo'];?>">
                </div>
                <div class="form-group">
                    <label for="example">Nombre</label>
                    <input type="text" class="form-control" id="example" name="nombre" value="<?php echo $producto['nombre'];?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Unidad</label>
                    <select class="form-control" id="id_unidad" name="id_unidad" >
                        <option value="">Seleccionar unidad</option>
                        <?php foreach ($unidades as $unidad) { ?>
                            <option value="<?php echo $unidad['id']; ?>" <?php if($unidad['id'] == $producto['id_unidad']){ echo 'selected';}?> ><?php echo $unidad['nombre']; ?></option>
                        <?php } ?>

                    </select>
                </div>
                <div class="form-group">
                    <label for="example">Categorias</label>
                    <select class="form-control" id="id_categoria" name="id_categoria" >
                        <option value="">Seleccionar categoria</option>
                        <?php foreach ($categorias as $categoria) { ?>
                            <option value="<?php echo $categoria['id']; ?>" <?php if($categoria['id'] == $producto['id_categoria']){ echo 'selected';}?> ><?php echo $categoria['nombre']; ?></option>
                        <?php } ?>

                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Precio Venta</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="precio_venta" value="<?php echo $producto['precio_venta'];?>">
                </div>
                <div class="form-group">
                    <label for="example">Precio Compra</label>
                    <input type="text" class="form-control" id="example" name="precio_compra" value="<?php echo $producto['precio_compra'];?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Stock Minimo</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="stock_minimo" value="<?php echo $producto['stock_minimo'];?>">
                </div>
                <div class="form-group">
                    <label for="example">Inventariable</label>
                    <select class="form-control" id="example" name="inventariable">
                        <option value="1" <?php if($producto['inventariable']==1){echo 'selected'; } ?>>SI</option>
                        <option value="0" <?php if($producto['inventariable']==0){echo 'selected'; } ?>>NO</option>
                    </select>

                </div>
                <br>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a class="btn btn-primary" href="<?php echo base_url(); ?>/productos">Salir!!</a>
            </form>


        </div>
    </main>