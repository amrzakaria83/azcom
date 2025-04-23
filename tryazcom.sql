-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2025 at 01:08 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tryazcom`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_trees`
--

CREATE TABLE `account_trees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(255) DEFAULT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = sub have parent_id - 1 = major advance_payment',
  `type_account` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = debite - 1 = credite',
  `value` bigint(20) NOT NULL DEFAULT 0,
  `targete` bigint(20) NOT NULL DEFAULT 0,
  `parent_targete` bigint(20) NOT NULL DEFAULT 0,
  `parent_value` bigint(20) DEFAULT NULL COMMENT 'for clossing and sub item',
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = not active',
  `note` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account_trees`
--

INSERT INTO `account_trees` (`id`, `emp_id`, `name_ar`, `name_en`, `parent_id`, `type`, `type_account`, `value`, `targete`, `parent_targete`, `parent_value`, `status`, `note`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'الاصول', 'Assets', NULL, 1, 1, 0, 0, 0, 0, 0, NULL, NULL, '2024-06-04 06:25:42', '2024-06-04 06:25:42'),
(2, 1, 'الخصوم', 'Adversaries', NULL, 1, 0, 0, 0, 0, 0, 0, NULL, NULL, '2024-06-04 06:26:52', '2024-06-04 06:26:52'),
(3, 1, 'حقوق الملكيه', 'Property rights', NULL, 1, 0, 0, 0, 0, 0, 0, NULL, NULL, '2024-06-04 06:28:39', '2024-06-04 06:28:39'),
(4, 1, 'الاصول الثابته', 'Fixed assets', 1, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, '2024-06-04 06:29:55', '2024-06-04 06:29:55'),
(5, 1, 'الاصول المتداوله', 'Assets', 1, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, '2024-06-04 06:30:43', '2024-06-04 06:30:43'),
(6, 1, 'الاصول الغير ملموسه', 'Intangible assets', 1, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, '2024-06-04 06:31:34', '2024-06-04 06:31:34'),
(7, 1, 'الخصوم قصيره الاجل', 'Short-term liabilities', 2, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, '2024-06-04 06:33:49', '2024-06-04 06:33:49'),
(8, 1, 'الخصوم طويله الاجل', 'Long-term liabilities', 2, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, '2024-06-04 06:34:24', '2024-06-04 06:34:24'),
(9, 1, 'راس المال', 'capital', 3, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, '2024-06-04 06:35:09', '2024-06-04 06:35:09'),
(10, 1, 'الارباح المرحله', 'Moving profits', 3, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, '2024-06-04 06:40:57', '2024-06-04 06:40:57'),
(11, 1, 'ارباح العام', 'Years profits', 3, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, '2024-06-04 06:41:54', '2024-06-04 06:41:54'),
(12, 1, 'جارى الشركاء', 'Partners are running', 3, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, '2024-06-04 06:42:31', '2024-06-04 06:42:31'),
(13, 1, 'الاحتياطيات', 'Reserves', 3, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, '2024-06-04 06:43:14', '2024-06-04 06:43:14'),
(14, 1, 'الايرادات', 'Revenues', NULL, 1, 0, 0, 0, 0, 0, 0, NULL, NULL, '2024-06-04 06:44:19', '2024-06-04 06:44:19'),
(15, 1, 'المصروفات', 'Expenses', NULL, 1, 1, 0, 0, 0, 0, 0, NULL, NULL, '2024-06-04 06:44:52', '2024-06-04 06:44:52'),
(16, 1, 'ايرادات النشاط', 'Activity revenues', 14, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, '2024-06-04 06:45:37', '2024-06-04 06:45:37'),
(17, 1, 'ايرادات اخرى-راسماليه', 'Other capital revenues', 14, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, '2024-06-04 06:46:28', '2024-06-04 06:46:28'),
(18, 1, 'مصروفات اداريه وعموميه', 'General and administrative expenses', 15, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, '2024-06-04 06:47:14', '2024-06-04 06:47:14'),
(19, 1, 'مصروفات تشغيليه', 'Operating expenses', 15, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, '2024-06-04 06:47:54', '2024-06-04 06:47:54'),
(20, 1, 'الاراضي', 'Lands', 4, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, '2024-06-04 06:53:02', '2024-06-04 06:53:02'),
(21, 1, 'الالات', 'The machines', 4, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, '2024-06-04 06:53:32', '2024-06-04 06:53:32'),
(22, 1, 'المعدات', 'hardware', 4, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, '2024-06-04 06:54:43', '2024-06-04 06:54:43'),
(23, 1, 'المباني', 'Buildings', 4, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, '2024-06-04 06:55:54', '2024-06-04 06:55:54'),
(24, 1, 'سيارات', 'Cars', 4, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, '2024-06-04 06:59:17', '2024-06-04 06:59:17'),
(25, 1, 'الموردين', 'Suppliers', 7, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, '2024-06-04 07:03:22', '2024-06-04 07:03:22'),
(26, 1, 'النقدية', 'Cash', 5, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, '2024-06-04 07:05:06', '2024-06-04 07:05:06'),
(27, 1, 'النقدية بالخزينة', 'Cash in the safe', 26, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, '2024-06-04 07:05:48', '2024-06-04 07:05:48'),
(28, 1, 'النقدية بالبنك', 'Cash in the bank', 26, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, '2024-06-04 07:06:35', '2024-06-04 07:06:35'),
(29, 1, 'العملاء', 'Customers', 5, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, '2024-06-04 07:07:37', '2024-06-04 07:07:37'),
(30, 1, 'المخزون', 'Inventory', 5, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, '2024-06-04 07:08:28', '2024-06-04 07:08:28'),
(31, 1, 'العدد والادوات', 'Equipment and tools', 4, 0, 1, 0, 0, 0, 0, 0, NULL, NULL, '2024-06-04 07:09:54', '2024-06-04 07:09:54'),
(32, 1, 'المقاولين', 'Contractors', 7, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, '2024-06-04 07:11:47', '2024-06-04 07:11:47'),
(33, 1, 'القروض - طويله الاجل', 'Loans - long term', 8, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, '2024-06-04 07:13:09', '2024-06-04 07:13:09'),
(34, 1, 'تمويل - طويل الاجل', 'Financing - long term', 8, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, '2024-06-04 07:13:43', '2024-06-04 07:13:43');

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `country_id` varchar(255) DEFAULT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `egy_or_uea_id` text DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = not active ',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `emp_id`, `country_id`, `name_en`, `egy_or_uea_id`, `note`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'EGY', 'abu quir 1', '93', NULL, 0, NULL, '2025-03-09 16:27:32', '2025-03-09 16:27:32'),
(2, 1, 'EGY', 'damanhour  1', '164', NULL, 0, NULL, '2025-03-09 16:27:51', '2025-03-09 16:27:51'),
(3, 1, 'EGY', 'nasr city 1', '39', NULL, 0, NULL, '2025-03-09 16:28:45', '2025-03-09 16:28:45'),
(4, 1, 'EGY', 'az1', '95', NULL, 0, NULL, '2025-03-09 19:49:20', '2025-03-09 19:49:20'),
(5, 1, 'EGY', 'tanta1', '192', NULL, 0, NULL, '2025-03-09 19:49:37', '2025-03-09 19:49:37'),
(6, 1, 'EGY', 'banisweif 1', '277', NULL, 0, NULL, '2025-03-09 19:50:20', '2025-03-09 19:50:20'),
(7, 1, 'EGY', 'banha1', '231', NULL, 0, NULL, '2025-03-09 19:50:46', '2025-03-09 19:50:46');

-- --------------------------------------------------------

--
-- Table structure for table `assistants`
--

CREATE TABLE `assistants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `center_id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `phone2` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = not active ',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bill_sale_details`
--

CREATE TABLE `bill_sale_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `bill_sale_header_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantityproduc` decimal(10,3) DEFAULT NULL COMMENT 'note for user',
  `sellpriceproduct` decimal(10,3) DEFAULT NULL COMMENT 'note for user',
  `note` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = not active ',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `approv_quantity` decimal(10,3) DEFAULT NULL COMMENT 'note for user',
  `approv_sellpriceproduct` decimal(10,3) DEFAULT NULL COMMENT 'note for user',
  `approv_percent` decimal(10,3) DEFAULT NULL COMMENT 'note for user',
  `status_requ` tinyint(4) DEFAULT NULL COMMENT '0 = request - 1 = approved - 2 = somecancell - 3 = all cancel - 4 = under deliverd - 5 = deliverd - 6 = Under collection - 7 = some paied - 8 = total paied ',
  `percent` decimal(10,3) DEFAULT NULL,
  `sellpriceph` decimal(10,3) DEFAULT NULL COMMENT 'note for user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bill_sale_headers`
--

CREATE TABLE `bill_sale_headers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `cut_sale_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sale_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `valued_time` datetime DEFAULT NULL,
  `totalsellprice` decimal(10,3) DEFAULT NULL COMMENT 'note for user',
  `note` text DEFAULT NULL,
  `method_for_payment` text DEFAULT NULL,
  `status_order` text DEFAULT NULL,
  `note1` text DEFAULT NULL,
  `note2` text DEFAULT NULL,
  `note3` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = not active ',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `approv_sellprice` decimal(10,3) DEFAULT NULL COMMENT 'note for user',
  `status_requ` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = request - 1 = approved - 2 = somecancell - 3 = all cancel - 4 = under deliverd - 5 = deliverd - 6 = Under collection - 7 = some paied - 8 = total paied '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `type` enum('news','gallery','video') NOT NULL DEFAULT 'news',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brand_gifts`
--

CREATE TABLE `brand_gifts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `note` text DEFAULT NULL,
  `class_gift` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = general - 1 =  specital - 2 = Valuable gift ',
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = not active ',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cashiers`
--

CREATE TABLE `cashiers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `acctree_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `value` bigint(20) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = notactive',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `centers`
--

CREATE TABLE `centers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `type_id` bigint(20) UNSIGNED NOT NULL,
  `area_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `phone2` varchar(255) DEFAULT NULL,
  `landline` varchar(255) DEFAULT NULL,
  `landline2` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `map_location` text DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = not active ',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `lng` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `centers`
--

INSERT INTO `centers` (`id`, `emp_id`, `type_id`, `area_id`, `name_en`, `phone`, `phone2`, `landline`, `landline2`, `email`, `website`, `address`, `map_location`, `note`, `status`, `deleted_at`, `created_at`, `updated_at`, `lat`, `lng`) VALUES
(1, 1, 2, 2, 'Mohamed Elzonkoly Clinic (Etay)', '0453331212', NULL, NULL, NULL, NULL, NULL, 'Elgomhoriaa Street', NULL, NULL, 0, NULL, '2025-03-09 18:39:31', '2025-03-09 18:39:31', '30.890350387956904', '30.66338364044597'),
(2, 1, 1, 3, 'Shepen university', '01006512740', NULL, NULL, NULL, NULL, NULL, 'adress', NULL, NULL, 0, NULL, '2025-03-09 18:48:06', '2025-03-09 18:48:06', '30.059483014682513', '31.331921612399615'),
(3, 1, 2, 1, 'Tamer Hassan Clinic', '034819380', NULL, NULL, NULL, NULL, NULL, 'ميدكال تاور- 8 ش كليه الطب محطه الرمل', NULL, NULL, 0, NULL, '2025-03-09 19:02:03', '2025-03-09 19:02:03', '31.209160632875374', '29.910619833603747'),
(4, 1, 1, 6, 'center 1', '00000', NULL, NULL, NULL, NULL, NULL, 'adress bani', NULL, NULL, 0, NULL, '2025-03-09 19:52:25', '2025-03-09 19:52:25', '29.073335022349912', '31.096495464440512'),
(5, 1, 1, 5, 'center 2', '0000', NULL, NULL, NULL, NULL, NULL, 'Elgomhoriaa Street', NULL, NULL, 0, NULL, '2025-03-09 19:53:17', '2025-03-09 19:53:17', '30.784184806162777', '30.996418244384387'),
(6, 1, 2, 7, 'center 3', '01559963440', NULL, NULL, NULL, NULL, NULL, 'adress', NULL, NULL, 0, NULL, '2025-03-10 19:44:19', '2025-03-10 19:44:19', '30.462248875026848', '31.186723073519648');

-- --------------------------------------------------------

--
-- Table structure for table `center_departments`
--

