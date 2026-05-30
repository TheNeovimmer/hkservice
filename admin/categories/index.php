<?php
$pageTitle = 'Catégories';
require_once __DIR__ . '/../partials/header.php';
$db = getDB();
$categories = $db->query("SELECT c.*, (SELECT COUNT(*) FROM products WHERE category_id=c.id) as product_count FROM categories c ORDER BY c.order_index ASC")->fetchAll();
?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="fas fa-tags me-2"></i>Catégories</span>
        <button class="btn btn-brand btn-sm" data-bs-toggle="modal" data-bs-target="#createModal"><i class="fas fa-plus me-1"></i>Nouvelle</button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>ID</th><th>Icône</th><th>Nom</th><th>Slug</th><th>Ordre</th><th>Produits</th><th>Actions</th></tr></thead>
                <tbody>
                    <?php foreach ($categories as $c): ?>
                    <tr>
                        <td><?= $c['id'] ?></td>
                        <td class="fs-5" style="color:#312783"><i class="fas fa-<?= sanitize($c['icon']) ?>"></i></td>
                        <td><strong><?= sanitize($c['name']) ?></strong></td>
                        <td><code><?= sanitize($c['slug']) ?></code></td>
                        <td><?= $c['order_index'] ?></td>
                        <td><span class="badge bg-light text-dark"><?= $c['product_count'] ?></span></td>
                        <td class="table-actions">
                            <button class="btn btn-sm btn-outline-brand" data-bs-toggle="modal" data-bs-target="#editModal<?= $c['id'] ?>"><i class="fas fa-edit"></i></button>
                            <a href="delete.php?id=<?= $c['id'] ?>" class="btn btn-sm btn-outline-danger btn-confirm-delete"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <div class="modal fade" id="editModal<?= $c['id'] ?>" tabindex="-1">
                        <div class="modal-dialog"><div class="modal-content">
                            <form method="post" action="edit.php">
                                <input type="hidden" name="id" value="<?= $c['id'] ?>">
                                <div class="modal-header"><h5 class="modal-title">Modifier : <?= sanitize($c['name']) ?></h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                                <div class="modal-body">
                                    <div class="mb-3"><label class="form-label">Nom</label><input name="name" class="form-control" value="<?= sanitize($c['name']) ?>" required></div>
                                    <div class="mb-3"><label class="form-label">Slug</label><input name="slug" class="form-control" value="<?= sanitize($c['slug']) ?>"></div>
                                    <div class="mb-3"><label class="form-label">Icône (Font Awesome, ex: "hammer")</label><input name="icon" class="form-control" value="<?= sanitize($c['icon']) ?>"></div>
                                    <div class="mb-3"><label class="form-label">Ordre</label><input name="order_index" type="number" class="form-control" value="<?= $c['order_index'] ?>"></div>
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
            <div class="modal-header"><h5 class="modal-title">Nouvelle Catégorie</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <div class="mb-3"><label class="form-label">Nom</label><input name="name" class="form-control" required></div>
                <div class="mb-3"><label class="form-label">Slug (laisser vide pour auto-génération)</label><input name="slug" class="form-control"></div>
                <div class="mb-3"><label class="form-label">Icône (Font Awesome, ex: "hammer")</label><input name="icon" class="form-control"></div>
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
