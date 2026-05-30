<?php
require_once __DIR__ . '/db.php';

function login($email, $password): bool {
    $db = getDB();
    $stmt = $db->prepare("SELECT * FROM admin_users WHERE email = ? LIMIT 1");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['admin_id'] = $user['id'];
        $_SESSION['admin_username'] = $user['username'];
        $_SESSION['admin_email'] = $user['email'];
        $_SESSION['admin_avatar'] = $user['avatar'] ?? '';
        return true;
    }
    return false;
}

function isLoggedIn(): bool {
    return isset($_SESSION['admin_id']);
}

function requireLogin(): void {
    if (!isLoggedIn()) {
        header('Location: /admin/index.php');
        exit;
    }
}

function logout(): void {
    unset($_SESSION['admin_id'], $_SESSION['admin_username'], $_SESSION['admin_email']);
    session_destroy();
}

function adminName(): string {
    return $_SESSION['admin_username'] ?? 'Admin';
}