CREATE TABLE `center_departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = not active ',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `governorate_id` int(11) DEFAULT NULL,
  `city_name_ar` text DEFAULT NULL,
  `city_name_en` text DEFAULT NULL,
  `countrycodealpha3` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `governorate_id`, `city_name_ar`, `city_name_en`, `countrycodealpha3`, `created_at`, `updated_at`) VALUES
(1, 1, '15 مايو', '15 May', 'EGY', NULL, NULL),
(2, 1, 'الازبكية', 'Al Azbakeyah', 'EGY', NULL, NULL),
(3, 1, 'البساتين', 'Al Basatin', 'EGY', NULL, NULL),
(4, 1, 'التبين', 'Tebin', 'EGY', NULL, NULL),
(5, 1, 'الخليفة', 'El-Khalifa', 'EGY', NULL, NULL),
(6, 1, 'الدراسة', 'El darrasa', 'EGY', NULL, NULL),
(7, 1, 'الدرب الاحمر', 'Aldarb Alahmar', 'EGY', NULL, NULL),
(8, 1, 'الزاوية الحمراء', 'Zawya al-Hamra', 'EGY', NULL, NULL),
(9, 1, 'الزيتون', 'El-Zaytoun', 'EGY', NULL, NULL),
(10, 1, 'الساحل', 'Sahel', 'EGY', NULL, NULL),
(11, 1, 'السلام', 'El Salam', 'EGY', NULL, NULL),
(12, 1, 'السيدة زينب', 'Sayeda Zeinab', 'EGY', NULL, NULL),
(13, 1, 'الشرابية', 'El Sharabeya', 'EGY', NULL, NULL),
(14, 1, 'مدينة الشروق', 'Shorouk', 'EGY', NULL, NULL),
(15, 1, 'الظاهر', 'El Daher', 'EGY', NULL, NULL),
(16, 1, 'العتبة', 'Ataba', 'EGY', NULL, NULL),
(17, 1, 'القاهرة الجديدة', 'New Cairo', 'EGY', NULL, NULL),
(18, 1, 'المرج', 'El Marg', 'EGY', NULL, NULL),
(19, 1, 'عزبة النخل', 'Ezbet el Nakhl', 'EGY', NULL, NULL),
(20, 1, 'المطرية', 'Matareya', 'EGY', NULL, NULL),
(21, 1, 'المعادى', 'Maadi', 'EGY', NULL, NULL),
(22, 1, 'المعصرة', 'Maasara', 'EGY', NULL, NULL),
(23, 1, 'المقطم', 'Mokattam', 'EGY', NULL, NULL),
(24, 1, 'المنيل', 'Manyal', 'EGY', NULL, NULL),
(25, 1, 'الموسكى', 'Mosky', 'EGY', NULL, NULL),
(26, 1, 'النزهة', 'Nozha', 'EGY', NULL, NULL),
(27, 1, 'الوايلى', 'Waily', 'EGY', NULL, NULL),
(28, 1, 'باب الشعرية', 'Bab al-Shereia', 'EGY', NULL, NULL),
(29, 1, 'بولاق', 'Bolaq', 'EGY', NULL, NULL),
(30, 1, 'جاردن سيتى', 'Garden City', 'EGY', NULL, NULL),
(31, 1, 'حدائق القبة', 'Hadayek El-Kobba', 'EGY', NULL, NULL),
(32, 1, 'حلوان', 'Helwan', 'EGY', NULL, NULL),
(33, 1, 'دار السلام', 'Dar Al Salam', 'EGY', NULL, NULL),
(34, 1, 'شبرا', 'Shubra', 'EGY', NULL, NULL),
(35, 1, 'طره', 'Tura', 'EGY', NULL, NULL),
(36, 1, 'عابدين', 'Abdeen', 'EGY', NULL, NULL),
(37, 1, 'عباسية', 'Abaseya', 'EGY', NULL, NULL),
(38, 1, 'عين شمس', 'Ain Shams', 'EGY', NULL, NULL),
(39, 1, 'مدينة نصر', 'Nasr City', 'EGY', NULL, NULL),
(40, 1, 'مصر الجديدة', 'New Heliopolis', 'EGY', NULL, NULL),
(41, 1, 'مصر القديمة', 'Masr Al Qadima', 'EGY', NULL, NULL),
(42, 1, 'منشية ناصر', 'Mansheya Nasir', 'EGY', NULL, NULL),
(43, 1, 'مدينة بدر', 'Badr City', 'EGY', NULL, NULL),
(44, 1, 'مدينة العبور', 'Obour City', 'EGY', NULL, NULL),
(45, 1, 'وسط البلد', 'Cairo Downtown', 'EGY', NULL, NULL),
(46, 1, 'الزمالك', 'Zamalek', 'EGY', NULL, NULL),
(47, 1, 'قصر النيل', 'Kasr El Nile', 'EGY', NULL, NULL),
(48, 1, 'الرحاب', 'Rehab', 'EGY', NULL, NULL),
(49, 1, 'القطامية', 'Katameya', 'EGY', NULL, NULL),
(50, 1, 'مدينتي', 'Madinty', 'EGY', NULL, NULL),
(51, 1, 'روض الفرج', 'Rod Alfarag', 'EGY', NULL, NULL),
(52, 1, 'شيراتون', 'Sheraton', 'EGY', NULL, NULL),
(53, 1, 'الجمالية', 'El-Gamaleya', 'EGY', NULL, NULL),
(54, 1, 'العاشر من رمضان', '10th of Ramadan City', 'EGY', NULL, NULL),
(55, 1, 'الحلمية', 'Helmeyat Alzaytoun', 'EGY', NULL, NULL),
(56, 1, 'النزهة الجديدة', 'New Nozha', 'EGY', NULL, NULL),
(57, 1, 'العاصمة الإدارية', 'Capital New', 'EGY', NULL, NULL),
(58, 2, 'الجيزة', 'Giza', 'EGY', NULL, NULL),
(59, 2, 'السادس من أكتوبر', 'Sixth of October', 'EGY', NULL, NULL),
(60, 2, 'الشيخ زايد', 'Cheikh Zayed', 'EGY', NULL, NULL),
(61, 2, 'الحوامدية', 'Hawamdiyah', 'EGY', NULL, NULL),
(62, 2, 'البدرشين', 'Al Badrasheen', 'EGY', NULL, NULL),
(63, 2, 'الصف', 'Saf', 'EGY', NULL, NULL),
(64, 2, 'أطفيح', 'Atfih', 'EGY', NULL, NULL),
(65, 2, 'العياط', 'Al Ayat', 'EGY', NULL, NULL),
(66, 2, 'الباويطي', 'Al-Bawaiti', 'EGY', NULL, NULL),
(67, 2, 'منشأة القناطر', 'ManshiyetAl Qanater', 'EGY', NULL, NULL),
(68, 2, 'أوسيم', 'Oaseem', 'EGY', NULL, NULL),
(69, 2, 'كرداسة', 'Kerdasa', 'EGY', NULL, NULL),
(70, 2, 'أبو النمرس', 'Abu Nomros', 'EGY', NULL, NULL),
(71, 2, 'كفر غطاطي', 'Kafr Ghati', 'EGY', NULL, NULL),
(72, 2, 'منشأة البكاري', 'Manshiyet Al Bakari', 'EGY', NULL, NULL),
(73, 2, 'الدقى', 'Dokki', 'EGY', NULL, NULL),
(74, 2, 'العجوزة', 'Agouza', 'EGY', NULL, NULL),
(75, 2, 'الهرم', 'Haram', 'EGY', NULL, NULL),
(76, 2, 'الوراق', 'Warraq', 'EGY', NULL, NULL),
(77, 2, 'امبابة', 'Imbaba', 'EGY', NULL, NULL),
(78, 2, 'بولاق الدكرور', 'Boulaq Dakrour', 'EGY', NULL, NULL),
(79, 2, 'الواحات البحرية', 'Al Wahat Al Baharia', 'EGY', NULL, NULL),
(80, 2, 'العمرانية', 'Omraneya', 'EGY', NULL, NULL),
(81, 2, 'المنيب', 'Moneeb', 'EGY', NULL, NULL),
(82, 2, 'بين السرايات', 'Bin Alsarayat', 'EGY', NULL, NULL),
(83, 2, 'الكيت كات', 'Kit Kat', 'EGY', NULL, NULL),
(84, 2, 'المهندسين', 'Mohandessin', 'EGY', NULL, NULL),
(85, 2, 'فيصل', 'Faisal', 'EGY', NULL, NULL),
(86, 2, 'أبو رواش', 'Abu Rawash', 'EGY', NULL, NULL),
(87, 2, 'حدائق الأهرام', 'Hadayek Alahram', 'EGY', NULL, NULL),
(88, 2, 'الحرانية', 'Haraneya', 'EGY', NULL, NULL),
(89, 2, 'حدائق اكتوبر', 'Hadayek October', 'EGY', NULL, NULL),
(90, 2, 'صفط اللبن', 'Saft Allaban', 'EGY', NULL, NULL),
(91, 2, 'القرية الذكية', 'Smart Village', 'EGY', NULL, NULL),
(92, 2, 'ارض اللواء', 'Ard Ellwaa', 'EGY', NULL, NULL),
(93, 3, 'ابو قير', 'Abu Qir', 'EGY', NULL, NULL),
(94, 3, 'الابراهيمية', 'Al Ibrahimeyah', 'EGY', NULL, NULL),
(95, 3, 'الأزاريطة', 'Azarita', 'EGY', NULL, NULL),
(96, 3, 'الانفوشى', 'Anfoushi', 'EGY', NULL, NULL),
(97, 3, 'الدخيلة', 'Dekheila', 'EGY', NULL, NULL),
(98, 3, 'السيوف', 'El Soyof', 'EGY', NULL, NULL),
(99, 3, 'العامرية', 'Ameria', 'EGY', NULL, NULL),
(100, 3, 'اللبان', 'El Labban', 'EGY', NULL, NULL),
(101, 3, 'المفروزة', 'Al Mafrouza', 'EGY', NULL, NULL),
(102, 3, 'المنتزه', 'El Montaza', 'EGY', NULL, NULL),
(103, 3, 'المنشية', 'Mansheya', 'EGY', NULL, NULL),
(104, 3, 'الناصرية', 'Naseria', 'EGY', NULL, NULL),
(105, 3, 'امبروزو', 'Ambrozo', 'EGY', NULL, NULL),
(106, 3, 'باب شرق', 'Bab Sharq', 'EGY', NULL, NULL),
(107, 3, 'برج العرب', 'Bourj Alarab', 'EGY', NULL, NULL),
(108, 3, 'ستانلى', 'Stanley', 'EGY', NULL, NULL),
(109, 3, 'سموحة', 'Smouha', 'EGY', NULL, NULL),
(110, 3, 'سيدى بشر', 'Sidi Bishr', 'EGY', NULL, NULL),
(111, 3, 'شدس', 'Shads', 'EGY', NULL, NULL),
(112, 3, 'غيط العنب', 'Gheet Alenab', 'EGY', NULL, NULL),
(113, 3, 'فلمينج', 'Fleming', 'EGY', NULL, NULL),
(114, 3, 'فيكتوريا', 'Victoria', 'EGY', NULL, NULL),
(115, 3, 'كامب شيزار', 'Camp Shizar', 'EGY', NULL, NULL),
(116, 3, 'كرموز', 'Karmooz', 'EGY', NULL, NULL),
(117, 3, 'محطة الرمل', 'Mahta Alraml', 'EGY', NULL, NULL),
(118, 3, 'مينا البصل', 'Mina El-Basal', 'EGY', NULL, NULL),
(119, 3, 'العصافرة', 'Asafra', 'EGY', NULL, NULL),
(120, 3, 'العجمي', 'Agamy', 'EGY', NULL, NULL),
(121, 3, 'بكوس', 'Bakos', 'EGY', NULL, NULL),
(122, 3, 'بولكلي', 'Boulkly', 'EGY', NULL, NULL),
(123, 3, 'كليوباترا', 'Cleopatra', 'EGY', NULL, NULL),
(124, 3, 'جليم', 'Glim', 'EGY', NULL, NULL),
(125, 3, 'المعمورة', 'Al Mamurah', 'EGY', NULL, NULL),
(126, 3, 'المندرة', 'Al Mandara', 'EGY', NULL, NULL),
(127, 3, 'محرم بك', 'Moharam Bek', 'EGY', NULL, NULL),
(128, 3, 'الشاطبي', 'Elshatby', 'EGY', NULL, NULL),
(129, 3, 'سيدي جابر', 'Sidi Gaber', 'EGY', NULL, NULL),
(130, 3, 'الساحل الشمالي', 'North Coast/sahel', 'EGY', NULL, NULL),
(131, 3, 'الحضرة', 'Alhadra', 'EGY', NULL, NULL),
(132, 3, 'العطارين', 'Alattarin', 'EGY', NULL, NULL),
(133, 3, 'سيدي كرير', 'Sidi Kerir', 'EGY', NULL, NULL),
(134, 3, 'الجمرك', 'Elgomrok', 'EGY', NULL, NULL),
(135, 3, 'المكس', 'Al Max', 'EGY', NULL, NULL),
(136, 3, 'مارينا', 'Marina', 'EGY', NULL, NULL),
(137, 4, 'المنصورة', 'Mansoura', 'EGY', NULL, NULL),
(138, 4, 'طلخا', 'Talkha', 'EGY', NULL, NULL),
(139, 4, 'ميت غمر', 'Mitt Ghamr', 'EGY', NULL, NULL),
(140, 4, 'دكرنس', 'Dekernes', 'EGY', NULL, NULL),
(141, 4, 'أجا', 'Aga', 'EGY', NULL, NULL),
(142, 4, 'منية النصر', 'Menia El Nasr', 'EGY', NULL, NULL),
(143, 4, 'السنبلاوين', 'Sinbillawin', 'EGY', NULL, NULL),
(144, 4, 'الكردي', 'El Kurdi', 'EGY', NULL, NULL),
(145, 4, 'بني عبيد', 'Bani Ubaid', 'EGY', NULL, NULL),
(146, 4, 'المنزلة', 'Al Manzala', 'EGY', NULL, NULL),
(147, 4, 'تمي الأمديد', 'tami alamdid', 'EGY', NULL, NULL),
(148, 4, 'الجمالية', 'aljamalia', 'EGY', NULL, NULL),
(149, 4, 'شربين', 'Sherbin', 'EGY', NULL, NULL),
(150, 4, 'المطرية', 'Mataria', 'EGY', NULL, NULL),
(151, 4, 'بلقاس', 'Belqas', 'EGY', NULL, NULL),
(152, 4, 'ميت سلسيل', 'Meet Salsil', 'EGY', NULL, NULL),
(153, 4, 'جمصة', 'Gamasa', 'EGY', NULL, NULL),
(154, 4, 'محلة دمنة', 'Mahalat Damana', 'EGY', NULL, NULL),
(155, 4, 'نبروه', 'Nabroh', 'EGY', NULL, NULL),
(156, 5, 'الغردقة', 'Hurghada', 'EGY', NULL, NULL),
(157, 5, 'رأس غارب', 'Ras Ghareb', 'EGY', NULL, NULL),
(158, 5, 'سفاجا', 'Safaga', 'EGY', NULL, NULL),
(159, 5, 'القصير', 'El Qusiar', 'EGY', NULL, NULL),
(160, 5, 'مرسى علم', 'Marsa Alam', 'EGY', NULL, NULL),
(161, 5, 'الشلاتين', 'Shalatin', 'EGY', NULL, NULL),
(162, 5, 'حلايب', 'Halaib', 'EGY', NULL, NULL),
(163, 5, 'الدهار', 'Aldahar', 'EGY', NULL, NULL),
(164, 6, 'دمنهور', 'Damanhour', 'EGY', NULL, NULL),
(165, 6, 'كفر الدوار', 'Kafr El Dawar', 'EGY', NULL, NULL),
(166, 6, 'رشيد', 'Rashid', 'EGY', NULL, NULL),
(167, 6, 'إدكو', 'Edco', 'EGY', NULL, NULL),
(168, 6, 'أبو المطامير', 'Abu al-Matamir', 'EGY', NULL, NULL),
(169, 6, 'أبو حمص', 'Abu Homs', 'EGY', NULL, NULL),
(170, 6, 'الدلنجات', 'Delengat', 'EGY', NULL, NULL),
(171, 6, 'المحمودية', 'Mahmoudiyah', 'EGY', NULL, NULL),
(172, 6, 'الرحمانية', 'Rahmaniyah', 'EGY', NULL, NULL),
(173, 6, 'إيتاي البارود', 'Itai Baroud', 'EGY', NULL, NULL),
(174, 6, 'حوش عيسى', 'Housh Eissa', 'EGY', NULL, NULL),
(175, 6, 'شبراخيت', 'Shubrakhit', 'EGY', NULL, NULL),
(176, 6, 'كوم حمادة', 'Kom Hamada', 'EGY', NULL, NULL),
(177, 6, 'بدر', 'Badr', 'EGY', NULL, NULL),
(178, 6, 'وادي النطرون', 'Wadi Natrun', 'EGY', NULL, NULL),
(179, 6, 'النوبارية الجديدة', 'New Nubaria', 'EGY', NULL, NULL),
(180, 6, 'النوبارية', 'Alnoubareya', 'EGY', NULL, NULL),
(181, 7, 'الفيوم', 'Fayoum', 'EGY', NULL, NULL),
(182, 7, 'الفيوم الجديدة', 'Fayoum El Gedida', 'EGY', NULL, NULL),
(183, 7, 'طامية', 'Tamiya', 'EGY', NULL, NULL),
(184, 7, 'سنورس', 'Snores', 'EGY', NULL, NULL),
(185, 7, 'إطسا', 'Etsa', 'EGY', NULL, NULL),
(186, 7, 'إبشواي', 'Epschway', 'EGY', NULL, NULL),
(187, 7, 'يوسف الصديق', 'Yusuf El Sediaq', 'EGY', NULL, NULL),
(188, 7, 'الحادقة', 'Hadqa', 'EGY', NULL, NULL),
(189, 7, 'اطسا', 'Atsa', 'EGY', NULL, NULL),
(190, 7, 'الجامعة', 'Algamaa', 'EGY', NULL, NULL),
(191, 7, 'السيالة', 'Sayala', 'EGY', NULL, NULL),
(192, 8, 'طنطا', 'Tanta', 'EGY', NULL, NULL),
(193, 8, 'المحلة الكبرى', 'Al Mahalla Al Kobra', 'EGY', NULL, NULL),
(194, 8, 'كفر الزيات', 'Kafr El Zayat', 'EGY', NULL, NULL),
(195, 8, 'زفتى', 'Zefta', 'EGY', NULL, NULL),
(196, 8, 'السنطة', 'El Santa', 'EGY', NULL, NULL),
(197, 8, 'قطور', 'Qutour', 'EGY', NULL, NULL),
(198, 8, 'بسيون', 'Basion', 'EGY', NULL, NULL),
(199, 8, 'سمنود', 'Samannoud', 'EGY', NULL, NULL),
(200, 9, 'الإسماعيلية', 'Ismailia', 'EGY', NULL, NULL),
(201, 9, 'فايد', 'Fayed', 'EGY', NULL, NULL),
(202, 9, 'القنطرة شرق', 'Qantara Sharq', 'EGY', NULL, NULL),
(203, 9, 'القنطرة غرب', 'Qantara Gharb', 'EGY', NULL, NULL),
(204, 9, 'التل الكبير', 'El Tal El Kabier', 'EGY', NULL, NULL),
(205, 9, 'أبو صوير', 'Abu Sawir', 'EGY', NULL, NULL),
(206, 9, 'القصاصين الجديدة', 'Kasasien El Gedida', 'EGY', NULL, NULL),
(207, 9, 'نفيشة', 'Nefesha', 'EGY', NULL, NULL),
(208, 9, 'الشيخ زايد', 'Sheikh Zayed', 'EGY', NULL, NULL),
(209, 10, 'شبين الكوم', 'Shbeen El Koom', 'EGY', NULL, NULL),
(210, 10, 'مدينة السادات', 'Sadat City', 'EGY', NULL, NULL),
(211, 10, 'منوف', 'Menouf', 'EGY', NULL, NULL),
(212, 10, 'سرس الليان', 'Sars El-Layan', 'EGY', NULL, NULL),
(213, 10, 'أشمون', 'Ashmon', 'EGY', NULL, NULL),
(214, 10, 'الباجور', 'Al Bagor', 'EGY', NULL, NULL),
(215, 10, 'قويسنا', 'Quesna', 'EGY', NULL, NULL),
(216, 10, 'بركة السبع', 'Berkat El Saba', 'EGY', NULL, NULL),
(217, 10, 'تلا', 'Tala', 'EGY', NULL, NULL),
(218, 10, 'الشهداء', 'Al Shohada', 'EGY', NULL, NULL),
(219, 11, 'المنيا', 'Minya', 'EGY', NULL, NULL),
(220, 11, 'المنيا الجديدة', 'Minya El Gedida', 'EGY', NULL, NULL),
(221, 11, 'العدوة', 'El Adwa', 'EGY', NULL, NULL),
(222, 11, 'مغاغة', 'Magagha', 'EGY', NULL, NULL),
(223, 11, 'بني مزار', 'Bani Mazar', 'EGY', NULL, NULL),
(224, 11, 'مطاي', 'Mattay', 'EGY', NULL, NULL),
(225, 11, 'سمالوط', 'Samalut', 'EGY', NULL, NULL),
(226, 11, 'المدينة الفكرية', 'Madinat El Fekria', 'EGY', NULL, NULL),
(227, 11, 'ملوي', 'Meloy', 'EGY', NULL, NULL),
(228, 11, 'دير مواس', 'Deir Mawas', 'EGY', NULL, NULL),
(229, 11, 'ابو قرقاص', 'Abu Qurqas', 'EGY', NULL, NULL),
(230, 11, 'ارض سلطان', 'Ard Sultan', 'EGY', NULL, NULL),
(231, 12, 'بنها', 'Banha', 'EGY', NULL, NULL),
(232, 12, 'قليوب', 'Qalyub', 'EGY', NULL, NULL),
(233, 12, 'شبرا الخيمة', 'Shubra Al Khaimah', 'EGY', NULL, NULL),
(234, 12, 'القناطر الخيرية', 'Al Qanater Charity', 'EGY', NULL, NULL),
(235, 12, 'الخانكة', 'Khanka', 'EGY', NULL, NULL),
(236, 12, 'كفر شكر', 'Kafr Shukr', 'EGY', NULL, NULL),
(237, 12, 'طوخ', 'Tukh', 'EGY', NULL, NULL),
(238, 12, 'قها', 'Qaha', 'EGY', NULL, NULL),
(239, 12, 'العبور', 'Obour', 'EGY', NULL, NULL),
(240, 12, 'الخصوص', 'Khosous', 'EGY', NULL, NULL),
(241, 12, 'شبين القناطر', 'Shibin Al Qanater', 'EGY', NULL, NULL),
(242, 12, 'مسطرد', 'Mostorod', 'EGY', NULL, NULL),
(243, 13, 'الخارجة', 'El Kharga', 'EGY', NULL, NULL),
(244, 13, 'باريس', 'Paris', 'EGY', NULL, NULL),
(245, 13, 'موط', 'Mout', 'EGY', NULL, NULL),
(246, 13, 'الفرافرة', 'Farafra', 'EGY', NULL, NULL),
(247, 13, 'بلاط', 'Balat', 'EGY', NULL, NULL),
(248, 13, 'الداخلة', 'Dakhla', 'EGY', NULL, NULL),
(249, 14, 'السويس', 'Suez', 'EGY', NULL, NULL),
(250, 14, 'الجناين', 'Alganayen', 'EGY', NULL, NULL),
(251, 14, 'عتاقة', 'Ataqah', 'EGY', NULL, NULL),
(252, 14, 'العين السخنة', 'Ain Sokhna', 'EGY', NULL, NULL),
(253, 14, 'فيصل', 'Faysal', 'EGY', NULL, NULL),
(254, 15, 'أسوان', 'Aswan', 'EGY', NULL, NULL),
(255, 15, 'أسوان الجديدة', 'Aswan El Gedida', 'EGY', NULL, NULL),
(256, 15, 'دراو', 'Drau', 'EGY', NULL, NULL),
(257, 15, 'كوم أمبو', 'Kom Ombo', 'EGY', NULL, NULL),
(258, 15, 'نصر النوبة', 'Nasr Al Nuba', 'EGY', NULL, NULL),
(259, 15, 'كلابشة', 'Kalabsha', 'EGY', NULL, NULL),
(260, 15, 'إدفو', 'Edfu', 'EGY', NULL, NULL),
(261, 15, 'الرديسية', 'Al-Radisiyah', 'EGY', NULL, NULL),
(262, 15, 'البصيلية', 'Al Basilia', 'EGY', NULL, NULL),
(263, 15, 'السباعية', 'Al Sibaeia', 'EGY', NULL, NULL),
(264, 15, 'ابوسمبل السياحية', 'Abo Simbl Al Siyahia', 'EGY', NULL, NULL),
(265, 15, 'مرسى علم', 'Marsa Alam', 'EGY', NULL, NULL),
(266, 16, 'أسيوط', 'Assiut', 'EGY', NULL, NULL),
(267, 16, 'أسيوط الجديدة', 'Assiut El Gedida', 'EGY', NULL, NULL),
(268, 16, 'ديروط', 'Dayrout', 'EGY', NULL, NULL),
(269, 16, 'منفلوط', 'Manfalut', 'EGY', NULL, NULL),
(270, 16, 'القوصية', 'Qusiya', 'EGY', NULL, NULL),
(271, 16, 'أبنوب', 'Abnoub', 'EGY', NULL, NULL),
(272, 16, 'أبو تيج', 'Abu Tig', 'EGY', NULL, NULL),
(273, 16, 'الغنايم', 'El Ghanaim', 'EGY', NULL, NULL),
(274, 16, 'ساحل سليم', 'Sahel Selim', 'EGY', NULL, NULL),
(275, 16, 'البداري', 'El Badari', 'EGY', NULL, NULL),
(276, 16, 'صدفا', 'Sidfa', 'EGY', NULL, NULL),
(277, 17, 'بني سويف', 'Bani Sweif', 'EGY', NULL, NULL),
(278, 17, 'بني سويف الجديدة', 'Beni Suef El Gedida', 'EGY', NULL, NULL),
(279, 17, 'الواسطى', 'Al Wasta', 'EGY', NULL, NULL),
(280, 17, 'ناصر', 'Naser', 'EGY', NULL, NULL),
(281, 17, 'إهناسيا', 'Ehnasia', 'EGY', NULL, NULL),
(282, 17, 'ببا', 'beba', 'EGY', NULL, NULL),
(283, 17, 'الفشن', 'Fashn', 'EGY', NULL, NULL),
(284, 17, 'سمسطا', 'Somasta', 'EGY', NULL, NULL),
(285, 17, 'الاباصيرى', 'Alabbaseri', 'EGY', NULL, NULL),
(286, 17, 'مقبل', 'Mokbel', 'EGY', NULL, NULL),
(287, 18, 'بورسعيد', 'PorSaid', 'EGY', NULL, NULL),
(288, 18, 'بورفؤاد', 'Port Fouad', 'EGY', NULL, NULL),
(289, 18, 'العرب', 'Alarab', 'EGY', NULL, NULL),
(290, 18, 'حى الزهور', 'Zohour', 'EGY', NULL, NULL),
(291, 18, 'حى الشرق', 'Alsharq', 'EGY', NULL, NULL),
(292, 18, 'حى الضواحى', 'Aldawahi', 'EGY', NULL, NULL),
(293, 18, 'حى المناخ', 'Almanakh', 'EGY', NULL, NULL),
(294, 18, 'حى مبارك', 'Mubarak', 'EGY', NULL, NULL),
(295, 19, 'دمياط', 'Damietta', 'EGY', NULL, NULL),
(296, 19, 'دمياط الجديدة', 'New Damietta', 'EGY', NULL, NULL),
(297, 19, 'رأس البر', 'Ras El Bar', 'EGY', NULL, NULL),
(298, 19, 'فارسكور', 'Faraskour', 'EGY', NULL, NULL),
(299, 19, 'الزرقا', 'Zarqa', 'EGY', NULL, NULL),
(300, 19, 'السرو', 'alsaru', 'EGY', NULL, NULL),
(301, 19, 'الروضة', 'alruwda', 'EGY', NULL, NULL),
(302, 19, 'كفر البطيخ', 'Kafr El-Batikh', 'EGY', NULL, NULL),
(303, 19, 'عزبة البرج', 'Azbet Al Burg', 'EGY', NULL, NULL),
(304, 19, 'ميت أبو غالب', 'Meet Abou Ghalib', 'EGY', NULL, NULL),
(305, 19, 'كفر سعد', 'Kafr Saad', 'EGY', NULL, NULL),
(306, 20, 'الزقازيق', 'Zagazig', 'EGY', NULL, NULL),
(307, 20, 'العاشر من رمضان', 'Al Ashr Men Ramadan', 'EGY', NULL, NULL),
(308, 20, 'منيا القمح', 'Minya Al Qamh', 'EGY', NULL, NULL),
(309, 20, 'بلبيس', 'Belbeis', 'EGY', NULL, NULL),
(310, 20, 'مشتول السوق', 'Mashtoul El Souq', 'EGY', NULL, NULL),
(311, 20, 'القنايات', 'Qenaiat', 'EGY', NULL, NULL),
(312, 20, 'أبو حماد', 'Abu Hammad', 'EGY', NULL, NULL),
(313, 20, 'القرين', 'El Qurain', 'EGY', NULL, NULL),
(314, 20, 'ههيا', 'Hehia', 'EGY', NULL, NULL),
(315, 20, 'أبو كبير', 'Abu Kabir', 'EGY', NULL, NULL),
(316, 20, 'فاقوس', 'Faccus', 'EGY', NULL, NULL),
(317, 20, 'الصالحية الجديدة', 'El Salihia El Gedida', 'EGY', NULL, NULL),
(318, 20, 'الإبراهيمية', 'Al Ibrahimiyah', 'EGY', NULL, NULL),
(319, 20, 'ديرب نجم', 'Deirb Negm', 'EGY', NULL, NULL),
(320, 20, 'كفر صقر', 'Kafr Saqr', 'EGY', NULL, NULL),
(321, 20, 'أولاد صقر', 'Awlad Saqr', 'EGY', NULL, NULL),
(322, 20, 'الحسينية', 'Husseiniya', 'EGY', NULL, NULL),
(323, 20, 'صان الحجر القبلية', 'san alhajar alqablia', 'EGY', NULL, NULL),
(324, 20, 'منشأة أبو عمر', 'Manshayat Abu Omar', 'EGY', NULL, NULL),
(325, 21, 'الطور', 'Al Toor', 'EGY', NULL, NULL),
(326, 21, 'شرم الشيخ', 'Sharm El-Shaikh', 'EGY', NULL, NULL),
(327, 21, 'دهب', 'Dahab', 'EGY', NULL, NULL),
(328, 21, 'نويبع', 'Nuweiba', 'EGY', NULL, NULL),
(329, 21, 'طابا', 'Taba', 'EGY', NULL, NULL),
(330, 21, 'سانت كاترين', 'Saint Catherine', 'EGY', NULL, NULL),
(331, 21, 'أبو رديس', 'Abu Redis', 'EGY', NULL, NULL),
(332, 21, 'أبو زنيمة', 'Abu Zenaima', 'EGY', NULL, NULL),
(333, 21, 'رأس سدر', 'Ras Sidr', 'EGY', NULL, NULL),
(334, 22, 'كفر الشيخ', 'Kafr El Sheikh', 'EGY', NULL, NULL),
(335, 22, 'وسط البلد كفر الشيخ', 'Kafr El Sheikh Downtown', 'EGY', NULL, NULL),
(336, 22, 'دسوق', 'Desouq', 'EGY', NULL, NULL),
(337, 22, 'فوه', 'Fooh', 'EGY', NULL, NULL),
(338, 22, 'مطوبس', 'Metobas', 'EGY', NULL, NULL),
(339, 22, 'برج البرلس', 'Burg Al Burullus', 'EGY', NULL, NULL),
(340, 22, 'بلطيم', 'Baltim', 'EGY', NULL, NULL),
(341, 22, 'مصيف بلطيم', 'Masief Baltim', 'EGY', NULL, NULL),
(342, 22, 'الحامول', 'Hamol', 'EGY', NULL, NULL),
(343, 22, 'بيلا', 'Bella', 'EGY', NULL, NULL),
(344, 22, 'الرياض', 'Riyadh', 'EGY', NULL, NULL),
(345, 22, 'سيدي سالم', 'Sidi Salm', 'EGY', NULL, NULL),
(346, 22, 'قلين', 'Qellen', 'EGY', NULL, NULL),
(347, 22, 'سيدي غازي', 'Sidi Ghazi', 'EGY', NULL, NULL),
(348, 23, 'مرسى مطروح', 'Marsa Matrouh', 'EGY', NULL, NULL),
(349, 23, 'الحمام', 'El Hamam', 'EGY', NULL, NULL),
(350, 23, 'العلمين', 'Alamein', 'EGY', NULL, NULL),
(351, 23, 'الضبعة', 'Dabaa', 'EGY', NULL, NULL),
(352, 23, 'النجيلة', 'Al-Nagila', 'EGY', NULL, NULL),
(353, 23, 'سيدي براني', 'Sidi Brani', 'EGY', NULL, NULL),
(354, 23, 'السلوم', 'Salloum', 'EGY', NULL, NULL),
(355, 23, 'سيوة', 'Siwa', 'EGY', NULL, NULL),
(356, 23, 'مارينا', 'Marina', 'EGY', NULL, NULL),
(357, 23, 'الساحل الشمالى', 'North Coast', 'EGY', NULL, NULL),
(358, 24, 'الأقصر', 'Luxor', 'EGY', NULL, NULL),
(359, 24, 'الأقصر الجديدة', 'New Luxor', 'EGY', NULL, NULL),
(360, 24, 'إسنا', 'Esna', 'EGY', NULL, NULL),
(361, 24, 'طيبة الجديدة', 'New Tiba', 'EGY', NULL, NULL),
(362, 24, 'الزينية', 'Al ziynia', 'EGY', NULL, NULL),
(363, 24, 'البياضية', 'Al Bayadieh', 'EGY', NULL, NULL),
(364, 24, 'القرنة', 'Al Qarna', 'EGY', NULL, NULL),
(365, 24, 'أرمنت', 'Armant', 'EGY', NULL, NULL),
(366, 24, 'الطود', 'Al Tud', 'EGY', NULL, NULL),
(367, 25, 'قنا', 'Qena', 'EGY', NULL, NULL),
(368, 25, 'قنا الجديدة', 'New Qena', 'EGY', NULL, NULL),
(369, 25, 'ابو طشت', 'Abu Tesht', 'EGY', NULL, NULL),
(370, 25, 'نجع حمادي', 'Nag Hammadi', 'EGY', NULL, NULL),
(371, 25, 'دشنا', 'Deshna', 'EGY', NULL, NULL),
(372, 25, 'الوقف', 'Alwaqf', 'EGY', NULL, NULL),
(373, 25, 'قفط', 'Qaft', 'EGY', NULL, NULL),
(374, 25, 'نقادة', 'Naqada', 'EGY', NULL, NULL),
(375, 25, 'فرشوط', 'Farshout', 'EGY', NULL, NULL),
(376, 25, 'قوص', 'Quos', 'EGY', NULL, NULL),
(377, 26, 'العريش', 'Arish', 'EGY', NULL, NULL),
(378, 26, 'الشيخ زويد', 'Sheikh Zowaid', 'EGY', NULL, NULL),
(379, 26, 'نخل', 'Nakhl', 'EGY', NULL, NULL),
(380, 26, 'رفح', 'Rafah', 'EGY', NULL, NULL),
(381, 26, 'بئر العبد', 'Bir al-Abed', 'EGY', NULL, NULL),
(382, 26, 'الحسنة', 'Al Hasana', 'EGY', NULL, NULL),
(383, 27, 'سوهاج', 'Sohag', 'EGY', NULL, NULL),
(384, 27, 'سوهاج الجديدة', 'Sohag El Gedida', 'EGY', NULL, NULL),
(385, 27, 'أخميم', 'Akhmeem', 'EGY', NULL, NULL),
(386, 27, 'أخميم الجديدة', 'Akhmim El Gedida', 'EGY', NULL, NULL),
(387, 27, 'البلينا', 'Albalina', 'EGY', NULL, NULL),
(388, 27, 'المراغة', 'El Maragha', 'EGY', NULL, NULL),
(389, 27, 'المنشأة', 'almunshaa', 'EGY', NULL, NULL),
(390, 27, 'دار السلام', 'Dar AISalaam', 'EGY', NULL, NULL),
(391, 27, 'جرجا', 'Gerga', 'EGY', NULL, NULL),
(392, 27, 'جهينة الغربية', 'Jahina Al Gharbia', 'EGY', NULL, NULL),
(393, 27, 'ساقلته', 'Saqilatuh', 'EGY', NULL, NULL),
(394, 27, 'طما', 'Tama', 'EGY', NULL, NULL),
(395, 27, 'طهطا', 'Tahta', 'EGY', NULL, NULL),
(396, 27, 'الكوثر', 'Alkawthar', 'EGY', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comment_visits`
--

