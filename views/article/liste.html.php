<?php
use App\Core\Role;
if(!Role::isConnect()) redirect("/login/form");
if (!Role::hasRole("Admin")) redirect("/categorie");
?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    
     <!-- Custom fonts for this template-->
     <link href="http://localhost:8000/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="http://localhost:8000/css/sb-admin-2.css" rel="stylesheet">

</head>

<body >
    <header >
        <?php require_once "./../views/inc/nav.html.php"; ?>
    </header>
    <div class="container d-flex justify-content-center align-items-center">
    <div class="table-responsive my-6" style="width: 80%;">
    <h1 class="text-center display-3 blue-100 lh-1 fw-bold" style="color: white">Liste Articles</h1>

        <div class="mt-10">
            <a href="<?=BASE_URL?>/article/form" class="btn btn-primary btn-lg">Ajouter Article</a>
        </div>
        <table class="table my-12" style="color: #000;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Libelle</th>
                    <th>Categorie</th>
                    <th>Prix Achat</th>
                    <th>Quantite Stock</th>
                    <th>Type</th>
                    <th>Date Production</th>
                    <th>Fournisseur</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($articles as $cat) : ?>
                    <tr class="text-center">
                        <td><?= $cat->getId() ?></td>
                        <td><?= $cat->getLibelle() ?></td>
                        <td><?= $cat->getCategorie()->getLibelle()?></td>
                        <td><?= $cat->getPrixAchat()?></td>
                        <td><?= $cat->getQteStock() ?></td>
                        <td><?= $cat->getType() ?></td>
                        <td><?= $cat->getType() == "ArticleVente" ? $cat->getDateProduction() : "-" ?></td>
                        <td><?= $cat->getType() == "ArticleConfection" ? $cat->getFournisseur() : "-" ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <?php require_once "./../views/inc/paginate.html.php"; ?>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>