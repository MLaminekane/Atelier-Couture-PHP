<?php
use App\Core\Role;
use App\Core\Session;
?>

<div class="d-flex flex-column" style="width: 80%;margin-left: 10%;">
    <div class="card mt-3 ">
        <div class="card-body d-flex justify-content-between">
            <div scope="col-4">Date : <span class='fs-5 fw-bold'>
                    <?=dateToFr($vente->date)?></span> </div>
            <div scope="col-4">Payement : <span class=' text-danger fs-5 fw-bold'>
                    <?=$vente->payer?'Payer':"Impayer"?></span></div>
        </div>
    </div>
    <button id="download-button" class="btn btn-primary mt-3">Télécharger Vente</button>
    <div class=" card mt-3 " style="background-color: #6E6E6E">
        <div class=" card-body ">
            <h5 class=" card-title " style=" margin-left: 10px;">Liste des Articles a vendre</h4>
                <div class="container mt-3">
                    <div class="table-responsive table-bordered table-light mt-1">
                        <table  class="table" style="width: 93%" >
                            <thead>
                                <tr>
                                    <th scope="col">Article</th>
                                    <th scope="col">Prix</th>
                                    <th scope="col">Qte Vente</th>
                                    <th scope="col">Montant</th>
                               
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                   
                                  foreach($detailsVente as $detail):?>
                                  
                                <tr>
                                    
                                    <td> <?=$detail->libelle?> </td>
                                    <td> <?=$detail->prixAchat?> </td>
                                    <td> <?=$detail->qteVente?> </td>
                                    <td> <?=$detail->prixAchat*$detail->qteVente?></td>
                                   
                                </tr>
                                
                                <?php    endforeach ?>

                            </tbody>
                        </table>
                    </div>

                    <div class="row mt-2 ">
                        <div class="fw-bold fs-4 ">Total : <span class="text-danger ">
                                <?=$vente->montant?> CFA
                            </span>
                        </div>

                    </div>

                </div>
        </div>
    </div>
</div>

<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script>
    const downloadButton = document.getElementById('download-button');
    downloadButton.addEventListener('click', () => {
      html2canvas(document.body).then(canvas => {
        const imageData = canvas.toDataURL('image/png');
        const link = document.createElement('a');
        link.href = imageData;
        link.download = 'capture.png';
        link.click();
      });
    });
</script>
