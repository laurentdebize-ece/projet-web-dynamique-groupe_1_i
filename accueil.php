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
                <h1>Mes competences star</h1>
                <br>
                <table>
                    <tr>
                        <td>
                            <button class="rectangle" name="compt" value="1"></button>
                        </td>
                        <td>
                            <button class="rectangle" name="compt" value="2"></button>
                        </td>
                        <td>
                            <button class="rectangle" name="compt" value="3"></button>
                        </td>
                        <td>
                            <button class="rectangle" name="compt" value="4"></button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button class="rectangle" name="compt" value="5"></button>
                        </td>
                        <td>
                            <button class="rectangle" name="compt" value="6"></button>
                        </td>
                        <td>
                            <button class="rectangle" name="compt" value="7"></button>
                        </td>
                        <td>
                            <button class="rectangle" name="compt" value="8"></button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-sm-4">
            <div id="carrousel">
                <ul>
                    <li><img src="img/ECE_Lyon1.jpg" width="350" height="200" /></li>
                    <li><img src="img/logo%20ece%20copie%20PNG.png" width="350" height="200" /></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-2 sidenav">
            <div id="cercle"></div>
            <br><br><br>
            <p><a href="connexion.php">Connectez-vous ici</a></p><br><br>
            <p><a href="matieres.php">Matières</a></p><br>
            <p><a href="competences.php">Compétences</a></p><br>
            <p><a href="competences_transverses.php">Compétences transverses</a></p><br>
            <p><a href="toutes_mes_competences.php">Toutes mes compétences</a></p><br>
            <p><a href="ajout_utilisateur.php">AJOUTER UTILISATEUR</a></p><br>
            <p><a href="pageCmp.php">tableauEvaluationTTCompt</a></p><br>
            <!--<p><a href="connexion.php">CONNEXION</a></p>-->
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
