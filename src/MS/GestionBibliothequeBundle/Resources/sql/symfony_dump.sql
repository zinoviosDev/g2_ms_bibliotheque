-- MySQL dump 10.13  Distrib 5.7.19, for Linux (x86_64)
--
-- Host: localhost    Database: symfonydb
-- ------------------------------------------------------
-- Server version	5.7.19-0ubuntu0.16.04.1

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
-- Table structure for table `AUTEURS_OEUVRES`
--

DROP TABLE IF EXISTS `AUTEURS_OEUVRES`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AUTEURS_OEUVRES` (
  `auteur_id` int(11) NOT NULL,
  `oeuvre_id` int(11) NOT NULL,
  PRIMARY KEY (`auteur_id`,`oeuvre_id`),
  UNIQUE KEY `UNIQ_F64EEF1588194DE8` (`oeuvre_id`),
  KEY `IDX_F64EEF1560BB6FE6` (`auteur_id`),
  CONSTRAINT `FK_F64EEF1560BB6FE6` FOREIGN KEY (`auteur_id`) REFERENCES `auteur` (`id`),
  CONSTRAINT `FK_F64EEF1588194DE8` FOREIGN KEY (`oeuvre_id`) REFERENCES `OEUVRE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AUTEURS_OEUVRES`
--

LOCK TABLES `AUTEURS_OEUVRES` WRITE;
/*!40000 ALTER TABLE `AUTEURS_OEUVRES` DISABLE KEYS */;
/*!40000 ALTER TABLE `AUTEURS_OEUVRES` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EMPRUNT`
--

DROP TABLE IF EXISTS `EMPRUNT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EMPRUNT` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adherent_id` int(11) DEFAULT NULL,
  `oeuvre_id` int(11) DEFAULT NULL,
  `date_emprunt` datetime NOT NULL,
  `date_retour_theorique` datetime NOT NULL,
  `date_retour_reelle` datetime NOT NULL,
  `nombre_avertissements` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9058FCD25F06C53` (`adherent_id`),
  KEY `IDX_9058FCD88194DE8` (`oeuvre_id`),
  CONSTRAINT `FK_9058FCD25F06C53` FOREIGN KEY (`adherent_id`) REFERENCES `adherent` (`id`),
  CONSTRAINT `FK_9058FCD88194DE8` FOREIGN KEY (`oeuvre_id`) REFERENCES `OEUVRE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EMPRUNT`
--

