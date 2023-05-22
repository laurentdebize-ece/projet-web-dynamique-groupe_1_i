
<?php
$connexion = mysqli_connect("localhost", "root", "root", "omnes myskills");
$data = mysqli_query($connexion, "SELECT autoevaluations.statut, autoevaluations.id, autoevaluations.id_competence ,competences.description FROM autoevaluations JOIN competences ON autoevaluations.id_competence = competences.id 
                                        JOIN matieres_competences ON matieres_competences.id_competence = competences.id");
$nb_lignes = mysqli_num_rows($data);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["evaluation_id"], $_POST["new_status"])) {
    $connexion = mysqli_connect("localhost", "root", "root", "omnes myskills");

    $evaluation_id = $_POST["evaluation_id"];
    $new_status = $_POST["new_status"];

    $query = "UPDATE autoevaluations SET statut='$new_status' WHERE id='$evaluation_id'";
    if (mysqli_query($connexion, $query)) {
        echo "Statut de l'évaluation mis à jour avec succès.";
    } else {
        echo "Erreur lors de la mise à jour du statut de l'évaluation: " . mysqli_error($connexion);
    }
    header("Location: pageCompetences.php");}



echo "<table>";
echo "<tr><th>description</th><th>non acquis</th><th>en cours</th><th>acquis</th><th>Modifier le statut</th></tr>";
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
    echo "<td>";
    echo "<form method='post'>";
    echo "<input type='hidden' name='evaluation_id' value='" . $ligne['id'] . "'>";
    echo "<select name='new_status'>";
    echo "<option value='non_acquis' " . (($ligne["statut"] == "non_acquis") ? "selected" : "") . ">Non acquis</option>";
    echo "<option value='en_cours' " . (($ligne["statut"] == "en_cours") ? "selected" : "") . ">En cours</option>";
    echo "<option value='acquis' " . (($ligne["statut"] == "acquis") ? "selected" : "") . ">Acquis</option>";
    echo "</select>";
    echo "<input type='submit' value='Modifier'>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
}
echo "</table>";

mysqli_close($connexion);
?>
