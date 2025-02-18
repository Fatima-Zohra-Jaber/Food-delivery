CREATE DATABASE restaurant;

CREATE TABLE `client` ( 
`idClient` int(10) AUTO_INCREMENT PRIMARY KEY,
`nom` varchar(50) NOT NULL,
`prenom` varchar(50) DEFAULT NULL,
`tel` varchar(10) NOT NULL UNIQUE );

CREATE TABLE `commande` (
  `idCmd` CHAR(5) PRIMARY KEY,
  `dateCmd` DATETIME DEFAULT NULL,
  `Statut` ENUM('non commencé', 'en cours', 'prêt', 'livré') DEFAULT 'non commencé',
  `idClt` INT(11),
  FOREIGN KEY (`idClt`) REFERENCES `client`(`idClient`)
);

CREATE TABLE `plat` (
  `idPlat` int(10) AUTO_INCREMENT PRIMARY KEY,
  `nom` varchar(50) NOT NULL UNIQUE,
  `categorie` varchar(50) NOT NULL,
  `prix` decimal(6,2) NOT NULL,
  `photo` varchar(100) 
)
ALTER TABLE plat ADD COLUMN photo VARCHAR(100);

CREATE TABLE `commande_plat` (
  `idPlat` int(10) NOT NULL,
  `idCmd` char(5) NOT NULL,
  `qte` int(3) NOT NULL,
  FOREIGN KEY (`idPlat`) REFERENCES `plat`(`idPlat`),
  FOREIGN KEY (`idCmd`) REFERENCES `commande`(`idCmd`),
    PRIMARY KEY (idPlat,idCmd)

)

-- Insertion des données
INSERT INTO `plat` (`nom`, `categorie`, `prix`, `photo`) VALUES
('Pastilla au Poulet', 'Marocain', 120.00,"Pastilla-au-poulet.jpg"),
('Tajine de Kefta', 'Marocain', 85.00, "tagine-kefta.jpg"),
('Rfissa', 'Marocain', 125.00, "Rfissa.jpg"),
('Pizza Margherita', 'Italien', 85.00, "Pizza-Margherita.jpg"),
('Lasagne', 'Italien', 120.00, ""),
('Tacos au bœuf', 'Mexicain', 77.50, ""),
('Burrito Poulet', 'Mexicain', 95.00, ""),
('Burger Classique', 'Américain', 89.99, "Burger.jpg"),
('Hot Dog', 'Américain', 55.50, ""),
('Paella', 'Espagnol', 140.00, "Paella.jpg"),
('Couscous', 'Marocain', 139.99, "Couscous.jpg"),
('Spaghetti Carbonara', 'Italien', 95.00, "Spaghetti.jpg"),
('Sushi Mix', 'Japonais', 159.99, "Sushi.jpg"),
('Ramen', 'Japonais', 105.50, "Ramen.jpg"),
('Tempura Crevettes', 'Japonais', 135.00, "Tempura Crevettes.jpg"),
('Burrito Poulet', 'Mexicain', 95.00, ""),
('Quesadilla Fromage', 'Mexicain', 80.00, ""),
('Steakhouse Grill', 'Américain', 160.00, "Steakhouse"),
('Tajine de Poulet', 'Marocain', 110.00, "");


INSERT INTO `client` (`nom`, `prenom`, `tel`) VALUES
('Benkirane', 'Abdelilah', '0650123456'),
('El Fassi', 'Mouad', '0661123456'),
('Choukri', 'Sabrina', '0672123456'),
('El Hajj', 'Omar', '0653123456'),
('Mouhsine', 'Youssef', '0673123456'),
('Rachid', 'Mouna', '0684123456'),
('Amrani', 'Karim', '0654123456'),
('Kabbaj', 'Salma', '0665123456'),
('Fakir', 'Ali', '0675123456'),
('Slaoui', 'Nada', '0656123456'),
('Mouhssine', 'Fatima', '0666123456'),
('Brahimi', 'Adil', '0676123456'),
('Oukassi', 'Khadija', '0657123456'),
('Naji', 'Samira', '0667123456'),
('Lahmadi', 'Yassine', '0677123456');


