<?php
if (isset($_POST['idProfesor'])) {
  $idProfesor = $_POST['idProfesor'];

  // Llamar a la función específica con el parámetro
  recogerRegistrosProfesor($idProfesor);
}


function recogerRegistrosProfesor($idProfesor)
{
  require_once '../config/connection.php';


  $query = "SELECT * FROM diasseleccionados WHERE idProfesor = '$idProfesor'";
  $db->consulta($query);
  $resultado = $db->numero_filas();
  echo $resultado;

}