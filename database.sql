-- ============================================
-- H&K Services - Database Schema + Seed Data
-- ============================================
-- Compatible with MySQL / MariaDB (XAMPP)
-- Import via phpMyAdmin or: mysql -u root -p < database.sql
-- ============================================

CREATE DATABASE IF NOT EXISTS `abir` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci;
USE `abir`;

-- --------------------------------------------------------
-- Table: admin_users
-- --------------------------------------------------------
DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

INSERT INTO `admin_users` (`id`, `username`, `email`, `avatar`, `password`, `created_at`) VALUES
(1, 'admin', 'admin@hketservices.com', NULL, '$2y$12$vIKTyArzyi85eKPr9Mk/8OFZfEkQCc4Bxdi3jq07NABZL2xJt/uV2', '2026-05-30 00:27:04'),
(2, 'manager', 'manager@hketservices.com', NULL, '$2y$12$vIKTyArzyi85eKPr9Mk/8OFZfEkQCc4Bxdi3jq07NABZL2xJt/uV2', '2026-05-30 00:29:08');

-- --------------------------------------------------------
-- Table: categories
-- --------------------------------------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `icon` varchar(10) DEFAULT '?',
  `description` text DEFAULT NULL,
  `order_index` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

INSERT INTO `categories` (`id`, `name`, `slug`, `icon`, `description`, `order_index`) VALUES
(1, 'Maçonnerie',     'maconnerie',   '🏗️', 'Matériaux de maçonnerie et structure',    1),
(2, 'Revêtement',     'revetement',   '⬜', 'Revêtements muraux et de sol',             2),
(3, 'Peinture',       'peinture',     '🎨', 'Peintures et finitions',                   3),
(4, 'Plomberie',      'plomberie',    '🔧', 'Équipement sanitaire et plomberie',         4),
(5, 'Électricité',    'electricite',  '⚡', 'Matériel électrique',                       5),
(6, 'Outillage',      'outillage',    '🛠️', 'Outils et équipements',                     6);

