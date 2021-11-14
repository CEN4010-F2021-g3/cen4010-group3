<?php
if(isset($_POST['reset-request-submit'])){

    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);
    //Change this when uploading files to Namecheap servers (https://peaceofmind-cen4010.xyz/)
    //$url = "https://localhost/principles_website/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);
    $url = "https://peaceofmind-cen4010.xyz/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);

    $expires = date("U") + 1800; //expiration time

    require '../src/dbh_src.php';

    $userEmail = $_POST['email'];

    //Delete any existing token entries from pwdReset table
    $sql = "DELETE FROM pwdreset WHERE pwdResetEmail=?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        echo "There was an error with deleting!";
        exit();
    } else{
        mysqli_stmt_bind_param($stmt,'s',$userEmail);
        mysqli_stmt_execute($stmt);
    }

    //Insert new token entry into pwdReset table
    $sql = "INSERT INTO pwdreset (pwdResetEmail,pwdResetSelector,pwdResetToken,pwdResetExpires) VALUES(?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        echo "There was an error with inserting pwdReset!";
        exit();
    } else{
        $hashedToken = password_hash($token,PASSWORD_DEFAULT); //token has to be in bytes not hex
        mysqli_stmt_bind_param($stmt,'ssss',$userEmail,$selector,$hashedToken,$expires);
        mysqli_stmt_execute($stmt);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    //Sending email to user
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
    $mail->Password = '#JuanPablo1988'; //contraseña
    $mail->SetFrom('principles.group3');

    //Agregar destinatario
    $mail->AddAddress($userEmail);
    $mail->Subject = 'Reset your password for Group 3 Website';
    $mail->Body = 'We have received a password reset request from your account. Click the following link in order to reset your password ' . $url;

    //Avisar si fue enviado o no y dirigir al index
    if ($mail->Send()) {
        echo'<script type="text/javascript">
            alert("An email to recover your password has been sent to you. Check your email!");
            </script>';
    } else {
        echo'<script type="text/javascript">
            alert("Something went wrong. Try again!");
            </script>';
    }

    header('Location: ../reset_password.php?reset=success');

} else{
    header('Location: ../index.php');
}