<?php
require_once 'BDD/initBDD.php';

session_start();

if (!isset($_SESSION['type']) || $_SESSION['type'] !== 'administrateur') {
    echo "Vous devez être connecté en tant qu'administrateur pour ajouter un utilisateur.";
    exit;
}

if (isset($_POST['nom'], $_POST['prenom'], $_POST['ecole'], $_POST['email'], $_POST['mot_de_passe'], $_POST['type'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $ecole = $_POST['ecole'];
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);
    $type = $_POST['type'];

    $statut_id = ($type === 'etudiant') ? 1 : 2;

    if ($statut_id === 1 && isset($_POST['nom_classe'])) {
        $nom_classe = $_POST['nom_classe'];
        $promotion = $_POST['promotion'];

        // Vérifier si la classe existe déjà
        $requete = $bdd->prepare("SELECT * FROM Classes WHERE nom_classe = :nom_classe AND promotion = :promotion");
        $requete->bindParam(':nom_classe', $nom_classe);
        $requete->bindParam(':promotion', $promotion);
        $requete->execute();

        // Si la classe n'existe pas, la créer
        if ($requete->rowCount() == 0) {
            $requete = $bdd->prepare("INSERT INTO Classes (nom_classe, promotion) VALUES (:nom_classe, :promotion)");
            $requete->bindParam(':nom_classe', $nom_classe);
            $requete->bindParam(':promotion', $promotion);
            $requete->execute();
        }

    } else if ($statut_id === 2 && isset($_POST['matiere'], $_POST['volume_horaire'])) {
        $matiere = $_POST['matiere'];
        $volume_horaire = $_POST['volume_horaire'];

        // Vérifier si la matière existe déjà
        $requete = $bdd->prepare("SELECT * FROM Matieres WHERE nom = :matiere AND volume_horaire = :volume_horaire");
        $requete->bindParam(':matiere', $matiere);
        $requete->bindParam(':volume_horaire', $volume_horaire);
        $requete->execute();

        // Si la matière n'existe pas, la créer
        if ($requete->rowCount() == 0) {
            $requete = $bdd->prepare("INSERT INTO Matieres (nom, volume_horaire) VALUES (:matiere, :volume_horaire)");
            $requete->bindParam(':matiere', $matiere);
            $requete->bindParam(':volume_horaire', $volume_horaire);
            $requete->execute();
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

        echo "L'utilisateur a été ajouté avec succès.";
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

if (isset($_POST['email_suppression'])) {
    $email_suppression = $_POST['email_suppression'];

    try {
        $requete = $bdd->prepare("DELETE FROM Utilisateurs WHERE email = :email");
        $requete->bindParam(':email', $email_suppression);
        $requete->execute();

        if ($requete->rowCount() > 0) {
            echo "L'utilisateur a été supprimé avec succès.";
        } else {
            echo "Aucun utilisateur trouvé avec cet email.";
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="style1.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Administration</title>
    <style>

        h1 {
            text-align: center;
            color: #6c757d;
        }

        form {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #6c757d;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        .group-section {
            display: none;
        }

        .group-section label {
            display: inline-block;
            margin-bottom: 0;
            margin-right: 10px;
        }

        .group-section input[type="text"],
        .group-section input[type="number"] {
            width: calc(50% - 10px);
        }

        .submit-btn {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            background-color: #6c757d;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-transform: uppercase;
            font-weight: bold;
        }

        .submit-btn:hover {
            background-color: #5a6268;
        }
    </style>

</head>

<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="accueil.php">OMNES</a>
            <a class="navbar-brand center" href="pageCompetences.php">Skills</a>
        </div>
    </div>
</nav>
<div id="divSupp" class="container-fluid text-center flex-float"> <!--style="height: 100%"-->
    <div class="row content">

        <div class="col-sm-10 text-left">
            <h1>Ajout utilisateur</h1>

            <form action="ajout_utilisateur.php" method="post">
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
                    <label for="mot_de_passe">Mot de passe :</label>
                    <input type="password" id="mot_de_passe" name="mot_de_passe" required>
                </div>
                <div>
                    <label for="type">Type :</label>
                    <select id="type" name="type" required>
                        <option value="">--Choisissez une option--</option>
                        <option value="etudiant">Étudiant</option>
                        <option value="professeur">Professeur</option>
                    </select>
                </div>

                <script>
                    document.getElementById('type').addEventListener('change', function () {
                        var groupeSection = document.getElementById('groupeSection');
                        var professeurSection = document.getElementById('professeurSection');
                        if (this.value === 'etudiant') {
                            groupeSection.style.display = 'block';
                            professeurSection.style.display = 'none';
                        } else if (this.value === 'professeur') {
                            professeurSection.style.display = 'block';
                            groupeSection.style.display = 'none';
                        } else {
                            groupeSection.style.display = 'none';
                            professeurSection.style.display = 'none';
                        }
                    });
                </script>

                <div id="groupeSection" class="group-section" style="display: none;">
                    <div>
                        <label for="nom_classe">Groupe :</label>
                        <input type="text" id="nom_classe" name="nom_classe">
                    </div>
                    <div>
                        <label for="promotion">Promotion :</label>
                        <input type="number" id="promotion" name="promotion" value="2026">
                    </div>
                </div>

                <div id="professeurSection" class="group-section" style="display: none;">
                    <div>
                        <label for="matiere">Matière :</label>
                        <input type="text" id="matiere" name="matiere">
                    </div>
                    <div>
                        <label for="volume_horaire">Volume horaire :</label>
                        <input type="number" id="volume_horaire" name="volume_horaire">
                    </div>
                </div>

                <br>

                <button type="submit" class="submit-btn">Inscription</button>

            </form>

            <h1>Suppression d'utilisateur</h1>
            <form action="ajout_utilisateur.php" method="post">
                <div>
                    <label for="email_suppression">Email de l'utilisateur à supprimer :</label>
                    <input type="email" id="email_suppression" name="email_suppression" required>
                </div>
                <button type="submit" class="submit-btn">Supprimer l'utilisateur</button>
            </form>
        </div>
        <div class="col-sm-2 sidenav">
            <a href="pageCompte.php"><img src='img/OIP.jpg' width="80" height="80" style="border-radius: 40px;" ;</a>
            <?php
            echo "<br><strong>" . $_SESSION['type'] . "</strong>";
            ?>
            <br><br><br>
            <p><a href="index.php">Connectez-vous ici</a></p><br><br>
            <p><a href="matieres.php">Matières</a></p><br>
            <p><a href="competences.php">Compétences</a></p><br>
            <p><a href="competences_transverses.php">Compétences transverses</a></p><br>
            <p><a href="toutes_mes_competences.php">Toutes mes compétences</a></p><br>
            <p><a href="ajout_utilisateur.php">AJOUTER UTILISATEUR</a></p><br>
            <p><a href="pageCompetences.php">tableauEvaluationTTCompt</a></p><br>
            <!--<p><a href="connexion.php">CONNEXION</a></p>-->
        </div>
    </div>
</div>
<footer class="footer">
    <p>Footer Text</p>
</footer>
</body>

</html>