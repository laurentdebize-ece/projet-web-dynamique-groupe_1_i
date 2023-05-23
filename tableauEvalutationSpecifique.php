<?php
session_start();

if (isset($_POST["evaluation_id"], $_POST["new_status"])) {
    $connexion = mysqli_connect("localhost", "root", "root", "omnes myskills");

    $evaluation_id = $_POST["evaluation_id"];
    $new_status = $_POST["new_status"];

    $query = "UPDATE autoevaluations SET statut='$new_status' WHERE id='$evaluation_id'";
    if (mysqli_query($connexion, $query)) {
        echo "Statut de l'évaluation mis à jour avec succès.";
    } else {
        echo "Erreur lors de la mise à jour du statut de l'évaluation: " . mysqli_error($connexion);
    }

    mysqli_close($connexion);
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
    <title>Omnes MySkill</title>
</head>

<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="accueil.php">OMNES</a>
            <a class="navbar-brand center" href=""><?php

                $connexion = mysqli_connect("localhost", "root", "root", "omnes myskills");
                $MATChoisie = $_POST['cmptChoisie'];
                $data = mysqli_query($connexion, "SELECT * FROM competences WHERE id = '$MATChoisie'");
                $matiere = mysqli_fetch_assoc($data);
                echo $matiere['nom'];
                mysqli_close($connexion);

                ?></a>
        </div>
    </div>
</nav>

<div class="container-fluid text-center">
    <div class="row content">

        <div class="col-sm-10 text-left">
            <h1>Evaluations</h1>
            <?php


            $connexion = mysqli_connect("localhost", "root", "root", "omnes myskills");
            $cmptChoisie = $_POST['cmptChoisie'];
            $data = mysqli_query($connexion, "SELECT autoevaluations.id, autoevaluations.statut, competences.description FROM autoevaluations JOIN competences ON autoevaluations.id_competence = competences.id WHERE autoevaluations.id_competence = '$cmptChoisie'");
            $nb_lignes = mysqli_num_rows($data);


            echo "<table>";
            echo "<tr><th>description</th><th>non acquis</th><th>en cours</th><th>acquis</th><th>Modifier le statut</th></tr>";
            while ($ligne = mysqli_fetch_assoc($data)) {
                echo "<tr>";
                echo "<td><div class='rectanglePourCmpListe'>" . $ligne['description'] . "</div></td>";
                if ($ligne["statut"] == "non_acquis") {
                    echo "<td><button class='rectanglePourCmpNonAcqui'>Non acquis</button></td>";
                } else {
                    echo "<td><button class='rectanglePourCmp'></button></td>";
                }
                if ($ligne["statut"] == "en_cours") {
                    echo "<td><button class='rectanglePourCmpEnCours'>en cours</button></td>";
                } else {
                    echo "<td><button class='rectanglePourCmp'></button></td>";
                }
                if ($ligne["statut"] == "acquis") {
                    echo "<td><button class='rectanglePourCmpvalide'>Acquis</button></td>";
                } else {
                    echo "<td><button class='rectanglePourCmp'></button></td>";
                }


                echo "<td>";
                echo "<form method='post'>";
                echo "<input type='hidden' name='evaluation_id' value='" . $ligne['id'] . "'>";
                echo "<input type='hidden' name='cmptChoisie' value='" . $cmptChoisie . "'>"; 
                echo "<select name='new_status'>";
                echo "<option value='non_acquis' " . (($ligne["statut"] == "non_acquis") ? "selected" : "") . ">Non acquis</option>";
                echo "<option value='en_cours' " . (($ligne["statut"] == "en_cours") ? "selected" : "") . ">En cours</option>";
                echo "<option value='acquis' " . (($ligne["statut"] == "acquis") ? "selected" : "") . ">Acquis</option>";
                echo "</select>";
                echo "<input type='submit' value='Modifier'>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";

            mysqli_close($connexion);
            ?>

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


</body>

<footer class="footer">
    <p>Footer Text</p>
</footer>

</html>