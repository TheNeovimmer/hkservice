<?php
require_once __DIR__ . '/../../includes/db.php';
require_once __DIR__ . '/../../includes/helpers.php';
if (session_status() === PHP_SESSION_NONE) session_start();
$title = $_POST['title'] ?? '';
$slug = $_POST['slug'] ?: slugify($title);
$section = $_POST['section'] ?? 'etude';
$icon = $_POST['icon'] ?? 'cog';
$summary = $_POST['summary'] ?? '';
$description = $_POST['description'] ?? '';
$order = (int)($_POST['order_index'] ?? 0);
$db = getDB();
$stmt = $db->prepare("INSERT INTO services (title, slug, section, icon, summary, description, order_index) VALUES (?,?,?,?,?,?,?)");
$stmt->execute([$title, $slug, $section, $icon, $summary, $description, $order]);
setFlash('success', 'Service créé avec succès.');
header('Location: index.php');
