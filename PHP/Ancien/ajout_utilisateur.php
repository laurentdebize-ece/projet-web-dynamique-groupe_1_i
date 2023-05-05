<?php
require_once 'connexion.php';

if (isset($_POST['submit'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];
    $type = $_POST['type'];

    $requete = "INSERT INTO Utilisateurs (nom, prenom, email, mot_de_passe, type) VALUES (:nom, :prenom, :email, :mot_de_passe, :type)";
    $stmt = $pdo->prepare($requete);
    
    try {
        $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':email' => $email,
            ':mot_de_passe' => $mot_de_passe,
            ':type' => $type
        ]);

        if ($type == 'etudiant') {
            header('Location: ../HTML/accueil_etudiant.php');
        } elseif ($type == 'professeur') {
            header('Location: ../HTML/accueil_professeur.php');
        }
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            header('Location: ../HTML/inscription.html?error=email_taken');
        } else {
            throw $e;
        }
    }
}
?>
