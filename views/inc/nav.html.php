<?php
use App\Core\Role;
use App\Core\Session;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Examen Atelier Couture</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="http://localhost:8000/css/style.css">
</head>
<nav class="mb-4 navbar navbar-expand-lg" style="background-color: #FBC40E">
    <div class="text-white"><?=Session::get("userconnect")['nomComplet']."<br> ".Session::get("userconnect")['role']?></div>        
    <a class="navbar-brand" href="#"><img src="https://images.pexels.com/photos/6765513/pexels-photo-6765513.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" height="60" style="border-radius: 50%;" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent-4" style="margin-left: 25vw">
        <ul class="navbar-nav ml-auto" style="font-size: 18px; font-weight: bold">
            <li class="nav-item active">
                <a class="nav-link" href="<?=BASE_URL?>/article">ARTICLE</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="<?=BASE_URL?>/categorie">CATEGORIE</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="<?=BASE_URL?>/appro">APPROVISIONNEMENT</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="<?=BASE_URL?>/vente">VENTE</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="<?=BASE_URL?>/prod">PRODUCTION</a>
            </li>

            <li class="nav-item dropdown" style="cursor: pointer">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-newspaper-o"></i> AJOUTER.. </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-cyan" aria-labelledby="navbarDropdownMenuLink-4">
                    <a class="dropdown-item" href="<?=BASE_URL?>/user">UTILISATEUR</a>
                    <a class="dropdown-item" href="<?=BASE_URL?>/client">CLIENT</a>
                </div>
            </li>
            <li class="nav-item active">
                <a class="nav-link active" aria-current="page" href="<?=BASE_URL?>/logout">Deconnexion</a>
            </li>
        </ul>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>
