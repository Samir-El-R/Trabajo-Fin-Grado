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
  require_once('class/GeneratePDF.php');
  $csvManager = new CsvManager($db);
  $teacherManagement = new TeacherManager($db);
  $formFiller = new FormFiller();

  $nameView = "";
  $indexPage = "index.php";
  include("views/header.php");
  ?>

  <div class="container w-100">
    <?php
    $teachers = $teacherManagement->getAllRequest();
    if ($teachers) {
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
      <?php }
    } else { ?>
      <div class="alert alert-info mt-2  text-center" role="alert">
        No hay solicitudes
      </div>

    <?php

    } ?>
    <!-- Añade más cards según sea necesario -->
  </div>

  <!-- Modal -->
  <div class=" modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Detalles del Elemento</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" onclick="cerrarPDF()">
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

          <button type="button" name=" rechazar" class="btn btn-danger" onclick="cambiarTipo(true)" data-bs-toggle="modal" data-bs-target="#modal1">Rechazar Solicitud</button>

          <button type="button" name="aceptar" class="btn btn-success" onclick="cambiarTipo(false)" data-bs-target="#modal1" data-bs-toggle="modal">Aceptar Solicitud</button>

        </div>
      </div>
    </div>
  </div>
  <!-- Firma -->
  <div class="modal fade" id="modal2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Firma Del Interesado</h1>
          <button type="button" class="close" data-bs-target="#modal1" id="cerrarFirma" data-bs-toggle="modal">
            <span aria-hidden="true">&times;</span>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <h4 class="modal-title" id="modal1Label">Firma</h4>
            <div id="signature-container">
              <canvas id="signature-canvas"></canvas>
            </div>
          </div>
          <div class="mb-3">

            <button class="btn btn-secondary" id="limpiarFirma">Limpiar Firma</button>

          </div>
        </div>
        <div class="modal-footer">
         
            <button class="btn btn-primary" id="save-button" type="button" name="aceptar" data-bs-target="#modal1" data-bs-toggle="modal">Guardar Firma</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Formulario  -->
  <div class="modal fade" id="modal1" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modal1Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal1Label"></h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" method="POST" id="miFormulario">
            <div class="mb-3">
              <h4 class="modal-title" id="modal1Label">Datos del interesado</h4>
              <p>los marcados con un * no es necesario rellenarlos</p>
            </div>
            <!-- Motivo -->
            <div class="mb-3">
              <label for="message-text" class="col-form-label">Motivo:</label>
              <textarea class="form-control" pattern=".{4,}"  id="motivo" name="motivo" required></textarea>
            </div>
            <!-- Firma -->
            <div class="mb-3">
              <h5 class="modal-title">Firma</h5>
              <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-primary" data-bs-target="#modal2" id="firma" data-bs-toggle="modal">Firma</button>
              </div>
            </div>
            <input type="hidden" name="path" id="path">
            <input type="hidden" name="imagen" id="imagenOculta">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <input type="submit" class="btn btn-secondary" name="rechazarSolicitud" id="generarPDF" data-bs-target="#modal3" data-bs-toggle="modal">
        </div>
        <!-- data-bs-target="#modal3" data-bs-toggle="modal" -->
        </form>

      </div>
    </div>
  </div>

  <?php

  // if (isset($_POST['aceptar'])) {

    // $imageData = $_POST['imagen'];

    // // Decodificar la imagen desde formato base64
    // $imageData = str_replace('data:image/png;base64,', '', $imageData);
    // $imageData = str_replace(' ', '+', $imageData);
    // $imageData = base64_decode($imageData);

    // // Ruta y nombre de archivo donde se guardará la imagen
    // $archivoImagen = 'assets/imagen.png';

    // file_put_contents($archivoImagen, $imageData);

    // $myPath = $_POST['path'];
    // $formFiller->chengePDF("", $myPath, $archivoImagen);
  // }

  if (isset($_POST['rechazarSolicitud'])) {

    $imageData = $_POST['imagen'];
    $motivo = $_POST['motivo'];

    // Decodificar la imagen desde formato base64
    $imageData = str_replace('data:image/png;base64,', '', $imageData);
    $imageData = str_replace(' ', '+', $imageData);
    $imageData = base64_decode($imageData);

    // Ruta y nombre de archivo donde se guardará la imagen
    $archivoImagen = 'assets/imagen.png';

    file_put_contents($archivoImagen, $imageData);

    $myPath = $_POST['path'];
    $formFiller->chengePDF($motivo, $myPath, $archivoImagen);
  }

  ?>
  <script src="js/firma.js"></script>
</body>

</html>