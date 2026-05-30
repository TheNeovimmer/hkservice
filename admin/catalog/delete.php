<?php
require_once __DIR__ . '/../../includes/db.php';
require_once __DIR__ . '/../../includes/helpers.php';
if (session_status() === PHP_SESSION_NONE) session_start();
$id = (int)($_GET['id'] ?? 0);
if ($id) {
    $db = getDB();
    $db->prepare("DELETE FROM catalog_items WHERE id=?")->execute([$id]);
    setFlash('success', 'Élément supprimé du catalogue.');
}
header('Location: index.php');
