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
