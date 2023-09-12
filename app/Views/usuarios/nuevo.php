<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4"><?php echo $titulo; ?></h1>
      <!-- ESTO ES PARA LISTAR LOS ERRORES DE LA PÁGINA  -->
      <?php if (isset($validation)) { ?>
        <div class="alert alert-danger">
          <?php echo $validation->listErrors(); ?>
        </div>
      <?php } ?>
      <form method="POST" action="<?php echo base_url(); ?>/usuarios/insertar">

        <div class="md-form">
          <label class="dark-grey-text" for="form3">Correo electrónico</label>
          <input type="text" id="usuario" class="form-control" name="usuario" required />
        </div>
        <div class="form-group">
          <input type="hidden" class="form-control" id="genaraImput" name="password">
        </div>
        <div class="form-group">
          <input type="hidden" class="form-control" id="generaImput" name="re_password">
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

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a class="btn btn-primary" href="<?php echo base_url(); ?>/usuarios">Salir!!</a>
      </form>

    </div>
  </main>


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

    var cadena = generarRandom(3);
    var genaraImput = document.getElementById('genaraImput');
    genaraImput.value = cadena;

    var genaraImput = document.getElementById('generaImput');
    genaraImput.value = cadena;
  </script>