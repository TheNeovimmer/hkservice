<?php
$slug = $_GET['slug'] ?? '';
require_once __DIR__ . '/includes/helpers.php';
require_once __DIR__ . '/includes/db.php';
$db = getDB();

$stmt = $db->prepare("SELECT * FROM projects WHERE slug=? AND active=1 LIMIT 1");
$stmt->execute([$slug]);
$proj = $stmt->fetch();
if (!$proj) { header('Location: realisations.php'); exit; }

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

.gallery-carousel-wrap {
    padding: 60px 0 40px;
    background: #f8f9fa;
}
.gallery-carousel .item {
    position: relative;
    border-radius: 16px;
    overflow: hidden;
    cursor: pointer;
}
.gallery-carousel .item img {
    width: 100%;
    height: 500px;
    object-fit: cover;
    border-radius: 16px;
    transition: transform .6s ease;
}
.gallery-carousel .item:hover img { transform: scale(1.03); }
.gallery-carousel .item .img-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.2);
    opacity: 0;
    transition: opacity .4s;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 16px;
}
.gallery-carousel .item:hover .img-overlay { opacity: 1; }
.gallery-carousel .item .img-overlay i {
    color: #fff;
    font-size: 2.5rem;
    text-shadow: 0 2px 10px rgba(0,0,0,0.3);
}
.owl-carousel .owl-nav button.owl-prev,
.owl-carousel .owl-nav button.owl-next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: rgba(49,39,131,0.9) !important;
    color: #fff !important;
    font-size: 1.3rem !important;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all .3s;
}
.owl-carousel .owl-nav button.owl-prev { left: -25px; }
.owl-carousel .owl-nav button.owl-next { right: -25px; }
.owl-carousel .owl-nav button.owl-prev:hover,
.owl-carousel .owl-nav button.owl-next:hover {
    background: #312783 !important;
    transform: translateY(-50%) scale(1.1);
}
.owl-carousel .owl-dots { margin-top: 20px; }
.owl-carousel .owl-dot span {
    width: 12px !important;
    height: 12px !important;
    background: #ccc !important;
    transition: all .3s;
}
.owl-carousel .owl-dot.active span {
    background: #312783 !important;
    width: 30px !important;
}

.project-info-section {
    padding: 60px 0;
    background: #fff;
}
.project-info-section .section-title {
    font-family: 'Teko', sans-serif;
    font-size: 2.2rem;
    font-weight: 600;
    color: #312783;
    margin-bottom: 30px;
    text-transform: uppercase;
}
.project-info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}
.project-info-card {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 25px;
    transition: all .3s;
    border-left: 4px solid #312783;
}
.project-info-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(49,39,131,0.1);
}
.project-info-card .info-icon {
    color: #312783;
    font-size: 1.5rem;
    margin-bottom: 10px;
}
.project-info-card .info-label {
    font-size: 0.85rem;
    color: #888;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: 600;
}
.project-info-card .info-value {
    font-size: 1.1rem;
    color: #333;
    font-weight: 500;
    margin-top: 5px;
}
.project-description-box {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 30px;
    line-height: 1.8;
    color: #555;
    font-size: 1.05rem;
}

