<?php 

//Front Contronler ==> Charger le Router
define("BASE_URL","http://localhost:8000");
require_once "./../helpers/helpers.php";

//Composer
   //Chargement automatiques des classes ==> PSR-4 : autoloading
    //Java                  PHP
   // pakadge                  1-Ranger les classes dans des Namespaces  
   //                          2-Les Classes portent le meme nom que les fichiers
   //import pakadge.Classe     3- use Namespaces\Classe
   //Toutes les classes de PHP appartiennent a un namespace Racine ==>\
   //Ajouter des Dependances et les configurer dans notre projet