-- Création de la base de données

-- Table des membres
CREATE TABLE membre (
    id_membre INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    date_naissance DATE,
    genre CHAR ,
    email VARCHAR(100),
    ville VARCHAR(100),
    mdp VARCHAR(100),
    image_profil VARCHAR(255)
);

-- Table des catégories
CREATE TABLE categorie_objet (
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom_categorie VARCHAR(100)
);

-- Table des objets
CREATE TABLE objet (
    id_objet INT AUTO_INCREMENT PRIMARY KEY,
    nom_objet VARCHAR(100),
    id_categorie INT,
    id_membre INT,
    FOREIGN KEY (id_categorie) REFERENCES categorie_objet(id_categorie),
    FOREIGN KEY (id_membre) REFERENCES membre(id_membre)
);

-- Table des images liées à un objet
CREATE TABLE images_objet (
    id_image INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT,
    nom_image VARCHAR(255),
    FOREIGN KEY (id_objet) REFERENCES objet(id_objet)
);

-- Table des emprunts
CREATE TABLE emprunt (
    id_emprunt INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT,
    id_membre INT,
    date_emprunt DATE,
    date_retour DATE,
    FOREIGN KEY (id_objet) REFERENCES objet(id_objet),
    FOREIGN KEY (id_membre) REFERENCES membre(id_membre)
);

INSERT INTO membre (nom, date_naissance, genre, email, ville, mdp, image_profil) VALUES
('Alice', '1990-05-12', 'F', 'alice@gmail.com', 'Paris', 'mdp1', 'alice.jpg'),
('Bob', '1988-07-23', 'H', 'bob@gmail.com', 'Lyon', 'mdp2', 'bob.jpg'),
('Claire', '1995-02-18', 'F', 'claire@gmail.com', 'Marseille', 'mdp3', 'claire.jpg'),
('David', '1992-11-30', 'H', 'david@gmail.com', 'Toulouse', 'mdp4', 'david.jpg');

INSERT INTO categorie_objet (nom_categorie) VALUES
('Esthétique'), ('Bricolage'), ('Mécanique'), ('Cuisine');

-- Pour Alice (id_membre = 1)
INSERT INTO objet (nom_objet, id_categorie, id_membre) VALUES
('Sèche-cheveux', 1, 1), ('Tondeuse', 1, 1), ('Perceuse', 2, 1), ('Marteau', 2, 1), 
('Clé anglaise', 3, 1), ('Tournevis', 3, 1), ('Moule à gâteau', 4, 1), ('Mixeur', 4, 1),
('Lisseur', 1, 1), ('Blender', 4, 1);

-- Pour Bob (id_membre = 2)
INSERT INTO objet (nom_objet, id_categorie, id_membre) VALUES
('Rasoir', 1, 2), ('Scie', 2, 2), ('Clé à molette', 3, 2), ('Batteur', 4, 2),
('Lime à ongles', 1, 2), ('Tournevis électrique', 2, 2), ('Cric', 3, 2), ('Robot de cuisine', 4, 2),
('Épilateur', 1, 2), ('Fouet', 4, 2);

-- Pour Claire (id_membre = 3)
INSERT INTO objet (nom_objet, id_categorie, id_membre) VALUES
('Brosse à cheveux', 1, 3), ('Perceuse-visseuse', 2, 3), ('Pompe', 3, 3), ('Cocotte', 4, 3),
('Fer à lisser', 1, 3), ('Marteau piqueur', 2, 3), ('Crics hydrauliques', 3, 3), ('Four', 4, 3),
('Peigne', 1, 3), ('Mijoteuse', 4, 3);

-- Pour David (id_membre = 4)
INSERT INTO objet (nom_objet, id_categorie, id_membre) VALUES
('Tondeuse barbe', 1, 4), ('Tournevis plat', 2, 4), ('Boîte à outils', 3, 4), ('Balance de cuisine', 4, 4),
('Sèche-mains', 1, 4), ('Visseuse', 2, 4), ('Manomètre', 3, 4), ('Cafetière', 4, 4),
('Rasoir électrique', 1, 4), ('Micro-ondes', 4, 4);

INSERT INTO emprunt (id_objet, id_membre, date_emprunt, date_retour) VALUES
(1, 2, '2025-07-01', '2025-07-05'),  -- Bob emprunte à Alice
(12, 1, '2025-07-02', '2025-07-06'), -- Alice emprunte à Bob
(21, 4, '2025-07-03', '2025-07-07'), -- David emprunte à Claire
(31, 3, '2025-07-04', '2025-07-08'), -- Claire emprunte à David
(2, 3, '2025-07-05', '2025-07-10'),
(13, 4, '2025-07-05', '2025-07-09'),
(22, 1, '2025-07-06', '2025-07-11'),
(32, 2, '2025-07-06', '2025-07-12'),
(3, 4, '2025-07-07', '2025-07-13'),
(14, 3, '2025-07-07', '2025-07-14');

create or replace view affiche_liste_objet as
select 
    objet.id_objet, 
    objet.id_categorie id_categorie,
    objet.nom_objet as objet,
    emprunt.date_emprunt as date_emprunt,
    emprunt.id_emprunt,
    emprunt.date_retour as date_retour
    from objet LEFT JOIN emprunt 
    ON objet.id_objet = emprunt.id_objet
; 

create or replace view affiche_filtre as 
select 
    categorie_objet.nom_categorie as categorie_objet,
    objet.nom_objet as objet,
    objet.id_objet as id_objet,
    objet.id_categorie as id_categorie
from objet JOIN categorie_objet ON objet.id_categorie = categorie_objet.id_categorie;








