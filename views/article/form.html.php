<?php
use App\Core\Session;
if(Session::isset("errors")) {
$errors=Session::get("errors");
$data=Session::get("data");
Session::unset("errors");
Session::unset("data");
}
?>
<div class="card" style="diaplay-flex; justify-content: center ;width:40rem;margin-left: 25%">
    <div class="card-body text-black rounded" style="border: 2px solid white;background-color: #E9F1FA">
        <h3 class="display-3 fw-bold text-black" style="font-size: 25px; margin-top: 5vh">Enregistrement</h3>
        <form class="row g-3 needs-validation mt-1" method="Post" action="<?=BASE_URL?>/article/create">
            <div class="col-md-10">
                <label for="validationCustom01" class="form-label">Libelle</label>
                <input type="text" class="form-control <?= isset($errors['libelle'])? "is-invalid" :"is-valid" ?>"
                    id="validationCustom01" value="<?php if(isset($data['libelle']))  echo $data['libelle'];  ?> "
                    name="libelle">
                <div class=" valid-feedback <?= isset($errors['libelle'])? "invalid-feedback" :"" ?> ">
                    <?= $errors['libelle']??"" ?>
                </div>
            </div>
            <div class=" col-md-5">
                <label for="validationCustom02" class="form-label">Qte Stock</label>
                <input type="text" class="form-control  <?= isset($errors['qteStock'])? "is-invalid" :"is-valid" ?> "
                    id="validationCustom02" value="<?php if(isset($data['qteStock']))  echo $data['qteStock'];  ?>"
                    name="qteStock">
                <div class="valid-feedback  <?= isset($errors['qteStock'])? "invalid-feedback" :"" ?> ">
                    <?= $errors['qteStock']??"" ?>
                </div>
            </div>
            <div class="col-md-5">
                <label for="validationCustom02" class="form-label">Prix Achat</label>
                <input type="text" class="form-control" id="validationCustom02" value="" name="prixAchat">
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>

            <div class="col-md-5">
                <label for="validationCustom04" class="form-label">Categorie</label>
                <select class="form-select" id="validationCustom04" name="categorie">
                    <option selected disabled value="">Choose...</option>
                    <?php foreach ($categories as  $value):?>
                    <option value="<?=$value->getId()?>"> <?=$value->getLibelle()?></option>
                    <?php endforeach ?>

                </select>
                <div class="invalid-feedback">
                    <?= $errors['categorie']??"" ?>
                </div>
            </div>
            <div class="col-md-5">
                <label for="validationCustom04" class="form-label">Type</label>
                <select class="form-select" id="select-type" name="type">
                    <?php foreach ($types as  $value):?>
                    <option value="<?=$value->getType()?>"><?=$value->getType()?></option>
                    <?php endforeach ?>
                </select>
                <div class=" invalid-feedback">
                    Please select a valid state.
                </div>
            </div>
            <div class="col-md-10" id="div-fournisseur">
                <label for="validationCustom02" class="form-label">Fournisseur</label>
                <input type="text" class="form-control" id="validationCustom02" value="" name="fournisseur">
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
            <div class="col-md-10 d-none" id="div-date">
                <label for=" validationCustom02" class="form-label">Date Production</label>
                <input type="date" class="form-control" id="validationCustom02" value="" name="dateProduction">
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>

            <div class="col-12">
                <button class="btn btn-primary float-end" type="submit">Enregistrer</button>
            </div>

        </form>

    </div>
</div>

<script>

const divDate = document.querySelector("#div-date")
const selectType = document.querySelector("#select-type")
const divFour = document.querySelector("#div-fournisseur")
selectType.addEventListener("change", function() {
    divFour.classList.toggle("d-none");
    divDate.classList.toggle("d-none")
})
</script>