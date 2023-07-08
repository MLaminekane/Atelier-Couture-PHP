<?php
use App\Core\Role;
use App\Core\Session;
?>

<div class="container justify-content-center rounded" style="height: 80vh; display:block; justify-content: center;border-radius: 8px; padding-top: 10px">
    <div class="card w-auto">
        <div class="card-body d-flex justify-content-between" style="margin-top: 10px;background-color: #E9F1FA">
            <div scope="col-4">
                Date : <span class='fs-5 fw-bold'><?=dateToFr($appro->date)?></span>
            </div>
            <div scope="col-4">
                Payement : <span class='text-danger fs-5 fw-bold'><?=$appro->payer ? 'Payer' : 'Impayer'?></span>
            </div>
        </div>
    </div>
    <button id="download-button" class="btn btn-primary mt-3">Télécharger Appro</button>
    <div class="table-responsive table-bordered mt-4">
        <table class="table table-bordered w-full text-black" style="background-color: #E9F1FA; border-radius: 8px; border: 2px solid">
            <thead>
                <tr>
                    <th scope="col">Article</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Qte Appro</th>
                    <th scope="col">Montant</th>
                    <th scope="col">Identifiant</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($detailsAppro as $detail): ?>
                <tr>
                    <td>
                        <?=$detail->libelle?>
                    </td>
                    <td><?=$detail->prixAchat?></td>
                    <td><?=$detail->qteAppro?></td>
                    <td><?=$detail->prixAchat * $detail->qteAppro?></td>
                    <td><div ></div><?=Session::get("userconnect")['nomComplet']."<br>".Session::get("userconnect")['role']?></div></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
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
