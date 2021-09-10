-- MySQL dump 10.13  Distrib 5.5.53, for Win32 (AMD64)
--
-- Host: localhost    Database: welive
-- ------------------------------------------------------
-- Server version	5.5.53

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
-- Table structure for table `welive_admin`
--

DROP TABLE IF EXISTS `welive_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `welive_admin` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `online` tinyint(1) NOT NULL DEFAULT '0',
  `username` varchar(64) NOT NULL DEFAULT '',
  `password` varchar(64) NOT NULL DEFAULT '',
  `email` varchar(128) NOT NULL DEFAULT '',
  `verifycode` varchar(8) NOT NULL DEFAULT '',
  `first` int(11) NOT NULL DEFAULT '0',
  `last` int(11) NOT NULL DEFAULT '0',
  `lastip` varchar(64) NOT NULL DEFAULT '',
  `logins` int(11) NOT NULL DEFAULT '0',
  `fullname` varchar(64) NOT NULL DEFAULT '',
  `fullname_en` varchar(64) NOT NULL DEFAULT '',
  `post` varchar(64) NOT NULL DEFAULT '',
  `post_en` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`aid`),
  KEY `last` (`last`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `welive_admin`
--

LOCK TABLES `welive_admin` WRITE;
/*!40000 ALTER TABLE `welive_admin` DISABLE KEYS */;
INSERT INTO `welive_admin` VALUES (1,1,1,0,'admin','e10adc3949ba59abbe56e057f20f883e','170515075@qq.com','',1562576561,1562634293,'unknown',2,'管理员','Admin','系统管理员','Administrator');
/*!40000 ALTER TABLE `welive_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `welive_advertisement`
--

DROP TABLE IF EXISTS `welive_advertisement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `welive_advertisement` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `left` text,
  `right` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `welive_advertisement`
--

LOCK TABLES `welive_advertisement` WRITE;
/*!40000 ALTER TABLE `welive_advertisement` DISABLE KEYS */;
INSERT INTO `welive_advertisement` VALUES (1,'<img src=\"http://t-1.tuzhan.com/f4569663c7ab/c-2/l/2013/01/29/19/06a24ce98ffa4bac8ea4560de5d3b25a.jpg\" />','<img src=\"http://t-1.tuzhan.com/f4569663c7ab/c-2/l/2013/01/29/19/06a24ce98ffa4bac8ea4560de5d3b25a.jpg\" />');
/*!40000 ALTER TABLE `welive_advertisement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `welive_comment`
--

DROP TABLE IF EXISTS `welive_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `welive_comment` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `readed` tinyint(1) NOT NULL DEFAULT '0',
  `gid` int(11) NOT NULL DEFAULT '0',
  `fullname` varchar(64) NOT NULL DEFAULT '',
  `ip` varchar(64) NOT NULL DEFAULT '',
  `zone` varchar(64) NOT NULL DEFAULT '',
  `phone` varchar(128) NOT NULL DEFAULT '',
  `email` varchar(128) NOT NULL DEFAULT '',
  `content` text,
  `time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cid`),
  KEY `gid` (`gid`),
  KEY `time` (`time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `welive_comment`
--

