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
  <!-- <div class="vacaciones-seccion">
    <div class="vacaciones-tarjetas">
      <?php $teachers = $teacherManagement->getAllRequest();
      // foreach ($teachers as $teacher) { ?>
        <div class="vacaciones-tarjeta" onclick="mostrarInformacionUsuario('<?php echo $teacher['nombre']; ?>', '<?php echo $teacher['fechaEscogida']; ?>', '<?php echo $teacher['estado']; ?>', '<?php echo $teacher['solicitud']; ?>')">
          <h3><?php //echo $teacher['nombre']; ?></h3>
          <p>Fecha de vacaciones: <?php //echo $teacher['fechaEscogida']; ?></p>
        </div>
      <?php //} ?>
    </div>
    <div class="vacaciones-info" 
      <h2>Información del usuario</h2>
      <p><strong>Nombre:</strong> <span id="usuario-nombre"></span></p>
      <p><strong>Fecha de vacaciones:</strong> <span id="usuario-fecha"></span></p>
      <p><strong>Estado:</strong> <span id="usuario-descripcion"></span></p>
      <p><strong>Solicitud:</strong> <span id="usuario-motivo"></span></p>
      <button class="vacaciones-btn-aceptar" name="aceptar">Aceptar</button>
      <button class="vacaciones-btn-rechazar" name="rechazar">Rechazar</button>
    </div>
  </div> -->
  <div class="container">
    <?php $teachers = $teacherManagement->getAllRequest();
    foreach ($teachers as $teacher) { ?>
      <div class="row justify-content-center m-2" onclick="mostrarInformacionUsuario('<?php echo $teacher['nombre']; ?>', '<?php echo $teacher['fechaEscogida']; ?>', '<?php echo $teacher['estado']; ?>', '<?php echo $teacher['solicitud']; ?>')">
        <div class="col-md-6" data-bs-toggle="modal" data-bs-target="#myModal">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Nombre: <?php echo $teacher['nombre']; ?></h5>
              <p class="card-text">Fecha escogida:  <?php echo $teacher['fechaEscogida']; ?></p>
              <p class="card-text">Estado: <?php echo $teacher['estado']; ?></p>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
    <!-- Añade más cards según sea necesario -->
  </div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detalles del Elemento</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><strong>Nombre:</strong> <span id="elementName"></span></p>
        <p><strong>Fecha escogida:</strong> <span id="elementDate"></span></p>
        <p><strong>Estado:</strong> <span id="elementStatus"></span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Guardar cambios</button>
      </div>
    </div>
  </div>
</div>




</body>

</html>
