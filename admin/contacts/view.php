<?php
$pageTitle = 'Détail de la demande';
require_once __DIR__ . '/../partials/header.php';
$db = getDB();
$id = (int)($_GET['id'] ?? 0);
$stmt = $db->prepare("SELECT * FROM contacts WHERE id=? LIMIT 1");
$stmt->execute([$id]);
$c = $stmt->fetch();
if (!$c) { header('Location: index.php'); exit; }

if ($c['status'] === 'new') {
    $db->prepare("UPDATE contacts SET status='read' WHERE id=?")->execute([$id]);
}
?>
<a href="index.php?status=<?= sanitize($_GET['from']??'new') ?>" class="btn btn-sm btn-outline-brand mb-3"><i class="fas fa-arrow-left me-1"></i>Retour</a>
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Détails de la demande</span>
                <span class="badge bg-<?= $c['status']==='new'?'danger':($c['status']==='read'?'secondary':($c['status']==='replied'?'info':'warning')) ?> fs-6">
                    <?= $c['status'] ?>
                </span>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr><th style="width:200px">Société / Nom</th><td><?= sanitize($c['company_name'] ?? '—') ?></td></tr>
                    <tr><th>Email</th><td><a href="mailto:<?= sanitize($c['email']) ?>"><?= sanitize($c['email'] ?? '—') ?></a></td></tr>
                    <tr><th>Téléphone</th><td><a href="tel:<?= sanitize($c['phone']) ?>"><?= sanitize($c['phone'] ?? '—') ?></a></td></tr>
                    <tr><th>Adresse du projet</th><td><?= sanitize($c['project_address'] ?? '—') ?></td></tr>
                    <tr><th>Type de projet</th><td>
                        <?php
                        $types = json_decode($c['project_type'] ?? '[]', true);
                        if (is_array($types) && !empty($types)): foreach ($types as $t):
                            echo '<span class="badge bg-brand me-1">' . sanitize($t) . '</span>';
                        endforeach; else: echo '—'; endif;
                        ?>
                    </td></tr>
                    <tr><th>Propriétaire terrain</th><td><?= sanitize($c['land_owner'] ?? '—') ?></td></tr>
                    <tr><th>Adresse du terrain</th><td><?= sanitize($c['land_address'] ?? '—') ?></td></tr>
                    <tr><th>Superficie terrain</th><td><?= sanitize($c['land_area'] ?? '—') ?></td></tr>
                    <tr><th>Statut administratif</th><td><?= sanitize($c['admin_status'] ?? '—') ?></td></tr>
                    <tr><th>Nature du bâtiment</th><td><?= sanitize($c['building_nature'] ?? '—') ?></td></tr>
                    <tr><th>Année construction</th><td><?= sanitize($c['construction_year'] ?? '—') ?></td></tr>
                    <tr><th>Superficie actuelle</th><td><?= sanitize($c['current_area'] ?? '—') ?></td></tr>
                    <tr><th>Type de construction</th><td><?= sanitize($c['construction_type'] ?? '—') ?></td></tr>
                    <tr><th>Budget estimé</th><td><?= sanitize($c['estimated_budget'] ?? '—') ?></td></tr>
                    <tr><th>Délais souhaités</th><td><?= sanitize($c['desired_deadline'] ?? '—') ?></td></tr>
                    <tr><th>Message</th><td><?= nl2br(sanitize($c['message'] ?? '—')) ?></td></tr>
                    <tr><th>Date de soumission</th><td><?= date('d/m/Y à H:i', strtotime($c['created_at'])) ?></td></tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">Actions</div>
            <div class="card-body d-flex flex-column gap-2">
                <?php if ($c['status'] !== 'replied'): ?>
                <a href="status.php?id=<?= $c['id'] ?>&status=replied" class="btn btn-brand w-100"><i class="fas fa-check me-1"></i>Marquer répondue</a>
                <?php endif; ?>
                <?php if ($c['status'] !== 'archived'): ?>
                <a href="status.php?id=<?= $c['id'] ?>&status=archived" class="btn btn-outline-secondary w-100"><i class="fas fa-archive me-1"></i>Archiver</a>
                <?php endif; ?>
                <a href="mailto:<?= sanitize($c['email']) ?>" class="btn btn-outline-brand w-100"><i class="fas fa-reply me-1"></i>Répondre par email</a>
                <a href="tel:<?= sanitize($c['phone']) ?>" class="btn btn-outline-success w-100"><i class="fas fa-phone me-1"></i>Appeler</a>
                <a href="delete.php?id=<?= $c['id'] ?>" class="btn btn-outline-danger w-100 btn-confirm-delete"><i class="fas fa-trash me-1"></i>Supprimer</a>
            </div>
        </div>
    </div>
</div>
<?php require_once __DIR__ . '/../partials/footer.php'; ?>
