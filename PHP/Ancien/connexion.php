<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "Omnes MySkills";

try {
  $connexion = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
  $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Échec de la connexion : " . $e->getMessage();
}
?>
