<?php
$pageTitle = 'Projets';
require_once __DIR__ . '/../partials/header.php';
$db = getDB();
$projects = $db->query("SELECT * FROM projects WHERE active=1 ORDER BY order_index ASC, id DESC")->fetchAll();
$projectCategories = ['villas', 'toitures', 'immeubles', 'renovations', 'amenagement', 'commercial'];
?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="fas fa-building me-2"></i>Projets</span>
        <button class="btn btn-brand btn-sm" data-bs-toggle="modal" data-bs-target="#createModal"><i class="fas fa-plus me-1"></i>Nouveau</button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>Image</th><th>Titre</th><th>Cat&eacute;gorie</th><th>Lieu</th><th>Surface</th><th>Ordre</th><th>Actions</th></tr></thead>
                <tbody>
                    <?php foreach ($projects as $p):
                    $images = $p['images'] ? json_decode($p['images'], true) : [];
                    $cover = $p['thumbnail'] ?: ($images[0] ?? '');
                    ?>
                    <tr>
                        <td>
                            <?php if ($cover && file_exists(__DIR__ . '/../../' . $cover)): ?>
                            <img src="<?= BASE_PATH ?>/<?= $cover ?>" class="img-thumb-sm">
                            <?php else: ?>
                            <div class="img-thumb-sm d-flex align-items-center justify-content-center bg-light rounded text-muted"><i class="fas fa-building"></i></div>
                            <?php endif; ?>
                        </td>
                        <td><strong><?= sanitize($p['title']) ?></strong></td>
                        <td><span class="badge bg-brand"><?= sanitize($p['category'] ?? 'amenagement') ?></span></td>
                        <td><?= sanitize($p['location']) ?></td>
                        <td><?= sanitize($p['surface']) ?></td>
                        <td><?= (int)$p['order_index'] ?></td>
                        <td class="table-actions">
                            <button class="btn btn-sm btn-outline-brand" data-bs-toggle="modal" data-bs-target="#editModal<?= $p['id'] ?>"><i class="fas fa-edit"></i></button>
                            <a href="delete.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-outline-danger btn-confirm-delete"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <div class="modal fade" id="editModal<?= $p['id'] ?>" tabindex="-1">
                        <div class="modal-dialog modal-lg"><div class="modal-content">
                            <form method="post" action="edit.php" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                <input type="hidden" name="existing_thumbnail" value="<?= $p['thumbnail'] ?>">
                                <div class="modal-header"><h5 class="modal-title">Modifier : <?= sanitize($p['title']) ?></h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                                <div class="modal-body">
                                    <div class="row g-3">
                                        <div class="col-md-6"><label class="form-label">Titre</label><input name="title" class="form-control" value="<?= sanitize($p['title']) ?>" required></div>
                                        <div class="col-md-6"><label class="form-label">Slug</label><input name="slug" class="form-control" value="<?= sanitize($p['slug']) ?>"></div>
                                        <div class="col-md-4">
                                            <label class="form-label">Cat&eacute;gorie</label>
                                            <select name="category" class="form-select">
                                                <?php foreach ($projectCategories as $cat): ?>
                                                <option value="<?= $cat ?>" <?= ($p['category'] ?? 'amenagement') === $cat ? 'selected' : '' ?>><?= ucfirst($cat) ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4"><label class="form-label">N&deg; de projet</label><input name="project_number" class="form-control" value="<?= sanitize($p['project_number'] ?? '') ?>" placeholder="PROJET N°X"></div>
                                        <div class="col-md-4"><label class="form-label">Ordre</label><input name="order_index" type="number" class="form-control" value="<?= (int)$p['order_index'] ?>"></div>
                                        <div class="col-md-4"><label class="form-label">Lieu</label><input name="location" class="form-control" value="<?= sanitize($p['location']) ?>"></div>
                                        <div class="col-md-4"><label class="form-label">Surface</label><input name="surface" class="form-control" value="<?= sanitize($p['surface']) ?>"></div>
                                        <div class="col-md-4"><label class="form-label">Client</label><input name="client" class="form-control" value="<?= sanitize($p['client']) ?>"></div>
                                        <div class="col-12"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="4"><?= sanitize($p['description'] ?? '') ?></textarea></div>
                                        <div class="col-md-6">
                                            <div class="upload-group">
                                                <label class="form-label">Ajouter des images</label>
                                                <input type="file" name="images[]" class="form-control upload-input" accept="image/*" multiple>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="checkbox" name="active" id="act<?= $p['id'] ?>" <?= $p['active'] ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="act<?= $p['id'] ?>">Actif</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Images existantes</label>
                                            <div class="d-flex flex-wrap gap-2">
                                                <?php foreach ($images as $idx => $img): ?>
                                                <div class="position-relative">
                                                    <img src="<?= BASE_PATH ?>/<?= $img ?>" class="img-thumb-sm border <?= $img === $p['thumbnail'] ? 'border-primary border-2' : '' ?>" title="<?= $img === $p['thumbnail'] ? 'Vignette principale' : '' ?>">
                                                </div>
                                                <?php endforeach; ?>
                                            </div>
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
    <div class="modal-dialog modal-lg"><div class="modal-content">
        <form method="post" action="create.php" enctype="multipart/form-data">
            <div class="modal-header"><h5 class="modal-title">Nouveau Projet</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label">Titre</label><input name="title" class="form-control" required></div>
                    <div class="col-md-6"><label class="form-label">Slug</label><input name="slug" class="form-control" placeholder="Auto-généré si vide"></div>
                    <div class="col-md-4">
                        <label class="form-label">Cat&eacute;gorie</label>
                        <select name="category" class="form-select">
                            <?php foreach ($projectCategories as $cat): ?>
                            <option value="<?= $cat ?>"><?= ucfirst($cat) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4"><label class="form-label">N&deg; de projet</label><input name="project_number" class="form-control" placeholder="PROJET N°X"></div>
                    <div class="col-md-4"><label class="form-label">Ordre</label><input name="order_index" type="number" class="form-control" value="0"></div>
                    <div class="col-md-4"><label class="form-label">Lieu</label><input name="location" class="form-control"></div>
                    <div class="col-md-4"><label class="form-label">Surface</label><input name="surface" class="form-control"></div>
                    <div class="col-md-4"><label class="form-label">Client</label><input name="client" class="form-control"></div>
                    <div class="col-12"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="4"></textarea></div>
                    <div class="col-md-6">
                        <div class="upload-group">
                            <label class="form-label">Images</label>
                            <input type="file" name="images[]" class="form-control upload-input" accept="image/*" multiple>
                            <div class="form-text">Sélectionnez plusieurs images. La première sera la vignette.</div>
                        </div>
                    </div>
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