-- --------------------------------------------------------
-- Table: products
-- --------------------------------------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price_tnd` decimal(10,3) NOT NULL DEFAULT 0.000,
  `price_eur` decimal(10,2) NOT NULL DEFAULT 0.00,
  `image` varchar(255) DEFAULT NULL,
  `badge_type` enum('none','nouveau','promotion','populaire') DEFAULT 'none',
  `colors` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`colors`)),
  `featured` tinyint(1) DEFAULT 0,
  `active` tinyint(1) DEFAULT 1,
  `order_index` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `description`, `price_tnd`, `price_eur`, `image`, `badge_type`, `colors`, `featured`, `active`, `order_index`) VALUES
(1, 1, 'Ciment Portland', 'ciment-portland', 'Sac de 50 kg – Ciment résistant pour fondations et structures.', 18.900, 5.50, NULL, 'populaire', '[{\"hex\":\"#8a8a8a\",\"name\":\"Gris\"},{\"hex\":\"#f0f0f0\",\"name\":\"Blanc\"}]', 1, 1, 1),
(2, 1, 'Brique Pleine', 'brique-pleine', 'Brique rouge 20×10×5 cm – Haute résistance compression.', 4.900, 1.40, NULL, 'none', '[{\"hex\":\"#b91c1c\",\"name\":\"Rouge\"}]', 0, 1, 2),
(3, 1, 'Parpaing Creux', 'parpaing-creux', 'Bloc creux 20×20×40 cm – Pour murs porteurs & cloisons.', 3.900, 1.10, NULL, 'none', '[{\"hex\":\"#a8a8a8\",\"name\":\"Gris\"}]', 0, 1, 3),
(4, 1, 'Fer à Béton', 'fer-a-beton', 'Barre d\'acier torsadée ø12 mm – Longueur 6 m.', 12.500, 3.60, NULL, 'populaire', '[{\"hex\":\"#6b7280\",\"name\":\"Acier\"}]', 0, 1, 4),
(5, 1, 'Sable Fin Lavé', 'sable-fin-lave', 'Sac de 40 kg – Sable pour mortier et enduits.', 5.400, 1.60, NULL, 'none', '[{\"hex\":\"#d4a373\",\"name\":\"Beige\"}]', 0, 1, 5),
(6, 1, 'Gravier Concassé', 'gravier-concasse', 'Sac de 35 kg – Granulométrie 8/16 mm pour béton.', 6.200, 1.80, NULL, 'none', '[{\"hex\":\"#8a8a8a\",\"name\":\"Gris\"}]', 0, 1, 6),
(7, 1, 'Chaux Hydraulique', 'chaux-hydraulique', 'Sac de 25 kg – Chaux NHL 3.5 pour mortier de chaux.', 15.900, 4.60, NULL, 'none', '[{\"hex\":\"#f5f5f0\",\"name\":\"Blanc cassé\"}]', 0, 1, 7),
(8, 2, 'Carreaux Céramique', 'carreaux-ceramique', 'Carreaux 60×60 cm – Finition brillante, pose facile.', 32.900, 9.50, NULL, 'nouveau', '[{\"hex\":\"#f5f5f5\",\"name\":\"Blanc\"},{\"hex\":\"#2d2d2d\",\"name\":\"Noir\"},{\"hex\":\"#e8d5b7\",\"name\":\"Beige\"},{\"hex\":\"#b0b0b0\",\"name\":\"Gris\"}]', 1, 1, 1),
(9, 2, 'Marbre Luxe', 'marbre-luxe', 'Dalle marbre poli 80×80 cm – Élégance et durabilité.', 59.900, 17.40, NULL, 'nouveau', '[{\"hex\":\"#fafafa\",\"name\":\"Blanc\"},{\"hex\":\"#1f1f1f\",\"name\":\"Noir\"},{\"hex\":\"#d4c5a9\",\"name\":\"Beige\"}]', 0, 1, 2),
(10, 2, 'Parquet Contrecollé', 'parquet-contrecollé', 'Lame 120×14 cm – Chêne verni, pose clipsable.', 45.900, 13.30, NULL, 'nouveau', '[{\"hex\":\"#c4a882\",\"name\":\"Chêne clair\"},{\"hex\":\"#8b6914\",\"name\":\"Chêne doré\"},{\"hex\":\"#5c4033\",\"name\":\"Chêne foncé\"}]', 0, 1, 3),
(11, 2, 'Carreau Ciment', 'carreau-ciment', 'Carreau 20×20 cm – Motif hexagonal, aspect ciré.', 28.900, 8.40, NULL, 'none', '[{\"hex\":\"#f0ebe3\",\"name\":\"Naturel\"},{\"hex\":\"#1a1a1a\",\"name\":\"Noir\"},{\"hex\":\"#c04040\",\"name\":\"Rouge\"}]', 0, 1, 4),
(12, 2, 'Mosaïque Verre', 'mosaique-verre', 'Grille 30×30 cm – Mosaïque émaillée pour salle de bain.', 38.900, 11.30, NULL, 'nouveau', '[{\"hex\":\"#1e93d1\",\"name\":\"Bleu\"},{\"hex\":\"#2d8a4e\",\"name\":\"Vert\"},{\"hex\":\"#9ca3af\",\"name\":\"Gris\"},{\"hex\":\"#d4a017\",\"name\":\"Or\"}]', 0, 1, 5),
(13, 2, 'Pierre Naturelle', 'pierre-naturelle', 'Dalle 40×60 cm – Travertin brut, ép. 2 cm.', 52.900, 15.30, NULL, 'none', '[{\"hex\":\"#d4c5a9\",\"name\":\"Travertin\"},{\"hex\":\"#9ca3af\",\"name\":\"Gris\"}]', 0, 1, 6),
(14, 3, 'Peinture Acrylique', 'peinture-acrylique', 'Pot de 5 L – Mate et lessivable, haute couvrance.', 25.900, 7.50, NULL, 'none', '[{\"hex\":\"#ffffff\",\"name\":\"Blanc\"},{\"hex\":\"#2563eb\",\"name\":\"Bleu\"},{\"hex\":\"#16a34a\",\"name\":\"Vert\"},{\"hex\":\"#eab308\",\"name\":\"Jaune\"},{\"hex\":\"#dc2626\",\"name\":\"Rouge\"}]', 1, 1, 1),
(15, 3, 'Enduit de Façade', 'enduit-de-facade', 'Seau 25 kg – Enduit projeté, finition grain fin.', 34.900, 10.10, NULL, 'promotion', '[{\"hex\":\"#f8f9fa\",\"name\":\"Blanc\"},{\"hex\":\"#d4c5a9\",\"name\":\"Beige\"},{\"hex\":\"#adb5bd\",\"name\":\"Gris\"}]', 0, 1, 2),
(16, 3, 'Peinture Extérieure', 'peinture-exterieure', 'Pot 10 L – Micro-poreuse, anti-UV, résiste aux intempéries.', 42.900, 12.40, NULL, 'none', '[{\"hex\":\"#f8f9fa\",\"name\":\"Blanc\"},{\"hex\":\"#adb5bd\",\"name\":\"Gris\"},{\"hex\":\"#d4c5a9\",\"name\":\"Beige\"},{\"hex\":\"#3b82f6\",\"name\":\"Bleu\"}]', 0, 1, 3),
(17, 3, 'Vernis Bois Mat', 'vernis-bois-mat', 'Pot 2.5 L – Vernis incolore, protection intérieur/extérieur.', 22.900, 6.60, NULL, 'none', '[{\"hex\":\"#e8e0d0\",\"name\":\"Naturel\"},{\"hex\":\"#d4c5a9\",\"name\":\"Chêne\"}]', 0, 1, 4),
(18, 3, 'Sous-Couche Murale', 'sous-couche-murale', 'Pot 5 L – Fixateur et régulateur d\'absorption.', 18.900, 5.50, NULL, 'none', '[{\"hex\":\"#f5f5f5\",\"name\":\"Blanc\"}]', 0, 1, 5),
(19, 3, 'Kit Pinceaux Pro', 'kit-pinceaux-pro', 'Lot de 6 pinceaux – Tailles 1 à 4 pouces, soie synthétique.', 14.900, 4.30, NULL, 'promotion', '[{\"hex\":\"#1f1f1f\",\"name\":\"Noir\"},{\"hex\":\"#1e3a5f\",\"name\":\"Bleu\"}]', 0, 1, 6),
(20, 4, 'Tuyau PVC', 'tuyau-pvc', 'Tube PVC pression – Diamètre 32 mm, longueur 3 m.', 8.900, 2.60, NULL, 'none', '[{\"hex\":\"#9ca3af\",\"name\":\"Gris\"},{\"hex\":\"#f3f4f6\",\"name\":\"Blanc\"}]', 0, 1, 1),
(21, 4, 'Raccord Cuivre', 'raccord-cuivre', 'Coude cuivre 90° – Diamètre 22 mm, soudable.', 3.200, 0.90, NULL, 'none', '[{\"hex\":\"#b87333\",\"name\":\"Cuivre\"}]', 0, 1, 2),
(22, 4, 'Robinet Mitigeur', 'robinet-mitigeur', 'Mitigeur chromé lavabo – Cartouche céramique.', 26.900, 7.80, NULL, 'none', '[{\"hex\":\"#c0c0c0\",\"name\":\"Chrome\"},{\"hex\":\"#1a1a1a\",\"name\":\"Noir\"},{\"hex\":\"#c9a84c\",\"name\":\"Or\"}]', 1, 1, 3),
(23, 4, 'Flexible Douche', 'flexible-douche', 'Flexible inox tressé 1.5 m – Anti-torsion, raccord universel.', 8.900, 2.60, NULL, 'none', '[{\"hex\":\"#d1d5db\",\"name\":\"Inox\"}]', 0, 1, 4),
(24, 4, 'Joint Sanitaire', 'joint-sanitaire', 'Tube silicone neutre 280 ml – Anti-moisissures.', 6.900, 2.00, NULL, 'none', '[{\"hex\":\"#ffffff\",\"name\":\"Blanc\"},{\"hex\":\"#e0e0e0\",\"name\":\"Gris\"},{\"hex\":\"#9ca3af\",\"name\":\"Transparent\"}]', 0, 1, 5),
(25, 4, 'Chauffe-Eau 50L', 'chauffe-eau-50l', 'Ballon électrique 50 L – Classe A, thermostat réglable.', 189.000, 54.80, NULL, 'populaire', '[{\"hex\":\"#f0f0f0\",\"name\":\"Blanc\"}]', 0, 1, 6),
(26, 4, 'WC Suspendu', 'wc-suspendu', 'Pack WC suspendu avec abattant – Cuvette vitrifiée.', 149.000, 43.20, NULL, 'none', '[{\"hex\":\"#f5f5f0\",\"name\":\"Blanc\"}]', 0, 1, 7),
(27, 5, 'Câble Électrique', 'cable-electrique', 'Rouleau 50 m – Section 2.5 mm², cuivre, gaine PVC.', 22.900, 6.60, NULL, 'none', '[{\"hex\":\"#9ca3af\",\"name\":\"Gris\"},{\"hex\":\"#2d2d2d\",\"name\":\"Noir\"}]', 0, 1, 1),
(28, 5, 'Interrupteur', 'interrupteur', 'Interrupteur simple allumage – Encastrable, blanc.', 5.900, 1.70, NULL, 'none', '[{\"hex\":\"#ffffff\",\"name\":\"Blanc\"},{\"hex\":\"#1a1a1a\",\"name\":\"Noir\"}]', 0, 1, 2),
(29, 5, 'Disjoncteur 16A', 'disjoncteur-16a', 'Disjoncteur divisionnaire 16A – Courbe C, modulaire.', 9.900, 2.90, NULL, 'none', '[{\"hex\":\"#f0f0f0\",\"name\":\"Blanc\"}]', 0, 1, 3),
(30, 6, 'Perceuse Sans Fil', 'perceuse-sans-fil', 'Perceuse-visseuse 18V – Batterie Li-Ion 4Ah.', 119.000, 34.50, NULL, 'promotion', '[{\"hex\":\"#b91c1c\",\"name\":\"Rouge\"},{\"hex\":\"#1f1f1f\",\"name\":\"Noir\"}]', 1, 1, 1),
(31, 6, 'Niveau à Bulle', 'niveau-a-bulle', 'Niveau magnétique 120 cm – Triple lentille, aluminium.', 15.900, 4.60, NULL, 'none', '[{\"hex\":\"#fbbf24\",\"name\":\"Jaune\"}]', 0, 1, 2),
(32, 6, 'Meuleuse Angulaire', 'meuleuse-angulaire', 'Meuleuse 125 mm – 850 W, protection surcharge.', 89.900, 26.10, NULL, 'none', '[{\"hex\":\"#1e40af\",\"name\":\"Bleu\"},{\"hex\":\"#1f1f1f\",\"name\":\"Noir\"}]', 0, 1, 3),
(33, 6, 'Échafaudage Roulant', 'echafaudage-roulant', 'Tour roulante alu 4 m – Plateforme 1.5×0.7 m.', 249.000, 72.20, NULL, 'none', '[{\"hex\":\"#a0a0a0\",\"name\":\"Aluminium\"}]', 0, 1, 4);

-- --------------------------------------------------------
-- Table: catalog_items
-- --------------------------------------------------------
DROP TABLE IF EXISTS `catalog_items`;
CREATE TABLE `catalog_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `file_type` enum('flipbook','pdf','image','link') NOT NULL DEFAULT 'flipbook',
  `file_url` varchar(500) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `order_index` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

