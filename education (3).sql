-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2024 at 08:20 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `education`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mark` int(11) NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `groupid` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `team` varchar(255) DEFAULT NULL,
  `fullmark` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `article_name` varchar(255) DEFAULT NULL,
  `article_description` text DEFAULT NULL,
  `allow_comment` tinyint(4) NOT NULL DEFAULT 1,
  `tags` varchar(255) DEFAULT NULL,
  `type` tinyint(4) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `article_name`, `article_description`, `allow_comment`, `tags`, `type`, `user_id`, `category_id`, `created_at`, `updated_at`) VALUES
(14, 'sds', 'dsds', 1, NULL, 1, 1, 1, '2023-12-16 10:01:57', '2023-12-16 10:01:57');

-- --------------------------------------------------------

--
-- Table structure for table `audio`
--

CREATE TABLE `audio` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `audio_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audio`
--

INSERT INTO `audio` (`id`, `url`, `filename`, `audio_name`, `description`, `status`, `user_id`, `category_id`, `created_at`, `updated_at`) VALUES
(4, 'http://localhost/working/mahmoudabdelqader/storage/audios/2023-10-31/audio_1698772834.mp3', 'audio_1698772834.mp3', 'بلي', 'لبلبي', 1, 1, 1, '2023-10-31 15:20:34', '2023-10-31 15:20:34');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_description` text DEFAULT NULL,
  `parent` int(11) NOT NULL DEFAULT 0,
  `Visibility` tinyint(4) NOT NULL DEFAULT 1,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_description`, `parent`, `Visibility`, `user_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 'الصف الأول الثانوي', 'الصف الأول الثانوي', 0, 1, 1, NULL, '2022-06-09 11:55:32', '2022-06-09 11:55:32'),
(2, 'الصف الثاني الثانوي', 'الصف الثاني الثانوي', 0, 1, 1, NULL, '2022-06-09 11:58:38', '2022-06-09 11:58:38'),
(3, 'الصف الثالث الثانوي', 'الصف الثالث الثانوي', 0, 1, 1, NULL, '2022-06-09 12:01:15', '2022-06-09 12:01:15'),
(56, 'الوحدة الاولى', NULL, 1, 1, 1, 'http://localhost/working/drsherifwaly/web_files/header/h3.jpg', '2023-10-31 14:54:59', '2023-12-17 11:28:36');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `comment` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `lesson_id` bigint(20) UNSIGNED DEFAULT NULL,
  `article_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `status`, `user_id`, `post_id`, `lesson_id`, `article_id`, `created_at`, `updated_at`) VALUES
(27, 'vcxbcvb', 0, 1, NULL, NULL, 14, '2023-12-16 15:59:51', '2023-12-16 15:59:51'),
(28, 'hjkghk', 0, 1, 22, NULL, NULL, '2023-12-16 16:03:55', '2023-12-16 16:03:55'),
(29, 'wfwefw', 0, 1, 22, NULL, NULL, '2023-12-17 11:19:06', '2023-12-17 11:19:06'),
(30, 'wsdqds', 0, 1, NULL, NULL, 14, '2023-12-17 11:19:42', '2023-12-17 11:19:42');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `events_name` varchar(255) DEFAULT NULL,
  `events_description` text DEFAULT NULL,
  `events_time` time DEFAULT NULL,
  `events_date` date DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `events_name`, `events_description`, `events_time`, `events_date`, `user_id`, `category_id`, `created_at`, `updated_at`) VALUES
(8, 'الحصة القادمة نحو', 'موعد الحصة القادمة نحو', '19:21:00', '2023-11-01', 1, 1, '2023-10-31 15:21:34', '2023-10-31 15:21:34');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_name` varchar(255) DEFAULT NULL,
  `exam_desc` text DEFAULT NULL,
  `number` int(11) NOT NULL DEFAULT 10,
  `time` int(11) NOT NULL DEFAULT 600,
  `type` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=>part,1=>full,2=>link',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `lesson_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `exam_name`, `exam_desc`, `number`, `time`, `type`, `user_id`, `category_id`, `lesson_id`, `created_at`, `updated_at`) VALUES
