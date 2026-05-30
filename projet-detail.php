<?php
$slug = $_GET['slug'] ?? '';
require_once __DIR__ . '/includes/helpers.php';
require_once __DIR__ . '/includes/db.php';
$db = getDB();

$stmt = $db->prepare("SELECT * FROM projects WHERE slug=? AND active=1 LIMIT 1");
$stmt->execute([$slug]);
$proj = $stmt->fetch();
if (!$proj) { header('Location: projets-construction-batiments.php'); exit; }

$prevStmt = $db->prepare("SELECT slug, title, thumbnail, project_number FROM projects WHERE active=1 AND order_index < ? ORDER BY order_index DESC LIMIT 1");
$prevStmt->execute([$proj['order_index']]);
$prevProj = $prevStmt->fetch();

$nextStmt = $db->prepare("SELECT slug, title, thumbnail, project_number FROM projects WHERE active=1 AND order_index > ? ORDER BY order_index ASC LIMIT 1");
$nextStmt->execute([$proj['order_index']]);
$nextProj = $nextStmt->fetch();

$activeNav = 'projets';
$pageTitle = sanitize($proj['title']) . ' | H&K Services';
$pageMeta = ['title' => $pageTitle, 'desc' => mb_substr(strip_tags($proj['description'] ?? ''), 0, 160)];
$images = json_decode($proj['images'] ?? '[]', true);
$projNum = $proj['project_number'] ?? ('PROJET N°' . $proj['order_index']);
$projCategory = $proj['category'] ?? '';

