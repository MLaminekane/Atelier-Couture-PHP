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
<div class=" card mt-3 d-flex" style="margin-left: 5%; margin-right: 5%" >
    <div class=" card-body" style="background-color: #6E6E6E;">
        <div class="d-flex align-items-center ">
        <?php if(!empty($sms)):?>
        <div class="alert alert-info" role="alert">
            <?=$sms??""?>
        </div>
        <?php endif?>
        <form style="display: flex; margin-left: 3vw;" method="post" action="<?=BASE_URL?>/vente/add/client">
            <div class="row" style="display: flex; justify-content: space-evenly; justify-content: center">
                <div class="col-4">
                <label for="" class="form-label">Client</label>
                <select class="form-select form-select-sm d-flex align-items-center" name="client" id="">
                    <option selected disabled value="">Choisir...</option>
                    <?php foreach ($clients as $value):?>
                        <option value="<?=$value->getId()?>"> <?=$value->getNom()?></option>
                    <?php endforeach ?>
                </select>
                </div>
                <div class="col-4">
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
                    <label for="" class="form-label">Qte Appro</label>
                    <input type="text" class="form-control" name="qteVente" id="" aria-describedby="helpId"
                        placeholder="">
                </div>
                
                <div class="col-2 ml-2 mt-1">
                    <label for="" class="form-label"></label>
                    <button type="submit" class="form-control btn btn-primary">Ajouter</button>
                </div>
            </div>
        </form>  
        </div>
            <div class="container mt-3">
                <div class="table-responsive table-bordered" style="width: 100%">
                    <table  class="table">
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
                                <td>
                                    <a class="btn btn-danger btn-sm mr-2" href="#" role="button">-</a>
                                    <a class="btn btn-success btn-sm " href="#" role="button">+</a>
                                </td>
                            </tr>
                            <?php endforeach ?>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
                <form class="my-3 d-flex flex-column "method="post" action="<?=BASE_URL?>/vente/create">
                    <div class="">
                        <div class="fw-bold fs-4">Total : <span class="text-danger ">
                                <?=$total?> CFA
                            </span>
                        </div>
                        <button type="submit"5vh" name="save-vente" class="form-control btn btn-primary ">Enregister</button>

                    </div>

                </form>
            </div>
    </div>
</div>
