<?php
http_response_code(404);
$pageTitle = 'Page introuvable | H&K Services';
require_once 'includes/site-head.php';
?>
</head>
<body>
<div class="page-wrapper">
<?php include 'includes/site-preloader.php'; ?>
<?php include 'includes/site-navbar.php'; ?>
<?php include 'includes/site-mobile-menu.php'; ?>

<section class="page-banner">
    <div class="image-layer" style="background-image: url('img/gallery/img5.jpg')"></div>
    <div class="shape-1"></div>
    <div class="shape-2"></div>
    <div class="banner-inner">
        <div class="auto-container">
            <div class="inner-container clearfix">
                <h1>404 - Page introuvable</h1>
                <div class="page-nav">
                    <ul class="bread-crumb clearfix">
                        <li><a href="index.php">Page d'accueil</a></li>
                        <li class="active">404</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="error-section" style="padding:120px 0;text-align:center;">
    <div class="auto-container">
        <h1 style="font-size:120px;font-weight:900;color:#312783;line-height:1;margin-bottom:20px;">404</h1>
        <h3 style="margin-bottom:20px;">Oups ! Cette page n'existe pas.</h3>
        <p style="color:#666;margin-bottom:30px;">La page que vous recherchez a été déplacée ou n'est plus disponible.</p>
        <a href="index.php" class="theme-btn btn-style-one">
            <i class="btn-curve"></i>
            <span class="btn-title">Retour à l'accueil</span>
        </a>
    </div>
</section>

<?php include 'includes/site-footer.php'; ?>
</div>
<?php include 'includes/site-scripts.php'; ?>
</body>
</html>
