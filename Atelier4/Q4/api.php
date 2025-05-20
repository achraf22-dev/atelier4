<?php
// Connexion à la base de données
$pdo = new PDO("mysql:host=localhost;dbname=geo;charset=utf8", "root", "");

// Récupération de tous les pays
if ($_GET['action'] === 'pays') {
  $stmt = $pdo->query("SELECT * FROM pays");
  echo "<option value=''>-- Sélectionner un pays --</option>";
  while ($row = $stmt->fetch()) {
    echo "<option value='{$row['id']}'>{$row['nom']}</option>";
  }
}

// Récupération des régions selon l'ID du pays
if ($_GET['action'] === 'regions' && isset($_GET['id_pays'])) {
  $id = intval($_GET['id_pays']);
  $stmt = $pdo->prepare("SELECT * FROM regions WHERE id_pays = ?");
  $stmt->execute([$id]);
  echo "<option value=''>-- Sélectionner une région --</option>";
  while ($row = $stmt->fetch()) {
    echo "<option value='{$row['id']}'>{$row['nom']}</option>";
  }
}

// Récupération des villes selon l'ID de la région
if ($_GET['action'] === 'villes' && isset($_GET['id_region'])) {
  $id = intval($_GET['id_region']);
  $stmt = $pdo->prepare("SELECT * FROM villes WHERE id_region = ?");
  $stmt->execute([$id]);
  echo "<option value=''>-- Sélectionner une ville --</option>";
  while ($row = $stmt->fetch()) {
    echo "<option value='{$row['id']}'>{$row['nom']}</option>";
  }
}
?>
