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
        // Mostrar la página de perfil
        header('Location: views/profile.php');
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

    public function mandar_direccion($userId,$userCorreo,$userPass, $tipo_via,$nombre_via,$numero_via,$portal,$escalera,$puerta,$provincia,$localidad,$CP)
    {
        
        $sql = "UPDATE profesores SET tipo_via='$tipo_via',nombre_via='$nombre_via',numero_via='$numero_via',portal='$portal',escalera='$escalera',puerta='$puerta',provincia='$provincia',localidad='$localidad',CP='$CP' WHERE id = '$userId'";
        
        $this->db->consulta($sql);
        $authController = new AuthController($this->db);
        $authController->authenticateUser($userCorreo,$userPass);
        
    }
    public function mandar_info($userId,$userCorreo,$userPass, $Apellido1,$Apellido2,$fijo,$movil,$DNI)
    {
        
        $sql = "UPDATE profesores SET apellido1 = '$Apellido1',apellido2 = '$Apellido2', DNI = '$DNI', fijo = '$fijo', movil = '$movil' WHERE id = $userId";

        $this->db->consulta($sql);
        $authController = new AuthController($this->db);
        $authController->authenticateUser($userCorreo,$userPass);
        
    }

}
