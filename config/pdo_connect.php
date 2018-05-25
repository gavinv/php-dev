<?php
require_once __DIR__ . '/live.conf.php';

try {
  $dbc = new PDO('mysql:host='.DB_HOST.';port=443;dbname='.DB_NAME, DB_USER, DB_PASS);

  $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

?>