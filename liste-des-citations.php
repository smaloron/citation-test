<?php
// Import
require "lib/pdo.php";

// connexion BD
$cn = getPDO();

// Requête SQL
$query = $cn->query("SELECT * FROM citations");

// Récupération des résultats dans une variable
$quoteList = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des citations</title>
</head>
<body>
    <h1>Liste des citations</h1>

    <table>
        <tr>
            <th>id</th>
            <th>Texte</th>
            <th>Auteur</th>
        </tr>

        <?php foreach($quoteList as $quote): ?>
            <tr>
                <td> <?= $quote["id"]?> </td>
                <td> <?= $quote["texte"]?> </td>
                <td> <?= $quote["auteur"]?> </td>
            </tr>
        <?php endforeach ?>
    
    </table>
</body>
</html>