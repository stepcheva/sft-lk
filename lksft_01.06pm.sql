-- Adminer 4.3.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `applications`;
CREATE TABLE `applications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `applicator_id` int(10) unsigned NOT NULL,
  `consigneer_id` int(10) unsigned NOT NULL,
  `number` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `period` date NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `provider_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `applications_number_unique` (`number`),
  KEY `applications_applicator_id_foreign` (`applicator_id`),
  KEY `applications_consigneer_id_foreign` (`consigneer_id`),
  KEY `applications_provider_id_foreign` (`provider_id`),
  CONSTRAINT `applications_applicator_id_foreign` FOREIGN KEY (`applicator_id`) REFERENCES `applicators` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `applications_consigneer_id_foreign` FOREIGN KEY (`consigneer_id`) REFERENCES `consigneers` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `applications_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `providers` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `applications` (`id`, `applicator_id`, `consigneer_id`, `number`, `period`, `status`, `provider_id`, `created_at`, `updated_at`) VALUES
(1,	2,	1,	'01/153-186',	'2018-07-31',	'new',	1,	'2018-05-31 08:43:01',	'2018-05-31 08:43:01'),
(2,	2,	1,	'01/141-199',	'2018-07-31',	'new',	1,	'2018-05-31 13:32:18',	'2018-05-31 13:32:18'),
(3,	2,	1,	'01/181-138',	'2018-07-31',	'new',	1,	'2018-06-01 05:47:23',	'2018-06-01 05:47:23'),
(4,	4,	5,	'01/112-151',	'2018-07-31',	'new',	4,	'2018-06-01 07:05:35',	'2018-06-01 07:05:35'),
(5,	4,	5,	'01/146-192',	'2018-07-31',	'new',	4,	'2018-06-01 07:05:42',	'2018-06-01 07:05:42'),
(6,	4,	4,	'01/164-183',	'2018-07-31',	'new',	4,	'2018-06-01 07:05:46',	'2018-06-01 07:05:46'),
(7,	4,	4,	'01/108-119',	'2018-07-31',	'new',	4,	'2018-06-01 07:07:28',	'2018-06-01 07:07:28'),
(8,	4,	4,	'01/119-163',	'2018-07-31',	'new',	4,	'2018-06-01 07:07:36',	'2018-06-01 07:07:36'),
(9,	5,	7,	'01/192-184',	'2018-07-31',	'new',	7,	'2018-06-01 08:58:44',	'2018-06-01 08:58:44')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `applicator_id` = VALUES(`applicator_id`), `consigneer_id` = VALUES(`consigneer_id`), `number` = VALUES(`number`), `period` = VALUES(`period`), `status` = VALUES(`status`), `provider_id` = VALUES(`provider_id`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`);

DROP TABLE IF EXISTS `applicators`;
CREATE TABLE `applicators` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `counter_id` int(10) unsigned NOT NULL,
  `cooperation_id` int(10) unsigned NOT NULL,
  `link_1s` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `applicators_user_id_foreign` (`user_id`),
  KEY `applicators_counter_id_foreign` (`counter_id`),
  KEY `applicators_cooperation_id_foreign` (`cooperation_id`),
  CONSTRAINT `applicators_cooperation_id_foreign` FOREIGN KEY (`cooperation_id`) REFERENCES `cooperations` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `applicators_counter_id_foreign` FOREIGN KEY (`counter_id`) REFERENCES `counters` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `applicators_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `applicators` (`id`, `user_id`, `counter_id`, `cooperation_id`, `link_1s`, `created_at`, `updated_at`) VALUES
(1,	1,	1,	1,	NULL,	NULL,	NULL),
(2,	2,	1,	2,	NULL,	NULL,	NULL),
(3,	3,	2,	3,	NULL,	NULL,	NULL),
(4,	4,	2,	1,	NULL,	NULL,	NULL),
(5,	5,	3,	4,	NULL,	NULL,	NULL)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `user_id` = VALUES(`user_id`), `counter_id` = VALUES(`counter_id`), `cooperation_id` = VALUES(`cooperation_id`), `link_1s` = VALUES(`link_1s`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`);

