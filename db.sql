-- MySQL dump 10.13  Distrib 5.7.29, for Linux (x86_64)
--
-- Host: localhost    Database: task_management_system
-- ------------------------------------------------------
-- Server version	5.7.29

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
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2020_05_25_163055_create_user_roles_table',2),(4,'2020_05_25_163137_create_permissions_table',2),(5,'2020_05_25_163321_create_role_permissions_table',2),(6,'2020_05_25_163956_create_projects_table',2),(7,'2020_05_25_164337_create_project_users_table',2),(8,'2020_05_25_164424_create_tasks_table',2),(9,'2020_05_25_164741_create_task_comments_table',2),(10,'2020_05_25_164857_create_task_assignments_table',2),(11,'2020_06_04_171206_create_notifications_table',3),(12,'2020_06_06_153325_create_task_completes_table',4),(13,'2020_06_06_161833_add_point_and_comment_fields_to_task_completes',5),(14,'2020_06_07_155356_add_image_field_to_users',6);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES ('148f264c-40d3-4cc8-a778-f57bfacaef44','App\\Notifications\\ProjectAssigned','App\\User',1,'{\"project_id\":4,\"owner_user_id\":5}','2020-06-06 11:20:45','2020-06-06 11:05:07','2020-06-06 11:20:45'),('210ed449-6d10-4a49-830c-de9838bfa357','App\\Notifications\\ProjectAssigned','App\\User',5,'{\"project_id\":2,\"owner_user_id\":1}','2020-06-06 15:18:10','2020-06-04 13:23:42','2020-06-06 15:18:10'),('4d9bb826-be3e-4c51-9974-0f90a57ea9c1','App\\Notifications\\TaskCompleted','App\\User',1,'{\"user_id\":2,\"task_id\":8}','2020-06-07 11:36:40','2020-06-07 11:36:26','2020-06-07 11:36:40'),('53714739-c06a-4fe8-a411-f56e98336c28','App\\Notifications\\ProjectAssigned','App\\User',2,'{\"project_id\":6,\"owner_user_id\":1}',NULL,'2020-06-07 11:41:32','2020-06-07 11:41:32'),('81b55496-35db-4b1f-9964-4a400d0c3402','App\\Notifications\\ProjectAssigned','App\\User',5,'{\"project_id\":1,\"owner_user_id\":1}','2020-06-06 15:17:51','2020-06-04 13:41:24','2020-06-06 15:17:51'),('8749757f-429c-4587-a9c1-4ce25edefb4c','App\\Notifications\\ProjectAssigned','App\\User',6,'{\"project_id\":6,\"owner_user_id\":1}',NULL,'2020-06-07 11:41:38','2020-06-07 11:41:38'),('932f2451-86d1-4ff3-9c34-e6652910dc88','App\\Notifications\\TaskCompleted','App\\User',1,'{\"user_id\":5,\"task_id\":8}','2020-06-06 12:09:15','2020-06-06 12:04:13','2020-06-06 12:09:15'),('c74093f9-4b55-49a0-a505-3bd2de6ab19d','App\\Notifications\\ProjectAssigned','App\\User',1,'{\"project_id\":5,\"owner_user_id\":5}','2020-06-06 11:20:31','2020-06-06 11:11:07','2020-06-06 11:20:31'),('ee67f805-aef1-4c69-9993-00643269e7e3','App\\Notifications\\ProjectAssigned','App\\User',5,'{\"project_id\":6,\"owner_user_id\":1}',NULL,'2020-06-07 11:41:35','2020-06-07 11:41:35'),('f45aa27e-f206-46d1-aae0-0d6e523ad13e','App\\Notifications\\TaskCompleted','App\\User',1,'{\"user_id\":5,\"task_id\":8}','2020-06-07 11:33:00','2020-06-07 11:32:47','2020-06-07 11:33:00');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'Users...','users','2020-05-25 13:11:36','2020-05-25 13:14:45'),(3,'Roles','user_roles','2020-05-25 13:36:31','2020-05-27 12:58:05'),(4,'Permissions','permissions','2020-05-25 13:36:41','2020-05-25 13:36:41'),(5,'Dashboard','dashboard','2020-05-27 13:15:19','2020-05-27 13:15:19'),(6,'Projects','projects','2020-05-30 11:22:03','2020-05-30 11:22:03'),(7,'Tasks','tasks','2020-05-31 12:20:08','2020-05-31 12:20:08');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_users`
--

DROP TABLE IF EXISTS `project_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_users`
--

LOCK TABLES `project_users` WRITE;
/*!40000 ALTER TABLE `project_users` DISABLE KEYS */;
INSERT INTO `project_users` VALUES (4,2,2,NULL,NULL),(7,1,2,NULL,NULL),(10,1,6,NULL,NULL),(11,2,6,NULL,NULL),(12,3,1,NULL,NULL),(15,2,5,NULL,NULL),(16,1,5,NULL,NULL),(17,4,1,NULL,NULL),(18,5,1,NULL,NULL),(19,6,2,NULL,NULL),(20,6,5,NULL,NULL),(21,6,6,NULL,NULL);
/*!40000 ALTER TABLE `project_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (1,'Test project','DzEZcl0uSqRH2htuMU2WC907Q91AJgGj2GTvXCtQ.svg',1,'2020-05-30 11:30:54','2020-05-30 11:30:54'),(2,'Lorem ipsum','RVajFvXdFZzSYwW87JORLKBQ5tNw1nJAJDPk498S.svg',1,'2020-05-30 11:33:53','2020-05-30 11:33:53'),(3,'New project','loj3yiGIy9vVNNzC8bqc3ZOdLnUiqTZhmtMJLeMD.svg',6,'2020-05-31 12:03:22','2020-05-31 12:03:22'),(4,'Memmedin proyekti',NULL,5,'2020-06-04 12:39:32','2020-06-04 12:39:32'),(5,'Memmedin 2ci proyekti',NULL,5,'2020-06-06 11:10:59','2020-06-06 11:10:59');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_permissions`
--

DROP TABLE IF EXISTS `role_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `permission_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_permissions`
--

LOCK TABLES `role_permissions` WRITE;
/*!40000 ALTER TABLE `role_permissions` DISABLE KEYS */;
INSERT INTO `role_permissions` VALUES (6,1,3,NULL,NULL),(7,1,4,NULL,NULL),(9,2,5,NULL,NULL),(10,1,1,NULL,NULL),(11,1,5,NULL,NULL),(12,4,1,NULL,NULL),(13,4,5,NULL,NULL),(14,1,6,NULL,NULL),(15,1,7,NULL,NULL),(16,2,6,NULL,NULL),(17,2,7,NULL,NULL);
/*!40000 ALTER TABLE `role_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task_assignments`
--

DROP TABLE IF EXISTS `task_assignments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task_assignments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `task_id` int(10) unsigned NOT NULL,
  `point` int(11) DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_assignments`
--

LOCK TABLES `task_assignments` WRITE;
/*!40000 ALTER TABLE `task_assignments` DISABLE KEYS */;
INSERT INTO `task_assignments` VALUES (1,5,8,NULL,NULL,NULL,NULL),(2,2,8,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `task_assignments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task_comments`
--

DROP TABLE IF EXISTS `task_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `task_id` int(10) unsigned NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_comments`
--

LOCK TABLES `task_comments` WRITE;
/*!40000 ALTER TABLE `task_comments` DISABLE KEYS */;
INSERT INTO `task_comments` VALUES (1,1,1,'SALAM','2020-06-02 13:31:30','2020-06-02 13:31:30'),(2,5,1,'Aleykum salam.','2020-06-02 13:36:17','2020-06-02 13:36:17'),(3,1,6,'hfgdfsg','2020-06-04 12:45:58','2020-06-04 12:45:58'),(4,1,8,'Test comment','2020-06-07 11:33:35','2020-06-07 11:33:35'),(5,2,8,'dsfgsdjkfglk','2020-06-07 11:37:18','2020-06-07 11:37:18');
/*!40000 ALTER TABLE `task_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task_completes`
--

DROP TABLE IF EXISTS `task_completes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task_completes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `task_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `point` int(11) DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_completes`
--

LOCK TABLES `task_completes` WRITE;
/*!40000 ALTER TABLE `task_completes` DISABLE KEYS */;
INSERT INTO `task_completes` VALUES (8,5,8,NULL,'2020-06-07 11:33:14',10,'Test comment.\r\ndfgsdfgsdfgdf'),(9,2,8,NULL,'2020-06-07 11:36:59',10,'Eladir.');
/*!40000 ALTER TABLE `task_completes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tasks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `deadline` date DEFAULT NULL,
  `project_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks`
--

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
INSERT INTO `tasks` VALUES (7,'kdfgjk','kjgjdf',NULL,1,NULL,3,'2020-06-04 12:59:29','2020-06-04 12:59:29'),(8,'My task','dsfklsdhfsdf',NULL,1,'2020-06-16',1,'2020-06-04 13:06:37','2020-06-04 13:06:37'),(9,'Memmedin taski','dl;fjklsfj',NULL,5,'2020-06-24',1,'2020-06-04 13:07:06','2020-06-04 13:07:06');
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_roles`
--

LOCK TABLES `user_roles` WRITE;
/*!40000 ALTER TABLE `user_roles` DISABLE KEYS */;
INSERT INTO `user_roles` VALUES (1,'Super admin..','2020-05-25 13:27:34','2020-05-25 13:29:03'),(2,'Manager','2020-05-25 13:27:43','2020-05-25 13:27:43'),(4,'developer','2020-05-25 13:40:37','2020-05-25 13:40:37');
/*!40000 ALTER TABLE `user_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(10) unsigned DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Ilyas Ilyasov','ilyas.ilyasov.1@gmail.comm',NULL,'$2y$10$TVhoEWdm7Hp4I0R7UHUeUeT3h5xUg7erqqA4odFfZSdarL08E.8LG',1,NULL,'2020-05-25 12:55:48','2020-06-07 12:05:25','u4x924JQid2ATUHAsusi47UFPSS6u36kLmjDDMbw.jpeg'),(2,'Test user','elvin.hacizade@live.com',NULL,'$2y$10$/OZynuygrYvfznTNDy1VheT5VoCyqay.yYUedID2QyRvz2G2Vxoga',2,'3ASHPctIucmeAbkfNeNY5PpFGYE35sjE592KA2hpowTXhkNgTXgAEg0yRnIo','2020-05-27 12:29:38','2020-06-07 12:12:41','Ej1DSZwwdTlt0g2lFmTqC7nrIfSOte7x3eGwAGTv.jpeg'),(5,'Memmed','ilyas.ilyasov.1@gmail.com',NULL,'$2y$10$56YluXm3B4m1Dj2IiThz.eEfs.17TYYGW54KoJPrHV2qn2H6I3Uum',1,'xkrou8rm3oMHomktvK9izuZctxWtS978cPb61fXUEHzShurvV34MjbNla8BT','2020-05-27 13:24:40','2020-06-02 13:35:30',NULL),(6,'Test test','ilyas@safaroff.az',NULL,'$2y$10$iyQ1R.9NM2hdrYX5JkgJUePAHBeAH5n66S68YKAy6HtqrKh/kLH7y',1,NULL,'2020-05-31 11:54:20','2020-05-31 12:02:52',NULL);
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

-- Dump completed on 2020-06-09 20:26:07
