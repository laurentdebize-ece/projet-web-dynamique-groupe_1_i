<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Omnes MySkill</title>
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="accueil.php">OMNES</a>
            <a class="navbar-brand center" href="matieres.php">Toutes mes competences</a>
        </div>
    </div>
</nav>

<div class="container-fluid text-center">
    <div class="row content">

        <div class="col-sm-10 text-left">
            <h1>Matieres</h1>
            <?php include "tableau_matieres.php"?>
        </div>

        <div class="col-sm-2 sidenav">
            <a href="pageCompte.php"><img src='img/OIP.jpg' width="80" height="80" style="border-radius: 40px;" ;</a>
            <?php
            if (isset($_SESSION['type'])) {
                if ($_SESSION['type'] == 'administrateur') {
                    ?>
                    <p class="etat">Administrateur &#128104;&#8205;&#128187;</p>
                    <?php
                } else if ($_SESSION['type'] == 'etudiant') {
                    ?>
                    <p class="etat">Etudiant &#128104;&#8205;&#127891;</p>
                    <?php
                } else if ($_SESSION['type'] == 'professeur') {
                    ?>
                    <p class="etat">Professeur &#128104;&#8205;&#127979;</p>
                    <?php
                }
            } else {
                ?>
                <p class="etat">Visiteur &#129335;&#8205;&#9794;</p>
                <?php
            }
            ?>
            <br><br>
            <?php
            if (isset($_SESSION['type'])) {
                echo '<p><a href="logout.php">Déconnectez-vous ici</a></p><br><br>';
            } else {
                echo '<p><a href="index.php">Connectez-vous ici</a></p><br><br>';
            }
            ?>
            <p><a href="matieres.php">Matières</a></p><br>
            <p><a href="competences.php">Compétences</a></p><br>
            <p><a href="competences_transverses.php">Compétences transverses</a></p><br>
            <p><a href="toutes_mes_competences.php">Toutes mes compétences</a></p><br>
            <p><a href="pageCompetences.php">tableauEvaluationTTCompt</a></p><br>
        </div>
    </div>
</div>

<footer class="container-fluid text-center">
    <p>Footer Text</p>
</footer>
</body>

</html>