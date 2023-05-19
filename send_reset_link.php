<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$email = $_POST['email'];

$encrypted_email = openssl_encrypt($email, 'AES-128-ECB', 'secret_key');
$reset_link = "../reset_password.php?token=" . urlencode($encrypted_email);

$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = 2;
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'pl.thomas013@gmail.com';
    $mail->Password   = 'fvxarkfroomwiktn';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    $mail->setFrom('pl.thomas013@gmail.com', 'Mailer');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = 'Reset Password';
    $mail->Body    = 'Click on this link to reset your password: ' . $reset_link;

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
