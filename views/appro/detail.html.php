<div class="d-flex flex-column w-auto" style="margin-left: 20%">
    <!-- ... Autres éléments de la vue ... -->

    <!-- Afficher les détails de la vente -->
    <div class="card w-75 mt-3">
        <div class="card-body">
            <h5 class="card-title">Détails de la vente</h5>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Article</th>
                            <th scope="col">Quantité</th>
                            <th scope="col">Prix</th>
                            <!-- Ajoutez d'autres colonnes si nécessaire -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($detailsVente as $detail) : ?>
                            <tr>
                                <td><?= $detail['article'] ?></td>
                                <td><?= $detail['qteVente'] ?></td>
                                <td><?= $detail['prix'] ?></td>
                                <!-- Ajoutez d'autres colonnes si nécessaire -->
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Afficher les détails de la confection -->
    <div class="card w-75 mt-3">
        <div class="card-body">
            <h5 class="card-title">Détails de la confection</h5>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Article</th>
                            <th scope="col">Quantité</th>
                            <!-- Ajoutez d'autres colonnes si nécessaire -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($detailsConf as $detail) : ?>
                            <tr>
                                <td><?= $detail['article'] ?></td>
                                <td><?= $detail['qteConf'] ?></td>
                                <!-- Ajoutez d'autres colonnes si nécessaire -->
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
