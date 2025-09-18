<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/band_generators.php';

$bandName = generate_bandname();
$logo = generate_bandlogo();

if (!isset($_SESSION['band_name'])) {
  $_SESSION['band_name'] = $bandName;
}
if (!isset($_SESSION['band_logo'])) {
  $_SESSION['band_logo'] = $logo;
}

// Handle logout
if (isset($_GET['disconnect']) && $_GET['disconnect'] == '1') {
  unset($_SESSION['admin_logged_in']);
  unset($_SESSION['admin_login']);
  header('Location: ' . strtok($_SERVER["REQUEST_URI"], '?'));
  exit;
}

// Handle login form submission
$login_error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admin_login']) && isset($_POST['admin_password'])) {
  $login = trim($_POST['admin_login']);
  $password = trim($_POST['admin_password']);
  
  if (!empty($login) && !empty($password)) {
    if ($pdo === null) {
      $login_error = 'Base de données non disponible';
    } else {
      try {
        $stmt = $pdo->prepare("SELECT login FROM admins WHERE login = ? AND password = SHA2(?, 256)");
        $stmt->execute([$login, $password]);
        $admin = $stmt->fetch();
        
        if ($admin) {
          $_SESSION['admin_logged_in'] = true;
          $_SESSION['admin_login'] = $admin['login'];
          header('Location: ' . htmlspecialchars($_SERVER["PHP_SELF"]));
          exit;
        } else {
          $login_error = 'Identifiants incorrects';
        }
      } catch (PDOException $e) {
        $login_error = 'Erreur de connexion à la base de données';
      }
    }
  } else {
    $login_error = 'Veuillez remplir tous les champs';
  }
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
          <a href="#" onclick="document.getElementById('loginModal').style.display='block'">CONNECT</a>
        <?php endif; ?>
        <a class="<?php echo active('setlist.php'); ?>" href="setlist.php">SETLIST</a>
        <a class="<?php echo active('contact.php'); ?>" href="setlist.php">CONTACT</a>
      </nav>
    </div>
  </header>

  <!-- Login Modal -->
  <div id="loginModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <span class="close" onclick="document.getElementById('loginModal').style.display='none'">&times;</span>
        <h2>Connexion Admin</h2>
      </div>
      <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="modal-body">
          <?php if (!empty($login_error)): ?>
            <div class="error-message"><?php echo htmlspecialchars($login_error); ?></div>
          <?php endif; ?>
          <div class="form-group">
            <label for="admin_login">Login:</label>
            <input type="text" id="admin_login" name="admin_login" required>
          </div>
          <div class="form-group">
            <label for="admin_password">Mot de passe:</label>
            <input type="password" id="admin_password" name="admin_password" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" onclick="document.getElementById('loginModal').style.display='none'">Annuler</button>
          <button type="submit">Login</button>
        </div>
      </form>
    </div>
  </div>

  <main>