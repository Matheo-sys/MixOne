-- MySQL dump 10.13  Distrib 8.0.32, for Linux (aarch64)
--
-- Host: localhost    Database: mixone
-- ------------------------------------------------------
-- Server version	8.0.32

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
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('test@test.com|192.168.65.1','i:1;',1772540290),('test@test.com|192.168.65.1:timer','i:1772540290;',1772540290);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hidden_conversations`
--

DROP TABLE IF EXISTS `hidden_conversations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hidden_conversations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `contact_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `hidden_conversations_user_id_contact_id_unique` (`user_id`,`contact_id`),
  KEY `hidden_conversations_contact_id_foreign` (`contact_id`),
  CONSTRAINT `hidden_conversations_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `hidden_conversations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hidden_conversations`
--

LOCK TABLES `hidden_conversations` WRITE;
/*!40000 ALTER TABLE `hidden_conversations` DISABLE KEYS */;
INSERT INTO `hidden_conversations` VALUES (1,2,2,'2026-03-04 10:42:17','2026-03-04 10:42:17'),(2,2,1,'2026-03-04 10:43:21','2026-03-04 10:43:21');
/*!40000 ALTER TABLE `hidden_conversations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sender_id` bigint unsigned NOT NULL,
  `receiver_id` bigint unsigned NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `is_edited` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_sender_id_foreign` (`sender_id`),
  KEY `messages_receiver_id_foreign` (`receiver_id`),
  CONSTRAINT `messages_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,3,2,'bonjour',1,0,'2026-03-03 10:51:11','2026-03-04 10:27:28'),(2,2,2,'eee',1,0,'2026-03-04 10:28:18','2026-03-04 10:28:23'),(3,2,1,'salut',0,0,'2026-03-04 10:43:08','2026-03-04 10:43:08'),(4,2,1,'salut',0,0,'2026-03-04 10:43:09','2026-03-04 10:43:09'),(5,2,1,'salut',0,0,'2026-03-04 10:43:09','2026-03-04 10:43:09'),(6,2,3,'salut',1,0,'2026-03-04 10:44:15','2026-03-04 10:45:11'),(7,3,2,'salut',1,0,'2026-03-04 10:49:53','2026-03-04 10:51:48'),(8,2,3,'ddd',1,0,'2026-03-04 10:56:34','2026-03-04 11:10:17'),(9,2,3,'bonjourrr',1,1,'2026-03-04 11:06:42','2026-03-04 11:10:17'),(10,2,3,'bonjour',1,0,'2026-03-06 08:28:24','2026-03-06 08:28:50');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_02_11_122349_create_studios_table',1),(5,'2025_02_14_170633_add_columns_to_studios_table',1),(6,'2025_02_14_194815_add_latitude_longitude_to_studios_table',1),(7,'2025_02_25_123031_create_messages_table',1),(8,'2025_03_01_160553_add_profile_fields_to_users_table',1),(9,'2025_03_09_202225_add_rating_to_studios_table',1),(10,'2025_03_20_142006_create_reservations_table',1),(11,'2025_03_20_160847_add_date_and_number_of_hours_to_reservations_table',1),(12,'2025_03_22_125109_create_wishlists_table',1),(13,'2025_03_22_164841_add_price_and_status_to_reservations',1),(14,'2025_03_23_164742_add_image_fields_to_studios_table',1),(15,'2026_03_03_131926_add_equipment_to_studios_table',2),(16,'2026_03_04_101847_add_is_read_to_messages_table',3),(17,'2026_03_04_103802_create_hidden_conversations_table',4),(18,'2026_03_04_105910_add_is_edited_to_messages_table',5);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `studio_id` bigint unsigned NOT NULL,
  `date` date NOT NULL,
  `number_of_hours` int NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `status` enum('en attente','confirmée','annulée') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en attente',
  `time_slot` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reservations_user_id_foreign` (`user_id`),
  KEY `reservations_studio_id_foreign` (`studio_id`),
  CONSTRAINT `reservations_studio_id_foreign` FOREIGN KEY (`studio_id`) REFERENCES `studios` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reservations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservations`
--

LOCK TABLES `reservations` WRITE;
/*!40000 ALTER TABLE `reservations` DISABLE KEYS */;
/*!40000 ALTER TABLE `reservations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('T2tD4dvvJ3oSi91PzE1itn55nm47sfZdsQfLzqrj',3,'192.168.65.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRkVxMXlIWklSQkpaWDU0YUE2Sk8xTThWdDlRSGlxRFd0UUZzYWNCayI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9sb2NhbGhvc3QvbWVzc2FnZS91bnJlYWQtY291bnQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO3M6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTc3Mjc4NTg2Nzt9fQ==',1772786535);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `studios`
--

DROP TABLE IF EXISTS `studios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `studios` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `equipment` json DEFAULT NULL,
  `video_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hourly_rate` double NOT NULL,
  `min_hours` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `available_date` date DEFAULT NULL,
  `hours` int DEFAULT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `rating` decimal(3,1) DEFAULT '0.0',
  `image1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `studios_user_id_foreign` (`user_id`),
  CONSTRAINT `studios_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `studios`
--

LOCK TABLES `studios` WRITE;
/*!40000 ALTER TABLE `studios` DISABLE KEYS */;
INSERT INTO `studios` VALUES (11,2,'Studio République','Super studio','[\"micro_condenser\", \"preamp_neve\", \"piano_grand\", \"console_ssl\", \"compressor_hardware\", \"booth\"]',NULL,'15 Avenue de la République','75011','Paris','France',35,1,'2026-03-03 14:26:41','2026-03-03 14:31:38',NULL,NULL,48.8636987,2.3828228,0.0,NULL,NULL,NULL,NULL),(12,2,'Montmartre Records','Haute volée','[\"micro_dynamic\", \"preamp_api\", \"piano_upright\", \"console_neve\", \"eq_hardware\", \"lounge\"]',NULL,'89 Rue des Martyrs','75018','Paris','France',40,1,'2026-03-03 14:26:41','2026-03-03 14:31:59',NULL,NULL,48.8839416,2.3396682,0.0,NULL,NULL,NULL,NULL),(13,2,'Pantin Groove','Un grand espace','[\"micro_ribbon\", \"preamp_ssl\", \"clavier_midi\", \"console_api\", \"reverb_hardware\", \"parking\"]',NULL,'42 Avenue Jean Lolive','93500','Pantin','France',25,1,'2026-03-03 14:26:41','2026-03-03 14:32:14',NULL,NULL,48.8906222,2.4007503,0.0,NULL,NULL,NULL,NULL),(14,2,'Montreuil Mix Room','Le mix parfait','[\"Shure SM7B\", \"SSL 2+\", \"Ableton Live\"]',NULL,'12 Rue de l\'Église','93100','Montreuil','France',30,1,'2026-03-03 14:26:41','2026-03-03 14:26:41',NULL,NULL,48.8623000,2.4412000,0.0,NULL,NULL,NULL,NULL),(15,2,'Boulogne Premium','Premium sound','[\"micro_ribbon\", \"micro_large_diaphragm\", \"micro_small_diaphragm\", \"interface_focusrite\", \"interface_rme\", \"drum_electronic\", \"guitar_electric\", \"console_api\", \"monitor_focal\", \"subwoofer\", \"eq_hardware\", \"reverb_hardware\", \"parking\", \"wifi\", \"air_conditioning\"]',NULL,'55 Boulevard Jean Jaurès','92100','Boulogne-Billancourt','France',60,1,'2026-03-03 14:26:41','2026-03-03 14:32:37',NULL,NULL,48.8401414,2.2399597,0.0,NULL,NULL,NULL,NULL),(16,2,'Saint-Denis Session','Session pour tous','[\"micro_small_diaphragm\", \"micro_usb\", \"interface_focusrite\", \"drum_kit\", \"daw_logic\", \"daw_ableton\", \"daw_studio_one\", \"eq_hardware\", \"booth\", \"lounge\", \"parking\", \"wifi\", \"air_conditioning\", \"accessible\", \"kitchen\"]',NULL,'2 Rue de la Légion d\'Honneur','93200','Saint-Denis','France',20,1,'2026-03-03 14:26:41','2026-03-03 14:33:06',NULL,NULL,48.9346890,2.3580290,0.0,NULL,NULL,NULL,NULL),(17,2,'Issy Sound Lab','Lab','[\"micro_small_diaphragm\", \"micro_usb\", \"preamp_ssl\", \"interface_apollo\", \"piano_grand\", \"piano_upright\", \"clavier_midi\", \"synth\", \"daw_logic\", \"daw_ableton\", \"daw_studio_one\", \"monitor_genelec\", \"reverb_hardware\", \"patchbay\", \"plugin_bundle\"]',NULL,'18 Rue Ernest Renan','92130','Issy-les-Moulineaux','France',45,1,'2026-03-03 14:26:41','2026-03-03 14:33:28',NULL,NULL,48.8295189,2.2834926,0.0,NULL,NULL,NULL,NULL),(18,2,'Ivry Underground','Underground','[\"micro_usb\", \"preamp_neve\", \"preamp_api\", \"preamp_ssl\", \"daw_logic\", \"monitor_focal\", \"subwoofer\", \"compressor_hardware\", \"eq_hardware\", \"patchbay\", \"plugin_bundle\"]',NULL,'33 Avenue Maurice Thorez','94200','Ivry-sur-Seine','France',25,1,'2026-03-03 14:26:41','2026-03-03 14:33:49',NULL,NULL,48.8142840,2.3790421,0.0,NULL,NULL,NULL,NULL),(19,2,'Neuilly Vocal Studio','Prises de voix','[\"micro_condenser\", \"micro_dynamic\", \"micro_ribbon\", \"preamp_api\", \"preamp_ssl\", \"piano_grand\", \"piano_upright\", \"clavier_midi\", \"synth\", \"console_api\", \"eq_hardware\", \"reverb_hardware\", \"lounge\", \"parking\", \"wifi\"]',NULL,'90 Avenue du Roule','92200','Neuilly-sur-Seine','France',55,1,'2026-03-03 14:26:41','2026-03-03 14:34:09',NULL,NULL,48.8842146,2.2709940,0.0,NULL,NULL,NULL,NULL),(20,2,'Vincennes BeatBox','Beatmaking','[\"micro_dynamic\", \"micro_ribbon\", \"piano_upright\", \"daw_studio_one\", \"monitor_genelec\", \"monitor_yamaha\", \"monitor_adam\", \"monitor_focal\", \"subwoofer\", \"headphones_dj\", \"wifi\", \"air_conditioning\", \"accessible\"]',NULL,'24 Rue de Montreuil','94300','Vincennes','France',35,1,'2026-03-03 14:26:41','2026-03-03 14:34:33',NULL,NULL,48.8452417,2.4346006,0.0,NULL,NULL,NULL,NULL),(21,2,'Studio Paul Langevin','Ouvert 24/24','[\"micro_condenser\", \"micro_dynamic\", \"daw_ableton\", \"daw_studio_one\", \"monitor_genelec\", \"monitor_yamaha\", \"patchbay\", \"plugin_bundle\", \"parking\", \"wifi\", \"air_conditioning\"]',NULL,'19 Rue Paul Langevin','93260','Les Lilas','France',70,1,'2026-03-03 15:43:57','2026-03-03 15:43:57',NULL,NULL,48.8838119,2.4229536,0.0,NULL,NULL,NULL,NULL),(29,2,'Studio Elias','Studio le plus mondiale du 94','[\"micro_condenser\", \"micro_dynamic\", \"micro_ribbon\", \"micro_large_diaphragm\", \"micro_small_diaphragm\", \"micro_usb\", \"preamp_neve\", \"preamp_api\", \"preamp_ssl\", \"interface_apollo\", \"interface_focusrite\", \"interface_rme\", \"interface_other\", \"piano_grand\", \"piano_upright\", \"clavier_midi\", \"synth\", \"drum_kit\", \"drum_electronic\", \"guitar_electric\", \"guitar_acoustic\", \"bass\", \"console_ssl\", \"console_neve\", \"console_api\", \"daw_protools\", \"daw_logic\", \"daw_ableton\", \"daw_studio_one\", \"monitor_genelec\", \"monitor_yamaha\", \"monitor_adam\", \"monitor_focal\", \"subwoofer\", \"headphones_dj\", \"compressor_hardware\", \"eq_hardware\", \"reverb_hardware\", \"patchbay\", \"plugin_bundle\", \"booth\", \"lounge\", \"parking\", \"wifi\", \"air_conditioning\", \"accessible\", \"kitchen\"]',NULL,'16 Rue du Commandant l’Herminier','94240','L\'Haÿ-les-Roses','France',10,1,'2026-03-04 09:46:55','2026-03-04 09:53:37',NULL,NULL,48.7698720,2.3280590,0.0,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `studios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `profile` enum('artist','studio') COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `about` text COLLATE utf8mb4_unicode_ci,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_line1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_line2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zipcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'artist',NULL,'User','Test','test@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-03-02 13:25:37','$2y$12$Vz3sChk9lVmvdrBA6LLfJOklmTGYYpxw9JhYMjSRR/rSToXZnMgSS','F0TP19YIEs','2026-03-02 13:25:37','2026-03-02 13:25:37'),(2,'studio','elias.l94','Louhichi','Elias','louhichielias94@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$2y$12$9COwXwGl7zCmi96g0KrzV.zauIcFr4gDcZWBECcaz1MBzFzhLsSOW',NULL,'2026-03-02 14:17:03','2026-03-03 15:50:17'),(3,'artist',NULL,'louhichi','Tommy','tommy@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$2y$12$zoFMH1acGSJgdjr5m.jHI.NvQfNIhXdSryfg31Y6a4sXBpCj.91l2',NULL,'2026-03-03 10:50:52','2026-03-03 10:50:52'),(4,'studio',NULL,'User','Studio','studio@test.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$2y$12$/8Uy2vKftq8LsUDVoyoe/OLYrDn6GgqAAGPj.TxFFSiv1Ydr.MCk.',NULL,'2026-03-03 12:20:15','2026-03-03 12:20:15');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wishlists`
--

DROP TABLE IF EXISTS `wishlists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wishlists` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `studio_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `wishlists_user_id_studio_id_unique` (`user_id`,`studio_id`),
  KEY `wishlists_studio_id_foreign` (`studio_id`),
  CONSTRAINT `wishlists_studio_id_foreign` FOREIGN KEY (`studio_id`) REFERENCES `studios` (`id`) ON DELETE CASCADE,
  CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wishlists`
--

LOCK TABLES `wishlists` WRITE;
/*!40000 ALTER TABLE `wishlists` DISABLE KEYS */;
INSERT INTO `wishlists` VALUES (5,3,11,'2026-03-03 19:09:09','2026-03-03 19:09:09'),(6,3,12,'2026-03-03 19:09:11','2026-03-03 19:09:11'),(7,3,13,'2026-03-03 19:09:12','2026-03-03 19:09:12'),(8,3,18,'2026-03-03 19:09:28','2026-03-03 19:09:28'),(9,3,17,'2026-03-03 19:09:29','2026-03-03 19:09:29'),(10,3,19,'2026-03-03 19:09:30','2026-03-03 19:09:30');
/*!40000 ALTER TABLE `wishlists` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-03-06  8:42:36
