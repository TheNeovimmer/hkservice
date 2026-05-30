<?php
$pageTitle = 'Produits';
require_once __DIR__ . '/../partials/header.php';
$db = getDB();
$products = $db->query("SELECT p.*, c.name as cat FROM products p LEFT JOIN categories c ON c.id=p.category_id ORDER BY p.id DESC")->fetchAll();
$categories = $db->query("SELECT * FROM categories ORDER BY name ASC")->fetchAll();
?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="fas fa-box me-2"></i>Produits (<?= count($products) ?>)</span>
        <button class="btn btn-brand btn-sm" data-bs-toggle="modal" data-bs-target="#createModal"><i class="fas fa-plus me-1"></i>Nouveau</button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead><tr><th>Image</th><th>Nom</th><th>Catégorie</th><th>Prix</th><th>Badge</th><th>Actions</th></tr></thead>
                <tbody>
                    <?php foreach ($products as $p):
                    $colors = json_decode($p['colors'] ?? '[]', true);
                    ?>
                    <tr>
                        <td>
                            <?php if ($p['image'] && file_exists(__DIR__ . '/../../' . $p['image'])): ?>
                            <img src="<?= BASE_PATH ?>/<?= $p['image'] ?>" class="img-thumb-sm">
                            <?php else: ?>
                            <div class="img-thumb-sm d-flex align-items-center justify-content-center bg-light rounded text-muted"><i class="fas fa-image"></i></div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <strong><?= sanitize($p['name']) ?></strong>
                            <?php if (!empty($colors)): ?>
                            <div class="swatch-list mt-1"><?php foreach ($colors as $c): ?><span class="color-swatch"><span class="dot" style="background:<?= $c['hex'] ?>"></span></span><?php endforeach; ?></div>
                            <?php endif; ?>
                        </td>
                        <td><?= sanitize($p['cat']) ?></td>
                        <td><strong><?= number_format($p['price_eur'], 2) ?> €</strong></td>
                        <td>
                            <?php if ($p['badge_type'] && $p['badge_type'] !== 'none'): ?>
                            <span class="badge bg-<?= $p['badge_type'] === 'nouveau' ? 'info' : ($p['badge_type'] === 'promotion' ? 'danger' : 'success') ?>"><?= ucfirst($p['badge_type']) ?></span>
                            <?php else: ?><span class="text-muted small">—</span><?php endif; ?>
                            <?php if ($p['featured']): ?><i class="fas fa-star text-warning ms-1" title="Mis en avant"></i><?php endif; ?>
                        </td>
                        <td class="table-actions">
                            <button class="btn btn-sm btn-outline-brand" data-bs-toggle="modal" data-bs-target="#editModal<?= $p['id'] ?>"><i class="fas fa-edit"></i></button>
                            <a href="delete.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-outline-danger btn-confirm-delete"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <div class="modal fade" id="editModal<?= $p['id'] ?>" tabindex="-1">
                        <div class="modal-dialog modal-lg"><div class="modal-content">
                            <form method="post" action="edit.php" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                <input type="hidden" name="existing_image" value="<?= $p['image'] ?>">
                                <div class="modal-header"><h5 class="modal-title">Modifier : <?= sanitize($p['name']) ?></h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                                <div class="modal-body">
                                    <div class="row g-3">
                                        <div class="col-md-6"><label class="form-label">Nom</label><input name="name" class="form-control" value="<?= sanitize($p['name']) ?>" required></div>
                                        <div class="col-md-6"><label class="form-label">Slug</label><input name="slug" class="form-control" value="<?= sanitize($p['slug']) ?>"></div>
                                        <div class="col-md-6"><label class="form-label">Catégorie</label>
                                            <select name="category_id" class="form-select"><?php foreach ($categories as $c): ?><option value="<?= $c['id'] ?>" <?= $c['id'] == $p['category_id'] ? 'selected' : '' ?>><?= sanitize($c['name']) ?></option><?php endforeach; ?></select>
                                        </div>
                                        <div class="col-md-3"><label class="form-label">Prix (€)</label><input name="price" type="number" step="0.01" class="form-control" value="<?= $p['price_eur'] ?>"></div>
                                        <div class="col-12"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="3"><?= sanitize($p['description']) ?></textarea></div>
                                        <div class="col-md-4"><label class="form-label">Badge</label>
                                            <select name="badge_type" class="form-select"><option value="none" <?= $p['badge_type'] === 'none' ? 'selected' : '' ?>>Aucun</option><option value="nouveau" <?= $p['badge_type'] === 'nouveau' ? 'selected' : '' ?>>Nouveau</option><option value="populaire" <?= $p['badge_type'] === 'populaire' ? 'selected' : '' ?>>Populaire</option><option value="promotion" <?= $p['badge_type'] === 'promotion' ? 'selected' : '' ?>>Promotion</option></select>
                                        </div>
                                        <div class="col-md-4"><label class="form-label">Ordre</label><input name="order_index" type="number" class="form-control" value="<?= $p['order_index'] ?>"></div>
                                        <div class="col-md-4 d-flex align-items-end gap-3 pb-2">
                                            <div class="form-check"><input class="form-check-input" type="checkbox" name="featured" id="feat<?= $p['id'] ?>" <?= $p['featured'] ? 'checked' : '' ?>><label class="form-check-label" for="feat<?= $p['id'] ?>">Mis en avant</label></div>
                                            <div class="form-check"><input class="form-check-input" type="checkbox" name="active" id="act<?= $p['id'] ?>" <?= $p['active'] ? 'checked' : '' ?>><label class="form-check-label" for="act<?= $p['id'] ?>">Actif</label></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="upload-group">
                                                <label class="form-label">Image</label>
                                                <input type="file" name="image" class="form-control upload-input" accept="image/*">
                                                <?php if ($p['image']): ?><img src="<?= BASE_PATH ?>/<?= $p['image'] ?>" class="upload-preview d-block"><?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Couleurs / Variantes</label>
                                            <input type="hidden" name="colors" id="colorsInput<?= $p['id'] ?>" value='<?= htmlspecialchars($p['colors'] ?? '[]', ENT_QUOTES) ?>'>
                                            <div class="d-flex gap-2 mb-2">
                                                <input type="color" id="newColorHex<?= $p['id'] ?>" value="#312783" class="form-control form-control-color" style="width:50px">
                                                <input type="text" id="newColorName<?= $p['id'] ?>" placeholder="Nom" class="form-control form-control-sm">
                                                <button type="button" class="btn btn-sm btn-outline-brand" onclick="addColorSwatch('swatch<?= $p['id'] ?>','colorsInput<?= $p['id'] ?>','newColorHex<?= $p['id'] ?>','newColorName<?= $p['id'] ?>')">+</button>
                                            </div>
                                            <div id="swatch<?= $p['id'] ?>"></div>
                                            <script>renderColorSwatches('swatch<?= $p['id'] ?>','colorsInput<?= $p['id'] ?>');</script>
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
            <div class="modal-header"><h5 class="modal-title">Nouveau Produit</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label">Nom</label><input name="name" class="form-control" required></div>
                    <div class="col-md-6"><label class="form-label">Slug</label><input name="slug" class="form-control" placeholder="Auto-généré si vide"></div>
                    <div class="col-md-6"><label class="form-label">Catégorie</label>
                        <select name="category_id" class="form-select"><?php foreach ($categories as $c): ?><option value="<?= $c['id'] ?>"><?= sanitize($c['name']) ?></option><?php endforeach; ?></select>
                    </div>
                    <div class="col-md-3"><label class="form-label">Prix (€)</label><input name="price" type="number" step="0.01" class="form-control" value="0"></div>
                    <div class="col-12"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="3"></textarea></div>
                    <div class="col-md-4"><label class="form-label">Badge</label>
                        <select name="badge_type" class="form-select"><option value="none">Aucun</option><option value="nouveau">Nouveau</option><option value="populaire">Populaire</option><option value="promotion">Promotion</option></select>
                    </div>
                    <div class="col-md-4"><label class="form-label">Ordre</label><input name="order_index" type="number" class="form-control" value="0"></div>
                    <div class="col-md-4 d-flex align-items-end gap-3 pb-2">
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="featured" id="featNew"><label class="form-check-label" for="featNew">Mis en avant</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="active" id="actNew" checked><label class="form-check-label" for="actNew">Actif</label></div>
                    </div>
                    <div class="col-md-6">
                        <div class="upload-group">
                            <label class="form-label">Image</label>
                            <input type="file" name="image" class="form-control upload-input" accept="image/*">
                            <img class="upload-preview d-none">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Couleurs / Variantes</label>
                        <input type="hidden" name="colors" id="colorsInputNew" value="[]">
                        <div class="d-flex gap-2 mb-2">
                            <input type="color" id="newColorHexNew" value="#312783" class="form-control form-control-color" style="width:50px">
                            <input type="text" id="newColorNameNew" placeholder="Nom" class="form-control form-control-sm">
                            <button type="button" class="btn btn-sm btn-outline-brand" onclick="addColorSwatch('swatchNew','colorsInputNew','newColorHexNew','newColorNameNew')">+</button>
                        </div>
                        <div id="swatchNew"></div>
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