CREATE TABLE `comment_visits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `visit_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` text DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = not active ',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `social_id` bigint(20) UNSIGNED DEFAULT NULL,
  `contractdr_id` bigint(20) UNSIGNED DEFAULT NULL,
  `typecont_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name_en` text NOT NULL,
  `phone` text DEFAULT NULL,
  `phone2` text DEFAULT NULL,
  `landline` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `gender` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = male - 1 = female - 2 = other ',
  `marital_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = singel - 1 = married - 2 = divorced  - 3 = widow - 4 = married more 1',
  `email` text DEFAULT NULL,
  `website` text DEFAULT NULL,
  `facebook` text DEFAULT NULL,
  `socialmedia` text DEFAULT NULL COMMENT 'other facebook',
  `note` text DEFAULT NULL,
  `speciality_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`speciality_id`)),
  `preferd_gift_brand` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`preferd_gift_brand`)),
  `university_degree` text DEFAULT NULL,
  `scientific_degree` text DEFAULT NULL,
  `preferd_readding` text DEFAULT NULL,
  `preferd_gift` text DEFAULT NULL,
  `preferd_service` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = not active ',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `emp_id`, `social_id`, `contractdr_id`, `typecont_id`, `name_en`, `phone`, `phone2`, `landline`, `address`, `birth_date`, `gender`, `marital_status`, `email`, `website`, `facebook`, `socialmedia`, `note`, `speciality_id`, `preferd_gift_brand`, `university_degree`, `scientific_degree`, `preferd_readding`, `preferd_gift`, `preferd_service`, `description`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 3, NULL, 2, 'contact 1', '01005541337', NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, '[\"2\"]', 'null', NULL, NULL, NULL, NULL, NULL, '', 0, NULL, '2025-03-09 19:54:25', '2025-03-09 19:54:25'),
(2, 1, 2, NULL, 1, 'contact 2', '01441132550', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '[\"1\"]', 'null', NULL, NULL, NULL, NULL, NULL, '', 0, NULL, '2025-03-09 19:55:31', '2025-03-09 19:55:31'),
(3, 1, 4, NULL, 1, 'contact 3', '06618874991', NULL, NULL, NULL, '1989-03-02', 0, 2, NULL, NULL, NULL, NULL, NULL, '[\"3\"]', 'null', NULL, NULL, NULL, NULL, NULL, '', 0, NULL, '2025-03-09 19:56:56', '2025-03-09 19:56:56'),
(4, 1, 3, NULL, 2, 'contact 4', '08774136448', NULL, NULL, NULL, '1983-11-10', 1, 2, NULL, NULL, NULL, NULL, NULL, '[\"4\",\"8\"]', 'null', NULL, NULL, NULL, NULL, NULL, '', 0, NULL, '2025-03-09 19:58:23', '2025-03-09 19:58:23'),
(5, 1, 4, NULL, 3, 'contact 5', '0446685447', NULL, NULL, NULL, '1982-12-19', 1, 0, NULL, NULL, NULL, NULL, NULL, '[\"6\"]', 'null', 'University Degree', 'scientific Degree', 'sports', 'flowers - sweets', 'Alex Conference on rheumatology', '', 0, NULL, '2025-03-10 19:33:44', '2025-03-10 19:34:30'),
(6, 1, 3, NULL, 2, 'contact 6', '0994475110', NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, '[\"1\",\"7\"]', 'null', NULL, NULL, NULL, NULL, NULL, '', 0, NULL, '2025-03-10 19:40:30', '2025-03-10 19:40:30');

-- --------------------------------------------------------

--
-- Table structure for table `contact_rates`
--

CREATE TABLE `contact_rates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `contact_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rate_id` bigint(20) UNSIGNED DEFAULT NULL,
  `value` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = not active ',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contract_drs`
