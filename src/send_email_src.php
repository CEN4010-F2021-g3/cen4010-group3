<?php
//Create a new PHPMailer instance
require_once '../PHPMailer/PHPMailerAutoload.php';
$mail = new PHPMailer();
$mail->IsSMTP();
 
//Configuracion servidor mail
$mail->From = "principles.group3@gmail.com"; //remitente
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls'; //seguridad
$mail->Host = "smtp.gmail.com"; // servidor smtp
$mail->Port = 587; //puerto
$mail->Username ='principles.group3@gmail.com'; //nombre usuario
$mail->Password = 'Principlesgroup3.'; //contraseña
$mail->SetFrom('principles.group3@gmail.com');

//Agregar destinatario
$mail->AddAddress('mauricioretanaiii@gmail.com');
$mail->Subject = 'Reset your password for Group 3 Website';
$mail->Body = 'We have received a password reset request for your account. The link to reset your password is: https://localhost/principles_website';

//Avisar si fue enviado o no y dirigir al index
if ($mail->Send()) {
    echo'<script type="text/javascript">
           alert("Enviado Correctamente");
        </script>';
} else {
    echo'<script type="text/javascript">
           alert("NO ENVIADO, intentar de nuevo");
        </script>';
}