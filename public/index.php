<?php

use App\Controllers\ClientController;
use App\Controllers\ProductionController;
use App\Core\Router;
use App\Controllers\AuthController;
use App\Controllers\ApproController;
use App\Controllers\ArticleController;
use App\Controllers\CategorieController;
use App\Controllers\VenteController;

require_once "./../vendor/autoload.php";
//Front Controller
require_once "./../src/core/bootsrap.php";

Router::route("/article",[ArticleController::class,'lister']);
Router::route("/article/form",[ArticleController::class,'showForm']);
Router::route("/article/create",[ArticleController::class,'save']);

Router::route("/categorie",[CategorieController::class,'lister']);
Router::route("/categorie/create",[CategorieController::class,'add']);

Router::route("/login",[AuthController::class,'login']);
Router::route("/login/form",[AuthController::class,'showFormLogin']);
Router::route("/logout",[AuthController::class,'logout']);
Router::route("/user",[AuthController::class,'lister']);
Router::route("/user/add",[AuthController::class,'showForm']);
Router::route("/user/create",[AuthController::class,'save']);

Router::route("/appro",[ApproController::class,'index']);
Router::route("/appro/create",[ApproController::class,'save']);
Router::route("/appro/detail",[ApproController::class,'detailAppro']);
Router::route("/appro/payement",[ApproController::class,'validerPayement']);
Router::route("/appro/add/detail",[ApproController::class,'addDetail']);

Router::route("/client",[ClientController::class,'lister']);
Router::route("/client/add",[ClientController::class,'showForm']);
Router::route("/client/create",[ClientController::class,'save']);

Router::route("/vente",[VenteController::class,'index']);
Router::route("/vente/client",[VenteController::class,'listeVenteClient']);
Router::route("/vente/create",[VenteController::class,'save']);
Router::route("/vente/add/detail",[VenteController::class,'addDetail']);
Router::route("/vente/add/client",[VenteController::class,'addClient']);
Router::route("/vente/payement",[VenteController::class,'validerPayement']);
Router::route("/vente/detail",[VenteController::class,'detailvente']);

Router::route("/prod",[ProductionController::class,'index']);
Router::route("/prod/create",[ProductionController::class,'save']);
Router::route("/prod/add/detailVente",[ProductionController::class,'addDetailVente']);
Router::route("/prod/add/detailConf",[ProductionController::class,'addDetailConf']);
Router::route("/prod/detail",[ProductionController::class,'detail']);

Router::resolve();