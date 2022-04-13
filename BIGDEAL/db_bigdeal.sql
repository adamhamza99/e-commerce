-- MySQL dump 10.13  Distrib 8.0.28, for Linux (x86_64)
--
-- Host: localhost    Database: BIGDEAL
-- ------------------------------------------------------
-- Server version	8.0.28-0ubuntu0.20.04.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `address` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D4E6F81A76ED395` (`user_id`),
  CONSTRAINT `FK_D4E6F81A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address`
--

LOCK TABLES `address` WRITE;
/*!40000 ALTER TABLE `address` DISABLE KEYS */;
INSERT INTO `address` VALUES (12,21,'Maison','Alexandre','Lazerat',NULL,'19 rue au moine','45005','Orléans','FR','0658955987');
/*!40000 ALTER TABLE `address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carrier`
--

DROP TABLE IF EXISTS `carrier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carrier` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrier`
--

LOCK TABLES `carrier` WRITE;
/*!40000 ALTER TABLE `carrier` DISABLE KEYS */;
INSERT INTO `carrier` VALUES (1,'Colissimo','Profitez d\'une livraison premium avec un colis chez vous dans les 72 prochaines heures.',6.5),(2,'Chronopost','Vos colis sont livrés dès le lendemain avant 10h ou avant 13h.',9.9);
/*!40000 ALTER TABLE `carrier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Informatique'),(2,'Image & son'),(3,'Téléphonie & Auto');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20220325102653','2022-03-25 11:28:20',85),('DoctrineMigrations\\Version20220325110052','2022-03-25 12:01:28',53),('DoctrineMigrations\\Version20220328132030','2022-03-28 15:21:28',69),('DoctrineMigrations\\Version20220328150408','2022-03-28 17:04:17',179),('DoctrineMigrations\\Version20220330101318','2022-03-30 12:13:27',197),('DoctrineMigrations\\Version20220330133244','2022-03-30 15:32:51',84),('DoctrineMigrations\\Version20220330135844','2022-03-30 15:58:54',318),('DoctrineMigrations\\Version20220331072811','2022-03-31 09:28:22',65),('DoctrineMigrations\\Version20220331155827','2022-03-31 17:58:54',44),('DoctrineMigrations\\Version20220404134652','2022-04-04 15:47:09',60);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `created_at` datetime NOT NULL,
  `carrier_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `carrier_price` double NOT NULL,
  `delivery` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_paid` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F5299398A76ED395` (`user_id`),
  CONSTRAINT `FK_F5299398A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` VALUES (35,21,'2022-04-01 20:02:24','Colissimo[br]Profitez d\'une livraison premium avec un colis chez vous dans les 72 prochaines heures.[br]6,50 €',6.5,'Alexandre Lazerat<br/>0658955987<br/>19 rue au moine<br/>45005 Orléans<br/>FR',0),(36,21,'2022-04-01 20:10:34','Colissimo[br]Profitez d\'une livraison premium avec un colis chez vous dans les 72 prochaines heures.[br]6,50 €',6.5,'Alexandre Lazerat<br/>0658955987<br/>19 rue au moine<br/>45005 Orléans<br/>FR',0),(44,21,'2022-04-07 16:52:20','Colissimo[br]Profitez d\'une livraison premium avec un colis chez vous dans les 72 prochaines heures.[br]6,50 €',6.5,'Alexandre Lazerat<br/>0658955987<br/>19 rue au moine<br/>45005 Orléans<br/>FR',0),(45,21,'2022-04-08 16:29:27','Colissimo[br]Profitez d\'une livraison premium avec un colis chez vous dans les 72 prochaines heures.[br]6,50 €',6.5,'Alexandre Lazerat<br/>0658955987<br/>19 rue au moine<br/>45005 Orléans<br/>FR',0),(46,21,'2022-04-08 16:35:43','Colissimo[br]Profitez d\'une livraison premium avec un colis chez vous dans les 72 prochaines heures.[br]6,50 €',6.5,'Alexandre Lazerat<br/>0658955987<br/>19 rue au moine<br/>45005 Orléans<br/>FR',0),(47,21,'2022-04-08 16:36:41','Colissimo[br]Profitez d\'une livraison premium avec un colis chez vous dans les 72 prochaines heures.[br]6,50 €',6.5,'Alexandre Lazerat<br/>0658955987<br/>19 rue au moine<br/>45005 Orléans<br/>FR',0),(48,21,'2022-04-08 16:36:59','Chronopost[br]Vos colis sont livrés dès le lendemain avant 10h ou avant 13h.[br]9,90 €',9.9,'Alexandre Lazerat<br/>0658955987<br/>19 rue au moine<br/>45005 Orléans<br/>FR',0),(49,21,'2022-04-08 16:40:28','Chronopost[br]Vos colis sont livrés dès le lendemain avant 10h ou avant 13h.[br]9,90 €',9.9,'Alexandre Lazerat<br/>0658955987<br/>19 rue au moine<br/>45005 Orléans<br/>FR',0);
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `my_order_id` int NOT NULL,
  `product` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL,
  `price` double NOT NULL,
  `total` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_845CA2C1BFCDF877` (`my_order_id`),
  CONSTRAINT `FK_845CA2C1BFCDF877` FOREIGN KEY (`my_order_id`) REFERENCES `order` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_details`
--

LOCK TABLES `order_details` WRITE;
/*!40000 ALTER TABLE `order_details` DISABLE KEYS */;
INSERT INTO `order_details` VALUES (46,35,'Hisense 32A4BG',1,19999,19999),(47,36,'Hisense 32A4BG',1,19999,19999),(48,36,'ASUS DUAL GeForce RTX 3050 O8G (LHR)',1,47695,47695),(59,44,'ASUS DUAL GeForce RTX 3050 O8G (LHR)',1,47695,47695),(60,45,'JBL TUNE 700BT Noir',1,4999,4999),(61,45,'Samsung Galaxy S21 5G Graphite (6 Go / 128 Go)',1,69995,69995),(62,46,'JBL TUNE 700BT Noir',1,4999,4999),(63,46,'Samsung Galaxy S21 5G Graphite (6 Go / 128 Go)',1,69995,69995),(64,47,'Toshiba Canvio Ready 2 To Noir',1,7996,7996),(65,48,'Toshiba Canvio Ready 2 To Noir',1,7996,7996),(66,48,'Apple iPhone 11 64 Go (PRODUCT)RED',1,58900,58900),(67,49,'Toshiba Canvio Ready 2 To Noir',1,7996,7996),(68,49,'Hisense 32A4BG',1,19999,19999);
/*!40000 ALTER TABLE `order_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `illustration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `is_best` tinyint(1) NOT NULL,
  `is_new` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D34A04AD12469DE2` (`category_id`),
  CONSTRAINT `FK_D34A04AD12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (16,1,'Toshiba Canvio Ready 2 To Noir','disque-dur-externe-320-gb','d1709f836a59938a20d1758bc2c4b0f79d42b757.jpg','Disque dur externe 2 To 2.5\" USB 3.0','Le disque dur externe USB 3.0 Toshiba Canvio Ready possède tous les avantages pour un stockage simplifié en toute sérénité. Retrouvez des vitesses de transfert élevées, une finition élégante et une capacité de stockage étendue pour répondre à l\'ensemble de vos besoins.',7996,1,0),(18,1,'ASUS DUAL GeForce RTX 3050 O8G (LHR)','asus-dual-geforce-rtx-3050-o8g-lhr','9295c75d63b474baf93dee1fea11635b9cd0a5fe.jpg','8 Go GDDR6 - HDMI/Tri DisplayPort - PCI Express (NVIDIA GeForce RTX 3050)','La carte graphique ASUS DUAL GeForce RTX 3050 O8G (LHR) embarque 8 Go de mémoire vidéo de nouvelle génération GDDR6 pour des graphismes sublimés, une fluidité remarquable et un réalisme incroyable. C\'est la carte idéale pour jouer en Full HD.',47695,1,1),(19,2,'Blaupunkt BN43U2132FEB','blaupunkt-bn43u2132feb','58afab824e9e22798c74c5220da6eee3d31c7776.jpg','Téléviseur LED 4K UHD 43\" (109 cm) 16/9 - 3x HDMI - 2x USB - Son 2.0 16W','Avec son design épuré et ses pieds latéraux, la TV 4K UHD Blaupunkt BN43U2132FEB s\'intègre idéalement dans votre intérieur pour vous donner accès à un divertissement de haute qualité. Ce modèle est équipé d\'une connectique optimale pour faciliter son installation et d\'un système audio stéréo.',33995,0,0),(20,2,'Hisense 32A4BG','hisense-32a4bg','5f90d156f29ec01779c95e0c5e9948dd6c0c9bf4.jpg','Téléviseur LED HD 32\" (81 cm) 16/9 - Wi-Fi - HDMI/USB - Son 2.0 12W','Le téléviseur Hisense 32A4BG propose un divertissement de qualité et facilement accessible. Design épuré, contrôle pratique et fonctions connectées, ce modèle vous accompagnera dans toutes vos envies. Bénéficiez d\'une belle image aux couleurs étendues, d\'un son stéréo immersif.',19999,1,1),(21,3,'Apple iPhone 11 64 Go (PRODUCT)RED','apple-iphone-11-64-go-productred','9ab76c9a12d1aa505c8dae04a9b5e3c021027916.jpg','Apple A13 Bionic Hexa-Core - RAM 4 Go - Ecran 6.1\" 828 x 1792 - 64 Go','Conçu pour élargir vos horizons, l\'iPhone 11 d\'Apple vous séduira en un rien de temps. Arborant des matériaux de haute qualité, il vous en mettra plein les yeux grâce à son magnifique écran Liquid Retina HD de 6.1 pouces à résolution 828 x 1792 pixels.',58900,1,0),(22,3,'Apple iPhone 13 Pro Max 128 Go Bleu Alpin','apple-iphone-13-pro-max-128-go-bleu-alpin','9747d0a456b59a44933d0bd5c3826dbd968bc0a4.jpg','Apple A15 Bionic Hexa-Core - RAM 6 Go -  128 Go  - iOS 15','iPhone 13 Pro Max. Un système photo pro amélioré comme jamais. Un écran Super Retina XDR de 6,7 pouces avec technologie ProMotion pour plus de rapidité et de réactivité. La puce A15 Bionic, d\'une vitesse fulgurante. La 5G ultra-rapide.',125900,0,1),(23,1,'WD Elements Portable 4 To Noir (USB 3.0)','wd-elements-portable-4-to-noir-usb-30','5de867b3725e0e19e51a0baf9d4652498a3a2fe1.jpg','Disque dur externe 2.5\" sur port USB 3.0 / USB 2.0','Le Western Digital Elements Portable 4 To USB 3.0 est un disque dur portable, simple et de grande qualité qui est léger et facile à porter. Il suffit de le brancher à un port USB pour commencer à enregistrer vos photos, vos musiques, vos vidéos et vos fichiers.',12400,0,0),(24,3,'Samsung Galaxy S21 5G Graphite (6 Go / 128 Go)','samsung-galaxy-s21-5g-graphite-6-go-128-go','3537d7971f5774eeac53b2583282ec3ba1868842.png','Smartphone 5G-LTE Dual SIM IP68 - Snapdragon 888 - RAM 6 Go - 128 Go - NFC/Bluetooth 5.0 - Android 12','Exprimez clairement votre style avec le Samsung Galaxy S21 FE Fan Edition. Doté d\'un sublime écran Infinity Super AMOLED de 6.4\" avec résolution Full HD+ 1080 x 2340 pixels, il offre un rafraichissement de 120 Hz pour une fluidité incroyable',69995,0,1),(40,1,'AMD Ryzen 5 5500 Wraith Stealth (3.6 GHz / 4.2 GHz)','amd-ryzen-5-5500-wraith-stealth-36-ghz-42-ghz','19e4f7fffdbd89273d462a24f8b9977b559bdbed.jpg','Processeur 6-Core 12-Threads socket AM4 GameCache 19 Mo 7 nm TDP 65W','Le processeur AMD Ryzen 5 5500 est taillé pour le jeu vidéo : 6 Cores, 12 Threads et GameCache 19 Mo. Sans parler des fréquences natives et boost qui atteignent des sommets pour vous permettre de profiter de vos jeux préférés dans les meilleures conditions.',20495,0,0),(41,1,'AMD Ryzen 3 4100 (3.8 GHz / 4.0 GHz)','amd-ryzen-3-4100-38-ghz-40-ghz','c8256e6df90f8dff77854a4a35daf1aed0e57366.jpg','Processeur 4-Core 8-Threads socket AM4 Cache 6 Mo 7 nm TDP 65W','Le processeur pour PC de bureau AMD Ryzen 3 4100 est basé sur l\'architecture AMD Zen 2. Il intègre 4 coeurs physiques + 8 coeurs logiques ainsi que 6 Mo de cache (L2 + L3). Grâce à des fréquences de fonctionnement élevées, il offre de bonnes performances dans tous les domaines.',12496,0,0),(42,1,'Textorm 32 Go (2x 16 Go) DDR4 3200 MHz CL16','textorm-32-go-2x-16-go-ddr4-3200-mhz-cl16','a4e5da3f277b7043fd767c761d077bec7a3bf807.jpg','Kit Dual Channel 2 barrettes de RAM DDR4 PC4-25600 - 2XTXU16G2M320','La RAM Textorm 32 Go (2x 16 Go) DDR4 3200 MHz CL16 est idéale pour l\'intégration ou pour réaliser un upgrade PC. Cette mémoire vive abordable et performante fonctionne à une tension de 1.35 Volts (XMP) et est équipée de radiateurs pour une meilleure dissipation de la chaleur.',17795,0,0),(43,1,'Kingston FURY Beast 16 Go (2 x 8 Go) DDR4 3200 MHz CL16','kingston-fury-beast-16-go-2-x-8-go-ddr4-3200-mhz-cl16','0eb3b3a8c3ee32f6f816872829fbc86678f1e019.jpg','Kit Dual Channel 2 barrettes de RAM DDR4 PC4-25600 - KF432C16BBK2/16','La mémoire PC Kingston FURY Beast DDR4 apporte une puissante augmentation des performances pour les jeux, l\'édition vidéo et le rendu avec des vitesses allant jusqu\'à 3733 MHz. Cette mise à niveau rentable est disponible à des vitesses de 2666 MHz à 3733 MHz avec des latences CL15 à 19.',7995,0,0),(44,1,'Seagate Exos 7E2000 2.5 HDD 1 To (ST1000NX0313)','seagate-exos-7e2000-25-hdd-1-to-st1000nx0313','10c6376bba49b56091b7048ee0799557e201df72.jpg','Disque dur serveur 2.5\" 1 To 7200 RPM 128 Mo SATA 6Gb/s 512e','Les disques durs Exos 7E2000 de Seagate permettent un stockage de masse à moindre coût dans les infrastructures de centre de données nécessitant un disque dur d\'entreprise haute fiabilité.',32395,0,0),(45,2,'JBL TUNE 700BT Noir','jbl-tune-700bt-noir','5dd994b9a2ec5c5d9c40bd5ef67811a5091d4796.jpg','Casque circum-auriculaire sans fil - Bluetooth 4.2 - Commandes/Micro - Autonomie 24h','Léger, moderne et connecté, le casque sans fil JBL TUNE 700BT est un formidable allié pour savourer vos morceaux préférés. Idéalement posé sur vos oreilles, il délivre un son JBL de qualité tout en se connectant sans le moindre fil à votre appareil mobile via Bluetooth.',4999,0,0),(46,2,'JBL Flip 5 Rouge','jbl-flip-5-rouge','3138fcd041ea22378f74691352f85ae9d18958e8.jpg','Enceinte portable sans fil Bluetooth - 20 Watts - Etanche (IPX7) - Autonomie 12 heures','L\'enceinte Bluetooth JBL Flip 5 dévoile tout son potentiel dans un format compact pratique au quotidien. Appréciez un son de qualité pour mettre l\'ambiance, un design résistant à l\'eau ainsi qu\'une longue autonomie de 12 heures.',19999,0,0);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (21,'Alexandre@yopmail.com','[]','$2y$13$jp2O7.ilDEj/ZfSnfqCYRuoRVV2qpq.Uka57aaVkik68JvkdNZUVO','Alexandre','Lazerat'),(33,'adam.hamza@epitech.eu','[\"ROLE_ADMIN\"]','$2y$13$RFtWOx49GijtfVdtj/jDEuOkX9BpEbAIFZuqiSV1c4njJ6gJGHFP.','Adam','HAMZA'),(34,'admin@admin.fr','[\"ROLE_ADMIN\"]','$2y$13$WgovzNnBitVx.MNV4m4uIe/Dn5DoXja/YmPNnl3c03YeqW64Tx4ii','John','Doe'),(35,'Romain.molina@yopmail.com','[]','admin','Romain','Molina');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-04-13 11:36:08
