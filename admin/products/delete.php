<?php
require_once __DIR__ . '/../../includes/db.php';
require_once __DIR__ . '/../../includes/helpers.php';
if (session_status() === PHP_SESSION_NONE) session_start();
$id = (int)($_GET['id'] ?? 0);
if ($id) {
    $db = getDB();
    $stmt = $db->prepare("SELECT image FROM products WHERE id=?");
    $stmt->execute([$id]);
    $p = $stmt->fetch();
    if (!empty($p['image']) && file_exists(__DIR__ . '/../../' . $p['image'])) {
        unlink(__DIR__ . '/../../' . $p['image']);
    }
    $db->prepare("DELETE FROM products WHERE id=?")->execute([$id]);
    setFlash('success', 'Produit supprimé.');
}
header('Location: index.php');
