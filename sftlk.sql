-- Хост: 127.0.0.1:3306
-- Время создания: Май 28 2018 г., 15:35
-- Версия сервера: 5.5.50-log
-- Версия PHP: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `sft-lk`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `applications`
--

CREATE TABLE IF NOT EXISTS `applications` (
  `id` int(10) unsigned NOT NULL,
  `applicator_id` int(10) unsigned NOT NULL,
  `consigneer_id` int(10) unsigned NOT NULL,
  `number` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `period` date NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `provider_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `applications`
--

INSERT INTO `applications` (`id`, `applicator_id`, `consigneer_id`, `number`, `period`, `status`, `provider_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '01/106-152', '2018-06-30', 'new', 1, '2018-05-28 04:35:30', '2018-05-28 04:35:30'),
(2, 2, 1, '01/122-166', '2018-06-30', 'new', 1, '2018-05-28 04:55:25', '2018-05-28 04:55:25'),
(3, 2, 1, '01/105-128', '2018-06-30', 'new', 1, '2018-05-28 04:59:37', '2018-05-28 04:59:37'),
(4, 6, 1, '01/156-142', '2018-06-30', 'new', 1, '2018-05-28 05:07:05', '2018-05-28 05:07:05'),
(5, 2, 1, '01/147-103', '2018-06-30', 'new', 1, '2018-05-28 05:20:11', '2018-05-28 05:20:11'),
(6, 2, 1, '01/106-171', '2018-06-30', 'new', 1, '2018-05-28 05:44:28', '2018-05-28 05:44:28'),
(7, 2, 1, '01/135-172', '2018-06-30', 'new', 1, '2018-05-28 05:56:08', '2018-05-28 05:56:08'),
(8, 2, 1, '01/163-152', '2018-06-30', 'new', 1, '2018-05-28 06:03:44', '2018-05-28 06:03:44'),
(9, 2, 1, '01/102-187', '2018-06-30', 'new', 1, '2018-05-28 07:03:58', '2018-05-28 07:03:58'),
(10, 2, 1, '01/161-122', '2018-06-30', 'new', 1, '2018-05-28 07:10:11', '2018-05-28 07:10:11'),
(11, 2, 2, '01/181-168', '2018-08-31', 'new', 1, '2018-05-28 07:31:33', '2018-05-28 07:31:33'),
(12, 2, 1, '01/145-168', '2018-06-30', 'new', 1, '2018-05-28 07:44:57', '2018-05-28 07:44:57'),
(13, 2, 2, '01/191-129', '2019-11-30', 'new', 1, '2018-05-28 08:03:40', '2018-05-28 08:03:40'),
(14, 2, 2, '01/112-183', '2018-06-30', 'new', 1, '2018-05-28 08:20:03', '2018-05-28 08:20:03'),
(15, 2, 1, '01/162-109', '2018-06-30', 'new', 1, '2018-05-28 08:25:09', '2018-05-28 08:25:09'),
(16, 2, 1, '01/101-191', '2018-06-30', 'new', 1, '2018-05-28 08:25:13', '2018-05-28 08:25:13'),
(17, 2, 1, '01/166-165', '2018-06-30', 'new', 1, '2018-05-28 08:28:05', '2018-05-28 08:28:05'),
(18, 2, 2, '01/117-200', '2018-06-30', 'new', 1, '2018-05-28 08:28:16', '2018-05-28 08:28:16'),
(19, 2, 1, '01/146-160', '2018-06-30', 'new', 1, '2018-05-28 08:29:09', '2018-05-28 08:29:09');

-- --------------------------------------------------------

--
-- Структура таблицы `applicators`
--

CREATE TABLE IF NOT EXISTS `applicators` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `counter_id` int(10) unsigned NOT NULL,
  `cooperation_id` int(10) unsigned NOT NULL,
  `link_1s` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `applicators`
--

INSERT INTO `applicators` (`id`, `user_id`, `counter_id`, `cooperation_id`, `link_1s`, `created_at`, `updated_at`) VALUES
(2, 2, 1, 2, NULL, NULL, '2018-05-28 04:24:41'),
(3, 3, 1, 3, NULL, NULL, '2018-05-27 14:58:26'),
(6, 6, 1, 3, NULL, '2018-05-25 03:05:16', '2018-05-28 04:13:33');

-- --------------------------------------------------------

--
-- Структура таблицы `consigneers`
--

