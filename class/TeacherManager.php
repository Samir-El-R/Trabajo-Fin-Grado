<?php

class TeacherManager
{

    private $db;

    public function __construct()
    {
        $host = "localhost";
        $user = "root";
        $password = "";
        $dbname = "app";
        $port = 3306;
        $socket = "";

        $db = new BBDD($host, $user, $password, $dbname, $port, $socket);
        $this->db = $db;
    }
    public function registerTeacher($nombre, $turno, $dedicacion, $correo, $contrasena)
    {
        try {
            // Validar los datos antes de registrar al profesor

            // Insertar el profesor en la base de datos
            $query = "INSERT INTO profesores (nombre,turno,dedicacion,correo,contrasena) VALUES ('$nombre','$turno','$dedicacion','$correo','$contrasena')";
            $result = $this->db->consulta($query);

            if ($result) {
                echo "Profesor registrado exitosamente";
            } else {
                throw new Exception("Error al registrar el profesor");
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function updateTeacher($nombre, $correo, $teacherId)
    {
        try {
            // Validar los datos antes de actualizar al profesor

            // Actualizar los datos del profesor en la base de datos
            $query = "UPDATE profesores SET name='$nombre', correo='$correo' WHERE id=$teacherId";
            $result = $this->db->consulta($query);

            if ($result) {
                echo "profesor actualizado exitosamente";
            } else {
                throw new Exception("Error al actualizar el profesor");
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function deleteTeacher($teacherId)
    {
        try {
            // Eliminar al profesor de la base de datos
            $query = "DELETE FROM profesores WHERE id=$teacherId";
            $result = $this->db->consulta($query);

            if ($result) {
                echo "profesor eliminado exitosamente";
            } else {
                throw new Exception("Error al eliminar el profesor");
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function getAllTeachers()
    {
        try {

            $query = "SELECT * FROM profesores";

            $result = $this->db->consulta($query);
            while ($fila = $this->db->extraer_registro()) {
                $teachers[] = $fila;
            }

            if ($teachers) {
                echo "profesor obtenidos exitosamente";
                return $teachers;
            } else {
                throw new Exception("Error al actualizar el profesor");
            }
        } catch (Exception $e) {

            echo "Error: " . $e->getMessage();
        }
    }
    public function getTeachers($query)
    {
        try {

            $result = $this->db->consulta($query);
            while ($fila = $this->db->extraer_registro()) {
                $teachers[] = $fila;
            }

            if ($teachers) {
                echo "profesor obtenidos exitosamente";
                return $teachers;
            } else {
                throw new Exception("Error al actualizar el profesor");
            }
        } catch (Exception $e) {

            echo "Error: " . $e->getMessage();
        }
    }
}

// // Ejemplo de uso de la clase
// $dbConnection = mysqli_connect('localhost', 'profesor', 'contraseña', 'basedatos'); // Configurar la conexión a la base de datos

// 

// // Registrar un profesor
// $teacherManagement->registerteacher('John Doe', 'john@example.com', 'secretpassword');

// // Actualizar un profesor
// $teacherManagement->updateteacher(1, 'Jane Smith', 'jane@example.com');

// // Eliminar un profesor
// $teacherManagement->deleteteacher(1);
