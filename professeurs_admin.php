<?php
require_once 'BDD/initBDD.php';

session_start();

if (!isset($_SESSION['type']) || $_SESSION['type'] !== 'administrateur') {
    echo "Vous devez être connecté en tant qu'administrateur pour ajouter un utilisateur.";
    exit;
}

if (isset($_POST['nom'], $_POST['prenom'], $_POST['ecole'], $_POST['email'], $_POST['mot_de_passe'], $_POST['type'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $ecole = $_POST['ecole'];
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);
    $statut_id = 2;

    if (isset($_POST['matiere'], $_POST['volume_horaire'])) {
        $matiere = $_POST['matiere'];
        $volume_horaire = $_POST['volume_horaire'];

        // Vérifier si la matière existe déjà
        $requete = $bdd->prepare("SELECT * FROM Matieres WHERE nom = :nom AND volume_horaire = :volume_horaire");
        $requete->bindParam(':nom', $matiere);
        $requete->bindParam(':volume_horaire', $volume_horaire);
        $requete->execute();

        $matiere_id = null;

        // Si la classe n'existe pas, la créer
        if ($requete->rowCount() == 0) {
            $requete = $bdd->prepare("INSERT INTO Matieres (nom, volume_horaire) VALUES (:nom, :volume_horaire)");
            $requete->bindParam(':nom', $nom);
            $requete->bindParam(':volume_horaire', $volume_horaire);
            $requete->execute();
        }
        else {
            // Si la classe existe déjà, récupérer son ID
            $classe = $requete->fetch();
            $matiere_id = $matiere['id'];
        }
        // Récupérer l'ID de la classe
        $matiere_id = $bdd->lastInsertId();
    }

    try {
        $requete = $bdd->prepare("INSERT INTO Utilisateurs (nom, prenom, email, mot_de_passe, ecole, statut_id) VALUES (:nom, :prenom, :email, :mot_de_passe, :ecole, :statut_id)");
        $requete->bindParam(':nom', $nom);
        $requete->bindParam(':prenom', $prenom);
        $requete->bindParam(':email', $email);
        $requete->bindParam(':mot_de_passe', $mot_de_passe);
        $requete->bindParam(':ecole', $ecole);
        $requete->bindParam(':statut_id', $statut_id);
        $requete->execute();

        // Récupérer l'ID de l'utilisateur
        $user_id = $bdd->lastInsertId();

        // Insérer l'ID de l'utilisateur et l'ID de la classe dans la table etudiant_classe
        $requete = $bdd->prepare("INSERT INTO Etudiants_classes (id_etudiant, id_classe) VALUES (:id_etudiant, :id_classe)");
        $requete->bindParam(':id_etudiant', $user_id);
        $requete->bindParam(':id_classe', $classe_id);
        $requete->execute();

        echo "L'utilisateur a été ajouté avec succès.";
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

$query = $bdd->prepare("SELECT * FROM Utilisateurs WHERE statut_id = 2");
$query->execute();

$professeurs = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des étudiants</title>
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

<h1 class="centered-title">Gestion des professeurs</h1>

<div class="container">
    <div class="left">
        <h2>Ajouter un professeur</h2>
        <form action="etudiants_admin.php" method="post">
            <input type="hidden" id="type" name="type" value="etudiant">
            <div>
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" required>
            </div>
            <div>
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" required>
            </div>
            <div>
                <label for="ecole">Ecole :</label>
                <input type="text" id="ecole" name="ecole" value="ECE" required>
            </div>
            <div>
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="mot_de_passe">Mot de passe :</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" required>
            </div>
            <div>
                <label for="matiere">Matière :</label>
                <input type="number" id="matiere" name="matiere" min="1" max="10">
            </div>
            <div>
                <label for="promotion">Promotion :</label>
                <input type="number" id="promotion" name="promotion" min="1919" value="2026">
            </div>
            <button type="submit" class="submit-btn">Ajouter</button>
        </form>
    </div>

    <div class="right">
        <h2>Professeurs existants</h2>
        <table>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
            </tr>
            <?php foreach ($professeurs as $professeurs): ?>
                <tr>
                    <td><?php echo htmlspecialchars($professeurs['nom']); ?></td>
                    <td><?php echo htmlspecialchars($professeurs['prenom']); ?></td>
                    <td><?php echo htmlspecialchars($professeurs['email']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

</body>
</html>