(21, 'nghg', 'https://www.youtube.com/watch?v=qgAPoKxw59Y', 10, 600, 2, 1, 2, NULL, '2023-10-31 15:15:06', '2023-10-31 15:15:06'),
(22, 'jkuh', 'ghjgjy', 5, 5, 1, 1, 1, NULL, '2023-10-31 15:15:39', '2023-10-31 15:15:39'),
(23, 'يسبثسي', 'سيبسي', 5, 5, 0, 1, NULL, 39, '2023-10-31 15:18:56', '2023-10-31 15:18:56'),
(24, 'yrere', NULL, 5, 5, 0, 1, NULL, 39, '2023-12-17 11:35:28', '2023-12-17 11:35:28'),
(25, 'qewqw', NULL, 5, 5, 1, 1, 1, NULL, '2023-12-17 11:37:08', '2023-12-17 11:37:08');

-- --------------------------------------------------------

--
-- Table structure for table `exam_parts`
--

CREATE TABLE `exam_parts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `part_name` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_parts`
--

INSERT INTO `exam_parts` (`id`, `part_name`, `photo`, `exam_id`, `filename`, `created_at`, `updated_at`) VALUES
(10, 'kp,', NULL, 22, NULL, '2023-10-31 15:16:42', '2023-10-31 15:16:42'),
(11, 'dadas', NULL, 25, NULL, '2023-12-17 11:37:26', '2023-12-17 11:37:26');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `article_id` bigint(20) UNSIGNED DEFAULT NULL,
  `event_id` bigint(20) UNSIGNED DEFAULT NULL,
  `setting_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `url`, `filename`, `post_id`, `article_id`, `event_id`, `setting_id`, `created_at`, `updated_at`) VALUES
(73, 'http://localhost/working/raafatgaber/storage/users/2023-09-02/main_1693661239.jpg', 'tops', 21, NULL, NULL, NULL, '2023-10-31 14:54:06', '2023-10-31 14:54:06'),
(74, 'http://localhost/working/drsherifwaly/storage/posts/2023-12-16/Leonardo_Diffusion_XL_i_want_an_biology_image_0_1702728084.jpg', 'Leonardo_Diffusion_XL_i_want_an_biology_image_0_1702728084.jpg', 22, NULL, NULL, NULL, '2023-12-16 10:01:24', '2023-12-16 10:01:24'),
(75, 'http://localhost/working/drsherifwaly/storage/articles/2023-12-16/Leonardo_Diffusion_XL_i_want_an_biology_image_1_1702728117.jpg', 'Leonardo_Diffusion_XL_i_want_an_biology_image_1_1702728117.jpg', NULL, 14, NULL, NULL, '2023-12-16 10:01:57', '2023-12-16 10:01:57'),
(76, 'http://localhost/working/raafatgaber/storage/users/2023-09-02/main_1693661239.jpg', 'tops', 23, NULL, NULL, NULL, '2023-12-17 11:41:44', '2023-12-17 11:41:44');

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lesson_name` varchar(255) DEFAULT NULL,
  `lesson_description` text DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `video_name` text DEFAULT NULL,
  `vfilename` varchar(255) DEFAULT NULL,
  `imagethumb` varchar(255) DEFAULT NULL,
  `pdffilename` varchar(255) DEFAULT NULL,
  `allow_comment` tinyint(4) NOT NULL DEFAULT 1,
  `approve` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=>with exam',
  `pdf` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `lesson_name`, `lesson_description`, `video`, `video_name`, `vfilename`, `imagethumb`, `pdffilename`, `allow_comment`, `approve`, `pdf`, `user_id`, `status`, `category_id`, `created_at`, `updated_at`) VALUES