.proj-nav-section {
    padding: 40px 0 60px;
    background: #fff;
    border-top: 1px solid #eee;
}
.proj-nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
}
.proj-nav-link {
    display: flex;
    align-items: center;
    gap: 15px;
    text-decoration: none;
    padding: 15px 20px;
    border-radius: 12px;
    background: #f8f9fa;
    transition: all .3s;
    max-width: 45%;
}
.proj-nav-link:hover {
    background: #312783;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(49,39,131,0.15);
}
.proj-nav-link.prev { text-align: left; }
.proj-nav-link.next { text-align: right; flex-direction: row-reverse; }
.proj-nav-link .nav-arrow {
    font-size: 1.5rem;
    color: #312783;
    transition: color .3s;
    flex-shrink: 0;
}
.proj-nav-link:hover .nav-arrow { color: #fff; }
.proj-nav-link .nav-label {
    font-size: 0.75rem;
    color: #999;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: color .3s;
}
.proj-nav-link:hover .nav-label { color: rgba(255,255,255,0.6); }
.proj-nav-link .nav-title {
    font-size: 1rem;
    font-weight: 600;
    color: #333;
    transition: color .3s;
}
.proj-nav-link:hover .nav-title { color: #fff; }
.proj-nav-link .nav-thumb {
    width: 60px;
    height: 60px;
    border-radius: 8px;
    object-fit: cover;
    flex-shrink: 0;
}
.proj-nav-link:hover .nav-thumb { opacity: 0.9; }
.proj-nav-back {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #312783;
    font-weight: 600;
    text-decoration: none;
    padding: 12px 24px;
    border-radius: 8px;
    border: 2px solid #312783;
    transition: all .3s;
    font-size: 0.9rem;
}
.proj-nav-back:hover {
    background: #312783;
    color: #fff;
}
@media (max-width: 768px) {
    .project-detail-hero h1 { font-size: 2.5rem; }
    .gallery-carousel .item img { height: 300px; }
    .proj-nav { flex-direction: column; }
    .proj-nav-link { max-width: 100%; width: 100%; }
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
            <a href="realisations.php">R&eacute;alisations</a>
            <span> / <?= sanitize($proj['title']) ?></span>
        </div>
    </div>
</section>

<?php if (!empty($images)): ?>
<section class="gallery-carousel-wrap">
    <div class="auto-container">
        <div class="gallery-carousel owl-carousel owl-theme">
            <?php foreach ($images as $img): ?>
            <div class="item">
                <a href="/<?= $img ?>" data-fancybox="project-gallery">
                    <img src="/<?= $img ?>" alt="<?= sanitize($proj['title']) ?>">
                    <div class="img-overlay"><i class="fas fa-expand"></i></div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<section class="project-info-section">
    <div class="auto-container">
        <h2 class="section-title">Pr&eacute;sentation du projet</h2>
        <div class="project-info-grid">
            <?php if ($proj['location']): ?>
            <div class="project-info-card">
                <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                <div class="info-label">Lieu</div>
                <div class="info-value"><?= sanitize($proj['location']) ?></div>
            </div>
            <?php endif; ?>
            <?php if ($proj['surface']): ?>
            <div class="project-info-card">
                <div class="info-icon"><i class="fas fa-ruler-combined"></i></div>
                <div class="info-label">Surface</div>
                <div class="info-value"><?= sanitize($proj['surface']) ?></div>
            </div>
            <?php endif; ?>
            <?php if ($proj['client']): ?>
            <div class="project-info-card">
                <div class="info-icon"><i class="fas fa-user-tie"></i></div>
                <div class="info-label">Client</div>
                <div class="info-value"><?= sanitize($proj['client']) ?></div>
            </div>
            <?php endif; ?>
            <div class="project-info-card">
                <div class="info-icon"><i class="fas fa-hashtag"></i></div>
                <div class="info-label">R&eacute;f&eacute;rence</div>
                <div class="info-value"><?= sanitize($projNum) ?></div>
            </div>
            <?php if ($projCategory): ?>
            <div class="project-info-card">
                <div class="info-icon"><i class="fas fa-tag"></i></div>
                <div class="info-label">Cat&eacute;gorie</div>
                <div class="info-value"><?= ucfirst(sanitize($projCategory)) ?></div>
            </div>
            <?php endif; ?>
        </div>
        <?php if ($proj['description']): ?>
        <div class="project-description-box">
            <?= nl2br(sanitize($proj['description'])) ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php if (!empty($related)): ?>
<section style="padding:40px 0;background:#f8f9fa;">
    <div class="auto-container">
        <h2 class="section-title" style="font-family:'Teko',sans-serif;font-size:2rem;font-weight:600;color:#312783;margin-bottom:30px;text-transform:uppercase;">Projets similaires</h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:20px;">
            <?php foreach ($related as $r):
                $rImg = $r['thumbnail'] ?: '';
                $rNum = $r['project_number'] ?? '';
            ?>
            <a href="/projets/<?= sanitize($r['slug']) ?>" style="text-decoration:none;display:block;">
                <div style="background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 2px 10px rgba(0,0,0,.06);transition:all .3s;" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 8px 25px rgba(49,39,131,.12)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
                    <?php if ($rImg && file_exists(__DIR__ . '/' . $rImg)): ?>
                    <img src="/<?= sanitize($rImg) ?>" alt="<?= sanitize($r['title']) ?>" style="width:100%;height:180px;object-fit:cover;">
                    <?php else: ?>
                    <div style="width:100%;height:180px;background:#f0f0f0;display:flex;align-items:center;justify-content:center;color:#ccc;"><i class="fas fa-building" style="font-size:2.5rem;"></i></div>
                    <?php endif; ?>
                    <div style="padding:15px;">
                        <?php if ($rNum): ?><div style="font-size:.7rem;color:#999;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;"><?= sanitize($rNum) ?></div><?php endif; ?>
                        <div style="font-weight:600;color:#333;font-size:.95rem;"><?= sanitize($r['title']) ?></div>
                        <?php if ($r['category']): ?><span style="font-size:.75rem;color:#312783;font-weight:500;"><?= ucfirst(sanitize($r['category'])) ?></span><?php endif; ?>
                    </div>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<section class="proj-nav-section">
    <div class="auto-container">
        <div style="text-align:center;margin-bottom:30px;">
            <a href="realisations.php" class="proj-nav-back">
                <i class="fas fa-th-large"></i> Tous les projets
            </a>
        </div>
        <div class="proj-nav">
            <?php if ($prevProj): ?>
            <a href="/projets/<?= sanitize($prevProj['slug']) ?>" class="proj-nav-link prev">
                <i class="fas fa-chevron-left nav-arrow"></i>
                <div>
                    <div class="nav-label">Projet pr&eacute;c&eacute;dent</div>
                    <div class="nav-title"><?= sanitize($prevProj['title']) ?></div>
                </div>
                <?php
                $prevThumb = $prevProj['thumbnail'] ?: '';
                if ($prevThumb):
                ?>
                <img src="/<?= sanitize($prevThumb) ?>" alt="" class="nav-thumb">
                <?php endif; ?>
            </a>
            <?php else: ?>
            <div></div>
            <?php endif; ?>
            <?php if ($nextProj): ?>
            <a href="/projets/<?= sanitize($nextProj['slug']) ?>" class="proj-nav-link next">
                <i class="fas fa-chevron-right nav-arrow"></i>
                <div>
                    <div class="nav-label">Projet suivant</div>
                    <div class="nav-title"><?= sanitize($nextProj['title']) ?></div>
                </div>
                <?php
                $nextThumb = $nextProj['thumbnail'] ?: '';
                if ($nextThumb):
                ?>
                <img src="/<?= sanitize($nextThumb) ?>" alt="" class="nav-thumb">
                <?php endif; ?>
            </a>
            <?php else: ?>
            <div></div>
            <?php endif; ?>
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
