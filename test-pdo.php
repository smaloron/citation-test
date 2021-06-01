<?php
// Importation de la bibliothèque perso pdo.php
require "lib/pdo.php";

// Test de la connexion
try {
    $connexion = getPDO();
    echo "ça marche <br>";

    // Requête sur la base de données
    $sql = "SELECT * FROM citations";
    $query = $connexion->query($sql);
   

    // Récupération des données ligne à ligne
    $data = $query->fetch();
    var_dump($data);
    
    echo "<br>";

    $data = $query->fetch();
    var_dump($data);

    // Récupération de toutes les données
    echo "<pre>";
    $data = $query->fetchAll(PDO::FETCH_ASSOC);

    var_dump($data);

    echo "</pre>";

    // Afficher les données de $data (juste la colonne texte) dans une liste à puce

    echo "<ul>";

    foreach($data as $citation){
        echo "<li>". $citation['texte']. "</li>";
    }

    echo "</ul>";

} catch(Exception $error){
    echo $error->getMessage();
}
