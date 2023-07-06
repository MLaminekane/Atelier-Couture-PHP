<?php
use App\Core\Role;
 if(!Role::hasRole("Admin") ) redirect("categorie");
?>

<div class="container mt-3">
    <div class="card">

        <div class="card-body">
            <div class="row float-end ">
                <div class="col-4  ">
                    <a name="" id="" class="btn btn-info  text-white  " href="<?=BASE_URL?>/user/add"
                        role="button">Nouveau</a>
                </div>

            </div>
            <h4 class="card-title">Liste des Utilisateurs</h4>
            <div class="table table-bordered table-light mt-3">
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nom Complet</th>
                            <th scope="col">Login</th>
                            <th scope="col">PASSWORD</th>
                            <th scope="col">ROLE</th>
                            <th scope="col">ETAT</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($users as $us): ?>

                        <tr class="">
                            <td scope=" row"> <?=$us->getId()?> </td>
                            <td><?=$us->getNomComplet()?></td>
                            <td><?=$us->getLogin()?></td>
                            <td><?=$us->getPassword()?></td>
                            <td><?=$us->getRole()?></td>
                            <td><?=$us->getEtat()?></td>
                            
                        </tr>

                        <?php endforeach ?>
                    </tbody>
                </table>
                <?php require_once "./../views/inc/paginate.html.php"; ?>
            </div>
        </div>
    </div>

</div>