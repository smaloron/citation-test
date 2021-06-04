<?php
// Import
require "lib/quote-model.php";

$quoteList = getAllQuotes();

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
                    <th>actions</th>
                </tr>

                <?php foreach($quoteList as $quote): ?>
                <tr>
                    <td> <?= $quote["id"]?> </td>
                    <td> <?= $quote["texte"]?> </td>
                    <td> <?= $quote["auteur"]?> </td>
                    <td>
                        <a href="delete-citation.php?id=<?= $quote["id"]?>"
                        class="btn btn-danger">
                            supprimer
                        </a>
                        <a href="update-citation.php?id=<?= $quote["id"]?>"
                        class="btn btn-warning">
                            modifier
                        </a>
                    </td>
                </tr>
                <?php endforeach ?>

            </table>
        </div>
    </div>
</body>

</html>