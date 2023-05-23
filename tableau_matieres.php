<?php

$connexion = mysqli_connect("localhost", "root", "root", "omnes myskills");
$data = mysqli_query($connexion, "SELECT * FROM matieres");
$nb_lignes = mysqli_num_rows($data);
$nb_cercles = 0;
echo "<form method='post' action='tableau_affichage_Matieres_Competences.php'>";
echo "<table>";
while ($ligne = mysqli_fetch_assoc($data)) {
    echo "<td><button class='circle' name='MATChoisie' value='" . $ligne['id'] . "'>" . $ligne['nom_matiere'] . "</button></td>";
    $nb_cercles++;
    if ($nb_cercles % 4 == 0) {
        echo "</tr><tr>";
    }
}
echo "</table>";
echo "</form>";

mysqli_close($connexion);
?>
