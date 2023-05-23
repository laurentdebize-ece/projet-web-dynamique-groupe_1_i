<?php
require_once 'BDD/initBDD.php';

session_start();
if (isset($_SESSION['token'])) {
    $token = $_SESSION['token'];
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
} else {
    // Redirigez l'utilisateur vers la page de réinitialisation du mot de passe si le token n'est pas défini
    header('Location: accueil.php');
    exit;
}
unset($_SESSION['token']);
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Changement du mot de passe</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="accueil.php">OMNES</a>
        </div>
    </div>
</nav>
<div id="divSupp">
<form action="reset_password.php" method="post">
    <?php if (isset($erreur)) : ?>
        <p class="error-message"><?php echo $erreur; ?></p>
    <?php endif; ?>
    <h2>Bonjour <?php echo htmlspecialchars($email); ?>, veuillez entrer votre nouveau mot de passe.</h2>
    <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
    <div>
        <label for="password">Nouveau mot de passe :</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div>
        <label for="confirm_password">Confirmez le nouveau mot de passe :</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
    </div>
    <div class="form-group">
        <input type="submit" value="Valider">
    </div>
</form>
</div>
<footer class="footer">
    <p>Footer Text</p>
</footer>
</body>

</html>

