-- Seed data for H&K Services
-- Run: ddev mysql abir < sql/seed.sql

-- Reset admin password to 'admin123'
UPDATE admin_users SET password = '$2y$12$vIKTyArzyi85eKPr9Mk/8OFZfEkQCc4Bxdi3jq07NABZL2xJt/uV2' WHERE email = 'admin@hketservices.com';
INSERT IGNORE INTO admin_users (username, email, password) VALUES ('manager', 'manager@hketservices.com', '$2y$12$vIKTyArzyi85eKPr9Mk/8OFZfEkQCc4Bxdi3jq07NABZL2xJt/uV2');

-- Clear and re-insert products
DELETE FROM products;

-- Maçonnerie (cat 1) — 7 products
INSERT INTO products (category_id, name, slug, description, price_tnd, price_eur, badge_type, colors, featured, order_index) VALUES
(1, 'Ciment Portland', 'ciment-portland', 'Sac de 50 kg – Ciment résistant pour fondations et structures.', 18.900, 5.50, 'populaire', '[{"hex":"#8a8a8a","name":"Gris"},{"hex":"#f0f0f0","name":"Blanc"}]', 1, 1),
(1, 'Brique Pleine', 'brique-pleine', 'Brique rouge 20×10×5 cm – Haute résistance compression.', 4.900, 1.40, 'none', '[{"hex":"#b91c1c","name":"Rouge"}]', 0, 2),
(1, 'Parpaing Creux', 'parpaing-creux', 'Bloc creux 20×20×40 cm – Pour murs porteurs & cloisons.', 3.900, 1.10, 'none', '[{"hex":"#a8a8a8","name":"Gris"}]', 0, 3),
(1, 'Fer à Béton', 'fer-a-beton', 'Barre d''acier torsadée ø12 mm – Longueur 6 m.', 12.500, 3.60, 'populaire', '[{"hex":"#6b7280","name":"Acier"}]', 0, 4),
(1, 'Sable Fin Lavé', 'sable-fin-lave', 'Sac de 40 kg – Sable pour mortier et enduits.', 5.400, 1.60, 'none', '[{"hex":"#d4a373","name":"Beige"}]', 0, 5),
(1, 'Gravier Concassé', 'gravier-concasse', 'Sac de 35 kg – Granulométrie 8/16 mm pour béton.', 6.200, 1.80, 'none', '[{"hex":"#8a8a8a","name":"Gris"}]', 0, 6),
(1, 'Chaux Hydraulique', 'chaux-hydraulique', 'Sac de 25 kg – Chaux NHL 3.5 pour mortier de chaux.', 15.900, 4.60, 'none', '[{"hex":"#f5f5f0","name":"Blanc cassé"}]', 0, 7);

-- Revêtement (cat 2) — 6 products
INSERT INTO products (category_id, name, slug, description, price_tnd, price_eur, badge_type, colors, featured, order_index) VALUES
(2, 'Carreaux Céramique', 'carreaux-ceramique', 'Carreaux 60×60 cm – Finition brillante, pose facile.', 32.900, 9.50, 'nouveau', '[{"hex":"#f5f5f5","name":"Blanc"},{"hex":"#2d2d2d","name":"Noir"},{"hex":"#e8d5b7","name":"Beige"},{"hex":"#b0b0b0","name":"Gris"}]', 1, 1),
(2, 'Marbre Luxe', 'marbre-luxe', 'Dalle marbre poli 80×80 cm – Élégance et durabilité.', 59.900, 17.40, 'nouveau', '[{"hex":"#fafafa","name":"Blanc"},{"hex":"#1f1f1f","name":"Noir"},{"hex":"#d4c5a9","name":"Beige"}]', 0, 2),
(2, 'Parquet Contrecollé', 'parquet-contrecollé', 'Lame 120×14 cm – Chêne verni, pose clipsable.', 45.900, 13.30, 'nouveau', '[{"hex":"#c4a882","name":"Chêne clair"},{"hex":"#8b6914","name":"Chêne doré"},{"hex":"#5c4033","name":"Chêne foncé"}]', 0, 3),
(2, 'Carreau Ciment', 'carreau-ciment', 'Carreau 20×20 cm – Motif hexagonal, aspect ciré.', 28.900, 8.40, 'none', '[{"hex":"#f0ebe3","name":"Naturel"},{"hex":"#1a1a1a","name":"Noir"},{"hex":"#c04040","name":"Rouge"}]', 0, 4),
(2, 'Mosaïque Verre', 'mosaique-verre', 'Grille 30×30 cm – Mosaïque émaillée pour salle de bain.', 38.900, 11.30, 'nouveau', '[{"hex":"#1e93d1","name":"Bleu"},{"hex":"#2d8a4e","name":"Vert"},{"hex":"#9ca3af","name":"Gris"},{"hex":"#d4a017","name":"Or"}]', 0, 5),
(2, 'Pierre Naturelle', 'pierre-naturelle', 'Dalle 40×60 cm – Travertin brut, ép. 2 cm.', 52.900, 15.30, 'none', '[{"hex":"#d4c5a9","name":"Travertin"},{"hex":"#9ca3af","name":"Gris"}]', 0, 6);