--

CREATE TABLE `contract_drs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `note` text DEFAULT NULL,
  `valued_to` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = not active ',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_en` text DEFAULT NULL,
  `name_ar` text DEFAULT NULL,
  `countrycodealpha3` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name_en`, `name_ar`, `countrycodealpha3`, `created_at`, `updated_at`) VALUES
(1, 'Egypt', 'مصر', 'EGY', NULL, NULL),
(2, 'United Arab Emirates', 'الإمارات العربية المتحدة', 'UAE', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cust_collections`
--

CREATE TABLE `cust_collections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `cust_id` bigint(20) UNSIGNED DEFAULT NULL,
  `value` decimal(10,3) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `balance_befor` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = notactive',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cust_payment_methods`
--

CREATE TABLE `cust_payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `name_ar` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = not active ',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cust_payment_methods`
--

INSERT INTO `cust_payment_methods` (`id`, `emp_id`, `name_en`, `name_ar`, `note`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'cash', NULL, NULL, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cut_sales`
--

CREATE TABLE `cut_sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `phone` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `note` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = not active ',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type_type` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = center - 1 = newcustomer ',
  `center_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name_ar` varchar(255) DEFAULT NULL,
  `tax_id` varchar(255) DEFAULT NULL,
  `value` decimal(10,3) DEFAULT NULL,
  `area_id` bigint(20) UNSIGNED DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `lng` varchar(255) DEFAULT NULL,
  `payment_method_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cycle_msg_prods`
--

CREATE TABLE `cycle_msg_prods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `prod_id` bigint(20) UNSIGNED NOT NULL,
  `title` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `valued_to` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = not active ',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emirates`
--

CREATE TABLE `emirates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_en` text DEFAULT NULL,
  `name_ar` text DEFAULT NULL,
  `countrycodealpha3` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `emirates`
--

INSERT INTO `emirates` (`id`, `name_en`, `name_ar`, `countrycodealpha3`, `created_at`, `updated_at`) VALUES
(1, 'Dubai', 'دبى', 'UAE', NULL, NULL),
(2, 'Abu Dhabi', 'أبوظبي', 'UAE', NULL, NULL),
(3, 'Sharjah', 'الشارقة', 'UAE', NULL, NULL),
(4, 'Al Ain', 'العين', 'UAE', NULL, NULL),
(5, 'Ajman', 'عجمان', 'UAE', NULL, NULL),
(6, 'Ras Al Khaimah', 'رأس الخيمة', 'UAE', NULL, NULL),
(7, 'Fujairah', 'الفجيرة', 'UAE', NULL, NULL),
(8, 'Umm Al Quwain', 'أم القيوين', 'UAE', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(255) DEFAULT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` enum('0','1','2','3') NOT NULL DEFAULT '1' COMMENT '0 => not active, 1 => active, 2 => suspended , 3 => terminated',
  `role_id` tinyint(4) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `national_id` varchar(255) DEFAULT NULL,
  `birth_date` date NOT NULL DEFAULT '2025-04-21',
  `work_date` date NOT NULL DEFAULT '2025-04-21',
  `address1` text NOT NULL,
  `address2` text DEFAULT NULL,
  `address3` text DEFAULT NULL,
  `job_title` text DEFAULT NULL,
  `phone2` varchar(255) DEFAULT NULL,
  `phone3` varchar(255) DEFAULT NULL,
  `gender` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = male, 1 = female',
  `method_for_payment` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = cash, 1 = bank_transefer',
  `acc_bank_no` text DEFAULT NULL,
  `note` text DEFAULT NULL,
  `token` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `social_insurance_no` varchar(255) DEFAULT NULL,
  `medical_insurance_no` varchar(255) DEFAULT NULL,
  `salary` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name_ar`, `name_en`, `phone`, `email`, `password`, `is_active`, `role_id`, `type`, `national_id`, `birth_date`, `work_date`, `address1`, `address2`, `address3`, `job_title`, `phone2`, `phone3`, `gender`, `method_for_payment`, `acc_bank_no`, `note`, `token`, `deleted_at`, `created_at`, `updated_at`, `social_insurance_no`, `medical_insurance_no`, `salary`, `bank_name`, `department`) VALUES
(1, 'رئيسي', 'Super Admin', '***********', 'admin1@az.com', '$2y$10$e6eeQePuQqyRHMR9LTSvZu9iBUugQO1wSzxWVcG3zZIvILrcN2WLC', '1', 1, 0, '************', '2002-11-18', '2002-11-18', 'address', NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, '2025-04-21 09:07:33', '2025-04-21 09:07:33', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee_roles`
--

CREATE TABLE `employee_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emp_bill_sales`
--

CREATE TABLE `emp_bill_sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `sale_id` bigint(20) UNSIGNED NOT NULL,
  `empsaled_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sale_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `percent` decimal(10,3) DEFAULT NULL,
  `value` decimal(10,3) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = notactive',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emp_sales`
--

CREATE TABLE `emp_sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `prod_id` bigint(20) UNSIGNED NOT NULL,
  `empsaled_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sale_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `percent` decimal(10,3) DEFAULT NULL,
  `quantity` decimal(10,3) DEFAULT NULL,
  `total_quantity` decimal(10,3) DEFAULT NULL,
  `unit_sellprice` decimal(10,3) DEFAULT NULL,
  `value_at` date DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = notactive',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `type_id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `from_time` datetime NOT NULL,
  `to_time` datetime NOT NULL,
  `note` text DEFAULT NULL,
  `prod_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`prod_id`)),
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = not active ',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_atts`
--

CREATE TABLE `event_atts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `empatt_id` bigint(20) UNSIGNED DEFAULT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `checkin_location` text DEFAULT NULL,
  `from_time` datetime DEFAULT NULL,
  `checkout_location` text DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = not active ',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_contents`
--

CREATE TABLE `event_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `from_time` datetime DEFAULT NULL,
  `to_time` datetime DEFAULT NULL,
  `type_event_content` tinyint(4) NOT NULL DEFAULT 4 COMMENT '0 = schedule - 1 = logistics - 2 = point discussion - 3 = recommended activities - 4 = other',
  `name_en` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = notactive',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_types`
--

CREATE TABLE `event_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = not active ',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expense_requests`
--

CREATE TABLE `expense_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `emp_id_dirctor` bigint(20) UNSIGNED DEFAULT NULL,
  `type_id` bigint(20) UNSIGNED NOT NULL,
  `value` decimal(10,3) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `notepayment` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = not active ',
  `statusresponse` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = waitting - 1 = approved - 2 = rejected - 3 = delayed ',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `funnel_tracks`
--

CREATE TABLE `funnel_tracks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `list_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status_funnel_befor` bigint(20) DEFAULT NULL,
  `status_funnel_after` bigint(20) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = not active ',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `governorates`
--

CREATE TABLE `governorates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `governorate_name_ar` text DEFAULT NULL,
  `governorate_name_en` text DEFAULT NULL,
  `countrycodealpha3` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `governorates`
--

INSERT INTO `governorates` (`id`, `governorate_name_ar`, `governorate_name_en`, `countrycodealpha3`, `created_at`, `updated_at`) VALUES
(1, 'القاهرة', 'Cairo', 'EGY', NULL, NULL),
(2, 'الجيزة', 'Giza', 'EGY', NULL, NULL),
(3, 'الأسكندرية', 'Alexandria', 'EGY', NULL, NULL),
(4, 'الدقهلية', 'Dakahlia', 'EGY', NULL, NULL),
(5, 'البحر الأحمر', 'Red Sea', 'EGY', NULL, NULL),
(6, 'البحيرة', 'Beheira', 'EGY', NULL, NULL),
(7, 'الفيوم', 'Fayoum', 'EGY', NULL, NULL),
(8, 'الغربية', 'Gharbiya', 'EGY', NULL, NULL),
(9, 'الإسماعلية', 'Ismailia', 'EGY', NULL, NULL),
(10, 'المنوفية', 'Menofia', 'EGY', NULL, NULL),
(11, 'المنيا', 'Minya', 'EGY', NULL, NULL),
(12, 'القليوبية', 'Qaliubiya', 'EGY', NULL, NULL),
(13, 'الوادي الجديد', 'New Valley', 'EGY', NULL, NULL),
(14, 'السويس', 'Suez', 'EGY', NULL, NULL),
(15, 'اسوان', 'Aswan', 'EGY', NULL, NULL),
(16, 'اسيوط', 'Assiut', 'EGY', NULL, NULL),
(17, 'بني سويف', 'Beni Suef', 'EGY', NULL, NULL),
(18, 'بورسعيد', 'Port Said', 'EGY', NULL, NULL),
(19, 'دمياط', 'Damietta', 'EGY', NULL, NULL),
(20, 'الشرقية', 'Sharkia', 'EGY', NULL, NULL),
(21, 'جنوب سيناء', 'South Sinai', 'EGY', NULL, NULL),
(22, 'كفر الشيخ', 'Kafr Al sheikh', 'EGY', NULL, NULL),
(23, 'مطروح', 'Matrouh', 'EGY', NULL, NULL),
(24, 'الأقصر', 'Luxor', 'EGY', NULL, NULL),
(25, 'قنا', 'Qena', 'EGY', NULL, NULL),
(26, 'شمال سيناء', 'North Sinai', 'EGY', NULL, NULL),
(27, 'سوهاج', 'Sohag', 'EGY', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hierarchy_emps`
--

CREATE TABLE `hierarchy_emps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `emphier_id` bigint(20) UNSIGNED NOT NULL,
  `type_hierarchy` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = main - 1 = middle - 2 = end hierarchy',
  `parent_id` varchar(255) DEFAULT NULL,
  `above_hierarchy` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`above_hierarchy`)),
  `status_area` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = area active - 1 = area notactive',
  `area` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`area`)),
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = notactive',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_prod` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = prod active - 1 = prod notactive',
  `prod` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`prod`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `list_contacs`
--

CREATE TABLE `list_contacs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `emplist_id` bigint(20) UNSIGNED DEFAULT NULL,
  `contact_id` bigint(20) UNSIGNED DEFAULT NULL,
  `center_id` bigint(20) UNSIGNED DEFAULT NULL,
  `parentlist_id` text DEFAULT NULL,
  `taregetvisit` int(10) UNSIGNED DEFAULT NULL,
  `sales_funel_id` bigint(20) UNSIGNED DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = not active ',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) DEFAULT NULL,
  `collection_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `mime_type` varchar(255) DEFAULT NULL,
  `disk` varchar(255) NOT NULL,
  `conversions_disk` varchar(255) DEFAULT NULL,
  `size` bigint(20) UNSIGNED NOT NULL,
  `manipulations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`manipulations`)),
  `custom_properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`custom_properties`)),
  `generated_conversions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`generated_conversions`)),
  `responsive_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`responsive_images`)),
  `order_column` int(10) UNSIGNED DEFAULT NULL,
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
  `status` enum('read','unread') NOT NULL DEFAULT 'unread',
  `sender_type` enum('student','teacher') NOT NULL,
  `sender_id` int(10) UNSIGNED NOT NULL,
  `receiver_type` enum('student','teacher') NOT NULL,
  `receiver_id` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
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

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2019_12_14_000002_create_media_table', 1),
(6, '2023_04_19_225815_create_settings_table', 1),
(7, '2023_05_05_191418_create_employees_table', 1),
(8, '2023_05_05_191419_create_employee_roles_table', 1),
(9, '2023_08_11_002102_create_pages_table', 1),
(10, '2023_08_14_004105_create_users_table', 1),
(11, '2023_10_15_000410_create_blogs_table', 1),
(12, '2023_10_27_162524_create_cities_table', 1),
(13, '2023_10_27_162524_create_countries_table', 1),
(14, '2023_10_27_162524_create_emirates_table', 1),
(15, '2023_10_27_162524_create_governorates_table', 1),
(16, '2023_12_23_123913_create_messages_table', 1),
(17, '2024_01_19_124222_create_notifications_table', 1),
(18, '2024_04_27_140410_create_permission_tables', 1),
(19, '2024_05_31_214805_create_account_trees_table', 1),
(20, '2024_09_01_163757_create_way_sells_table', 1),
(21, '2024_09_01_163759_create_areas_table', 1),
(22, '2024_09_01_163760_create_specialties_table', 1),
(23, '2024_09_01_164524_create_cashiers_table', 1),
(24, '2024_09_01_173956_create_sales_funels_table', 1),
(25, '2024_09_03_133505_create_vacationemps_table', 1),
(26, '2024_09_11_163303_create_type_expenses_table', 1),
(27, '2024_09_11_163917_create_expense_requests_table', 1),
(28, '2024_09_11_163918_create_brand_gifts_table', 1),
(29, '2024_09_11_163919_create_social_styls_table', 1),
(30, '2024_09_11_163920_create_contract_drs_table', 1),
(31, '2024_09_13_225258_create_type_centers_table', 1),
(32, '2024_09_13_225259_create_center_departments_table', 1),
(33, '2024_09_13_225315_create_centers_table', 1),
(34, '2024_09_14_114115_create_working_hours_table', 1),
(35, '2024_09_14_165748_create_assistants_table', 1),
(36, '2024_09_14_183425_create_products_table', 1),
(37, '2024_09_14_221657_create_cycle_msg_prods_table', 1),
(38, '2024_09_15_104650_create_type_contacts_table', 1),
(39, '2024_09_16_130616_create_contacts_table', 1),
(40, '2024_09_16_170321_create_relative_contacts_table', 1),
(41, '2024_09_17_113332_create_ratings_table', 1),
(42, '2024_09_17_121423_create_contact_rates_table', 1),
(43, '2024_09_18_131946_create_place_ws_table', 1),
(44, '2024_09_19_165745_create_sale_types_table', 1),
(45, '2024_09_21_121230_create_sale_emp_aschiveds_table', 1),
(46, '2024_09_21_121232_create_emp_sales_table', 1),
(47, '2024_09_21_121234_create_hierarchy_emps_table', 1),
(48, '2024_09_25_143713_create_event_types_table', 1),
(49, '2024_09_25_143813_create_events_table', 1),
(50, '2024_09_25_144629_create_event_contents_table', 1),
(51, '2024_10_01_133525_create_type_visits_table', 1),
(52, '2024_10_02_142254_create_type_tools_table', 1),
(53, '2024_10_03_131717_create_plan_visits_table', 1),
(54, '2024_10_03_165152_create_tools_table', 1),
(55, '2024_10_06_020650_create_technical_supports_table', 1),
(56, '2024_10_19_184224_create_visits_table', 1),
(57, '2024_10_24_231827_create_comment_visits_table', 1),
(58, '2024_10_27_162524_create_list_contacs_table', 1),
(59, '2024_10_28_134504_create_funnel_tracks_table', 1),
(60, '2024_11_08_135321_create_cust_payment_methods_table', 1),
(61, '2024_11_09_160858_create_cut_sales_table', 1),
(62, '2024_11_09_161599_create_temp_sale_recs_table', 1),
(63, '2024_11_09_161600_create_bill_sale_headers_table', 1),
(64, '2024_11_09_161616_create_bill_sale_details_table', 1),
(65, '2024_11_09_169901_create_trans_custs_table', 1),
(66, '2024_11_09_234529_create_emp_bill_sales_table', 1),
(67, '2024_11_16_201614_add_lat_lng_column_to_centers_table', 1),
(68, '2024_11_16_201614_add_lat_lng_column_to_employees_table', 1),
(69, '2025_02_16_201617_add_percent_column_to_products_table', 1),
(70, '2025_02_17_201614_add_approv_sellprice_column_to_bill_sale_headers_table', 1),
(71, '2025_02_17_201615_add_approv_sellprice_column_to_bill_sale_details_table', 1),
(72, '2025_02_17_201616_add_status_prod_column_to_hierarchy_emps', 1),
(73, '2025_02_17_201616_add_status_type_column_to_trans_custs_table', 1),
(74, '2025_02_17_201617_add_type_type_column_to_cut_sales_table', 1),
(75, '2025_03_04_211532_create_event_atts_table', 1),
(76, '2025_04_05_142839_create_cust_collections_table', 1),
(77, '2025_04_05_153708_create_refund_causes_table', 1),
(78, '2025_04_05_165207_create_refund_sales_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\Employee', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `body` varchar(255) DEFAULT NULL,
  `type` enum('daily','blog','walls','chat','exam','other') NOT NULL DEFAULT 'other',
  `type_id` int(11) NOT NULL DEFAULT 0,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'visit plan', 'admin', NULL, NULL),
