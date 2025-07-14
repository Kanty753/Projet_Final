CREATE DATABASE IF NOT EXISTS projet_final CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE projet_final;

CREATE TABLE IF NOT EXISTS membre (
    id_membre INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    date_naissance DATE NOT NULL,
    genre varchar(50) NOT NULL,
    email VARCHAR(150) NOT NULL ,
    ville VARCHAR(100) NOT NULL,
    mdp VARCHAR(255) NOT NULL,
    image_profil VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS categorie_objet (
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom_categorie VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS objet (
    id_objet INT AUTO_INCREMENT PRIMARY KEY,
    nom_objet VARCHAR(100) NOT NULL,
    id_categorie INT NOT NULL,
    id_membre INT NOT NULL,
    FOREIGN KEY (id_categorie) REFERENCES categorie_objet(id_categorie) ON DELETE CASCADE,
    FOREIGN KEY (id_membre) REFERENCES membre(id_membre) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS images_objet (
    id_image INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT NOT NULL,
    nom_image VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_objet) REFERENCES objet(id_objet) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS emprunt (
    id_emprunt INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT NOT NULL,
    id_membre INT NOT NULL,
    date_emprunt DATE NOT NULL,
    date_retour DATE,
    FOREIGN KEY (id_objet) REFERENCES objet(id_objet) ON DELETE CASCADE,
    FOREIGN KEY (id_membre) REFERENCES membre(id_membre) ON DELETE CASCADE
);

-- ...existing code...

-- Insertion des membres
INSERT INTO membre (nom, date_naissance, genre, email, ville, mdp, image_profil) VALUES
('Alice', '1990-01-01', 'Femme', 'alice@email.com', 'Paris', 'mdp1', NULL),
('Bob', '1985-05-12', 'Homme', 'bob@email.com', 'Lyon', 'mdp2', NULL),
('Charlie', '1992-07-23', 'Homme', 'charlie@email.com', 'Marseille', 'mdp3', NULL),
('Diane', '1988-11-30', 'Femme', 'diane@email.com', 'Toulouse', 'mdp4', NULL);

-- Insertion des catégories
INSERT INTO categorie_objet (nom_categorie) VALUES
('esthétique'),
('bricolage'),
('mécanique'),
('cuisine');

-- Insertion des objets (10 par membre, répartis sur les catégories)
INSERT INTO objet (nom_objet, id_categorie, id_membre) VALUES
('Sèche-cheveux', 1, 1),
('Lisseur', 1, 1),
('Perceuse', 2, 1),
('Tournevis', 2, 1),
('Clé à molette', 3, 1),
('Casserole', 4, 1),
('Mixeur', 4, 1),
('Pinceau maquillage', 1, 1),
('Scie', 2, 1),
('Robot pâtissier', 4, 1),

('Tondeuse', 1, 2),
('Marteau', 2, 2),
('Tournevis électrique', 2, 2),
('Pompe à vélo', 3, 2),
('Fouet', 4, 2),
('Batteur', 4, 2),
('Fer à lisser', 1, 2),
('Perceuse-visseuse', 2, 2),
('Cafetière', 4, 2),
('Clé dynamométrique', 3, 2),

('Brosse à cheveux', 1, 3),
('Scie sauteuse', 2, 3),
('Tournevis plat', 2, 3),
('Pompe à air', 3, 3),
('Poêle', 4, 3),
('Grille-pain', 4, 3),
('Lime à ongles', 1, 3),
('Perceuse à colonne', 2, 3),
('Bouilloire', 4, 3),
('Clé Allen', 3, 3),

('Brosse visage', 1, 4),
('Scie circulaire', 2, 4),
('Tournevis cruciforme', 2, 4),
('Compresseur', 3, 4),
('Cocotte-minute', 4, 4),
('Mixeur plongeant', 4, 4),
('Sèche-ongles', 1, 4),
('Perceuse sans fil', 2, 4),
('Grill', 4, 4),
('Clé plate', 3, 4);

-- Insertion de 10 emprunts
INSERT INTO emprunt (id_objet, id_membre, date_emprunt, date_retour) VALUES
(1, 2, '2024-06-01', '2024-06-10'),
(12, 1, '2024-06-02', '2024-06-12'),
(23, 4, '2024-06-03', '2024-06-13'),
(34, 3, '2024-06-04', '2024-06-14'),
(5, 3, '2024-06-05', '2024-06-15'),
(16, 4, '2024-06-06', '2024-06-16'),
(27, 2, '2024-06-07', '2024-06-17'),
(8, 3, '2024-06-08', '2024-06-18'),
(19, 1, '2024-06-09', '2024-06-19'),
(30, 2, '2024-06-10', '2024-06-24') ;