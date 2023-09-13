<?php 
    $user_sesion=session();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>MI LOGIN ES HIJA</title>
    <link href="<?php echo base_url(); ?>/css/style.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>css/styles.css" rel="stylesheet" />
    <script src="<?php echo base_url(); ?>/js/all.js"></script>
    <script src="<?php echo base_url(); ?>/js/jquery-2.2.4.js"></script>
</head>

<body class="bg-primary">
<?php print_r($user_sesion->nombre); ?>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">INICIAR SECIÓN EN LA EMPRESA</h3>
                                </div>
                                <div class="card-body">

                                    <form method="POST" action="<?php echo base_url(); ?>usuarios/valida" >
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="usuario" type="text" placeholder="Ingersa tu ususario" name="usuario" />
                                            <label for="usuario">USUARIO-CUATRO</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="password" type="password" placeholder="Ingresa tu password" name="password" value="<?php echo set_value('password'); ?>"/>
                                            <label for="password">Contraseña-CUATRO</label>
                                        </div>
                                       

                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">

                                            <button type="submit" class="btn btn-primary" >Ingresar-CUATRO</button>
                                        </div>
                                        <?php if (isset($validation)) { ?>
                                            <div class="alert alert-danger">
                                                <?php echo $validation->listErrors(); ?>
                                            </div>
                                        <?php } ?>
                                        <?php if (isset($error)) { ?>
                                            <div class="alert alert-danger">
                                                <?php echo $error ?>
                                            </div>
                                        <?php } ?>
                                        
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">COCHABAMBA &copy; PROYECTO <?php echo date('Y'); ?></div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="<?php echo base_url(); ?>/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>/js/scripts.js"></script>

</body>

</html>