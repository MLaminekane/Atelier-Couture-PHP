<?php
use App\Core\Session;
if (Session::isset("errors")) {
    $errors = Session::get("errors");
    Session::unset("errors");
}
if (Session::isset("sms")) {
    $sms = Session::get("sms");
    Session::unset("sms");
}
?>
<div class="card w-100 mt-3" style="display: flex; flex-direction: row;">
    <div class="card-body col-6">
        <?php if (!empty($sms)) : ?>
            <div class="alert alert-info" role="alert">
                <?= $sms ?? "" ?>
            </div>
        <?php endif ?>
        <h5 class="card-title" style="margin-left: 10px;">Liste des Articles à Produire</h5>
        <form class="my-3" style="margin-left: 10px;" method="post" action="<?= BASE_URL ?>/prod/add/detailVente">
            <div class="row w-100 d-flex">
                <div class="col-4">
                    <div class="mb-2">
                        <label for="" class="form-label">Article</label>
                        <select class="form-select form-select-md" name="articleID" id="">
                            <?php foreach ($articleVentes as $article) : ?>
                                <option value="<?= $article->getId() ?>"><?= $article->getLibelle() ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="mb-2 col-3">
                    <label for="" class="form-label">Qte Prod</label>
                    <input type="text" class="form-control" name="qteVente" id="" aria-describedby="helpId" placeholder="">
                </div>
                <div class="col-4 ml-2 mt-1">
                    <label for="" class="form-label"></label>
                    <button type="submit" class="form-control btn btn-primary">Ajouter</button>
                </div>
            </div>
        </form>
        <div class="container mt-3">
            <div class="table-responsive table-bordered table-light mt-1">
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Article</th>
                            <th scope="col">Prix</th>
                            <th scope="col">Qte Produit</th>
                            <th scope="col">Montant</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0;
                        if (Session::isset("detailsProdVente")) : ?>
                            <?php
                            $detailsProdVente = Session::get("detailsProdVente");
                            $total = Session::get("total");
                            foreach ($detailsProdVente as $detail) : ?>
                                <tr>
                                    <td> <?= $detail['article'] ?> </td>
                                    <td> <?= $detail['prix'] ?> </td>
                                    <td> <?= $detail['qteVente'] ?> </td>
                                    <td> <?= $detail['montant'] ?></td>
                                    <td>
                                        <a class="btn btn-danger btn-sm mr-2" href="#" role="button">-</a>
                                        <a class="btn btn-success btn-sm" href="#" role="button">+</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
            <form class="my-3 d-flex flex-column" style="margin-left: 10px;" method="post" action="">
                <div class="col-8 row ml-2  mb-2 ">
                    <div class="fw-bold fs-4">Total : <span class="text-danger "><?= $total ?> CFA</span></div>
                </div>
            </form>
        </div>
    </div>
    <div class="card-body col-6">
        <?php if (!empty($sms)) : ?>
            <div class="alert alert-info" role="alert">
                <?= $sms ?? "" ?>
            </div>
        <?php endif ?>
        <h5 class="card-title" style="margin-left: 10px;">Liste des Articles de confection</h5>
        <form class="my-3" style="margin-left: 10px;" method="post" action="<?= BASE_URL ?>/prod/add/detailConf">
            <div class="row w-100 d-flex">
                <div class="col-4">
                    <div class="mb-2">
                        <label for="" class="form-label">Article</label>
                        <select class="form-select form-select-md" name="articleID" id="">
                            <?php foreach ($articleConf as $article) : ?>
                                <option value="<?= $article->getId() ?>"><?= $article->getLibelle() ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="mb-2 col-3">
                    <label for="" class="form-label">Qte Prod</label>
                    <input type="text" class="form-control" name="qteConf" id="" aria-describedby="helpId" placeholder="">
                </div>
                <div class="col-4 ml-2 mt-1">
                    <label for="" class="form-label"></label>
                    <button type="submit" class="form-control btn btn-primary">Ajouter</button>
                </div>
            </div>
        </form>
        <div class="container mt-3">
            <div class="table-responsive table-bordered table-light mt-1">
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Article</th>
                            <th scope="col">Qte Utilise</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0;
                        if (Session::isset("detailsProdConf")) : ?>
                            <?php
                            $detailsProdConf = Session::get("detailsProdConf");
                            foreach ($detailsProdConf as $detail) : ?>
                                <tr>
                                    <td> <?= $detail['article'] ?> </td>
                                    <td> <?= $detail['qteConf'] ?> </td>
                                    <td>
                                        <a class="btn btn-danger btn-sm mr-2" href="#" role="button">-</a>
                                        <a class="btn btn-success btn-sm" href="#" role="button">+</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<form class="my-3 d-flex flex-column" style="margin-left: 10px;" method="post" action="<?= BASE_URL ?>/prod/create">
    <div class="col-3 offset-md-9 float-end">
        <button type="submit" name="save-Prod" class="form-control btn btn-primary">Enregistrer</button>
    </div>
</form>
