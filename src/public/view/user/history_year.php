<?php 
require_once __DIR__ . "/../../../Bootstrap.php";
$authController = new AuthController;
$monthController = new MonthController;
$user = $authController->getAuthUser();
$authController->checkIfUserIsNotLogged();
$months = $monthController->getAll();
?>
<?php
require_once __DIR__ . "/../partials/header.php";
require_once __DIR__ . "/../partials/sidebar.php";
?>
<div class="content mt-5">
  <h2 id="titolo">Spese anno <?php echo htmlspecialchars($_GET["year"]);//todo verificare l'anno nel database e non stampare la get ?></h2>

  <div class="row mt-4" id="mesiContainer">
    <?php foreach($months as $month){
      ?>
      <div class="col-md-3 mb-3">
        <div class="card shadow">
          <div class="card-body text-center">
            <h6><?php echo htmlspecialchars($month->getName()); ?></h6>
            <button class="btn btn-outline-primary btn-sm">
              Visualizza Spese
            </button>
          </div>
        </div>
      </div>
      <?php
    }?>
  </div>
</div>

<?php require_once __DIR__ . "/../partials/footer.php"; ?>