<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['type'] != 'etudiant') {
  header("Location: connexion.html");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Accueil Étudiant</title>
</head>
<body>
  <h1>Bienvenue, <?php echo $_SESSION['prenom']; ?> !</h1>
  <p>Vous êtes connecté en tant qu'étudiant.</p>
  <a href="deconnexion.php">Se déconnecter</a>
</body>
</html>
