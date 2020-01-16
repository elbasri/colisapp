-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2020 at 08:16 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cmaroc`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `image`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$10$vtPacIp2C.D3H7oX3RmzGujAdIMTLXA4Ickbhe8Tqk7zj0mUG02PW', 'HtjLnOaS7YZQlmM6bLskclNJETb6mWlC4cPdljwAFcKc3rHeocatgyj2fUGd', NULL, '2019-12-01 22:05:28');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `image`, `email`, `phone`, `address`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Depot Derb Ghellef', NULL, 'access@gmail.com', '0676479581', 'casa access', 'Active', '2019-12-01 22:04:05', '2020-01-12 12:08:54');

-- --------------------------------------------------------

--
-- Table structure for table `courier_types`
--

CREATE TABLE `courier_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `unit_id` int(10) UNSIGNED NOT NULL,
  `price` double(8,2) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courier_types`
--

INSERT INTO `courier_types` (`id`, `unit_id`, `price`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 35.00, 'AccessoiresType', 'Active', '2019-12-01 22:17:35', '2019-12-01 22:17:35'),
(2, 1, 1.00, 'Electronique', 'Active', '2019-12-08 11:49:13', '2019-12-08 11:49:13');

-- --------------------------------------------------------

--
-- Table structure for table `currier_infos`
--

CREATE TABLE `currier_infos` (
  `id` int(10) UNSIGNED NOT NULL,
  `sender_branch_id` int(10) UNSIGNED NOT NULL,
  `sender_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sender_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sender_phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sender_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiver_branch_id` int(10) UNSIGNED NOT NULL,
  `price_id` int(11) NOT NULL DEFAULT 1,
  `receiver_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receiver_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiver_phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receiver_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sender_branch_staff_id` int(10) UNSIGNED DEFAULT NULL,
  `receiver_branch_staff_id` int(10) UNSIGNED DEFAULT NULL,
  `invoice_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_receiver_id` int(11) DEFAULT NULL,
  `payment_branch_id` int(11) DEFAULT NULL,
  `payment_method_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` enum('Unpaid','Paid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Unpaid',
  `payment_transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_balance` double(8,2) DEFAULT NULL,
  `payment_transaction_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Received','Delivered') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Delivered',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currier_infos`
--

INSERT INTO `currier_infos` (`id`, `sender_branch_id`, `sender_name`, `sender_email`, `sender_phone`, `sender_address`, `receiver_branch_id`, `price_id`, `receiver_name`, `receiver_email`, `receiver_phone`, `receiver_address`, `sender_branch_staff_id`, `receiver_branch_staff_id`, `invoice_id`, `code`, `payment_receiver_id`, `payment_branch_id`, `payment_method_name`, `payment_status`, `payment_transaction_id`, `payment_date`, `payment_balance`, `payment_transaction_image`, `payment_note`, `status`, `created_at`, `updated_at`) VALUES
(4, 1, 'fsf', 'jkljklj@dfg.dg', 'lkkljk', 'lhkjh', 1, 20, 'lkhkl', 'kljkl', 'jkljklj', 'jkljlk', 4, 4, '1', '1OPEBQ814MJ2', 4, 1, NULL, 'Paid', NULL, '2019-12-08', 175.00, NULL, NULL, 'Delivered', '2019-12-08 11:13:31', '2019-12-08 11:15:52'),
(5, 1, 'sssssss', 'sssss@sds.sd', 'sssss', 'ssssssssss', 1, 20, 'gggggg', 'ggggg@ggg.gg', 'gggggg', 'ggggggg', 2, 2, '5', '4HTECOAYUKVC', 2, 1, NULL, 'Paid', NULL, '2020-01-10', 875.00, NULL, NULL, 'Delivered', '2020-01-10 14:04:03', '2020-01-10 14:06:48'),
(6, 1, 'staff', 'staff@gmail.com', '454564', 'address de test, staff', 1, 20, '454545454', 'qdsf@sdf.sdf', '545454545', 'sd65', 2, NULL, '6', 'UGVENWV6A38O', NULL, NULL, NULL, 'Unpaid', NULL, NULL, 35.00, NULL, NULL, 'Received', '2020-01-12 11:44:50', '2020-01-12 11:44:50'),
(8, 1, 'staff', 'staff@gmail.com', '454564', 'address de test, staff', 1, 4, 'elbasri nacer', 'sdfdsf@dsf.df', '0666666', 'fsdhfj  sdfhdsjkl sdqfkjh', 2, NULL, '7', 'RS33S12DCBJY', NULL, NULL, NULL, 'Unpaid', NULL, NULL, 20.00, NULL, NULL, 'Received', '2020-01-12 18:15:17', '2020-01-12 18:15:17'),
(9, 1, 'staff', 'staff@gmail.com', '454564', 'address de test, staff', 1, 4, 'sdjkfh sdfkjdskf', 'sdfds@sdf.sdf', '0656456', 'sdfhkjh', 2, NULL, '9', 'S4FO5QLUSTVT', NULL, NULL, NULL, 'Unpaid', NULL, NULL, 40.00, NULL, NULL, 'Received', '2020-01-12 18:15:52', '2020-01-12 18:15:52');

-- --------------------------------------------------------

--
-- Table structure for table `currier_product_infos`
--

CREATE TABLE `currier_product_infos` (
  `id` int(10) UNSIGNED NOT NULL,
  `currier_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currier_type` int(11) NOT NULL,
  `currier_quantity` int(11) NOT NULL,
  `currier_fee` double(8,2) NOT NULL,
  `currier_details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currier_info_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currier_product_infos`
--

INSERT INTO `currier_product_infos` (`id`, `currier_code`, `currier_type`, `currier_quantity`, `currier_fee`, `currier_details`, `currier_info_id`, `created_at`, `updated_at`) VALUES
(1, '1OPEBQ814MJ2', 1, 5, 175.00, NULL, 4, '2019-12-08 11:13:31', '2019-12-08 11:13:31'),
(2, '4HTECOAYUKVC', 1, 25, 875.00, NULL, 5, '2020-01-10 14:04:03', '2020-01-10 14:04:03'),
(3, 'UGVENWV6A38O', 1, 1, 35.00, NULL, 6, '2020-01-12 11:44:50', '2020-01-12 11:44:50'),
(4, 'RS33S12DCBJY', 1, 2, 20.00, NULL, 8, '2020-01-12 18:15:17', '2020-01-12 18:15:17'),
(5, 'S4FO5QLUSTVT', 2, 1, 20.00, NULL, 9, '2020-01-12 18:15:52', '2020-01-12 18:15:52'),
(6, 'S4FO5QLUSTVT', 1, 3, 20.00, NULL, 9, '2020-01-12 18:15:52', '2020-01-12 18:15:52');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(10) UNSIGNED NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `created_at`, `updated_at`) VALUES
(1, 'Comment s\'inscrire.', 'Cliquer sur le button Inscription en haut de la page, puis remplire le formulaire et clique sur le button S\'inscrire', '2020-01-08 14:02:57', '2020-01-10 13:15:38'),
(2, 'Comment suivi les colis?', 'Pour suivi vos colis, cliquez sur \"Recherche de Colis\" dans le menu du site, puis tapez le numero de la colis ou bien de la facture.', '2020-01-08 14:02:57', '2020-01-10 13:16:57');

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_subtitle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aboutus_keyword` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aboutus_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aboutus_details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `search_currier_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `search_currier_details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gallery_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gallery_details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_notification` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `email_sent_from` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_template` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_api` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_notification` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `registration_verification` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `email_verification` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `sms_verification` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `base_currency` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `base_currency_symbol` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departure_currier` int(11) DEFAULT NULL,
  `upcoming_currier` int(11) DEFAULT NULL,
  `total_deliver` int(11) DEFAULT NULL,
  `about_us_quote_one` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_us_quote_two` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_us_quote_three` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `title`, `header_title`, `header_subtitle`, `service_title`, `service_details`, `aboutus_keyword`, `aboutus_title`, `aboutus_details`, `price_title`, `price_details`, `search_currier_title`, `search_currier_details`, `footer_text`, `gallery_title`, `gallery_details`, `contact_title`, `contact_address`, `contact_phone`, `contact_email`, `address`, `color_code`, `email_notification`, `email_sent_from`, `email_template`, `sms_api`, `sms_notification`, `registration_verification`, `email_verification`, `sms_verification`, `base_currency`, `base_currency_symbol`, `departure_currier`, `upcoming_currier`, `total_deliver`, `about_us_quote_one`, `about_us_quote_two`, `about_us_quote_three`, `map`, `created_at`, `updated_at`) VALUES
(1, 'Coursier Maroc', 'Coursier Maroc', 'Est un système de gestion de messagerie multi-entreprises', 'Nos services', 'Avec des années d\'expérience dans la livraison, nous offrons les services suivants', NULL, 'À propos de nous', '<div align=\"justify\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod \r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim \r\nveniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod \r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim \r\nveniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod \r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim \r\nveniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</div><div align=\"left\"><div><br></div><ul><li><font size=\"4\"><b>FIRST DELIVERY&nbsp;</b></font></li></ul><div><br></div><ul><li><font size=\"4\"><b>SECURED SERVICE&nbsp;</b></font></li></ul><div><br></div><ul><li><font size=\"4\"><b>WORLD WIDE SHIPPING&nbsp;</b></font></li></ul><div><br></div></div>', 'Villes et Tarifs', 'La liste ci-dessous montre les villes dans lesquelles nous expédions et notre prix pour chaque ville', 'Recherche de Colis', 'Vous pouvez rechercher et suivre les colis via son numéro ou le numéro de facture', '© 2019 - Copyright Tous droits réservés .', 'Photo Gallery', 'dfdsafdf', 'Nous contacter', 'Casablanca, Morocco', '+212676479581', 'contact@elbasri.net', NULL, 'e41d3c', '0', 'do-not-reply@thesoftking.com', '<br><br>\r\n	<div class=\"contents\" style=\"max-width: 600px; margin: 0 auto; border: 2px solid #000036;\">\r\n\r\n<div class=\"header\" style=\"background-color: #000036; padding: 15px; text-align: center;\">\r\n	<div class=\"logo\" style=\"width: 260px;text-align: center; margin: 0 auto;\">\r\n		<img src=\"https://i.imgur.com/4NN55uD.png\" alt=\"THESOFTKING\" style=\"width: 100%;\">\r\n	</div>\r\n</div>\r\n\r\n<div class=\"mailtext\" style=\"padding: 30px 15px; background-color: #f0f8ff; font-family: \'Open Sans\', sans-serif; font-size: 16px; line-height: 26px;\">\r\n\r\nHi {{name}},\r\n<br><br>\r\n{{message}}\r\n<br><br>\r\n<br><br>\r\n</div>\r\n\r\n<div class=\"footer\" style=\"background-color: #000036; padding: 15px; text-align: center;\">\r\n<a href=\"https://thesoftking.com/\" style=\"	background-color: #2ecc71;\r\n	padding: 10px 0;\r\n	margin: 10px;\r\n	display: inline-block;\r\n	width: 100px;\r\n	text-transform: uppercase;\r\n	text-decoration: none;\r\n	color: #ffff;\r\n	font-weight: 600;\r\n	border-radius: 4px;\">Website</a>\r\n<a href=\"https://thesoftking.com/products\" style=\"	background-color: #2ecc71;\r\n	padding: 10px 0;\r\n	margin: 10px;\r\n	display: inline-block;\r\n	width: 100px;\r\n	text-transform: uppercase;\r\n	text-decoration: none;\r\n	color: #ffff;\r\n	font-weight: 600;\r\n	border-radius: 4px;\">Products</a>\r\n<a href=\"https://thesoftking.com/contact\" style=\"	background-color: #2ecc71;\r\n	padding: 10px 0;\r\n	margin: 10px;\r\n	display: inline-block;\r\n	width: 100px;\r\n	text-transform: uppercase;\r\n	text-decoration: none;\r\n	color: #ffff;\r\n	font-weight: 600;\r\n	border-radius: 4px;\">Contact</a>\r\n</div>\r\n\r\n\r\n<div class=\"footer\" style=\"background-color: #000036; padding: 15px; text-align: center; border-top: 1px solid rgba(255, 255, 255, 0.2);\">\r\n\r\n<strong style=\"color: #fff;\">© 2011 - 2018 THESOFTKING. All Rights Reserved.</strong>\r\n<p style=\"color: #ddd;\">TheSoftKing is not partnered with any other \r\ncompany or person. We work as a team and do not have any reseller, \r\ndistributor or partner!</p>\r\n\r\n\r\n</div>\r\n\r\n	</div>\r\n<br><br>', 'https://api.infobip.com/api/v3/sendsms/plain?user=****&amp;password=*****&amp;sender=Runner&amp;SMSText={{message}}&amp;GSM={{number}}&amp;type=longSMS', '0', '1', '0', '0', 'DH', 'DH', 30, 300, 3541, 'Coursier Maroc Est un système de gestion de messagerie multi-entreprises 1', 'Coursier Maroc Est un système de gestion de messagerie multi-entreprises', 'Coursier Maroc Est un système de gestion de messagerie multi-entreprises  2', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d106376.72692335998!2d-7.657032583103355!3d33.57226777575701!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xda7cd4778aa113b%3A0xb06c1d84f310fd3!2sCasablanca!5e0!3m2!1sen!2sma!4v1578654788449!5m2!1sen!2sma\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\"></iframe>', NULL, '2020-01-12 11:29:48');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(36, '2013_01_04_092658_create_branches_table', 1),
(37, '2014_10_12_000000_create_users_table', 1),
(38, '2014_10_12_100000_create_password_resets_table', 1),
(39, '2018_12_08_065013_create_admins_table', 1),
(40, '2018_12_08_100407_create_general_settings_table', 1),
(41, '2018_12_11_063901_create_visitor_messages_table', 1),
(42, '2018_12_22_070119_create_socials_table', 1),
(43, '2018_12_27_060657_create_withdraw_payments_table', 1),
(44, '2018_12_27_130759_create_withdraw_transaction_logs_table', 1),
(45, '2019_01_05_083743_create_units_table', 1),
(46, '2019_01_05_085106_create_courier_types_table', 1),
(47, '2019_01_05_104055_create_currier_infos_table', 1),
(48, '2019_01_06_084324_create_currier_product_infos_table', 2),
(49, '2019_02_26_142454_create_faqs_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `status`, `created_at`) VALUES
('devnasser@gmail.com', 'BWUZvVB4cYShSGMa49ZIcRErP9WjBM3bbmbx7Qfy6sAckW5UF1zKfXBBIaxc', '0', '2020-01-10 01:55:02');

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `id` int(11) NOT NULL,
  `city` text DEFAULT NULL,
  `price` text DEFAULT NULL,
  `details` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`id`, `city`, `price`, `details`, `created_at`, `updated_at`) VALUES
(4, 'Casablanca', '20', 'Entourage de 50 KM', '2020-01-10 11:45:20', '2020-01-10 13:11:28'),
(5, 'Ain Harouda', '35', NULL, '2020-01-10 12:58:10', '2020-01-10 12:58:10'),
(6, 'Arrahma', '35', NULL, '2020-01-10 12:58:30', '2020-01-10 12:58:30'),
(7, 'Bouskoura', '35', NULL, '2020-01-10 12:58:44', '2020-01-10 12:58:44'),
(8, 'Dar Bouazza', '35', NULL, '2020-01-10 12:58:55', '2020-01-10 12:58:55'),
(9, 'Mohammadia', '35', NULL, '2020-01-10 12:59:07', '2020-01-10 12:59:07'),
(10, 'Tamaresse', '35', NULL, '2020-01-10 12:59:25', '2020-01-10 12:59:25'),
(11, 'Tit Mellil', '35', NULL, '2020-01-10 12:59:39', '2020-01-10 12:59:39'),
(12, 'Agadir', '40', NULL, '2020-01-10 12:59:57', '2020-01-10 12:59:57'),
(13, 'Ait Melloul', '40', NULL, '2020-01-10 13:00:08', '2020-01-10 13:00:08'),
(14, 'Anza', '40', NULL, '2020-01-10 13:00:33', '2020-01-10 13:00:33'),
(15, 'Berrechid', '40', NULL, '2020-01-10 13:00:43', '2020-01-10 13:00:43');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `title` text DEFAULT NULL,
  `icon` text DEFAULT NULL,
  `details` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `icon`, `details`, `created_at`, `updated_at`) VALUES
(4, 'Ramassage', '<i class=\"fa fa-cubes\"></i>', 'Maroc Coursier assure le ramassage de vos colis, un de nos agent va se deplacer chez vous pour ramasser vos colis', '2020-01-10 12:49:03', '2020-01-10 12:49:03'),
(5, 'Livraison', '<i class=\"fa fa-shipping-fast\"></i>', 'Maroc Coursier assure la livraison de vos colis dans les plus bref delais, 24h pour la plupart des ville, et 48h pour le reste', '2020-01-10 12:49:39', '2020-01-10 12:49:39'),
(6, 'Suivi', '<i class=\"fa fa-phone\"></i>', 'Express Coursier assure le suivi de vos colis avec vos clients, et la mise à jour des états des colis dans moins de 48h', '2020-01-10 12:50:08', '2020-01-10 12:50:08');

-- --------------------------------------------------------

--
-- Table structure for table `socials`
--

CREATE TABLE `socials` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'KG', 'Active', '2019-12-01 22:17:07', '2019-12-01 22:17:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('Manager','Staff') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `branch_id` int(10) UNSIGNED DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `image`, `email_verified_at`, `password`, `type`, `status`, `branch_id`, `remember_token`, `code`, `created_at`, `updated_at`) VALUES
(2, 'staff', 'staff@gmail.com', '454564', 'address de test, staff', NULL, NULL, '$2y$10$tDNcb7MfvPaT4IXN0GLwtOD.kqZlzHOBY0.PRPCreWh0Ha6FYMBlW', 'Staff', 'Active', 1, 'B7Kxy87SOuQTMoEidrHfzXn0RIbfrmuJGlDY7SB1GcNlpK0rv0QA5BX6cF7I', NULL, '2019-12-01 22:14:07', '2020-01-10 14:01:37'),
(3, 'staff2', 'staff2@gmail.com', '0676479581', NULL, NULL, NULL, '$2y$10$AHW4VzFOFUqw62RUn8v3QOwZfi0vTvbnDthM5x.h2JJMfUzKuBkJK', 'Staff', 'Active', 1, NULL, NULL, '2019-12-03 09:56:53', '2019-12-03 09:56:53'),
(4, 'Staff3', 'staff3@gmail.com', '000000', NULL, NULL, NULL, '$2y$10$OnQGxav/v8e213tj72Ts3u0iO4c6feS8o0q4hUBLCQrxH4xSemnYa', 'Staff', 'Inactive', 1, '0lHB5mqlTmtsornRdKiMbkVd7dkLFFO0I8KOnENqcBFt3K7KSGJ6v24642b8', NULL, '2019-12-08 11:07:06', '2019-12-08 11:07:06'),
(5, 'qsdqsd', 'qsdqsd@qsd.qsd', 'qsdqsd@qsd.qsd', NULL, 'qsdqsd@qsd.qsd', NULL, '$2y$10$R/xmL0RNO12bOPEqenCI0ufAixafRE2vpMj54A8wAlKLHbSCGmGwG', 'Staff', 'Inactive', 1, '6JXvPg67IgGvzY4DzKWHUSLAAapC9vxSvOH35KK2nALBFMInej9leexA0LA1', NULL, '2020-01-10 14:19:48', '2020-01-10 14:19:48'),
(6, 'qdsqd', 'qsdqsd@sd.sd', 'qsdqsd@sd.sd', NULL, 'qsdqsd@sd.sd', NULL, '$2y$10$JOMbiw5zn8pTkdj2N7edDuX5rfwfZdHDl5d8x4F/8V2GqjBI2PdMq', 'Staff', 'Inactive', 1, '6NlEoHdCMQiWIbg4SErAFPJte0GYIUWAZOYxTW6Un8AI9pV18bIvkf7ht9vJ', NULL, '2020-01-10 14:20:11', '2020-01-10 14:20:11'),
(7, 'qdqs', 'dsdf@sdfds.df', 'dsdf@sdfds.df', NULL, 'dsdf@sdfds.df', NULL, '$2y$10$mVWC9TTYDwLxG6bohNyaS.yOELie8.uWCwBZqNM0Q9ReykqR0fDPG', 'Staff', 'Inactive', 1, 'fEm3wCq2Sly32zAiIGloHADyCTgZGWL8HxgCbc9cJOE3Ia5WQ707Y1mhFUAS', 'hBeX7T', '2020-01-10 14:21:41', '2020-01-10 14:21:41'),
(8, 'nacer', 'nacer@nacer.ma', 'nacer@nacer.ma', NULL, 'nacer@nacer.ma', NULL, '$2y$10$AHYueTqUj4KAKwyBT36oRu1pJst7q1DicOoYOSFpUUqMv.7eGkBCK', 'Staff', 'Inactive', 1, 'YzkxwLD04XU6bO6taEa3IhVUE81SFXSAaPLlQnWFWTW0hxSNJQKsEqYlgFsk', 'GJJR5T', '2020-01-10 14:27:03', '2020-01-10 14:27:03'),
(9, 'sfsdf', 'lhjhjk@df.sdf', 'lhjhjk@df.sdf', NULL, 'lhjhjk@df.sdf', NULL, '$2y$10$Qa3.53pnLbvvKHXDqREpQ.8Y55Y17xeOq0EjXJFJEv9J9bkzgpSdW', 'Staff', 'Inactive', 1, 'YyQYmaOGIub200YlLIAiNamP0xTwusFvifj1fZ9rRaEIN8zGZ2YECQ2t4Z2X', 'edmEHR', '2020-01-10 14:29:52', '2020-01-10 14:29:52'),
(10, 'nacero', 'qsdsqd@qsdsq.sd', 'qsdsqd@qsdsq.sd', NULL, 'qsdsqd@qsdsq.sd', NULL, '$2y$10$1wAFs.LKC4E07owonEgH5O6SK9argeoJ4dUWJjUkCKOClkKBXqIOi', 'Staff', 'Inactive', 1, 'tUOUqOboGCjTXNdSsX9Vo1CQ27VTXI3KFFgnjdKA8M77BNkPLquPmLBFWFXW', NULL, '2020-01-10 14:32:59', '2020-01-10 14:32:59'),
(11, 'Staff it', 'staffit@gmail.com', '0676478594', NULL, '', NULL, '$2y$10$rYcfZc.w0wZzcGWnvI9H3OND6U9iUCxyXinHHrOaTWUz0iesRlW1y', 'Staff', 'Inactive', 1, 'cx78oi9balBuEd6j3HCZlG6yqpvj5TbgNm5Ls0XAZhQ1UI5FEL2sSqA3p2ia', NULL, '2020-01-12 08:57:53', '2020-01-12 08:57:53'),
(12, 'Mohamed', 'mohamed@cmaroc.com', '0676479581', NULL, NULL, NULL, '$2y$10$ReTbE.ec98BowI6MVeV07ugMi03TROcSDYX8lK2C3HQmDIIDf975m', 'Manager', 'Active', 1, NULL, NULL, '2020-01-12 12:09:24', '2020-01-12 12:09:24');

-- --------------------------------------------------------

--
-- Table structure for table `visitor_messages`
--

CREATE TABLE `visitor_messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `messages` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visitor_messages`
--

INSERT INTO `visitor_messages` (`id`, `name`, `email`, `phone`, `messages`, `created_at`, `updated_at`) VALUES
(1, 'qsdd', 'qsdsqd@qsd.sd', '5645456', 'qsdsqd', '2020-01-10 10:44:20', '2020-01-10 10:44:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courier_types`
--
ALTER TABLE `courier_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courier_types_unit_id_index` (`unit_id`);

