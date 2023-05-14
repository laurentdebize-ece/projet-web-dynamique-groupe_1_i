<?php
require_once 'BDD/initBDD.php';

session_start();

if (!isset($_SESSION['type']) || $_SESSION['type'] !== 'administrateur') {
    echo "Vous devez être connecté en tant qu'administrateur pour gérer les professeurs.";
    exit;
}

if (isset($_POST['nom'], $_POST['prenom'], $_POST['ecole'], $_POST['email'], $_POST['mot_de_passe'], $_POST['type'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $ecole = $_POST['ecole'];
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);
    $statut_id = 2;

    // Assigner un professeur à une classe
    if (isset($_POST['professeur_id'], $_POST['classe_id'])) {
        $professeur_id = $_POST['professeur_id'];
        $classe_id = $_POST['classe_id'];

        try {
            $requete = $bdd->prepare("INSERT INTO Professeurs_classes (id_professeur, id_classe) VALUES (:id_professeur, :id_classe)");
            $requete->bindParam(':id_professeur', $professeur_id);
            $requete->bindParam(':id_classe', $classe_id);
            $requete->execute();

            echo "Le professeur a été assigné à la classe avec succès.";
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    // Assigner un professeur à une matière
    if (isset($_POST['professeur_id_matiere'], $_POST['matiere_id'])) {
        $professeur_id = $_POST['professeur_id_matiere'];
        $matiere_id = $_POST['matiere_id'];

        try {
            $requete = $bdd->prepare("INSERT INTO Professeurs_Matieres (id_professeur, id_matiere) VALUES (:id_professeur, :id_matiere)");
            $requete->bindParam(':id_professeur', $professeur_id);
            $requete->bindParam(':id_matiere', $matiere_id);
            $requete->execute();

            echo "Le professeur a été assigné à la matière avec succès.";
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
    // Enlever un professeur d'une classe
    if (isset($_POST['delete_class'], $_POST['professeur_id'], $_POST['classe_id'])) {
        $professeur_id = $_POST['professeur_id'];
        $classe_id = $_POST['classe_id'];

        try {
            $requete = $bdd->prepare("DELETE FROM Professeurs_classes WHERE id_professeur = :id_professeur AND id_classe = :id_classe");
            $requete->bindParam(':id_professeur', $professeur_id);
            $requete->bindParam(':id_classe', $classe_id);
            $requete->execute();

            echo "Le professeur a été enlevé de la classe avec succès.";
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    // Enlever un professeur d'une matière
    if (isset($_POST['delete_subject'], $_POST['professeur_id_matiere'], $_POST['matiere_id'])) {
        $professeur_id = $_POST['professeur_id_matiere'];
        $matiere_id = $_POST['matiere_id'];

        try {
            $requete = $bdd->prepare("DELETE FROM Professeurs_Matieres WHERE id_professeur = :id_professeur AND id_matiere = :id_matiere");
            $requete->bindParam(':id_professeur', $professeur_id);
            $requete->bindParam(':id_matiere', $matiere_id);
            $requete->execute();

            echo "Le professeur a été enlevé de la matière avec succès.";
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
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

        echo "L'utilisateur a été ajouté avec succès.";
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
$query = $bdd->prepare("SELECT * FROM Utilisateurs WHERE statut_id = (SELECT id FROM Statut WHERE statut = 'professeur')");
$query->execute();
$professeurs = $query->fetchAll();

$query = $bdd->prepare("SELECT * FROM Classes");
$query->execute();
$classes = $query->fetchAll();

$query = $bdd->prepare("SELECT * FROM Matieres");
$query->execute();
$matieres = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des professeurs</title>
    <style>
        .container {
            display: flex;
            justify-content: space-between;
        }

        .left, .right {
            flex: 1;
            padding: 20px;
        }

        .centered-title {
            text-align: center;
        }

        .submit-btn {
            display: block;
            width: 30%;
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

<h1 class="centered-title">Gestion des professeurs</h1>

<div class="container">
    <div class="left">
        <h2>Ajouter un professeur</h2>
        <form action="professeurs_admin.php" method="post">
            <input type="hidden" id="type" name="type" value="professeur">
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
            <button type="submit" class="submit-btn">Ajouter</button>
        </form>
    </div>

    <div class="right">
        <h2>Professeurs existants</h2>
        <table>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
            </tr>
            <?php foreach ($professeurs as $professeur): ?>
                <tr>
                    <td><?php echo htmlspecialchars($professeur['nom']); ?></td>
                    <td><?php echo htmlspecialchars($professeur['prenom']); ?></td>
                    <td><?php echo htmlspecialchars($professeur['email']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <h2>Matières existantes</h2>
        <table>
            <tr>
                <th>Nom</th>
                <th>Volume horaire</th>
            </tr>
            <?php foreach ($matieres as $matiere): ?>
                <tr>
                    <td><?php echo htmlspecialchars($matiere['nom_matiere']); ?></td>
                    <td><?php echo htmlspecialchars($matiere['volume_horaire']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

<br>

<div class="centered-title">
    <button>
        <a href="matieres_admin.php" style="text-decoration: none; color: inherit;">Ajouter une matière/classe</a>
    </button>
</div>

<div class="centered-title">
    <h2>Assigner un professeur à une classe</h2>
    <form action="professeurs_admin.php" method="post">
        <label for="professeur_id">Professeur :</label>
        <select id="professeur_id" name="professeur_id" required>
            <?php foreach ($professeurs as $professeur): ?>
                <option
                    value="<?php echo $professeur['id']; ?>"><?php echo htmlspecialchars($professeur['prenom'] . " " . $professeur['nom']); ?></option>
            <?php endforeach; ?>
        </select>
        <label for="classe_id">Classe :</label>
        <select id="classe_id" name="classe_id" required>
            <?php foreach ($classes as $classe): ?>
                <option
                    value="<?php echo $classe['id']; ?>"><?php echo htmlspecialchars("Groupe n°" . $classe['groupe'] . " -- Promo : " . $classe['promotion'] . " -- Ecole : " . $classe['ecole']); ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Assigner</button>
    </form>

    <h2>Assigner un professeur à une matière</h2>
    <form action="professeurs_admin.php" method="post">
        <label for="professeur_id_matiere">Professeur :</label>
        <select id="professeur_id_matiere" name="professeur_id_matiere" required>
            <?php foreach ($professeurs as $professeur): ?>
                <option
                    value="<?php echo $professeur['id']; ?>"><?php echo htmlspecialchars($professeur['prenom'] . " " . $professeur['nom']); ?></option>
            <?php endforeach; ?>
        </select>
        <label for="matiere_id">Matière :</label>
        <select id="matiere_id" name="matiere_id" required>
            <?php foreach ($matieres as $matiere): ?>
                <option value="<?php echo $matiere['id']; ?>">
                    <?php echo htmlspecialchars("Matière : " . $matiere['nom_matiere'] . " -- Volume horaire : " . $matiere['volume_horaire']); ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Assigner</button>
    </form>
</div>

<div class="centered-title">
    <h2>Enlever un professeur d'une classe</h2>
    <form action="professeurs_admin.php" method="post">
        <label for="professeur_id">Professeur :</label>
        <select id="professeur_id" name="professeur_id" required>
            <?php foreach ($professeurs as $professeur): ?>
                <option
                    value="<?php echo $professeur['id']; ?>"><?php echo htmlspecialchars($professeur['prenom'] . " " . $professeur['nom']); ?></option>
            <?php endforeach; ?>
        </select>
        <label for="classe_id">Classe :</label>
        <select id="classe_id" name="classe_id" required>
            <?php foreach ($classes as $classe): ?>
                <option
                    value="<?php echo $classe['id']; ?>"><?php echo htmlspecialchars("Groupe n°" . $classe['groupe'] . " -- Promo : " . $classe['promotion'] . " -- Ecole : " . $classe['ecole']); ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit" name="delete_class">Enlever</button>
    </form>

    <h2>Enlever un professeur d'une matière</h2>
    <form action="professeurs_admin.php" method="post">
        <label for="professeur_id_matiere">Professeur :</label>
        <select id="professeur_id_matiere" name="professeur_id_matiere" required>
            <?php foreach ($professeurs as $professeur): ?>
                <option
                    value="<?php echo $professeur['id']; ?>"><?php echo htmlspecialchars($professeur['prenom'] . " " . $professeur['nom']); ?></option>
            <?php endforeach; ?>
        </select>
        <label for="matiere_id">Matière :</label>
        <select id="matiere_id" name="matiere_id" required>
            <?php foreach ($matieres as $matiere): ?>
                <option value="<?php echo $matiere['id']; ?>">
                    <?php echo htmlspecialchars("Matière : " . $matiere['nom_matiere'] . " -- Volume horaire : " . $matiere['volume_horaire']); ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit" name="delete_subject">Enlever</button>
    </form>
</div>


</body>
</html>
