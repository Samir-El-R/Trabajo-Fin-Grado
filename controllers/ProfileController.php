<?php
// Archivo ProfileController.php

class ProfileController
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function showProfile()
    {
        // Obtener el usuario actualmente autenticado
        $authController = new AuthController($this->db);
        $user = $authController->getCurrentUser();

        // Mostrar la página de perfil
        require_once 'views/profile.php';
    }


    private function verifyOldPassword($userId, $oldPassword)
    {
        $query = "SELECT * FROM profesores WHERE id = $userId";
        $this->db->consulta($query);

        if ($this->db->numero_filas() > 0) {
            $user = $this->db->extraer_registro();
            $storedPassword = $user['contrasena'];

            // Verificar si la contraseña antigua coincide con la almacenada
            if ($oldPassword === $storedPassword) {
                return true;
            }
        }

        return false;
    }

    private function updatePassword($userId, $newPassword)
    {
        // Actualizar la contraseña en la base de datos
        $query = "UPDATE profesores SET contrasena = '$newPassword' WHERE id = $userId";
        $this->db->consulta($query);
    }

    public function changePassword($userId, $oldPassword, $newPassword)
    {
        // Validar los datos y realizar el cambio de contraseña
        if ($this->verifyOldPassword($userId, $oldPassword)) {
            $this->updatePassword($userId, $newPassword);
            echo "¡Contraseña cambiada con éxito!";
        } else {
            echo "La contraseña antigua es incorrecta. Inténtalo de nuevo.";
        }
    }
}
