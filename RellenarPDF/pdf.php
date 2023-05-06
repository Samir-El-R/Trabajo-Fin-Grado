<?php
// Incluir las librerías FPDF y FPDI

require_once('lib/fpdf185/fpdf.php');
use setasign\Fpdi\Fpdi;
require_once('lib/FPDI-2.3.7/src/autoload.php');

// Obtener la ruta del archivo PDF a rellenar
$pdfTemplate = 'form-1-1.pdf';

$pdf = new Fpdi();
$pdf->AddPage();
$pdf->setSourceFile($pdfTemplate);
$tplIdx = $pdf->importPage(1);
$pdf->useTemplate($tplIdx, 0, 0);
$pdf->SetFont('Arial', '', 9);

// Posicion de los campos a rellenar y los datos a insertar

// Datos del interesado
$pdf->SetXY(45, 63);
$pdf->Write(0, 'Apellido 1º');
$pdf->SetXY(134, 63);
$pdf->Write(0, 'Apellido 2º');
$pdf->SetXY(45,68);
$pdf->Write(0, 'Nombre');
$pdf->SetXY(163, 68);
$pdf->Write(0, 'DNI');
$pdf->SetXY(49, 73);
$pdf->Write(0, 'Tipo via');
$pdf->SetXY(102, 73);
$pdf->Write(0, 'Nombre via');
$pdf->SetXY(189, 73);
$pdf->Write(0, 'Nº');
$pdf->SetXY(35, 79);
$pdf->Write(0, 'Esc.');
$pdf->SetXY(61, 79);
$pdf->Write(0, 'Piso');
$pdf->SetXY(92, 79);
$pdf->Write(0, 'Puerta');
$pdf->SetXY(117, 79);
$pdf->Write(0, 'CP');
$pdf->SetXY(150, 79);
$pdf->Write(0, 'Provincia');
$pdf->SetXY(50, 84);
$pdf->Write(0, 'Localidad');
$pdf->SetXY(127.3, 84);
$pdf->Write(0, 'Telefono fijo');
$pdf->SetXY(174, 84);
$pdf->Write(0, 'Telefono movil');
$pdf->SetXY(50, 89);
$pdf->Write(0, 'Correo electronico');

// else if para cambiar el tipo de dia Lectivo/no Lectivo
$pdf->SetXY(73.6, 107.3);
$pdf->SetFont('Arial', 'B', 34);
$pdf->Write(0, '.',0,1);

// Fecha solicitada para el permiso
$pdf->SetFont('Arial', 'B', 9);
$pdf->SetXY(113, 116);
$pdf->Write(0, '12');
$pdf->SetXY(120, 116);
$pdf->Write(0, '12');
$pdf->SetXY(132, 116);
$pdf->Write(0, '12');

$pdf->SetFont('Arial', '', 9);
$pdf->SetXY(22, 131);
$pdf->MultiCell(155, 5,iconv('UTF-8', 'ISO-8859-1',"Este es ud  d d d d d dn párrafo multilínea e inserta aklka  acnaj a d a djoa dja djoad ja dja djo adj adj ajd jvvs wv ads djoadad ,aklj dajkd ad  ja djdjsaltos de línea automáticamente"), 0, 'J');

$pdf->AddPage();
$pdf->setSourceFile($pdfTemplate);
$tplIdx = $pdf->importPage(2);
$pdf->useTemplate($tplIdx, 0, 0);

$pdf->AddPage();
$pdf->setSourceFile($pdfTemplate);
$tplIdx = $pdf->importPage(3);
$pdf->useTemplate($tplIdx, 0, 0);

// el archivo PDF rellenado
$pdf->Output('formulario_relleno.pdf', 'F');

