<?php
require_once __DIR__ . '/../../includes/helpers.php';
require_once __DIR__ . '/../../includes/auth.php';
requireLogin();
$db = getDB();
$id = (int)($_GET['id'] ?? 0);
$db->prepare("DELETE FROM contacts WHERE id=?")->execute([$id]);
setFlash('success', 'Demande supprimée.');
header('Location: index.php');
exit;
