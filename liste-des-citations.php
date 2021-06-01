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

<?php require "head.php" ?>

<body>

    <?php require "navigation.php"?>


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