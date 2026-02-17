<?php require_once __DIR__ . "/../../controller/AuthController.php"; ?>
<?php require __DIR__ . "/header.php"; 
unset($_SESSION["flash"]);?>
<div class="container vh-100 d-flex justify-content-center align-items-center">
  <div class="card shadow p-4" style="width: 400px;">
    <h3 class="text-center mb-4">Registrazione</h3>
    
    <form action="registrazione" method="POST">
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
        <input type="password" name="password" id="password" class="form-control" placeholder="****" required>
      </div>
      <div class="mb-3">
        <label>Conferma password</label>
        <input type="password" name="password_confirm" id="password_confirm" class="form-control mb-1" placeholder="****" required>
        <span id="password_error" class="text-danger"></span>
      </div>
      <button type="submit" id="submit_button" class="btn btn-success w-100">Registrati</button>
    </form>

    <div class="text-center mt-3">
      <a href="accedi">Hai già un account? Accedi</a>
    </div>
  </div>
</div>
<script>   
  let emailTimeout;
  let usernameTimeout;

  document.getElementById("email").addEventListener("keyup", function() {
    clearTimeout(emailTimeout);

    emailTimeout = setTimeout(() => {
      const email = document.getElementById("email").value;

      if (email !== "") {
        let formData = new FormData();
        formData.append("email", email);

        fetch('checkExistEmail', {
          method: 'POST',
          body: formData
        })
        .then(response => response.json())
        .then(response => {
          if (response == true) {
            document.getElementById("email_error").innerText = "Email già presente nel sistema!";
            document.getElementById("submit_button").disabled = true;
          } else {
            document.getElementById("email_error").innerText = "";
            document.getElementById("submit_button").disabled = false;
          }
        });
      }else{
        document.getElementById("email_error").innerText = "";
        document.getElementById("submit_button").disabled = false;
      }
    }, 350);
  });


  document.getElementById("username").addEventListener("keyup", function() {
    clearTimeout(usernameTimeout);

    usernameTimeout = setTimeout(() => {
      const username = document.getElementById("username").value;

      if (username !== "") {
        let formData = new FormData();
        formData.append("username", username);

        fetch('checkExistUsername', {
          method: 'POST',
          body: formData
        })
        .then(response => response.json())
        .then(response => {
          if (response == true) {
            document.getElementById("username_error").innerText = "Username già presente nel sistema!";
            document.getElementById("submit_button").disabled = true;
          } else {
            document.getElementById("username_error").innerText = "";
            document.getElementById("submit_button").disabled = false;
          }
        });
      }else{
        document.getElementById("username_error").innerText = "";
        document.getElementById("submit_button").disabled = false;
      }
    }, 350);
  });
</script>
<?php require __DIR__ . "/footer.php" ?>

