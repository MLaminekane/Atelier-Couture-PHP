<?php
use App\Core\Role;
use App\Core\Session;
?>
<style>
    /* Start Global Rules */
* {
  box-sizing: border-box;
}
body {
  font-family: 'Open Sans', sans-serif;
}
a {
  text-decoration: none;
}
ul {
  list-style: none;
  padding: 0;
  margin: 0;
}
.container {
  padding-left: 15px;
  padding-right: 15px;
  margin-left: auto;
  margin-right: auto;
}
/* Small */
@media (min-width: 768px) {
  .container {
    width: 750px;
  }
}
/* Medium */
@media (min-width: 992px) {
  .container {
    width: 970px;
  }
}
/* Large */
@media (min-width: 1200px) {
  .container {
    width: 1170px;
  }
}
/* End Global Rules */

/* Start Landing Page */
.landing-page header {
  min-height: 80px;
  display: flex;
}
@media (max-width: 767px) {
  .landing-page header {
    min-height: auto;
    display: initial;
  }
}
.landing-page header .container {
  display: flex;
  align-items: center;
  justify-content: space-between;
}
@media (max-width: 767px) {
  .landing-page header .container {
    flex-direction: column;
    justify-content: center;
  }
}
.landing-page header .logo {
  color: #5d5d5d;
  font-style: italic;
  text-transform: uppercase;
  font-size: 20px;
}

.landing-page header .links {
  display: flex;
  align-items: center;
}

.landing-page header .links li {
  margin-left: 30px;
  color: #5d5d5d;
  cursor: pointer;
  transition: .3s;
}

.landing-page header .links li:last-child {
  border-radius: 20px;
  padding: 10px 20px;
  color: #FFF;
  background-color: #6c63ff;
}
.landing-page header .links li:not(:last-child):hover {
  color: #6c63ff;
}
.landing-page .content .container {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 140px;
  min-height: calc(100vh - 80px);
}
.landing-page .content .info h1 {
  color: #5d5d5d;
  font-size: 44px;
}
.landing-page .content .info p {
  margin: 0;
  line-height: 1.6;
  font-size: 15px;
  color: #5d5d5d;
}
.landing-page .content .info button {
  border: 0;
  border-radius: 20px;
  padding: 12px 30px;
  margin-top: 30px;
  cursor: pointer;
  color: #FFF;
  background-color: #6c63ff;
}
.landing-page .content .image img {
  max-width: 100%;
}
header{
    background-color: #0C0C0D;
}

</style>
<link rel="stylesheet" href="http://localhost:8000/css/style.css">
<div class="landing-page">
    <header>
        <div class="container" style="width: 80%">
            <a href="<?=BASE_URL?>/categorie" class="logo">Atelier <b>Couture</b></a>
            <ul class="links">
                <li><a class="nav-link" href="<?=BASE_URL?>/categorie">CATEGORIE</a></li>
                <li><a class="nav-link" href="<?=BASE_URL?>/article">ARTICLE</a></li>
                <li><a class="nav-link" href="<?=BASE_URL?>/appro">APPROVISIONNEMENT</a></li>
                <li><a class="nav-link" href="<?=BASE_URL?>/vente">VENTE</a></li>
                <li><a class="nav-link" href="<?=BASE_URL?>/prod">PRODUCTION</a></li>
                <li class="nav-item dropdown" style="cursor: pointer">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-newspaper-o"></i> AJOUTER.. </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-cyan" aria-labelledby="navbarDropdownMenuLink-4">
                        <a class="dropdown-item" href="<?=BASE_URL?>/user">UTILISATEUR</a>
                        <a class="dropdown-item" href="<?=BASE_URL?>/client">CLIENT</a>
                    </div>
                </li>
                <li><a class="nav-link active" aria-current="page" href="<?=BASE_URL?>/logout">Deconnexion</a></li>
            </ul>
            <div style="margin-left: 3vw" class="text-white"> <?=Session::get("userconnect")['nomComplet']."/".Session::get("userconnect")['role']?></div>
        </div>
    </header>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script> 