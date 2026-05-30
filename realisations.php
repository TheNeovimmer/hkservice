<?php
require_once __DIR__ . '/includes/helpers.php';
$activeNav = 'projets';
$pageTitle = 'Réalisations | H&K Services';
$pageMeta = ['title' => $pageTitle, 'desc' => 'Découvrez nos projets emblématiques de construction, toiture, rénovation et bâtiments. H&K Services vous présente ses réalisations.'];
require_once __DIR__ . '/includes/site-head.php';
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Montserrat:wght@400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
</head>
<body>
<div class="loading-screen">
    <div class="loader">
        <div class="loader-logo">
            <div class="logo-3d">
                <div class="logo-front">H&K</div>
                <div class="logo-side">H&K</div>
            </div>
        </div>
        <div class="loader-bar">
            <div class="loader-progress"></div>
        </div>
    </div>
</div>

<header class="header" id="header">
    <div class="header-container">
        <a href="index.php" class="logo">
            <div class="logo-icon"><i class="fas fa-hard-hat"></i></div>
            <span class="logo-text">H&K <span class="logo-accent">Services</span></span>
        </a>
        <nav class="nav-menu" id="navMenu">
            <ul class="nav-list">
                <li><a href="index.php" class="nav-link">Accueil</a></li>
                <li><a href="services.php" class="nav-link">Services</a></li>
                <li><a href="boutique.php" class="nav-link">Boutique</a></li>
                <li><a href="realisations.php" class="nav-link active">Réalisations</a></li>
                <li><a href="apropos.php" class="nav-link">À propos</a></li>
                <li><a href="contact.php" class="nav-link">Contact</a></li>
            </ul>
        </nav>
        <div class="header-actions">
            <a href="panier.php" class="cart-btn">
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-count" id="cartCount">0</span>
            </a>
            <a href="https://wa.me/330605682407" class="whatsapp-btn" target="_blank">
                <i class="fab fa-whatsapp"></i>
            </a>
            <a href="contact.php" class="quote-btn">Devis Gratuit</a>
            <button class="menu-toggle" id="menuToggle">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>
</header>

<section class="page-hero">
    <div class="page-hero-bg">
        <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=1920" alt="Réalisations">
        <div class="page-hero-overlay"></div>
    </div>
    <div class="page-hero-content" data-aos="fade-up">
        <h1>Nos Réalisations</h1>
        <p>Découvrez nos projets emblématiques</p>
        <div class="breadcrumb">
            <a href="index.php">Accueil</a>
            <i class="fas fa-chevron-right"></i>
            <span>Réalisations</span>
        </div>
    </div>
</section>

<section class="realisations-section">
    <div class="gallery-filters" data-aos="fade-up">
        <button class="filter-btn active" data-filter="all">Tous</button>
        <button class="filter-btn" data-filter="villas">Villas</button>
        <button class="filter-btn" data-filter="toitures">Toitures</button>
        <button class="filter-btn" data-filter="immeubles">Immeubles</button>
        <button class="filter-btn" data-filter="renovations">Rénovations</button>
        <button class="filter-btn" data-filter="amenagement">Am&eacute;nagement</button>
        <button class="filter-btn" data-filter="commercial">Commercial</button>
    </div>

    <div class="gallery-grid">
        <?php
        $db = getDB();
        $projects = $db->query("SELECT * FROM projects WHERE active=1 ORDER BY id DESC")->fetchAll();
        $delay = 100;
        foreach ($projects as $proj):
            $images = json_decode($proj['images'] ?? '[]', true);
            $img = $proj['thumbnail'] ?: ($images[0] ?? 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=800');
            $category = strtolower(sanitize($proj['category'] ?? 'villas'));
        ?>
        <div class="gallery-item" data-category="<?= $category ?>" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
            <img src="<?= sanitize($img) ?>" alt="<?= sanitize($proj['title']) ?>">
            <div class="gallery-overlay">
                <span class="gallery-category"><?= ucfirst($category) ?></span>
                <h4><?= sanitize($proj['title']) ?></h4>
                <?php if ($proj['location']): ?><p><?= sanitize($proj['location']) ?></p><?php endif; ?>
                <div class="gallery-meta">
                    <?php if ($proj['surface']): ?><span><i class="fas fa-ruler-combined"></i> <?= sanitize($proj['surface']) ?></span><?php endif; ?>
                </div>
                <a href="/projets/<?= sanitize($proj['slug'] ?: $proj['id']) ?>" class="gallery-link">Voir le projet <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
        <?php $delay += 100; endforeach; ?>
    </div>
</section>

<section class="stats-section">
    <div class="stats-container">
        <div class="stats-grid">
            <div class="stat-item" data-count="250">
                <div class="stat-number">0</div>
                <div class="stat-label">Projets réalisés</div>
            </div>
            <div class="stat-item" data-count="180">
                <div class="stat-number">0</div>
                <div class="stat-label">Clients satisfaits</div>
            </div>
            <div class="stat-item" data-count="10">
                <div class="stat-number">0</div>
                <div class="stat-label">Ans d'expérience</div>
            </div>
            <div class="stat-item" data-count="15">
                <div class="stat-number">0</div>
                <div class="stat-label">Artisans qualifiés</div>
            </div>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="cta-container" data-aos="zoom-in">
        <h2>Vous avez un projet?</h2>
        <p>Parlons ensemble de votre prochaine réalisation</p>
        <div class="cta-buttons">
            <a href="contact.php" class="btn-primary">Contactez-nous</a>
            <a href="tel:+330605682407" class="btn-secondary">
                <i class="fas fa-phone"></i> +33 06 05 68 24 07
            </a>
        </div>
    </div>
</section>

<footer class="footer">
    <div class="footer-container">
        <div class="footer-col">
            <a href="index.php" class="footer-logo">
                <div class="logo-icon"><i class="fas fa-hard-hat"></i></div>
                <span class="logo-text">H&K <span class="logo-accent">Services</span></span>
            </a>
            <p>Entreprise de construction et roofing premium basée à La Teste-de-Buch.</p>
        </div>
        <div class="footer-col">
            <h4>Services</h4>
            <ul>
                <li><a href="services.php">Construction</a></li>
                <li><a href="services.php">Toiture</a></li>
                <li><a href="services.php">Rénovation</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Boutique</h4>
            <ul>
                <li><a href="boutique.php">Matériaux</a></li>
                <li><a href="boutique.php">Outils</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Contact</h4>
            <ul>
                <li><i class="fas fa-phone"></i> +33 06 05 68 24 07</li>
                <li><i class="fas fa-map-marker-alt"></i> La Teste-de-Buch</li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2025 H&K Services — Tous droits réservés</p>
    </div>
</footer>

<a href="https://wa.me/330605682407" class="floating-whatsapp" target="_blank">
    <i class="fab fa-whatsapp"></i>
</a>

<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script src="script.js"></script>
<script>
    AOS.init({ duration: 1000, once: true });
    updateCartCount();
    initGalleryFilter();
</script>
</body>
</html>
