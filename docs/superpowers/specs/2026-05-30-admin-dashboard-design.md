# Admin Dashboard Redesign — H&K Services

## Goal
Rebuild the `admin/` dashboard with Bootstrap 5 + Chart.js, fully responsive, modern dark sidebar, dynamic CRUD, matching brand `#312783`.

## Layout
- **Sidebar:** Dark `#312783` gradient, collapsible via Bootstrap offcanvas on mobile, fixed on desktop
- **Top navbar:** White, user avatar + name + logout button, sidebar toggle on left
- **Content:** White background, card-based, responsive 12-column Bootstrap grid
- **Login page:** Centered card with brand gradient header

## Pages & Components

### Login (`admin/index.php`)
- Centered card (max-width 420px) with brand gradient top bar
- Logo + title, email/password fields, error alert
- POST to `login.php`, redirect to `dashboard.php`

### Dashboard (`admin/dashboard.php`)
- 4 stat cards: Produits, Catégories, Services, Projets — each with icon + color + count
- Bar chart (Chart.js): monthly activity (products + projects per month)
- Pie chart: products distribution by category
- Doughnut chart: services by section (etude/construction/gestion)
- Recent items tables: last 5 products + last 5 projects

### Categories CRUD (`admin/categories/`)
- Bootstrap DataTable: ID, name, icon, slug, order, product count, actions
- Create/Edit: Bootstrap modal with form (name, slug auto-generated, icon picker, order)
- Delete: confirm modal via AJAX

### Products CRUD (`admin/products/`)
- DataTable with image thumbnail, name, category, prices (TND/EUR), badge, featured star, actions
- Create/Edit modal: name, slug, category dropdown, description textarea, prices, badge select, color swatches editor, image upload with preview, featured checkbox, active toggle
- Delete: confirm modal

### Services CRUD (`admin/services/`)
- DataTable: icon (Font Awesome), title, section badge, summary preview, order, actions
- Create/Edit modal: title, slug, section select (etude/construction/gestion), icon picker, summary, description, order
- Delete: confirm modal

### Projects CRUD (`admin/projects/`)
- DataTable: cover image, title, slug, location, surface, client, status badge, actions
- Create/Edit modal with multi-image gallery upload, thumbnail star selector, metadata fields
- Delete: confirm modal

### Catalog CRUD (`admin/catalog/`)
- DataTable: title, file type badge, active toggle, order, actions
- Create/Edit modal: title, description, file type select (flipbook/pdf/link), URL, file upload, active toggle, order
- Delete: confirm modal

## Technical Stack
- **Bootstrap 5.3** CDN (CSS + JS bundle)
- **Chart.js 4** CDN (dashboard charts)
- **Font Awesome 6** CDN (icons)
- **Custom CSS** (`admin/assets/admin.css`) reduced to brand overrides only
- **Custom JS** (`admin/assets/admin.js`) reduced to sidebar toggle, toast, upload preview, chart init

## Removed
- All custom grid/layout CSS (replaced by Bootstrap grid)
- All manual table styling (replaced by Bootstrap table)
- Custom scrollbar styling
- Redundant CSS from old admin design system

## File Changes
- Rewrite: `admin/partials/header.php`, `admin/partials/footer.php`
- Rewrite: `admin/index.php`, `admin/dashboard.php`
- Rewrite: `admin/categories/index.php`, `create.php`, `edit.php`, `delete.php`
- Rewrite: `admin/products/index.php`, `create.php`, `edit.php`, `delete.php`
- Rewrite: `admin/services/index.php`, `create.php`, `edit.php`, `delete.php`
- Rewrite: `admin/projects/index.php`, `create.php`, `edit.php`, `delete.php`
- Rewrite: `admin/catalog/index.php`, `create.php`, `edit.php`, `delete.php`
- Rewrite: `admin/assets/admin.css`, `admin/assets/admin.js`
