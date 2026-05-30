<?php
$pageTitle = 'Services';
require_once __DIR__ . '/../partials/header.php';
$db = getDB();
$sections = ['etude' => 'Étude & Conception', 'construction' => 'Construction & Réalisation', 'gestion' => 'Gestion & Suivi'];
$allServices = $db->query("SELECT * FROM services WHERE active=1 ORDER BY field(section,'etude','construction','gestion'), order_index ASC")->fetchAll();
$services = [];
foreach ($allServices as $s) {
    $services[$s['section']][] = $s;
}
?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="fas fa-wrench me-2"></i>Services</span>
        <button class="btn btn-brand btn-sm" data-bs-toggle="modal" data-bs-target="#createModal"><i class="fas fa-plus me-1"></i>Nouveau</button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>Icône</th><th>Titre</th><th>Section</th><th>Résumé</th><th>Ordre</th><th>Actions</th></tr></thead>
                <tbody>
                    <?php foreach ($sections as $key => $label):
                    $sectionServices = $services[$key] ?? [];
                    foreach ($sectionServices as $s): ?>
                    <tr>
                        <td class="fs-5" style="color:#312783"><i class="fas fa-<?= sanitize($s['icon']) ?>"></i></td>
                        <td><strong><?= sanitize($s['title']) ?></strong></td>
                        <td><span class="badge bg-brand"><?= $label ?></span></td>
                        <td class="text-muted small"><?= mb_substr(strip_tags($s['summary'] ?? ''), 0, 60) ?>...</td>
                        <td><?= $s['order_index'] ?></td>
                        <td class="table-actions">
                            <button class="btn btn-sm btn-outline-brand" data-bs-toggle="modal" data-bs-target="#editModal<?= $s['id'] ?>"><i class="fas fa-edit"></i></button>
                            <a href="delete.php?id=<?= $s['id'] ?>" class="btn btn-sm btn-outline-danger btn-confirm-delete"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <div class="modal fade" id="editModal<?= $s['id'] ?>" tabindex="-1">
                        <div class="modal-dialog"><div class="modal-content">
                            <form method="post" action="edit.php">
                                <input type="hidden" name="id" value="<?= $s['id'] ?>">
                                <div class="modal-header"><h5 class="modal-title">Modifier : <?= sanitize($s['title']) ?></h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                                <div class="modal-body">
                                    <div class="mb-3"><label class="form-label">Titre</label><input name="title" class="form-control" value="<?= sanitize($s['title']) ?>" required></div>
                                    <div class="mb-3"><label class="form-label">Slug</label><input name="slug" class="form-control" value="<?= sanitize($s['slug']) ?>"></div>
                                    <div class="mb-3"><label class="form-label">Section</label>
                                        <select name="section" class="form-select"><?php foreach ($sections as $sk => $sl): ?><option value="<?= $sk ?>" <?= $sk === $s['section'] ? 'selected' : '' ?>><?= $sl ?></option><?php endforeach; ?></select>
                                    </div>
                                    <div class="mb-3"><label class="form-label">Icône (Font Awesome, ex: "hard-hat")</label><input name="icon" class="form-control" value="<?= sanitize($s['icon']) ?>"></div>
                                    <div class="mb-3"><label class="form-label">Résumé</label><textarea name="summary" class="form-control" rows="3"><?= sanitize($s['summary'] ?? '') ?></textarea></div>
                                    <div class="mb-3"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="5"><?= sanitize($s['description'] ?? '') ?></textarea></div>
                                    <div class="mb-3"><label class="form-label">Ordre</label><input name="order_index" type="number" class="form-control" value="<?= $s['order_index'] ?>"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-brand">Enregistrer</button>
                                </div>
                            </form>
                        </div></div>
                    </div>
                    <?php endforeach; endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog"><div class="modal-content">
        <form method="post" action="create.php">
            <div class="modal-header"><h5 class="modal-title">Nouveau Service</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <div class="mb-3"><label class="form-label">Titre</label><input name="title" class="form-control" required></div>
                <div class="mb-3"><label class="form-label">Slug</label><input name="slug" class="form-control" placeholder="Auto-généré si vide"></div>
                <div class="mb-3"><label class="form-label">Section</label>
                    <select name="section" class="form-select"><?php foreach ($sections as $sk => $sl): ?><option value="<?= $sk ?>"><?= $sl ?></option><?php endforeach; ?></select>
                </div>
                <div class="mb-3"><label class="form-label">Icône (Font Awesome)</label><input name="icon" class="form-control"></div>
                <div class="mb-3"><label class="form-label">Résumé</label><textarea name="summary" class="form-control" rows="3"></textarea></div>
                <div class="mb-3"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="5"></textarea></div>
                <div class="mb-3"><label class="form-label">Ordre</label><input name="order_index" type="number" class="form-control" value="0"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-brand">Créer</button>
            </div>
        </form>
    </div></div>
</div>
<?php require_once __DIR__ . '/../partials/footer.php'; ?>
