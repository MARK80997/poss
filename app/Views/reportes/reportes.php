<div id="layoutSidenav_content">
    <main>
        <br>
        <div class="row">
            <div class="col-sm-12">
                <div class="container-fluid px-4">
                    <div class="button-row">
                        <button type="button" id="botonGenerar" class="btn btn-info">IMPRIMIR!!</button>
                        <button type="button" id="btnMasVendidos" class="btn btn-info">MÁS VENDIDOS!!</button>
                        <button>Botón 3</button>
                        <button>Botón 4</button>
                        <button>Botón 5</button>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>

        <!--VENTANA MODAL PARA VER LOS DETALLES DEL PRODUCTO-->
        <div class="modal fade" id="verDetalleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">DETALLE DE LA VENTA!!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body">
                            <table border="1" class="table table-hover table-dark">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Importe</th>
                                    </tr>
                                </thead>
                                <tbody id="bodyVerDetalle">
                                    <!-- Aquí se mostrarán los productos -->
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-6">
                                    <h4>
                                        Total General: Bs <span id="totalVentaDetalle">0.00</span>
                                    </h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9">
                                    <h6>
                                        <div id="resultDetalle"></div>
                                    </h6>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!--FIN MODAL ELIMINADOS!!-->
        </div>

        <!--INPUT PARA BUSCAR CLIENTES Y MOSTRARLO EN  UNA TABLA DINÁMICA
            EXISTENTES EN LA BDD. CON UN BOTÓN A LADO 
            QUE CUMPLE DE AÑADIR UN NUEVO USUARIO SI EL MISMO NO EXISTE-->
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <!-- INPUT PARA BUSCAR PRODUCTO POR FECHAS Y LISTAR EN LA TABLA A LA TABLA DINÁMICA PARA
                    EL PROCESO DE CÁLCULO.-->
                <form>
                    <label for="fecha">Selecciona una fecha:</label>
                    <input class="form-control" type="date" id="fechaInicio" name="fechaInicio">
                    <input class="form-control" type="date" id="fechaFinal" name="fechaFinal">
                </form>

                <table id="tablaProductoFecha" class="table table-hover table-dark">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>FechaVenta</th>
                            <th>Cliente</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- EN ESTÁ PARTE S MUESTRA EL RESULTADO DE LA CONSULTA -->
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <h4>
                        Total General: Bs <span id="totalVentaReporte">0.00</span>
                    </h4>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-9">
                    <h6>
                        <div id="result"></div>
                    </h6>
                </div>
            </div>
            <div class="col-sm-3"></div>
        </div>
        <br>
    </main>



    <!-- //////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////
    -->

    <!--SCRIPT DE REPORTES DE VENTAS (BUSCANDO PRODUCTOS POR FECHAS)-->
    <script>
        // $('#tablaProductoFecha').dataTable()
        $(document).ready(function() {
            //BUÚSQUEDA DE VENTAS REALIZADAS POR FECHAS (FECHAINICIO-FECHAFINAL).
            $('#fechaFinal').on("input", function() {
                var fechaFinal = $(this).val();
                var fechaInicio = $('#fechaInicio').val();
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url(); ?>/reportes/buscarProductoFecha', // Reemplaza 'ruta/ajax' con la URL de tu controlador
                    data: {
                        fechaInicio: fechaInicio,
                        fechaFinal: fechaFinal
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#tablaProductoFecha tbody').empty();
                        // Procesa la respuesta JSON y agrégala a DataTable
                        //if (response) {
                        $.each(response, function(index, reporte) {

                            var rowTemplate = '<tr>' +
                                '<td>' + reporte.id + '</td>' +
                                '<td>' + reporte.fechaRegistro + '</td>' +
                                '<td>' + reporte.razonSocial + '</td>' +
                                '<td id="tTotal">' + reporte.total + '</td>' +
                                '<td><button class="btnVerDetalle btn btn-primary" data-id="' + reporte.id + '">DETALLE!!</button></td>' +
                                '</tr>';
                            $('#tablaProductoFecha').append(rowTemplate);
                            calcularTotal();
                        });

                        //console.log($('#totalVentaReporte').text());
                        var literalTotal = $('#totalVentaReporte').text();
                        $.ajax({
                            method: 'POST',
                            url: '<?php echo base_url(); ?>/reportes/literalTotal',
                            data: {
                                totalVentaReporte: literalTotal
                            },
                            dataType: 'json',
                            success: function(response) {
                                //$('#result').empty();                              
                                $.each(response, function(index, data) {
                                    $('#result').text("SON: " + data);
                                });
                            },
                            error: function(error) {
                                console.error(error);
                            }
                        });
                    }
                });

            });


            //CALCULA EL TOTAL DE LA COLUMNA TOTAL DE LA TABLA DINÁMICA
            function calcularTotal() {
                var total = 0;
                $('#tablaProductoFecha tbody tr').each(function() {
                    var importe = parseFloat($(this).find('#tTotal').text());
                    total += importe;
                });
                $('#totalVentaReporte').text(total.toFixed(2));
            };

            //EL SIGUIENTE CÓDIGO ES FUNCIONAL. NOS GENERA EL UNA VENTANA CON EL PDF
            $("#botonGenerar").click(function() {
                // Obtener las fechas del formulario
                var fechaInicio = $('#fechaInicio').val(); // .VAL->RECUPERA VALOR DEL INPUTS
                var fechaFinal = $('#fechaFinal').val();
                var totalVentaReporte = $('#totalVentaReporte').text(); //.TEXT-> RECUPERA VALOR DE OTROS ELEMENTOS, EN ESTE CASO ES DE UNA TABLA 
                console.log(totalVentaReporte);
                // Crear un formulario oculto y agregar las fechas como campos de formulario
                var form = $('<form method="POST" action="<?= base_url('reportes/generarReporte') ?>" target="_blank"></form>');
                form.append($('<input type="hidden" name="fechaInicio" value="' + fechaInicio + '">'));
                form.append($('<input type="hidden" name="fechaFinal" value="' + fechaFinal + '">'));
                form.append($('<input type="hidden" name="totalVentaReporte" value="' + totalVentaReporte + '">'));

                // Agregar el formulario al cuerpo del documento y enviarlo
                form.appendTo('body').submit();
            });


            $("#btnMasVendidos").click(function() {
                // Obtener las fechas del formulario
                var fechaInicio = $('#fechaInicio').val();
                var fechaFinal = $('#fechaFinal').val();

                var form = $('<form method="POST" action="<?= base_url('reportes/productoMasVendido') ?>" target="_blank"></form>');
                form.append($('<input type="hidden" name="fechaInicio" value="' + fechaInicio + '">'));
                form.append($('<input type="hidden" name="fechaFinal" value="' + fechaFinal + '">'));
                form.appendTo('body').submit();
            });


            //ABRE UN MODAL PARA MOSTRAR EL DETALLE DE LA VEMTA DE ACUERDO A CADA ID
            //DE LA VENTA, SE MANDA AL COMTROLADOR DONDE S REALIZA LA CONSULTA. NOS DEVUELVE
            //UN A ARRAY DE DATOS LOS CUALES IMPRIMIMOS EN LA VENTANA MODAL.
            $('#tablaProductoFecha tbody').on('click', '.btnVerDetalle', function() {
                var idVerDetalle = $(this).data('id');
                var fechaInicio = $('#fechaInicio').val();
                var fechaFinal = $('#fechaFinal').val();
                console.log(idVerDetalle);
                $.ajax({
                    url: '<?php echo base_url(); ?>/reportes/verDetalleVenta',
                    type: 'POST',
                    data: {
                        idVerDetalle: idVerDetalle,
                        fechaInicio: fechaInicio,
                        fechaFinal: fechaFinal
                    },
                    dataType: 'json',
                    success: function(response) {
                        var tbody = $('#bodyVerDetalle');
                        tbody.empty(); // Limpiar la tabla antes de agregar nuevos datos
                        $.each(response, function(index, detalle) {
                            var filaDetalle = '<tr>' +
                                '<td>' + detalle.nombreProducto + '</td>' +
                                '<td>' + detalle.precio + '</td>' +
                                '<td>' + detalle.cantidad + '</td>' +
                                '<td>' + detalle.importe + '</td>' +
                                '</tr>';
                            tbody.append(filaDetalle);
                            //calcularTotalDetalle();
                        });
                    }
                });
                $('#verDetalleModal').modal('show');

                //CREAR FUNCIÓN PARA CALCULAR EL TOTAL DEL IMPORTE PARA CALCULAR 
                //CON LA TABLA PRINCIPAL.



            });





        });


        //Me ayudas a crear una tabla dinámica con un paginador en jQuery y ajax?
    </script>