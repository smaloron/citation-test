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

<?php require "head.php" ?>

<body class="container-fluid p-4">
    <?php require "navigation.php" ?>

    <h1 class="mb-3">La citation du jour</h1>


    <div class="alert alert-success">
        <figure>
            <blockquote class="blockquote">
                <!-- ici le texte de la citation -->
                <?= $quote["texte"] ?>
            </blockquote>

            <figcaption class="blockquote-footer">
                <!-- ici l'auteur de la citation -->
                <?= $quote["auteur"] ?>
            </figcaption>
        </figure>
    </div>

</body>

</html>