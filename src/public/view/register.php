<?php session_start(); ?>
<?php require __DIR__ . "/header.php";
echo flashMessage();
?>
<div class="container vh-100 d-flex justify-content-center align-items-center">
  <div class="card shadow p-4" style="width: 400px;">
    <h3 class="text-center mb-4">Registrazione</h3>
    
    <form id="registerForm" action="registrazione" method="POST">
      <div class="mb-3">
        <label>Nome utente</label>
        <input type="text" name="username" id="username" class="form-control mb-1" placeholder="mario_rossi" required>
        <span id="username_error" class="text-danger"></span>
      </div>
      <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" id="email" class="form-control mb-1" placeholder="mario.rossi@mail.com" required>
        <span id="email_error" class="text-danger"></span>
      </div>
      <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="********" required>
      </div>
      <div class="mb-3">
        <label>Conferma password</label>
        <input type="password" name="password_confirm" id="password_confirm" class="form-control mb-1" placeholder="********" required>
        <span id="password_error" class="text-danger"></span>
      </div>
      <button type="submit" id="submit_btn" class="btn btn-success w-100">Registrati</button>
    </form>

    <div class="text-center mt-3">
      <a href="accedi">Hai già un account? Accedi</a>
    </div>
  </div>
</div>
<?php require __DIR__ . "/footer.php" ?>

