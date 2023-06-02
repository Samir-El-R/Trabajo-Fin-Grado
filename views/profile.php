<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="libraries/bootstrap/css/bootstrap.min.css " rel="stylesheet" />
    <link href="css/perfileStyle.css" rel="stylesheet" />
    <script src="libraries/bootstrap/js/bootstrap.bundle.min.js"></script>
    <title>Perfil</title>
</head>
<body>
    <?php
    $nameView = "Calendario";
    include("views/header.php");
    include("views/footer.php");
    ?>
    
   <div class="container">
    <div class="row">
      <div class="col-md-8">
        <h2>Información de Perfil</h2>
        <hr>
        <form class="row g-3">
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
                <input type="text" class="form-control" id="turno" value="<?php echo $user['turno'];?>">
            </div>
            <div class="col-6">
                <label for="dedicacion" class="form-label">Dedicación:</label>
                <input type="text" class="form-control" id="dedicacion" value="<?php echo $user['dedicacion'];?>">
            </div>
        </form>
      </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <h2>Datos opcionales para el formulario</h2>
            <hr>
            <form class="row g-3">
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Apellido 1</label>
                    <input type="email" class="form-control" id="inputEmail4">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Apellido 2</label>
                    <input type="password" class="form-control" id="inputPassword4">
                </div>
                <div class="col-6">
                    <label for="DNI" class="form-label">DNI</label>
                    <input type="text" class="form-control" id="DNI" placeholder="XXXXXXXXXX">
                </div>
                <div class="col-md-6">
                    <label for="fijo" class="form-label">Teléfono fijo</label>
                    <input type="text" class="form-control" id="fijo" placeholder="000000000">
                </div>
                <div class="col-md-6">
                    <label for="movil" class="form-label">Teléfono movil</label>
                    <input type="text" class="form-control" id="movil" placeholder="000000000">
                </div>
                <div class="col-12">
                    <label for="inputAddress" class="form-label">Address</label>
                    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                </div>
                <div class="col-md-6">
                    <label for="inputCity" class="form-label">City</label>
                    <input type="text" class="form-control" id="inputCity">
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label">State</label>
                    <select id="inputState" class="form-select">
                    <option selected>Choose...</option>
                    <option>...</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="inputZip" class="form-label">Zip</label>
                    <input type="text" class="form-control" id="inputZip">
                </div>
            </form>
        </div>
    </div>
      <div class="col-md-8">
        <h2>Otra información</h2>
        <hr>
        <div class="row">
          <div class="col-sm-6">
            <h4>Cambio de contraseña</h4>
            <button class="btn btn-primary" data-toggle="modal" data-target="#modal1">Cambio de contraseña</button>
          </div>
          <div class="col-sm-6">
            <h4>Información 2</h4>
            <button class="btn btn-primary" data-toggle="modal" data-target="#modal2">Botón 2</button>
          </div>
          <div class="col-sm-6">
            <h4>Información 3</h4>
            <button class="btn btn-primary" data-toggle="modal" data-target="#modal3">Botón 3</button>
          </div>
          <div class="col-sm-6">
            <h4>Información 4</h4>
            <button class="btn btn-primary" data-toggle="modal" data-target="#modal4">Botón 4</button>
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
      </div>
    </div>
  </div>

  <!-- Modal 2 -->
  <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="modal2Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal2Label">Información 2</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Contenido aleatorio para el popup del Botón 2</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal 3 -->
  <div class="modal fade" id="modal3" tabindex="-1" role="dialog" aria-labelledby="modal3Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal3Label">Información 3</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Contenido aleatorio para el popup del Botón 3</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal 4 -->
  <div class="modal fade" id="modal4" tabindex="-1" role="dialog" aria-labelledby="modal4Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal4Label">Información 4</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Contenido aleatorio para el popup del Botón 4</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>


  <footer class="bg-light text-center text-lg-start" >
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    © 2023 
    <a class="text-dark" href="http://secretaria.iesjovellanos.org/">Secretaria IES Gaspar Melchor de Jovellanos</a>
  </div> 
</footer>



  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>







    
</body>

</html>
<?php
