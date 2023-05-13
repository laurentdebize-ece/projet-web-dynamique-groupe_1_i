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
            <a class="navbar-brand center" href="pageCmp.php">Skills</a>
        </div>
    </div>
</nav>


<div class="container-fluid text-center flex-float"> <!--style="height: 100%"-->
    <div class="row content">

        <div class="col-sm-10 text-left">
            <h1>Omnes Skills</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam interdum arcu nec augue convallis, vitae
                lacinia nibh convallis. Etiam nec blandit magna, quis ultrices nisl. Ut vestibulum turpis ac diam
                elementum, a ultrices ipsum suscipit.</p><br>

            <div>
                <h1>Tableau dynamique</h1>
                <?php include "TableauEvalutation.php"; ?>
            </div>
        </div>

        <div class="col-sm-2 sidenav">
            <div id="cercle"></div>
            <br><br><br>
            <p><a href="index.php">Connectez-vous ici</a></p><br><br>
            <p><a href="matieres.php">Matières</a></p><br>
            <p><a href="competences.php">Compétences</a></p><br>
            <p><a href="competences_transverses.php">Compétences transverses</a></p><br>
            <p><a href="toutes_mes_competences.php">Toutes mes compétences</a></p><br>
            <p><a href="ajout_utilisateur.php">AJOUTER UTILISATEUR</a></p><br>
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