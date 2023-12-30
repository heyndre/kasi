
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
  `invoice_id` bigint(20) unsigned NOT NULL,
  `class_id` bigint(20) unsigned DEFAULT NULL,
  `student_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_billings_classes` (`class_id`),
  KEY `FK_billings_students` (`student_id`),
  CONSTRAINT `FK_billings_classes` FOREIGN KEY (`class_id`) REFERENCES `courses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_billings_students` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `billings` WRITE;
/*!40000 ALTER TABLE `billings` DISABLE KEYS */;
INSERT INTO `billings` VALUES (19,'2023-12-28 10:46:11','2023-12-28 14:34:19','2024-01-01','2024-01-11',210000.000000,1,NULL,6),(20,'2023-12-28 13:45:14','2023-12-28 13:45:14','2024-01-01','2024-01-11',50000.000000,2,NULL,2);
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
  `student_attendance` datetime DEFAULT NULL,
  `tutor_attendance` datetime DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (2,'2023-12-26 09:45:22','2023-12-28 13:45:14',2,5,1,20,'2023-12-26 10:30:00','2023-12-26 12:19:12','2023-12-26 10:28:14','Sistem Pernafasan Manusia',NULL,NULL,'[]',NULL,'Free trial Chelsea.png',60,50000),(3,'2023-12-26 09:45:22','2023-12-28 13:53:12',6,5,1,19,'2023-12-26 10:30:00','2023-12-26 12:19:12','2023-12-26 10:28:14',NULL,NULL,NULL,'[]',NULL,NULL,60,50000),(4,'2023-12-26 09:45:22','2023-12-28 14:34:19',6,1,3,19,'2023-12-26 11:00:00',NULL,NULL,'Gerund',NULL,NULL,'[]',NULL,NULL,60,50000),(5,'2023-12-26 09:45:22','2023-12-28 10:46:11',6,5,2,19,'2023-12-26 17:21:10','2023-12-26 17:21:12','2023-12-26 17:21:13','Something','Mauris vel erat pharetra, auctor risus molestie, volutpat eros. Sed cursus sem nec neque dignissim vulputate. Nullam a sodales augue. Ut iaculis viverra orci, sit amet tincidunt ex pulvinar non. Maecenas eu pretium dui, non elementum lectus. Aenean dapibus quam non porttitor elementum. Duis vitae lectus libero. Nulla facilisi. Aliquam efficitur dapibus iaculis. Ut a nibh vel nisl congue imperdiet. Duis aliquam ipsum ut quam molestie elementum. Vivamus risus tortor, commodo vel porttitor non, facilisis ut erat. Morbi volutpat, erat sit amet tempor vehicula, ipsum ligula convallis neque, id finibus purus leo ut risus. Vestibulum tempus purus in ligula accumsan suscipit. Fusce porta metus enim, nec finibus nibh malesuada eu.\r\n\r\nEtiam suscipit neque nec ex bibendum, sed consequat sem dignissim. Proin posuere arcu elit, condimentum dictum diam tincidunt at. Cras id molestie mauris, a feugiat sem. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec ex est, semper sit amet nisl ut, sagittis dictum odio. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas non condimentum quam, id eleifend risus. Fusce lorem ligula, consequat id pretium quis, dapibus sed lacus. Vestibulum volutpat orci ut mi bibendum, at placerat ipsum fermentum.\r\n\r\nNulla efficitur volutpat sapien ut viverra. Duis eu egestas felis, quis sollicitudin felis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Cras tincidunt nec leo aliquam eleifend. Nulla finibus, nisl vel sollicitudin iaculis, eros massa tempor ligula, lobortis tincidunt ipsum sem at sem. Morbi finibus facilisis erat hendrerit cursus. Phasellus ac laoreet elit. Etiam non posuere mauris.\r\n\r\nVestibulum eleifend blandit lobortis. Vestibulum justo arcu, fermentum sed lorem a, volutpat vehicula tortor. Aenean pellentesque semper erat, vel fringilla justo scelerisque quis. Aliquam sed risus urna. Aliquam varius risus mi, in viverra libero laoreet vitae. Vivamus laoreet molestie nulla, eget maximus neque pharetra eget. Morbi id urna facilisis, bibendum eros nec, vulputate lectus. Praesent dapibus posuere feugiat. Integer rhoncus nunc eu tellus mollis, non feugiat ex semper. Ut mollis placerat leo id suscipit. Duis blandit quam non lorem finibus, et molestie nisi rhoncus. Suspendisse sed neque nisi. Nullam id scelerisque leo, ut pulvinar libero. Maecenas condimentum enim nulla.\r\n\r\nIn enim turpis, lobortis id nisl ut, commodo auctor nibh. Maecenas sed viverra neque, at pellentesque arcu. Donec lobortis, sapien condimentum maximus suscipit, leo sem facilisis lorem, in imperdiet lectus dolor sed enim. Aenean laoreet orci et scelerisque vulputate. Nullam vel lectus urna. Vestibulum felis velit, facilisis eu auctor eu, ultrices sit amet nisl. Etiam tristique quis elit in elementum. Fusce pretium luctus felis, malesuada lobortis nulla condimentum eu. Fusce dictum nibh lectus, et pellentesque elit volutpat sed. Pellentesque eleifend nisl id dictum molestie. Cras luctus leo quis neque dapibus, ut placerat ipsum rhoncus. Nunc consequat blandit risus et pulvinar. Morbi sit amet enim condimentum elit feugiat mattis in non arcu. Quisque eget tempus leo, quis dignissim est. Quisque accumsan sollicitudin faucibus. ','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu auctor sem, vitae consectetur elit. Nulla laoreet ornare volutpat. Sed. ','[]',NULL,NULL,60,60000),(6,'2023-12-26 09:45:22','2023-12-28 13:55:47',6,5,1,19,'2023-12-31 10:30:00','2023-12-31 12:19:12','2023-12-31 10:28:14',NULL,NULL,NULL,'[]',NULL,NULL,60,50000);
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `expenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expenses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `spent_date` date NOT NULL,
  `due_date` date DEFAULT NULL,
  `information` varchar(1024) NOT NULL,
  `amount` decimal(20,6) NOT NULL,
  `additional_info` mediumtext,
  `tutor_id` bigint(20) unsigned NOT NULL,
  `student_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_expense_tutors` (`tutor_id`),
  KEY `FK__students` (`student_id`),
  CONSTRAINT `FK__students` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_expense_tutors` FOREIGN KEY (`tutor_id`) REFERENCES `tutors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `expenses` WRITE;
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;
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
  `religion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edu_level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edu_site` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edu_major` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_site` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `base_user_student` (`user_id`) USING BTREE,
  CONSTRAINT `guardians_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `guardians` WRITE;
