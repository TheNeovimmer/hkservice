<?php
$activeNav = 'contact';
$pageTitle = "H&K Services - Contact";
$pageMeta = ['title' => 'H&K Services - Contact', 'desc' => "Contactez H&K Services pour vos projets de construction, renovation et amenagement en France."];
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

<style>
#toast {
    position: fixed; bottom: 2rem; left: 50%; transform: translateX(-50%) translateY(20px);
    padding: .85rem 1.8rem; border-radius: 10px; color: #fff; font-weight: 500;
    font-size: .95rem; z-index: 99999; opacity: 0; transition: all .35s ease;
    pointer-events: none; box-shadow: 0 8px 30px rgba(0,0,0,.2);
    white-space: nowrap;
}
#toast.show { opacity: 1; transform: translateX(-50%) translateY(0); }
#toast.success { background: #059669; }
#toast.error { background: #dc2626; }
.contact-enhanced .form-section-title {
    font-family: var(--thm-font);
    font-size: 1.25rem;
    font-weight: 600;
    color: #1a1a2e;
    border-bottom: 2px solid #2563eb;
    padding-bottom: .5rem;
    margin: 1.75rem 0 1.25rem;
    display: flex;
    align-items: center;
    gap: .5rem;
}
.contact-enhanced .form-section-title:first-of-type { margin-top: 0; }
.contact-enhanced .form-section-title i { color: #2563eb; font-size: 1rem; }
.contact-enhanced .field-inner { position: relative; }
.contact-enhanced .field-inner input,
.contact-enhanced .field-inner textarea {
    transition: border-color .2s, box-shadow .2s;
}
.contact-enhanced .field-inner input:focus,
.contact-enhanced .field-inner textarea:focus {
    border-color: #2563eb !important;
    box-shadow: 0 0 0 3px rgba(37,99,235,.1) !important;
}
.contact-enhanced .required-star { color: #dc2626; margin-left: 2px; }
.contact-enhanced .field-label {
    display: block;
    margin-bottom: .4rem;
    font-size: .85rem;
    font-weight: 500;
    color: #374151;
}
.contact-enhanced .field-label .optional-tag {
    font-weight: 400;
    color: #9ca3af;
    font-size: .75rem;
    margin-left: .4rem;
}
.contact-enhanced .checkbox-group { display: flex; flex-wrap: wrap; gap: .5rem 1.5rem; }
.contact-enhanced .checkbox-group .checkbox-label { margin-bottom: 0; }
@keyframes fadeSlideDown {
    from { opacity: 0; transform: translateY(-8px); }
    to { opacity: 1; transform: translateY(0); }
}
.contact-enhanced .alert-success,
.contact-enhanced .alert-error {
    animation: fadeSlideDown .35s ease;
}
</style>
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
                    <div class="default-form contact-enhanced">
                        <?php if (isset($_GET['sent']) && $_GET['sent'] === 'ok'): ?>
                        <div class="alert-success" style="background:#ecfdf5;border:1px solid #bbf7d0;border-radius:10px;padding:1.5rem;text-align:center;margin-bottom:1.5rem;">
                            <i class="fas fa-check-circle" style="font-size:2.5rem;color:#16a34a;margin-bottom:.5rem;display:block;"></i>
                            <h4 style="color:#166534;font-weight:700;margin-bottom:.25rem;">Message envoye avec succes !</h4>
                            <p style="color:#15803d;font-size:.9rem;margin:0;">Nous vous repondrons dans les plus brefs delais.</p>
                        </div>
                        <?php endif; ?>
                        <?php if (isset($_GET['error'])): ?>
                        <div class="alert-error" style="background:#fef2f2;border:1px solid #fecaca;border-radius:10px;padding:.9rem 1.2rem;color:#dc2626;font-size:.85rem;display:flex;align-items:flex-start;gap:.6rem;margin-bottom:1.5rem;">
                            <i class="fas fa-exclamation-circle" style="margin-top:2px;flex-shrink:0;"></i>
                            <div>
                                <strong style="display:block;margin-bottom:2px;">Le formulaire contient des erreurs :</strong>
                                <?php $errList = explode(' | ', $_GET['error']); ?>
                                <ul style="margin:0;padding-left:1.2rem;">
                                <?php foreach ($errList as $e): ?>
                                    <li><?= sanitize($e) ?></li>
                                <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                        <?php endif; ?>

                        <form id="contact-form" method="post" action="contact-submit.php" novalidate>
                            <div class="row clearfix">
                                <div class="col-lg-12">
                                    <h4 class="form-section-title"><i class="fas fa-user"></i> Informations generales</h4>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <label class="field-label">Nom / Societe <span class="required-star">*</span></label>
                                    <div class="field-inner">
                                        <input type="text" name="from_name" placeholder="Ex: Dupont BATIMENT" required />
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <label class="field-label">Adresse e-mail <span class="optional-tag">— optionnel</span></label>
                                    <div class="field-inner">
                                        <input type="email" name="email_id" placeholder="Ex: contact@exemple.fr" />
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <label class="field-label">Telephone <span class="required-star">*</span></label>
                                    <div class="field-inner">
                                        <input type="tel" name="tel" placeholder="Ex: 06 12 34 56 78" required />
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <label class="field-label">Adresse du projet <span class="optional-tag">— optionnel</span></label>
                                    <div class="field-inner">
                                        <input type="text" name="Lieu" placeholder="Ex: 15 Rue de Paris, 75001" />
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <h4 class="form-section-title"><i class="fas fa-hard-hat"></i> Type de projet</h4>
                                </div>
                                <div class="form-group col-lg-12">
                                    <div class="checkbox-group">
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="service[]" value="Nouvelle construction" />
                                            <span class="checkbox-custom"></span>
                                            Nouvelle construction
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="service[]" value="Renovation / Extension" id="renovation-extension" />
                                            <span class="checkbox-custom"></span>
                                            Renovation / Extension
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="service[]" value="Amenagement interieur" id="amenagement-interieur" />
                                            <span class="checkbox-custom"></span>
                                            Amenagement interieur
                                        </label>
                                    </div>
                                </div>

                                <div class="col-lg-12" id="existing-heading" style="display:none;">
                                    <h4 class="form-section-title"><i class="fas fa-building"></i> En cas de construction existante</h4>
                                </div>
                                <div class="form-group col-lg-4 col-md-6 col-sm-12 existing-detail" style="display:none;">
                                    <label class="field-label">Nature du batiment <span class="optional-tag">— optionnel</span></label>
                                    <div class="field-inner">
                                        <input type="text" name="nature_batiment" placeholder="Ex: Maison, immeuble, local commercial" />
                                    </div>
                                </div>
                                <div class="form-group col-lg-4 col-md-6 col-sm-12 existing-detail" style="display:none;">
                                    <label class="field-label">Annee de construction <span class="optional-tag">— optionnel</span></label>
                                    <div class="field-inner">
                                        <input type="number" name="annee_construction" placeholder="Ex: 2020" />
                                    </div>
                                </div>
                                <div class="form-group col-lg-4 col-md-6 col-sm-12 existing-detail" style="display:none;">
                                    <label class="field-label">Superficie actuelle <span class="optional-tag">— optionnel</span></label>
                                    <div class="field-inner">
                                        <input type="number" name="superficie_actuelle" placeholder="Surface en m&sup2;" />
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <h4 class="form-section-title"><i class="fas fa-map-marked-alt"></i> Terrain</h4>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <label class="field-label">Proprietaire du terrain <span class="optional-tag">— optionnel</span></label>
                                    <div class="field-inner" style="display:flex;gap:1.5rem;padding-top:.25rem;">
                                        <label class="checkbox-label">
                                            <input type="radio" name="proprietaire_terrain" value="Oui" />
                                            <span class="checkbox-custom"></span>
                                            Oui
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="radio" name="proprietaire_terrain" value="Non" />
                                            <span class="checkbox-custom"></span>
                                            Non
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <label class="field-label">Adresse du terrain <span class="optional-tag">— optionnel</span></label>
                                    <div class="field-inner">
                                        <input type="text" name="adresse_terrain" placeholder="Adresse complete" />
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <label class="field-label">Superficie du terrain <span class="optional-tag">— optionnel</span></label>
                                    <div class="field-inner">
                                        <input type="number" name="superficie_terrain" placeholder="Surface en m&sup2;" />
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <label class="field-label">Statut administratif <span class="optional-tag">— optionnel</span></label>
                                    <div class="field-inner">
                                        <input type="text" name="statut_administratif" placeholder="Ex: Pret a construire, en cours de validation" />
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <h4 class="form-section-title"><i class="fas fa-cogs"></i> Details techniques</h4>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <label class="field-label">Type de construction <span class="optional-tag">— optionnel</span></label>
                                    <div class="field-inner">
                                        <input type="text" name="type_construction" placeholder="Ex: Residentiel, commercial, industriel" />
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <label class="field-label">Budget estime <span class="optional-tag">— optionnel</span></label>
                                    <div class="field-inner">
                                        <input type="text" name="budget_estime" placeholder="Ex: 150 000 EUR" />
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <label class="field-label">Delais souhaites <span class="optional-tag">— optionnel</span></label>
                                    <div class="field-inner">
                                        <input type="text" name="delais_souhaite" placeholder="Ex: 3 mois a compter de septembre" />
                                    </div>
                                </div>

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <label class="field-label">Message <span class="optional-tag">— optionnel</span></label>
                                    <div class="field-inner">
                                        <textarea name="message" placeholder="Decrivez votre projet en quelques mots..." rows="5"></textarea>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <button class="theme-btn btn-style-one" type="submit" id="contact-submit-btn">
                                        <i class="btn-curve"></i>
                                        <span class="btn-title">Envoyer la demande</span>
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
<div id="toast"></div>
<script>
function showToast(msg, type) {
    var el = document.getElementById('toast');
    if (!el) return;
    el.textContent = msg;
    el.style.background = type === 'error' ? '#dc2626' : '#059669';
    el.style.opacity = '1';
    el.style.transform = 'translateX(-50%) translateY(0)';
    setTimeout(function() {
        el.style.opacity = '0';
        el.style.transform = 'translateX(-50%) translateY(20px)';
    }, 3500);
}
(function() {
    var renovation = document.getElementById('renovation-extension');
    var amenagement = document.getElementById('amenagement-interieur');
    var heading = document.getElementById('existing-heading');
    var details = document.querySelectorAll('.existing-detail');
    var form = document.getElementById('contact-form');
    var btn = document.getElementById('contact-submit-btn');
    var titleEl = btn && btn.querySelector('.btn-title');

    function toggleExisting() {
        var show = (renovation && renovation.checked) || (amenagement && amenagement.checked);
        if (heading) heading.style.display = show ? 'block' : 'none';
        details.forEach(function(el) { el.style.display = show ? 'block' : 'none'; });
    }

    if (renovation) renovation.addEventListener('change', toggleExisting);
    if (amenagement) amenagement.addEventListener('change', toggleExisting);

    if (form && btn && titleEl) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            if (btn.dataset.sending === '1') return;
            btn.dataset.sending = '1';
            var orig = titleEl.textContent;
            titleEl.textContent = 'Envoi en cours...';

            var data = new FormData(form);
            fetch('contact-submit.php', {
                method: 'POST',
                body: data,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            }).then(function(r) {
                return r.json();
            }).then(function(j) {
                if (j.ok) {
                    showToast(j.message, 'success');
                    form.reset();
                } else {
                    showToast(j.error || 'Erreur lors de l\'envoi.', 'error');
                }
            }).catch(function() {
                showToast('Erreur de connexion. Veuillez reessayer.', 'error');
            }).finally(function() {
                delete btn.dataset.sending;
                titleEl.textContent = orig;
            });
        });
    }
})();
</script>
</body>
</html>
