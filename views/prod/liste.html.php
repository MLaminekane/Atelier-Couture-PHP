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
    <div class="card" style="background-color: #6E6E6E">
         <?php if(!empty($sms)):?>
            <div class="alert alert-info" role="alert" style="background-color: white-red;">
                <?=$sms??""?>
            </div>
        <?php endif?>
        <div class="card-body" style="background-color: #E9F1FA">
            <div class="row float-end ">
                <div class="col-4  ">
                    <a name="" id="" class="btn btn-primary  text-white  " href="<?=BASE_URL?>/prod/create"
                        role="button">Nouveau</a>
                </div>

            </div>
            <h4 class="card-title">Liste des Production</h4>
            
           
            <form class="d-flex" method="post" action="<?=BASE_URL?>/prod">
                <div class="col">
                        <label for="birthday">Date de Production</label>
                        <input type="date" id="date" name="date">
                        <input name="" id="" class="btn btn-sm btn-primary" type="submit" value="Ok">
                </div>

            </form>
            <div class="table table-bordered table-light mt-3">
                <table  class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Montant</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($prods as $prod): ?>

                            <tr class="">
                                <td scope=" row"> <?=$prod->date?> </td>
                                <td><?=$prod->montant?></td>
                                <td class="d-flex">
                                    
                                    <form method="post" action="<?=BASE_URL?>/prod/detail" style="margin-left:5px;">
                                        <input type="hidden" name="id-prod" value="<?=$prod->id?>">
                                        <button name="" id="" class=" btn btn-primary text-white mr-1 "
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

