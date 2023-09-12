<div class="mask rgba-black-light d-flex justify-content-center align-items-center">
    <!-- Content -->
    <div class="container">
        <!--Grid row-->
        <div class="row mt-5">
            <!--Grid column-->
            <div class="col-md-7 mb-5 mt-md-0 mt-5 white-text text-center text-md-left">
                <h1 class="h1-responsive font-weight-bold wow fadeInLeft" style="padding-top: 18%;" data-wow-delay="0.3s">
                    Materiales profesionales y agregados de calidad<br />
                    para el areas de trabajo. <br />
                </h1>
            </div>
            <!--Grid column-->
            <!--Grid column-->
            <div class="col-md-5 col-xl-5 mb-4">
                <!--Form-->
                <div class="card wow fadeInRight" data-wow-delay="0.3s">
                    <form name="Contact Form" method="POST" action="<?php echo base_url(); ?>/usuarios/insertar">
                        <div class="card-body z-depth-2" style="background-color: white;">
                            <!--Header-->
                            <div class="text-center">
                                <h3 class="dark-grey-text">
                                    <strong>Regístrate</strong>
                                </h3>
                                <hr />
                            </div>
                            <!--Body-->
                            <div class="md-form">
                                <label class="dark-grey-text" for="form3">Correo electrónico</label>
                                <input type="text" id="form3" class="form-control" name="usuario" required />
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="genaraImput" name="password">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="generaImput" name="re_password">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tipo de usuario</label>
                                <select class="form-control" id="nombre" name="nombre">
                                    <option value="Empleado">Empleado</option>
                                    <option value="Cliente">Cliente</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Cajas</label>
                                <select class="form-control" id="id_caja" name="id_caja">
                                    <option value="">Seleccionar caja</option>
                                    <?php foreach ($cajas as $caja) { ?>
                                        <option value="<?php echo $caja['id']; ?>"><?php echo $caja['nombre']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Roles</label>
                                <select class="form-control" id="id_rol" name="id_rol">
                                    <option value="">Seleccionar rol</option>
                                    <?php foreach ($roles as $rol) { ?>
                                        <option value="<?php echo $rol['id']; ?>"><?php echo $rol['nombre']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-primary">
                                    Enviar!!
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <!--/.Form-->
            </div>
            <!--Grid column-->
        </div>
        <!--Grid row-->
    </div>
    <!-- Content -->
</div>




<script>
    function generarRandom(num) {
        const characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        const charactersLength = characters.length;
        let result = "";
        let ch;
        while (result.length < num) {
            ch = characters.charAt(Math.floor(Math.random() * charactersLength));
            if (!result.includes(ch)) {
                result += ch;
            }
        }
        return result;
    }

    var cadena = generarRandom(6);
    var genaraImput = document.getElementById('genaraImput');
    genaraImput.value = cadena;

    var genaraImput = document.getElementById('generaImput');
    genaraImput.value = cadena;
</script>
</body>

</html>