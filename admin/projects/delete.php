<?php
require_once __DIR__ . '/../../includes/db.php';
require_once __DIR__ . '/../../includes/helpers.php';
session_start();
$id = (int)($_GET['id'] ?? 0);
if ($id) {
    $db = getDB();
    $p = $db->prepare("SELECT images FROM projects WHERE id=?")->execute([$id])->fetch();
    if ($p && $p['images']) {
        foreach (json_decode($p['images'], true) as $img) {
            $path = __DIR__ . '/../../' . $img;
            if (file_exists($path)) @unlink($path);
        }
    }
    $db->prepare("DELETE FROM projects WHERE id=?")->execute([$id]);
    setFlash('success', 'Projet supprimé.');
}
header('Location: index.php');
