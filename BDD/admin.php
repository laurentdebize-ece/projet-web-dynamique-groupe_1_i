<?php
$password_admin = "123admin";
$password_etu = "123etu";
$password_prof = "123prof";

$hash_admin = password_hash($password_admin, PASSWORD_DEFAULT);
$hash_etu = password_hash($password_etu, PASSWORD_DEFAULT);
$hash_prof = password_hash($password_prof, PASSWORD_DEFAULT);

echo "Admin : $hash_admin<br>";
echo "Etudiant : $hash_etu<br>";
echo "Prof : $hash_prof<br>";
?>