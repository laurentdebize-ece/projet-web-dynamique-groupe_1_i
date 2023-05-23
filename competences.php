<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "Omnes MySkills";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sort = "id ASC"; // Tri par défaut : ordre croissant d'ID
if (isset($_POST['submit'])) {
    $sort = isset($_POST['sort']) ? $_POST['sort'] : 'C.id ASC';

    // Traitez le tri en fonction de la valeur sélectionnée ($sort)
    switch ($sort) {
        case "croissant_competences":
            $orderBy = "C.nom ASC";
            break;
        case "decroissant_competences":
            $orderBy = "C.nom DESC";
            break;
        case "croissant_date":
            $orderBy = "A.date ASC";
            break;
        case "decroissant_date":
            $orderBy = "A.date DESC";
            break;
        default:
            $orderBy = "C.id ASC";
            break;
    }
} else {
    $orderBy = "C.id ASC"; // Tri par défaut : ordre croissant d'ID
}

$sql = "SELECT C.* FROM Competences C 
        JOIN Autoevaluations A ON C.id = A.id_competence 
        WHERE C.type = 'specifique' 
        ORDER BY $orderBy";

$result = $conn->query($sql);

$competences = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $competences[] = $row;
    }
}

// Filtrage par statut de compétence
if (isset($_POST['status'])) {
    $status = $_POST['status'];
    if ($status != "tous") {
        $filteredCompetences = [];
        foreach ($competences as $competence) {
            $competenceId = $competence['id'];
            $evaluationSql = "SELECT * FROM Autoevaluations WHERE id_competence = $competenceId AND statut = '$status'";
            $evaluationResult = $conn->query($evaluationSql);
            if ($evaluationResult && $evaluationResult->num_rows > 0) {
                $filteredCompetences[] = $competence;
            }
        }
        $competences = $filteredCompetences;
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="style1.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Omnes MySkill</title>
</head>

<body>

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="accueil.php">OMNES</a>
                <a class="navbar-brand center" href="competences.php">Competences</a>
            </div>
        </div>
    </nav>

    <div class="container-fluid text-center">
        <div class="row content">

            <div class="col-sm-10 text-left">
                <h1>Competences</h1>
                <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" id="Barre_de_trie">
                    <label class="titreTrier" for="sort">Trier le tableau:</label><br></br>
                    <select name="sort" id="sort">
                        <option value="croissant_competences" <?php if ($sort == "C.nom ASC") echo "selected"; ?>>Ordre alphabétique croissant du nom des compétences</option>
                        <option value="decroissant_competences" <?php if ($sort == "C.nom DESC") echo "selected"; ?>>Ordre alphabétique décroissant du nom des compétences</option>
                        <option value="croissant_date" <?php if ($sort == "A.date ASC") echo "selected"; ?>>Date d'évaluation croissante</option>
                        <option value="decroissant_date" <?php if ($sort == "A.date DESC") echo "selected"; ?>>Date d'évaluation décroissante</option>
                    </select>
                    <input type="submit" name="submit" value="Trier">
                </form>

                <?php
                if (!empty($competences)) {
                    echo "<form method='post' action='tableauEvalutationSpecifique.php'>";
                    echo "<table>";
                    $nb_rectangles = 0;
                    foreach ($competences as $competence) {
                        echo "<td><button class='rectangle' name='cmptChoisie' value='" . $competence['id'] . "'>" . $competence['nom'] . "</button></td>";
                        $nb_rectangles++;
                        if ($nb_rectangles % 4 == 0) {
                            echo "</tr><tr>";
                        }
                    }
                    echo "</table>";
                    echo "</form>";
                } else {
                    echo "Aucune compétence trouvée.";
                }
                ?>

                <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" id="Barre_de_filtre3">
                    <label for="status">Filtrer par statut de compétence :</label><br></br>
                    <select name="status" id="status">
                        <option value="tous">Tous</option>
                        <option value="acquis">Acquis</option>
                        <option value="en_cours">En cours d'acquisition</option>
                        <option value="non_acquis">Non acquis</option>
                    </select>
                    <input type="submit" name="submit" value="Filtrer">
                </form>
            </div>


            <div class="col-sm-2 sidenav">
                <a href="pageCompte.php"><img src='img/OIP.jpg' width="80" height="80" style="border-radius: 40px;" ;</a>
                    <?php
                    if (isset($_SESSION['type'])) {
                        if ($_SESSION['type'] == 'administrateur') {
                    ?>
                            <p class="etat">Administrateur &#128104;&#8205;&#128187;</p>
                        <?php
                        } else if ($_SESSION['type'] == 'etudiant') {
                        ?>
                            <p class="etat">Etudiant &#128104;&#8205;&#127891;</p>
                        <?php
                        } else if ($_SESSION['type'] == 'professeur') {
                        ?>
                            <p class="etat">Professeur &#128104;&#8205;&#127979;</p>
                        <?php
                        }
                    } else {
                        ?>
                        <p class="etat">Visiteur &#129335;&#8205;&#9794;</p>
                    <?php
                    }
                    ?>
                    <br><br>
                    <?php
                    if (isset($_SESSION['type'])) {
                        echo '<p><a href="logout.php">Déconnectez-vous ici</a></p><br><br>';
                    } else {
                        echo '<p><a href="index.php">Connectez-vous ici</a></p><br><br>';
                    }
                    ?>
                    <p><a href="matieres.php">Matières</a></p><br>
                    <p><a href="competences.php">Compétences</a></p><br>
                    <p><a href="competences_transverses.php">Compétences transverses</a></p><br>
                    <p><a href="toutes_mes_competences.php">Toutes mes compétences</a></p><br>
                    <p><a href="pageCompetences.php">tableauEvaluationTTCompt</a></p><br>
            </div>
        </div>
    </div>


</body>


<footer class="footer">
    <p>Footer Text</p>
</footer>

</html>