<?php 
require_once __DIR__ . "/../../../Bootstrap.php";
$authController = new AuthController;
$yearController = new YearController;
$monthController = new MonthController;
$authController->checkIfUserIsNotLogged();
$user = $authController->getAuthUser();

if(empty($_GET["year"]) || empty($_GET["month"])){
    header("Location: /error");
}

$year = $yearController->getByYear($_GET["year"]);
$month = $monthController->getById($_GET["month"]);
if(!$year || !$month){
    header("Location: /error");
}
?>
<?php 
require_once __DIR__ . "/../partials/header.php";
require_once __DIR__ . "/../partials/sidebar.php";
echo flashMessage(); 
?>

<div class="content">
  <h2>Gestione Mese <?php echo htmlspecialchars($month->getName()) . " " . htmlspecialchars($year->getYear()); ?></h2>

  <div class="card mb-4 shadow">
    <div class="card-body">
      <h5>Aggiungi Spesa</h5>
      <form id="addSpesaForm" class="row g-3">
        <input type="hidden" name="id_month" value="<?php echo htmlspecialchars($idCurrentMonth); ?>">
        <input type="hidden" name="id_year" value="<?php echo htmlspecialchars($idCurrentYear); ?>">
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

  <div id="speseList">
    <div class="card spesa-card shadow">
        <div class="card-body d-flex justify-content-between align-items-center">
        <span>${s.descrizione} - €${parseFloat(s.importo).toFixed(2)}</span>
        <button class="btn btn-sm btn-danger" >Elimina</button>
        </div>
    </div>
  </div>

  <div class="card shadow mt-3 p-3">
    <h5>Totale: €<span id="totale">0.00</span></h5>
  </div>
</div>

<?php require_once __DIR__ . "/../partials/footer.php"; ?>
