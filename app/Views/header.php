<?php
$user_sesion = session();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Mi Proyecto Hijas!!</title>

    <!--ENLACES ANTIGUOS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!--FIN MODAL CHAT GTP-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="<?php echo base_url(); ?>/css/style.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>css/styles.css" rel="stylesheet" />
    <script src="<?php echo base_url(); ?>/js/all.js"></script>
    <script src="<?php echo base_url(); ?>/js/jquery-3.7.1.js"></script>
    <!--TAMBIEN SE PUEDE CAMBIAR ESTE SCRIPT AL ARCHIVO DONDE TRABAJAMOS EN JSON-->
    <script src="<?php echo base_url(); ?>/js/jquery-2.2.4.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!--ENLACE1--->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!--ENLACE DOS-->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!--ENLACE DE DATATABLES PARA AÑADIR PAGINACIÓN A LAS TABLAS--->
    <!--ENLACES 24-10-2023-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
    <!--FIN ENLACES-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

    <!--REFERENCIA A LA LIBRERÍA PARA FORMATEAR NÚMEROS A LITERAL-->
    <script src="<?php echo base_url(); ?>/public/assets/js/number-to-words.js"></script>

</head>

<body class="sb-nav-fixed">
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto  me-3 me-lg-4 me-md-3 my-2 my-md-0">

        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">MI PROYECTO!!</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->

            <!--COMIENZO DE LA LISTA DESPLEGABLE-->
            <ul class="navbar-nav ms-auto  me-3 me-lg-4 me-md-3 my-2 my-md-0">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Catálogo</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $user_sesion->nombreUsuario; ?></a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalCambioPasword">
                            Cambiar password</a>
                        <a class="dropdown-item" href="#">Otro</a>
                        <a class="dropdown-item" href="#">Otro</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>/usuarios/logout">Cerrar sessión</a>
                    </div>
                </li>
            </ul>
            <!--FIN DE LA LISTA DESPLEGABLE-->
        </nav>

    </ul>


    <!--// COMIENZO DE TODO EL COTENIDO SIDE NAV. -->
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <!-- ESTE ES EL MENÚ DE VENTAS! -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsOk" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-shop"></i></div>
                            GESTIÓN-VENTAS!!
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>

                        <div class="collapse" id="collapseLayoutsOk" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url(); ?>/ventas/">VENTAS</a>
                            </nav>
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url(); ?>/reportes/">REPORTES</a>
                            </nav>
                        </div>

                        <!-- ESTE ES EL MENÚ DE PRODUCTOS! -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-shop"></i></div>
                            ALMACÉN
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>

                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url(); ?>/productos/">PRODUCTOS</a>
                                <a class="nav-link" href="<?php echo base_url(); ?>/categorias/">CATEGORIAS</a>
                                <a class="nav-link" href="<?php echo base_url(); ?>/clientes/">CLIENTES</a>
                            </nav>
                        </div>

                        <!-- ESTE ES EL MENÚ DE CLIENTES -->
                        <a disabled class="nav-link" href="#">CLIENTES</a>


                        <!--ESTE ES EL MENÚ DE COMPRAS!!-->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#compras" aria-expanded="false" aria-controls="compras">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-shop"></i></div>
                            COMPRAS
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="compras" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a disabled class="nav-link" href="#">NUEVO COMPRA</a>
                                <a disabled class="nav-link" href="#">COMPRA</a>
                            </nav>
                        </div>

                        <!-- DESDE ACÁ EMPIEZA EL MENÚ DE ADMINISTRACIÓN -->
                        <a disabled class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#administracion" aria-expanded="false" aria-controls="administracion">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-shop"></i></div>
                            ADMINISTRACIÓN
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="administracion" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a disabled class="nav-link" href="#">CONFIGURACIÓN</a>
                            </nav>
                            <!-- MENÚ DE ADMINISTRACIÓN!! -->
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url(); ?>/usuarios/">USUARIOS</a>
                            </nav>
                        </div>
                    </div>
                </div>
            </nav>
        </div>


        <!--COMIENZO DE MODAL PARA CAMBIAR PASSWORD-->
        <div class="modal fade" id="modalCambioPasword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cambiar Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="forVerifica">
                            <div>
                                <input id="otro" class="form-control" type="text" name="password" placeholder="Ingrese password actual" required>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Verificar!!</button>
                        </form>
                        <br>
                        <form id="forCambiaPasword">
                            <div id="message"></div>
                            <br>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- FIN MODAL PARA CAMBIAR PASSWORD -->


        <!-- Script para evitar el cierre del modal -->
        <script>
            $(document).ready(function() {

                $('#forVerifica').submit(function(e) {
                    e.preventDefault();
                    var form = $(this);
                    var message = $('#message');
                    console.log($("#otro").val());

                    //console.log(verificaPas);
                    $.ajax({
                        url: '<?php echo base_url(); ?>/usuarios/actualizaPas', // Ruta para la función de registro',
                        type: 'POST',
                        data: form.serialize(),
                        dataType: 'json',
                        success: function(response) {
                            if (response.message === 'Registro exitoso') {
                                message.html(' <div><input class="form-control" type="text" id="np" name="newPassword" placeholder="Ingrese password nuevo" required></div><br><div><input class="form-control" type="text" id="rp" name="rePassword" placeholder="Repite password nuevo" required></div>');
                                $("#forCambiaPasword")[0].reset();
                                alert('USUARIO CORRECTO!!');
                            } else {
                                $("#forVerifica")[0].reset();
                                alert('ERROR DE CONTRASEÑA!!');
                                message.html('<p class="error">ERROR DE VERIFICACIÓN</p>');
                            }
                        }
                    });
                });

                $('#forCambiaPasword').submit(function(e) {
                    e.preventDefault();
                    var form = $(this);

                    var p1 = $("#np").val();
                    var p2 = $("#rp").val();

                    if (p1 === p2) {
                        console.log(p1);
                        console.log(p2);
                        console.log("CORRECTO");
                        $.ajax({
                            url: '<?php echo base_url(); ?>/usuarios/actualizaPasUsu', // Ruta para la función de registro',
                            type: 'POST',
                            data: form.serialize(),
                            dataType: 'json',
                            success: function(response) {
                                if (response.message === 'Registro exitoso') {
                                    alert('REGISTRO EXISTOSO!!');
                                    $("#forCambiaPasword")[0].reset();
                                } else {
                                    alert('ERROR DE ACTUALIZACIÓN!!');
                                    $("#forCambiaPasword")[0].reset();
                                }
                            }
                        });
                    } else {
                        alert('LAS CONTRACEÑAS NO COINCIDEN!!');
                        $("#forCambiaPasword")[0].reset();
                    }

                });
                //HASTA EL MOMENTO YA VALIDAMOS LA COINCIDENCIA ENTRE LOS DOS CAMPOS DE 
                //PASSWORD PARA CONFIRMAR EL CAMBIO DE CONTRASEÑA
                //SOLO QUEDA REALIZAR LA ACTUALIZACIÓN PARA EN EL CONTROLADOR, RECUPERANDO LOS DATOS
                //DEL FORMULARIO.

            });
        </script>