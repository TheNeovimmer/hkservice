<?php
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/auth.php';
requireLogin();
$db = getDB();
$userId = (int)$_SESSION['admin_id'];

$username = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');
$currentPassword = $_POST['current_password'] ?? '';
$newPassword = $_POST['new_password'] ?? '';
$confirmPassword = $_POST['confirm_password'] ?? '';

if (!$username || !$email) {
    setFlash('error', 'Le nom d\'utilisateur et l\'email sont obligatoires.');
    header('Location: profile.php');
    exit;
}

$stmt = $db->prepare("SELECT * FROM admin_users WHERE id=?");
$stmt->execute([$userId]);
$admin = $stmt->fetch();
if (!$admin) {
    setFlash('error', 'Utilisateur introuvable.');
    header('Location: profile.php');
    exit;
}

$check = $db->prepare("SELECT id FROM admin_users WHERE email=? AND id!=?");
$check->execute([$email, $userId]);
if ($check->fetch()) {
    setFlash('error', 'Cet email est déjà utilisé par un autre administrateur.');
    header('Location: profile.php');
    exit;
}

$avatar = $admin['avatar'];
if (!empty($_FILES['avatar']['name']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
    $uploaded = uploadImage($_FILES['avatar'], 'avatars');
    if ($uploaded) {
        if ($admin['avatar'] && file_exists(__DIR__ . '/../' . $admin['avatar'])) {
            @unlink(__DIR__ . '/../' . $admin['avatar']);
        }
        $avatar = $uploaded;
    }
}

$passwordSql = '';
$params = [$username, $email, $avatar, $userId];

if ($newPassword || $confirmPassword) {
    if (!$currentPassword) {
        setFlash('error', 'Veuillez entrer votre mot de passe actuel pour le changer.');
        header('Location: profile.php');
        exit;
    }
    if (!password_verify($currentPassword, $admin['password'])) {
        setFlash('error', 'Le mot de passe actuel est incorrect.');
        header('Location: profile.php');
        exit;
    }
    if ($newPassword !== $confirmPassword) {
        setFlash('error', 'Les nouveaux mots de passe ne correspondent pas.');
        header('Location: profile.php');
        exit;
    }
    if (strlen($newPassword) < 6) {
        setFlash('error', 'Le mot de passe doit contenir au moins 6 caractères.');
        header('Location: profile.php');
        exit;
    }
    $hash = password_hash($newPassword, PASSWORD_BCRYPT, ['cost' => 12]);
    $passwordSql = ', password=?';
    array_splice($params, 3, 0, [$hash]);
}

$sql = "UPDATE admin_users SET username=?, email=?, avatar=?$passwordSql WHERE id=?";
$stmt = $db->prepare($sql);
$stmt->execute($params);

$_SESSION['admin_username'] = $username;
$_SESSION['admin_email'] = $email;

setFlash('success', 'Profil mis à jour avec succès.');
header('Location: profile.php');
