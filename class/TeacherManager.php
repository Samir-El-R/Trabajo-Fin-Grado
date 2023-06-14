<?php

class TeacherManager
{

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
    public function registerTeacher($nombre, $turno, $dedicacion, $correo, $contrasena)
    {
        try {
            // Validar los datos antes de registrar al profesor

            // Insertar el profesor en la base de datos
            $query = "INSERT INTO profesores (nombre,turno,dedicacion,correo,contrasena) VALUES ('$nombre','$turno','$dedicacion','$correo','$contrasena')";
            $result = $this->db->consulta($query);
            echo $result;
            if ($result) {
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
            } else {
                throw new Exception("Error al actualizar el profesor");
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function deleteTeacher($teacherId)
    {
        echo $teacherId;
        try {
            // Eliminar al profesor de la base de datos
            $query = "DELETE FROM profesores WHERE id=$teacherId";
            $result = $this->db->consulta($query);
            echo $result;
            // if ($result) {
            //     echo "profesor eliminado exitosamente";
            // } else {
            //     throw new Exception("Error al eliminar el profesor");
            // }
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
                
                return $teachers;
            } else {
                throw new Exception("Error al actualizar el profesor");
            }
        } catch (Exception $e) {

            echo "Error: " . $e->getMessage();
        }
    }
    public function getTeacher($query)
    {
        try {

            $result = $this->db->consulta($query);
            while ($fila = $this->db->extraer_registro()) {
                $teachers[] = $fila;
            }
            if ($teachers) {
                
                return $teachers;
            } else {
                throw new Exception("Error al actualizar el profesor");
            }
        } catch (Exception $e) {

            echo "Error: " . $e->getMessage();
        }
    }
    public function getAllTeachersInCsv($fileName){
        $query = "SELECT * FROM profesores";

         $this->db->consulta($query);
        $csvData ="";
        if ($this->db->numero_filas() > 0) {

             // Encabezados del archivo CSV
             $headers = array_keys($this->db->extraer_registro());
             $csvData .= implode(',', $headers) . "\n";

            // Datos de los registros
            while ($fila = $this->db->extraer_registro()) {
                $csvData .= implode(',', $fila) . "\n";
            }
        }
         // Guardar el contenido en el archivo CSV
        file_put_contents($fileName, $csvData);
        $authController = new AuthController($this->db);
        $user = $authController->getCurrentUser();
        $senderMail = new Mailer();
        $senderMail->sendAttachment($user["nombre"],$user["correo"],$fileName);
        unlink($fileName);
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
