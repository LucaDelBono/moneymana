<?php 
require_once __DIR__ . "/../../../Bootstrap.php";
$authController = new AuthController;
$yearController = new YearController;
$authController->checkIfUserIsNotLogged();
$user = $authController->getAuthUser();
$years = $yearController->getAll();
?>
<?php 
require_once __DIR__ . "/../partials/header.php";
require_once __DIR__ . "/../partials/sidebar.php"; 
echo flashMessage();

?>

<div class="content">
  <h2>Storico Anni</h2>
  <div class="list-group mt-4" id="anniList">
    <?php
    foreach($years as $year){ 
        ?>
        <a href="storico_anno?year=<?php echo htmlspecialchars($year->getYear()); ?>" class="list-group-item list-group-item-action">
            <?php echo htmlspecialchars($year->getYear()); ?>
        </a>
        <?php
    }?>
  </div>
</div>
<?php require_once __DIR__ . "/../partials/footer.php"; ?>
