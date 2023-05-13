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
            <form action="matieres.php" method="post">
             <table class="tableMat">
                 <tr>
                     <td><span class="title">Matière 1</span></td>
                     <td><span class="title">Matière 2</span></td>
                     <td><span class="title">Matière 3</span></td>
                 </tr>
                <tr>
                    <td><button class = "circle" name="matChoisie" value="1">1</button></td>
                    <td><button class = "circle" name="matChoisie" value="2">2</button></td>
                    <td><button class = "circle" name="matChoisie" value="3">3</button></td>
                </tr>
                 <tr>
                     <td><span class="title">Matière 4</span></td>
                     <td><span class="title">Matière 5</span></td>
                     <td><span class="title">Matière 6</span></td>
                 </tr>
                <tr>
                    <td><button class = "circle" name="matChoisie" value="4">4</button></td>
                    <td><button class = "circle" name="matChoisie" value="5">5</button></td>
                    <td><button class = "circle" name="matChoisie" value="6">6</button></td>
                </tr>
                 <tr>
                     <td><span class="title">Matière 7</span></td>
                     <td><span class="title">Matière 8</span></td>
                     <td><span class="title">Matière 9</span></td>
                 </tr>
                <tr>
                    <td><button class = "circle" name="matChoisie" value="7">7</button></td>
                    <td><button class = "circle" name="matChoisie" value="8">8</button></td>
                    <td><button class = "circle" name="matChoisie" value="9">9</button></td>
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

<?php
    $choice = isset($_POST["matChoisie"]) ? $_POST["matChoisie"] : "";
    switch ($choice) {
        case "1":
            echo '<p>'. $_POST["matChoisie"] . '</p>';
            break;
        case "2":
            echo '<p>'. $_POST["matChoisie"] . '</p>';
            break;
        case "3":
            echo '<p>'. $_POST["matChoisie"] . '</p>';
            break;
        case "4":
            echo '<p>'. $_POST["matChoisie"] . '</p>';
            break;
        case "5":
            echo '<p>'. $_POST["matChoisie"] . '</p>';
            break;
        case "6":
            echo '<p>'. $_POST["matChoisie"] . '</p>';
            break;
        case "7":
            echo '<p>'. $_POST["matChoisie"] . '</p>';
            break;
        case "8":
            echo '<p>'. $_POST["matChoisie"] . '</p>';
            break;
        case "9":
            echo '<p>'. $_POST["matChoisie"] . '</p>';
            break;
        default:
            break;
    }
?>
</html>