-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: garagevparrot
-- ------------------------------------------------------
-- Server version	8.0.34

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `voiture`
--

DROP TABLE IF EXISTS `voiture`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `voiture` (
  `id` int NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `annee` int NOT NULL,
  `kilometre` int NOT NULL,
  `chevaux` int NOT NULL,
  `prix` int NOT NULL,
  `date_enregistrement` datetime NOT NULL,
  `detail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `porte` int NOT NULL,
  `motorisation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gps` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `camera` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `updated_at` datetime NOT NULL,
  `name_image_carousel1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_image_carousel2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_image_carousel3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=502 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `voiture`
--

LOCK TABLES `voiture` WRITE;
/*!40000 ALTER TABLE `voiture` DISABLE KEYS */;
INSERT INTO `voiture` VALUES (496,'photo.jpg','ut delectus','At sunt voluptas architecto. Vel ut aut eum a exercitationem tempora. Ipsam harum sunt libero reprehenderit non qui est aspernatur.',2017,960860,429,32364,'2023-09-28 10:13:28',NULL,5,'Electique','Non','Oui',1,'2023-09-28 10:13:28','photo.jpg','photo.jpg','photo.jpg'),(497,'photo.jpg','ut delectus','Aut tempore quod corrupti rerum expedita pariatur. Mollitia minus maxime non maxime. Aut nesciunt officia hic expedita eum omnis aut eum.',1960,100143,969,8677,'2023-09-28 10:13:28',NULL,5,'Diesel','Non','Non',1,'2023-09-28 10:13:28','photo.jpg','photo.jpg','photo.jpg'),(498,'photo.jpg','tempore voluptatum','Voluptate inventore in in quos repellat numquam quam. Dignissimos et corporis tenetur officiis cumque maiores. Nisi soluta consequatur consequatur.',2019,181967,55,35774,'2023-09-28 10:13:28',NULL,3,'Diesel','Non','Non',1,'2023-09-28 10:13:28','photo.jpg','photo.jpg','photo.jpg'),(499,'photo.jpg','temporibus porro','Et et omnis quisquam mollitia excepturi. Voluptatem quam vero labore animi. Velit unde iusto delectus quidem.',1963,14703,51,33521,'2023-09-28 10:13:28',NULL,5,'Essence','Oui','Oui',1,'2023-09-28 10:13:28','photo.jpg','photo.jpg','photo.jpg'),(500,'photo.jpg','nulla temporibus','Unde magnam qui ea est sit fugiat quia. Dicta vel nemo nemo maiores inventore consequatur autem. Animi assumenda sint blanditiis possimus illum.',1955,987923,984,26321,'2023-09-28 10:13:28',NULL,3,'Electique','Oui','Non',1,'2023-09-28 10:13:28','photo.jpg','photo.jpg','photo.jpg'),(501,'photo.jpg','eum error','Ex quia eum voluptatibus est est quibusdam vero. Dolorem omnis asperiores inventore qui culpa voluptate et. Nemo earum perferendis commodi exercitationem deleniti.',1950,666124,908,12906,'2023-09-28 10:13:28',NULL,5,'Electique','Oui','Non',1,'2023-09-28 10:13:28','photo.jpg','photo.jpg','photo.jpg');
/*!40000 ALTER TABLE `voiture` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-10-02 16:16:02
