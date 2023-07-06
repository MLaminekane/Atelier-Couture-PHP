<?php
use App\Core\Session;

$errors = [];
$data = [];

if (Session::isset("errors")) {
    $errors = Session::get("errors")->firstOfAll();
    $data = Session::get("data");
    Session::unset("errors");
    Session::unset("data");
}
?>
<section class="h-screen">
  <div class="container-fluid h-custom">
    <div class="flex justify-center items-center h-full mt-4">
      <div class="md:w-9/12 lg:w-6/12 xl:w-5/12">
        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp" class="" style="height: 30vh" alt="Sample image">
      </div>
      <div class="md:w-8/12 lg:w-6/12 xl:w-7/12 xl:pl-8">
        <form action="<?= BASE_URL ?>/login" method="POST">
          <!-- Email input -->
          <div class="mb-4">
            <input type="text" id="form3Example3" class="form-control form-control-lg" placeholder="Enter a valid email address" id="exampleInputEmail1" name="login" aria-describedby="emailHelp" value="<?= $data['login'] ?? '' ?>" />
            <label class="form-label" for="exampleInputEmail1">Email</label>
            <div id="emailHelp" class="text-danger"><?= $errors['login'] ?? "" ?></div>
          </div>
          <!-- Password input -->
          <div class="mb-3">
            <input type="password" id="exampleInputPassword1" class="form-control form-control-lg" placeholder="Enter password" name="password" />
            <label class="form-label" for="exampleInputPassword1">Password</label>
          </div>
          <div class="flex justify-between items-center">
            <!-- Checkbox -->
            <div class="mb-0">
              <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
              <label class="form-check-label" for="form2Example3">
                Se souvenir de moi 
              </label>
            </div>
          </div>
          <div id="emailHelp" class="text-danger mb-2"><?= $errors['password'] ?? "" ?></div>

          <div class="text-center lg:text-left mt-4 pt-2">
            <button type="submit" class="btn btn-primary btn-lg px-10" name="submit">Se connecter</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</section>
