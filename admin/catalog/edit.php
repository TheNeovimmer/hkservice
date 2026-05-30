<?php
require_once __DIR__ . '/../../includes/db.php';
require_once __DIR__ . '/../../includes/helpers.php';
if (session_status() === PHP_SESSION_NONE) session_start();
$id = (int)($_POST['id'] ?? 0);
$title = $_POST['title'] ?? '';
$description = $_POST['description'] ?? '';
$fileType = $_POST['file_type'] ?? 'flipbook';
$fileUrl = $_POST['file_url'] ?? '';
$active = isset($_POST['active']) ? 1 : 0;
$order = (int)($_POST['order_index'] ?? 0);
$db = getDB();
$stmt = $db->prepare("UPDATE catalog_items SET title=?, description=?, file_type=?, file_url=?, active=?, order_index=? WHERE id=?");
$stmt->execute([$title, $description, $fileType, $fileUrl, $active, $order, $id]);
setFlash('success', 'Élément modifié avec succès.');
header('Location: index.php');
