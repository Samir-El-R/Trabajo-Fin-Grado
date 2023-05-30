<?php

require 'libraries/PHPMailer/Exception.php';
require 'libraries/PHPMailer/PHPMailer.php';
require 'libraries/PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class PDFMailer {
    private $username = "";
    private $password = "";
    private $senderEmail = "ies.jovellanos.fuenlabrada@educa.madrid.org";
    private $senderName = "Jovellanos";

    public function __construct() {
    }

    public function sendPDF($recipientName, $recipientEmail, $pdfPath) {
        try {
            $mail = new PHPMailer(true);
            
            // Server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->CharSet = 'UTF-8';
            $mail->Host = 'smtp01.educa.madrid.org';
            $mail->SMTPAuth = true;
            $mail->Username = $this->username;
            $mail->Password = $this->password;
            $mail->SMTPSecure = 'tls';
            $mail->Port = 465;
            
            // Recipients
            $mail->setFrom($this->senderEmail, $this->senderName);
            $mail->addAddress($recipientEmail, $recipientName);
            $mail->addAttachment($pdfPath, 'formulario_relleno.pdf');
            
            $mail->isHTML(true);
            $mail->Subject = 'Envío de PDF';
            $mail->Body = '¡Hola ' . $recipientName . '! Adjunto encontrarás el archivo PDF solicitado.';
            
            $mail->send();
            
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
    public function sendNotification($recipientName, $recipientEmail) {
        try {
            $mail = new PHPMailer(true);
            
            // Server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->CharSet = 'UTF-8';
            $mail->Host = 'smtp01.educa.madrid.org';
            $mail->SMTPAuth = true;
            $mail->Username = $this->username;
            $mail->Password = $this->password;
            $mail->SMTPSecure = 'tls';
            $mail->Port = 465;
            
            // Recipients
            $mail->setFrom($this->senderEmail, $this->senderName);
            $mail->addAddress($recipientEmail, $recipientName);
            $mail->isHTML(true);
            $mail->Subject = 'Envío de PDF';
            $mail->Body = '¡Hola ' . $recipientName . '! Adjunto encontrarás el archivo PDF solicitado.';
            
            $mail->send();
            
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
