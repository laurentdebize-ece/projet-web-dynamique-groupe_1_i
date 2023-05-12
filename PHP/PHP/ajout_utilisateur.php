<?php
require_once 'connexion.php';

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$mot_de_passe = $_POST['mot_de_passe'];
$type = $_POST['type'];

try {
    $requete = $bdd->prepare("SELECT email FROM Utilisateurs WHERE email = :email");
    $requete->bindParam(':email', $email);
    $requete->execute();
    if ($requete->rowCount() > 0) {
        echo "L'email existe déjà, veuillez en choisir un autre.";
    } else {
        $requete = $bdd->prepare("SELECT id FROM Status WHERE statut = :type");
        $requete->bindParam(':type', $type);
        $requete->execute();
        $status_id = $requete->fetchColumn();

        $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);
        $requete = $bdd->prepare("INSERT INTO Utilisateurs (nom, prenom, email, mot_de_passe, status_id) VALUES (:nom, :prenom, :email, :mot_de_passe, :status_id)");
        $requete->bindParam(':nom', $nom);
        $requete->bindParam(':prenom', $prenom);
        $requete->bindParam(':email', $email);
        $requete->bindParam(':mot_de_passe', $mot_de_passe_hash);
        $requete->bindParam(':status_id', $status_id);
        $requete->execute();
        echo "Inscription réussie !";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
</head>
<body>
    <h1>Inscription</h1>
    <form action="ajout_utilisateur.php" method="post">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>
        <br>
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required>
        <br>
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required>
        <br>
        <label for="type">Type :</label>
        <select id="type" name="type" required>
            <option value="">--Choisissez une option--</option>
            <option value="etudiant">Étudiant</option>
            <option value="professeur">Professeur</option>
        </select>
        <br>
        <button type="submit">Inscription</button>
    </form>
</body>
</html>
