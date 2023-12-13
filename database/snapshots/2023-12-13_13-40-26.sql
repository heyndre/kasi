
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
INSERT INTO `sessions` VALUES ('gy1mB6mpve8eMO9BF8zBZXNah3IRgqnFloph4oYp',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:120.0) Gecko/20100101 Firefox/120.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoidHozTHNVRndwSWdLSEFqaFRCc0ZwR3hkQWpEVmVMdVFWTTNSSTFHZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTY6Imh0dHA6Ly9rYXNpLnRlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1702438460),('hzCalO3PlCSnnAR5yKi4vIFCcejbxwHEvdULUPy6',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:120.0) Gecko/20100101 Firefox/120.0','YTo2OntzOjY6Il90b2tlbiI7czo0MDoiMENJb0dpVTJSbGJKNU03dHhvTkpIS1hIU3FFeUIxMlhsSDlUcmxDYyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjE2OiJodHRwOi8va2FzaS50ZXN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMiRWcUZ6WTBvZkNELnBEWDZyRTRQdWsudGt4MTZZdjU3NkpCaE9xQ3ZUaTZ5dGhCb2I5Wk1MNiI7fQ==',1702438224),('MQYGByH8siVBZPwpzAvqARoKShSFSRmlKRiSn2Fc',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:120.0) Gecko/20100101 Firefox/120.0','YTo2OntzOjY6Il90b2tlbiI7czo0MDoidjRNQ2pHOERMTDMwSDFvc3FvenBRMDRNdnJRVDVhNUxaU2lnWEh0ZyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI4OiJodHRwOi8va2FzaS50ZXN0L3R1dG9yL2FrdGlmIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMiRWcUZ6WTBvZkNELnBEWDZyRTRQdWsudGt4MTZZdjU3NkpCaE9xQ3ZUaTZ5dGhCb2I5Wk1MNiI7fQ==',1702398803);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
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
  `guardian_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `has_guardian` tinyint(1) NOT NULL,
  `guardian_contact` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `edu_status` int(11) DEFAULT NULL,
  `edu_level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edu_site` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_site` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `base_user_student` (`user_id`),
  CONSTRAINT `base_user_student` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (1,NULL,'2023-12-12 10:17:39','2022110001',2,'Parent 1',1,'628536591422','Jl. Polda Sabari 24',1,'s1','Universitas LALALA','DMB','other'),(2,NULL,NULL,'2023100002',3,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,'2023-11-13 13:08:00','2023-11-13 13:08:00','2023110001',11,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,'2023-11-13 13:08:47','2023-11-13 13:08:47','2023110002',12,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(26,'2023-12-12 11:13:38','2023-12-12 11:13:38','2023120001',33,'Josephine',1,'16488755',NULL,1,'sd','SD Shinta',NULL,'unemployed');
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `tutor_skills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tutor_skills` (
  `id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `tutor_skills` WRITE;
/*!40000 ALTER TABLE `tutor_skills` DISABLE KEYS */;
INSERT INTO `tutor_skills` VALUES (1,'Matematika SD'),(2,'Matematika SMP'),(3,'Matematika SMA'),(4,'Bahasa Inggris SD'),(5,'Bahasa Inggris SMP'),(6,'Bahasa Inggris SMA'),(7,'IPA SD'),(8,'IPA SMP'),(9,'Kimia SMA'),(10,'Fisika SMA'),(11,'Fisika SMP'),(12,'Biologi SMP'),(13,'Biologi SMA'),(14,'General English'),(15,'English Preparation for TOEFL'),(16,'English Preparation for IELTS');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `tutor_skills_pivot` WRITE;
/*!40000 ALTER TABLE `tutor_skills_pivot` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `tutors` WRITE;
/*!40000 ALTER TABLE `tutors` DISABLE KEYS */;
INSERT INTO `tutors` VALUES (1,37,1,'Widya Mandala','s1',NULL,'unemployed',NULL,'2000706640','BCA',NULL,'Electrical Engineering','Kristen','playing online games, reading book, watching instagram','education, programming, teaching, playing','Hidup harus rendah hati dan saling mengasihi','<ol>\n<li>Teaching private class in Kasi (2020)</li>\n<li>Teaching my friends in senior and junior highschool</li>\n</ol>','<ol>\n<li>Class&rsquo; Captain in High School</li>\n<li>Class&rsquo; Captain in University</li>\n<li>Join an Student Organization in College</li>\n</ol>','<ol>\n<li>Won 4th-5th place at Lomba Fisika Se-Jember</li>\n<li>Awardee of OSC Scholarship 2019</li>\n</ol>','2023-12-12 16:31:30','2023-12-12 16:31:30');
/*!40000 ALTER TABLE `tutors` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Kangen Menginspirasi','kangenmenginspirasi@gmail.com','2023-11-09 00:59:10',NULL,'$2y$12$VqFzY0ofCD.pDX6rE4Puk.tkx16Yv576JBhOqCvTi6ythBob9ZML6',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-09 00:23:42','2023-12-13 03:30:24',NULL,'2023-12-12 10:58:55','2023-12-13 03:30:24','Aktif',NULL,NULL,NULL,NULL),(2,'Student 1','kangenmenginspirasi+1@gmail.com','2023-11-09 11:10:42','62854798569','$2y$12$7ZV8qPK5rhDh4/.xZt0iMOZsH6M9nC0GrRYysebeN5TOAzefiKXj6',NULL,NULL,NULL,NULL,NULL,'profile-photos/fHgZxEhH8EPBQrnh9AvLWqjhPoedRmNsnkqhVG6w.jpg','2023-11-09 10:30:18','2023-12-12 10:13:23','1999-02-09','2023-11-14 02:19:31','2023-11-14 02:42:48','Aktif',NULL,NULL,NULL,NULL),(3,'Matahari nadia wicaksono','kangenmenginspirasi+2@gmail.com',NULL,'62897458815','$2y$12$UY7PkDgw9vz1d2ywDTNScuYWCNsqZL9cum1rYHr/WR1H8vUeOIT3G',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-09 10:57:22','2023-11-09 10:57:22',NULL,NULL,NULL,'Berhenti Sementara',NULL,NULL,NULL,NULL),(5,'test','test@mail.com',NULL,NULL,'$2y$12$rKzuZhwc/1aN0oWCpKRkKOekia78SNgVz2qL/sQvskD8LFe5gatge',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-13 11:59:27','2023-11-13 11:59:27',NULL,NULL,NULL,'Aktif',NULL,NULL,NULL,NULL),(11,'test','test1@mail.com',NULL,NULL,'$2y$12$neZ20EuCWuMlGkMgmRdGXuWWVFksT7XXTsmMAW/X.27dHtyMnqp7a',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-13 13:08:00','2023-11-13 13:08:00',NULL,NULL,NULL,'Aktif',NULL,NULL,NULL,NULL),(12,'Test2','test2@email.com',NULL,NULL,'$2y$12$/Dp7GXIkdX7OcX5KbBMro.xqb3aSQnaTD5LWV8w3meqMQfk6QfLzW',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-13 13:08:47','2023-11-13 13:08:47',NULL,NULL,NULL,'Aktif',NULL,NULL,NULL,NULL),(33,'Marimba Marimbo','test@kasi.com',NULL,'62897458816','$2y$12$lok2bvfELF5q.Ip12VxUo.dp9sdYGXXfuw/z9050tR0XsWkr3rzsi',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-12 11:13:38','2023-12-12 11:18:17','2013-10-09',NULL,'2023-12-12 11:18:17','Aktif',NULL,NULL,NULL,NULL),(37,'Samuel Franklin','frank@kasi.id',NULL,'62897456213','$2y$12$OOaqzDylRHlmATttKLilYeDFmC4V216.kdnEpTb85XIOLoTh5zoZe',NULL,NULL,NULL,NULL,NULL,'profile-photos/PFQqvVTyF3NsqGeftI10BlcvvYv4kGoYosIguHT2.jpg','2023-12-12 16:31:29','2023-12-12 16:31:30','2002-03-08',NULL,NULL,'Aktif','2023-12-13 16:31:29',NULL,NULL,NULL);
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

