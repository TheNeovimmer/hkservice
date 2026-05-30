<?php
$activeNav = '';
$pageTitle = 'H&K Services - Politique de confidentialité';
$pageMeta = ['title' => 'H&K Services - Politique de confidentialité', 'desc' => 'Politique de confidentialité de H&K Services, société française de construction.'];
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
                <h1>Politique de confidentialité</h1>
                <div class="page-nav">
                    <ul class="bread-crumb clearfix">
                        <li><a href="index.php">Page d'accueil</a></li>
                        <li class="active">Politique de confidentialité</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

</div>

<div class="auto-container">
    <div class="row clearfix">
        <section id="politique-de-confidentialite">
            <h4 style="padding-top: 30px;">1. Introduction</h4>
            <p>La présente Politique de Confidentialité explique comment <strong>H&K Services</strong> collecte, utilise, partage et protège les informations personnelles des utilisateurs de notre site web.</p>

            <h4 style="padding-top: 30px;">2. Données Collectées</h4>
            <p>Nous pouvons collecter les types d'informations suivants :</p>
            <ul>
                <li><strong>Informations d'identification :</strong> nom, prénom, adresse e-mail, numéro de téléphone.</li>
                <li><strong>Informations de navigation :</strong> adresse IP, type de navigateur, pages visitées, temps passé sur le site.</li>
                <li><strong>Cookies :</strong> Nous utilisons des cookies pour améliorer votre expérience utilisateur. Vous pouvez consulter notre <a href="politiquedecookies.php">Politique de Cookies</a> pour plus de détails.</li>
            </ul>

            <h4 style="padding-top: 30px;">3. Utilisation des Données</h4>
            <p>Les données collectées sont utilisées pour :</p>
            <ul>
                <li>Répondre à vos demandes de devis et questions.</li>
                <li>Améliorer notre site et nos services.</li>
                <li>Vous envoyer des informations sur nos services (avec votre consentement).</li>
                <li>Respecter nos obligations légales et réglementaires.</li>
            </ul>

            <h4 style="padding-top: 30px;">4. Partage des Données</h4>
            <p>Nous ne partageons pas vos données personnelles avec des tiers, sauf :</p>
            <ul>
                <li>Avec votre consentement explicite.</li>
                <li>Pour répondre à une obligation légale ou réglementaire.</li>
                <li>Avec des prestataires de services tiers (hébergement, maintenance) qui sont tenus de respecter la confidentialité de vos données.</li>
            </ul>

            <h4 style="padding-top: 30px;">5. Sécurité des Données</h4>
            <p>Nous mettons en œuvre des mesures de sécurité techniques et organisationnelles appropriées pour protéger vos données personnelles contre tout accès non autorisé, modification, divulgation ou destruction.</p>

            <h4 style="padding-top: 30px;">6. Vos Droits</h4>
            <p>Conformément au Règlement Général sur la Protection des Données (RGPD), vous disposez des droits suivants :</p>
            <ul>
                <li>Droit d'accès à vos données personnelles.</li>
                <li>Droit de rectification de vos données inexactes.</li>
                <li>Droit à l'effacement de vos données ("droit à l'oubli").</li>
                <li>Droit à la limitation du traitement.</li>
                <li>Droit à la portabilité de vos données.</li>
                <li>Droit d'opposition au traitement de vos données.</li>
            </ul>
            <p>Pour exercer vos droits, veuillez nous contacter à l'adresse e-mail suivante : contact@hketservices.com</p>

            <h4 style="padding-top: 30px;">7. Modifications de la Politique</h4>
            <p>Nous pouvons mettre à jour cette Politique de Confidentialité de temps à autre. Toute modification sera publiée sur cette page avec la date de mise à jour.</p>

            <h4 style="padding-top: 30px;">8. Contact</h4>
            <p>Pour toute question concernant cette Politique de Confidentialité, veuillez nous contacter à contact@hketservices.com.</p>
        </section>
    </div>
</div>

<?php include 'includes/site-footer.php'; ?>
</div><!-- /.page-wrapper -->
<?php include 'includes/site-scripts.php'; ?>
</body>
</html>
