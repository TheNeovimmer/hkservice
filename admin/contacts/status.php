<?php
require_once __DIR__ . '/../../includes/helpers.php';
require_once __DIR__ . '/../../includes/auth.php';
requireLogin();
$db = getDB();
$id = (int)($_GET['id'] ?? 0);
$status = $_GET['status'] ?? 'read';
$allowed = ['read','replied','archived'];
if (!in_array($status, $allowed)) $status = 'read';
$db->prepare("UPDATE contacts SET status=? WHERE id=?")->execute([$status, $id]);
$from = $_GET['from'] ?? $_SERVER['HTTP_REFERER'] ?? 'index.php';
header('Location: ' . $from);
exit;
