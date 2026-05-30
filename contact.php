<?php
$activeNav = 'contact';
$pageTitle = "H&K Services - Contact";
$pageMeta = ['title' => 'H&K Services - Contact', 'desc' => "Contactez H&K Services pour vos projets de construction, renovation et amenagement en Tunisie et en France."];
require_once __DIR__ . '/includes/site-head.php';
?>
</head>
<body>
<div class="page-wrapper">
<?php include __DIR__ . '/includes/site-preloader.php'; ?>
<?php include __DIR__ . '/includes/site-navbar.php'; ?>
<?php include __DIR__ . '/includes/site-mobile-menu.php'; ?>

<section class="page-banner">
    <div class="image-layer" style="background-image: url('img/gallery/img5.jpg')"></div>
    <div class="shape-1"></div>
    <div class="shape-2"></div>
    <div class="banner-inner">
        <div class="auto-container">
            <div class="inner-container clearfix">
                <h1>Contactez-nous</h1>
                <div class="page-nav">
                    <ul class="bread-crumb clearfix">
                        <li><a href="index.php">Accueil</a></li>
                        <li class="active">Contact</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="contact-section contact-two">
    <div class="auto-container">
        <div class="row">
            <div class="col-lg-4">
                <div class="contact-two__content">
                    <div class="sec-title">
                        <h2>Avez-vous un projet de construction en tete ?<span class="dot">.</span></h2>
                    </div>
                    <p class="contact-two__text">
                        H&K Services vous accompagne dans la realisation de vos idees avec professionnalisme, qualite et expertise.
                        Notre equipe est a votre disposition pour repondre a toutes vos demandes d'information, etablir un devis personnalise ou vous conseiller dans chaque etape de votre projet.
                        N'hesitez pas a nous contacter pour donner vie a vos projets en toute confiance.
                    </p>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="form-box">
                    <div class="default-form">
                        <?php if (isset($_GET['sent']) && $_GET['sent'] === 'ok'): ?>
                        <div class="contact-success" style="background:#ecfdf5;border:1px solid #bbf7d0;border-radius:10px;padding:1.5rem;text-align:center;margin-bottom:1.5rem;">
                            <i class="fas fa-check-circle" style="font-size:2.5rem;color:#16a34a;margin-bottom:.5rem;display:block;"></i>
                            <h4 style="color:#166534;font-weight:700;margin-bottom:.25rem;">Message envoye avec succes !</h4>
                            <p style="color:#15803d;font-size:.9rem;margin:0;">Nous vous repondrons dans les plus brefs delais.</p>
                        </div>
                        <?php endif; ?>
                        <?php if (isset($_GET['error'])): ?>
                        <div class="contact-error" style="background:#fef2f2;border:1px solid #fecaca;border-radius:10px;padding:.75rem 1rem;color:#dc2626;font-size:.85rem;display:flex;align-items:center;gap:.5rem;margin-bottom:1rem;">
                            <i class="fas fa-exclamation-circle"></i>
                            <span>Erreur : <?= sanitize($_GET['error']) ?></span>
                        </div>
                        <?php endif; ?>

                        <form id="contact-form" method="post" action="contact-submit.php">
                            <div class="row clearfix">
                                <div class="col-lg-12">
                                    <h3 class="section-title">Informations generales :</h3>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <div class="field-inner">
                                        <input type="text" name="from_name" placeholder="Nom de la societe / Nom du client" required />
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <div class="field-inner">
                                        <input type="email" name="email_id" placeholder="Adresse e-mail" />
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <div class="field-inner">
                                        <input type="tel" name="tel" placeholder="Numero de telephone" required />
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <div class="field-inner">
                                        <input type="text" name="Lieu" placeholder="Adresse du projet (lieu de construction)" />
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <h3 class="section-title">Type de projet :</h3>
                                </div>
                                <div class="form-group col-lg-4 col-md-4 col-sm-4">
                                    <div class="field-inner">
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="service[]" value="Nouvelle construction" />
                                            <span class="checkbox-custom"></span>
                                            Nouvelle construction
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-lg-4 col-md-4 col-sm-4">
                                    <div class="field-inner">
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="service[]" value="Renovation / Extension" id="renovation-extension" />
                                            <span class="checkbox-custom"></span>
                                            Renovation / Extension
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-lg-4 col-md-4 col-sm-4">
                                    <div class="field-inner">
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="service[]" value="Amenagement interieur" id="amenagement-interieur" />
                                            <span class="checkbox-custom"></span>
                                            Amenagement interieur
                                        </label>
                                    </div>
                                </div>

                                <div class="col-lg-12" id="existing-heading" style="display:none;">
                                    <h3 class="section-title">En cas de construction existante :</h3>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12 existing-detail" style="display:none;">
                                    <div class="field-inner">
                                        <input type="text" name="nature_batiment" placeholder="Nature du batiment existant (maison, immeuble, local commercial ...)" />
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12 existing-detail" style="display:none;">
                                    <div class="field-inner">
                                        <input type="number" name="annee_construction" placeholder="Annee de construction" />
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12 existing-detail" style="display:none;">
                                    <div class="field-inner">
                                        <input type="number" name="superficie_actuelle" placeholder="Superficie actuelle (m2)" />
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <h3 class="section-title">Terrain :</h3>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <label style="display:block;margin-bottom:.5rem;font-weight:500;color:#333;font-size:.9rem;">Proprietaire du terrain :</label>
                                    <div class="field-inner" style="display:flex;gap:1.5rem;">
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="proprietaire_terrain" value="Oui" />
                                            <span class="checkbox-custom"></span>
                                            Oui
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="proprietaire_terrain" value="Non" />
                                            <span class="checkbox-custom"></span>
                                            Non
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <div class="field-inner">
                                        <input type="text" name="adresse_terrain" placeholder="Adresse du terrain" />
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <div class="field-inner">
                                        <input type="number" name="superficie_terrain" placeholder="Superficie du terrain (m2)" />
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <div class="field-inner">
                                        <input type="text" name="statut_administratif" placeholder="Statut administratif (pret a construire, en cours de validation ...)" />
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <h3 class="section-title">Details techniques :</h3>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <div class="field-inner">
                                        <input type="text" name="type_construction" placeholder="Type de construction (Residentiel, commercial, industriel ...)" />
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <div class="field-inner">
                                        <input type="text" name="budget_estime" placeholder="Budget estime" />
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <div class="field-inner">
                                        <input type="text" name="delais_souhaite" placeholder="Delais souhaites (date de debut et de fin)" />
                                    </div>
                                </div>

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <div class="field-inner">
                                        <textarea name="message" placeholder="Message" rows="5"></textarea>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <button class="theme-btn btn-style-one" type="submit">
                                        <i class="btn-curve"></i>
                                        <span class="btn-title">Envoyer</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/site-footer.php'; ?>
</div>
<?php include __DIR__ . '/includes/site-scripts.php'; ?>
<script>
(function() {
    var renovation = document.getElementById('renovation-extension');
    var amenagement = document.getElementById('amenagement-interieur');
    var heading = document.getElementById('existing-heading');
    var details = document.querySelectorAll('.existing-detail');

    function toggleExisting() {
        var show = (renovation && renovation.checked) || (amenagement && amenagement.checked);
        if (heading) heading.style.display = show ? 'block' : 'none';
        details.forEach(function(el) { el.style.display = show ? 'block' : 'none'; });
    }

    if (renovation) renovation.addEventListener('change', toggleExisting);
    if (amenagement) amenagement.addEventListener('change', toggleExisting);
})();
</script>
</body>
</html>