-- Peinture (cat 3) — 6 products
INSERT INTO products (category_id, name, slug, description, price_tnd, price_eur, badge_type, colors, featured, order_index) VALUES
(3, 'Peinture Acrylique', 'peinture-acrylique', 'Pot de 5 L – Mate et lessivable, haute couvrance.', 25.900, 7.50, 'none', '[{"hex":"#ffffff","name":"Blanc"},{"hex":"#2563eb","name":"Bleu"},{"hex":"#16a34a","name":"Vert"},{"hex":"#eab308","name":"Jaune"},{"hex":"#dc2626","name":"Rouge"}]', 1, 1),
(3, 'Enduit de Façade', 'enduit-de-facade', 'Seau 25 kg – Enduit projeté, finition grain fin.', 34.900, 10.10, 'promotion', '[{"hex":"#f8f9fa","name":"Blanc"},{"hex":"#d4c5a9","name":"Beige"},{"hex":"#adb5bd","name":"Gris"}]', 0, 2),
(3, 'Peinture Extérieure', 'peinture-exterieure', 'Pot 10 L – Micro-poreuse, anti-UV, résiste aux intempéries.', 42.900, 12.40, 'none', '[{"hex":"#f8f9fa","name":"Blanc"},{"hex":"#adb5bd","name":"Gris"},{"hex":"#d4c5a9","name":"Beige"},{"hex":"#3b82f6","name":"Bleu"}]', 0, 3),
(3, 'Vernis Bois Mat', 'vernis-bois-mat', 'Pot 2.5 L – Vernis incolore, protection intérieur/extérieur.', 22.900, 6.60, 'none', '[{"hex":"#e8e0d0","name":"Naturel"},{"hex":"#d4c5a9","name":"Chêne"}]', 0, 4),
(3, 'Sous-Couche Murale', 'sous-couche-murale', 'Pot 5 L – Fixateur et régulateur d''absorption.', 18.900, 5.50, 'none', '[{"hex":"#f5f5f5","name":"Blanc"}]', 0, 5),
(3, 'Kit Pinceaux Pro', 'kit-pinceaux-pro', 'Lot de 6 pinceaux – Tailles 1 à 4 pouces, soie synthétique.', 14.900, 4.30, 'promotion', '[{"hex":"#1f1f1f","name":"Noir"},{"hex":"#1e3a5f","name":"Bleu"}]', 0, 6);

-- Plomberie (cat 4) — 7 products
INSERT INTO products (category_id, name, slug, description, price_tnd, price_eur, badge_type, colors, featured, order_index) VALUES
(4, 'Tuyau PVC', 'tuyau-pvc', 'Tube PVC pression – Diamètre 32 mm, longueur 3 m.', 8.900, 2.60, 'none', '[{"hex":"#9ca3af","name":"Gris"},{"hex":"#f3f4f6","name":"Blanc"}]', 0, 1),
(4, 'Raccord Cuivre', 'raccord-cuivre', 'Coude cuivre 90° – Diamètre 22 mm, soudable.', 3.200, 0.90, 'none', '[{"hex":"#b87333","name":"Cuivre"}]', 0, 2),
(4, 'Robinet Mitigeur', 'robinet-mitigeur', 'Mitigeur chromé lavabo – Cartouche céramique.', 26.900, 7.80, 'none', '[{"hex":"#c0c0c0","name":"Chrome"},{"hex":"#1a1a1a","name":"Noir"},{"hex":"#c9a84c","name":"Or"}]', 1, 3),
(4, 'Flexible Douche', 'flexible-douche', 'Flexible inox tressé 1.5 m – Anti-torsion, raccord universel.', 8.900, 2.60, 'none', '[{"hex":"#d1d5db","name":"Inox"}]', 0, 4),
(4, 'Joint Sanitaire', 'joint-sanitaire', 'Tube silicone neutre 280 ml – Anti-moisissures.', 6.900, 2.00, 'none', '[{"hex":"#ffffff","name":"Blanc"},{"hex":"#e0e0e0","name":"Gris"},{"hex":"#9ca3af","name":"Transparent"}]', 0, 5),
(4, 'Chauffe-Eau 50L', 'chauffe-eau-50l', 'Ballon électrique 50 L – Classe A, thermostat réglable.', 189.000, 54.80, 'populaire', '[{"hex":"#f0f0f0","name":"Blanc"}]', 0, 6),
(4, 'WC Suspendu', 'wc-suspendu', 'Pack WC suspendu avec abattant – Cuvette vitrifiée.', 149.000, 43.20, 'none', '[{"hex":"#f5f5f0","name":"Blanc"}]', 0, 7);

