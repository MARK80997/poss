<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <!-- EN ESTA ARCHIVO PHP DEBEMOS MOSTRAR LOS DATOS
                DE LAS COMPRAS DE LOS USUAR COMO SI FUESE UN UPDATE!! -->
                

            <form method="POST" action="<?php echo base_url(); ?>/compras" autocomplete="off">

                <div class="form-group col-12">
                    <input type="hidden" id="id_producto" name="id_producto" />
               
                    <label for="exampleInputEmail1">CÓDIGO</label>
                    <input type="text" placeholder="Escribe el código y enter" class="form-control" id="codigo" name="codigo" onkeyup="buscarProducto(event, this, this.value)" autofocus />
                    <label for="codigo" id="resultado_error" style="color: red"></label>
                </div>
                <div class="form-group col-12">
                    <label for="example">NOMBBRE DEL PRODUCTO</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" disabled />
                    
                </div>
                <div class="form-group col-12">
                    <label for="exampleInputEmail1">CANTIDAD</label>
                    <input type="text" class="form-control" id="cantidad" name="cantidad" />
                </div>
                <br>
                <div class="form-group col-12">
                    <label for="exampleInputEmail1">PRECIO DE COMPRA</label>
                    <input type="text" class="form-control" id="precio_compra" name="precio_compra"/>
                </div>
                <div class="form-group col-12">
                    <label for="example">SUBTOTAL</label>
                    <input type="text" class="form-control" id="subtotal" name="subtotal" disabled>
                </div> 
                <div class="form-group col-12">
                    <label><br>&nbsp;</label>
                    <button type="button" id="agregar_producto" name="agregar_producto" class="btn btn-primary">AGREGAR PPRODUCTO</button>
                </div>
                <br>

                <table class="table" id="tablaProductos">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>CÓDIGO</th>
                            <th>NOMBRE</th>
                            <th>PRECIO</th>
                            <th>CANTIDAD</th>
                            <th>TOTAL</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                 
                <div class="form-group col-10 offset-md-8">
                    <label for="example"><h1>TOTAL $</h1></label>
                    <input type="text" id="total" name="total" class="form-control"  readonly="true" value="0.00" style="font-size: 30px;" >
                    <button type="button" id="completa_compra" class="btn btn-success">COMPLETAR COMPRA!!</button>
                </div>
    
            </form>
        </div>
    </main>