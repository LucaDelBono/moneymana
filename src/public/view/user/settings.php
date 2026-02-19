<?php 
require_once __DIR__ . "/../../../Bootstrap.php";
$authController = new AuthController;
$authController->checkIfUserIsNotLogged();
$user = $authController->getAuthUser();
?>
<?php require_once __DIR__ . "/../partials/header.php"; ?>
<?php require_once __DIR__ . "/../partials/sidebar.php"; ?>
<?php 
echo flashMessage();
$authController->getDeleteModal(); 
?>

<div class="content">
  <h2>Impostazioni Account</h2>

  <div class="row mt-4">

    <div class="col-md-6 mb-4">
      <div class="card shadow p-3">
        <h5>Profilo</h5>
        <form action="/user/update" method="POST">
          <div class="mb-3">
            <label>Nome utente</label>
            <input type="text" name="username" class="form-control" placeholder="mario_rossi" value="<?php echo htmlspecialchars($user->getUsername()); ?>">
          </div>
          <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" placeholder="mario.rossi@email.com" value="<?php echo htmlspecialchars($user->getEmail()); ?>">
          </div>
          <button type="submit" class="btn btn-primary w-100">Salva Modifiche</button>
        </form>
      </div>
    </div>

    <div class="col-md-6 mb-4">
      <div class="card shadow p-3 border-danger">
        <h5 class="text-danger">Zona Pericolosa</h5>
        <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#deleteAuthUserModal">
          Elimina Account
        </button>
      </div>
    </div>

    <div class="col-md-6 mb-4">
      <div class="card shadow p-3">
        <h5>Cambia Password</h5>
        <form id="changePasswordForm" action="/user/update_password" method="POST">
          <div class="mb-3">
            <label>Vecchia Password</label>
            <input type="password" name="old_password" id="old_password" class="form-control" placeholder="****" required>
          </div>
          <div class="mb-3">
            <label>Nuova Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="****" required>
          </div>
          <div class="mb-3">
            <label>Conferma Password</label>
            <input type="password" name="password_confirm" id="password_confirm" class="form-control mb-1" placeholder="****" required>
            <span id="password_error" class="text-danger"></span>
          </div>
          <button type="submit" id="submit_btn" class="btn btn-warning w-100">Aggiorna Password</button>
        </form>
      </div>
    </div>

  </div>
</div>

<?php require_once __DIR__ . "/../partials/footer.php"; ?>

