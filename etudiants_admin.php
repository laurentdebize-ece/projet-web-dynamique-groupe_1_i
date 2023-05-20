<?php
require_once 'BDD/initBDD.php';

session_start();

if (!isset($_SESSION['type']) || $_SESSION['type'] !== 'administrateur') {
    echo "Vous devez être connecté en tant qu'administrateur pour ajouter un utilisateur.";
    exit;
}

function generateRandomPassword($length = 8){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ\/¡!¿?';
    $charactersLength = strlen($characters);
    $randomPassword = '';
    for ($i = 0; $i < $length; $i++) {
        $randomPassword .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomPassword;
}

if (isset($_POST['nom'], $_POST['prenom'], $_POST['ecole'], $_POST['email'], $_POST['type'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $ecole = $_POST['ecole'];
    $mot_de_passe = generateRandomPassword();
    $mot_de_passe = password_hash($mot_de_passe, PASSWORD_DEFAULT);
    $statut_id = 1;

    if (isset($_POST['groupe'], $_POST['promotion'])) {
        $groupe = $_POST['groupe'];
        $promotion = $_POST['promotion'];

        // Vérifier si la classe existe déjà
        $requete = $bdd->prepare("SELECT * FROM Classes WHERE groupe = :groupe AND promotion = :promotion AND ecole = :ecole");
        $requete->bindParam(':groupe', $groupe);
        $requete->bindParam(':promotion', $promotion);
        $requete->bindParam(':ecole', $ecole);
        $requete->execute();

        $classe_id = null;

        // Si la classe n'existe pas, la créer
        if ($requete->rowCount() == 0) {
            $requete = $bdd->prepare("INSERT INTO Classes (groupe, promotion, ecole) VALUES (:groupe, :promotion, :ecole)");
            $requete->bindParam(':groupe', $groupe);
            $requete->bindParam(':promotion', $promotion);
            $requete->bindParam(':ecole', $ecole);
            $requete->execute();

            // Récupérer l'ID de la classe
            $classe_id = $bdd->lastInsertId();
        } else {
            // Si la classe existe déjà, récupérer son ID
            $classe = $requete->fetch();
            $classe_id = $classe['id'];
        }
    }

    try {
        $requete = $bdd->prepare("INSERT INTO Utilisateurs (nom, prenom, email, mot_de_passe, ecole, statut_id) VALUES (:nom, :prenom, :email, :mot_de_passe, :ecole, :statut_id)");
        $requete->bindParam(':nom', $nom);
        $requete->bindParam(':prenom', $prenom);
        $requete->bindParam(':email', $email);
        $requete->bindParam(':mot_de_passe', $mot_de_passe);
        $requete->bindParam(':ecole', $ecole);
        $requete->bindParam(':statut_id', $statut_id);
        $requete->execute();

        // Récupérer l'ID de l'utilisateur
        $user_id = $bdd->lastInsertId();

        if ($classe_id) {
            // Insérer l'ID de l'utilisateur et l'ID de la classe dans la table etudiants_classes
            $requete = $bdd->prepare("INSERT INTO Etudiants_classes (id_etudiant, id_classe) VALUES (:id_etudiant, :id_classe)");
            $requete->bindParam(':id_etudiant', $user_id);
            $requete->bindParam(':id_classe', $classe_id);
            $requete->execute();
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

$query = $bdd->prepare("SELECT * FROM Utilisateurs WHERE statut_id = 1");
$query->execute();

$etudiants = $query->fetchAll();
?>


<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Gestion des étudiants</title>
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
    <div class="container-fluid text-center flex-float">
        <div class="row content">
            <div class="col-sm-10 text-left">
                <h1>Gestion des étudiants</h1>

                <div class="container">
                    <div class="left">
                        <h2>Ajouter un étudiant</h2>
                        <form action="etudiants_admin.php" method="post">
                            <input type="hidden" id="type" name="type" value="etudiant">
                            <div>
                                <label for="nom">Nom :</label>
                                <input type="text" id="nom" name="nom" required>
                            </div>
                            <div>
                                <label for="prenom">Prénom :</label>
                                <input type="text" id="prenom" name="prenom" required>
                            </div>
                            <div>
                                <label for="ecole">Ecole :</label>
                                <input type="text" id="ecole" name="ecole" value="ECE" required>
                            </div>
                            <div>
                                <label for="email">Email :</label>
                                <input type="email" id="email" name="email" required>
                            </div>
                            <div>
                                <label for="groupe">Groupe :</label>
                                <input type="number" id="groupe" name="groupe" min="1" max="10">
                            </div>
                            <div>
                                <label for="promotion">Promotion :</label>
                                <input type="number" id="promotion" name="promotion" min="1919" value="2026">
                            </div>
                            <button type="submit" class="submit-btn">Ajouter</button>
                        </form>
                    </div>

                    <div class="right">
                        <h2>Etudiants existants</h2>
                        <table>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Email</th>
                            </tr>
                            <?php foreach ($etudiants as $etudiant): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($etudiant['nom']); ?></td>
                                    <td><?php echo htmlspecialchars($etudiant['prenom']); ?></td>
                                    <td><?php echo htmlspecialchars($etudiant['email']); ?></td>
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
