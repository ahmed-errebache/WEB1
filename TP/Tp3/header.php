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
        <a class="<?php echo active('connect.php'); ?>" href="setlist.php">CONNECT</a>
        <a class="<?php echo active('setlist.php'); ?>" href="setlist.php">SETLIST</a>
        <a class="<?php echo active('contact.php'); ?>" href="setlist.php">CONTACT</a>
      </nav>
    </div>
  </header>

  <main>