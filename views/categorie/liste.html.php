<?php
use App\Core\Session;
 if(Session::isset("errors")) {
      $errors=Session::get("errors");
      Session::unset("errors");  
 }
?>

<div class="container my-6 justify-content-center rounded mt-2" style=" height: 90vh;display:block; justify-content: center">
    <h3 class="text-center display-3 blue-100 lh-1 fw-bold" style="color: white">Liste Categories</h3>
    <div class="w-50 mx-auto mt-6 ">
        <form method="post" action="<?=BASE_URL?>/categorie/create">
            <label for="category" class="text-white">Categorie:</label>
            <div class="d-flex items-center">
                <input type="text" id="category" name="libelle" class="form-control bg-dark text-white" placeholder="Libelle" aria-label="Libelle">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
        <div class="text-danger" style="margin-left: 10px;">
            <?= $errors['libelle']??"" ?>
        </div>
    </div>
    <table class="table" style="color:#F7F7F7; margin: 5vh auto; width: 80%;">
        <thead>
            <tr class="text-center">
                <th>ID</th>
                <th>Libelle</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($categories as $cat): ?>
            <tr class="text-center">
                <td> <?=$cat->getId()?> </td>
                <td> <?=$cat->getLibelle()?> </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
