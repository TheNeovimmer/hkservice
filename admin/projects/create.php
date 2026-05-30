<?php
require_once __DIR__ . '/../../includes/db.php';
require_once __DIR__ . '/../../includes/helpers.php';
session_start();
$db = getDB();
$title = $_POST['title'] ?? '';
$slug = $_POST['slug'] ?: slugify($title);
$category = $_POST['category'] ?? 'amenagement';
$location = $_POST['location'] ?? '';
$surface = $_POST['surface'] ?? '';
$client = $_POST['client'] ?? '';
$description = $_POST['description'] ?? '';
$orderIndex = (int)($_POST['order_index'] ?? 0);
$active = isset($_POST['active']) ? 1 : 0;
$projectNumber = $_POST['project_number'] ?? '';
$images = [];
$thumbnail = '';
if (!empty($_FILES['images']['name'][0])) {
    $uploaded = uploadMultiple($_FILES['images'], 'projects');
    $images = $uploaded['files'];
    $thumbnail = $images[0] ?? '';
}
$stmt = $db->prepare("INSERT INTO projects (title, slug, category, project_number, location, surface, client, description, images, thumbnail, order_index, active) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
$stmt->execute([$title, $slug, $category, $projectNumber, $location, $surface, $client, $description, json_encode($images), $thumbnail, $orderIndex, $active]);
setFlash('success', 'Projet créé avec succès.');
header('Location: index.php');