LOCK TABLES `welive_comment` WRITE;
/*!40000 ALTER TABLE `welive_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `welive_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `welive_guest`
--

DROP TABLE IF EXISTS `welive_guest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `welive_guest` (
  `gid` int(11) NOT NULL AUTO_INCREMENT,
  `aid` int(11) NOT NULL DEFAULT '0',
  `upload` tinyint(1) NOT NULL DEFAULT '0',
  `lang` tinyint(1) NOT NULL DEFAULT '0',
  `banned` int(11) NOT NULL DEFAULT '0',
  `logins` int(11) NOT NULL DEFAULT '0',
  `last` int(11) NOT NULL DEFAULT '0',
  `lastip` varchar(64) NOT NULL DEFAULT '',
  `ipzone` varchar(64) NOT NULL DEFAULT '',
  `browser` varchar(64) NOT NULL DEFAULT '',
  `mobile` tinyint(1) NOT NULL DEFAULT '0',
  `fromurl` varchar(255) NOT NULL DEFAULT '',
  `grade` tinyint(1) NOT NULL DEFAULT '0',
  `fullname` varchar(64) NOT NULL DEFAULT '',
  `address` varchar(128) NOT NULL DEFAULT '',
  `phone` varchar(128) NOT NULL DEFAULT '',
  `email` varchar(128) NOT NULL DEFAULT '',
  `remark` text,
  `session` char(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`gid`),
  KEY `aid` (`aid`),
  KEY `last` (`last`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `welive_guest`
--

LOCK TABLES `welive_guest` WRITE;
/*!40000 ALTER TABLE `welive_guest` DISABLE KEYS */;
/*!40000 ALTER TABLE `welive_guest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `welive_msg`
--

DROP TABLE IF EXISTS `welive_msg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `welive_msg` (
  `mid` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `fromid` int(11) NOT NULL DEFAULT '0',
  `fromname` varchar(64) NOT NULL DEFAULT '',
  `toid` int(11) NOT NULL DEFAULT '0',
  `toname` varchar(64) NOT NULL DEFAULT '',
  `msg` text,
  `filetype` tinyint(1) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`mid`),
  KEY `fromid` (`fromid`),
  KEY `toid` (`toid`),
  KEY `time` (`time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `welive_msg`
--

LOCK TABLES `welive_msg` WRITE;
/*!40000 ALTER TABLE `welive_msg` DISABLE KEYS */;
/*!40000 ALTER TABLE `welive_msg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `welive_phrase`
--

DROP TABLE IF EXISTS `welive_phrase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `welive_phrase` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `aid` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `msg` text,
  `msg_en` text,
  PRIMARY KEY (`pid`),
  KEY `aid` (`aid`),
  KEY `sort` (`sort`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `welive_phrase`
--

LOCK TABLES `welive_phrase` WRITE;
/*!40000 ALTER TABLE `welive_phrase` DISABLE KEYS */;
/*!40000 ALTER TABLE `welive_phrase` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `welive_rating`
--

DROP TABLE IF EXISTS `welive_rating`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `welive_rating` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `gid` int(11) NOT NULL DEFAULT '0',
  `aid` int(11) NOT NULL DEFAULT '0',
  `score` tinyint(1) NOT NULL DEFAULT '0',
  `msg` text,
  `time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rid`),
  KEY `aid` (`aid`),
  KEY `time` (`time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `welive_rating`
--

LOCK TABLES `welive_rating` WRITE;
/*!40000 ALTER TABLE `welive_rating` DISABLE KEYS */;
/*!40000 ALTER TABLE `welive_rating` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `welive_robot`
--

DROP TABLE IF EXISTS `welive_robot`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `welive_robot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  `kn` int(3) NOT NULL DEFAULT '0',
  `keyword` varchar(128) NOT NULL DEFAULT '',
  `msg` text,
  `avatar` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `kn` (`kn`),
  KEY `sort` (`sort`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `welive_robot`
--

LOCK TABLES `welive_robot` WRITE;
/*!40000 ALTER TABLE `welive_robot` DISABLE KEYS */;
/*!40000 ALTER TABLE `welive_robot` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `welive_session`
--

DROP TABLE IF EXISTS `welive_session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `welive_session` (
  `sid` char(32) NOT NULL DEFAULT '',
  `aid` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(32) NOT NULL DEFAULT '',
  `agent` char(32) NOT NULL DEFAULT '',
  `time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`sid`),
  KEY `aid` (`aid`),
  KEY `time` (`time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `welive_session`
--

LOCK TABLES `welive_session` WRITE;
/*!40000 ALTER TABLE `welive_session` DISABLE KEYS */;
INSERT INTO `welive_session` VALUES ('def13cdb7b38b8be068c60bd2a47056f',1,'unknown','0dc8262b140e1fe6ac7c5b94396492d0',1562578901),('4b13dbe8dc0fac63ac5632b80dd33c71',1,'unknown','1b4b982e2d5c4d98261e8a6e93436081',1562634293);
/*!40000 ALTER TABLE `welive_session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `welive_vvc`
--

DROP TABLE IF EXISTS `welive_vvc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `welive_vvc` (
  `vid` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(9) NOT NULL DEFAULT '',
  `time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`vid`),
  KEY `time` (`time`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `welive_vvc`
--

LOCK TABLES `welive_vvc` WRITE;
/*!40000 ALTER TABLE `welive_vvc` DISABLE KEYS */;
INSERT INTO `welive_vvc` VALUES (1,'28',1562576606),(2,'18',1562576703),(3,'21',1562576761),(4,'28',1562576848),(5,'16',1562576986),(6,'31',1562576998),(7,'16',1562577223),(8,'17',1562577381),(9,'19',1562577881),(10,'27',1562577937),(11,'24',1562577949),(12,'18',1562578040),(13,'23',1562578057),(14,'35',1562578228),(15,'30',1562578237),(16,'21',1562578262),(17,'27',1562591642),(18,'16',1562592095),(19,'18',1562592775),(20,'38',1562592855),(21,'27',1562592934),(22,'29',1562593070),(23,'30',1562593271),(24,'25',1562595092),(25,'28',1562595235),(26,'26',1562596079),(27,'14',1562596095),(28,'9',1562632752),(29,'27',1562632776),(30,'23',1562632794),(31,'12',1562632873),(32,'9',1562633486),(33,'26',1562633564),(34,'15',1562633583),(35,'19',1562633675),(36,'35',1562633819),(37,'23',1562633986),(38,'25',1562634689),(39,'21',1562634698);
/*!40000 ALTER TABLE `welive_vvc` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-07-09  9:11:59
