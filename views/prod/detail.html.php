<div class="d-flex flex-column w-100" style="background-color: #000">
    <div class="card w-100 mt-3">
        <div class="card-body d-flex justify-content-between" style="background-color: #E9F1FA">
            <div scope="col-4">Date : <span class='fs-5 fw-bold'><?= dateToFr($vente->date) ?></span></div>
        </div>
    </div>
    <div class="card w-90 mt-3" style="display: flex; flex-direction: column;background-color: #E9F1FA">
        <div class="card-body">
            <h5 class="card-title" style="margin-left: 10px;">Liste des Articles de vente</h5>
            <div class="container mt-3">
                <div class="table-responsive table-bordered table-light mt-1">
                    <table class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Article</th>
                                <th scope="col">Prix</th>
                                <th scope="col">Qte Vente</th>
                                <th scope="col">Montant</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($detailsVente as $detail) : ?>
                                <tr>
                                    <td><?= $detail->libelle ?></td>
                                    <td><?= $detail->prixAchat ?></td>
                                    <td><?= $detail->qteVente ?></td>
                                    <td><?= $detail->prixAchat * $detail->qteVente ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>

                <div class="row float-end mt-2">
                    <div class="fw-bold fs-4">Total : <span class="text-danger"><?= $vente->montant ?> CFA</span></div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <h5 class="card-title" style="margin-left: 10px;">Liste des Articles de Production</h5>
            <div class="container mt-3">
                <div class="table-responsive table-bordered table-light mt-1">
                    <table class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Article</th>
                                <th scope="col">Qte utilise</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($detailsconf as $detail) : ?>
                                <tr>
                                    <td><?= $detail->libelle ?></td>
                                    <td><?= $detail->qteConf ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
