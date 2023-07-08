<?php
use App\Core\Role;
use App\Core\Session;

if(!Role::hasRole("Admin") ) redirect("categorie");

if(Session::isset("errors")) {
    $errors=Session::get("errors")->firstOfAll();
    $data=Session::get("data");
    Session::unset("errors");  
    Session::unset("data"); 
}
?>
<div class="card" style="width:40rem; margin-left: 25%;background-color: #E9F1FA ">
    <div class="card-body" style="background-color: #E9F1FA">
        <h5 class="card-title">Ajouter un Client</h5>
        <form class="row g-3 needs-validation mt-1" method="Post" action="<?=BASE_URL?>/client/create">
            <div class="col-md-10">
                <label for="validationCustom01" class="form-label">Nom</label>
                <input type="text" class="form-control <?= isset($errors['nom'])? "is-invalid" :"is-valid" ?>"
                    id="validationCustom01" value="<?php if(isset($data['nom']))  echo $data['nom'];  ?> "
                    name="nom">
                <div class=" valid-feedback <?= isset($errors['nom'])? "invalid-feedback" :"" ?> ">
                    <?= $errors['nom']??"" ?>
                </div>
            </div>
            <div class="col-md-10">
                <label for="validationCustom01" class="form-label">Prenom</label>
                <input type="text" class="form-control <?= isset($errors['prenom'])? "is-invalid" :"is-valid" ?>"
                    id="validationCustom01" value="<?php if(isset($data['prenom']))  echo $data['prenom'];  ?> "
                    name="prenom">
                <div class=" valid-feedback <?= isset($errors['prenom'])? "invalid-feedback" :"" ?> ">
                    <?= $errors['prenom']??"" ?>
                </div>
            </div>
            <div class="col-md-6">
                <label for="validationCustom01" class="form-label">Telephone</label>
                <input type="text" class="form-control <?= isset($errors['telephone'])? "is-invalid" :"is-valid" ?>"
                    id="validationCustom01" value="<?php if(isset($data['telephone']))  echo $data['telephone'];  ?> "
                    name="telephone">
                <div class=" valid-feedback <?= isset($errors['telephone'])? "invalid-feedback" :"" ?> ">
                    <?= $errors['telephone']??"" ?>
                </div>
            </div>
            
            <div class=" col-md-5">
                <label for="validationCustom02" class="form-label">Adresse</label>
                <input type="text" class="form-control  <?= isset($errors['adresse'])? "is-invalid" :"is-valid" ?> "
                    id="validationCustom02" value="<?php if(isset($data['adresse']))  echo $data['adresse'];  ?>"
                    name="adresse">
                <div class="valid-feedback  <?= isset($errors['adresse'])? "invalid-feedback" :"" ?> ">
                    <?= $errors['adresse']??"" ?>
                </div>
            </div>
           
            <div class="col-md-5 ">
                <label for="validationCustom04" class="form-label">Etat</label>
                <select class="form-select <?= isset($errors['etat'])? "is-invalid" :"is-valid" ?>" id="validationCustom04" name="etat">
                    <option selected disabled value="">Choose...</option>
                    <option value="1">ACTIF</option>
                    <option value="2">NON ACTIF</option>
                </select>
                <div class="invalid-feedback --bs-danger <?= isset($errors['etat'])? "invalid-feedback" :"" ?>">
                    <?= $errors['etat']??"" ?>
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