(2, 'visit plan new', 'admin', NULL, NULL),
(3, 'visit', 'admin', NULL, NULL),
(4, 'visit new', 'admin', NULL, NULL),
(5, 'report list', 'admin', NULL, NULL),
(6, 'report product', 'admin', NULL, NULL),
(7, 'all list', 'admin', NULL, NULL),
(8, 'list details', 'admin', NULL, NULL),
(9, 'list new', 'admin', NULL, NULL),
(10, 'list edit', 'admin', NULL, NULL),
(11, 'all employee', 'admin', NULL, NULL),
(12, 'employee details', 'admin', NULL, NULL),
(13, 'employee new', 'admin', NULL, NULL),
(14, 'employee edit', 'admin', NULL, NULL),
(15, 'employee delete', 'admin', NULL, NULL),
(16, 'all tool', 'admin', NULL, NULL),
(17, 'tool new', 'admin', NULL, NULL),
(18, 'all contact', 'admin', NULL, NULL),
(19, 'contact details', 'admin', NULL, NULL),
(20, 'contact new', 'admin', NULL, NULL),
(21, 'contact edit', 'admin', NULL, NULL),
(22, 'all contact place', 'admin', NULL, NULL),
(23, 'contact place details', 'admin', NULL, NULL),
(24, 'contact place new', 'admin', NULL, NULL),
(25, 'contact place edit', 'admin', NULL, NULL),
(26, 'all contact type', 'admin', NULL, NULL),
(27, 'contact type details', 'admin', NULL, NULL),
(28, 'contact type new', 'admin', NULL, NULL),
(29, 'contact type edit', 'admin', NULL, NULL),
(30, 'contact relative', 'admin', NULL, NULL),
(31, 'contact rate', 'admin', NULL, NULL),
(32, 'all center', 'admin', NULL, NULL),
(33, 'center details', 'admin', NULL, NULL),
(34, 'center new', 'admin', NULL, NULL),
(35, 'center edit', 'admin', NULL, NULL),
(36, 'all assistant', 'admin', NULL, NULL),
(37, 'assistant details', 'admin', NULL, NULL),
(38, 'assistant new', 'admin', NULL, NULL),
(39, 'assistant edit', 'admin', NULL, NULL),
(40, 'assistant delete', 'admin', NULL, NULL),
(41, 'all vacation', 'admin', NULL, NULL),
(42, 'vacation request', 'admin', NULL, NULL),
(43, 'vacation new', 'admin', NULL, NULL),
(44, 'vacation edit', 'admin', NULL, NULL),
(45, 'all expense', 'admin', NULL, NULL),
(46, 'expense details', 'admin', NULL, NULL),
(47, 'expense new', 'admin', NULL, NULL),
(48, 'expense edit', 'admin', NULL, NULL),
(49, 'expense delete', 'admin', NULL, NULL),
(50, 'all product', 'admin', NULL, NULL),
(51, 'product details', 'admin', NULL, NULL),
(52, 'product new', 'admin', NULL, NULL),
(53, 'product edit', 'admin', NULL, NULL),
(54, 'product delete', 'admin', NULL, NULL),
(55, 'all product msg', 'admin', NULL, NULL),
(56, 'product msg details', 'admin', NULL, NULL),
(57, 'product msg new', 'admin', NULL, NULL),
(58, 'product msg edit', 'admin', NULL, NULL),
(59, 'product msg delete', 'admin', NULL, NULL),
(60, 'all area', 'admin', NULL, NULL),
(61, 'area details', 'admin', NULL, NULL),
(62, 'area new', 'admin', NULL, NULL),
(63, 'area edit', 'admin', NULL, NULL),
(64, 'area delete', 'admin', NULL, NULL),
(65, 'all specialty', 'admin', NULL, NULL),
(66, 'specialty details', 'admin', NULL, NULL),
(67, 'specialty new', 'admin', NULL, NULL),
(68, 'specialty edit', 'admin', NULL, NULL),
(69, 'specialty delete', 'admin', NULL, NULL),
(70, 'all brand gift', 'admin', NULL, NULL),
(71, 'brand gift details', 'admin', NULL, NULL),
(72, 'brand gift new', 'admin', NULL, NULL),
(73, 'brand gift edit', 'admin', NULL, NULL),
(74, 'brand gift delete', 'admin', NULL, NULL),
(75, 'all social style', 'admin', NULL, NULL),
(76, 'social style details', 'admin', NULL, NULL),
(77, 'social style new', 'admin', NULL, NULL),
(78, 'social style edit', 'admin', NULL, NULL),
(79, 'social style delete', 'admin', NULL, NULL),
(80, 'all sale funnel', 'admin', NULL, NULL),
(81, 'sale funnel details', 'admin', NULL, NULL),
(82, 'sale funnel new', 'admin', NULL, NULL),
(83, 'sale funnel edit', 'admin', NULL, NULL),
(84, 'all rating', 'admin', NULL, NULL),
(85, 'rating details', 'admin', NULL, NULL),
(86, 'rating new', 'admin', NULL, NULL),
(87, 'rating edit', 'admin', NULL, NULL),
(88, 'rating delete', 'admin', NULL, NULL),
(89, 'all event', 'admin', NULL, NULL),
(90, 'event details', 'admin', NULL, NULL),
(91, 'event new', 'admin', NULL, NULL),
(92, 'event edit', 'admin', NULL, NULL),
(93, 'event delete', 'admin', NULL, NULL),
(94, 'sale', 'admin', NULL, NULL),
(95, 'sale details', 'admin', NULL, NULL),
(96, 'sale new', 'admin', NULL, NULL),
(97, 'sale edit', 'admin', NULL, NULL),
(98, 'sale delete', 'admin', NULL, NULL),
(99, 'sale_requests', 'admin', NULL, NULL),
(100, 'sale_delivered', 'admin', NULL, NULL),
(101, 'sale report', 'admin', NULL, NULL),
(102, 'sale report governorates', 'admin', NULL, NULL),
(103, 'sale report cities', 'admin', NULL, NULL),
(104, 'sale report areas', 'admin', NULL, NULL),
(105, 'sale area unit', 'admin', NULL, NULL),
(106, 'sale governorates unit', 'admin', NULL, NULL),
(107, 'sale bills', 'admin', NULL, NULL),
(108, 'sale bills employee', 'admin', NULL, NULL),
(109, 'all sale bills employee', 'admin', NULL, NULL),
(110, 'all customers', 'admin', NULL, NULL),
(111, 'customer details', 'admin', NULL, NULL),
(112, 'customer new', 'admin', NULL, NULL),
(113, 'customer edit', 'admin', NULL, NULL),
(114, 'customer delete', 'admin', NULL, NULL),
(115, 'all trans customers', 'admin', NULL, NULL),
(116, 'trans customers details', 'admin', NULL, NULL),
(117, 'trans customers new', 'admin', NULL, NULL),
(118, 'trans customers edit', 'admin', NULL, NULL),
(119, 'trans customers delete', 'admin', NULL, NULL),
(120, 'cust collection', 'admin', NULL, NULL),
(121, 'cust collection details', 'admin', NULL, NULL),
(122, 'cust collection new', 'admin', NULL, NULL),
(123, 'cust collection edit', 'admin', NULL, NULL),
(124, 'cust collection delete', 'admin', NULL, NULL),
(125, 'all customers return', 'admin', NULL, NULL),
(126, 'customers return details', 'admin', NULL, NULL),
(127, 'customers return new', 'admin', NULL, NULL),
(128, 'customers return edit', 'admin', NULL, NULL),
(129, 'customers return delete', 'admin', NULL, NULL),
(130, 'all role', 'admin', NULL, NULL),
(131, 'role new', 'admin', NULL, NULL),
(132, 'role edit', 'admin', NULL, NULL),
(133, 'role delete', 'admin', NULL, NULL),
(134, 'setting', 'admin', NULL, NULL);

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
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `place_ws`
--

