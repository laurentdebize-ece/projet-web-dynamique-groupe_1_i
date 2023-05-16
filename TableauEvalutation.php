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
        echo "<td><button class='rectanglePourCmpNonAcqui' onClick='test()'>Non acquis</button></td>";
    } else {
        echo "<td><button class='rectanglePourCmp'></button></td>";
    }
    if($ligne["statut"] == "en_cours") {
        echo "<td><button class='rectanglePourCmpEnCours'>" . "</button></td>";
    } else {
        echo "<td><button class='rectanglePourCmp'>" . "</button></td>";
    }
    if($ligne["statut"] == "acquis") {
        echo "<td><button class='rectanglePourCmpvalide'>" ."</button></td>";
    } else {
        echo "<td><button class='rectanglePourCmp'>" . "</button></td>";
    }
    echo "</tr>";
}
echo "</table>";


mysqli_close($connexion);
?>

<script>
    function test(){
        alert("test");
    }

</script>
