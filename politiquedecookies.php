<?php
$activeNav = '';
$pageTitle = 'H&K Services - Politique de cookies';
$pageMeta = ['title' => 'H&K Services - Politique de cookies', 'desc' => 'Politique de cookies de H&K Services, société française de construction.'];
require_once 'includes/site-head.php';
?>
<style>
    .slider {
        position: relative;
        height: 0px;
        padding-bottom: 66.666666667%;
        margin-top: 24px;
        margin-bottom: 24px;
    }
    .slider__after {
        position: absolute;
        top: 0px;
        left: 0px;
        z-index: 1;
        width: 100%;
        height: 100%;
        background-image: url('img/project/Project1/1.png');
        background-size: cover;
        pointer-events: none;
    }
    .slider__before {
        position: absolute;
        top: 0px;
        left: 0px;
        z-index: 2;
        width: 50%;
        height: 100%;
        background-image: url('img/project/Project1/1.png');
        background-size: cover;
        pointer-events: none;
        overflow: hidden;
    }
    .slider__before:before {
        content: 'Avant';
        position: absolute;
        left: 8px;
        top: 8px;
        color: white;
        text-transform: uppercase;
        font-weight: bold;
    }
    .slider__after:before {
        content: 'Après';
        position: absolute;
        right: 8px;
        top: 8px;
        color: white;
        text-transform: uppercase;
        font-weight: bold;
    }
    .slider__separator {
        position: absolute;
        left: 50%;
        width: 2px;
        top: 0px;
        bottom: 0px;
        background: rgba(255, 255, 255, 0.7);
        box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.5);
        cursor: ew-resize;
        z-index: 3;
        transform: translateX(-50%);
    }
    .slider__range {
        position: absolute;
        width: 100%;
        bottom: 0px;
        z-index: 3;
        appearance: none;
        background: rgba(255, 255, 255, 0.3);
        outline: none;
        margin: 0px;
    }
    .slider__range::-webkit-slider-thumb {
        -webkit-appearance: none;
        width: 12px;
        height: 16px;
        background: white;
    }
    .slider__range::-moz-slider-thumb {
        -moz-appearance: none;
        width: 12px;
        height: 16px;
        background: white;
    }
    .slider--tokyo .slider__before {
        background-image: url('img/project/Project1/1.png');
    }
    .slider--tokyo .slider__after {
        background-image: url('img/project/Project1/2.png');
    }
    .slider--tokyo .slider__separator:before {
        content: '';
        width: 32px;
        height: 32px;
        border-radius: 50%;
        border: solid 2px white;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .slider--tokyo .slider__range {
        display: none;
    }
    .slider--tokyo .slider__before:before,
    .slider--tokyo .slider__after:before {
        top: 50%;
        transform: translateY(-50%);
        background: rgb(220, 193, 81);
        padding: 8px 16px;
        margin-left: 8px;
        margin-right: 8px;
    }
</style>
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
            <input type="text" name="search" placeholder="Entrez ici pour rechercher...." />
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
                <h1>Politique de cookies</h1>
                <div class="page-nav">
                    <ul class="bread-crumb clearfix">
                        <li><a href="index.php">Page d'accueil</a></li>
                        <li class="active">Politique de cookies</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

</div>

<div class="auto-container">
    <div class="row clearfix">
        <section id="politique-de-cookies">
            <h4 style="padding-top: 30px;">1. Introduction</h4>
            <p>Cette Politique de Cookies explique comment <strong>H&K Services</strong> utilise les cookies et technologies similaires pour reconnaître les utilisateurs sur notre site web.</p>

            <h4 style="padding-top: 30px;">2. Qu'est-ce qu'un Cookie ?</h4>
            <p>Un cookie est un petit fichier texte stocké sur votre appareil lorsque vous visitez un site web. Les cookies aident à améliorer votre expérience en mémorisant vos préférences et actions.</p>

            <h4 style="padding-top: 30px;">3. Types de Cookies Utilisés</h4>
            <ul>
                <li><strong>Cookies Essentiels :</strong> Nécessaires au fonctionnement du site (par exemple, pour naviguer sur le site et accéder à des zones sécurisées).</li>
                <li><strong>Cookies de Performance :</strong> Collectent des informations sur la façon dont les visiteurs utilisent le site (par exemple, les pages les plus visitées).</li>
                <li><strong>Cookies de Fonctionnalité :</strong> Permettent au site de mémoriser vos choix (par exemple, langue, région).</li>
                <li><strong>Cookies Publicitaires :</strong> Utilisés pour diffuser des publicités pertinentes et mesurer l'efficacité des campagnes publicitaires.</li>
            </ul>

            <h4 style="padding-top: 30px;">4. Gestion des Cookies</h4>
            <p>Vous pouvez configurer votre navigateur pour refuser les cookies ou pour vous alerter lorsqu'un cookie est envoyé. Veuillez noter que la désactivation des cookies peut affecter le fonctionnement de certaines fonctionnalités du site.</p>

            <h4 style="padding-top: 30px;">5. Consentement</h4>
            <p>En utilisant notre site, vous consentez à l'utilisation des cookies décrits dans cette Politique. Vous pouvez retirer votre consentement à tout moment en modifiant les paramètres de votre navigateur ou en utilisant notre outil de gestion des cookies.</p>

            <h4 style="padding-top: 30px;">6. Modifications de la Politique</h4>
            <p>Nous pouvons mettre à jour cette Politique de Cookies de temps à autre. Toute modification sera publiée sur cette page avec la date de mise à jour.</p>

            <h4 style="padding-top: 30px;">7. Contact</h4>
            <p>Pour toute question concernant notre Politique de Cookies, veuillez nous contacter à contact@hketservices.com.</p>
        </section>
    </div>
</div>

<?php include 'includes/site-footer.php'; ?>
</div><!-- /.page-wrapper -->
<?php include 'includes/site-scripts.php'; ?>
</body>
</html>