$related = [];
if ($projCategory) {
    $relStmt = $db->prepare("SELECT slug, title, thumbnail, project_number, category FROM projects WHERE active=1 AND category=? AND id!=? ORDER BY order_index ASC LIMIT 4");
    $relStmt->execute([$projCategory, $proj['id']]);
    $related = $relStmt->fetchAll();
}
require_once __DIR__ . '/includes/site-head.php';
?>
<style>
.project-detail-hero {
    position: relative;
    padding: 100px 0 60px;
    background: linear-gradient(135deg, #1a1a2e 0%, #312783 50%, #16213e 100%);
    text-align: center;
    overflow: hidden;
}
.project-detail-hero::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle at 30% 50%, rgba(255,255,255,0.03) 0%, transparent 50%);
    animation: heroShift 20s ease-in-out infinite;
}
@keyframes heroShift {
    0%, 100% { transform: translate(0, 0); }
    50% { transform: translate(-5%, 5%); }
}
.project-detail-hero .auto-container { position: relative; z-index: 1; }
.project-detail-hero .proj-number {
    display: inline-block;
    font-family: 'Teko', sans-serif;
    font-size: 1rem;
    letter-spacing: 4px;
    color: rgba(255,255,255,0.6);
    text-transform: uppercase;
    margin-bottom: 10px;
}
.project-detail-hero h1 {
    font-family: 'Teko', sans-serif;
    font-size: 4rem;
    font-weight: 700;
    color: #fff;
    margin-bottom: 15px;
    text-transform: uppercase;
    line-height: 1.1;
}
.project-detail-hero .breadcrumb-hero {
    color: rgba(255,255,255,0.5);
    font-size: 0.95rem;
}
.project-detail-hero .breadcrumb-hero a {
    color: rgba(255,255,255,0.5);
    text-decoration: none;
    transition: color .3s;
}
.project-detail-hero .breadcrumb-hero a:hover { color: #fff; }
.project-detail-hero .breadcrumb-hero span { color: rgba(255,255,255,0.8); }
@media (max-width: 768px) {
    .project-detail-hero h1 { font-size: 2.5rem; }
}
</style>
</head>
<body>
<div class="page-wrapper">
<?php include __DIR__ . '/includes/site-preloader.php'; ?>
<?php include __DIR__ . '/includes/site-navbar.php'; ?>
<?php include __DIR__ . '/includes/site-mobile-menu.php'; ?>

<section class="project-detail-hero">
    <div class="auto-container">
        <div class="proj-number"><?= sanitize($projNum) ?></div>
        <h1><?= sanitize($proj['title']) ?></h1>
        <div class="breadcrumb-hero">
            <a href="projets-construction-batiments.php">R&eacute;alisations</a>
            <span> / <?= sanitize($proj['title']) ?></span>
        </div>
    </div>
</section>

<?php if (!empty($images)): ?>
<section class="gallery-section" style="padding:60px 0;background:#f8f9fa;">
    <div class="auto-container">
        <div class="gallery-carousel owl-carousel owl-theme">
            <?php foreach ($images as $img): ?>
            <div class="item">
                <a href="<?= sanitize($img) ?>" data-fancybox="project-gallery">
                    <img src="<?= sanitize($img) ?>" alt="<?= sanitize($proj['title']) ?>" style="width:100%;height:500px;object-fit:cover;border-radius:16px;">
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<section class="project-info-section" style="padding:60px 0;background:#fff;">
    <div class="auto-container">
        <div class="sec-title"><h2>Pr&eacute;sentation du projet</h2></div>
        <div class="row">
            <?php if ($proj['location']): ?>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="project-info-card" style="background:#f8f9fa;border-radius:12px;padding:25px;border-left:4px solid #312783;height:100%;">
                    <div style="color:#312783;font-size:1.5rem;margin-bottom:10px;"><i class="fas fa-map-marker-alt"></i></div>
                    <div style="font-size:.85rem;color:#888;text-transform:uppercase;letter-spacing:1px;font-weight:600;">Lieu</div>
                    <div style="font-size:1.1rem;color:#333;font-weight:500;margin-top:5px;"><?= sanitize($proj['location']) ?></div>
                </div>
            </div>
            <?php endif; ?>
            <?php if ($proj['surface']): ?>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="project-info-card" style="background:#f8f9fa;border-radius:12px;padding:25px;border-left:4px solid #312783;height:100%;">
                    <div style="color:#312783;font-size:1.5rem;margin-bottom:10px;"><i class="fas fa-ruler-combined"></i></div>
                    <div style="font-size:.85rem;color:#888;text-transform:uppercase;letter-spacing:1px;font-weight:600;">Surface</div>
                    <div style="font-size:1.1rem;color:#333;font-weight:500;margin-top:5px;"><?= sanitize($proj['surface']) ?></div>
                </div>
            </div>
            <?php endif; ?>
            <?php if ($proj['client']): ?>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="project-info-card" style="background:#f8f9fa;border-radius:12px;padding:25px;border-left:4px solid #312783;height:100%;">
                    <div style="color:#312783;font-size:1.5rem;margin-bottom:10px;"><i class="fas fa-user-tie"></i></div>
                    <div style="font-size:.85rem;color:#888;text-transform:uppercase;letter-spacing:1px;font-weight:600;">Client</div>
                    <div style="font-size:1.1rem;color:#333;font-weight:500;margin-top:5px;"><?= sanitize($proj['client']) ?></div>
                </div>
            </div>
            <?php endif; ?>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="project-info-card" style="background:#f8f9fa;border-radius:12px;padding:25px;border-left:4px solid #312783;height:100%;">
                    <div style="color:#312783;font-size:1.5rem;margin-bottom:10px;"><i class="fas fa-hashtag"></i></div>
                    <div style="font-size:.85rem;color:#888;text-transform:uppercase;letter-spacing:1px;font-weight:600;">R&eacute;f&eacute;rence</div>
                    <div style="font-size:1.1rem;color:#333;font-weight:500;margin-top:5px;"><?= sanitize($projNum) ?></div>
                </div>
            </div>
            <?php if ($projCategory): ?>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="project-info-card" style="background:#f8f9fa;border-radius:12px;padding:25px;border-left:4px solid #312783;height:100%;">
                    <div style="color:#312783;font-size:1.5rem;margin-bottom:10px;"><i class="fas fa-tag"></i></div>
                    <div style="font-size:.85rem;color:#888;text-transform:uppercase;letter-spacing:1px;font-weight:600;">Cat&eacute;gorie</div>
                    <div style="font-size:1.1rem;color:#333;font-weight:500;margin-top:5px;"><?= ucfirst(sanitize($projCategory)) ?></div>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php if ($proj['description']): ?>
        <div style="background:#f8f9fa;border-radius:12px;padding:30px;line-height:1.8;color:#555;font-size:1.05rem;">
            <?= nl2br(sanitize($proj['description'])) ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php if (!empty($related)): ?>
<section style="padding:60px 0;background:#f8f9fa;">
    <div class="auto-container">
        <div class="sec-title"><h2>Projets similaires</h2></div>
        <div class="row">
            <?php foreach ($related as $r):
                $rImg = $r['thumbnail'] ?: '';
                $rNum = $r['project_number'] ?? '';
            ?>
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <a href="/projets/<?= sanitize($r['slug']) ?>" class="project-card-link" style="text-decoration:none;display:block;height:100%;">
                    <div class="project-card" style="background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 2px 10px rgba(0,0,0,.06);transition:all .3s;height:100%;">
                        <?php if ($rImg && file_exists(__DIR__ . '/' . $rImg)): ?>
                        <img src="<?= sanitize($rImg) ?>" alt="<?= sanitize($r['title']) ?>" style="width:100%;height:200px;object-fit:cover;">
                        <?php else: ?>
                        <div style="width:100%;height:200px;background:#f0f0f0;display:flex;align-items:center;justify-content:center;color:#ccc;"><i class="fas fa-building" style="font-size:3rem;"></i></div>
                        <?php endif; ?>
                        <div style="padding:20px;">
                            <?php if ($rNum): ?><div style="font-size:.75rem;color:#999;text-transform:uppercase;letter-spacing:1px;margin-bottom:6px;"><?= sanitize($rNum) ?></div><?php endif; ?>
                            <div style="font-weight:600;color:#333;font-size:1.05rem;margin-bottom:4px;"><?= sanitize($r['title']) ?></div>
                            <?php if ($r['category']): ?><span style="font-size:.8rem;color:#312783;font-weight:500;"><i class="fas fa-tag me-1"></i><?= ucfirst(sanitize($r['category'])) ?></span><?php endif; ?>
                        </div>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<section style="padding:40px 0 60px;background:#fff;border-top:1px solid #eee;">
    <div class="auto-container">
        <div class="text-center mb-4">
            <a href="projets-construction-batiments.php" class="theme-btn btn-style-one"><i class="btn-curve"></i><span class="btn-title">Tous les projets</span></a>
        </div>
        <div class="row justify-content-between">
            <div class="col-md-5 mb-3 mb-md-0">
                <?php if ($prevProj): ?>
                <a href="/projets/<?= sanitize($prevProj['slug']) ?>" class="d-flex align-items-center gap-3 text-decoration-none p-3 rounded-3 bg-light transition-all" style="transition:all .3s;" onmouseover="this.style.backgroundColor='#312783'" onmouseout="this.style.backgroundColor=''">
                    <i class="fas fa-chevron-left" style="font-size:1.5rem;color:#312783;flex-shrink:0;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#312783'"></i>
                    <div class="flex-grow-1">
                        <div style="font-size:.75rem;color:#999;text-transform:uppercase;letter-spacing:1px;transition:color .3s;">Projet pr&eacute;c&eacute;dent</div>
                        <div style="font-weight:600;color:#333;font-size:1rem;transition:color .3s;"><?= sanitize($prevProj['title']) ?></div>
                    </div>
                    <?php
                    $prevThumb = $prevProj['thumbnail'] ?: '';
                    if ($prevThumb):
                    ?>
                    <img src="<?= sanitize($prevThumb) ?>" alt="" style="width:60px;height:60px;border-radius:8px;object-fit:cover;flex-shrink:0;">
                    <?php endif; ?>
                </a>
                <?php endif; ?>
            </div>
            <div class="col-md-5 text-md-end">
                <?php if ($nextProj): ?>
                <a href="/projets/<?= sanitize($nextProj['slug']) ?>" class="d-flex align-items-center gap-3 text-decoration-none p-3 rounded-3 bg-light transition-all" style="transition:all .3s;" onmouseover="this.style.backgroundColor='#312783'" onmouseout="this.style.backgroundColor=''">
                    <?php
                    $nextThumb = $nextProj['thumbnail'] ?: '';
                    if ($nextThumb):
                    ?>
                    <img src="<?= sanitize($nextThumb) ?>" alt="" style="width:60px;height:60px;border-radius:8px;object-fit:cover;flex-shrink:0;">
                    <?php endif; ?>
                    <div class="flex-grow-1">
                        <div style="font-size:.75rem;color:#999;text-transform:uppercase;letter-spacing:1px;transition:color .3s;">Projet suivant</div>
                        <div style="font-weight:600;color:#333;font-size:1rem;transition:color .3s;"><?= sanitize($nextProj['title']) ?></div>
                    </div>
                    <i class="fas fa-chevron-right" style="font-size:1.5rem;color:#312783;flex-shrink:0;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#312783'"></i>
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/site-footer.php'; ?>
</div>
<?php include __DIR__ . '/includes/site-scripts.php'; ?>
<script>
$(document).ready(function () {
    $(".gallery-carousel").owlCarousel({
        items: 1,
        loop: true,
        margin: 20,
        nav: true,
        dots: true,
        navText: [
            "<i class='fas fa-chevron-left'></i>",
            "<i class='fas fa-chevron-right'></i>"
        ],
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        smartSpeed: 600
    });
});
</script>
</body>
</html>