LOCK TABLES `EMPRUNT` WRITE;
/*!40000 ALTER TABLE `EMPRUNT` DISABLE KEYS */;
/*!40000 ALTER TABLE `EMPRUNT` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `OEUVRE`
--

DROP TABLE IF EXISTS `OEUVRE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `OEUVRE` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `editeur_id` int(11) DEFAULT NULL,
  `etat_oeuvre_id` int(11) DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sujet` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_publication` datetime NOT NULL,
  `fonds_specifique` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `langue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `DISCR` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_C506E978788B0B04` (`etat_oeuvre_id`),
  KEY `IDX_C506E9783375BD21` (`editeur_id`),
  CONSTRAINT `FK_C506E9783375BD21` FOREIGN KEY (`editeur_id`) REFERENCES `editeur` (`id`),
  CONSTRAINT `FK_C506E978788B0B04` FOREIGN KEY (`etat_oeuvre_id`) REFERENCES `etat_oeuvre` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `OEUVRE`
--

LOCK TABLES `OEUVRE` WRITE;
/*!40000 ALTER TABLE `OEUVRE` DISABLE KEYS */;
/*!40000 ALTER TABLE `OEUVRE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adherent`
--

DROP TABLE IF EXISTS `adherent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adherent` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `genre` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `dateNaissance` datetime DEFAULT NULL,
  `nbreEmpruntsAuthorises` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numTelephone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_90D3F060BF396750` FOREIGN KEY (`id`) REFERENCES `personne` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adherent`
--

LOCK TABLES `adherent` WRITE;
/*!40000 ALTER TABLE `adherent` DISABLE KEYS */;
INSERT INTO `adherent` VALUES (2,'Doe','John','male','2008-08-06 19:46:34',10,'john.doe@gmail.com','33608654232'),(3,'Doe','John','male','2002-08-16 19:46:34',10,'john.doe@gmail.com','+33608654232');
/*!40000 ALTER TABLE `adherent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adresse`
--

DROP TABLE IF EXISTS `adresse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adresse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exemplaire_id` int(11) DEFAULT NULL,
  `numero` int(11) NOT NULL,
  `code_nature_voie` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `libelle_voie` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code_postal` int(11) NOT NULL,
  `ville` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C35F08165843AA21` (`exemplaire_id`),
  CONSTRAINT `FK_C35F08165843AA21` FOREIGN KEY (`exemplaire_id`) REFERENCES `exemplaire` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adresse`
--

LOCK TABLES `adresse` WRITE;
/*!40000 ALTER TABLE `adresse` DISABLE KEYS */;
INSERT INTO `adresse` VALUES (58,NULL,0,'Rue','Adolphe Thiers',13001,'Marseille'),(59,NULL,0,'Rue','Barthelemy',13001,'Marseille'),(60,NULL,0,'Rue','Bernard du Bois',13001,'Marseille'),(61,NULL,0,'Rue','Châteauredon',13001,'Marseille'),(62,NULL,0,'Rue','Consolat',13001,'Marseille'),(63,NULL,0,'Rue d\'','Anvers',13001,'Marseille'),(64,NULL,0,'Rue de l\'','Academie',13001,'Marseille'),(65,NULL,0,'Rue de','la Fare',13001,'Marseille'),(66,NULL,0,'Rue de','la Palud',13001,'Marseille'),(67,NULL,0,'Rue de','la République',13001,'Marseille'),(68,NULL,0,'Rue','de Rome',13001,'Marseille'),(69,NULL,0,'Rue','des Augustins',13001,'Marseille'),(70,NULL,0,'Rue','des Fabres',13001,'Marseille'),(71,NULL,0,'Rue','des Petites Maries',13001,'Marseille'),(72,NULL,0,'Rue','du Beausset',13001,'Marseille'),(73,NULL,0,'Rue','du Loisir',13001,'Marseille'),(74,NULL,0,'Rue','du Relais',13001,'Marseille'),(75,NULL,0,'Rue','Esperandieu',13001,'Marseille'),(76,NULL,0,'Rue','Flegier',13001,'Marseille'),(77,NULL,0,'Rue','Francis Davso',13001,'Marseille'),(78,NULL,0,'Rue','Glandeves',13001,'Marseille'),(79,NULL,0,'Rue','Guy Moquet',13001,'Marseille'),(80,NULL,0,'Rue','Henri Fiocca',13001,'Marseille'),(81,NULL,0,'Rue','Jean Roque',13001,'Marseille'),(82,NULL,0,'Rue','Léon Bourgeois',13001,'Marseille'),(83,NULL,0,'Rue','Lulli',13001,'Marseille'),(84,NULL,0,'Rue','Mazagran',13001,'Marseille'),(85,NULL,0,'Rue','Moustier',13001,'Marseille'),(86,NULL,0,'Rue','Papere',13001,'Marseille'),(87,NULL,0,'Rue','Philippe de Girard',13001,'Marseille'),(88,NULL,0,'Rue','Puvis de Chavannes',13001,'Marseille'),(89,NULL,0,'Rue','Rouget de Lisle',13001,'Marseille'),(90,NULL,0,'Rue','Saint Dominique',13001,'Marseille'),(91,NULL,0,'Rue','Saint Théodore',13001,'Marseille'),(92,NULL,0,'Rue','Sibie',13001,'Marseille'),(93,NULL,0,'Rue','Vacon',13001,'Marseille'),(94,NULL,0,'Rue','Albert 1er',13001,'Marseille'),(95,NULL,0,'Rue','Beaumont',13001,'Marseille'),(96,NULL,0,'Rue','Bernex',13001,'Marseille'),(97,NULL,0,'Rue','Clapier',13001,'Marseille'),(98,NULL,0,'Rue','Corneille',13001,'Marseille'),(99,NULL,0,'Rue','d\'Aubagne',13001,'Marseille'),(100,NULL,0,'Rue','de l\'Arc',13001,'Marseille'),(101,NULL,0,'Rue','de la Glace',13001,'Marseille'),(102,NULL,0,'Rue','de la Providence',13001,'Marseille'),(103,NULL,0,'Rue','de la Rotonde',13001,'Marseille'),(104,NULL,0,'Rue','Delille',13001,'Marseille'),(105,NULL,0,'Rue','des Chapeliers',13001,'Marseille'),(106,NULL,0,'Rue','des Feuillants',13001,'Marseille'),(107,NULL,0,'Rue','des Precheurs',13001,'Marseille'),(108,NULL,0,'Rue','du Coq',13001,'Marseille'),(109,NULL,0,'Rue','du Mont de Piete',13001,'Marseille'),(110,NULL,0,'Rue','du Theatre Français',13001,'Marseille'),(111,NULL,0,'Rue','Estelle',13001,'Marseille'),(112,NULL,0,'Rue','Fontaine d\'Armenie',13001,'Marseille'),(113,NULL,0,'Rue','Francis Pressence',13001,'Marseille'),(114,NULL,0,'Rue','Grignan',13001,'Marseille');
/*!40000 ALTER TABLE `adresse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `application`
--

DROP TABLE IF EXISTS `application`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `application` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `advert_id` int(11) NOT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A45BDDC1D07ECCB6` (`advert_id`),
  CONSTRAINT `FK_A45BDDC1D07ECCB6` FOREIGN KEY (`advert_id`) REFERENCES `oc_advert` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `application`
--

LOCK TABLES `application` WRITE;
/*!40000 ALTER TABLE `application` DISABLE KEYS */;
/*!40000 ALTER TABLE `application` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auteur`
--

DROP TABLE IF EXISTS `auteur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auteur` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `genre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_naissance` datetime NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_55AB140BF396750` FOREIGN KEY (`id`) REFERENCES `personne` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auteur`
--

LOCK TABLES `auteur` WRITE;
/*!40000 ALTER TABLE `auteur` DISABLE KEYS */;
/*!40000 ALTER TABLE `auteur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carte_bibliotheque`
--

DROP TABLE IF EXISTS `carte_bibliotheque`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carte_bibliotheque` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adherent_id` int(11) DEFAULT NULL,
  `numero_carte` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `MOT_DE_PASSE` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_513279A525F06C53` (`adherent_id`),
  CONSTRAINT `FK_513279A525F06C53` FOREIGN KEY (`adherent_id`) REFERENCES `adherent` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carte_bibliotheque`
--

LOCK TABLES `carte_bibliotheque` WRITE;
/*!40000 ALTER TABLE `carte_bibliotheque` DISABLE KEYS */;
/*!40000 ALTER TABLE `carte_bibliotheque` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (6,'Développement web'),(7,'Développement mobile'),(8,'Graphisme'),(9,'Intégration'),(10,'Réseau');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commentaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adherent_id` int(11) DEFAULT NULL,
  `oeuvre_id` int(11) DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_publication` datetime NOT NULL,
  `date_modification` datetime NOT NULL,
  `contenu` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_67F068BC25F06C53` (`adherent_id`),
  KEY `IDX_67F068BC88194DE8` (`oeuvre_id`),
  CONSTRAINT `FK_67F068BC25F06C53` FOREIGN KEY (`adherent_id`) REFERENCES `adherent` (`id`),
  CONSTRAINT `FK_67F068BC88194DE8` FOREIGN KEY (`oeuvre_id`) REFERENCES `OEUVRE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commentaire`
--

LOCK TABLES `commentaire` WRITE;
/*!40000 ALTER TABLE `commentaire` DISABLE KEYS */;
/*!40000 ALTER TABLE `commentaire` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dvd`
--

DROP TABLE IF EXISTS `dvd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dvd` (
  `id` int(11) NOT NULL,
  `duree` datetime NOT NULL,
  `contenu` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `TYPE_DVD` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_8325C1DFBF396750` FOREIGN KEY (`id`) REFERENCES `OEUVRE` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dvd`
--

LOCK TABLES `dvd` WRITE;
/*!40000 ALTER TABLE `dvd` DISABLE KEYS */;
/*!40000 ALTER TABLE `dvd` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `editeur`
--

DROP TABLE IF EXISTS `editeur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `editeur` (
  `id` int(11) NOT NULL,
  `sigle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `raison_sociale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_5A747EFBF396750` FOREIGN KEY (`id`) REFERENCES `personne` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `editeur`
--

LOCK TABLES `editeur` WRITE;
/*!40000 ALTER TABLE `editeur` DISABLE KEYS */;
/*!40000 ALTER TABLE `editeur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `etat_oeuvre`
--

DROP TABLE IF EXISTS `etat_oeuvre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `etat_oeuvre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `etat` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `etat_oeuvre`
--

LOCK TABLES `etat_oeuvre` WRITE;
/*!40000 ALTER TABLE `etat_oeuvre` DISABLE KEYS */;
/*!40000 ALTER TABLE `etat_oeuvre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exemplaire`
--

DROP TABLE IF EXISTS `exemplaire`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exemplaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oeuvre_id` int(11) DEFAULT NULL,
  `mode_acces` int(11) NOT NULL,
  `cote` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5EF83C9288194DE8` (`oeuvre_id`),
  CONSTRAINT `FK_5EF83C9288194DE8` FOREIGN KEY (`oeuvre_id`) REFERENCES `OEUVRE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exemplaire`
--

LOCK TABLES `exemplaire` WRITE;
/*!40000 ALTER TABLE `exemplaire` DISABLE KEYS */;
/*!40000 ALTER TABLE `exemplaire` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image`
--

LOCK TABLES `image` WRITE;
/*!40000 ALTER TABLE `image` DISABLE KEYS */;
/*!40000 ALTER TABLE `image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `livre`
--

DROP TABLE IF EXISTS `livre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `livre` (
  `id` int(11) NOT NULL,
  `isbn` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nbre_pages` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `resume` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `format` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_AC634F99BF396750` FOREIGN KEY (`id`) REFERENCES `OEUVRE` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `livre`
--

LOCK TABLES `livre` WRITE;
/*!40000 ALTER TABLE `livre` DISABLE KEYS */;
/*!40000 ALTER TABLE `livre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oc_advert`
--

DROP TABLE IF EXISTS `oc_advert`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oc_advert` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_id` int(11) DEFAULT NULL,
  `published` tinyint(1) NOT NULL,
  `date` datetime NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_B1931753DA5256D` (`image_id`),
  CONSTRAINT `FK_B1931753DA5256D` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oc_advert`
--

LOCK TABLES `oc_advert` WRITE;
/*!40000 ALTER TABLE `oc_advert` DISABLE KEYS */;
INSERT INTO `oc_advert` VALUES (4,NULL,1,'2017-10-28 19:46:34','Recherche développpeur Symfony','Alexandre','Nous recherchons un développeur Symfony débutant sur Lyon. Blabla…'),(5,NULL,1,'2017-10-28 19:46:34','Mission de webmaster','Hugo','Nous recherchons un webmaster capable de maintenir notre site internet. Blabla…'),(6,NULL,1,'2017-10-28 19:46:34','Offre de stage webdesigner','Mathieu','Nous proposons un poste pour webdesigner. Blabla…');
/*!40000 ALTER TABLE `oc_advert` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oc_advert_category`
--

DROP TABLE IF EXISTS `oc_advert_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oc_advert_category` (
  `advert_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`advert_id`,`category_id`),
  KEY `IDX_435EA006D07ECCB6` (`advert_id`),
  KEY `IDX_435EA00612469DE2` (`category_id`),
  CONSTRAINT `FK_435EA00612469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_435EA006D07ECCB6` FOREIGN KEY (`advert_id`) REFERENCES `oc_advert` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oc_advert_category`
--

LOCK TABLES `oc_advert_category` WRITE;
/*!40000 ALTER TABLE `oc_advert_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `oc_advert_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oc_advert_skill`
--

DROP TABLE IF EXISTS `oc_advert_skill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oc_advert_skill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `advert_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL,
  `level` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_32EFF25BD07ECCB6` (`advert_id`),
  KEY `IDX_32EFF25B5585C142` (`skill_id`),
  CONSTRAINT `FK_32EFF25B5585C142` FOREIGN KEY (`skill_id`) REFERENCES `skill` (`id`),
  CONSTRAINT `FK_32EFF25BD07ECCB6` FOREIGN KEY (`advert_id`) REFERENCES `oc_advert` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oc_advert_skill`
--

LOCK TABLES `oc_advert_skill` WRITE;
/*!40000 ALTER TABLE `oc_advert_skill` DISABLE KEYS */;
/*!40000 ALTER TABLE `oc_advert_skill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personne`
--

DROP TABLE IF EXISTS `personne`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personne` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `DISCR` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personne`
--

LOCK TABLES `personne` WRITE;
/*!40000 ALTER TABLE `personne` DISABLE KEYS */;
INSERT INTO `personne` VALUES (2,'adherent'),(3,'adherent');
/*!40000 ALTER TABLE `personne` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personnes_adresses`
--

DROP TABLE IF EXISTS `personnes_adresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personnes_adresses` (
  `personne_id` int(11) NOT NULL,
  `adresse_id` int(11) NOT NULL,
  PRIMARY KEY (`personne_id`,`adresse_id`),
  UNIQUE KEY `UNIQ_92CDE4724DE7DC5C` (`adresse_id`),
  KEY `IDX_92CDE472A21BD112` (`personne_id`),
  CONSTRAINT `FK_92CDE4724DE7DC5C` FOREIGN KEY (`adresse_id`) REFERENCES `adresse` (`id`),
  CONSTRAINT `FK_92CDE472A21BD112` FOREIGN KEY (`personne_id`) REFERENCES `personne` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personnes_adresses`
--

LOCK TABLES `personnes_adresses` WRITE;
/*!40000 ALTER TABLE `personnes_adresses` DISABLE KEYS */;
/*!40000 ALTER TABLE `personnes_adresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adherent_id` int(11) DEFAULT NULL,
  `oeuvre_id` int(11) DEFAULT NULL,
  `date_demande_reservation` datetime NOT NULL,
  `date_annulation_reservation` datetime NOT NULL,
  `date_reservation` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_42C8495525F06C53` (`adherent_id`),
  KEY `IDX_42C8495588194DE8` (`oeuvre_id`),
  CONSTRAINT `FK_42C8495525F06C53` FOREIGN KEY (`adherent_id`) REFERENCES `adherent` (`id`),
  CONSTRAINT `FK_42C8495588194DE8` FOREIGN KEY (`oeuvre_id`) REFERENCES `OEUVRE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservation`
--

LOCK TABLES `reservation` WRITE;
/*!40000 ALTER TABLE `reservation` DISABLE KEYS */;
/*!40000 ALTER TABLE `reservation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `skill`
--

DROP TABLE IF EXISTS `skill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `skill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skill`
--

LOCK TABLES `skill` WRITE;
/*!40000 ALTER TABLE `skill` DISABLE KEYS */;
INSERT INTO `skill` VALUES (8,'PHP'),(9,'Symfony'),(10,'C++'),(11,'Java'),(12,'Photoshop'),(13,'Blender'),(14,'Bloc-note');
/*!40000 ALTER TABLE `skill` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-10-28 21:49:24
