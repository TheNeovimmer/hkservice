<?php
require_once __DIR__ . '/../../includes/db.php';
require_once __DIR__ . '/../../includes/helpers.php';
session_start();
$title = $_POST['title'] ?? '';
$description = $_POST['description'] ?? '';
$fileType = $_POST['file_type'] ?? 'flipbook';
$fileUrl = $_POST['file_url'] ?? '';
$active = isset($_POST['active']) ? 1 : 0;
$order = (int)($_POST['order_index'] ?? 0);
$db = getDB();
$stmt = $db->prepare("INSERT INTO catalog_items (title, description, file_type, file_url, active, order_index) VALUES (?,?,?,?,?,?)");
$stmt->execute([$title, $description, $fileType, $fileUrl, $active, $order]);
setFlash('success', 'Élément ajouté au catalogue.');
header('Location: index.php');