INSERT INTO `commande` (`idCmd`, `dateCmd`, `Statut`, `idClt`) VALUES
('C001', '2025-02-17 10:30:00', 'en cours', 1),
('C002', '2025-02-17 11:00:00', 'non commencé', 2),
('C003', '2025-02-17 12:00:00', 'prêt', 3),
('C004', '2025-02-17 13:00:00', 'livré', 4),
('C005', '2025-02-17 14:30:00', 'en cours', 5),
('C006', '2025-02-17 15:00:00', 'non commencé', 6),
('C007', '2025-02-17 16:15:00', 'prêt', 7),
('C008', '2025-02-17 17:30:00', 'livré', 8),
('C009', '2025-02-17 18:00:00', 'en cours', 9),
('C010', '2025-02-17 19:00:00', 'non commencé', 10);


INSERT INTO `commande_plat` (`idPlat`, `idCmd`, `qte`) VALUES
(1, 'C001', 2),  -- 2 pizzas Margherita pour la commande C001
(2, 'C002', 1),  -- 1 Lasagne pour la commande C002
(3, 'C003', 3),  -- 3 Sushi Mix pour la commande C003
(4, 'C004', 1),  -- 1 Ramen pour la commande C004
(5, 'C005', 4),  -- 4 Tacos au bœuf pour la commande C005
(6, 'C006', 2),  -- 2 Burritos Poulet pour la commande C006
(7, 'C007', 3),  -- 3 Burgers Classiques pour la commande C007
(8, 'C008', 1),  -- 1 Hot Dog pour la commande C008
(9, 'C009', 2),  -- 2 Paella pour la commande C009
(10, 'C010', 1); -- 1 Couscous Royal pour la commande C010




