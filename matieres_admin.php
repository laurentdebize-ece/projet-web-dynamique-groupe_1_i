<?php
require_once 'BDD/initBDD.php';

session_start();

if (!isset($_SESSION['type']) || $_SESSION['type'] !== 'administrateur') {
    echo "Vous devez être connecté en tant qu'administrateur pour ajouter un utilisateur.";
    exit;
}

if (isset($_POST['matiere'], $_POST['volume_horaire'])) {
    $matiere = $_POST['matiere'];
    $volume_horaire = $_POST['volume_horaire'];

    // Vérifier si la matière existe déjà
    $requete = $bdd->prepare("SELECT * FROM Matieres WHERE nom = :matiere AND volume_horaire = :volume_horaire");
    $requete->bindParam(':matiere', $matiere);
    $requete->bindParam(':volume_horaire', $volume_horaire);
    $requete->execute();

    // Si la matière n'existe pas, la créer
    if ($requete->rowCount() == 0) {
        $requete = $bdd->prepare("INSERT INTO Matieres (nom, volume_horaire) VALUES (:matiere, :volume_horaire)");
        $requete->bindParam(':matiere', $matiere);
        $requete->bindParam(':volume_horaire', $volume_horaire);
        $requete->execute();
    }
}

$query = $bdd->prepare("SELECT * FROM Matieres");
$query->execute();

$matiere = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des matières</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .container {
            display: flex;
            justify-content: space-between;
        }

        .left, .right {
            flex: 1;
            padding: 20px;
        }

        .centered-title {
            text-align: center;
        }

        .submit-btn {
            display: block;
            width: 30%;
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

    </style>
</head>
<body>
<h1 class="centered-title">Gestion des matières</h1>

<div class="container">
    <div class="left">
        <h2>Ajouter une matière</h2>
        <form action="matieres_admin.php" method="post">
            <div>
                <label for="matiere">Nom de la matière :</label>
                <input type="text" id="matiere" name="matiere" required>
            </div>
            <div>
                <label for="volume_horaire">Volume horaire :</label>
                <input type="number" id="volume_horaire" min="0" name="volume_horaire" required>
            </div>
            <button type="submit" class="submit-btn">Ajouter</button>
        </form>
    </div>
    <div class="right">
        <h2>Matières existantes</h2>
        <table>
            <tr>
                <th>Nom</th>
                <th>Volume horaire</th>
            </tr>
            <?php foreach ($matiere as $matiere): ?>
                <tr>
                    <td><?php echo htmlspecialchars($matiere['nom']); ?></td>
                    <td><?php echo htmlspecialchars($matiere['volume_horaire']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
</body>
</html>
