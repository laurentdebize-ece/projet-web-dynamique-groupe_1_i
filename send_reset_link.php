<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$email = $_POST['email'];

$encrypted_email = openssl_encrypt($email, 'AES-128-ECB', 'secret_key');
$reset_link = urlencode($encrypted_email);

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
    $mail->Subject = 'Réinitialisation du mot de passe';
    $mail->Body    = 'Token pour réinitialiser votre mot de passe: ' . $reset_link;

    $mail->send();
    echo 'Message envoyé';
} catch (Exception $e) {
    echo "Le message n'a pas pu être envoyé. Mailer Error: {$mail->ErrorInfo}";
}
?>
