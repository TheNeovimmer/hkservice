<?php
$pageTitle = 'Demandes de contact';
require_once __DIR__ . '/../partials/header.php';
$db = getDB();

$status = $_GET['status'] ?? 'new';
$allowed = ['new','read','replied','archived','all'];
if (!in_array($status, $allowed)) $status = 'new';

$where = $status === 'all' ? '' : 'WHERE status=?';
$sql = "SELECT * FROM contacts $where ORDER BY created_at DESC";
$stmt = $db->prepare($sql);
$params = $status === 'all' ? [] : [$status];
$stmt->execute($params);
$contacts = $stmt->fetchAll();

$counts = $db->query("SELECT status, COUNT(*) as c FROM contacts GROUP BY status")->fetchAll();
$countMap = ['new'=>0,'read'=>0,'replied'=>0,'archived'=>0];
foreach ($counts as $r) $countMap[$r['status']] = $r['c'];
$total = array_sum($countMap);
?>
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <h4 class="mb-0">Demandes de contact</h4>
</div>
<div class="card">
    <div class="card-body p-0">
        <ul class="nav nav-tabs px-3 pt-2">
            <li class="nav-item"><a class="nav-link <?= $status==='new'?'active':'' ?>" href="?status=new">Nouvelles <?= $countMap['new']?'<span class="badge bg-danger ms-1">'.$countMap['new'].'</span>':'' ?></a></li>
            <li class="nav-item"><a class="nav-link <?= $status==='read'?'active':'' ?>" href="?status=read">Lues <?= $countMap['read']?'<span class="badge bg-secondary ms-1">'.$countMap['read'].'</span>':'' ?></a></li>
            <li class="nav-item"><a class="nav-link <?= $status==='replied'?'active':'' ?>" href="?status=replied">Répondues <?= $countMap['replied']?'<span class="badge bg-info ms-1">'.$countMap['replied'].'</span>':'' ?></a></li>
            <li class="nav-item"><a class="nav-link <?= $status==='archived'?'active':'' ?>" href="?status=archived">Archivées <?= $countMap['archived']?'<span class="badge bg-warning ms-1">'.$countMap['archived'].'</span>':'' ?></a></li>
            <li class="nav-item"><a class="nav-link <?= $status==='all'?'active':'' ?>" href="?status=all">Toutes <span class="badge bg-dark ms-1"><?= $total ?></span></a></li>
        </ul>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Société / Nom</th>
                        <th>Contact</th>
                        <th>Type de projet</th>
                        <th>Statut</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($contacts)): ?>
                    <tr><td colspan="6" class="text-center text-muted py-4">Aucune demande <?= $status==='all'?'':$status ?></td></tr>
                    <?php endif; ?>
                    <?php foreach ($contacts as $c): ?>
                    <tr class="<?= $c['status']==='new'?'table-primary':'' ?>">
                        <td class="text-nowrap"><small><?= date('d/m/Y H:i', strtotime($c['created_at'])) ?></small></td>
                        <td><strong><?= sanitize($c['company_name'] ?? '—') ?></strong></td>
                        <td>
                            <small><?= sanitize($c['email'] ?? '') ?></small><br>
                            <small><?= sanitize($c['phone'] ?? '') ?></small>
                        </td>
                        <td>
                            <?php
                            $types = json_decode($c['project_type'] ?? '[]', true);
                            if (is_array($types)): foreach ($types as $t): ?>
                                <span class="badge bg-brand me-1"><?= sanitize($t) ?></span>
                            <?php endforeach; endif; ?>
                        </td>
                        <td>
                            <span class="badge bg-<?= $c['status']==='new'?'danger':($c['status']==='read'?'secondary':($c['status']==='replied'?'info':'warning')) ?>">
                                <?= $c['status'] ?>
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="view.php?id=<?= $c['id'] ?>" class="btn btn-sm btn-outline-brand"><i class="fas fa-eye"></i></a>
                            <a href="delete.php?id=<?= $c['id'] ?>" class="btn btn-sm btn-outline-danger btn-confirm-delete"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require_once __DIR__ . '/../partials/footer.php'; ?>
