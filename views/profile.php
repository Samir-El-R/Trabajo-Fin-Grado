<?php
session_start();
require_once '../controllers/AuthController.php';
require_once '../config/connection.php';
require_once('../class/TeacherManager.php');
$teacherManagement = new TeacherManager($db);
$authController = new AuthController($db);
if (!$authController->isUserAuthenticated()) {
  header('Location: ../index.php');
}
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
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <title>Perfil</title>

  <script>
    function Numeros(string) {//Solo numeros
      var out = '';
      var filtro = '1234567890';//Caracteres validos

      //Recorrer el texto y verificar si el caracter se encuentra en la lista de validos 
      for (var i = 0; i < string.length; i++)
        if (filtro.indexOf(string.charAt(i)) != -1)
          //Se añaden a la salida los caracteres validos
          out += string.charAt(i);

      //Retornar valor filtrado
      return out;
    }
    function NumText(string) {//solo letras y numeros
      var out = '';
      //Se añaden las letras validas
      var filtro = 'abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ';//Caracteres validos

      for (var i = 0; i < string.length; i++)
        if (filtro.indexOf(string.charAt(i)) != -1)
          out += string.charAt(i);
      return out;
    }
  </script>
</head>

<body class="m-0 row justify-content-center">

  <?php
  $nameView = "Calendario";
  $indexPage = "../index.php";
  include("../views/header.php");
  // 
  // $sql = "SELECT * FROM profesores";
  // $teachers = $teacherManagement->getTeacher($sql);
  

  ?>





  <div class="row mt-3 mb-3 justify-content-center">
    <div class="col-md-6">
      <h2 class="text-center">Información de perfil</h2>
      <hr>
      <form class="row g-3 mt-3 mb-3 ">
        <div class="col-md-6">
          <label for="Nombre" class="form-label">Nombre:</label>
          <input type="text" class="form-control" id="nombre" readonly value="<?php echo $user['nombre']; ?>" onkeyup="this.value=NumText(this.value)">
        </div>
        <div class="col-md-6">
          <label for="correo" class="form-label">Correo electrónico:</label>
          <input type="text" class="form-control" id="inputEmail" readonly value="<?php echo $user['correo']; ?>">
        </div>
        <div class="col-6">
          <label for="turno" class="form-label">Turno:</label>
          <input type="text" class="form-control" id="turno" readonly value="<?php echo $user['turno']; ?>" onkeyup="this.value=NumText(this.value)">
        </div>
        <div class="col-6">
          <label for="dedicacion" class="form-label">Dedicación:</label>
          <input type="text" class="form-control" id="dedicacion" readonly value="<?php echo $user['dedicacion']; ?>" onkeyup="this.value=NumText(this.value)">
        </div>
      </form>
    </div>
  </div>



  <div class="row mt-3 mb-3 justify-content-center">
    <div class="col-md-6 mt-3 mb-3">
      <h2 class="text-center">Datos opcionales para el formulario</h2>
      <i class="mt-3 mb-3">*Estos campos servirán para autocompletar el formulario al solicitar dias, estos mismos se
        podrán modificar en el formulario de solicitud si así se desea.</i>
      <hr>
      <form action="../index.php" method="POST" class="row g-3 mt-3 mb-3" id="miFormulario">
        <div class="row g-3 mt-3 mb-3">
          <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Apellido 1</label>
            <input type="text" class="form-control" name="Apellido1" value="<?php echo $user['apellido1']; ?>" onkeyup="this.value=NumText(this.value)" id="apellidoUno" onblur="validarCampo('apellidoUno')">
          </div>
          <div class="col-md-6">
            <label for="inputPassword4" class="form-label">Apellido 2</label>
            <input type="text" class="form-control" name="Apellido2" value="<?php echo $user['apellido2']; ?>" onkeyup="this.value=NumText(this.value)" id="apellidoDos" onblur="validarCampo('apellidoDos')">
          </div>
        </div>
        <div class="row g-3">
          <div class="col-6">
            <label for="DNI" class="form-label">DNI</label>
            <input type="text" class="form-control" name="DNI" placeholder="XXXXXXXXXX" id="dni"
              value="<?php echo $user['DNI']; ?>" onblur="validarCampo('dni')">
          </div>
        </div>
        <div class="row g-3">
          <div class="col-md-6">
            <label for="fijo" class="form-label">Teléfono fijo</label>
            <input type="text" class="form-control" name="fijo" placeholder="000000000"
              value="<?php echo $user['fijo']; ?>" onkeyup="this.value=Numeros(this.value)" id="telefonoFijo" onblur="validarCampo('telefonoFijo')">
          </div>
          <div class="col-md-6">
            <label for="movil" class="form-label">Teléfono movil</label>
            <input type="text" class="form-control" name="movil" placeholder="000000000"
              value="<?php echo $user['movil']; ?>" onkeyup="this.value=Numeros(this.value)" id="telefonoMovil" onblur="validarCampo('telefonoMovil')">
          </div>

          <div class="row g-3 mt-3 mb-3">
            <h4 class="text-center">Información de dirección</h4>
            <hr>
            <div class="col-md-2">
              <label for="tipo_via" class="form-label">Tipo de via</label>
              <select id="tipo_via" name="tipo_via" class="form-select">
                <option value="Calle">Calle</option>
                <option value="Avenida">Avenida</option>
                <option value="Plaza">Plaza</option>
              </select>
            </div>
            <div class="col-md-9">
              <label for="nombre_via" class="form-label">Nombre de via</label>
              <input type="text" class="form-control" name="nombre_via" placeholder="Islas Canarias"
                value="<?php echo $user['nombre_via']; ?>" onkeyup="this.value=NumText(this.value)" id="nombreDeVia" onblur="validarCampo('nombreDeVia')">
            </div>
            <div class="col-md-1">
              <label for="numero_via" class="form-label">Nº</label>
              <input type="text" class="form-control" name="numero_via" value="<?php echo $user['numero_via']; ?>"  onkeyup="this.value=Numeros(this.value)" id="numero" onblur="validarCampo('numero')">
            </div>
          </div>
          <div class="row g-3 d-flex justify-content-between">
            <div class="col-md-2">
              <label for="portal" class="form-label">Piso</label>
              <input type="text" class="form-control" name="piso" value="<?php echo $user['portal']; ?>" onkeyup="this.value=Numeros(this.value)" id="piso" onblur="validarCampo('piso')">
            </div>
            <div class="col-md-2">
              <label for="escalera" class="form-label">Nº Escalera</label>
              <input type="text" class="form-control" name="escalera" value="<?php echo $user['escalera']; ?>" onkeyup="this.value=Numeros(this.value)" id="escalera" onblur="validarCampo('escalera')">
            </div>
            <div class="col-md-2">
              <label for="puerta" class="form-label">Letra Puerta</label>
              <input type="text" class="form-control" name="puerta" value="<?php echo $user['puerta']; ?>" id="puerta" onblur="validarCampo('puerta')">
            </div>
            <div class="col-md-2">
              <label for="CP" class="form-label">CP</label>
              <input type="text" class="form-control" name="CP" value="<?php echo $user['CP']; ?>" onkeyup="this.value=Numeros(this.value)" id="codigoPostal" onblur="validarCampo('codigoPostal')">
            </div>
          </div>
          <div class="row g-3">
            <div class="col-md-6">
              <label for="Provincia" class="form-label">Provincia</label>
              <input type="text" class="form-control" name="provincia" value="<?php echo $user['provincia']; ?>" onkeyup="this.value=NumText(this.value)" id="provincia" onblur="validarCampo('provincia')">
            </div>
            <div class="col-md-6">
              <label for="localidad" class="form-label">Localidad</label>
              <input type="text" class="form-control" name="localidad" value="<?php echo $user['localidad']; ?>" onkeyup="this.value=NumText(this.value)" id="localidad" onblur="validarCampo('localidad')">
            </div>
          </div>
        </div>
        <div class="row mt-3 mb-3 justify-content-center">
          <div class="row g-3 col-md-3">
            <input type="submit" class="btn btn-primary" name="info">
          </div>
        </div>
      </form>
    </div>
  </div>




  <!-- <div class="row mt-3 mb-3 justify-content-center">
      <div class="col-md-6 mt-3 mb-3">
          <h4 class="text-center">Información de dirección</h4>
          <hr>
          <form action="../index.php" method="POST" class="row g-3 mt-3 mb-3">
            <div class="row g-3 mt-3 mb-3">            
              <div class="col-md-2">
                <label for="tipo_via" class="form-label">Tipo de via</label>
                <select id="tipo_via" name="tipo_via" class="form-select">
                  <option value="Calle">Calle</option>
                  <option value="Avenida">Avenida</option>
                  <option value="Plaza">Plaza</option>
                </select>
              </div>
              <div class="col-md-9">
                <label for="nombre_via" class="form-label">Nombre de via</label>
                <input type="text" class="form-control" name="nombre_via" placeholder="Islas Canarias" value="<?php echo $user['nombre_via']; ?>">
              </div>
              <div class="col-md-1">
                <label for="numero_via" class="form-label">Nº</label>
                <input type="number" class="form-control" name="numero_via" value="<?php echo $user['numero_via']; ?>">
              </div>
            </div>
            <div class="row g-3 d-flex justify-content-between">
              <div class="col-md-1">
                <label for="portal" class="form-label">Nº Portal</label>
                <input type="number" class="form-control" name="portal" value="<?php echo $user['portal']; ?>">
              </div>
              <div class="col-md-1">
                <label for="escalera" class="form-label">Nº Escalera</label>
                <input type="number" class="form-control" name="escalera" value="<?php echo $user['escalera']; ?>">
              </div>
              <div class="col-md-1">
                <label for="puerta" class="form-label">Letra Puerta</label>
                <input type="text" class="form-control" name="puerta" value="<?php echo $user['puerta']; ?>">
              </div>
              <div class="col-md-1">
                <label for="CP" class="form-label">CP</label>
                <input type="number" class="form-control" name="CP" value="<?php echo $user['CP']; ?>">
              </div>
            </div>
            <div class="row g-3">
              <div class="col-md-6">
                <label for="Provincia" class="form-label">Provincia</label>
                <input type="text" class="form-control" name="provincia" value="<?php echo $user['provincia']; ?>">
              </div>
              <div class="col-md-6">
                <label for="localidad" class="form-label">Localidad</label>
                <input type="text" class="form-control" name="localidad" value="<?php echo $user['localidad']; ?>">
              </div>
            </div>
            <div class="row g-3">
              <input type="submit" class="btn btn-primary" name="direccion">
            </div>
        </form>
      </div>
    </div> -->





  <div class="row mt-3 mb-3 justify-content-center text-center">
    <div class=" row col-md-6 mt-3 mb-3 justify-content-center ">
      <h2 class="text-center">Cambio de contraseña</h2>
      <hr>
      <div class="row mt-3 mb-3 justify-content-center">
        <div class="col-sm-6">
          <button class="btn btn-secondary mt-3 mb-3" data-toggle="modal" data-target="#modal1">Cambio de
            contraseña</button>
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
              <input type="password" class="form-control" name="contrasena_actual">
            </div>
            <div class="mb-3">
              <label for="formGroupExampleInput2" class="form-label">Introduzca contraseña nueva</label>
              <input type="password" class="form-control" name="contrasena_nueva">
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



  <?php
  include("../views/footer.php");
  ?>
  <script src="../js/perfilForm.js"></script>
</body>

</html>