(37, 'ahmed', NULL, NULL, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/qgAPoKxw59Y?si=pX6DXyzC6IBE_U5H\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', NULL, NULL, NULL, 1, 0, NULL, 1, 1, 56, '2023-10-31 15:02:26', '2023-10-31 15:02:26'),
(38, 'احمد', NULL, NULL, 'cvcbc', NULL, NULL, NULL, 1, 1, NULL, 1, 1, 56, '2023-10-31 15:09:45', '2023-10-31 15:09:45'),
(39, 'حسام', NULL, NULL, 'سصيسي', NULL, NULL, NULL, 1, 1, NULL, 1, 1, 56, '2023-10-31 15:18:24', '2023-10-31 15:18:24');

-- --------------------------------------------------------

--
-- Table structure for table `lesson_members`
--

CREATE TABLE `lesson_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 1,
  `lesson_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `end_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lives`
--

CREATE TABLE `lives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `message` text DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `content` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `read_at` datetime DEFAULT NULL,
  `type` enum('newUser','comment','post','lesson','article','event','live','audio','exam','fullExam') DEFAULT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `content`, `model`, `read_at`, `type`, `model_id`, `created_at`, `updated_at`) VALUES
(36, 214, 'تم اضافة مستخدم جديد', 'User', NULL, 'newUser', 214, '2023-12-16 09:00:55', '2023-12-16 09:00:55'),
(37, 215, 'تم اضافة مستخدم جديد', 'User', NULL, 'newUser', 215, '2023-12-17 11:14:26', '2023-12-17 11:14:26'),
(38, 216, 'تم اضافة مستخدم جديد', 'User', NULL, 'newUser', 216, '2023-12-18 11:14:07', '2023-12-18 11:14:07');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_name` varchar(255) DEFAULT NULL,
  `post_description` text DEFAULT NULL,
  `allow_comment` tinyint(4) NOT NULL DEFAULT 1,
  `tags` varchar(255) DEFAULT NULL,
  `type` tinyint(4) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `likecount` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `post_name`, `post_description`, `allow_comment`, `tags`, `type`, `user_id`, `category_id`, `likecount`, `created_at`, `updated_at`) VALUES
(21, 'الطلاب المتفوقين', 'الطلاب المتفوقين للصف الصف الثاني الثانوي<br>الطالب <b class=\"text-primary\">ahmed mohamed goma</b>', 1, 'الطلاب_المتفوقين', 1, 1, 2, 0, '2023-10-31 14:54:06', '2023-10-31 14:54:06'),
(22, 'fdzfs', 'sdfsd', 1, NULL, 1, 1, 1, 3, '2023-12-16 10:01:24', '2023-12-17 11:19:03'),
(23, 'الطلاب المتفوقين', 'الطلاب المتفوقين للصف الصف الأول الثانوي<br>الطالب <b class=\"text-primary\">ahmed mohamed goma</b>', 1, 'الطلاب_المتفوقين', 1, 1, 1, 0, '2023-12-17 11:41:44', '2023-12-17 11:41:44');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `answer_1` text DEFAULT NULL,
  `answer_2` text DEFAULT NULL,
  `answer_3` text DEFAULT NULL,
  `answer_4` text DEFAULT NULL,
  `answer` text DEFAULT NULL,
  `right_answer` text DEFAULT NULL,
  `part_id` bigint(20) UNSIGNED DEFAULT NULL,
  `exam_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `image`, `filename`, `answer_1`, `answer_2`, `answer_3`, `answer_4`, `answer`, `right_answer`, `part_id`, `exam_id`, `created_at`, `updated_at`) VALUES
(55, 'a', NULL, NULL, 'a', 'aa', 'aaa', 'aaaa', NULL, 'a', NULL, 24, '2023-12-17 11:36:13', '2023-12-17 11:36:13');

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE `quotes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `about_us` text DEFAULT NULL,
  `video_1` varchar(255) DEFAULT NULL,
  `video_2` varchar(255) DEFAULT NULL,
  `video_3` varchar(255) DEFAULT NULL,
  `video_4` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tops`
--

CREATE TABLE `tops` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tops`
--

INSERT INTO `tops` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(11, 1, '2023-12-17 11:41:44', '2023-12-17 11:41:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `groupid` int(11) NOT NULL DEFAULT 0,
  `avatar` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `only` tinyint(4) NOT NULL DEFAULT 0,
  `mac` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `username`, `groupid`, `avatar`, `phone`, `status`, `only`, `mac`, `remember_token`, `filename`, `created_at`, `updated_at`) VALUES
