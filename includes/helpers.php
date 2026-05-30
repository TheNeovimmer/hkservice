<?php
$projectRoot = dirname(__DIR__);
$docRoot = $_SERVER['DOCUMENT_ROOT'];
$basePath = rtrim(str_replace('\\', '/', substr($projectRoot, strlen($docRoot))), '/');
define('BASE_PATH', $basePath);

function slugify($text): string {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    $text = strtolower($text);
    return $text ?: 'n-a';
}

function uploadImage($file, $subdir = 'products'): ?string {
    if ($file['error'] !== UPLOAD_ERR_OK) return null;
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    if (!in_array($ext, $allowed)) return null;
    $filename = uniqid() . '.' . $ext;
    $dest = UPLOAD_DIR . $subdir . '/' . $filename;
    if (!is_dir(dirname($dest))) mkdir(dirname($dest), 0755, true);
    move_uploaded_file($file['tmp_name'], $dest);
    return 'uploads/' . $subdir . '/' . $filename;
}

function uploadFile($file, $subdir = 'catalog'): ?string {
    if ($file['error'] !== UPLOAD_ERR_OK) return null;
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $allowed = ['pdf', 'jpg', 'jpeg', 'png', 'gif', 'webp'];
    if (!in_array($ext, $allowed)) return null;
    $filename = uniqid() . '.' . $ext;
    $dest = UPLOAD_DIR . $subdir . '/' . $filename;
    if (!is_dir(dirname($dest))) mkdir(dirname($dest), 0755, true);
    move_uploaded_file($file['tmp_name'], $dest);
    return 'uploads/' . $subdir . '/' . $filename;
}

function uploadMultiple($files, $subdir = 'projects'): array {
    $uploaded = [];
    $total = count($files['name']);
    for ($i = 0; $i < $total; $i++) {
        $file = [
            'name' => $files['name'][$i],
            'type' => $files['type'][$i],
            'tmp_name' => $files['tmp_name'][$i],
            'error' => $files['error'][$i],
            'size' => $files['size'][$i],
        ];
        $path = uploadFile($file, $subdir);
        if ($path) $uploaded[] = $path;
    }
    return ['files' => $uploaded];
}

function deleteFile($path): void {
    if ($path && file_exists(__DIR__ . '/../' . $path)) {
        unlink(__DIR__ . '/../' . $path);
    }
}

function sanitize($input): string {
    return htmlspecialchars(trim((string)$input), ENT_QUOTES, 'UTF-8');
}

function formatPrice($amount): string {
    return number_format((float)$amount, 3, ',', ' ');
}

function formatEur($amount): string {
    return number_format((float)$amount, 2, ',', ' ');
}

function formatTnd($amount): string {
    return number_format((float)$amount, 3, ',', ' ');
}

function setFlash($type, $msg): void {
    if ($type === 'success') $_SESSION['flash_success'] = $msg;
    else $_SESSION['flash_error'] = $msg;
}

function successMsg($msg): void {
    $_SESSION['flash_success'] = $msg;
}

function errorMsg($msg): void {
    $_SESSION['flash_error'] = $msg;
}

function getFlash(): ?array {
    if (isset($_SESSION['flash_success'])) {
        $msg = $_SESSION['flash_success'];
        unset($_SESSION['flash_success']);
        return ['type' => 'success', 'msg' => $msg];
    }
    if (isset($_SESSION['flash_error'])) {
        $msg = $_SESSION['flash_error'];
        unset($_SESSION['flash_error']);
        return ['type' => 'error', 'msg' => $msg];
    }
    return null;
}
