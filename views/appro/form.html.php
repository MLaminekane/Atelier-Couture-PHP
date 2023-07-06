<?php
use App\Core\Session;
if(Session::isset("errors")) {
    $errors=Session::get("errors");
    Session::unset("errors");
}
if(Session::isset("sms")) {
    $sms=Session::get("sms");
    Session::unset("sms");
}
?>
<div class="d-flex justify-content-center" style="height: 90vh; display: block; justify-content: center">

<div class="card w-75 mt-3 d-flex" style="background-color: #6E6E6E">
    <div class="card-body" >
        <?php if(!empty($sms)):?>
            <div class="alert alert-info" role="alert">
                <?=$sms??""?>
            </div>
        <?php endif?>
    <h2 class="text-center display-3 blue-100 lh-1 fw-bold" style="color: white">Ajouter Approvisionnement</h2>
        <form class="my-3 mt-4" style="margin-left: 10px;" method="post" action="<?=BASE_URL?>/appro/add/detail">
            <div class="row w-100 d-flex " style="align-items: center";>
                <div class="col-6">
                    <div class="mb-2">
                        <label for="" class="form-label">Article</label>
                        <select class="form-select form-select-md" name="articleID" id="">
                            <?php foreach($articles as $article):?>
                                <option value="<?=$article->getId()?>"><?=$article->getLibelle()?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="mb-2 col-2">
                    <label for="" class="form-label">Quantite</label>
                    <input type="text" class="form-control" name="qteAppro" id="" aria-describedby="helpId"
                           placeholder="">
                </div>
                <div class="col-2 ml-2 ">
                    <label for="" class="form-label"></label>
                    <button type="submit" class="form-control btn btn-primary">Ajouter</button>
                </div>
            </div>
        </form>

        <div class="text-danger" style="margin-left: 10px;">
            <?= $errors['libelle']??"" ?>
        </div>
        <div class="container mt-3">
            <div class="table-responsive table-bordered table-light mt-1">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Article</th>
                            <th scope="col">Prix</th>
                            <th scope="col">Qte Appro</th>
                            <th scope="col">Montant</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $total=0;
                            if(Session::isset("detailsAppro")):
                                $detailsAppro=Session::get("detailsAppro");
                                $total=Session::get("total");
                                foreach($detailsAppro as $detail):?>
                                    <tr>
                                        <td> <?=$detail['article']?> </td>
                                        <td> <?=$detail['prix']?> </td>
                                        <td> <?=$detail['qteAppro']?> </td>
                                        <td> <?=$detail['montant']?></td>
                                    </tr>
                                <?php endforeach ?>
                            <?php endif ?>
                    </tbody>
                </table>
            </div>

            <form class="my-3 d-flex flex-column" style="margin-left: 10px;" method="post" action="<?=BASE_URL?>/appro/create">
                <div class="col-8 row ml-2  mb-2">
                    <div class="fw-bold fs-4">Total : <span class="text-danger"><?=$total?> CFA</span></div>
                </div>
                <div class="col-3 offset-md-9 float-end">
                    <button type="submit" name="save-appro" class="form-control btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
