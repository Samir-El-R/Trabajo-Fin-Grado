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
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cambiar_contrasena'])) {
    $oldPassword = $_POST['contrasena_actual'];
    $newPassword = $_POST['contrasena_nueva'];
    $user = $authController->getCurrentUser();
    // Llamar al método de cambio de contraseña en el controlador
    $profileController->changePassword($user['id'], $oldPassword, $newPassword);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['direccion'])) {
    $tipo_via = $_POST["tipo_via"];
    $nombre_via = $_POST["nombre_via"];
    $numero_via = $_POST["numero_via"];
    $portal = $_POST["portal"];
    $escalera = $_POST["escalera"];
    $puerta = $_POST["puerta"];
    $provincia = $_POST["provincia"];
    $localidad = $_POST["localidad"];
    $user = $authController->getCurrentUser();

    $profileController->mandar_direccion($user['id'], $tipo_via,$nombre_via,$numero_via,$portal,$escalera,$puerta,$provincia,$localidad);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['info'])) {
    $Apellido1 = $_POST["Apellido1"];
    $Apellido2 = $_POST["Apellido2"];
    $fijo = $_POST["fijo"];
    $movil = $_POST["movil"];
    $DNI = $_POST["DNI"];
    $user = $authController->getCurrentUser();

    $profileController->mandar_info($user['id'], $Apellido1,$Apellido2,$fijo,$movil,$DNI);
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

            break;
        case "director":
            // Mostrar la página de director
            header('Location: views/director.php');
            break;
        default:

    endswitch;

} else {

    $authController->showLogin();
    // Mostrar el formulario de inicio de sesión
}