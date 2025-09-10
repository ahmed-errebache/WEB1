<?php
// header.php : inclusion de l'entête commun et initialisation session (TP2)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/config.php';

// Initialisation du nom et du logo à la première visite (variables de session)
if (!isset($_SESSION['band_name'])) {
    $_SESSION['band_name'] = 'MetaRock'; // remplace par ton nom de groupe
}
if (!isset($_SESSION['band_logo'])) {
    $_SESSION['band_logo'] = 'assets/logo.png'; // chemin relatif vers le logo
}
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo htmlspecialchars($_SESSION['band_name']); ?></title>
  <style>
    body { font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif; margin:0; padding:0; background:#111; color:#eee; }
    header, footer { background:#1f1f1f; padding:12px 16px; }
    header .row { display:flex; align-items:center; gap:12px; }
    header img { height:48px; width:auto; }
    nav a { color:#fff; text-decoration:none; margin-right:12px; }
    nav a.active { font-weight:700; text-decoration:underline; }
    main { padding:16px; }
    table { border-collapse: collapse; width:100%; background:#181818; }
    th, td { border:1px solid #2a2a2a; padding:8px; }
    th a { color:#fff; }
    input[type="search"] { padding:8px; width:260px; max-width:100%; }
    .container { max-width:980px; margin:0 auto; }
  </style>
</head>
<body>
  <header>
    <div class="container">
      <div class="row">
        <img src="<?php echo htmlspecialchars($_SESSION['band_logo']); ?>" alt="logo">
        <h1 style="margin:0"><?php echo htmlspecialchars($_SESSION['band_name']); ?></h1>
      </div>
      <nav style="margin-top:8px">
        <?php
        function active($p) {
            return basename($_SERVER['PHP_SELF']) === $p ? 'active' : '';
        }
        ?>
        <a class="<?php echo active('index.php'); ?>" href="index.php">Accueil</a>
        <a class="<?php echo active('setlist.php'); ?>" href="setlist.php">Setlist</a>
      </nav>
    </div>
  </header>
  <main><div class="container">