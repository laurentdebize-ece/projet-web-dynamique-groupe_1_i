<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "famille";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM membre";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Afficher les données de chaque ligne
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Nom: " . $row["Nom"]. " - Prénom: " . $row["Prénom"]. "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>
