<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="style1.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src = "test.js"></script>
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

<div class="container-fluid text-center">
    <div class="row content">
        <form method="post" action="index.php">
            <div>
                <label for="prenom">Login :</label>
                <input type="text" name="login" id="login">
            </div>
            <br>
            <div>
                <label for="prenom">mdp :</label>
                <input type="text" name="mdp" id="mdp">
            </div>
            <br>
            <div>
                <input type="submit" value="Valider">
            </div>
        </form>
    </div>

    <footer class="container-fluid text-center" id="footer1">
        <p>Footer Text</p>
    </footer>

</body>


<?php
$users = array(
    array('user123', 'motdepasse123'),
    array('admin', 'password')
);

if (isset($_POST['login']) && isset($_POST['mdp'])) {
    $login = $_POST['login'];
    $pass = $_POST['mdp'];

    $connected = false;
    foreach ($users as $user) {
        if ($login === $user[0] && $pass === $user[1]) {
            $connected = true;
            break;
        }
    }

    if ($connected) {
        echo "Connection okay";
        header("Location: accueil.php");
    } else {
        echo "Identifiant ou mot de passe incorrect";
    }
}
?>


</html>
