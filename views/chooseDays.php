<?php
session_start();
require_once '../controllers/AuthController.php';
require_once '../config/connection.php';

$authController = new AuthController($db);
$user = $authController->getCurrentUser();
if (!$authController->isUserAuthenticated()) {
  header('Location: ../index.php');
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>IES GM Jovellanos</title>
  <link href="../libraries/bootstrap/css/bootstrap.min.css " rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <link rel="stylesheet" href="../css/chooseDaysStyle.css" />
  <script src="../libraries/fullcalendar-6.1.4/dist/index.global.js"></script>
  <script type="module" src="../libraries/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script>
    function Numeros(string){//Solo numeros
  var out = '';
  var filtro = '1234567890';//Caracteres validos

  //Recorrer el texto y verificar si el caracter se encuentra en la lista de validos 
  for (var i=0; i<string.length; i++)
     if (filtro.indexOf(string.charAt(i)) != -1) 
           //Se añaden a la salida los caracteres validos
     out += string.charAt(i);

  //Retornar valor filtrado
  return out;
} 
function NumText(string){//solo letras y numeros
    var out = '';
    //Se añaden las letras validas
    var filtro = 'abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ';//Caracteres validos
	
    for (var i=0; i<string.length; i++)
       if (filtro.indexOf(string.charAt(i)) != -1) 
	     out += string.charAt(i);
    return out;
}
  </script>
</head>

<body>
  <?php
  $nameView = "Perfil";
  $indexPage = "index.php";
  include("../views/header.php")
    ?>

  <div class="d-flex justify-content-center ">

    <div id="calendar" class=""></div>

  </div>
  <!-- <div class="bienvenida" id="bienvenida">
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
  </div> -->
  <div class="contenedor" id="error">
    <div class="new-box" id="new-box">
      <img src="http://100dayscss.com/codepen/alert.png">
      <h2>Oh vaya</h2>
      <p>No puede escoger mas de 4 dias libres</p>
      <div class="button" id="button" onclick="esconder()">Deshacer</div>
      <label for="button"></label>
    </div>
  </div>

  <div class="boton-formulario">
    <div>
      <div class="formulario">
        <div class="contenedorDia1">
          <label for="">Dia 1</label>
          <input type="text" name="dia0" id="dia0" readonly="readonly">
        </div>

        <div class="contenedorDia2">
          <label for="">Dia 2</label>
          <input type="text" name="dia1" id="dia1" readonly="readonly">
        </div>

        <div class="contenedorDia3">
          <label for="">Dia 3</label>
          <input type="text" name="dia2" id="dia2" readonly="readonly">
        </div>

        <div class="contenedorDia4"> <label for="">Dia 4</label>
          <input type="text" name="dia3" id="dia3" readonly="readonly">
        </div>
      </div>

      <div class="btn-contenedor">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal1" id="botonFormulario">button</button>
      </div>
    </div>

  </div>


  <!-- Modal -->
  <div class="modal fade" id="modal1" data-bs-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="modal1Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal1Label">DÍAS DE LIBRE DISPOSICIÓN</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="../class/GeneratePDF.php" method="POST">
            <div class="mb-3">
              <h5 class="modal-title" id="modal1Label">Datos del interesado</h5>
            </div>
            <!-- Apellidos -->
            <div class="mb-3">
              <label for="formGroupExampleInput2" class="form-label">Apellidos</label>
              <div class="input-group">
                <span class="input-group-text">Primero</span>
                <input type="text" aria-label="First name" class="form-control" id="apellidoUno" name="apellidoUno" value="" onkeyup="this.value=NumText(this.value)">
                <span class="input-group-text">Segundo</span>
                <input type="text" aria-label="Last name" class="form-control" id="apellidoDos" name="apellidoDos" value="" onkeyup="this.value=NumText(this.value)">
              </div>
            </div>

            <!-- Nombre -->
            <div class="mb-3">
              <label for="formGroupExampleInput2" class="form-label">Nombre</label>
              <div class="input-group">
                <span class="input-group-text">Nombre</span>
                <input type="text" class="form-control" id="nombre" name="nombre" value="" onkeyup="this.value=NumText(this.value)">
                <span class="input-group-text">DNI</span>
                <input type="text" class="form-control" id="dni" name="dni" value="" >
              </div>
            </div>
            <!-- Direccion -->
            <div class="mb-3">
              <label for="formGroupExampleInput2" class="form-label">Dirección</label>
              <div class="input-group">
                <span class="input-group-text">Tipo de Vía</span>
                <input type="text" aria-label="First name" class="form-control" id="tipoDeVia" name="tipoDeVia">
                <span class="input-group-text">Nombre Vía</span>
                <input type="text" aria-label="Last name" class="form-control" id="nombreDeVia" name="nombreDeVia">
              </div>
              <div class="input-group">
                <span class="input-group-text">Nº</span>
                <input type="text" aria-label="Last name" class="form-control" id="numero" name="numero" value="" onkeyup="this.value=Numeros(this.value)">
              </div>
              <div class="input-group">
                <span class="input-group-text">Esc.</span>
                <input type="text" aria-label="Last name" class="form-control" id="escalera" name="escalera">
                <span class="input-group-text">Piso</span>
                <input type="text" aria-label="Last name" class="form-control" id="piso" name="piso">
                <span class="input-group-text">Puerta</span>
                <input type="text" aria-label="Last name" class="form-control" id="puerta" name="puerta">
                <span class="input-group-text">Cp</span>
                <input type="text" aria-label="Last name" class="form-control" id="codigoPostal" name="codigoPostal" value="" onkeyup="this.value=Numeros(this.value)">

              </div>
              <div class="input-group">
                <span class="input-group-text">Provincia</span>
                <input type="text" aria-label="Last name" class="form-control" id="provincia" name="provincia" value="" onkeyup="this.value=NumText(this.value)">
              </div>
            </div>
            <div class="mb-3">
              <div class="input-group">
                <span class="input-group-text">Localidad</span>
                <input type="text" aria-label="Last name" class="form-control" id="localidad" name="localidad" value="" onkeyup="this.value=NumText(this.value)">
              </div>
            </div>
            <div class="mb-3">
              <div class="input-group">
                <span class="input-group-text">Tlf. Fijo* </span>
                <input type="text" aria-label="Last name" class="form-control" value="" onkeyup="this.value=Numeros(this.value)" id="telefonoFijo" name="telefonoFijo">
              </div>
            </div>
            <div class="mb-3">
              <div class="input-group">
                <span class="input-group-text">Tlf. móvil*</span>
                <input type="text" aria-label="Last name" class="form-control" value="" onkeyup="this.value=Numeros(this.value)" id="telefonoMovil" name="telefonoMovil">
              </div>
            </div>

            <div class="mb-3">
              <label for="formGroupExampleInput2" class="form-label">Correo*</label>
              <div class="input-group">
                <span class="input-group-text">Correo Electrónico</span>
                <input type="text" aria-label="Last name" class="form-control" id="correoElectronico" name="correoElectronico">
              </div>
            </div>
            <!-- Dias y fechas -->
            <div class="mb-3">
              <h5 class="modal-title" id="modal1Label">Día y fecha solicitada para el permiso</h5>
            </div>
            <!-- Dia -->
            <div class="mb-3">
              <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01">Día</label>
                <select class="form-select" id="inputGroupSelect01">
                  <option value="1" id="periodoLectivo" name="periodoLectivo">Periodo Lectivo</option>
                  <option value="2" id="periodoNoLectivo" name="periodoNoLectivo">Periodo No Lectivo</option>
                </select>
              </div>
            </div>
            <!-- Fecha -->
            <div class="mb-3">
              <div class="input-group">
                <span class="input-group-text">Fecha</span>
                <input type="text" class="form-control" id="fecha" name="fecha" readonly>
              </div>
            </div>
            <!-- Motivo -->
            <div class="mb-3">
              <label for="message-text" class="col-form-label">Informacion Adicional:</label>
              <textarea class="form-control" id="motivo" name="motivo"></textarea>
            </div>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <input type="submit" class="btn btn-secondary" name="submit">
        </div>

        </form>

      </div>
    </div>
  </div>
  <script>
    var myModal = new bootstrap.Modal(document.getElementById('modal1'), {
      backdrop: 'static'
    });
    
  </script>
  <script type="module" src="../js/chooseDays.js"></script>

</body>

</html>
<?php
if (isset($_POST['submit'])) {
  require_once '../class/GeneratePDF.php';
  $data = array(
    'nombre' => $_POST["nombre"],
    'apellido1' => $_POST["apellidoUno"],
    'apellido2' => $_POST["apellidoDos"],
    'dni' => $_POST["dni"],
    'tipoVia' => $_POST["tipoDeVia"],
    'nombreVia' => $_POST["nombreDeVia"],
    'numero' => $_POST["numero"],
    'escalera' => $_POST["escalera"],
    'piso' => $_POST["piso"],
    'puerta' => $_POST["puerta"],
    'codigoPostal' => $_POST["codigoPostal"],
    'provincia' => $_POST["provincia"],
    'localidad' => $_POST["localidad"],
    'telefonoFijo' => $_POST["telefonoFijo"],
    'telefonoMovil' => $_POST["telefonoMovil"],
    'correoElectronico' => $_POST["correoElectronico"],
    'fecha ' => $_POST["fecha"],
    'parrafo' => $_POST["motivo"]


);
  $formFiller = new FormFiller($data);
  $formFiller->fillForm();
}



?>