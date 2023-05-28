<?php
session_start();
include 'conectarse.php';

if (isset($_POST['submit'])) {
$GLOBALS['error'] = 0;
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

$MyBBDD->consulta("SELECT * FROM profesores where nombre = '$usuario' AND contrasena = '$contrasena'");

if ($MyBBDD->numero_filas() > 0) {

    if (!isset($_SESSION["usuario"])) {
        $_SESSION["usuario"];
    }
    
    $_SESSION["usuario"] = $usuario;
    header("location: ../PaginaWeb/Calendario.php");

  } else {
    $_SESSION["usuario"] = 0;
    header("location: ../index.php");

  }

}





