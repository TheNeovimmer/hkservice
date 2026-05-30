<?php
$activeNav = 'boutique';
$pageTitle = 'Boutique Matériaux | H&K Services';
$pageMeta = ['title' => 'Boutique Matériaux | H&K Services', 'desc' => 'Achetez vos matériaux de construction en ligne'];
require_once 'includes/site-head.php';
?>
<style>
    :root {
      --accent: #312783;
      --accent-dark: #1f1a5c;
      --accent-light: #e8e6f7;
    }

    /* ===== SHOP ===== */
    .shop-section { padding: 80px 0; }

    /* --- Filter via radio --- */
    .filter-radios { display: none; }

    .shop-filter-bar {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      justify-content: center;
      margin-bottom: 40px;
    }
    .shop-filter-bar label {
      padding: 10px 24px;
      border-radius: 50px;
      font-size: .85rem;
      font-weight: 500;
      color: #6c757d;
      background: transparent;
      border: 1px solid #dee2e6;
      transition: .3s;
      font-family: 'Poppins', sans-serif;
      cursor: pointer;
    }
    .shop-filter-bar label:hover { border-color: var(--accent); color: var(--accent); }

    #fTous:checked   ~ .shop-section .shop-filter-bar label[for="fTous"],
    #fMac:checked    ~ .shop-section .shop-filter-bar label[for="fMac"],
    #fRev:checked    ~ .shop-section .shop-filter-bar label[for="fRev"],
    #fPeint:checked  ~ .shop-section .shop-filter-bar label[for="fPeint"],
    #fPlom:checked   ~ .shop-section .shop-filter-bar label[for="fPlom"],
    #fElec:checked   ~ .shop-section .shop-filter-bar label[for="fElec"],
    #fOut:checked    ~ .shop-section .shop-filter-bar label[for="fOut"] {
      background: var(--accent);
      border-color: var(--accent);
      color: #fff;
      font-weight: 600;
      box-shadow: 0 4px 12px rgba(49,39,131,0.3);
    }

    /* Hide / show products */
    .product-card { display: flex; flex-direction: column; }
    #fTous:checked   ~ .shop-section .product-card { display: flex; }
    #fMac:checked    ~ .shop-section .product-card[data-cat="maconnerie"] { display: flex; }
    #fMac:checked    ~ .shop-section .product-card:not([data-cat="maconnerie"]) { display: none; }
    #fRev:checked    ~ .shop-section .product-card[data-cat="revetement"] { display: flex; }
    #fRev:checked    ~ .shop-section .product-card:not([data-cat="revetement"]) { display: none; }
    #fPeint:checked  ~ .shop-section .product-card[data-cat="peinture"] { display: flex; }
    #fPeint:checked  ~ .shop-section .product-card:not([data-cat="peinture"]) { display: none; }
    #fPlom:checked   ~ .shop-section .product-card[data-cat="plomberie"] { display: flex; }
    #fPlom:checked   ~ .shop-section .product-card:not([data-cat="plomberie"]) { display: none; }
    #fElec:checked   ~ .shop-section .product-card[data-cat="electricite"] { display: flex; }
    #fElec:checked   ~ .shop-section .product-card:not([data-cat="electricite"]) { display: none; }
    #fOut:checked    ~ .shop-section .product-card[data-cat="outillage"] { display: flex; }
    #fOut:checked    ~ .shop-section .product-card:not([data-cat="outillage"]) { display: none; }

    /* --- Products Grid --- */
    .products-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 24px;
    }

    .product-card {
      background: #fff;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(0,0,0,0.08);
      transition: .3s;
      height: 100%;
      border: 1px solid transparent;
    }
    .product-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 8px 30px rgba(49,39,131,0.12);
      border-color: var(--accent);
    }

    .product-image {
      height: 220px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: #f8f9fa;
      position: relative;
      overflow: hidden;
    }
    .product-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
      transition: transform .4s ease;
    }
    .product-card:hover .product-image img { transform: scale(1.05); }
    .product-image .img-emoji {
      font-size: 4.5rem;
      line-height: 1;
    }

    .product-badge {
      position: absolute;
      top: 12px; left: 12px;
      z-index: 2;
      padding: 4px 14px;
      border-radius: 50px;
      font-size: .7rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: .5px;
      font-family: 'Poppins', sans-serif;
    }
    .badge-nouveau { background: #10b981; color: #fff; }
    .badge-promotion { background: var(--accent); color: #fff; }
    .badge-populaire { background: var(--accent); color: #fff; }

    .product-body { padding: 20px; flex: 1; display: flex; flex-direction: column; }
    .product-category {
      font-size: .75rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 1px;
      color: var(--accent);
      margin-bottom: 4px;
    }
    .product-name {
      font-size: 1.1rem;
      font-weight: 600;
      color: #1a1a2e;
      margin-bottom: 6px;
      font-family: 'Poppins', sans-serif;
    }
    .product-desc {
      font-size: .85rem;
      color: #6c757d;
      line-height: 1.5;
      margin-bottom: 14px;
      flex: 1;
    }

    /* Colors via radio */
    .product-colors {
      display: flex;
      gap: 8px;
      margin-bottom: 14px;
      align-items: center;
      flex-wrap: wrap;
    }
    .color-label { font-size: .75rem; color: #6c757d; margin-right: 4px; }

    .color-swatch {
      width: 26px;
      height: 26px;
      border-radius: 50%;
      border: 2px solid transparent;
      cursor: pointer;
      transition: .3s;
      flex-shrink: 0;
      display: inline-block;
      position: relative;
    }
    .color-swatch:hover { transform: scale(1.15); }

    .color-swatch input { position: absolute; opacity: 0; width: 0; height: 0; }
    .color-swatch span {
      display: block;
      width: 100%;
      height: 100%;
      border-radius: 50%;
    }
    .color-swatch input:checked ~ span {
      box-shadow: 0 0 0 2px #fff, 0 0 0 4px var(--accent);
    }

    /* Pricing */
    .product-pricing {
      display: flex;
      align-items: baseline;
      gap: 12px;
      margin-bottom: 16px;
      padding: 10px 14px;
      background: #f8f9fa;
      border-radius: 8px;
      border: 1px solid #e9ecef;
    }
    .price-eur { font-size: 1.3rem; font-weight: 700; color: #1a1a2e; }
    .price-tnd { font-size: .85rem; font-weight: 500; color: #6c757d; }

    .btn-shop {
      width: 100%;
      padding: 12px;
      background: linear-gradient(to right, var(--accent), var(--accent-dark));
      color: #fff;
      font-weight: 600;
      border-radius: 8px;
      transition: all 300ms ease;
      font-size: .9rem;
      border: none;
      font-family: 'Poppins', sans-serif;
      cursor: pointer;
      text-align: center;
      display: inline-block;
      text-decoration: none;
      box-shadow: 0 4px 12px rgba(49,39,131,0.2);
    }
    .btn-shop:hover { background: var(--accent-dark); transform: translateY(-2px); color: #fff; text-decoration: none; box-shadow: 0 6px 20px rgba(49,39,131,0.3); }

    /* ===== Cart Toggle (checkbox hack) ===== */
    #cartToggleInput { display: none; }

    .cart-trigger-wrap { text-align: right; margin-bottom: 20px; }
    .cart-trigger-wrap label {
      position: relative;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      color: #fff;
      font-size: .9rem;
      padding: 10px 20px;
      background: linear-gradient(to right, var(--accent), var(--accent-dark));
      border-radius: 8px;
      transition: all 300ms ease;
      cursor: pointer;
      font-family: 'Poppins', sans-serif;
      font-weight: 500;
      box-shadow: 0 4px 12px rgba(49,39,131,0.2);
    }
    .cart-trigger-wrap label:hover { background: var(--accent-dark); transform: translateY(-1px); box-shadow: 0 6px 20px rgba(49,39,131,0.3); }

    .cart-count-badge {
      position: absolute;
      top: -6px; right: -6px;
      width: 22px; height: 22px;
      background: #dc2626;
      color: #fff;
      font-size: .65rem;
      font-weight: 700;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    /* ===== Cart Overlay ===== */
    .cart-overlay {
      position: fixed; inset: 0; z-index: 9998;
      background: rgba(0,0,0,.5);
      backdrop-filter: blur(4px);
      opacity: 0;
      pointer-events: none;
      transition: .3s;
    }
    #cartToggleInput:checked ~ .cart-overlay {
      opacity: 1;
      pointer-events: auto;
    }

    /* ===== Cart Sidebar ===== */
    .cart-sidebar {
      position: fixed; top: 0; right: 0; z-index: 9999;
      width: 420px; max-width: 100vw; height: 100vh;
      background: #fff;
      border-left: 1px solid #e9ecef;
      display: flex; flex-direction: column;
      transform: translateX(100%);
      transition: transform .4s cubic-bezier(.4,0,.2,1);
      box-shadow: -10px 0 40px rgba(0,0,0,.1);
    }
    #cartToggleInput:checked ~ .cart-sidebar {
      transform: translateX(0);
    }

    .cart-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 20px 24px;
      border-bottom: 1px solid #e9ecef;
    }
    .cart-header h3 {
      font-family: 'Poppins', sans-serif;
      font-size: 1.3rem;
      color: #1a1a2e;
      margin: 0;
      font-weight: 600;
    }
    .cart-header label {
      width: 36px; height: 36px;
      display: flex; align-items: center; justify-content: center;
      border-radius: 50%;
      font-size: 1.5rem;
      color: #6c757d;
      cursor: pointer;
      transition: .3s;
    }
    .cart-header label:hover { background: #f8f9fa; color: #1a1a2e; }

    .cart-body { flex: 1; overflow-y: auto; padding: 16px 24px; }

    .cart-empty {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100%;
      text-align: center;
      color: #adb5bd;
    }
    .cart-empty-icon { font-size: 3rem; margin-bottom: 12px; }
    .cart-empty p { font-weight: 600; color: #6c757d; }

    .cart-item {
      display: flex;
      gap: 14px;
      padding: 14px 0;
      border-bottom: 1px solid #f1f3f5;
    }
    .cart-item-img {
      width: 60px; height: 60px;
      border-radius: 8px;
      background: #f8f9fa;
      display: flex; align-items: center; justify-content: center;
      font-size: 1.6rem; flex-shrink: 0;
    }
    .cart-item-info { flex: 1; min-width: 0; }
    .cart-item-name {
      font-weight: 600; font-size: .9rem;
      color: #1a1a2e;
      font-family: 'Poppins', sans-serif;
    }
    .cart-item-detail { font-size: .75rem; color: #6c757d; margin-bottom: 6px; }
    .cart-item-price { font-weight: 700; font-size: .9rem; color: var(--accent); }

    .cart-footer {
      padding: 20px 24px;
      border-top: 1px solid #e9ecef;
      background: #f8f9fa;
    }
    .cart-total-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 8px;
      font-size: .9rem;
      color: #6c757d;
    }
    .cart-total-row:last-of-type { margin-bottom: 16px; }
    .cart-total { font-weight: 800; font-size: 1.1rem; color: #1a1a2e; }

    .btn-cart-checkout {
      width: 100%;
      padding: 14px;
      background: linear-gradient(to right, var(--accent), var(--accent-dark));
      color: #fff;
      border: none;
      border-radius: 8px;
      font-weight: 700;
      font-size: 1rem;
      cursor: pointer;
      transition: all 300ms ease;
      font-family: 'Poppins', sans-serif;
      display: inline-block;
      text-align: center;
      text-decoration: none;
      box-shadow: 0 4px 12px rgba(49,39,131,0.2);
    }
    .btn-cart-checkout:hover { background: var(--accent-dark); transform: translateY(-2px); color: #fff; text-decoration: none; box-shadow: 0 6px 20px rgba(49,39,131,0.3); }

    /* ===== Banner heading brand color ===== */
    .page-banner .banner-inner h1 span,
    .sec-title h2 .dot {
      color: var(--accent) !important;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .products-grid { grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 16px; }
      .cart-sidebar { width: 100%; }
      .shop-filter-bar label { font-size: .8rem; padding: 6px 14px; }
    }
    @media (max-width: 480px) {
      .products-grid { grid-template-columns: 1fr; }
      .product-image { height: 180px; }
    }
  </style>
</head>
<body>
<div class="page-wrapper">
<?php include 'includes/site-preloader.php'; ?>
<?php include 'includes/site-navbar.php'; ?>
<?php include 'includes/site-mobile-menu.php'; ?>

<!-- Banner -->
<section class="page-banner">
  <div class="image-layer" style="background-image: url('img/background/image-7.png')"></div>
  <div class="shape-1"></div>
  <div class="shape-2"></div>
  <div class="banner-inner">
    <div class="auto-container">
      <div class="inner-container clearfix">
        <h1>Notre <span>Boutique</span></h1>
        <div class="page-nav">
          <ul class="bread-crumb clearfix">
            <li><a href="index.html">Page d'accueil</a></li>
            <li class="active">Boutique</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== FILTER RADIOS ===== -->
<input type="radio" name="catFilter" id="fTous" class="filter-radios" checked />
<input type="radio" name="catFilter" id="fMac" class="filter-radios" />
<input type="radio" name="catFilter" id="fRev" class="filter-radios" />
<input type="radio" name="catFilter" id="fPeint" class="filter-radios" />
<input type="radio" name="catFilter" id="fPlom" class="filter-radios" />
<input type="radio" name="catFilter" id="fElec" class="filter-radios" />
<input type="radio" name="catFilter" id="fOut" class="filter-radios" />

<!-- ===== CART CHECKBOX ===== -->
<input type="checkbox" id="cartToggleInput" />

<!-- ===== SHOP SECTION ===== -->
<section class="shop-section">
  <div class="auto-container">
    <div class="sec-title centered">
      <h2>Matériaux de <span class="dot">Construction</span></h2>
      <p style="color:#6c757d; margin-top:8px;">Sélectionnez vos matériaux — Prix en <strong>EUR</strong> / <strong>TND</strong></p>
    </div>

    <!-- Cart trigger -->
    <div class="cart-trigger-wrap">
      <label for="cartToggleInput">
        <i class="fas fa-shopping-cart"></i>
        <span>Panier</span>
        <span class="cart-count-badge">3</span>
      </label>
    </div>

    <!-- Filter bar -->
    <div class="shop-filter-bar">
      <label for="fTous">Tous</label>
      <label for="fMac">Maçonnerie</label>
      <label for="fRev">Revêtement</label>
      <label for="fPeint">Peinture</label>
      <label for="fPlom">Plomberie</label>
      <label for="fElec">Électricité</label>
      <label for="fOut">Outillage</label>
    </div>

    <!-- Products Grid -->
    <div class="products-grid">
      <?php
      $db = getDB();
      $products = $db->query("SELECT p.*, c.name as cat, c.slug as cat_slug FROM products p LEFT JOIN categories c ON c.id=p.category_id WHERE p.active=1 ORDER BY p.category_id, p.order_index ASC")->fetchAll();
      foreach ($products as $p):
        $colors = json_decode($p['colors'] ?? '[]', true);
        $badgeClass = '';
        $badgeText = '';
        if ($p['badge_type'] && $p['badge_type'] !== 'none') {
          $badgeClass = 'badge-' . $p['badge_type'];
          $badgeText = $p['badge_type'] === 'nouveau' ? 'Nouveau' : ($p['badge_type'] === 'promotion' ? 'Promo' : 'Populaire');
        }
      ?>
      <div class="product-card" data-cat="<?= sanitize($p['cat_slug']) ?>">
        <div class="product-image">
          <?php if ($badgeText): ?><span class="product-badge <?= $badgeClass ?>"><?= $badgeText ?></span><?php endif; ?>
          <?php if ($p['image'] && file_exists(__DIR__ . '/' . $p['image'])): ?>
          <img src="<?= $p['image'] ?>" alt="<?= sanitize($p['name']) ?>" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'" />
          <?php endif; ?>
          <span class="img-emoji" style="<?= ($p['image'] && file_exists(__DIR__ . '/' . $p['image'])) ? 'display:none' : 'display:flex' ?>">📦</span>
        </div>
        <div class="product-body">
          <span class="product-category"><?= sanitize($p['cat']) ?></span>
          <h3 class="product-name"><?= sanitize($p['name']) ?></h3>
          <p class="product-desc"><?= sanitize($p['description']) ?></p>
          <?php if (!empty($colors)): ?>
          <div class="product-colors">
            <span class="color-label">Couleurs:</span>
            <?php foreach ($colors as $i => $c): ?>
            <label class="color-swatch"><input type="radio" name="color_<?= $p['id'] ?>" <?= $i === 0 ? 'checked' : '' ?> /><span style="background:<?= $c['hex'] ?>"></span></label>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>
          <div class="product-pricing">
            <span class="price-eur"><?= number_format($p['price_eur'], 2, ',', '') ?> €</span>
            <span class="price-tnd">/ <?= number_format($p['price_tnd'], 3, ',', '') ?> TND</span>
          </div>
          <a href="#cartToggleInput" class="btn-shop" data-id="<?= $p['id'] ?>" data-name="<?= sanitize($p['name']) ?>" data-price="<?= $p['price_eur'] ?>" data-price-tnd="<?= $p['price_tnd'] ?>" data-emoji="📦">Ajouter au panier</a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ===== CART OVERLAY ===== -->
<label class="cart-overlay" for="cartToggleInput"></label>

<!-- ===== CART SIDEBAR ===== -->
<aside class="cart-sidebar">
  <div class="cart-header">
    <h3><i class="fas fa-shopping-cart" style="color:var(--accent);margin-right:8px;"></i>Votre Panier</h3>
    <label for="cartToggleInput">&times;</label>
  </div>
  <div class="cart-body">
    <div class="cart-item">
      <div class="cart-item-img">🧱</div>
      <div class="cart-item-info">
        <div class="cart-item-name">Ciment Portland</div>
        <div class="cart-item-detail">Qté: 2 × 5,50 €</div>
        <div class="cart-item-price">11,00 €</div>
      </div>
    </div>
    <div class="cart-item">
      <div class="cart-item-img">🎨</div>
      <div class="cart-item-info">
        <div class="cart-item-name">Peinture Acrylique</div>
        <div class="cart-item-detail">Qté: 1 × 7,50 €</div>
        <div class="cart-item-price">7,50 €</div>
      </div>
    </div>
  </div>
  <div class="cart-footer">
    <div class="cart-total-row">
      <span>Total (EUR)</span>
      <span class="cart-total" id="cartTotalEUR">0,00 €</span>
    </div>
    <div class="cart-total-row">
      <span>Total (TND)</span>
      <span class="cart-total" id="cartTotalTND">0,000 TND</span>
    </div>
    <a href="contact.html" class="btn-cart-checkout"><i class="fas fa-check-circle" style="margin-right:8px;"></i>Commander</a>
  </div>
</aside>

<?php include 'includes/site-footer.php'; ?>
</div><!-- /.page-wrapper -->
<?php include 'includes/site-scripts.php'; ?>
</body>
</html>
