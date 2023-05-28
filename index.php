<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="indexCss.css">
  <title>TeachOff</title>
</head>

<body>
  <h1>Deja de enseñar y empieza a disfrutar</h1>
  <div class="login-box">
    <h2>Inicio De Sesión</h2>
    <form action="funcionalidades/inicio_sesion.php" method="post">
      <div class="user-box">
        <input type="text" name="correo" id="correo" required="true">
        <label>Correo</label>
      </div>
      <div class="user-box">
        <input type="password" name="contrasena" id="contrasena" required="true">
        <label>Contraseña</label>
      </div>

      <a href="funcionalidades/inicio_sesion.php">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <input type="submit" required name="submit">
      </a>
    </form>
  </div>
  <!-- Mensaje de error -->
  <?php
  if (isset($_GET['error']) && $_GET['error'] == 1) {
    echo '<p style="color: red;">Correo o contraseña incorrectos.</p>';
  }
  ?>


</body>

</html>