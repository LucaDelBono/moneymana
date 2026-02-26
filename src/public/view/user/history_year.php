<?php 
require_once __DIR__ . "/../../../Bootstrap.php";

$authController = new AuthController;
$monthController = new MonthController;
$yearController = new YearController;
$user = $authController->getAuthUser();
$authController->checkIfUserIsNotLogged();

$year = $_GET["year"];
if(!$yearController->getByYear($year)){
  header("Location: /error");
}

$months = $monthController->getAll();
?>
<?php
require_once __DIR__ . "/../partials/header.php";
require_once __DIR__ . "/../partials/sidebar.php";
?>
<div class="content mt-5">
  <h2 id="titolo">Spese anno <?php echo htmlspecialchars($year); ?></h2>

  <div class="row mt-4" id="mesiContainer">
    <?php foreach($months as $month){
      ?>
      <div class="col-md-3 mb-3">
        <div class="card shadow">
          <div class="card-body text-center">
            <h6><?php echo htmlspecialchars($month->getName()); ?></h6>
            <a href="spese_mensili?month=<?php echo htmlspecialchars($month->getId())?>&year=<?php echo htmlspecialchars($year); ?>" class="btn btn-outline-primary btn-sm">
              Visualizza Spese
            </a>
          </div>
        </div>
      </div>
      <?php
    }?>
  </div>
</div>

<?php require_once __DIR__ . "/../partials/footer.php"; ?>