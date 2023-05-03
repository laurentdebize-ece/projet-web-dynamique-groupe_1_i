<?php

// liste_utilisateurs.php
require_once 'connexion.php';

$sql = "SELECT id, nom, prenom, email, type FROM Utilisateurs";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Afficher les données de chaque utilisateur
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"] . " - Nom: " . $row["nom"] . " - Prenom: " . $row["prenom"] . " - Email: " . $row["email"] . " - Type: " . $row["type"] . "<br>";
  }
} else {
  echo "0 results";
}

$conn->close();
?>
