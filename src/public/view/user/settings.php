<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Impostazioni - Gestione Spese</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body.dark-mode {
      background-color: #121212;
      color: white;
    }
    .dark-mode .card {
      background-color: #1e1e1e;
      color: white;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a href="home.html" class="navbar-brand">← Home</a>
  </div>
</nav>

<div class="container mt-5">
  <h2>Impostazioni Account</h2>

  <div class="row mt-4">

    <!-- Profilo -->
    <div class="col-md-6 mb-4">
      <div class="card shadow p-3">
        <h5>Profilo</h5>
        <form id="profileForm">
          <div class="mb-3">
            <label>Nome</label>
            <input type="text" class="form-control" value="Mario Rossi">
          </div>
          <div class="mb-3">
            <label>Email</label>
            <input type="email" class="form-control" value="mario@email.it">
          </div>
          <button class="btn btn-primary w-100">Salva Modifiche</button>
        </form>
      </div>
    </div>

    <!-- Cambio Password -->
    <div class="col-md-6 mb-4">
      <div class="card shadow p-3">
        <h5>Cambia Password</h5>
        <form id="passwordForm">
          <div class="mb-3">
            <label>Nuova Password</label>
            <input type="password" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Conferma Password</label>
            <input type="password" class="form-control" required>
          </div>
          <button class="btn btn-warning w-100">Aggiorna Password</button>
        </form>
      </div>
    </div>

    <!-- Preferenze -->
    <div class="col-md-6 mb-4">
      <div class="card shadow p-3">
        <h5>Preferenze</h5>
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" id="darkModeSwitch">
          <label class="form-check-label">Modalità Scura</label>
        </div>
      </div>
    </div>

    <!-- Eliminazione Account -->
    <div class="col-md-6 mb-4">
      <div class="card shadow p-3 border-danger">
        <h5 class="text-danger">Zona Pericolosa</h5>
        <button class="btn btn-danger w-100" id="deleteAccount">
          Elimina Account
        </button>
      </div>
    </div>

  </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>

// Salva profilo
$("#profileForm").submit(function(e){
  e.preventDefault();
  alert("Profilo aggiornato!");
});

// Cambio password
$("#passwordForm").submit(function(e){
  e.preventDefault();
  alert("Password aggiornata!");
});

// Dark mode
if(localStorage.getItem("darkMode") === "enabled"){
  $("body").addClass("dark-mode");
  $("#darkModeSwitch").prop("checked", true);
}

$("#darkModeSwitch").change(function(){
  if($(this).is(":checked")){
    $("body").addClass("dark-mode");
    localStorage.setItem("darkMode","enabled");
  } else {
    $("body").removeClass("dark-mode");
    localStorage.setItem("darkMode","disabled");
  }
});

// Eliminazione account
$("#deleteAccount").click(function(){
  if(confirm("Sei sicuro di voler eliminare l'account?")){
    alert("Account eliminato!");
    window.location.href = "index.html";
  }
});

</script>

</body>
</html>
