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
