<header class="main-header header-style-one">
    <div class="header-upper">
      <div class="inner-container clearfix">
        <div class="logo-box">
          <div class="logo">
            <a href="index.php" title="H&K Services">
              <img src="img/logo png/Logo.png" id="thm-logo" alt="H&K Services" title="H&K Services" />
            </a>
          </div>
        </div>
        <div class="nav-outer clearfix">
          <div class="mobile-nav-toggler">
            <span class="icon flaticon-menu-2"></span><span class="txt">Menu</span>
          </div>
          <nav class="main-menu navbar-expand-md navbar-light">
            <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
              <ul class="navigation clearfix">
                <li class="<?= $activeNav === 'accueil' ? 'active' : '' ?>"><a href="index.php">Accueil</a></li>
                <li class="dropdown <?= $activeNav === 'services' ? 'active' : '' ?>">
                  <a href="services-construction.php">Nos Services</a>
                  <ul>
                    <li><a href="services-construction.php#etude">Étude de Projet</a></li>
                    <li><a href="services-construction.php#Construction">Travaux Génie Civil</a></li>
                    <li><a href="services-construction.php#Gestion">Travaux Spécifiques</a></li>
                  </ul>
                </li>
                <li class="<?= $activeNav === 'projets' ? 'active' : '' ?>"><a href="projets-construction-batiments.php">Projets</a></li>
                <li class="<?= $activeNav === 'catalogue' ? 'active' : '' ?>"><a href="catalogue.php">E-Catalogue</a></li>
                <li class="<?= $activeNav === 'societe' ? 'active' : '' ?>"><a href="societe-batiment.php">Qui Sommes Nous</a></li>
                <li class="<?= $activeNav === 'boutique' ? 'active' : '' ?>"><a href="boutique.php">Boutique</a></li>
                <li class="<?= $activeNav === 'contact' ? 'active' : '' ?>"><a href="contact.php">Contactez-nous</a></li>
              </ul>
            </div>
          </nav>
        </div>
        <div class="other-links clearfix">
          <div class="link-box">
            <div class="call-us">
              <a class="link" href="tel:+330605682407">
                <span class="icon"></span>
                <span class="sub-text">Appelez à tout moment</span>
                <span class="number">+330605682407</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
