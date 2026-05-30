# H&K Services

Site web de H&K Services — Société franco-tunisienne de construction, rénovation et aménagement.

---

## Français 🇫🇷

### 📋 Prérequis

- [XAMPP](https://www.apachefriends.org/fr/index.html) (Apache + PHP 8.x + MySQL)
- ou [DDEV](https://ddev.com/) (environnement Docker recommandé pour le développement)
- Navigateur web (Chrome, Firefox, Edge)

### 🚀 Installation rapide avec DDEV (recommandé)

```bash
ddev start
ddev mysql < sql/schema.sql
ddev mysql < sql/seed.sql
```

### 🚀 Installation pas à pas (XAMPP)

#### 1. Installer XAMPP

Téléchargez et installez XAMPP depuis [apachefriends.org](https://www.apachefriends.org/fr/index.html).
Lancez le panneau de contrôle XAMPP et démarrez les services **Apache** et **MySQL**.

#### 2. Copier le projet

Copiez le dossier du projet dans le répertoire `htdocs` de XAMPP :

```
C:\xampp\htdocs\H&K Services\
```

#### 3. Créer la base de données

1. Ouvrez **phpMyAdmin** : http://localhost/phpmyadmin
2. Cliquez sur **"Nouvelle base de données"**
3. Nommez-la `abir`, choisissez `utf8mb4_general_ci` comme collation
4. Cliquez sur **"Créer"**
5. Allez dans l'onglet **"SQL"**
6. Ouvrez le fichier `sql/schema.sql`, copiez tout son contenu et collez-le dans phpMyAdmin
7. Cliquez sur **"Exécuter"**
8. Répétez la même opération avec le fichier `sql/seed.sql`

#### 4. Configurer le projet

Ouvrez le fichier `includes/config.php` et modifiez-le ainsi :

```php
<?php
session_start();

define('DB_HOST', 'localhost');       // XAMPP utilise localhost
define('DB_PORT', '3306');            // Port MySQL par défaut
define('DB_NAME', 'abir');            // Nom de la base de données
define('DB_USER', 'root');            // Utilisateur MySQL (root par défaut dans XAMPP)
define('DB_PASS', '');                // Mot de passe vide par défaut dans XAMPP
define('BASE_URL', 'http://localhost/H&K Services');
define('UPLOAD_DIR', __DIR__ . '/../uploads/');
```

Pour DDEV, les valeurs sont déjà configurées dans `includes/config.php`.

#### 5. Accéder au site

- **Site public** : http://localhost/H&K Services (XAMPP) ou https://abir.ddev.site (DDEV)
- **Panneau d'administration** : http://localhost/H&K Services/admin (XAMPP) ou https://abir.ddev.site/admin (DDEV)
- **Projets** : http://localhost/H&K Services/realisations.php

#### 6. Identifiants administrateur

| Champ        | Valeur                                  |
|--------------|----------------------------------------|
| Email        | `admin@hketservices.com`               |
| Mot de passe | `admin123`                             |

#### 7. Migrations (base existante uniquement)

Si vous mettez à jour une base de données existante, exécutez :

```sql
ALTER TABLE admin_users ADD COLUMN avatar VARCHAR(255) DEFAULT NULL AFTER email;
ALTER TABLE projects ADD COLUMN category VARCHAR(100) DEFAULT 'amenagement' AFTER slug;
```

Ou via DDEV :

```bash
ddev mysql < sql/migration.sql
```

### ✨ Fonctionnalités

- **Projets** : galerie avec filtre par catégorie (Villas, Toitures, Immeubles, Rénovations, Aménagement, Commercial)
- **Pages détail** : carrousel Owl Carousel, fancybox, navigation projet précédent/suivant, projets similaires
- **Administration** : CRUD projets avec catégorie et ordre, gestion du profil admin (avatar, email, mot de passe)
- **URLs propres** : `/projets/{slug}` redirigé vers `projet-detail.php`

---

## العربية 🇦🇷

### 📋 المتطلبات

- **XAMPP** (Apache + PHP 8.x + MySQL)
- متصفح ويب (Chrome, Firefox, Edge)

### 🚀 دليل التثبيت خطوة بخطوة

#### 1. تثبيت XAMPP

قم بتحميل وتثبيت XAMPP من [apachefriends.org](https://www.apachefriends.org/).
افتح لوحة تحكم XAMPP وقم بتشغيل خدمتي **Apache** و **MySQL**.

#### 2. نسخ المشروع

انسخ مجلد المشروع إلى مجلد `htdocs` في مسار تثبيت XAMPP :

```
C:\xampp\htdocs\H&K Services\
```

#### 3. إنشاء قاعدة البيانات

1. افتح **phpMyAdmin** : http://localhost/phpmyadmin
2. انقر على **"جديد" (New)** لإنشاء قاعدة بيانات
3. اسم قاعدة البيانات : `abir` ، اختر `utf8mb4_general_ci` كترميز
4. انقر على **"إنشاء" (Create)**
5. اذهب إلى لسان **"SQL"**
6. افتح ملف `sql/schema.sql` بالمفكرة، انسخ كل محتواه والصقه في phpMyAdmin
7. انقر على **"تنفيذ" (Go)**
8. كرر نفس العملية مع ملف `sql/seed.sql` لاستيراد بيانات العرض

#### 4. إعداد المشروع

افتح ملف `includes/config.php` وقم بالتعديل كالتالي :

```php
<?php
session_start();

define('DB_HOST', 'localhost');       // XAMPP يستخدم localhost
define('DB_PORT', '3306');            // منفذ MySQL الافتراضي
define('DB_NAME', 'abir');            // اسم قاعدة البيانات
define('DB_USER', 'root');            // مستخدم MySQL (الجذر افتراضياً في XAMPP)
define('DB_PASS', '');                // كلمة السر فارغة افتراضياً في XAMPP
define('BASE_URL', 'http://localhost/H&K Services');
define('UPLOAD_DIR', __DIR__ . '/../uploads/');
```

#### 5. الوصول إلى الموقع

- **الموقع العام** : http://localhost/H&K Services
- **لوحة التحكم** : http://localhost/H&K Services/admin

#### 6. بيانات تسجيل الدخول للمشرف

| الحقل        | القيمة                                  |
|-------------|----------------------------------------|
| البريد الإلكتروني | `admin@hketservices.com`               |
| كلمة المرور      | `admin123`                             |

---

## 📁 Structure du projet / هيكل المشروع

```
H&K Services/
├── admin/              # Panneau d'administration / لوحة التحكم
│   ├── assets/         # CSS, JS, logo
│   ├── catalog/        # Gestion du catalogue
│   ├── categories/     # Gestion des catégories
│   ├── contacts/       # Gestion des demandes de contact
│   ├── partials/       # Header/footer partagés
│   ├── products/       # Gestion des produits
│   ├── projects/       # Gestion des projets
│   ├── services/       # Gestion des services
│   ├── dashboard.php   # Tableau de bord
│   ├── profile.php     # Profil administrateur (avatar, email, mot de passe)
│   └── profile-update.php
├── css/                # Feuilles de style
├── fonts/              # Polices
├── img/                # Images
├── includes/           # Fichiers inclus (config, helpers, db, auth)
├── js/                 # Scripts JavaScript
├── sql/                # Fichiers SQL (schema + seed + migration)
│   ├── schema.sql      # Structure complète + données initiales
│   ├── seed.sql        # Données de démonstration
│   └── migration.sql   # Migrations pour bases existantes
├── uploads/            # Fichiers uploadés (avatars, projets, produits)
├── contact.php         # Page de contact
├── index.php           # Page d'accueil
├── projet-detail.php   # Page détail projet (dynamique, slug-based)
├── realisations.php    # Galerie projets avec filtres
└── README.md           # Ce fichier
```

## 🔧 Dépannage / استكشاف الأخطاء

| Problème / المشكلة                          | Solution / الحل |
|---------------------------------------------|-----------------|
| Page blanche / صفحة فارغة                   | Vérifiez que MySQL est démarré dans XAMPP / تأكد من تشغيل MySQL في XAMPP |
| Erreur de connexion DB / خطأ اتصال بقاعدة البيانات | Vérifiez les identifiants dans `includes/config.php` / تحقق من بيانات الاتصال في ملف الإعدادات |
| 404 Not Found / الصفحة غير موجودة            | Vérifiez que le dossier est bien dans `htdocs` / تأكد من وجود المجلد في المسار الصحيح |
| Images manquantes / الصور لا تظهر             | Vérifiez le chemin `BASE_URL` dans `config.php` / تحقق من مسار `BASE_URL` في ملف الإعدادات |
| URLs propres / /projets/xxx ne fonctionne pas | Vérifiez la configuration nginx (`.ddev/nginx_full/nginx-site.conf`) ou les règles de réécriture Apache (`.htaccess`) |
