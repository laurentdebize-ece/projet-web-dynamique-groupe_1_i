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
            <a class="navbar-brand center" href="competences.php">Competences</a>
        </div>
    </div>
</nav>

<div class="container-fluid text-center">
    <div class="row content">

        <div class="col-sm-10 text-left">
            <h1>Competences</h1>
            <form action="competences.php" method="post">
                <table class="tableComp">
                    <tr>
                        <td><button class = "rectangle" name="compChoisie" value="1">Compétence 1</button></td>
                        <td><button class = "rectangle" name="compChoisie" value="2">Compétence 2</button></td>
                        <td><button class = "rectangle" name="compChoisie" value="3">Compétence 3</button></td>
                    </tr>
                    <tr>
                        <td><button class = "rectangle" name="compChoisie" value="4">Compétence 4</button></td>
                        <td><button class = "rectangle" name="compChoisie" value="5">Compétence 5</button></td>
                        <td><button class = "rectangle" name="compChoisie" value="6">Compétence 6</button></td>
                    </tr>
                    <tr>
                        <td><button class = "rectangle" name="compChoisie" value="7">Compétence 7</button></td>
                        <td><button class = "rectangle" name="compChoisie" value="8">Compétence 8</button></td>
                        <td><button class = "rectangle" name="compChoisie" value="9">Compétence 9</button></td>
                    </tr>
                </table>
                </form>
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
            <p><a href="pageCmp.php">tableauEvaluationTTCompt</a></p><br>
            <!--<p><a href="connexion.php">CONNEXION</a></p>-->
        </div>
</div>
</div>


</body>

<footer class="footer">
    <p>Footer Text</p>
</footer>

</html>