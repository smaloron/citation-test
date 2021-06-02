<?php
require "lib/pdo.php";


// On détermine si les données ont été postées
$isPosted = count($_POST) > 0; // filter_has_var(INPUT_POST, "submit")

// Tableau des erreurs
$errors = [];

// On traite le formulaire si les données ont été postées
if($isPosted){
    // On récupère la saisie
    $text = filter_input(INPUT_POST, "texte", FILTER_SANITIZE_STRING);
    $author = filter_input(INPUT_POST, "auteur", FILTER_SANITIZE_STRING);

    // Validation de la saisie
    if(empty($text)){
        $errors[] = "Le texte ne peut être vide";
    }

    if(empty($author)){
        $errors[] = "L'auteur ne peut être vide";
    }

    // Insertion uniquement s'il n'y a pas d'erreurs
    if(count($errors) == 0) {
        try {
            // On ajoute la nouvelle citation
            $pdo = getPDO();
            // La requête sql
            $sql = "INSERT INTO citations (texte, auteur) VALUES (?,?)";
            // Préparation de la requête
            $statement = $pdo->prepare($sql);
            // paramètres
            $params = [$text, $author];
            // Exécution en passant les paramètres
            $statement->execute($params);
        
            // redirection vers la liste des citations
            header("location:liste-des-citations.php");
            exit;
        } catch (Exception $ex) {
            $errors[] = "Erreur interne du serveur";
        }
    }
}

?>

<?php require "head.php" ?>

<body class="container-fluid">
    <?php require "navigation.php" ?>
    <div class="row justify-content-center">
        <div class="col-md-6">

            <?php if($errors): ?>
                <div class="alert alert-danger">
                    <?php foreach($errors as $errorMessage): ?>
                        <p><?= $errorMessage ?></p>
                    <?php endforeach ?>
                </div>
            <?php endif ?>

            <form method="post">
                <div class="mb-2">
                    <label class="form-label">Texte de la citation</label>
                    <textarea class="form-control" name="texte"></textarea>
                </div>
                <div class="mb-2">
                    <label class="form-label">Auteur de la citation</label>
                    <input type="text" class="form-control" name="auteur"></input>
                </div>

                <button type="submit" name="submit" 
                        class="btn btn-primary">
                    Valider
                </button>
            </form>
        </div>
    </div>
</body>

</html>