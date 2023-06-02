<?php
// Incluir los controladores y modelos
require_once 'controllers/AuthController.php';
require_once 'controllers/ProfileController.php';
require_once 'controllers/ChooseDayController.php';
require_once 'controllers/AppController.php';
require_once 'config/connection.php';


// Iniciar la sesión
session_start();

// Crear una instancia del controlador AuthController y pasarle la conexión a la base de datos
$profileController = new ProfileController($db);

$authController = new AuthController($db);
$AppController = new AppController($db);


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email']) && isset($_POST['password']) && $_POST['login'] === 'true') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Llamar al método de login en el controlador
    $authController->login($email, $password);
}

// Verificar si se envió la solicitud de logout
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout']) && $_POST['logout'] === 'true') {
    // Llamar a la función de logout en el controlador
    $authController->logout();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['toggleView']) && $_POST['views'] === 'true') {
    $_SESSION['show'] = !$_SESSION['show'];
    $AppController->showAndHiddenViews();
}


// Verificar si el formulario de cambio de contraseña se ha enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
    $oldPassword = $_POST['old_password'];
    $newPassword = $_POST['new_password'];
    $user = $authController->getCurrentUser();
    // Llamar al método de cambio de contraseña en el controlador
    $profileController->changePassword($user['id'], $oldPassword, $newPassword);
}
// Verificar si el usuario está autenticado
if ($authController->isUserAuthenticated()) {
    $user = $authController->getCurrentUser();
    switch ($user["roles"]):
        case "admin":
            header('Location: admin.php');
            break;
        case "profesor":
            $AppController->showAndHiddenViews();
            // header('Location: index.php');
            break;
        case "director":

            break;
        default:

    endswitch;

} else {

    $authController->showLogin();
    // Mostrar el formulario de inicio de sesión
}
