<?php
require_once 'BDD/initBDD.php';

if (isset($_POST['email']) && isset($_POST['mot_de_passe'])) {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    try {
        $requete = $bdd->prepare("SELECT * FROM Utilisateurs WHERE email = :email");
        $requete->bindParam(':email', $email);
        $requete->execute();
        $utilisateur = $requete->fetch();

        if ($utilisateur && password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
            session_start();
            $_SESSION['utilisateur'] = $utilisateur;

            $requete = $bdd->prepare("SELECT statut FROM Statut WHERE id = :statut_id");
            $requete->bindParam(':statut_id', $utilisateur['statut_id']);
            $requete->execute();
            $status = $requete->fetchColumn();

            $_SESSION['type'] = $status;

            if ($status == 'administrateur') {
                header('Location: accueil.php');
                exit;
            } else if ($status == 'etudiant') {
                header('Location: accueil.php');
                exit;
            } else if ($status == 'professeur') {
                header('Location: accueil.php');
                exit;
            }
        } else {
            $erreur = "Email ou mot de passe incorrect.";
        }
    } catch (PDOException $e) {
        $erreur = "Erreur : " . $e->getMessage();
    }
    $nom_utilisateur = $email;

    /*if (isset($_POST['maintenir_connexion'])) {
        $temps_expiration = time() + (10 * 365 * 24 * 60 * 60);  // 10 ans
    } else {
        $temps_expiration = null;
    }

    //Lors de la connexion, stocker le nom d'utilisateur dans un cookie
    setcookie('nom_utilisateur', $nom_utilisateur, $temps_expiration);*/
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: #f8f9fa;
        }

        .connexion-container {
            width: 30%;
            padding: 50px;
            background: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.1);
        }

        .logo {
            width: 70%;
            height: auto;
            margin-bottom: 10px;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .submit-btn {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-transform: uppercase;
            font-weight: bold;
        }

        .info-text {
            color: gray;
            text-align: center;
            text-decoration: none;
            margin-bottom: 20px;
        }

        .forgotten-password {
            color: #007bff;
            text-align: center;
            text-decoration: none;
            margin-bottom: 20px;
        }

        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }

        footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            color: darkgray;
            text-align: center;
            padding: 0px 0;
        }

    </style>
</head>
<body>
<div class="connexion-container">
    <img src="img/logo%20ece%20copie%20PNG.png" alt="Logo" class="logo">
    <h1>Connexion avec votre compte</h1>
    <?php if (isset($erreur)) : ?>
        <p class="error-message"><?php echo $erreur; ?></p>
    <?php endif; ?>
    <form action="index.php" method="post">
        <input type="email" name="email" placeholder="xyz@example.com" required>
        <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
        <div class="remember-me">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">Maintenir la connexion</label>
        </div>
        <button type="submit" class="submit-btn">Connexion</button>
    </form>
    <p class="info-text">Cette connexion vous redirigera automatiquement vers votre site.</p>
    <a href="#" class="forgotten-password">Étudiants : mot de passe oublié ?</a>
</div>
</body>
<footer>
    ©Projet web dynamique - Groupe_1_i©
</footer>
</html>
