<?php
$activeNav = 'societe';
$pageTitle = "une entreprise française spécialisée dans le bâtiment : H&K Services";
$pageMeta = ['title' => 'H&K Services - Société de bâtiment', 'desc' => "Découvrez notre société de bâtiment en France, notre équipe, nos clients et notre engagement envers l'excellence dans le secteur de la construction."];
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
            <input type="text" name="search" placeholder="Entrez ici pour rechercher...." />
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
</div>

<section class="page-banner">
    <div class="image-layer" style="background-image:url('img/gallery/img5.jpg');"></div>
    <div class="shape-1"></div>
    <div class="shape-2"></div>
    <div class="banner-inner">
        <div class="auto-container">
            <div class="inner-container clearfix">
                <h1>Construire avec confiance et exigence</h1>
                <div class="page-nav">
                    <ul class="bread-crumb clearfix">
                        <li><a href="index.php">Home</a></li>
                        <li class="active">Qui Sommes Nous</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="featured-section featured-section__about-two">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="left-col col-lg-6 col-md-12 col-sm-12">
                <div class="inner wow fadeInLeft animated" data-wow-delay="0ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInLeft;">
                    <div class="image-box"><img src="img/gallery/im1.jpg" alt=""></div>
                </div>
            </div>
            <div class="right-col col-lg-6 col-md-12 col-sm-12">
                <div class="inner">
                    <div class="sec-title">
                        <h2>Votre Partenaire de Confiance pour les Travaux de Bâtiment en France <span class="dot">.</span></h2>
                        <div class="lower-text">
                            Depuis 2018, H&K Services accompagne ses clients dans la réalisation de projets de construction résidentiels et commerciaux en France.<br /><br />
                            Forte d'une solide expérience dans le secteur du bâtiment, notre entreprise conçoit et réalise des espaces modernes, fonctionnels et durables, répondant aux exigences les plus élevées en matière de qualité et de sécurité.<br /><br />
                            Grâce à une équipe qualifiée et passionnée, nous intervenons dans la construction de villas, maisons individuelles, immeubles résidentiels ainsi que locaux et espaces commerciaux.<br /><br />
                            Notre priorité est d'offrir à chaque client un accompagnement personnalisé, un suivi rigoureux des travaux et le respect des délais convenus, afin de garantir des réalisations à la hauteur de leurs attentes.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="feature col-md-6 col-sm-12">
                <div class="inner-box">
                    <h6>Un engagement envers la qualité</h6>
                    <div class="text">
                        Chez H&K Services, la qualité constitue le fondement de chacune de nos réalisations. Nous mobilisons notre savoir-faire et notre expertise afin de concevoir et réaliser des projets de construction modernes, durables et exécutés avec une grande précision.<br /><br />
                        Chaque chantier est conduit avec rigueur, professionnalisme et un souci constant du détail, garantissant ainsi des résultats conformes aux attentes de nos clients.<br /><br />
                        Notre engagement repose sur la fourniture de constructions fiables, sécurisées et respectant les normes les plus strictes du secteur.
                    </div>
                </div>
            </div>
            <div class="feature col-md-6 col-sm-12">
                <div class="inner-box">
                    <h6>Des projets réalisés avec succès</h6>
                    <div class="text">
                        Avec plus de 100 projets réalisés, H&K Services a su développer une solide expérience et un savoir-faire reconnu dans le secteur de la construction. Chaque réalisation témoigne de notre engagement envers la qualité, la précision et la satisfaction de nos clients.<br /><br />
                        Au fil des années, nous avons transformé les idées et les ambitions de nos clients en projets concrets, durables et parfaitement exécutés, tout en respectant les délais convenus ainsi que les budgets définis.<br /><br />
                        Notre expertise nous permet aujourd'hui de garantir des réalisations fiables, modernes et adaptées aux exigences spécifiques de chaque projet.
                    </div>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="feature col-md-6 col-sm-12">
                <div class="inner-box">
                    <h6>Des clients satisfaits</h6>
                    <div class="text">
                        La satisfaction de nos clients est au cœur de notre engagement. Plus de 100 clients nous ont déjà accordé leur confiance et témoignent aujourd'hui de notre sérieux, de notre professionnalisme et de la qualité de nos réalisations.<br /><br />
                        Chez H&K Services, chaque projet est une relation de confiance construite avec transparence, écoute et engagement. La réussite et la satisfaction de nos clients représentent notre plus grande motivation et renforcent chaque jour notre passion pour l'excellence.
                    </div>
                </div>
            </div>
            <div class="feature col-md-6 col-sm-12">
                <div class="inner-box">
                    <h6>Distinction : élue brand de l'année</h6>
                    <div class="text">
                        Nous sommes fiers d'avoir été élus "Brand de l'Année" pendant deux années consécutives, en 2021 et 2022. Cette reconnaissance reflète notre engagement permanent envers l'excellence, la qualité et la sécurité dans chacun de nos projets.<br /><br />
                        Chez H&K Services, cette distinction représente la confiance de nos clients ainsi que le professionnalisme de notre équipe, qui travaille chaque jour avec passion pour offrir des réalisations fiables, modernes et conformes aux standards les plus exigeants.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="parallax-section jarallax" data-jarallax data-speed="0.3" data-imgPosition="50% 80%">
    <img src="img/background/image-2.jpg" alt="" class="jarallax-img" />
    <div class="auto-container">
        <div class="content-box">
            <h2>H&K Services. <span>Votre projet, notre expertise, un résultat exceptionnel.</span></h2>
        </div>
    </div>
