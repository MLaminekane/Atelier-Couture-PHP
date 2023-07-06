<?php
use App\Core\Role;
use App\Core\Session;
 if(!Role::hasRole("Admin") ) redirect("categorie");
 if(Session::isset("sms")) {
    $sms=Session::get("sms");
    Session::unset("sms");  
}
?>
<div class="container mt-3">
    <div class="card">
         <?php if(!empty($sms)):?>
            <div class="alert alert-info" role="alert" style="background-color: white-red;">
                <?=$sms??""?>
            </div>
        <?php endif?>
        <div class="card-body">
            <h4 class="card-title">Liste des Ventes</h4>
           
            <div class="table table-bordered table-light mt-3">
                <table  class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Montant</th>
                            <th scope="col">Etat Paiement</th>
                            <th scope="col">Client</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($ventes as $vente): ?>

                            <tr class="">
                                <td scope=" row"> <?=$vente->date?> </td>
                                <td><?=$vente->montant?></td>
                                <td><?=$vente->payer?"Payer":"Impayer"?></td>
                                <td><?=$vente->idClient?></td>
                                <td class="d-flex">
                                    <?php if(!$vente->payer):?>
                                    <a name="" id="" class="btn btn-sm btn-danger  text-white  "
                                        href="<?=BASE_URL?>/vente/payement?id-vente=<?=$vente->id?>" role="button">Valider
                                        Paiement</a>
                                    <?php endif?>
                                    <form method="post" action="<?=BASE_URL?>/vente/detail" style="margin-left:5px;">
                                        <input type="hidden" name="id-vente" value="<?=$vente->id?>">
                                        <button name="" id="" class=" btn btn-sm btn-info text-white mr-1 "
                                            type="submit">Voir Details</button>
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

