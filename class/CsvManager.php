<?php
class CsvManager
{

    private $csvPath;
    private $db;

    public function __construct($csvPath, $db)
    {
        $this->csvPath = "/assets/" . $csvPath;
        $this->db = $db;
    }
    public function RegisterTeacherFromCSV()
    {

        $file = fopen($this->csvPath, 'r');
        if (!$file) {
            echo "Error al abrir el CSV";
            return;
        }
        while (($datos = fgetcsv($file)) !== false) {
            // 
            $nombre = $datos[0];
            $turno = $datos[1];
            $dedicacion = $datos[2];
            $correo = $datos[3];
            $contrasena = GeneratePassword();

            $teacherManagement = new TeacherManager($this->db);
            // Registrar un profesor
            $teacherManagement->registerteacher($nombre,$turno,$dedicacion,$correo,$contrasena);
        }
        fclose($file);
    }
}
