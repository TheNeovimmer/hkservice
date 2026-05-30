<?php
$activeNav = '';
$pageTitle = 'H&K Services - Mentions légales';
$pageMeta = ['title' => 'H&K Services - Mentions légales', 'desc' => 'Mentions légales de H&K Services, société française de construction.'];
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
        background: rgb(0, 68, 255);
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
                <h1>Mentions légales</h1>
                <div class="page-nav">
                    <ul class="bread-crumb clearfix">
                        <li><a href="index.php">Page d'accueil</a></li>
                        <li class="active">Mentions légales</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

</div>

<div class="auto-container">
    <div class="row clearfix">
        <section id="mentions-legales">
            <h4 style="padding-top: 30px;">1. Informations Générales</h4>
            <p>
                <strong>Nom de la société :</strong> H&K Services<br>
                <strong>Forme juridique :</strong> Société SARL<br>
                <strong>Adresse du siège social :</strong> La Teste-de-Buch, France<br>
                <strong>Téléphone :</strong> +330605682407<br>
                <strong>Adresse e-mail :</strong> contact@hketservices.com<br>
                <strong>Site internet :</strong> www.hketservices.com
            </p>

            <h4 style="padding-top: 30px;">2. Directeur de la Publication</h4>
            <p><strong>Nom :</strong> Haikel Moussa</p>

            <h4 style="padding-top: 30px;">3. Hébergeur du Site</h4>
            <p>
                <strong>Nom de l'hébergeur :</strong> OVHCLOUD<br>
                <strong>Adresse :</strong> La Teste-de-Buch, France
            </p>

            <h4 style="padding-top: 30px;">4. Propriété Intellectuelle</h4>
            <p>Tous les contenus présents sur le site H&K Services (textes, images, vidéos, logos, etc.) sont la propriété exclusive de H&K Services ou de leurs auteurs respectifs. Toute reproduction, distribution, modification, ou utilisation non autorisée est strictement interdite.</p>

            <h4 style="padding-top: 30px;">5. Responsabilité</h4>
            <p>H&K Services s'efforce d'assurer l'exactitude et la mise à jour des informations diffusées sur le site. Cependant, la société ne peut garantir l'exactitude, la complétude ou l'actualité des informations fournies. En conséquence, l'utilisateur reconnaît utiliser ces informations sous sa responsabilité exclusive.</p>

            <h4 style="padding-top: 30px;">6. Données Personnelles</h4>
            <p>Pour plus d'informations sur la gestion de vos données personnelles, veuillez consulter notre <a href="politique.php">Politique de confidentialité</a>.</p>

            <h4 style="padding-top: 30px;">7. Litiges</h4>
            <p>En cas de litige, une solution amiable sera recherchée avant toute action judiciaire. À défaut, les tribunaux compétents seront seuls habilités à connaître du litige.</p>
        </section>
    </div>
</div>

<?php include 'includes/site-footer.php'; ?>
</div><!-- /.page-wrapper -->
<?php include 'includes/site-scripts.php'; ?>
</body>
</html>
