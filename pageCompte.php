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
    <style>
        .etat {
            font-weight: bold;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="accueil.php">OMNES</a>
            <a class="navbar-brand center" href="pageCompte.php">Compte</a>
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

        <div class="col-sm-10 text-left">
        </div>
        <div class="col-sm-2 sidenav">
            <a href="pageCompte.php"><img src='img/OIP.jpg' width="80" height="80" style="border-radius: 40px;"></a>
            <?php
            if (isset($_SESSION['type'])) {
                if ($_SESSION['type'] == 'etudiant') {
                    ?>
                    <p class="etat"><a>Etudiant &#128104;&#8205;&#127891;</a></p><br>
                    <p><a href="matieres.php">Matières</a></p><br>
                    <p><a href="competences.php">Compétences</a></p><br>
                    <p><a href="competences_transverses.php">Compétences transverses</a></p><br>
                    <p><a href="toutes_mes_competences.php">Toutes mes compétences</a></p><br>
                    <p><a href="ajout_utilisateur.php">AJOUTER UTILISATEUR</a></p><br>
                    <p><a href="pageCompetences.php">tableauEvaluationTTCompt</a></p><br>
                    <?php
                } else if ($_SESSION['type'] === 'professeur') {
                    ?>
                    <p class="etat"><a>Professeur &#128104;&#8205;&#127979;</a></p>
                    <p><a href="matieres.php">Matières</a></p><br>
                    <p><a href="competences.php">Compétences</a></p><br>
                    <p><a href="competences_transverses.php">Compétences transverses</a></p><br>
                    <p><a href="toutes_mes_competences.php">Toutes mes compétences</a></p><br>
                    <p><a href="ajout_utilisateur.php">AJOUTER UTILISATEUR</a></p><br>
                    <p><a href="pageCompetences.php">tableauEvaluationTTCompt</a></p><br>
                    <?php
                } else if ($_SESSION['type'] === 'administrateur') {
                    ?>
                    <p class="etat" ><a> Administrateur &#128104;&#8205;&#128187;</a></p>
                    <br><br ><br >
                    <p><a href = "matieres_admin.php" > Matières/Classes</a ></p ><br >
                    <p><a href = "etudiants_admin.php" > Etudiants</a ></p ><br >
                    <p><a href = "professeurs_admin.php" > Professeurs</a ></p ><br >
                    <?php
                } else {
                    ?>
                    <h1>Connectez-vous</h1>
                    <?php
                }
                echo '<p><a href="logout.php">Déconnectez-vous ici</a></p><br><br>';
            } else {
                echo '<p><a href="index.php">Connectez-vous ici</a></p><br><br>';
            } ?>

            <!--<p><a href="connexion.php">CONNEXION</a></p>-->
        </div>

    </div>

    <footer class="footer">
        <p>Footer Text</p>
    </footer>


</body>

</html>