CREATE TABLE `place_ws` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `contact_id` bigint(20) UNSIGNED DEFAULT NULL,
  `center_id` bigint(20) UNSIGNED DEFAULT NULL,
  `note` text DEFAULT NULL,
  `from_time` time DEFAULT NULL,
  `to_time` time DEFAULT NULL,
  `dynamic_work` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = hours - 1 = unregular - 2 = 24 hours',
  `on_workrule` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = weekly - 1 = unregular - 2 = 7 days work',
  `work_days` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '0 = Saturday - 1 = Sunday - 2 = Monday - 3 = Tuesday - 4 = Wednesday - 5 = Thursday - 6 =  Friday' CHECK (json_valid(`work_days`)),
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = not active ',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plan_visits`
--

CREATE TABLE `plan_visits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `emphplan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `center_id` bigint(20) UNSIGNED DEFAULT NULL,
  `contact_id` bigint(20) UNSIGNED DEFAULT NULL,
  `typevist_id` bigint(20) UNSIGNED DEFAULT NULL,
  `from_time` datetime DEFAULT NULL,
  `status_visit` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = single visit - 1 = double visit - 2 = triple visit',
  `visit_emp_ass` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`visit_emp_ass`)),
  `note` text DEFAULT NULL,
  `status_planvisit_list` tinyint(4) DEFAULT NULL COMMENT '0 = listed contact - 1 = listed center - 2 = both - 3 = out list ',
  `status_return` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = done - 1 = canceld - 3 = delayed - 4 = planned',
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = notactive',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `sell_price` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = not active ',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `percent` decimal(10,3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `emp_id`, `name_en`, `sell_price`, `description`, `note`, `status`, `deleted_at`, `created_at`, `updated_at`, `percent`) VALUES
(1, 1, 'prod 1', '1000', '', NULL, 0, NULL, '2025-03-09 16:35:34', '2025-03-09 16:35:34', 0.000),
(2, 1, 'prod 2', '2000', '', NULL, 0, NULL, '2025-03-09 16:35:50', '2025-03-09 16:35:50', 0.000),
(3, 1, 'prod 3', '3000', '', NULL, 0, NULL, '2025-03-09 16:36:06', '2025-03-09 16:36:06', 0.000),
(4, 1, 'prod 4', '4000', '', NULL, 0, NULL, '2025-03-09 16:36:19', '2025-03-09 16:36:19', 0.000);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `name_en` text DEFAULT NULL,
  `lowestdegree` text DEFAULT NULL,
  `largestdegree` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = not active ',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `refund_causes`
--

CREATE TABLE `refund_causes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `name_en` text DEFAULT NULL,
  `name_ar` text DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = notactive',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `refund_sales`
--

CREATE TABLE `refund_sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `cust_id` bigint(20) UNSIGNED DEFAULT NULL,
  `prod_id` bigint(20) UNSIGNED DEFAULT NULL,
  `bill_sale_header_id` bigint(20) UNSIGNED DEFAULT NULL,
  `approv_quantity_ref` decimal(10,3) DEFAULT NULL COMMENT 'note for user',
  `approv_sellpriceproduct_ref` decimal(10,3) DEFAULT NULL COMMENT 'note for user',
  `approv_percent_ref` decimal(10,3) DEFAULT NULL COMMENT 'note for user',
  `status_requ_ref` tinyint(4) DEFAULT NULL COMMENT '0 = request - 1 = approved - 2 = somecancell - 3 = all cancel - 4 = done ',
  `refund_causes_id` bigint(20) UNSIGNED DEFAULT NULL,
  `parent_id` text DEFAULT NULL,
  `value` decimal(10,3) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = notactive',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `relative_contacts`
--

CREATE TABLE `relative_contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `contact_id` bigint(20) UNSIGNED DEFAULT NULL,
  `relative_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = not_knowen - 1 = wife - 2 = husband - 3 = daughter  - 4 = son - 5 = father - 6 = mather - 7 = grandson - 8 = grandfather',
  `name_en` text DEFAULT NULL,
  `phone` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `gender` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = male - 1 = female - 2 = other ',
  `marital_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = singel - 1 = married - 2 = divorced  - 3 = widow - 4 = married more 1',
  `email` text DEFAULT NULL,
  `website` text DEFAULT NULL,
  `facebook` text DEFAULT NULL,
  `socialmedia` text DEFAULT NULL,
  `note` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = not active ',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super admin', 'admin', '2025-04-21 09:07:33', '2025-04-21 09:07:33');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
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
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1),
(91, 1),
(92, 1),
(93, 1),
(94, 1),
(95, 1),
(96, 1),
(97, 1),
(98, 1),
(99, 1),
(100, 1),
(101, 1),
(102, 1),
(103, 1),
(104, 1),
(105, 1),
(106, 1),
(107, 1),
(108, 1),
(109, 1),
(110, 1),
(111, 1),
(112, 1),
(113, 1),
(114, 1),
(115, 1),
(116, 1),
(117, 1),
(118, 1),
(119, 1),
(120, 1),
(121, 1),
(122, 1),
(123, 1),
(124, 1),
(125, 1),
(126, 1),
(127, 1),
(128, 1),
(129, 1),
(130, 1),
(131, 1),
(132, 1),
(133, 1),
(134, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sales_funels`
--

CREATE TABLE `sales_funels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = not active ',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sale_emp_aschiveds`
--

CREATE TABLE `sale_emp_aschiveds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `prod_id` bigint(20) UNSIGNED NOT NULL,
  `empsaled_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sale_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `percent` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = notactive',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sale_types`
--

CREATE TABLE `sale_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'classify sale type',
  `note` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = notactive',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_types`
--

