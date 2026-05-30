<?php
require_once __DIR__ . '/../../includes/db.php';
require_once __DIR__ . '/../../includes/helpers.php';
session_start();
$name = $_POST['name'] ?? '';
$slug = $_POST['slug'] ?: slugify($name);
$icon = $_POST['icon'] ?? 'tag';
$order = (int)($_POST['order_index'] ?? 0);
$db = getDB();
$stmt = $db->prepare("INSERT INTO categories (name, slug, icon, order_index) VALUES (?,?,?,?)");
$stmt->execute([$name, $slug, $icon, $order]);
setFlash('success', 'Catégorie créée avec succès.');
header('Location: index.php');
