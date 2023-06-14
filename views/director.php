<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/director.css">
  <link href="../libraries/bootstrap/css/bootstrap.min.css " rel="stylesheet" />
  <script type="module" src="../libraries/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../js/director.js"></script>
  <title>Director</title>
</head>

<body>

  <?php

  require_once('../config/connection.php');
  require_once('../class/TeacherManager.php');
  require_once('../class/CsvManager.php');

  $csvManager = new CsvManager($db);
  $teacherManagement = new TeacherManager($db);
  $nameView = "Calendario";
  $indexPage = "index.php";
  include("header.php");
  ?>
  <!-- <embed src="../assets/plantilla.pdf" type="application/pdf" width="100%" height="600px"> -->
  <div class="vacaciones-seccion">
    <div class="vacaciones-tarjetas">
      <?php $teachers = $teacherManagement->getAllTeachers();
      foreach ($teachers as $teacher) { ?>
        <div class="vacaciones-tarjeta" onclick="mostrarInformacionUsuario('<?php echo $teacher['nombre']; ?>', '<?php echo $teacher['CP']; ?>', '<?php echo $teacher['roles']; ?>', '<?php echo $teacher['contrasena']; ?>')">
          <h3><?php echo $teacher['nombre']; ?></h3>
          <p>Fecha de vacaciones: <?php echo $teacher['CP']; ?></p>
        </div>
      <?php } ?>
    </div>
    <div class="vacaciones-info" 
      <h2>Información del usuario</h2>
      <p><strong>Nombre:</strong> <span id="usuario-nombre"></span></p>
      <p><strong>Fecha de vacaciones:</strong> <span id="usuario-fecha"></span></p>
      <p><strong>Descripción:</strong> <span id="usuario-descripcion"></span></p>
      <p><strong>Motivo:</strong> <span id="usuario-motivo"></span></p>
      <button class="vacaciones-btn-aceptar">Aceptar</button>
      <button class="vacaciones-btn-rechazar">Rechazar</button>
    </div>
  </div>


</body>

</html>