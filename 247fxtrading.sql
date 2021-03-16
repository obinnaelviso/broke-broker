-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 16 mars 2021 à 04:56
-- Version du serveur :  10.4.16-MariaDB
-- Version de PHP : 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `247fxtrading`
--

-- --------------------------------------------------------

--
-- Structure de la table `acc_stats`
--

CREATE TABLE `acc_stats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `acc_stats`
--

INSERT INTO `acc_stats` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'inactive', '2019-08-27 22:50:00', '2019-08-26 23:00:00'),
(2, 'active', '2019-08-26 23:00:00', '2019-08-26 23:00:00'),
(3, 'blocked', '2019-08-26 23:00:00', '2019-08-26 23:00:00'),
(4, 'new', '2019-09-06 13:26:22', '2019-09-06 13:26:22');

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acc_stat_id` bigint(20) UNSIGNED NOT NULL DEFAULT 4,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`id`, `first_name`, `last_name`, `gender`, `email`, `phone`, `address`, `state`, `email_verified_at`, `password`, `acc_stat_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Admin', 'male', 'admin@admin.com', '01234567890', 'Lucid', 'LA', '2019-09-16 22:50:47', '$2y$10$SfyzSKLYT05pKVWJNxzfVuJMxhJfmsL91LEJfKR5HSLV.xNxQgZrW', 2, '1PUopZGj3qXyNBlgY4PTfjL9OsUat7TxrhoeuVx3cYSXi4PjvdLY0CuZAL4O', '2019-09-05 09:12:28', '2019-09-16 22:50:47');

-- --------------------------------------------------------

--
-- Structure de la table `admin_mailings`
--

CREATE TABLE `admin_mailings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admin_mailings`
--

INSERT INTO `admin_mailings` (`id`, `admin_id`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(1, 1, 'Soooooooooooooooooooo', '<p>Dkakjald</p>\r\n\r\n<p>dkja</p>\r\n\r\n<p>dlajdkjkd</p>\r\n\r\n<p>adkj</p>\r\n\r\n<p>dklskd</p>\r\n\r\n<p>adja</p>\r\n\r\n<p>a</p>', '2019-09-24 08:46:22', '2019-09-24 08:46:22');

-- --------------------------------------------------------

--
-- Structure de la table `admin_msgs`
--

CREATE TABLE `admin_msgs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `message` varchar(255) NOT NULL,
  `service_stat_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admin_msgs`
--

INSERT INTO `admin_msgs` (`id`, `title`, `message`, `service_stat_id`, `created_at`, `updated_at`) VALUES
(1, '**New**', 'Welcome to nwallet.', 8, '2019-09-11 10:22:44', '2019-09-11 13:24:23');

-- --------------------------------------------------------

--
-- Structure de la table `assigned_pcs`
--

CREATE TABLE `assigned_pcs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `promo_code_id` bigint(20) UNSIGNED NOT NULL,
  `service_stat_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `assigned_pcs`
--

INSERT INTO `assigned_pcs` (`id`, `user_id`, `promo_code_id`, `service_stat_id`, `created_at`, `updated_at`) VALUES
(4, 1, 1, 9, '2019-09-08 14:32:22', '2019-09-08 23:34:42'),
(6, 4, 1, 1, '2019-09-08 14:32:22', '2019-09-08 14:32:22'),
(10, 9, 5, 9, '2019-09-09 15:05:46', '2019-09-09 15:05:46'),
(11, 10, 5, 9, '2019-09-24 09:43:49', '2019-09-24 09:43:49');

-- --------------------------------------------------------

--
-- Structure de la table `contact_forms`
--

CREATE TABLE `contact_forms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mailing_list_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `contact_forms`
--

INSERT INTO `contact_forms` (`id`, `mailing_list_id`, `name`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(2, 3, 'Obinna Okechukwu', 'Ishaga', 'Ijushaga Ijushaga', '2019-09-21 07:57:35', '2019-09-21 07:57:35'),
(3, 3, 'Obinna Okechukwu', 'Ishaga', 'Softest Ijushaga', '2019-09-21 08:04:19', '2019-09-21 08:04:19');

-- --------------------------------------------------------

--
-- Structure de la table `conversion_rates`
--

CREATE TABLE `conversion_rates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `currency_1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` decimal(20,2) UNSIGNED NOT NULL,
  `currency_2` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `conversion_rates`
--

INSERT INTO `conversion_rates` (`id`, `currency_1`, `value`, `currency_2`, `created_at`, `updated_at`) VALUES
(1, 'btc', '61210.96', 'usd', NULL, '2021-03-13 21:29:41');

-- --------------------------------------------------------

--
-- Structure de la table `default_transactions`
--

CREATE TABLE `default_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `initial_deposit` decimal(15,2) UNSIGNED NOT NULL,
  `profit_made` decimal(15,2) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `homepages`
--

CREATE TABLE `homepages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `body` varchar(1000) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `homepages`
--

