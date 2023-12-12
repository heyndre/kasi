-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.39 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table kasi.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
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

-- Dumping data for table kasi.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table kasi.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kasi.migrations: ~6 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(5, '2014_10_12_000000_create_users_table', 1),
	(6, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(7, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
	(8, '2019_08_19_000000_create_failed_jobs_table', 1),
	(9, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(10, '2023_11_09_071958_create_sessions_table', 1),
	(11, '2023_11_09_172008_create_students_table', 2);

-- Dumping structure for table kasi.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kasi.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table kasi.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
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

-- Dumping data for table kasi.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table kasi.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
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

-- Dumping data for table kasi.sessions: ~2 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('OyDBsihG9uXbkvxrut58YdQOF6huYCnVRP2bwm3O', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:120.0) Gecko/20100101 Firefox/120.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiN3N2ZThuUW44SkxST0o2UUdtM1hUQURRUkRBcjdrSDY0dThxd3RZZCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1701480503),
	('X2emZzv5Xuh3hlrZNnBadvfighaEUZRypDvz69mr', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:120.0) Gecko/20100101 Firefox/120.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoic0ZNYnljeEdnOGl0eXVYZ2VjM3MzUTRsZEtaQ0k1THpzRzk0TTQ1MiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9rYXNpLnRlc3QvbXVyaWQvZGF0YS8yMDIyMTEwMDAxIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMiRWcUZ6WTBvZkNELnBEWDZyRTRQdWsudGt4MTZZdjU3NkpCaE9xQ3ZUaTZ5dGhCb2I5Wk1MNiI7fQ==', 1701480934);

-- Dumping structure for table kasi.students
CREATE TABLE IF NOT EXISTS `students` (
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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kasi.students: ~7 rows (approximately)
INSERT INTO `students` (`id`, `created_at`, `updated_at`, `nim`, `user_id`, `guardian_name`, `has_guardian`, `guardian_contact`, `address`, `edu_status`, `edu_level`, `edu_site`, `work_site`, `work_title`) VALUES
	(1, NULL, '2023-11-29 02:45:07', '2022110001', 2, 'Parent 1', 0, '628536591422', 'Jl. Polda Sabari 24', 1, 's1', NULL, 'DMB', 'other'),
	(2, NULL, NULL, '2023100002', 3, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(5, '2023-11-13 13:08:00', '2023-11-13 13:08:00', '2023110001', 11, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(6, '2023-11-13 13:08:47', '2023-11-13 13:08:47', '2023110002', 12, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(7, '2023-11-13 13:11:14', '2023-11-13 13:11:14', '2023110003', 13, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(8, '2023-11-27 09:33:49', '2023-11-27 09:33:49', '2023110004', 14, 'MMM', 1, '313313313', NULL, 1, 's2', 'Universitas LALALA', NULL, 'other'),
	(22, '2023-11-29 02:15:55', '2023-11-29 02:15:55', '2023110005', 29, NULL, 0, NULL, NULL, 1, NULL, NULL, NULL, 'unemployed');

-- Dumping structure for table kasi.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `mobile_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kasi.users: ~8 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `mobile_number`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`, `birthday`, `last_login_at`, `last_active_at`, `exist_status`) VALUES
	(1, 'Kangen Menginspirasi', 'kangenmenginspirasi@gmail.com', '2023-11-09 00:59:10', NULL, '$2y$12$VqFzY0ofCD.pDX6rE4Puk.tkx16Yv576JBhOqCvTi6ythBob9ZML6', NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-09 00:23:42', '2023-12-02 01:35:34', NULL, '2023-12-02 00:55:55', '2023-12-02 01:35:34', 'Aktif'),
	(2, 'Student 1', 'kangenmenginspirasi+1@gmail.com', '2023-11-09 11:10:42', '62854798569', '$2y$12$7ZV8qPK5rhDh4/.xZt0iMOZsH6M9nC0GrRYysebeN5TOAzefiKXj6', NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-09 10:30:18', '2023-12-02 01:33:37', '1999-02-09', '2023-11-14 02:19:31', '2023-11-14 02:42:48', 'Aktif'),
	(3, 'Matahari nadia wicaksono', 'kangenmenginspirasi+2@gmail.com', NULL, '62897458815', '$2y$12$UY7PkDgw9vz1d2ywDTNScuYWCNsqZL9cum1rYHr/WR1H8vUeOIT3G', NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-09 10:57:22', '2023-11-09 10:57:22', NULL, NULL, NULL, 'Berhenti Sementara'),
	(5, 'test', 'test@mail.com', NULL, NULL, '$2y$12$rKzuZhwc/1aN0oWCpKRkKOekia78SNgVz2qL/sQvskD8LFe5gatge', NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-13 11:59:27', '2023-11-13 11:59:27', NULL, NULL, NULL, 'Aktif'),
	(11, 'test', 'test1@mail.com', NULL, NULL, '$2y$12$neZ20EuCWuMlGkMgmRdGXuWWVFksT7XXTsmMAW/X.27dHtyMnqp7a', NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-13 13:08:00', '2023-11-13 13:08:00', NULL, NULL, NULL, 'Aktif'),
	(12, 'Test2', 'test2@email.com', NULL, NULL, '$2y$12$/Dp7GXIkdX7OcX5KbBMro.xqb3aSQnaTD5LWV8w3meqMQfk6QfLzW', NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-13 13:08:47', '2023-11-13 13:08:47', NULL, NULL, NULL, 'Aktif'),
	(13, 'Test3', 'test@multi.com', NULL, '1515123', '$2y$12$HQkYCDP8/HKCJqVtg61z8e738phpHnPhtWerlYIFtLGBabYd7vF8u', NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-13 13:11:14', '2023-11-13 13:11:14', NULL, NULL, NULL, 'Aktif'),
	(14, 'NNN', 'testing@gmail.com', NULL, '123123123', '$2y$12$4WOMnYdWCu9zCjj/LRpwF.X0IuigWVK4pJ.Z00JJb3tevFVUf2SEy', NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-27 09:33:49', '2023-11-27 09:33:49', NULL, NULL, NULL, 'Aktif'),
	(29, 'Logo s', 'test@kasi.com', NULL, '62897458816', '$2y$12$jMsmA1eHXYqImfBUeOUK2eGH8m/oDyZqb2VrmBDbaRLZsSzdtO486', NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-29 02:15:55', '2023-11-29 02:15:55', '2023-11-08', NULL, NULL, 'Aktif');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
