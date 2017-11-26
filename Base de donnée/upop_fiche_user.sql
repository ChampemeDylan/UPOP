-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: upop
-- ------------------------------------------------------
-- Server version	5.7.20-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `fiche_user`
--

DROP TABLE IF EXISTS `fiche_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fiche_user` (
  `loginUser` varchar(10) NOT NULL,
  `nomUser` varchar(40) NOT NULL,
  `prenomUser` varchar(40) NOT NULL,
  `genreUser` char(1) NOT NULL,
  `dateNaissanceUser` date NOT NULL,
  `passwordUser` varchar(512) DEFAULT NULL,
  `adresseUser` varchar(100) NOT NULL,
  `cpUser` char(5) NOT NULL,
  `villeUser` varchar(40) NOT NULL,
  `mailUser` varchar(50) NOT NULL,
  `typeUser` tinyint(1) NOT NULL,
  PRIMARY KEY (`loginUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fiche_user`
--

LOCK TABLES `fiche_user` WRITE;
/*!40000 ALTER TABLE `fiche_user` DISABLE KEYS */;
INSERT INTO `fiche_user` VALUES ('Simon','Simon','Jean-Christophe','M','1977-04-26','749192863bc171e608fe82f74b3581234dbd80d3592b90f9a592a6e6f6db92892217ad588d6c037c320d6bcecc8220abde1aa1c12471cad05d51bcb56f3dc7ad','4 rue Emilienne Goumy','63000','Clermont-Ferrand','tweetysimon@free.fr',1);
/*!40000 ALTER TABLE `fiche_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-26 16:56:45
