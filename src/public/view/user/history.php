<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Storico - Gestione Spese</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a href="home.html" class="navbar-brand">← Home</a>
  </div>
</nav>

<div class="container mt-5">
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

</body>
</html>
