<div class="sidebar d-flex flex-column">
  <div class="user-info text-center mb-4">
    <div class="avatar mb-2"><?php echo  substr(htmlspecialchars($user->getUsername()), 0, 1); ?></div>
    <h6 class="mb-0" id="nomeUtente"><?php echo htmlspecialchars($user->getUsername()); ?></h6>
    <small class="text-light opacity-75">Utente</small>
  </div>

  <hr class="text-secondary">

  <a href="/user/home" class="active">🏠 Dashboard</a>
  <a href="/user/storico">📊 Storico</a>
  <a href="/user/impostazioni">⚙️ Impostazioni</a>

  <div class="mt-auto">
    <a href="/logout" class="logout">🚪 Logout</a>
  </div>
</div>