<?php
$pageTitle = 'Mon Profil';
require_once __DIR__ . '/partials/header.php';
$db = getDB();
$stmt = $db->prepare("SELECT * FROM admin_users WHERE id=?");
$stmt->execute([$_SESSION['admin_id']]);
$admin = $stmt->fetch();
?>
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header"><i class="fas fa-user-cog me-2"></i>Paramètres du compte</div>
            <div class="card-body">
                <form method="post" action="profile-update.php" enctype="multipart/form-data" class="row g-4">
                    <div class="col-12 text-center mb-3">
                        <div class="position-relative d-inline-block">
                            <div class="profile-avatar-wrapper">
                                <?php if ($admin['avatar'] && file_exists(__DIR__ . '/../' . $admin['avatar'])): ?>
                                <img src="<?= BASE_PATH ?>/<?= sanitize($admin['avatar']) ?>" alt="Avatar" class="profile-avatar" id="avatarPreview">
                                <?php else: ?>
                                <div class="profile-avatar profile-avatar-initials" id="avatarPreview"><?= strtoupper(substr($admin['username'], 0, 2)) ?></div>
                                <?php endif; ?>
                            </div>
                            <label for="avatarUpload" class="avatar-upload-btn" title="Changer la photo">
                                <i class="fas fa-camera"></i>
                            </label>
                            <input type="file" id="avatarUpload" name="avatar" accept="image/*" class="d-none" onchange="previewAvatar(event)">
                        </div>
                        <div class="mt-2"><small class="text-muted">Cliquez sur l'icône pour changer votre photo de profil</small></div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><i class="fas fa-user"></i>Nom d'utilisateur</label>
                        <input type="text" name="username" class="form-control" value="<?= sanitize($admin['username']) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><i class="fas fa-envelope"></i>Email</label>
                        <input type="email" name="email" class="form-control" value="<?= sanitize($admin['email']) ?>" required>
                    </div>
                    <div class="col-12"><hr><h6 class="text-brand fw-600"><i class="fas fa-lock me-2"></i>Changer le mot de passe</h6><p class="text-muted small">Laissez vide pour conserver le mot de passe actuel.</p></div>
                    <div class="col-md-4">
                        <label class="form-label"><i class="fas fa-key"></i>Mot de passe actuel</label>
                        <input type="password" name="current_password" class="form-control" autocomplete="current-password">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label"><i class="fas fa-key"></i>Nouveau mot de passe</label>
                        <input type="password" name="new_password" class="form-control" autocomplete="new-password">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label"><i class="fas fa-key"></i>Confirmer le nouveau</label>
                        <input type="password" name="confirm_password" class="form-control" autocomplete="new-password">
                    </div>
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-brand"><i class="fas fa-save me-1"></i>Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
.profile-avatar-wrapper {
    width: 120px; height: 120px;
    border-radius: 50%;
    overflow: hidden;
    border: 4px solid var(--brand-light);
    box-shadow: 0 4px 20px var(--brand-glow);
    transition: all .3s;
}
.profile-avatar-wrapper:hover { border-color: var(--brand); }
.profile-avatar { width: 100%; height: 100%; object-fit: cover; }
.profile-avatar-initials {
    display: flex; align-items: center; justify-content: center;
    background: linear-gradient(135deg, var(--brand), var(--brand-dark));
    color: #fff; font-size: 2rem; font-weight: 700;
}
.avatar-upload-btn {
    position: absolute;
    bottom: 4px; right: 4px;
    width: 36px; height: 36px;
    border-radius: 50%;
    background: var(--brand);
    color: #fff;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer;
    border: 3px solid #fff;
    transition: all .3s;
    box-shadow: 0 2px 8px rgba(0,0,0,.2);
}
.avatar-upload-btn:hover { background: var(--brand-dark); transform: scale(1.1); }
</style>
<script>
function previewAvatar(e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(ev) {
        const wrapper = document.querySelector('.profile-avatar-wrapper');
        wrapper.innerHTML = '<img src="' + ev.target.result + '" alt="Avatar" class="profile-avatar" id="avatarPreview">';
    };
    reader.readAsDataURL(file);
}
</script>
<?php require_once __DIR__ . '/partials/footer.php'; ?>
