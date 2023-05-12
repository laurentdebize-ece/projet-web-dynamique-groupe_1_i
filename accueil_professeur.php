<?php
session_start();

if (isset($_SESSION['type'])) {
    if ($_SESSION['type'] === 'professeur') {
        echo "Bienvenue ! Vous êtes connecté en tant que professeur.";
    } else {
        echo "Vous n'êtes pas un professeur.";
        exit;
    }
} else {
    echo "Vous n'êtes pas connecté.";
    exit;
}
?>
