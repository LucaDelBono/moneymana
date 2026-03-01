<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<title>Errore 404</title>
<style>
  body {
    min-height: 100vh;
    display: flex;
    margin: 0;
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
  }

  .content {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .error-box {
    background: white;
    padding: 50px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    text-align: center;
    max-width: 500px;
  }

  .error-code {
    font-size: 90px;
    font-weight: 800;
    color: #0d6efd;
    margin: 0;
    letter-spacing: 5px;
  }

  .error-message {
    font-size: 20px;
    margin: 20px 0;
    color: #495057;
  }

  .btn-home {
    display: inline-block;
    padding: 12px 25px;
    background-color: #0d6efd;
    color: white;
    text-decoration: none;
    border-radius: 6px;
    font-weight: bold;
    transition: 0.2s ease;
  }

  .btn-home:hover {
    background-color: #0b5ed7;
    transform: translateY(-2px);
  }

</style>
</head>
<body>

<div class="content">
  <div class="error-box">
    <div class="error-code">404</div>
    <div class="error-message">
      Ops! La pagina che stai cercando non esiste.
    </div>
    <a href="/" class="btn-home">Torna alla Home</a>
  </div>
</div>

</body>
</html>