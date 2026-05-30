<?php
require_once __DIR__ . '/../../includes/db.php';
require_once __DIR__ . '/../../includes/helpers.php';
session_start();
$id = (int)($_POST['id'] ?? 0);
$title = $_POST['title'] ?? '';
$slug = $_POST['slug'] ?: slugify($title);
$section = $_POST['section'] ?? 'etude';
$icon = $_POST['icon'] ?? 'cog';
$summary = $_POST['summary'] ?? '';
$description = $_POST['description'] ?? '';
$order = (int)($_POST['order_index'] ?? 0);
$db = getDB();
$stmt = $db->prepare("UPDATE services SET title=?, slug=?, section=?, icon=?, summary=?, description=?, order_index=? WHERE id=?");
$stmt->execute([$title, $slug, $section, $icon, $summary, $description, $order, $id]);
setFlash('success', 'Service modifié avec succès.');
header('Location: index.php');
