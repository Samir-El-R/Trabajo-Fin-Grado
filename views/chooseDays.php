<?php
session_start();
require_once '../controllers/AuthController.php';
require_once '../config/connection.php';
$authController = new AuthController($db);
$user = $authController->getCurrentUser();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>IES GM Jovellanos</title>
  <link href="../libraries/bootstrap/css/bootstrap.min.css " rel="stylesheet" />
  <script src="../libraries/bootstrap/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="../css/chooseDaysStyle.css" />
  <script src="../libraries/fullcalendar-6.1.4/dist/index.global.js"></script>

</head>

<body>
  <?php
  $nameView = "Perfil";
  $indexPage="index.php";
  include("../views/header.php")
  ?>

  <div class="d-flex justify-content-center ">

    <div id="calendar" class=""></div>

  </div>
  <div class="bienvenida" id="bienvenida">
    <div class="titulo">
      <?php
      echo '<h2>Bienvenido ' . $user["nombre"] . '</h2>';
      ?>

    </div>
    <div class="texto">
      <p>Empieza a escoger dias libres clickando en los dias del calendario.
        <br> A la derecha del calendario te encontraras un boton para empezar a rellenar el formulario.
      </p>
    </div>
    <a id="cerrarBienvenida">✖</a>
    <script>
      document.getElementById("cerrarBienvenida").addEventListener('click', function () {

        document.getElementById("bienvenida").style.display = "none";
        document.getElementById("calendar").style.filter = "blur(0px)";

      })
    </script>
  </div>
  <div class="container" id="error">
    <div class="new-box" id="new-box">
      <img src="http://100dayscss.com/codepen/alert.png">
      <h2>Oh vaya</h2>
      <p>No puede escoger mas de 4 dias libres</p>
      <div class="button" id="button" onclick="esconder()">Deshacer</div>
      <label for="button"></label>
    </div>
  </div>
  <div class="formulario">
    <div class="new-box" id="new-box">
      <form action="" method="post">
        <label for="">Dia 1</label>
        <input type="text" name="dia0" id="dia0" readonly="readonly">
        <br><br>
        <label for="">Dia 2</label>
        <input type="text" name="dia1" id="dia1" readonly="readonly">
        <br><br>
        <label for="">Dia 3</label>
        <input type="text" name="dia2" id="dia2" readonly="readonly">
        <br><br>
        <label for="">Dia 4</label>
        <input type="text" name="dia3" id="dia3" readonly="readonly">
      </form>

      <div class="button" id="#" onclick="esconder()">Deshacer</div>
      <label for="button"></label>
    </div>
  </div>
  <script type="module" src="../js/chooseDays.js"></script>

</body>

</html>