<?php
    session_start();

    // Import de la bibliothèque quote-model
    require "lib/quote-model.php";
    require "lib/user-model.php";

    $quote = getRandomQuote();
    
?>

<?php require "head.php" ?>

<body class="container-fluid p-4">
    <?php require "navigation.php" ?>

    <h1 class="mb-3">La citation du jour</h1>



    <!-- Affichage du message -->
    <?php if(hasFlashMessage()): ?>
        <div class="alert alert-primary">
            <?= getFlashMessage() ?>
        </div>
    <?php endif ?>
    

    <!-- on dit bonjour à l'utilisateur -->
    <?php if(isUserLogged()): ?>
        <p>Bonjour <?= getUserName() ?></p>
    <?php endif ?>

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