<?php
require_once 'BDD/initBDD.php';

session_start();

if (!isset($_SESSION['type']) || $_SESSION['type'] !== 'administrateur') {
    echo "Vous devez être connecté en tant qu'administrateur pour gérer les professeurs.";
    exit;
}

if (isset($_POST['email_suppression'])) {
    $email_suppression = $_POST['email_suppression'];

    // Vérification pour empêcher un administrateur de se supprimer lui-même
    if ($_SESSION['statut_id'] == 3) {
        echo "Vous ne pouvez pas vous supprimer vous-même.";
        exit;
    }

    try {
        $requete = $bdd->prepare("DELETE FROM Utilisateurs WHERE email = :email");
        $requete->bindParam(':email', $email_suppression);
        $requete->execute();

        if ($requete->rowCount() > 0) {
            echo "L'utilisateur a été supprimé avec succès.";
        } else {
            echo "Aucun utilisateur trouvé avec cet email.";
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
$query = $bdd->prepare("SELECT * FROM Utilisateurs WHERE statut_id IN ((SELECT id FROM Statut WHERE statut = 'professeur'), (SELECT id FROM Statut WHERE statut = 'etudiant'))");
$query->execute();
$utilisateurs = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Administration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        h1, h2 {
            text-align: center;
            color: #6c757d;
        }

        form {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #6c757d;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        .container {
            display: flex;
            justify-content: space-between;
        }

        .left, .right {
            flex: 1;
            padding: 20px;
        }

        .submit-btn {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            background-color: #6c757d;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-transform: uppercase;
            font-weight: bold;
        }

        .submit-btn:hover {
            background-color: #5a6268;
        }

        /* Ajout de styles pour le tableau */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ced4da;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #6c757d;
            color: #fff;
        }
    </style>

</head>

<body>
<div class="container">
    <div class="left">
        <h1>Suppression d'utilisateur</h1>
        <form action="supprimer_utilisateurs.php" method="post">
            <div>
                <label for="email_suppression">Email de l'utilisateur à supprimer :</label>
                <input type="email" id="email_suppression" name="email_suppression" required>
            </div>
            <button type="submit" class="submit-btn">Supprimer l'utilisateur</button>
        </form>
    </div>

    <div class="right">
        <h2>Utilisateurs existants</h2>
        <table>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Statut</th>
            </tr>
            <?php foreach ($utilisateurs as $utilisateur): ?>
                <tr>
                    <td><?php echo htmlspecialchars($utilisateur['nom']); ?></td>
                    <td><?php echo htmlspecialchars($utilisateur['prenom']); ?></td>
                    <td><?php echo htmlspecialchars($utilisateur['email']); ?></td>
                    <?php

                    if ($utilisateur['statut_id'] == 3) { ?>
                        <td><?php echo htmlspecialchars("Administrateur"); ?></td>
                        <?php
                    } else if ($utilisateur['statut_id'] == 1) { ?>
                    <td><?php echo htmlspecialchars("Etudiant"); ?></td>
                    <?php
                    } else if ($utilisateur['statut_id'] == 2) { ?>
                        <td><?php echo htmlspecialchars("Professeur"); ?></td>
                        <?php
                    } ?>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

</body>

</html>
