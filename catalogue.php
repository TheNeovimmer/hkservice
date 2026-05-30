<?php
require_once __DIR__ . '/includes/helpers.php';
$activeNav = 'catalogue';
$pageTitle = 'E-Catalogue | H&K Services';
$pageMeta = ['title' => $pageTitle, 'desc' => 'Consultez nos catalogues interactifs, brochures PDF et liens utiles H&K Services.'];
require_once __DIR__ . '/includes/site-head.php';
?>
<style>
.catalogue-section { padding: 80px 0; }
.catalogue-card { background: #fff; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,.08); padding: 30px; text-align: center; transition: transform .3s; margin-bottom: 30px; }
.catalogue-card:hover { transform: translateY(-5px); }
.catalogue-card .icon { font-size: 3rem; color: #312783; margin-bottom: 15px; }
.catalogue-card h3 { font-size: 1.2rem; font-weight: 700; margin-bottom: 10px; }
.catalogue-card p { color: #6c757d; font-size: .9rem; margin-bottom: 20px; }
.catalogue-card .btn-catalogue { background: linear-gradient(135deg, #312783, #1f1a5c); color: #fff; padding: 10px 30px; border-radius: 30px; text-decoration: none; display: inline-block; font-weight: 600; transition: opacity .3s; }
.catalogue-card .btn-catalogue:hover { opacity: .9; color: #fff; }
</style>
</head>
<body>
<div class="page-wrapper">
<?php include __DIR__ . '/includes/site-preloader.php'; ?>
<?php include __DIR__ . '/includes/site-navbar.php'; ?>
<?php include __DIR__ . '/includes/site-mobile-menu.php'; ?>
<section class="page-banner">
  <div class="image-layer" style="background-image: url('img/background/image-7.png')"></div>
  <div class="shape-1"></div>
  <div class="shape-2"></div>
  <div class="banner-inner">
    <div class="auto-container">
      <div class="inner-container clearfix">
        <h1>E-<span>Catalogue</span></h1>
        <div class="page-nav">
          <ul class="bread-crumb clearfix">
            <li><a href="index.php">Page d'accueil</a></li>
            <li class="active">Catalogue</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="catalogue-section">
  <div class="auto-container">
    <div class="row">
      <?php
      $db = getDB();
      $items = $db->query("SELECT * FROM catalog_items WHERE active=1 ORDER BY order_index ASC")->fetchAll();
      foreach ($items as $item):
        $icon = $item['file_type'] === 'flipbook' ? 'fa-book-open' : ($item['file_type'] === 'pdf' ? 'fa-file-pdf' : 'fa-link');
        $btnText = $item['file_type'] === 'flipbook' ? 'Lire en ligne' : ($item['file_type'] === 'pdf' ? 'Télécharger PDF' : 'Visiter le lien');
      ?>
      <div class="col-lg-4 col-md-6">
        <div class="catalogue-card">
          <div class="icon"><i class="fas <?= $icon ?>"></i></div>
          <h3><?= sanitize($item['title']) ?></h3>
          <?php if ($item['description']): ?><p><?= sanitize($item['description']) ?></p><?php endif; ?>
          <a href="<?= sanitize($item['file_url']) ?>" target="_blank" class="btn-catalogue"><?= $btnText ?></a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php include __DIR__ . '/includes/site-footer.php'; ?>
</div>
<?php include __DIR__ . '/includes/site-scripts.php'; ?>
</body>
</html>
