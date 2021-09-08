-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 28, 2021 at 03:59 PM
-- Server version: 8.0.26-0ubuntu0.20.04.2
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ADC`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_applications`
--

CREATE TABLE `attendance_applications` (
  `id` bigint UNSIGNED NOT NULL,
  `student_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instructor_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `absents` int NOT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachment` blob NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_records`
--

CREATE TABLE `attendance_records` (
  `student_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `presents` int NOT NULL,
  `absents` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendance_records`
--

INSERT INTO `attendance_records` (`student_id`, `course_id`, `presents`, `absents`, `created_at`, `updated_at`) VALUES
('021-17-0015', 'CSC-302', 84, 6, '2021-08-28 09:07:12', '2021-08-28 09:07:12'),
('021-17-0015', 'CSC-401', 81, 9, '2021-08-28 09:07:12', '2021-08-28 09:07:12'),
('021-17-0015', 'CSC-403', 87, 3, '2021-08-28 09:07:12', '2021-08-28 09:07:12'),
('021-17-0015', 'SME-310', 84, 6, '2021-08-28 09:07:12', '2021-08-28 09:07:12'),
('021-17-0037', 'CSC-302', 82, 8, '2021-08-28 09:07:12', '2021-08-28 09:07:12'),
('021-17-0037', 'CSC-401', 86, 4, '2021-08-28 09:07:12', '2021-08-28 09:07:12'),
('021-17-0037', 'CSC-403', 84, 6, '2021-08-28 09:07:12', '2021-08-28 09:07:12'),
('021-17-0037', 'MTS-102', 80, 10, '2021-08-28 09:07:12', '2021-08-28 09:07:12'),
('021-17-0037', 'SME-310', 84, 6, '2021-08-28 09:07:12', '2021-08-28 09:07:12'),
('021-17-0043', 'CSC-302', 81, 9, '2021-08-28 09:07:12', '2021-08-28 09:07:12'),
('021-17-0043', 'CSC-401', 84, 6, '2021-08-28 09:07:12', '2021-08-28 09:07:12'),
('021-17-0043', 'CSC-403', 83, 7, '2021-08-28 09:07:12', '2021-08-28 09:07:12'),
('021-17-0043', 'MTS-019', 80, 10, '2021-08-28 09:07:12', '2021-08-28 09:07:12'),
('021-17-0043', 'MTS-102', 82, 8, '2021-08-28 09:07:12', '2021-08-28 09:07:12'),
('021-17-0043', 'SME-310', 86, 4, '2021-08-28 09:07:12', '2021-08-28 09:07:12'),
('051-17-0037', 'CSC-302', 88, 2, '2021-08-28 09:07:12', '2021-08-28 09:07:12'),
('051-17-0037', 'MTS-019', 84, 6, '2021-08-28 09:07:12', '2021-08-28 09:07:12'),
('051-17-0037', 'MTS-102', 82, 8, '2021-08-28 09:07:12', '2021-08-28 09:07:12'),
('051-17-0037', 'SME-310', 84, 6, '2021-08-28 09:07:12', '2021-08-28 09:07:12');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `crs_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `credit_hours` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`crs_id`, `name`, `credit_hours`, `created_at`, `updated_at`) VALUES
('CSC-302', 'Data Structures', 3, '2021-08-28 07:16:21', '2021-08-28 07:16:21'),
('CSC-401', 'Network Security', 3, '2021-08-28 07:17:19', '2021-08-28 07:17:19'),
('CSC-403', 'Data Science', 3, '2021-08-28 07:16:21', '2021-08-28 07:16:21'),
('MTS-019', 'Multivariate Calculus', 3, '2021-08-28 07:17:19', '2021-08-28 07:17:19'),
('MTS-102', 'Calculus-I', 3, '2021-08-28 07:17:19', '2021-08-28 07:17:19'),
('SME-310', 'Software Engineering', 3, '2021-08-28 07:17:19', '2021-08-28 07:17:19');

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `reg_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`reg_id`, `first_name`, `last_name`, `email`, `phone`, `created_at`, `updated_at`) VALUES
('INS-001', 'Javed', 'Shahani', 'javed@gmail.com', '923128943890', '2021-08-28 08:53:52', '2021-08-28 08:53:52'),
('INS-010', 'Dr', 'Sher', 'sher@gmail.comm', '923128978302', '2021-08-28 08:53:52', '2021-08-28 08:53:52'),
('INS-110', 'Asif Raza', 'Shah', 'asifraza@gmail.com', '923127898320', '2021-08-28 08:53:52', '2021-08-28 08:53:52'),
('INS-302', 'Abdul', 'Rehman', 'rehman@gmail.com', '923109328973', '2021-08-28 08:53:52', '2021-08-28 08:53:52');

-- --------------------------------------------------------

--
-- Table structure for table `makeup_exam_applications`
--

CREATE TABLE `makeup_exam_applications` (
  `id` bigint UNSIGNED NOT NULL,
  `student_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instructor_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `term` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2021_02_14_105914_create_admins_table', 1),
