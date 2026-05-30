<?php
$pageTitle = 'Catalogue';
require_once __DIR__ . '/../partials/header.php';
$db = getDB();
$items = $db->query("SELECT * FROM catalog_items ORDER BY order_index ASC")->fetchAll();
?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="fas fa-book me-2"></i>Catalogue</span>
        <button class="btn btn-brand btn-sm" data-bs-toggle="modal" data-bs-target="#createModal"><i class="fas fa-plus me-1"></i>Nouveau</button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>Titre</th><th>Type</th><th>Ordre</th><th>Actif</th><th>Actions</th></tr></thead>
                <tbody>
                    <?php foreach ($items as $item): ?>
                    <tr>
                        <td><strong><?= sanitize($item['title']) ?></strong></td>
                        <td><span class="badge bg-<?= $item['file_type'] === 'flipbook' ? 'info' : ($item['file_type'] === 'pdf' ? 'danger' : 'secondary') ?>"><?= $item['file_type'] ?></span></td>
                        <td><?= $item['order_index'] ?></td>
                        <td><?= $item['active'] ? '<i class="fas fa-check-circle text-success"></i>' : '<i class="fas fa-times-circle text-muted"></i>' ?></td>
                        <td class="table-actions">
                            <button class="btn btn-sm btn-outline-brand" data-bs-toggle="modal" data-bs-target="#editModal<?= $item['id'] ?>"><i class="fas fa-edit"></i></button>
                            <a href="delete.php?id=<?= $item['id'] ?>" class="btn btn-sm btn-outline-danger btn-confirm-delete"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <div class="modal fade" id="editModal<?= $item['id'] ?>" tabindex="-1">
                        <div class="modal-dialog"><div class="modal-content">
                            <form method="post" action="edit.php">
                                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                <div class="modal-header"><h5 class="modal-title">Modifier : <?= sanitize($item['title']) ?></h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                                <div class="modal-body">
                                    <div class="mb-3"><label class="form-label">Titre</label><input name="title" class="form-control" value="<?= sanitize($item['title']) ?>" required></div>
                                    <div class="mb-3"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="2"><?= sanitize($item['description'] ?? '') ?></textarea></div>
                                    <div class="mb-3"><label class="form-label">Type</label>
                                        <select name="file_type" class="form-select"><option value="flipbook" <?= $item['file_type'] === 'flipbook' ? 'selected' : '' ?>>Flipbook</option><option value="pdf" <?= $item['file_type'] === 'pdf' ? 'selected' : '' ?>>PDF</option><option value="link" <?= $item['file_type'] === 'link' ? 'selected' : '' ?>>Lien externe</option></select>
                                    </div>
                                    <div class="mb-3"><label class="form-label">URL</label><input name="file_url" class="form-control" value="<?= sanitize($item['file_url']) ?>"></div>
                                    <div class="row">
                                        <div class="col-md-6"><label class="form-label">Ordre</label><input name="order_index" type="number" class="form-control" value="<?= $item['order_index'] ?>"></div>
                                        <div class="col-md-6 d-flex align-items-end pb-2">
                                            <div class="form-check"><input class="form-check-input" type="checkbox" name="active" id="act<?= $item['id'] ?>" <?= $item['active'] ? 'checked' : '' ?>><label class="form-check-label" for="act<?= $item['id'] ?>">Actif</label></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-brand">Enregistrer</button>
                                </div>
                            </form>
                        </div></div>
                    </div>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog"><div class="modal-content">
        <form method="post" action="create.php">
            <div class="modal-header"><h5 class="modal-title">Nouvel Élément</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <div class="mb-3"><label class="form-label">Titre</label><input name="title" class="form-control" required></div>
                <div class="mb-3"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="2"></textarea></div>
                <div class="mb-3"><label class="form-label">Type</label>
                    <select name="file_type" class="form-select"><option value="flipbook">Flipbook</option><option value="pdf">PDF</option><option value="link">Lien externe</option></select>
                </div>
                <div class="mb-3"><label class="form-label">URL</label><input name="file_url" class="form-control"></div>
                <div class="row">
                    <div class="col-md-6"><label class="form-label">Ordre</label><input name="order_index" type="number" class="form-control" value="0"></div>
                    <div class="col-md-6 d-flex align-items-end pb-2">
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="active" id="actNew" checked><label class="form-check-label" for="actNew">Actif</label></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-brand">Créer</button>
            </div>
        </form>
    </div></div>
</div>
<?php require_once __DIR__ . '/../partials/footer.php'; ?>
