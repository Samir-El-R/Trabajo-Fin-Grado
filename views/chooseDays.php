<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>IES GM Jovellanos</title>
  <link href="libraries/bootstrap/css/bootstrap.min.css " rel="stylesheet" />
  <script  src="libraries/bootstrap/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="css/chooseDaysStyle.css" />
  <script  src="libraries/fullcalendar-6.1.4/dist/index.global.js"></script>
</head>

<body>
  <?php
  include("views/header.php")
  ?>

  <div class="d-flex justify-content-center ">

    <div id="calendar" class="w-50 h-75"></div>

  </div>
  <?php
  include("views/footer.php")
  ?>
  <script type="module" src="js/chooseDays.js"></script>

</body>

</html>