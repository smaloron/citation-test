<?php
// Importation de la bibliothèque perso pdo.php
require "lib/pdo.php";

// Test de la connexion
try {
    $connexion = getPDO();
    echo "ça marche";
} catch(Exception $error){
    echo "ça plante";
}
