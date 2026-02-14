<?php require_once __DIR__ . "/../../controller/AuthController.php"; ?>
<?php require __DIR__ . "/header.php"; 
unset($_SESSION["flash"]);?>
<div class="container vh-100 d-flex justify-content-center align-items-center">
  <div class="card shadow p-4" style="width: 400px;">
    <h3 class="text-center mb-4">Registrazione</h3>
    
    <form action="registrazione" method="POST">
      <div class="mb-3">
        <label>Nome utente</label>
        <input type="text" name="username" class="form-control" placeholder="mario_rossi" required>
      </div>
      <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" placeholder="mario.rossi@mail.com" required>
      </div>
      <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" placeholder="****" required>
      </div>
      <div class="mb-3">
        <label>Conferma password</label>
        <input type="password" name="password_confirm" class="form-control" placeholder="****" required>
      </div>
      <button type="submit" class="btn btn-success w-100">Registrati</button>
    </form>

    <div class="text-center mt-3">
      <a href="accedi">Hai già un account? Accedi</a>
    </div>
  </div>
</div>
<?php require __DIR__ . "/footer.php" ?>

