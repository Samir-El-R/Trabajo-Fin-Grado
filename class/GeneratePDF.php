<?php

// Incluir las librerías FPDF y FPDI

require_once('libraries/fpdf185/fpdf.php');
require_once('libraries/FPDI-2.3.7/src/autoload.php');

use setasign\Fpdi\Fpdi;


class FormFiller
{
    private $pdfTemplate = "assets/plantilla.pdf";
    private $data;

    public function __construct()
    {
    }

    public function fillForm($data, $correoProfesor)
    {

        $this->data = $data;
        for ($i = 0; $i < count($this->data['fecha']); $i++) {
            if ($this->data['fecha'][$i] == "") {
                break;
            }
            $pdf = new Fpdi();
            $pdf->AddPage();
            $pdf->setSourceFile($this->pdfTemplate);
            $tplIdx = $pdf->importPage(1);
            $pdf->useTemplate($tplIdx, 0, 0);
            $pdf->SetFont('Arial', '', 9);

            // Datos del interesado
            $pdf->SetXY(45, 63);
            $pdf->Write(0, iconv('UTF-8', 'ISO-8859-1', $this->data['apellido1']));
            $pdf->SetXY(134, 63);
            $pdf->Write(0, iconv('UTF-8', 'ISO-8859-1', $this->data['apellido2']));
            $pdf->SetXY(45, 68);
            $pdf->Write(0, iconv('UTF-8', 'ISO-8859-1', $this->data['nombre']));
            $pdf->SetXY(163, 68);
            $pdf->Write(0, iconv('UTF-8', 'ISO-8859-1', $this->data['dni']));
            $pdf->SetXY(49, 73);
            $pdf->Write(0, iconv('UTF-8', 'ISO-8859-1', $this->data['tipoVia']));
            $pdf->SetXY(102, 73);
            $pdf->Write(0, iconv('UTF-8', 'ISO-8859-1', $this->data['nombreVia']));
            $pdf->SetXY(189, 73);
            $pdf->Write(0, iconv('UTF-8', 'ISO-8859-1', $this->data['numero']));
            $pdf->SetXY(35, 79);
            $pdf->Write(0, iconv('UTF-8', 'ISO-8859-1', $this->data['escalera']));
            $pdf->SetXY(61, 79);
            $pdf->Write(0, iconv('UTF-8', 'ISO-8859-1', $this->data['piso']));
            $pdf->SetXY(92, 79);
            $pdf->Write(0, iconv('UTF-8', 'ISO-8859-1', $this->data['puerta']));
            $pdf->SetXY(117, 79);
            $pdf->Write(0, iconv('UTF-8', 'ISO-8859-1', $this->data['codigoPostal']));
            $pdf->SetXY(150, 79);
            $pdf->Write(0, iconv('UTF-8', 'ISO-8859-1', $this->data['provincia']));
            $pdf->SetXY(50, 84);
            $pdf->Write(0, iconv('UTF-8', 'ISO-8859-1', $this->data['localidad']));
            $pdf->SetXY(127.3, 84);
            $pdf->Write(0, iconv('UTF-8', 'ISO-8859-1', $this->data['telefonoFijo']));
            $pdf->SetXY(174, 84);
            $pdf->Write(0, iconv('UTF-8', 'ISO-8859-1', $this->data['telefonoMovil']));
            $pdf->SetXY(50, 89);
            $pdf->Write(0, iconv('UTF-8', 'ISO-8859-1', $this->data['correoElectronico']));

            // else if para cambiar el tipo de dia Lectivo/no Lectivo
            if ($this->data['periodo'] == "lectivo") {
                $pdf->SetXY(73.6, 107.3);
                $pdf->SetFont('Arial', 'B', 34);
                $pdf->Write(0, iconv('UTF-8', 'ISO-8859-1', '.'), 0, 1);
            } else {
                $pdf->SetXY(145.7, 107.3);
                $pdf->SetFont('Arial', 'B', 34);
                $pdf->Write(0, iconv('UTF-8', 'ISO-8859-1', '.'), 0, 1);
            }

            // Fecha solicitada para el permiso
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetXY(113, 116);
            $pdf->Write(0, iconv('UTF-8', 'ISO-8859-1', $this->data['fecha'][$i]));

            $pdf->SetFont('Arial', '', 9);
            $pdf->SetXY(22, 131);
            $pdf->MultiCell(155, 5, iconv('UTF-8', 'ISO-8859-1', $this->data['parrafo']), 0, 'J');

            $pdf->SetXY(22, 131);
            $pdf->Image($this->data['imagen'], 130, 218, 50, 0);

            $pdf->AddPage();
            $pdf->setSourceFile($this->pdfTemplate);
            $tplIdx = $pdf->importPage(2);
            $pdf->useTemplate($tplIdx, 0, 0);

            $pdf->AddPage();
            $pdf->setSourceFile($this->pdfTemplate);
            $tplIdx = $pdf->importPage(3);
            $pdf->useTemplate($tplIdx, 0, 0);

            // Guardar el archivo PDF rellenado
            $pdf->Output('pdfDiasLibres/DiasLibres_' . $correoProfesor . $i . '.pdf', 'F');
        }
    }
    public function savePDF($correoProfesor)
    {
        $directorio = 'pdfDiasLibres'; // Ruta del directorio a recorrer
        $nombreUsuario = $correoProfesor; // Nombre de usuario para filtrar los archivos

        if (!is_readable($directorio)) {
            echo '<script>console.log("No se puede leer el directorio. Verifica los permisos de archivo y directorio.");</script>';
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
        }

        // Comprobar si se encontraron archivos
        if (!empty($archivos)) {
            // Nombre del archivo ZIP
            $nombreZip = 'DiasLibres.zip';

            // Crear objeto ZipArchive
            $zip = new ZipArchive();

            // Crear archivo ZIP
            if ($zip->open($nombreZip, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
                // Agregar los archivos al archivo ZIP
                foreach ($archivos as $archivo) {
                    $rutaArchivo = $directorio . '/' . $archivo;
                    $nombreArchivoZip = basename($archivo); // Obtener el nombre del archivo sin la ruta
                    $zip->addFile($rutaArchivo, $nombreArchivoZip); // Especificar el nombre interno del archivo
                }

                // Cerrar el archivo ZIP
                $zip->close();

                // Descargar el archivo ZIP
                header('Content-Type: application/zip');
                header('Content-Disposition: attachment; filename="' . $nombreZip . '"');
                header('Content-Length: ' . filesize($nombreZip));
                readfile($nombreZip);

                // Eliminar el archivo ZIP después de la descarga
                unlink($nombreZip);

                // Reiniciar la página usando JavaScript

            } else {
                echo '<script>console.log("No se pudo crear el archivo ZIP.");</script>';
            }
        } else {
            echo '<script>console.log("No hay archivos en ese directorio para el usuario especificado.");</script>';
        }
    }

    public function chengePDF($motivo = "",$myPath)
    {
        


            $pdf = new Fpdi();
            $pdf->AddPage();
            $pdf->setSourceFile($myPath);
            $tplIdx = $pdf->importPage(1);
            $pdf->useTemplate($tplIdx, 0, 0);
        

            $pdf->AddPage();
            $pdf->setSourceFile($myPath);
            $tplIdx = $pdf->importPage(2);
            $pdf->useTemplate($tplIdx, 0, 0);
            $pdf->SetFont('Arial', '', 9);

            if ($motivo == "") {
                $pdf->SetXY(25, 32.3);
                $pdf->SetFont('Arial', 'B', 18);
                $pdf->Write(0, iconv('UTF-8', 'ISO-8859-1', 'X'), 0, 1);
            } else {
                $pdf->SetXY(42.3, 32.3);
                $pdf->SetFont('Arial', 'B', 18);
                $pdf->Write(0, iconv('UTF-8', 'ISO-8859-1', 'X'), 0, 1);
            }

            $pdf->AddPage();
            $pdf->setSourceFile($myPath);
            $tplIdx = $pdf->importPage(3);
            $pdf->useTemplate($tplIdx, 0, 0);

            // Guardar el archivo PDF rellenado
         
            $pdf->Output($myPath, 'F');
    }
}
