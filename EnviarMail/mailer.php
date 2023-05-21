<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $pdf = $_FILES['pdf'];
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->CharSet       = 'UTF-8';
        // $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->Host       = 'smtp01.educa.madrid.org';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'usuario de educa madrid';                     //SMTP username
        $mail->Password   = 'contraseña educa';                      //SMTP password
        $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('tu_Correo@educa.madrid.org', 'Samir '); // Cambia esto por tu dirección de correo y nombre
        $mail->addAddress($correo, $nombre);
        $mail->addAttachment('../RellenarPDF/formulario_relleno.pdf', 'formulario_relleno.pdf');
        $mail->isHTML(true);
        $mail->Subject = 'Envío de PDF';
        $mail->Body = '¡Hola ' . $nombre . '! Adjunto encontrarás el archivo PDF solicitado.';
        $mail->send();

        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Enviar correo con adjunto</title>
</head>

<body>
    <h1>Enviar correo con adjunto</h1>
    <form method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required><br>

        <label for="correo">Correo:</label>
        <input type="email" name="correo" id="correo" required><br>

        <label for="pdf">Archivo PDF:</label>
        <input type="file" name="pdf" id="pdf" ><br>

        <input type="submit" value="Enviar correo">
    </form>
</body>

</html>