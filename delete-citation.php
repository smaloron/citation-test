<?php

// Récupération de l'id passé dans l'url
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

// import de la bibliothèque quote-model
require "lib/quote-model.php";

// appel de la fonction de suppression
deleteOneQuoteById($id);

// redirection
header("location:liste-des-citations.php");
