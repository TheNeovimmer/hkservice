<?php
require_once __DIR__ . '/../includes/auth.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: index.php'); exit; }
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
if (login($email, $password)) {
    header('Location: dashboard.php');
} else {
    header('Location: index.php?error=1');
}
exit;
