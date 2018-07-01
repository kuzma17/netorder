-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Июл 02 2018 г., 01:26
-- Версия сервера: 10.1.26-MariaDB-0+deb9u1
-- Версия PHP: 7.0.27-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `netorder_sint`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cartridges`
--

CREATE TABLE `cartridges` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cartridges`
--

INSERT INTO `cartridges` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'yhtfyhtg', '2018-06-29 05:43:38', '2018-06-29 05:43:38'),
(2, 'rwe1', '2018-06-29 09:35:27', '2018-06-29 06:35:27'),
(6, '77', '2018-06-29 17:32:02', '2018-06-29 17:32:02'),
(7, '78', '2018-06-29 17:32:10', '2018-06-29 17:32:10'),
(8, '79', '2018-06-29 17:32:20', '2018-06-29 17:32:20');

-- --------------------------------------------------------

--
-- Структура таблицы `cartridge_printer`
--

CREATE TABLE `cartridge_printer` (
  `printer_id` int(11) NOT NULL,
  `cartridge_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cartridge_printer`
--

INSERT INTO `cartridge_printer` (`printer_id`, `cartridge_id`) VALUES
(2, 5),
(1, 2),
(2, 4),
(3, 6),
(1, 7),
(1, 6),
(4, 1),
(4, 6),
(4, 7),
(5, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `clients`
--

CREATE TABLE `clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `firm_id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `town_id` int(11) NOT NULL,
  `contractor_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('on','off') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `clients`
--

INSERT INTO `clients` (`id`, `firm_id`, `region_id`, `town_id`, `contractor_id`, `name`, `phone`, `address`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 'Офис 1', '09854354354', 'Пушкинская 33', 'on', '2018-06-19 11:39:39', '2018-06-19 11:39:39'),
(2, 1, 1, 2, 1, 'некнне', '54354354', 'Ленина 1', 'on', '2018-06-19 11:48:59', '2018-06-19 16:20:43'),
(3, 1, 3, 2, 1, 'office2', '453653653465', 'ytrytryt 55', 'on', '2018-06-30 10:06:09', '2018-06-30 10:06:09'),
(7, 1, 13, 2, 3, 'ttr', '564365365', 'tuhjyfhg', 'on', '2018-06-30 12:19:24', '2018-06-30 12:19:24'),
(8, 1, 7, 1, 3, 'GFDgfdg', '54563', 'ghdgf', 'on', '2018-06-30 12:21:26', '2018-06-30 19:05:20'),
(9, 1, 14, 1, 1, 'GHfdghfdg', '543543', 'ytryry', 'on', '2018-06-30 13:04:51', '2018-06-30 13:04:51'),
(10, 1, 14, 1, 1, 'GHfdghfdg', '543543', 'ytryry', 'on', '2018-06-30 13:07:28', '2018-06-30 13:07:28'),
(11, 1, 14, 1, 1, 'GHfdghfdg', '543543', 'ytryry', 'on', '2018-06-30 13:10:58', '2018-06-30 13:10:58'),
(12, 1, 19, 1, 1, 'Ttrtretr', '65465465', 'Tfytryt', 'on', '2018-07-01 02:37:48', '2018-07-01 02:37:48'),
(16, 2, 17, 1, 3, 'ЕКнекн', '54543543', 'рненекн', 'on', '2018-07-01 08:13:16', '2018-07-01 08:13:28');

-- --------------------------------------------------------

--
-- Структура таблицы `client_printer`
--

CREATE TABLE `client_printer` (
  `client_id` int(11) NOT NULL,
  `printer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `client_printer`
--

INSERT INTO `client_printer` (`client_id`, `printer_id`) VALUES
(3, 3),
(3, 1),
(4, 3),
(3, 4),
(5, 3),
(6, 3),
(7, 3),
(10, 3),
(10, 4),
(8, 1),
(8, 4),
(11, 3),
(11, 4),
(11, 1),
(9, 1),
(12, 4),
(14, 1),
(14, 3),
(16, 4),
(1, 4),
(1, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `contractors`
--

CREATE TABLE `contractors` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('on','off') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `contractors`
--

INSERT INTO `contractors` (`id`, `name`, `phone`, `address`, `status`, `created_at`, `updated_at`) VALUES
(1, 'МЧП Ремонтник', '09845324324', 'Одесса ул. Греческая 20', 'on', '2018-06-19 11:20:22', '2018-06-19 11:20:22'),
(3, 'test2', '+79806542315', 'ул. Мира 23', 'on', '2018-06-28 15:42:16', '2018-06-28 16:50:37');

-- --------------------------------------------------------

--
-- Структура таблицы `firms`
--

CREATE TABLE `firms` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('on','off') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `firms`
--

INSERT INTO `firms` (`id`, `name`, `phone`, `status`, `created_at`, `updated_at`) VALUES
(1, '1 Мастер', '987542316', 'on', '2018-06-19 11:18:22', '2018-06-19 11:18:22'),
(2, 'банк Пивденный', '65465465', 'on', '2018-07-01 03:20:31', '2018-07-01 03:20:31');

-- --------------------------------------------------------

--
-- Структура таблицы `helps`
--

CREATE TABLE `helps` (
  `id` int(11) NOT NULL,
  `role` varchar(30) NOT NULL,
  `content` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `helps`
--

INSERT INTO `helps` (`id`, `role`, `content`, `created_at`, `updated_at`) VALUES
(1, 'admin', '<p>Help</p>', '2018-06-19 17:56:04', '0000-00-00 00:00:00'),
(2, 'admin_firm', '<p>Help</p>', '2018-06-19 17:56:08', '0000-00-00 00:00:00'),
(3, 'client', '<p>Help</p>', '2018-06-19 17:56:12', '0000-00-00 00:00:00'),
(4, 'contractor', '<p>Help</p>', '2018-06-19 17:56:16', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2018_02_27_133727_create_statuses_table', 1),
(5, '2018_02_27_134038_create_type_works_table', 1),
(6, '2018_02_27_151920_create_orders_table', 2),
(8, '2018_03_08_113126_create_firms_table', 2),
(10, '2018_03_09_094801_create_towns_table', 3),
(11, '2018_03_09_094818_create_regions_table', 3),
(12, '2018_03_09_113556_create_contractors_table', 3),
(13, '2018_03_08_113135_create_clients_table', 4),
(14, '2018_03_08_111048_create_user_profiles_table', 5),
(15, '2018_02_27_133147_create_roles_table', 6);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `type_work_id` int(11) NOT NULL,
  `firm_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `contractor_id` int(11) NOT NULL,
  `printer_id` int(11) NOT NULL,
  `cartridge_id` int(11) NOT NULL,
  `count_cartridge` int(11) NOT NULL,
  `date_end` date NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `act_complete` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `type_work_id`, `firm_id`, `client_id`, `user_id`, `contractor_id`, `printer_id`, `cartridge_id`, `count_cartridge`, `date_end`, `comment`, `act_complete`, `status_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 2, 1, 0, 0, 0, '2018-06-23', 'test2222', '/images/5b2a2f1ed750a_1529491230_20180620.jpeg', 4, '2018-06-19 15:35:39', '2018-06-20 07:40:32'),
(2, 1, 1, 1, 2, 1, 0, 0, 0, '2018-06-27', 'test2', NULL, 1, '2018-06-19 15:36:01', '2018-06-19 15:36:01'),
(3, 2, 1, 1, 2, 1, 0, 0, 0, '2018-07-19', 'test', NULL, 1, '2018-07-01 13:56:12', '2018-07-01 13:56:12'),
(4, 1, 1, 1, 2, 1, 0, 0, 0, '2018-07-11', NULL, NULL, 1, '2018-07-01 13:56:38', '2018-07-01 13:56:38'),
(5, 1, 1, 1, 2, 1, 0, 0, 0, '2018-07-14', NULL, NULL, 1, '2018-07-01 13:57:11', '2018-07-01 13:57:11'),
(6, 1, 1, 1, 2, 1, 4, 0, 0, '2018-07-12', NULL, NULL, 1, '2018-07-01 13:58:45', '2018-07-01 13:58:45'),
(7, 1, 1, 1, 2, 1, 4, 1, 0, '2018-07-21', 'test', NULL, 1, '2018-07-01 14:01:10', '2018-07-01 14:01:10'),
(8, 2, 1, 1, 2, 1, 0, 0, 0, '2018-07-20', 'test777', '', 3, '2018-07-01 14:02:23', '2018-07-01 18:08:52'),
(9, 1, 1, 1, 2, 1, 0, 0, 0, '2018-07-14', NULL, '', 2, '2018-07-01 14:35:53', '2018-07-01 18:08:40'),
(10, 2, 1, 1, 2, 1, 0, 0, 0, '2018-07-21', NULL, '', 3, '2018-07-01 14:53:51', '2018-07-01 18:09:19'),
(11, 2, 1, 1, 2, 1, 0, 0, 0, '2018-07-21', NULL, '', 4, '2018-07-01 14:54:53', '2018-07-01 18:09:36'),
(12, 1, 1, 1, 2, 1, 0, 0, 0, '2018-07-27', 'test', '', 2, '2018-07-01 18:12:16', '2018-07-01 18:14:13'),
(13, 2, 1, 1, 2, 1, 0, 0, 0, '2018-07-27', NULL, '', 3, '2018-07-01 18:17:50', '2018-07-01 18:25:27'),
(14, 2, 1, 1, 2, 1, 0, 0, 0, '2018-07-05', NULL, '', 2, '2018-07-01 18:21:35', '2018-07-01 18:22:37'),
(15, 1, 1, 1, 2, 1, 4, 1, 1, '2018-07-27', NULL, '', 2, '2018-07-01 18:26:37', '2018-07-01 18:28:31');

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `prices`
--

CREATE TABLE `prices` (
  `client_id` int(11) NOT NULL,
  `printer_id` int(11) NOT NULL,
  `cartridge_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `prices`
--

INSERT INTO `prices` (`client_id`, `printer_id`, `cartridge_id`, `price`, `created_at`, `updated_at`) VALUES
(10, 3, 6, 100, '2018-06-30 20:12:41', '2018-06-30 20:12:41'),
(10, 4, 1, 123, '2018-06-30 20:12:42', '2018-06-30 20:12:42'),
(10, 4, 6, 100, '2018-06-30 20:12:42', '2018-06-30 20:12:42'),
(10, 4, 7, 100, '2018-06-30 20:12:42', '2018-06-30 20:12:42'),
(9, 1, 2, 543, '2018-06-30 20:16:30', '2018-06-30 20:16:30'),
(9, 1, 6, 54354, '2018-06-30 20:16:30', '2018-06-30 20:16:30'),
(9, 1, 7, 45354, '2018-06-30 20:16:30', '2018-06-30 20:16:30'),
(11, 3, 6, 11, '2018-07-01 02:26:43', '2018-07-01 02:26:43'),
(11, 4, 1, 21, '2018-07-01 02:26:43', '2018-07-01 02:26:43'),
(11, 4, 6, 123123, '2018-07-01 02:26:43', '2018-07-01 02:26:43'),
(11, 4, 7, 12, '2018-07-01 02:26:43', '2018-07-01 02:26:43'),
(11, 1, 2, 34, '2018-07-01 02:26:43', '2018-07-01 02:26:43'),
(11, 1, 6, 32, '2018-07-01 02:26:43', '2018-07-01 02:26:43'),
(11, 1, 7, 222, '2018-07-01 02:26:43', '2018-07-01 02:26:43'),
(12, 4, 1, 154, '2018-07-01 02:44:31', '2018-07-01 02:44:31'),
(12, 4, 6, 143, '2018-07-01 02:44:31', '2018-07-01 02:44:31'),
(12, 4, 7, 30, '2018-07-01 02:44:32', '2018-07-01 02:44:32'),
(16, 4, 1, 101, '2018-07-01 09:33:48', '2018-07-01 09:33:48'),
(16, 4, 6, 200, '2018-07-01 09:33:48', '2018-07-01 09:33:48'),
(16, 4, 7, 300, '2018-07-01 09:33:48', '2018-07-01 09:33:48'),
(1, 4, 1, 100, '2018-07-01 18:10:12', '2018-07-01 18:10:12'),
(1, 4, 6, 110, '2018-07-01 18:10:13', '2018-07-01 18:10:13'),
(1, 4, 7, 120, '2018-07-01 18:10:13', '2018-07-01 18:10:13'),
(1, 5, 6, 130, '2018-07-01 18:10:13', '2018-07-01 18:10:13');

-- --------------------------------------------------------

--
-- Структура таблицы `printers`
--

CREATE TABLE `printers` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `printers`
--

INSERT INTO `printers` (`id`, `name`, `created_at`, `updated_at`) VALUES
(4, 'Canon 4432  MFP', '2018-06-30 10:47:02', '2018-06-30 10:47:02'),
(5, 'Hp LaserJet 6534 NFP Pro', '2018-07-01 03:15:39', '2018-07-01 03:15:39');

-- --------------------------------------------------------

--
-- Структура таблицы `regions`
--

CREATE TABLE `regions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `regions`
--

INSERT INTO `regions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Винницкая область', NULL, NULL),
(2, 'Волынская область', NULL, NULL),
(3, 'Днепропетровская область', NULL, NULL),
(4, 'Донецкая область', NULL, NULL),
(5, 'Житомирская область', NULL, NULL),
(6, 'Закарпатская область', NULL, NULL),
(7, 'Запорожская область', NULL, NULL),
(8, 'Ивано-Франковская область', NULL, NULL),
(9, 'Киевская область', NULL, NULL),
(10, 'Кировоградская область', NULL, NULL),
(11, 'Луганская область', NULL, NULL),
(12, 'Львовская область', NULL, NULL),
(13, 'Николаевская область', NULL, NULL),
(14, 'Одесская область', NULL, NULL),
(15, 'Полтавская область', NULL, NULL),
(16, 'Ровненская область', NULL, NULL),
(17, 'Сумская область', NULL, NULL),
(18, 'Тернопольская область', NULL, NULL),
(19, 'Харьковская область', NULL, NULL),
(20, 'Херсонская область', NULL, NULL),
(21, 'Хмельницкая область', NULL, NULL),
(22, 'Черкасская область', NULL, NULL),
(23, 'Черниговская область', NULL, NULL),
(24, 'Черновицкая область', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`, `label`, `created_at`, `updated_at`) VALUES
(1, 'администратор', 'admin', NULL, NULL),
(2, 'администратор предприятия', 'admin_firm', NULL, NULL),
(3, 'заказчик', 'client', NULL, NULL),
(4, 'подрядчик', 'contractor', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `statuses`
--

CREATE TABLE `statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `style` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `statuses`
--

INSERT INTO `statuses` (`id`, `name`, `label`, `style`, `created_at`, `updated_at`) VALUES
(1, 'новый', 'wait', 'danger', NULL, NULL),
(2, 'диагностика', 'diagnostic', 'info', NULL, NULL),
(3, 'в работе', 'work', 'success', NULL, NULL),
(4, 'выдан', 'done', 'warning', NULL, NULL),
(5, 'возврат', 'field', 'default', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `towns`
--

CREATE TABLE `towns` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `towns`
--

INSERT INTO `towns` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Odessa', NULL, NULL),
(2, 'Nikolaev', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `type_works`
--

CREATE TABLE `type_works` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `type_works`
--

INSERT INTO `type_works` (`id`, `name`, `label`, `created_at`, `updated_at`) VALUES
(1, 'заправка', 'filling', NULL, NULL),
(2, 'ремонт', 'repair', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'kuzma', 'kuzma@mail.ru', '$2y$10$2bk638733N84RYGoGijoCOPGiipQwzwAoikNrwXzf0tIHWzuJbfbW', 'TkFG8YWkTz9ZQncX4shbwHc4cpi9ekgnlQKOmltRtnWZM4BmguEnxouo4Cy2', '2018-02-28 07:05:17', '2018-06-07 13:34:49'),
(2, 'user1', 'user1@mail.ru', '$2y$10$j.AbPKA3TwGvHUbt78wFWu03R0skc/7ToMYRnzGunA9.BRGbZEd7e', '1lQxHgHxElUKGAaEHyG0BsFK3mVh0KD176qBMefS0rOzj6nLN87prfMXRrSe', '2018-06-19 11:50:36', '2018-06-19 11:50:36'),
(3, 'admin_firm@mail.ru', 'admin_firm@mail.ru', '$2y$10$UjZy6eJu7aN9tYAdECwMiuT4vI.vXzb1ZHmgrcNmESNoxza8rlm7W', '1sK5OKG8trSRMT1X0J7kLkoQ9VMjOIz9jQ7L0LeAkt8oGn5Fu6PFXDsUlqLK', '2018-06-19 11:52:25', '2018-06-19 11:52:25'),
(4, 'Contractor123', 'contractor@mail.ru', '$2y$10$DAhfrx/kQd4z8ew3z8Bxmet8OktAiRAZAbH7xgqa6ZUImJszJWaxG', 'CEcsUatZwEpv6q1Yj6qNku9QI9zkjq2HcofHrUW4jyEe05a4bKIP1yfUkMOc', '2018-06-19 11:53:25', '2018-06-19 11:55:09'),
(5, 'test', 'test123@mail.ru', '$2y$10$EEWO8vl2DwvR.J1hdYBN7OfGUI9jROQEk0Y65t7bkikKu5g5rnE1a', 'ycZZ3K77oHo3NV5jh5dbTbTRN1FaqzXLZaOeue7RFFvECeNPJv0oCLwDTqU1', '2018-06-29 13:05:04', '2018-06-29 13:05:04'),
(6, 'y7676576', '65465@kj.ey', '$2y$10$gPTkGD00DwV025VcU53xQOZCw3CA/rMFQRHcHQJXS7cU1wRSDp/hG', NULL, '2018-06-29 13:31:01', '2018-06-29 13:31:01'),
(7, 'ujytuy', 'tetetretr@trdstr.ri', '$2y$10$qntcW5/igK2tm3cggC7zV.J8XyahaD.rBk6lUGxvYPwjti1ZYpEhC', NULL, '2018-06-29 13:36:53', '2018-06-29 13:36:53');

-- --------------------------------------------------------

--
-- Структура таблицы `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firm_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `status` enum('on','off') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `user_id`, `role_id`, `name`, `phone`, `firm_id`, `branch_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'kuzma', '43243243', 0, 0, 'on', NULL, '2018-06-09 05:37:15'),
(2, 2, 3, 'TREtretre', '4532432432', 1, 1, 'on', '2018-06-19 11:50:36', '2018-06-19 11:50:36'),
(3, 3, 2, 'Yytruy', '654654654', 1, 0, 'on', '2018-06-19 11:52:25', '2018-06-19 11:52:25'),
(4, 4, 4, 'YTrytytre', '5454354', 1, 0, 'on', '2018-06-19 11:53:25', '2018-06-19 11:53:25'),
(5, 5, 3, 'ybvnvf', '543543543', 1, 1, 'on', '2018-06-29 13:05:04', '2018-06-29 13:05:04'),
(6, 6, 3, 'FGhghg', '54354354', 1, 1, 'on', '2018-06-29 13:31:01', '2018-06-29 13:31:01'),
(7, 7, 4, 'jhgjhgjh', '65465465', 3, 0, 'on', '2018-06-29 13:36:53', '2018-06-29 13:38:19');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cartridges`
--
ALTER TABLE `cartridges`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `contractors`
--
ALTER TABLE `contractors`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `firms`
--
ALTER TABLE `firms`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `helps`
--
ALTER TABLE `helps`
  ADD PRIMARY KEY (`id`);

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
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `printers`
--
ALTER TABLE `printers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `towns`
--
ALTER TABLE `towns`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `type_works`
--
ALTER TABLE `type_works`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Индексы таблицы `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cartridges`
--
ALTER TABLE `cartridges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT для таблицы `contractors`
--
ALTER TABLE `contractors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `firms`
--
ALTER TABLE `firms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `helps`
--
ALTER TABLE `helps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT для таблицы `printers`
--
ALTER TABLE `printers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `towns`
--
ALTER TABLE `towns`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `type_works`
--
ALTER TABLE `type_works`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
