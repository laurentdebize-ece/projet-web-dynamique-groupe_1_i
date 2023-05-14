<?php
require_once 'BDD/initBDD.php';

session_start();

if (!isset($_SESSION['type']) || $_SESSION['type'] !== 'administrateur') {
    echo "Vous devez être connecté en tant qu'administrateur pour ajouter un utilisateur.";
    exit;
}

$query = $bdd->prepare("SELECT * FROM Utilisateurs WHERE statut_id = 1");
$query->execute();

$etudiants = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des étudiants</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Liste des étudiants</h1>
<table>
    <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
        <!-- Ajoutez d'autres colonnes si nécessaire -->
    </tr>
    <?php foreach ($etudiants as $etudiant): ?>
        <tr>
            <td><?php echo htmlspecialchars($etudiant['nom']); ?></td>
            <td><?php echo htmlspecialchars($etudiant['prenom']); ?></td>
            <td><?php echo htmlspecialchars($etudiant['email']); ?></td>
            <!-- Ajoutez d'autres colonnes si nécessaire -->
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
