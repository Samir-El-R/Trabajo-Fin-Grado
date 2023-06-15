<?php



if (isset($_POST['idProfesor'])) {
  $idProfesor = $_POST['idProfesor'];

  // Llamar a la función específica con el parámetro
  miFuncion($idProfesor);
}


function miFuncion($idProfesor)
{
  require_once '../config/connection.php';


  $query = "SELECT * FROM diasseleccionados WHERE correo = '$idProfesor'";
  $db->consulta($query);
  if ($registro = $db->extraer_registro() <= 4) {
  echo true;
  } else {
    echo false;
  }
}