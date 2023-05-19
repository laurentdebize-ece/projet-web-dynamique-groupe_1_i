<?php
$token = $_GET['token'];
$email = openssl_decrypt(urldecode($token), 'AES-128-ECB', 'secret_key');

// Display a form to the user to enter their new password
// Once they submit that form, you'll need another script to handle updating the password in your database.
// Remember to hash the password before storing it!
echo "Hi $email, please enter your new password.";
?>
