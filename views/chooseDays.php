<?php
session_start();
require_once '../controllers/AuthController.php';
require_once '../config/connection.php';

$authController = new AuthController($db);
$user = $authController->getCurrentUser();
$idProfesor = $user['id'];
echo'<input type="hidden" name="userId" id="userId" value="'.$idProfesor.'">';
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

<body>
  <?php
  $nameView = "Perfil";
  $indexPage = "../index.php";
  include("../views/header.php");
  $nombre = explode(" ",$user['nombre']);
    ?>

  <div class="d-flex justify-content-center ">

    <div id="calendar" class=""></div>

  </div>

  <!-- BIENVENIDA -->

  <!-- <div class="bienvenida" id="bienvenida">
    <div class="titulo">
      <?php
      echo '<h2>Bienvenido ' . $user["nombre"] . '</h2>';
      ?>

    </div>
    <div class="texto">
      <p>Empieza a escoger dias libres clickando en los dias del calendario.
      </p>
    </div>
    <a id="cerrarBienvenida">✖</a>
    <script>
      document.getElementById("cerrarBienvenida").addEventListener('click', function () {

        document.getElementById("bienvenida").style.display = "none";
        document.getElementById("calendar").style.filter = "blur(0px)";
        document.getElementById("seleccionDeDias").style.filter = "blur(0px)";

      })
    </script>
  </div> -->
  <!-- Contenedor de error -->
  <div class="contenedor" id="error">
    
    <div class="new-box" id="new-box">
      <img src="http://100dayscss.com/codepen/alert.png">
      <h2>Oh vaya</h2>
      <p>No puede escoger mas de 4 dias libres</p>
      <div class="button" id="button" onclick="esconder()">Deshacer</div>
      <label for="button"></label>
    </div>
  </div>

  <!-- Lista de dias y apertura de formulario -->
  <div class="container text-center justify-content-center" id="seleccionDeDias">
  <div class="container  row text-center justify-content-center">
    <div class="row col-md-4 justify-content-center text-center">
    <h1>Selección de días</h1>
    <hr>
    </div>
  
  
  <div class="boton-formulario">
    <div>
      <div class="formulario">
        <div class="contenedorDia1 text-center">
          <label for=""><b>Dia 1</b></label>
          <input type="text" name="dia0" id="dia0" onblur="funcionOnBlur(this.value)">
        </div>

        <div class="contenedorDia2 text-center">
          <label for=""><b>Dia 2</b></label>
          <input type="text" name="dia1" id="dia1" onblur="funcionOnBlur(this.value)">
        </div>

        <div class="contenedorDia3 text-center">
          <label for=""><b>Dia 3</b></label>
          <input type="text" name="dia2" id="dia2" onblur="funcionOnBlur(this.value)">
        </div>

        <div class="contenedorDia4 text-center"> 
          <label for=""><b>Dia 4</b></label>
          <input type="text" name="dia3" id="dia3" onblur="funcionOnBlur(this.value)">
        </div>
      </div>

      <div class="btn-contenedor">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal1"
          id="botonFormulario">Formulario</button>
      </div>
    </div>
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
          <form action="../index.php" method="POST" id="miFormulario">
            <div class="mb-3">
              <h4 class="modal-title" id="modal1Label">Datos del interesado</h4>
              <p>Los marcados con un * no es necesario rellenarlos</p>
            </div>
            <!-- Apellidos -->
            <div class="mb-3">
              <label for="formGroupExampleInput2" class="form-label">Apellidos</label>
              <div class="input-group">
                <span class="input-group-text">Primero</span>
                <input type="text" aria-label="First name" class="form-control" id="apellidoUno" name="apellidoUno"
                  value="<?php echo $user['apellido1']; ?>" onkeyup="this.value=NumText(this.value)" onblur="validarCampo('apellidoUno')" required>
                  
                <span class="input-group-text">Segundo</span> 
                <input type="text" aria-label="Last name" class="form-control" id="apellidoDos" name="apellidoDos"
                  value="<?php echo $user['apellido2']; ?>" onkeyup="this.value=NumText(this.value)" onblur="validarCampo('apellidoDos')" required>
              </div>
            </div>
            

            <!-- Nombre -->
            <div class="mb-3">
              <label for="formGroupExampleInput2" class="form-label">Nombre</label>
              <div class="input-group">
                <span class="input-group-text">Nombre</span>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre[0]; ?>"
                  onkeyup="this.value=NumText(this.value)" onblur="validarCampo('nombre')" required>
                <span class="input-group-text">DNI</span>
                <input type="text" class="form-control" id="dni" name="dni" value="<?php echo $user['DNI']; ?>"
                onblur="validarCampo('dni')" required>
              </div>
            </div>
            <!-- Direccion -->
            <div class="mb-3">
              <label for="formGroupExampleInput2" class="form-label">Dirección</label>
              <div class="input-group">
                <span class="input-group-text">Tipo de Vía</span>
                <input type="text" aria-label="First name" class="form-control" id="tipoDeVia" name="tipoDeVia"
                  value="<?php echo $user['tipo_via']; ?>" onblur="validarCampo('tipoDeVia')" required onkeyup="this.value=NumText(this.value)">
                <span class="input-group-text">Nombre Vía</span>
                <input type="text" aria-label="Last name" class="form-control" id="nombreDeVia" name="nombreDeVia"
                  value="<?php echo $user['nombre_via']; ?>" onblur="validarCampo('nombreDeVia')" required onkeyup="this.value=NumText(this.value)">
              </div>
              <div class="input-group">
                <span class="input-group-text">Nº</span>
                <input type="text" aria-label="Last name" class="form-control" id="numero" name="numero"
                  value="<?php echo $user['numero_via']; ?>" onkeyup="this.value=Numeros(this.value)" onblur="validarCampo('numero')" required>
              </div>
              <div class="input-group">
                <span class="input-group-text">Esc.</span>
                <input type="text" aria-label="Last name" class="form-control" id="escalera" name="escalera"
                  value="<?php echo $user['escalera']; ?>" onblur="validarCampo('escalera')" required  onkeyup="this.value=Numeros(this.value)">
                <span class="input-group-text">Piso</span>
                <input type="text" aria-label="Last name" class="form-control" id="piso" name="piso"
                  value="<?php echo $user['portal']; ?>" onblur="validarCampo('piso')" required  onkeyup="this.value=Numeros(this.value)">
                <span class="input-group-text">Puerta</span>
                <input type="text" aria-label="Last name" class="form-control" id="puerta" name="puerta"
                  value="<?php echo $user['puerta']; ?>" onblur="validarCampo('puerta')" required>
                <span class="input-group-text">Cp</span>
                <input type="text" aria-label="Last name" class="form-control" id="codigoPostal" name="codigoPostal"
                  value="<?php echo $user['CP']; ?>" onkeyup="this.value=Numeros(this.value)" onblur="validarCampo('codigoPostal')" required>

              </div>
              <div class="input-group">
                <span class="input-group-text">Provincia</span>
                <input type="text" aria-label="Last name" class="form-control" id="provincia" name="provincia"
                  value="<?php echo $user['provincia']; ?>" onkeyup="this.value=NumText(this.value)" onblur="validarCampo('provincia')" required>
              </div>
            </div>
            <div class="mb-3">
              <div class="input-group">
                <span class="input-group-text">Localidad</span>
                <input type="text" aria-label="Last name" class="form-control" id="localidad" name="localidad"
                  value="<?php echo $user['localidad']; ?>" onkeyup="this.value=NumText(this.value)" onblur="validarCampo('localidad')"required>
              </div>
            </div>
            <div class="mb-3">
              <div class="input-group">
                <span class="input-group-text">Tlf. Fijo* </span>
                <input type="text" aria-label="Last name" class="form-control" value="<?php echo $user['fijo']; ?>"
                  onkeyup="this.value=Numeros(this.value)" id="telefonoFijo" name="telefonoFijo" onblur="validarCampo('telefonoFijo')">
              </div>
            </div>
            <div class="mb-3">
              <div class="input-group">
                <span class="input-group-text">Tlf. móvil*</span>
                <input type="text" aria-label="Last name" class="form-control" value="<?php echo $user['movil']; ?>"
                  onkeyup="this.value=Numeros(this.value)" id="telefonoMovil" name="telefonoMovil" onblur="validarCampo('telefonoMovil')">
              </div>
            </div>

            <div class="mb-3">
              <label for="formGroupExampleInput2" class="form-label">Correo*</label>
              <div class="input-group">
                <span class="input-group-text">Correo Electrónico</span>
                <input type="text" aria-label="Last name" class="form-control" id="correoElectronico"
                  name="correoElectronico" readonly value="<?php echo $user['correo']; ?>" onblur="validarCampo('correoElectronico')">
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
                <select class="form-select" id="inputGroupSelect01" name="periodo" required>
                  <option value="lectivo" id="periodoLectivo" name="periodoLectivo">Periodo Lectivo</option>
                  <option value="noLectivo" id="periodoNoLectivo" name="periodoNoLectivo">Periodo No Lectivo</option>
                </select>
              </div>
            </div>
            <!-- Fechas -->
            <div class="mb-3">
              <div class="input-group">
                <span class="input-group-text">Fecha 1</span>
                <input type="text" class="form-control" id="fecha0" name="fecha0" readonly>
                <span class="input-group-text">Fecha 2</span>
                <input type="text" class="form-control" id="fecha1" name="fecha1" readonly>
              </div>
            </div>
            <!-- <div class="mb-3">
              <div class="input-group">
                <span class="input-group-text">Fecha 2</span>
                <input type="text" class="form-control" id="fecha1" name="fecha1" readonly>
              </div>
            </div> -->
            <div class="mb-3">
              <div class="input-group">
                <span class="input-group-text">Fecha 3</span>
                <input type="text" class="form-control" id="fecha2" name="fecha2" readonly>
                <span class="input-group-text">Fecha 4</span>
                <input type="text" class="form-control" id="fecha3" name="fecha3" readonly>
              </div>
            </div>
            <!-- <div class="mb-3">
              <div class="input-group">
                <span class="input-group-text">Fecha 4</span>
                <input type="text" class="form-control" id="fecha3" name="fecha3" readonly>
              </div>
            </div> -->
            <!-- Motivo -->
            <div class="mb-3">
              <label for="message-text" class="col-form-label">Informacion Adicional:</label>
              <textarea class="form-control" id="motivo" name="motivo"></textarea>
            </div>
            <!-- Firma -->
            <div class="mb-3">
              <h5 class="modal-title" >Firma</h5>
              <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-primary" data-bs-target="#modal2" id="firma" data-bs-toggle="modal">Firma</button>
              </div>
            </div> 
            <div class="mb-3">
              <input type="text" id="imagenOculta" name="imagen" required hidden>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <input type="submit" class="btn btn-secondary" name="generarPDF" id="generarPDF" data-bs-target="#modal3" data-bs-toggle="modal">
        </div>
        <!-- data-bs-target="#modal3" data-bs-toggle="modal" -->
        </form>

      </div>
    </div>
  </div>


  <!-- Segundo modal -->
  <div class="modal fade" id="modal2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1"
    data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Firma Del Interesado</h1>
          <button type="button" class="close"data-bs-target="#modal1" id="cerrarFirma" data-bs-toggle="modal">
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
          <button class="btn btn-primary" id="save-button" data-bs-target="#modal1" data-bs-toggle="modal">Guardar Firma</button>
        </div>
      </div>
    </div>
  </div>

    <!-- Tercer modal-->
    <div class="modal fade" id="modal3" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1"
    data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Solicitud de Dias Libres</h1>
        </div>
        <div class="modal-body">
          <div class="mb-3">
          <div class="mb-3">
              <h4 class="modal-title" id="modal1Label">Datos del solicitante</h4>
              <p>Los datos se han enviado correctamente y se han descargado en tu navegador</p>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" id="aceptarTercerModal" data-bs-target="#modal1" data-bs-toggle="modal">Aceptar</button>
        </div>
      </div>
    </div>
  </div>
  <?php
    include("../views/footer.php");
  ?>
  <script>
    var myModal = new bootstrap.Modal(document.getElementById('modal1'), {backdrop: 'static'});
  </script>
  <script src="../js/chooseDays.js"></script>
  <script src="../js/formularioChooseDays.js"></script>
  <script src="../js/firma.js"></script>
</body>

</html>

