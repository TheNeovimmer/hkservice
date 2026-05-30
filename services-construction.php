<?php
$activeNav = 'services';
$pageTitle = 'Services Construction | H&K Services';
$pageMeta = [
    'title' => 'Services Construction | H&K Services',
    'desc'  => 'Explorez nos services en construction et rénovation de bâtiments en Tunisie. Du plan à l\'exécution, travaux génie civil, architecture et étude de projet!',
];
require_once 'includes/site-head.php';
?>
</head>
<body>
<div class="page-wrapper">
<?php include 'includes/site-preloader.php'; ?>
<?php include 'includes/site-navbar.php'; ?>
<?php include 'includes/site-mobile-menu.php'; ?>

<div class="search-popup">
    <div class="search-popup__overlay custom-cursor__overlay">
        <div class="cursor"></div>
        <div class="cursor-follower"></div>
    </div>
    <div class="search-popup__inner">
        <form action="#" class="search-popup__form">
            <input type="text" name="search" placeholder="Entrez ici pour rechercher....">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
</div>

<section class="page-banner">
    <div class="image-layer" style="background-image:url(img/background/image-7.png);"></div>
    <div class="shape-1"></div>
    <div class="shape-2"></div>
    <div class="banner-inner">
        <div class="auto-container">
            <div class="inner-container clearfix">
                <h1>Services en gestion de projets de construction</h1>
                <div class="page-nav">
                    <ul class="bread-crumb clearfix">
                        <li><a href="index.php">Page d'accueil</a></li>
                        <li class="active">Services</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
require_once 'includes/helpers.php';
$db = getDB();

$sections = ['etude', 'construction', 'gestion'];

$sectionData = [
    'etude' => [
        'id'    => 'etude',
        'title' => 'Exécution et construction de projets de bâtiment <span class="dot">.</span>',
        'desc'  => 'Analyse approfondie, <b>planification stratégique</b> et <b>élaboration détaillée du dossier d\'exécution</b> avec les détails techniques pour <b>votre projet de construction</b>.',
        'class' => 'col-xl-4 col-lg-6 col-md-6 col-sm-12',
    ],
    'construction' => [
        'id'    => 'Construction',
        'title' => 'Travaux Génie Civil<span class="dot">.</span>',
        'desc'  => 'La conception, la <b>construction</b> et la <b>rénovation d\'infrastructures des bâtiments</b>, en assurant la sécurité et la durabilité.',
        'class' => 'col-xl-4 col-lg-6 col-md-6 col-sm-12',
    ],
    'gestion' => [
        'id'    => 'Gestion',
        'title' => 'Travaux de construction spécifiques et interventions spécialisées<span class="dot">.</span>',
        'desc'  => 'Besoin d\'un électricien, peintre, plombier, ferronnier ou menuisier ? Nos <b>artisans qualifiés</b> réalisent tous <b>vos travaux d\'aménagement</b> et de rénovation avec soin et professionnalisme.',
        'class' => 'col-xl-4 col-lg-6 col-md-6 col-sm-12',
    ],
];

foreach ($sections as $sec):
    $stmt = $db->prepare("SELECT * FROM services WHERE section=? AND active=1 ORDER BY order_index ASC");
    $stmt->execute([$sec]);
    $services = $stmt->fetchAll();
    if (empty($services)) continue;
    $sd = $sectionData[$sec];
?>
<section class="services-section-three padd-top">
    <div class="auto-container" id="<?= $sd['id'] ?>">
        <div class="sec-title centered">
            <h2><?= $sd['title'] ?></h2>
            <p><?= $sd['desc'] ?></p>
        </div>
        <div class="services">
            <div class="row clearfix">
<?php foreach ($services as $s): ?>
                <div class="service-block-two <?= $sd['class'] ?> wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                    <div class="inner-box" style="height: 100%;">
                        <div class="bottom-curve"></div>
                        <div class="icon-box"><i class="fas fa-<?= sanitize($s['icon']) ?>"></i></div>
                        <h5><?= sanitize($s['title']) ?></h5>
                        <div class="text"><?= mb_substr(strip_tags($s['description'] ?? ''), 0, 200) ?></div>
                        <div class="link-box"></div>
                    </div>
                </div>
<?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<?php endforeach; ?>

<section class="call-to-section">
    <div class="auto-container">
        <div class="inner clearfix">
            <div class="shape-1 wow slideInRight" data-wow-delay="0ms" data-wow-duration="1500ms"></div>
            <div class="shape-2 wow fadeInDown" data-wow-delay="0ms" data-wow-duration="1500ms"></div>
            <h2>Démarrons votre projet dès aujourd'hui !</h2>
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
$(document).ready(function(){
    $(".owl-carousel").owlCarousel({
        items: 1,
        loop: true,
        margin: 10,
        nav: true,
        navText: [
            "<i class='fa-solid fa-circle-chevron-left' style='color: #312783; font-size: 35px;'></i>",
            "<i class='fa-solid fa-circle-chevron-right' style='color: #312783; font-size: 35px;'></i>",
        ],
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
    });
});
</script>

<script>
window.onload = function(){
    const popup = document.getElementById("popup");
    const popupContent = document.querySelector(".popup-content");
    popup.style.display = "flex";
    setTimeout(() => {
        popup.classList.add("show");
        popupContent.classList.add("show");
    }, 10);
};

function closePopupAndRedirect(){
    const popup = document.getElementById("popup");
    const popupContent = document.querySelector(".popup-content");
    popup.classList.remove("show");
    popupContent.classList.remove("show");
    setTimeout(() => {
        popup.style.display = "none";
        window.location.href = "#evenement";
    }, 500);
}

function closePopup(){
    const popup = document.getElementById("popup");
    const popupContent = document.querySelector(".popup-content");
    popup.classList.remove("show");
    popupContent.classList.remove("show");
    setTimeout(() => { popup.style.display = "none"; }, 500);
}

document.querySelector(".close-btn").onclick = closePopup;

window.onclick = function(event){
    if (event.target == document.getElementById("popup")) {
        closePopupAndRedirect();
    }
};
</script>

<script>
$(document).ready(function(){
    $(".owl-carousel").owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        responsive: {
            0: { items: 1 },
            600: { items: 2 },
            1000: { items: 3 },
        },
    });
});
</script>
</body>
</html>
