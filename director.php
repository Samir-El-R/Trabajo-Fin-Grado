<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/director.css">
  <link href="libraries/bootstrap/css/bootstrap.min.css " rel="stylesheet" />
  <script type="module" src="libraries/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="js/director.js"></script>
  <title>Director</title>
</head>

<body>

  <?php

  require_once('config/connection.php');
  require_once('class/TeacherManager.php');
  require_once('class/CsvManager.php');
  require_once ('class/GeneratePDF.php');
  $csvManager = new CsvManager($db);
  $teacherManagement = new TeacherManager($db);
  $formFiller = new FormFiller();

  $nameView = "";
  $indexPage = "index.php";
  include("views/header.php");
  ?>

  <div class="container w-100">
    <?php $teachers = $teacherManagement->getAllRequest();
    foreach ($teachers as $teacher) { ?>
      <div class="row justify-content-center m-2 w-100" data-bs-toggle="modal" data-bs-target="#myModal" onclick="mostrarInformacionUsuario('<?php echo $teacher['nombre']; ?>', '<?php echo $teacher['fechaEscogida']; ?>', '<?php echo $teacher['estado']; ?>','<?php echo $teacher['solicitud']; ?>')">
        <div class="col-md-6 w-75">
          <div class="card">
            <div class="card-body  ">
              <h5 class="card-title">Nombre: <?php echo $teacher['nombre']; ?></h5>
              <p class="card-text">Fecha escogida: <?php echo $teacher['fechaEscogida']; ?></p>
              <p class="card-text
              <?php
              switch ($teacher['estado']) {
                case 'Pendiente':
                  echo " text-warning";
                  break;
                case 'Aprobada':
                  echo " text-success";
                  break;
                case 'Rechazada':
                  echo " text-danger";

                  break;
              }

              ?>
              ">Estado: <?php echo  $teacher['estado']; ?>

              </p>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
    <!-- Añade más cards según sea necesario -->
  </div>

  <!-- Modal -->
  <div class=" modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
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
          <iframe id="pdfIframe" src="" width="100%" height="500px" style="display: none;"></iframe>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" onclick="mostrarPDF()">Ver La Solicitud</button>
          <form method="post" action="">
            <input type="hidden" name="path2" id="path2">
            <button type="submit" name="rechazar" class="btn btn-danger">Rechazar Solicitud</button>
          </form>
          <form method="post" action="">
          <input type="hidden" name="path1" id="path1">
            <button type="submit" name="aceptar" class="btn btn-success">Aceptar Solicitud</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php
  if (isset($_POST['aceptar'])) {
    $myPath = $_POST['path1'];
    $formFiller->chengePDF("",$myPath);

  } 
  
  ?>

</body>

</html>