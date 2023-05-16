<?php

$connexion = mysqli_connect("localhost", "root", "root", "omnes myskills");
$data = mysqli_query($connexion, "SELECT nom FROM competences");
$nb_lignes = mysqli_num_rows($data);


echo "<table>";
while ($ligne = mysqli_fetch_assoc($data)) {
    echo "<tr>";
    echo "<td><button class='rectangle'>" . $ligne['nom'] . "</button></td>";
    echo "</tr>";
}
echo "</table>";


mysqli_close($connexion);
?>

<script>
    function test() {
        alert("test");
    }

</script>
