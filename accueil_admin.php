<?php
require_once 'BDD/initBDD.php';

session_start();

if (!isset($_SESSION['type']) || $_SESSION['type'] !== 'administrateur') {
    echo "Vous devez être connecté en tant qu'administrateur pour ajouter un utilisateur.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil Administrateur</title>
    <style>
        body {
            display: flex;
            font-family: Arial, sans-serif;
        }

        .navbar {
            width: 20%;
            height: 100vh;
            border-right: 1px solid #000;
            padding: 10px;
        }

        .navbar a {
            display: block;
            padding: 10px 0;
            color: #000;
            text-decoration: none;
        }

        .navbar a.active {
            color: #007BFF;
        }

        .content {
            width: 80%;
            padding: 10px;
        }
    </style>
</head>
<body>
<div class="navbar">
    <a href="accueil.php" class="nav-link active">Général</a>
    <a href="matieres_admin.php" class="nav-link">Matières</a>
    <a href="etudiants_admin.php" class="nav-link">Etudiants</a>
    <a href="professeurs_admin.php" class="nav-link">Professeurs</a>
</div>
<div class="content">
    <h2>Bienvenue sur la page d'administration</h2>
    <p>Sélectionnez un onglet pour commencer.</p>
</div>


<script>
    $('.nav-link').on('click', function (e) {
        e.preventDefault();

        // Remove the active class from all links
        $('.nav-link').removeClass('active');

        // Add the active class to the link that was clicked
        $(this).addClass('active');

        // Load the content from the page specified in the href attribute of the clicked link
        $('.content').load($(this).attr('href'));
    });
</script>
</body>
</html>

