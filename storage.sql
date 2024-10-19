/*!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.6.18-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: storage
-- ------------------------------------------------------
-- Server version	10.6.18-MariaDB-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `directories`
--

DROP TABLE IF EXISTS `directories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `directories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `filesystem_entry_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `directories_filesystem_entry_id` (`filesystem_entry_id`),
  CONSTRAINT `directories_filesystem_entry_id` FOREIGN KEY (`filesystem_entry_id`) REFERENCES `filesystem_entries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `directories`
--

LOCK TABLES `directories` WRITE;
/*!40000 ALTER TABLE `directories` DISABLE KEYS */;
INSERT INTO `directories` VALUES (1,4),(2,6),(28,949),(31,971),(32,973),(33,987),(34,991),(35,993),(36,998),(43,1049);
/*!40000 ALTER TABLE `directories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `filesystem_entry_id` int(10) unsigned NOT NULL,
  `lifetime` mediumint(8) unsigned DEFAULT NULL,
  `modification_time` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `files_filesystem_entry_id` (`filesystem_entry_id`),
  CONSTRAINT `files_filesystem_entry_id` FOREIGN KEY (`filesystem_entry_id`) REFERENCES `filesystem_entries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1062 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files`
--

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
INSERT INTO `files` VALUES (16,18,NULL,'2023-09-29 18:42:41'),(25,27,NULL,'2023-10-14 14:10:21'),(26,28,NULL,'2023-10-20 16:01:52'),(27,29,NULL,'2023-10-20 17:21:14'),(28,30,NULL,'2023-10-20 17:32:03'),(29,31,NULL,'2023-10-20 20:06:40'),(31,33,NULL,'2023-10-23 20:36:41'),(51,53,NULL,'2023-11-13 10:49:15'),(79,81,NULL,'2023-11-28 20:09:06'),(578,580,NULL,'2023-12-22 00:11:51'),(615,617,NULL,'2023-12-23 11:36:20'),(618,620,NULL,'2024-01-04 20:47:54'),(619,621,NULL,'2024-01-09 11:33:28'),(623,625,NULL,'2024-01-14 20:48:45'),(677,689,NULL,'2024-01-20 16:02:03'),(698,710,NULL,'2024-01-29 04:40:19'),(824,841,NULL,'2024-07-28 00:50:30'),(875,892,NULL,'2024-02-17 13:35:36'),(876,899,NULL,'2024-02-18 18:52:07'),(910,935,NULL,'2024-02-24 17:51:22'),(914,939,NULL,'2024-02-28 16:34:49'),(922,950,NULL,'2024-03-08 09:02:47'),(941,972,NULL,'2024-03-31 10:17:44'),(942,974,NULL,'2024-03-31 16:09:35'),(943,975,NULL,'2024-03-31 17:15:07'),(944,976,NULL,'2024-03-31 19:38:46'),(945,977,NULL,'2024-03-31 19:39:00'),(946,978,NULL,'2024-03-31 19:39:22'),(955,988,NULL,'2024-04-02 10:54:52'),(956,989,NULL,'2024-04-02 10:54:56'),(957,990,NULL,'2024-04-02 10:55:53'),(967,1003,NULL,'2024-04-06 17:05:03'),(968,1004,NULL,'2024-04-06 17:05:48'),(969,1005,NULL,'2024-04-06 18:13:37'),(972,1010,NULL,'2024-04-08 20:08:21'),(973,1011,NULL,'2024-04-08 20:12:41'),(974,1012,NULL,'2024-04-08 20:13:51'),(975,1013,NULL,'2024-04-08 20:15:41'),(976,1014,NULL,'2024-04-08 20:17:02'),(985,1025,NULL,'2024-04-21 17:31:58'),(987,1027,NULL,'2024-04-26 17:07:03'),(1007,1050,NULL,'2024-05-18 19:29:22'),(1008,1051,NULL,'2024-05-18 19:29:33'),(1011,1054,NULL,'2024-06-02 14:04:32'),(1016,1059,NULL,'2024-06-19 18:15:56'),(1017,1060,NULL,'2024-06-19 18:16:46'),(1023,1066,NULL,'2024-06-24 08:17:31'),(1030,1073,NULL,'2024-07-02 11:15:54'),(1031,1074,NULL,'2024-07-02 11:18:30'),(1032,1075,NULL,'2024-07-03 19:46:31'),(1033,1076,NULL,'2024-07-03 19:46:31'),(1038,1081,NULL,'2024-07-12 20:05:23'),(1041,1084,NULL,'2024-07-15 22:12:28'),(1045,1088,NULL,'2024-07-24 14:43:02'),(1054,1104,NULL,'2024-07-26 21:36:03');
/*!40000 ALTER TABLE `files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `filesystem_entries`
--

DROP TABLE IF EXISTS `filesystem_entries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `filesystem_entries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `directory_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `hidden` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `creation_time` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `filesystem_entries_user_id` (`user_id`),
  CONSTRAINT `filesystem_entries_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1114 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `filesystem_entries`
--

LOCK TABLES `filesystem_entries` WRITE;
/*!40000 ALTER TABLE `filesystem_entries` DISABLE KEYS */;
INSERT INTO `filesystem_entries` VALUES (4,'vkbot',NULL,2,0,'2023-09-22 08:16:51'),(6,'screenshots',NULL,1,1,'2023-09-22 14:24:35'),(18,'dota2_qFrLzcHNgd.png',2,3,1,'2023-09-29 18:42:41'),(27,'Dude (228).mp4',NULL,1,0,'2023-10-14 14:10:21'),(28,'firefox_oHRHWF1ZBM.png',2,3,1,'2023-10-20 16:01:52'),(29,'firefox_Xn0vjqTvfi.png',2,3,1,'2023-10-20 17:21:14'),(30,'firefox_lMcQMYui1v.png',2,3,1,'2023-10-20 17:32:03'),(31,'firefox_eE0ZxFWtIR.png',2,3,1,'2023-10-20 20:06:40'),(33,'Crysis Sounds.zip',2,3,1,'2023-10-23 20:36:41'),(53,'1.19.4.zip',2,3,1,'2023-11-13 10:49:15'),(81,'Discord_mevCrNxCHl.png',2,3,1,'2023-11-28 20:09:06'),(580,'example_stats.jpg',1,1,0,'2023-12-22 00:11:51'),(617,'help_dbg.html',1,2,0,'2023-12-23 11:36:20'),(620,'OCIFEdit_WekYJufr4X.png',2,3,1,'2024-01-04 20:47:54'),(621,'free_and_total_memory.pic',NULL,1,0,'2024-01-09 11:33:28'),(625,'geo.pic',NULL,1,0,'2024-01-14 20:48:45'),(689,'zalupa.pic',NULL,1,0,'2024-01-20 16:02:03'),(710,'Untitled.pic',NULL,1,0,'2024-01-29 04:40:19'),(841,'help.html',1,2,0,'2024-02-15 22:01:43'),(892,'comfort.png',NULL,1,0,'2024-02-17 13:35:36'),(899,'index2.png',2,3,0,'2024-02-18 18:52:07'),(935,'rat.gif',NULL,1,0,'2024-02-24 17:50:23'),(939,'vaginopizdovka.html',NULL,1,0,'2024-02-27 17:45:29'),(949,'dont_delete',NULL,1,0,'2024-03-08 09:02:40'),(950,'telnet.png',28,1,0,'2024-03-08 09:02:47'),(971,'fs24bot',NULL,3,1,'2024-03-31 10:16:04'),(972,'chars.sqlite',31,3,0,'2024-03-31 10:17:44'),(973,'dfpwm',NULL,3,1,'2024-03-31 16:09:18'),(974,'01 - Boot.dfpwm',32,3,0,'2024-03-31 16:09:35'),(975,'02 - Floating Point.dfpwm',32,3,0,'2024-03-31 17:15:07'),(976,'10 - Trojans (Hard Mode).dfpwm',32,3,0,'2024-03-31 19:38:46'),(977,'04 - Brute Force.dfpwm',32,3,0,'2024-03-31 19:39:00'),(978,'03 - Pointers.dfpwm',32,3,0,'2024-03-31 19:39:22'),(987,'passwords',NULL,1,0,'2024-04-02 10:38:44'),(988,'list1.txt',33,1,0,'2024-04-02 10:54:52'),(989,'list2.txt',33,1,0,'2024-04-02 10:54:56'),(990,'big_list.txt',33,1,0,'2024-04-02 10:55:53'),(991,'wav',NULL,3,0,'2024-04-02 11:29:03'),(993,'hidden',NULL,3,1,'2024-04-05 14:21:16'),(998,'Server 1.20.1',NULL,1,0,'2024-04-06 15:09:32'),(1003,'test.txt',34,1,0,'2024-04-06 17:05:03'),(1004,'world.zip',36,1,0,'2024-04-06 17:05:48'),(1005,'mods.zip',36,1,0,'2024-04-06 18:13:37'),(1010,'test share.txt',35,12,0,'2024-04-08 20:08:21'),(1011,'test share2.txt',35,12,0,'2024-04-08 20:12:41'),(1012,'meow.txt',35,12,0,'2024-04-08 20:13:51'),(1013,'test2.txt',35,12,0,'2024-04-08 20:15:41'),(1014,'test3.txt',35,12,0,'2024-04-08 20:17:02'),(1025,'fabric 1.20.1.zip',36,3,0,'2024-04-21 17:31:58'),(1027,'fabric 1.20.1 update.zip',36,3,0,'2024-04-26 17:01:36'),(1049,'tishina',NULL,12,0,'2024-05-18 19:28:54'),(1050,'buhanka.jpg',43,12,0,'2024-05-18 19:29:22'),(1051,'kitchen in the dungeon.mp4',43,12,0,'2024-05-18 19:29:33'),(1054,'VID_20240528_183441.mp4',43,12,0,'2024-06-02 14:04:32'),(1059,'screenshot.jpg',2,3,0,'2024-06-19 18:15:56'),(1060,'paintdotnet_znzZOt5hdF.png',2,3,0,'2024-06-19 18:16:46'),(1066,'Discord_tYEnKDZU5N.png',31,3,0,'2024-06-24 08:17:31'),(1073,'screenshot2.pic',34,1,0,'2024-07-02 11:15:54'),(1074,'screenshot1.pic',34,1,0,'2024-07-02 11:18:30'),(1075,'minecode2.pic',34,1,0,'2024-07-03 19:46:31'),(1076,'minecode1.pic',34,1,0,'2024-07-03 19:46:31'),(1081,'mods_forge_1.20.1.zip',36,3,0,'2024-07-12 20:05:23'),(1084,'get_file_preview.png',34,1,0,'2024-07-15 22:12:28'),(1088,'IMG_20240701_180617.jpg',NULL,10,0,'2024-07-24 14:43:02'),(1104,'get_file_preview.png',NULL,10,0,'2024-07-26 21:36:03');
/*!40000 ALTER TABLE `filesystem_entries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `password` varchar(64) NOT NULL,
  `avatar_url` varchar(1024) DEFAULT NULL,
  `token` varchar(255) NOT NULL,
  `access_level` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'smok1e','synthwave rat','a6319cf37a39adaad402f8c80b86d706f4e70d48bc5572c5b7c2a4183214b675','https://storage.buttex.ru/permanent/1045','dfef0f67-591e-11ee-a474-305a3a090b6e',2,'2024-02-13 19:44:08'),(2,'vkbot','','d2eff6741d1ff819810364c1a4dc424106e9a9186d59f6ad5810f16ba432041a',NULL,'5ebb6ad1-5920-11ee-a474-305a3a090b6e',0,'2024-02-13 19:44:08'),(3,'max','maximus','9875896fefee15962d74c5d032a80dab570e62ab1fed6fee0ee2e44ec33ecaa1','https://storage.buttex.ru/permanent/875','0128549c-154c-11ef-8413-305a3a090b6e',2,'2024-02-13 19:44:08'),(8,'birb','bird','bdf8cbb5ca1a40dc4bdd44e7cdc2fde56cce44bede97adb805dce65615ec7c17',NULL,'8c209f9a-f408-11ee-b087-305a3a090b6e',2,'2024-02-13 19:44:08'),(9,'test','test','0ca7dfd364c6b744445778269e122a268b9dcef659846d8e8dba32cc560315ca',NULL,'64cd85f5-c900-11ee-8fb0-305a3a090b6e',0,'2024-02-13 19:44:08'),(10,'igor','1gor sm0l1','0ca7dfd364c6b744445778269e122a268b9dcef659846d8e8dba32cc560315ca','https://storage.buttex.ru/permanent/875','93e56292-d271-11ee-8fb0-305a3a090b6e',2,'2024-02-23 17:32:54'),(11,'logic','rootmaster','0ca7dfd364c6b744445778269e122a268b9dcef659846d8e8dba32cc560315ca',NULL,'44df4c9f-d3d8-11ee-8fb0-305a3a090b6e',0,'2024-02-25 12:20:31'),(12,'computrix','computrix','ccd758e72a8a8cb5f140bab26837f363908550f2558ed86d229ec9016fed49b9','https://storage.buttex.ru/permanent/982','e2cf3a3d-20e8-11ef-8413-305a3a090b6e',2,'2024-04-06 18:38:41'),(13,'leshainc','leshainc','5c1787c66f5382b87257a7058caafc0cff8e2252e870db53c8e858108bf4d41f','null','7293987c-42f6-11ef-a50b-305a3a090b6e',2,'2024-07-15 22:05:19');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-07-28 19:25:50
