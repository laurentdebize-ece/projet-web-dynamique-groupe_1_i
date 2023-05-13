<?php
session_start();

if (isset($_SESSION['type'])) {
    if ($_SESSION['type'] === 'administrateur') {
        echo "Bienvenue ! Vous êtes connecté en tant qu'administrateur.";
    } else {
        echo "Vous n'êtes pas un administrateur.";
        //exit;
    }
} else {
    echo "Vous n'êtes pas connecté.";
    exit;
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

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
<h1>Inscription</h1>

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
            <option value="administrateur">Administrateur</option>
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
            <input type="number" id="promotion" name="promotion">
        </div>
    </div>

    <div id="professeurSection" class="group-section" style="display: none;">
        <div>
            <label for="matiere">Matière :</label>
            <input type="text" id="matiere" name="matiere">
        </div>
        <div>
            <label for="grade">Grade :</label>
            <input type="text" id="grade" name="grade">
        </div>
    </div>

    <br>

    <button type="submit" class="submit-btn">Inscription</button>

</form>

</body>

</html>