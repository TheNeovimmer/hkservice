CREATE TABLE IF NOT EXISTS admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    avatar VARCHAR(255) DEFAULT NULL,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO admin_users (username, email, password) VALUES
('admin', 'admin@hketservices.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL UNIQUE,
    icon VARCHAR(10) DEFAULT '📦',
    description TEXT,
    order_index INT DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO categories (name, slug, icon, description, order_index) VALUES
('Maçonnerie', 'maconnerie', '🏗️', 'Matériaux de maçonnerie et structure', 1),
('Revêtement', 'revetement', '⬜', 'Revêtements muraux et de sol', 2),
('Peinture', 'peinture', '🎨', 'Peintures et finitions', 3),
('Plomberie', 'plomberie', '🔧', 'Équipement sanitaire et plomberie', 4),
('Électricité', 'electricite', '⚡', 'Matériel électrique', 5),
('Outillage', 'outillage', '🛠️', 'Outils et équipements', 6);

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    description TEXT,
    price_tnd DECIMAL(10,3) NOT NULL DEFAULT 0,
    price_eur DECIMAL(10,2) NOT NULL DEFAULT 0,
    image VARCHAR(255) DEFAULT NULL,
    badge_type ENUM('none','nouveau','promotion','populaire') DEFAULT 'none',
    colors JSON DEFAULT NULL,
    featured TINYINT(1) DEFAULT 0,
    active TINYINT(1) DEFAULT 1,
    order_index INT DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    icon VARCHAR(100) DEFAULT 'fas fa-tools',
    description TEXT,
    section ENUM('etude','construction','gestion') NOT NULL DEFAULT 'construction',
    order_index INT DEFAULT 0,
    active TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO services (title, slug, icon, description, section, order_index) VALUES
('Architecture', 'architecture', 'fas fa-drafting-compass', 'Plans architecturaux, traitement de façades et conception de bâtiments.', 'etude', 1),
('Architecture d\'Intérieur', 'architecture-interieur', 'fas fa-pencil-ruler', 'Sélection de matériaux, couleurs et éclairage pour un intérieur sur mesure.', 'etude', 2),
('Aménagement Extérieur', 'amenagement-exterieur', 'fas fa-tree', 'Conception d\'espaces extérieurs : jardins, terrasses, piscines.', 'etude', 3),
('Construction et Réhabilitation', 'construction-rehabilitation', 'fas fa-building', 'Démolition, construction neuve et rénovation complète.', 'construction', 1),
('Gestion et Supervision', 'gestion-supervision', 'fas fa-hard-hat', 'Planification, gestion des coûts et suivi de chantier.', 'construction', 2),
('Conseils et Expertise', 'conseils-expertise', 'fas fa-lightbulb', 'Conseil technique et expertise pour vos projets de construction.', 'construction', 3),
('Peinture', 'peinture', 'fas fa-paint-roller', 'Peinture intérieure et extérieure, finitions décoratives.', 'gestion', 1),
('Menuiserie', 'menuiserie', 'fas fa-chair', 'Menuiserie bois, aluminium et fer forgé.', 'gestion', 2),
('Électricité', 'electricite', 'fas fa-bolt', 'Installation et maintenance électrique.', 'gestion', 3),
('Plomberie Sanitaire', 'plomberie-sanitaire', 'fas fa-wrench', 'Installation sanitaire, plomberie et chauffage.', 'gestion', 4),
('Ferronnerie', 'ferronnerie', 'fas fa-fire', 'Travaux de ferronnerie : portails, garde-corps, escaliers.', 'gestion', 5);

CREATE TABLE IF NOT EXISTS projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    category VARCHAR(100) DEFAULT 'amenagement',
    project_number VARCHAR(50) DEFAULT NULL,
    description TEXT,
    location VARCHAR(255) DEFAULT NULL,
    surface VARCHAR(50) DEFAULT NULL,
    client VARCHAR(255) DEFAULT NULL,
    thumbnail VARCHAR(255) DEFAULT NULL,
    images JSON DEFAULT NULL,
    active TINYINT(1) DEFAULT 1,
    order_index INT DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO projects (title, slug, project_number, category, description, thumbnail, images, order_index) VALUES
('Bureaux', 'bureaux', 'PROJET N°1', 'commercial', 'ShowRoom H&K Services - Espaces de travail modernes et fonctionnels.', 'img/project/Project1/b1.jpg', '["img/project/Project1/b1.jpg","img/project/Project1/b2.jpg","img/project/Project1/b3.jpg","img/project/Project1/b4.jpg","img/project/Project1/b5.jpg","img/project/Project1/b6.jpg"]', 1),
('Piscine', 'piscine', 'PROJET N°2', 'amenagement', 'Construction de piscine résidentielle avec finitions haut de gamme.', 'img/project/Project2/p2.jpg', '["img/project/Project2/p2.jpg","img/project/Project2/p3.jpg","img/project/Project2/p5.jpg","img/project/Project2/p7.jpg"]', 2),
('Terrasse', 'terrasse', 'PROJET N°3', 'amenagement', 'Aménagement de terrasse extérieure en carrelage et bois.', 'img/project/Project3/t2.jpg', '["img/project/Project3/t2.jpg","img/project/Project3/t3.jpg","img/project/Project3/t4.jpg"]', 3),
('Balcon', 'balcon', 'PROJET N°4', 'renovations', 'Rénovation et sécurisation de balcon avec garde-corps moderne.', 'img/project/Project4/b1.png', '["img/project/Project4/b1.png","img/project/Project4/b5.png","img/project/Project4/b6.png"]', 4),
('Cuisine', 'cuisine', 'PROJET N°5', 'renovations', 'Cuisine équipée sur mesure avec îlot central et plan de travail.', 'img/project/projet5/c6.jpg', '["img/project/projet5/c1.jpg","img/project/projet5/c2.jpg","img/project/projet5/c3.jpg","img/project/projet5/c4.jpg","img/project/projet5/c5.jpg","img/project/projet5/c6.jpg","img/project/projet5/c7.jpg","img/project/projet5/c8.jpg"]', 5),
('Salles de Bain', 'salles-de-bain', 'PROJET N°6', 'renovations', 'Salle de bain moderne avec douche à l\'italienne et vasque design.', 'img/project/projet6/s2.jpg', '["img/project/projet6/s1.jpg","img/project/projet6/s2.jpg","img/project/projet6/s3.jpg","img/project/projet6/s4.jpg","img/project/projet6/s5.jpg","img/project/projet6/s6.jpg"]', 6),
('Salle de Sport', 'salle-de-sport', 'PROJET N°7', 'amenagement', 'Aménagement de salle de sport privée avec équipements professionnels.', 'img/project/Project7/s7.jpg', '["img/project/Project7/s1.jpg","img/project/Project7/s2.jpg","img/project/Project7/s3.jpg","img/project/Project7/s7.jpg"]', 7),
('Salon de Coiffure', 'salon-de-coiffure', 'PROJET N°8', 'commercial', 'Salon de coiffure moderne avec éclairage professionnel et mobilier design.', 'img/project/Project9/f1.png', '["img/project/Project9/f1.png","img/project/Project9/f2.png","img/project/Project9/f3.png"]', 8),
('Salon de Thé', 'salon-de-the', 'PROJET N°9', 'commercial', 'Salon de thé chaleureux avec décoration intérieure raffinée.', 'img/project/Project8/t3.png', '["img/project/Project8/t1.png","img/project/Project8/t2.png","img/project/Project8/t3.png","img/project/Project8/t4.png"]', 9),
('Boutique', 'boutique', 'PROJET N°10', 'commercial', 'Boutique commerciale élégante avec vitrine et agencement intérieur.', 'img/project/Project10/b3.jpg', '["img/project/Project10/b1.jpg","img/project/Project10/b2.jpg","img/project/Project10/b3.jpg","img/project/Project10/b4.jpg"]', 10),
('Immeuble Moderne', 'immeuble-moderne', 'PROJET N°11', 'immeubles', 'Construction d\'un immeuble moderne avec façade contemporaine et aménagements intérieurs de standing.', 'img/project/project11/m1.jpg', '["img/project/project11/m1.jpg","img/project/project11/m2.jpg","img/project/project11/m3.jpg","img/project/project11/m4.jpg","img/project/project11/m5.jpg","img/project/project11/m6.jpg","img/project/project11/m9.jpg"]', 11),
('Jardin Paysager', 'jardin-paysager', 'PROJET N°12', 'amenagement', 'Aménagement paysager complet avec espaces verts, éclairage extérieur et mobilier de jardin.', 'img/project/project12/j1.jpg', '["img/project/project12/j1.jpg","img/project/project12/j2.jpg","img/project/project12/j3.jpg","img/project/project12/j4.jpg","img/project/project12/j5.jpg","img/project/project12/j6.jpg","img/project/project12/j7.jpg","img/project/project12/j8.jpg"]', 12);

CREATE TABLE IF NOT EXISTS catalog_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    file_type ENUM('flipbook','pdf','image','link') NOT NULL DEFAULT 'flipbook',
    file_url VARCHAR(500) DEFAULT NULL,
    thumbnail VARCHAR(255) DEFAULT NULL,
    active TINYINT(1) DEFAULT 1,
    order_index INT DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    company_name VARCHAR(255) DEFAULT NULL,
    email VARCHAR(255) DEFAULT NULL,
    phone VARCHAR(50) DEFAULT NULL,
    project_address VARCHAR(255) DEFAULT NULL,
    project_type JSON DEFAULT NULL,
    land_owner VARCHAR(10) DEFAULT NULL,
    land_address VARCHAR(255) DEFAULT NULL,
    land_area VARCHAR(50) DEFAULT NULL,
    admin_status VARCHAR(255) DEFAULT NULL,
    building_nature VARCHAR(255) DEFAULT NULL,
    construction_year VARCHAR(50) DEFAULT NULL,
    current_area VARCHAR(50) DEFAULT NULL,
    construction_type VARCHAR(255) DEFAULT NULL,
    estimated_budget VARCHAR(255) DEFAULT NULL,
    desired_deadline VARCHAR(255) DEFAULT NULL,
    message TEXT DEFAULT NULL,
    status ENUM('new','read','replied','archived') DEFAULT 'new',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
