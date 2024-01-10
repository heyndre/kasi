
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
DROP TABLE IF EXISTS `announcements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `announcements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `expire_at` timestamp NULL DEFAULT NULL,
  `title` varchar(512) DEFAULT NULL,
  `content` mediumtext,
  `for_role` enum('TUTOR','ADMIN','MURID','WALI MURID') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `announcements` WRITE;
/*!40000 ALTER TABLE `announcements` DISABLE KEYS */;
/*!40000 ALTER TABLE `announcements` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `billings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `billings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `bill_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `amount` decimal(20,6) NOT NULL,
  `length` bigint(20) unsigned DEFAULT NULL,
  `invoice_id` bigint(20) unsigned NOT NULL,
  `class_id` bigint(20) unsigned DEFAULT NULL,
  `student_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_billings_classes` (`class_id`),
  KEY `FK_billings_students` (`student_id`),
  CONSTRAINT `FK_billings_classes` FOREIGN KEY (`class_id`) REFERENCES `courses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_billings_students` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `billings` WRITE;
/*!40000 ALTER TABLE `billings` DISABLE KEYS */;
INSERT INTO `billings` VALUES (20,'2023-12-28 13:45:14','2023-12-28 13:45:14','2024-01-01','2024-01-11',50000.000000,60,2,NULL,2),(29,'2024-01-02 16:02:28','2024-01-02 16:19:44','2024-02-01','2024-02-11',105000.000000,180,3,NULL,6);
/*!40000 ALTER TABLE `billings` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `student_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `tutor_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `course_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `billing_id` bigint(20) unsigned DEFAULT NULL,
  `date_of_event` datetime DEFAULT NULL,
  `event_end_time` datetime DEFAULT NULL,
  `student_attendance` datetime DEFAULT NULL,
  `tutor_attendance` datetime DEFAULT NULL,
  `status` enum('CONDUCTED','CANCELLED','BURNED','WAITING') NOT NULL DEFAULT 'WAITING',
  `topic` varchar(1024) DEFAULT NULL,
  `lesson_matter` longtext,
  `tutor_notes` longtext,
  `additional_links` json DEFAULT NULL,
  `recording` varchar(1024) DEFAULT NULL,
  `photo` varchar(1024) DEFAULT NULL,
  `length` tinyint(3) unsigned DEFAULT NULL,
  `price` mediumint(8) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_class_tutors` (`tutor_id`),
  KEY `FK_class_students` (`student_id`),
  KEY `FK_class_tutor_skills_pivot` (`course_id`),
  KEY `billing_id` (`billing_id`),
  CONSTRAINT `FK_class_students` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_class_tutor_skills_pivot` FOREIGN KEY (`course_id`) REFERENCES `tutor_skills_pivot` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_class_tutors` FOREIGN KEY (`tutor_id`) REFERENCES `tutors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_courses_billings` FOREIGN KEY (`billing_id`) REFERENCES `billings` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (2,'2023-12-26 09:45:22','2023-12-28 13:45:14',2,5,1,20,'2023-12-26 10:30:00',NULL,'2023-12-26 12:19:12','2023-12-26 10:28:14','CONDUCTED','Sistem Pernafasan Manusia',NULL,NULL,'[]',NULL,'Free trial Chelsea.png',60,50000),(3,'2023-12-26 09:45:22','2024-01-02 16:02:28',6,5,1,29,'2023-12-26 10:30:00',NULL,'2023-12-26 12:19:12','2023-12-26 10:28:14','CONDUCTED',NULL,NULL,NULL,'[]',NULL,NULL,60,50000),(4,'2023-12-26 09:45:22','2024-01-02 15:43:02',6,1,3,NULL,'2023-12-26 11:00:00',NULL,NULL,NULL,'CANCELLED','Gerund',NULL,NULL,'[]',NULL,NULL,60,50000),(5,'2023-12-26 09:45:22','2024-01-02 16:18:16',6,5,2,29,'2023-12-26 17:21:10',NULL,'2023-12-26 17:21:12','2023-12-26 17:21:13','CONDUCTED','Something','Mauris vel erat pharetra, auctor risus molestie, volutpat eros. Sed cursus sem nec neque dignissim vulputate. Nullam a sodales augue. Ut iaculis viverra orci, sit amet tincidunt ex pulvinar non. Maecenas eu pretium dui, non elementum lectus. Aenean dapibus quam non porttitor elementum. Duis vitae lectus libero. Nulla facilisi. Aliquam efficitur dapibus iaculis. Ut a nibh vel nisl congue imperdiet. Duis aliquam ipsum ut quam molestie elementum. Vivamus risus tortor, commodo vel porttitor non, facilisis ut erat. Morbi volutpat, erat sit amet tempor vehicula, ipsum ligula convallis neque, id finibus purus leo ut risus. Vestibulum tempus purus in ligula accumsan suscipit. Fusce porta metus enim, nec finibus nibh malesuada eu.\r\n\r\nEtiam suscipit neque nec ex bibendum, sed consequat sem dignissim. Proin posuere arcu elit, condimentum dictum diam tincidunt at. Cras id molestie mauris, a feugiat sem. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec ex est, semper sit amet nisl ut, sagittis dictum odio. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas non condimentum quam, id eleifend risus. Fusce lorem ligula, consequat id pretium quis, dapibus sed lacus. Vestibulum volutpat orci ut mi bibendum, at placerat ipsum fermentum.\r\n\r\nNulla efficitur volutpat sapien ut viverra. Duis eu egestas felis, quis sollicitudin felis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Cras tincidunt nec leo aliquam eleifend. Nulla finibus, nisl vel sollicitudin iaculis, eros massa tempor ligula, lobortis tincidunt ipsum sem at sem. Morbi finibus facilisis erat hendrerit cursus. Phasellus ac laoreet elit. Etiam non posuere mauris.\r\n\r\nVestibulum eleifend blandit lobortis. Vestibulum justo arcu, fermentum sed lorem a, volutpat vehicula tortor. Aenean pellentesque semper erat, vel fringilla justo scelerisque quis. Aliquam sed risus urna. Aliquam varius risus mi, in viverra libero laoreet vitae. Vivamus laoreet molestie nulla, eget maximus neque pharetra eget. Morbi id urna facilisis, bibendum eros nec, vulputate lectus. Praesent dapibus posuere feugiat. Integer rhoncus nunc eu tellus mollis, non feugiat ex semper. Ut mollis placerat leo id suscipit. Duis blandit quam non lorem finibus, et molestie nisi rhoncus. Suspendisse sed neque nisi. Nullam id scelerisque leo, ut pulvinar libero. Maecenas condimentum enim nulla.\r\n\r\nIn enim turpis, lobortis id nisl ut, commodo auctor nibh. Maecenas sed viverra neque, at pellentesque arcu. Donec lobortis, sapien condimentum maximus suscipit, leo sem facilisis lorem, in imperdiet lectus dolor sed enim. Aenean laoreet orci et scelerisque vulputate. Nullam vel lectus urna. Vestibulum felis velit, facilisis eu auctor eu, ultrices sit amet nisl. Etiam tristique quis elit in elementum. Fusce pretium luctus felis, malesuada lobortis nulla condimentum eu. Fusce dictum nibh lectus, et pellentesque elit volutpat sed. Pellentesque eleifend nisl id dictum molestie. Cras luctus leo quis neque dapibus, ut placerat ipsum rhoncus. Nunc consequat blandit risus et pulvinar. Morbi sit amet enim condimentum elit feugiat mattis in non arcu. Quisque eget tempus leo, quis dignissim est. Quisque accumsan sollicitudin faucibus. ','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu auctor sem, vitae consectetur elit. Nulla laoreet ornare volutpat. Sed. ','[]',NULL,NULL,60,60000),(6,'2023-12-26 09:45:22','2024-01-02 16:19:44',6,5,1,29,'2023-12-31 10:30:00',NULL,'2023-12-31 12:19:12','2023-12-31 10:28:14','CONDUCTED',NULL,NULL,NULL,'[]',NULL,NULL,60,50000),(12,'2024-01-08 12:50:37','2024-01-09 08:15:57',28,7,4,NULL,'2024-01-09 16:00:00',NULL,NULL,NULL,'WAITING','English For Beginner - Restaurant','',NULL,'\"[\\\"https:\\\\/\\\\/drive.google.com\\\\/file\\\\/d\\\\/1WtIwXOw5DjmQvMHqD1u55PpgkebuWZ7Y\\\\/view?usp=drive_link\\\"]\"',NULL,NULL,60,50000);
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `expenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expenses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `spent_date` datetime DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `information` varchar(1024) NOT NULL,
  `pay_method` enum('cash','bank_transfer','flip','gopay','ovo','other') NOT NULL DEFAULT 'bank_transfer',
  `amount` decimal(20,6) NOT NULL,
  `additional_info` mediumtext,
  `payment_file` varchar(512) DEFAULT NULL,
  `tutor_id` bigint(20) unsigned DEFAULT NULL,
  `billing_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_expense_tutors` (`tutor_id`),
  KEY `FK_expenses_billings` (`billing_id`),
  CONSTRAINT `FK_expense_tutors` FOREIGN KEY (`tutor_id`) REFERENCES `tutors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_expenses_billings` FOREIGN KEY (`billing_id`) REFERENCES `billings` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `expenses` WRITE;
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;
INSERT INTO `expenses` VALUES (1,'2024-01-02 12:10:17','2024-01-02 14:04:00','2024-01-02 00:00:00','2024-01-12','Pengembalian dana billing #00002','bank_transfer',51700.000000,'628734031218','2023100002/00001-20240102 210400.jpg',NULL,20),(4,'2024-01-03 02:22:45','2024-01-03 02:29:16','2024-01-03 09:29:16','2024-01-13','Pengembalian dana billing #00003','bank_transfer',472500.000000,'0420231209164620nK35w971EwID','2023110002/00004-20240103 092916.jpg',NULL,29);
/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
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

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `guardians`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `guardians` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `edu_status` int(11) DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `religion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edu_level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edu_site` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edu_major` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_site` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `base_user_student` (`user_id`) USING BTREE,
  CONSTRAINT `guardians_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `guardians` WRITE;
/*!40000 ALTER TABLE `guardians` DISABLE KEYS */;
INSERT INTO `guardians` VALUES (27,NULL,'2023-12-20 13:49:00',44,1,NULL,'Kristen','Mahasiswa Jenjang S1',NULL,NULL,NULL,'housewife'),(29,'2023-12-20 14:00:11','2023-12-20 14:00:11',47,1,NULL,'Hindu','s1',NULL,NULL,NULL,'housewife'),(30,'2024-01-03 11:10:34','2024-01-03 11:10:34',50,1,'Jl. Penataran Sari 1A No. 14, Bali',NULL,NULL,NULL,NULL,NULL,'housewife'),(31,'2024-01-08 12:06:00','2024-01-08 12:06:00',53,1,NULL,NULL,'s1',NULL,NULL,NULL,'other');
/*!40000 ALTER TABLE `guardians` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (5,'2014_10_12_000000_create_users_table',1),(6,'2014_10_12_100000_create_password_reset_tokens_table',1),(7,'2014_10_12_200000_add_two_factor_columns_to_users_table',1),(8,'2019_08_19_000000_create_failed_jobs_table',1),(9,'2019_12_14_000001_create_personal_access_tokens_table',1),(10,'2023_11_09_071958_create_sessions_table',1),(11,'2023_11_09_172008_create_students_table',2),(12,'2023_12_12_174647_add_welcome_valid_until_field_to_users_table',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `packages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `student_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `bought_at` timestamp NOT NULL,
  `duration` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `remaining` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `price_per_unit` decimal(20,6) NOT NULL,
  `expire_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_packages_students` (`student_id`),
  CONSTRAINT `FK_packages_students` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `packages` WRITE;
/*!40000 ALTER TABLE `packages` DISABLE KEYS */;
INSERT INTO `packages` VALUES (1,NULL,'2024-01-03 02:13:17',6,'2023-12-01 07:05:46',90,0,35000.000000,'2025-01-02 07:06:04');
/*!40000 ALTER TABLE `packages` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `billing_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `confirmed_by` bigint(20) unsigned DEFAULT NULL,
  `pay_date` datetime NOT NULL,
  `confirm_date` datetime DEFAULT NULL,
  `payment_file` varchar(512) DEFAULT NULL,
  `amount` decimal(20,6) unsigned DEFAULT '0.000000',
  `penalty` decimal(20,6) unsigned DEFAULT '0.000000',
  `pay_method` enum('package','bank_transfer','other') NOT NULL DEFAULT 'bank_transfer',
  `package_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__billings` (`billing_id`),
  CONSTRAINT `FK__billings` FOREIGN KEY (`billing_id`) REFERENCES `billings` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (9,'2024-01-02 09:47:49','2024-01-02 10:26:10',20,1,'2024-01-02 16:47:49','2024-01-02 17:26:10','2023100002/00002-20240102 164749.jpg',101700.000000,0.000000,'bank_transfer',NULL),(22,'2024-01-03 02:13:17','2024-01-03 02:13:24',29,1,'2024-01-03 09:13:17','2024-01-03 09:13:17','2023110002/SIPAKA-00022.png',52500.000000,0.000000,'package',1),(24,'2024-01-03 02:20:10','2024-01-03 02:20:38',29,1,'2024-01-03 09:20:10','2024-01-03 09:20:38','2023110002/00003-20240103 092010.jpg',525000.000000,0.000000,'bank_transfer',NULL);
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `prices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `course_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `price` decimal(20,6) unsigned DEFAULT NULL,
  `duration` tinyint(4) unsigned DEFAULT NULL,
  `type` enum('single','package') NOT NULL DEFAULT 'single',
  PRIMARY KEY (`id`),
  KEY `FK_price_tutor_skills` (`course_id`),
  CONSTRAINT `FK_price_tutor_skills` FOREIGN KEY (`course_id`) REFERENCES `tutor_skills` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `prices` WRITE;
/*!40000 ALTER TABLE `prices` DISABLE KEYS */;
INSERT INTO `prices` VALUES (1,NULL,NULL,5,60000.000000,60,'single'),(2,NULL,NULL,4,50000.000000,60,'single');
/*!40000 ALTER TABLE `prices` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('7JRoYHfbkL9WEESrrzM31PhtBpbkYqV90yjonSQ4',NULL,'::1','WhatsApp/2.2349.2 W','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVkYyQnR5WVdmamZLQkRGU0x6NVk2TkdiZXJMWDM5TzFNZHk1UGk4dSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTY6Imh0dHA6Ly9rYXNpLnRlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1704784342),('gzK1cOPTOcrtwkx9651SOHTGJRrggndlDGN3PzJ3',54,'192.168.1.250','Mozilla/5.0 (Android 13; Mobile; rv:121.0) Gecko/121.0 Firefox/121.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiajdJYkZHUnhPa01ld3B5NXNCbkxXa005Y0VhbXZoSTFDRGI2VFNnQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xOTIuMTY4LjEuMTEvbXVyaWQva2VsYXMvZGV0YWlsLzEyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTQ7czoyMToicGFzc3dvcmRfaGFzaF9zYW5jdHVtIjtzOjYwOiIkMnkkMTIkbGxzZFIxYllLUTRJekMvRW5idzBHZWdsVk0ya3hDSzFQOWM2eFMxYVZYS1YzOVlwdm5FVUciO30=',1704788238),('KOMmGX9v0bIjFqdswpvJJu6sOc6PIhfnHkSEBep5',NULL,'::1','Mozilla/5.0 (Android 13; Mobile; rv:121.0) Gecko/121.0 Firefox/121.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVHdWM0E4SWlPVjhqU3ExV0toeHZMcDIwUVNtRWVBUzhKZmxteE12cCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTY6Imh0dHA6Ly9rYXNpLnRlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1704784975),('m6KY03pgGs0Yl29rL5GuODbMftUvAIdGugTcoCYG',52,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNjdWSkRFTm1Pc0RVNllsT2N4VVlXYm50c09YNnJzNXBTanBQZFhsMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHBzOi8va2FzaS50ZXN0L3R1dG9yL2tlbGFzL2RldGFpbC8xMiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjUyO3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEyJFc4M3ZGRzBSSllJdXAyWXlZZXhKb2UyRzNNcWxXcm0uUElOUG5UeDNkOTJvVHgvQ2lha2UyIjt9',1704788203),('SIGmAyMpBrjPWXvHZeZ69ZTRzDqfxSVAdVxX0fZi',NULL,'::1','Mozilla/5.0 (Android 13; Mobile; rv:121.0) Gecko/121.0 Firefox/121.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNGJZdFVNUHJkMERXRWdzaWpxeWhJMGdGRlRjcGpURDVTMlZidVFNayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTk6Imh0dHA6Ly9mODE1LTEyNS0xNjYtMTE4LTY4Lm5ncm9rLWZyZWUuYXBwL2thc2kvcHVibGljL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1704785360),('suvvB0FNdeJIKXJ4fTuqlQCz7d3kWHQ1ZbYU5q4B',NULL,'192.168.1.250','Mozilla/5.0 (Android 13; Mobile; rv:121.0) Gecko/121.0 Firefox/121.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMU01ZmVla2ttVWl1QVdqdDhDd1A0OWY5NHdlUE1odUNOd1BYQktKbCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MToiaHR0cDovLzE5Mi4xNjguMS4xMS9tdXJpZC9rZWxhcy9kZXRhaWwvMTIiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNToiaHR0cDovLzE5Mi4xNjguMS4xMS9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1704811851),('Y6wBKLZG0qWQfDYtaNWLEpfMPZx9tooRgBmIf5UW',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZmdkNnEzUEl5WWY4UXVkWm1KRkNqZ1JqTm1ESkdyRFVaTlNJYWFiZCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNzoiaHR0cHM6Ly9rYXNpLnRlc3QvdHV0b3Iva2VsYXMvZWRpdC8xMiI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM3OiJodHRwczovL2thc2kudGVzdC90dXRvci9rZWxhcy9lZGl0LzEyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1704810712);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `key` varchar(512) NOT NULL,
  `value` varchar(512) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,NULL,NULL,'bill_due_date','10'),(2,NULL,NULL,'motto','Belajar Dulu, Menginspirasi Kemudian!'),(3,NULL,NULL,'app_nickname','KASI'),(4,NULL,NULL,'whatsapp','6285179824064'),(5,NULL,NULL,'inquiryConfirmPayment','Halo Admin KASI, saya hendak inquiry konfirmasi bukti pembayaran saya dengan nomor pembayaran ');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `student_evaluations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_evaluations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `evaluation_date` timestamp NOT NULL,
  `received_date` timestamp NOT NULL,
  `student_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `lesson_scoring` json NOT NULL,
  `general_scoring` json NOT NULL,
  `student_feedback` json NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_evaluation_tutors` (`student_id`) USING BTREE,
  CONSTRAINT `FK_student_evaluations_students` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `student_evaluations` WRITE;
/*!40000 ALTER TABLE `student_evaluations` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_evaluations` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `students` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nim` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `has_guardian` tinyint(1) NOT NULL,
  `guardian_id` bigint(20) unsigned DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `edu_status` int(11) DEFAULT NULL,
  `edu_level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edu_site` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_site` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `religion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `base_user_student` (`user_id`),
  KEY `FK_students_guardians` (`guardian_id`),
  CONSTRAINT `FK_students_guardians` FOREIGN KEY (`guardian_id`) REFERENCES `guardians` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `base_user_student` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (2,NULL,'2024-01-03 11:36:43','2023100002',3,1,30,'Jl. Penataran Sari 1A No. 14, Bali',1,'smp','Jembatan Budaya School',NULL,NULL,'Katolik'),(5,'2023-11-13 13:08:00','2023-11-13 13:08:00','2023110001',11,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,'2023-11-13 13:08:47','2023-11-13 13:08:47','2023110002',12,0,27,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(26,'2023-12-12 11:13:38','2023-12-20 14:21:41','2023120001',33,1,29,NULL,1,'sd','SD Shinta',NULL,'unemployed',NULL),(27,'2023-12-20 14:43:11','2023-12-20 14:43:11','2023120002',49,1,29,NULL,1,'sd','SPK SD CHIS Denpasar',NULL,'unemployed',NULL),(28,'2024-01-08 12:13:58','2024-01-08 12:13:58','2024010001',54,1,31,NULL,1,'sd','SD Santo Yoseph 2 Denpasar',NULL,'unemployed',NULL);
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `tutor_evaluations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tutor_evaluations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `evaluation_date` timestamp NOT NULL,
  `received_date` timestamp NOT NULL,
  `tutor_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `scoring` json NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_evaluation_tutors` (`tutor_id`),
  CONSTRAINT `FK_evaluation_tutors` FOREIGN KEY (`tutor_id`) REFERENCES `tutors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `tutor_evaluations` WRITE;
/*!40000 ALTER TABLE `tutor_evaluations` DISABLE KEYS */;
/*!40000 ALTER TABLE `tutor_evaluations` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `tutor_payment_sharing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tutor_payment_sharing` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `billing_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `tutor_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `pay_date` decimal(20,6) unsigned NOT NULL DEFAULT '0.000000',
  `amount` decimal(20,6) unsigned NOT NULL DEFAULT '0.000000',
  `pay_method` enum('bank_transfer','other') NOT NULL DEFAULT 'bank_transfer',
  `payment_proof` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK__billings` (`billing_id`) USING BTREE,
  KEY `FK_tutor_payment_sharing_tutors` (`tutor_id`),
  CONSTRAINT `FK_tutor_payment_sharing_billings` FOREIGN KEY (`billing_id`) REFERENCES `billings` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_tutor_payment_sharing_tutors` FOREIGN KEY (`tutor_id`) REFERENCES `tutors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `tutor_payment_sharing` WRITE;
/*!40000 ALTER TABLE `tutor_payment_sharing` DISABLE KEYS */;
/*!40000 ALTER TABLE `tutor_payment_sharing` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `tutor_skills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tutor_skills` (
  `id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '0',
  `price` decimal(20,6) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `tutor_skills` WRITE;
/*!40000 ALTER TABLE `tutor_skills` DISABLE KEYS */;
INSERT INTO `tutor_skills` VALUES (1,'Matematika SD',50000.000000),(2,'Matematika SMP',60000.000000),(3,'Matematika SMA',60000.000000),(4,'Bahasa Inggris SD',50000.000000),(5,'Bahasa Inggris SMP',60000.000000),(6,'Bahasa Inggris SMA',60000.000000),(7,'IPA SD',50000.000000),(8,'IPA SMP',60000.000000),(9,'Kimia SMA',60000.000000),(10,'Fisika SMA',60000.000000),(11,'Fisika SMP',60000.000000),(12,'Biologi SMP',60000.000000),(13,'Biologi SMA',60000.000000),(14,'General English',60000.000000),(15,'English Preparation for TOEFL',95000.000000),(16,'English Preparation for IELTS',110000.000000);
/*!40000 ALTER TABLE `tutor_skills` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `tutor_skills_pivot`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tutor_skills_pivot` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `Column 2` bigint(20) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tutor_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `skill_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK__tutors` (`tutor_id`),
  KEY `FK_tutor_skills_pivot_tutor_skills` (`skill_id`),
  CONSTRAINT `FK__tutors` FOREIGN KEY (`tutor_id`) REFERENCES `tutors` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_tutor_skills_pivot_tutor_skills` FOREIGN KEY (`skill_id`) REFERENCES `tutor_skills` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `tutor_skills_pivot` WRITE;
/*!40000 ALTER TABLE `tutor_skills_pivot` DISABLE KEYS */;
INSERT INTO `tutor_skills_pivot` VALUES (1,0,NULL,NULL,5,13),(2,0,NULL,NULL,5,11),(3,0,NULL,NULL,1,15),(4,0,'2024-01-08 11:25:41','2024-01-08 11:25:41',7,4),(5,0,'2024-01-08 11:25:41','2024-01-08 11:25:41',7,5),(6,0,'2024-01-08 11:25:41','2024-01-08 11:25:41',7,6),(7,0,'2024-01-08 11:25:41','2024-01-08 11:25:41',7,14),(8,0,'2024-01-08 11:25:41','2024-01-08 11:25:41',7,15);
/*!40000 ALTER TABLE `tutor_skills_pivot` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `tutors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tutors` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `edu_status` int(10) unsigned DEFAULT NULL,
  `edu_site` varchar(255) DEFAULT NULL,
  `edu_level` varchar(255) DEFAULT NULL,
  `edu_title` varchar(255) DEFAULT NULL,
  `work_title` varchar(255) DEFAULT NULL,
  `work_site` varchar(255) DEFAULT NULL,
  `bank_number` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `bank_additional_info` text,
  `edu_major` varchar(255) DEFAULT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `hobbies` varchar(255) DEFAULT NULL,
  `passion` varchar(255) DEFAULT NULL,
  `motto` varchar(255) DEFAULT NULL,
  `teaching_experience` mediumtext,
  `leadership_experience` mediumtext,
  `competition_experience` mediumtext,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tutor_user_id` (`user_id`),
  CONSTRAINT `tutor_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `tutors` WRITE;
/*!40000 ALTER TABLE `tutors` DISABLE KEYS */;
INSERT INTO `tutors` VALUES (1,37,1,'Widya Mandala','s1',NULL,'freelance','non KASI','2000706640','BCA',NULL,'Electrical Engineering','Kristen','playing online games, reading book, watching instagram','education, programming, teaching, playing','Hidup harus rendah hati dan saling mengasihi','<ol>\n<li>Teaching private class in Kasi (2020)</li>\n<li>Teaching my friends in senior and junior highschool</li>\n</ol>','<ol>\n<li>Class&rsquo; Captain in High School</li>\n<li>Class&rsquo; Captain in University</li>\n<li>Join an Student Organization in College</li>\n</ol>','<ol>\n<li>Won 4th-5th place at Lomba Fisika Se-Jember</li>\n<li>Awardee of OSC Scholarship 2019</li>\n</ol>','2023-12-12 16:31:30','2023-12-13 11:19:37'),(5,43,1,'Universitas LALALA','s1',NULL,'unemployed',NULL,'2000706632','BCA',NULL,'Electrical Engineering','Kristen','playing online games, reading book, watching instagram','education, programming, teaching, playing','Hidup harus rendah hati dan saling mengasihi','<p>-</p>','<p>-</p>','<p>-</p>','2023-12-13 10:29:11','2023-12-13 10:29:11'),(7,52,1,NULL,'s2',NULL,'teacher','Cakap','7610853913','BCA',NULL,NULL,'Kristen','listening to music, hanging out with friends, watching movies','education, business, social change, culture','Live by faith, turn dream into reality','<p dir=\"ltr\" style=\"line-height: 1.7999999999999998; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size: 12pt; font-family: \'Times New Roman\',serif; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">Teaching Experience (s) </span><span style=\"font-size: 12pt; font-family: \'Times New Roman\',serif; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\"><span class=\"Apple-tab-span\" style=\"white-space: pre;\"> </span></span><span style=\"font-size: 12pt; font-family: \'Times New Roman\',serif; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\"><span class=\"Apple-tab-span\" style=\"white-space: pre;\"> </span></span><span style=\"font-size: 12pt; font-family: \'Times New Roman\',serif; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">:&nbsp;</span></p>\n<ol style=\"margin-top: 0; margin-bottom: 0; padding-inline-start: 48px;\">\n<li dir=\"ltr\" style=\"list-style-type: lower-alpha; font-size: 12pt; font-family: \'Times New Roman\',serif; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre;\" aria-level=\"1\">\n<p dir=\"ltr\" style=\"line-height: 1.7999999999999998; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\" role=\"presentation\"><span style=\"font-size: 12pt; font-family: \'Times New Roman\',serif; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">Teaching private class in Elizabeth Learning Center (2019)</span></p>\n</li>\n<li dir=\"ltr\" style=\"list-style-type: lower-alpha; font-size: 12pt; font-family: \'Times New Roman\',serif; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre;\" aria-level=\"1\">\n<p dir=\"ltr\" style=\"line-height: 1.7999999999999998; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\" role=\"presentation\"><span style=\"font-size: 12pt; font-family: \'Times New Roman\',serif; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">Teaching private class in KaSi (2020 - present)</span></p>\n</li>\n<li dir=\"ltr\" style=\"list-style-type: lower-alpha; font-size: 12pt; font-family: \'Times New Roman\',serif; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre;\" aria-level=\"1\">\n<p dir=\"ltr\" style=\"line-height: 1.7999999999999998; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\" role=\"presentation\"><span style=\"font-size: 12pt; font-family: \'Times New Roman\',serif; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">Part-Time English Teacher in Cakap (2021 - present)</span></p>\n</li>\n</ol>\n<p>&nbsp;</p>','<p dir=\"ltr\" style=\"line-height: 1.7999999999999998; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size: 12pt; font-family: \'Times New Roman\',serif; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">Leadership Experience (s)</span><span style=\"font-size: 12pt; font-family: \'Times New Roman\',serif; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\"><span class=\"Apple-tab-span\" style=\"white-space: pre;\"> </span></span><span style=\"font-size: 12pt; font-family: \'Times New Roman\',serif; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\"><span class=\"Apple-tab-span\" style=\"white-space: pre;\"> </span></span><span style=\"font-size: 12pt; font-family: \'Times New Roman\',serif; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">:&nbsp;&nbsp;</span></p>\n<ol style=\"margin-top: 0; margin-bottom: 0; padding-inline-start: 48px;\">\n<li dir=\"ltr\" style=\"list-style-type: lower-alpha; font-size: 12pt; font-family: \'Times New Roman\',serif; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre;\" aria-level=\"1\">\n<p dir=\"ltr\" style=\"line-height: 1.7999999999999998; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\" role=\"presentation\"><span style=\"font-size: 12pt; font-family: \'Times New Roman\',serif; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">Content Manager at Anonwimous (2021)</span></p>\n</li>\n<li dir=\"ltr\" style=\"list-style-type: lower-alpha; font-size: 12pt; font-family: \'Times New Roman\',serif; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre;\" aria-level=\"1\">\n<p dir=\"ltr\" style=\"line-height: 1.7999999999999998; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\" role=\"presentation\"><span style=\"font-size: 12pt; font-family: \'Times New Roman\',serif; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">Tutor&rsquo;s Assistant at Ethics Enrichment Program PCU (2019-2020)</span></p>\n</li>\n<li dir=\"ltr\" style=\"list-style-type: lower-alpha; font-size: 12pt; font-family: \'Times New Roman\',serif; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre;\" aria-level=\"1\">\n<p dir=\"ltr\" style=\"line-height: 1.7999999999999998; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\" role=\"presentation\"><span style=\"font-size: 12pt; font-family: \'Times New Roman\',serif; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">Frontline Division at Welcome Grateful Generation PCU (2018)</span></p>\n</li>\n<li dir=\"ltr\" style=\"list-style-type: lower-alpha; font-size: 12pt; font-family: \'Times New Roman\',serif; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre;\" aria-level=\"1\">\n<p dir=\"ltr\" style=\"line-height: 1.7999999999999998; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\" role=\"presentation\"><span style=\"font-size: 12pt; font-family: \'Times New Roman\',serif; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">Finance Division Coordinator at Rapat Akhir Pers Mahasiswa (2018)</span></p>\n</li>\n</ol>\n<p>&nbsp;</p>','<p dir=\"ltr\" style=\"line-height: 1.7999999999999998; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"font-size: 12pt; font-family: \'Times New Roman\',serif; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">Competition Experience (s)</span><span style=\"font-size: 12pt; font-family: \'Times New Roman\',serif; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\"><span class=\"Apple-tab-span\" style=\"white-space: pre;\"> </span></span><span style=\"font-size: 12pt; font-family: \'Times New Roman\',serif; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">:&nbsp;</span></p>\n<ol style=\"margin-top: 0; margin-bottom: 0; padding-inline-start: 48px;\">\n<li dir=\"ltr\" style=\"list-style-type: lower-alpha; font-size: 12pt; font-family: \'Times New Roman\',serif; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre;\" aria-level=\"1\">\n<p dir=\"ltr\" style=\"line-height: 1.7999999999999998; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\" role=\"presentation\"><span style=\"font-size: 12pt; font-family: \'Times New Roman\',serif; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">Won Originality Award at Lomba Nasional Konten Kreatif UKRIDA &amp; UK Maranatha 2020</span></p>\n</li>\n<li dir=\"ltr\" style=\"list-style-type: lower-alpha; font-size: 12pt; font-family: \'Times New Roman\',serif; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre;\" aria-level=\"1\">\n<p dir=\"ltr\" style=\"line-height: 1.7999999999999998; text-align: justify; margin-top: 0pt; margin-bottom: 0pt;\" role=\"presentation\"><span style=\"font-size: 12pt; font-family: \'Times New Roman\',serif; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;\">Top 15 Best Work at Creative Writing Weekend Workshop with Dee Lestari (2018)</span></p>\n</li>\n</ol>\n<p>&nbsp;</p>','2024-01-08 11:25:41','2024-01-08 11:25:41');
/*!40000 ALTER TABLE `tutors` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nickname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `mobile_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) unsigned DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `last_active_at` timestamp NULL DEFAULT NULL,
  `exist_status` enum('Aktif','Berhenti Sementara','Berhenti Permanen','Reaktivasi') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Aktif',
  `welcome_valid_until` timestamp NULL DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `city` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('TUTOR','ADMIN','MURID','WALI MURID','SUPERADMIN') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Kangen Menginspirasi','KASI','kangenmenginspirasi@gmail.com','2023-11-09 00:59:10',NULL,'$2y$12$VqFzY0ofCD.pDX6rE4Puk.tkx16Yv576JBhOqCvTi6ythBob9ZML6',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-09 00:23:42','2024-01-08 14:49:46','2020-06-24','2023-12-12 10:58:55','2024-01-08 14:49:46','Aktif',NULL,NULL,NULL,NULL,'kangen-menginspirasi','SUPERADMIN'),(3,'Matahari nadia wicaksono','Matahari','kangenmenginspirasi+2@gmail.com',NULL,'6282146055988','$2y$12$UY7PkDgw9vz1d2ywDTNScuYWCNsqZL9cum1rYHr/WR1H8vUeOIT3G',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-09 10:57:22','2024-01-08 12:22:36','2010-05-24',NULL,'2024-01-08 12:22:36','Aktif',NULL,'Jl. Penataran Sari 1A no. 14 Bali ',NULL,NULL,'matahari-nadia','MURID'),(5,'test','test','test@mail.com',NULL,NULL,'$2y$12$rKzuZhwc/1aN0oWCpKRkKOekia78SNgVz2qL/sQvskD8LFe5gatge',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-13 11:59:27','2023-11-13 11:59:27','2004-02-14',NULL,NULL,'Aktif',NULL,NULL,NULL,NULL,'test','MURID'),(11,'test 1','t1','test1@mail.com',NULL,NULL,'$2y$12$neZ20EuCWuMlGkMgmRdGXuWWVFksT7XXTsmMAW/X.27dHtyMnqp7a',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-13 13:08:00','2023-11-13 13:08:00','2004-02-14',NULL,NULL,'Aktif',NULL,NULL,NULL,NULL,'test-2','MURID'),(12,'Test 2','t2','test2@email.com',NULL,NULL,'$2y$12$/Dp7GXIkdX7OcX5KbBMro.xqb3aSQnaTD5LWV8w3meqMQfk6QfLzW',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-13 13:08:47','2024-01-03 04:03:30','2004-02-14',NULL,'2024-01-03 04:03:30','Aktif',NULL,NULL,NULL,NULL,'test2','MURID'),(33,'Marimba Marimbo','mambo','test@kasi.com',NULL,'62897458816','$2y$12$lok2bvfELF5q.Ip12VxUo.dp9sdYGXXfuw/z9050tR0XsWkr3rzsi',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-12 11:13:38','2023-12-30 22:03:39','2013-10-09',NULL,'2023-12-30 22:03:39','Aktif',NULL,NULL,NULL,NULL,'marimba-marimbo','MURID'),(37,'Samuel Franklin','Frank','frank@kasi.id',NULL,'62897456213','$2y$12$OOaqzDylRHlmATttKLilYeDFmC4V216.kdnEpTb85XIOLoTh5zoZe',NULL,NULL,NULL,NULL,NULL,'profile-photos/ul7UVecmWPMwRHTPNUwV31RLU5V6XbnNYLG2NhJY.jpg','2023-12-12 16:31:29','2023-12-13 11:09:01','2002-03-08',NULL,NULL,'Aktif','2023-12-13 16:31:29','Perumahan Tegal Besar Raya blok E5',NULL,NULL,'samuel-franklin','TUTOR'),(43,'Franklin Wijaya','Frewi','franklin@kasi.id',NULL,'62897452816','$2y$12$rWjzokG45EXDeDT7MhPWz.Kycn3ANSKMbuLKpSwfFVvXQVd80ft2e',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-13 10:29:11','2023-12-13 10:29:11','1995-05-15',NULL,NULL,'Aktif','2023-12-14 10:29:11','...',NULL,NULL,'franklin-wijaya','TUTOR'),(44,'Erny Wijayanti','Erny','erny@kasi.id','2023-12-20 12:24:15','6281234567',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-20 12:24:36','2023-12-20 13:44:24',NULL,NULL,NULL,'Aktif',NULL,'Perumahan Tegal Besar Raya blok J5',NULL,NULL,'erny-wali-murid','WALI MURID'),(47,'Sisca Romana','Sisca','sisca@kasi.id',NULL,'621554221','$2y$12$yA2blHC6z71MwRWDxLqLeeyNv7X5M6zX6phZO1pstm63Mt2S73Z4S',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-20 14:00:11','2023-12-20 14:00:11',NULL,NULL,NULL,'Aktif','2023-12-21 14:00:11','Denpasar',NULL,NULL,'sisca','WALI MURID'),(49,'Abraham Nararya','Abam','abam@kasi.id',NULL,NULL,'$2y$12$piCSxGnIGCk8v3AEu7nIOeLNjZEdJ9j8BrIaqZb6lr8WuHd70Rxjm',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-20 14:43:11','2023-12-30 22:00:24','2014-11-05',NULL,'2023-12-30 22:00:24','Aktif','2023-12-21 14:43:11',NULL,NULL,NULL,'abraham-nararya','MURID'),(50,'Vinna Moeljo',NULL,'vinna@wali.kasi.id',NULL,'628123383337','$2y$12$YIr0AqB6EpLefhnzz27DT.30PXtuvbScJsUnmuvi1FR9sUfQrw.tW',NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-03 11:10:33','2024-01-03 11:10:33',NULL,NULL,NULL,'Aktif','2024-01-04 11:10:33','Jl. Penataran Sari 1A no. 14, Bali',NULL,NULL,'vinna-moeljo',NULL),(52,'Levana Vivian Nurtanto','Levy','levnurtanto@gmail.com','2024-01-08 12:25:04','628118809900','$2y$12$W83vFG0RJYIup2YyYexJoe2G3MqlWrm.PINPnTx3d92oTx/Ciake2',NULL,NULL,NULL,NULL,NULL,'profile-photos/YhnwZgIDOwCvN7aConib6S0qvLljU7H9eCNfQByJ.png','2024-01-08 11:25:40','2024-01-09 08:16:43','1999-09-04',NULL,'2024-01-09 08:16:43','Aktif',NULL,'Taman Permata Sektor 5 Blok A7/47, Lippo Karawaci, Tangerang',NULL,NULL,'levana-vivian-nurtanto','TUTOR'),(53,'Graciella Eunike',NULL,'graciellaeunike@kasi.id',NULL,'6285171203018','$2y$12$lN8njg69PzPtaW0GJ9tLweUE6xVKUMRZ49KvEBP96aWHtnHMbjap6',NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-08 12:05:59','2024-01-08 12:05:59',NULL,NULL,NULL,'Aktif','2024-01-09 12:05:59',NULL,NULL,NULL,'graciella-eunike','WALI MURID'),(54,'Glenn Immanuel The','Glenn',NULL,NULL,'6281338423113','$2y$12$llsdR1bYKQ4IzC/Enbw0GeglVM2kxCK1P9c6xS1aVXKV39YpvnEUG',NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-08 12:13:58','2024-01-09 08:17:18','2014-12-06',NULL,'2024-01-09 08:17:18','Aktif',NULL,NULL,NULL,NULL,'glenn-immanuel-the','MURID');
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

