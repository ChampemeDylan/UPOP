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
-- Table structure for table `univers_categorie`
--

DROP TABLE IF EXISTS `univers_categorie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `univers_categorie` (
  `libelleUnivers` varchar(40) NOT NULL,
  `libelleCategorie` varchar(20) NOT NULL,
  PRIMARY KEY (`libelleUnivers`,`libelleCategorie`),
  KEY `FK_UC_categorie` (`libelleCategorie`),
  CONSTRAINT `FK_UC_categorie` FOREIGN KEY (`libelleCategorie`) REFERENCES `categorie` (`libelleCategorie`),
  CONSTRAINT `FK_UC_univers` FOREIGN KEY (`libelleUnivers`) REFERENCES `univers` (`libelleUnivers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `univers_categorie`
--

LOCK TABLES `univers_categorie` WRITE;
/*!40000 ALTER TABLE `univers_categorie` DISABLE KEYS */;
INSERT INTO `univers_categorie` VALUES ('Dragon Ball Z','Dessin Animé'),('Marvel','Dessin Animé'),('South Park','Dessin Animé'),('Star Wars','Dessin Animé'),('Harry Potter','Film'),('Le Seigneur Des Anneaux','Film'),('Marvel','Film'),('Star Wars','Film'),('Assassin’s Creed','Jeu Vidéo'),('Dragon Ball Z','Jeu Vidéo'),('Games Of Thrones','Jeu Vidéo'),('Harry Potter','Jeu Vidéo'),('Le Seigneur Des Anneaux','Jeu Vidéo'),('Marvel','Jeu Vidéo'),('Star Wars','Jeu Vidéo'),('Tekken','Jeu Vidéo'),('The Witcher','Jeu Vidéo'),('Breaking Bad','Série'),('Games Of Thrones','Série'),('Lost','Série'),('Star Wars','Série');
/*!40000 ALTER TABLE `univers_categorie` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-26 16:56:46
