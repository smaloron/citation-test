<?php

require "lib/pdo.php";

/**
 * Liste de tous les rôles depuis la BD
 *
 * @return array
 */
function getAllRoles()
{
    $pdo = getPDO();
    $sql = "SELECT * FROM roles";
    return $pdo->query($sql)
        ->fetchAll(PDO::FETCH_ASSOC);
}

function validateRegisterInput($data)
{
    $errors = [];

    if (empty($data["pseudo"])) {
        $errors[] = "Le pseudo ne peut être vide";
    }
    if (empty($data["email"])) {
        $errors[] = "L'email ne peut être vide";
    }
    if (empty($data["mot_de_passe"])) {
        $errors[] = "Le mot de passe ne peut être vide";
    } else if(mb_strlen($data["mot_de_passe"]) < 6){
        $errors[] = "Le mot de passe doit comporter au moins 6 catactères";
    }
    if (empty($data["role_id"])) {
        $errors[] = "Le role ne peut être vide";
    }

    return $errors;

}

function insertUser(array $data){
    $pdo = getPDO();
    $sql = "INSERT INTO utilisateurs (pseudo, email, mot_de_passe, role_id)
            VALUES                   (:pseudo, :email, :mot_de_passe, :role_id)";
    // hachage du mot de passe pour sécuriser l'application
    $data["mot_de_passe"] = password_hash(
        $data["mot_de_passe"], PASSWORD_BCRYPT);
    $statement = $pdo->prepare($sql);
    $statement->execute($data);
}

/**
 * Traitement du formulaire d'ajout de citation
 *
 * @return array $errors
 */
function handleRegisterForm(int $id = null)
{
    // On récupère la saisie
    $data = filter_input_array(INPUT_POST, [
        "pseudo" => FILTER_SANITIZE_STRING,
        "email" => FILTER_SANITIZE_EMAIL,
        "mot_de_passe" => FILTER_DEFAULT,
        "role_id" => FILTER_SANITIZE_NUMBER_INT,
    ]);

    // Validation de la saisie
    $errors = validateRegisterInput($data);

    // Insertion uniquement s'il n'y a pas d'erreurs
    if (count($errors) == 0) {
        try {
            // Ajout ou modification
            // en fonction de la valeur de $id
            if ($id) {
                //updateQuote($data, $id);
            } else {
                insertUser($data);
            }

            // redirection vers l'index
            header("location:index.php");
            exit;
        } catch (Exception $ex) {
            $errors[] = "Erreur interne du serveur";
            $errors[] = $ex->getMessage();
        }
    }

    return $errors;
}