DROP TABLE IF EXISTS `consigneers`;
CREATE TABLE `consigneers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `counter_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `consigneers_inn_unique` (`INN`),
  KEY `consigneers_counter_id_foreign` (`counter_id`),
  CONSTRAINT `consigneers_counter_id_foreign` FOREIGN KEY (`counter_id`) REFERENCES `counters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `consigneers` (`id`, `name`, `address`, `INN`, `KPP`, `delivery_time`, `roll_diameter`, `core_diameter`, `link_1s`, `created_at`, `updated_at`, `counter_id`) VALUES
(1,	'Грузополучатель 1 Контрагента 1',	'Адрес Грузополучателя',	'2343423433',	'34343434',	'2018-05-30',	50,	20,	NULL,	NULL,	NULL,	1),
(2,	'Грузополучатель 2 Контрагента 1',	'Адрес Грузополучателя',	'3647364736',	'4545454',	'2018-05-14',	40,	50,	NULL,	NULL,	NULL,	1),
(3,	'Грузополучатель 3 Контрагента 1',	'Адрес Грузополучателя',	'8923343433',	'3343434',	'2018-05-30',	50,	20,	NULL,	NULL,	NULL,	1),
(4,	'Грузополучатель 1 Контрагента 2',	'Адрес Грузополучателя',	'1343423433',	'34343434',	'2018-05-30',	50,	20,	NULL,	NULL,	NULL,	2),
(5,	'Грузополучатель 2 Контрагента 2',	'Адрес Грузополучателя',	'2647364736',	'4545454',	'2018-05-14',	40,	50,	NULL,	NULL,	NULL,	2),
(6,	'Грузополучатель 3 Контрагента 2',	'Адрес Грузополучателя',	'1923343433',	'3343434',	'2018-05-30',	50,	20,	NULL,	NULL,	NULL,	2),
(7,	'АО \"Фамадар Картона Лимитед\"',	'347927, Ростовская обл, Таганрог г, Поляковское ш, д. 16-а',	'6154069596 ',	'6154069596',	NULL,	NULL,	NULL,	NULL,	'2018-05-23 21:00:00',	'2018-05-23 21:00:00',	3)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `name` = VALUES(`name`), `address` = VALUES(`address`), `INN` = VALUES(`INN`), `KPP` = VALUES(`KPP`), `delivery_time` = VALUES(`delivery_time`), `roll_diameter` = VALUES(`roll_diameter`), `core_diameter` = VALUES(`core_diameter`), `link_1s` = VALUES(`link_1s`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `counter_id` = VALUES(`counter_id`);

DROP TABLE IF EXISTS `consigneer_deliveries`;
CREATE TABLE `consigneer_deliveries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `consigneer_id` int(10) unsigned NOT NULL,
  `delivery_id` int(10) unsigned NOT NULL,
  `price` int(11) DEFAULT NULL,
  `link_1s` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `productrange_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `consigneer_deliveries_consigneer_id_foreign` (`consigneer_id`),
  KEY `consigneer_deliveries_delivery_id_foreign` (`delivery_id`),
  KEY `consigneer_deliveries_productrange_id_foreign` (`productrange_id`),
  CONSTRAINT `consigneer_deliveries_consigneer_id_foreign` FOREIGN KEY (`consigneer_id`) REFERENCES `consigneers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `consigneer_deliveries_delivery_id_foreign` FOREIGN KEY (`delivery_id`) REFERENCES `deliveries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `consigneer_deliveries_productrange_id_foreign` FOREIGN KEY (`productrange_id`) REFERENCES `productranges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `consigneer_deliveries` (`id`, `consigneer_id`, `delivery_id`, `price`, `link_1s`, `created_at`, `updated_at`, `productrange_id`) VALUES
