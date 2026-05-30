# H&K Services — Site de Matériaux de Construction & Services

Site web professionnel pour **H&K Services** (France), spécialisé dans les matériaux de construction, la rénovation et les services d'aménagement.

**Stack :** PHP + MySQL + JavaScript

---

## Installer le site avec XAMPP

### 1. Prérequis

- [XAMPP](https://www.apachefriends.org/) (PHP 8.1+ recommandé)
- Navigateur web (Chrome, Edge, Firefox)

### 2. Copier les fichiers

1. Téléchargez tous les fichiers du projet (ou clonez le dépôt Git)
2. Copiez l'intégralité du dossier dans `C:\xampp\htdocs\hkservice`

```
C:\xampp\htdocs\hkservice\
├── admin/            # Backend PHP (dashboard admin)
│   ├── assets/
│   ├── categories/
│   ├── products/
│   ├── projects/
│   ├── services/
│   ├── catalog/
│   ├── contacts/
│   ├── partials/
│   ├── dashboard.php
│   ├── index.php
│   ├── login.php
│   ├── logout.php
│   ├── profile.php
│   └── profile-update.php
├── css/              # Feuilles de style
├── img/              # Images et uploads
├── includes/         # Fonctions PHP (helpers, auth, DB)
├── js/           # Scripts frontend
├── config.php        # Configuration DB (préconfiguré)
├── index.php         # Page d'accueil
├── projets-construction-batiments.php
├── projet-detail.php
├── contact.php
└── database.sql      # Export SQL complet
```

### 3. Démarrer XAMPP

1. Lancez **XAMPP Control Panel**
2. Cliquez sur **Start** pour **Apache**
3. Cliquez sur **Start** pour **MySQL**
4. Vérifiez que les deux sont sur fond **vert**

### 4. Importer la base de données

#### Option A : via phpMyAdmin (recommandé)

1. Ouvrez votre navigateur → [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
2. Cliquez sur l'onglet **Importer** en haut
3. Cliquez sur **Choisir un fichier** → sélectionnez `database.sql`
4. Laissez tous les paramètres par défaut
5. Cliquez sur **Exécuter** en bas

#### Option B : via ligne de commande

Ouvrez un terminal et tapez :

```bash
mysql -u root -p < C:\xampp\htdocs\hkservice\database.sql
```

(laissez le mot de passe vide par défaut)

### 5. Accéder au site

| Page | URL |
|------|-----|
| **Site public** | [http://localhost/hkservice](http://localhost/hkservice) |
| **Admin panel** | [http://localhost/hkservice/admin](http://localhost/hkservice/admin) |

> **Note :** Le site fonctionne quel que soit le nom du dossier dans `htdocs`. Les liens s'adaptent automatiquement (`BASE_PATH`).

**Identifiants admin par défaut :**

| Utilisateur | Mot de passe | Email |
|-------------|-------------|-------|
| `admin` | `admin123` | admin@hketservices.com |
| `manager` | `admin123` | manager@hketservices.com |

---

## Comptes utilisateurs

L'admin panel permet de gérer :

- **Produits** — Ajout/édition/suppression avec images et couleurs (prix en EUR et TND)
- **Catégories** — Organisation des produits (Maçonnerie, Peinture, etc.)
- **Projets** — Portfolio avec galerie d'images
- **Services** — Sections Étude / Construction / Gestion
- **Catalogues** — Liens flipbook ou PDF
- **Messages** — Demandes de devis envoyées depuis le formulaire contact

---

## Licence

Usage interne H&K Services.
