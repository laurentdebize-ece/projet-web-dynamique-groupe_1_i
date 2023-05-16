<!DOCTYPE html>
<html lang="fr">
<body>
<?php

$connexion = mysqli_connect("localhost", "root", "root", "omnes myskills");
$data = mysqli_query($connexion, "SELECT * FROM autoevaluations");
$data2 = mysqli_query($connexion, "SELECT description FROM competences");
$nb_lignes = mysqli_num_rows($data);
$description = mysqli_fetch_assoc($data2);
echo "<table>";
echo "<tr><th>ID</th><th>non acquis</th><th>en cours</th><th>acquis</th></tr>";
while ($ligne = mysqli_fetch_assoc($data)) {
    echo "<tr>";
    echo "<td><div class='rectanglePourCmpListe'>" . $description['description'] . "</div></td>";
    if ($ligne["statut"] == "non_acquis") {
        echo "<td><button class='rectanglePourCmpNonAcqui'>Non acquis</button></td>";
    } else {
        echo "<td><button class='rectanglePourCmp' onClick='click_NonAcquis(" . $ligne['id'] . ")' name = '" . $ligne['id'] . "' value = '1'></button></td>";
    }
    if ($ligne["statut"] == "en_cours") {
        echo "<td><button class='rectanglePourCmpEnCours'>" . "</button></td>";
    } else {
        echo "<td><button class='rectanglePourCmp' onClick='click_EnCours(" . $ligne['id'] . ")'>" . "</button></td>";
    }
    if ($ligne["statut"] == "acquis") {
        echo "<td><button class='rectanglePourCmpvalide'>" . "</button></td>";
    } else {
        echo "<td><button class='rectanglePourCmp' onClick = 'click_Acquis(" . $ligne['id'] . ")'>" . "</button></td>";
    }
    echo "</tr>";
}
echo "</table>";


mysqli_close($connexion);
?>

<script>
    function click_NonAcquis(var ID)
    {
        alert("click_NonAcquis");
        if(ID === 1){
            <?php
                $connexion = mysqli_connect("localhost", "root", "root", "omnes myskills");
                $sql = mysqli_query($connexion, "UPDATE autoevaluations
                                                        SET statut = 'non_acquis'
                                                        WHERE id = ID;");
                mysqli_close($connexion);
                header("Location = pageCompetences.php");
            ?>
        }
    }

    function click_EnCours(var ID)
    {
        alert("click_EnCours");
        if(1==0){
            <?php
            $connexion = mysqli_connect("localhost", "root", "root", "omnes myskills");
            $sql = mysqli_query($connexion, "UPDATE autoevaluations
                                                        SET statut = 'en_cours'
                                                        WHERE id = ID;");
            mysqli_close($connexion);
            header("Location = pageCompetences.php");
            ?>
        }

    }

    function click_Acquis(var ID)
    {
        alert("click_Acquis");
        if(1==0){
            <?php
            $connexion = mysqli_connect("localhost", "root", "root", "omnes myskills");
            $sql = mysqli_query($connexion, "UPDATE autoevaluations
                                                        SET statut = 'acquis'
                                                        WHERE id = ID;");
            mysqli_close($connexion);
            header("Location = pageCompetences.php");
            ?>
        }
    }

</script>
</body>
</html>