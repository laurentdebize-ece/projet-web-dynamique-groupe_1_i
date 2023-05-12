<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once 'connexion.php';

if (isset($_POST['email']) && isset($_POST['mot_de_passe'])) {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    $requete = $bdd->prepare("SELECT * FROM Utilisateurs WHERE email = :email");
    $requete->execute(array('email' => $email));
    $user = $requete->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo "Utilisateur trouvé : ";
        var_dump($user);

        if (password_verify($mot_de_passe, $user['mot_de_passe'])) {
            $_SESSION['user'] = $user;
            if ($user['type'] == 'etudiant') {
                header('Location: etudiant.html');
                exit;
            } elseif ($user['type'] == 'professeur') {
                header('Location: professeur.html');
                exit;
            } else {
                $error_message = "Type d'utilisateur inconnu";
            }            
        } else {
            $erreur = "Le mot de passe est incorrect.";
        }
    } else {
        $erreur = "L'adresse e-mail n'existe pas.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>
<body>
    <h1>Connexion</h1>
    <?php if (isset($erreur)): ?>
        <p style="color: red;"><?= $erreur ?></p>
    <?php endif; ?>
    <form action="" method="post">
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required>
        <br>
        <button type="submit">Se connecter</button>
    </form>
    <p>Pas encore inscrit ? <a href="inscription.html">Inscrivez-vous ici</a>.</p>
</body>
</html>
