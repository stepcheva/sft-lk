-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 18 2018 г., 21:46
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
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `applicators`
--

CREATE TABLE IF NOT EXISTS `applicators` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `counter_id` int(10) unsigned NOT NULL,
  `provider_id` int(10) unsigned NOT NULL,
  `cooperation_id` int(10) unsigned NOT NULL,
  `link_1s` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `counter_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `consigneer_delivery`
--

CREATE TABLE IF NOT EXISTS `consigneer_delivery` (
  `id` int(10) unsigned NOT NULL,
  `consigneer_id` int(10) unsigned NOT NULL,
  `delivery_id` int(10) unsigned NOT NULL,
  `price` int(11) DEFAULT NULL,
  `link_1s` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `applicator_id` int(10) unsigned NOT NULL,
  `file_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `link_1s` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `counterparties`
--

CREATE TABLE IF NOT EXISTS `counterparties` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_1s` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `counters`
--

CREATE TABLE IF NOT EXISTS `counters` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `requisites` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_1s` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `counterparty_id` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `deliveries`
--

CREATE TABLE IF NOT EXISTS `deliveries` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=209 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(184, '2018_05_07_014529_create_counters_table', 1),
(185, '2018_05_07_054948_create_users_table', 1),
(186, '2018_05_07_060423_create_admins_table', 1),
(187, '2018_05_07_060630_create_counterparties_table', 1),
(188, '2018_05_07_064737_create_providers_table', 1),
(189, '2018_05_07_064840_create_deliveries_table', 1),
(190, '2018_05_07_072314_create_productranges_table', 1),
(191, '2018_05_07_072400_create_consigneers_table', 1),
(192, '2018_05_07_072500_create_cooperations_table', 1),
(193, '2018_05_07_072510_create_applicators_table', 1),
(194, '2018_05_07_072515_add_foreign_to_applicators', 1),
(195, '2018_05_07_072520_create_consigneer_delivery_table', 1),
(196, '2018_05_07_074217_create_contactqueries_table', 1),
(197, '2018_05_07_132602_create_applications_table', 1),
(198, '2018_05_07_132800_create_product_applications_table', 1),
(199, '2018_05_07_133024_create_files_table', 1),
(200, '2018_05_08_054230_create_transportunits_table', 1),
(201, '2018_05_08_055725_create_lunits_table', 1),
(202, '2018_05_08_062032_add_foreign_to_contactqueries', 1),
(203, '2018_05_08_063655_add_foreign_counter_id_to_consigneers', 1),
(204, '2018_05_08_070607_add_foreign_to_files', 1),
(205, '2018_05_08_084156_add_foreign_counters_table', 1),
(206, '2018_05_18_170845_create_product_application_units_table', 1),
(207, '2018_05_18_171047_add_foreign_to_product_application_units', 1),
(208, '2018_05_18_183213_add_foreign_to_productranges', 1);

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
  `provider_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `product_applications`
--

CREATE TABLE IF NOT EXISTS `product_applications` (
  `id` int(10) unsigned NOT NULL,
  `price` int(11) NOT NULL,
  `productrange_id` int(10) unsigned NOT NULL,
  `application_id` int(10) unsigned NOT NULL,
  `consigneer_delivery_id` int(10) unsigned NOT NULL
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
  `link_1s` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `transportunits`
--

CREATE TABLE IF NOT EXISTS `transportunits` (
  `id` int(10) unsigned NOT NULL,
  `info` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_id` int(10) unsigned NOT NULL,
  `link_1s` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  ADD KEY `applications_consigneer_id_foreign` (`consigneer_id`);

--
-- Индексы таблицы `applicators`
--
ALTER TABLE `applicators`
  ADD PRIMARY KEY (`id`),
  ADD KEY `applicators_user_id_foreign` (`user_id`),
  ADD KEY `applicators_counter_id_foreign` (`counter_id`),
  ADD KEY `applicators_provider_id_foreign` (`provider_id`),
  ADD KEY `applicators_cooperation_id_foreign` (`cooperation_id`);

--
-- Индексы таблицы `consigneers`
--
ALTER TABLE `consigneers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `consigneers_inn_unique` (`INN`),
  ADD KEY `consigneers_counter_id_foreign` (`counter_id`);

--
-- Индексы таблицы `consigneer_delivery`
--
ALTER TABLE `consigneer_delivery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `consigneer_delivery_consigneer_id_foreign` (`consigneer_id`),
  ADD KEY `consigneer_delivery_delivery_id_foreign` (`delivery_id`);

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `applicators`
--
ALTER TABLE `applicators`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `consigneers`
--
ALTER TABLE `consigneers`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `consigneer_delivery`
--
ALTER TABLE `consigneer_delivery`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `contactqueries`
--
ALTER TABLE `contactqueries`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `cooperations`
--
ALTER TABLE `cooperations`
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
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
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
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=209;
--
-- AUTO_INCREMENT для таблицы `productranges`
--
ALTER TABLE `productranges`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
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
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `transportunits`
--
ALTER TABLE `transportunits`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_consigneer_id_foreign` FOREIGN KEY (`consigneer_id`) REFERENCES `consigneers` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `applications_applicator_id_foreign` FOREIGN KEY (`applicator_id`) REFERENCES `applicators` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `applicators`
--
ALTER TABLE `applicators`
  ADD CONSTRAINT `applicators_cooperation_id_foreign` FOREIGN KEY (`cooperation_id`) REFERENCES `cooperations` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `applicators_counter_id_foreign` FOREIGN KEY (`counter_id`) REFERENCES `counters` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `applicators_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `providers` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `applicators_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `consigneers`
--
ALTER TABLE `consigneers`
  ADD CONSTRAINT `consigneers_counter_id_foreign` FOREIGN KEY (`counter_id`) REFERENCES `counters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `consigneer_delivery`
--
ALTER TABLE `consigneer_delivery`
  ADD CONSTRAINT `consigneer_delivery_delivery_id_foreign` FOREIGN KEY (`delivery_id`) REFERENCES `deliveries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `consigneer_delivery_consigneer_id_foreign` FOREIGN KEY (`consigneer_id`) REFERENCES `consigneers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `contactqueries`
--
ALTER TABLE `contactqueries`
  ADD CONSTRAINT `contactqueries_file_id_foreign` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contactqueries_applicator_id_foreign` FOREIGN KEY (`applicator_id`) REFERENCES `applicators` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `counters`
--
ALTER TABLE `counters`
  ADD CONSTRAINT `counters_counterparty_id_foreign` FOREIGN KEY (`counterparty_id`) REFERENCES `counterparties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_lunit_id_foreign` FOREIGN KEY (`lunit_id`) REFERENCES `lunits` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `files_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `files_applicator_id_foreign` FOREIGN KEY (`applicator_id`) REFERENCES `applicators` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `productranges`
--
ALTER TABLE `productranges`
  ADD CONSTRAINT `productranges_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `providers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `product_applications`
--
ALTER TABLE `product_applications`
  ADD CONSTRAINT `product_applications_consigneer_delivery_id_foreign` FOREIGN KEY (`consigneer_delivery_id`) REFERENCES `consigneer_delivery` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_applications_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
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