/*!40000 ALTER TABLE `guardians` DISABLE KEYS */;
INSERT INTO `guardians` VALUES (27,NULL,'2023-12-20 13:49:00',44,1,'Kristen','Mahasiswa Jenjang S1',NULL,NULL,NULL,'housewife'),(29,'2023-12-20 14:00:11','2023-12-20 14:00:11',47,1,'Hindu','s1',NULL,NULL,NULL,'housewife');
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
  `duration` tinyint(3) unsigned NOT NULL,
  `price_per_unit` decimal(20,6) NOT NULL,
  `expire_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_packages_students` (`student_id`),
  CONSTRAINT `FK_packages_students` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `packages` WRITE;
/*!40000 ALTER TABLE `packages` DISABLE KEYS */;
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
  `pay_date` datetime NOT NULL,
  `confirm_date` datetime DEFAULT NULL,
  `amount` decimal(20,6) unsigned NOT NULL DEFAULT '0.000000',
  `pay_method` enum('package','bank_transfer','other') NOT NULL DEFAULT 'bank_transfer',
  `package_id` bigint(20) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK__billings` (`billing_id`),
  CONSTRAINT `FK__billings` FOREIGN KEY (`billing_id`) REFERENCES `billings` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
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
INSERT INTO `sessions` VALUES ('6V2uiTGSPSLZXDPJ5oPLZYQRpH7sUF3GrghqHFps',3,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiM0RCeWpsWW1lSEdvOXRUT0N1N2xSeWNxM2lrUnBGVWtaYldYOGN4QSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8va2FzaS50ZXN0L3VzZXIvcHJvZmlsZSI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7czoyMToicGFzc3dvcmRfaGFzaF9zYW5jdHVtIjtzOjYwOiIkMnkkMTIkVVk3UGtEZ3c5dnoxZDJ5d0RUTlNjdVlXQ05zcVpMOWN1bTFyWUhyL1dSMUg4dlVlT0lUM0ciO30=',1703974485),('qddfQ0zH8knNc3oTBPo5MsvMHGrLrl4uDPNriWti',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0','YTo2OntzOjY6Il90b2tlbiI7czo0MDoiSDlCSEdzRlQ4OUs5SENJTnRpdmhXdzY5ZU1hS0N1dnl1Ykp4aENYbCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly9rYXNpLnRlc3QvZGFzaGJvYXJkIjt9czo1OiJsb2dpbiI7YTowOnt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMiRWcUZ6WTBvZkNELnBEWDZyRTRQdWsudGt4MTZZdjU3NkpCaE9xQ3ZUaTZ5dGhCb2I5Wk1MNiI7fQ==',1703974604);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,NULL,NULL,'bill_due_date','10'),(2,NULL,NULL,'motto','Belajar Dulu, Menginspirasi Kemudian!'),(3,NULL,NULL,'app_nickname','KASI'),(4,NULL,NULL,'whatsapp','6285179824064');
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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (1,NULL,'2023-12-12 10:17:39','2022110001',2,1,NULL,'Jl. Polda Sabari 24',1,'s1','Universitas LALALA','DMB','other',NULL),(2,NULL,NULL,'2023100002',3,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,'2023-11-13 13:08:00','2023-11-13 13:08:00','2023110001',11,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,'2023-11-13 13:08:47','2023-11-13 13:08:47','2023110002',12,0,27,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(26,'2023-12-12 11:13:38','2023-12-20 14:21:41','2023120001',33,1,29,NULL,1,'sd','SD Shinta',NULL,'unemployed',NULL),(27,'2023-12-20 14:43:11','2023-12-20 14:43:11','2023120002',49,1,29,NULL,1,'sd','SPK SD CHIS Denpasar',NULL,'unemployed',NULL);
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
  `tutor_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `skill_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK__tutors` (`tutor_id`),
  KEY `FK_tutor_skills_pivot_tutor_skills` (`skill_id`),
  CONSTRAINT `FK__tutors` FOREIGN KEY (`tutor_id`) REFERENCES `tutors` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_tutor_skills_pivot_tutor_skills` FOREIGN KEY (`skill_id`) REFERENCES `tutor_skills` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `tutor_skills_pivot` WRITE;
/*!40000 ALTER TABLE `tutor_skills_pivot` DISABLE KEYS */;
INSERT INTO `tutor_skills_pivot` VALUES (1,0,5,13),(2,0,5,11),(3,0,1,15);
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `tutors` WRITE;
/*!40000 ALTER TABLE `tutors` DISABLE KEYS */;
INSERT INTO `tutors` VALUES (1,37,1,'Widya Mandala','s1',NULL,'freelance','non KASI','2000706640','BCA',NULL,'Electrical Engineering','Kristen','playing online games, reading book, watching instagram','education, programming, teaching, playing','Hidup harus rendah hati dan saling mengasihi','<ol>\n<li>Teaching private class in Kasi (2020)</li>\n<li>Teaching my friends in senior and junior highschool</li>\n</ol>','<ol>\n<li>Class&rsquo; Captain in High School</li>\n<li>Class&rsquo; Captain in University</li>\n<li>Join an Student Organization in College</li>\n</ol>','<ol>\n<li>Won 4th-5th place at Lomba Fisika Se-Jember</li>\n<li>Awardee of OSC Scholarship 2019</li>\n</ol>','2023-12-12 16:31:30','2023-12-13 11:19:37'),(5,43,1,'Universitas LALALA','s1',NULL,'unemployed',NULL,'2000706632','BCA',NULL,'Electrical Engineering','Kristen','playing online games, reading book, watching instagram','education, programming, teaching, playing','Hidup harus rendah hati dan saling mengasihi','<p>-</p>','<p>-</p>','<p>-</p>','2023-12-13 10:29:11','2023-12-13 10:29:11');
/*!40000 ALTER TABLE `tutors` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nickname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `role` enum('TUTOR','ADMIN','MURID','WALI MURID') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Kangen Menginspirasi','KASI','kangenmenginspirasi@gmail.com','2023-11-09 00:59:10',NULL,'$2y$12$VqFzY0ofCD.pDX6rE4Puk.tkx16Yv576JBhOqCvTi6ythBob9ZML6','eyJpdiI6ImhtK3l1Zzg1T2V3UE5ydGFOUnhrbWc9PSIsInZhbHVlIjoiWkM5ampjQlRYMWRhL21KdnAyOEtYWkZNQTJYQ29uRVJRb0JRRnNxQXQrOD0iLCJtYWMiOiJjYjhmOTczYWRjNzgyYzk0NDViMGRkMjcxYzIyYThhNzgwMmVkMmQ2NGMzMGIwNmRlMzI1Mjk0N2U1MWZjMTkyIiwidGFnIjoiIn0=','eyJpdiI6InZCSzlML1JQQmtJYTROWll6OVhjQmc9PSIsInZhbHVlIjoiRWF0RFFBc0Vnc1JHVWsvcm9PQzV5T1BZb2E3YXJNeVp1eDM5a1Jad0ZmMHZhZGVyNXd5MnFxMTlLem5pTUx6dmIyVTEyWUZMYzAwL1pCMHY0RzhvY3MrcXB2VTFxVUIxTENIblNjTnRQdEY4bU9tWlVJWW5NUUtyTGJxQnB3cXByTXdWWmVoWEkyalNDYzZndkgvNXpFbzMrNW10TXFiN2U2ODE3MEloK2szZUFMWFVmYU9rWG1wTWU4Y1NrZ1NLcW9adTBQVk9GZmZVOXV1YmYrL2FiaERPTzR6NmU3VkwwWGxjL2JPK1BxbEJTYTRMSFVGS3N2OFhnN2N6eWRuNmh2Y3c2bG45M3l2WkhGTGtzeFVlUFE9PSIsIm1hYyI6ImUwYTFlZTdlMThkZDkzNzg4NDdkZDM2NDFmNGVlODNkYjk5MmY2NTI4MmE2YjFkZmJhZTFkMTlhZDNkOWMwYTUiLCJ0YWciOiIifQ==','2023-12-30 22:15:46',NULL,NULL,NULL,'2023-11-09 00:23:42','2023-12-30 22:16:44','2020-06-24','2023-12-12 10:58:55','2023-12-30 22:16:44','Aktif',NULL,NULL,NULL,NULL,'kangen-menginspirasi','ADMIN'),(2,'Student 1','Student 1','kangenmenginspirasi+1@gmail.com','2023-11-09 11:10:42','62854798569','$2y$12$7ZV8qPK5rhDh4/.xZt0iMOZsH6M9nC0GrRYysebeN5TOAzefiKXj6',NULL,NULL,NULL,NULL,NULL,'profile-photos/fHgZxEhH8EPBQrnh9AvLWqjhPoedRmNsnkqhVG6w.jpg','2023-11-09 10:30:18','2023-12-12 10:13:23','1999-02-09','2023-11-14 02:19:31','2023-11-14 02:42:48','Aktif',NULL,NULL,NULL,NULL,'student-1','MURID'),(3,'Matahari nadia wicaksono','Matahari','kangenmenginspirasi+2@gmail.com',NULL,'62897458815','$2y$12$UY7PkDgw9vz1d2ywDTNScuYWCNsqZL9cum1rYHr/WR1H8vUeOIT3G',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-09 10:57:22','2023-12-30 22:14:44','2004-02-14',NULL,'2023-12-30 22:14:44','Berhenti Sementara',NULL,NULL,NULL,NULL,'matahari-nadia','MURID'),(5,'test','test','test@mail.com',NULL,NULL,'$2y$12$rKzuZhwc/1aN0oWCpKRkKOekia78SNgVz2qL/sQvskD8LFe5gatge',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-13 11:59:27','2023-11-13 11:59:27','2004-02-14',NULL,NULL,'Aktif',NULL,NULL,NULL,NULL,'test','MURID'),(11,'test 1','t1','test1@mail.com',NULL,NULL,'$2y$12$neZ20EuCWuMlGkMgmRdGXuWWVFksT7XXTsmMAW/X.27dHtyMnqp7a',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-13 13:08:00','2023-11-13 13:08:00','2004-02-14',NULL,NULL,'Aktif',NULL,NULL,NULL,NULL,'test-2','MURID'),(12,'Test 2','t2','test2@email.com',NULL,NULL,'$2y$12$/Dp7GXIkdX7OcX5KbBMro.xqb3aSQnaTD5LWV8w3meqMQfk6QfLzW',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-13 13:08:47','2023-11-13 13:08:47','2004-02-14',NULL,NULL,'Aktif',NULL,NULL,NULL,NULL,'test2','MURID'),(33,'Marimba Marimbo','mambo','test@kasi.com',NULL,'62897458816','$2y$12$lok2bvfELF5q.Ip12VxUo.dp9sdYGXXfuw/z9050tR0XsWkr3rzsi',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-12 11:13:38','2023-12-30 22:03:39','2013-10-09',NULL,'2023-12-30 22:03:39','Aktif',NULL,NULL,NULL,NULL,'marimba-marimbo','MURID'),(37,'Samuel Franklin','Frank','frank@kasi.id',NULL,'62897456213','$2y$12$OOaqzDylRHlmATttKLilYeDFmC4V216.kdnEpTb85XIOLoTh5zoZe',NULL,NULL,NULL,NULL,NULL,'profile-photos/ul7UVecmWPMwRHTPNUwV31RLU5V6XbnNYLG2NhJY.jpg','2023-12-12 16:31:29','2023-12-13 11:09:01','2002-03-08',NULL,NULL,'Berhenti Permanen','2023-12-13 16:31:29','Perumahan Tegal Besar Raya blok E5',NULL,NULL,'samuel-franklin','TUTOR'),(43,'Franklin Wijaya','Frewi','franklin@kasi.id',NULL,'62897452816','$2y$12$rWjzokG45EXDeDT7MhPWz.Kycn3ANSKMbuLKpSwfFVvXQVd80ft2e',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-13 10:29:11','2023-12-13 10:29:11','1995-05-15',NULL,NULL,'Aktif','2023-12-14 10:29:11','...',NULL,NULL,'franklin-wijaya','TUTOR'),(44,'Erny Wijayanti','Erny','erny@kasi.id','2023-12-20 12:24:15','6281234567',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-20 12:24:36','2023-12-20 13:44:24',NULL,NULL,NULL,'Aktif',NULL,'Perumahan Tegal Besar Raya blok J5',NULL,NULL,'erny-wali-murid','WALI MURID'),(47,'Sisca Romana','Sisca','sisca@kasi.id',NULL,'621554221','$2y$12$yA2blHC6z71MwRWDxLqLeeyNv7X5M6zX6phZO1pstm63Mt2S73Z4S',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-20 14:00:11','2023-12-20 14:00:11',NULL,NULL,NULL,'Aktif','2023-12-21 14:00:11','Denpasar',NULL,NULL,'sisca','WALI MURID'),(49,'Abraham Nararya','Abam','abam@kasi.id',NULL,NULL,'$2y$12$piCSxGnIGCk8v3AEu7nIOeLNjZEdJ9j8BrIaqZb6lr8WuHd70Rxjm',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-20 14:43:11','2023-12-30 22:00:24','2014-11-05',NULL,'2023-12-30 22:00:24','Aktif','2023-12-21 14:43:11',NULL,NULL,NULL,'abraham-nararya','MURID');
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

