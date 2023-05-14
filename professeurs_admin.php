<?php
require_once 'BDD/initBDD.php';

session_start();

if (!isset($_SESSION['type']) || $_SESSION['type'] !== 'administrateur') {
    echo "Vous devez être connecté en tant qu'administrateur pour ajouter un utilisateur.";
    exit;
}

$query = $bdd->prepare("SELECT * FROM Utilisateurs WHERE statut_id = 2");
$query->execute();

$professeurs = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des professeurs</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Liste des professeurs</h1>
<table>
    <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
        <!-- Ajoutez d'autres colonnes si nécessaire -->
    </tr>
    <?php foreach ($professeurs as $professeur): ?>
        <tr>
            <td><?php echo htmlspecialchars($professeur['nom']); ?></td>
            <td><?php echo htmlspecialchars($professeur['prenom']); ?></td>
            <td><?php echo htmlspecialchars($professeur['email']); ?></td>
            <!-- Ajoutez d'autres colonnes si nécessaire -->
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
