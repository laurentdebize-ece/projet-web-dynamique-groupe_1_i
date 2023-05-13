<?php
// Connexion à la base de données
$connexion = mysqli_connect("localhost", "root", "root", "omnes myskills");

// Requête SQL pour récupérer les données
$resultat = mysqli_query($connexion, "SELECT * FROM autoevaluations");

// Nombre de lignes dans la base de données
$nb_lignes = mysqli_num_rows($resultat);

// Génération du tableau HTML
echo "<table>";
echo "<tr><th>ID</th><th>statut</th></tr>";
while ($ligne = mysqli_fetch_assoc($resultat)) {
    echo "<tr>";
    echo "<td><div class='rectanglePourCmpListe'>" . $ligne["id"] . "</div></td>";
    if($ligne["statut"] == "non_acquis") {
        echo "<td><div class='rectanglePourCmpNonAcqui'>" . $ligne["statut"] . "</div></td>";
    } else {
        echo "<td><div class='rectanglePourCmp'>" . $ligne["statut"] . "</div></td>";
    }
    if($ligne["statut"] == "en_cours") {
        echo "<td><div class='rectanglePourCmpEnCours'>" . $ligne["statut"] . "</div></td>";
    } else {
        echo "<td><div class='rectanglePourCmp'>" . $ligne["statut"] . "</div></td>";
    }
    if($ligne["statut"] == "acquis") {
        echo "<td><div class='rectanglePourCmpvalide'>" . $ligne["statut"] . "</div></td>";
    } else {
        echo "<td><div class='rectanglePourCmp'>" . $ligne["statut"] . "</div></td>";
    }
    echo "</tr>";
}
echo "</table>";

// Fermeture de la connexion à la base de données
mysqli_close($connexion);
?>
