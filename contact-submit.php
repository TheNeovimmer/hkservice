<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/includes/helpers.php';
require_once __DIR__ . '/includes/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: contact.php');
    exit;
}

try {
    $db = getDB();
    $stmt = $db->prepare("INSERT INTO contacts (company_name, email, phone, project_address, project_type, land_owner, land_address, land_area, admin_status, building_nature, construction_year, current_area, construction_type, estimated_budget, desired_deadline, message, status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,'new')");

    $stmt->execute([
        sanitize($_POST['from_name'] ?? ''),
        sanitize($_POST['email_id'] ?? ''),
        sanitize($_POST['tel'] ?? ''),
        sanitize($_POST['Lieu'] ?? ''),
        json_encode($_POST['service'] ?? []),
        sanitize($_POST['proprietaire_terrain'] ?? ''),
        sanitize($_POST['adresse_terrain'] ?? ''),
        sanitize($_POST['superficie_terrain'] ?? ''),
        sanitize($_POST['statut_administratif'] ?? ''),
        sanitize($_POST['nature_batiment'] ?? ''),
        sanitize($_POST['annee_construction'] ?? ''),
        sanitize($_POST['superficie_actuelle'] ?? ''),
        sanitize($_POST['type_construction'] ?? ''),
        sanitize($_POST['budget_estime'] ?? ''),
        sanitize($_POST['delais_souhaite'] ?? ''),
        sanitize($_POST['message'] ?? ''),
    ]);

    header('Location: contact.php?sent=ok');
} catch (Throwable $e) {
    header('Location: contact.php?error=' . urlencode($e->getMessage()));
}
exit;