INSERT INTO `plat` (`idPlat`, `nomPlat`, `categoryPlat`, `TypeCuisine`, `prix`, `image`) VALUES
(3, 'Poulet Rôti', 'plat principal', 'Internationale', 9.99, 'https://www.apero-bordeaux.fr/wp-content/uploads/2024/02/20240216_65cfa1ce1fa54.jpg.webp'),
(4, 'Kefta Mkaouara', 'plat principal', 'Marocaine', 8.49, 'https://tasteofmaroc.com/wp-content/uploads/2018/02/kefta-tagine-oysy-bigstock-kofta-tajine-kefta-tagine-mo-65105917.jpg'),
(5, 'Mechoui', 'plat principal', 'Marocaine', 13.49, 'https://www.tangeraccueil.org/local/cache-vignettes/L600xH368/evenementon1957-17b12.jpg?1619980398'),
(6, 'Rfissa', 'plat principal', 'Marocaine', 12.49, 'https://patisseriegato.ma/wp-content/uploads/2023/08/rfissa-marocaine.webp'),
(7, 'Pastilla au Poulet', 'entrée', 'Marocaine', 11.99, 'https://www.sousou-kitchen.com/wp-content/uploads/2015/05/Pastilla-au-poulet..jpg'),
(8, 'Salade Marocaine', 'entrée', 'Marocaine', 4.99, 'https://abattoirdebondy.fr/wp-content/uploads/2020/10/bcdeb661911e43b996ca17953be67c83.jpg'),
(9, 'Briouates', 'entrée', 'Marocaine', 6.99, 'https://www.hervecuisine.com/wp-content/uploads/2016/11/recette-briouates-poulet.jpg'),
(10, 'Harira', 'entrée', 'Marocaine', 5.99, 'https://www.mesinspirationsculinaires.com/wp-content/uploads/2015/02/harira-recette-marocaine-1.jpg'),
(11, 'Zaalouk', 'entrée', 'Marocaine', 5.49, 'https://www.thedeliciouscrescent.com/wp-content/uploads/2021/09/Zaalouk-5-480x270.jpg'),
(12, 'Sardines Grillées', 'entrée', 'Marocaine', 7.99, 'https://cuisine.nessma.tv/uploads/7/2020-06/dda2e0ecf300305eb4eff3a4ea922ce8.jpg'),
(13, 'Mrouzia', 'plat principal', 'Marocaine', 14.99, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQPsriN_grh4a_18Xu7r-vVy5siU4niZwyrmw&s'),
(14, 'Pain Marocain', 'entrée', 'Marocaine', 2.99, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRfx83DX9RWKNRbbVLyWpj9JCW7B01ZLchTkQ&s'),
(15, 'Chbakia', 'dessert', 'Marocaine', 3.99, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTucnRAEYhh-8tTvKVmWXt50MhoExZ_WUi1zQ&s'),
(16, 'Baklava', 'dessert', 'Moyen-Orientale', 4.49, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTqcXBktNsIimO0afpqZTFfKzsZaqzk-5FHsQ&s'),
(17, 'Mhancha', 'dessert', 'Marocaine', 5.99, 'https://www.la-cuisine-marocaine.com/photos-recettes/mhancha-amandes.jpg'),
(18, 'Makroud', 'dessert', 'Marocaine', 4.99, 'https://www.caaleyrebon.fr/wp-content/uploads/2022/02/caaleyrebon-makroud4-500x327.jpg'),
(19, 'Sellou', 'dessert', 'Marocaine', 3.49, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRM3LEyA3X3UYrV-fcowNazNTLCewHQLkfe-A&s'),
(20, 'Baghrir', 'dessert', 'Marocaine', 2.99, 'https://i0.wp.com/www.programme-malin.com/wp-content/uploads/2020/10/Sans-nom-6.jpg?fit=1920%2C1080&ssl=1'),
(21, 'Paella', 'plat principal', 'Espagnole', 14.99, 'https://themediterraneanchick.com/wp-content/uploads/2020/09/IMG_0825-1-scaled.jpg'),
(22, 'Fideuà', 'plat principal', 'Espagnole', 13.49, 'https://imag.bonviveur.com/fideua-de-pescado-y-marisco.jpg'),
(23, 'Risotto aux Champignons', 'plat principal', 'Italienne', 12.99, 'https://m1.zeste.ca/serdy-m-dia-inc/image/upload/f_auto/fl_lossy/q_auto:eco/x_0,y_699,w_2721,h_1530,c_crop/w_1200,h_630,c_fill/v1541705178/foodlavie/prod/recettes/risotto-aux-champignons-4b5bce42'),
(24, 'Lasagnes', 'plat principal', 'Italienne', 11.99, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRVhEF4ZxEU_LgV0CefrC5eb5iQRU039NDtCA&s'),
(25, 'Poulet Tikka Masala', 'plat principal', 'Indienne', 13.99, 'https://image.over-blog.com/BF0JiSWAA9-nrGn8zOrhalmzjo4=/filters:no_upscale()/image%2F0651923%2F20200914%2Fob_b7e6de_recette-poulet-tikka-masala.jpg'),
(26, 'Butter Chicken', 'plat principal', 'Indienne', 14.49, 'https://images.immediate.co.uk/production/volatile/sites/30/2021/02/butter-chicken-ac2ff98.jpg'),
(27, 'Canard Laqué', 'plat principal', 'Chinoise', 16.99, 'https://images.squarespace-cdn.com/content/v1/532d9b45e4b0ff70f47a1674/1518795186833-PBID1LBYMIOSPCO41MOX/Canard+Laqu%C3%A9+Cyril+Rouquet-Pr%C3%A9vost'),
(28, 'Bœuf Sauté aux Légumes', 'plat principal', 'Chinoise', 12.99, 'https://m1.zeste.ca/serdy-m-dia-inc/image/upload/f_auto/fl_lossy/q_auto:eco/x_0,y_0,w_1279,h_720,c_crop/w_1200,h_630,c_scale/v1642452008/foodlavie/prod/articles/top-recettes-de-saute-de-boeuf-27ca7e85'),
(29, 'Dim Sum', 'plat principal', 'Chinoise', 10.99, 'https://cdn.britannica.com/55/234755-050-ED5FBC23/dim-sum-chopsticks.jpg'),
(30, 'Chow Mein', 'plat principal', 'Chinoise', 11.99, 'https://s.lightorangebean.com/media/20240914164843/chow-mein-fun-done.png'),
(31, 'Gazpacho', 'entrée', 'Espagnole', 5.99, 'https://castey.com/wp-content/uploads/2024/08/1-3.jpg'),
(32, 'Tapas Variés', 'entrée', 'Espagnole', 7.49, 'https://lh3.googleusercontent.com/proxy/2hBJuZWZrKUF8QHiUiVd_fZid7rahBR6YnCIOhSHgG8tEShOeleWpYqY6Z-AnbtrQ8wV3LJTJLvNo2_B9tJfi4G_4RfBcV1VFICdN-6MwtELH1c'),
(33, 'Bruschetta', 'entrée', 'Italienne', 6.99, 'https://saratogaoliveoil.com/cdn/shop/articles/TomatoBruchetta-300x250.jpg?v=1663185079'),
(34, 'Caprese', 'entrée', 'Italienne', 7.99, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRuiNkkn-JbmLYL7TeBD3l7XNerf89TlNRAIg&s'),
(35, 'Samosa', 'entrée', 'Indienne', 5.49, 'https://www.indianhealthyrecipes.com/wp-content/uploads/2021/12/samosa-recipe.jpg'),
(36, 'Pakora', 'entrée', 'Indienne', 6.49, 'https://static01.nyt.com/images/2024/07/25/multimedia/ND-Pakorarex-clfq/ND-Pakorarex-clfq-threeByTwoMediumAt2X.jpg'),
(37, 'Rouleaux de Printemps', 'entrée', 'Chinoise', 5.99, 'https://img.cuisineaz.com/1024x576/2018/01/17/i135088-rouleau-de-printemps.webp'),
(38, 'Soupe Aigre-Douce', 'entrée', 'Chinoise', 6.99, 'https://www.la-viande.fr/sites/default/files/styles/slider_recettes/public/recettes/images/soupe-aigre-douce-chinoise-au-chevreau.jpg?itok=SLa5WzO6'),
(39, 'Gyoza', 'entrée', 'Chinoise', 7.49, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS7ZCE9uPWOv3g-gbpx_xCq3xTbdhZgD72c3g&s'),
(40, 'Salade de Concombres Épicée', 'entrée', 'Chinoise', 5.49, 'https://m1.zeste.ca/serdy-m-dia-inc/image/upload/f_auto/fl_lossy/q_auto:eco/x_10,y_0,w_3047,h_1714,c_crop/w_1200,h_630,c_fill/v1662582185/foodlavie/prod/recettes/salade-de-concombre-herbes-epices-0c30ba49'),
(41, 'Tarta de Santiago', 'dessert', 'Espagnole', 4.99, '2wCEAAkGBxMTEhUTExMWFhUVGBgYGBgVFxcXGBcYGhUYGBgaGBgYHigiGBolHRcXITEhJikrLi4uFx8zODMtNygtLisBCgoKDg0OGhAQGy0lHyUtLS0tKy8tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLf'),
(42, 'Churros avec Chocolat', 'dessert', 'Espagnole', 5.49, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTbCt0d1VKsBs_TqAlYWjVCDZxxAx6djTa9yg&s'),
(43, 'Tiramisu', 'dessert', 'Italienne', 6.99, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTqxullZdEFw3ic583k-AW0fpjTGbvokTEIiw&s'),
(44, 'Panna Cotta', 'dessert', 'Italienne', 5.99, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcROGp72KujLJBa0r0DB9L75ZA8KXQYlNyrw_A&s'),
(45, 'Gulab Jamun', 'dessert', 'Indienne', 4.49, 'https://theartisticcook.com/wp-content/uploads/2024/10/Gulab-Jamun-with-Milk-Powder.jpg'),
(46, 'Rasgulla', 'dessert', 'Indienne', 4.99, 'https://madhurasrecipe.com/wp-content/uploads/2023/10/Rasgulla-Featured-Image.jpg'),
(47, 'Mochi', 'dessert', 'Chinoise', 5.49, 'https://images.getrecipekit.com/20240411054015-peach-mochi.webp?class=16x9'),
(48, 'Baozi au Lait Sucré', 'dessert', 'Chinoise', 4.99, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSfEc7tb3dlZ6hwX1fSwf0Cjc4tE8zePcPy5w&s'),
(49, 'Tangyuan', 'dessert', 'Chinoise', 5.49, 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/34/Pumpkin_tangyuan_%28%E6%B1%A4%E5%9C%86%29_with_red_bean_baste_and_black_sesame_fillings.jpg/800px-Pumpkin_tangyuan_%28%E6%B1%A4%E5%9C%86%29_with_red_bean_baste_and_black_sesame_fillings.jpg'),
(50, 'Mooncake', 'dessert', 'Chinoise', 6.49, 'https://images.getrecipekit.com/20221128194311-how-to-make-chinese-mooncake.jpg?aspect_ratio=4:3&quality=90&');
