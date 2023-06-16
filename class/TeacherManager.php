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
            if ($this->db->numero_filas() > 0) {
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
            $query = "DELETE diasseleccionados, profesores
            FROM diasseleccionados
            JOIN profesores ON diasseleccionados.idProfesor = '$teacherId";
            $result = $this->db->consulta($query);
            echo $result;

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

            if ($this->db->numero_filas() > 0) {

                return $teachers;
            }
        } catch (Exception $e) {

            return false;
        }
    }
    public function getAllRequest($estado = "Pendiente")
    {
        try {

            $query = "SELECT d.*,p.nombre,p.correo
            FROM diasseleccionados d
            INNER JOIN profesores p ON p.id = d.idProfesor
            WHERE d.estado = '$estado'";

            $result = $this->db->consulta($query);
            while ($fila = $this->db->extraer_registro()) {
                $teachers[] = $fila;
            }

            if ($this->db->numero_filas() > 0) {

                return $teachers;
            }
        } catch (Exception $e) {

            return false;
        }
    }
    public function getTeacher($query)
    {
        try {

            $result = $this->db->consulta($query);
            while ($fila = $this->db->extraer_registro()) {
                $teachers[] = $fila;
            }
            if ($this->db->numero_filas() > 0) {

                return $teachers;
            }
        } catch (Exception $e) {

            return false;
        }
    }
    public function getAllTeachersInCsv($fileName)
    {



        $query = "SELECT nombre, correo	, dedicacion , turno FROM profesores";

        $this->db->consulta($query);
        if ($this->db->numero_filas() > 0) {

            $modo = file_exists($fileName) ? 'a+' : 'w';
            $archivo = fopen($fileName, $modo);

            // Encabezados del archivo CSV
            $cabecera = array("nombre", "correo", "dedicacion", "turno");
            fputcsv($archivo, $cabecera);

            while ($fila = $this->db->extraer_registro()) {
                fputcsv($archivo, $fila);
            }
            fclose($archivo);
        }
        // Guardar el contenido en el archivo CSV
        $authController = new AuthController($this->db);
        $user = $authController->getCurrentUser();
        $senderMail = new Mailer();
        $senderMail->sendAttachment($user["nombre"], $user["correo"], $fileName);
        unlink($fileName);
    }

    public function updateSolicitudes($idProfesor, $myPath, $estado)
    {
        $query = "UPDATE diasseleccionados SET estado='$estado' WHERE idProfesor='$idProfesor' AND solicitud='$myPath'";
        $this->db->consulta($query);
    }
    public function getSolicitudes($query)
    {


        $result = $this->db->consulta($query);
        // while ($fila = $this->db->extraer_registro()) {
        //     $teachers[] = $fila;
        // }
        // if ( $this->db->numero_filas() > 0) {

        return $this->db->numero_filas();

        // }

    }
}
// }

// // Ejemplo de uso de la clase
// $dbConnection = mysqli_connect('localhost', 'profesor', 'contraseña', 'basedatos'); // Configurar la conexión a la base de datos

// 

// // Registrar un profesor
// $teacherManagement->registerteacher('John Doe', 'john@example.com', 'secretpassword');

// // Actualizar un profesor
// $teacherManagement->updateteacher(1, 'Jane Smith', 'jane@example.com');

// // Eliminar un profesor
// $teacherManagement->deleteteacher(1);