(1,	1,	1,	10000,	NULL,	NULL,	NULL,	1),
(2,	1,	2,	30000,	NULL,	NULL,	NULL,	1),
(3,	1,	3,	40000,	NULL,	NULL,	NULL,	2),
(4,	1,	4,	50000,	NULL,	NULL,	NULL,	1),
(5,	2,	2,	35000,	NULL,	NULL,	NULL,	2),
(6,	2,	3,	40000,	NULL,	NULL,	NULL,	1),
(7,	7,	2,	33924,	NULL,	NULL,	NULL,	62),
(8,	7,	2,	33924,	NULL,	NULL,	NULL,	63),
(9,	7,	2,	33724,	NULL,	NULL,	NULL,	64),
(10,	7,	2,	33524,	NULL,	NULL,	NULL,	65),
(11,	7,	2,	33324,	NULL,	NULL,	NULL,	66),
(12,	7,	2,	26750,	NULL,	NULL,	NULL,	67),
(13,	7,	2,	34324,	NULL,	NULL,	NULL,	68),
(14,	7,	2,	34124,	NULL,	NULL,	NULL,	69),
(15,	7,	2,	33924,	NULL,	NULL,	NULL,	70),
(16,	7,	2,	33724,	NULL,	NULL,	NULL,	71),
(17,	7,	2,	33724,	NULL,	NULL,	NULL,	72),
(18,	7,	2,	33924,	NULL,	NULL,	NULL,	73),
(19,	7,	2,	33924,	NULL,	NULL,	NULL,	74),
(20,	7,	2,	33724,	NULL,	NULL,	NULL,	75),
(21,	7,	2,	33524,	NULL,	NULL,	NULL,	76),
(22,	7,	2,	33324,	NULL,	NULL,	NULL,	77),
(23,	7,	2,	26750,	NULL,	NULL,	NULL,	78),
(24,	7,	2,	34324,	NULL,	NULL,	NULL,	79),
(25,	7,	2,	34124,	NULL,	NULL,	NULL,	80),
(26,	7,	2,	33924,	NULL,	NULL,	NULL,	81),
(27,	7,	2,	33724,	NULL,	NULL,	NULL,	82),
(28,	7,	2,	33724,	NULL,	NULL,	NULL,	83),
(29,	7,	2,	33924,	NULL,	NULL,	NULL,	84),
(30,	7,	2,	33924,	NULL,	NULL,	NULL,	85),
(31,	7,	2,	33724,	NULL,	NULL,	NULL,	86),
(32,	7,	2,	33524,	NULL,	NULL,	NULL,	87),
(33,	7,	2,	33324,	NULL,	NULL,	NULL,	88),
(34,	7,	2,	26750,	NULL,	NULL,	NULL,	89),
(35,	7,	2,	34324,	NULL,	NULL,	NULL,	90),
(36,	7,	2,	34124,	NULL,	NULL,	NULL,	91),
(37,	7,	2,	33924,	NULL,	NULL,	NULL,	92),
(38,	7,	2,	33724,	NULL,	NULL,	NULL,	93),
(39,	7,	2,	33724,	NULL,	NULL,	NULL,	94),
(40,	7,	2,	33924,	NULL,	NULL,	NULL,	95),
(41,	7,	2,	33924,	NULL,	NULL,	NULL,	96),
(42,	7,	2,	33724,	NULL,	NULL,	NULL,	97),
(43,	7,	2,	33524,	NULL,	NULL,	NULL,	98),
(44,	7,	2,	33324,	NULL,	NULL,	NULL,	99),
(45,	7,	2,	26750,	NULL,	NULL,	NULL,	100),
(46,	7,	2,	34324,	NULL,	NULL,	NULL,	101),
(47,	7,	2,	34124,	NULL,	NULL,	NULL,	102),
(48,	7,	2,	33924,	NULL,	NULL,	NULL,	103),
(49,	7,	2,	33724,	NULL,	NULL,	NULL,	104),
(50,	7,	2,	33724,	NULL,	NULL,	NULL,	105),
(51,	7,	2,	33924,	NULL,	NULL,	NULL,	106),
(52,	7,	2,	33924,	NULL,	NULL,	NULL,	107),
(53,	7,	2,	33724,	NULL,	NULL,	NULL,	108),
(54,	7,	2,	33524,	NULL,	NULL,	NULL,	109),
(55,	7,	2,	33324,	NULL,	NULL,	NULL,	110),
(56,	7,	2,	26750,	NULL,	NULL,	NULL,	111),
(57,	7,	2,	34324,	NULL,	NULL,	NULL,	112),
(58,	7,	2,	34124,	NULL,	NULL,	NULL,	113),
(59,	7,	2,	33924,	NULL,	NULL,	NULL,	114),
(60,	7,	2,	33724,	NULL,	NULL,	NULL,	115),
(61,	7,	2,	33724,	NULL,	NULL,	NULL,	116)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `consigneer_id` = VALUES(`consigneer_id`), `delivery_id` = VALUES(`delivery_id`), `price` = VALUES(`price`), `link_1s` = VALUES(`link_1s`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `productrange_id` = VALUES(`productrange_id`);

DROP TABLE IF EXISTS `contactqueries`;
CREATE TABLE `contactqueries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `theme` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `querytext` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `link_1s` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `applicator_id` int(10) unsigned DEFAULT NULL,
  `file_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contactqueries_applicator_id_foreign` (`applicator_id`),
  KEY `contactqueries_file_id_foreign` (`file_id`),
  CONSTRAINT `contactqueries_applicator_id_foreign` FOREIGN KEY (`applicator_id`) REFERENCES `applicators` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `contactqueries_file_id_foreign` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `cooperations`;
CREATE TABLE `cooperations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contract_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contract_period` date NOT NULL,
  `monthly_min_volume` int(11) NOT NULL,
  `monthly_max_volume` int(11) NOT NULL,
  `delayed_payment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bonus` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_1s` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `counter_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cooperations_counter_id_foreign` (`counter_id`),
  CONSTRAINT `cooperations_counter_id_foreign` FOREIGN KEY (`counter_id`) REFERENCES `counters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `cooperations` (`id`, `contract_number`, `contract_period`, `monthly_min_volume`, `monthly_max_volume`, `delayed_payment`, `currency`, `description`, `bonus`, `link_1s`, `counter_id`, `created_at`, `updated_at`) VALUES
(1,	'12345',	'2018-05-23',	10,	50,	'1',	'рубли',	'Условия сотрудничества 1 актуальные',	'нет',	NULL,	1,	NULL,	NULL),
(2,	'12345',	'2018-05-14',	10,	50,	'1',	'рубли',	'Условия сотрудничества 1 просрочены',	'нет',	NULL,	1,	NULL,	NULL),
(3,	'22222',	'2018-05-25',	10,	20,	'3',	'рубли',	'Условия сотрудничества 2 актуальные',	'нет',	NULL,	2,	NULL,	NULL),
(4,	'12345',	'2018-06-30',	0,	0,	'90 дней',	'рубли',	'Товарный лимит - 220 000 000 руб с учетом НДС\r\nОтсрочка - 90 дн\r\nДиаметр рулона - не более 1330мм\r\nВес рулона - не более 2 тн\r\nДиаметр гильзы - 100мм\r\nДата окончания - 01.12.2018',	'нет',	NULL,	3,	NULL,	NULL)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `contract_number` = VALUES(`contract_number`), `contract_period` = VALUES(`contract_period`), `monthly_min_volume` = VALUES(`monthly_min_volume`), `monthly_max_volume` = VALUES(`monthly_max_volume`), `delayed_payment` = VALUES(`delayed_payment`), `currency` = VALUES(`currency`), `description` = VALUES(`description`), `bonus` = VALUES(`bonus`), `link_1s` = VALUES(`link_1s`), `counter_id` = VALUES(`counter_id`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`);