INSERT INTO `catalog_items` (`id`, `title`, `description`, `file_type`, `file_url`) VALUES
(1, 'Catalogue Général 2026', 'Notre catalogue complet de matériaux de construction et outillage.', 'flipbook', 'https://heyzine.com/flip-book/81348bbb28.html'),
(2, 'Brochure Maçonnerie', 'Guide des produits de maçonnerie — ciments, briques et parpaings.', 'flipbook', 'https://heyzine.com/flip-book/81348bbb28.html'),
(3, 'Catalogue Électricité', 'Solutions électriques pour professionnels et particuliers.', 'flipbook', 'https://heyzine.com/flip-book/81348bbb28.html');

-- --------------------------------------------------------
-- Table: contacts
-- --------------------------------------------------------
DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `project_address` varchar(255) DEFAULT NULL,
  `project_type` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`project_type`)),
  `land_owner` varchar(10) DEFAULT NULL,
  `land_address` varchar(255) DEFAULT NULL,
  `land_area` varchar(50) DEFAULT NULL,
  `admin_status` varchar(255) DEFAULT NULL,
  `building_nature` varchar(255) DEFAULT NULL,
  `construction_year` varchar(50) DEFAULT NULL,
  `current_area` varchar(50) DEFAULT NULL,
  `construction_type` varchar(255) DEFAULT NULL,
  `estimated_budget` varchar(255) DEFAULT NULL,
  `desired_deadline` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` enum('new','read','replied','archived') DEFAULT 'new',
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------
-- Table: projects
-- --------------------------------------------------------
DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category` varchar(100) DEFAULT 'amenagement',
  `project_number` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `surface` varchar(50) DEFAULT NULL,
  `client` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`images`)),
  `active` tinyint(1) DEFAULT 1,
  `order_index` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

