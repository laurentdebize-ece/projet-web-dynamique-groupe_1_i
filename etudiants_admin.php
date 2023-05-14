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
    $statut_id = $_POST['type']; // Récupérer la valeur du statut depuis le formulaire

    if (isset($_POST['groupe'])) {
        $groupe = $_POST['groupe'];
        $promotion = $_POST['promotion'];

        // Vérifier si la classe existe déjà
        $requete = $bdd->prepare("SELECT * FROM Classes WHERE groupe = :groupe AND promotion = :promotion");
        $requete->bindParam(':groupe', $groupe); // Utilisation de la variable $groupe au lieu de $groupe
        $requete->bindParam(':promotion', $promotion);
        $requete->execute();

        // Si la classe n'existe pas, la créer
        if ($requete->rowCount() == 0) {
            $requete = $bdd->prepare("INSERT INTO Classes (groupe, promotion) VALUES (:groupe, :promotion)");
            $requete->bindParam(':groupe', $groupe);
            $requete->bindParam(':promotion', $promotion);
            $requete->execute();
        }
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

        // Récupérer l'ID de la classe
        $requete = $bdd->prepare("SELECT id FROM Classes WHERE groupe = :groupe AND promotion = :promotion");
        $requete->bindParam(':groupe', $groupe); // Utilisation de la variable $groupe au lieu de $groupe
        $requete->bindParam(':promotion', $promotion);
        $requete->execute();

        $classe = $requete->fetch();
        $id_classe = $classe['id'];

        // Récupérer l'ID du nouvel utilisateur
        $requete = $bdd->prepare("SELECT id FROM Utilisateurs WHERE email = :email");
        $requete->bindParam(':email', $email);
        $requete->execute();

        $utilisateur = $requete->fetch();
        $id_utilisateur = $utilisateur['id'];

        // Créer une nouvelle entrée dans la table 'Etudiant_classe'
        $requete = $bdd->prepare("INSERT INTO Etudiant_classe (id_etudiant, id_classe) VALUES (:id_etudiant, :id_classe)");
        $requete->bindParam(':id_etudiant', $id_utilisateur);
        $requete->bindParam(':id_classe', $id_classe);
        $requete->execute();


        echo "L'utilisateur a été ajouté avec succès.";
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
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

<h1 class="centered-title">Gestion des étudiants</h1>

<div class="container">
    <div class="left">
        <h2>Ajouter un étudiant</h2>
        <form action="etudiants_admin.php" method="post">
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
                <label for="groupe">Groupe :</label>
                <input type="number" id="groupe" name="groupe" min="1" max="10">
            </div>
            <div>
                <label for="promotion">Promotion :</label>
                <input type="number" id="promotion" name="promotion" min="1919" value="2026">
            </div>
            <button type="submit" class="submit-btn">Ajouter</button>
        </form>
    </div>

    <div class="right">
        <h2>Etudiants existants</h2>
        <table>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
            </tr>
            <?php foreach ($etudiants as $etudiant): ?>
                <tr>
                    <td><?php echo htmlspecialchars($etudiant['nom']); ?></td>
                    <td><?php echo htmlspecialchars($etudiant['prenom']); ?></td>
                    <td><?php echo htmlspecialchars($etudiant['email']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

</body>
</html>