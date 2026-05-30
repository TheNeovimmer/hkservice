<?php
$activeNav = 'projets';
$pageTitle = 'Projets Construction | H&K Services';
$pageMeta = [
    'title' => 'Projets Construction | H&K Services',
    'desc'  => "Besoin d'une entreprise générale du bâtiment en Tunisie ou en France ? H&K Services transforme vos idées en projets modernes et durables.",
];
require_once __DIR__ . '/includes/helpers.php';
require_once __DIR__ . '/includes/site-head.php';

$db = getDB();
$projects = $db->query("SELECT * FROM projects WHERE active=1 ORDER BY order_index ASC, id DESC")->fetchAll();
$categories = $db->query("SELECT DISTINCT category FROM projects WHERE active=1 AND category != '' ORDER BY category")->fetchAll(PDO::FETCH_COLUMN);
?>
<style>
.gallery-section .filter-list {
    margin: 0 -12px;
}

.project-card-enhanced {
    position: relative;
    border-radius: 16px;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 2px 12px rgba(0,0,0,0.06);
    transition: all .4s cubic-bezier(.25,.8,.25,1);
    height: 100%;
    cursor: pointer;
}

.project-card-enhanced:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(49,39,131,0.12);
}

.project-card-enhanced .card-image {
    position: relative;
    overflow: hidden;
    aspect-ratio: 4/3;
}

.project-card-enhanced .card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .6s ease;
}

.project-card-enhanced:hover .card-image img {
    transform: scale(1.08);
}

.project-card-enhanced .card-image .card-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, transparent 40%, rgba(0,0,0,0.7) 100%);
    opacity: 0;
    transition: opacity .4s ease;
    display: flex;
    align-items: flex-end;
    padding: 20px;
}

.project-card-enhanced:hover .card-image .card-overlay {
    opacity: 1;
}

.project-card-enhanced .card-overlay .overlay-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #fff;
    font-size: .85rem;
    font-weight: 600;
    letter-spacing: .5px;
    text-transform: uppercase;
    text-decoration: none;
    padding: 10px 20px;
    background: rgba(49,39,131,0.9);
    border-radius: 8px;
    transition: background .3s;
}

.project-card-enhanced .card-overlay .overlay-btn:hover {
    background: #312783;
}

.project-card-enhanced .card-body {
    padding: 20px;
}

.project-card-enhanced .card-body .project-number {
    font-size: .75rem;
    color: #999;
    text-transform: uppercase;
    letter-spacing: 2px;
    font-weight: 600;
    margin-bottom: 6px;
}

.project-card-enhanced .card-body .project-title {
    font-family: 'Teko', sans-serif;
    font-size: 1.4rem;
    font-weight: 600;
    color: #222;
    margin-bottom: 8px;
    line-height: 1.2;
    transition: color .3s;
}

.project-card-enhanced:hover .card-body .project-title {
    color: #312783;
}

.project-card-enhanced .card-body .project-title a {
    color: inherit;
    text-decoration: none;
}

.project-card-enhanced .card-body .project-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    font-size: .82rem;
    color: #777;
}

