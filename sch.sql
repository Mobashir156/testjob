-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 15, 2025 at 01:57 PM
-- Server version: 5.7.24
-- PHP Version: 8.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sch`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `headmaster_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `original_image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resized_image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scheduled_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_sent` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `headmaster_id`, `title`, `description`, `original_image_path`, `resized_image_path`, `scheduled_at`, `is_sent`, `created_at`, `updated_at`) VALUES
(6, 1, 'tet', 'tet', 'announcements/original/92fcd0a52b784ed4e0c3f417b40b654e.jpg', 'announcements/resized/8061c3d2-b1d4-4edd-ba7d-3e83bbb47056.webp', '2025-04-15 13:44:00', 0, '2025-04-15 07:47:03', '2025-04-15 07:47:03'),
(7, 1, 'test', 'test', 'announcements/original/2ea2a02bc28a6b272aa7afc4a17e08b4.jpg', 'announcements/resized/7ca23837-e771-4025-bee9-33748b690e86.webp', '2025-04-15 13:48:00', 0, '2025-04-15 07:48:04', '2025-04-15 07:48:04'),
(8, 1, 'tet', 'test', 'announcements/original/yen9XiLxmXt9bKtCeWO3FaVAM6ZSiwRpuYw4Wdua.jpg', 'announcements/resized/79677b5b-d175-4c31-be74-b1e13fa3175f.webp', '2025-04-15 13:49:00', 0, '2025-04-15 07:49:09', '2025-04-15 07:49:09'),
(9, 1, 'new', 'new', 'announcements/original/YSWf6ghkFUxNvCLETLhLFrKRGkBYvc3NOOq98bAq.jpg', 'announcements/resized/49d8ec7b-9409-45a2-8f62-d22ecd8e3439.webp', '2025-04-15 13:50:00', 0, '2025-04-15 07:50:45', '2025-04-15 07:50:45');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_04_13_143333_create_students_table', 1),
(5, '2025_04_13_143343_create_tasks_table', 1),
(6, '2025_04_13_143351_create_submissions_table', 1),
(7, '2025_04_13_143358_create_announcements_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('FJxXiZi0BkLwJ1TYv9Jwi9GRq07sB47uqwSTC7xu', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiem9kbUpZSzBzeHczVmVwdTRuUDFqZTRVNGtVSWFLRGZBUDV5TnBxbCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjIxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1744725332);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `roll_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `user_id`, `teacher_id`, `class`, `section`, `roll_number`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 2, NULL, NULL, NULL, '2025-04-13 12:06:32', '2025-04-13 12:06:32', NULL),
(8, 10, 2, '10', 'a', '1', '2025-04-15 06:46:20', '2025-04-15 06:46:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `task_id` bigint(20) UNSIGNED NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `feedback` text COLLATE utf8mb4_unicode_ci,
  `feedback_by` bigint(20) UNSIGNED DEFAULT NULL,
  `feedback_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`id`, `task_id`, `notes`, `file_path`, `feedback`, `feedback_by`, `feedback_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'dfdffdf', NULL, 'nice', 2, '2025-04-15 17:08:03', '2025-04-15 10:54:30', '2025-04-15 11:10:26');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `teacher_id`, `student_id`, `title`, `description`, `approved_at`, `approved_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, 'Math test', 'htyyy', '2025-04-14 12:02:51', 1, '2025-04-14 06:56:33', '2025-04-14 12:02:51', NULL),
(2, 2, 1, 'test', 'hig', '2025-04-15 12:43:02', 1, '2025-04-15 12:37:33', '2025-04-15 12:43:02', NULL),
(3, 2, 8, 'math task', 'test', '2025-04-15 07:12:59', 1, '2025-04-15 06:55:41', '2025-04-15 07:12:59', NULL),
(4, 2, 8, 'math task', 'test', '2025-04-15 07:12:57', 1, '2025-04-15 06:56:04', '2025-04-15 07:12:57', NULL),
(5, 2, 8, 'hi', 'hi', '2025-04-15 07:12:54', 1, '2025-04-15 06:56:59', '2025-04-15 07:12:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('headmaster','teacher','student') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'student',
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permissions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `phone`, `remember_token`, `permissions`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Mobashir Raihan', 'mobashirraihan125@gmail.com', NULL, '$2y$12$8w/uRK1zVK.TyhyZ9ojil.8P/WC7rG0KYtCaRm1jMK2ciGviWehI2', 'headmaster', '01628095603', NULL, '{\"tasks\": {\"edit\": true, \"create\": true, \"delete\": true, \"submit\": false, \"approve\": true, \"view_all\": true, \"give_feedback\": false}, \"profile\": {\"edit\": true, \"view\": true, \"change_password\": true}, \"students\": {\"edit\": true, \"create\": true, \"delete\": true, \"view_all\": true, \"request_delete\": false}, \"teachers\": {\"edit\": true, \"view\": true, \"create\": true, \"delete\": true, \"manage_permissions\": true}, \"dashboard\": {\"view\": true}, \"announcements\": {\"edit\": true, \"view\": true, \"create\": true, \"delete\": true, \"publish\": true}}', '2025-04-13 12:04:00', '2025-04-14 05:56:05', NULL),
(2, 'Fahim hasan', 'teacher@gmail.com', NULL, '$2y$12$7Ai8lCUMtRuXSeghBSPA2ukz3k0RBRZFZFafosW/TxVzY93sPDYyS', 'teacher', NULL, NULL, '{\"tasks\": {\"edit\": true, \"view\": true, \"create\": true, \"submit\": false, \"approve\": false, \"delete_own\": true, \"give_feedback\": true}, \"profile\": {\"edit\": true, \"view\": true, \"change_password\": true}, \"students\": {\"create\": true, \"delete\": true, \"edit_own\": true, \"view_all\": true, \"request_delete\": true}, \"teachers\": {\"edit\": false, \"view\": false, \"create\": false, \"delete\": false, \"manage_permissions\": false}, \"dashboard\": {\"view\": true}, \"announcements\": {\"edit\": false, \"view\": false, \"create\": false, \"delete\": false, \"publish\": false}}', '2025-04-13 12:05:14', '2025-04-13 12:05:14', NULL),
(3, 'Fahim hasan', 'student@gmail.com', NULL, '$2y$12$5Jq1a261kplkQYXmnegiO.RCUp7e5Y8a3RXv3TAWNg6m92ocFcdPC', 'student', NULL, NULL, '{\"tasks\": {\"edit\": false, \"create\": false, \"delete\": false, \"submit\": true, \"approve\": false, \"give_feedback\": false, \"view_assigned\": true}, \"profile\": {\"edit\": true, \"view\": true, \"change_password\": true}, \"students\": {\"edit\": false, \"create\": false, \"delete\": false, \"view_own\": true, \"request_delete\": false}, \"teachers\": {\"edit\": false, \"view\": false, \"create\": false, \"delete\": false, \"manage_permissions\": false}, \"dashboard\": {\"view\": true}, \"announcements\": {\"edit\": false, \"view\": false, \"create\": false, \"delete\": false, \"publish\": false}}', '2025-04-13 12:06:32', '2025-04-13 12:06:32', NULL),
(10, 'Mobashir Raihan', 'onlinelearningpoint83@gmail.com', NULL, '$2y$12$GGHXF6NNpFhgcdOmX.bMiul0sfkbjahByRgGVof0oh08Na9OnYS7e', 'student', '01789957078', NULL, NULL, '2025-04-15 06:46:20', '2025-04-15 06:46:20', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `announcements_headmaster_id_foreign` (`headmaster_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `students_user_id_foreign` (`user_id`),
  ADD KEY `students_teacher_id_foreign` (`teacher_id`);

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `submissions_task_id_foreign` (`task_id`),
  ADD KEY `submissions_feedback_by_foreign` (`feedback_by`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_teacher_id_foreign` (`teacher_id`),
  ADD KEY `tasks_student_id_foreign` (`student_id`),
  ADD KEY `tasks_approved_by_foreign` (`approved_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `announcements`
--
ALTER TABLE `announcements`
  ADD CONSTRAINT `announcements_headmaster_id_foreign` FOREIGN KEY (`headmaster_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `students_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `submissions`
--
ALTER TABLE `submissions`
  ADD CONSTRAINT `submissions_feedback_by_foreign` FOREIGN KEY (`feedback_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `submissions_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tasks_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tasks_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
