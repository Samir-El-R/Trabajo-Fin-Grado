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

    public function insertarSolicitudes($correoProfesor, $data,$fileNames)
    {


        $query = "SELECT * FROM profesores WHERE correo = '$correoProfesor'";
        $this->db->consulta($query);
        $fila = $this->db->extraer_registro();
        $rutaDirectorio = 'pdfDiasLibres/';

        if ($fila) {
            $idTabla = $fila['id'];

            $query = "SELECT * FROM diasseleccionados WHERE idProfesor = $idTabla";
            $this->db->consulta($query);

            if ($registro = $this->db->numero_filas() <= 4) {
                $archivos = $this->leerDirectorios($correoProfesor);
                $query = "SELECT solicitud FROM diasseleccionados WHERE idProfesor = $idTabla";
                $this->db->consulta($query);
                
                $archivosBBDD = array();
                while ($registro = $this->db->extraer_registro()) {
                    $archivosBBDD[] = $registro['solicitud'];
                }
                
                
                foreach ($archivosBBDD as $archivoBBDD) {
                    $key = array_search($archivoBBDD, $archivos);
                    if ($key !== false) {
                        unset($archivos[$key]);
                    }
                }
                $archivos = array_values($archivos);
                $j = 0;
            foreach ($data['fecha'] as $fecha) {
                
                if ($fecha != null && $fecha != '') {
                    $pdf = $fileNames[$j];
                    $j++;
                    $insertBBDD = "INSERT INTO diasseleccionados (idProfesor, fechaEscogida, estado, solicitud) VALUES ('$idTabla', '$fecha', 'Pendiente', '$pdf')";
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
                        $archivos[] = $directorio."/".$archivo;

                    }
                }
            }
            closedir($handle);
            return $archivos;

        }
    }


}