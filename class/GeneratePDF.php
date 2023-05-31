<?php
// Incluir las librerías FPDF y FPDI

require_once('/libraries/fpdf185/fpdf.php');

use setasign\Fpdi\Fpdi;

require_once('/libraries/FPDI-2.3.7/src/autoload.php');
require_once('./assets/');

class FormFiller
{
    private  $pdfTemplate = "assets/plantilla.pdf";
    private $data;

    public function __construct( $data)
    {
       
        $this->data = $data;
    }

    public function fillForm()
    {
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
        $pdf->SetXY(73.6, 107.3);
        $pdf->SetFont('Arial', 'B', 34);
        $pdf->Write(0, iconv('UTF-8', 'ISO-8859-1', '.'), 0, 1);

        // Fecha solicitada para el permiso
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetXY(113, 116);
        $pdf->Write(0, iconv('UTF-8', 'ISO-8859-1', $this->data['fecha']));

        $pdf->SetFont('Arial', '', 9);
        $pdf->SetXY(22, 131);
        $pdf->MultiCell(155, 5, iconv('UTF-8', 'ISO-8859-1', $this->data['parrafo']), 0, 'J');

        $pdf->AddPage();
        $pdf->setSourceFile($this->pdfTemplate);
        $tplIdx = $pdf->importPage(2);
        $pdf->useTemplate($tplIdx, 0, 0);

        $pdf->AddPage();
        $pdf->setSourceFile($this->pdfTemplate);
        $tplIdx = $pdf->importPage(3);
        $pdf->useTemplate($tplIdx, 0, 0);

        // Guardar el archivo PDF rellenado
        $pdf->Output('formulario_relleno.pdf', 'F');
    }
}

// Obtener los datos del formulario
// $data = array(
//     'apellido1' => $_POST['apellido1'],
//     'apellido2' => $_POST['apellido2'],
//     'nombre' => $_POST['nombre'],
//     'dni' => $_POST['dni'],
//     'tipoVia' => $_POST['tipoVia'],
//     'nombreVia' => $_POST['nombreVia'],
//     'numero' => $_POST['numero'],
//     'escalera' => $_POST['escalera'],
//     'piso' => $_POST['piso'],
//     'puerta' => $_POST['puerta'],
//     'codigoPostal' => $_POST['codigoPostal'],
//     'provincia' => $_POST['provincia'],
//     'localidad' => $_POST['localidad'],
//     'telefonoFijo' => $_POST['telefonoFijo'],
//     'telefonoMovil' => $_POST['telefonoMovil'],
//     'correoElectronico' => $_POST['correoElectronico'],
//     'fecha' => $_POST['fecha'],
//     'parrafo' => $_POST['parrafo']
// );
$data = array(
    'apellido1' => 'González',
    'apellido2' => 'Pérez',
    'nombre' => 'María',
    'dni' => '12345678',
    'tipoVia' => 'Calle',
    'nombreVia' => 'Principal',
    'numero' => '123',
    'escalera' => 'A',
    'piso' => '1',
    'puerta' => 'A',
    'codigoPostal' => '12345',
    'provincia' => 'Barcelona',
    'localidad' => 'Barcelona',
    'telefonoFijo' => '123456789',
    'telefonoMovil' => '987654321',
    'correoElectronico' => 'example@example.com',
    'fecha' => '2022-01-01',
    'parrafo' => 'Este es un párrafo de ejemplo.'
);

// Crear una instancia de la clase FormFiller y llenar el formulario
$formFiller = new FormFiller($data);
$formFiller->fillForm();
