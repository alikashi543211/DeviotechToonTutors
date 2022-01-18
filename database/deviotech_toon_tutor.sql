-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2021 at 09:53 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `deviotech_toon_tutor`
--

-- --------------------------------------------------------

--
-- Table structure for table `class_plans`
--

CREATE TABLE `class_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tutor_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `date_time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','taken','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `class_plans`
--

INSERT INTO `class_plans` (`id`, `tutor_id`, `student_id`, `date_time`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 10, '2020/11/17 12:50', 'taken', '2020-11-17 07:48:49', '2020-11-17 07:52:11'),
(2, 2, 9, '2020/11/18 11:45', 'taken', '2020-11-17 13:05:20', '2020-11-18 06:48:59'),
(3, 4, 9, '2020/11/18 12:15', 'taken', '2020-11-18 07:14:16', '2020-11-18 07:19:20');

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tutor_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `conversations`
--

INSERT INTO `conversations` (`id`, `tutor_id`, `student_id`, `created_at`, `updated_at`) VALUES
(1, 14, 13, '2020-12-27 19:00:00', '2020-12-27 19:00:00'),
(2, 15, 13, '2021-01-04 10:33:57', '2021-01-04 10:33:57');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_code`, `country_name`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AL', 'Albania'),
(3, 'DZ', 'Algeria'),
(4, 'DS', 'American Samoa'),
(5, 'AD', 'Andorra'),
(6, 'AO', 'Angola'),
(7, 'AI', 'Anguilla'),
(8, 'AQ', 'Antarctica'),
(9, 'AG', 'Antigua and Barbuda'),
(10, 'AR', 'Argentina'),
(11, 'AM', 'Armenia'),
(12, 'AW', 'Aruba'),
(13, 'AU', 'Australia'),
(14, 'AT', 'Austria'),
(15, 'AZ', 'Azerbaijan'),
(16, 'BS', 'Bahamas'),
(17, 'BH', 'Bahrain'),
(18, 'BD', 'Bangladesh'),
(19, 'BB', 'Barbados'),
(20, 'BY', 'Belarus'),
(21, 'BE', 'Belgium'),
(22, 'BZ', 'Belize'),
(23, 'BJ', 'Benin'),
(24, 'BM', 'Bermuda'),
(25, 'BT', 'Bhutan'),
(26, 'BO', 'Bolivia'),
(27, 'BA', 'Bosnia and Herzegovina'),
(28, 'BW', 'Botswana'),
(29, 'BV', 'Bouvet Island'),
(30, 'BR', 'Brazil'),
(31, 'IO', 'British Indian Ocean Territory'),
(32, 'BN', 'Brunei Darussalam'),
(33, 'BG', 'Bulgaria'),
(34, 'BF', 'Burkina Faso'),
(35, 'BI', 'Burundi'),
(36, 'KH', 'Cambodia'),
(37, 'CM', 'Cameroon'),
(38, 'CA', 'Canada'),
(39, 'CV', 'Cape Verde'),
(40, 'KY', 'Cayman Islands'),
(41, 'CF', 'Central African Republic'),
(42, 'TD', 'Chad'),
(43, 'CL', 'Chile'),
(44, 'CN', 'China'),
(45, 'CX', 'Christmas Island'),
(46, 'CC', 'Cocos (Keeling) Islands'),
(47, 'CO', 'Colombia'),
(48, 'KM', 'Comoros'),
(49, 'CD', 'Democratic Republic of the Congo'),
(50, 'CG', 'Republic of Congo'),
(51, 'CK', 'Cook Islands'),
(52, 'CR', 'Costa Rica'),
(53, 'HR', 'Croatia (Hrvatska)'),
(54, 'CU', 'Cuba'),
(55, 'CY', 'Cyprus'),
(56, 'CZ', 'Czech Republic'),
(57, 'DK', 'Denmark'),
(58, 'DJ', 'Djibouti'),
(59, 'DM', 'Dominica'),
(60, 'DO', 'Dominican Republic'),
(61, 'TP', 'East Timor'),
(62, 'EC', 'Ecuador'),
(63, 'EG', 'Egypt'),
(64, 'SV', 'El Salvador'),
(65, 'GQ', 'Equatorial Guinea'),
(66, 'ER', 'Eritrea'),
(67, 'EE', 'Estonia'),
(68, 'ET', 'Ethiopia'),
(69, 'FK', 'Falkland Islands (Malvinas)'),
(70, 'FO', 'Faroe Islands'),
(71, 'FJ', 'Fiji'),
(72, 'FI', 'Finland'),
(73, 'FR', 'France'),
(74, 'FX', 'France, Metropolitan'),
(75, 'GF', 'French Guiana'),
(76, 'PF', 'French Polynesia'),
(77, 'TF', 'French Southern Territories'),
(78, 'GA', 'Gabon'),
(79, 'GM', 'Gambia'),
(80, 'GE', 'Georgia'),
(81, 'DE', 'Germany'),
(82, 'GH', 'Ghana'),
(83, 'GI', 'Gibraltar'),
(84, 'GK', 'Guernsey'),
(85, 'GR', 'Greece'),
(86, 'GL', 'Greenland'),
(87, 'GD', 'Grenada'),
(88, 'GP', 'Guadeloupe'),
(89, 'GU', 'Guam'),
(90, 'GT', 'Guatemala'),
(91, 'GN', 'Guinea'),
(92, 'GW', 'Guinea-Bissau'),
(93, 'GY', 'Guyana'),
(94, 'HT', 'Haiti'),
(95, 'HM', 'Heard and Mc Donald Islands'),
(96, 'HN', 'Honduras'),
(97, 'HK', 'Hong Kong'),
(98, 'HU', 'Hungary'),
(99, 'IS', 'Iceland'),
(100, 'IN', 'India'),
(101, 'IM', 'Isle of Man'),
(102, 'ID', 'Indonesia'),
(103, 'IR', 'Iran (Islamic Republic of)'),
(104, 'IQ', 'Iraq'),
(105, 'IE', 'Ireland'),
(106, 'IL', 'Israel'),
(107, 'IT', 'Italy'),
(108, 'CI', 'Ivory Coast'),
(109, 'JE', 'Jersey'),
(110, 'JM', 'Jamaica'),
(111, 'JP', 'Japan'),
(112, 'JO', 'Jordan'),
(113, 'KZ', 'Kazakhstan'),
(114, 'KE', 'Kenya'),
(115, 'KI', 'Kiribati'),
(116, 'KP', 'Korea, Democratic People\'s Republic of'),
(117, 'KR', 'Korea, Republic of'),
(118, 'XK', 'Kosovo'),
(119, 'KW', 'Kuwait'),
(120, 'KG', 'Kyrgyzstan'),
(121, 'LA', 'Lao People\'s Democratic Republic'),
(122, 'LV', 'Latvia'),
(123, 'LB', 'Lebanon'),
(124, 'LS', 'Lesotho'),
(125, 'LR', 'Liberia'),
(126, 'LY', 'Libyan Arab Jamahiriya'),
(127, 'LI', 'Liechtenstein'),
(128, 'LT', 'Lithuania'),
(129, 'LU', 'Luxembourg'),
(130, 'MO', 'Macau'),
(131, 'MK', 'North Macedonia'),
(132, 'MG', 'Madagascar'),
(133, 'MW', 'Malawi'),
(134, 'MY', 'Malaysia'),
(135, 'MV', 'Maldives'),
(136, 'ML', 'Mali'),
(137, 'MT', 'Malta'),
(138, 'MH', 'Marshall Islands'),
(139, 'MQ', 'Martinique'),
(140, 'MR', 'Mauritania'),
(141, 'MU', 'Mauritius'),
(142, 'TY', 'Mayotte'),
(143, 'MX', 'Mexico'),
(144, 'FM', 'Micronesia, Federated States of'),
(145, 'MD', 'Moldova, Republic of'),
(146, 'MC', 'Monaco'),
(147, 'MN', 'Mongolia'),
(148, 'ME', 'Montenegro'),
(149, 'MS', 'Montserrat'),
(150, 'MA', 'Morocco'),
(151, 'MZ', 'Mozambique'),
(152, 'MM', 'Myanmar'),
(153, 'NA', 'Namibia'),
(154, 'NR', 'Nauru'),
(155, 'NP', 'Nepal'),
(156, 'NL', 'Netherlands'),
(157, 'AN', 'Netherlands Antilles'),
(158, 'NC', 'New Caledonia'),
(159, 'NZ', 'New Zealand'),
(160, 'NI', 'Nicaragua'),
(161, 'NE', 'Niger'),
(162, 'NG', 'Nigeria'),
(163, 'NU', 'Niue'),
(164, 'NF', 'Norfolk Island'),
(165, 'MP', 'Northern Mariana Islands'),
(166, 'NO', 'Norway'),
(167, 'OM', 'Oman'),
(168, 'PK', 'Pakistan'),
(169, 'PW', 'Palau'),
(170, 'PS', 'Palestine'),
(171, 'PA', 'Panama'),
(172, 'PG', 'Papua New Guinea'),
(173, 'PY', 'Paraguay'),
(174, 'PE', 'Peru'),
(175, 'PH', 'Philippines'),
(176, 'PN', 'Pitcairn'),
(177, 'PL', 'Poland'),
(178, 'PT', 'Portugal'),
(179, 'PR', 'Puerto Rico'),
(180, 'QA', 'Qatar'),
(181, 'RE', 'Reunion'),
(182, 'RO', 'Romania'),
(183, 'RU', 'Russian Federation'),
(184, 'RW', 'Rwanda'),
(185, 'KN', 'Saint Kitts and Nevis'),
(186, 'LC', 'Saint Lucia'),
(187, 'VC', 'Saint Vincent and the Grenadines'),
(188, 'WS', 'Samoa'),
(189, 'SM', 'San Marino'),
(190, 'ST', 'Sao Tome and Principe'),
(191, 'SA', 'Saudi Arabia'),
(192, 'SN', 'Senegal'),
(193, 'RS', 'Serbia'),
(194, 'SC', 'Seychelles'),
(195, 'SL', 'Sierra Leone'),
(196, 'SG', 'Singapore'),
(197, 'SK', 'Slovakia'),
(198, 'SI', 'Slovenia'),
(199, 'SB', 'Solomon Islands'),
(200, 'SO', 'Somalia'),
(201, 'ZA', 'South Africa'),
(202, 'GS', 'South Georgia South Sandwich Islands'),
(203, 'SS', 'South Sudan'),
(204, 'ES', 'Spain'),
(205, 'LK', 'Sri Lanka'),
(206, 'SH', 'St. Helena'),
(207, 'PM', 'St. Pierre and Miquelon'),
(208, 'SD', 'Sudan'),
(209, 'SR', 'Suriname'),
(210, 'SJ', 'Svalbard and Jan Mayen Islands'),
(211, 'SZ', 'Swaziland'),
(212, 'SE', 'Sweden'),
(213, 'CH', 'Switzerland'),
(214, 'SY', 'Syrian Arab Republic'),
(215, 'TW', 'Taiwan'),
(216, 'TJ', 'Tajikistan'),
(217, 'TZ', 'Tanzania, United Republic of'),
(218, 'TH', 'Thailand'),
(219, 'TG', 'Togo'),
(220, 'TK', 'Tokelau'),
(221, 'TO', 'Tonga'),
(222, 'TT', 'Trinidad and Tobago'),
(223, 'TN', 'Tunisia'),
(224, 'TR', 'Turkey'),
(225, 'TM', 'Turkmenistan'),
(226, 'TC', 'Turks and Caicos Islands'),
(227, 'TV', 'Tuvalu'),
(228, 'UG', 'Uganda'),
(229, 'UA', 'Ukraine'),
(230, 'AE', 'United Arab Emirates'),
(231, 'GB', 'United Kingdom'),
(232, 'US', 'United States'),
(233, 'UM', 'United States minor outlying islands'),
(234, 'UY', 'Uruguay'),
(235, 'UZ', 'Uzbekistan'),
(236, 'VU', 'Vanuatu'),
(237, 'VA', 'Vatican City State'),
(238, 'VE', 'Venezuela'),
(239, 'VN', 'Vietnam'),
(240, 'VG', 'Virgin Islands (British)'),
(241, 'VI', 'Virgin Islands (U.S.)'),
(242, 'WF', 'Wallis and Futuna Islands'),
(243, 'EH', 'Western Sahara'),
(244, 'YE', 'Yemen'),
(245, 'ZM', 'Zambia'),
(246, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meeting_sessions`
--

