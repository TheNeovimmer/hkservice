<?php
$activeNav = 'projets';
$pageTitle = 'Projets Construction | H&K Services';
$pageMeta = [
    'title' => 'Projets Construction | H&K Services',
    'desc'  => "Besoin d'une entreprise générale du bâtiment en Tunisie ou en France ? H&K Services transforme vos idées en projets modernes et durables.",
];
require_once __DIR__ . '/includes/helpers.php';
require_once __DIR__ . '/includes/site-head.php';
?>
<style>
</style>
</head>
<body>

<div class="page-wrapper">

<?php include 'includes/site-preloader.php'; ?>
<?php include 'includes/site-navbar.php'; ?>
<?php include 'includes/site-mobile-menu.php'; ?>

<!--Search Popup-->
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

<!-- Banner Section -->
<section class="page-banner">
    <div class="image-layer" style="background-image:url('img/gallery/img5.jpg');"></div>
    <div class="shape-1"></div>
    <div class="shape-2"></div>
    <div class="banner-inner">
        <div class="auto-container">
            <div class="inner-container clearfix">
                <h1>Projets</h1>
                <div class="page-nav">
                    <ul class="bread-crumb clearfix">
                        <li><a href="index.php">Page d'accueil</a></li>
                        <li class="active">Projets</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section class="gallery-section gallery-section-four">
    <div class="auto-container">
        <div class="sec-title centered">
            <h2>Nos projets</h2>
            <h5>Nos projets de construction résidentielle allient qualité, confort et design moderne afin de répondre aux besoins des familles d'aujourd'hui. Nous veillons à réaliser chaque projet avec précision tout en respectant les délais et les normes de construction les plus exigeantes.</h5>
            <p> Nos réalisations comprennent :
            Construction de villas et maisons modernes
            Immeubles résidentiels
            Aménagement intérieur et extérieur
            Travaux de finition et décoration
            Rénovation et réhabilitation des habitations
            Réalisation des fondations et structures en béton
            Nous accompagnons nos clients à chaque étape du projet, de la conception jusqu'à la livraison finale, afin de garantir des résultats durables, esthétiques et de haute qualité.</p>
        </div>
        <div class="mixitup-gallery">
            <div class="filter-list row">

                <?php
                $db = getDB();
                $projects = $db->query("SELECT * FROM projects WHERE active=1 ORDER BY id DESC")->fetchAll();
                $counter = 0;
                foreach ($projects as $p):
                    $counter++;
                    $images = json_decode($p['images'] ?? '[]', true);
                    $cover = $p['thumbnail'] ?: ($images[0] ?? '');
                    $slug = $p['slug'] ?: slugify($p['title']);
                    $coverSrc = $cover;
                    if ($cover && file_exists(__DIR__ . '/' . $cover)):
                        $coverSrc = $cover;
                    elseif ($cover):
                        $coverSrc = $cover;
                    else:
                        $coverSrc = 'img/logo png/Logo.png';
                    endif;
                    $detailLink = '/projets/' . urlencode($slug);
                ?>
                <!-- Gallery Item -->
                <div class="gallery-item mix all Residentiel col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <a href="<?= $detailLink ?>">
                            <figure class="image">
                                <img src="<?= sanitize($coverSrc) ?>" alt="<?= sanitize($p['title']) ?>">
                            </figure>
                        </a>
                        <div class="cap-box">
                            <div class="cap-inner">
                                <div class="cat"><span>PROJET N&deg;<?= $counter ?></span></div>
                                <div class="title">
                                    <h5><a href="<?= $detailLink ?>"><?= sanitize($p['title']) ?></a></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>

    <!-- Call To Section -->
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
    $(document).ready(function () {
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
    window.onload = function () {
        const popup = document.getElementById("popup");
        if (!popup) return;
        const popupContent = document.querySelector(".popup-content");
        popup.style.display = "flex";
        setTimeout(() => {
            popup.classList.add("show");
            popupContent.classList.add("show");
        }, 10);
    };

    function closePopupAndRedirect() {
        const popup = document.getElementById("popup");
        const popupContent = document.querySelector(".popup-content");
        popup.classList.remove("show");
        popupContent.classList.remove("show");
        setTimeout(() => {
            popup.style.display = "none";
            window.location.href = "#evenement";
        }, 500);
    }

    function closePopup() {
        const popup = document.getElementById("popup");
        const popupContent = document.querySelector(".popup-content");
        popup.classList.remove("show");
        popupContent.classList.remove("show");
        setTimeout(() => {
            popup.style.display = "none";
        }, 500);
    }

    document.querySelector(".close-btn").onclick = closePopup;

    window.onclick = function (event) {
        if (event.target == document.getElementById("popup")) {
            closePopupAndRedirect();
        }
    };
</script>

<script>
    $(document).ready(function () {
        $(".owl-carousel").owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            responsive: {
                0: { items: 1 },
                600: { items: 2 },
                1000: { items: 3 }
            }
        });
    });
</script>

</body>
</html>