INSERT INTO `homepages` (`id`, `name`, `title`, `body`, `img`, `created_at`, `updated_at`) VALUES
(1, 'header', '', 'Start sending and receiving payment today.', 'homepage/continents.jpg', '2019-09-15 14:53:58', '2019-09-16 17:41:02'),
(2, 'section 1', 'For Your business', 'Scale your business to reach global audience. Sell where you have not sold before and reach new customers all over the world. With our simple payment API, you can start accepting payments from all card types for local and international transactions....', '', '2019-09-15 14:53:58', '2019-09-16 11:08:03'),
(3, 'section 2', 'Why nwallet', '', 'homepage/banner4.jpg', '2019-09-15 14:53:58', '2019-09-16 17:41:02'),
(4, 'section 3', 'The services nwallet offers', 'Integrate payment into your product with our simple API or choose from over 20 plugins or extensions to save development time for your next project. Wordpress, Joomla etc are supported.', 'homepage/nwallet_bg.jpg', '2019-09-15 14:53:58', '2020-03-29 00:48:22'),
(5, 'section 3a', 'GOTV and DSTV Subscription', 'Lorem Ipsum is simply text the printing and typesetting standard industry.', 'homepage/alert.jpg', '2019-09-15 14:53:58', '2020-03-29 00:48:51'),
(6, 'section 4', 'Hear from our customers', '', 'homepage/banner3.jpg', '2019-09-15 14:53:58', '2019-09-16 17:43:52'),
(7, 'footer a', 'nwallet', 'nwallet is a user-friendly online payment platform that allows you to send and receive payment easily from anyone, in any currency. Accept payment through Card transaction and Bank transfers.', '', '2019-09-15 14:53:58', '2019-09-16 08:49:33'),
(8, 'footer b', 'Contact Info', '', '', '2019-09-15 14:53:58', '2019-09-16 07:54:10'),
(9, 'section 2a', 'International payments.', 'nwallet\'s global coverage allows consumers and businesses to safely make and receive payments in all major currencies, regardless of location.', NULL, '2019-09-16 07:42:54', '2019-09-16 07:42:54'),
(10, 'section 2b', 'Give your customers more ways to pay online.', 'Stop losing sales. Give your customers more ways to pay online: Internet banking (direct pay), wallet transfers, mobile payment, subscription billing.', NULL, '2019-09-16 07:42:54', '2019-09-16 11:07:33'),
(11, 'section 2c', 'Business Intelligence and analytics tools.', 'Get a bird\'s eye look of your sales, revenue and cashflow with detailed reports. We also send a weekly performance report to keep your updated.', NULL, '2019-09-16 07:42:54', '2019-09-16 11:07:33'),
(12, 'section 3b', 'Buy Cinema Tickets', 'Lorem Ipsum is simply text the printing and typesetting standard industry.', NULL, '2019-09-16 07:53:12', '2019-09-16 07:53:12'),
(13, 'section 3c', 'Airtime/Data Recharge', 'Lorem Ipsum is simply text the printing and typesetting standard industry.', NULL, '2019-09-16 07:53:12', '2019-09-16 07:53:12'),
(14, 'section 3d', 'Travel Tickets', 'Lorem Ipsum is simply text the printing and typesetting standard industry.', NULL, '2019-09-16 07:53:12', '2019-09-16 07:53:12'),
(15, 'section 4a', 'Clara Chinwe Okoro', 'Can testify of their credibility. I have never been stranded with voguepay. They are expert in treating customers. Thumbs up', NULL, '2019-09-16 07:53:12', '2019-09-16 08:18:56'),
(16, 'section 4b', 'Obinna Elvis', 'I\'ve been using nwallet for my website and it seems to be reliable so far... I recommend it to anyone interested in online payment', NULL, '2019-09-16 07:53:12', '2019-09-16 11:08:19'),
(17, 'section 4c', 'Tom Sulayman', 'I never believe that Nigerian product can be this globally competitive, i recommend voguepay to any serious online business owner', NULL, '2019-09-16 07:53:12', '2019-09-16 08:19:11'),
(18, 'contact address', '', 'No. 4 Ijaiye Str., Surulere, Lagos, Nigeria.', NULL, '2019-09-16 07:53:12', '2019-09-16 11:33:13'),
(19, 'contact phone', '', '08012345678', NULL, '2019-09-16 07:53:12', '2019-09-16 11:08:40'),
(20, 'contact email', '', 'info@example.com', NULL, '2019-09-16 07:53:12', '2019-09-16 08:46:43'),
(21, 'social facebook', 'facebook', '#', NULL, '2019-09-16 07:53:12', '2019-09-20 13:16:32'),
(22, 'social instagram', 'instagram', '#', NULL, '2019-09-16 07:53:12', '2019-09-20 13:16:34'),
(23, 'social twitter', 'twitter', '#', NULL, '2019-09-16 07:53:12', '2019-09-20 13:16:37');

-- --------------------------------------------------------

--
-- Structure de la table `investments`
--

CREATE TABLE `investments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `investment_plan_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(20,2) NOT NULL,
  `completed_cycles` int(11) NOT NULL DEFAULT 0,
  `expire_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `investments`
--

INSERT INTO `investments` (`id`, `user_id`, `investment_plan_id`, `amount`, `completed_cycles`, `expire_at`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 5, '700.00', 0, '2021-03-16 03:25:00', -1, '2021-03-16 01:09:41', '2021-03-16 03:25:00'),
(2, 1, 5, '600.00', 3, '2021-03-16 03:32:40', 1, '2021-03-16 03:28:02', '2021-03-16 03:30:31'),
(3, 1, 5, '1000.00', 3, '2021-03-16 03:34:27', 1, '2021-03-16 03:33:11', '2021-03-16 03:34:27');

-- --------------------------------------------------------

--
-- Structure de la table `investment_payouts`
--

CREATE TABLE `investment_payouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `investment_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(20,8) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `investment_plans`
--

CREATE TABLE `investment_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_amount` decimal(15,2) NOT NULL,
  `max_amount` decimal(15,2) NOT NULL,
  `duration` int(10) UNSIGNED NOT NULL DEFAULT 7,
  `cycles` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `percentage` int(10) UNSIGNED NOT NULL DEFAULT 15,
  `bonus` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `investment_plans`
--

INSERT INTO `investment_plans` (`id`, `title`, `min_amount`, `max_amount`, `duration`, `cycles`, `percentage`, `bonus`, `created_at`, `updated_at`) VALUES
(2, 'Premium', '9000.00', '20000.00', 3, 1, 15, '10.00', '2021-03-15 12:13:16', '2021-03-15 12:13:16'),
(3, 'Expert', '20000.00', '1000000.00', 14, 1, 10, '10000.00', '2021-03-15 12:16:40', '2021-03-15 15:24:07'),
(4, 'Professional', '100000.00', '5000000.00', 30, 3, 5, '50000.00', '2021-03-15 12:18:35', '2021-03-15 12:18:35'),
(5, 'Basic', '100.00', '9000.00', 7, 3, 15, NULL, '2021-03-15 15:38:25', '2021-03-15 15:38:25');

-- --------------------------------------------------------

--
-- Structure de la table `mailing_lists`
--

CREATE TABLE `mailing_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `service_stat_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `mailing_lists`
--

INSERT INTO `mailing_lists` (`id`, `email`, `service_stat_id`, `created_at`, `updated_at`) VALUES
(3, 'dreamor47@gmail.com', 1, '2019-09-21 07:57:35', '2019-09-21 08:13:42');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2013_08_26_091315_create_acc_stats_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_24_091330_create_service_stats_table', 1),
(5, '2019_08_24_091420_create_wallet_types_table', 1),
(6, '2019_08_25_054758_create_admins_table', 1),
(7, '2019_08_25_054832_create_wallets_table', 1),
(8, '2019_08_25_054842_create_with_rates_table', 1),
(9, '2019_08_25_054926_create_credit_types_table', 1),
(10, '2019_08_26_090958_create_credit_infos_table', 1),
(11, '2019_08_26_092257_create_roles_table', 1),
(12, '2019_08_26_095606_create_credited_wallet_infos_table', 1),
(13, '2020_08_19_194814_create_default_transactions_table', 2),
(15, '2021_03_12_165039_create_conversion_rates_table', 3),
(18, '2021_03_15_095722_create_static_messages_table', 4),
(26, '2021_03_15_110443_create_investment_plans_table', 5),
(31, '2021_03_15_165459_create_investments_table', 6),
(32, '2021_03_15_171731_create_investment_payouts_table', 6);

-- --------------------------------------------------------

--
-- Structure de la table `my_transactions`
--

CREATE TABLE `my_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prev_bal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `reference_no` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `my_transactions`
--

