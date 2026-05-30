<?php
require_once __DIR__ . '/includes/helpers.php';
require_once __DIR__ . '/includes/db.php';

$isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    if ($isAjax) { header('Content-Type: application/json'); echo '{"ok":false}'; exit; }
    header('Location: contact.php'); exit;
}

$errors = [];

$from_name     = trim($_POST['from_name'] ?? '');
$email_id      = trim($_POST['email_id'] ?? '');
$tel           = trim($_POST['tel'] ?? '');
$Lieu          = trim($_POST['Lieu'] ?? '');
$services      = $_POST['service'] ?? [];
$proprietaire  = trim($_POST['proprietaire_terrain'] ?? '');
$adresse_terrain = trim($_POST['adresse_terrain'] ?? '');
$superficie_terrain = trim($_POST['superficie_terrain'] ?? '');
$statut_admin  = trim($_POST['statut_administratif'] ?? '');
$nature_bat    = trim($_POST['nature_batiment'] ?? '');
$annee_const   = trim($_POST['annee_construction'] ?? '');
$superficie_act = trim($_POST['superficie_actuelle'] ?? '');
$type_const    = trim($_POST['type_construction'] ?? '');
$budget        = trim($_POST['budget_estime'] ?? '');
$delais        = trim($_POST['delais_souhaite'] ?? '');
$message       = trim($_POST['message'] ?? '');

if ($from_name === '') $errors[] = 'Le nom ou la societe est requis.';
if ($tel === '') $errors[] = 'Le numero de telephone est requis.';
if ($email_id !== '' && !filter_var($email_id, FILTER_VALIDATE_EMAIL)) $errors[] = "L'adresse email n'est pas valide.";

if (!empty($errors)) {
    $errorStr = implode(' | ', $errors);
    if ($isAjax) {
        header('Content-Type: application/json');
        echo json_encode(['ok' => false, 'error' => $errorStr]);
        exit;
    }
    header('Location: contact.php?error=' . urlencode($errorStr));
    exit;
}

try {
    $db = getDB();
    $stmt = $db->prepare("INSERT INTO contacts (company_name, email, phone, project_address, project_type, land_owner, land_address, land_area, admin_status, building_nature, construction_year, current_area, construction_type, estimated_budget, desired_deadline, message, status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,'new')");

    $stmt->execute([
        $from_name,
        $email_id,
        $tel,
        $Lieu,
        json_encode($services),
        $proprietaire,
        $adresse_terrain,
        $superficie_terrain,
        $statut_admin,
        $nature_bat,
        $annee_const,
        $superficie_act,
        $type_const,
        $budget,
        $delais,
        $message,
    ]);

    if ($isAjax) {
        header('Content-Type: application/json');
        echo json_encode(['ok' => true, 'message' => 'Votre message a ete envoye avec succes !']);
        exit;
    }
    header('Location: contact.php?sent=ok');
} catch (Throwable $e) {
    if ($isAjax) {
        header('Content-Type: application/json');
        echo json_encode(['ok' => false, 'error' => $e->getMessage()]);
        exit;
    }
    header('Location: contact.php?error=' . urlencode($e->getMessage()));
}
exit;
