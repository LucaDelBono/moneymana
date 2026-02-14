<?php require __DIR__ . "/header.php"; ?>
<div class="container vh-100 d-flex justify-content-center align-items-center">
  <div class="card shadow p-4" style="width: 400px;">
    <h3 class="text-center mb-4">Login</h3>
    
    <form action="/accedi" method="POST">
      <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" placeholder="mario.rossi@gmail.com" required>
      </div>
      <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" placeholder="****" required>
      </div>
      <button type="submit" class="btn btn-primary w-100">Accedi</button>
    </form>

    <div class="text-center mt-3">
      <a href="registrazione">Non hai un account? Registrati</a>
    </div>
  </div>
</div>
<?php require __DIR__ . "/footer.php" ?>

