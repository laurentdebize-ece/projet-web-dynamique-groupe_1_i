<?php
require_once 'BDD/initBDD.php';

if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['mot_de_passe']) && isset($_POST['groupe']) && isset($_POST['type'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];
    $type = $_POST['type'];
    $nom_classe = $_POST['nom_classe'];
    $promotion = $_POST['promotion'];

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
            $requete = $bdd->prepare("INSERT INTO Classes (nom_classe, promotion) VALUES (:nom_classe, :promotion)");
            $requete->bindParam(':nom_classe', $nom_classe);
            $requete->bindParam(':promotion', $promotion);
            $requete->execute();
            echo "Inscription réussie !";
            header('Location: ajout_utilisateur.php');
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Inscription</title>

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

        <script>
            document.getElementById('type').addEventListener('change', function () {
                var groupeSection = document.getElementById('groupeSection');
                if (this.value === 'etudiant') {
                    groupeSection.style.display = 'block';
                } else {
                    groupeSection.style.display = 'none';
                }
            });
        </script>

        <div id="groupeSection" style="display: none;">
            <label for="nom_classe">Groupe :</label>
            <select id="nom_classe" name="nom_classe" required>
                <option value="">--Choisissez une option--</option>
                <option value="groupe_1">Groupe 1</option>
                <option value="groupe_2">Groupe 2</option>
                <option value="groupe_3">Groupe 3</option>
                <option value="groupe_4">Groupe 4</option>
                <option value="groupe_5">Groupe 5</option>
            </select>
            <br>

            <div>
            <label for="promotion">Promotion :</label>
                <input type="number" id="promotion" name="promotion" value="2025" required>
            </div>
        </div>

        <!--<label for="groupe">Matière :</label>
        <select id="groupe" name="groupe" required>
            <option value="">--Choisissez une option--</option>
            <option value="1">Mathématiques</option>
            <option value="2">Physique</option>
            <option value="3">Informatique</option>
            <option value="3">Électronique</option>
        </select>
        <br>-->

        <button type="submit">Inscription</button>
    </form>
</body>

</html>