<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Spese - Gestione Spese</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a href="storico.html" class="navbar-brand">← Storico</a>
  </div>
</nav>

<div class="container mt-5">
  <h2 id="titolo"></h2>

  <div class="row mt-4" id="mesiContainer"></div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
const urlParams = new URLSearchParams(window.location.search);
const anno = urlParams.get('anno');

$("#titolo").text("Spese anno " + anno);

const mesi = [
  "Gennaio","Febbraio","Marzo","Aprile","Maggio","Giugno",
  "Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre"
];

mesi.forEach(function(mese){
  $("#mesiContainer").append(`
    <div class="col-md-3 mb-3">
      <div class="card shadow">
        <div class="card-body text-center">
          <h6>${mese}</h6>
          <button class="btn btn-outline-primary btn-sm">
            Visualizza Spese
          </button>
        </div>
      </div>
    </div>
  `);
});
</script>

</body>
</html>
