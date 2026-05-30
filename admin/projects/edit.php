<?php
require_once __DIR__ . '/../../includes/db.php';
require_once __DIR__ . '/../../includes/helpers.php';
session_start();
$db = getDB();
$id = (int)($_POST['id'] ?? 0);
$title = $_POST['title'] ?? '';
$slug = $_POST['slug'] ?: slugify($title);
$category = $_POST['category'] ?? 'amenagement';
$location = $_POST['location'] ?? '';
$surface = $_POST['surface'] ?? '';
$client = $_POST['client'] ?? '';
$description = $_POST['description'] ?? '';
$orderIndex = (int)($_POST['order_index'] ?? 0);
$projectNumber = $_POST['project_number'] ?? '';
$active = isset($_POST['active']) ? 1 : 0;
$existing = $db->prepare("SELECT * FROM projects WHERE id=?")->execute([$id])->fetch();
$images = $existing ? json_decode($existing['images'], true) : [];
$thumbnail = $_POST['existing_thumbnail'] ?? ($images[0] ?? '');
if (!empty($_FILES['images']['name'][0])) {
    $uploaded = uploadMultiple($_FILES['images'], 'projects');
    $images = array_merge($images, $uploaded['files']);
}
$stmt = $db->prepare("UPDATE projects SET title=?, slug=?, category=?, project_number=?, location=?, surface=?, client=?, description=?, images=?, thumbnail=?, order_index=?, active=? WHERE id=?");
$stmt->execute([$title, $slug, $category, $projectNumber, $location, $surface, $client, $description, json_encode($images), $thumbnail, $orderIndex, $active, $id]);
setFlash('success', 'Projet modifié avec succès.');
header('Location: index.php');
