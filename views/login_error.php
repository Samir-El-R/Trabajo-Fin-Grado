<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<script>
    document.addEventListener('DOMContentLoaded', function() {
      // Obtener la referencia al elemento de alerta
      var alerta = document.getElementById('myAlert');

      // Mostrar la alerta
      alerta.classList.add('show');

      // Ocultar la alerta después de 5 segundos
      setTimeout(function() {
        alerta.classList.remove('show');
      }, 5000);
    });
  </script>
</head>
<body>
  <div class="container mt-5">
    <div id="myAlert" class="alert alert-success alert-dismissible fade" role="alert">
      <strong>Alerta!</strong> Este mensaje desaparecerá automáticamente después de 5 segundos.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  </div>
</body>
</html>