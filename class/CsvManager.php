<?php
class CsvManager
{

    private $csvPath;
    private $db;

    public function __construct( $db)
    {
        $this->db = $db;
    }
    public function RegisterTeacherFromCSV($fileName)
    {
        $this->csvPath = 'temp/'.$fileName;
        $numFila = 0;
        $file = fopen($this->csvPath, 'r');
        if (!$file) {
            echo "Error al abrir el CSV";
            return;
        }
        while (($datos = fgetcsv($file)) !== false) {
            if ($numFila == 0) {
                $numFila ++;

            } else {

                $nombre = $datos[0];
                $turno = $datos[1];
                $dedicacion = $datos[2];
                $correo = $datos[3];
                $contrasena = GeneratePassword();
                $senderMail = new Mailer();
                $senderMail->sendNotification($nombre,$correo,$contrasena);
                $teacherManagement = new TeacherManager($this->db);
                // Registrar un profesor
                $teacherManagement->registerteacher($nombre, $turno, $dedicacion, $correo, $contrasena);
            }
        }
        fclose($file);
        unlink($this->csvPath);
    }
}
