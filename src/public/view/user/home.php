<?php 
require_once __DIR__ . "/../../../Bootstrap.php";
$authController = new AuthController;
$monthController = new MonthController;
$expenseController = new ExpenseController;
$authController->checkIfUserIsNotLogged();
$user = $authController->getAuthUser();
$idCurrentMonth = MONTHS[date("n")];
$month = $monthController->getById($idCurrentMonth);
$year = date("Y");
$idYear = YEARS[$year];
$expenses = $expenseController->getAllByIdMonthAndIdYear($month->getId(), $idYear);
$total = 0;
?>
<?php 
require_once __DIR__ . "/../partials/header.php";
require_once __DIR__ . "/../partials/sidebar.php";
echo flashMessage(); 
$expenseController->getDeleteModal();
?>

<div class="py-4 content">
  <h2 class="mb-4">
    Gestione Mese <?php echo htmlspecialchars($month->getName()) . " " . htmlspecialchars($year); ?>
  </h2>

  <div class="card mb-4 shadow-sm">
    <div class="card-header bg-primary text-white">
      <h5 class="mb-0">Aggiungi Spesa</h5>
    </div>

    <div class="card-body">
      <form action="/user/spese_mensili/insert" method="POST" class="row g-3 align-items-end">
        <input type="hidden" name="month" value="<?php echo htmlspecialchars($month->getId()); ?>">
        <input type="hidden" name="year" value="<?php echo htmlspecialchars($year); ?>">
        <div class="col-md-5">
          <label class="form-label">Descrizione</label>
          <input type="text" name="description" class="form-control" placeholder="Motivo della spesa..." required>
        </div>
        <div class="col-md-2">
          <label class="form-label">Importo</label>
          <div class="input-group">
            <span class="input-group-text">€</span>
            <input type="number" name="import" class="form-control" required step="0.01">
          </div>
        </div>
        <div class="col-md-2">
          <label class="form-label">Giorno</label>
          <select name="day" id="day" class="form-select" required></select>
        </div>
        <div class="col-md-3">
          <button type="submit" class="btn btn-primary w-100">
            + Aggiungi
          </button>
        </div>
      </form>
    </div>
  </div>

  <div id="speseList">
    <?php 
    $total = 0;
    if(empty($expenses)){
      ?>
      <div class="alert alert-light text-center">
        Nessuna spesa registrata per questo mese
      </div>
      <?php
    }

    foreach($expenses as $expense){
      $total += $expense->getImport();
      ?>
      <div class="card spesa-card shadow-sm mb-2">
        <div class="card-body d-flex justify-content-between align-items-center">
          <div>
            <div class="fw-semibold">
              <?php echo htmlspecialchars($expense->getDescription()); ?>
            </div>
            <small class="text-muted">
              <?php echo htmlspecialchars($expense->getDay()) . " " . htmlspecialchars($month->getName()); ?>
            </small>
          </div>
          <div class="d-flex align-items-center gap-3">
            <span class="fw-bold text-success">
              €<?php echo htmlspecialchars(round($expense->getImport(),2)); ?>
            </span>
            <button 
              class="btn btn-sm btn-outline-danger"
              data-bs-toggle="modal"
              data-bs-target="#deleteExpenseModal"
              data-id="<?php echo htmlspecialchars($expense->getId()); ?>"
              data-month="<?php echo htmlspecialchars($month->getId()); ?>"
              data-year="<?php echo htmlspecialchars($year); ?>">
              Elimina
            </button>
          </div>
        </div>
      </div>
      <?php
    }?>
  </div>

  <div class="card shadow-sm mt-4 border-0 bg-light">
    <div class="card-body d-flex justify-content-between align-items-center">
      <h5 class="mb-0 text-muted">
        Totale Spese
      </h5>
      <h4 class="mb-0 fw-bold text-danger">
        €<span id="totale"><?php echo htmlspecialchars(round($total,2)); ?></span>
      </h4>
    </div>
  </div>
</div>

<?php require_once __DIR__ . "/../partials/footer.php"; ?>
