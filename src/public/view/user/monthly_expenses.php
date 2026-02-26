<?php 
require_once __DIR__ . "/../../../Bootstrap.php";
$authController = new AuthController;
$yearController = new YearController;
$monthController = new MonthController;
$expenseController = new ExpenseController;
$authController->checkIfUserIsNotLogged();
$user = $authController->getAuthUser();
if(empty($_GET["month"]) || empty($_GET["year"])){
    header("Location: /error");
}

if(empty(MONTHS[$_GET["month"]]) || empty(YEARS[$_GET["year"]])){
    header("Location: /error");
}

$month = $monthController->getById($_GET["month"]);
$year = $_GET["year"];

if(!$month){
    header("Location: /error");
}

$expenses = $expenseController->getAllByIdMonthAndIdYear($month->getId(), YEARS[$_GET["year"]]);
$total = 0;
?>
<?php 
require_once __DIR__ . "/../partials/header.php";
require_once __DIR__ . "/../partials/sidebar.php";
echo flashMessage(); 
?>

<div class="content">
  <h2>Gestione Mese <?php echo htmlspecialchars($month->getName()) . " " . htmlspecialchars($year); ?></h2>

  <div class="card mb-4 shadow">
    <div class="card-body">
      <h5>Aggiungi Spesa</h5>
      <form action="/user/spese_mensili/insert" method="POST" class="row g-3">
        <input type="hidden" name="month" value="<?php echo htmlspecialchars($month->getId()); ?>">
        <input type="hidden" name="year" value="<?php echo htmlspecialchars($year); ?>">
        <div class="col-md-6">
          <input type="text" name="description" class="form-control" placeholder="Descrizione" required>
        </div>
        <div class="col-md-3">
          <input type="number" name="import" class="form-control" placeholder="Importo" required step="0.01">
        </div>
        <div class="col-md-3">
          <button type="submit" class="btn btn-primary w-100">Aggiungi</button>
        </div>
      </form>
    </div>
  </div>

  <div id="speseList">
    <?php 
    foreach($expenses as $expense){
      $total += $expense->getImport();
      ?>
      <div class="card spesa-card shadow">
        <div class="card-body d-flex justify-content-between align-items-center">
          <span><?php echo htmlspecialchars($expense->getDescription()) . " - " . htmlspecialchars(round( $expense->getImport(),2)) . "€"; ?></span>
          <button class="btn btn-sm btn-danger" >Elimina</button>
        </div>
      </div>
      <?php
    }?>
  </div>

  <div class="card shadow mt-3 p-3">
    <h5>Totale: €<span id="totale"><?php echo htmlspecialchars($total)?></span></h5>
  </div>
</div>

<?php require_once __DIR__ . "/../partials/footer.php"; ?>