INSERT INTO `projects` (`id`, `title`, `slug`, `category`, `project_number`, `description`, `thumbnail`, `images`, `active`, `order_index`) VALUES
(1,  'Bureaux',          'bureaux',          'commercial',   'PROJET N°1',  'ShowRoom H&K Services - Espaces de travail modernes et fonctionnels.',                      'img/project/Project1/b1.jpg',  '[\"img/project/Project1/b1.jpg\",\"img/project/Project1/b2.jpg\",\"img/project/Project1/b3.jpg\",\"img/project/Project1/b4.jpg\",\"img/project/Project1/b5.jpg\",\"img/project/Project1/b6.jpg\"]',  1, 1),
(2,  'Piscine',          'piscine',          'amenagement',  'PROJET N°2',  'Construction de piscine résidentielle avec finitions haut de gamme.',                       'img/project/Project2/p2.jpg',  '[\"img/project/Project2/p2.jpg\",\"img/project/Project2/p3.jpg\",\"img/project/Project2/p5.jpg\",\"img/project/Project2/p7.jpg\"]',  1, 2),
(3,  'Terrasse',         'terrasse',         'amenagement',  'PROJET N°3',  'Aménagement de terrasse extérieure en carrelage et bois.',                                  'img/project/Project3/t2.jpg',  '[\"img/project/Project3/t2.jpg\",\"img/project/Project3/t3.jpg\",\"img/project/Project3/t4.jpg\"]',  1, 3),
(4,  'Balcon',           'balcon',           'renovations',  'PROJET N°4',  'Rénovation et sécurisation de balcon avec garde-corps moderne.',                            'img/project/Project4/b1.png',  '[\"img/project/Project4/b1.png\",\"img/project/Project4/b5.png\",\"img/project/Project4/b6.png\"]',  1, 4),
(5,  'Cuisine',          'cuisine',          'renovations',  'PROJET N°5',  'Cuisine équipée sur mesure avec îlot central et plan de travail.',                          'img/project/projet5/c6.jpg',   '[\"img/project/projet5/c1.jpg\",\"img/project/projet5/c2.jpg\",\"img/project/projet5/c3.jpg\",\"img/project/projet5/c4.jpg\",\"img/project/projet5/c5.jpg\",\"img/project/projet5/c6.jpg\",\"img/project/projet5/c7.jpg\",\"img/project/projet5/c8.jpg\"]',  1, 5),
(6,  'Salles de Bain',   'salles-de-bain',   'renovations',  'PROJET N°6',  'Salle de bain moderne avec douche à l\'italienne et vasque design.',                         'img/project/projet6/s2.jpg',   '[\"img/project/projet6/s1.jpg\",\"img/project/projet6/s2.jpg\",\"img/project/projet6/s3.jpg\",\"img/project/projet6/s4.jpg\",\"img/project/projet6/s5.jpg\",\"img/project/projet6/s6.jpg\"]',  1, 6),
(7,  'Salle de Sport',   'salle-de-sport',   'amenagement',  'PROJET N°7',  'Aménagement de salle de sport privée avec équipements professionnels.',                      'img/project/Project7/s7.jpg',  '[\"img/project/Project7/s1.jpg\",\"img/project/Project7/s2.jpg\",\"img/project/Project7/s3.jpg\",\"img/project/Project7/s7.jpg\"]',  1, 7),
(8,  'Salon de Coiffure','salon-de-coiffure','commercial',   'PROJET N°8',  'Salon de coiffure moderne avec éclairage professionnel et mobilier design.',                'img/project/Project9/f1.png',  '[\"img/project/Project9/f1.png\",\"img/project/Project9/f2.png\",\"img/project/Project9/f3.png\"]',  1, 8),
(9,  'Salon de Thé',     'salon-de-the',     'commercial',   'PROJET N°9',  'Salon de thé chaleureux avec décoration intérieure raffinée.',                              'img/project/Project8/t3.png',  '[\"img/project/Project8/t1.png\",\"img/project/Project8/t2.png\",\"img/project/Project8/t3.png\",\"img/project/Project8/t4.png\"]',  1, 9),
(10, 'Boutique',         'boutique',         'commercial',   'PROJET N°10', 'Boutique commerciale élégante avec vitrine et agencement intérieur.',                        'img/project/Project10/b3.jpg', '[\"img/project/Project10/b1.jpg\",\"img/project/Project10/b2.jpg\",\"img/project/Project10/b3.jpg\",\"img/project/Project10/b4.jpg\"]',  1, 10),
(12, 'Immeuble Moderne',  'immeuble-moderne', 'immeubles',    'PROJET N°11', 'Construction d\'un immeuble moderne avec façade contemporaine et aménagements intérieurs.',  'img/project/project11/m1.jpg', '[\"img/project/project11/m1.jpg\",\"img/project/project11/m2.jpg\",\"img/project/project11/m3.jpg\",\"img/project/project11/m4.jpg\",\"img/project/project11/m5.jpg\",\"img/project/project11/m6.jpg\",\"img/project/project11/m9.jpg\"]',  1, 11),
(13, 'Jardin Paysager',   'jardin-paysager',  'amenagement',  'PROJET N°12', 'Aménagement paysager complet avec espaces verts, éclairage extérieur et mobilier de jardin.', 'img/project/project12/j1.jpg', '[\"img/project/project12/j1.jpg\",\"img/project/project12/j2.jpg\",\"img/project/project12/j3.jpg\",\"img/project/project12/j4.jpg\",\"img/project/project12/j5.jpg\",\"img/project/project12/j6.jpg\",\"img/project/project12/j7.jpg\",\"img/project/project12/j8.jpg\"]', 1, 12);

