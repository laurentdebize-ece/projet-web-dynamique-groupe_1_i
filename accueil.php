<?php
session_start();
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
    <title>Omnes MySkill</title>
</head>

<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="accueil.php">OMNES</a>
            <a class="navbar-brand center" href="accueil.php">ACCUEIL</a>
        </div>
    </div>
</nav>

<script>
    $(document).ready(function () {
        var $carrousel = $('#carrousel'); // on cible le bloc du carrousel
        $img = $('#carrousel img'); // on cible les images contenues dans le carrousel
        indexImg = $img.length - 1; // on définit l'index du dernier élément
        i = 0; // on initialise un compteur
        $currentImg = $img.eq(i); // enfin, on cible l'image courante, qui possède l'index i (0 pour l'instant)
        $img.css('display', 'none'); // on cache les images
        $currentImg.css('display', 'block'); // on affiche seulement l'image courante

        function slideImg() {
            setTimeout(function () { // on utilise une fonction anonyme
                if (i < indexImg) { // si le compteur est inférieur au dernier index
                    i++; // on l'incrémente
                } else { // sinon, on le remet à 0 (première image)
                    i = 0;
                }
                $img.css('display', 'none');
                $currentImg = $img.eq(i);
                $currentImg.css('display', 'block');
                slideImg(); // on oublie pas de relancer la fonction à la fin
            }, 4000); // on définit l'intervalle à 4000 millisecondes (4s)
        }

        slideImg();
    });
</script>

<div class="container-fluid text-center flex-float"> <!--style="height: 100%"-->
    <div class="row content">

        <div class="col-sm-6 text-left">
            <h1>Omnes Skills</h1>
            <p>Omnes skills est une plateforme qui vous permetera de suivre vos competences<br>
                acquises durant vos années d'études</p>
            <br><br><br><br>
            <div>
                <br>
                <h1>Mes competences star</h1>
                <br>
                <?php include "tableauAccueil.php"; ?>
            </div>
        </div>
        <div class="col-sm-4">
            <div id="carrousel">
                <ul>
                    <li><img src="img/ECE_Lyon1.jpg" width="350" height="200"/></li>
                    <li><img src="img/logo%20ece%20copie%20PNG.png" width="350" height="200"/></li>
                </ul>
            </div>
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

<footer class="footer">
    <p>Footer Text</p>
</footer>

<!--
<footer class="footer mt-auto py-3">
    <p>Footer Text</p>
</footer>
-->

</body>

</html>
