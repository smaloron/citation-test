<?php
    // Import de la bibliothèque pdo
    require "lib/pdo.php";

    // création de la connexion
    $cn = getPDO();
    // Requête pour extraire une citation
    // ORDER BY RAND() effectue un tri aléatoire
    // LIMIT 1 permet de n'obtenir qu'une ligne
    $query = $cn->query("SELECT * FROM citations ORDER BY RAND() LIMIT 1 ");
    // Récupération des données de la requête
    $quote = $query->fetch(PDO::FETCH_ASSOC);
    
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citation du jour</title>
</head>

<body>
    <?php require "navigation.php" ?>

    <h1>La citation du jour</h1>


    <div>
        <figure>
            <blockquote>
                <!-- ici le texte de la citation -->
                <?= $quote["texte"] ?>
            </blockquote>

            <figcaption>
                <!-- ici l'auteur de la citation -->
                <?= $quote["auteur"] ?>
            </figcaption>
        </figure>
    </div>

</body>

</html>