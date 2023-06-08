<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/director.css">
  <link href="../libraries/bootstrap/css/bootstrap.min.css " rel="stylesheet" />
  <script type="module" src="../libraries/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../js/director.js"></script>
  <title>Director</title>
</head>
<body>
  
<?php
  $nameView = "Calendario";
  $indexPage="index.php";
  include("header.php");
?>
<embed src="../assets/plantilla.pdf" type="application/pdf" width="100%" height="600px">
<div class="vacaciones-seccion">

  <div class="vacaciones-tarjetas">
    <div class="vacaciones-tarjeta" onclick="mostrarInformacionUsuario('Juan Perez', '10/06/2023 - 20/06/2023', 'Viaje de vacaciones a la playa', 'Necesito descansar y relajarme.')">
      <h3>Juan Perez</h3>
      <p>Fecha de vacaciones: 10/06/2023 - 20/06/2023</p>
      <button class="vacaciones-btn-aceptar">Aceptar</button>
      <button class="vacaciones-btn-rechazar">Rechazar</button>
    </div>
    <div class="vacaciones-tarjeta" onclick="mostrarInformacionUsuario('María García', '15/07/2023 - 30/07/2023', 'Visitar a mi familia en otra ciudad', 'Es un viaje familiar muy importante para mí.')">
      <h3>María García</h3>
      <p>Fecha de vacaciones: 15/07/2023 - 30/07/2023</p>
      <button class="vacaciones-btn-aceptar">Aceptar</button>
      <button class="vacaciones-btn-rechazar">Rechazar</button>
    </div>
  </div>
   <div class="vacaciones-info">
    <h2>Información del usuario</h2>
    <p><strong>Nombre:</strong> <span id="usuario-nombre"></span></p>
    <p><strong>Fecha de vacaciones:</strong> <span id="usuario-fecha"></span></p>
    <p><strong>Descripción:</strong> <span id="usuario-descripcion"></span></p>
    <p><strong>Motivo:</strong> <span id="usuario-motivo"></span></p>
  </div>
</div>

</body>
</html>
