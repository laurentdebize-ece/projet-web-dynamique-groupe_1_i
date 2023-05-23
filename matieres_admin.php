<?php
require_once 'BDD/initBDD.php';

session_start();

if (!isset($_SESSION['type']) || $_SESSION['type'] !== 'administrateur') {
    echo "Vous devez être connecté en tant qu'administrateur pour ajouter un utilisateur.";
    exit;
}

if (isset($_POST['nom_matiere'], $_POST['volume_horaire'])) {
    $nom_matiere = $_POST['nom_matiere'];
    $volume_horaire = $_POST['volume_horaire'];

    // Vérifier si la matière existe déjà
    $requete = $bdd->prepare("SELECT * FROM Matieres WHERE nom_matiere = :nom_matiere AND volume_horaire = :volume_horaire");
    $requete->bindParam(':nom_matiere', $nom_matiere);
    $requete->bindParam(':volume_horaire', $volume_horaire);
    $requete->execute();

    // Si la matière n'existe pas, la créer
    if ($requete->rowCount() == 0) {
        $requete = $bdd->prepare("INSERT INTO Matieres (nom_matiere, volume_horaire) VALUES (:nom_matiere, :volume_horaire)");
        $requete->bindParam(':nom_matiere', $nom_matiere);
        $requete->bindParam(':volume_horaire', $volume_horaire);
        $requete->execute();
    }
}
if (isset($_POST['groupe'], $_POST['promotion'], $_POST['ecole'])) {
    $groupe = $_POST['groupe'];
    $promotion = $_POST['promotion'];
    $ecole = $_POST['ecole'];

    // Vérifier si la classe existe déjà
    $requete = $bdd->prepare("SELECT * FROM Classes WHERE groupe = :groupe AND promotion = :promotion AND ecole = :ecole");
    $requete->bindParam(':groupe', $groupe);
    $requete->bindParam(':promotion', $promotion);
    $requete->bindParam(':ecole', $ecole);
    $requete->execute();

    // Si la matière n'existe pas, la créer
    if ($requete->rowCount() == 0) {
        $requete = $bdd->prepare("INSERT INTO Classes (groupe, promotion, ecole) VALUES (:groupe, :promotion, :ecole)");
        $requete->bindParam(':groupe', $groupe);
        $requete->bindParam(':promotion', $promotion);
        $requete->bindParam(':ecole', $ecole);
        $requete->execute();
    }
}
$query = $bdd->prepare("SELECT * FROM Matieres");
$query->execute();
$nom_matiere = $query->fetchAll();

