<?php
require_once 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

function sendMail($to, $subject, $message)
{
  require_once 'data.php';
  $mail = new PHPMailer();
  $mail->isSMTP();
  $mail->Host = $host;
  $mail->SMTPAuth = true;
  $mail->Username = $user;
  $mail->Password = $pw;
  $mail->Port = 465;
  $mail->SMTPSecure = "ssl";
  $mail->setFrom($user, 'Andrés Profe');

  // El mensaje del correo
  $mail->addAddress($to);
  $mail->Subject = $subject;
  $mail->isHTML(true);
  $mail->Body = $message;

  if (!$mail->send()) {
    exit('No se ha podido enviar el mensaje');
  }
  // Cerrar la conexión
  $mail->smtpClose();
}
