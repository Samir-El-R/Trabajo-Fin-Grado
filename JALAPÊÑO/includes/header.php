<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="src/img/Iconos/icon.svg">
  <link rel="stylesheet" href="src/css/style.css" />
  <script src="https://kit.fontawesome.com/1d80f98c36.js" crossorigin="anonymous"></script>
  <script src="app.js"></script>
  <title>Darkom</title>
</head>

<body>
<header>
    <div class="div_titulo">
      <a href="index.php">
        <div class="logo"> <img src="src/img/Iconos/logo.png" alt="sdfsdfs"></div> </a>
        <a href="index.php"> <h1 class="titulo">Darkom</h1>
      </a>
    </div>
    <div class="lista_header">
      <ul class="ul_header">
        <li class="li_header">
          <span><a class="div_favoritos" href="">Favoritos</a></span>
        </li>
        <li class="li_header">
          <span><a class="div_publicar" href="publicarCasa.php">Publicar casa</a></span>
        </li>
        <li class="li_header">
          <button class="div_iniciar_sesion" onclick="openForm()">Iniciar Sesión</button>
  
          <div class="myform" id="myform">
            
            <div class="modal">
              <h1>Iniciar Sesión</h1>
              <form action="" method="post">
                <label for="" name="name"><b>Nombre:</b></label><br>
                <input type="text" name="name" required />
                <br><br>
                <label for="" name="name"><b>Contraseña:</b></label><br>
                <input type="password" name="pass" id="pass" required>
                <br><br>
                <label for="" name="email"><b>Email:</b></label><br>
                <input type="text" name="email" id="email" required />
                <br><br>
                <input type="submit" value="Enviar" name="submit" class="submit_iniciar_sesion div_iniciar_sesion">
                <button type="button" class="div_iniciar_sesion div_cerrar_form  " onclick="closeForm()">Cerrar</button>
              </form>
            </div>
          
          </div>
        </li>
      </ul>
    </div>
  </header>