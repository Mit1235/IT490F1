-- MySQL dump 10.13  Distrib 8.0.28, for Linux (x86_64)
--
-- Host: localhost    Database: IT490F1
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
-- Table structure for table `brackets`
--

DROP TABLE IF EXISTS `brackets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `brackets` (
  `bracketID` smallint NOT NULL AUTO_INCREMENT,
  `bracketName` varchar(40) NOT NULL,
  `player1Name` varchar(40) NOT NULL,
  `player1Driver1` varchar(40) DEFAULT NULL,
  `player1Driver2` varchar(40) DEFAULT NULL,
  `player1PitCrew` varchar(40) DEFAULT NULL,
  `player1Score` int NOT NULL,
  `player2Name` varchar(40) DEFAULT NULL,
  `player2Driver1` varchar(40) DEFAULT NULL,
  `player2Driver2` varchar(40) DEFAULT NULL,
  `player2PitCrew` varchar(40) DEFAULT NULL,
  `player2Score` int DEFAULT NULL,
  `player3Name` varchar(40) DEFAULT NULL,
  `player3Driver1` varchar(40) DEFAULT NULL,
  `player3Driver2` varchar(40) DEFAULT NULL,
  `player3PitCrew` varchar(40) DEFAULT NULL,
  `player3Score` int DEFAULT NULL,
  `player4Name` varchar(40) DEFAULT NULL,
  `player4Driver1` varchar(40) DEFAULT NULL,
  `player4Driver2` varchar(40) DEFAULT NULL,
  `player4PitCrew` varchar(40) DEFAULT NULL,
  `player4Score` int DEFAULT NULL,
  PRIMARY KEY (`bracketID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brackets`
--

LOCK TABLES `brackets` WRITE;
/*!40000 ALTER TABLE `brackets` DISABLE KEYS */;
INSERT INTO `brackets` VALUES (2,'TestBracket','Zach','Charles','Yuki','PitCrew1',0,'Mit','Esteban','Lando','PitCrew2',0,'Sarah','Yuki','Esteban','PitCrew3',0,'Theja','Lando','Yuki','PitCrew4',0),(6,'NewBracket1','thejat',NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,'NewBracket2','thejat',NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `brackets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comments` (
  `commentID` int NOT NULL AUTO_INCREMENT,
  `bracketName` varchar(40) NOT NULL,
  `username` varchar(40) NOT NULL,
  `commentText` varchar(999) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`commentID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,'TestBracket','Zach','this is a comment'),(2,'TestBracket','Mit','this is another comment'),(3,'AnotherBracket','Theja','this is yet another comment'),(4,'h','fhsdhf','hdfhfhdh'),(5,'TestBracket','Mit','jjfjfjsjajfs'),(6,'TestBracket','Mit','hshhshshs');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `userID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(99) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(40) NOT NULL,
  `isNotif` tinyint NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (6,'johndoe','$2y$10$dpe5H4J1XDcrUzpXrB8Y4eVaRUvsCbvr/yOBEKN.FACAS2wIq21NG','johndoe@gmail.com',1),(9,'steve','$2y$10$zzMnGUT2yVLEiVgF09G5kuxnIOecRIEk5zry0ZXvcwJlpjhOZoNhK','test@email.com',1),(10,'Mit','$2y$10$qVKXfvxbFWYGkodGR6P.eOVaSj3YydpW2jBIHO/FRgjZYs6m/.G0O','Mp875@njit.edu',1),(12,'Zach','$2y$10$5dSVvWtxaEiMF90rU1CzXuBoE/9D0p0nkQMuOLgV0S6t8/1UNGcRa','zrt6@njit.edu',0),(14,'thejat','$2y$10$FKYPsEn9zw.Balyy2Nusp.j01rAiVzOOhvdSPFLJ6IRbbf1zo0vue','beharteja@gmail.com',0),(15,'TestUser','$2y$10$W.HARmAibzBUn1O9aQh41uaBfARa8m/.ha96RvZi3NiXHl7fZNLOq','testuser@njit.edu',0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `versions`
--

DROP TABLE IF EXISTS `versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `versions` (
  `versionNo` int NOT NULL AUTO_INCREMENT,
  `versionName` varchar(40) NOT NULL,
  `workingStatus` tinyint DEFAULT NULL,
  PRIMARY KEY (`versionNo`)
) ENGINE=InnoDB AUTO_INCREMENT=203 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `versions`
--