INSERT INTO `sale_types` (`id`, `emp_id`, `name_en`, `type`, `note`, `description`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Direct', 0, NULL, NULL, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(255) DEFAULT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email2` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `phone2` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `lng` varchar(255) DEFAULT NULL,
  `pdf` text DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `snapchat` varchar(255) DEFAULT NULL,
  `tiktok` varchar(255) DEFAULT NULL,
  `keywords_ar` varchar(255) DEFAULT NULL,
  `keywords_en` varchar(255) DEFAULT NULL,
  `description_ar` varchar(255) DEFAULT NULL,
  `description_en` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name_ar`, `name_en`, `email`, `email2`, `phone`, `phone2`, `whatsapp`, `address`, `address2`, `location`, `lat`, `lng`, `pdf`, `facebook`, `twitter`, `youtube`, `linkedin`, `instagram`, `snapchat`, `tiktok`, `keywords_ar`, `keywords_en`, `description_ar`, `description_en`, `created_at`, `updated_at`) VALUES
(1, 'نظام تجريبي', 'demo system', 'info@company.com', NULL, '01006287379', NULL, '201006287379', 'عنوان تجريبي عنوان تجريبي', NULL, NULL, NULL, NULL, NULL, 'facebook link', NULL, NULL, NULL, NULL, NULL, NULL, 'كلمات دلاليه', NULL, 'وصف النظام', NULL, '2025-04-21 09:07:32', '2025-04-21 09:07:32');

-- --------------------------------------------------------

--
-- Table structure for table `social_styls`
--

CREATE TABLE `social_styls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = not active ',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_styls`
--

INSERT INTO `social_styls` (`id`, `emp_id`, `name_en`, `description`, `note`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Expressive', '<ul style=\"box-sizing: border-box; padding-left: 2rem; margin-top: 0px; margin-bottom: 1rem; scrollbar-width: thin; scrollbar-color: var(--bs-scrollbar-color) transparent; color: #181c32; font-family: Inter, Helvetica, \'sans-serif\'; font-size: 13.975px; font-weight: 600; text-transform: capitalize; background-color: #ffffff;\">\n                <li style=\"box-sizing: border-box;\">Key traits: Enthusiastic, persuasive, creative, spontaneous.</li>\n                <li style=\"box-sizing: border-box;\">Focus: Vision and excitement.</li>\n                </ul>', '(Yellow)', 0, NULL, '2025-03-09 16:45:54', '2025-03-09 16:45:54'),
(2, 1, 'Amiable', '<ul style=\"box-sizing: border-box; padding-left: 2rem; margin-top: 0px; margin-bottom: 1rem; scrollbar-width: thin; scrollbar-color: var(--bs-scrollbar-color) transparent; color: #7e8299; font-family: Inter, Helvetica, \'sans-serif\'; font-size: 13.975px; font-weight: 600; text-transform: capitalize; background-color: #ffffff;\">\n                <li style=\"box-sizing: border-box;\">Key traits: Supportive, empathetic, cooperative, loyal.</li>\n                <li style=\"box-sizing: border-box;\">Focus: Relationships and harmony.</li>\n                </ul>', '(Green)', 0, NULL, '2025-03-09 16:46:29', '2025-03-09 16:46:29'),
(3, 1, 'Driver', '<ul style=\"box-sizing: border-box; padding-left: 2rem; margin-top: 0px; margin-bottom: 1rem; scrollbar-width: thin; scrollbar-color: var(--bs-scrollbar-hover-color) transparent; color: #181c32; font-family: Inter, Helvetica, \'sans-serif\'; font-size: 13.975px; font-weight: 600; text-transform: capitalize; background-color: #ffffff;\">\n                <li style=\"box-sizing: border-box;\">Key traits: Results-driven, decisive, independent, assertive.</li>\n                <li style=\"box-sizing: border-box;\">Focus: Efficiency and outcomes.</li>\n                </ul>', '(Red)', 0, NULL, '2025-03-09 19:45:24', '2025-03-09 19:45:24'),
(4, 1, 'Analytical', '<ul style=\"box-sizing: border-box; padding-left: 2rem; margin-top: 0px; margin-bottom: 1rem; scrollbar-width: thin; scrollbar-color: var(--bs-scrollbar-color) transparent; color: #7e8299; font-family: Inter, Helvetica, \'sans-serif\'; font-size: 13.975px; font-weight: 600; text-transform: capitalize; background-color: #ffffff;\">\n                <li style=\"box-sizing: border-box;\">Key traits: Logical, detail-oriented, cautious, structured.</li>\n                <li style=\"box-sizing: border-box;\">Focus: Facts and accuracy.</li>\n                </ul>', '(Blue)', 0, NULL, '2025-03-09 19:45:52', '2025-03-09 19:45:52');

-- --------------------------------------------------------

--
-- Table structure for table `specialties`
--

CREATE TABLE `specialties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `parent_id` varchar(255) DEFAULT NULL,
  `type_specialty` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = main - 1 = sub specialty',
  `note` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = not active ',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `specialties`
--

INSERT INTO `specialties` (`id`, `emp_id`, `name_en`, `parent_id`, `type_specialty`, `note`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Dermatology', NULL, 0, NULL, 0, NULL, '2025-03-09 16:30:08', '2025-03-09 16:30:08'),
(2, 1, 'Neurology', NULL, 0, NULL, 0, NULL, '2025-03-09 16:30:56', '2025-03-09 16:30:56'),
(3, 1, 'Obstetrics and Gynecology', NULL, 0, NULL, 0, NULL, '2025-03-09 16:31:11', '2025-03-09 16:31:11'),
(4, 1, 'Pediatrics', NULL, 0, NULL, 0, NULL, '2025-03-09 16:31:34', '2025-03-09 16:31:34'),
(5, 1, 'Psychiatry', NULL, 0, NULL, 0, NULL, '2025-03-09 16:32:05', '2025-03-09 16:32:05'),
(6, 1, 'Rheumatology', NULL, 0, NULL, 0, NULL, '2025-03-09 16:32:26', '2025-03-09 16:32:26'),
(7, 1, 'dermatologic oncology', '1', 1, NULL, 0, NULL, '2025-03-09 16:33:22', '2025-03-09 16:33:22'),
(8, 1, 'pediatric cardiology', '4', 1, NULL, 0, NULL, '2025-03-09 16:34:17', '2025-03-09 16:34:17'),
(9, 1, 'General Surgery', NULL, 0, NULL, 0, NULL, '2025-03-09 16:34:47', '2025-03-09 16:34:47');

-- --------------------------------------------------------

--
-- Table structure for table `technical_supports`
--

CREATE TABLE `technical_supports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `discreption` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = resolve - 2 = canceled ',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `temp_sale_recs`
--

CREATE TABLE `temp_sale_recs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `cut_sale_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sale_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `valued_time` datetime DEFAULT NULL,
  `percent` decimal(10,3) DEFAULT NULL,
  `quantityproduc` decimal(10,3) DEFAULT NULL COMMENT 'note for user',
  `sellpriceproduct` decimal(10,3) DEFAULT NULL COMMENT 'note for user',
  `sellpriceph` decimal(10,3) DEFAULT NULL COMMENT 'note for user',
  `totalsellprice` decimal(10,3) DEFAULT NULL COMMENT 'note for user',
  `note` text DEFAULT NULL,
  `method_for_payment` text DEFAULT NULL,
  `note1` text DEFAULT NULL,
  `note2` text DEFAULT NULL,
  `note3` text DEFAULT NULL,
  `status_order` text DEFAULT NULL,
  `status_order_req` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = request - 1 = approved - 2 = cancel ',
  `parent_order` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = not active ',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tools`
--

CREATE TABLE `tools` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `empreceved_id` bigint(20) UNSIGNED NOT NULL,
  `type_tool_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = not active ',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trans_custs`
--

CREATE TABLE `trans_custs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `cust_id` bigint(20) UNSIGNED DEFAULT NULL,
  `model_name` varchar(255) DEFAULT NULL COMMENT 'name for model which chang amount',
  `id_model` varchar(255) DEFAULT NULL COMMENT 'id for model which chang amount',
  `total_value` decimal(10,3) DEFAULT NULL,
  `status_trans` tinyint(4) DEFAULT NULL COMMENT '0 = increased creadite - 1 = decreased creadite',
  `note` text DEFAULT NULL,
  `value_befor` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = notactive',
  `detal_cash` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`detal_cash`)),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_type` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `type_centers`
--

CREATE TABLE `type_centers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = not active ',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type_centers`
--

INSERT INTO `type_centers` (`id`, `emp_id`, `name_en`, `note`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Hospital', NULL, 0, NULL, NULL, NULL),
(2, 1, 'Poly-clinic', NULL, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `type_contacts`
--

CREATE TABLE `type_contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `favcolor` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = not active ',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type_contacts`
--

INSERT INTO `type_contacts` (`id`, `emp_id`, `name_en`, `favcolor`, `note`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'friendly', '#2c70dd', NULL, 0, NULL, '2025-03-09 16:37:30', '2025-03-09 16:37:30'),
(2, 1, 'aggressive', '#e12d2d', NULL, 0, NULL, '2025-03-09 16:39:32', '2025-03-09 16:39:32'),
(3, 1, 'Ethical', '#069809', NULL, 0, NULL, '2025-03-10 19:31:34', '2025-03-10 19:31:34');

-- --------------------------------------------------------

--
-- Table structure for table `type_expenses`
--

CREATE TABLE `type_expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = not active ',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `type_tools`
--

CREATE TABLE `type_tools` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = not active ',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `type_visits`
--

CREATE TABLE `type_visits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = not active ',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type_visits`
--

INSERT INTO `type_visits` (`id`, `emp_id`, `name_en`, `note`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'A.M.', NULL, 0, NULL, NULL, NULL),
(2, 1, 'P.M.', NULL, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `token` text DEFAULT NULL,
  `is_active` enum('0','1','2') NOT NULL DEFAULT '1' COMMENT '0 => not active, 1 => active, 2 => suspended',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vacationemps`
--

CREATE TABLE `vacationemps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `emp_vacation` bigint(20) UNSIGNED NOT NULL,
  `vactionfrom` timestamp NULL DEFAULT NULL,
  `vactionto` timestamp NULL DEFAULT NULL,
  `vactionfrommanger` timestamp NULL DEFAULT NULL,
  `vactiontomanger` timestamp NULL DEFAULT NULL,
  `vacationrequesttype` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 =  general leave - 1 = sick leave ',
  `vacationrequest` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = without salary - 1 = 50%salary - 2 = fullsalary ',
  `typevacation` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = without salary - 1 = 50%salary - 2 = fullsalary ',
  `statusmangeraprove` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = waitting - 1 = approved - 2 = rejected - 3 = delayed ',
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = not active ',
  `noterequest` text DEFAULT NULL,
  `notemanger` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

CREATE TABLE `visits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `empvisit_id` bigint(20) UNSIGNED DEFAULT NULL,
  `typevist_id` bigint(20) UNSIGNED DEFAULT NULL,
  `center_id` bigint(20) UNSIGNED DEFAULT NULL,
  `contact_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status_visit` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = single visit - 1 = double visit - 2 = triple visit',
  `firstprodstep_id` bigint(20) UNSIGNED DEFAULT NULL,
  `first_type` tinyint(4) DEFAULT NULL COMMENT '0 = details - 1 = reminder ',
  `secondprodstep_id` bigint(20) UNSIGNED DEFAULT NULL,
  `second_type` tinyint(4) DEFAULT NULL COMMENT '0 = details - 1 = reminder ',
  `thirdprodstep_id` bigint(20) UNSIGNED DEFAULT NULL,
  `third_type` tinyint(4) DEFAULT NULL COMMENT '0 = details - 1 = reminder ',
  `visit_emp_ass` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`visit_emp_ass`)),
  `note` text DEFAULT NULL,
  `status_return` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = planned - 1 = randum ',
  `status_visit_list` tinyint(4) DEFAULT NULL COMMENT '0 = listed contact - 1 = listed center - 2 = both - 3 = out list - 4 = cancelled',
  `description` text DEFAULT NULL,
  `checkin_location` text DEFAULT NULL,
  `from_time` datetime DEFAULT NULL,
  `checkout_location` text DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = not active ',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `way_sells`
--

CREATE TABLE `way_sells` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'classify way',
  `note` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = notactive',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `working_hours`
--

CREATE TABLE `working_hours` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `id_model` varchar(255) DEFAULT NULL COMMENT 'id for model which whorking hours',
  `model_name` varchar(255) DEFAULT NULL COMMENT 'name for model which whorking hours',
  `from_time` time DEFAULT NULL,
  `to_time` time DEFAULT NULL,
  `dynamic_work` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = hours - 1 = unregular - 2 = 24 hours',
  `on_workrule` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = weekly - 1 = unregular - 2 = 7 days work',
  `work_days` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '0 = Saturday - 1 = Sunday - 2 = Monday - 3 = Tuesday - 4 = Wednesday - 5 = Thursday - 6 =  Friday' CHECK (json_valid(`work_days`)),
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = active - 1 = not active ',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_trees`
--
ALTER TABLE `account_trees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_trees_emp_id_foreign` (`emp_id`);

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `areas_emp_id_foreign` (`emp_id`);

--
-- Indexes for table `assistants`
--
ALTER TABLE `assistants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assistants_emp_id_foreign` (`emp_id`),
  ADD KEY `assistants_center_id_foreign` (`center_id`);

--
-- Indexes for table `bill_sale_details`
--
ALTER TABLE `bill_sale_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_sale_details_emp_id_foreign` (`emp_id`),
  ADD KEY `bill_sale_details_product_id_foreign` (`product_id`),
  ADD KEY `bill_sale_details_bill_sale_header_id_foreign` (`bill_sale_header_id`);

--
-- Indexes for table `bill_sale_headers`
--
ALTER TABLE `bill_sale_headers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_sale_headers_emp_id_foreign` (`emp_id`),
  ADD KEY `bill_sale_headers_cut_sale_id_foreign` (`cut_sale_id`),
  ADD KEY `bill_sale_headers_sale_type_id_foreign` (`sale_type_id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand_gifts`
--
ALTER TABLE `brand_gifts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_gifts_emp_id_foreign` (`emp_id`);

--
-- Indexes for table `cashiers`
--
ALTER TABLE `cashiers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cashiers_emp_id_foreign` (`emp_id`),
  ADD KEY `cashiers_acctree_id_foreign` (`acctree_id`);

--
-- Indexes for table `centers`
--
ALTER TABLE `centers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `centers_emp_id_foreign` (`emp_id`),
  ADD KEY `centers_type_id_foreign` (`type_id`),
  ADD KEY `centers_area_id_foreign` (`area_id`);

--
-- Indexes for table `center_departments`
--
ALTER TABLE `center_departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `center_departments_emp_id_foreign` (`emp_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment_visits`
--
ALTER TABLE `comment_visits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_visits_emp_id_foreign` (`emp_id`),
  ADD KEY `comment_visits_visit_id_foreign` (`visit_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contacts_emp_id_foreign` (`emp_id`),
  ADD KEY `contacts_social_id_foreign` (`social_id`),
  ADD KEY `contacts_contractdr_id_foreign` (`contractdr_id`),
  ADD KEY `contacts_typecont_id_foreign` (`typecont_id`);

--
-- Indexes for table `contact_rates`
--
ALTER TABLE `contact_rates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_rates_emp_id_foreign` (`emp_id`),
  ADD KEY `contact_rates_contact_id_foreign` (`contact_id`),
  ADD KEY `contact_rates_rate_id_foreign` (`rate_id`);

--
-- Indexes for table `contract_drs`
--
ALTER TABLE `contract_drs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contract_drs_emp_id_foreign` (`emp_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cust_collections`
--
ALTER TABLE `cust_collections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cust_collections_emp_id_foreign` (`emp_id`),
  ADD KEY `cust_collections_cust_id_foreign` (`cust_id`);

--
-- Indexes for table `cust_payment_methods`
--
ALTER TABLE `cust_payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cust_payment_methods_emp_id_foreign` (`emp_id`);

--
-- Indexes for table `cut_sales`
--
ALTER TABLE `cut_sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cut_sales_emp_id_foreign` (`emp_id`),
  ADD KEY `cut_sales_center_id_foreign` (`center_id`),
  ADD KEY `cut_sales_area_id_foreign` (`area_id`),
  ADD KEY `cut_sales_payment_method_id_foreign` (`payment_method_id`);

--
-- Indexes for table `cycle_msg_prods`
--
ALTER TABLE `cycle_msg_prods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cycle_msg_prods_emp_id_foreign` (`emp_id`),
  ADD KEY `cycle_msg_prods_prod_id_foreign` (`prod_id`);

--
-- Indexes for table `emirates`
--
ALTER TABLE `emirates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_email_unique` (`email`);

--
-- Indexes for table `employee_roles`
--
ALTER TABLE `employee_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_bill_sales`
--
ALTER TABLE `emp_bill_sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_bill_sales_emp_id_foreign` (`emp_id`),
  ADD KEY `emp_bill_sales_sale_id_foreign` (`sale_id`),
  ADD KEY `emp_bill_sales_empsaled_id_foreign` (`empsaled_id`),
  ADD KEY `emp_bill_sales_sale_type_id_foreign` (`sale_type_id`);

--
-- Indexes for table `emp_sales`
--
ALTER TABLE `emp_sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_sales_emp_id_foreign` (`emp_id`),
  ADD KEY `emp_sales_prod_id_foreign` (`prod_id`),
  ADD KEY `emp_sales_empsaled_id_foreign` (`empsaled_id`),
  ADD KEY `emp_sales_sale_type_id_foreign` (`sale_type_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_emp_id_foreign` (`emp_id`),
  ADD KEY `events_type_id_foreign` (`type_id`);

--
-- Indexes for table `event_atts`
--
ALTER TABLE `event_atts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_atts_emp_id_foreign` (`emp_id`),
  ADD KEY `event_atts_empatt_id_foreign` (`empatt_id`),
  ADD KEY `event_atts_event_id_foreign` (`event_id`);

--
-- Indexes for table `event_contents`
--
ALTER TABLE `event_contents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_contents_emp_id_foreign` (`emp_id`),
  ADD KEY `event_contents_event_id_foreign` (`event_id`);

--
-- Indexes for table `event_types`
--
ALTER TABLE `event_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_types_emp_id_foreign` (`emp_id`);

--
-- Indexes for table `expense_requests`
--
ALTER TABLE `expense_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expense_requests_emp_id_foreign` (`emp_id`),
  ADD KEY `expense_requests_emp_id_dirctor_foreign` (`emp_id_dirctor`),
  ADD KEY `expense_requests_type_id_foreign` (`type_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `funnel_tracks`
--
ALTER TABLE `funnel_tracks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `funnel_tracks_emp_id_foreign` (`emp_id`),
  ADD KEY `funnel_tracks_list_id_foreign` (`list_id`);

--
-- Indexes for table `governorates`
--
ALTER TABLE `governorates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hierarchy_emps`
--
ALTER TABLE `hierarchy_emps`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hierarchy_emps_emphier_id_unique` (`emphier_id`),
  ADD KEY `hierarchy_emps_emp_id_foreign` (`emp_id`);

--
-- Indexes for table `list_contacs`
--
ALTER TABLE `list_contacs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `list_contacs_emp_id_foreign` (`emp_id`),
  ADD KEY `list_contacs_emplist_id_foreign` (`emplist_id`),
  ADD KEY `list_contacs_contact_id_foreign` (`contact_id`),
  ADD KEY `list_contacs_center_id_foreign` (`center_id`),
  ADD KEY `list_contacs_sales_funel_id_foreign` (`sales_funel_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `media_uuid_unique` (`uuid`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  ADD KEY `media_order_column_index` (`order_column`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `place_ws`
--
ALTER TABLE `place_ws`
  ADD PRIMARY KEY (`id`),
  ADD KEY `place_ws_emp_id_foreign` (`emp_id`),
  ADD KEY `place_ws_contact_id_foreign` (`contact_id`),
  ADD KEY `place_ws_center_id_foreign` (`center_id`);

--
-- Indexes for table `plan_visits`
--
ALTER TABLE `plan_visits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plan_visits_emp_id_foreign` (`emp_id`),
  ADD KEY `plan_visits_emphplan_id_foreign` (`emphplan_id`),
  ADD KEY `plan_visits_center_id_foreign` (`center_id`),
  ADD KEY `plan_visits_contact_id_foreign` (`contact_id`),
  ADD KEY `plan_visits_typevist_id_foreign` (`typevist_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_emp_id_foreign` (`emp_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ratings_emp_id_foreign` (`emp_id`);

--
-- Indexes for table `refund_causes`
--
ALTER TABLE `refund_causes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `refund_causes_emp_id_foreign` (`emp_id`);

--
-- Indexes for table `refund_sales`
--
ALTER TABLE `refund_sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `refund_sales_emp_id_foreign` (`emp_id`),
  ADD KEY `refund_sales_cust_id_foreign` (`cust_id`),
  ADD KEY `refund_sales_prod_id_foreign` (`prod_id`),
  ADD KEY `refund_sales_bill_sale_header_id_foreign` (`bill_sale_header_id`),
  ADD KEY `refund_sales_refund_causes_id_foreign` (`refund_causes_id`);

--
-- Indexes for table `relative_contacts`
--
ALTER TABLE `relative_contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `relative_contacts_emp_id_foreign` (`emp_id`),
  ADD KEY `relative_contacts_contact_id_foreign` (`contact_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sales_funels`
--
ALTER TABLE `sales_funels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_funels_emp_id_foreign` (`emp_id`);

--
-- Indexes for table `sale_emp_aschiveds`
--
ALTER TABLE `sale_emp_aschiveds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_emp_aschiveds_emp_id_foreign` (`emp_id`),
  ADD KEY `sale_emp_aschiveds_prod_id_foreign` (`prod_id`),
  ADD KEY `sale_emp_aschiveds_empsaled_id_foreign` (`empsaled_id`),
  ADD KEY `sale_emp_aschiveds_sale_type_id_foreign` (`sale_type_id`);

--
-- Indexes for table `sale_types`
--
ALTER TABLE `sale_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sale_types_name_en_unique` (`name_en`),
  ADD KEY `sale_types_emp_id_foreign` (`emp_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_styls`
--
ALTER TABLE `social_styls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `social_styls_emp_id_foreign` (`emp_id`);

--
-- Indexes for table `specialties`
--
ALTER TABLE `specialties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `specialties_emp_id_foreign` (`emp_id`);

--
-- Indexes for table `technical_supports`
--
ALTER TABLE `technical_supports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `technical_supports_emp_id_foreign` (`emp_id`);

--
-- Indexes for table `temp_sale_recs`
--
ALTER TABLE `temp_sale_recs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `temp_sale_recs_emp_id_foreign` (`emp_id`),
  ADD KEY `temp_sale_recs_cut_sale_id_foreign` (`cut_sale_id`),
  ADD KEY `temp_sale_recs_sale_type_id_foreign` (`sale_type_id`),
  ADD KEY `temp_sale_recs_product_id_foreign` (`product_id`);

--
-- Indexes for table `tools`
--
ALTER TABLE `tools`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tools_emp_id_foreign` (`emp_id`),
  ADD KEY `tools_empreceved_id_foreign` (`empreceved_id`),
  ADD KEY `tools_type_tool_id_foreign` (`type_tool_id`);

--
-- Indexes for table `trans_custs`
--
ALTER TABLE `trans_custs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trans_custs_emp_id_foreign` (`emp_id`),
  ADD KEY `trans_custs_cust_id_foreign` (`cust_id`);

--
-- Indexes for table `type_centers`
--
ALTER TABLE `type_centers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_centers_emp_id_foreign` (`emp_id`);

--
-- Indexes for table `type_contacts`
--
ALTER TABLE `type_contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_contacts_emp_id_foreign` (`emp_id`);

--
-- Indexes for table `type_expenses`
--
ALTER TABLE `type_expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_expenses_emp_id_foreign` (`emp_id`);

--
-- Indexes for table `type_tools`
--
ALTER TABLE `type_tools`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_tools_emp_id_foreign` (`emp_id`);

--
-- Indexes for table `type_visits`
--
ALTER TABLE `type_visits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_visits_emp_id_foreign` (`emp_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- Indexes for table `vacationemps`
--
ALTER TABLE `vacationemps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vacationemps_emp_id_foreign` (`emp_id`),
  ADD KEY `vacationemps_emp_vacation_foreign` (`emp_vacation`);

--
-- Indexes for table `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visits_emp_id_foreign` (`emp_id`),
  ADD KEY `visits_empvisit_id_foreign` (`empvisit_id`),
  ADD KEY `visits_typevist_id_foreign` (`typevist_id`),
  ADD KEY `visits_center_id_foreign` (`center_id`),
  ADD KEY `visits_contact_id_foreign` (`contact_id`),
  ADD KEY `visits_firstprodstep_id_foreign` (`firstprodstep_id`),
  ADD KEY `visits_secondprodstep_id_foreign` (`secondprodstep_id`),
  ADD KEY `visits_thirdprodstep_id_foreign` (`thirdprodstep_id`);

--
-- Indexes for table `way_sells`
--
ALTER TABLE `way_sells`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `way_sells_name_en_unique` (`name_en`),
  ADD KEY `way_sells_emp_id_foreign` (`emp_id`);

--
-- Indexes for table `working_hours`
--
ALTER TABLE `working_hours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `working_hours_emp_id_foreign` (`emp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_trees`
--
ALTER TABLE `account_trees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `assistants`
--
ALTER TABLE `assistants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bill_sale_details`
--
ALTER TABLE `bill_sale_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bill_sale_headers`
--
ALTER TABLE `bill_sale_headers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brand_gifts`
--
ALTER TABLE `brand_gifts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cashiers`
--
ALTER TABLE `cashiers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `centers`
--
ALTER TABLE `centers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `center_departments`
--
ALTER TABLE `center_departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=397;

--
-- AUTO_INCREMENT for table `comment_visits`
--
ALTER TABLE `comment_visits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contact_rates`
--
ALTER TABLE `contact_rates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contract_drs`
--
ALTER TABLE `contract_drs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cust_collections`
--
ALTER TABLE `cust_collections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cust_payment_methods`
--
ALTER TABLE `cust_payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cut_sales`
--
ALTER TABLE `cut_sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cycle_msg_prods`
--
ALTER TABLE `cycle_msg_prods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emirates`
--
ALTER TABLE `emirates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employee_roles`
--
ALTER TABLE `employee_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emp_bill_sales`
--
ALTER TABLE `emp_bill_sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emp_sales`
--
ALTER TABLE `emp_sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_atts`
--
ALTER TABLE `event_atts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_contents`
--
ALTER TABLE `event_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_types`
--
ALTER TABLE `event_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense_requests`
--
ALTER TABLE `expense_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `funnel_tracks`
--
ALTER TABLE `funnel_tracks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `governorates`
--
ALTER TABLE `governorates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `hierarchy_emps`
--
ALTER TABLE `hierarchy_emps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `list_contacs`
--
ALTER TABLE `list_contacs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `place_ws`
--
ALTER TABLE `place_ws`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plan_visits`
--
ALTER TABLE `plan_visits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `refund_causes`
--
ALTER TABLE `refund_causes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `refund_sales`
--
ALTER TABLE `refund_sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `relative_contacts`
--
ALTER TABLE `relative_contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales_funels`
--
ALTER TABLE `sales_funels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_emp_aschiveds`
--
ALTER TABLE `sale_emp_aschiveds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_types`
--
ALTER TABLE `sale_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `social_styls`
--
ALTER TABLE `social_styls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `specialties`
--
ALTER TABLE `specialties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `technical_supports`
--
ALTER TABLE `technical_supports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temp_sale_recs`
--
ALTER TABLE `temp_sale_recs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tools`
--
ALTER TABLE `tools`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trans_custs`
--
ALTER TABLE `trans_custs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type_centers`
--
ALTER TABLE `type_centers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `type_contacts`
--
ALTER TABLE `type_contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `type_expenses`
--
ALTER TABLE `type_expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type_tools`
--
ALTER TABLE `type_tools`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type_visits`
--
ALTER TABLE `type_visits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vacationemps`
--
ALTER TABLE `vacationemps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visits`
--
ALTER TABLE `visits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `way_sells`
--
ALTER TABLE `way_sells`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `working_hours`
--
ALTER TABLE `working_hours`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account_trees`
--
ALTER TABLE `account_trees`
  ADD CONSTRAINT `account_trees_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `areas`
--
ALTER TABLE `areas`
  ADD CONSTRAINT `areas_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `assistants`
--
ALTER TABLE `assistants`
  ADD CONSTRAINT `assistants_center_id_foreign` FOREIGN KEY (`center_id`) REFERENCES `centers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assistants_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bill_sale_details`
--
ALTER TABLE `bill_sale_details`
  ADD CONSTRAINT `bill_sale_details_bill_sale_header_id_foreign` FOREIGN KEY (`bill_sale_header_id`) REFERENCES `bill_sale_headers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bill_sale_details_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bill_sale_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bill_sale_headers`
--
ALTER TABLE `bill_sale_headers`
  ADD CONSTRAINT `bill_sale_headers_cut_sale_id_foreign` FOREIGN KEY (`cut_sale_id`) REFERENCES `cut_sales` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bill_sale_headers_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bill_sale_headers_sale_type_id_foreign` FOREIGN KEY (`sale_type_id`) REFERENCES `sale_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `brand_gifts`
--
ALTER TABLE `brand_gifts`
  ADD CONSTRAINT `brand_gifts_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cashiers`
--
ALTER TABLE `cashiers`
  ADD CONSTRAINT `cashiers_acctree_id_foreign` FOREIGN KEY (`acctree_id`) REFERENCES `account_trees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cashiers_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `centers`
--
ALTER TABLE `centers`
  ADD CONSTRAINT `centers_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `centers_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `centers_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `type_centers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `center_departments`
--
ALTER TABLE `center_departments`
  ADD CONSTRAINT `center_departments_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comment_visits`
--
ALTER TABLE `comment_visits`
  ADD CONSTRAINT `comment_visits_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_visits_visit_id_foreign` FOREIGN KEY (`visit_id`) REFERENCES `visits` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_contractdr_id_foreign` FOREIGN KEY (`contractdr_id`) REFERENCES `contract_drs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contacts_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contacts_social_id_foreign` FOREIGN KEY (`social_id`) REFERENCES `social_styls` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contacts_typecont_id_foreign` FOREIGN KEY (`typecont_id`) REFERENCES `type_contacts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contact_rates`
--
ALTER TABLE `contact_rates`
  ADD CONSTRAINT `contact_rates_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contact_rates_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contact_rates_rate_id_foreign` FOREIGN KEY (`rate_id`) REFERENCES `ratings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contract_drs`
--
ALTER TABLE `contract_drs`
  ADD CONSTRAINT `contract_drs_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cust_collections`
--
ALTER TABLE `cust_collections`
  ADD CONSTRAINT `cust_collections_cust_id_foreign` FOREIGN KEY (`cust_id`) REFERENCES `cut_sales` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cust_collections_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cust_payment_methods`
--
ALTER TABLE `cust_payment_methods`
  ADD CONSTRAINT `cust_payment_methods_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cut_sales`
--
ALTER TABLE `cut_sales`
  ADD CONSTRAINT `cut_sales_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cut_sales_center_id_foreign` FOREIGN KEY (`center_id`) REFERENCES `centers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cut_sales_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cut_sales_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `cust_payment_methods` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cycle_msg_prods`
--
ALTER TABLE `cycle_msg_prods`
  ADD CONSTRAINT `cycle_msg_prods_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cycle_msg_prods_prod_id_foreign` FOREIGN KEY (`prod_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `emp_bill_sales`
--
ALTER TABLE `emp_bill_sales`
  ADD CONSTRAINT `emp_bill_sales_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `emp_bill_sales_empsaled_id_foreign` FOREIGN KEY (`empsaled_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `emp_bill_sales_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `bill_sale_details` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `emp_bill_sales_sale_type_id_foreign` FOREIGN KEY (`sale_type_id`) REFERENCES `sale_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `emp_sales`
--
ALTER TABLE `emp_sales`
  ADD CONSTRAINT `emp_sales_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `emp_sales_empsaled_id_foreign` FOREIGN KEY (`empsaled_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `emp_sales_prod_id_foreign` FOREIGN KEY (`prod_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `emp_sales_sale_type_id_foreign` FOREIGN KEY (`sale_type_id`) REFERENCES `sale_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `events_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `event_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `event_atts`
--
ALTER TABLE `event_atts`
  ADD CONSTRAINT `event_atts_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_atts_empatt_id_foreign` FOREIGN KEY (`empatt_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_atts_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `event_contents`
--
ALTER TABLE `event_contents`
  ADD CONSTRAINT `event_contents_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_contents_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `event_types`
--
ALTER TABLE `event_types`
  ADD CONSTRAINT `event_types_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `expense_requests`
--
ALTER TABLE `expense_requests`
  ADD CONSTRAINT `expense_requests_emp_id_dirctor_foreign` FOREIGN KEY (`emp_id_dirctor`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `expense_requests_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `expense_requests_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `type_expenses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `funnel_tracks`
--
ALTER TABLE `funnel_tracks`
  ADD CONSTRAINT `funnel_tracks_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `funnel_tracks_list_id_foreign` FOREIGN KEY (`list_id`) REFERENCES `list_contacs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hierarchy_emps`
--
ALTER TABLE `hierarchy_emps`
  ADD CONSTRAINT `hierarchy_emps_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hierarchy_emps_emphier_id_foreign` FOREIGN KEY (`emphier_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `list_contacs`
--
ALTER TABLE `list_contacs`
  ADD CONSTRAINT `list_contacs_center_id_foreign` FOREIGN KEY (`center_id`) REFERENCES `centers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `list_contacs_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `list_contacs_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `list_contacs_emplist_id_foreign` FOREIGN KEY (`emplist_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `list_contacs_sales_funel_id_foreign` FOREIGN KEY (`sales_funel_id`) REFERENCES `sales_funels` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `place_ws`
--
ALTER TABLE `place_ws`
  ADD CONSTRAINT `place_ws_center_id_foreign` FOREIGN KEY (`center_id`) REFERENCES `centers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `place_ws_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `place_ws_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `plan_visits`
--
ALTER TABLE `plan_visits`
  ADD CONSTRAINT `plan_visits_center_id_foreign` FOREIGN KEY (`center_id`) REFERENCES `centers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `plan_visits_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `plan_visits_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `plan_visits_emphplan_id_foreign` FOREIGN KEY (`emphplan_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `plan_visits_typevist_id_foreign` FOREIGN KEY (`typevist_id`) REFERENCES `type_visits` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `refund_causes`
--
ALTER TABLE `refund_causes`
  ADD CONSTRAINT `refund_causes_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `refund_sales`
--
ALTER TABLE `refund_sales`
  ADD CONSTRAINT `refund_sales_bill_sale_header_id_foreign` FOREIGN KEY (`bill_sale_header_id`) REFERENCES `bill_sale_headers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `refund_sales_cust_id_foreign` FOREIGN KEY (`cust_id`) REFERENCES `cut_sales` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `refund_sales_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `refund_sales_prod_id_foreign` FOREIGN KEY (`prod_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `refund_sales_refund_causes_id_foreign` FOREIGN KEY (`refund_causes_id`) REFERENCES `refund_causes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `relative_contacts`
--
ALTER TABLE `relative_contacts`
  ADD CONSTRAINT `relative_contacts_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `relative_contacts_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sales_funels`
--
ALTER TABLE `sales_funels`
  ADD CONSTRAINT `sales_funels_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sale_emp_aschiveds`
--
ALTER TABLE `sale_emp_aschiveds`
  ADD CONSTRAINT `sale_emp_aschiveds_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sale_emp_aschiveds_empsaled_id_foreign` FOREIGN KEY (`empsaled_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sale_emp_aschiveds_prod_id_foreign` FOREIGN KEY (`prod_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sale_emp_aschiveds_sale_type_id_foreign` FOREIGN KEY (`sale_type_id`) REFERENCES `sale_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sale_types`
--
ALTER TABLE `sale_types`
  ADD CONSTRAINT `sale_types_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `social_styls`
--
ALTER TABLE `social_styls`
  ADD CONSTRAINT `social_styls_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `specialties`
--
ALTER TABLE `specialties`
  ADD CONSTRAINT `specialties_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `technical_supports`
--
ALTER TABLE `technical_supports`
  ADD CONSTRAINT `technical_supports_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `temp_sale_recs`
--
ALTER TABLE `temp_sale_recs`
  ADD CONSTRAINT `temp_sale_recs_cut_sale_id_foreign` FOREIGN KEY (`cut_sale_id`) REFERENCES `cut_sales` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `temp_sale_recs_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `temp_sale_recs_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `temp_sale_recs_sale_type_id_foreign` FOREIGN KEY (`sale_type_id`) REFERENCES `sale_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tools`
--
ALTER TABLE `tools`
  ADD CONSTRAINT `tools_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tools_empreceved_id_foreign` FOREIGN KEY (`empreceved_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tools_type_tool_id_foreign` FOREIGN KEY (`type_tool_id`) REFERENCES `type_tools` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `trans_custs`
--
ALTER TABLE `trans_custs`
  ADD CONSTRAINT `trans_custs_cust_id_foreign` FOREIGN KEY (`cust_id`) REFERENCES `cut_sales` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `trans_custs_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `type_centers`
--
ALTER TABLE `type_centers`
  ADD CONSTRAINT `type_centers_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `type_contacts`
--
ALTER TABLE `type_contacts`
  ADD CONSTRAINT `type_contacts_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `type_expenses`
--
ALTER TABLE `type_expenses`
  ADD CONSTRAINT `type_expenses_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `type_tools`
--
ALTER TABLE `type_tools`
  ADD CONSTRAINT `type_tools_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `type_visits`
--
ALTER TABLE `type_visits`
  ADD CONSTRAINT `type_visits_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vacationemps`
--
ALTER TABLE `vacationemps`
  ADD CONSTRAINT `vacationemps_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vacationemps_emp_vacation_foreign` FOREIGN KEY (`emp_vacation`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `visits`
--
ALTER TABLE `visits`
  ADD CONSTRAINT `visits_center_id_foreign` FOREIGN KEY (`center_id`) REFERENCES `centers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `visits_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `visits_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `visits_empvisit_id_foreign` FOREIGN KEY (`empvisit_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `visits_firstprodstep_id_foreign` FOREIGN KEY (`firstprodstep_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `visits_secondprodstep_id_foreign` FOREIGN KEY (`secondprodstep_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `visits_thirdprodstep_id_foreign` FOREIGN KEY (`thirdprodstep_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `visits_typevist_id_foreign` FOREIGN KEY (`typevist_id`) REFERENCES `type_visits` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `way_sells`
--
ALTER TABLE `way_sells`
  ADD CONSTRAINT `way_sells_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `working_hours`
--
ALTER TABLE `working_hours`
  ADD CONSTRAINT `working_hours_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
