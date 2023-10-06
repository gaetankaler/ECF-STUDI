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
-- Table structure for table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `commentaires` (
  `id` int NOT NULL AUTO_INCREMENT,
  `contenue` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pseudo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `note` int NOT NULL,
  `valide` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=430 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commentaires`
--

LOCK TABLES `commentaires` WRITE;
/*!40000 ALTER TABLE `commentaires` DISABLE KEYS */;
INSERT INTO `commentaires` VALUES (415,'Molestias dolore asperiores quis non accusantium nulla nobis. Non architecto cum assumenda rerum iusto aperiam. Perspiciatis id ex voluptatem et quis consequatur.','david93@live.com','stephane47','2023-09-28 10:13:25',5,1),(416,'Asperiores voluptatem officia explicabo repudiandae natus. Placeat quo excepturi earum hic accusamus. Modi est animi vel.','marianne.marchal@coste.org','herve.jules','2023-09-28 10:13:25',5,1),(417,'Iusto debitis nihil sapiente iste hic. Quia quis tempora molestiae perspiciatis quia aliquid vel. Consequatur debitis impedit assumenda omnis assumenda ea deleniti.','bbrunet@camus.com','isaac.texier','2023-09-28 10:13:25',5,1),(418,'Recusandae exercitationem eos itaque ea error. Consequatur adipisci error voluptatem voluptate. Placeat voluptate officiis autem sunt aspernatur aliquid.','alix98@guillet.com','guilbert.eugene','2023-09-28 10:13:25',2,1),(420,'Veritatis qui reprehenderit debitis amet molestiae est voluptatibus. Cupiditate labore voluptas similique illum dolores corrupti officia. Id et ea autem voluptatibus magnam totam sint.','nbertin@gmail.com','delorme.sylvie','2023-09-28 10:13:25',3,1),(421,'Vitae veritatis omnis atque et est blanditiis voluptatem temporibus. Repellendus rem eos consequatur omnis eius ut architecto. Quia omnis dolores minima.','araymond@bouvet.com','madeleine74','2023-09-28 10:13:25',3,1),(422,'Consequatur illum quis et beatae. Deserunt quasi aliquid officiis qui sint maxime voluptas pariatur. Quisquam odio explicabo ut itaque labore architecto pariatur ut.','schevalier@bertrand.fr','dominique36','2023-09-28 10:13:25',3,1),(423,'Debitis corporis nihil ex. Esse ea dolorem fugiat non ut odio. Laborum reiciendis exercitationem ipsum.','juliette.evrard@tiscali.fr','vincent90','2023-09-28 10:13:25',2,0),(424,'Qui sint nemo nemo eos cum. Molestiae quae dolor voluptas illum eveniet nihil rerum sed. Qui aspernatur et eaque quasi.','david.lefort@sfr.fr','joseph.nathalie','2023-09-28 10:13:25',1,0),(425,'Quia consequuntur accusamus dolores temporibus facilis vel iusto. Cupiditate exercitationem sed exercitationem molestiae. Quae veritatis laboriosam omnis nam sapiente voluptatem.','marchand.colette@georges.com','huet.maurice','2023-09-28 10:13:25',1,1),(426,'Fuga sit voluptatem autem error molestiae. Eaque repudiandae magnam id in. Corporis veritatis enim non veniam consequuntur iste ut.','vlecoq@voila.fr','benjamin.guyon','2023-09-28 10:13:25',1,0),(427,'Sequi deserunt nihil id sunt nihil qui. Incidunt eius vitae cum quasi. Repellendus id eum provident optio quam ea.','klaurent@lefort.com','joly.marcel','2023-09-28 10:13:25',1,1),(428,'Qui qui recusandae odio sint excepturi autem dolor. Aut nulla omnis dolores dolores corporis est. Dolor cupiditate omnis fugiat velit incidunt est.','wriou@faivre.fr','xlefort','2023-09-28 10:13:25',1,1),(429,'Quo quia saepe qui ab et explicabo quia non. Et atque autem non ut. Dolor omnis excepturi ut.','xfleury@faure.com','vdiallo','2023-09-28 10:13:25',4,1);
/*!40000 ALTER TABLE `commentaires` ENABLE KEYS */;
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
