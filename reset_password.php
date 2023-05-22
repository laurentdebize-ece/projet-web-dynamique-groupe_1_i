<?php
require_once 'BDD/initBDD.php';
session_start();

$erreur = null;
$email = $_POST['email'] ?? null;

$encrypted_email = openssl_encrypt($email, 'AES-128-ECB', 'secret_key');
$token = urlencode($encrypted_email);
if ($token !== ($_POST['token'] ?? null)) {
    $erreur = 'Le token entré n\'est pas bon';
    header('Location: mdp_oublie.php');
    exit;
}

if (isset($_POST['password'], $_POST['confirm_password'])) {
    if ($_POST['password'] === $_POST['confirm_password']) {
        if (strlen($_POST['password']) >= 8) {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
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

                    header('Location: index.php');
                    exit;
                } else {
                    $erreur = "L'utilisateur n'existe pas.";
                }
            } catch (PDOException $e) {
                $erreur = "Erreur : " . $e->getMessage();
            }
        } else {
            $erreur = "Votre mot de passe doit contenir au moins 8 caractères.";
        }
    } else {
        $erreur = "Les mots de passe ne correspondent pas.";
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Réinitialisation du mot de passe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 10%;
        }

        form {
            background: white;
            padding: 20px;
            border-radius: 10px;
            max-width: 500px;
            margin: auto;
        }

        h2, label {
            color: #4a5568;
        }

        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            box-sizing: border-box;
            border-radius: 5px;
            border: 1px solid #ced4da;
        }

        input[type="submit"] {
            background-color: #4caf50;
            border: none;
            color: white;
            padding: 15px 32px;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
        }

        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
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
    <div>
        <input type="submit" value="Valider">
    </div>
</form>
</body>
</html>