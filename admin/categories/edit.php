<?php
require_once __DIR__ . '/../../includes/db.php';
require_once __DIR__ . '/../../includes/helpers.php';
session_start();
$id = (int)($_POST['id'] ?? 0);
$name = $_POST['name'] ?? '';
$slug = $_POST['slug'] ?: slugify($name);
$icon = $_POST['icon'] ?? 'tag';
$order = (int)($_POST['order_index'] ?? 0);
$db = getDB();
$stmt = $db->prepare("UPDATE categories SET name=?, slug=?, icon=?, order_index=? WHERE id=?");
$stmt->execute([$name, $slug, $icon, $order, $id]);
setFlash('success', 'Catégorie modifiée avec succès.');
header('Location: index.php');
