<?php
require_once __DIR__ . '/../../includes/db.php';
require_once __DIR__ . '/../../includes/helpers.php';
if (session_status() === PHP_SESSION_NONE) session_start();
$db = getDB();
$id = (int)($_POST['id'] ?? 0);
$name = $_POST['name'] ?? '';
$slug = $_POST['slug'] ?: slugify($name);
$catId = (int)($_POST['category_id'] ?? 0);
$desc = $_POST['description'] ?? '';
$price = (float)($_POST['price'] ?? 0);
$priceTnd = (float)($_POST['price_tnd'] ?? 0);
$badge = $_POST['badge_type'] ?? 'none';
$colors = $_POST['colors'] ?? '[]';
$featured = isset($_POST['featured']) ? 1 : 0;
$active = isset($_POST['active']) ? 1 : 0;
$order = (int)($_POST['order_index'] ?? 0);
$image = $_POST['existing_image'] ?? '';
if (!empty($_FILES['image']['name'])) {
    $newImage = uploadFile($_FILES['image'], 'products');
    if ($newImage) $image = $newImage;
}
$stmt = $db->prepare("UPDATE products SET category_id=?, name=?, slug=?, description=?, price_eur=?, price_tnd=?, badge_type=?, colors=?, image=?, featured=?, active=?, order_index=? WHERE id=?");
$stmt->execute([$catId, $name, $slug, $desc, $price, $priceTnd, $badge, $colors, $image, $featured, $active, $order, $id]);
setFlash('success', 'Produit modifié avec succès.');
header('Location: index.php');
