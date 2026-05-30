-- Migration: add avatar to admin_users
ALTER TABLE admin_users ADD COLUMN avatar VARCHAR(255) DEFAULT NULL AFTER email;

-- Migration: add category to projects
ALTER TABLE projects ADD COLUMN category VARCHAR(100) DEFAULT 'amenagement' AFTER slug;

-- Seed missing projects 11 & 12
INSERT INTO projects (title, slug, project_number, category, description, thumbnail, images, order_index) VALUES
('Immeuble Moderne', 'immeuble-moderne', 'PROJET N°11', 'immeubles', 'Construction d''un immeuble moderne avec façade contemporaine et aménagements intérieurs de standing.', 'img/project/project11/m1.jpg', '["img/project/project11/m1.jpg","img/project/project11/m2.jpg","img/project/project11/m3.jpg","img/project/project11/m4.jpg","img/project/project11/m5.jpg","img/project/project11/m6.jpg","img/project/project11/m9.jpg"]', 11),
('Jardin Paysager', 'jardin-paysager', 'PROJET N°12', 'amenagement', 'Aménagement paysager complet avec espaces verts, éclairage extérieur et mobilier de jardin.', 'img/project/project12/j1.jpg', '["img/project/project12/j1.jpg","img/project/project12/j2.jpg","img/project/project12/j3.jpg","img/project/project12/j4.jpg","img/project/project12/j5.jpg","img/project/project12/j6.jpg","img/project/project12/j7.jpg","img/project/project12/j8.jpg"]', 12);
