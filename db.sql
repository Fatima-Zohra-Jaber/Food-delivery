create database SoliRestaurant


use SoliRestaurant
--Table CLIENT
CREATE TABLE `client` (
  `idClient` int PRIMARY KEY,
  `nomCl` varchar(50) NOT NULL,
  `prenomCl` varchar(50) DEFAULT NULL,
  `telCl` varchar(30) NOT NULL UNIQUE
)

--Table COMMANDE
CREATE TABLE `commande` (
  `idCmd` char(4) PRIMARY KEY,
  `dateCmd` datetime DEFAULT CURRENT_TIMESTAMP,
  `Statut` varchar(100) DEFAULT 'en attente',
  `idCl` int ,
  foreign key(idCl) references CLIENT(idClient)
) ;

ALTER TABLE `commande`
ADD CONSTRAINT `statut_check` CHECK (statut IN ('en attente','en cours','expédiée','livrée','annulée'))

--Table PLAT
CREATE TABLE `plat` (
  `idPlat` int AUTO_INCREMENT PRIMARY KEY,
  `nomPlat` varchar(100) NOT NULL,
  `categoriePlat` varchar(100) NOT NULL,
  `TypeCuisine` varchar(250) NOT NULL,
  `prix` decimal(6,2) NOT NULL,
  `image` varchar(500) NOT NULL
) 

ALTER TABLE `plat`
ADD CONSTRAINT `categorie_check` CHECK (`categoriePlat`  IN ('plat principal','dessert','entrée'))

ALTER TABLE `plat`
ADD CONSTRAINT `cuisine_check` CHECK (`TypeCuisine`  IN ('Marocaine','Italienne','Chinoise','Espagnole','Francaise'))

--Table COMMANDE_PLAT
CREATE TABLE `commande_plat` (
  `idPlat` int ,
  `idCmd` char(4) ,
  `qte` int NOT NULL,
  FOREIGN KEY(idPlat) references PLAT(idPlat),
  FOREIGN KEY(idCmd) references COMMANDE(idCmd),
  PRIMARY KEY(idPlat,idCmd)
) 

-- 

INSERT INTO client (idClient, nomCl, prenomCl, telCl) VALUES
(1, 'El Amrani', 'Youssef', '0612345678'),
(2, 'Bennani', 'Salma', '0623456789'),
(3, 'Mouline', 'Omar', '0634567890'),
(4, 'Zahraoui', 'Fatima', '0645678901'),
(5, 'Ouazzani', 'Rachid', '0656789012'),
(6, 'Tahiri', 'Kawtar', '0667890123'),
(7, 'Naciri', 'Hamza', '0678901234'),
(8, 'Jabri', 'Imane', '0689012345'),
(9, 'Fassi', 'Mehdi', '0690123456'),
(10, 'Belkadi', 'Hajar', '0601122334');

INSERT INTO commande (idCmd, dateCmd, Statut, idCl) VALUES
('C001', '2025-02-18 12:30:00', 'en attente', 1),
('C002', '2025-02-17 14:15:00', 'en cours', 2),
('C003', '2025-02-16 19:45:00', 'expédiée', 3),
('C004', '2025-02-15 11:20:00', 'livrée', 4),
('C005', '2025-02-14 13:05:00', 'annulée', 5);


INSERT INTO plat (nomPlat, categoriePlat, TypeCuisine, prix, image) VALUES
-- Cuisine Marocaine
('Couscous Royal', 'plat principal', 'Marocaine', 120.00, 'couscous.jpg'),
('Tajine de Poulet aux Citrons', 'plat principal', 'Marocaine', 110.00, 'tajine_poulet.jpg'),
('Harira', 'entrée', 'Marocaine', 40.00, 'harira.jpg'),
('Briouates au Fromage', 'entrée', 'Marocaine', 50.00, 'briouates.jpg'),
('Sellou', 'dessert', 'Marocaine', 45.00, 'sellou.jpg'),
('Chebakia', 'dessert', 'Marocaine', 35.00, 'chebakia.jpg'),

-- Cuisine Italienne
('Pizza Margherita', 'plat principal', 'Italienne', 95.00, 'pizza_margherita.png'),
('Lasagnes à la Bolognaise', 'plat principal', 'Italienne', 110.00, 'lasagnes.jpg'),
('Bruschetta', 'entrée', 'Italienne', 55.00, 'bruschetta.jpg'),
('Carpaccio de Bœuf', 'entrée', 'Italienne', 70.00, 'carpaccio.jpg'),
('Tiramisu', 'dessert', 'Italienne', 50.00, 'tiramisu.jpg'),
('Panna Cotta', 'dessert', 'Italienne', 45.00, 'panna_cotta.jpg'),

-- Cuisine Chinoise
('Canard Laqué', 'plat principal', 'Chinoise', 150.00, 'canard_laque.jpg'),
('Riz Cantonais', 'plat principal', 'Chinoise', 80.00, 'riz_cantonais.jpg'),
('Nems au Poulet', 'entrée', 'Chinoise', 60.00, 'nems.jpg'),
('Dim Sum', 'entrée', 'Chinoise', 75.00, 'dimsum.jpg'),
('Perles de Coco', 'dessert', 'Chinoise', 40.00, 'perles_coco.jpg'),
('Nougat Chinois', 'dessert', 'Chinoise', 45.00, 'nougat_chinois.jpg'),

-- Cuisine Espagnole
('Paella Royale', 'plat principal', 'Espagnole', 130.00, 'paella.jpg'),
('Gazpacho', 'entrée', 'Espagnole', 50.00, 'gazpacho.jpg'),
('Tortilla Espagnole', 'entrée', 'Espagnole', 55.00, 'tortilla.jpg'),
('Churros au Chocolat', 'dessert', 'Espagnole', 40.00, 'churros.jpg'),
('Flan Espagnol', 'dessert', 'Espagnole', 45.00, 'flan_espagnol.jpg'),
('Crema Catalana', 'dessert', 'Espagnole', 50.00, 'crema_catalana.jpg'),

-- Cuisine Française
('Bœuf Bourguignon', 'plat principal', 'Francaise', 140.00, 'boeuf_bourguignon.jpg'),
('Coq au Vin', 'plat principal', 'Francaise', 135.00, 'coq_au_vin.jpg'),
('Soupe à l’Oignon', 'entrée', 'Francaise', 65.00, 'soupe_oignon.jpg'),
('Escargots de Bourgogne', 'entrée', 'Francaise', 85.00, 'escargots.jpg'),
('Crème Brûlée', 'dessert', 'Francaise', 55.00, 'creme_brulee.jpg'),
('Tarte Tatin', 'dessert', 'Francaise', 50.00, 'tarte_tatin.jpg');


INSERT INTO commande_plat (idPlat, idCmd, qte) VALUES
(1, 'C001', 2),
(2, 'C001', 1),
(3, 'C002', 3),
(4, 'C003', 1),
(5, 'C004', 2);