$query = $bdd->prepare("SELECT * FROM Classes");
$query->execute();
$groupe = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Gestion des matières</title>
        <link rel="stylesheet" href="style1.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="accueil.php">OMNES</a>
                    <a class="navbar-brand center" href="pageCompte.php">Compte</a>
               </div>
            </div>
        </nav>
        <div id="divSupp" class="container-fluid text-center flex-float">
            <div class="row content">
                <div class="col-sm-10 text-left">
                    <h1>Gestion des matières</h1>
                        <div class="container">
                            <div class="left">
                                <h2>Ajouter une matière</h2>
                                <form action="matieres_admin.php" method="post">
                                    <div>
                                        <label for="nom_matiere">Nom de la matière :</label>
                                        <input type="text" id="nom_matiere" name="nom_matiere" required>
                                    </div>
                                    <div>
                                        <label for="volume_horaire">Volume horaire :</label>
                                        <input type="number" id="volume_horaire" min="0" name="volume_horaire" required>
                                    </div>
                                    <button type="submit" class="submit-btn">Ajouter</button>
                                </form>
                            </div>
                            <div class="right">
                                <h2>Matières existantes</h2>
                                <table>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Volume horaire</th>
                                    </tr>
                                    <?php foreach ($nom_matiere as $nom_matiere): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($nom_matiere['nom_matiere']); ?></td>
                                            <td><?php echo htmlspecialchars($nom_matiere['volume_horaire']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        </div>
                        <div class="container">
                            <div class="left">
                                <h2>Ajouter une classe</h2>
                                <form action="matieres_admin.php" method="post">
                                    <div>
                                        <label for="groupe">Nom de la classe :</label>
                                        <input type="number" id="groupe" name="groupe" min="1" max="10" required>
                                    </div>
                                    <div>
                                        <label for="promotion">Promotion :</label>
                                        <input type="number" id="promotion" name="promotion" min="1919" value="2026" required>
                                    </div>
                                    <div>
                                        <label for="ecole">Ecole :</label>
                                        <input type="text" id="ecole" name="ecole" value="ECE" required>
                                    </div>
                                    <button type="submit" class="submit-btn">Ajouter</button>
                                </form>
                            </div>
                            <div class="right">
                                <h2>Classes existantes</h2>
                                <table>
                                    <tr>
                                        <th>Groupe</th>
                                        <th>Promotion</th>
                                        <th>Ecole</th>
                                    </tr>
                                    <?php foreach ($groupe as $groupe): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($groupe['groupe']); ?></td>
                                            <td><?php echo htmlspecialchars($groupe['promotion']); ?></td>
                                            <td><?php echo htmlspecialchars($groupe['ecole']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                <div class="col-sm-2 sidenav">
                <a href="pageCompte.php"><img src='img/OIP.jpg' width="80" height="80" style="border-radius: 40px;"></a>
                <?php
                if (isset($_SESSION['type'])) {
                    if ($_SESSION['type'] == 'etudiant') {
                        ?>
                        <p class="etat"><a>Etudiant &#128104;&#8205;&#127891;</a></p><br>
                        <p><a href="matieres.php">Matières</a></p><br>
                        <p><a href="competences.php">Compétences</a></p><br>
                        <p><a href="competences_transverses.php">Compétences transverses</a></p><br>
                        <p><a href="toutes_mes_competences.php">Toutes mes compétences</a></p><br>
                        <p><a href="ajout_utilisateur.php">AJOUTER UTILISATEUR</a></p><br>
                        <p><a href="pageCompetences.php">tableauEvaluationTTCompt</a></p><br>
                        <?php
                    } else if ($_SESSION['type'] === 'professeur') {
                        ?>
                        <p class="etat"><a>Professeur &#128104;&#8205;&#127979;</a></p>
                        <p><a href="matieres.php">Matières</a></p><br>
                        <p><a href="competences.php">Compétences</a></p><br>
                        <p><a href="competences_transverses.php">Compétences transverses</a></p><br>
                        <p><a href="toutes_mes_competences.php">Toutes mes compétences</a></p><br>
                        <p><a href="ajout_utilisateur.php">AJOUTER UTILISATEUR</a></p><br>
                        <p><a href="pageCompetences.php">tableauEvaluationTTCompt</a></p><br>
                        <?php
                    } else if ($_SESSION['type'] === 'administrateur') {
                        ?>
                        <p class="etat" ><a> Administrateur &#128104;&#8205;&#128187;</a></p>
                        <br><br ><br >
                        <p><a href = "matieres_admin.php" > Matières/Classes</a ></p ><br >
                        <p><a href = "etudiants_admin.php" > Etudiants</a ></p ><br >
                        <p><a href = "professeurs_admin.php" > Professeurs</a ></p ><br >
                        <p><a href = "supprimer_utilisateurs.php" > Supprimer</a ></p ><br >
                        <?php
                    } else {
                        ?>
                        <h1>Connectez-vous</h1>
                        <?php
                    }
                    echo '<p><a href="logout.php">Déconnectez-vous ici</a></p><br><br>';
                } else {
                    echo '<p><a href="index.php">Connectez-vous ici</a></p><br><br>';
                } ?>

                <!--<p><a href="connexion.php">CONNEXION</a></p>-->
                </div>

        </div>

        <footer class="footer">
            <p>Footer Text</p>
        </footer>
    </body>
</html>