-- Électricité (cat 5) — 3 products
INSERT INTO products (category_id, name, slug, description, price_tnd, price_eur, badge_type, colors, featured, order_index) VALUES
(5, 'Câble Électrique', 'cable-electrique', 'Rouleau 50 m – Section 2.5 mm², cuivre, gaine PVC.', 22.900, 6.60, 'none', '[{"hex":"#9ca3af","name":"Gris"},{"hex":"#2d2d2d","name":"Noir"}]', 0, 1),
(5, 'Interrupteur', 'interrupteur', 'Interrupteur simple allumage – Encastrable, blanc.', 5.900, 1.70, 'none', '[{"hex":"#ffffff","name":"Blanc"},{"hex":"#1a1a1a","name":"Noir"}]', 0, 2),
(5, 'Disjoncteur 16A', 'disjoncteur-16a', 'Disjoncteur divisionnaire 16A – Courbe C, modulaire.', 9.900, 2.90, 'none', '[{"hex":"#f0f0f0","name":"Blanc"}]', 0, 3);

-- Outillage (cat 6) — 4 products
INSERT INTO products (category_id, name, slug, description, price_tnd, price_eur, badge_type, colors, featured, order_index) VALUES
(6, 'Perceuse Sans Fil', 'perceuse-sans-fil', 'Perceuse-visseuse 18V – Batterie Li-Ion 4Ah.', 119.000, 34.50, 'promotion', '[{"hex":"#b91c1c","name":"Rouge"},{"hex":"#1f1f1f","name":"Noir"}]', 1, 1),
(6, 'Niveau à Bulle', 'niveau-a-bulle', 'Niveau magnétique 120 cm – Triple lentille, aluminium.', 15.900, 4.60, 'none', '[{"hex":"#fbbf24","name":"Jaune"}]', 0, 2),
(6, 'Meuleuse Angulaire', 'meuleuse-angulaire', 'Meuleuse 125 mm – 850 W, protection surcharge.', 89.900, 26.10, 'none', '[{"hex":"#1e40af","name":"Bleu"},{"hex":"#1f1f1f","name":"Noir"}]', 0, 3),
(6, 'Échafaudage Roulant', 'echafaudage-roulant', 'Tour roulante alu 4 m – Plateforme 1.5×0.7 m.', 249.000, 72.20, 'none', '[{"hex":"#a0a0a0","name":"Aluminium"}]', 0, 4);

-- Catalog items
DELETE FROM catalog_items;
INSERT INTO catalog_items (title, description, file_type, file_url, active, order_index) VALUES
('Catalogue Général 2026', 'Notre catalogue complet de matériaux de construction et outillage.', 'flipbook', 'https://heyzine.com/flip-book/81348bbb28.html', 1, 1),
('Brochure Maçonnerie', 'Guide des produits de maçonnerie — ciments, briques et parpaings.', 'flipbook', 'https://heyzine.com/flip-book/81348bbb28.html', 1, 2),
('Catalogue Électricité', 'Solutions électriques pour professionnels et particuliers.', 'flipbook', 'https://heyzine.com/flip-book/81348bbb28.html', 1, 3);

-- Verify counts
SELECT 'categories' as tbl, COUNT(*) as cnt FROM categories
UNION ALL SELECT 'products', COUNT(*) FROM products
UNION ALL SELECT 'services', COUNT(*) FROM services
UNION ALL SELECT 'projects', COUNT(*) FROM projects
UNION ALL SELECT 'catalog_items', COUNT(*) FROM catalog_items;
