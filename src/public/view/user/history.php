<?php 
require_once __DIR__ . "/../../../Bootstrap.php";
$authController = new AuthController;
$authController->checkIfUserIsNotLogged();
$user = $authController->getAuthUser();
echo flashMessage();
?>
<?php require_once __DIR__ . "/../partials/header.php"; ?>
<?php require_once __DIR__ . "/../partials/sidebar.php"; ?>

<div class="content">
  <h2>Storico Anni</h2>
  <div class="list-group mt-4" id="anniList">
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
let anni = [2024, 2023, 2022, 2021];

anni.forEach(function(anno){
    $("#anniList").append(
        `<a href="spese.html?anno=${anno}" class="list-group-item list-group-item-action">
            ${anno}
        </a>`
    );
});
</script>

<?php require_once __DIR__ . "/../partials/footer.php"; ?>