(5, '2021_05_10_170106_create_attendance_applications_table', 1),
(7, '2021_05_10_170106_create_makeup_exam_applications_table', 1),
(8, '2021_05_10_170106_create_withdrawal_applications_table', 1),
(9, '2021_07_11_113750_students', 2),
(10, '2021_07_11_113824_instructors', 2),
(11, '2021_07_11_113843_courses', 2),
(13, '2021_07_11_113946_attendance_records', 4),
(14, '2021_07_11_114145_transaction_historys', 4),
(15, '2021_07_11_113940_registrations', 5),
(16, '2021_08_23_104351_laratrust_setup_tables', 6),
(19, '2014_10_12_000000_create_users_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'users-create', 'Create Users', 'Create Users', '2021-08-23 07:00:12', '2021-08-23 07:00:12'),
(2, 'users-read', 'Read Users', 'Read Users', '2021-08-23 07:00:12', '2021-08-23 07:00:12'),
(3, 'users-update', 'Update Users', 'Update Users', '2021-08-23 07:00:12', '2021-08-23 07:00:12'),
(4, 'users-delete', 'Delete Users', 'Delete Users', '2021-08-23 07:00:12', '2021-08-23 07:00:12'),
(5, 'meeting-create', 'Create Meeting', 'Create Meeting', '2021-08-23 07:00:13', '2021-08-23 07:00:13'),
(6, 'meeting-read', 'Read Meeting', 'Read Meeting', '2021-08-23 07:00:13', '2021-08-23 07:00:13'),
(7, 'meeting-update', 'Update Meeting', 'Update Meeting', '2021-08-23 07:00:13', '2021-08-23 07:00:13'),
(8, 'meeting-delete', 'Delete Meeting', 'Delete Meeting', '2021-08-23 07:00:13', '2021-08-23 07:00:13'),
(9, 'application-create', 'Create Application', 'Create Application', '2021-08-23 07:00:13', '2021-08-23 07:00:13'),
(10, 'application-read', 'Read Application', 'Read Application', '2021-08-23 07:00:13', '2021-08-23 07:00:13'),
(11, 'application-update', 'Update Application', 'Update Application', '2021-08-23 07:00:13', '2021-08-23 07:00:13'),
(12, 'application-delete', 'Delete Application', 'Delete Application', '2021-08-23 07:00:13', '2021-08-23 07:00:13'),
(13, 'profile-read', 'Read Profile', 'Read Profile', '2021-08-23 07:00:13', '2021-08-23 07:00:13'),
(14, 'profile-update', 'Update Profile', 'Update Profile', '2021-08-23 07:00:14', '2021-08-23 07:00:14');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(6, 3),
(7, 3),
(10, 3),
(11, 3),
(6, 4),
(10, 4),
(11, 4),
(6, 5),
(9, 5),
(10, 5),
(11, 5),
(12, 5);

-- --------------------------------------------------------

--
-- Table structure for table `permission_user`
--

CREATE TABLE `permission_user` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `student_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instructor_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`student_id`, `course_id`, `instructor_id`, `created_at`, `updated_at`) VALUES
('021-17-0015', 'CSC-302', 'INS-302', '2021-08-28 09:07:12', '2021-08-28 09:07:12'),
('021-17-0015', 'CSC-401', 'INS-110', '2021-08-28 09:07:12', '2021-08-28 09:07:12'),
('021-17-0015', 'CSC-403', 'INS-010', '2021-08-28 09:07:12', '2021-08-28 09:07:12'),
('021-17-0015', 'SME-310', 'INS-302', '2021-08-28 09:07:12', '2021-08-28 09:07:12'),
('021-17-0037', 'CSC-302', 'INS-302', '2021-08-28 09:07:12', '2021-08-28 09:07:12'),
('021-17-0037', 'CSC-401', 'INS-110', '2021-08-28 09:07:12', '2021-08-28 09:07:12'),
('021-17-0037', 'CSC-403', 'INS-010', '2021-08-28 09:07:12', '2021-08-28 09:07:12'),
('021-17-0037', 'MTS-102', 'INS-001', '2021-08-28 09:07:12', '2021-08-28 09:07:12'),
('021-17-0037', 'SME-310', 'INS-302', '2021-08-28 09:07:12', '2021-08-28 09:07:12'),
('021-17-0043', 'CSC-302', 'INS-302', '2021-08-28 09:07:12', '2021-08-28 09:07:12'),
('021-17-0043', 'CSC-401', 'INS-110', '2021-08-28 09:07:12', '2021-08-28 09:07:12'),
('021-17-0043', 'CSC-403', 'INS-010', '2021-08-28 09:07:12', '2021-08-28 09:07:12'),
('021-17-0043', 'MTS-019', 'INS-010', '2021-08-28 09:07:12', '2021-08-28 09:07:12'),
('021-17-0043', 'MTS-102', 'INS-001', '2021-08-28 09:07:12', '2021-08-28 09:07:12'),
('021-17-0043', 'SME-310', 'INS-302', '2021-08-28 09:07:12', '2021-08-28 09:07:12'),
('051-17-0037', 'CSC-302', 'INS-302', '2021-08-28 09:07:12', '2021-08-28 09:07:12'),
('051-17-0037', 'MTS-019', 'INS-010', '2021-08-28 09:07:12', '2021-08-28 09:07:12'),
('051-17-0037', 'MTS-102', 'INS-001', '2021-08-28 09:07:12', '2021-08-28 09:07:12'),
('051-17-0037', 'SME-310', 'INS-302', '2021-08-28 09:07:12', '2021-08-28 09:07:12');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', 'Admin', '2021-08-23 07:00:12', '2021-08-23 07:00:12'),
(2, 'secretary', 'Secretary', 'Secretary', '2021-08-23 07:00:15', '2021-08-23 07:00:15'),
(3, 'jury', 'Jury', 'Jury', '2021-08-23 07:00:16', '2021-08-23 07:00:16'),
(4, 'instructor', 'Instructor', 'Instructor', '2021-08-23 07:00:17', '2021-08-23 07:00:17'),
(5, 'student', 'Student', 'Student', '2021-08-23 07:00:17', '2021-08-23 07:00:17');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `role_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`, `user_type`) VALUES
(1, 3, 'App\\Models\\User'),
(2, 14, 'App\\Models\\User'),
(3, 11, 'App\\Models\\User'),
(3, 12, 'App\\Models\\User'),
(3, 13, 'App\\Models\\User'),
(4, 7, 'App\\Models\\User'),
(4, 8, 'App\\Models\\User'),
(4, 9, 'App\\Models\\User'),
(4, 10, 'App\\Models\\User'),
(5, 2, 'App\\Models\\User'),
(5, 4, 'App\\Models\\User'),
(5, 5, 'App\\Models\\User'),
(5, 6, 'App\\Models\\User');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `reg_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`reg_id`, `first_name`, `last_name`, `email`, `phone`, `created_at`, `updated_at`) VALUES
('021-17-0037', 'Shakeel', 'Ahmed', 'shakeel@gmail.com', '923312690628', '2021-08-28 07:04:27', '2021-08-28 07:03:13'),
('051-17-0037', 'Fattah', 'Hussain', 'fattah@iba-suk.edu.pk', '923312568903', '2021-08-28 07:03:13', '2021-08-28 07:03:13'),
('021-17-0043', 'Shahzeb', 'Mahesar', 'shahzeb@gmail.com', '923312367389', '2021-08-28 07:04:27', '2021-08-28 07:04:27'),
('021-17-0015', 'Sham', 'Kumar', 'sham@gmail.com', '923419383091', '2021-08-28 07:04:27', '2021-08-28 07:04:27');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_historys`
--

CREATE TABLE `transaction_historys` (
  `id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `reg_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `reg_id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(2, '021-17-0037', 'Shakeel Babar', 'shakeel@gmail.com', '$2y$10$iBtCCrSQNHdTbxLQyaJlDuU4/aNLRb3pogk.rrTwHfpIJbiXC0WHa', '2021-08-27 12:57:25', '2021-08-27 12:57:25'),
