-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 18 2018 г., 15:33
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
  `number` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `period` date NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cooperation_id` int(10) unsigned NOT NULL,
  `consigneer_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `application_shipment`
--

CREATE TABLE IF NOT EXISTS `application_shipment` (
  `id` int(10) unsigned NOT NULL,
  `volume` int(11) NOT NULL,
  `diameter` int(11) NOT NULL,
  `shipment` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order_id` int(10) unsigned DEFAULT NULL,
  `application_id` int(10) unsigned DEFAULT NULL,
  `productrange_id` int(10) unsigned DEFAULT NULL,
  `delivery_id` int(10) unsigned NOT NULL
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `counter_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `consigneers`
--

INSERT INTO `consigneers` (`id`, `name`, `address`, `INN`, `KPP`, `created_at`, `updated_at`, `counter_id`) VALUES
(1, 'Первый грузополучатель', 'Адрес грузополучателя', '1231351235', '121215', NULL, NULL, 1),
(2, 'Второй грузополучатель', 'Адрес грузополучателя', '1231231231', '121212', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `consigneer_delivery`
--

CREATE TABLE IF NOT EXISTS `consigneer_delivery` (
  `id` int(10) unsigned NOT NULL,
  `consigneer_id` int(10) unsigned DEFAULT NULL,
  `delivery_id` int(10) unsigned DEFAULT NULL
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
  `user_id` int(10) unsigned NOT NULL,
  `file_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `cooperations`
--

CREATE TABLE IF NOT EXISTS `cooperations` (
  `id` int(10) unsigned NOT NULL,
  `min_volume` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `cooperations`
--

INSERT INTO `cooperations` (`id`, `min_volume`, `description`, `created_at`, `updated_at`) VALUES
(1, 50000, 'Условия оплаты 1\r\nТекущая ДЗ 30 000\r\nТоварный лимит 50 000\r\nПросроченная ДЗ 10 000\r\n', NULL, NULL),
(2, 34000, 'Условия оплаты 1\r\nТекущая ДЗ 30 000\r\nТоварный лимит 34 000\r\nПросроченная ДЗ 10 000', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `cooperation_counter`
--

CREATE TABLE IF NOT EXISTS `cooperation_counter` (
  `id` int(10) unsigned NOT NULL,
  `cooperation_id` int(10) unsigned DEFAULT NULL,
  `counter_id` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `cooperation_counter`
--

INSERT INTO `cooperation_counter` (`id`, `cooperation_id`, `counter_id`) VALUES
(1, 1, 1),
(2, 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `cooperation_productrange`
--

CREATE TABLE IF NOT EXISTS `cooperation_productrange` (
  `id` int(10) unsigned NOT NULL,
  `cooperation_id` int(10) unsigned DEFAULT NULL,
  `productrange_id` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `counterparties`
--

CREATE TABLE IF NOT EXISTS `counterparties` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `requisites` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `counterparty_id` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `counters`
--

INSERT INTO `counters` (`id`, `name`, `address`, `requisites`, `created_at`, `updated_at`, `counterparty_id`) VALUES
(1, 'Первый контрагент', 'Адрес 1', 'Реквизиты 1', NULL, NULL, NULL),
(2, 'Второй контрагент', 'Адрес 2', 'Реквизиты 2', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `counter_provider`
--

CREATE TABLE IF NOT EXISTS `counter_provider` (
  `id` int(10) unsigned NOT NULL,
  `counter_id` int(10) unsigned NOT NULL,
  `provider_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `deliveries`
--

CREATE TABLE IF NOT EXISTS `deliveries` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `delivery_productrange`
--

CREATE TABLE IF NOT EXISTS `delivery_productrange` (
  `id` int(10) unsigned NOT NULL,
  `delivery_id` int(10) unsigned NOT NULL,
  `productrange_id` int(10) unsigned NOT NULL
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
  `user_id` int(10) unsigned DEFAULT NULL,
  `admin_id` int(10) unsigned DEFAULT NULL,
  `order_id` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(63, '2018_05_07_054948_create_users_table', 1),
(64, '2018_05_07_060423_create_admins_table', 1),
(65, '2018_05_07_060630_create_counterparties_table', 1),
(66, '2018_05_07_064529_create_counters_table', 1),
(67, '2018_05_07_064737_create_providers_table', 1),
(68, '2018_05_07_065529_create_counter_providers_table', 1),
(69, '2018_05_07_072140_create_deliveries_table', 1),
(70, '2018_05_07_072314_create_productranges_table', 1),
(71, '2018_05_07_072654_create_delivery_productranges_table', 1),
(72, '2018_05_07_073036_create_productrange_providers_table', 1),
(73, '2018_05_07_074217_create_contactqueries_table', 1),
(74, '2018_05_07_131827_create_consigneers_table', 1),
(75, '2018_05_07_132602_create_applications_table', 1),
(76, '2018_05_07_133024_create_files_table', 1),
(77, '2018_05_08_052419_create_application_shipments_table', 1),
(78, '2018_05_08_053625_create_orders_table', 1),
(79, '2018_05_08_054230_create_transportunits_table', 1),
(80, '2018_05_08_054525_create_order_transportunits_table', 1),
(81, '2018_05_08_054714_add_foreign_to_order_transportunits', 1),
(82, '2018_05_08_054850_create_cooperations_table', 1),
(83, '2018_05_08_055300_create_cooperation_productranges_table', 1),
(84, '2018_05_08_060545_add_foreign_counter_id_to_users_table', 1),
(85, '2018_05_08_062032_add_foreign_to_contactqueries', 1),
(86, '2018_05_08_062428_add_foreign_order_id_to_application_shipments', 1),
(87, '2018_05_08_063655_add_foreign_counter_id_to_consigneers', 1),
(88, '2018_05_08_070607_add_foreign_to_files', 1),
(89, '2018_05_08_070922_add_foreign_to_application_shipments', 1),
(90, '2018_05_08_081842_create_consigneer_deliveries_table', 1),
(91, '2018_05_08_083920_create_cooperation_counters_table', 1),
(92, '2018_05_08_084156_add_foreign_counters_table', 1),
(93, '2018_05_08_084509_add_foreigns_to_applications', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(10) unsigned NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `order_transportunit`
--

CREATE TABLE IF NOT EXISTS `order_transportunit` (
  `id` int(10) unsigned NOT NULL,
  `order_id` int(10) unsigned DEFAULT NULL,
  `transportunit_id` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `productrange_provider`
--

CREATE TABLE IF NOT EXISTS `productrange_provider` (
  `id` int(10) unsigned NOT NULL,
  `productrange_id` int(10) unsigned NOT NULL,
  `provider_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `providers`
--

CREATE TABLE IF NOT EXISTS `providers` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `transportunits`
--

CREATE TABLE IF NOT EXISTS `transportunits` (
  `id` int(10) unsigned NOT NULL,
  `info` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_id` int(10) unsigned NOT NULL,
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
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `counter_id` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `lastName`, `firstName`, `middleName`, `email`, `phone`, `password`, `passwordUntil`, `remember_token`, `created_at`, `updated_at`, `counter_id`) VALUES
(5, 'Ивановаff', 'Мария', 'Васильевнаf', 'stzv78@mail.ru', '+7(232) 7-232', '2123123456', '2018-05-15', NULL, '2018-05-11 06:00:04', '2018-05-16 06:54:38', 1);

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
  ADD KEY `applications_cooperation_id_foreign` (`cooperation_id`),
  ADD KEY `applications_consigneer_id_foreign` (`consigneer_id`);

--
-- Индексы таблицы `application_shipment`
--
ALTER TABLE `application_shipment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `application_shipments_order_id_foreign` (`order_id`),
  ADD KEY `application_shipments_application_id_foreign` (`application_id`),
  ADD KEY `application_shipments_productrange_id_foreign` (`productrange_id`),
  ADD KEY `application_shipments_delivery_id_foreign` (`delivery_id`);

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
  ADD KEY `consigneer_deliveries_consigneer_id_foreign` (`consigneer_id`),
  ADD KEY `consigneer_deliveries_delivery_id_foreign` (`delivery_id`);

--
-- Индексы таблицы `contactqueries`
--
ALTER TABLE `contactqueries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contactqueries_user_id_foreign` (`user_id`),
  ADD KEY `contactqueries_file_id_foreign` (`file_id`);

--
-- Индексы таблицы `cooperations`
--
ALTER TABLE `cooperations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cooperation_counter`
--
ALTER TABLE `cooperation_counter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cooperation_counters_cooperation_id_foreign` (`cooperation_id`),
  ADD KEY `cooperation_counters_counter_id_foreign` (`counter_id`);

--
-- Индексы таблицы `cooperation_productrange`
--
ALTER TABLE `cooperation_productrange`
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
  ADD KEY `counters_counterparty_id_foreign` (`counterparty_id`);

--
-- Индексы таблицы `counter_provider`
--
ALTER TABLE `counter_provider`
  ADD PRIMARY KEY (`id`),
  ADD KEY `counter_providers_counter_id_foreign` (`counter_id`),
  ADD KEY `counter_providers_provider_id_foreign` (`provider_id`);

--
-- Индексы таблицы `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `delivery_productrange`
--
ALTER TABLE `delivery_productrange`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delivery_productranges_delivery_id_foreign` (`delivery_id`),
  ADD KEY `delivery_productranges_productrange_id_foreign` (`productrange_id`);

--
-- Индексы таблицы `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `files_user_id_foreign` (`user_id`),
  ADD KEY `files_admin_id_foreign` (`admin_id`),
  ADD KEY `files_order_id_foreign` (`order_id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_transportunit`
--
ALTER TABLE `order_transportunit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_transportunits_order_id_foreign` (`order_id`),
  ADD KEY `order_transportunits_transportunit_id_foreign` (`transportunit_id`);

--
-- Индексы таблицы `productranges`
--
ALTER TABLE `productranges`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `productrange_provider`
--
ALTER TABLE `productrange_provider`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productrange_providers_productrange_id_foreign` (`productrange_id`),
  ADD KEY `productrange_providers_provider_id_foreign` (`provider_id`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_counter_id_foreign` (`counter_id`);

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
-- AUTO_INCREMENT для таблицы `application_shipment`
--
ALTER TABLE `application_shipment`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `consigneers`
--
ALTER TABLE `consigneers`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
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
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `cooperation_counter`
--
ALTER TABLE `cooperation_counter`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `cooperation_productrange`
--
ALTER TABLE `cooperation_productrange`
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
-- AUTO_INCREMENT для таблицы `counter_provider`
--
ALTER TABLE `counter_provider`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `delivery_productrange`
--
ALTER TABLE `delivery_productrange`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `files`
--
ALTER TABLE `files`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=94;
--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `order_transportunit`
--
ALTER TABLE `order_transportunit`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `productranges`
--
ALTER TABLE `productranges`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `productrange_provider`
--
ALTER TABLE `productrange_provider`
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
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_consigneer_id_foreign` FOREIGN KEY (`consigneer_id`) REFERENCES `consigneers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `applications_cooperation_id_foreign` FOREIGN KEY (`cooperation_id`) REFERENCES `cooperations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `application_shipment`
--
ALTER TABLE `application_shipment`
  ADD CONSTRAINT `application_shipments_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `application_shipments_delivery_id_foreign` FOREIGN KEY (`delivery_id`) REFERENCES `deliveries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `application_shipments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `application_shipments_productrange_id_foreign` FOREIGN KEY (`productrange_id`) REFERENCES `productranges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `consigneers`
--
ALTER TABLE `consigneers`
  ADD CONSTRAINT `consigneers_counter_id_foreign` FOREIGN KEY (`counter_id`) REFERENCES `counters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `consigneer_delivery`
--
ALTER TABLE `consigneer_delivery`
  ADD CONSTRAINT `consigneer_deliveries_consigneer_id_foreign` FOREIGN KEY (`consigneer_id`) REFERENCES `consigneers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `consigneer_deliveries_delivery_id_foreign` FOREIGN KEY (`delivery_id`) REFERENCES `deliveries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `contactqueries`
--
ALTER TABLE `contactqueries`
  ADD CONSTRAINT `contactqueries_file_id_foreign` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contactqueries_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `cooperation_counter`
--
ALTER TABLE `cooperation_counter`
  ADD CONSTRAINT `cooperation_counters_cooperation_id_foreign` FOREIGN KEY (`cooperation_id`) REFERENCES `cooperations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cooperation_counters_counter_id_foreign` FOREIGN KEY (`counter_id`) REFERENCES `counters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `cooperation_productrange`
--
ALTER TABLE `cooperation_productrange`
  ADD CONSTRAINT `cooperation_productranges_cooperation_id_foreign` FOREIGN KEY (`cooperation_id`) REFERENCES `cooperations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cooperation_productranges_productrange_id_foreign` FOREIGN KEY (`productrange_id`) REFERENCES `productranges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `counters`
--
ALTER TABLE `counters`
  ADD CONSTRAINT `counters_counterparty_id_foreign` FOREIGN KEY (`counterparty_id`) REFERENCES `counterparties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `counter_provider`
--
ALTER TABLE `counter_provider`
  ADD CONSTRAINT `counter_providers_counter_id_foreign` FOREIGN KEY (`counter_id`) REFERENCES `counters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `counter_providers_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `providers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `delivery_productrange`
--
ALTER TABLE `delivery_productrange`
  ADD CONSTRAINT `delivery_productranges_delivery_id_foreign` FOREIGN KEY (`delivery_id`) REFERENCES `deliveries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `delivery_productranges_productrange_id_foreign` FOREIGN KEY (`productrange_id`) REFERENCES `productranges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `files_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `files_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `order_transportunit`
--
ALTER TABLE `order_transportunit`
  ADD CONSTRAINT `order_transportunits_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_transportunits_transportunit_id_foreign` FOREIGN KEY (`transportunit_id`) REFERENCES `transportunits` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `productrange_provider`
--
ALTER TABLE `productrange_provider`
  ADD CONSTRAINT `productrange_providers_productrange_id_foreign` FOREIGN KEY (`productrange_id`) REFERENCES `productranges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productrange_providers_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `providers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `transportunits`
--
ALTER TABLE `transportunits`
  ADD CONSTRAINT `transportunits_delivery_id_foreign` FOREIGN KEY (`delivery_id`) REFERENCES `deliveries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_counter_id_foreign` FOREIGN KEY (`counter_id`) REFERENCES `counters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
