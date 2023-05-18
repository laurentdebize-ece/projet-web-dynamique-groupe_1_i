<?php

$connexion = mysqli_connect("localhost", "root", "root", "omnes myskills");
$data = mysqli_query($connexion, "SELECT * FROM competences");
$nb_lignes = mysqli_num_rows($data);

echo "<table>";
while ($ligne = mysqli_fetch_assoc($data)) {
    echo "<td><button class='rectangle'>" . $ligne['nom'] . "</button></td>";
    if ($ligne['id'] == 4){
        echo "<tr>";
    }
}
echo "</table>";

mysqli_close($connexion);
?>
