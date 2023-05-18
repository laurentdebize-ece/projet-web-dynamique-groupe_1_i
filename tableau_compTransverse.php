<?php

$connexion = mysqli_connect("localhost", "root", "root", "omnes myskills");
$data = mysqli_query($connexion, "SELECT * FROM competences WHERE type = 'transverse'");
$nb_lignes = mysqli_num_rows($data);
$nb_rectangles = 0;
echo "<table>";
while ($ligne = mysqli_fetch_assoc($data)) {
    echo "<td><button class='rectangle'>" . $ligne['nom'] . "</button></td>";
    $nb_rectangles++;
    if ($nb_rectangles % 4 == 0) {
        echo "<tr>";
    }
}
echo "</table>";

mysqli_close($connexion);
?>
