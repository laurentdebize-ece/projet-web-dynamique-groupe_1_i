<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "Omnes MySkills";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Erreur de connexion: " . $conn->connect_error);
}
?>
