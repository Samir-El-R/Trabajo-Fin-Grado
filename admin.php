<?php
session_start();
// ...
require_once 'config/connection.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/ProfileController.php';
require_once 'class/CsvManager.php.php';
require_once('functions/GeneratePassword.php');
require_once('functions/TeacherManager.php');

$authController = new AuthController($db);
$profileController = new ProfileController($db);
$teacherManagement = new TeacherManager($dbConnection);
// echo "<pre>";
// var_dump($_SESSION['user']);
// echo "</pre>";
if (isset($_SESSION['is_authenticated']) && $_SESSION['is_authenticated']) {
    // Verificar si el usuario es administrador
    if ($_SESSION['user']['correo'] === 'admin@gmail.com') {
    } else {
        header('Location: index.php');
    }
} else {
    // Mostrar el formulario de inicio de sesión
    header('Location: index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout']) && $_POST['logout'] === 'true') {
    // Llamar a la función de logout en el controlador
    $authController->logout();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    // Llamar a la función de logout en el controlador
    $authController->logout();
    
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/adminStyle.css">

</head>

<body>
   <?php require_once 'views/header.php'; ?>
    <form action="" method="POST">
        <input type="hidden" name="logout" value="true">
        <input type="submit" value="Cerrar Sesión">
    </form>
</body>

</html>