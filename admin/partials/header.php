<?php
require_once __DIR__ . '/../../includes/helpers.php';
require_once __DIR__ . '/../../includes/auth.php';
requireLogin();
$pageTitle = $pageTitle ?? 'Dashboard';
$flash = getFlash();
$currentPage = basename($_SERVER['PHP_SELF']);
function isActive($path): string {
    return strpos($_SERVER['PHP_SELF'], $path) !== false ? ' active' : '';
}
?><!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= sanitize($pageTitle) ?> - H&K Services Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_PATH ?>/admin/assets/admin.css">
    <link rel="icon" href="<?= BASE_PATH ?>/admin/assets/logo.png" type="image/x-icon">
</head>
<body>
<div class="sidebar-overlay" id="sidebarOverlay"></div>
<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <a href="<?= BASE_PATH ?>/admin/dashboard.php"><img src="<?= BASE_PATH ?>/admin/assets/logo.png" alt="H&K Services"></a>
    </div>
    <nav class="sidebar-nav">
        <div class="nav-item">
            <a href="<?= BASE_PATH ?>/admin/dashboard.php" class="nav-link<?= $currentPage === 'dashboard.php' ? ' active' : '' ?>">
                <i class="fas fa-chart-simple"></i>
                <span class="nav-text">Dashboard</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="#" class="nav-link nav-toggle<?= isActive('/products/') || isActive('/categories/') ?>">
                <i class="fas fa-box"></i>
                <span class="nav-text">Produits</span>
                <i class="fas fa-chevron-right nav-arrow"></i>
            </a>
            <div class="sub-menu">
                <a href="<?= BASE_PATH ?>/admin/categories/index.php" class="nav-link<?= isActive('/categories/') ?>">
                    <i class="fas fa-tags"></i>
                    <span class="nav-text">Categories</span>
                </a>
                <a href="<?= BASE_PATH ?>/admin/products/index.php" class="nav-link<?= isActive('/products/') ?>">
                    <i class="fas fa-cube"></i>
                    <span class="nav-text">Produits</span>
                </a>
            </div>
        </div>
        <div class="nav-item">
            <a href="#" class="nav-link nav-toggle<?= isActive('/services/') ?>">
                <i class="fas fa-wrench"></i>
                <span class="nav-text">Services</span>
                <i class="fas fa-chevron-right nav-arrow"></i>
            </a>
            <div class="sub-menu">
                <a href="<?= BASE_PATH ?>/admin/services/index.php" class="nav-link<?= isActive('/services/') ?>">
                    <i class="fas fa-list"></i>
                    <span class="nav-text">Tous les services</span>
                </a>
            </div>
        </div>
        <div class="nav-item">
            <a href="#" class="nav-link nav-toggle<?= isActive('/projects/') ?>">
                <i class="fas fa-building"></i>
                <span class="nav-text">Projets</span>
                <i class="fas fa-chevron-right nav-arrow"></i>
            </a>
            <div class="sub-menu">
                <a href="<?= BASE_PATH ?>/admin/projects/index.php" class="nav-link<?= isActive('/projects/') ?>">
                    <i class="fas fa-list"></i>
                    <span class="nav-text">Tous les projets</span>
                </a>
            </div>
        </div>
        <div class="nav-item">
            <a href="#" class="nav-link nav-toggle<?= isActive('/catalog/') ?>">
                <i class="fas fa-book"></i>
                <span class="nav-text">Catalogue</span>
                <i class="fas fa-chevron-right nav-arrow"></i>
            </a>
            <div class="sub-menu">
                <a href="<?= BASE_PATH ?>/admin/catalog/index.php" class="nav-link<?= isActive('/catalog/') ?>">
                    <i class="fas fa-list"></i>
                    <span class="nav-text">Elements du catalogue</span>
                </a>
            </div>
        </div>
        <div class="nav-item">
            <a href="#" class="nav-link nav-toggle<?= isActive('/contacts/') ?>">
                <i class="fas fa-envelope"></i>
                <span class="nav-text">Contacts</span>
                <i class="fas fa-chevron-right nav-arrow"></i>
            </a>
            <div class="sub-menu">
                <a href="<?= BASE_PATH ?>/admin/contacts/index.php?status=new" class="nav-link<?= isActive('/contacts/') ?>">
                    <i class="fas fa-inbox"></i>
                    <span class="nav-text">Demandes</span>
                </a>
            </div>
        </div>
        <div class="nav-item">
            <a href="<?= BASE_PATH ?>/admin/profile.php" class="nav-link<?= isActive('profile.php') ?>">
                <i class="fas fa-user-cog"></i>
                <span class="nav-text">Mon Profil</span>
            </a>
        </div>
    </nav>
    <div class="sidebar-footer">
        <a href="<?= BASE_PATH ?>/" target="_blank">
            <i class="fas fa-external-link-alt"></i>
            <span class="nav-text">Voir le site</span>
        </a>
    </div>
</aside>
<header class="topbar">
    <div class="topbar-left">
        <button class="topbar-toggle d-md-none" id="sidebarToggle"><i class="fas fa-bars"></i></button>
        <button class="topbar-toggle d-none d-md-flex" id="sidebarCollapse"><i class="fas fa-bars"></i></button>
        <span class="topbar-title"><?= sanitize($pageTitle) ?></span>
    </div>
    <div class="topbar-right">
        <div class="topbar-user">
            <?php
            $av = $_SESSION['admin_avatar'] ?? '';
            if ($av && file_exists(__DIR__ . '/../../' . $av)):
            ?>
            <img src="<?= BASE_PATH ?>/<?= sanitize($av) ?>" class="topbar-avatar-img">
            <?php else: ?>
            <div class="topbar-avatar"><?= strtoupper(substr(adminName(), 0, 1)) ?></div>
            <?php endif; ?>
            <span class="d-none d-md-inline"><?= sanitize(adminName()) ?></span>
        </div>
        <a href="<?= BASE_PATH ?>/admin/logout.php" class="topbar-logout" title="Deconnexion"><i class="fas fa-sign-out-alt"></i></a>
    </div>
</header>
<main class="content">
    <?php if ($flash): ?>
    <div class="toast-container">
        <div class="toast toast-auto align-items-center text-bg-<?= $flash['type'] === 'success' ? 'success' : ($flash['type'] === 'error' ? 'danger' : 'warning') ?> border-0 d-flex">
            <div class="d-flex align-items-center gap-2 px-3 py-2 w-100">
                <i class="fas fa-<?= $flash['type'] === 'success' ? 'check-circle' : 'exclamation-circle' ?>"></i>
                <span><?= sanitize($flash['msg']) ?></span>
                <button type="button" class="btn-close btn-close-white ms-auto toast-close"></button>
            </div>
        </div>
    </div>
    <?php endif; ?>