--
-- Indexes for table `currier_infos`
--
ALTER TABLE `currier_infos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `currier_infos_sender_branch_id_index` (`sender_branch_id`),
  ADD KEY `currier_infos_receiver_branch_id_index` (`receiver_branch_id`),
  ADD KEY `currier_infos_sender_branch_staff_id_index` (`sender_branch_staff_id`),
  ADD KEY `currier_infos_receiver_branch_staff_id_index` (`receiver_branch_staff_id`);

--
-- Indexes for table `currier_product_infos`
--
ALTER TABLE `currier_product_infos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `currier_product_infos_currier_info_id_index` (`currier_info_id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `socials`
--
ALTER TABLE `socials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_branch_id_index` (`branch_id`);

--
-- Indexes for table `visitor_messages`
--
ALTER TABLE `visitor_messages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `courier_types`
--
ALTER TABLE `courier_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `currier_infos`
--
ALTER TABLE `currier_infos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `currier_product_infos`
--
ALTER TABLE `currier_product_infos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `socials`
--
ALTER TABLE `socials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `visitor_messages`
--
ALTER TABLE `visitor_messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courier_types`
--
ALTER TABLE `courier_types`
  ADD CONSTRAINT `courier_types_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `currier_infos`
--
ALTER TABLE `currier_infos`
  ADD CONSTRAINT `currier_infos_receiver_branch_id_foreign` FOREIGN KEY (`receiver_branch_id`) REFERENCES `branches` (`id`),
  ADD CONSTRAINT `currier_infos_receiver_branch_staff_id_foreign` FOREIGN KEY (`receiver_branch_staff_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `currier_infos_sender_branch_id_foreign` FOREIGN KEY (`sender_branch_id`) REFERENCES `branches` (`id`),
  ADD CONSTRAINT `currier_infos_sender_branch_staff_id_foreign` FOREIGN KEY (`sender_branch_staff_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `currier_product_infos`
--
ALTER TABLE `currier_product_infos`
  ADD CONSTRAINT `currier_product_infos_currier_info_id_foreign` FOREIGN KEY (`currier_info_id`) REFERENCES `currier_infos` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