(1, 'ahmed mohamed goma', 'aa@a.com', NULL, '$2y$10$E9Y.3671FoECLqyDwpJN8.JqP8f609S.aO6wf7fQT7dfZqLu.qMq6', '123123', 3, 'http://localhost/working/raafatgaber/storage/users/2023-09-02/main_1693661239.jpg', '245454', 1, 1, '', NULL, 'main_1693661239.jpg', '2022-06-09 08:40:29', '2023-12-17 11:43:51'),
(214, 'احمد الطارون', NULL, NULL, '$2y$10$pDW5Qs.mfbyJjoMZ8JIGN.7xmYQ4MOIZ00aPtMJ7ZIUWlHYjYHjwi', '63605937', 2, NULL, '123123', 0, 0, '::1', NULL, NULL, '2023-12-16 09:00:55', '2023-12-17 11:43:29'),
(215, 'wefrweqe', NULL, NULL, '$2y$10$wJ0IP9RATFq0IyN7i1N7f.KdVe0N2lGQ17xsdS2MLn7QOy9AKfJte', '75521530', 2, NULL, '010524747', 0, 0, '::1', NULL, NULL, '2023-12-17 11:14:26', '2023-12-17 11:14:26'),
(216, 'yyrhrt', NULL, NULL, '$2y$10$bgcVRHzR/IaW32q5tY5o0u4SOFfDeuaD.TbQ3CDWzZaj3d9XrBWOW', '88575475', 2, NULL, '45456', 0, 0, '::1', NULL, NULL, '2023-12-18 11:14:07', '2023-12-18 11:14:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_answer` (`exam_id`),
  ADD KEY `user_answer` (`user_id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_articles` (`user_id`),
  ADD KEY `category_articles` (`category_id`);

--
-- Indexes for table `audio`
--
ALTER TABLE `audio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_audios` (`user_id`),
  ADD KEY `category_audios` (`category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_categories` (`user_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lesson_comments` (`lesson_id`),
  ADD KEY `post_comments` (`post_id`),
  ADD KEY `user_comments` (`user_id`),
  ADD KEY `article_comment` (`article_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_category` (`category_id`),
  ADD KEY `user_category` (`user_id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_exam` (`category_id`),
  ADD KEY `lesson_exam` (`lesson_id`),
  ADD KEY `user_exam` (`user_id`);

--
-- Indexes for table `exam_parts`
--
ALTER TABLE `exam_parts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_part` (`exam_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_images` (`article_id`),
  ADD KEY `evant_images` (`event_id`),
  ADD KEY `post_images` (`post_id`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_lesson` (`category_id`),
  ADD KEY `user_lesson` (`user_id`);

--
-- Indexes for table `lesson_members`
--
ALTER TABLE `lesson_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lesson_members1` (`lesson_id`),
  ADD KEY `lesson_members2` (`user_id`);

--
-- Indexes for table `lives`
--
ALTER TABLE `lives`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_lives` (`user_id`),
  ADD KEY `category_lives` (`category_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_user` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_notification` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_post` (`category_id`),
  ADD KEY `user_post` (`user_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_questions` (`exam_id`),
  ADD KEY `part_questions` (`part_id`);

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tops`
--
ALTER TABLE `tops`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `audio`
--
ALTER TABLE `audio`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `exam_parts`
--
ALTER TABLE `exam_parts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `lesson_members`
--
ALTER TABLE `lesson_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `lives`
--
ALTER TABLE `lives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tops`
--
ALTER TABLE `tops`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `exam_answer` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_answer` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `category_articles` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_articles` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `audio`
--
ALTER TABLE `audio`
  ADD CONSTRAINT `category_audios` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_audios` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `user_categories` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `article_comment` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lesson_comments` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_comments` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_comments` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `event_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_category` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `category_exam` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lesson_exam` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_exam` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_parts`
--
ALTER TABLE `exam_parts`
  ADD CONSTRAINT `exam_part` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `article_images` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `evant_images` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_images` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `category_lesson` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_lesson` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lesson_members`
--
ALTER TABLE `lesson_members`
  ADD CONSTRAINT `lesson_members1` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lesson_members2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lives`
--
ALTER TABLE `lives`
  ADD CONSTRAINT `category_lives` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_lives` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `message_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `user_notification` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `category_post` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_post` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `exam_questions` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `part_questions` FOREIGN KEY (`part_id`) REFERENCES `exam_parts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quotes`
--
ALTER TABLE `quotes`
  ADD CONSTRAINT `quotes_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tops`
--
ALTER TABLE `tops`
  ADD CONSTRAINT `tops_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
