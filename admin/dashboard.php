<?php
$pageTitle = 'Dashboard';
require_once __DIR__ . '/partials/header.php';
$db = getDB();
$stats = [
    'products'   => $db->query("SELECT COUNT(*) FROM products")->fetchColumn(),
    'categories' => $db->query("SELECT COUNT(*) FROM categories")->fetchColumn(),
    'services'   => $db->query("SELECT COUNT(*) FROM services WHERE active=1")->fetchColumn(),
    'projects'   => $db->query("SELECT COUNT(*) FROM projects WHERE active=1")->fetchColumn(),
];
$catDist = $db->query("SELECT c.name, COUNT(p.id) as cnt FROM categories c LEFT JOIN products p ON p.category_id=c.id GROUP BY c.id ORDER BY cnt DESC")->fetchAll();
$recentProducts = $db->query("SELECT p.id, p.name, p.price_eur as price, c.name as cat FROM products p LEFT JOIN categories c ON c.id=p.category_id ORDER BY p.id DESC LIMIT 5")->fetchAll();
$recentProjects = $db->query("SELECT id, title, location, created_at FROM projects WHERE active=1 ORDER BY id DESC LIMIT 5")->fetchAll();
?>
<div class="row g-4 mb-4">
    <div class="col-md-3 col-6">
        <div class="stat-card" style="background:linear-gradient(135deg,#312783,#5045a8)">
            <div class="stat-icon"><i class="fas fa-box"></i></div>
            <div><div class="stat-number"><?= $stats['products'] ?></div><div class="stat-label">Produits</div></div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="stat-card" style="background:linear-gradient(135deg,#1e40af,#3b82f6)">
            <div class="stat-icon"><i class="fas fa-tags"></i></div>
            <div><div class="stat-number"><?= $stats['categories'] ?></div><div class="stat-label">Catégories</div></div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="stat-card" style="background:linear-gradient(135deg,#059669,#34d399)">
            <div class="stat-icon"><i class="fas fa-wrench"></i></div>
            <div><div class="stat-number"><?= $stats['services'] ?></div><div class="stat-label">Services</div></div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="stat-card" style="background:linear-gradient(135deg,#d97706,#fbbf24)">
            <div class="stat-icon"><i class="fas fa-building"></i></div>
            <div><div class="stat-number"><?= $stats['projects'] ?></div><div class="stat-label">Projets</div></div>
        </div>
    </div>
</div>
<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header"><i class="fas fa-chart-bar me-2"></i>Activité Mensuelle</div>
            <div class="card-body chart-container"><canvas id="barChart"></canvas></div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header"><i class="fas fa-chart-pie me-2"></i>Répartition par Catégorie</div>
            <div class="card-body chart-container" style="height:240px"><canvas id="pieChart"></canvas></div>
        </div>
    </div>
</div>
<div class="row g-4">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-box me-2"></i>Derniers Produits</span>
                <a href="<?= BASE_PATH ?>/admin/products/index.php" class="btn btn-sm btn-outline-brand">Voir tout</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead><tr><th>Produit</th><th>Catégorie</th><th>Prix</th></tr></thead>
                        <tbody>
                            <?php foreach ($recentProducts as $p): ?>
                            <tr><td><?= sanitize($p['name']) ?></td><td><?= sanitize($p['cat']) ?></td><td><?= number_format($p['price'], 2) ?> €</td></tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-building me-2"></i>Derniers Projets</span>
                <a href="<?= BASE_PATH ?>/admin/projects/index.php" class="btn btn-sm btn-outline-brand">Voir tout</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead><tr><th>Titre</th><th>Lieu</th><th>Date</th></tr></thead>
                        <tbody>
                            <?php foreach ($recentProjects as $p): ?>
                            <tr><td><?= sanitize($p['title']) ?></td><td><?= sanitize($p['location']) ?></td><td><?= date('d/m/Y', strtotime($p['created_at'])) ?></td></tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
<script>
const catLabels = <?= json_encode(array_map(fn($r) => $r['name'], $catDist)) ?>;
const catData = <?= json_encode(array_map(fn($r) => (int)$r['cnt'], $catDist)) ?>;
new Chart(document.getElementById('barChart'), {
    type: 'bar',
    data: { labels: ['Jan','Fév','Mar','Avr','Mai','Jun','Jul','Aoû','Sep','Oct','Nov','Déc'], datasets: [{ label: 'Nouveaux produits', data: [3,5,2,8,4,6,3,7,5,4,6,2], backgroundColor: '#312783', borderRadius: 4 }] },
    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } }
});
new Chart(document.getElementById('pieChart'), {
    type: 'pie',
    data: { labels: catLabels, datasets: [{ data: catData, backgroundColor: ['#312783','#1e40af','#059669','#d97706','#dc2626','#7c3aed','#0891b2'] }] },
    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom', labels: { boxWidth: 12, padding: 8 } } } }
});
</script>
<?php require_once __DIR__ . '/partials/footer.php'; ?>
