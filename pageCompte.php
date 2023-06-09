<?php
session_start();
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
    <title>Omnes MySkill</title>
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
            <h2>Mon Profil</h2>
            <div class="profile">
                <img src='img/OIP.jpg' width="150">
                <?php
                if (isset($_SESSION['type'])) {
                    ?>
                    <h3><?php echo "Nom : " . $_SESSION['nom']; ?></h3>
                    <h3><?php echo "Prénom : " . $_SESSION['prenom']; ?></h3>
                    <p><?php echo "Email : " . $_SESSION['email']; ?></p>
                    <p><?php echo "Ecole : " . $_SESSION['ecole']; ?></p>
                    <?php
                    if ($_SESSION['type'] === 'etudiant') {
                        ?>
                        <p>Statut : Etudiant</p><br>
                        <?php
                    } else if ($_SESSION['type'] === 'professeur') {
                        ?>
                        <p>Statut : Professeur</p>
                        <?php
                    } else if ($_SESSION['type'] === 'administrateur') {
                        ?>
                        <p>Statut : Administrateur</p>
                        <?php
                    }

                } ?>
                <!--<h3>Nom: Admin Admin</h3>
                <p>Email: admin@ece.fr</p>
                <p>Ecole: ECE</p>
                <p>Statut: Admin</p>-->
            </div>
        </div>
        <div class="col-sm-2 sidenav">
            <a href="pageCompte.php"><img src='img/OIP.jpg' width="80" height="80" style="border-radius: 40px;"></a>
            <?php
            if (isset($_SESSION['type'])) {
                if ($_SESSION['type'] === 'etudiant') {
                    ?>
                    <p class="etat"><a>Etudiant &#128104;&#8205;&#127891;</a></p><br>
                    <p><a href="matieres.php">Matières</a></p><br>
                    <p><a href="competences.php">Compétences</a></p><br>
                    <p><a href="competences_transverses.php">Compétences transverses</a></p><br>
                    <p><a href="toutes_mes_competences.php">Toutes mes compétences</a></p><br>
                    <p><a href="pageCompetences.php">tableauEvaluationTTCompte</a></p><br><br><br>
                    <?php
                } else if ($_SESSION['type'] === 'professeur') {
                    ?>
                    <p class="etat"><a>Professeur &#128104;&#8205;&#127979;</a></p>
                    <p><a href="matieres.php">Matières</a></p><br>
                    <p><a href="competences.php">Compétences</a></p><br>
                    <p><a href="competences_transverses.php">Compétences transverses</a></p><br>
                    <p><a href="toutes_mes_competences.php">Toutes mes compétences</a></p><br>
                    <p><a href="pageCompetences.php">tableauEvaluationTTCompt</a></p><br><br><br>
                    <?php
                } else if ($_SESSION['type'] === 'administrateur') {
                    ?>
                    <p class="etat"><a> Administrateur &#128104;&#8205;&#128187;</a></p>
                    <br><br><br>
                    <p><a href="matieres_admin.php"> Matières/Classes</a></p><br>
                    <p><a href="etudiants_admin.php"> Etudiants</a></p><br>
                    <p><a href="professeurs_admin.php"> Professeurs</a></p><br>
                    <p><a href="supprimer_utilisateurs.php"> Supprimer</a></p><br><br><br>
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
        </div>

    </div>

    <footer class="footer">
        <p>Footer Text</p>
    </footer>

</div>

</body>

</html>
