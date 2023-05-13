<?php

$connexion = mysqli_connect("localhost", "root", "root", "omnes myskills");
$data = mysqli_query($connexion, "SELECT * FROM autoevaluations");
$nb_lignes = mysqli_num_rows($data);

echo "<table>";
echo "<tr><th>ID</th><th>non acquis</th><th>en cours</th><th>acquis</th></tr>";
while ($ligne = mysqli_fetch_assoc($data)) {
    echo "<tr>";
    echo "<td><div class='rectanglePourCmpListe'>" . $ligne["id"] . "</div></td>";
    if($ligne["statut"] == "non_acquis") {
        echo "<td><div class='rectanglePourCmpNonAcqui'>" . "</div></td>";
    } else {
        echo "<td><div class='rectanglePourCmp'>" . "</div></td>";
    }
    if($ligne["statut"] == "en_cours") {
        echo "<td><div class='rectanglePourCmpEnCours'>" . "</div></td>";
    } else {
        echo "<td><div class='rectanglePourCmp'>" . "</div></td>";
    }
    if($ligne["statut"] == "acquis") {
        echo "<td><div class='rectanglePourCmpvalide'>" ."</div></td>";
    } else {
        echo "<td><div class='rectanglePourCmp'>" . "</div></td>";
    }
    echo "</tr>";
}
echo "</table>";


mysqli_close($connexion);
?>
