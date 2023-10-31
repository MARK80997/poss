<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?php echo $titulo; ?></h1>
          
            <div class="container-fluid px-4">
                <button type="button" id="reporteVenta" class="btn btn-info">IMPRIMIR!!</button>
            </div>
        </div>
        <!-- VENTANA MODAL PARA AGREGAR CLIENTE SI EN EL BUSCADOR NO EXISTE -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar Cliente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="forax">
                            <div>
                                <input class="form-control" type="text" name="razonSocial" placeholder="Nombre">
                            </div>
                            <br>
                            <div>
                                <input class="form-control" type="text" name="ciNit" placeholder="C.I">
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

        <br>
        <!--INPUT PARA BUSCAR CLIENTES Y MOSTRARLO EN  UNA TABLA DINÁMICA
            EXISTENTES EN LA BDD. CON UN BOTÓN A LADO 
            QUE CUMPLE DE AÑADIR UN NUEVO USUARIO SI EL MISMO NO EXISTE-->
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-10">
                        <input class="form-control" type="text" id="inputBuscarCliente" data-id="idCliente" placeholder="Buscar Clientes!!">
                    </div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <h6>+</h6>
                        </button>
                    </div>
                </div>
                <table id="tablaClientes" class="table table-hover table-dark">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>C.I</th>
                            <th>Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- EN ESTE CAMPO SE VISUALIZARÁ EL RESULTADO DE LA BÚSQUEDA
                            DEL CLIENTE. -->
                    </tbody>
                </table>

                <!-- INPUT PARA BUSCAR PRODUCTO Y AÑADIR A LA TABLA DINÁMICA PARA
                    EL PROCESO DE CÁLCULO.-->
                <input class="form-control" type="text" id="inputBuscarProducto" placeholder="Buscar producto">
                <table id="tablaProductos" class="table table-hover table-dark">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Precio.B.</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Aquí se agregarán las filas dinámicamente -->
                    </tbody>
                </table>
            </div>
            <div class="col-sm-3"></div>
        </div>



        <!--TABLA DONDE SE VISUALIZAN LOS PRODUCTOS AÑADIDOS ANTERIORMENTE A TRAVÉS DEL INPUT
        PARA VISUALIZACIÓN DEL TOTAL A PAGAR CON LAS OPCIONES DE MODIFICACIÓN EN LOS CAMPOS 
        DE CANTIDAD DEL PRODUCTO TABLAS DE CÁLCULO  Y ENVIAR A LA BDD.-->
        <br>
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-5">
                <form id="formularioVenta">
                    <table id="tablaDetalleVenta" class="table table-hover table-dark">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Importe</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <br>
                    <div class="row">
                        <div class="col-sm-6"></div>
                        <div class="col-sm-6">
                            <h4>
                                Total: Bs <span id="totalVenta">0.00</span>
                            </h4>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info">Guardar Venta</button>
                </form>
            </div>
            <div class="col-sm-3"></div>
        </div>

    </main>


    <!-- //////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////
    -->

    <!--SCRIPT DE NUEVA INTERFAZ DE VENTAS -->
    <script>
        //LLENADO DE LAS TABLAS DE BUSQUEDA DE PRODUCTO Y DETALLE VENTA
        $(document).ready(function() {

            //BUSCAR CLIENTE
            $("#inputBuscarCliente").on("input", function() {
                var buscarCliente = $(this).val();
                //console.log(buscarCliente);

                // Realizar una solicitud AJAX al controlador para buscar datos
                if ($('#inputBuscarCliente').val() === "") {
                    // Limpia la tabla
                    $('#tablaClientes tbody').empty();
                } else {

                    $.ajax({
                        type: "POST",
                        url: '<?php echo base_url(); ?>/clientes/buscar',
                        data: {
                            clientes: buscarCliente
                        },
                        dataType: "json",
                        success: function(result) {
                            // Construir la tabla de resultados
                            $('#tablaClientes tbody').empty();
                            $.each(result, function(index, cliente) {
                                var row = '<tr>' +
                                    '<td>' + cliente.id + '</td>' +
                                    '<td>' + cliente.ciNit + '</td>' +
                                    '<td>' + cliente.razonSocial + '</td>' +
                                    '</tr>';
                                $('#tablaClientes tbody').append(row);
                            });
                        }
                    });
                }
            });



            $('#forax').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var message = $('#message');

                $.ajax({
                    url: '<?php echo base_url(); ?>/clientes/insertar', // Ruta para la función de registro
                    type: 'POST',
                    data: form.serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.message === 'Registro exitoso') {
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

            //CÓDIGO DE BÚSQUEDA DE PRODUCTO MEDIANTE LA ETIQUETE INPUT
            $('#inputBuscarProducto').on('input', function() {

                var inputBuscarProducto = $(this).val();

                // Realizar la búsqueda mediante AJAX

                if ($('#inputBuscarProducto').val() === "") {
                    // Limpia la tabla
                    $('#tablaProductos tbody').empty();
                } else {
                    $.ajax({
                        url: '<?php echo base_url(); ?>/productos/buscar',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            nombre_producto: inputBuscarProducto
                        },
                        success: function(result) {
                            // Limpiar la tabla de resultados
                            $('#tablaProductos tbody').empty();
                            // Mostrar los resultados en la tabla
                            $.each(result, function(index, producto) {
                                var row = '<tr>' +
                                    '<td>' + producto.id + '</td>' +
                                    '<td>' + producto.nombre + '</td>' +
                                    '<td>' + producto.precioBase + '</td>' +
                                    '<td><button class="agregar-producto btn btn-primary" data-id="' + producto.id + '">Agregar</button></td>' +
                                    '</tr>';
                                $('#tablaProductos tbody').append(row);
                            });
                        }

                    });
                }

            });

            $('#tablaProductos').on('click', '.agregar-producto', function() {
                var productId = $(this).data('id');
                var productName = $(this).closest('tr').find('td:nth-child(2)').text();
                var productPrice = parseFloat($(this).closest('tr').find('td:nth-child(3)').text());

                // Agregar a la tabla de detalle de venta
                var row = '<tr data-id="' + productId + '">' +
                    '<td id="tProducto">' + productId + '</td>' +
                    '<td>' + productName + '</td>' +
                    '<td>' + productPrice + '</td>' +
                    '<td contenteditable="true"  id="tCantidad">1</td>' +
                    '<td id="tPrecio">' + productPrice + '</td>' +
                    '<td><button class="eliminar-producto btn btn-primary">Eliminar</button></td>' +
                    '</tr>';

                $('#tablaDetalleVenta tbody').append(row);
                calcularTotal();

            });

            function calcularTotal() {
                var total = 0;
                $('#tablaDetalleVenta tbody tr').each(function() {
                    var importe = parseFloat($(this).find('#tPrecio').text());
                    total += importe;
                });

                $('#totalVenta').text(total.toFixed(2));

            };

            function calcularImporte() {
                var totalImporte = 0;
                $('#tablaDetalleVenta tbody tr').each(function() {
                    var cantidad = parseFloat($(this).find('#tCantidad').text());
                    var precioUnitario = parseFloat($(this).find('#tPrecio').text());
                    totalImporte += cantidad * precioUnitario;
                });

                // Actualizar el elemento HTML con el total calculado
                $('#tPrecio').text(totalImporte.toFixed(2));

            }

            // Al cambiar la cantidad en la tabla de detalle de venta
            $('#tablaDetalleVenta').on('blur', '#tCantidad', function() {
                var cantidad = parseInt($(this).text());
                var importe = cantidad * parseFloat($(this).closest('tr').find('#tPrecio').text());

                $(this).closest('tr').find('#tPrecio').text(importe.toFixed(2));
                calcularTotal();

            });


            // Al hacer clic en el botón "Eliminar" en la tabla de detalle de venta
            $('#tablaDetalleVenta').on('click', '.eliminar-producto', function() {
                $(this).closest('tr').remove();
                //calcularTotal()
                calcularTotal();

            });

            ///////////////////////////////////////////////////
            // FORMULARIO ////////////////////////////////////////////////////

            $('#formularioVenta').on('submit', function(e) {
                valorCliente();
                e.preventDefault();
                var datosArray = [];

                function valorCliente() {
                    // Iterar sobre las filas de la tabla
                    $('#tablaClientes tbody tr').each(function() {
                        valorCliente.cliente = $(this).find('td:eq(0)').text();
                    });
                }

                function valorTotal() {
                    // Iterar sobre las filas de la tabla
                    $('#tablaClientes tbody tr').each(function() {
                        valorCliente.cliente = $(this).find('td:eq(0)').text();
                    });
                }

                $('#tablaDetalleVenta tbody tr').each(function() {
                    var filaDatos = {
                        'idProductoVenta': $(this).find('td:eq(0)').text(),
                        'precio': $(this).find('td:eq(2)').text(),
                        'cantidad': $(this).find('td:eq(3)').text(),
                        'importe': $(this).find('td:eq(4)').text()
                        // Agregar más columnas según sea necesario
                    };

                    datosArray.push(filaDatos);
                });

                console.log(datosArray);
                console.log(valorCliente.cliente);

                // Realiza la solicitud Ajax para agregar los productos al controlador
                $.ajax({
                    url: '<?php echo base_url(); ?>/ventas/transaccion',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        idProducto: datosArray,
                        idCliente: valorCliente.cliente,
                        total: $('#totalVenta').text()
                    },
                    success: function(response) {
                        console.log("Respuesta del servidor:", response);

                        if (response.message) {
                            alert('TRANSACCIÓN COMPLETADA');
                        } else {
                            alert('NO HAY PRODUCTOS');
                        }
                    },

                });
            });

            //GENERAR REPORTE DE VENTA

            $("#reporteVenta").click(function() {
                // Obtener las fechas del formulario

                // Crear un formulario oculto y agregar las fechas como campos de formulario
                var form = $('<form action="<?= base_url('ventas/pdf') ?>" target="_blank"></form>');
                

                // Agregar el formulario al cuerpo del documento y enviarlo
                form.appendTo('body').submit();
            });

        });
    </script>