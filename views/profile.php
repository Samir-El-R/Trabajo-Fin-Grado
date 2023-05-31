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
    include("views/header.php")
    ?>
    <h1>Bienvenido, <?php echo $user['nombre']; ?></h1>
    <p>Correo electrónico: <?php echo $user['correo']; ?></p>

    <!-- Formulario de cambio de contraseña -->
    <form action="" method="POST">
        <h3>Cambiar Contraseña</h3>
        <div>
            <label for="old_password">Contraseña Antigua:</label>
            <input type="password" name="old_password" id="old_password" required>
        </div>
        <div>
            <label for="new_password">Nueva Contraseña:</label>
            <input type="password" name="new_password" id="new_password" required>
        </div>
        <div>
            <input type="submit" name="change_password" value="Cambiar Contraseña">
        </div>
    </form>

    <!-- Botón de logout -->

    <?php
    include("views/footer.php")
    ?>
</body>

</html>
<?php
