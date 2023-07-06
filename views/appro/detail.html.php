<div class="d-flex flex-column w-auto " style="margin-left: 20%">
    <div class="card w-75 mt-3 ">
        <div class="card-body d-flex justify-content-between">
            <div scope="col-4">Date : <span class='fs-5 fw-bold'>
                    <?=dateToFr($appro->date)?></span> </div>
            <div scope="col-4">Payement : <span class=' text-danger fs-5 fw-bold'><?=$appro->payer?'Payer':"Impayer"?></span></div>
        </div>
    </div>
    <div class=" card w-75 mt-3 " style="background-color: #6E6E6E">
        <div class=" card-body ">
            <h5 class=" card-title " style=" margin-left: 10px;">Liste Article a Approvisionner</h4>
                <div class="container mt-3">
                    <div class="table-responsive table-bordered table-light mt-1">
                        <table  class="table table-dark table-striped">
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
                                  foreach($detailsAppro as $detail):?>
                                <tr>
                                    <td> <?=$detail->libelle?> </td>
                                    <td> <?=$detail->prixAchat?> </td>
                                    <td> <?=$detail->qteAppro?> </td>
                                    <td> <?=$detail->prixAchat*$detail->qteAppro?></td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="  row float-end mt-2 ">
                        <div class="fw-bold fs-4 ">Total : <span class="text-danger ">
                                <?=$appro->montant?> CFA
                            </span>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>