CREATE TABLE IF NOT EXISTS `consigneers` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `INN` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KPP` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_time` date DEFAULT NULL,
  `roll_diameter` int(11) DEFAULT NULL,
  `core_diameter` int(11) DEFAULT NULL,
  `link_1s` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `counter_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `consigneers`
--

INSERT INTO `consigneers` (`id`, `name`, `address`, `INN`, `KPP`, `delivery_time`, `roll_diameter`, `core_diameter`, `link_1s`, `created_at`, `updated_at`, `counter_id`) VALUES
(1, 'Грузополучатель 1 Контрагента 1', 'Адрес Грузополучателя', '2343423433', '34343434', '2018-05-30', 50, 20, NULL, NULL, NULL, 1),
(2, 'Грузополучатель 2 Контрагента 1', 'Адрес Грузополучателя', '3647364736', '4545454', '2018-05-14', 40, 50, NULL, NULL, NULL, 1),
(3, 'Грузополучатель 3 Контрагента 1', 'Адрес Грузополучателя', '8923343433', '3343434', '2018-05-30', 50, 20, NULL, NULL, NULL, 1),
(4, 'Грузополучатель 1 Контрагента 2', 'Адрес Грузополучателя', '1343423433', '34343434', '2018-05-30', 50, 20, NULL, NULL, NULL, 2),
(5, 'Грузополучатель 2 Контрагента 2', 'Адрес Грузополучателя', '2647364736', '4545454', '2018-05-14', 40, 50, NULL, NULL, NULL, 2),
(6, 'Грузополучатель 3 Контрагента 2', 'Адрес Грузополучателя', '1923343433', '3343434', '2018-05-30', 50, 20, NULL, NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `consigneer_deliveries`
--

CREATE TABLE IF NOT EXISTS `consigneer_deliveries` (
  `id` int(10) unsigned NOT NULL,
  `consigneer_id` int(10) unsigned NOT NULL,
  `delivery_id` int(10) unsigned NOT NULL,
  `price` int(11) DEFAULT NULL,
  `link_1s` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `consigneer_deliveries`
--

INSERT INTO `consigneer_deliveries` (`id`, `consigneer_id`, `delivery_id`, `price`, `link_1s`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 10000, NULL, NULL, NULL),
(2, 1, 2, 30000, NULL, NULL, NULL),
(3, 1, 3, 40000, NULL, NULL, NULL),
(4, 1, 4, 50000, NULL, NULL, NULL),
(5, 2, 2, 35000, NULL, NULL, NULL),
(6, 2, 3, 40000, NULL, NULL, NULL),
(7, 2, 4, 45000, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `contactqueries`
--

CREATE TABLE IF NOT EXISTS `contactqueries` (
  `id` int(10) unsigned NOT NULL,
  `theme` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `querytext` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `link_1s` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `applicator_id` int(10) unsigned DEFAULT NULL,
  `file_id` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `contactqueries`
--

INSERT INTO `contactqueries` (`id`, `theme`, `querytext`, `created_at`, `updated_at`, `link_1s`, `applicator_id`, `file_id`) VALUES
(1, 'Изменение заявки', 'Новое обращение', '2018-05-25 02:13:19', '2018-05-25 02:13:19', NULL, NULL, NULL),
(2, 'Изменение заявки', 'Иыщвыв', '2018-05-25 02:17:28', '2018-05-25 02:17:28', NULL, NULL, NULL),
(3, 'Изменение заявки', 'ивоыаооыва', '2018-05-25 02:19:45', '2018-05-25 02:19:45', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `cooperations`
--

CREATE TABLE IF NOT EXISTS `cooperations` (
  `id` int(10) unsigned NOT NULL,
  `contract_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contract_period` date NOT NULL,
  `monthly_min_volume` int(11) NOT NULL,
  `monthly_max_volume` int(11) NOT NULL,
  `delayed_payment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `bonus` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_1s` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `counter_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `cooperations`
--

