<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/band_generators.php';

// Handle logout
if (isset($_GET['disconnect']) && $_GET['disconnect'] == '1') {
  unset($_SESSION['admin_logged_in']);
  unset($_SESSION['admin_login']);
  header('Location: ' . basename($_SERVER['PHP_SELF']));
  exit;
}

// Handle login form submission
$login_error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login']) && isset($_POST['password'])) {
  $login = trim($_POST['login']);
  $password = trim($_POST['password']);
  
  if (!empty($login) && !empty($password)) {
    try {
      // Use PHP hash function for better compatibility
      $stmt = $pdo->prepare("SELECT login FROM admins WHERE login = ? AND password = ?");
      $stmt->execute([$login, hash('sha256', $password)]);
      $admin = $stmt->fetch();
      
      if ($admin) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_login'] = $admin['login'];
        header('Location: ' . basename($_SERVER['PHP_SELF']));
        exit;
      } else {
        $login_error = 'Identifiants incorrects';
      }
    } catch (PDOException $e) {
      $login_error = 'Erreur de connexion';
    }
  } else {
    $login_error = 'Veuillez remplir tous les champs';
  }
}

$bandName = generate_bandname();
$logo = generate_bandlogo();

if (!isset($_SESSION['band_name'])) {
  $_SESSION['band_name'] = $bandName;
}
if (!isset($_SESSION['band_logo'])) {
  $_SESSION['band_logo'] = $logo;
}
?>
<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  <title><?php echo htmlspecialchars($_SESSION['band_name']); ?></title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
  <header>
    <div class="container header-row">
      <div class="brand">
        <img src="<?php echo htmlspecialchars($_SESSION['band_logo']); ?>" alt="logo">
        <h1><?php echo htmlspecialchars($_SESSION['band_name']); ?></h1>
      </div>
      <?php
       function active($p)
        {
          return basename($_SERVER['PHP_SELF']) === $p ? 'active' : '';
        }
      ?>
      <nav>
        <a class="<?php echo active('index.php'); ?>" href="index.php">HOME</a>
        <?php if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in']): ?>
          <a href="?disconnect=1">DISCONNECT</a>
        <?php else: ?>
          <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal">CONNECT</a>
        <?php endif; ?>
        <a class="<?php echo active('setlist.php'); ?>" href="setlist.php">SETLIST</a>
        <a class="<?php echo active('contact.php'); ?>" href="setlist.php">CONTACT</a>
      </nav>
    </div>
  </header>

  <!-- Login Modal -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="loginModalLabel">Connexion Admin</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          <div class="modal-body">
            <?php if (!empty($login_error)): ?>
              <div class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($login_error); ?>
              </div>
            <?php endif; ?>
            <div class="mb-3">
              <label for="login" class="form-label">Login</label>
              <input type="text" class="form-control" id="login" name="login" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Mot de passe</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            <button type="submit" class="btn btn-primary">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php if (!empty($login_error)): ?>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
        loginModal.show();
      });
    </script>
  <?php endif; ?>

  <main>