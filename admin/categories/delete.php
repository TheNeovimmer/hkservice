<?php
require_once __DIR__ . '/../../includes/db.php';
require_once __DIR__ . '/../../includes/helpers.php';
if (session_status() === PHP_SESSION_NONE) session_start();
$id = (int)($_GET['id'] ?? 0);
if ($id) {
    $db = getDB();
    $db->prepare("DELETE FROM categories WHERE id=?")->execute([$id]);
    setFlash('success', 'Catégorie supprimée.');
}
header('Location: index.php');