LOCK TABLES `versions` WRITE;
/*!40000 ALTER TABLE `versions` DISABLE KEYS */;
INSERT INTO `versions` VALUES (1,'FirstVersion',2),(3,'SecondVersion',2),(21,'dmzaaa',NULL),(22,'q',NULL),(23,'w',NULL),(24,'e',NULL),(25,'r',NULL),(27,'new',NULL),(31,'new2',NULL),(34,'new1',2),(35,'test35',2),(36,'new 36',NULL),(37,'new37',NULL),(38,'test38',NULL),(39,'39',NULL),(40,'test40',2),(41,'41',2),(42,'42',2),(43,'43',NULL),(44,'test 44',NULL),(45,'test 45',NULL),(46,'46',2),(47,'testing2141lknt',2),(48,'bad',NULL),(49,'a',NULL),(50,'aa',NULL),(51,'a',NULL),(52,'a',NULL),(53,'a',NULL),(54,'a',NULL),(55,'a',NULL),(56,'a',NULL),(57,'a',NULL),(58,'a',NULL),(59,'a',NULL),(60,'a',NULL),(61,'a',NULL),(62,'a',NULL),(63,'a',NULL),(64,'a',NULL),(65,'a',NULL),(66,'a',NULL),(67,'a',NULL),(68,'a',NULL),(69,'a',NULL),(70,'a',NULL),(71,'a',NULL),(72,'Nav1',NULL),(73,'DB1',NULL),(74,'db4',NULL),(75,'db5',NULL),(76,'db6',NULL),(77,'bd7',NULL),(78,'db9',NULL),(79,'db 10',NULL),(80,'db11',NULL),(81,'db12',NULL),(82,'db13',NULL),(83,'db13',NULL),(84,'db14',NULL),(85,'db15',NULL),(86,'dmz16',NULL),(87,'db17',NULL),(88,'db18',NULL),(89,'db19',NULL),(90,'db20',NULL),(91,'db21',NULL),(92,'db22',NULL),(93,'23',NULL),(94,'24',NULL),(95,'db25',NULL),(96,'db25',NULL),(97,'db25',NULL),(98,'db25',NULL),(99,'db26',NULL),(100,'db27',NULL),(101,'26',NULL),(102,'db27',NULL),(103,'db27',NULL),(104,'db26',NULL),(105,'27',NULL),(106,'db28',NULL),(107,'db29',NULL),(108,'db30',NULL),(109,'db31',NULL),(110,'db33',NULL),(111,'db34',NULL),(112,'db35',NULL),(113,'db36',NULL),(114,'db37',NULL),(115,'db38',NULL),(116,'db39',NULL),(117,'db04',NULL),(118,'db41',NULL),(119,'db41',NULL),(120,'db42',NULL),(121,'41',NULL),(122,'db42',NULL),(123,'Db43',NULL),(124,'db44',NULL),(125,'db45',NULL),(126,'db46',NULL),(127,'DMZ',NULL),(128,'db47',NULL),(129,'db48',NULL),(130,'db49',NULL),(131,'db50',NULL),(132,'db51',NULL),(133,'db52',NULL),(134,'db53',NULL),(135,'db54',NULL),(136,'db55',NULL),(137,'db56',NULL),(138,'db57',NULL),(139,'db58',NULL),(140,'db58',NULL),(141,'db58',NULL),(142,'db59',NULL),(143,'db60',NULL),(144,'db60',NULL),(145,'db46',NULL),(146,'db64',NULL),(147,'db48',NULL),(148,'48',NULL),(149,'db65',NULL),(150,'db66',NULL),(151,'db67',NULL),(152,'db67',NULL),(153,'db68',NULL),(154,'dmz1',NULL),(155,'dmz',NULL),(156,'dmz',NULL),(157,'dmz',NULL),(158,'dmz',NULL),(159,'dzm',NULL),(160,'dmz',NULL),(161,'dmz',NULL),(162,'dmz',NULL),(163,'dmz',NULL),(164,'dmz',NULL),(165,'dmz',NULL),(166,'dmz',NULL),(167,'dmz',NULL),(168,'dmz',NULL),(169,'dmz',NULL),(170,'dmz',NULL),(171,'dmz',NULL),(172,'dmz',NULL),(173,'dmz',NULL),(174,'dmz',NULL),(175,'dmz',NULL),(176,'dmz',NULL),(177,'dmz',NULL),(178,'dmz',NULL),(179,'dmz',NULL),(180,'dmz',NULL),(181,'dmz',NULL),(182,'dmz',NULL),(183,'dmz',NULL),(184,'dmz',NULL),(185,'dmz',NULL),(186,'dmz',NULL),(187,'dmz',NULL),(188,'dmz',NULL),(189,'dmz',NULL),(190,'dmz',NULL),(191,'dmz',NULL),(192,'dmz',NULL),(193,'dmznew',NULL),(194,'dmz',NULL),(195,'dmz',NULL),(196,'dmz',2),(197,'db66',NULL),(198,'db69',NULL),(199,'db70',2),(200,'db72',2),(201,'db72',NULL),(202,'db73',2);
/*!40000 ALTER TABLE `versions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-10  1:12:44
