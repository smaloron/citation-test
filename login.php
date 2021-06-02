<?php
// Démarre la session
session_start();

require "lib/pdo.php";
 
if (isPosted()){
    // récupération des saisies
    $data = filter_input_array(INPUT_POST, [
        "login" => FILTER_SANITIZE_STRING,
        "pass" => FILTER_DEFAULT
    ]);

    // Test de l'authentification
    $authenticated =   $data["login"] == "admin"
                    && $data["pass"] == "123";


    if($authenticated){
        // Enregistrement dans la session
        $_SESSION["user"] = "admin";
        $_SESSION["message"] = "Vous êtes authentifié";
        
        header("location:index.php");
        exit;
    }
    
}

?>

<?php require "head.php" ?>
<body class="container-fluid">
    <?php require "navigation.php" ?>

    <div class="row justify-content-center">
        <div class="col-md-4">

            <?php if(isPosted() && !$authenticated): ?>
                <div class="alert alert-danger">
                    <p>Vos infos sont incorrecte</p>
                </div>
            <?php endif ?>

            <form method="post">
                <div class="mb-3">
                    <label class="form-label">login</label>
                    <input type="text" name="login" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Mot de passe</label>
                    <input type="password" name="pass" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Connexion</button>
            </form>
        </div>
    </div>   
</body>
</html>