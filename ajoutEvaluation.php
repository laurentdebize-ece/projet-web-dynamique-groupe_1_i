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
            <a class="navbar-brand center" href="pageCompetences.php">Skills</a>
        </div>
    </div>
</nav>


<div id="divSupp" class="container-fluid text-center flex-float"> <!--style="height: 100%"-->
    <div class="row content">

        <div class="col-sm-10 text-left">

            <h1>Ajouter une evaluation</h1><br>
            <div class="container-fluid text-left flex-float">
                <form method="post" action="ajoutEvaluation.php">
                    <!--
                    <label for="id">id</label>
                    <input type="text" id="id" name="id" required><br><br>-->

                    <label for="id_etudiant">id etudiant :</label>
                    <input type="number" id="id_etudiant" name="id_etudiant" required><br><br>

                    <label for="id_competence">id_competence :</label>
                    <input type="number" id="id_competence" name="id_competence" required><br><br>

                    <label for="statut">statut :</label>
                    <!--<input type="text" id="statut" name="statut" required> -->

                    <select name="statut">
                        <option value="acquis">acquis</option>
                        <option value="en_cours">en_cours</option>
                        <option value="non_acquis">non_acquis</option>
                    </select>

                    <br><br>

                    <label for="date">date :</label>
                    <input type="date" id="date" name="date" required><br><br>

                    <input type="submit" value="Envoyer">
                </form>
            </div>
        </div>

        <div class="col-sm-2 sidenav">
            <a href="pageCompte.php"><img src='img/OIP.jpg' width="80" height="80" style="border-radius: 40px;" ;</a>
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

<footer class="footer">
    <p>Footer Text</p>
</footer>


</body>

</html>


<?php

$connexion = mysqli_connect("localhost", "root", "root", "omnes myskills");

$id_etudiant = isset($_POST["id_etudiant"]) ? $_POST["id_etudiant"] : "";
$id_competence = isset($_POST["id_competence"]) ? $_POST["id_competence"] : "";
$statut = isset($_POST["statut"]) ? $_POST["statut"] : "";
$date = isset($_POST["date"]) ? $_POST["date"] : "";

echo "<p>" . $id_etudiant . "</p>";
echo "<p>" . $id_competence . "</p>";
echo "<p>" . $statut . "</p>";
echo "<p>" . $date . "</p>";

if ($id_etudiant != "" && $id_competence != "" && $statut != "" && $date != "") {
    $sql = " INSERT INTO autoevaluations (id_etudiant, id_competence, statut, date)
               VALUES ('$id_etudiant', '$id_competence', '$statut', '$date')";
}
if (mysqli_query($connexion, $sql)) {
    echo "Employé ajouté avec succès";
} else {
    echo "Erreur lors de l'ajout de l'employé: " . mysqli_error($connexion);
}
?>
