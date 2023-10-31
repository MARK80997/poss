<div id="layoutSidenav_content">
    <main>
        <!--VENTANA MODAL PARA AGREGAR PRODUCTOS-->
        <div class="modal fade" id="categoriasModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar Categorías</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="forCat">
                            <div>
                                <input class="form-control" type="text" name="nombre" placeholder="Nombre" required>
                            </div>
                            <br>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Enviar</button>
                            </div>
                        </form>
                        <div id="message"></div>
                    </div>
                </div>
            </div>
        </div>

        <!--MODAL ACTUALIZAR CATEGORÍAS-->
        <div class="modal" id="miModalCategorias" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Actualizar Producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form id="categoriaActualizar">
                            <div>
                                <input class="form-control" type="hidden" id="idCategoriaInput" name="idCategoria">
                            </div>
                            <div>
                                <input class="form-control" type="text" id="nombreInput" name="nombre">
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
        <div class="modal fade" id="categoriasEliminadosModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Categorias Eliminadas!!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body">
                            <table border="1" class="table table-hover table-dark">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tablaCategoriasEliminadosBody">
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
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#categoriasModal">
                        Agregar
                    </button>
                    <button type="button" class="btnVerCategoriasEliminados btn btn-warning" data-bs-toggle="modal" data-bs-target="#categoriasEliminadosModal">
                        Eliminados
                    </button>

                </p>
            </div>
            <!--LISTA DE PRODUCTOS NUEVA-->
            <table border="1" class="table table-hover table-dark">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Editar</th>
                        <th>Eliminar!!</th>
                    </tr>
                </thead>
                <tbody id="tablaCategoriasBody">
                    <!-- Aquí se mostrarán los productos -->
                </tbody>
            </table>
        </div>

        <!--CAMPO DONDE SE DARA LECTURA AL CÓDIGO QR GENERADO ANTERIORMENTE-->

        <!--CAMPO DONDE SE GENERA EL CODIGO QR-->

    </main>




    <!-- CAMPO DONDE SE REALIZA LA LÓGICA DE CAPTURA Y ENVIO DE DATOS MEDIANTE 
     AJAX Y JQUERY EN CODEIGNITER 4; -->
    <script>
        //ACTUALIZAR PRODUCTOS!!
        $(document).ready(function() {
            // Cargar lista de productos al cargar la página
            cargarListaCategorias();

            function cargarListaCategorias() {
                $.ajax({
                    url: '<?php echo base_url(); ?>/categorias/obtenerDatos',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        mostrarCategoriasEnTabla(data.categorias);
                    }
                });
            }

            function mostrarCategoriasEnTabla(categorias) {
                var tbody = $('#tablaCategoriasBody');
                tbody.empty(); // Limpiar la tabla antes de agregar nuevos datos

                $.each(categorias, function(index, categoria) {

                    var fila = '<tr>' +
                        '<td id="nombre">' + categoria.nombre + '</td>' +
                        // Agrega las demás celdas de la fila aquí
                        '<td><button class="btnEditar btn btn-warning" data-id="' + categoria.id + '"  data-bs-toggle="modal" data-bs-target="#miModalCategorias">Editar</button></td>' +
                        '<td><button class="btnEliminar btn btn-danger" data-id="' + categoria.id + '">Eliminar</button></td>' +
                        '</tr>';

                    tbody.append(fila);

                });

                // Agregar manejador de eventos para el botón "Editar"
                $(document).on('click', '.btnEditar', function() {
                    var idCategoria = $(this).data('id');

                    // Encuentra los elementos específicos dentro de la fila asociada al botón clicado
                    var fila = $(this).closest('tr');

                    var idCategoria = fila.find('.btnEditar').data('id');
                    var nombre = fila.find('#nombre').text();

                    $("#idCategoriaInput").val(idCategoria);
                    $("#nombreInput").val(nombre);

                    // Puedes imprimir los valores en la consola o donde sea necesario
                    console.log(idProducto);
                    console.log(nombre);
                });

            }
            $('#categoriaActualizar').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var message = $('#message');

                $.ajax({
                    url: '<?php echo base_url(); ?>/categorias/actualizar', // Ruta para la función de registro',
                    type: 'POST',
                    data: form.serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.message === 'Registro exitoso') {
                            cargarListaCategorias();
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
                var idCategoria = fila.find('.btnEditar').data('id');
                console.log("eliminar", idCategoria);

                $.ajax({
                    url: '<?php echo base_url(); ?>/categorias/eliminar', // Ruta para la función de registro',
                    type: 'POST',
                    data: {
                        idCategoria: idCategoria
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.message === 'Registro exitoso') {
                            cargarListaCategorias();

                        } else {}
                    }
                });

            });


            // VER PRODUCTOS ELIMINADOS Y VOLVER A REINGRESARLOS
            $(document).on('click', '.btnVerCategoriasEliminados', function() {

                cargarListaCategoriasEliminados();

                function cargarListaCategoriasEliminados() {
                    $.ajax({
                        url: '<?php echo base_url(); ?>/categorias/obtenerDatosEliminados',
                        method: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            mostrarCategoriasEliminadosEnTabla(data.categorias);

                        }
                    });
                }

                function mostrarCategoriasEliminadosEnTabla(categorias) {
                    var tbody = $('#tablaCategoriasEliminadosBody');
                    tbody.empty(); // Limpiar la tabla antes de agregar nuevos datos

                    $.each(categorias, function(index, categoria) {
                        var fila = '<tr>' +
                            '<td id="nombre">' + categoria.nombre + '</td>' +
                            // Agrega las demás celdas de la fila aquí
                            '<td><button class="btnVolverCategoriasEliminados btn btn-warning" data-id="' + categoria.id + '" data-bs-toggle="modal" data-bs-target="#categoriasEliminadosModal" >Reingresar!!</button></td>' +
                            '</tr>';                                                                                             

                        tbody.append(fila);

                    });

                    // Agregar manejador de eventos para el botón "PRODUCTOS ELIMINADOS (ELIMINADOS)"
                    $(document).on('click', '.btnVolverCategoriasEliminados', function() {
                        var idCategoriaEliminado = $(this).data('id');

                        $.ajax({
                            url: '<?php echo base_url(); ?>/categorias/reingresarDatosEliminados',
                            method: 'POST',
                            dataType: 'json',
                            data: {
                                idCategoriaEliminado: idCategoriaEliminado
                            },
                            success: function(data) {
                                cargarListaCategorias();
                                mostrarCategoriasEliminadosEnTabla(data.categorias);
                            }
                        });

                        // Encuentra los elementos específicos dentro de la fila asociada al botón clicado
                        var fila = $(this).closest('tr');
                        var idCategoria = fila.find('.btnVolverCategoriasEliminados').data('id');
                        // Puedes imprimir los valores en la consola o donde sea necesario
                        console.log(idCategoria);

                    });
                }

            });


            //AGREGAR PRODUCTO (INSERT)
            $('#forCat').submit(function(e) {

                e.preventDefault();
                var form = $(this);
                var message = $('#message');

                $.ajax({
                    url: '<?php echo base_url(); ?>/categorias/insertar', // Ruta para la función de registro',
                    type: 'POST',
                    data: form.serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.message === 'Registro exitoso') {
                            cargarListaCategorias();
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