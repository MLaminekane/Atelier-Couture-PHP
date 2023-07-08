<?php
use App\Core\Role;
 if(!Role::hasRole("Admin") ) redirect("categorie");
?>

<div class="container mt-3">
    <div class="card" style="background-color: #E9F1FA">

        <div class="card-body" style="background-color: #E9F1FA">
            <div class="row float-end ">
                <div class="col-4  ">
                    <a name="" id="" class="btn btn-info  text-white  " href="<?=BASE_URL?>/client/add"
                        role="button">Nouveau</a>
                </div>

            </div>
            <h4 class="card-title">Liste des Utilisateurs</h4>
            <div class="table table-bordered table-light mt-3">
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">NOM</th>
                            <th scope="col">PRENOM</th>
                            <th scope="col">TELEPHONE </th>
                            <th scope="col">ADRESSE</th>
                            <th scope="col">ETAT</th>
                            <th scope="col">ACHAT</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($client as $cl): ?>

                        <tr class="">
                            <td scope=" row"> <?=$cl->getId()?> </td>
                            <td><?=$cl->getNom()?></td>
                            <td><?=$cl->getPrenom()?></td>
                            <td><?=$cl->getTelephone()?></td>
                            <td><?=$cl->getAdresse()?></td>
                            <td><?=$cl->getEtat()?></td>
                            <td class="d-flex">
                                    <form method="post" action="<?=BASE_URL?>/vente/client" style="margin-left:5px;">
                                        <input type="hidden" name="client" value="<?=$cl->getId()?> ">
                                        <button name="" id="" class=" btn btn-sm btn-info text-white mr-1 "
                                            type="submit">Voir Achat</button>
                                    </form>
                                </td>
                        </tr>

                        <?php endforeach ?>
                    </tbody>
                </table>
                <?php require_once "./../views/inc/paginate.html.php"; ?>
            </div>
        </div>
    </div>

</div>