INSERT INTO `my_transactions` (`id`, `user_id`, `description`, `prev_bal`, `amount`, `reference_no`, `created_at`, `updated_at`) VALUES
(6, 14, NULL, '200', '200.00', '6397539400', NULL, '2020-08-25 09:12:50');

-- --------------------------------------------------------

--
-- Structure de la table `otps`
--

CREATE TABLE `otps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_stat_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `otps`
--

INSERT INTO `otps` (`id`, `user_id`, `code`, `service_stat_id`, `created_at`, `updated_at`) VALUES
(21, 14, '52420', 2, '2020-03-26 11:10:34', '2020-03-26 11:10:42'),
(22, 14, '61526', 2, '2020-03-26 11:11:34', '2020-03-26 11:11:43'),
(23, 14, '49769', 2, '2020-03-26 11:12:21', '2020-03-26 11:12:37'),
(24, 14, '09850', 2, '2020-03-26 11:15:48', '2020-03-26 11:17:57'),
(25, 14, '60307', 2, '2020-03-26 11:18:33', '2020-03-26 11:18:47'),
(26, 14, '78026', 2, '2020-03-26 11:19:55', '2020-03-26 11:20:04'),
(27, 14, '53832', 2, '2020-03-26 13:01:04', '2020-03-26 13:04:29'),
(28, 14, '47043', 2, '2020-03-26 13:04:29', '2020-03-26 13:04:58'),
(29, 14, '85923', 2, '2020-03-26 13:04:58', '2020-03-26 13:06:21'),
(30, 14, '99365', 2, '2020-03-26 13:06:21', '2020-03-26 13:08:15'),
(31, 14, '20730', 2, '2020-03-26 13:08:16', '2020-03-26 13:08:44'),
(32, 14, '83803', 2, '2020-03-26 13:08:45', '2020-03-26 13:09:56'),
(33, 14, '26964', 2, '2020-03-26 13:09:56', '2020-03-26 13:11:56'),
(34, 14, '57599', 2, '2020-03-26 13:11:56', '2020-03-26 13:12:13'),
(35, 14, '43706', 2, '2020-03-26 13:12:14', '2020-03-26 13:56:02'),
(36, 14, '95904', 2, '2020-03-26 13:56:02', '2020-03-26 14:15:36'),
(37, 14, '39410', 2, '2020-03-26 14:15:37', '2020-03-26 14:17:36'),
(38, 14, '03737', 2, '2020-03-26 14:17:37', '2020-03-27 16:05:35'),
(39, 14, '28468', 2, '2020-03-27 16:05:35', '2020-03-27 16:16:45'),
(40, 14, '38921', 2, '2020-03-27 16:16:45', '2020-03-27 18:50:08'),
(41, 14, '02972', 2, '2020-03-27 18:50:09', '2020-03-27 18:50:18'),
(42, 14, '34799', 2, '2020-03-27 18:50:18', '2020-03-27 18:51:36'),
(43, 14, '69110', 2, '2020-03-27 18:51:36', '2020-03-27 18:52:29'),
(44, 14, '94728', 2, '2020-03-27 18:52:29', '2020-03-27 18:52:35'),
(45, 14, '45932', 2, '2020-03-27 18:52:35', '2020-03-27 18:55:32'),
(46, 14, '03863', 2, '2020-03-27 18:55:32', '2020-03-27 18:57:39'),
(47, 14, '07863', 2, '2020-03-27 18:57:39', '2020-03-27 19:27:34'),
(48, 14, '90892', 2, '2020-03-27 19:27:34', '2020-03-27 19:29:20'),
(49, 14, '80255', 2, '2020-03-27 19:29:21', '2020-03-27 19:31:15'),
(50, 14, '50955', 2, '2020-03-27 19:31:15', '2020-03-27 19:31:42'),
(51, 14, '39410', 2, '2020-03-27 19:31:43', '2020-03-27 19:34:28'),
(52, 14, '60560', 1, '2020-03-27 19:34:28', '2020-03-27 19:34:28');

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('dreamor47@gmail.com', '$2y$10$fA1YcjaZmc9YUi6ri4LJduV25TpdqAolo7XeGNmcqRuXptvqAqDkW', '2019-09-16 20:41:50');

-- --------------------------------------------------------

--
-- Structure de la table `pc_types`
--

CREATE TABLE `pc_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `service_stat_id` bigint(20) UNSIGNED NOT NULL,
  `expire_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `pc_types`
--

INSERT INTO `pc_types` (`id`, `name`, `admin_id`, `service_stat_id`, `expire_at`, `created_at`, `updated_at`) VALUES
(1, 'Registration', 1, 1, NULL, '2019-09-07 11:18:43', '2019-09-07 10:18:43'),
(2, 'Prime King', 1, 1, '2019-09-20 14:00:00', '2019-09-07 11:10:21', '2019-09-07 10:10:21'),
(3, 'Travelling', 1, 1, '2018-12-31 23:00:00', '2019-09-07 09:41:27', '2019-09-07 09:41:27'),
(4, 'Business', 1, 1, NULL, '2019-09-07 09:43:21', '2019-09-07 09:43:21'),
(5, 'For You', 1, 1, '2019-09-19 15:00:00', '2019-09-07 09:43:43', '2019-09-07 09:43:43');

-- --------------------------------------------------------

--
-- Structure de la table `promo_codes`
--

CREATE TABLE `promo_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(100) NOT NULL,
  `amount` decimal(15,2) UNSIGNED NOT NULL,
  `pc_type_id` bigint(20) UNSIGNED NOT NULL,
  `service_stat_id` bigint(20) UNSIGNED NOT NULL,
  `expire_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `promo_codes`
--

INSERT INTO `promo_codes` (`id`, `code`, `amount`, `pc_type_id`, `service_stat_id`, `expire_at`, `created_at`, `updated_at`) VALUES
(1, 'cYsUz42MLV0kGlK', '100.00', 1, 1, '2019-09-27 15:00:00', '2019-09-07 09:44:48', '2019-09-09 14:58:21'),
(2, 'CATCHTHEFUN', '100.00', 1, 1, '2019-09-28 15:00:00', '2019-09-07 09:49:20', '2019-09-09 14:53:14'),
(3, 'QUICKFASTMONEY', '500.00', 1, 1, '2019-10-28 10:54:00', '2019-09-07 09:54:59', '2019-09-07 09:54:59'),
(4, 'g0fYmKhBkZrAvQG', '200.00', 1, 1, NULL, '2019-09-09 14:46:57', '2019-09-09 14:46:57'),
(5, 'UVhv8hM47WceVGQ', '300.00', 1, 10, '2019-09-20 20:00:00', '2019-09-09 14:48:08', '2019-09-09 14:58:35'),
(6, 'xoiYHjSZfPlErX4', '500.00', 1, 1, NULL, '2019-09-09 14:48:35', '2019-09-09 14:58:14');

-- --------------------------------------------------------

--
-- Structure de la table `reference_nos`
--

CREATE TABLE `reference_nos` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `reference_no` varchar(100) NOT NULL,
  `trans_type_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `reference_nos`