DROP TABLE IF EXISTS `cooperation_productranges`;
CREATE TABLE `cooperation_productranges` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cooperation_id` int(10) unsigned NOT NULL,
  `productrange_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cooperation_productranges_cooperation_id_foreign` (`cooperation_id`),
  KEY `cooperation_productranges_productrange_id_foreign` (`productrange_id`),
  CONSTRAINT `cooperation_productranges_cooperation_id_foreign` FOREIGN KEY (`cooperation_id`) REFERENCES `cooperations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cooperation_productranges_productrange_id_foreign` FOREIGN KEY (`productrange_id`) REFERENCES `productranges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `counterparties`;
CREATE TABLE `counterparties` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_1s` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `counterparties` (`id`, `name`, `link_1s`, `created_at`, `updated_at`) VALUES
(1,	'АО ФКЛ - Код:7869',	NULL,	NULL,	NULL)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `name` = VALUES(`name`), `link_1s` = VALUES(`link_1s`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`);

DROP TABLE IF EXISTS `counters`;
CREATE TABLE `counters` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `INN` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KPP` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requisites` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_1s` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `counterparty_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `counters_inn_unique` (`INN`),
  KEY `counters_counterparty_id_foreign` (`counterparty_id`),
  CONSTRAINT `counters_counterparty_id_foreign` FOREIGN KEY (`counterparty_id`) REFERENCES `counterparties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `counters` (`id`, `name`, `address`, `INN`, `KPP`, `requisites`, `link_1s`, `created_at`, `updated_at`, `counterparty_id`) VALUES
(1,	'Контрагент 1',	'Адрес контрагента 1',	'111111111',	'11111',	'Реквизиты контрагента 1',	NULL,	NULL,	NULL,	NULL),
(2,	'Контрагент 2',	'Адрес контрагента 2',	'222222222',	'22222',	'Реквизиты контрагента 2',	NULL,	NULL,	NULL,	NULL),
(3,	'АО \"Фамадар Картона Лимитед\"',	'347927, Ростовская обл, Таганрог г, Поляковское ш, д. 16-а',	'6154069596',	'6154069596',	'\r\nОГРН: 1026102573001\r\nОКАТО: 60437000000\r\nр/с 40702810400154551565 \r\nБанк: РОСТОВСКИЙ ФИЛИАЛ АО ЮНИКРЕДИТ БАНК\r\nБИК 046027238\r\nкор счет 30101810200000000238\r\n',	NULL,	'2018-05-23 21:00:00',	'2018-05-23 21:00:00',	1)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `name` = VALUES(`name`), `address` = VALUES(`address`), `INN` = VALUES(`INN`), `KPP` = VALUES(`KPP`), `requisites` = VALUES(`requisites`), `link_1s` = VALUES(`link_1s`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `counterparty_id` = VALUES(`counterparty_id`);

DROP TABLE IF EXISTS `deliveries`;
CREATE TABLE `deliveries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `deliveries` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1,	'АВТО',	NULL,	NULL),
(2,	'ЖД',	NULL,	NULL),
(3,	'Авиа',	NULL,	NULL),
(4,	'Самовывоз',	NULL,	NULL)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `name` = VALUES(`name`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`);

DROP TABLE IF EXISTS `files`;
CREATE TABLE `files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `applicator_id` int(10) unsigned DEFAULT NULL,
  `admin_id` int(10) unsigned DEFAULT NULL,
  `lunit_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `files_applicator_id_foreign` (`applicator_id`),
  KEY `files_admin_id_foreign` (`admin_id`),
  KEY `files_lunit_id_foreign` (`lunit_id`),
  CONSTRAINT `files_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `files_applicator_id_foreign` FOREIGN KEY (`applicator_id`) REFERENCES `applicators` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `files_lunit_id_foreign` FOREIGN KEY (`lunit_id`) REFERENCES `lunits` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `lunits`;
CREATE TABLE `lunits` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `consigneer_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transportunits_info` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `volume_decada` tinyint(4) NOT NULL,
  `volume` int(11) NOT NULL,
  `plan_data` date NOT NULL,
  `shipment_data` date NOT NULL,
  `delivery_data` date NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(48,	'2018_05_07_004948_create_users_table',	1),
(49,	'2018_05_07_014529_create_counters_table',	1),
(50,	'2018_05_07_060423_create_admins_table',	1),
(51,	'2018_05_07_060630_create_counterparties_table',	1),
(52,	'2018_05_07_064737_create_providers_table',	1),
(53,	'2018_05_07_064840_create_deliveries_table',	1),
(54,	'2018_05_07_072314_create_productranges_table',	1),
(55,	'2018_05_07_072400_create_consigneers_table',	1),
(56,	'2018_05_07_072500_create_cooperations_table',	1),
(57,	'2018_05_07_072510_create_applicators_table',	1),
(58,	'2018_05_07_072515_add_foreign_to_applicators',	1),
(59,	'2018_05_07_072520_create_consigneer_deliveries_table',	1),
(60,	'2018_05_07_074217_create_contactqueries_table',	1),
(61,	'2018_05_07_132602_create_applications_table',	1),
(62,	'2018_05_07_132700_create_order_applications_table',	1),
(63,	'2018_05_07_133024_create_files_table',	1),
(64,	'2018_05_08_054230_create_transportunits_table',	1),
(65,	'2018_05_08_055725_create_lunits_table',	1),
(66,	'2018_05_08_062032_add_foreign_to_contactqueries',	1),
(67,	'2018_05_08_063655_add_foreign_counter_id_to_consigneers',	1),
(68,	'2018_05_08_070607_add_foreign_to_files',	1),
(69,	'2018_05_08_084156_add_foreign_counters_table',	1),
(70,	'2018_05_18_183213_add_foreign_to_productranges',	1),
(71,	'2018_05_21_051518_create_cooperation_productranges_table',	1),
(72,	'2018_05_31_101800_add_productrange_id_to_consiigner_deliveries',	1)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `migration` = VALUES(`migration`), `batch` = VALUES(`batch`);

DROP TABLE IF EXISTS `order_applications`;
CREATE TABLE `order_applications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `volume_1` int(11) DEFAULT NULL,
  `volume_2` int(11) DEFAULT NULL,
  `volume_3` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `productrange_id` int(10) unsigned NOT NULL,
  `application_id` int(10) unsigned NOT NULL,
  `consigneer_delivery_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_applications_productrange_id_foreign` (`productrange_id`),
  KEY `order_applications_application_id_foreign` (`application_id`),
  KEY `order_applications_consigneer_delivery_id_foreign` (`consigneer_delivery_id`),
  CONSTRAINT `order_applications_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `order_applications_consigneer_delivery_id_foreign` FOREIGN KEY (`consigneer_delivery_id`) REFERENCES `consigneer_deliveries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `order_applications_productrange_id_foreign` FOREIGN KEY (`productrange_id`) REFERENCES `productranges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `order_applications` (`id`, `volume_1`, `volume_2`, `volume_3`, `price`, `comment`, `productrange_id`, `application_id`, `consigneer_delivery_id`, `created_at`, `updated_at`) VALUES
(1,	NULL,	NULL,	30,	300000,	NULL,	1,	1,	1,	'2018-05-31 09:36:32',	'2018-05-31 09:36:32'),
(2,	NULL,	10,	NULL,	100000,	NULL,	1,	2,	1,	'2018-05-31 13:34:12',	'2018-05-31 13:34:12'),
(3,	NULL,	NULL,	30,	300000,	NULL,	2,	2,	1,	'2018-05-31 13:34:12',	'2018-05-31 13:34:12')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `volume_1` = VALUES(`volume_1`), `volume_2` = VALUES(`volume_2`), `volume_3` = VALUES(`volume_3`), `price` = VALUES(`price`), `comment` = VALUES(`comment`), `productrange_id` = VALUES(`productrange_id`), `application_id` = VALUES(`application_id`), `consigneer_delivery_id` = VALUES(`consigneer_delivery_id`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`);

DROP TABLE IF EXISTS `productranges`;
CREATE TABLE `productranges` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grammage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `format` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `min_lot` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_1s` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `provider_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `productranges_provider_id_foreign` (`provider_id`),
  CONSTRAINT `productranges_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `providers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `productranges` (`id`, `brand`, `grammage`, `format`, `price`, `min_lot`, `link_1s`, `created_at`, `updated_at`, `provider_id`) VALUES
(1,	'L1',	'135',	'2100',	0,	'30',	NULL,	NULL,	NULL,	1),
(2,	'L1',	'200',	'2100',	0,	'50',	NULL,	NULL,	NULL,	1),
(3,	'L2',	'90',	'2100',	0,	'50',	NULL,	NULL,	NULL,	2),
(4,	'L2',	'90',	'2100',	0,	'50',	NULL,	NULL,	NULL,	1),
(5,	'L2',	'90',	'2100',	0,	'50',	NULL,	NULL,	NULL,	3),
(6,	'L3',	'80',	'2200',	0,	'30',	NULL,	NULL,	NULL,	1),
(62,	'M (SFT Medium)',	'100',	'2100',	33924,	'',	NULL,	NULL,	NULL,	7),
(63,	'M (SFT Medium)',	'110',	'2100',	33924,	'',	NULL,	NULL,	NULL,	7),
(64,	'M (SFT Medium)',	'120',	'2100',	33724,	'',	NULL,	NULL,	NULL,	7),
(65,	'M (SFT Medium)',	'135',	'2100',	33524,	'',	NULL,	NULL,	NULL,	7),
(66,	'M (SFT Medium)',	'150',	'2100',	33324,	'',	NULL,	NULL,	NULL,	7),
(67,	'M3 (SFT Medium 3)',	'100',	'2100',	26750,	'',	NULL,	NULL,	NULL,	7),
(68,	'L2 (SFT Liner 2)',	'110',	'2100',	34324,	'',	NULL,	NULL,	NULL,	7),
(69,	'L2 (SFT Liner 2)',	'120',	'2100',	34124,	'',	NULL,	NULL,	NULL,	7),
(70,	'L2 (SFT Liner 2)',	'135',	'2100',	33924,	'',	NULL,	NULL,	NULL,	7),
(71,	'L2 (SFT Liner 2)',	'150',	'2100',	33724,	'',	NULL,	NULL,	NULL,	7),
(72,	'L2 (SFT Liner 2)',	'175',	'2100',	33724,	'',	NULL,	NULL,	NULL,	7),
(73,	'M (SFT Medium)',	'100',	'1700',	33924,	'',	NULL,	NULL,	NULL,	7),
(74,	'M (SFT Medium)',	'110',	'1700',	33924,	'',	NULL,	NULL,	NULL,	7),
(75,	'M (SFT Medium)',	'120',	'1700',	33724,	'',	NULL,	NULL,	NULL,	7),
(76,	'M (SFT Medium)',	'135',	'1700',	33524,	'',	NULL,	NULL,	NULL,	7),
(77,	'M (SFT Medium)',	'150',	'1700',	33324,	'',	NULL,	NULL,	NULL,	7),
(78,	'M3 (SFT Medium 3)',	'100',	'1700',	26750,	'',	NULL,	NULL,	NULL,	7),
(79,	'L2 (SFT Liner 2)',	'110',	'1700',	34324,	'',	NULL,	NULL,	NULL,	7),
(80,	'L2 (SFT Liner 2)',	'120',	'1700',	34124,	'',	NULL,	NULL,	NULL,	7),
(81,	'L2 (SFT Liner 2)',	'135',	'1700',	33924,	'',	NULL,	NULL,	NULL,	7),
(82,	'L2 (SFT Liner 2)',	'150',	'1700',	33724,	'',	NULL,	NULL,	NULL,	7),
(83,	'L2 (SFT Liner 2)',	'175',	'1700',	33724,	'',	NULL,	NULL,	NULL,	7),
(84,	'M (SFT Medium)',	'100',	'2500',	33924,	'',	NULL,	NULL,	NULL,	7),
(85,	'M (SFT Medium)',	'110',	'2500',	33924,	'',	NULL,	NULL,	NULL,	7),
(86,	'M (SFT Medium)',	'120',	'2500',	33724,	'',	NULL,	NULL,	NULL,	7),
(87,	'M (SFT Medium)',	'135',	'2500',	33524,	'',	NULL,	NULL,	NULL,	7),
(88,	'M (SFT Medium)',	'150',	'2500',	33324,	'',	NULL,	NULL,	NULL,	7),
(89,	'M3 (SFT Medium 3)',	'100',	'2500',	26750,	'',	NULL,	NULL,	NULL,	7),
(90,	'L2 (SFT Liner 2)',	'110',	'2500',	34324,	'',	NULL,	NULL,	NULL,	7),
(91,	'L2 (SFT Liner 2)',	'120',	'2500',	34124,	'',	NULL,	NULL,	NULL,	7),
(92,	'L2 (SFT Liner 2)',	'135',	'2500',	33924,	'',	NULL,	NULL,	NULL,	7),
(93,	'L2 (SFT Liner 2)',	'150',	'2500',	33724,	'',	NULL,	NULL,	NULL,	7),
(94,	'L2 (SFT Liner 2)',	'175',	'2500',	33724,	'',	NULL,	NULL,	NULL,	7),
(95,	'M (SFT Medium)',	'100',	'2000',	33924,	'',	NULL,	NULL,	NULL,	7),
(96,	'M (SFT Medium)',	'110',	'2000',	33924,	'',	NULL,	NULL,	NULL,	7),
(97,	'M (SFT Medium)',	'120',	'2000',	33724,	'',	NULL,	NULL,	NULL,	7),
(98,	'M (SFT Medium)',	'135',	'2000',	33524,	'',	NULL,	NULL,	NULL,	7),
(99,	'M (SFT Medium)',	'150',	'2000',	33324,	'',	NULL,	NULL,	NULL,	7),
(100,	'M3 (SFT Medium 3)',	'100',	'2000',	26750,	'',	NULL,	NULL,	NULL,	7),
(101,	'L2 (SFT Liner 2)',	'110',	'2000',	34324,	'',	NULL,	NULL,	NULL,	7),
(102,	'L2 (SFT Liner 2)',	'120',	'2000',	34124,	'',	NULL,	NULL,	NULL,	7),
(103,	'L2 (SFT Liner 2)',	'135',	'2000',	33924,	'',	NULL,	NULL,	NULL,	7),
(104,	'L2 (SFT Liner 2)',	'150',	'2000',	33724,	'',	NULL,	NULL,	NULL,	7),
(105,	'L2 (SFT Liner 2)',	'175',	'2000',	33724,	'',	NULL,	NULL,	NULL,	7),
(106,	'M (SFT Medium)',	'100',	'2200',	33924,	'',	NULL,	NULL,	NULL,	7),
(107,	'M (SFT Medium)',	'110',	'2200',	33924,	'',	NULL,	NULL,	NULL,	7),
(108,	'M (SFT Medium)',	'120',	'2200',	33724,	'',	NULL,	NULL,	NULL,	7),
(109,	'M (SFT Medium)',	'135',	'2200',	33524,	'',	NULL,	NULL,	NULL,	7),
(110,	'M (SFT Medium)',	'150',	'2200',	33324,	'',	NULL,	NULL,	NULL,	7),
(111,	'M3 (SFT Medium 3)',	'100',	'2200',	26750,	'',	NULL,	NULL,	NULL,	7),
(112,	'L2 (SFT Liner 2)',	'110',	'2200',	34324,	'',	NULL,	NULL,	NULL,	7),
(113,	'L2 (SFT Liner 2)',	'120',	'2200',	34124,	'',	NULL,	NULL,	NULL,	7),
(114,	'L2 (SFT Liner 2)',	'135',	'2200',	33924,	'',	NULL,	NULL,	NULL,	7),
(115,	'L2 (SFT Liner 2)',	'150',	'2200',	33724,	'',	NULL,	NULL,	NULL,	7),
(116,	'L2 (SFT Liner 2)',	'175',	'2200',	33724,	'',	NULL,	NULL,	NULL,	7)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `brand` = VALUES(`brand`), `grammage` = VALUES(`grammage`), `format` = VALUES(`format`), `price` = VALUES(`price`), `min_lot` = VALUES(`min_lot`), `link_1s` = VALUES(`link_1s`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `provider_id` = VALUES(`provider_id`);

DROP TABLE IF EXISTS `providers`;
CREATE TABLE `providers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `counter_id` int(11) NOT NULL,
  `link_1s` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `providers` (`id`, `name`, `counter_id`, `link_1s`, `created_at`, `updated_at`) VALUES
(1,	'Поставщик 1',	1,	NULL,	NULL,	NULL),
(2,	'Поставщик 2',	1,	NULL,	NULL,	NULL),
(3,	'Поставщик 3',	1,	NULL,	NULL,	NULL),
(4,	'Поставщик 1',	2,	NULL,	NULL,	NULL),
(5,	'Поставщик 2',	2,	NULL,	NULL,	NULL),
(6,	'Поставщик 3',	2,	NULL,	NULL,	NULL),
(7,	'Каменская БКФ',	3,	NULL,	NULL,	NULL)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `name` = VALUES(`name`), `counter_id` = VALUES(`counter_id`), `link_1s` = VALUES(`link_1s`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`);

DROP TABLE IF EXISTS `transportunits`;
CREATE TABLE `transportunits` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `info` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_id` int(10) unsigned NOT NULL,
  `link_1s` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transportunits_delivery_id_foreign` (`delivery_id`),
  CONSTRAINT `transportunits_delivery_id_foreign` FOREIGN KEY (`delivery_id`) REFERENCES `deliveries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `lastName`, `firstName`, `middleName`, `email`, `phone`, `password`, `passwordUntil`, `link_1s`, `remember_token`, `created_at`, `updated_at`) VALUES
(1,	'Иванов',	'Иван',	'Иванович',	'abs@dhs.ru',	'+7(999) 99-99-91',	'abcdef',	'2018-05-14',	NULL,	NULL,	NULL,	NULL),
(2,	'Сидоров',	'Сергей',	'Петрович',	'dssa@dhs.ru',	'+7(999) 99-99-92',	'abcdef',	'2018-05-14',	NULL,	NULL,	NULL,	NULL),
(3,	'Капустин',	'Иван',	'Федорович',	'rty@dhs.ru',	'+7(999) 99-99-93',	'abcdef',	'2018-05-14',	NULL,	NULL,	NULL,	NULL),
(4,	'Малкова',	'Светлана',	'Анатольевна',	'ssdf@dhs.ru',	'+7(999) 99-99-94',	'abcdef',	'2018-05-14',	NULL,	NULL,	NULL,	NULL),
(5,	'Тестовый',	'Оператор',	'Проверочно',	'd.shinshinov@sftgroup.ru',	'79163030180',	'1234512345',	'2018-07-20',	NULL,	NULL,	NULL,	NULL)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `lastName` = VALUES(`lastName`), `firstName` = VALUES(`firstName`), `middleName` = VALUES(`middleName`), `email` = VALUES(`email`), `phone` = VALUES(`phone`), `password` = VALUES(`password`), `passwordUntil` = VALUES(`passwordUntil`), `link_1s` = VALUES(`link_1s`), `remember_token` = VALUES(`remember_token`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`);

-- 2018-06-01 12:01:32
