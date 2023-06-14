<?php

class AuthController
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function showLogin()
    {
        // Mostrar formulario de inicio de sesión
        require_once 'views/login.php';
    }

    // public function showLoginError()
    // {
    //     // Mostrar mensaje de error en el inicio de sesión
    //     require_once 'views/login_error.php';
    // }


    public function authenticateUser($email, $password)
    {
        // Realizar la lógica de autenticación utilizando la conexión a la base de datos
        $query = ("SELECT * FROM profesores where correo = '$email' AND contrasena = '$password'");
        $this->db->consulta($query);

        if ($this->db->numero_filas() > 0) {
            // Las credenciales son válidas, autenticación exitosa
            $_SESSION['user'] = $this->db->extraer_registro();
            if (!isset($_SESSION['show'])) {
                $_SESSION['show'] = true;
            }
            return true;
        }

        // Las credenciales son inválidas, autenticación fallida
        return false;
    }

    public function login($email, $password)
    {


        // Validar los datos y realizar la autenticación
        if ($this->authenticateUser($email, $password)) {
            // Autenticación exitosa, establecer la variable de sesión y mostrar la página de perfil
            $_SESSION['is_authenticated'] = true;
            $user = $this->getCurrentUser();
            switch ($user["roles"]):
                case "admin":
                    header('Location: admin.php');
                    break;
                case "profesor":
                    $AppController = new AppController($this->db);
                    $AppController->showAndHiddenViews();
                    header('Location: index.php');
                    break;
                case "director":

                    break;
                default:

            endswitch;
        } else {
            require_once 'class/ErrorManager.php'; 
            $ErrorManager = new ErrorManager();
            $ErrorManager->showNotification("<b><u>Usuario No Encontrado:</u> revisa tus credenciales</b> ","danger");
        }
    }

    public function logout()
    {
        // Cerrar sesión y redirigir al usuario a la página de inicio de sesión
        session_unset();
        session_destroy();
        header('Location: index.php');
        exit();
    }

    public function isUserAuthenticated()
    {
        // Verificar si el usuario está autenticado
        return isset($_SESSION['user']);
    }

    public function getCurrentUser()
    {
        // Obtener los datos del usuario actualmente autenticado
        return $_SESSION['user'];
    }
}
