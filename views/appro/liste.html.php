<?php
use App\Core\Role;
if (!Role::hasRole("Admin")) {
    redirect("categorie");
}
?>

<div class="container my-6 justify-content-center rounded mt-2" style=" height: 90vh; display: block; justify-content: center">
    <h1 class="text-center display-3 blue-100 lh-1 fw-bold" style="color: white">Liste Approvisionnements</h1>
    <div class="row mt-6 mx-auto w-50" >
        <div class="col" >
            <form method="post" action="<?= BASE_URL ?>/appro">
                <label for="etatPayement" class="text-white">Etat Paiement:</label>
                <div class="d-flex align-items-center">
                    <select class="form-select form-select-sm bg-dark text-white" name="etatPayement" id="etatPayement" style="width: 50vw">
                        <option value="0">Impayé</option>
                        <option value="1">Payé</option>
                    </select>
                    <button type="submit" class="btn btn-primary ml-2">Ok</button>
                </div>

            </form>
        </div>
        <div class="col">
            <?php if (!empty($errors['libelle'])): ?>
                <div class="text-danger">
                    <?= $errors['libelle'] ?>
                </div>
            <?php endif ?>
        </div>
    </div>
    <div class="table-responsive mt-3 mx-auto" style="width: 80%;" >
        <div class="">
            <a name="" id="" class="btn btn-primary text-black" href="<?=BASE_URL?>/appro/create"role="button">Nouveau</a>
        </div>
        <table class="table table-bordered text-black" style="background-color: #E9F1FA">
            <thead>
                <tr class="text-center">
                    <th>Date</th>
                    <th>Montant</th>
                    <th>Etat Paiement</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($appros as $appro): ?>
                    <tr class="text-center">
                        <td><?= $appro->date ?></td>
                        <td><?= $appro->montant ?></td>
                        <td><?= $appro->payer ? "Payé" : "Impayé" ?></td>
                        <td class="d-flex justify-content-center">
                            <?php if (!$appro->payer): ?>
                                <a class="btn btn-sm btn-danger text-white" href="<?= BASE_URL ?>/appro/payement?id-appro=<?= $appro->id ?>" role="button">Valider Paiement</a>
                            <?php endif ?>
                            <form method="post" action="<?= BASE_URL ?>/appro/detail">
                                <input type="hidden" name="id-appro" value="<?= $appro->id ?>">
                                <button class="btn btn-sm btn-info text-white mr-1" type="submit">Voir Détails</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

