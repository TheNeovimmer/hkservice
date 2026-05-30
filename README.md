# H&K Services — Site de Matériaux de Construction & Services

Site web professionnel pour **H&K Services** (Tunisie), spécialisé dans les matériaux de construction, la rénovation et les services d'aménagement.

**Stack :** Svelte 5 (frontend) + PHP + MySQL (backend/admin)

---

## Installer le site avec XAMPP sur Windows

### 1. Prérequis

- [XAMPP](https://www.apachefriends.org/) (PHP 8.1+ recommandé)
- Navigateur web (Chrome, Edge, Firefox)

### 2. Copier les fichiers

1. Téléchargez tous les fichiers du projet (ou clonez le dépôt Git)
2. Copiez l'intégralité du dossier dans `C:\xampp\htdocs\abir`

```
C:\xampp\htdocs\abir\
├── admin/
├── api/
├── backend/
├── database/
├── img/
├── lib/
├── node_modules/
├── public/
├── src/
├── config.php
├── index.html
├── package.json
├── vite.config.js
├── README.md
└── database.sql
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
mysql -u root -p < C:\xampp\htdocs\abir\database.sql
```

(laissez le mot de passe vide par défaut)

### 5. Configurer la connexion

Vérifiez que le fichier `config.php` à la racine du projet a ces valeurs :

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'abir');
define('DB_USER', 'root');
define('DB_PASS', '');
```

(Ce sont les identifiants XAMPP par défaut — aucun changement nécessaire si vous n'avez pas modifié MySQL.)

### 6. Accéder au site

| Page | URL |
|------|-----|
| **Site public** | [http://localhost/abir](http://localhost/abir) |
| **Admin panel** | [http://localhost/abir/admin](http://localhost/abir/admin) |

**Identifiants admin par défaut :**

| Utilisateur | Mot de passe | Email |
|-------------|-------------|-------|
| `admin` | `admin123` | admin@hketservices.com |
| `manager` | `admin123` | manager@hketservices.com |

### 7. Bonus : construire le frontend (si vous modifiez les sources Svelte)

```bash
cd C:\xampp\htdocs\abir
npm install        # une seule fois
npm run build      # reconstruit le frontend
```

Le fronted buildé se trouve dans `public/`.

---

## Structure du projet

```
abir/
├── admin/          # Backend PHP (dashboard admin)
│   ├── categories.php
│   ├── products.php
│   ├── projects.php
│   ├── services.php
│   ├── catalog.php
│   ├── contacts.php
│   └── login.php
├── api/            # Endpoints API PHP
├── backend/        # Classes PHP (Database, CRUD)
├── database/       # Schéma SQL séparé
├── img/            # Images et uploads
│   └── project/    # Photos des projets
├── lib/            # Bibliothèques PHP (auth, helpers)
├── public/         # Frontend compilé
├── src/            # Sources Svelte 5
│   ├── lib/
│   │   └── components/
│   ├── routes/
│   └── app.html
├── config.php      # Configuration DB
└── database.sql    # Export SQL complet
```

---

## Comptes utilisateurs

L'admin panel permet de gérer :

- **Produits** — Ajout/édition/suppression avec images et couleurs
- **Catégories** — Organisation des produits (Maçonnerie, Peinture, etc.)
- **Projets** — Portfolio avec galerie d'images
- **Services** — Sections Étude / Construction / Gestion
- **Catalogues** — Liens flipbook ou PDF
- **Messages** — Demandes de devis envoyées depuis le formulaire contact

---

## Licence

Usage interne H&K Services.
