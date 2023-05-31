<?php
require_once('config/connection.php');
session_start();
// ...
require_once('controllers/ProfileController.php');
require_once('controllers/AdminController.php');
require_once('controllers/AuthController.php');
require_once('controllers/AppController.php');
require_once('class/GeneratePassword.php');
require_once('class/TeacherManager.php');
require_once('class/CsvManager.php');


// $db = new BBDD();
$profileController = new ProfileController($db);
$teacherManagement = new TeacherManager($db);
$adminController = new AdminController($db);
$authController = new AuthController($db);
$appController = new AppController($db);


// echo "<pre>";
// var_dump($_SESSION['user']);
// echo "</pre>";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout']) && $_POST['logout'] === 'true') {
    // Llamar a la función de logout en el controlador
    $authController->logout();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    // eliminar user
}
if ($authController->isUserAuthenticated()) {
    $user = $authController->getCurrentUser();
    switch ($user["roles"]):
        case "admin":
           $adminController->showAndHiddenViews();
            break;
        case "profesor":
            $appController->showAndHiddenViews();
            header('Location: index.php');
            break;
        case "director":

            break;
        default:

    endswitch;
} else {


    $authController->showLogin();
    // Mostrar el formulario de inicio de sesión
}

?>
<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/adminStyle.css">

</head>

<body>

    // $nameView = "Calendario";
    // include("views/header.php")
    ?>
    <form action="" method="POST">
        <input type="hidden" name="logout" value="true">
        <input type="submit" value="Cerrar Sesión">
    </form>
</body>

</html> -->