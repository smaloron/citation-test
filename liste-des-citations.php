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

<body class="container-fluid">

    <?php require "navigation.php"?>


    <div class="row justify-content-center">
        <div class="col-lg-10 p-2">
            <h1>Liste des citations</h1>

            <table class="table table-striped">
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
        </div>
    </div>
</body>

</html>