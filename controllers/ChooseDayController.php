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

    public function insertarSolicitudes($correoProfesor,$data)
    {

        $query = "SELECT * FROM profesores WHERE correo = '$correoProfesor'";
        $resultado = $this->db->consulta($query);
        $fila = $this->db->extraer_registro();
        $rutaDirectorio = 'pdfDiasLibres/';

        if ($fila) {
            $idTabla1 = $fila['id'];
        
            $archivos = $this->leerDirectorios($correoProfesor);
            for ($i = 0; $i < count($data['fecha']); $i++) {
                $fecha = $data["fecha"][$i];
                $pdf =$rutaDirectorio.$archivos[$i];
                $nombreArchivo = basename($pdf); // Obtiene el nombre del archivo sin la ruta
                // Lee el contenido del archivo PDF
                $contenidoPDF = file_get_contents($pdf);
                $contenidoPDFEscapado = mysqli_real_escape_string($this->db->descriptor, $contenidoPDF);

                $insertBBDD = "INSERT INTO diasseleccionados (idProfesor, fechaEscogida, estado, solicitud) VALUES (?, ?, 'Pendiente', ?)";

                $stmt = $this->db->descriptor->prepare($insertBBDD);
                $stmt->bind_param("iss", $idTabla1, $fecha, $contenidoPDF);
                $stmt->execute();
                
                // Ejecutar la consulta preparada
                $resultado = $stmt->get_result();
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
