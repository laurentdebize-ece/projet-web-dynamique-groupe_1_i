<?php
session_start();

if (isset($_SESSION['type'])) {
    if ($_SESSION['type'] === 'etudiant') {
        echo "Bienvenue ! Vous êtes connecté en tant qu'étudiant.";
    } else {
        echo "Vous n'êtes pas un étudiant.";
        exit;
    }
} else {
    echo "Vous n'êtes pas connecté.";
    exit;
}
?>
