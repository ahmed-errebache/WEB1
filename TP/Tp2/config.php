<?php
// config.php : connexion PDO pour votre site (utilisez vos identifiants)
$DB_HOST = 'localhost';
$DB_NAME = 'myband';
$DB_USER = 'root';   // adapté pour un MySQL local sans mot de passe
$DB_PASS = '';       // mot de passe vide pour l'utilisateur root
$DB_CHARSET = 'utf8mb4';

$dsn = "mysql:host=$DB_HOST;dbname=$DB_NAME;charset=$DB_CHARSET";
$options = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES => false,
];

try {
  $pdo = new PDO($dsn, $DB_USER, $DB_PASS, $options);
} catch (PDOException $e) {
  http_response_code(500);
  echo "Erreur connexion BDD : " . htmlspecialchars($e->getMessage());
  exit;
}
?>