.project-card-enhanced .card-body .project-meta span {
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.project-card-enhanced .card-body .project-meta i {
    color: #312783;
    font-size: .75rem;
}

.category-badge {
    display: inline-block;
    font-size: .72rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    padding: 4px 12px;
    border-radius: 20px;
    background: rgba(49,39,131,0.08);
    color: #312783;
    margin-bottom: 10px;
}

.filter-tabs {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    justify-content: center;
    margin-bottom: 40px;
}

.filter-tab {
    padding: 8px 24px;
    border-radius: 25px;
    border: 2px solid #e0e0e0;
    background: transparent;
    color: #666;
    font-size: .85rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    cursor: pointer;
    transition: all .3s ease;
}

.filter-tab:hover,
.filter-tab.active {
    background: #312783;
    border-color: #312783;
    color: #fff;
}

@media (max-width: 768px) {
    .project-card-enhanced .card-image {
        aspect-ratio: 16/10;
    }
    .project-card-enhanced .card-body .project-title {
        font-size: 1.2rem;
    }
}
</style>
</head>
<body>
<div class="page-wrapper">

<?php include 'includes/site-preloader.php'; ?>
<?php include 'includes/site-navbar.php'; ?>
<?php include 'includes/site-mobile-menu.php'; ?>

<section class="page-banner">
    <div class="image-layer" style="background-image:url('img/gallery/img5.jpg');"></div>
    <div class="shape-1"></div>
    <div class="shape-2"></div>
    <div class="banner-inner">
        <div class="auto-container">
            <div class="inner-container clearfix">
                <h1>Nos projets</h1>
                <div class="page-nav">
                    <ul class="bread-crumb clearfix">
                        <li><a href="index.php">Accueil</a></li>
                        <li class="active">Projets</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="gallery-section" style="padding:80px 0;">
    <div class="auto-container">
        <div class="sec-title centered">
            <h2>Nos derni&egrave;res r&eacute;alisations</h2>
            <div class="text" style="max-width:700px;margin:0 auto;color:#888;font-size:1rem;line-height:1.8;">
                D&eacute;couvrez notre s&eacute;lection de projets r&eacute;alis&eacute;s avec passion et expertise.
            </div>
        </div>

        <div class="filter-tabs">
            <button class="filter-tab active" data-filter="all">Tous</button>
            <?php foreach ($categories as $cat): ?>
            <button class="filter-tab" data-filter=".<?= sanitize($cat) ?>"><?= ucfirst(sanitize($cat)) ?></button>
            <?php endforeach; ?>
        </div>

        <div class="mixitup-gallery">
            <div class="filter-list row">
                <?php foreach ($projects as $p):
                    $images = json_decode($p['images'] ?? '[]', true);
                    $cover = $p['thumbnail'] ?: ($images[0] ?? 'img/logo png/Logo.png');
                    $slug = $p['slug'] ?: slugify($p['title']);
                    $projNum = $p['project_number'] ?? ('PROJET N°' . $p['order_index']);
                    $detailLink = '/projets/' . urlencode($slug);
                    $catClass = $p['category'] ?: 'non-classe';
                ?>
                <div class="col-lg-4 col-md-6 col-sm-12 mix <?= sanitize($catClass) ?>" style="padding:12px;">
                    <div class="project-card-enhanced">
                        <a href="<?= $detailLink ?>" class="card-image d-block">
                            <img src="<?= sanitize($cover) ?>" alt="<?= sanitize($p['title']) ?>" loading="lazy">
                            <div class="card-overlay">
                                <span class="overlay-btn"><i class="fas fa-plus"></i> Voir le projet</span>
                            </div>
                        </a>
                        <div class="card-body">
                            <?php if ($p['category']): ?>
                            <div class="category-badge"><?= ucfirst(sanitize($p['category'])) ?></div>
                            <?php endif; ?>
                            <div class="project-number"><?= sanitize($projNum) ?></div>
                            <div class="project-title"><a href="<?= $detailLink ?>"><?= sanitize($p['title']) ?></a></div>
                            <div class="project-meta">
                                <?php if ($p['location']): ?>
                                <span><i class="fas fa-map-marker-alt"></i> <?= sanitize($p['location']) ?></span>
                                <?php endif; ?>
                                <?php if ($p['surface']): ?>
                                <span><i class="fas fa-ruler-combined"></i> <?= sanitize($p['surface']) ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<section class="call-to-section">
    <div class="auto-container">
        <div class="inner clearfix">
            <div class="shape-1 wow slideInRight" data-wow-delay="0ms" data-wow-duration="1500ms"></div>
            <div class="shape-2 wow fadeInDown" data-wow-delay="0ms" data-wow-duration="1500ms"></div>
            <h2>D&eacute;marrons votre projet d&egrave;s aujourd'hui !</h2>
            <div class="link-box">
                <a class="theme-btn btn-style-two" href="contact.php">
                    <i class="btn-curve"></i>
                    <span class="btn-title">OBTENIR UN DEVIS</span>
                </a>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/site-footer.php'; ?>
</div>

<?php include 'includes/site-scripts.php'; ?>
<script>
$(document).ready(function () {
    $('.filter-tab').on('click', function () {
        var filterVal = $(this).data('filter');
        $('.filter-tab').removeClass('active');
        $(this).addClass('active');

        if (filterVal === 'all') {
            $('.filter-list > .mix').fadeIn(400);
        } else {
            $('.filter-list > .mix').fadeOut(300);
            $('.filter-list > .mix' + filterVal).delay(100).fadeIn(400);
        }
    });
});
</script>
</body>
</html>
