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
require_once('class/Mailer.php');

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
$csvManager = new CsvManager($db);
$senderMail = new Mailer();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['csvLoad']) && isset($_FILES['csvFile'])) {
    $csvFile = $_FILES['csvFile'];
    $tmpFilePath = $csvFile['tmp_name'];
    $fileName = GeneratePassword() . '.csv';
    move_uploaded_file($tmpFilePath, "temp/$fileName");
    $csvManager->RegisterTeacherFromCSV($fileName);
    // header('Location: views/manageTeacherManual.php');
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout']) && $_POST['logout'] === 'true') {
    // Llamar a la función de logout en el controlador
    $authController->logout();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['toggleView']) && $_POST['views'] === 'true') {
    $_SESSION['show'] = !$_SESSION['show'];
    $adminController->showAndHiddenViews();
}
  

if ( isset($_POST['download_csv_teachers']) ) {
    $fileName = "temp/". GeneratePassword() . '.csv';
    $teacherManagement->getAllTeachersInCsv($fileName);
    
}
if ( isset($_POST['envair_bd_correo']) ) {
    $fileName = "temp/". GeneratePassword() . '.csv';
    $teacherManagement->getAllTeachersInCsvMail($fileName);
    
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $teacherManagement->deleteTeacher($_POST['id_teacher']);
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
            // Mostrar la página de director
            header('Location: director.php');
            break;
        default:

    endswitch;
} else {


    $authController->showLogin();
    // Mostrar el formulario de inicio de sesión
}
