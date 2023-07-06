<?php
use App\Core\Role;
use App\Core\Session;
 if(!Role::hasRole("Admin") ) redirect("categorie");
 if(Session::isset("sms")) {
    $sms=Session::get("sms");
    Session::unset("sms");  
}
?>
<div class="container mt-3" >
    <div class="card" style="background-color: #6E6E6E">
         <?php if(!empty($sms)):?>
            <div class="alert alert-info" role="alert" style="background-color: white-red;">
                <?=$sms??""?>
            </div>
        <?php endif?>
        <div class="card-body">
            <div class="row float-end ">
                <div class="col-4  ">
                    <a name="" id="" class="btn btn-info  text-white  " href="<?=BASE_URL?>/vente/create"
                        role="button">Nouveau</a>
                </div>

            </div>
            <h4 class="card-title">Liste des Ventes</h4>

            <div class="d-flex w-full" style="align-items: center">
                <form class="d-flex align-items-center" method="post" action="<?=BASE_URL?>/vente" style="width: 25%">
                    <div class="col">
                        <div class="mb-4">
                            <label for="" class="form-label">Etat Paiement</label>
                            <select class="form-select form-select-sm" name="etatPayement" id="">
                                <option value="0">Impayer</option>
                                <option value="1">Payer</option>
                            </select>
                        </div>
                    </div>
                    <div class="col" style="">
                        <div class="mt-2">
                            <label for="" class="form-label"></label>
                            <input name="" id="" class="btn btn-sm btn-primary" type="submit" value="Ok">
                        </div>
                    </div>
                </form>
                <form class="d-flex align-items-center" method="post" action="<?=BASE_URL?>/vente" style="width: 25%">
                    <div class="col">
                        <div class="mb-4">
                            <label for="" class="form-label">Client</label>
                            <select class="form-select form-select-sm" name="client" id="">
                                <option selected disabled value="">Choose...</option>
                                <?php foreach ($clients as  $value):?>
                                    <option value="<?=$value->getId()?>"> <?=$value->getNom()?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="col" style="">
                        <div class="mt-2">
                            <label for="" class="form-label"></label>
                            <input name="" id="" class="btn btn-sm btn-primary" type="submit" value="Ok">
                        </div>
                    </div>
                </form>
                <form class="d-flex align-items-center" method="post" action="<?=BASE_URL?>/vente" style="width: 25%">
                    <div class="col">
                        <div class="mb-3" style="border-radius: 15%">
                            <label for="birthday">Date de vente</label>
                            <input type="date" id="date" name="date">
                        </div>
                    </div>
                    <div class="col" style="">
                        <div class="mt-2">
                            <label for="" class="form-label"></label>
                            <input name="" id="" class="btn btn-sm btn-primary" type="submit" value="Ok">
                        </div>
                    </div>
                </form>
            </div>
            <div class="table table-bordered table-light mt-3">
                <table  class="table table-white table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Montant</th>
                           
                            <th scope="col">Etat Paiement</th>
                            <th scope="col">Client</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($ventes as $vente): ?>

                            <tr class="">
                                <td scope=" row"> <?=$vente->date?> </td>
                                <td><?=$vente->montant?></td>
                                <td><?=$vente->payer?"Payer":"Impayer"?></td>
                                <td><?=$vente->idClient?></td>
                                <td>
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