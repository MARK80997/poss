<div id="layoutSidenav_content">
    <main>
        <!--VENTANA MODAL PARA AGREGAR PRODUCTOS-->
        <div class="modal fade" id="productosModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar Producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="forPro">
                            <div>
                                <input class="form-control" type="text" name="nombre" placeholder="Nombre" required>
                            </div>
                            <br>
                            <div>
                                <input class="form-control" type="text" name="unidadMedida" placeholder="Unidad Medida" required>
                            </div>
                            <br>
                            <div>
                                <input class="form-control" type="number" name="precioBase" placeholder="Precio Base" required>
                            </div>
                            <br>
                            <div>
                                <input class="form-control" type="number" name="stock" placeholder="Stock" required>
                            </div>
                            <br>
                            <div>
                                <input class="form-control" type="text" name="marca" placeholder="Marca" required>
                            </div>
                            <br>
                            <div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Categoría</label>
                                    <select class="form-control" id="idCategoria" name="idCategoria">
                                        <?php foreach ($categorias as $categoria) { ?>
                                            <option value="<?php echo $categoria['id']; ?>"><?php echo $categoria['nombre']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Enviar</button>
                            </div>
                        </form>
                        <div id="message"></div>
                    </div>
                </div>
            </div>
        </div>

        <!--MODAL ACTUALIZAR PRODUCTOS-->
        <div class="modal" id="miModalProductos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Actualizar Producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form id="productoActualizar">
                            <div>
                                <input class="form-control" type="hidden" id="idProductoInput" name="idProducto">
                            </div>
                            <div>
                                <input class="form-control" type="text" id="nombreInput" name="nombre">
                            </div>
                            <br>
                            <div>
                                <input class="form-control" type="text" id="unidadMedidaInput" name="unidadMedida">
                            </div>
                            <br>
                            <div>
                                <input class="form-control" type="number" id="precioBaseInput" name="precioBase">
                            </div>
                            <br>
                            <div>
                                <input class="form-control" type="number" id="stockInput" name="stock">
                            </div>
                            <br>
                            <div>
                                <input class="form-control" type="text" id="marcaInput" name="marca">
                            </div>
                            <br>
                            <div>
                                <div class="form-group">
                                    <select class="form-control" name="idCategoria">
                                        <?php foreach ($categorias as $categoria) { ?>
                                            <option value="<?php echo $categoria['id']; ?>"><?php echo $categoria['nombre']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <!-- Botón para asignar un nuevo valor -->
                            <button class="btn btn-info" type="submit" class="btn btn-primary" data-bs-dismiss="modal">Guardar!!</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!--MODAL PARA VER PRODUCTOS ELIMINADOS-->
        <div class="modal fade" id="productosEliminadosModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Producto Eliminados!!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body">
                            <table border="1" class="table table-hover table-dark">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>U.M.</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Marca</th>
                                        <th>Categoría</th>
                                        <th>Reingresar!!</th>
                                    </tr>
                                </thead>
                                <tbody id="tablaProductosEliminadosBody">
                                    <!-- Aquí se mostrarán los productos -->
                                </tbody>
                            </table>

                            <div id="message"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!--FIN MODAL ELIMINADOS!!-->
        </div>


        <!--AREA DE GESTIONAMIENTO DE PRODUCTOS-->
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?php echo $titulo; ?></h1>
            <div>
                <p>
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#productosModal">
                        Agregar
                    </button>
                    <button type="button" class="btnVerProductosEliminados btn btn-warning" data-bs-toggle="modal" data-bs-target="#productosEliminadosModal">
                        Eliminados
                    </button>

                </p>
            </div>
            <!--LISTA DE PRODUCTOS NUEVA-->
            <table border="1" class="table table-hover table-dark">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>U.M.</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Marca</th>
                        <th>Categoría</th>
                        <th>Editar</th>
                        <th>Eliminar!!</th>
                    </tr>
                </thead>
                <tbody id="tablaProductosBody">
                    <!-- Aquí se mostrarán los productos -->
                </tbody>
            </table>

        </div>

        <!--CAMPO DONDE SE DARA LECTURA AL CÓDIGO QR GENERADO ANTERIORMENTE-->

        <!--CAMPO DONDE SE GENERA EL CODIGO QR-->
        <div class="row">
            <div class="col-sm-2">
                <?php
                $nombre = 'LEONARDOvalencia';
                // Configuración del código QR
                $size = 800; // Tamaño del código QR
                $margin = 70; // Margen alrededor del código QR
                // Generar el código QR
                QRcode::png($nombre, 'path-to-save-QR-code.png', QR_ECLEVEL_L, $size, $margin);
                echo '<img src="path-to-save-QR-code.png" alt="Código QR">';
                ?>
            </div>
            <div class="col-sm-9"></div>
        </div>
    </main>




    <!-- CAMPO DONDE SE REALIZA LA LÓGICA DE CAPTURA Y ENVIO DE DATOS MEDIANTE 
     AJAX Y JQUERY EN CODEIGNITER 4; -->
    <script>
        //ACTUALIZAR PRODUCTOS!!
        $(document).ready(function() {
            // Cargar lista de productos al cargar la página
            cargarListaProductos();

            function cargarListaProductos() {
                $.ajax({
                    url: '<?php echo base_url(); ?>/productos/obtenerDatos',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        mostrarProductosEnTabla(data.productos);
                    }
                });
            }

            function mostrarProductosEnTabla(productos) {
                var tbody = $('#tablaProductosBody');
                tbody.empty(); // Limpiar la tabla antes de agregar nuevos datos

                $.each(productos, function(index, producto) {
                    var fila = '<tr>' +
                        '<td id="nombre">' + producto.nombre + '</td>' +
                        '<td id="unidadMedida">' + producto.unidadMedida + '</td>' +
                        '<td id="precioBase">' + producto.precioBase + '</td>' +
                        '<td id="stock">' + producto.stock + '</td>' +
                        '<td id="marca">' + producto.marca + '</td>' +
                        '<td id="categoriasNombre">' + producto.categoriasNombre + '</td>' +
                        // Agrega las demás celdas de la fila aquí
                        '<td><button class="btnEditar btn btn-warning" data-id="' + producto.id + '"  data-bs-toggle="modal" data-bs-target="#miModalProductos">Editar</button></td>' +
                        '<td><button class="btnEliminar btn btn-danger" data-id="' + producto.id + '">Eliminar</button></td>' +
                        '</tr>';

                    tbody.append(fila);

                });

                // Agregar manejador de eventos para el botón "Editar"
                $(document).on('click', '.btnEditar', function() {
                    var idProducto = $(this).data('id');

                    // Encuentra los elementos específicos dentro de la fila asociada al botón clicado
                    var fila = $(this).closest('tr');

                    var idProducto = fila.find('.btnEditar').data('id');
                    var nombre = fila.find('#nombre').text();
                    var unidadMedida = fila.find('#unidadMedida').text();
                    var precioBase = fila.find('#precioBase').text();
                    var stock = fila.find('#stock').text();
                    var marca = fila.find('#marca').text();
                    var categoriasNombre = fila.find('#categoriasNombre').text();


                    $("#idProductoInput").val(idProducto);
                    $("#nombreInput").val(nombre);
                    $("#unidadMedidaInput").val(unidadMedida);
                    $("#precioBaseInput").val(precioBase);
                    $("#stockInput").val(stock);
                    $("#marcaInput").val(marca);
                    $("#categoriasNombreInput").val(categoriasNombre);

                    // Puedes imprimir los valores en la consola o donde sea necesario
                    console.log(idProducto);
                    console.log(nombre);
                });

            }
            $('#productoActualizar').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var message = $('#message');

                $.ajax({
                    url: '<?php echo base_url(); ?>/productos/actualizar', // Ruta para la función de registro',
                    type: 'POST',
                    data: form.serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.message === 'Registro exitoso') {
                            cargarListaProductos();
                            message.html('<p class="success">Registro exitoso</p>');
                            // Limpia el formulario o realiza otras acciones necesarias
                            form[0].reset();
                            // Recarga la lista de contactos
                            //loadContacts();
                        } else {
                            message.html('<p class="error">Error al actualizar</p>');
                        }
                    }
                });
            });

            //ELIMINAR PRODUCTO
            $(document).on('click', '.btnEliminar', function() {

                var fila = $(this).closest('tr');
                var idProducto = fila.find('.btnEditar').data('id');
                console.log("eliminar", idProducto);

                $.ajax({
                    url: '<?php echo base_url(); ?>/productos/eliminar', // Ruta para la función de registro',
                    type: 'POST',
                    data: {
                        idProducto: idProducto
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.message === 'Registro exitoso') {
                            cargarListaProductos();

                        } else {}
                    }
                });

            });


            // VER PRODUCTOS ELIMINADOS Y VOLVER A REINGRESARLOS
            $(document).on('click', '.btnVerProductosEliminados', function() {

                cargarListaProductosEliminados();

                function cargarListaProductosEliminados() {
                    $.ajax({
                        url: '<?php echo base_url(); ?>/productos/obtenerDatosEliminados',
                        method: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            mostrarProductosEliminadosEnTabla(data.productos);
                        }
                    });
                }

                function mostrarProductosEliminadosEnTabla(productos) {
                    var tbody = $('#tablaProductosEliminadosBody');
                    tbody.empty(); // Limpiar la tabla antes de agregar nuevos datos

                    $.each(productos, function(index, producto) {
                        var fila = '<tr>' +
                            '<td id="nombre">' + producto.nombre + '</td>' +
                            '<td id="unidadMedida">' + producto.unidadMedida + '</td>' +
                            '<td id="precioBase">' + producto.precioBase + '</td>' +
                            '<td id="stock">' + producto.stock + '</td>' +
                            '<td id="marca">' + producto.marca + '</td>' +
                            '<td id="categoriasNombre">' + producto.categoriasNombre + '</td>' +
                            // Agrega las demás celdas de la fila aquí
                            '<td><button class="btnVolverProductosEliminados btn btn-warning" data-id="' + producto.id + '"  data-bs-toggle="modal" data-bs-target="#productosEliminadosModal">Reingresar!!</button></td>' +
                            '</tr>';

                        tbody.append(fila);

                    });

                    // Agregar manejador de eventos para el botón "PRODUCTOS ELIMINADOS (ELIMINADOS)"
                    $(document).on('click', '.btnVolverProductosEliminados', function() {
                        var idProductoEliminado = $(this).data('id');

                        $.ajax({
                            url: '<?php echo base_url(); ?>/productos/reingresarDatosEliminados',
                            method: 'POST',
                            dataType: 'json',
                            data: {
                                idProductoEliminado: idProductoEliminado
                            },
                            success: function(data) {
                                cargarListaProductos();
                                mostrarProductosEliminadosEnTabla(data.productos);
                            }
                        });

                        // Encuentra los elementos específicos dentro de la fila asociada al botón clicado
                        var fila = $(this).closest('tr');
                        var idProducto = fila.find('.btnVolverProductosEliminados').data('id');
                        // Puedes imprimir los valores en la consola o donde sea necesario
                        console.log(idProducto);

                    });
                }

            });


            //AGREGAR PRODUCTO (INSERT)
            $('#forPro').submit(function(e) {

                e.preventDefault();
                var form = $(this);
                var message = $('#message');

                $.ajax({
                    url: '<?php echo base_url(); ?>/productos/insertar', // Ruta para la función de registro',
                    type: 'POST',
                    data: form.serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.message === 'Registro exitoso') {
                            cargarListaProductos();
                            message.html('<p class="success">Registro exitoso</p>');
                            // Limpia el formulario o realiza otras acciones necesarias
                            form[0].reset();
                            // Recarga la lista de contactos
                            //loadContacts();
                        } else {
                            message.html('<p class="error">Error al registrar</p>');
                        }
                    }
                });
            });

            // ... Código para editar (mostrado en la respuesta anterior) ...
        });
    </script>

    <!--  PARA GENERAR EL CÓDIGO QR
    -SE DEBE COMPLETAR EL TRABAJO AÑADIENDO LA EL CÓDIGO QR A UN MODADL PARA SU VISUALIZACIÓN.
    -TAMBIÉN SE DEBE PODER DESCARGAR LA IMAGEN. 
    -PLANIFICAR EL PROCESODE NAVEGABILIDAD DEL CODÓDIGO QR.-->