CREATE TABLE `meeting_sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zoom_id` bigint(20) NOT NULL,
  `start_url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `join_url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tutor_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `time_taken` int(11) DEFAULT NULL,
  `ended_at` timestamp NULL DEFAULT NULL,
  `status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0. No state 1. Started 2. Ended',
  `student_joined` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tutor_request_id` bigint(20) UNSIGNED NOT NULL,
  `refund_request` enum('1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0. Default 1. Requested 2. Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meeting_sessions`
--

INSERT INTO `meeting_sessions` (`id`, `session_id`, `zoom_id`, `start_url`, `join_url`, `tutor_id`, `student_id`, `time_taken`, `ended_at`, `status`, `student_joined`, `created_at`, `updated_at`, `tutor_request_id`, `refund_request`) VALUES
(2, '9wef65aszqr340gpxu7h2n81jmylkcvt', 75554120073, 'https://us04web.zoom.us/s/75554120073?zak=eyJ6bV9za20iOiJ6bV9vMm0iLCJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJhdWQiOiJjbGllbnQiLCJ1aWQiOiJjcmJlcS1YUFJXQzhHOTlyTFdneHB3IiwiaXNzIjoid2ViIiwic3R5IjoxLCJ3Y2QiOiJ1czA0IiwiY2x0IjowLCJzdGsiOiI1Q091WDNMNUhHUUQ2aGJBOFY4Z0xYM0FjSGpTRFk0LVhQRmNkRzZzV2I0LkFHLlBpcW1QV1hWcmQ1Z0JxUWIwam16bkp1UEljWkJoekxrNkFlTGtRMWNtTERHNWRxdUZMV3F0Wk9ZZzVLUjZFTDN3Z3lYWEh2bHRhMnR1RDVfLjhsM2VCS2RpNDBZWUhNT2ZFVnh5Q1EuVjZ0T2ZmMkJKMUpBS21FWSIsImV4cCI6MTYxMDYxOTY0NSwiaWF0IjoxNjEwNjEyNDQ1LCJhaWQiOiJVaU1SS0N2N1JNbXFrcU5YQUF2YW5nIiwiY2lkIjoiIn0.HZVETLC_AX7eSqDNBkTWFRC953UnIQ-JwW9DWBsbT8E', 'https://us04web.zoom.us/j/75554120073?pwd=NXdLTXNYdXhnWUp3WWNlVTVzT3RIdz09', 14, 13, NULL, NULL, '1', 0, '2021-01-14 08:20:46', '2021-04-29 07:50:17', 43, '3');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `conversation_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `conversation_id`, `user_id`, `message`, `ip`, `file`, `created_at`, `updated_at`) VALUES
(1, 1, 13, 'Hello sir ji', '99.124.229.143', NULL, '2020-12-27 19:00:00', '2020-12-27 19:00:00'),
(2, 1, 14, 'Hello Beta', '127.0.0.1', NULL, '2020-12-29 06:31:55', '2020-12-29 06:31:55'),
(3, 1, 14, 'Hello Beta', '127.0.0.1', NULL, '2020-12-29 06:31:55', '2020-12-29 06:31:55'),
(4, 1, 14, 'kjkj', '127.0.0.1', NULL, '2020-12-29 06:47:35', '2020-12-29 06:47:35'),
(5, 1, 14, 'hello sir', '127.0.0.1', NULL, '2020-12-29 06:56:05', '2020-12-29 06:56:05'),
(6, 1, 14, 'Nice sir', '127.0.0.1', NULL, '2020-12-29 07:00:29', '2020-12-29 07:00:29'),
(7, 1, 14, 'Ab work kry ga?', '127.0.0.1', NULL, '2020-12-29 07:04:36', '2020-12-29 07:04:36'),
(8, 1, 14, 'Nice to see you', '127.0.0.1', NULL, '2020-12-29 07:05:26', '2020-12-29 07:05:26'),
(9, 1, 14, 'Acha hai', '127.0.0.1', NULL, '2020-12-29 07:07:14', '2020-12-29 07:07:14'),
(10, 1, 13, 'Hello sir', '127.0.0.1', NULL, '2020-12-29 07:42:33', '2020-12-29 07:42:33'),
(11, 1, 14, 'JI beta', '127.0.0.1', NULL, '2020-12-29 07:42:59', '2020-12-29 07:42:59'),
(12, 1, 13, 'Sir Ap bht achy hain', '127.0.0.1', NULL, '2020-12-29 07:51:36', '2020-12-29 07:51:36'),
(13, 1, 13, 'ji sir', '127.0.0.1', NULL, '2020-12-29 07:53:07', '2020-12-29 07:53:07'),
(14, 1, 14, 'Kuch ni betha ayse hi vella betha hun', '127.0.0.1', NULL, '2020-12-29 07:56:18', '2020-12-29 07:56:18'),
(15, 1, 13, 'kch ni m b vella', '127.0.0.1', NULL, '2020-12-29 08:18:58', '2020-12-29 08:18:58'),
(16, 2, 13, 'Hello sir', '127.0.0.1', NULL, '2021-01-04 10:33:57', '2021-01-04 10:33:57'),
(17, 1, 13, 'Sir Class Ly Lyn Please', '127.0.0.1', NULL, '2021-01-14 07:54:12', '2021-01-14 07:54:12');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2020_10_05_185154_create_sessions_table', 1),
(7, '2020_10_20_094126_create_settings_table', 1),
(8, '2020_11_05_161818_create_tutor_profiles_table', 1),
(9, '2020_11_07_094145_alter_tutor_profiles_for_add_country', 2),
(10, '2020_11_07_094901_alter_tutor_profiles_for_add_bio', 3),
(12, '2020_11_07_105146_alter_tutor_profiles_for_add_availability', 4),
(13, '2020_11_07_115346_create_student_profiles_table', 5),
(15, '2020_11_07_132837_create_tutor_requests_table', 6),
(19, '2019_05_03_000001_create_customer_columns', 7),
(20, '2019_05_03_000002_create_subscriptions_table', 7),
(21, '2019_05_03_000003_create_subscription_items_table', 7),
(23, '2020_11_13_062048_create_transactions_table', 8),
(24, '2020_11_13_072044_create_class_plans_table', 9),
(26, '2020_11_13_112909_create_meeting_sessions_table', 10),
(27, '2020_11_14_155212_alter_transactions_table_for_status', 11),
(28, '2020_11_15_140420_create_reviews_table', 12),
(29, '2020_11_17_110659_create_parent_profiles_table', 13),
(30, '2020_11_17_110950_create_parent_students_table', 14),
(32, '2020_11_17_121501_alter_tutor_requests_for_parent_student_id_column', 15),
(33, '2020_11_18_105515_alter_tutor_profiles_table_for_hourly_rate', 16),
(34, '2020_11_18_113849_alter_meeting_sessions_table_for_student_joined', 17),
(35, '2020_11_19_180218_create_time_tables_table', 18),
(36, '2020_11_20_103259_alter_tutor_requests_table_for_adding_hours_column', 19),
(37, '2020_11_20_120332_alter_tutor_requests_table_for_adding_date_column', 20),
(38, '2020_11_20_151831_alter_tutor_requests_table_for_class_status_column', 21),
(39, '2020_11_20_162731_alter_meeting_sessions_table_for_tutor_request_id', 22),
(40, '2020_11_24_123339_alter_users_table_for_time_zone', 23),
(41, '2020_11_27_101810_alter_users_table_for_calendar_id', 24),
(42, '2020_11_30_141402_alter_tutor_requests_table_for_interval_and_no_of_weeks', 25),
(43, '2020_11_30_155026_alter_tutor_requests_table_for_remaining_weeks_and_active_date', 26),
(44, '2020_11_30_162644_alter_tutor_requests_table_for_class_status_enum', 27),
(45, '2020_11_30_164826_alter_transactions_table_for_amount_captured', 28),
(46, '2020_11_30_170318_alter_transactions_table_for_amount_reserved', 29),
(47, '2020_12_02_122450_alter_tutor_requests_table_for_payment_status', 30),
(48, '2020_12_02_180941_alter_tutor_requests_table_for_amount_coloums', 31),
(49, '2020_12_02_235053_alter_transactions_table_for_drop_column', 32),
(50, '2020_12_15_150109_create_subscribe_plans_table', 33),
(51, '2020_12_16_111315_create_packages_table', 33),
(52, '2020_12_16_144525_alter_column_package_type_in_subscribe_plans', 33),
(53, '2020_12_21_104009_alter_packages_table_for_drop_and_add_columns', 34),
(54, '2020_12_21_111544_alter_packages_table_for_hours_column', 35),
(55, '2020_12_22_115034_alter_subscribe_plans_table_for_drop_column_and_add_column', 36),
(56, '2020_12_22_151923_alter_subscribe_plans_table_for_status', 37),
(57, '2020_12_22_154348_alter_tutor_requests_table_for_is_subscribed_payment', 38),
(58, '2020_12_24_164105_alter_meeting_sessions_table_for_columns', 39),
(59, '2020_12_24_170952_alter_meeting_sessions_table_for_zoom_id', 40),
(60, '2020_12_27_222701_create_tutor_payouts_table', 41),
(61, '2020_12_27_225744_alter_tutor_payouts_table_for_hours', 42),
(62, '2020_12_27_233538_alter_tutor_profiles_table_for_columns', 43),
(63, '2020_12_28_103011_create_stripe_transfers_table', 44),
(65, '2020_12_28_144146_create_conversations_table', 45),
(66, '2020_12_28_174010_create_messages_table', 45),
(67, '2020_12_28_174501_alter_messages_table_for_user_id', 46),
(68, '2020_12_31_145200_alter_meeting_sessions_for_add_refund_request', 47),
(69, '2020_12_31_151655_alter_meeting_sessions_for_add_session_id', 47),
(70, '2020_12_31_162130_alter_tutor_payouts_for_drop_status', 47),
(72, '2020_12_31_162237_alter_tutor_payouts_for_add_status_with_cancel', 48),
(73, '2021_01_04_111621_alter_tutor_profiles_table_for_status', 49),
(74, '2021_01_11_161500_alter_users_table_for_time_zone_nullable', 50),
(75, '2021_01_11_170027_alter_tutor_profiles_table_for_drop_column', 51),
(78, '2021_01_15_121329_alter_packages_table_for_changing_column_type', 52);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hours` int(11) NOT NULL,
  `per_hour_amount` double NOT NULL,
  `total_amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `hours`, `per_hour_amount`, `total_amount`, `created_at`, `updated_at`, `description`) VALUES
(1, 'Pro', 10, 35, 350, '2020-12-22 05:26:35', '2020-12-22 05:31:52', '<p>20&nbsp;Hours</p>\r\n\r\n<p>Unlimited&nbsp;Tutors</p>\r\n\r\n<p>Email&nbsp;Support</p>\r\n\r\n<p>Lifetime&nbsp;updates</p>'),
(2, 'Plus', 20, 34, 680, '2020-12-22 05:32:19', '2020-12-22 05:32:19', '<p>20&nbsp;Hours</p>\r\n\r\n<p>Unlimited&nbsp;Tutors</p>\r\n\r\n<p>Email&nbsp;Support</p>\r\n\r\n<p>Lifetime&nbsp;updates</p>'),
(3, 'Premium', 25, 30.5, 762.5, '2020-12-22 05:32:42', '2021-01-15 07:22:24', '<p>25 Hours</p>\r\n\r\n<p>Unlimited&nbsp;Tutors</p>\r\n\r\n<p>Email&nbsp;Support</p>\r\n\r\n<p>Lifetime&nbsp;updates</p>');

-- --------------------------------------------------------

--
-- Table structure for table `parent_profiles`
--

CREATE TABLE `parent_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `profile_photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parent_profiles`
--

INSERT INTO `parent_profiles` (`id`, `profile_photo`, `phone`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'default.png', '03077839212', 10, '2020-11-17 19:00:00', '2020-11-18 07:32:27'),
(2, 'default.png', '03069387974', 11, '2020-11-24 05:56:03', '2020-11-24 05:56:03'),
(3, 'default.png', '03017476025', 12, '2020-11-24 05:59:15', '2020-11-24 05:59:15');

-- --------------------------------------------------------

--
-- Table structure for table `parent_students`
--

CREATE TABLE `parent_students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_dob` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parent_students`
--

INSERT INTO `parent_students` (`id`, `student_name`, `student_dob`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Ali', '1998/10/19', 10, '2020-11-17 19:00:00', '2020-11-18 07:33:56'),
(2, 'Fuzail', '2004/11/15', 10, '2020-11-17 19:00:00', '2020-11-17 19:00:00'),
(3, 'Zain Ch', '1995/03/16', 11, '2020-11-24 05:56:03', '2020-11-24 05:56:03'),
(4, 'Anum Ch', '1996/08/14', 11, '2020-11-24 05:56:03', '2020-11-24 05:56:03'),
(5, 'Ezza Ch', '1998/06/11', 11, '2020-11-24 05:56:03', '2020-11-24 05:56:03'),
(6, 'Umar Ch', '2000/08/23', 11, '2020-11-24 05:56:03', '2020-11-24 05:56:03'),
(7, 'Taimoor', '1995/09/20', 12, '2020-11-24 05:59:15', '2020-11-24 05:59:15');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slot` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `tutor_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','cancelled','approved','active') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `meeting_session_id` bigint(20) UNSIGNED NOT NULL,
  `rating` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `review` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('q1hG2LtCbRSzmUVTUPfSBs2zHdpZXrNRJc5PSbRf', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZEpGUFFYejJ5SGlDbHZjT1pLV2tDbG5HRGQzcDZoN3V3MFc3dE9PZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMCRaMlNjRzlvQjV0bTc1NUswNHI5dkpPaWNGRDZLeS43d3ZaYlNFT1ZtaHlkdm9KYmUwYlgzQyI7fQ==', 1610697990),
('R6eNpDl0ThU65q99rxkkzcprOCtC6EU6yNe2mXMC', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:84.0) Gecko/20100101 Firefox/84.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiYTBhanpOa1dJalpFeExIWEtUUWl0dFdOUmRFMVJDcG5LenluTGw2TyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1610699280);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `setting` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `setting`, `created_at`, `updated_at`) VALUES
(1, 'phone', '(780) 974-6481', '2020-10-19 22:19:21', '2020-10-19 22:19:21'),
(2, 'email', 'hello@toontutors.ca', '2020-10-19 22:19:21', '2020-10-19 22:19:21'),
(3, 'web', 'toontutors.ca', '2020-10-19 22:19:21', '2020-10-19 22:19:21'),
(4, 'facebook', 'toontutor.fb.com', '2020-10-19 22:19:21', '2020-10-19 22:19:21'),
(5, 'instagram', 'toontutor.instagram.com', '2020-10-19 22:19:21', '2020-10-19 22:19:21'),
(6, 'banner_heading', 'Affordable & Personalized Tutoring', '2020-10-19 22:19:21', '2020-10-19 22:19:21'),
(7, 'banner_sub_heading', 'Revolutionizing education. One student at a time.', '2020-10-19 22:19:21', '2020-10-19 22:19:21'),
(8, 'section_3_title', 'We are a Canadian tutoring company that matches every student with an experienced tutor who best fits the individual student’s needs.', '2020-10-19 22:19:21', '2020-10-19 22:19:21'),
(9, 'section_3_description', 'We believe that learning should be a fun process—we do this by having the tutors close in age to the students.  Our tutors are effective because of their recent knowledge and experience with the school curriculum.', '2020-10-19 22:19:21', '2020-10-19 22:19:21'),
(10, 'section_4_first_title', 'Online Tutoring', '2020-10-19 22:19:22', '2020-10-19 22:19:22'),
(11, 'section_4_first_description', 'We believe that learning should be a fun process—we do this by having the tutors close in age to the students.', '2020-10-19 22:19:22', '2020-10-19 22:19:22'),
(12, 'section_4_second_title', 'Group Tutoring', '2020-10-19 22:19:22', '2020-10-19 22:19:22'),
(13, 'section_4_second_description', 'We believe that learning should be a fun process—we do this by having the tutors close in age to the students.', '2020-10-19 22:19:22', '2020-10-19 22:19:22'),
(14, 'section_4_third_title', 'Package Tutoring', '2020-10-19 22:19:22', '2020-10-19 22:19:22'),
(15, 'section_4_third_description', 'We believe that learning should be a fun process—we do this by having the tutors close in age to the students.', '2020-10-19 22:19:22', '2020-10-19 22:19:22'),
(16, 'section_5_first_title', 'Tell Us Where You Need Help', '2020-10-19 22:19:22', '2020-10-19 22:19:22'),
(17, 'section_5_first_description', 'We believe that learning should be a fun process—we do this by having the tutors close in age to the students.', '2020-10-19 22:19:22', '2020-10-19 22:19:22'),
(18, 'section_5_second_title', 'Choose The Tutor You Want', '2020-10-19 22:19:22', '2020-10-19 22:19:22'),
(19, 'section_5_second_description', 'We believe that learning should be a fun process—we do this by having the tutors close in age to the students.', '2020-10-19 22:19:22', '2020-10-19 22:19:22'),
(20, 'section_5_third_title', 'Book A Tutor Start Lesson', '2020-10-19 22:19:22', '2020-10-19 22:19:22'),
(21, 'section_5_third_description', 'We believe that learning should be a fun process—we do this by having the tutors close in age to the students.', '2020-10-19 22:19:22', '2020-10-19 22:19:22'),
(22, 'call_us', '(780) 974-6481', '2020-10-19 22:19:22', '2020-10-19 22:19:22'),
(23, 'question', 'How can i get help by inbound marketing??', '2020-10-19 22:19:22', '2020-10-19 22:19:22'),
(24, 'question_sub_heading', 'Our staff can help you with the process of becoming a tutor', '2020-10-19 22:19:22', '2020-10-19 22:19:22'),
(25, 'commission_amount', '120', '2020-10-19 22:19:32', '2020-10-19 22:19:32');

-- --------------------------------------------------------

--
-- Table structure for table `stripe_transfers`
--

CREATE TABLE `stripe_transfers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stripe_transfer_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `tutor_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_profiles`
--

CREATE TABLE `student_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `profile_photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_profiles`
--

INSERT INTO `student_profiles` (`id`, `profile_photo`, `phone`, `dob`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'student/student/1605510600-profile-photo', '03069387974', '11/04/2020 5:26 PM', 9, '2020-11-07 07:26:45', '2020-11-17 05:59:36'),
(2, 'student/huzaifa/1610366909-profile-photo', NULL, '2008/08/07', 13, '2020-11-24 08:55:17', '2021-01-11 12:08:29'),
(3, 'default.png', NULL, '1998/10/19', 16, '2021-01-14 09:39:47', '2021-01-14 09:39:47'),
(4, 'default.png', NULL, '1998/10/19', 17, '2021-01-14 09:58:28', '2021-01-14 09:58:28'),
(5, 'default.png', NULL, '233432', 18, '2021-01-26 06:40:18', '2021-01-26 06:40:18');

-- --------------------------------------------------------

--
-- Table structure for table `subscribe_plans`
--

CREATE TABLE `subscribe_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `card_holder_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_hour` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remaining_hour` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('active','disabled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscribe_plans`
--

INSERT INTO `subscribe_plans` (`id`, `user_id`, `card_holder_name`, `total_hour`, `remaining_hour`, `amount`, `created_at`, `updated_at`, `package_id`, `status`) VALUES
(1, 13, 'mirza alisam', '20', '18', '680', '2020-12-29 10:34:04', '2021-01-14 07:54:13', 2, 'active'),
(2, 16, 'Testing Student', '25', '25', '750', '2021-01-14 09:42:43', '2021-01-14 09:42:43', 3, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_plan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscription_items`
--

CREATE TABLE `subscription_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subscription_id` bigint(20) UNSIGNED NOT NULL,
  `stripe_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_plan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `time_tables`
--

CREATE TABLE `time_tables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tutor_id` bigint(20) UNSIGNED NOT NULL,
  `day` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_closed` tinyint(1) NOT NULL DEFAULT 0,
  `from` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `time_tables`
--

INSERT INTO `time_tables` (`id`, `tutor_id`, `day`, `is_closed`, `from`, `to`, `created_at`, `updated_at`) VALUES
(57, 15, 'Monday', 0, '09:00am', '02:00pm', '2021-01-04 10:33:40', '2021-01-04 10:33:40'),
(58, 15, 'Tuesday', 0, '09:00am', '02:00pm', '2021-01-04 10:33:40', '2021-01-04 10:33:40'),
(59, 15, 'Wednesday', 0, '09:00am', '02:00pm', '2021-01-04 10:33:40', '2021-01-04 10:33:40'),
(60, 15, 'Thursday', 0, '09:00am', '02:00pm', '2021-01-04 10:33:40', '2021-01-04 10:33:40'),
(61, 15, 'Friday', 0, '09:00am', '02:00pm', '2021-01-04 10:33:40', '2021-01-04 10:33:40'),
(62, 15, 'Saturday', 1, NULL, NULL, '2021-01-04 10:33:40', '2021-01-04 10:33:40'),
(63, 15, 'Sunday', 1, NULL, NULL, '2021-01-04 10:33:40', '2021-01-04 10:33:40'),
(120, 14, 'Monday', 0, '9:00 AM', '2:00 PM', '2021-01-13 11:53:05', '2021-01-13 11:53:05'),
(121, 14, 'Tuesday', 0, '9:00 AM', '2:00 PM', '2021-01-13 11:53:05', '2021-01-13 11:53:05'),
(122, 14, 'Wednesday', 0, '9:00 AM', '2:00 PM', '2021-01-13 11:53:05', '2021-01-13 11:53:05'),
(123, 14, 'Thursday', 0, '9:00 AM', '2:00 PM', '2021-01-13 11:53:05', '2021-01-13 11:53:05'),
(124, 14, 'Friday', 0, '9:00 AM', '2:00 PM', '2021-01-13 11:53:05', '2021-01-13 11:53:05'),
(125, 14, 'Saturday', 0, '9:00 AM', '2:00 PM', '2021-01-13 11:53:05', '2021-01-13 11:53:05'),
(126, 14, 'Sunday', 1, NULL, NULL, '2021-01-13 11:53:05', '2021-01-13 11:53:05');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stripe_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `tutor_request_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `stripe_id`, `amount`, `tutor_request_id`, `created_at`, `updated_at`) VALUES
(2, 'ch_1HoTrOFIQnHdLDIG88vGpoXE', 10.00, 16, '2020-11-17 13:04:39', '2020-11-17 13:04:39'),
(3, 'ch_1HokkSFIQnHdLDIGeDUxkLTx', 5.00, 17, '2020-11-18 07:06:36', '2020-11-18 07:06:36'),
(4, 'ch_1HpUY5FIQnHdLDIGNW1yI1XL', 5.00, 18, '2020-11-20 08:00:55', '2020-11-20 08:00:55'),
(5, 'ch_1HpYPqFIQnHdLDIGOjWTmi4c', 5.00, 19, '2020-11-20 12:08:40', '2020-11-20 12:08:40'),
(9, 'ch_1Hqza9FIQnHdLDIG1G7jXa5z', 10.00, 23, '2020-11-24 11:21:14', '2020-11-24 11:21:14'),
(10, 'ch_1HrzlTFIQnHdLDIGhwkEm4ZC', 10.00, 24, '2020-11-27 05:45:05', '2020-11-27 05:45:05'),
(20, 'ch_1Hu9hYFIQnHdLDIGXBISTmr7', 10.00, 34, '2020-12-03 04:45:56', '2020-12-03 04:45:56'),
(21, 'ch_1I198PFIQnHdLDIGmBtTNMPx', 10.00, 38, '2020-12-22 11:34:35', '2020-12-22 11:34:35');

-- --------------------------------------------------------

--
-- Table structure for table `tutor_payouts`
--

CREATE TABLE `tutor_payouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tutor_id` bigint(20) UNSIGNED NOT NULL,
  `meeting_session_id` bigint(20) UNSIGNED NOT NULL,
  `hours` int(11) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `status` enum('due','cleared','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'due',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tutor_profiles`
--

CREATE TABLE `tutor_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `profile_photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subjects` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover_letter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resume` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currently_enrolled` tinyint(1) DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `availability` enum('morning','evening') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'morning',
  `hourly_rate` int(11) NOT NULL DEFAULT 0,
  `stripe_account` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_boarded` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('pending','approved') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tutor_profiles`
--

INSERT INTO `tutor_profiles` (`id`, `profile_photo`, `phone`, `video_url`, `dob`, `subjects`, `cover_letter`, `resume`, `currently_enrolled`, `user_id`, `created_at`, `updated_at`, `country`, `bio`, `availability`, `hourly_rate`, `stripe_account`, `is_boarded`, `status`) VALUES
(1, 'tutor/shahzad-ahmed/1604742411-profile-photo', '090078601', 'http://127.0.0.1:8000/our-tutors', '11/09/2020 2:46 PM', 'OS', NULL, NULL, 0, 2, '2020-11-07 04:46:51', '2020-11-18 06:08:00', 'Pakistan', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.', 'morning', 5, NULL, 0, 'approved'),
(2, 'tutor/ajay-devgun/1604742801-profile-photo', '090012345678', 'http://127.0.0.1:8000/our-tutors', '11/30/2020 2:52 PM', 'DBA', NULL, NULL, 0, 3, '2020-11-07 04:53:21', '2020-11-07 04:53:21', 'Nigeria', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum eos cum in corporis sapiente laborum asperiores esse impedit consequatur.', 'evening', 5, NULL, 0, 'pending'),
(3, 'tutor/kajol/1604743315-profile-photo', '090012345678', 'http://127.0.0.1:8000/our-tutors', '11/23/2020 3:00 PM', 'Web', NULL, NULL, 0, 4, '2020-11-07 05:01:55', '2020-11-07 05:01:55', 'India', 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system.', 'morning', 5, NULL, 0, 'pending'),
(5, 'tutor/arslan-khan/1604743433-profile-photo', '090012345678', 'http://127.0.0.1:8000/our-tutors', '11/07/2020 3:03 PM', 'DBA', NULL, NULL, 0, 6, '2020-11-07 05:03:53', '2020-11-07 05:03:53', 'Oman', 'You how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system.', 'evening', 5, NULL, 0, 'pending'),
(6, 'tutor/oktai-khan/1604743547-profile-photo', '090012345678', 'http://127.0.0.1:8000', '11/09/2020 3:05 PM', 'English', NULL, NULL, 0, 7, '2020-11-07 05:05:47', '2020-11-07 05:05:47', 'Oman', 'This mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system.', 'morning', 5, NULL, 0, 'pending'),
(7, 'tutor/halaku-khan/1604743614-profile-photo', '090012345678', 'http://127.0.0.1:8000', '11/18/2020 3:06 PM', 'Computer', NULL, NULL, 0, 8, '2020-11-07 05:06:54', '2021-01-04 07:27:15', 'India', 'Denouncing pleasure and praising pain was born and I will give you a complete account of the system.', 'morning', 5, NULL, 0, 'pending'),
(8, 'tutor/mirza-taimoor/1610366869-profile-photo', '03336114474', 'www.youtube.com', NULL, 'Biology', 'tutor/mirza-taimoor/1606209136-cover-letter', 'tutor/mirza-taimoor/1606209136-resume', 0, 14, '2020-11-24 09:12:16', '2021-01-11 12:07:49', 'Pakistan', 'Hello, my name is Mirza Taimoor. I am currently working as a freelancer teacher.', 'morning', 10, 'acct_1I3DkLGpTGr0OgHU', 0, 'approved'),
(9, 'tutor/mirza-ali/1609747642-profile-photo', '03069387974', 'www.google.com', '2021/01/12', 'Biology', NULL, NULL, 0, 15, '2021-01-04 08:07:22', '2021-01-04 11:10:11', 'Pakistan', 'Hello my name is Ali', 'morning', 10, 'acct_1I5qsb2Yv6Sf8NeT', 1, 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `tutor_requests`
--

CREATE TABLE `tutor_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interval` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '1. One Time 2. Recurring',
  `no_of_weeks` int(11) DEFAULT NULL,
  `remaining_weeks` int(11) DEFAULT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slot` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_in_min` int(11) NOT NULL DEFAULT 0,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `tutor_id` bigint(20) UNSIGNED NOT NULL,
  `parent_student_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('pending','cancelled','approved','active') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `class_status` enum('pending','completed','cancelled') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` tinyint(1) NOT NULL DEFAULT 0,
  `amount` double(8,2) NOT NULL DEFAULT 0.00,
  `amount_paid` double(8,2) NOT NULL DEFAULT 0.00,
  `amount_reserved` double(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_subscribed_payment` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tutor_requests`
--

INSERT INTO `tutor_requests` (`id`, `message`, `interval`, `no_of_weeks`, `remaining_weeks`, `date`, `active_date`, `slot`, `time_in_min`, `student_id`, `tutor_id`, `parent_student_id`, `status`, `class_status`, `payment_status`, `amount`, `amount_paid`, `amount_reserved`, `created_at`, `updated_at`, `is_subscribed_payment`) VALUES
(16, 'Hello Baby', '1', NULL, NULL, '', NULL, '2020/11/18 18:04', 0, 9, 2, NULL, 'approved', NULL, 0, 0.00, 0.00, 0.00, '2020-11-17 13:04:39', '2020-11-17 13:05:20', 0),
(17, 'Hello i need it right now', '1', NULL, NULL, '', NULL, '2020/11/18 12:15', 0, 9, 4, NULL, 'approved', NULL, 0, 0.00, 0.00, 0.00, '2020-11-18 07:06:36', '2020-11-18 07:14:16', 0),
(18, 'Helloo ji', '1', NULL, NULL, '2020/11/20', NULL, '4:30pm-5:00pm', 30, 9, 2, NULL, 'approved', '', 0, 0.00, 0.00, 0.00, '2020-11-20 08:00:55', '2020-11-20 11:40:53', 0),
(19, 'Hello h', '1', NULL, NULL, '2020/11/21', NULL, '09:00am-09:30am, 09:30am-10:00am', 60, 9, 2, NULL, 'cancelled', NULL, 0, 0.00, 0.00, 0.00, '2020-11-20 12:08:40', '2020-11-20 12:34:46', 0),
(23, 'Hello tutor', '1', NULL, NULL, '2020/11/25', NULL, '12:00pm-12:30pm, 12:30pm-01:00pm', 60, 13, 14, NULL, 'cancelled', 'cancelled', 0, 0.00, 0.00, 0.00, '2020-11-24 11:21:14', '2020-12-02 20:23:14', 0),
(24, 'Hellllo jiiaiai', '1', NULL, NULL, '2020/11/30', NULL, '10:00am-10:30am, 10:30am-11:00am', 60, 13, 14, NULL, 'cancelled', 'cancelled', 0, 0.00, 0.00, 0.00, '2020-11-27 05:45:05', '2020-12-03 04:51:38', 0),
(34, 'Helllooooo', '2', 5, 5, '2020/12/03', '2020/12/03', '11:30am-12:00am, 12:00am-12:30am', 60, 13, 14, NULL, 'cancelled', 'cancelled', 1, 50.00, 10.00, 40.00, '2020-12-03 04:45:56', '2020-12-03 05:59:32', 0),
(36, 'Hello i need it', '2', 3, 3, '2020/12/23', '2020/12/23', '09:00am-09:30am, 09:30am-10:00am, 10:00am-10:30am, 10:30am-11:00am, 11:00am-11:30am, 11:30am-12:00pm', 180, 13, 14, NULL, 'cancelled', 'cancelled', 1, 10.00, 10.00, 0.00, '2020-12-22 10:30:48', '2020-12-22 10:36:40', 0),
(37, 'Hoele', '2', 3, 3, '2020/12/22', '2020/12/22', '09:30am-10:00am, 10:00am-10:30am, 10:30am-11:00am, 11:00am-11:30am', 120, 13, 14, NULL, 'cancelled', 'cancelled', 1, 10.00, 10.00, 0.00, '2020-12-22 10:40:04', '2020-12-22 11:11:37', 0),
(38, 'ddfsdf', '2', 3, 3, '2020/12/23', '2020/12/23', '09:30am-10:00am, 10:00am-10:30am, 10:30am-11:00am, 11:00am-11:30am', 120, 13, 14, NULL, 'cancelled', 'cancelled', 1, 30.00, 10.00, 20.00, '2020-12-22 11:34:35', '2020-12-22 11:34:55', 0),
(39, 'Hello ji', '2', 3, 2, '2020/12/22', '2020/12/29', '04:30pm-05:00pm, 05:00pm-06:30pm, 06:30pm-07:00pm, 07:00pm-07:30pm', 120, 13, 14, NULL, 'approved', 'pending', 1, 10.00, 10.00, 0.00, '2020-12-22 11:42:39', '2020-12-22 11:56:03', 0),
(40, 'Hello sir', '1', NULL, NULL, '2021/01/05', '2021/01/05', '10:00am-10:30am, 10:30am-11:00am', 60, 13, 15, NULL, 'approved', 'pending', 1, 10.00, 10.00, 0.00, '2021-01-04 10:33:57', '2021-01-04 10:34:13', 1),
(43, 'Sir Class Ly Lyn Please', '1', NULL, NULL, '2021/01/14', '2021/01/14', '01:00pm-01:30pm, 01:30pm-02:00pm', 60, 13, 14, NULL, 'approved', 'pending', 1, 10.00, 10.00, 0.00, '2021-01-14 07:54:12', '2021-01-14 07:56:05', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','student','parent','tutor') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'student',
  `time_zone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stripe_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_brand` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_last_four` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `calendar_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `role`, `time_zone`, `remember_token`, `created_at`, `updated_at`, `stripe_id`, `card_brand`, `card_last_four`, `trial_ends_at`, `calendar_id`) VALUES
(1, 'Admin', 'admin@toontutors.com', '2020-08-07 12:00:00', '$2y$10$Z2ScG9oB5tm755K04r9vJOicFD6Ky.7wvZbSEOVmhydvoJbe0bX3C', NULL, NULL, 'admin', '', NULL, '2020-11-07 03:37:42', '2020-11-07 03:37:42', NULL, NULL, NULL, NULL, NULL),
(2, 'Shahzad Ahmed', 'shahzad@gmail.com', '2021-02-02 06:33:34', '$2y$10$Z2ScG9oB5tm755K04r9vJOicFD6Ky.7wvZbSEOVmhydvoJbe0bX3C', NULL, NULL, 'tutor', '', NULL, '2020-11-07 04:46:51', '2020-11-27 05:32:57', NULL, NULL, NULL, NULL, '75jdmei3dudnosmkto9trjstds@group.calendar.google.com'),
(3, 'Ajay Devgun', 'ajay@gmail.com', NULL, '$2y$10$Z2ScG9oB5tm755K04r9vJOicFD6Ky.7wvZbSEOVmhydvoJbe0bX3C', NULL, NULL, 'tutor', '', NULL, '2020-11-07 04:53:21', '2020-11-07 04:53:21', NULL, NULL, NULL, NULL, NULL),
(4, 'Kajol', 'kajol@gmail.com', NULL, '$2y$10$Z2ScG9oB5tm755K04r9vJOicFD6Ky.7wvZbSEOVmhydvoJbe0bX3C', NULL, NULL, 'tutor', '', NULL, '2020-11-07 05:01:55', '2020-11-07 05:01:55', NULL, NULL, NULL, NULL, NULL),
(6, 'Arslan Khan', 'arslan@gmail.com', NULL, '$2y$10$Z2ScG9oB5tm755K04r9vJOicFD6Ky.7wvZbSEOVmhydvoJbe0bX3C', NULL, NULL, 'tutor', '', NULL, '2020-11-07 05:03:53', '2020-11-07 05:03:53', NULL, NULL, NULL, NULL, NULL),
(7, 'Oktai Khan', 'oktai@gmail.com', NULL, '$2y$10$Z2ScG9oB5tm755K04r9vJOicFD6Ky.7wvZbSEOVmhydvoJbe0bX3C', NULL, NULL, 'tutor', '', NULL, '2020-11-07 05:05:47', '2020-11-07 05:05:47', NULL, NULL, NULL, NULL, NULL),
(8, 'Halaku Khan', 'halaku@gmail.com', NULL, '$2y$10$Z2ScG9oB5tm755K04r9vJOicFD6Ky.7wvZbSEOVmhydvoJbe0bX3C', NULL, NULL, 'tutor', '', NULL, '2020-11-07 05:06:54', '2020-11-07 05:06:54', NULL, NULL, NULL, NULL, NULL),
(9, 'Student', 'student@gmail.com', NULL, '$2y$10$Z2ScG9oB5tm755K04r9vJOicFD6Ky.7wvZbSEOVmhydvoJbe0bX3C', NULL, NULL, 'student', '', NULL, '2020-11-07 07:26:45', '2020-11-12 23:21:07', 'cus_INf6h9Ez1bLq0s', 'visa', '4242', NULL, NULL),
(10, 'Mirza Yameen', 'yameen@gmail.com', NULL, '$2y$10$VzOH2k0RFdG3B/fWyvcaIeYpECJqwQFW8n4ZgCgCc4aNbLfuK0NO.', NULL, NULL, 'parent', '', NULL, '2020-11-17 06:28:44', '2020-11-17 06:28:44', NULL, NULL, NULL, NULL, NULL),
(11, 'Ch Naveed', 'naveed@gmail.com', NULL, '$2y$10$TF2Hw12AhURqz14iyMAD5eALIPvFRSjYiWQ9NDoQHRigpWjyZuSd2', NULL, NULL, 'parent', '', NULL, '2020-11-24 05:56:03', '2020-11-24 05:56:03', NULL, NULL, NULL, NULL, NULL),
(12, 'Yaseen', 'yaseen@gmail.com', NULL, '$2y$10$FlTd5zyQDcXakNwI.kzDT.b/3rGDeENDZk53n9GMgQ1qZ.glEcQNK', NULL, NULL, 'parent', '', NULL, '2020-11-24 05:59:15', '2020-11-24 05:59:15', NULL, NULL, NULL, NULL, NULL),
(13, 'Huzaifa', 'huzaifa@gmail.com', NULL, '$2y$10$LN4gBlCvOWCy7SEYEUcjquPASfslHSpkQza.az08xt4Nd2ixv9dum', NULL, NULL, 'student', 'US/Mountain', NULL, '2020-11-24 08:55:17', '2021-01-13 11:51:07', NULL, NULL, NULL, NULL, NULL),
(14, 'Mirza Taimoor', 'taimoor@gmail.com', NULL, '$2y$10$1JTXk1DfSUjry/PBxsWFeepTMtM3OTLEiD3PIsaIuq1Ahi3MLLEjW', NULL, NULL, 'tutor', 'US/Mountain', NULL, '2020-11-24 09:12:16', '2021-01-13 11:50:26', NULL, NULL, NULL, NULL, '75jdmei3dudnosmkto9trjstds@group.calendar.google.com'),
(15, 'Mirza Ali', 'mali70162@gmail.com', NULL, '$2y$10$JyhrqmE9F17EiDPGfL814.qCDPF83rAOhYBOD1alHWueEGbLRwVei', NULL, NULL, 'tutor', 'Asia/Karachi', 'g209PQODgRZMdbmTF6zU8HjEtiHLoa7UYsUbVoSQJAXMvw5M34xd7zk1JOG5', '2021-01-04 08:07:22', '2021-01-04 10:23:21', NULL, NULL, NULL, NULL, NULL),
(16, 'Testing Student', 'demoproject.testing+13@gmail.com', NULL, '$2y$10$FZkbgyr9KrcWwOur5ceV8ef6YyrIAmU43uqTubXSHqiBwBVUe0RS2', NULL, NULL, 'student', 'America/Manaus', NULL, '2021-01-14 09:39:47', '2021-01-14 09:39:47', NULL, NULL, NULL, NULL, NULL),
(17, 'Testing Account 2', 'demoprojects.testing+4@gmail.com', NULL, '$2y$10$jTe9I83o/l1uqTMdWV8YZOdYboXDOnX3gFFCItD8tq.1F3bYenyCa', NULL, NULL, 'student', 'America/Manaus', NULL, '2021-01-14 09:58:28', '2021-01-14 09:58:28', NULL, NULL, NULL, NULL, NULL),
(18, 'kashif', 'kashif@gmail.com', NULL, '$2y$10$6/y8P157ASHRRVCS4S4STOKizIbQrSZUrlap0gigGjMJLYtzxVTki', NULL, NULL, 'student', 'US/Mountain', NULL, '2021-01-26 06:40:18', '2021-01-26 06:40:18', NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class_plans`
--
ALTER TABLE `class_plans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_plans_tutor_id_foreign` (`tutor_id`),
  ADD KEY `class_plans_student_id_foreign` (`student_id`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conversations_tutor_id_foreign` (`tutor_id`),
  ADD KEY `conversations_student_id_foreign` (`student_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `meeting_sessions`
--
ALTER TABLE `meeting_sessions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `meeting_sessions_zoom_id_unique` (`zoom_id`),
  ADD UNIQUE KEY `meeting_sessions_session_id_unique` (`session_id`),
  ADD KEY `meeting_sessions_tutor_id_foreign` (`tutor_id`),
  ADD KEY `meeting_sessions_student_id_foreign` (`student_id`),
  ADD KEY `meeting_sessions_tutor_request_id_foreign` (`tutor_request_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_conversation_id_foreign` (`conversation_id`),
  ADD KEY `messages_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parent_profiles`
--
ALTER TABLE `parent_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_profiles_user_id_foreign` (`user_id`);

--
-- Indexes for table `parent_students`
--
ALTER TABLE `parent_students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_students_parent_id_foreign` (`parent_id`);

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
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requests_student_id_foreign` (`student_id`),
  ADD KEY `requests_tutor_id_foreign` (`tutor_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_meeting_session_id_foreign` (`meeting_session_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stripe_transfers`
--
ALTER TABLE `stripe_transfers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stripe_transfers_tutor_id_foreign` (`tutor_id`);

--
-- Indexes for table `student_profiles`
--
ALTER TABLE `student_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_profiles_user_id_foreign` (`user_id`);

--
-- Indexes for table `subscribe_plans`
--
ALTER TABLE `subscribe_plans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscribe_plans_user_id_foreign` (`user_id`),
  ADD KEY `subscribe_plans_package_id_foreign` (`package_id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscriptions_user_id_stripe_status_index` (`user_id`,`stripe_status`);

--
-- Indexes for table `subscription_items`
--
ALTER TABLE `subscription_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscription_items_subscription_id_stripe_plan_unique` (`subscription_id`,`stripe_plan`),
  ADD KEY `subscription_items_stripe_id_index` (`stripe_id`);

--
-- Indexes for table `time_tables`
--
ALTER TABLE `time_tables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `time_tables_tutor_id_foreign` (`tutor_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_tutor_request_id_foreign` (`tutor_request_id`);

--
-- Indexes for table `tutor_payouts`
--
ALTER TABLE `tutor_payouts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tutor_payouts_tutor_id_foreign` (`tutor_id`),
  ADD KEY `tutor_payouts_meeting_session_id_foreign` (`meeting_session_id`);

--
-- Indexes for table `tutor_profiles`
--
ALTER TABLE `tutor_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tutor_profiles_user_id_foreign` (`user_id`);

--
-- Indexes for table `tutor_requests`
--
ALTER TABLE `tutor_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tutor_requests_student_id_foreign` (`student_id`),
  ADD KEY `tutor_requests_tutor_id_foreign` (`tutor_id`),
  ADD KEY `tutor_requests_parent_student_id_foreign` (`parent_student_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_stripe_id_index` (`stripe_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class_plans`
--
ALTER TABLE `class_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meeting_sessions`
--
ALTER TABLE `meeting_sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `parent_profiles`
--
ALTER TABLE `parent_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `parent_students`
--
ALTER TABLE `parent_students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `stripe_transfers`
--
ALTER TABLE `stripe_transfers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_profiles`
--
ALTER TABLE `student_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subscribe_plans`
--
ALTER TABLE `subscribe_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscription_items`
--
ALTER TABLE `subscription_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `time_tables`
--
ALTER TABLE `time_tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tutor_payouts`
--
ALTER TABLE `tutor_payouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tutor_profiles`
--
ALTER TABLE `tutor_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tutor_requests`
--
ALTER TABLE `tutor_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class_plans`
--
ALTER TABLE `class_plans`
  ADD CONSTRAINT `class_plans_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `class_plans_tutor_id_foreign` FOREIGN KEY (`tutor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `conversations`
--
ALTER TABLE `conversations`
  ADD CONSTRAINT `conversations_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `conversations_tutor_id_foreign` FOREIGN KEY (`tutor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `meeting_sessions`
--
ALTER TABLE `meeting_sessions`
  ADD CONSTRAINT `meeting_sessions_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `meeting_sessions_tutor_id_foreign` FOREIGN KEY (`tutor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `meeting_sessions_tutor_request_id_foreign` FOREIGN KEY (`tutor_request_id`) REFERENCES `tutor_requests` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_conversation_id_foreign` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `parent_profiles`
--
ALTER TABLE `parent_profiles`
  ADD CONSTRAINT `parent_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `parent_students`
--
ALTER TABLE `parent_students`
  ADD CONSTRAINT `parent_students_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `requests_tutor_id_foreign` FOREIGN KEY (`tutor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_meeting_session_id_foreign` FOREIGN KEY (`meeting_session_id`) REFERENCES `meeting_sessions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stripe_transfers`
--
ALTER TABLE `stripe_transfers`
  ADD CONSTRAINT `stripe_transfers_tutor_id_foreign` FOREIGN KEY (`tutor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_profiles`
--
ALTER TABLE `student_profiles`
  ADD CONSTRAINT `student_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subscribe_plans`
--
ALTER TABLE `subscribe_plans`
  ADD CONSTRAINT `subscribe_plans_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subscribe_plans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `time_tables`
--
ALTER TABLE `time_tables`
  ADD CONSTRAINT `time_tables_tutor_id_foreign` FOREIGN KEY (`tutor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_tutor_request_id_foreign` FOREIGN KEY (`tutor_request_id`) REFERENCES `tutor_requests` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tutor_payouts`
--
ALTER TABLE `tutor_payouts`
  ADD CONSTRAINT `tutor_payouts_meeting_session_id_foreign` FOREIGN KEY (`meeting_session_id`) REFERENCES `meeting_sessions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tutor_payouts_tutor_id_foreign` FOREIGN KEY (`tutor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tutor_profiles`
--
ALTER TABLE `tutor_profiles`
  ADD CONSTRAINT `tutor_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tutor_requests`
--
ALTER TABLE `tutor_requests`
  ADD CONSTRAINT `tutor_requests_parent_student_id_foreign` FOREIGN KEY (`parent_student_id`) REFERENCES `parent_students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tutor_requests_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tutor_requests_tutor_id_foreign` FOREIGN KEY (`tutor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