(3, 'Admin-021', 'Admin-I', 'admin@gmail.com', '$2y$10$WtrUUUM1mY6vGV7ntZkQ1OT8YroG4unfT4vB2xreUgxGmr06DV96C', '2021-08-27 08:11:15', '2021-08-27 08:11:15'),
(4, '051-17-0037', 'Fattah Hussain', 'fattah@iba-suk.edu.pk', '$2y$10$NCDSvGlmjzGd.mi3Gtg06OpLl6prdNxikq.WIE.s.RaymxWjxjMKa', '2021-08-27 08:19:44', '2021-08-27 08:19:44'),
(5, '021-17-0043', 'Shahzeb Mahesar', 'shahzeb@gmail.com', '$2y$10$xZMjMvgsDhtxJXK7YbAs5.D9NibOTHU2GsAUlTgceO92i68sNN7P.', '2021-08-28 02:12:26', '2021-08-28 02:12:26'),
(6, '021-17-0015', 'Sham Kumar', 'sham@gmail.com', '$2y$10$Si.6OQ5KNWbwXUskA024FOfy6BtWmLG94Ei2sM5akAvzksE4htiT6', '2021-08-28 02:13:13', '2021-08-28 02:13:13'),
(7, 'INS-001', 'Javed Shahani', 'javed@gmail.com', '$2y$10$9CdzIdZBkjIQvJFIaMBLOuhuM32KCRr0sD/tgB6nnIFU75tyY4IFe', '2021-08-28 02:22:27', '2021-08-28 02:22:27'),
(8, 'INS-010', 'Dr. Sher', 'sher@gmail.com', '$2y$10$HXRlt2pXu0.bW7zWiNr1/ulvo0OJvngRutXE061/STfvLVDcAzqOO', '2021-08-28 03:37:23', '2021-08-28 03:37:23'),
(9, 'INS-302', 'Abdul Rehman', 'rehman@gmail.com', '$2y$10$zy/.6sGRZtO2pN1dY4g0heC9pxfRsBI7ZPA6Bprxdhijgp/axsGFi', '2021-08-28 03:38:39', '2021-08-28 03:38:39'),
(10, 'INS-110', 'Asif Raza Shah', 'asifraza@gmail.com', '$2y$10$DUTmDNpEopBprdcuKj.pbu8rYwlUY14uj5qeRDrW9alwecoY7OkLu', '2021-08-28 03:39:44', '2021-08-28 03:39:44'),
(11, 'INS-101', 'A Rehman Soomrani', 'rehmansoomrani@gmail.com', '$2y$10$dEKZcivuKVTVM3vezcEZCe4x/6xpw9rhcAxvexoRHYTQqxffzn4UC', '2021-08-28 03:46:54', '2021-08-28 03:46:54'),
(12, 'INS-200', 'Manzoor Meerani', 'manzoor@gmail.com', '$2y$10$2hu/yJ2LD7lJFt.wWR/tqu9nBwAA.jEQv6az7/VU/HSlwYaDYFJbq', '2021-08-28 03:48:34', '2021-08-28 03:48:34'),
(13, 'STF-001', 'Zahid Hussain', 'zahid@gmail.com', '$2y$10$v1jxqiewrr0nkT2y73FEDOoATdGey/YnWKdaLnPpjv5cjOBmNPvSm', '2021-08-28 03:49:28', '2021-08-28 03:49:28'),
(14, 'STF-002', 'Mazhar Ali', 'mazhar@gmail.com', '$2y$10$ZnRhbPEcR3Dyb/XnCzG96.atBmmK6SPDb7l/8uC4qK51XukF1dT5e', '2021-08-28 03:52:38', '2021-08-28 03:52:38');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawal_applications`
--

CREATE TABLE `withdrawal_applications` (
  `id` bigint UNSIGNED NOT NULL,
  `student_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instructor_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance_applications`
--
ALTER TABLE `attendance_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance_records`
--
ALTER TABLE `attendance_records`
  ADD PRIMARY KEY (`student_id`,`course_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`crs_id`);

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`reg_id`);

--
-- Indexes for table `makeup_exam_applications`
--
ALTER TABLE `makeup_exam_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD PRIMARY KEY (`user_id`,`permission_id`,`user_type`),
  ADD KEY `permission_user_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`student_id`,`course_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`,`user_type`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `transaction_historys`
--
ALTER TABLE `transaction_historys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdrawal_applications`
--
ALTER TABLE `withdrawal_applications`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance_applications`
--
ALTER TABLE `attendance_applications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `makeup_exam_applications`
--
ALTER TABLE `makeup_exam_applications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaction_historys`
--
ALTER TABLE `transaction_historys`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `withdrawal_applications`
--
ALTER TABLE `withdrawal_applications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
