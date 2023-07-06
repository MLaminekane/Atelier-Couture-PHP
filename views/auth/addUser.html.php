<?php
use App\Core\Role;
use App\Core\Session;

if(!Role::hasRole("Admin") ) redirect("categorie");

if(Session::isset("errors")) {
    $errors=Session::get("errors")->firstOfAll();
    //Recuperer les donnees du Formulaire
    $data=Session::get("data");
    Session::unset("errors");  
    Session::unset("data"); 
}
?><div class="card mt-5" style="width:40rem;  margin-left: 20%">
    <div class="card-body">
        <h5 class="card-title">Ajouter un Uitlisateur</h5>
        <form class="row g-3 needs-validation mt-1" method="Post" action="<?=BASE_URL?>/user/create">
            <div class="col-md-10">
                <label for="validationCustom01" class="form-label">Nom Complet</label>
                <input type="text" class="form-control <?= isset($errors['nomComplet'])? "is-invalid" :"is-valid" ?>"
                    id="validationCustom01" value="<?php if(isset($data['nomComplet']))  echo $data['nomComplet'];  ?> "
                    name="nomComplet">
                <div class=" valid-feedback <?= isset($errors['nomComplet'])? "invalid-feedback" :"" ?> ">
                    <?= $errors['nomComplet']??"" ?>
                </div>
            </div>
            <div class=" col-md-5">
                <label for="validationCustom02" class="form-label">Login</label>
                <input type="text" class="form-control  <?= isset($errors['login'])? "is-invalid" :"is-valid" ?> "
                    id="validationCustom02" value="<?php if(isset($data['login']))  echo $data['login'];  ?>"
                    name="login">
                <div class="valid-feedback  <?= isset($errors['login'])? "invalid-feedback" :"" ?> ">
                    <?= $errors['login']??"" ?>
                </div>
            </div>
            <div class="col-md-5">
                <label for="validationCustom03" class="form-label">Password</label>
                <input type="text" class="form-control <?= isset($errors['password'])? "is-invalid" :"is-valid" ?>" 
                 id="validationCustom03" value="<?php if(isset($data['password']))  echo $data['password'];  ?>" name="password">
                <div class="valid-feedback <?= isset($errors['password'])? "invalid-feedback" :"" ?>">
                    <?= $errors['password']??"" ?>
                </div>
            </div>

            <div class="col-md-5">
                <label for="validationCustom04" class="form-label">Role</label>
                <select class="form-select <?= isset($errors['role'])? "is-invalid" :"is-valid" ?>" id="validationCustom04" name="role">
                    <option selected disabled value="">Choose...</option>
                    <option value="Admin ">ADMIN</option>
                    <option value="Rs">RS</option>
                    <option value="Rp">RP</option>
                    <option value="Vendeur">VENDEUR</option>

                </select>
                <div class="invalid-feedback --bs-danger <?= isset($errors['role'])? "invalid-feedback" :"" ?>">
                    <?= $errors['role']??"" ?>
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
//select-type
//div-date
//div-fournisseur

const divDate = document.querySelector("#div-date")
const selectType = document.querySelector("#select-type")
const divFour = document.querySelector("#div-fournisseur")
selectType.addEventListener("change", function() {
    divFour.classList.toggle("d-none");
    divDate.classList.toggle("d-none")
})
</script>