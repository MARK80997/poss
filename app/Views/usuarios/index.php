<?php require 'PHPMailer/PHPMailerAutoload.php'; ?>
<?php
function Redirect_to($New_Location)
{
  header("Location:" . $New_Location);
  exit;
}

// call the contact() function if contact_btn is clicked
if (isset($_POST['contact_btn'])) {
  contact();
}

function contact()
{
  if (isset($_POST["contact_btn"])) {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $message = $_POST["message"];
    $descripcion = $_POST["descripcion"];

    $generado = "ttr";

    // Email Functionality

    date_default_timezone_set('Etc/UTC');

    $mail = new PHPMailer();

    $uno = 'merida.marcos.137@gmail.com';
    $mail->setFrom($uno);
    $mail->addAddress($email);

    // The subject of the message.
    $mail->Subject = 'Received Message From Client ' . $name;

    $message = '<html><body>';

    $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';

    $message .= "<tr style='background: #eee;'><td><strong>Hola!!:</strong> </td><td>" . strip_tags($_POST['name']) . "</td></tr>";

    $message .= "<tr><td><strong>Email:</strong> </td><td>" . strip_tags('gromar@gmail.com') . "</td></tr>";

    $message .= "<tr><td><strong>Tu Password es:</strong> </td><td>" . strip_tags($generado) . "</td></tr>";

    $message .= "<tr><td><strong>Message</strong> </td><td>" . strip_tags($_POST['message']) . "</td></tr>";

    $message .= "<tr><td><strong>Obligatorio</strong> </td><td>" . strip_tags($_POST['descripcion']) . "</td></tr>";

    $message .= "</table>";
    $message .= "</body></html>";

    $mail->Body = $message;

    $mail->isHTML(true);

    if ($mail->send()) {
      Redirect_to("index.php");
      //echo view('usuarios/correo');
      //echo view('usuarios/correo/index');
      //Redirect_to("usuarios/correo/index.php");
    } else {
      Redirect_to("index.php");
      //Redirect_to("usuarios/correo/index.php");
      //echo view('usuarios/correo');
      //echo view('usuarios/correo/index');
    }
  } //Ending of Submit Button If-Condition

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>
    Ferretería
  </title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <!-- Material Design Bootstrap -->
  <link rel="stylesheet" href="css/mdb.min.css" />
  <!-- Your custom styles (optional) -->
  <link rel="stylesheet" href="css/style.css" />
</head>

<body id="home">
  <!--Header-->
  <header>
    <div class="view" style="
          background-image: url('img/Air-duct-mainPic.jpg');
          background-repeat: no-repeat;
          background-size: cover;
          background-position: center center;
        ">
      <!-- Mask & flexbox options-->
      <div class="mask rgba-black-light d-flex justify-content-center align-items-center">
        <!-- Content -->
        <div class="container">
          <!--Grid row-->
          <div class="row mt-5">
            <!--Grid column-->
            <div class="col-md-7 mb-5 mt-md-0 mt-5 white-text text-center text-md-left">


              <h4 class="mb-3 pt-4 pb-4 wow fadeInLeft" data-wow-delay="0.3s">

              </h4>
              <a class="btn bookhover2 btn-outline-white btn-rounded wow fadeInLeft" data-wow-delay="0.3s" href="#about">Ver Productos</a>
            </div>
            <!--Grid column-->
            <!--Grid column-->
            <div class="col-md-5 col-xl-5 mb-4">
              <!--Form-->
              <div class="card wow fadeInRight" data-wow-delay="0.3s">
                <form name="Contact Form" method="post" action="index.php">
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
                      <i class="fas fa-user prefix grey-text"></i>
                      <input type="text" id="form3" class="form-control" name="name" required />
                      <label class="dark-grey-text" for="form3">Nombre</label>
                    </div>
                    <div class="md-form">
                      <i class="fas fa-envelope prefix grey-text"></i>
                      <input type="email" id="form2" class="form-control" name="email" required />
                      <label class="dark-grey-text" for="form2">Correo</label>
                    </div>
                    <div class="md-form">
                      <i class="fas fa-phone prefix grey-text"></i>
                      <input type="number" id="form5" class="form-control" name="phone" required />
                      <label class="dark-grey-text" for="form5">Celular</label>

                    </div>
                    <div class="md-form">
                      <i class="fas fa-user prefix grey-text"></i>
                      <input type="text" id="form6" class="form-control" name="descripcion" required />
                      <label class="dark-grey-text" for="form6">Descripcion</label>
                    </div>

                    <!--Textarea with icon prefix-->
                    <div class="md-form">
                      <i class="fas fa-pencil-alt prefix grey-text"></i>
                      <textarea type="text" id="form8" class="md-textarea form-control" rows="3" name="message" required></textarea>
                      <label class="dark-grey-text" for="form8">Mensage</label>
                    </div>
                    <div class="text-center mt-3">
                      <button type="submit" class="btn bookhover btn-outline-success btn-rounded waves-effect" name="contact_btn">
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
      <!-- Mask & flexbox options-->
    </div>
    <!-- Full Page Intro -->
  </header>
  <!--Header-->


  <!-- jQuery -->
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Your custom scripts (optional) -->
  <script type="text/javascript">
    $(function() {
      new WOW().init();
      // Add smooth scrolling to all links
      $('a').on('click', function(event) {
        // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== '') {
          // Prevent default anchor click behavior
          event.preventDefault();

          // Store hash
          var hash = this.hash;

          // Using jQuery's animate() method to add smooth page scroll
          // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
          $('html, body').animate({
              scrollTop: $(hash).offset().top,
            },
            800,
            function() {
              // Add hash (#) to URL when done scrolling (default click behavior)
              window.location.hash = hash;
            }
          );
        } // End if
      });
    });
  </script>
</body>

</html>