--

INSERT INTO `reference_nos` (`user_id`, `id`, `reference_no`, `trans_type_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'PkdHH1AXIHaSsGYRLaZuxbA61', 1, '2019-09-02 12:44:43', '2019-09-02 12:55:02'),
(1, 2, 'ueEo5Ov0UGlJmCehSLc7wShn1', 1, '2019-09-02 12:44:43', '2019-09-02 12:55:02'),
(1, 3, 'cR3vzq4d605SABjW1wPp82LyI', 3, '2019-09-02 12:45:09', '2019-09-02 12:55:02'),
(1, 7, 'OXwvQZGpc4Flsn1jmySaDVY7L', 3, '2019-09-02 12:23:49', '2019-09-02 12:23:49'),
(1, 8, 'TQyu3sZmoNAlRaXfP6eMOjknH', 3, '2019-09-02 12:30:31', '2019-09-02 12:30:31'),
(1, 9, 'DhtPb1AaFD412H8A2KCPKWTOM', 1, '2019-09-02 12:43:43', '2019-09-02 12:43:43'),
(1, 10, 'NyIO5SozHQKBnVYHLuC2EIyeH', 1, '2019-09-02 12:44:12', '2019-09-02 12:44:12'),
(1, 11, '37Rzpm1kDIwQFhSVY5LZdfruH', 3, '2019-09-02 12:45:04', '2019-09-02 12:45:04'),
(1, 13, 'Bbjo54Zt3u96gOAmisaP2HfI8', 3, '2019-09-02 13:06:57', '2019-09-02 13:06:57'),
(1, 15, 'du052ymB1XO26pkZB8H7HlOaZ', 4, '2019-09-03 08:05:53', '2019-09-03 08:05:53'),
(1, 16, 'mfgkJcW1gzGLKCfsyyGJcUPfq', 4, '2019-09-03 08:11:44', '2019-09-03 08:11:44'),
(1, 17, 'TMbySkTmm6EPiay23Hicua7gq', 4, '2019-09-03 08:23:55', '2019-09-03 08:23:55'),
(1, 20, 'OTPmSGzmITpaY1UjOPq2VAKwb', 1, '2019-09-03 12:00:06', '2019-09-03 12:00:06'),
(1, 21, 'nruJt29bcK04U4LhyGYpY7jf5', 1, '2019-09-03 14:29:44', '2019-09-03 14:29:44'),
(1, 22, 'QTJQzxU72OySrzKYUmmDCEXJj', 1, '2019-09-03 15:35:24', '2019-09-03 15:35:24'),
(1, 23, 'piLSFnvWU2NyNEhPPVKLwphsl', 4, '2019-09-05 20:46:06', '2019-09-05 20:46:06'),
(1, 24, '8o5GjMKdqet2IDZrFUPw8csm7', 4, '2019-09-05 20:52:21', '2019-09-05 20:52:21'),
(1, 25, 'SfU8GFyjCw2cJ4Y9yAjLrtKFj', 1, '2019-09-05 20:59:20', '2019-09-05 20:59:20'),
(1, 26, 'yZcNaldrxnH4EJIdXOiEpMTXr', 3, '2019-09-06 15:00:29', '2019-09-06 15:00:29'),
(1, 27, 'LZhPMxz5NcqT8QAysaGefb50j', 5, '2019-09-08 23:33:04', '2019-09-08 23:33:04'),
(1, 28, 'JM6PzQYxx2dWolEoTuysgXid6', 5, '2019-09-08 23:34:42', '2019-09-08 23:34:42'),
(1, 29, 'CmJNYP7vg0PP2niS2Rb3x8BgC', 5, '2019-09-09 00:03:57', '2019-09-09 00:03:57'),
(7, 30, 'gR03I6N3O5RH5hxjPep2jftl7', 5, '2019-09-09 00:26:19', '2019-09-09 00:26:19'),
(1, 31, '2KUFvs1hiWVGSOYrnFZPVk6Sj', 1, '2019-09-09 09:37:13', '2019-09-09 09:37:13'),
(1, 32, 'YtTS8JMnUvik4iRsqgpJ74tjS', 1, '2019-09-09 09:42:06', '2019-09-09 09:42:06'),
(1, 33, 'pcQwfa7TXWZ08XmBOVSqnQNXb', 1, '2019-09-09 09:50:09', '2019-09-09 09:50:09'),
(1, 34, 'phhi7ll4nv', 1, '2019-09-09 10:07:30', '2019-09-09 10:07:30'),
(1, 35, '005yjqzb6h', 1, '2019-09-09 10:26:08', '2019-09-09 10:26:08'),
(1, 36, 'uja95ryj9o', 1, '2019-09-09 10:31:29', '2019-09-09 10:31:29'),
(9, 38, 'alKHWKinMjJh093egFrjMpyPO', 5, '2019-09-09 15:05:46', '2019-09-09 15:05:46'),
(9, 39, 'XTZK4VbpJxtBQ7ZhbXAmiNRAl', 1, '2019-09-09 15:14:02', '2019-09-09 15:14:02'),
(1, 40, 'jXAZvCwbdWK823uT8xz5iftQp', 3, '2019-09-10 07:09:20', '2019-09-10 07:09:20'),
(1, 41, 'BCbK2Usez8DqwgCz1FIS1ybHG', 1, '2019-09-11 10:07:12', '2019-09-11 10:07:12'),
(10, 42, 'mIY0ZMzxKY2cFGJ1RVGaFaHpS', 5, '2019-09-24 09:43:49', '2019-09-24 09:43:49'),
(14, 43, 'VQ976RZzDGBPv5HGSMRjbL6pU', 4, '2020-03-27 16:22:54', '2020-03-27 16:22:54'),
(1, 44, '1EZBBlQv0SmhJMshgPOW2bqgO', 4, '2020-08-10 12:34:03', '2020-08-10 12:34:03'),
(1, 45, 'icVZdqHvsQ6rvt95dHqfND2O8', 4, '2020-08-10 12:39:54', '2020-08-10 12:39:54'),
(1, 46, 'HsmCLClYGVD7BzIXL11mHQ9JF', 4, '2020-08-10 12:41:10', '2020-08-10 12:41:10'),
(1, 47, '2HCYc57QOG4pKsrM6PNRcK64j', 4, '2020-08-10 12:41:35', '2020-08-10 12:41:35'),
(1, 48, '6sqLtbcdIcZbiAESCVKSXdp5f', 4, '2020-08-10 12:47:20', '2020-08-10 12:47:20'),
(1, 49, 'KhTiOQNlxg68ZEgS9yX2WiUCa', 4, '2020-08-10 12:49:58', '2020-08-10 12:49:58'),
(1, 50, 'DcghI0CHD984qxIKMLgAGji2S', 4, '2020-08-10 14:20:57', '2020-08-10 14:20:57'),
(1, 51, 'wG9Nf6Rweijy57769je5m8wXF', 4, '2020-08-10 14:21:24', '2020-08-10 14:21:24');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `service_stats`
--

CREATE TABLE `service_stats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `service_stats`
--

INSERT INTO `service_stats` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'active', '2019-08-27 23:00:00', '2019-08-27 23:00:00'),
(2, 'blocked', '2019-08-27 23:00:00', '2019-08-27 23:00:00'),
(3, 'success', '2019-08-27 23:00:00', '2019-08-27 23:00:00'),
(4, 'failed', '2019-08-27 23:00:00', '2019-08-27 23:00:00'),
(5, 'pending', '2019-09-02 23:00:00', '2019-09-02 23:00:00'),
(6, 'in-progress', '2019-09-02 23:00:00', '2019-09-02 23:00:00'),
(7, 'cancelled', '2019-09-02 23:00:00', '2019-09-02 23:00:00'),
(8, 'disabled', '2019-09-07 04:46:03', '2019-09-07 04:46:03'),
(9, 'used', '2019-09-07 11:40:52', '2019-09-07 11:40:52'),
(10, 'registration', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `static_messages`
--

CREATE TABLE `static_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message_1` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `message_2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message_3` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `static_messages`
--

INSERT INTO `static_messages` (`id`, `title`, `message_1`, `message_2`, `message_3`, `created_at`, `updated_at`) VALUES
(1, 'total_live_traders', '$167,700K', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trans_type_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `wallet_id` bigint(20) UNSIGNED NOT NULL,
  `prev_amount` decimal(15,2) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `reference_no_id` bigint(20) UNSIGNED NOT NULL,
  `service_stat_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `transactions`
--

INSERT INTO `transactions` (`id`, `trans_type_id`, `user_id`, `wallet_id`, `prev_amount`, `amount`, `reference_no_id`, `service_stat_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 3, '0.00', '500.00', 1, 3, '2019-08-28 13:40:21', '2019-08-28 13:40:21'),
(2, 1, 1, 3, '500.00', '1000.00', 2, 3, '2019-08-28 13:43:24', '2019-08-28 13:43:24'),
(3, 1, 3, 5, '0.00', '100.00', 3, 3, '2019-09-02 11:28:41', '2019-09-02 11:28:41'),
(5, 3, 1, 3, '1500.00', '100.00', 3, 3, '2019-09-02 13:03:01', '2019-09-02 13:03:01'),
(9, 1, 3, 5, '100.00', '200.00', 7, 3, '2019-09-02 12:23:50', '2019-09-02 12:23:50'),
(10, 3, 1, 3, '1400.00', '200.00', 7, 3, '2019-09-02 13:29:20', '2019-09-02 13:29:20'),
(11, 3, 1, 3, '1200.00', '100.00', 8, 3, '2019-09-02 12:30:31', '2019-09-02 12:30:31'),
(12, 1, 3, 5, '300.00', '100.00', 8, 3, '2019-09-02 12:30:32', '2019-09-02 12:30:32'),
(13, 1, 1, 3, '1100.00', '5000.00', 9, 3, '2019-09-02 12:43:43', '2019-09-02 12:43:43'),
(14, 1, 1, 3, '6100.00', '200.00', 10, 3, '2019-09-02 12:44:13', '2019-09-02 12:44:13'),
(15, 3, 1, 3, '6300.00', '1000.00', 11, 3, '2019-09-02 12:45:04', '2019-09-02 12:45:04'),
(16, 1, 4, 4, '0.00', '1000.00', 11, 3, '2019-09-02 12:45:04', '2019-09-02 12:45:04'),
(18, 3, 1, 3, '5300.00', '100.00', 13, 3, '2019-09-02 13:06:57', '2019-09-02 13:06:57'),
(19, 1, 4, 4, '1000.00', '100.00', 13, 3, '2019-09-02 13:06:57', '2019-09-02 13:06:57'),
(20, 4, 1, 3, '5200.00', '520.00', 15, 5, '2019-09-03 08:05:54', '2019-09-03 08:05:54'),
(21, 4, 1, 3, '4680.00', '3020.00', 16, 5, '2019-09-03 08:11:44', '2019-09-03 08:11:44'),
(22, 4, 1, 3, '1660.00', '1620.00', 17, 5, '2019-09-03 08:23:56', '2019-09-03 08:23:56'),
(23, 1, 1, 3, '40.00', '1000.00', 20, 3, '2019-09-03 12:00:07', '2019-09-03 12:00:07'),
(24, 1, 1, 3, '1040.00', '1620.00', 21, 3, '2019-09-03 14:29:44', '2019-09-03 14:29:44'),
(25, 1, 1, 3, '2660.00', '3020.00', 22, 3, '2019-09-03 15:35:24', '2019-09-03 15:35:24'),
(26, 4, 1, 3, '5680.00', '520.00', 23, 3, '2019-09-05 20:46:06', '2019-09-05 20:46:06'),
(27, 4, 1, 3, '5680.00', '2520.00', 24, 5, '2019-09-05 20:52:21', '2019-09-05 20:52:21'),
(28, 1, 1, 3, '3160.00', '2520.00', 25, 4, '2019-09-05 20:59:20', '2019-09-05 20:59:20'),
(29, 3, 1, 3, '5680.00', '2200.00', 26, 3, '2019-09-06 15:00:29', '2019-09-06 15:00:29'),
(30, 1, 4, 4, '1100.00', '2200.00', 26, 3, '2019-09-06 15:00:29', '2019-09-06 15:00:29'),
(31, 5, 1, 3, '3480.00', '100.00', 28, 1, '2019-09-08 23:34:42', '2019-09-08 23:34:42'),
(32, 5, 1, 3, '3580.00', '100.00', 29, 3, '2019-09-09 00:03:57', '2019-09-09 00:03:57'),
(33, 5, 7, 8, '0.00', '100.00', 30, 3, '2019-09-09 00:26:20', '2019-09-09 00:26:20'),
(34, 1, 1, 3, '3680.00', '1000.00', 31, 3, '2019-09-09 09:37:14', '2019-09-09 09:37:14'),
(35, 1, 1, 3, '4680.00', '500.00', 32, 3, '2019-09-09 09:42:06', '2019-09-09 09:42:06'),
(36, 1, 1, 3, '5180.00', '500.00', 33, 3, '2019-09-09 09:50:09', '2019-09-09 09:50:09'),
(37, 1, 1, 3, '5680.00', '200.00', 34, 3, '2019-09-09 10:07:30', '2019-09-09 10:07:30'),
(38, 1, 1, 3, '5880.00', '800.00', 35, 3, '2019-09-09 10:26:08', '2019-09-09 10:26:08'),
(39, 1, 1, 3, '6680.00', '200.00', 36, 3, '2019-09-09 10:31:29', '2019-09-09 10:31:29'),
(40, 5, 9, 10, '0.00', '300.00', 38, 3, '2019-09-09 15:05:46', '2019-09-09 15:05:46'),
(41, 1, 9, 10, '300.00', '1000.00', 39, 3, '2019-09-09 15:14:02', '2019-09-09 15:14:02'),
(42, 3, 1, 3, '6880.00', '1000.00', 40, 3, '2019-09-10 07:09:20', '2019-09-10 07:09:20'),
(43, 1, 4, 4, '3300.00', '1000.00', 40, 3, '2019-09-10 07:09:20', '2019-09-10 07:09:20'),
(44, 1, 1, 3, '5880.00', '500.00', 41, 3, '2019-09-11 10:07:12', '2019-09-11 10:07:12'),
(45, 5, 10, 11, '0.00', '300.00', 42, 3, '2019-09-24 09:43:49', '2019-09-24 09:43:49'),
(46, 4, 14, 13, '50000.00', '200.00', 43, 5, '2020-03-27 16:22:55', '2020-03-27 16:22:55'),
(47, 4, 1, 3, '1000.00', '5.00', 45, 5, '2020-08-10 12:39:54', '2020-08-10 12:39:54'),
(48, 4, 1, 3, '995.00', '5.00', 46, 5, '2020-08-10 12:41:10', '2020-08-10 12:41:10'),
(49, 4, 1, 3, '990.00', '5.00', 47, 5, '2020-08-10 12:41:36', '2020-08-10 12:41:36'),
(50, 4, 1, 3, '985.00', '5.00', 48, 5, '2020-08-10 12:47:20', '2020-08-10 12:47:20'),
(51, 4, 1, 3, '980.00', '5.00', 49, 5, '2020-08-10 12:49:59', '2020-08-10 12:49:59'),
(52, 4, 1, 3, '975.00', '5.00', 50, 5, '2020-08-10 14:20:57', '2020-08-10 14:20:57'),
(53, 4, 1, 3, '970.00', '6.00', 51, 5, '2020-08-10 14:21:24', '2020-08-10 14:21:24');

-- --------------------------------------------------------

--
-- Structure de la table `transfer_stats`
--

CREATE TABLE `transfer_stats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `recepient_id` bigint(20) UNSIGNED NOT NULL,
  `reference_no_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `service_stat_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `transfer_stats`
--

INSERT INTO `transfer_stats` (`id`, `user_id`, `recepient_id`, `reference_no_id`, `amount`, `service_stat_id`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 3, '100.00', 3, '2019-09-02 11:28:41', '2019-09-02 13:21:18'),
(2, 1, 3, 7, '200.00', 3, '2019-09-02 12:23:50', '2019-09-02 12:23:50'),
(3, 1, 3, 8, '100.00', 3, '2019-09-02 12:30:32', '2019-09-02 12:30:32'),
(4, 1, 4, 11, '1000.00', 3, '2019-09-02 12:45:04', '2019-09-02 12:45:04'),
(5, 1, 4, 13, '100.00', 3, '2019-09-02 13:06:57', '2019-09-02 13:06:57'),
(6, 1, 4, 26, '2200.00', 3, '2019-09-06 15:00:29', '2019-09-06 15:00:29'),
(7, 1, 4, 40, '1000.00', 3, '2019-09-10 07:09:20', '2019-09-10 07:09:20');

-- --------------------------------------------------------

--
-- Structure de la table `trans_types`
--

CREATE TABLE `trans_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `trans_types`
--

INSERT INTO `trans_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'credit', '2019-08-30 14:03:12', '2019-08-31 10:05:22'),
(2, 'debit', '2019-08-30 14:03:19', '2019-08-30 14:03:19'),
(3, 'transfer', '2019-08-30 14:13:57', '2019-08-30 14:13:57'),
(4, 'withdraw', '2019-08-30 14:14:04', '2019-08-30 14:14:04'),
(5, 'promo code', '2019-09-09 00:02:23', '2019-09-09 00:02:23');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc_no` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0123456789',
  `acc_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Savings',
  `otp_status` timestamp NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_pin` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc_stat_id` bigint(20) UNSIGNED NOT NULL DEFAULT 2,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `gender`, `email`, `phone`, `address`, `country`, `acc_no`, `acc_type`, `otp_status`, `email_verified_at`, `password`, `transaction_pin`, `acc_stat_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Obina', 'Sir-Elviss', 'male', 'dreamor@gmail.com', '1234567890', 'Delhi', 'India', '0123456789', 'Savings', '2020-03-26 11:09:03', '2019-09-17 08:19:44', '$2y$10$SfyzSKLYT05pKVWJNxzfVuJMxhJfmsL91LEJfKR5HSLV.xNxQgZrW', '', 2, 'b8rzHVaN8W98jY8XOLvcuoJMxrO34mEhQJYYF3dNZZFeaNAo7QtK2SrjbDaE', '2019-08-26 15:35:37', '2020-08-10 15:10:48');

-- --------------------------------------------------------

--
-- Structure de la table `wallets`
--

CREATE TABLE `wallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `service_stat_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `btc` decimal(15,8) NOT NULL DEFAULT 0.00000000,
  `bonus` decimal(15,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `wallets`
--

INSERT INTO `wallets` (`id`, `user_id`, `amount`, `created_at`, `updated_at`, `service_stat_id`, `btc`, `bonus`) VALUES
(3, 1, '1684.00', '2019-08-27 23:00:00', '2021-03-16 03:34:27', 1, '0.00000000', '0.00'),
(4, 4, '4300.00', '2019-08-28 14:40:49', '2019-09-10 07:09:20', 1, '0.00000000', '0.00'),
(5, 3, '400.00', '2019-09-01 23:00:00', '2019-09-02 12:30:32', 1, '0.00000000', '0.00'),
(8, 7, '100.00', '2019-09-09 00:23:27', '2019-09-09 00:26:20', 1, '0.00000000', '0.00'),
(10, 9, '1300.00', '2019-09-09 15:05:46', '2019-09-09 15:14:02', 1, '0.00000000', '0.00'),
(11, 10, '300.00', '2019-09-24 09:43:49', '2019-09-24 09:43:50', 1, '0.00000000', '0.00'),
(12, 13, '0.00', '2020-03-25 02:59:39', '2020-03-25 02:59:39', 1, '0.00000000', '0.00'),
(13, 14, '40000.00', '2020-03-25 03:03:30', '2021-01-02 13:46:18', 1, '0.00000000', '0.00'),
(14, 15, '0.00', '2020-08-09 19:12:05', '2020-08-09 19:12:05', 1, '0.00000000', '0.00');

-- --------------------------------------------------------

--
-- Structure de la table `wallet_promo_code`
--

CREATE TABLE `wallet_promo_code` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `wallet_id` bigint(20) NOT NULL,
  `promo_code_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `wallet_types`
--

CREATE TABLE `wallet_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wal_limit` decimal(15,2) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `service_stat_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `wallet_types`
--

INSERT INTO `wallet_types` (`id`, `name`, `wal_limit`, `created_at`, `updated_at`, `service_stat_id`) VALUES
(1, 'level 1', '10000.00', '2019-08-06 23:00:00', '2019-08-07 23:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `withdraw_requests`
--

CREATE TABLE `withdraw_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `reference_no_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `charge` decimal(15,2) UNSIGNED NOT NULL,
  `bitcoin_address` varchar(255) DEFAULT NULL,
  `acc_name` varchar(100) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `acc_no` varchar(100) DEFAULT NULL,
  `acc_type` varchar(100) DEFAULT NULL,
  `iban_no` varchar(200) DEFAULT NULL,
  `swift_code` varchar(200) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `transfer_type` varchar(20) DEFAULT NULL,
  `message` varchar(255) DEFAULT 'Withdraw Request sent. It will be processed in an hour!',
  `service_stat_id` bigint(20) UNSIGNED NOT NULL,
  `expire_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `withdraw_specs`
--

CREATE TABLE `withdraw_specs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `min_amt` decimal(15,2) UNSIGNED NOT NULL,
  `max_amt` decimal(15,2) UNSIGNED NOT NULL,
  `min_bal` decimal(15,2) NOT NULL,
  `charge` decimal(15,2) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `withdraw_specs`
--

INSERT INTO `withdraw_specs` (`id`, `name`, `min_amt`, `max_amt`, `min_bal`, `charge`, `created_at`, `updated_at`) VALUES
(1, 'default', '100.00', '3000.00', '500.00', '0.00', '2019-09-02 08:15:01', '2019-09-06 11:32:03'),
(2, 'transfer', '100.00', '5000.00', '100.00', '0.00', '2019-09-06 11:22:55', '2019-09-06 11:22:55');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `acc_stats`
--
ALTER TABLE `acc_stats`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD UNIQUE KEY `admins_phone_unique` (`phone`),
  ADD KEY `admins_acc_stat_id_foreign` (`acc_stat_id`);

--
-- Index pour la table `admin_mailings`
--
ALTER TABLE `admin_mailings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Index pour la table `admin_msgs`
--
ALTER TABLE `admin_msgs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_stat_id` (`service_stat_id`);

--
-- Index pour la table `assigned_pcs`
--
ALTER TABLE `assigned_pcs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `promo_code_id` (`promo_code_id`),
  ADD KEY `service_stat_id` (`service_stat_id`),
  ADD KEY `assigned_pcs_ibfk_3` (`user_id`);

--
-- Index pour la table `contact_forms`
--
ALTER TABLE `contact_forms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_forms_ibfk_1` (`mailing_list_id`);

--
-- Index pour la table `conversion_rates`
--
ALTER TABLE `conversion_rates`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `default_transactions`
--
ALTER TABLE `default_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `homepages`
--
ALTER TABLE `homepages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `investments`
--
ALTER TABLE `investments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `investments_user_id_index` (`user_id`),
  ADD KEY `investments_investment_plan_id_index` (`investment_plan_id`);

--
-- Index pour la table `investment_payouts`
--
ALTER TABLE `investment_payouts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `investment_payouts_user_id_index` (`user_id`),
  ADD KEY `investment_payouts_investment_id_index` (`investment_id`);

--
-- Index pour la table `investment_plans`
--
ALTER TABLE `investment_plans`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `mailing_lists`
--
ALTER TABLE `mailing_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_stat_id` (`service_stat_id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `my_transactions`
--
ALTER TABLE `my_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `otps`
--
ALTER TABLE `otps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `credit_infos_service_stat_id_foreign` (`service_stat_id`),
  ADD KEY `credit_infos_user_id_foreign` (`user_id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `pc_types`
--
ALTER TABLE `pc_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_stat_id` (`service_stat_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Index pour la table `promo_codes`
--
ALTER TABLE `promo_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pc_types_id` (`pc_type_id`),
  ADD KEY `service_stat_id` (`service_stat_id`);

--
-- Index pour la table `reference_nos`
--
ALTER TABLE `reference_nos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reference_no` (`reference_no`),
  ADD KEY `reference_nos_ibfk_1` (`trans_type_id`),
  ADD KEY `reference_nos_ibfk_2` (`user_id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `service_stats`
--
ALTER TABLE `service_stats`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `static_messages`
--
ALTER TABLE `static_messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `credit_infos_service_stat_id_foreign` (`service_stat_id`),
  ADD KEY `credit_infos_wallet_id_foreign` (`wallet_id`),
  ADD KEY `transactions_ibfk_1` (`trans_type_id`),
  ADD KEY `reference_no_id` (`reference_no_id`),
  ADD KEY `credit_infos_user_id_foreign` (`user_id`);

--
-- Index pour la table `transfer_stats`
--
ALTER TABLE `transfer_stats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `service_stat_id` (`service_stat_id`),
  ADD KEY `recepient_id` (`recepient_id`),
  ADD KEY `reference_no_id` (`reference_no_id`);

--
-- Index pour la table `trans_types`
--
ALTER TABLE `trans_types`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD KEY `users_acc_stat_id_foreign` (`acc_stat_id`);

--
-- Index pour la table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wallets_service_stat_id_foreign` (`service_stat_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `wallet_promo_code`
--
ALTER TABLE `wallet_promo_code`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `wallet_types`
--
ALTER TABLE `wallet_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wallet_types_service_stat_id_foreign` (`service_stat_id`);

--
-- Index pour la table `withdraw_requests`
--
ALTER TABLE `withdraw_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `service_stat_id` (`service_stat_id`),
  ADD KEY `reference_no_id` (`reference_no_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Index pour la table `withdraw_specs`
--
ALTER TABLE `withdraw_specs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `acc_stats`
--
ALTER TABLE `acc_stats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `admin_mailings`
--
ALTER TABLE `admin_mailings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `admin_msgs`
--
ALTER TABLE `admin_msgs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `assigned_pcs`
--
ALTER TABLE `assigned_pcs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `contact_forms`
--
ALTER TABLE `contact_forms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `conversion_rates`
--
ALTER TABLE `conversion_rates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `default_transactions`
--
ALTER TABLE `default_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `homepages`
--
ALTER TABLE `homepages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `investments`
--
ALTER TABLE `investments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `investment_payouts`
--
ALTER TABLE `investment_payouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `investment_plans`
--
ALTER TABLE `investment_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `mailing_lists`
--
ALTER TABLE `mailing_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `my_transactions`
--
ALTER TABLE `my_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `otps`
--
ALTER TABLE `otps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT pour la table `pc_types`
--
ALTER TABLE `pc_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `promo_codes`
--
ALTER TABLE `promo_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `reference_nos`
--
ALTER TABLE `reference_nos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `service_stats`
--
ALTER TABLE `service_stats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `static_messages`
--
ALTER TABLE `static_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT pour la table `transfer_stats`
--
ALTER TABLE `transfer_stats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `trans_types`
--
ALTER TABLE `trans_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `wallet_promo_code`
--
ALTER TABLE `wallet_promo_code`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `wallet_types`
--
ALTER TABLE `wallet_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `withdraw_requests`
--
ALTER TABLE `withdraw_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `withdraw_specs`
--
ALTER TABLE `withdraw_specs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