</section>

<section class="testimonials-section">
    <div class="auto-container">
        <div class="sec-title">
            <h2>Clients satisfaits<span class="dot">.</span></h2>
        </div>
        <div class="carousel-box">
            <div class="testimonials-carousel owl-theme owl-carousel">
                <div class="testi-block">
                    <div class="inner">
                        <div class="icon"><span>"</span></div>
                        <div class="info">
                            <div class="image"><img src="img/resource/author-1.png" alt=""></div>
                            <div class="name">Jihed</div>
                            <div class="designation">Client</div>
                        </div>
                        <div class="text">Fondée en 2018, H&K Services est une spécialisée dans les Projets résidentiels et commerciaux Nous nous distinguons par notre engagement envers la qualité et notre capacité à satisfaire pleinement nos clients respecter les normes les plus strictes en matière de qualité, de budget et de délais.</div>
                        <div class="whatsapp-icon"><i class="fab fa-facebook"></i></div>
                    </div>
                </div>
                <div class="testi-block">
                    <div class="inner">
                        <div class="icon"><span>"</span></div>
                        <div class="info">
                            <div class="image"><img src="img/resource/author-1.png" alt=""></div>
                            <div class="name">Mohamed</div>
                            <div class="designation">Client</div>
                        </div>
                        <div class="text">H&K Services est une société spécialisée dans la construction de bâtiments résidentiels et commerciaux en France. Depuis sa création, l'entreprise s'engage à offrir des solutions de construction modernes, fiables et durables, répondant aux besoins et aux exigences de chaque client.</div>
                        <div class="whatsapp-icon"><i class="fab fa-facebook"></i></div>
                    </div>
                </div>
                <div class="testi-block">
                    <div class="inner">
                        <div class="icon"><span>"</span></div>
                        <div class="info">
                            <div class="image"><img src="img/resource/author-1.png" alt=""></div>
                            <div class="name">Kenza</div>
                            <div class="designation">Client</div>
                        </div>
                        <div class="text">aya, Re-bonjour très beau travail, je te remercie infiniment et je te félicite.</div>
                        <div class="whatsapp-icon"><i class="fab fa-whatsapp"></i></div>
                    </div>
                </div>
                <div class="testi-block">
                    <div class="inner">
                        <div class="icon"><span>"</span></div>
                        <div class="info">
                            <div class="image"><img src="img/resource/author-1.png" alt=""></div>
                            <div class="name">Slim</div>
                            <div class="designation">Client</div>
                        </div>
                        <div class="text">Merci pour votre travail pour moi ça me convient très bien.</div>
                        <div class="whatsapp-icon"><i class="fab fa-whatsapp"></i></div>
                    </div>
                </div>
                <div class="testi-block">
                    <div class="inner">
                        <div class="icon"><span>"</span></div>
                        <div class="info">
                            <div class="image"><img src="img/resource/author-1.png" alt=""></div>
                            <div class="name">Wissem</div>
                            <div class="designation">Client</div>
                        </div>
                        <div class="text">Bonsoir, Merci pour les photos, on est contents de l'avancement des travaux.</div>
                        <div class="whatsapp-icon"><i class="fab fa-whatsapp"></i></div>
                    </div>
                </div>
                <div class="testi-block">
                    <div class="inner">
                        <div class="icon"><span>"</span></div>
                        <div class="info">
                            <div class="image"><img src="img/resource/author-1.png" alt=""></div>
                            <div class="name">Monia</div>
                            <div class="designation">Client</div>
                        </div>
                        <div class="text">Merci, je suis contente de travailler avec vous et je souhaite que cela continue dans l'ensemble de mes projets. Bonne journée.</div>
                        <div class="whatsapp-icon"><i class="fab fa-whatsapp"></i></div>
                    </div>
                </div>
                <div class="testi-block">
                    <div class="inner">
                        <div class="icon"><span>"</span></div>
                        <div class="info">
                            <div class="image"><img src="img/resource/author-1.png" alt=""></div>
                            <div class="name">Inès</div>
                            <div class="designation">Client</div>
                        </div>
                        <div class="text">Bonjour, Merci beaucoup pour le travail effectué.</div>
                        <div class="whatsapp-icon"><i class="fab fa-whatsapp"></i></div>
                    </div>
                </div>
                <div class="testi-block">
                    <div class="inner">
                        <div class="icon"><span>"</span></div>
                        <div class="info">
                            <div class="image"><img src="img/resource/author-1.png" alt=""></div>
                            <div class="name">Ikram</div>
                            <div class="designation">Client</div>
                        </div>
                        <div class="text">Merci pour le travail accompli. On valide le projet. Bonne journée, Cordialement.</div>
                        <div class="whatsapp-icon"><i class="fab fa-whatsapp"></i></div>
                    </div>
                </div>
                <div class="testi-block">
                    <div class="inner">
                        <div class="icon"><span>"</span></div>
                        <div class="info">
                            <div class="image"><img src="img/resource/author-1.png" alt=""></div>
                            <div class="name">Haikel Moussa</div>
                            <div class="designation">Client</div>
                        </div>
                        <div class="text">En tant que client exigeant, j'aime avoir confiance pour la construction de ma maison et pas toujours me dire si ça a été bien ou mal fait. Avec H&K Services, j'ai trouvé des personnes à l'écoute qui m'ont donné envie de faire confiance.</div>
                        <div class="whatsapp-icon"><i class="fab fa-facebook"></i></div>
                    </div>
                </div>
                <div class="testi-block">
                    <div class="inner">
                        <div class="icon"><span>"</span></div>
                        <div class="info">
                            <div class="image"><img src="img/resource/author-1.png" alt=""></div>
                            <div class="name">Aya</div>
                            <div class="designation">Client</div>
                        </div>
                        <div class="text">Bonjour, Merci pour votre travail, Woooo comme j'ai imaginé !</div>
                        <div class="whatsapp-icon"><i class="fab fa-whatsapp"></i></div>
                    </div>
                </div>
                <div class="testi-block">
                    <div class="inner">
                        <div class="icon"><span>"</span></div>
                        <div class="info">
                            <div class="image"><img src="img/resource/author-1.png" alt=""></div>
                            <div class="name">Ahmed</div>
                            <div class="designation">Client</div>
                        </div>
                        <div class="text">Macha2alh tbarkallah 3likom, Adorable rabi ifadhlk aya, Sublime rien à dire unique parfait.</div>
                        <div class="whatsapp-icon"><i class="fab fa-whatsapp"></i></div>
                    </div>
                </div>
                <div class="testi-block">
                    <div class="inner">
                        <div class="icon"><span>"</span></div>
                        <div class="info">
                            <div class="image"><img src="img/resource/author-1.png" alt=""></div>
                            <div class="name">Amal</div>
                            <div class="designation">Client</div>
                        </div>
                        <div class="text">Macha2allah kil3ada rien à dire raw3a, Ya3tikom sa77a ibdaaa3 bon travail.</div>
                        <div class="whatsapp-icon"><i class="fab fa-whatsapp"></i></div>
                    </div>
                </div>
                <div class="testi-block">
                    <div class="inner">
                        <div class="icon"><span>"</span></div>
                        <div class="info">
                            <div class="image"><img src="img/resource/author-1.png" alt=""></div>
                            <div class="name">Haifa</div>
                            <div class="designation">Client</div>
                        </div>
                        <div class="text">Tous l'équipe ya3tikom alf alf sahha a7la melli konna nitsawrou merci 3ala tawsi3 bel w les idées l mizyanin, Inchalah rabbi ywaf9kom w ya3tikom matimanew un grand merci à tous. tawa chwa9touni akther 3al vidéo en 3D.</div>
                        <div class="whatsapp-icon"><i class="fab fa-whatsapp"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/site-footer.php'; ?>
</div><!-- /.page-wrapper -->
<?php include 'includes/site-scripts.php'; ?>
</body>
</html>
