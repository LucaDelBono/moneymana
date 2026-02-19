<?php 
require_once __DIR__ . "/../../../Bootstrap.php";
$authController = new AuthController;
$authController->checkIfUserIsNotLogged();
$user = $authController->getAuthUser();
?>
<?php require_once __DIR__ . "/../partials/header.php"; ?>
<?php require_once __DIR__ . "/../partials/sidebar.php"; ?>
<?php echo flashMessage(); ?>
<!-- Contenuto principale -->
<div class="content">
  <h2>Gestione Mese Corrente</h2>
  <p id="meseCorrente"></p>

  <!-- Form per aggiungere spesa -->
  <div class="card mb-4 shadow">
    <div class="card-body">
      <h5>Aggiungi Spesa</h5>
      <form id="addSpesaForm" class="row g-3">
        <div class="col-md-6">
          <input type="text" class="form-control" placeholder="Descrizione" required>
        </div>
        <div class="col-md-3">
          <input type="number" class="form-control" placeholder="Importo" required step="0.01">
        </div>
        <div class="col-md-3">
          <button type="submit" class="btn btn-primary w-100">Aggiungi</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Elenco spese -->
  <div id="speseList"></div>

  <!-- Totale -->
  <div class="card shadow mt-3 p-3">
    <h5>Totale: €<span id="totale">0.00</span></h5>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(document).ready(function(){

  // Mese corrente
  const mesi = [
    "Gennaio","Febbraio","Marzo","Aprile","Maggio","Giugno",
    "Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre"
  ];
  const oggi = new Date();
  const meseCorrente = mesi[oggi.getMonth()] + " " + oggi.getFullYear();
  $("#meseCorrente").text("Mese: " + meseCorrente);

  // Array spese (simulazione)
  let spese = [];

  // Funzione per aggiornare lista spese
  function aggiornaLista(){
    $("#speseList").empty();
    let totale = 0;
    spese.forEach((s, i) => {
      totale += parseFloat(s.importo);
      $("#speseList").append(`
        <div class="card spesa-card shadow">
          <div class="card-body d-flex justify-content-between align-items-center">
            <span>${s.descrizione} - €${parseFloat(s.importo).toFixed(2)}</span>
            <button class="btn btn-sm btn-danger" data-index="${i}">Elimina</button>
          </div>
        </div>
      `);
    });
    $("#totale").text(totale.toFixed(2));
  }

  // Aggiungi spesa
  $("#addSpesaForm").submit(function(e){
    e.preventDefault();
    const descrizione = $(this).find('input[type="text"]').val();
    const importo = $(this).find('input[type="number"]').val();
    spese.push({descrizione, importo});
    aggiornaLista();
    $(this)[0].reset();
  });

  // Elimina spesa
  $(document).on('click', '.spesa-card button', function(){
    const index = $(this).data('index');
    spese.splice(index,1);
    aggiornaLista();
  });

});
</script>

<?php require_once __DIR__ . "/../partials/footer.php"; ?>
