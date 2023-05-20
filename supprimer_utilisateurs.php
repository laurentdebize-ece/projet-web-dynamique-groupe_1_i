<?php
require_once 'BDD/initBDD.php';

session_start();

if (!isset($_SESSION['type']) || $_SESSION['type'] !== 'administrateur') {
    echo "Vous devez être connecté en tant qu'administrateur pour gérer les professeurs.";
    exit;
}

if (isset($_POST['email_suppression'])) {
    $email_suppression = $_POST['email_suppression'];

    try {
        // Requête pour récupérer l'id de l'utilisateur
        $requete = $bdd->prepare("SELECT id, statut_id FROM Utilisateurs WHERE email = :email");
        $requete->bindParam(':email', $email_suppression);
        $requete->execute();

        $resultat = $requete->fetch(PDO::FETCH_ASSOC);

        if ($resultat['statut_id'] == 3) {
            header('Location: supprimer_utilisateurs.php');
            $erreur = " Vous ne pouvez pas supprimer un administrateur";
            exit;
        }

        // Supprimer l'utilisateur de la table professeurs_classes s'il est un professeur
        if ($resultat['statut_id'] == 2) {
            $id_professeur = $resultat['id'];

            // Supprimer les références dans la table professeurs_matieres
            $requete = $bdd->prepare("DELETE FROM professeurs_matieres WHERE id_professeur = :id_professeur");
            $requete->bindParam(':id_professeur', $id_professeur);
            $requete->execute();

            // Supprimer les références dans la table professeurs_classes
            $requete = $bdd->prepare("DELETE FROM professeurs_classes WHERE id_professeur = :id_professeur");
            $requete->bindParam(':id_professeur', $id_professeur);
            $requete->execute();
        }

        // Requête pour supprimer l'utilisateur
        $requete = $bdd->prepare("DELETE FROM Utilisateurs WHERE email = :email");
        $requete->bindParam(':email', $email_suppression);
        $requete->execute();

    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

if (isset($_POST['id_matiere_suppression'])) {
    $id_matiere_suppression = $_POST['id_matiere_suppression'];

    try {
        // Supprimer les références dans la table professeurs_matieres
        $requete = $bdd->prepare("DELETE FROM professeurs_matieres WHERE id_matiere = :id_matiere");
        $requete->bindParam(':id_matiere', $id_matiere_suppression);
        $requete->execute();

        // Requête pour supprimer la matière
        $requete = $bdd->prepare("DELETE FROM Matieres WHERE id = :id");
        $requete->bindParam(':id', $id_matiere_suppression);
        $requete->execute();

    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
if (isset($_POST['id_classe_suppression'])) {
    $id_classe_suppression = $_POST['id_classe_suppression'];

    try {
        // Supprimer les références dans la table professeurs_classes
        $requete = $bdd->prepare("DELETE FROM professeurs_classes WHERE id_classe = :id_classe_suppression");
        $requete->bindParam(':id_classe_suppression', $id_classe_suppression);
        $requete->execute();

        // Supprimer les références dans la table etudiants_classes
        $requete = $bdd->prepare("DELETE FROM etudiants_classes WHERE id_classe = :id_classe_suppression");
        $requete->bindParam(':id_classe_suppression', $id_classe_suppression);
        $requete->execute();

        // Requête pour supprimer la classe
        $requete = $bdd->prepare("DELETE FROM Classes WHERE id = :id_classe_suppression");
        $requete->bindParam(':id_classe_suppression', $id_classe_suppression);
        $requete->execute();

    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}



$query = $bdd->prepare("SELECT * FROM Utilisateurs WHERE statut_id IN ((SELECT id FROM Statut WHERE statut = 'professeur'), (SELECT id FROM Statut WHERE statut = 'etudiant'))");
$query->execute();
$utilisateurs = $query->fetchAll();

$query = $bdd->prepare("SELECT * FROM Matieres");
$query->execute();
$matieres = $query->fetchAll();

$query = $bdd->prepare("SELECT * FROM Classes");
$query->execute();
$classes = $query->fetchAll();
?>




<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <title>Administration</title>
        <link rel="stylesheet" href="style1.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
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
                <h1>Administration</h1>
                <div class="container">
                    <div class="left">
                        <h1>Suppression d'utilisateur</h1>
                        <form action="supprimer_utilisateurs.php" method="post">
                            <div>
                                <label for="email_suppression">Email de l'utilisateur à supprimer :</label>
                                <input type="email" id="email_suppression" name="email_suppression" required>
                            </div>
                            <button type="submit" class="submit-btn">Supprimer l'utilisateur</button>
                        </form>
                    </div>

                    <div class="right">
                        <h2>Utilisateurs existants</h2>
                        <table>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Email</th>
                                <th>Statut</th>
                            </tr>
                            <?php foreach ($utilisateurs as $utilisateur): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($utilisateur['nom']); ?></td>
                                    <td><?php echo htmlspecialchars($utilisateur['prenom']); ?></td>
                                    <td><?php echo htmlspecialchars($utilisateur['email']); ?></td>
                                    <?php
                                    if ($utilisateur['statut_id'] == 1) { ?>
                                        <td><?php echo htmlspecialchars("Etudiant"); ?></td>
                                        <?php
                                    } else if ($utilisateur['statut_id'] == 2) { ?>
                                        <td><?php echo htmlspecialchars("Professeur"); ?></td>
                                        <?php
                                    } ?>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
                <div class="container">
                    <div class="left">
                        <h1>Suppression de matières</h1>
                        <form action="supprimer_utilisateurs.php" method="post">
                            <div>
                                <label for="id_matiere_suppression">ID de la matière à supprimer :</label>
                                <input type="number" id="id_matiere_suppression" name="id_matiere_suppression" required>
                            </div>
                            <button type="submit" class="submit-btn">Supprimer la matière</button>
                        </form>
                    </div>
                    <div class="left">
                        <h1>Suppression de classes</h1>
                        <form action="supprimer_utilisateurs.php" method="post">
                            <div>
                                <label for="id_classe_suppression">ID de la classe à supprimer :</label>
                                <input type="number" id="id_classe_suppression" name="id_classe_suppression" required>
                            </div>
                            <button type="submit" class="submit-btn">Supprimer la classe</button>
                        </form>
                    </div>

                    <div class="right">
                        <h2>Matières existantes</h2>
                        <table>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Volume horaire</th>
                            </tr>
                            <?php foreach ($matieres as $matiere): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($matiere['id']); ?></td>
                                    <td><?php echo htmlspecialchars($matiere['nom_matiere']); ?></td>
                                    <td><?php echo htmlspecialchars($matiere['volume_horaire']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                    <div class="right">
                        <h2>Classes existantes</h2>
                        <table>
                            <tr>
                                <th>ID</th>
                                <th>Groupe</th>
                                <th>Promotion</th>
                                <th>Ecole</th>
                            </tr>
                            <?php foreach ($classes as $classe): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($classe['id']); ?></td>
                                    <td><?php echo htmlspecialchars($classe['groupe']); ?></td>
                                    <td><?php echo htmlspecialchars($classe['promotion']); ?></td>
                                    <td><?php echo htmlspecialchars($classe['ecole']); ?></td>
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
    </div>
    <footer class="footer">
        <p>Footer Text</p>
    </footer>
    </body>
</html>
