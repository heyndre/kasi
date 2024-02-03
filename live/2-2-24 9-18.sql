-- --------------------------------------------------------
-- Host:                         103.181.183.61
-- Server version:               5.7.43-log - Source distribution
-- Server OS:                    Linux
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

-- Dumping structure for table kasi_edu.announcements
CREATE TABLE IF NOT EXISTS `announcements` (
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

-- Dumping data for table kasi_edu.announcements: ~0 rows (approximately)

-- Dumping structure for table kasi_edu.billings
CREATE TABLE IF NOT EXISTS `billings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `bill_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `amount_no_promo` decimal(20,6) NOT NULL,
  `promo_code` varchar(50) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table kasi_edu.billings: ~5 rows (approximately)
INSERT INTO `billings` (`id`, `created_at`, `updated_at`, `bill_date`, `due_date`, `amount_no_promo`, `promo_code`, `amount`, `length`, `invoice_id`, `class_id`, `student_id`) VALUES
	(1, '2024-01-31 16:24:24', '2024-01-31 16:24:31', '2024-02-01', '2024-02-11', 12000.000000, NULL, 12000.000000, 60, 1, NULL, 55),
	(3, '2024-01-31 16:56:46', '2024-01-31 17:02:49', '2024-02-01', '2024-02-11', 330000.000000, '10UNTUK10', 297000.000000, 330, 2, NULL, 41),
	(4, '2024-01-31 17:12:45', '2024-01-31 17:17:34', '2024-02-01', '2024-02-11', 60000.000000, '10UNTUK10', 54000.000000, 90, 3, NULL, 33),
	(8, '2024-01-31 17:27:36', '2024-02-01 00:59:47', '2024-02-01', '2024-02-11', 240000.000000, '10UNTUK10', 216000.000000, 240, 4, NULL, 34),
	(10, '2024-01-31 17:50:54', '2024-02-01 01:00:33', '2024-02-01', '2024-02-11', 120000.000000, '10UNTUK10', 108000.000000, 120, 5, NULL, 46),
	(11, '2024-01-31 17:55:43', '2024-02-01 01:01:04', '2024-03-01', '2024-03-11', 70000.000000, '10UNTUK10', 63000.000000, 60, 6, NULL, 52),
	(12, '2024-01-31 17:56:01', '2024-02-01 01:01:27', '2024-03-01', '2024-03-11', 60000.000000, '10UNTUK10', 54000.000000, 60, 7, NULL, 51),
	(13, '2024-01-31 18:01:50', '2024-02-01 01:01:51', '2024-02-01', '2024-02-11', 180000.000000, '10UNTUK10', 162000.000000, 180, 8, NULL, 44),
	(14, '2024-02-01 00:11:31', '2024-02-01 01:02:13', '2024-02-01', '2024-02-11', 125000.000000, '10UNTUK10', 112500.000000, 150, 9, NULL, 54),
	(15, '2024-02-01 00:13:10', '2024-02-01 00:13:10', '2024-02-01', '2024-02-11', 12000.000000, NULL, 12000.000000, 60, 10, NULL, 53),
	(16, '2024-02-01 00:27:29', '2024-02-01 01:02:43', '2024-02-01', '2024-02-11', 170000.000000, '10UNTUK10', 153000.000000, 120, 11, NULL, 42),
	(17, '2024-02-01 00:27:32', '2024-02-01 01:03:08', '2024-03-01', '2024-03-11', 340000.000000, '10UNTUK10', 306000.000000, 60, 12, NULL, 43),
	(19, '2024-02-01 00:31:45', '2024-02-01 01:03:29', '2024-02-01', '2024-02-11', 180000.000000, '10UNTUK10', 162000.000000, 180, 13, NULL, 50),
	(20, '2024-02-01 00:39:20', '2024-02-01 01:03:48', '2024-02-01', '2024-02-11', 75000.000000, '10UNTUK10', 67500.000000, 90, 14, NULL, 45),
	(21, '2024-02-01 00:44:27', '2024-02-01 01:04:21', '2024-02-01', '2024-02-11', 240000.000000, '10UNTUK10', 216000.000000, 240, 15, NULL, 35),
	(22, '2024-02-01 00:52:28', '2024-02-01 05:11:38', '2024-02-01', '2024-02-11', 360000.000000, '10UNTUK10', 333000.000000, 360, 16, NULL, 40);

-- Dumping structure for table kasi_edu.courses
CREATE TABLE IF NOT EXISTS `courses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `student_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `tutor_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `course_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `billing_id` bigint(20) unsigned DEFAULT NULL,
  `tutor_payment_id` bigint(20) unsigned DEFAULT NULL,
  `date_of_event` datetime DEFAULT NULL,
  `student_attendance` datetime DEFAULT NULL,
  `tutor_attendance` datetime DEFAULT NULL,
  `tutor_finish_confirm` datetime DEFAULT NULL,
  `status` enum('CONDUCTED','CANCELLED','BURNED','WAITING','RUNNING','NEEDCONFIRMATION') NOT NULL DEFAULT 'WAITING',
  `topic` varchar(1024) DEFAULT NULL,
  `meeting_link` varchar(1024) DEFAULT NULL,
  `lesson_matter` longtext,
  `tutor_notes` longtext,
  `tutor_notes_to_admin` longtext,
  `additional_links` json DEFAULT NULL,
  `files` json DEFAULT NULL,
  `recording` varchar(1024) DEFAULT NULL,
  `recording_youtube` varchar(1024) DEFAULT NULL,
  `photo` varchar(1024) DEFAULT NULL,
  `length` tinyint(3) unsigned DEFAULT NULL,
  `free_trial` tinyint(3) NOT NULL DEFAULT '0',
  `price` mediumint(8) unsigned DEFAULT NULL,
  `price_idr` mediumint(8) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_class_tutors` (`tutor_id`),
  KEY `FK_class_students` (`student_id`),
  KEY `billing_id` (`billing_id`),
  KEY `FK_class_tutor_skills` (`course_id`),
  KEY `FK_courses_tutor_payment_sharing` (`tutor_payment_id`),
  CONSTRAINT `FK_class_students` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_class_tutor_skills` FOREIGN KEY (`course_id`) REFERENCES `tutor_skills` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_class_tutors` FOREIGN KEY (`tutor_id`) REFERENCES `tutors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_courses_billings` FOREIGN KEY (`billing_id`) REFERENCES `billings` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_courses_tutor_payment_sharing` FOREIGN KEY (`tutor_payment_id`) REFERENCES `tutor_payment_sharing` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table kasi_edu.courses: ~62 rows (approximately)
INSERT INTO `courses` (`id`, `created_at`, `updated_at`, `student_id`, `tutor_id`, `course_id`, `billing_id`, `tutor_payment_id`, `date_of_event`, `student_attendance`, `tutor_attendance`, `tutor_finish_confirm`, `status`, `topic`, `meeting_link`, `lesson_matter`, `tutor_notes`, `tutor_notes_to_admin`, `additional_links`, `files`, `recording`, `recording_youtube`, `photo`, `length`, `free_trial`, `price`, `price_idr`) VALUES
	(2, '2024-01-31 16:14:20', '2024-02-02 02:05:07', 55, 11, 17, 1, 56, '2024-01-02 12:00:00', '2024-01-02 12:00:00', '2024-01-02 12:05:00', '2024-01-02 12:05:00', 'CONDUCTED', 'Describing a picture', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 30, 0, 12000, 85000),
	(3, '2024-01-31 16:14:20', '2024-02-02 02:05:07', 55, 11, 17, 1, 57, '2024-01-04 12:00:00', '2024-01-04 12:00:00', '2024-01-04 12:05:00', '2024-01-02 12:05:00', 'CONDUCTED', 'Describing a picture', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 30, 0, 12000, 85000),
	(4, '2024-01-31 16:41:53', '2024-02-02 02:05:07', 41, 11, 5, 3, 58, '2024-01-08 12:00:00', '2024-01-08 12:00:00', '2024-01-08 12:00:00', '2024-01-08 12:00:00', 'CONDUCTED', 'Passive & Active Voice', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 60000, 60000),
	(5, '2024-01-31 16:47:33', '2024-02-02 02:05:07', 41, 11, 5, 3, 59, '2024-01-15 12:00:00', '2024-01-15 12:00:00', '2024-01-15 12:00:00', '2024-01-15 00:00:00', 'CONDUCTED', 'Life Science : Immune System', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 60000, 60000),
	(6, '2024-01-31 16:48:08', '2024-02-02 02:05:07', 41, 11, 5, 3, 60, '2024-01-17 12:00:00', '2024-01-17 12:00:00', '2024-01-17 12:00:00', '2024-01-17 00:00:00', 'CONDUCTED', 'Life Science : Turmeric as anti inflammatory', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 60000, 60000),
	(7, '2024-01-31 16:48:39', '2024-02-02 02:05:07', 41, 11, 5, 3, 61, '2024-01-22 12:00:00', '2024-01-22 12:00:00', '2024-01-22 12:00:00', '2024-01-22 12:00:00', 'CONDUCTED', 'Life Science : Turmeric as anti inflammatory', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 60000, 60000),
	(8, '2024-01-31 16:49:11', '2024-02-02 02:05:08', 41, 11, 5, 3, 62, '2024-01-23 12:00:00', '2024-01-23 12:00:00', '2024-01-23 12:00:00', '2024-01-23 12:00:00', 'CONDUCTED', 'Turmeric', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 90, 0, 60000, 60000),
	(10, '2024-01-31 17:08:33', '2024-02-02 02:05:08', 33, 11, 14, 4, 63, '2024-01-10 12:00:00', '2024-01-10 12:00:00', '2024-01-10 12:00:00', '2024-01-10 12:00:00', 'CONDUCTED', 'Introduction', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 30, 1, 60000, 60000),
	(11, '2024-01-31 17:11:21', '2024-02-02 02:05:08', 33, 11, 14, 4, 64, '2024-01-19 12:00:00', '2024-01-19 12:00:00', '2024-01-19 12:00:00', '2024-01-19 12:00:00', 'CONDUCTED', 'Suffixes', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 60000, 60000),
	(12, '2024-01-31 17:21:01', '2024-02-02 02:05:08', 34, 11, 19, 8, 65, '2024-01-17 12:00:00', '2024-01-17 12:00:00', '2024-01-17 12:00:00', '2024-01-17 12:00:00', 'CONDUCTED', 'SIMOC P4', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 60000, 60000),
	(13, '2024-01-31 17:21:45', '2024-02-02 02:05:08', 34, 11, 19, 8, 66, '2024-01-19 12:00:00', NULL, '2024-01-19 12:00:00', '2024-01-19 12:00:00', 'BURNED', '-', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, 'Murid tidak hadir sesuai jadwal pelaksanaan', NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 60000, 60000),
	(14, '2024-01-31 17:22:26', '2024-02-02 02:05:08', 34, 11, 19, 8, 67, '2024-01-24 12:00:00', '2024-01-24 12:00:00', '2024-01-24 12:00:00', '2024-01-24 12:00:00', 'CONDUCTED', 'SIMOC P4', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 60000, 60000),
	(15, '2024-01-31 17:22:49', '2024-02-02 02:05:08', 34, 11, 19, 8, 68, '2024-01-31 12:00:00', '2024-01-31 12:00:00', '2024-01-31 12:00:00', '2024-01-31 12:00:00', 'CONDUCTED', 'SIMOC P5 + SASMO 2020', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 60000, 60000),
	(16, '2024-01-31 17:47:20', '2024-02-02 02:05:09', 46, 13, 2, 10, 79, '2024-01-23 12:00:00', '2024-01-23 12:00:00', '2024-01-23 12:00:00', '2024-01-23 12:00:00', 'CONDUCTED', 'Perbandingan', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 60000, 60000),
	(17, '2024-01-31 17:49:25', '2024-02-02 02:05:09', 46, 13, 2, 10, 80, '2024-01-29 12:00:00', '2024-01-29 12:00:00', '2024-01-29 12:00:00', '2024-01-29 12:00:00', 'CONDUCTED', 'Perbandingan', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 60000, 60000),
	(18, '2024-01-31 17:51:52', '2024-02-02 02:05:09', 51, 13, 2, 12, 81, '2024-01-30 12:00:00', '2024-01-30 12:00:00', '2024-01-30 12:00:00', '2024-01-30 12:00:00', 'CONDUCTED', 'Himpunan', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 60000, 60000),
	(19, '2024-01-31 17:54:58', '2024-02-02 02:05:09', 52, 13, 20, 11, 82, '2024-01-30 12:00:00', '2024-01-30 12:00:00', '2024-01-30 12:00:00', '2024-01-30 12:00:00', 'CONDUCTED', 'Fraction', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 70000, 70000),
	(20, '2024-01-31 17:59:15', '2024-02-02 02:05:05', 44, 9, 21, 13, 49, '2024-01-10 12:00:00', '2024-01-10 12:00:00', '2024-01-10 12:00:00', '2024-01-10 12:00:00', 'CONDUCTED', 'P5 Unit 6 Discussion: Poetic License', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 60000, 60000),
	(21, '2024-01-31 17:59:39', '2024-02-02 02:05:05', 44, 9, 21, 13, 50, '2024-01-17 12:00:00', '2024-01-17 12:00:00', '2024-01-17 12:00:00', '2024-01-17 12:00:00', 'CONDUCTED', 'P5 Unit 6 Discussion: Cinquain Poem, Spelling Bee', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 60000, 60000),
	(22, '2024-01-31 18:00:21', '2024-02-02 02:05:05', 44, 9, 21, 13, 51, '2024-01-24 12:00:00', '2024-01-24 12:00:00', '2024-01-24 12:00:00', '2024-01-24 12:00:00', 'CONDUCTED', 'P5 Unit 6 Test Review: Limericks, Cinquain Poems, Poetic License, Homophones and Homonyms', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 60000, 60000),
	(23, '2024-02-01 00:09:04', '2024-02-02 02:05:05', 54, 9, 4, 14, 52, '2024-01-11 12:00:00', '2024-01-11 12:00:00', '2024-01-11 12:00:00', '2024-01-11 12:00:00', 'CONDUCTED', 'General English Kids Beginner Lesson 11 - My House', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 50000, 50000),
	(24, '2024-02-01 00:09:45', '2024-02-02 02:05:05', 54, 9, 4, 14, 53, '2024-01-20 12:00:00', '2024-01-20 12:00:00', '2024-01-20 12:00:00', '2024-01-20 12:00:00', 'CONDUCTED', 'General English Kids Beginner Lesson 11 - My House', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 30, 0, 50000, 50000),
	(25, '2024-02-01 00:10:17', '2024-02-02 02:05:05', 54, 9, 4, 14, 54, '2024-01-25 12:00:00', '2024-01-25 12:00:00', '2024-01-25 12:00:00', '2024-01-25 12:00:00', 'CONDUCTED', 'General English Kids Beginner Lesson 11 - My House', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 50000, 50000),
	(26, '2024-02-01 00:12:34', '2024-02-02 02:05:05', 53, 9, 17, 15, 55, '2024-01-18 12:00:00', '2024-01-18 12:00:00', '2024-01-18 12:00:00', '2024-01-18 12:00:00', 'CONDUCTED', 'Free Conversation: Investments, Master\'s Degree, International and Korean Age', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 12000, 85000),
	(27, '2024-02-01 00:17:22', '2024-02-02 02:05:11', 42, 15, 14, 16, 91, '2024-01-13 12:00:00', '2024-01-13 12:00:00', '2024-01-13 12:00:00', '2024-01-13 12:00:00', 'CONDUCTED', 'Conversation Skills: Discussing about New Year', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 85000, 85000),
	(28, '2024-02-01 00:17:58', '2024-02-02 02:05:11', 42, 15, 14, 16, 92, '2024-01-27 12:00:00', '2024-01-27 12:00:00', '2024-01-27 12:00:00', '2024-01-27 12:00:00', 'CONDUCTED', 'Conversation Skills: Discussing about University Policies and Systems', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 85000, 85000),
	(29, '2024-02-01 00:19:30', '2024-02-02 02:05:11', 43, 15, 14, 17, 93, '2024-01-13 12:00:00', '2024-01-13 12:00:00', '2024-01-13 12:00:00', '2024-01-13 12:00:00', 'CONDUCTED', 'Discussing Concerns for the Tutoring', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 85000, 85000),
	(30, '2024-02-01 00:24:15', '2024-02-02 02:05:11', 43, 15, 14, 17, 94, '2024-01-20 12:00:00', '2024-01-20 12:00:00', '2024-01-20 12:00:00', '2024-01-20 12:00:00', 'CONDUCTED', 'Practicing English Grammar: Multiple Choice and Fill in the Blanks', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 85000, 85000),
	(31, '2024-02-01 00:24:42', '2024-02-02 02:05:11', 43, 15, 14, 17, 95, '2024-01-27 12:00:00', '2024-01-27 12:00:00', '2024-01-27 12:00:00', '2024-01-27 12:00:00', 'CONDUCTED', 'Practicing English Grammar: Fill in the Blanks', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 85000, 85000),
	(32, '2024-02-01 00:25:01', '2024-02-02 02:05:11', 43, 15, 14, 17, 96, '2024-01-28 12:00:00', '2024-01-28 12:00:00', '2024-01-28 12:00:00', '2024-01-28 12:00:00', 'CONDUCTED', 'Practicing English Grammar: Fill in the Blanks', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 85000, 85000),
	(33, '2024-02-01 00:30:58', '2024-02-02 02:05:08', 50, 12, 5, 19, 70, '2024-01-22 12:00:00', '2024-01-22 12:00:00', '2024-01-22 12:00:00', '2024-01-22 12:00:00', 'CONDUCTED', 'Present Perfect Tense', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 60000, 60000),
	(34, '2024-02-01 00:34:49', '2024-02-02 02:05:08', 45, 12, 4, 20, 71, '2024-01-18 12:00:00', '2024-01-18 12:00:00', '2024-01-18 12:00:00', '2024-01-18 12:00:00', 'CONDUCTED', 'Answering the Writing Test', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 30, 0, 50000, 50000),
	(35, '2024-02-01 00:35:12', '2024-02-02 02:05:08', 45, 12, 4, 20, 72, '2024-01-23 12:00:00', '2024-01-23 12:00:00', '2024-01-23 12:00:00', '2024-01-23 12:00:00', 'CONDUCTED', 'Practice : Speaking', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 30, 0, 50000, 50000),
	(36, '2024-02-01 00:36:43', '2024-02-02 02:05:08', 45, 12, 4, 20, 73, '2024-01-25 12:00:00', '2024-01-25 12:00:00', '2024-01-25 12:00:00', '2024-01-25 12:00:00', 'CONDUCTED', 'Practice : Simple Past Tense', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 30, 0, 50000, 50000),
	(37, '2024-02-01 00:40:13', '2024-02-02 02:05:08', 35, 12, 5, 21, 74, '2024-01-16 12:00:00', '2024-01-16 12:00:00', '2024-01-16 12:00:00', '2024-01-16 12:00:00', 'CONDUCTED', 'Practice speaking + writing Positive Degree', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 60000, 60000),
	(38, '2024-02-01 00:40:34', '2024-02-02 02:05:08', 35, 12, 5, 21, 75, '2024-01-18 12:00:00', '2024-01-18 12:00:00', '2024-01-18 12:00:00', '2024-01-18 12:00:00', 'CONDUCTED', 'Practice writing and speaking Positive degree and Comparative degree', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 60000, 60000),
	(39, '2024-02-01 00:40:57', '2024-02-02 02:05:08', 35, 12, 5, 21, 76, '2024-01-23 12:00:00', '2024-01-23 12:00:00', '2024-01-23 12:00:00', '2024-01-23 12:00:00', 'CONDUCTED', 'Practice writing positive degree + comparative degree', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 60000, 60000),
	(40, '2024-02-01 00:41:34', '2024-02-02 02:05:08', 35, 12, 5, 21, 77, '2024-01-27 12:00:00', '2024-01-27 12:00:00', '2024-01-27 12:00:00', '2024-01-27 12:00:00', 'CONDUCTED', 'Practice writing comparative degree', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 30, 0, 60000, 60000),
	(41, '2024-02-01 00:42:01', '2024-02-02 02:05:09', 35, 12, 5, 21, 78, '2024-01-30 12:00:00', '2024-01-30 12:00:00', '2024-01-30 12:00:00', '2024-01-30 12:00:00', 'CONDUCTED', 'Practice writing comparative degree', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 30, 0, 60000, 60000),
	(42, '2024-02-01 00:46:30', '2024-02-02 02:05:10', 40, 14, 2, 22, 83, '2024-01-07 12:00:00', '2024-01-07 12:00:00', '2024-01-07 12:00:00', '2024-01-07 12:00:00', 'CONDUCTED', 'Persamaan Garis Lurus (PGL)', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 60000, 60000),
	(43, '2024-02-01 00:47:18', '2024-02-02 02:05:10', 40, 14, 2, 22, 84, '2024-01-12 12:00:00', NULL, '2024-01-12 12:00:00', '2024-01-12 12:00:00', 'BURNED', 'Murid tidak hadir sesuai jadwal yang telah disepakati', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 60000, 60000),
	(44, '2024-02-01 00:48:35', '2024-02-02 02:05:10', 40, 14, 2, 22, 85, '2024-01-13 12:00:00', '2024-01-13 12:00:00', '2024-01-13 12:00:00', '2024-01-13 12:00:00', 'CONDUCTED', 'Persamaan Garis Lurus (PGL)', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 60000, 60000),
	(45, '2024-02-01 00:49:01', '2024-02-02 02:05:10', 40, 14, 2, 22, 86, '2024-01-21 12:00:00', '2024-01-21 12:00:00', '2024-01-21 12:00:00', '2024-01-21 12:00:00', 'CONDUCTED', 'Persamaan Garis Lurus (PGL)', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 60000, 60000),
	(46, '2024-02-01 00:51:17', '2024-02-02 02:05:10', 40, 14, 2, 22, 87, '2024-01-25 12:00:00', '2024-01-25 12:00:00', '2024-01-25 12:00:00', '2024-01-25 12:00:00', 'CONDUCTED', 'Persamaan Garis Lurus (PGL)', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 60000, 60000),
	(47, '2024-02-01 00:53:46', '2024-02-02 02:05:10', 50, 14, 2, 19, 88, '2024-01-18 12:00:00', '2024-01-18 12:00:00', '2024-01-18 12:00:00', '2024-01-18 12:00:00', 'CONDUCTED', 'Kekongruenan dan Kesebangunan', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 60000, 60000),
	(48, '2024-02-01 00:54:06', '2024-02-02 02:05:10', 50, 14, 2, 19, 89, '2024-01-25 12:00:00', '2024-01-25 12:00:00', '2024-01-25 12:00:00', '2024-01-25 12:00:00', 'CONDUCTED', 'Kekongruenan dan Kesebangunan', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 60000, 60000),
	(49, '2024-02-01 01:40:58', '2024-02-02 02:05:08', 34, 11, 19, NULL, 69, '2024-02-01 15:00:00', '2024-02-01 15:06:17', '2024-02-01 14:58:10', '2024-02-01 16:02:17', 'CONDUCTED', 'SASMO G3 2020', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', '', NULL, '- Abam perlu lebih fokus dan mendengarkan, jangan terburu-buru skip atau menebak-nebak ketika ada soal yang perlu ketelitian (ex: menghitung jumlah bangun pada gambar)\n- Ada kesalahan teknis sedikit sehingga mengganggu konsentrasi abam tadi', '"[\\"https:\\\\/\\\\/drive.google.com\\\\/file\\\\/d\\\\/1wLYmRYzRVwRVZTn6-U1TkG8crWsfu-K1\\\\/view?usp=drive_link\\"]"', NULL, NULL, NULL, 'Meeting-00049', 60, 0, 60000, 60000),
	(50, '2024-02-01 01:41:26', '2024-02-01 01:41:26', 33, 11, 14, NULL, NULL, '2024-02-02 19:00:00', NULL, NULL, NULL, 'WAITING', NULL, 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 85000, 85000),
	(51, '2024-02-01 05:10:50', '2024-02-02 02:05:10', 40, 14, 2, 22, 90, '2024-01-28 12:00:00', '2024-01-28 12:00:00', '2024-01-28 12:00:00', '2024-01-28 12:00:00', 'CONDUCTED', 'Persamaan Garis Lurus (PGL)', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 60000, 60000),
	(52, '2024-02-01 05:14:01', '2024-02-01 05:14:01', 46, 13, 2, NULL, NULL, '2024-02-05 19:00:00', NULL, NULL, NULL, 'WAITING', NULL, 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 60000, 60000),
	(53, '2024-02-01 05:14:51', '2024-02-01 05:14:51', 51, 13, 2, NULL, NULL, '2024-02-06 17:00:00', NULL, NULL, NULL, 'WAITING', NULL, 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 60000, 60000),
	(54, '2024-02-01 05:15:39', '2024-02-01 05:15:39', 52, 13, 20, NULL, NULL, '2024-02-06 18:00:00', NULL, NULL, NULL, 'WAITING', NULL, 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 70000, 70000),
	(55, '2024-02-01 05:16:52', '2024-02-01 12:07:37', 54, 9, 4, NULL, NULL, '2024-02-01 19:00:00', NULL, '2024-02-01 19:07:37', NULL, 'RUNNING', NULL, 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 50000, 50000),
	(56, '2024-02-01 05:17:34', '2024-02-01 05:17:34', 44, 9, 21, NULL, NULL, '2024-02-03 20:00:00', NULL, NULL, NULL, 'WAITING', NULL, 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 60000, 60000),
	(57, '2024-02-01 05:18:09', '2024-02-01 05:18:09', 54, 9, 4, NULL, NULL, '2024-02-06 19:00:00', NULL, NULL, NULL, 'WAITING', NULL, 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 50000, 50000),
	(58, '2024-02-01 05:18:33', '2024-02-01 05:18:33', 44, 9, 21, NULL, NULL, '2024-02-07 20:00:00', NULL, NULL, NULL, 'WAITING', NULL, 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 60000, 60000),
	(59, '2024-02-01 05:19:11', '2024-02-01 08:17:36', 40, 14, 2, NULL, NULL, '2024-02-01 14:00:00', NULL, '2024-02-01 14:31:19', '2024-02-01 15:17:36', 'NEEDCONFIRMATION', 'Persamaan Garis Lurus (PGL)', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', '<p>Latihan soal PGL mengenai:</p>\n<ol>\n<li>cara mencari gradien dari persamaan garis</li>\n<li>cara mencari gradien dari grafik</li>\n<li>cara mencari gradien apabila diketahui 2 titik yang dilalui garis</li>\n<li>cara menentukan persamaan garis yang melalui 2 titik</li>\n<li>cara menentukan persamaan garis yang diketahui gradien dan melalui 1 titik</li>\n</ol>', 'Progres minggu ini, Chris sudah bisa mengerjakan soal dengan lebih baik dan lebih cepat. Chris juga bisa mengingat rumus untuk setiap jenis soal yang dikerjakan. Hanya saja Chris harus lebih teliti lagi dalam melakukan operasi matematika.', 'Kelas berlangsung selama 60 menit.\nKelas dimulai pukul 14.00 WIB dan berakhir pukul 15.02 WIB', '"[]"', NULL, NULL, NULL, 'Meeting-00059', 60, 0, 60000, 60000),
	(60, '2024-02-01 05:20:27', '2024-02-01 09:50:03', 50, 14, 2, NULL, NULL, '2024-02-01 16:30:00', NULL, '2024-02-01 16:32:18', NULL, 'CANCELLED', NULL, 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 60000, 60000),
	(61, '2024-02-01 05:20:54', '2024-02-01 05:20:54', 40, 14, 2, NULL, NULL, '2024-02-04 14:00:00', NULL, NULL, NULL, 'WAITING', NULL, 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 60000, 60000),
	(62, '2024-02-01 07:58:29', '2024-02-01 07:58:29', 45, 12, 4, NULL, NULL, '2024-02-01 17:00:00', NULL, NULL, NULL, 'WAITING', NULL, 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 50000, 50000),
	(63, '2024-02-01 07:59:05', '2024-02-01 07:59:05', 35, 12, 5, NULL, NULL, '2024-02-01 20:00:00', NULL, NULL, NULL, 'WAITING', NULL, 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 60000, 60000),
	(64, '2024-02-01 07:59:37', '2024-02-01 07:59:37', 50, 12, 5, NULL, NULL, '2024-02-02 17:00:00', NULL, NULL, NULL, 'WAITING', NULL, 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338', NULL, NULL, NULL, '"[]"', NULL, NULL, NULL, NULL, 60, 0, 60000, 60000);

-- Dumping structure for table kasi_edu.expenses
CREATE TABLE IF NOT EXISTS `expenses` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table kasi_edu.expenses: ~0 rows (approximately)

-- Dumping structure for table kasi_edu.failed_jobs
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

-- Dumping data for table kasi_edu.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table kasi_edu.guardians
CREATE TABLE IF NOT EXISTS `guardians` (
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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table kasi_edu.guardians: ~0 rows (approximately)
INSERT INTO `guardians` (`id`, `created_at`, `updated_at`, `user_id`, `edu_status`, `address`, `religion`, `edu_level`, `edu_site`, `edu_major`, `work_site`, `work_title`) VALUES
	(34, '2024-01-26 09:14:37', '2024-01-29 02:51:03', 71, 1, NULL, NULL, 'Sekolah Menengah Atas/Ekuivalen', '(menunggu pembaruan data)', NULL, NULL, 'unemployed'),
	(35, '2024-01-30 03:39:54', '2024-01-30 03:39:54', 84, 1, NULL, 'Kristen', 's1', NULL, NULL, NULL, 'unemployed');

-- Dumping structure for table kasi_edu.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kasi_edu.jobs: ~0 rows (approximately)

-- Dumping structure for table kasi_edu.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kasi_edu.migrations: ~9 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(5, '2014_10_12_000000_create_users_table', 1),
	(6, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(7, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
	(8, '2019_08_19_000000_create_failed_jobs_table', 1),
	(9, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(10, '2023_11_09_071958_create_sessions_table', 1),
	(11, '2023_11_09_172008_create_students_table', 2),
	(12, '2023_12_12_174647_add_welcome_valid_until_field_to_users_table', 3),
	(13, '2024_01_16_221418_create_jobs_table', 4);

-- Dumping structure for table kasi_edu.packages
CREATE TABLE IF NOT EXISTS `packages` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table kasi_edu.packages: ~0 rows (approximately)

-- Dumping structure for table kasi_edu.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kasi_edu.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table kasi_edu.payments
CREATE TABLE IF NOT EXISTS `payments` (
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table kasi_edu.payments: ~0 rows (approximately)
INSERT INTO `payments` (`id`, `created_at`, `updated_at`, `billing_id`, `confirmed_by`, `pay_date`, `confirm_date`, `payment_file`, `amount`, `penalty`, `pay_method`, `package_id`) VALUES
	(1, '2024-02-01 08:11:43', '2024-02-01 08:12:35', 22, 1, '2024-02-01 15:11:43', '2024-02-01 15:12:35', '2024010007/00016-20240201 151143.jpg', 333000.000000, 0.000000, 'bank_transfer', NULL),
	(2, '2024-02-01 14:16:43', '2024-02-02 00:28:01', 17, 1, '2024-02-01 21:16:43', '2024-02-02 07:28:01', '2024010010/00012-20240201 211643.jpg', 306000.000000, 0.000000, 'bank_transfer', NULL);

-- Dumping structure for table kasi_edu.personal_access_tokens
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

-- Dumping data for table kasi_edu.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table kasi_edu.prices
CREATE TABLE IF NOT EXISTS `prices` (
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

-- Dumping data for table kasi_edu.prices: ~2 rows (approximately)
INSERT INTO `prices` (`id`, `created_at`, `updated_at`, `course_id`, `price`, `duration`, `type`) VALUES
	(1, NULL, NULL, 5, 60000.000000, 60, 'single'),
	(2, NULL, NULL, 4, 50000.000000, 60, 'single');

-- Dumping structure for table kasi_edu.promos
CREATE TABLE IF NOT EXISTS `promos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `code` varchar(50) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `type` enum('flat','percentage') NOT NULL DEFAULT 'percentage',
  `quota` tinyint(3) unsigned DEFAULT NULL,
  `amount` decimal(20,6) unsigned DEFAULT '0.000000',
  `description` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table kasi_edu.promos: ~0 rows (approximately)
INSERT INTO `promos` (`id`, `created_at`, `updated_at`, `code`, `start_date`, `end_date`, `type`, `quota`, `amount`, `description`) VALUES
	(37, NULL, NULL, '10UNTUK10', '2024-01-01 00:00:00', '2024-02-01 23:59:59', 'percentage', NULL, 10.000000, 'Diskon awal tahun, 10% dari harga kelas untuk seluruh murid KASI. Berlaku untuk semua murid.');

-- Dumping structure for table kasi_edu.sessions
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

-- Dumping data for table kasi_edu.sessions: ~5 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('J0xi8QiTfRFcUTXDE5jBAxeNmoGkN4sQHvi9Mv7V', NULL, '162.158.130.10', 'Mozilla/5.0 (compatible; YandexBot/3.0; +http://yandex.com/bots) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidHZMNTVhTmFwVXNweWJaQjhzWlhqTkU0RUwxNG91TDNNUjIyV0pYRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vZWR1Lmthc2kud2ViLmlkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1706822912),
	('m3AnPJGg23KO5BNJwR6oTMKoUs7nwW30QqGRB47t', 1, '162.158.114.96', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiT040V3V3SzV4NnVnZTdkR3BtQ0FXd296R1F4VzBDeHd4UDRVMlM5WCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQ5OiJodHRwczovL2VkdS5rYXNpLndlYi5pZC9rZXVhbmdhbi9wZW5nZ2FqaWFuL3R1dG9yIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMiRZMXp3bzJ5YkJhMHRXMVpiQTVvLkFlUzhLQ0N3c3FZeEVpc3BpYkxsSEVJNDBSOGNtMndqRyI7fQ==', 1706839716),
	('NS2painaEBhzcFJ3Tn60bCIsiTGT6uYPOl69lNwI', 79, '172.70.147.100', 'Mozilla/5.0 (Linux; U; Android 11; en-gb; Redmi Note 9 Build/RP1A.200720.011) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/112.0.5615.136 Mobile Safari/537.36 XiaoMi/MiuiBrowser/14.4.0-gn', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTzdPWnF2SGFYbUxvZm45amIyRGIwN2Q4YlpadE14MUhJUGlLZHV5WSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI5OiJodHRwczovL2VkdS5rYXNpLndlYi5pZC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjc5O30=', 1706825573),
	('qTD2MsRUvO7mMShi91woJTfpCIyefDPs7nMM8PVg', NULL, '172.69.135.141', 'Mozilla/5.0 (compatible; MixrankBot; crawler@mixrank.com)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWXBQSjNLZksyOVFaQktKMVE2N1dxY25OWXRCV1Y2eDV4ck91NDdORCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHBzOi8vZWR1Lmthc2kud2ViLmlkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1706833491),
	('wtmnyg5johppLGmQdosrNPoo2NRLuvMJ269U92dd', NULL, '172.70.147.100', 'Mozilla/5.0 (Linux; U; Android 11; en-gb; Redmi Note 9 Build/RP1A.200720.011) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/112.0.5615.136 Mobile Safari/537.36 XiaoMi/MiuiBrowser/14.4.0-gn', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieDYyTHVmRjM3ejA2cTFBc0Zlcnp0NW10MW10ZDhVdVgxYWpWWXBHdSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMzoiaHR0cHM6Ly9lZHUua2FzaS53ZWIuaWQvZGFzaGJvYXJkIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHBzOi8vZWR1Lmthc2kud2ViLmlkL2Rhc2hib2FyZCI7fX0=', 1706825582);

-- Dumping structure for table kasi_edu.settings
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `key` varchar(512) NOT NULL,
  `value` varchar(512) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table kasi_edu.settings: ~6 rows (approximately)
INSERT INTO `settings` (`id`, `created_at`, `updated_at`, `key`, `value`) VALUES
	(1, NULL, NULL, 'bill_due_date', '10'),
	(2, NULL, NULL, 'motto', 'Belajar Dulu, Menginspirasi Kemudian!'),
	(3, NULL, NULL, 'app_nickname', 'KASI'),
	(4, NULL, NULL, 'whatsapp', '6285179824064'),
	(5, NULL, NULL, 'inquiryConfirmPayment', 'Halo Admin KASI, saya hendak inquiry konfirmasi bukti pembayaran saya dengan nomor pembayaran '),
	(6, NULL, NULL, 'default_link', 'https://us06web.zoom.us/j/2318232507?pwd=ckx2MEhVNG9GQnlkNWJmMm1KZEIvZz09&omn=86061916338');

-- Dumping structure for table kasi_edu.students
CREATE TABLE IF NOT EXISTS `students` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nim` bigint(20) unsigned NOT NULL,
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
  `nationality` enum('INDONESIAN','KOREAN') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'INDONESIAN',
  PRIMARY KEY (`id`),
  KEY `base_user_student` (`user_id`),
  KEY `FK_students_guardians` (`guardian_id`),
  CONSTRAINT `FK_students_guardians` FOREIGN KEY (`guardian_id`) REFERENCES `guardians` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `base_user_student` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kasi_edu.students: ~11 rows (approximately)
INSERT INTO `students` (`id`, `created_at`, `updated_at`, `nim`, `user_id`, `has_guardian`, `guardian_id`, `address`, `edu_status`, `edu_level`, `edu_site`, `work_site`, `work_title`, `religion`, `nationality`) VALUES
	(33, '2024-01-26 13:25:13', '2024-01-26 13:25:13', 2024010003, 72, 0, NULL, NULL, 1, 's1', 'Universitas Kristen Petra', NULL, 'unemployed', NULL, 'INDONESIAN'),
	(34, '2024-01-26 13:26:58', '2024-01-26 13:26:58', 2024010004, 73, 0, NULL, NULL, 1, 'sd', 'SPK SD CHIS Denpasar', NULL, 'unemployed', NULL, 'INDONESIAN'),
	(35, '2024-01-26 13:29:21', '2024-01-26 13:29:21', 2024010005, 74, 1, 34, NULL, 1, 'smp', 'SMPN 1 BOJONGPICUNG ', NULL, 'unemployed', NULL, 'INDONESIAN'),
	(39, '2024-01-29 01:49:32', '2024-01-29 01:49:32', 2024010006, 78, 0, NULL, NULL, 1, 's1', 'Woosong University', NULL, 'unemployed', NULL, 'KOREAN'),
	(40, '2024-01-29 02:53:42', '2024-01-29 02:53:42', 2024010007, 79, 0, NULL, NULL, 1, 'smp', 'Smp Negeri 6 Denpasar jalan Gurita Sesetan Denpasar', NULL, 'unemployed', NULL, 'INDONESIAN'),
	(41, '2024-01-30 03:02:31', '2024-01-30 03:02:31', 2024010008, 80, 0, NULL, NULL, 1, 'smp', 'Petra Acitya', NULL, 'unemployed', NULL, 'INDONESIAN'),
	(42, '2024-01-30 03:21:16', '2024-01-30 03:21:16', 2024010009, 81, 0, NULL, NULL, 1, 's1', 'Universitas Kristen Petra', NULL, 'unemployed', NULL, 'INDONESIAN'),
	(43, '2024-01-30 03:23:28', '2024-01-30 03:23:28', 2024010010, 82, 0, NULL, NULL, 1, NULL, NULL, 'SMP Petra 4 (tempat kerja)', 'teacher', NULL, 'INDONESIAN'),
	(44, '2024-01-30 03:33:21', '2024-01-30 03:33:21', 2024010011, 83, 0, NULL, NULL, 1, 'sd', 'Springfield Interntional School Permata Buana Primary 5', NULL, 'unemployed', NULL, 'INDONESIAN'),
	(45, '2024-01-30 03:47:20', '2024-01-30 03:47:20', 2024010012, 85, 1, 35, NULL, 1, 'sd', 'Perguruan Advent Bekasi 14. Bekasi Timur', NULL, 'unemployed', NULL, 'INDONESIAN'),
	(46, '2024-01-30 03:50:33', '2024-01-30 03:50:33', 2024010013, 86, 1, 35, NULL, 1, 'sd', 'Perguruan Advent Bekasi 14. Bekasi Timur', NULL, 'unemployed', NULL, 'INDONESIAN'),
	(50, '2024-01-30 04:24:41', '2024-01-30 04:24:41', 2024010014, 90, 1, 35, NULL, 1, 'smp', 'Perguruan Advent Bekasi 14. Bekasi Timur', NULL, 'unemployed', NULL, 'INDONESIAN'),
	(51, '2024-01-30 05:02:22', '2024-01-30 05:02:22', 2024010015, 91, 0, NULL, NULL, 1, 'smp', 'Jembatan Budaya school', NULL, 'unemployed', NULL, 'INDONESIAN'),
	(52, '2024-01-30 13:38:54', '2024-01-30 13:38:54', 2024010016, 92, 0, NULL, NULL, 1, 'smp', 'Regents Secondary School', NULL, 'unemployed', NULL, 'INDONESIAN'),
	(53, '2024-01-30 13:40:45', '2024-01-30 13:40:45', 2024010017, 93, 0, NULL, NULL, 1, NULL, NULL, NULL, 'other', NULL, 'KOREAN'),
	(54, '2024-01-30 23:16:33', '2024-01-30 23:16:33', 2024010018, 94, 0, NULL, NULL, 1, 'sd', 'Sd santo yoseph 2 denpasar', NULL, 'unemployed', NULL, 'INDONESIAN'),
	(55, '2024-01-31 16:06:10', '2024-01-31 16:06:10', 2024010019, 98, 0, NULL, NULL, 1, 's1', 'Ulsan University', NULL, 'unemployed', NULL, 'KOREAN');

-- Dumping structure for table kasi_edu.student_evaluations
CREATE TABLE IF NOT EXISTS `student_evaluations` (
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

-- Dumping data for table kasi_edu.student_evaluations: ~0 rows (approximately)

-- Dumping structure for table kasi_edu.tutors
CREATE TABLE IF NOT EXISTS `tutors` (
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table kasi_edu.tutors: ~6 rows (approximately)
INSERT INTO `tutors` (`id`, `user_id`, `edu_status`, `edu_site`, `edu_level`, `edu_title`, `work_title`, `work_site`, `bank_number`, `bank_name`, `bank_additional_info`, `edu_major`, `religion`, `hobbies`, `passion`, `motto`, `teaching_experience`, `leadership_experience`, `competition_experience`, `created_at`, `updated_at`) VALUES
	(9, 60, 1, 'Pelita Harapan University', 's2', NULL, 'teacher', 'Cakap', '7610853913 ', 'BCA', NULL, 'Educational Technology', 'Kristen', 'listening to music, hanging out with friends, watching movies', 'education, business, social change, culture ', 'Live by faith, turn dream into reality', '<ol>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">Teaching private class in Elizabeth Learning Center (2019)</p>\n</li>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">Teaching private class in KaSi (2020 - present)</p>\n</li>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">Part-Time English Teacher in Cakap (2021 - present)</p>\n</li>\n</ol>\n<p>&nbsp;</p>', '<ol>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">Content Manager at Anonwimous (2021)</p>\n</li>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">Tutor&rsquo;s Assistant at Ethics Enrichment Program PCU (2019-2020)</p>\n</li>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">Frontline Division at Welcome Grateful Generation PCU (2018)</p>\n</li>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">Finance Division Coordinator at Rapat Akhir Pers Mahasiswa (2018)</p>\n</li>\n</ol>\n<p>&nbsp;</p>', '<ol>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">Won Originality Award at Lomba Nasional Konten Kreatif UKRIDA &amp; UK Maranatha 2020</p>\n</li>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">Top 15 Best Work at Creative Writing Weekend Workshop with Dee Lestari (2018)</p>\n</li>\n</ol>\n<p>&nbsp;</p>', '2024-01-21 10:43:59', '2024-01-26 08:41:45'),
	(11, 63, 1, 'Universitas Airlangga', 'Mahasiswa Jenjang S1', NULL, 'unemployed', NULL, '0240803593 ', 'BCA', NULL, 'Bahasa & Sastra Inggris', 'Buddha', 'Watching movie, playing game, reading, writing', 'Writing', 'Things don’t always go the way we’ve planned and it’s ok', '<ul>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">Bahasa Indonesia Tutor (2022)</p>\n</li>\n</ul>\n<p dir="ltr">Ruanglesonline Ruangguru</p>\n<ul>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">Volunteer English Tutor (2021)</p>\n</li>\n</ul>\n<p dir="ltr">Bonapasogit Mengajar</p>\n<p>&nbsp;</p>', '<ul>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">Journalist and SEO Optimization Supervisor (2021)</p>\n</li>\n</ul>\n<p dir="ltr">Yayasan Amal dan Sosial &ldquo;Media Insani&rdquo;</p>\n<p>&nbsp;</p>', '<ul>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">Gold Medalist&nbsp;</p>\n</li>\n</ul>\n<p dir="ltr">Olimpiade Sains Indonesia (OSI) 2020</p>\n<ul>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">Silver Medalist&nbsp;</p>\n</li>\n</ul>\n<p dir="ltr">Olimpiade Sains Indonesia (OSI) 2021</p>\n<ul>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">Silver Medalist&nbsp;</p>\n</li>\n</ul>\n<p dir="ltr">Kanigara English Olympiad 2021</p>\n<ul>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">9th Best Short Story</p>\n</li>\n</ul>\n<p dir="ltr">Lomba Bahasa dan Sastra 2021 Universitas Jenderal Soedirman</p>\n<p>&nbsp;</p>', '2024-01-25 19:52:13', '2024-01-26 08:40:17'),
	(12, 64, 1, 'Universitas Pasundan', 'Mahasiswa Jenjang S1', NULL, 'unemployed', NULL, '901035014492', 'SEA Bank', 'Flip (akan diupdate)', 'Sastra Inggris', 'Islam', 'Watching, Listening, Singing ', 'Creating English learning video ', 'Keep going on', '<ol>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">Teaching English Speaking, Pronunciation, Vocabulary - Interpeace, Kampung Inggris Pare (2018)</p>\n</li>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">Teaching an elementary student privately for English lesson in a month (2020)</p>\n</li>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">Teaching as a solver for English lesson at Roboguru in six months (2021)&nbsp;</p>\n</li>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">Teaching English and Math&nbsp; in KaSi (2022 - present).</p>\n</li>\n</ol>\n<p>&nbsp;</p>', '<ol>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">Publication Departmen of WCD Kampung Inggris Branch (2018)</p>\n</li>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">Committee English Conversation Club in ESA Pasundan University&nbsp; (2021)</p>\n</li>\n</ol>\n<p>&nbsp;</p>', '<ol>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">Private learning for SBMPTN of Medical faculty - LPP Salman ITB (2017)</p>\n</li>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">&nbsp;Awardee of Interpeace Scholarship of English Trainer (2018)</p>\n</li>\n</ol>\n<p>&nbsp;</p>', '2024-01-25 19:54:09', '2024-01-26 08:39:08'),
	(13, 65, 1, 'Institut Teknologi Bandung', 'Mahasiswa Jenjang S2', NULL, 'unemployed', NULL, '0454142529', 'BNI', 'Flip (akan diupdate)', 'Teknik Geologi', 'Katolik', 'Swimming, nature travelling', 'Sharing, creative art, photography', 'Universe rules our life, keep believing in the best', '<ol>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">Assistant Laboratory of Physics - ITS (2020)</p>\n</li>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">Assistant Laboratory of Electromagnetic Exploration - ITS (2021)</p>\n</li>\n</ol>\n<p>&nbsp;</p>', '<ol>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">Head of Entrepreneurship HMGI (2019-2020)</p>\n</li>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">Chief Extecutive of Seminar Nasional HMGI (2019)</p>\n</li>\n</ol>\n<p>&nbsp;</p>', '<ol>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">4th place of Essay Competition Solver ITB 2021</p>\n</li>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">International Publication of ITB Geothermal International Workshop 2021</p>\n</li>\n</ol>\n<p>&nbsp;</p>', '2024-01-25 19:55:52', '2024-01-26 08:37:01'),
	(14, 66, 1, 'ITS', 'Mahasiswa Jenjang S3', NULL, 'freelance', NULL, '144-001-7939-759', 'Mandiri', 'Flip BCA: 5465389254 (Akan diupdate)', 'Matematika', 'Islam', 'Studying, singing, and watching movies or series', 'Teaching and graphic design', 'We learn and grow together. Learning by doing.', '<ol>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">Teaching Mathematics - SMP Negeri 48 Surabaya (2016-2017)</p>\n</li>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">Teaching English Speaking, Grammar, &amp; Pronunciation - Interpeace, Kampung Inggris Pare (2018)</p>\n</li>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">Teaching Mathematics for International Elementary School&rsquo;s Students - Sun Smart (2019 - present)</p>\n</li>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">Teaching Mathematics &amp; English for Senior High School&rsquo;s Students - Sun Smart (2019 - 2021)</p>\n</li>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">Teaching All Subject for Home-schooling Elementary School&rsquo;s Students - Sun Smart (2022 - present)</p>\n</li>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">Teaching Mathematics for both Junior &amp; Senior High School&rsquo;s Students - RBC (2019 - present)</p>\n</li>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">Teaching Mathematics for UTBK-SBMPTN - Azka Course (2022)</p>\n</li>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">Teaching English Speaking for Children - Azka Course (2021 - present)</p>\n</li>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">Teaching General English for Employee - Azka Course (2022 - present)</p>\n</li>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">Teaching English Speaking - KaSi (2022 - present)</p>\n</li>\n</ol>\n<p>&nbsp;</p>', '<ol>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">The Head of WCD Kampung Inggris Branch (2018)</p>\n</li>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">Creative Media Coordinator - Scholars (2018)</p>\n</li>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">IPITS Event Coordinator - ITS (2020)</p>\n</li>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">Student Resource Development Division Coordinator - HMP ITS (2019 - 2021)</p>\n</li>\n</ol>\n<p>&nbsp;</p>', '<p dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Awardee of Interpeace Scholarship of English Trainer (2018)</p>\n<p>&nbsp;</p>', '2024-01-25 19:58:06', '2024-01-26 08:35:15'),
	(15, 68, 1, 'Universitas Kristen Petra', 's1', NULL, 'unemployed', NULL, '6750726281', 'BCA', NULL, 'English for Creative Industry', 'Kristen', 'Membaca buku, mendengarkan musik', 'Books, teaching, menulis cerita', 'Do everything as if for the Lord, and not for men.', '<ol>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">HIMASAINTRA English tutor for Grammar and Writing - Petra Christian University (2020-2021)</p>\n</li>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">English tutor for Grammar 3 and Writing 3 - GE-I Class (2021)</p>\n</li>\n</ol>\n<p>&nbsp;</p>', '<ol>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">Frontline Division at Welcome Grateful Generation - Petra Christian University (2020-2021)</p>\n</li>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">Tutor&rsquo;s Assistant at Ethics Enrichment Program - Petra Christian University (2020-2022)</p>\n</li>\n<li dir="ltr" aria-level="1">\n<p dir="ltr" role="presentation">Coordinator of Secretariat and Consumption Division for Welcome Grateful Generation Prodi (WGGP) English Department - Petra Christian University (2022)</p>\n</li>\n</ol>', '<p><strong id="docs-internal-guid-4a3f50f2-7fff-6160-8596-1150d8dc860b">Won 2nd place for Erlangga English Speech Competition - Anak Bangsa Senior High School (2018)</strong></p>', '2024-01-26 08:31:04', '2024-01-26 08:31:04');

-- Dumping structure for table kasi_edu.tutor_evaluations
CREATE TABLE IF NOT EXISTS `tutor_evaluations` (
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

-- Dumping data for table kasi_edu.tutor_evaluations: ~0 rows (approximately)

-- Dumping structure for table kasi_edu.tutor_payment_sharing
CREATE TABLE IF NOT EXISTS `tutor_payment_sharing` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_number` bigint(20) unsigned NOT NULL,
  `due_date` datetime DEFAULT NULL,
  `class_id` bigint(20) unsigned NOT NULL,
  `tutor_id` bigint(20) unsigned NOT NULL,
  `pay_date` datetime DEFAULT NULL,
  `amount` decimal(20,6) unsigned NOT NULL DEFAULT '0.000000',
  `pay_method` enum('bank_transfer','other','flip','gopay','dana','ovo') NOT NULL DEFAULT 'bank_transfer',
  `payment_proof` varchar(1024) DEFAULT NULL,
  `additional_info` text,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_tutor_payment_sharing_tutors` (`tutor_id`),
  KEY `FK__billings` (`class_id`) USING BTREE,
  CONSTRAINT `FK_tutor_payment_sharing_courses` FOREIGN KEY (`class_id`) REFERENCES `courses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_tutor_payment_sharing_tutors` FOREIGN KEY (`tutor_id`) REFERENCES `tutors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table kasi_edu.tutor_payment_sharing: ~48 rows (approximately)
INSERT INTO `tutor_payment_sharing` (`id`, `created_at`, `updated_at`, `payment_number`, `due_date`, `class_id`, `tutor_id`, `pay_date`, `amount`, `pay_method`, `payment_proof`, `additional_info`) VALUES
	(49, '2024-02-02 02:05:05', '2024-02-02 02:05:05', 1, '2024-02-02 09:05:05', 20, 9, NULL, 45000.000000, 'bank_transfer', NULL, NULL),
	(50, '2024-02-02 02:05:05', '2024-02-02 02:05:05', 1, '2024-02-02 09:05:05', 21, 9, NULL, 45000.000000, 'bank_transfer', NULL, NULL),
	(51, '2024-02-02 02:05:05', '2024-02-02 02:05:05', 1, '2024-02-02 09:05:05', 22, 9, NULL, 45000.000000, 'bank_transfer', NULL, NULL),
	(52, '2024-02-02 02:05:05', '2024-02-02 02:05:05', 1, '2024-02-02 09:05:05', 23, 9, NULL, 37500.000000, 'bank_transfer', NULL, NULL),
	(53, '2024-02-02 02:05:05', '2024-02-02 02:05:05', 1, '2024-02-02 09:05:05', 24, 9, NULL, 18750.000000, 'bank_transfer', NULL, NULL),
	(54, '2024-02-02 02:05:05', '2024-02-02 02:05:05', 1, '2024-02-02 09:05:05', 25, 9, NULL, 37500.000000, 'bank_transfer', NULL, NULL),
	(55, '2024-02-02 02:05:05', '2024-02-02 02:05:05', 1, '2024-02-02 09:05:05', 26, 9, NULL, 9000.000000, 'bank_transfer', NULL, NULL),
	(56, '2024-02-02 02:05:07', '2024-02-02 02:05:07', 2, '2024-02-02 09:05:07', 2, 11, NULL, 4500.000000, 'bank_transfer', NULL, NULL),
	(57, '2024-02-02 02:05:07', '2024-02-02 02:05:07', 2, '2024-02-02 09:05:07', 3, 11, NULL, 4500.000000, 'bank_transfer', NULL, NULL),
	(58, '2024-02-02 02:05:07', '2024-02-02 02:05:07', 2, '2024-02-02 09:05:07', 4, 11, NULL, 45000.000000, 'bank_transfer', NULL, NULL),
	(59, '2024-02-02 02:05:07', '2024-02-02 02:05:07', 2, '2024-02-02 09:05:07', 5, 11, NULL, 45000.000000, 'bank_transfer', NULL, NULL),
	(60, '2024-02-02 02:05:07', '2024-02-02 02:05:07', 2, '2024-02-02 09:05:07', 6, 11, NULL, 45000.000000, 'bank_transfer', NULL, NULL),
	(61, '2024-02-02 02:05:07', '2024-02-02 02:05:07', 2, '2024-02-02 09:05:07', 7, 11, NULL, 45000.000000, 'bank_transfer', NULL, NULL),
	(62, '2024-02-02 02:05:07', '2024-02-02 02:05:07', 2, '2024-02-02 09:05:07', 8, 11, NULL, 67500.000000, 'bank_transfer', NULL, NULL),
	(63, '2024-02-02 02:05:08', '2024-02-02 02:05:08', 2, '2024-02-02 09:05:08', 10, 11, NULL, 11250.000000, 'bank_transfer', NULL, NULL),
	(64, '2024-02-02 02:05:08', '2024-02-02 02:05:08', 2, '2024-02-02 09:05:08', 11, 11, NULL, 45000.000000, 'bank_transfer', NULL, NULL),
	(65, '2024-02-02 02:05:08', '2024-02-02 02:05:08', 2, '2024-02-02 09:05:08', 12, 11, NULL, 45000.000000, 'bank_transfer', NULL, NULL),
	(66, '2024-02-02 02:05:08', '2024-02-02 02:05:08', 2, '2024-02-02 09:05:08', 13, 11, NULL, 45000.000000, 'bank_transfer', NULL, NULL),
	(67, '2024-02-02 02:05:08', '2024-02-02 02:05:08', 2, '2024-02-02 09:05:08', 14, 11, NULL, 45000.000000, 'bank_transfer', NULL, NULL),
	(68, '2024-02-02 02:05:08', '2024-02-02 02:05:08', 2, '2024-02-02 09:05:08', 15, 11, NULL, 45000.000000, 'bank_transfer', NULL, NULL),
	(69, '2024-02-02 02:05:08', '2024-02-02 02:05:08', 2, '2024-02-02 09:05:08', 49, 11, NULL, 45000.000000, 'bank_transfer', NULL, NULL),
	(70, '2024-02-02 02:05:08', '2024-02-02 02:05:08', 3, '2024-02-02 09:05:08', 33, 12, NULL, 45000.000000, 'bank_transfer', NULL, NULL),
	(71, '2024-02-02 02:05:08', '2024-02-02 02:05:08', 3, '2024-02-02 09:05:08', 34, 12, NULL, 18750.000000, 'bank_transfer', NULL, NULL),
	(72, '2024-02-02 02:05:08', '2024-02-02 02:05:08', 3, '2024-02-02 09:05:08', 35, 12, NULL, 18750.000000, 'bank_transfer', NULL, NULL),
	(73, '2024-02-02 02:05:08', '2024-02-02 02:05:08', 3, '2024-02-02 09:05:08', 36, 12, NULL, 18750.000000, 'bank_transfer', NULL, NULL),
	(74, '2024-02-02 02:05:08', '2024-02-02 02:05:08', 3, '2024-02-02 09:05:08', 37, 12, NULL, 45000.000000, 'bank_transfer', NULL, NULL),
	(75, '2024-02-02 02:05:08', '2024-02-02 02:05:08', 3, '2024-02-02 09:05:08', 38, 12, NULL, 45000.000000, 'bank_transfer', NULL, NULL),
	(76, '2024-02-02 02:05:08', '2024-02-02 02:05:08', 3, '2024-02-02 09:05:08', 39, 12, NULL, 45000.000000, 'bank_transfer', NULL, NULL),
	(77, '2024-02-02 02:05:08', '2024-02-02 02:05:08', 3, '2024-02-02 09:05:08', 40, 12, NULL, 22500.000000, 'bank_transfer', NULL, NULL),
	(78, '2024-02-02 02:05:08', '2024-02-02 02:05:08', 3, '2024-02-02 09:05:08', 41, 12, NULL, 22500.000000, 'bank_transfer', NULL, NULL),
	(79, '2024-02-02 02:05:09', '2024-02-02 02:05:09', 4, '2024-02-02 09:05:09', 16, 13, NULL, 45000.000000, 'bank_transfer', NULL, NULL),
	(80, '2024-02-02 02:05:09', '2024-02-02 02:05:09', 4, '2024-02-02 09:05:09', 17, 13, NULL, 45000.000000, 'bank_transfer', NULL, NULL),
	(81, '2024-02-02 02:05:09', '2024-02-02 02:05:09', 4, '2024-02-02 09:05:09', 18, 13, NULL, 45000.000000, 'bank_transfer', NULL, NULL),
	(82, '2024-02-02 02:05:09', '2024-02-02 02:05:09', 4, '2024-02-02 09:05:09', 19, 13, NULL, 52500.000000, 'bank_transfer', NULL, NULL),
	(83, '2024-02-02 02:05:10', '2024-02-02 02:05:10', 5, '2024-02-02 09:05:10', 42, 14, NULL, 45000.000000, 'bank_transfer', NULL, NULL),
	(84, '2024-02-02 02:05:10', '2024-02-02 02:05:10', 5, '2024-02-02 09:05:10', 43, 14, NULL, 45000.000000, 'bank_transfer', NULL, NULL),
	(85, '2024-02-02 02:05:10', '2024-02-02 02:05:10', 5, '2024-02-02 09:05:10', 44, 14, NULL, 45000.000000, 'bank_transfer', NULL, NULL),
	(86, '2024-02-02 02:05:10', '2024-02-02 02:05:10', 5, '2024-02-02 09:05:10', 45, 14, NULL, 45000.000000, 'bank_transfer', NULL, NULL),
	(87, '2024-02-02 02:05:10', '2024-02-02 02:05:10', 5, '2024-02-02 09:05:10', 46, 14, NULL, 45000.000000, 'bank_transfer', NULL, NULL),
	(88, '2024-02-02 02:05:10', '2024-02-02 02:05:10', 5, '2024-02-02 09:05:10', 47, 14, NULL, 45000.000000, 'bank_transfer', NULL, NULL),
	(89, '2024-02-02 02:05:10', '2024-02-02 02:05:10', 5, '2024-02-02 09:05:10', 48, 14, NULL, 45000.000000, 'bank_transfer', NULL, NULL),
	(90, '2024-02-02 02:05:10', '2024-02-02 02:05:10', 5, '2024-02-02 09:05:10', 51, 14, NULL, 45000.000000, 'bank_transfer', NULL, NULL),
	(91, '2024-02-02 02:05:11', '2024-02-02 02:05:11', 6, '2024-02-02 09:05:11', 27, 15, NULL, 63750.000000, 'bank_transfer', NULL, NULL),
	(92, '2024-02-02 02:05:11', '2024-02-02 02:05:11', 6, '2024-02-02 09:05:11', 28, 15, NULL, 63750.000000, 'bank_transfer', NULL, NULL),
	(93, '2024-02-02 02:05:11', '2024-02-02 02:05:11', 6, '2024-02-02 09:05:11', 29, 15, NULL, 63750.000000, 'bank_transfer', NULL, NULL),
	(94, '2024-02-02 02:05:11', '2024-02-02 02:05:11', 6, '2024-02-02 09:05:11', 30, 15, NULL, 63750.000000, 'bank_transfer', NULL, NULL),
	(95, '2024-02-02 02:05:11', '2024-02-02 02:05:11', 6, '2024-02-02 09:05:11', 31, 15, NULL, 63750.000000, 'bank_transfer', NULL, NULL),
	(96, '2024-02-02 02:05:11', '2024-02-02 02:05:11', 6, '2024-02-02 09:05:11', 32, 15, NULL, 63750.000000, 'bank_transfer', NULL, NULL);

-- Dumping structure for table kasi_edu.tutor_skills
CREATE TABLE IF NOT EXISTS `tutor_skills` (
  `id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '0',
  `price` decimal(20,6) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table kasi_edu.tutor_skills: ~18 rows (approximately)
INSERT INTO `tutor_skills` (`id`, `name`, `price`) VALUES
	(1, 'Matematika SD', 50000.000000),
	(2, 'Matematika SMP', 60000.000000),
	(3, 'Matematika SMA', 70000.000000),
	(4, 'Bahasa Inggris SD', 50000.000000),
	(5, 'Bahasa Inggris SMP', 60000.000000),
	(6, 'Bahasa Inggris SMA', 70000.000000),
	(7, 'IPA SD', 50000.000000),
	(8, 'IPA SMP', 60000.000000),
	(9, 'Kimia SMA', 70000.000000),
	(10, 'Fisika SMA', 70000.000000),
	(11, 'Fisika SMP', 60000.000000),
	(12, 'Biologi SMP', 60000.000000),
	(13, 'Biologi SMA', 70000.000000),
	(14, 'General English', 85000.000000),
	(15, 'English Preparation for TOEFL', 95000.000000),
	(16, 'English Preparation for IELTS', 110000.000000),
	(17, 'General English for Korean 12', 12000.000000),
	(18, 'General English for Korean 16', 16000.000000),
	(19, 'Matematika SD Internasional', 60000.000000),
	(20, 'Matematika SMP Internasional', 70000.000000),
	(21, 'Bahasa Inggris SD Internasional', 60000.000000),
	(22, 'General English SMP', 70000.000000),
	(23, 'General English SD', 60000.000000);

-- Dumping structure for table kasi_edu.tutor_skills_pivot
CREATE TABLE IF NOT EXISTS `tutor_skills_pivot` (
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
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table kasi_edu.tutor_skills_pivot: ~31 rows (approximately)
INSERT INTO `tutor_skills_pivot` (`id`, `Column 2`, `created_at`, `updated_at`, `tutor_id`, `skill_id`) VALUES
	(10, 0, '2024-01-21 10:43:59', '2024-01-21 10:43:59', 9, 4),
	(11, 0, '2024-01-21 10:43:59', '2024-01-21 10:43:59', 9, 5),
	(12, 0, '2024-01-21 10:44:00', '2024-01-21 10:44:00', 9, 6),
	(13, 0, '2024-01-21 10:44:00', '2024-01-21 10:44:00', 9, 14),
	(15, 0, '2024-01-25 19:52:13', '2024-01-25 19:52:13', 11, 1),
	(16, 0, '2024-01-25 19:52:13', '2024-01-25 19:52:13', 11, 4),
	(17, 0, '2024-01-25 19:52:13', '2024-01-25 19:52:13', 11, 5),
	(18, 0, '2024-01-25 19:52:13', '2024-01-25 19:52:13', 11, 6),
	(19, 0, '2024-01-25 19:52:13', '2024-01-25 19:52:13', 11, 14),
	(20, 0, '2024-01-25 19:52:13', '2024-01-25 19:52:13', 11, 15),
	(21, 0, '2024-01-25 19:54:09', '2024-01-25 19:54:09', 12, 4),
	(22, 0, '2024-01-25 19:54:10', '2024-01-25 19:54:10', 12, 5),
	(23, 0, '2024-01-25 19:54:10', '2024-01-25 19:54:10', 12, 6),
	(24, 0, '2024-01-25 19:54:10', '2024-01-25 19:54:10', 12, 14),
	(25, 0, '2024-01-25 19:55:52', '2024-01-25 19:55:52', 13, 1),
	(26, 0, '2024-01-25 19:55:52', '2024-01-25 19:55:52', 13, 2),
	(27, 0, '2024-01-25 19:55:52', '2024-01-25 19:55:52', 13, 3),
	(28, 0, '2024-01-25 19:58:06', '2024-01-25 19:58:06', 14, 1),
	(29, 0, '2024-01-25 19:58:07', '2024-01-25 19:58:07', 14, 2),
	(30, 0, '2024-01-25 19:58:07', '2024-01-25 19:58:07', 14, 3),
	(31, 0, '2024-01-25 19:58:07', '2024-01-25 19:58:07', 14, 4),
	(32, 0, '2024-01-25 19:58:07', '2024-01-25 19:58:07', 14, 5),
	(33, 0, '2024-01-25 19:58:07', '2024-01-25 19:58:07', 14, 6),
	(34, 0, '2024-01-25 19:58:07', '2024-01-25 19:58:07', 14, 14),
	(35, 0, '2024-01-25 19:58:07', '2024-01-25 19:58:07', 14, 15),
	(36, 0, '2024-01-26 08:31:04', '2024-01-26 08:31:04', 15, 4),
	(37, 0, '2024-01-26 08:31:04', '2024-01-26 08:31:04', 15, 5),
	(38, 0, '2024-01-26 08:31:04', '2024-01-26 08:31:04', 15, 6),
	(39, 0, '2024-01-26 08:31:04', '2024-01-26 08:31:04', 15, 14),
	(40, 0, '2024-01-26 08:31:04', '2024-01-26 08:31:04', 15, 15),
	(41, 0, '2024-01-26 08:31:04', '2024-01-26 08:31:04', 15, 16),
	(42, 0, NULL, NULL, 11, 17),
	(43, 0, NULL, NULL, 9, 17),
	(44, 0, NULL, NULL, 11, 19),
	(45, 0, NULL, NULL, 13, 20),
	(46, 0, '2024-01-21 10:43:59', '2024-01-21 10:43:59', 9, 21);

-- Dumping structure for table kasi_edu.users
CREATE TABLE IF NOT EXISTS `users` (
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
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table kasi_edu.users: ~21 rows (approximately)
INSERT INTO `users` (`id`, `name`, `nickname`, `email`, `email_verified_at`, `mobile_number`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`, `birthday`, `last_login_at`, `last_active_at`, `exist_status`, `welcome_valid_until`, `address`, `city`, `province`, `slug`, `role`) VALUES
	(1, 'Kangen Menginspirasi', 'KASI', 'kangenmenginspirasi@gmail.com', '2023-11-09 00:59:10', '6285179824064', '$2y$12$Y1zwo2ybBa0tW1ZbA5o.AeS8KCCwsqYxEispibLlHEI40R8cm2wjG', NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-09 00:23:42', '2024-02-02 02:08:36', '2020-06-24', '2023-12-12 10:58:55', '2024-02-02 02:08:36', 'Aktif', NULL, NULL, NULL, NULL, 'kangen-menginspirasi', 'SUPERADMIN'),
	(60, 'Levana Vivian', 'Levy', 'levnurtanto@gmail.com', NULL, '628118809900', '$2y$12$xi33bvXJvRqzZNgl.3MxKeS3YiU.birCpa1O2DbHCQuhenSicUfTm', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-21 10:43:59', '2024-02-01 12:21:49', '1999-09-04', NULL, '2024-02-01 12:21:49', 'Aktif', NULL, 'Taman Permata Sektor 5 Blok A7/47, Lippo Karawaci, Tangerang\n', NULL, NULL, 'levana-vivian-tutor', 'TUTOR'),
	(63, 'Ching Sioe', 'Ching', 'chingsioe@gmail.com', '2024-02-01 11:51:12', '6282338669575', '$2y$12$5SFlcP820YSvaJfpy4znQuVKNOamSfPYmlHMIwH5mYFh2fuhkHsKi', NULL, NULL, NULL, 'E3PU8KPCMMPGdDQKt3eHUFGmEdotLujCvSpqM6psU8CtAI1TofKqYSZ3G530', NULL, NULL, '2024-01-25 19:52:13', '2024-02-01 11:51:31', '2001-09-25', NULL, '2024-02-01 11:51:31', 'Aktif', NULL, 'Jl. Semeru No-,  RT 002/RW003, Ajung, Jember\n', NULL, NULL, 'ching-sioe-tutor', 'TUTOR'),
	(64, 'Siti Hasanah', 'Siti', 'adsth2501@gmail.com', NULL, '6285871102639', '$2y$12$Vz9ui4Vxq0ei4KGPgVfp2ekV16CqtlWBaKr2E0sTaZSZFUGdEx.E6', NULL, NULL, NULL, 'ZhopoTu5LQRkKSwh6FJrNosB3wBv060KJSSNDbTaMbzo79ncZEMlcfR3JijO', NULL, NULL, '2024-01-25 19:54:09', '2024-02-01 13:04:44', '1999-01-25', NULL, '2024-02-01 13:04:44', 'Aktif', NULL, 'KP. Cikurutug No.46 RT 02/02 Ciburial, Cimenyan, Bandung', NULL, NULL, 'siti-hasanah-tutor', 'TUTOR'),
	(65, 'Dionisius Alfa Amori Kusuma', 'Dion', 'dionisiusalfa@gmail.com', NULL, '6282141731114', '$2y$12$3pUqP0yINk1LpCpqU4ivQerkRSsWyo9YbUm0IW5gEDsnSF0nnguYC', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-25 19:55:52', '2024-01-26 08:37:01', '1999-03-09', NULL, '2024-01-25 21:01:15', 'Aktif', NULL, 'Jl. Cisitu Indah V no.5a Bandung ', NULL, NULL, 'dionisius-alfa-amori-kusuma-tutor', 'TUTOR'),
	(66, 'Erna Setiawati', 'Tia', 'ernasetiawati862@gmail.com', NULL, '6287853828520', '$2y$12$RJN4RbIF1ryg24qol.LXXetB1v1FrYfBBy89FfX3Nm8huQCCcPGJm', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-25 19:58:06', '2024-02-01 09:32:18', '1994-08-28', NULL, '2024-02-01 09:32:18', 'Aktif', NULL, 'Margomulyo Permai Blok AJ No.1, Surabaya\n', NULL, NULL, 'erna-setiawati-tutor', 'TUTOR'),
	(68, 'Veronica Febriyanti Adam', 'Vero', 'veronicafebrianti92@gmail.com', NULL, '6281216159545', '$2y$12$kJrVXcLgekiaXeWogUA7t.zrNlxKmPkKGMPApS2xDIjcjaRmjbICS', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-26 08:31:04', '2024-01-26 08:31:04', '2001-02-05', NULL, NULL, 'Aktif', NULL, 'Jl. Medayu Utara 2 No.40, Surabaya', NULL, NULL, 'veronica-febriyanti-adam-tutor', 'TUTOR'),
	(71, 'Ai Junaenah', NULL, 'ai25junaenah@gmail.com', NULL, '6285659424066', '$2y$12$GwGL9umt6KKfO7wrlZz.ReCbG2SeQMyNt/hM9cEhHlxDqALV6x3DS', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-26 09:14:37', '2024-02-01 13:59:12', NULL, NULL, '2024-02-01 13:59:12', 'Aktif', NULL, 'Kp. Babakansoka RT 04/RW 07 Desa neglasari Kec. Bojongpicung', NULL, NULL, 'ai-junaenah-wali-murid', 'WALI MURID'),
	(72, 'Agusman Zai', 'Agus', 'agusmanzai2001@gmail.com', NULL, '6282268270632', '$2y$12$ZJw9t22X16pKnGpdwn/vg.wIJNakcChSYHFbvWKMK65qW9SYuVLMK', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-26 13:25:13', '2024-01-26 13:25:13', '2001-08-22', NULL, NULL, 'Aktif', NULL, NULL, NULL, NULL, 'agusman-zai-murid', 'MURID'),
	(73, 'Abraham Nararya Rahe Jatmiko', 'Abam', 'bamrahe@gmail.com', NULL, NULL, '$2y$12$QeSKQmMJ4cnDd8K0pkSf7ux9A2rwPWWqWLKy..SMMkd/ydErS68mq', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-26 13:26:58', '2024-02-01 09:33:48', '2014-11-05', NULL, '2024-02-01 09:33:48', 'Aktif', NULL, NULL, NULL, NULL, 'abraham-nararya-rahe-jatmiko-murid', 'MURID'),
	(74, 'Fathan Rafa Ramadhan', 'Fathan', NULL, NULL, '6285861796009', '$2y$12$c.f4Ga8u.Gwam5H0WgoKP.IuGev5I5J7aFcm9kW5diaJUIzj9Rt0.', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-26 13:29:21', '2024-01-26 13:29:21', '2009-09-17', NULL, NULL, 'Aktif', NULL, NULL, NULL, NULL, 'fathan-rafa-ramadhan-murid', 'MURID'),
	(78, 'Jongwon Song', 'Jongwon', 'goldenboy24@naver.com', NULL, '000', '$2y$12$BJe5w77vnsWB0VoKi0k5Bue6M76FUbwQHJIsjKv9GyFck6HFtzqvi', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-29 01:49:32', '2024-01-29 01:49:32', '1996-02-27', NULL, NULL, 'Aktif', NULL, NULL, NULL, NULL, 'jongwon-song-murid', 'MURID'),
	(79, 'Christian Rayner', 'Chris', 'gettygogo78@gmail.com', NULL, '6281234678938', '$2y$12$ja54l2Qb40EztSF7PX6P3OP4mN1uiMEWFMO8VnOSTSB8yk.AhMfyW', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-29 02:53:42', '2024-02-01 07:02:17', '2010-08-29', NULL, '2024-02-01 07:02:17', 'Aktif', NULL, NULL, NULL, NULL, 'christian-rayner-murid', 'MURID'),
	(80, 'Marcell Wen', 'Marcell', 'marcellwen@gmail.com', NULL, '6285241010000', '$2y$12$rTMmmujtakbDKeHVA6Y1Ue5EEpZfq16Bv8SGoN/qyd46sNEaSN0DW', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-30 03:02:31', '2024-01-30 03:02:31', '2009-01-30', NULL, NULL, 'Aktif', NULL, NULL, NULL, NULL, 'marcell-wen-murid', 'MURID'),
	(81, 'Gloria Christabel Lilipory', 'Gloria', 'glorialilipory50@gmail.com', NULL, '6281358790867', '$2y$12$r8I1G/v75rk.INVO0mSbr.OeEuH5kbdQkP9HFwM6lR25cSa0.REYu', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-30 03:21:16', '2024-02-01 02:59:49', '1999-05-05', NULL, '2024-02-01 02:59:49', 'Aktif', NULL, NULL, NULL, NULL, 'gloria-christabel-lilipory-murid', 'MURID'),
	(82, 'Aprillia Adella Suyanto', 'Della', 'aprilliaadella@gmail.com', NULL, '6287851246413', '$2y$12$B25Wz1IeWWhEoBp5.CWDCuacPBYZE.8uZgMqjZ5Nq2K5StePazM3O', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-30 03:23:28', '2024-02-01 14:16:48', '1999-04-05', NULL, '2024-02-01 14:16:48', 'Aktif', NULL, NULL, NULL, NULL, 'aprillia-adella-suyanto-murid', 'MURID'),
	(83, 'Kylie Eugenia The', 'Kylie', 'Elke.solomon@gmail.com', NULL, '6289607107288', '$2y$12$Ze/sbYpgVxZVUsZxnfaWtuVIIs7fK6bAwDMSrgKJXRJyc2Zi.u.Hm', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-30 03:33:21', '2024-01-30 03:39:29', '2013-02-13', NULL, '2024-01-30 03:39:29', 'Aktif', NULL, NULL, NULL, NULL, 'kylie-eugenia-the-murid', 'MURID'),
	(84, 'Imelda Situmorang', NULL, 'situmorangimeldas@yahoo.com', NULL, '6281311380016', '$2y$12$r5PhuQNFLpIcXxyBgHK8lepSoenFpDWBKKyIsXgoATKyZITXq8OUi', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-30 03:39:53', '2024-02-01 01:44:03', NULL, NULL, '2024-02-01 01:44:03', 'Aktif', NULL, 'Perumahan Permata Bekasi II blok J no 16. Durenjaya Bekasi Timur 17111', NULL, NULL, 'imelda-situmorang-wali-murid', 'WALI MURID'),
	(85, 'William Misael', 'William', 'william.misael@kasi.web.id', NULL, '002', '$2y$12$xBtkEOgA683jQ0QvCAAjDemkS0MIpcvJBfJiTrkn.nQiA4yBjau.y', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-30 03:47:20', '2024-01-30 03:47:20', '2012-12-19', NULL, NULL, 'Aktif', NULL, NULL, NULL, NULL, 'william-misael-murid', 'MURID'),
	(86, 'Vincent Samuel Maruli Tua', 'Vincent', 'vincent.samuel.maruli.tua@kasi.web.id', NULL, '003', '$2y$12$bKpgIUQD663r1Y1D3PVCPuP368fFBLYrIZsB/42Kp39.KU5Ocn.H.', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-30 03:50:33', '2024-01-30 03:50:33', '2011-06-27', NULL, NULL, 'Aktif', NULL, NULL, NULL, NULL, 'vincent-samuel-maruli-tua-murid', 'MURID'),
	(90, 'Joanna Lydia Oriel Asian', 'Joanna ', 'joanna.lydia.oriel.asian@kasi.web.id', NULL, '004', '$2y$12$TjU3LYMG.fBQyMmgpWGX2.xCwAvRG8vhVDDYI4OrZwIZliN.afg5u', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-30 04:24:41', '2024-01-30 04:24:41', '2008-10-30', NULL, NULL, 'Aktif', NULL, NULL, NULL, NULL, 'joanna-lydia-oriel-asian-murid', 'MURID'),
	(91, 'Matahari nadia wicaksono', 'Matahari', 'wicaksono.matahari@gmail.com', NULL, '6282146055988', '$2y$12$RjMmequLGRkqarR8VgemtO2Nc289pCxGpUkBfv1Yfq/kj.IRUCaJW', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-30 05:02:22', '2024-01-30 05:02:22', '2010-05-24', NULL, NULL, 'Aktif', NULL, NULL, NULL, NULL, 'matahari-nadia-wicaksono-murid', 'MURID'),
	(92, 'Nayo', 'Nayo', 'khazjuzu2@gmail.com', NULL, '6289670435251', '$2y$12$HZiMDG4.HYH/xU7SmfuBRueqt4MDF43E/OvP264PQYUQe8/mbpiVG', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-30 13:38:54', '2024-01-30 13:38:54', '2009-09-22', NULL, NULL, 'Aktif', NULL, NULL, NULL, NULL, 'nayo-murid', 'MURID'),
	(93, 'Kwak GiBong', 'GiBong', 'Kwakgibongwsu@gmail.com', NULL, '01036640506', '$2y$12$gSYfnBVCnmMUJwuPcrTcTuxqJTLocFF2hWLEiBK1OaTBUKFRP7Wmy', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-30 13:40:45', '2024-01-30 13:40:45', '1996-05-06', NULL, NULL, 'Aktif', NULL, NULL, NULL, NULL, 'kwak-gibong-murid', 'MURID'),
	(94, 'Glenn Emmanuel The', 'Glenn', 'graciellaeunikesatriyo@gmail.com', NULL, '6281337685094', '$2y$12$jfsBAdzN9GrK1iO5GmsGB.u6c5VW1jv5An0eDcWnz5QlPYBaIGaQO', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-30 23:16:33', '2024-02-01 01:39:43', '2014-12-06', NULL, '2024-02-01 01:39:43', 'Aktif', NULL, NULL, NULL, NULL, 'glenn-emmanuel-the-murid', 'MURID'),
	(98, 'Daeun Jeong', 'Daeun', 'daeun.jeong@kasi.web.id', NULL, '005', '$2y$12$FHkmsX7fYqtbpDCvr0Ay.u8RIRO3aqEju7bcUafu6Caqg04sUvHPS', NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-31 16:06:10', '2024-01-31 16:06:10', '2002-04-10', NULL, NULL, 'Aktif', NULL, NULL, NULL, NULL, 'daeun-jeong-murid', 'MURID');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
