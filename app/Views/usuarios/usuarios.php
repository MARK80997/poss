<div id="layoutSidenav_content">
    <main>
        <!--VENTANA MODAL PARA AGREGAR USUARIOS-->
        <div class="modal fade" id="usuariosModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar Usuarios</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="forUsuario">
                            <div>
                                <input class="form-control" type="text" name="nombres" placeholder="Nombre" required>
                            </div>
                            <br>
                            <div>
                                <input class="form-control" type="text" name="apellidoPaterno" placeholder="Apellido Paterno">
                            </div>
                            <br>
                            <div>
                                <input class="form-control" type="text" name="apellidoMaterno" placeholder="Apellido Materno">
                            </div>
                            <br>
                            <div>
                                <input class="form-control" type="text" name="nombreUsuario" placeholder="Correo" required>
                            </div>
                            <br>
                            <div>
                                <input class="form-control" type="text" name="password" placeholder="password" required>
                            </div>
                            <br>
                            <div>
                                <input class="form-control" type="text" name="rol" placeholder="Rol" required>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--MODAL ACTUALIZAR USUARIOS-->
        <div class="modal" id="miModalUsuarios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Actualizar Usuarios</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form id="usuarioActualizar">
                            <div>
                                <input class="form-control" type="hidden" id="idUsuarioInput" name="idUsuario">
                            </div>
                            <div>
                                <input class="form-control" type="text" id="nombresInput" name="nombres">
                            </div>
                            <br>
                            <div>
                                <input class="form-control" type="text" id="primerApellidoInput" name="primerApellido">
                            </div>
                            <br>
                            <div>
                                <input class="form-control" type="text" id="segundoApellidoInput" name="segundoApellido">
                            </div>
                            <br>
                            <div>
                                <input class="form-control" type="text" id="nombreUsuarioInput" name="nombreUsuario">
                            </div>
                            <br>
                            <div>
                                <input class="form-control" type="text" id="passwordInput" name="password">
                            </div>
                            <br>
                            <div>
                                <input class="form-control" type="text" id="rolInput" name="rol">
                            </div>
                            <!-- Botón para asignar un nuevo valor -->
                            <button class="btn btn-info" type="submit" class="btn btn-primary" data-bs-dismiss="modal">Guardar!!</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!--MODAL PARA VER CLIENTES ELIMINADOS-->
        <div class="modal fade" id="usuariosEliminadosModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Usuarios Eliminadas!!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body">
                            <table border="1" class="table table-hover table-dark">
                                <thead>
                                    <tr>
                                        <th>Nombres</th>
                                        <th>Apellido P.</th>
                                        <th>Apellido M.</th>
                                        <th>Correo</th>
                                        <th>Rol</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tablaUsuariosEliminadosBody">
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


        <!--AREA DE GESTIONAMIENTO DE CLIENTES-->
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?php echo $titulo; ?></h1>
            <div>
                <p>
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#usuariosModal">
                        Agregar
                    </button>
                    <button type="button" class="btnVerUsuariosEliminados btn btn-warning" data-bs-toggle="modal" data-bs-target="#usuariosEliminadosModal">
                        Eliminados
                    </button>

                </p>
            </div>
            <!--LISTA DE PRODUCTOS NUEVA-->
            <table border="1" class="table table-hover table-dark">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>A. Paterno</th>
                        <th>A. Materno</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Editar</th>
                        <th>Eliminar!!</th>
                    </tr>
                </thead>
                <tbody id="tablaUsuariosBody">
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
            cargarListaUsuarios();

            function cargarListaUsuarios() {
                $.ajax({
                    url: '<?php echo base_url(); ?>/usuarios/obtenerDatos',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        mostrarUsuariosEnTabla(data.usuarios);
                    }
                });
            }

            function mostrarUsuariosEnTabla(usuarios) {
                var tbody = $('#tablaUsuariosBody');
                tbody.empty(); // Limpiar la tabla antes de agregar nuevos datos

                $.each(usuarios, function(index, usuario) {

                    var fila = '<tr>' +
                        '<td id="nombres">' + usuario.nombres + '</td>' +
                        '<td id="primerApellido">' + usuario.primerApellido + '</td>' +
                        '<td id="segundoApellido">' + usuario.segundoApellido + '</td>' +
                        '<td id="nombreUsuario">' + usuario.nombreUsuario + '</td>' +
                        '<td id="rol">' + usuario.rol + '</td>' +
                        // Agrega las demás celdas de la fila aquí
                        '<td><button class="btnEditar btn btn-warning" data-id="' + usuario.id + '"  data-bs-toggle="modal" data-bs-target="#miModalUsuarios">Editar</button></td>' +
                        '<td><button class="btnEliminar btn btn-danger" data-id="' + usuario.id + '">Eliminar</button></td>' +
                        '</tr>';

                    tbody.append(fila);

                });

                // Agregar manejador de eventos para el botón "Editar"
                $(document).on('click', '.btnEditar', function() {
                    var idUsuario = $(this).data('id');

                    // Encuentra los elementos específicos dentro de la fila asociada al botón clicado
                    var fila = $(this).closest('tr');

                    var idUsuario = fila.find('.btnEditar').data('id');
                    var nombres = fila.find('#nombres').text();
                    var primerApellido = fila.find('#primerApellido').text();
                    var segundoApellido = fila.find('#segundoApellido').text();
                    var nobreUsuario = fila.find('#nobreUsuario').text();
                    var password = fila.find('#password').text();
                    var rol = fila.find('#rol').text();


                    $("#idUsuarioInput").val(idUsuario);
                    $("#nombresInput").val(nombres);
                    $("#primerApellidoInput").val(primerApellido);
                    $("#segundoApellidoInput").val(segundoApellido);
                    $("#nombreUsuarioInput").val(nobreUsuario);
                    $("#passwordInput").val(password);
                    $("#rolInput").val(rol);

                    // Puedes imprimir los valores en la consola o donde sea necesario
                    console.log(idCliente);
                    console.log(nombre);
                });

            }
            $('#usuarioActualizar').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var message = $('#message');

                $.ajax({
                    url: '<?php echo base_url(); ?>/usuarios/actualizar', // Ruta para la función de registro',
                    type: 'POST',
                    data: form.serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.message === 'Registro exitoso') {
                            cargarListaUsuarios();
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
                var idUsuario = fila.find('.btnEditar').data('id');
                console.log("eliminar", idUsuario);

                $.ajax({
                    url: '<?php echo base_url(); ?>/usuarios/eliminar', // Ruta para la función de registro',
                    type: 'POST',
                    data: {
                        idUsuario: idUsuario
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.message === 'Registro exitoso') {
                            cargarListaUsuarios();

                        } else {}
                    }
                });

            });


            // VER PRODUCTOS ELIMINADOS Y VOLVER A REINGRESARLOS
            $(document).on('click', '.btnVerUsuariosEliminados', function() {

                cargarListaUsuariosEliminados();

                function cargarListaUsuariosEliminados() {
                    $.ajax({
                        url: '<?php echo base_url(); ?>/usuarios/obtenerDatosEliminados',
                        method: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            mostrarUsuariosEliminadosEnTabla(data.usuarios);

                        }
                    });
                }

                function mostrarUsuariosEliminadosEnTabla(usuarios) {
                    var tbody = $('#tablaUsuariosEliminadosBody');
                    tbody.empty(); // Limpiar la tabla antes de agregar nuevos datos

                    $.each(usuarios, function(index, usuario) {
                        var fila = '<tr>' +
                            '<td id="nombres">' + usuario.nombres + '</td>' +
                            '<td id="primerApellido">' + usuario.primerApellido + '</td>' +
                            '<td id="segundoApellido">' + usuario.segundoApellido + '</td>' +
                            '<td id="nombreUsuario">' + usuario.nombreUsuario + '</td>' +
                            '<td id="rol">' + usuario.rol + '</td>' +
                            // Agrega las demás celdas de la fila aquí
                            '<td><button class="btnVolverUsuariosEliminados btn btn-warning" data-id="' + usuario.id + '" data-bs-toggle="modal" data-bs-target="#usuariosEliminadosModal" >Reingresar!!</button></td>' +
                            '</tr>';

                        tbody.append(fila);

                    });

                    // Agregar manejador de eventos para el botón "PRODUCTOS ELIMINADOS (ELIMINADOS)"
                    $(document).on('click', '.btnVolverUsuariosEliminados', function() {
                        var idUsuarioEliminado = $(this).data('id');

                        $.ajax({
                            url: '<?php echo base_url(); ?>/usuarios/reingresarDatosEliminados',
                            method: 'POST',
                            dataType: 'json',
                            data: {
                                idUsuarioEliminado: idUsuarioEliminado
                            },
                            success: function(data) {
                                cargarListaUsuarios();
                                mostrarUsuariosEliminadosEnTabla(data.usuarios);
                            }
                        });

                        // Encuentra los elementos específicos dentro de la fila asociada al botón clicado
                        var fila = $(this).closest('tr');
                        var idUsuario = fila.find('.btnVolverUsuariosEliminados').data('id');
                        // Puedes imprimir los valores en la consola o donde sea necesario
                        console.log(idUsuario);

                    });
                }

            });


            //AGREGAR PRODUCTO (INSERT)
            $('#forUsuario').submit(function(e) {

                e.preventDefault();
                var form = $(this);
                var message = $('#message');

                $.ajax({
                    url: '<?php echo base_url(); ?>/usuarios/insertar', // Ruta para la función de registro',
                    type: 'POST',
                    data: form.serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.message === 'Registro exitoso') {
                            cargarListaUsuarios();
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