<?php

$connexion = mysqli_connect("localhost", "root", "root", "omnes myskills");
$data = mysqli_query($connexion, "SELECT autoevaluations.statut, competences.description FROM autoevaluations JOIN competences ON autoevaluations.id_competence = competences.id");
$nb_lignes = mysqli_num_rows($data);

echo "<table>";
echo "<tr><th>description</th><th>non acquis</th><th>en cours</th><th>acquis</th></tr>";
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
    echo "</tr>";
}
echo "</table>";

mysqli_close($connexion);
?>
