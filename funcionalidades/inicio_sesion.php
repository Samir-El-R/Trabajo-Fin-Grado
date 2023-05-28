<?php
session_start();
include 'conectarse.php';

if (isset($_POST['submit'])) {
  $GLOBALS['error'] = 0;
  $correo = $_POST['correo'];
  $contrasena = $_POST['contrasena'];

  $MyBBDD->consulta("SELECT * FROM profesores where correo = '$correo' AND contrasena = '$contrasena'");

  if ($MyBBDD->numero_filas() > 0) {

    $fila = $MyBBDD->extraer_registro();
    $_SESSION["profesor"]["nombre"] = $fila['nombre'];
    $_SESSION["profesor"]["correo"] = $fila['correo'];
    

    header("location: ../PaginaWeb/calendario.php");
  } else {

    header("location: ../index.php?error=1");
  }
}
