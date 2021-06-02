<?php
 define('DSN', 'mysql:host=localhost;dbname=citations;charset=utf8');
 define('DB_USER', 'root');
 define('DB_PASS', '');

 /**
  * Fonction de connexion à la BD
  *
  * @return PDO
  */
 function getPDO(){
     // options de connexion
     $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

     return new PDO(DSN, DB_USER, DB_PASS, $options);
 }

 /**
  * Retourne vrai si les données du formulaire sont postées
  *
  * @return boolean
  */
 function isPosted(){
    return count($_POST) > 0;
 }

?>