INSERT INTO `cooperations` (`id`, `contract_number`, `contract_period`, `monthly_min_volume`, `monthly_max_volume`, `delayed_payment`, `currency`, `description`, `bonus`, `link_1s`, `counter_id`, `created_at`, `updated_at`) VALUES
(1, '12345', '2018-05-23', 10, 50, '1', 'рубли', 'Условия сотрудничества 1 актуальные', 'нет', NULL, 1, NULL, NULL),
(2, '12345', '2018-05-14', 10, 50, '1', 'рубли', 'Условия сотрудничества 1 просрочены', 'нет', NULL, 1, NULL, NULL),
(3, '22222', '2018-05-25', 10, 20, '3', 'рубли', 'Условия сотрудничества 2 актуальные', 'нет', NULL, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `cooperation_productranges`
--

CREATE TABLE IF NOT EXISTS `cooperation_productranges` (
  `id` int(10) unsigned NOT NULL,
  `cooperation_id` int(10) unsigned NOT NULL,
  `productrange_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `counterparties`
--

CREATE TABLE IF NOT EXISTS `counterparties` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_1s` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `counters`
--

CREATE TABLE IF NOT EXISTS `counters` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `INN` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KPP` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requisites` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_1s` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `counterparty_id` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `counters`
--

INSERT INTO `counters` (`id`, `name`, `address`, `INN`, `KPP`, `requisites`, `link_1s`, `created_at`, `updated_at`, `counterparty_id`) VALUES
(1, 'Контрагент 1', 'Адрес контрагента 1', '111111111', '11111', 'Реквизиты контрагента 1', NULL, NULL, NULL, NULL),
(2, 'Контрагент 2', 'Адрес контрагента 2', '222222222', '22222', 'Реквизиты контрагента 2', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `deliveries`
--

CREATE TABLE IF NOT EXISTS `deliveries` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `deliveries`
--

INSERT INTO `deliveries` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'АВТО', NULL, NULL),
(2, 'ЖД', NULL, NULL),
(3, 'Авиа', NULL, NULL),
(4, 'Самовывоз', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `applicator_id` int(10) unsigned DEFAULT NULL,
  `admin_id` int(10) unsigned DEFAULT NULL,
  `lunit_id` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `lunits`
--

CREATE TABLE IF NOT EXISTS `lunits` (
  `id` int(10) unsigned NOT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `consigneer_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transportunits_info` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `volume_decada` tinyint(4) NOT NULL,
  `volume` int(11) NOT NULL,
  `plan_data` date NOT NULL,
  `shipment_data` date NOT NULL,
  `delivery_data` date NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(27, '2018_05_07_004948_create_users_table', 1),
(28, '2018_05_07_014529_create_counters_table', 1),
(29, '2018_05_07_060423_create_admins_table', 1),
(30, '2018_05_07_060630_create_counterparties_table', 1),
(31, '2018_05_07_064737_create_providers_table', 1),
(32, '2018_05_07_064840_create_deliveries_table', 1),
(33, '2018_05_07_072314_create_productranges_table', 1),
(34, '2018_05_07_072400_create_consigneers_table', 1),
(35, '2018_05_07_072500_create_cooperations_table', 1),
(36, '2018_05_07_072510_create_applicators_table', 1),
(37, '2018_05_07_072515_add_foreign_to_applicators', 1),
(38, '2018_05_07_072520_create_consigneer_deliveries_table', 1),
(39, '2018_05_07_074217_create_contactqueries_table', 1),
(40, '2018_05_07_132602_create_applications_table', 1),
(41, '2018_05_07_132800_create_product_applications_table', 1),
(42, '2018_05_07_133024_create_files_table', 1),
(43, '2018_05_08_054230_create_transportunits_table', 1),
(44, '2018_05_08_055725_create_lunits_table', 1),
(45, '2018_05_08_062032_add_foreign_to_contactqueries', 1),
(46, '2018_05_08_063655_add_foreign_counter_id_to_consigneers', 1),
(47, '2018_05_08_070607_add_foreign_to_files', 1),
(48, '2018_05_08_084156_add_foreign_counters_table', 1),
(49, '2018_05_18_170845_create_product_application_units_table', 1),
(50, '2018_05_18_171047_add_foreign_to_product_application_units', 1),
(51, '2018_05_18_183213_add_foreign_to_productranges', 1),
(52, '2018_05_21_051518_create_cooperation_productranges_table', 1),
(55, '2018_05_07_132700_create_order_applications_table', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `order_applications`
--

CREATE TABLE IF NOT EXISTS `order_applications` (
  `id` int(10) unsigned NOT NULL,
  `volume_1` int(11) DEFAULT NULL,
  `volume_2` int(11) DEFAULT NULL,
  `volume_3` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `productrange_id` int(10) unsigned NOT NULL,
  `application_id` int(10) unsigned NOT NULL,
  `consigneer_delivery_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `order_applications`
--

INSERT INTO `order_applications` (`id`, `volume_1`, `volume_2`, `volume_3`, `price`, `comment`, `productrange_id`, `application_id`, `consigneer_delivery_id`, `created_at`, `updated_at`) VALUES
(1, 10, NULL, 10, 200000, NULL, 1, 12, 1, '2018-05-28 07:48:42', '2018-05-28 07:48:42'),
(2, NULL, 20, NULL, 200000, NULL, 4, 12, 1, '2018-05-28 07:48:42', '2018-05-28 07:48:42'),
(3, 100, NULL, 10, 3850000, NULL, 1, 13, 5, '2018-05-28 08:13:07', '2018-05-28 08:13:07'),
(4, NULL, 10, NULL, 400000, NULL, 4, 13, 6, '2018-05-28 08:13:07', '2018-05-28 08:13:07'),
(5, 10, NULL, NULL, 350000, NULL, 1, 13, 5, '2018-05-28 08:17:02', '2018-05-28 08:17:02'),
(6, NULL, 10, NULL, 350000, NULL, 4, 13, 5, '2018-05-28 08:17:02', '2018-05-28 08:17:02'),
(7, NULL, NULL, 30, 300000, NULL, 2, 19, 1, '2018-05-28 08:29:20', '2018-05-28 08:29:20');

-- --------------------------------------------------------

--
-- Структура таблицы `productranges`
--

CREATE TABLE IF NOT EXISTS `productranges` (
  `id` int(10) unsigned NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grammage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `format` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `min_lot` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_1s` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `provider_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `productranges`
--

INSERT INTO `productranges` (`id`, `brand`, `grammage`, `format`, `price`, `min_lot`, `link_1s`, `created_at`, `updated_at`, `provider_id`) VALUES
(1, 'L1', '135', '2100', 0, '30', NULL, NULL, NULL, 1),
(2, 'L1', '200', '2100', 0, '50', NULL, NULL, NULL, 1),
(3, 'L2', '90', '2100', 0, '50', NULL, NULL, NULL, 2),
(4, 'L2', '90', '2100', 0, '50', NULL, NULL, NULL, 1),
(5, 'L2', '90', '2100', 0, '50', NULL, NULL, NULL, 3),
(6, 'L3', '80', '2200', 0, '30', NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `product_applications`
--

CREATE TABLE IF NOT EXISTS `product_applications` (
  `id` int(10) unsigned NOT NULL,
  `price` int(11) NOT NULL,
  `productrange_id` int(10) unsigned NOT NULL,
  `application_id` int(10) unsigned NOT NULL,
  `consigneer_delivery_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `product_application_units`
--

CREATE TABLE IF NOT EXISTS `product_application_units` (
  `id` int(10) unsigned NOT NULL,
  `unit_number` int(11) NOT NULL,
  `volume` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `volume_decada` tinyint(4) NOT NULL,
  `delivery_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_application_id` int(10) unsigned DEFAULT NULL,
  `lunits_id` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `providers`
--

CREATE TABLE IF NOT EXISTS `providers` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `counter_id` int(11) NOT NULL,
  `link_1s` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `providers`
--

INSERT INTO `providers` (`id`, `name`, `counter_id`, `link_1s`, `created_at`, `updated_at`) VALUES
(1, 'Поставщик 1', 1, NULL, NULL, NULL),
(2, 'Поставщик 2', 1, NULL, NULL, NULL),
(3, 'Поставщик 3', 1, NULL, NULL, NULL),
(4, 'Поставщик 1', 2, NULL, NULL, NULL),
(5, 'Поставщик 2', 2, NULL, NULL, NULL),
(6, 'Поставщик 3', 2, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `transportunits`
--

CREATE TABLE IF NOT EXISTS `transportunits` (
  `id` int(10) unsigned NOT NULL,
  `info` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_id` int(10) unsigned NOT NULL,
  `link_1s` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `lastName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middleName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passwordUntil` date DEFAULT NULL,
  `link_1s` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `lastName`, `firstName`, `middleName`, `email`, `phone`, `password`, `passwordUntil`, `link_1s`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Сидоров', 'Сергей', 'Петрович', 'stzv78@mail.ru', '+7(999) 99-99-92v', 'abcdef123', '2018-05-28', NULL, NULL, NULL, '2018-05-28 04:24:39'),
(3, 'Капустин', 'Иван', 'Федорович', 'rty@dhs.ru', '+7(999) 99-99-93', 'abcdeftyty', '2018-05-27', NULL, NULL, NULL, '2018-05-27 14:58:16'),
(6, 'Степчева', 'Зоя', 'Ивановна', 'sdssdsds@asasas.ru', '+79278287575', 'asasasasasasa', '2018-06-19', NULL, NULL, '2018-05-25 03:05:16', '2018-05-25 03:05:16');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Индексы таблицы `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `applications_number_unique` (`number`),
  ADD KEY `applications_applicator_id_foreign` (`applicator_id`),
  ADD KEY `applications_consigneer_id_foreign` (`consigneer_id`),
  ADD KEY `applications_provider_id_foreign` (`provider_id`);

--
-- Индексы таблицы `applicators`
--
ALTER TABLE `applicators`
  ADD PRIMARY KEY (`id`),
  ADD KEY `applicators_user_id_foreign` (`user_id`),
  ADD KEY `applicators_counter_id_foreign` (`counter_id`),
  ADD KEY `applicators_cooperation_id_foreign` (`cooperation_id`);

--
-- Индексы таблицы `consigneers`
--
ALTER TABLE `consigneers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `consigneers_inn_unique` (`INN`),
  ADD KEY `consigneers_counter_id_foreign` (`counter_id`);

--
-- Индексы таблицы `consigneer_deliveries`
--
ALTER TABLE `consigneer_deliveries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `consigneer_deliveries_consigneer_id_foreign` (`consigneer_id`),
  ADD KEY `consigneer_deliveries_delivery_id_foreign` (`delivery_id`);

--
-- Индексы таблицы `contactqueries`
--
ALTER TABLE `contactqueries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contactqueries_applicator_id_foreign` (`applicator_id`),
  ADD KEY `contactqueries_file_id_foreign` (`file_id`);

--
-- Индексы таблицы `cooperations`
--
ALTER TABLE `cooperations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cooperations_counter_id_foreign` (`counter_id`);

--
-- Индексы таблицы `cooperation_productranges`
--
ALTER TABLE `cooperation_productranges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cooperation_productranges_cooperation_id_foreign` (`cooperation_id`),
  ADD KEY `cooperation_productranges_productrange_id_foreign` (`productrange_id`);

--
-- Индексы таблицы `counterparties`
--
ALTER TABLE `counterparties`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `counters`
--
ALTER TABLE `counters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `counters_inn_unique` (`INN`),
  ADD KEY `counters_counterparty_id_foreign` (`counterparty_id`);

--
-- Индексы таблицы `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `files_applicator_id_foreign` (`applicator_id`),
  ADD KEY `files_admin_id_foreign` (`admin_id`),
  ADD KEY `files_lunit_id_foreign` (`lunit_id`);

--
-- Индексы таблицы `lunits`
--
ALTER TABLE `lunits`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_applications`
--
ALTER TABLE `order_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_applications_productrange_id_foreign` (`productrange_id`),
  ADD KEY `order_applications_application_id_foreign` (`application_id`),
  ADD KEY `order_applications_consigneer_delivery_id_foreign` (`consigneer_delivery_id`);

--
-- Индексы таблицы `productranges`
--
ALTER TABLE `productranges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productranges_provider_id_foreign` (`provider_id`);

--
-- Индексы таблицы `product_applications`
--
ALTER TABLE `product_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_applications_productrange_id_foreign` (`productrange_id`),
  ADD KEY `product_applications_application_id_foreign` (`application_id`),
  ADD KEY `product_applications_consigneer_delivery_id_foreign` (`consigneer_delivery_id`);

--
-- Индексы таблицы `product_application_units`
--
ALTER TABLE `product_application_units`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_application_units_product_application_id_foreign` (`product_application_id`),
  ADD KEY `product_application_units_lunits_id_foreign` (`lunits_id`);

--
-- Индексы таблицы `providers`
--
ALTER TABLE `providers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `transportunits`
--
ALTER TABLE `transportunits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transportunits_delivery_id_foreign` (`delivery_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT для таблицы `applicators`
--
ALTER TABLE `applicators`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `consigneers`
--
ALTER TABLE `consigneers`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `consigneer_deliveries`
--
ALTER TABLE `consigneer_deliveries`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `contactqueries`
--
ALTER TABLE `contactqueries`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `cooperations`
--
ALTER TABLE `cooperations`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `cooperation_productranges`
--
ALTER TABLE `cooperation_productranges`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `counterparties`
--
ALTER TABLE `counterparties`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `counters`
--
ALTER TABLE `counters`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `files`
--
ALTER TABLE `files`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `lunits`
--
ALTER TABLE `lunits`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT для таблицы `order_applications`
--
ALTER TABLE `order_applications`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `productranges`
--
ALTER TABLE `productranges`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `product_applications`
--
ALTER TABLE `product_applications`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `product_application_units`
--
ALTER TABLE `product_application_units`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `providers`
--
ALTER TABLE `providers`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `transportunits`
--
ALTER TABLE `transportunits`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_applicator_id_foreign` FOREIGN KEY (`applicator_id`) REFERENCES `applicators` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `applications_consigneer_id_foreign` FOREIGN KEY (`consigneer_id`) REFERENCES `consigneers` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `applications_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `providers` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `applicators`
--
ALTER TABLE `applicators`
  ADD CONSTRAINT `applicators_cooperation_id_foreign` FOREIGN KEY (`cooperation_id`) REFERENCES `cooperations` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `applicators_counter_id_foreign` FOREIGN KEY (`counter_id`) REFERENCES `counters` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `applicators_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `consigneers`
--
ALTER TABLE `consigneers`
  ADD CONSTRAINT `consigneers_counter_id_foreign` FOREIGN KEY (`counter_id`) REFERENCES `counters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `consigneer_deliveries`
--
ALTER TABLE `consigneer_deliveries`
  ADD CONSTRAINT `consigneer_deliveries_consigneer_id_foreign` FOREIGN KEY (`consigneer_id`) REFERENCES `consigneers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `consigneer_deliveries_delivery_id_foreign` FOREIGN KEY (`delivery_id`) REFERENCES `deliveries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `contactqueries`
--
ALTER TABLE `contactqueries`
  ADD CONSTRAINT `contactqueries_applicator_id_foreign` FOREIGN KEY (`applicator_id`) REFERENCES `applicators` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contactqueries_file_id_foreign` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `cooperations`
--
ALTER TABLE `cooperations`
  ADD CONSTRAINT `cooperations_counter_id_foreign` FOREIGN KEY (`counter_id`) REFERENCES `counters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `cooperation_productranges`
--
ALTER TABLE `cooperation_productranges`
  ADD CONSTRAINT `cooperation_productranges_cooperation_id_foreign` FOREIGN KEY (`cooperation_id`) REFERENCES `cooperations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cooperation_productranges_productrange_id_foreign` FOREIGN KEY (`productrange_id`) REFERENCES `productranges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `counters`
--
ALTER TABLE `counters`
  ADD CONSTRAINT `counters_counterparty_id_foreign` FOREIGN KEY (`counterparty_id`) REFERENCES `counterparties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `files_applicator_id_foreign` FOREIGN KEY (`applicator_id`) REFERENCES `applicators` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `files_lunit_id_foreign` FOREIGN KEY (`lunit_id`) REFERENCES `lunits` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `order_applications`
--
ALTER TABLE `order_applications`
  ADD CONSTRAINT `order_applications_consigneer_delivery_id_foreign` FOREIGN KEY (`consigneer_delivery_id`) REFERENCES `consigneer_deliveries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_applications_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_applications_productrange_id_foreign` FOREIGN KEY (`productrange_id`) REFERENCES `productranges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `productranges`
--
ALTER TABLE `productranges`
  ADD CONSTRAINT `productranges_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `providers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `product_applications`
--
ALTER TABLE `product_applications`
  ADD CONSTRAINT `product_applications_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_applications_consigneer_delivery_id_foreign` FOREIGN KEY (`consigneer_delivery_id`) REFERENCES `consigneer_deliveries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_applications_productrange_id_foreign` FOREIGN KEY (`productrange_id`) REFERENCES `productranges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `product_application_units`
--
ALTER TABLE `product_application_units`
  ADD CONSTRAINT `product_application_units_lunits_id_foreign` FOREIGN KEY (`lunits_id`) REFERENCES `lunits` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `product_application_units_product_application_id_foreign` FOREIGN KEY (`product_application_id`) REFERENCES `product_applications` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `transportunits`
--
ALTER TABLE `transportunits`
  ADD CONSTRAINT `transportunits_delivery_id_foreign` FOREIGN KEY (`delivery_id`) REFERENCES `deliveries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
