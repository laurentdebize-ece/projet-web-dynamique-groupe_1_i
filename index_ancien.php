<?php

$host = 'localhost';
$db = 'Omnes MySkills';
$user = 'root';
$pass = 'root';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];
try {
    $bdd = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (isset($_POST['email']) && isset($_POST['mot_de_passe'])) {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    $requete = $bdd->prepare("SELECT Utilisateurs.*, Status.statut FROM Utilisateurs INNER JOIN Status ON Utilisateurs.status_id = Status.id WHERE email = :email");
    $requete->execute(array('email' => $email));
    $user = $requete->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (password_verify($mot_de_passe, $user['mot_de_passe'])) {
            $_SESSION['user'] = $user;
            if ($user['statut'] == 'etudiant') {
                header('Location: accueil.php');
                exit;
            } elseif ($user['statut'] == 'professeur') {
                header('Location: accueil.php');
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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="style1.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="test.js"></script>
    <title>Omnes MySkill</title>
</head>

<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="accueil.php">OMNES</a>
        </div>
    </div>
</nav>

<div class="container-fluid text-left">
    <div class="raw content text-align center">
        <?php if (isset($erreur)): ?>
            <p style="color: red;">
                <?= $erreur ?>
            </p>
        <?php endif; ?>
        <form method="post" action="index_ancien.php">
            <br><br><br>

            <div>
                <label for="login">Login :</label>
                <input type="email" id="email" name="email" required>
            </div>
            <br><br>
            <div>
                <label for="mdp">Mot de passe :</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" required>
            </div>
            <br>
            <div class="text-align left">
                <input type="submit" value="Valider">
            </div>
        </form>
    </div>

    <footer class="container-fluid text-center" id="footer1">
        <p>Footer Text</p>
    </footer>

</body>

</html>
