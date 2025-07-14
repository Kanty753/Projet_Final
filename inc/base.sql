CREATE DATABASE IF NOT EXISTS projet_final CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE projet_final;

CREATE TABLE IF NOT EXISTS membre (
    id_membre INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    date_naissance DATE NOT NULL,
    genre ENUM('Homme', 'Femme', 'Autre') NOT NULL,
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