-- --------------------------------------------------------
-- Table: services
-- --------------------------------------------------------
DROP TABLE IF EXISTS `services`;
CREATE TABLE `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` varchar(100) DEFAULT 'fas fa-tools',
  `description` text DEFAULT NULL,
  `section` enum('etude','construction','gestion') NOT NULL DEFAULT 'construction',
  `order_index` int(11) DEFAULT 0,
  `active` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

INSERT INTO `services` (`id`, `title`, `slug`, `icon`, `description`, `section`, `order_index`) VALUES
(1,  'Architecture',             'architecture',             'fas fa-drafting-compass', 'Plans architecturaux, traitement de façades et conception de bâtiments.',     'etude',        1),
(2,  "Architecture d'Intérieur", 'architecture-interieur',   'fas fa-pencil-ruler',     'Sélection de matériaux, couleurs et éclairage pour un intérieur sur mesure.', 'etude',        2),
(3,  "Aménagement Extérieur",    'amenagement-exterieur',    'fas fa-tree',             'Conception d\'espaces extérieurs : jardins, terrasses, piscines.',            'etude',        3),
(4,  'Construction et Réhabilitation', 'construction-rehabilitation', 'fas fa-building', 'Démolition, construction neuve et rénovation complète.',                      'construction', 1),
(5,  'Gestion et Supervision',   'gestion-supervision',      'fas fa-hard-hat',         'Planification, gestion des coûts et suivi de chantier.',                      'construction', 2),
(6,  'Conseils et Expertise',    'conseils-expertise',       'fas fa-lightbulb',        'Conseil technique et expertise pour vos projets de construction.',            'construction', 3),
(7,  'Peinture',                 'peinture',                 'fas fa-paint-roller',     'Peinture intérieure et extérieure, finitions décoratives.',                   'gestion',      1),
(8,  'Menuiserie',               'menuiserie',               'fas fa-chair',            'Menuiserie bois, aluminium et fer forgé.',                                    'gestion',      2),
(9,  'Électricité',              'electricite',              'fas fa-bolt',             'Installation et maintenance électrique.',                                     'gestion',      3),
(10, 'Plomberie Sanitaire',      'plomberie-sanitaire',      'fas fa-wrench',           'Installation sanitaire, plomberie et chauffage.',                             'gestion',      4),
(11, 'Ferronnerie',              'ferronnerie',              'fas fa-fire',             'Travaux de ferronnerie : portails, garde-corps, escaliers.',                  'gestion',      5);
