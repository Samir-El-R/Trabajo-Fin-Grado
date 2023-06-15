<?php
// Archivo ChooseDayController.php


class ChooseDayController
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function showChooseDay()
    {
        // Mostrar la página de calendario
        header('Location: views/chooseDays.php');
    }

    public function insertarSolicitudes($correoProfesor, $data)
    {

        $query = "SELECT * FROM profesores WHERE correo = '$correoProfesor'";
        $resultado = $this->db->consulta($query);
        $fila = $this->db->extraer_registro();
        $rutaDirectorio = 'pdfDiasLibres/';

        if ($fila) {
            $idTabla1 = $fila['id'];

            $query = "SELECT * FROM diasseleccionados WHERE id = $idTabla1";
            $this->db->consulta($query);

            if ($registro = $this->db->extraer_registro() <= 4) {
                $archivos = $this->leerDirectorios($correoProfesor);
            
            foreach ($data['fecha'] as $fecha) {
                $i = 0;
                if ($fecha != null && $fecha != '') {
                    $pdf = $rutaDirectorio . $archivos[$i];
                    $i++;

                    $insertBBDD = "INSERT INTO diasseleccionados (idProfesor, fechaEscogida, estado, solicitud) VALUES ('$idTabla1', '$fecha', 'Pendiente', '$pdf')";
                    $this->db->consulta($insertBBDD);

                }
            }
            }

        }
    }

    public function leerDirectorios($correoProfesor)
    {
        $directorio = 'pdfDiasLibres'; // Ruta del directorio a recorrer
        $nombreUsuario = $correoProfesor; // Nombre de usuario para filtrar los archivos

        if (!is_readable($directorio)) {
            exit;
        }

        $archivos = array(); // Array para almacenar los nombres de los archivos

        // Recorrer el directorio y almacenar los archivos en el array
        if ($handle = opendir($directorio)) {

            while (false !== ($archivo = readdir($handle))) {

                if ($archivo != "." && $archivo != "..") {
                    // Filtrar archivos por nombre de usuario
                    if (strpos($archivo, $nombreUsuario) !== false) {
                        $archivos[] = $archivo;

                    }
                }
            }
            closedir($handle);
            return $archivos;

        }
    }


}