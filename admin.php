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

// Evitar el almacenamiento en caché de la página
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

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
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['toggleView']) && $_POST['views'] === 'true') {
    $_SESSION['show'] = !$_SESSION['show'];
    $adminController->showAndHiddenViews();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registerWithCSV'])) {

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if ($_FILES['file']['name'] != null) {
        $fileName = $_FILES['file']['name'];
        $fileType = $_FILES['file']['type'];
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        $nombre_imagen_perfil = 'perfil-' . substr(str_shuffle($permitted_chars), 0, 12) . '.';
        $nombre_imagen_perfil .= $extension;
        if ($fileType == "image/jpeg" || $fileType == "image/png") {

            move_uploaded_file($_FILES['file']['tmp_name'], "../imagen/img_perfil/$nombre_imagen_perfil");

            $MyBBDD->consulta("INSERT INTO registro (usuario,nombre,apellido,fecha_creacion,email,contrasena,imagen_perfil) values ('$usuario','$nombre','$apellidos','$fecha','$correo','$contrasena','$nombre_imagen_perfil')");
            $MyBBDD->consulta("SELECT * FROM registro where usuario = '$usuario'");

            if ($MyBBDD->numero_filas() > 0) {

                echo '<script> alert("Usuario Registrado"); </script>';
            } else {
                echo '<script> alert("Hay un error en la base de datos"); </script>';
            }
        } else {

            echo "Formato no valido";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    // eliminar user
}
if ($authController->isUserAuthenticated()) {
    $user = $authController->getCurrentUser();
    switch ($user["roles"]):
        case "admin":
            $adminController->showAndHiddenViews();
            //    header('Location: admin.php');
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