<?php
session_start();
require_once '../controllers/AuthController.php';
require_once '../config/connection.php';
require_once('../class/TeacherManager.php');
$teacherManagement = new TeacherManager($db);
$authController = new AuthController($db);
$user = $authController->getCurrentUser();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../libraries/bootstrap/css/bootstrap.min.css " rel="stylesheet" />
  <link href="../css/perfileStyle.css" rel="stylesheet" />
  <script type="module" src="../libraries/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <title>Perfil</title>
</head>

<body>

  <?php
  $nameView = "Calendario";
  $indexPage="index.php";
  include("../views/header.php");
  // 
  $sql = "SELECT * FROM profesores";
  $teachers = $teacherManagement->getTeacher($sql);
  if($user['nombre']){

  }

  ?>

  <div class="container center-container mt-3 ml-3">
    <div class="row">
      <div class="col-md-8">
        <h2 class="text-center">Información de perfil</h2>
        <hr>
        <form class="row g-3 mt-3 mb-3">
          <div class="col-md-6">
            <label for="Nombre" class="form-label">Nombre:</label>
            <input type="text" class="form-control" id="inputEmail4" readonly value="<?php echo $user['nombre']; ?>">
          </div>
          <div class="col-md-6">
            <label for="correo" class="form-label">Correo electrónico:</label>
            <input type="text" class="form-control" id="inputEmail4" readonly value="<?php echo $user['correo']; ?>">
          </div>
          <div class="col-6">
            <label for="turno" class="form-label">Turno:</label>
            <input type="text" class="form-control" id="turno" readonly value="<?php echo $user['turno']; ?>">
          </div>
          <div class="col-6">
            <label for="dedicacion" class="form-label">Dedicación:</label>
            <input type="text" class="form-control" id="dedicacion" readonly value="<?php echo $user['dedicacion']; ?>">
          </div>
        </form>
      </div>
    </div>
    <div class="row mt-3 mb-3">
      <div class="col-md-8 mt-3 mb-3">
        <h2 class="text-center">Datos opcionales para el formulario</h2>
        <i class="mt-3 mb-3">*Estos campos servirán para autocompletar el formulario al solicitar dias, estos mismos se podrán modificar en el formulario de solicitud si así se desea.</i>
        <hr>
        <form action="../index.php" method="POST" class="row g-3 mt-3 mb-3">
          <div class="row g-3 mt-3 mb-3">
            <div class="col-md-6">
              <label for="inputEmail4" class="form-label">Apellido 1</label>
              <input type="text" class="form-control" name="Apellido1">
            </div>
            <div class="col-md-6">
              <label for="inputPassword4" class="form-label">Apellido 2</label>
              <input type="text" class="form-control" name="Apellido2">
            </div>
          </div>
          <div class="row g-3">
            <div class="col-6">
              <label for="DNI" class="form-label">DNI</label>
              <input type="text" class="form-control" name="DNI" placeholder="XXXXXXXXXX">
            </div>
          </div>
          <div class="row g-3">
            <div class="col-md-6">
              <label for="fijo" class="form-label">Teléfono fijo</label>
              <input type="number" class="form-control" name="fijo" placeholder="000000000">
            </div>
            <div class="col-md-6">
              <label for="movil" class="form-label">Teléfono movil</label>
              <input type="number" class="form-control" name="movil" placeholder="000000000">
            </div>
          </div>
          <div class="row g-3">
              <input type="submit" class="btn btn-primary" name="info">
            </div>
        </form>
          <div class="row g-3">
            <h4 class="text-center">Información de dirección</h4>
          </div>
          <hr>
          <form action="../index.php" method="POST">
            <div class="row g-3 mt-3 mb-3">            
              <div class="col-md-2">
                <label for="tipo_via" class="form-label">Tipo de via</label>
                <select id="tipo_via" class="form-select">
                  <option selected>Calle</option>
                  <option>Avenida</option>
                  <option>Plaza</option>
                </select>
              </div>
              <div class="col-md-9">
                <label for="nombre_via" class="form-label">Nombre de via</label>
                <input type="text" class="form-control" id="nombre_via" placeholder="Islas Canarias">
              </div>
              <div class="col-md-1">
                <label for="numero_via" class="form-label">Nº</label>
                <input type="number" class="form-control" id="numero_via">
              </div>
            </div>
            <div class="row g-3 d-flex justify-content-between">
              <div class="col-md-1">
                <label for="portal" class="form-label">Nº Portal</label>
                <input type="number" class="form-control" id="portal">
              </div>
              <div class="col-md-1">
                <label for="escalera" class="form-label">Nº Escalera</label>
                <input type="number" class="form-control" id="escalera">
              </div>
              <div class="col-md-1">
                <label for="puerta" class="form-label">Letra Puerta</label>
                <input type="text" class="form-control" id="puerta">
              </div>
            </div>
            <div class="row g-3">
              <div class="col-md-6">
                <label for="Provincia" class="form-label">Provincia</label>
                <input type="text" class="form-control" id="puerta">
              </div>
              <div class="col-md-6">
                <label for="localidad" class="form-label">Localidad</label>
                <input type="text" class="form-control" id="localidad">
              </div>
            </div>
            <div class="row g-3">
              <input type="submit" class="btn btn-primary" name="direccion">
            </div>
        </form>
      </div>
    </div>
    <div class="col-md-8 mt-3 mb-3 text-center ">
      <h2 class="text-center">Cambio de información</h2>
      <hr>
      <div class="row mt-3 mb-3 d-flex justify-content-between">
        <div class="col-sm-6">
          <h4>Cambio de contraseña</h4>
          <button class="btn btn-primary mt-3 mb-3" data-toggle="modal" data-target="#modal1">Cambio de contraseña</button>
        </div>
        <div class="col-sm-6">
          <h4>Información 2</h4>
          <button class="btn btn-primary mt-3 mb-3" data-toggle="modal" data-target="#modal2">Botón 2</button>
        </div>
      </div>
    </div>
  </div>

  </div>

  <!-- Modal 1 -->
  <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modal1Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal1Label">Cambio de contraseña</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="../index.php" method="POST">
          <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">Introduzca contraseña actual</label>
            <input type="password" class="form-control" id="contrasena1" name="contrasena_actual">
          </div>
          <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Introduzca contraseña nueva</label>
            <input type="password" class="form-control" id="contrasena2" name="contrasena_nueva">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <input type="submit" class="btn btn-secondary" name="cambiar_contrasena">
        </div>
        
        </form>
          
      </div>
    </div>
  </div>

  <!-- Modal 2 -->
  <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modal1Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal1Label">Cambio de contraseña</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" method="POST">
          <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">Introduzca contraseña</label>
            <input type="password" class="form-control" id="formGroupExampleInput">
          </div>
          <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Confirme contraseña</label>
            <input type="password" class="form-control" id="formGroupExampleInput2">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
        <input type="submit" name="cambiar_contraseña">
          </form>
          
      </div>
    </div>
  </div>




<?php
include("../views/footer.php");
?>





  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>







</body>
</html>


<?php
