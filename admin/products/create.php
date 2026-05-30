<?php
require_once __DIR__ . '/../../includes/db.php';
require_once __DIR__ . '/../../includes/helpers.php';
if (session_status() === PHP_SESSION_NONE) session_start();
$db = getDB();
$name = $_POST['name'] ?? '';
$slug = $_POST['slug'] ?: slugify($name);
$catId = (int)($_POST['category_id'] ?? 0);
$desc = $_POST['description'] ?? '';
$price = (float)($_POST['price'] ?? 0);
$badge = $_POST['badge_type'] ?? 'none';
$colors = $_POST['colors'] ?? '[]';
$featured = isset($_POST['featured']) ? 1 : 0;
$active = isset($_POST['active']) ? 1 : 0;
$order = (int)($_POST['order_index'] ?? 0);
$image = '';
if (!empty($_FILES['image']['name'])) {
    $image = uploadFile($_FILES['image'], 'products');
}
$stmt = $db->prepare("INSERT INTO products (category_id, name, slug, description, price_eur, badge_type, colors, image, featured, active, order_index) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
$stmt->execute([$catId, $name, $slug, $desc, $price, $badge, $colors, $image, $featured, $active, $order]);
setFlash('success', 'Produit créé avec succès.');
header('Location: index.php');
