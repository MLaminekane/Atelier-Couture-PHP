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
<div class=" card w-75 mt-3 d-flex" style="margin-left: 12.5%">
    <div class=" card-body" style="background-color: #6E6E6E">
        <?php if(!empty($sms)):?>
        <div class="alert alert-info" role="alert">
            <?=$sms??""?>
        </div>
        <?php endif?>
        <div class="d-flex">
            <form class="my-3 d-flex" style="margin-left: 10px;" method="post" action="<?=BASE_URL?>/vente/add/client">
                <div class="mb-3">
                    <label for="" class="form-label">Client</label>
                    <select class="form-select form-select-sm" name="client" id="">
                        <option selected disabled value="">Choose...</option>
                        <?php foreach ($clients as  $value):?>
                            <option value="<?=$value->getId()?>"> <?=$value->getNom()?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </form>
            <form class=" my-3" style="margin-left: 10px;" method="post" action="<?=BASE_URL?>/vente/add/detail">
            <div class="row d-flex" >
                    <div class="mb-3 col-3">
                        <label for="" class="form-label">Article</label>
                        <select class="form-select form-select-md" name="articleID" id="">
                            <?php foreach($articles as $article):?>
                            <option value="<?=$article->getId()?>"><?=$article->getLibelle()?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                <div class="mb-3 col-2">
                    <label for="" class="form-label">Qte Appro</label>
                    <input type="text" class="form-control" name="qteVente" id="" aria-describedby="helpId"
                        placeholder="">

                </div>
                
                <div class="col-2 ml-2 mt-1">
                    <label for="" class="form-label"></label>
                    <button type="submit" class="form-control btn btn-primary mt-1">OK</button>
                </div>
            </div>
        </form>
        </div>


       
        <h5 class=" card-title " style=" margin-left: 10px;">Liste des Articles a Vendre
        </h5>
            <div class="container mt-3">
                <div class="table-responsive table-bordered" >
                    <table  class="table" style="width: 87%">
                        <thead>
                            <tr>
                                <th scope="col">Article</th>
                                <th scope="col">Prix</th>
                                <th scope="col">Qte vente</th>
                                <th scope="col">Montant</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $total=0;
                             if(Session::isset("detailsVente")):?>

                            <?php
                                   $detailsVente=Session::get("detailsVente");
                                   $total=Session::get("total");
                                  foreach($detailsVente as $detail):?>
                            <tr>
                                <td> <?=$detail['article']?> </td>
                                <td> <?=$detail['prix']?> </td>
                                <td> <?=$detail['qteVente']?> </td>
                                <td> <?=$detail['montant']?></td>
                            </tr>
                            <?php endforeach ?>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
                <form class="my-3 " method="post" action="<?=BASE_URL?>/vente/create">
                    <div class=" ">
                        <div class="fw-bold fs-4">Total : <span class="text-danger "><?=$total?> CFA </span> </div>
                        <button type="submit" style="width: 10vw; margin-left: 50vw: position: fixed" name="save-vente" class="form-control btn btn-primary">Enregister</button>
                    </div>
                </form>
            </div>
    </div>
</div>