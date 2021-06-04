<?php

require "lib/pdo.php";

/**
 * Retourne une citation aléatoire extraite de la DB
 * @author sébastien Maloron <email@email.com>
 * @date 2021-06-02
 * @return array
 */
function getRandomQuote()
{
    // création de la connexion
    $cn = getPDO();
    // Requête pour extraire une citation
    // ORDER BY RAND() effectue un tri aléatoire
    // LIMIT 1 permet de n'obtenir qu'une ligne
    $query = $cn->query("SELECT * FROM citations ORDER BY RAND() LIMIT 1 ");
    // Récupération des données de la requête
    $quote = $query->fetch(PDO::FETCH_ASSOC);

    return $quote;
}

/**
 * Retourne la liste des citations
 * à partir d'une requête sur la BD
 *
 * @return array
 */
function getAllQuotes()
{
    // connexion BD
    $cn = getPDO();

    // Requête SQL
    $query = $cn->query("SELECT * FROM citations");

    // Récupération des résultats dans une variable
    $quoteList = $query->fetchAll(PDO::FETCH_ASSOC);

    return $quoteList;
}

/**
 * Validation des données contenues dans $data 
 *
 * @param array $data
 * @return array $errors
 */
function validateInput(array $data){
    // Initialisation du tableau des erreurs
    $errors = [];
    if (empty($data["texte"])) {
        $errors[] = "Le texte ne peut être vide";
    }

    if (empty($data["auteur"])) {
        $errors[] = "L'auteur ne peut être vide";
    }

    return $errors;
}

/**
 * Insertion d'une citation dans la base de données
 *
 * @param array $data
 * @return void
 */
function insertQuote(array $data){
    // On ajoute la nouvelle citation
    $pdo = getPDO();
    // La requête sql
    $sql = "INSERT INTO citations (texte, auteur) VALUES (?,?)";
    // Préparation de la requête
    $statement = $pdo->prepare($sql);
    // paramètres
    $params = [$data["texte"], $data["auteur"]];
    // Exécution en passant les paramètres
    $statement->execute($params);
}

/**
 * Traitement du formulaire d'ajout de citation
 *
 * @return array $errors
 */
function handleInsertQuoteForm()
{
    // On récupère la saisie
    $data = filter_input_array(INPUT_POST, [
        "texte" => FILTER_SANITIZE_STRING,
        "auteur" => FILTER_SANITIZE_STRING
    ]);

    // Validation de la saisie
    $errors = validateInput($data);
    
    // Insertion uniquement s'il n'y a pas d'erreurs
    if (count($errors) == 0) {
        try {
            insertQuote($data);
            // redirection vers la liste des citations
            header("location:liste-des-citations.php");
            exit;
        } catch (Exception $ex) {
            $errors[] = "Erreur interne du serveur";
        }
    }

    return $errors;
}

/**
 *
 * Suppression d'une citation dans la BD
 * en fonction d'un argument $id
 *
 * @return void
 *
 */
function deleteOneQuoteById(int $id)
{
// Requête SQL pour la suppression
    $sql = "DELETE FROM citations WHERE id=?";

// obtention d'une instance de pdo (connexion à la BD)
    $pdo = getPDO();

// préparation de la requête
    $statement = $pdo->prepare($sql);

// exécution de la requête
// en passant le paramètre dans un tableau ordinal
    $statement->execute([$id]);
}

