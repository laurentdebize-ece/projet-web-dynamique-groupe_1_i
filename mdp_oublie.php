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



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Changement de mot de passe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .form-group button {
            padding: 8px 20px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #45a049;
        }

        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>

<body>
<div class="container">
    <h2>Changement de mot de passe</h2>
    <form action="mdp_oublie.php" method="post">
        <div class="form-group">
            <label for="email">Adresse e-mail :</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <button type="submit">Changer le mot de passe</button>
        </div>
    </form>
</div>
</body>

</html>

