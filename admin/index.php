<?php
require_once __DIR__ . '/../includes/db.php';
if (isset($_SESSION['admin_id'])) {
    header('Location: dashboard.php');
    exit;
}
$error = $_GET['error'] ?? '';
?><!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - H&K Services Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/admin/assets/admin.css">
</head>
<body class="login-page">
    <div class="login-bg">
        <div class="login-grid"></div>
        <div class="login-orb o1"></div>
        <div class="login-orb o2"></div>
        <div class="login-orb o3"></div>
    </div>

    <div class="login-container">
        <div class="login-card">
            <div class="login-card-inner">
                <div class="login-header">
                    <div class="login-logo">
                        <img src="/admin/assets/logo.png" alt="H&K Services">
                    </div>
                    <h1>Bienvenue</h1>
                    <p>Accédez à votre tableau de bord</p>
                </div>

                <?php if ($error === '1'): ?>
                <div class="login-alert">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    Identifiants incorrects
                </div>
                <?php endif; ?>

                <form method="post" action="/admin/login.php" class="login-form" autocomplete="off">
                    <div class="input-group">
                        <div class="input-field">
                            <input type="email" name="email" id="email" class="form-input" placeholder=" " required autocomplete="off" value="">
                            <label for="email" class="input-label">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                                Adresse email
                            </label>
                        </div>
                        <div class="input-field">
                            <input type="password" name="password" id="password" class="form-input" placeholder=" " required autocomplete="off" value="">
                            <label for="password" class="input-label">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                Mot de passe
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn-submit">
                        <span>Se connecter</span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </button>
                </form>
            </div>
            <div class="login-footer">
                &copy; 2026 H&K Services. Tous droits reserves.
            </div>
        </div>
    </div>
</body>
</html>
