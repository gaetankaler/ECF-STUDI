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
-- Table structure for table `horaire_garage`
--

DROP TABLE IF EXISTS `horaire_garage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `horaire_garage` (
  `id` int NOT NULL AUTO_INCREMENT,
  `jour` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ouverture_matin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fermeture_matin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ouverture_apres_midi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fermeture_apres_midi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horaire_garage`
--

LOCK TABLES `horaire_garage` WRITE;
/*!40000 ALTER TABLE `horaire_garage` DISABLE KEYS */;
INSERT INTO `horaire_garage` VALUES (135,'Lundi','08:00','12:00','13:00','18:00'),(136,'Mardi','08:00','12:00','13:00','18:00'),(137,'Mercredi','08:00','12:00','13:00','18:00'),(138,'Jeudi','08:00','12:00','13:00','18:00'),(139,'Vendredi','08:00','12:00','13:00','18:00'),(140,'Samedi','08:00','12:00','13:00','18:00');
/*!40000 ALTER TABLE `horaire_garage` ENABLE KEYS */;
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
