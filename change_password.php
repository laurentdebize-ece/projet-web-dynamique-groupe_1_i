<?php
require_once 'BDD/initBDD.php';

session_start();
if (isset($_POST['password'], $_POST['confirm_password'])) {
    if ($_POST['password'] === $_POST['confirm_password']) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $email = $_POST['email'];

        try {
            $requete = $bdd->prepare("UPDATE Utilisateurs SET mot_de_passe = :password, first_login = 0 WHERE email = :email");
            $requete->bindParam(':password', $password);
            $requete->bindParam(':email', $email);
            $requete->execute();

            // Après le changement de mot de passe
            $requete = $bdd->prepare("SELECT id FROM Utilisateurs WHERE email = :email");
            $requete->bindParam(':email', $email);
            $requete->execute();

            if ($requete->rowCount() > 0) {
                $utilisateur = $requete->fetch();
                $utilisateur_id = $utilisateur['id'];

                $requete = $bdd->prepare("UPDATE Utilisateurs SET first_login = 0 WHERE id = :id");
                $requete->bindParam(':id', $utilisateur_id);
                $requete->execute();

                echo "Votre mot de passe a été modifié avec succès.";
            } else {
                echo "L'utilisateur n'existe pas.";
            }

            header('Location: index.php');
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    } else {
        echo "Les mots de passe ne correspondent pas.";
    }
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Changement de mot de passe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .form-group button {
            padding: 8px 20px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #45a049;
        }

        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>

<body>
<div class="container">
    <h2>Changement de mot de passe</h2>
    <form action="change_password.php" method="post">
        <div class="form-group">
            <label for="email">Adresse e-mail :</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Nouveau mot de passe :</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirmez le mot de passe :</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>
        <div class="form-group">
            <button type="submit">Changer le mot de passe</button>
        </div>
    </form>
</div>
</body>

</html>

