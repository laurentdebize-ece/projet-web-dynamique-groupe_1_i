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
            <a class="navbar-brand center" href="competences_transverses.php">Toutes mes competences</a>
        </div>
    </div>
</nav>

<div class="container-fluid text-center">
    <div class="row content">

        <div class="col-sm-10 text-left">
            <h1>Competences transverses</h1>
            <form action="competences.php" method="post">
                <table class="tableComp">
                    <tr>
                        <td><button class = "rectangle" name="compChoisie" value="1">CompétenceT 1</button></td>
                        <td><button class = "rectangle" name="compChoisie" value="2">CompétenceT 2</button></td>
                        <td><button class = "rectangle" name="compChoisie" value="3">CompétenceT 3</button></td>
                    </tr>
                    <tr>
                        <td><button class = "rectangle" name="compChoisie" value="4">CompétenceT 4</button></td>
                        <td><button class = "rectangle" name="compChoisie" value="5">CompétenceT 5</button></td>
                        <td><button class = "rectangle" name="compChoisie" value="6">CompétenceT 6</button></td>
                    </tr>
                    <tr>
                        <td><button class = "rectangle" name="compChoisie" value="7">CompétenceT 7</button></td>
                        <td><button class = "rectangle" name="compChoisie" value="8">CompétenceT 8</button></td>
                        <td><button class = "rectangle" name="compChoisie" value="9">CompétenceT 9</button></td>
                    </tr>
                </table>
            </form>
        </div>

        <div class="col-sm-2 sidenav">
            <a href="pageCompte.php"><img src = 'img/OIP.jpg' width="80" height="80" style ="border-radius: 40px;";</a>
            <?php
            echo "<br><strong>" . $_SESSION['type'] . "</strong>";
            ?>
            <br><br><br>
            <p><a href="index.php">Connectez-vous ici</a></p><br><br>
            <p><a href="matieres.php">Matières</a></p><br>
            <p><a href="competences.php">Compétences</a></p><br>
            <p><a href="competences_transverses.php">Compétences transverses</a></p><br>
            <p><a href="toutes_mes_competences.php">Toutes mes compétences</a></p><br>
            <p><a href="ajout_utilisateur.php">AJOUTER UTILISATEUR</a></p><br>
            <p><a href="pageCompetences.php">tableauEvaluationTTCompt</a></p><br>
            <!--<p><a href="connexion.php">CONNEXION</a></p>-->
        </div>
    </div>
</div>

<footer class="container-fluid text-center">
    <p>Footer Text</p>
</footer>
</body>
</html>