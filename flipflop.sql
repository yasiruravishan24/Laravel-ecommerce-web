-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2022 at 09:04 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flipflop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `logout_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `firstName`, `lastName`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `logout_at`) VALUES
(1, 'Admin', 'Test', 'admin@gmail.com', NULL, '$2y$10$qpcRhrr8WLBti2ub2L8XP.YSoMXP/Ef7gZMSuxxRCJimPmirZJuXy', NULL, NULL, '2022-07-25 17:02:45', '2022-07-25 17:02:45');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand`, `created_at`, `updated_at`) VALUES
(1, 'Nike', '2022-02-16 13:20:50', '2022-02-16 13:20:50'),
(2, 'Adidas', '2022-02-16 13:20:50', '2022-02-16 13:20:50'),
(3, 'Puma', '2022-02-16 13:20:50', '2022-02-16 13:20:50'),
(4, 'Fila', '2022-02-16 13:20:50', '2022-02-16 13:20:50'),
(5, 'Timberland', '2022-02-16 13:20:50', '2022-02-16 13:20:50'),
(6, 'New Balance', '2022-02-16 13:20:50', '2022-02-16 13:20:50'),
(7, 'Lacoste', '2022-02-16 13:20:50', '2022-02-16 13:20:50'),
(8, 'Yezzy', '2022-02-16 13:20:50', '2022-02-16 13:20:50');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE `cart_item` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `categoryName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoryValue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categoryName`, `categoryValue`, `created_at`, `updated_at`) VALUES
(1, 'Men', 'M', NULL, NULL),
(2, 'Women', 'W', NULL, NULL),
(3, 'Kids', 'K', NULL, NULL),
(4, 'Stock Clearance', 'C', NULL, NULL),
(5, 'New Arrival', 'A', NULL, NULL),
(6, 'Top Trending', 'T', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `delivers`
--

CREATE TABLE `delivers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `notice_no` int(11) DEFAULT NULL,
  `deliver_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `settlement_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `total_bill` int(11) NOT NULL,
  `discountAmount` int(11) DEFAULT NULL,
  `taxAmount` int(11) DEFAULT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_receipt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_item`
--

CREATE TABLE `invoice_item` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brandName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `skuNo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagePath` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `brandName`, `skuNo`, `price`, `quantity`, `description`, `imagePath`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Swift Run X', 'Adidas', 'A-001', 5500, 2, 'A court look emerges on the streets. These shoes have a sleek leather-like \r\nupper punctuated with perforated 3-Stripes. \r\nThe low-profile shape rides on a smooth rubber cupsole.\r\nStripped-down sports style. Showing off a clean look, \r\nthese tennis-inspired shoes have a smooth leather upper. \r\nPerforated 3-Stripes detail the sides.\r\nA cushioned sockliner brings comfort to every step', '1643571385-Swift Run X Shoes..png', '2022-01-30 19:36:25', '2022-03-01 05:38:13', NULL),
(2, 'Adilette Lite Slides', 'Adidas', 'A-002', 5000, 4, 'A court look emerges on the streets. These shoes have a sleek leather-like \r\nupper punctuated with perforated 3-Stripes. \r\nThe low-profile shape rides on a smooth rubber cupsole.\r\nStripped-down sports style. Showing off a clean look, \r\nthese tennis-inspired shoes have a smooth leather upper. \r\nPerforated 3-Stripes detail the sides.\r\nA cushioned sockliner brings comfort to every step', '1643571432-Adilette Lite Slides..png', '2022-01-30 19:37:12', '2022-03-17 13:25:52', NULL),
(3, 'Multix  blue', 'Adidas', 'A-003', 6000, 2, 'A court look emerges on the streets. These shoes have a sleek leather-like \r\nupper punctuated with perforated 3-Stripes. \r\nThe low-profile shape rides on a smooth rubber cupsole.\r\nStripped-down sports style. Showing off a clean look, \r\nthese tennis-inspired shoes have a smooth leather upper. \r\nPerforated 3-Stripes detail the sides.\r\nA cushioned sockliner brings comfort to every step', '1643571498-Multix  blue..png', '2022-01-30 19:38:18', '2022-02-12 18:51:33', NULL),
(4, 'ZX 1K pink', 'Adidas', 'A-004', 4000, 2, 'A court look emerges on the streets. These shoes have a sleek leather-like \r\nupper punctuated with perforated 3-Stripes. \r\nThe low-profile shape rides on a smooth rubber cupsole.\r\nStripped-down sports style. Showing off a clean look, \r\nthese tennis-inspired shoes have a smooth leather upper. \r\nPerforated 3-Stripes detail the sides.\r\nA cushioned sockliner brings comfort to every step', '1643571583-ZX 1K pink..png', '2022-01-30 19:39:43', '2022-03-02 05:41:10', NULL),
(5, 'Racer TR21', 'Adidas', 'A-005', 3000, 0, 'A court look emerges on the streets. These shoes have a sleek leather-like \r\nupper punctuated with perforated 3-Stripes. \r\nThe low-profile shape rides on a smooth rubber cupsole.\r\nStripped-down sports style. Showing off a clean look, \r\nthese tennis-inspired shoes have a smooth leather upper. \r\nPerforated 3-Stripes detail the sides.\r\nA cushioned sockliner brings comfort to every step', '1643571634-Racer TR21..png', '2022-01-30 19:40:34', '2022-03-10 06:11:42', NULL),
(6, 'Swift Lite kids', 'Adidas', 'A-006', 4500, 4, 'A court look emerges on the streets. These shoes have a sleek leather-like \r\nupper punctuated with perforated 3-Stripes. \r\nThe low-profile shape rides on a smooth rubber cupsole.\r\nStripped-down sports style. Showing off a clean look, \r\nthese tennis-inspired shoes have a smooth leather upper. \r\nPerforated 3-Stripes detail the sides.\r\nA cushioned sockliner brings comfort to every step', '1643571701-Swift Lite kids..png', '2022-01-30 19:41:41', '2022-03-17 14:05:33', NULL),
(7, 'Adilette mickey', 'Adidas', 'A-007', 4000, 0, 'A court look emerges on the streets. These shoes have a sleek leather-like \r\nupper punctuated with perforated 3-Stripes. \r\nThe low-profile shape rides on a smooth rubber cupsole.\r\nStripped-down sports style. Showing off a clean look, \r\nthese tennis-inspired shoes have a smooth leather upper. \r\nPerforated 3-Stripes detail the sides.\r\nA cushioned sockliner brings comfort to every step', '1643571784-Adilette mickey..png', '2022-01-30 19:43:04', '2022-03-16 06:24:39', NULL),
(8, 'Stan Smith', 'Adidas', 'A-008', 7000, 0, 'A court look emerges on the streets. These shoes have a sleek leather-like \r\nupper punctuated with perforated 3-Stripes. \r\nThe low-profile shape rides on a smooth rubber cupsole.\r\nStripped-down sports style. Showing off a clean look, \r\nthese tennis-inspired shoes have a smooth leather upper. \r\nPerforated 3-Stripes detail the sides.\r\nA cushioned sockliner brings comfort to every step', '1643571858-Stan Smith(..png', '2022-01-30 19:44:18', '2022-06-11 18:31:06', NULL),
(9, 'ZX lite', 'Adidas', 'A-009', 5000, 4, 'A court look emerges on the streets. These shoes have a sleek leather-like \r\nupper punctuated with perforated 3-Stripes. \r\nThe low-profile shape rides on a smooth rubber cupsole.\r\nStripped-down sports style. Showing off a clean look, \r\nthese tennis-inspired shoes have a smooth leather upper. \r\nPerforated 3-Stripes detail the sides.\r\nA cushioned sockliner brings comfort to every step', '1643571936-ZX lite..png', '2022-01-30 19:45:36', '2022-03-27 11:22:56', NULL),
(10, 'Adidas Superstar', 'Adidas', 'A-010', 4000, 1, 'A court look emerges on the streets. These shoes have a sleek leather-like \r\nupper punctuated with perforated 3-Stripes. \r\nThe low-profile shape rides on a smooth rubber cupsole.\r\nStripped-down sports style. Showing off a clean look, \r\nthese tennis-inspired shoes have a smooth leather upper. \r\nPerforated 3-Stripes detail the sides.\r\nA cushioned sockliner brings comfort to every step', '1643572000-Adidas Superstar..png', '2022-01-30 19:46:40', '2022-03-07 06:06:20', NULL),
(11, 'adidas Forum', 'Adidas', 'A-011', 6000, 2, 'A court look emerges on the streets. These shoes have a sleek leather-like \r\nupper punctuated with perforated 3-Stripes. \r\nThe low-profile shape rides on a smooth rubber cupsole.\r\nStripped-down sports style. Showing off a clean look, \r\nthese tennis-inspired shoes have a smooth leather upper. \r\nPerforated 3-Stripes detail the sides.\r\nA cushioned sockliner brings comfort to every step', '1643572078-adidas Forum..png', '2022-01-30 19:47:58', '2022-03-01 05:36:59', NULL),
(12, 'adilette f1', 'Adidas', 'A-012', 7000, 0, 'A court look emerges on the streets. These shoes have a sleek leather-like \r\nupper punctuated with perforated 3-Stripes. \r\nThe low-profile shape rides on a smooth rubber cupsole.\r\nStripped-down sports style. Showing off a clean look, \r\nthese tennis-inspired shoes have a smooth leather upper. \r\nPerforated 3-Stripes detail the sides.\r\nA cushioned sockliner brings comfort to every step', '1643572208-adilette f1..png', '2022-01-30 19:50:08', '2022-03-07 06:06:20', NULL),
(13, 'adidas Swift L1', 'Adidas', 'A-013', 4000, 0, 'A court look emerges on the streets. These shoes have a sleek leather-like \r\nupper punctuated with perforated 3-Stripes. \r\nThe low-profile shape rides on a smooth rubber cupsole.\r\nStripped-down sports style. Showing off a clean look, \r\nthese tennis-inspired shoes have a smooth leather upper. \r\nPerforated 3-Stripes detail the sides.\r\nA cushioned sockliner brings comfort to every step', '1643572276-adidas Swift L1..png', '2022-01-30 19:51:16', '2022-03-04 05:44:20', NULL),
(14, 'Adidas Nizza F9', 'Adidas', 'A-014', 5000, 2, 'A court look emerges on the streets. These shoes have a sleek leather-like \r\nupper punctuated with perforated 3-Stripes. \r\nThe low-profile shape rides on a smooth rubber cupsole.\r\nStripped-down sports style. Showing off a clean look, \r\nthese tennis-inspired shoes have a smooth leather upper. \r\nPerforated 3-Stripes detail the sides.\r\nA cushioned sockliner brings comfort to every step', '1643572334-Adidas Nizza F9..png', '2022-01-30 19:52:14', '2022-01-30 19:52:14', NULL),
(15, 'Superstar rose', 'Adidas', 'A-015', 6500, 0, 'A court look emerges on the streets. These shoes have a sleek leather-like \r\nupper punctuated with perforated 3-Stripes. \r\nThe low-profile shape rides on a smooth rubber cupsole.\r\nStripped-down sports style. Showing off a clean look, \r\nthese tennis-inspired shoes have a smooth leather upper. \r\nPerforated 3-Stripes detail the sides.\r\nA cushioned sockliner brings comfort to every step', '1643572529-Superstar rose..png', '2022-01-30 19:55:29', '2022-03-01 05:35:42', NULL),
(16, 'Racer TR21', 'Adidas', 'A-016', 5000, 0, 'A court look emerges on the streets. These shoes have a sleek leather-like \r\nupper punctuated with perforated 3-Stripes. \r\nThe low-profile shape rides on a smooth rubber cupsole.\r\nStripped-down sports style. Showing off a clean look, \r\nthese tennis-inspired shoes have a smooth leather upper. \r\nPerforated 3-Stripes detail the sides.\r\nA cushioned sockliner brings comfort to every step', '1643572628-Racer TR21..png', '2022-01-30 19:57:08', '2022-06-11 18:34:00', NULL),
(17, 'ULTRABOOST 22', 'Adidas', 'A-017', 4000, 1, 'A court look emerges on the streets. These shoes have a sleek leather-like \r\nupper punctuated with perforated 3-Stripes. \r\nThe low-profile shape rides on a smooth rubber cupsole.\r\nStripped-down sports style. Showing off a clean look, \r\nthese tennis-inspired shoes have a smooth leather upper. \r\nPerforated 3-Stripes detail the sides.\r\nA cushioned sockliner brings comfort to every step', '1643572705-ULTRABOOST 22..png', '2022-01-30 19:58:25', '2022-03-06 05:59:54', NULL),
(18, 'NMD R1 Primeblue', 'Adidas', 'A-018', 7000, 1, 'A court look emerges on the streets. These shoes have a sleek leather-like \r\nupper punctuated with perforated 3-Stripes. \r\nThe low-profile shape rides on a smooth rubber cupsole.\r\nStripped-down sports style. Showing off a clean look, \r\nthese tennis-inspired shoes have a smooth leather upper. \r\nPerforated 3-Stripes detail the sides.\r\nA cushioned sockliner brings comfort to every step', '1643572765-NMD R1 Primeblue..png', '2022-01-30 19:59:25', '2022-03-10 06:13:12', NULL),
(19, 'Adidas Supernova', 'Adidas', 'A-019', 5500, 1, 'A court look emerges on the streets. These shoes have a sleek leather-like \r\nupper punctuated with perforated 3-Stripes. \r\nThe low-profile shape rides on a smooth rubber cupsole.\r\nStripped-down sports style. Showing off a clean look, \r\nthese tennis-inspired shoes have a smooth leather upper. \r\nPerforated 3-Stripes detail the sides.\r\nA cushioned sockliner brings comfort to every step', '1643572813-Adidas Supernova..png', '2022-01-30 20:00:13', '2022-03-05 05:54:36', NULL),
(20, 'QT Racer', 'Adidas', 'A-020', 6000, 1, 'A court look emerges on the streets. These shoes have a sleek leather-like \r\nupper punctuated with perforated 3-Stripes. \r\nThe low-profile shape rides on a smooth rubber cupsole.\r\nStripped-down sports style. Showing off a clean look, \r\nthese tennis-inspired shoes have a smooth leather upper. \r\nPerforated 3-Stripes detail the sides.\r\nA cushioned sockliner brings comfort to every step', '1643572890-QT Racer..png', '2022-01-30 20:01:30', '2022-03-17 14:05:33', NULL),
(21, 'NMD R3 Primered', 'Adidas', 'A-021', 5600, 0, 'A court look emerges on the streets. These shoes have a sleek leather-like \r\nupper punctuated with perforated 3-Stripes. \r\nThe low-profile shape rides on a smooth rubber cupsole.\r\nStripped-down sports style. Showing off a clean look, \r\nthese tennis-inspired shoes have a smooth leather upper. \r\nPerforated 3-Stripes detail the sides.\r\nA cushioned sockliner brings comfort to every step', '1643572957-NMD R3 Primered..png', '2022-01-30 20:02:37', '2022-03-04 05:45:07', NULL),
(22, 'QT Racer r2', 'Adidas', 'A-022', 4500, 1, 'A court look emerges on the streets. These shoes have a sleek leather-like \r\nupper punctuated with perforated 3-Stripes. \r\nThe low-profile shape rides on a smooth rubber cupsole.\r\nStripped-down sports style. Showing off a clean look, \r\nthese tennis-inspired shoes have a smooth leather upper. \r\nPerforated 3-Stripes detail the sides.\r\nA cushioned sockliner brings comfort to every step', '1643573068-QT Racer r2..png', '2022-01-30 20:04:28', '2022-03-12 06:14:28', NULL),
(23, 'Air Fly By U Uptempo', 'Nike', 'N-23', 3000, 2, 'Journey off the beaten path and into wet weather with the Nike Pegasus Trail 3 GORE-TEX. It\'s made with the same cushioned comfort you love, plus tough traction and improved midfoot construction for secure, neutral support. The waterproof upper helps keep you moving on rocky trails even when stormy conditions try to slow you down. Don\'t let the rain stop you, lace up and take on the elements.', '1647509365-Air Fly By U Uptempo..png', '2022-02-14 09:29:25', '2022-03-17 14:11:22', NULL),
(24, 'Zoom Haven', 'Nike', 'N-24', 4000, 0, 'Journey off the beaten path and into wet weather with the Nike Pegasus Trail 3 GORE-TEX. It\'s made with the same cushioned comfort you love, plus tough traction and improved midfoot construction for secure, neutral support. The waterproof upper helps keep you moving on rocky trails even when stormy conditions try to slow you down. Don\'t let the rain stop you, lace up and take on the elements.', '1647509446-Zoom Haven..png', '2022-02-16 09:30:46', '2022-03-07 06:01:58', NULL),
(25, 'Air Force III', 'Nike', 'N-25', 5000, 0, 'Journey off the beaten path and into wet weather with the Nike Pegasus Trail 3 GORE-TEX. It\'s made with the same cushioned comfort you love, plus tough traction and improved midfoot construction for secure, neutral support. The waterproof upper helps keep you moving on rocky trails even when stormy conditions try to slow you down. Don\'t let the rain stop you, lace up and take on the elements.', '1647509511-Air Force III..png', '2022-03-17 09:31:51', '2022-03-12 06:23:05', NULL),
(26, 'Zoom JTS', 'Nike', 'N-26', 3000, 0, 'Journey off the beaten path and into wet weather with the Nike Pegasus Trail 3 GORE-TEX. It\'s made with the same cushioned comfort you love, plus tough traction and improved midfoot construction for secure, neutral support. The waterproof upper helps keep you moving on rocky trails even when stormy conditions try to slow you down. Don\'t let the rain stop you, lace up and take on the elements.', '1647510749-Zoom JTS..png', '2022-02-07 09:52:29', '2022-03-05 05:55:52', NULL),
(27, 'air Force STS', 'Nike', 'N-27', 5000, 1, 'Journey off the beaten path and into wet weather with the Nike Pegasus Trail 3 GORE-TEX. It\'s made with the same cushioned comfort you love, plus tough traction and improved midfoot construction for secure, neutral support. The waterproof upper helps keep you moving on rocky trails even when stormy conditions try to slow you down. Don\'t let the rain stop you, lace up and take on the elements.', '1647510819-air Force STS..png', '2022-03-17 09:53:39', '2022-03-05 05:53:30', NULL),
(28, 'Zoom Hyperfuse', 'Nike', 'N-28', 4000, 2, 'Journey off the beaten path and into wet weather with the Nike Pegasus Trail 3 GORE-TEX. It\'s made with the same cushioned comfort you love, plus tough traction and improved midfoot construction for secure, neutral support. The waterproof upper helps keep you moving on rocky trails even when stormy conditions try to slow you down. Don\'t let the rain stop you, lace up and take on the elements.', '1647510895-Zoom Hyperfuse..png', '2022-03-01 09:54:55', '2022-03-17 14:12:07', NULL),
(29, 'Air challenge LWP', 'Nike', 'N-29', 4000, 2, 'Journey off the beaten path and into wet weather with the Nike Pegasus Trail 3 GORE-TEX. It\'s made with the same cushioned comfort you love, plus tough traction and improved midfoot construction for secure, neutral support. The waterproof upper helps keep you moving on rocky trails even when stormy conditions try to slow you down. Don\'t let the rain stop you, lace up and take on the elements.', '1647510952-Air challenge LWP..png', '2022-03-23 09:55:52', '2022-03-17 14:12:26', NULL),
(30, 'Air max Plus', 'Nike', 'N-30', 5000, 1, 'Journey off the beaten path and into wet weather with the Nike Pegasus Trail 3 GORE-TEX. It\'s made with the same cushioned comfort you love, plus tough traction and improved midfoot construction for secure, neutral support. The waterproof upper helps keep you moving on rocky trails even when stormy conditions try to slow you down. Don\'t let the rain stop you, lace up and take on the elements.', '1647510994-Air max Plus..png', '2022-03-07 09:56:34', '2022-03-17 13:31:46', NULL),
(31, 'Adidas Yeezy 350 V2', 'Yezzy', 'Y-31', 3000, 1, 'Initially released in February 2018 as a limited pre-order in New York and Los Angeles, the Yeezy 500 ‘Blush’ underwent a general release in April 2018. Its moniker is a fitting one, as the monochromatic light taupe finish barely registers as a color. The subdued palette is contrasted by a bold silhouette, featuring a paneled mesh and suede upper combined with a hefty midsole reminiscent of adidas’ Feet You Wear\' technology of the 1990s.', '1647511202-Adidas Yeezy 350 V2..png', '2022-02-27 10:00:02', '2022-03-17 13:37:34', NULL),
(32, 'Adidas Yeezy 700', 'Yezzy', 'Y-32', 2000, 2, 'Initially released in February 2018 as a limited pre-order in New York and Los Angeles, the Yeezy 500 ‘Blush’ underwent a general release in April 2018. Its moniker is a fitting one, as the monochromatic light taupe finish barely registers as a color. The subdued palette is contrasted by a bold silhouette, featuring a paneled mesh and suede upper combined with a hefty midsole reminiscent of adidas’ Feet You Wear\' technology of the 1990s.', '1647511273-Adidas Yeezy 700..png', '2022-03-02 10:01:13', '2022-03-17 10:01:13', NULL),
(33, 'Adidas Yeezy Slide', 'Yezzy', 'Y-33', 3000, 1, 'Initially released in February 2018 as a limited pre-order in New York and Los Angeles, the Yeezy 500 ‘Blush’ underwent a general release in April 2018. Its moniker is a fitting one, as the monochromatic light taupe finish barely registers as a color. The subdued palette is contrasted by a bold silhouette, featuring a paneled mesh and suede upper combined with a hefty midsole reminiscent of adidas’ Feet You Wear\' technology of the 1990s.', '1647511329-Adidas Yeezy Slide..png', '2022-03-12 10:02:09', '2022-03-17 10:02:09', NULL),
(34, 'Adidas Yeezy Foam', 'Yezzy', 'Y-34', 3000, 1, 'Initially released in February 2018 as a limited pre-order in New York and Los Angeles, the Yeezy 500 ‘Blush’ underwent a general release in April 2018. Its moniker is a fitting one, as the monochromatic light taupe finish barely registers as a color. The subdued palette is contrasted by a bold silhouette, featuring a paneled mesh and suede upper combined with a hefty midsole reminiscent of adidas’ Feet You Wear\' technology of the 1990s.', '1647511440-Adidas Yeezy Foam..png', '2022-03-17 10:04:01', '2022-03-17 10:04:01', NULL),
(35, 'Adidas Yeezy Boost', 'Yezzy', 'Y-35', 5000, 1, 'Initially released in February 2018 as a limited pre-order in New York and Los Angeles, the Yeezy 500 ‘Blush’ underwent a general release in April 2018. Its moniker is a fitting one, as the monochromatic light taupe finish barely registers as a color. The subdued palette is contrasted by a bold silhouette, featuring a paneled mesh and suede upper combined with a hefty midsole reminiscent of adidas’ Feet You Wear\' technology of the 1990s.', '1647511493-Adidas Yeezy Boost..png', '2022-03-17 10:04:53', '2022-03-17 13:56:14', NULL),
(36, 'Adidas Yeezy QNTM', 'Yezzy', 'Y-36', 5000, 1, 'Initially released in February 2018 as a limited pre-order in New York and Los Angeles, the Yeezy 500 ‘Blush’ underwent a general release in April 2018. Its moniker is a fitting one, as the monochromatic light taupe finish barely registers as a color. The subdued palette is contrasted by a bold silhouette, featuring a paneled mesh and suede upper combined with a hefty midsole reminiscent of adidas’ Feet You Wear\' technology of the 1990s.', '1647511545-Adidas Yeezy QNTM..png', '2022-02-12 10:05:45', '2022-03-17 13:59:43', NULL),
(37, 'Adidas Yeezy 350', 'Yezzy', 'Y-37', 5500, 3, 'Initially released in February 2018 as a limited pre-order in New York and Los Angeles, the Yeezy 500 ‘Blush’ underwent a general release in April 2018. Its moniker is a fitting one, as the monochromatic light taupe finish barely registers as a color. The subdued palette is contrasted by a bold silhouette, featuring a paneled mesh and suede upper combined with a hefty midsole reminiscent of adidas’ Feet You Wear\' technology of the 1990s.', '1647511610-Adidas Yeezy 350..png', '2022-03-17 10:06:50', '2022-03-17 13:51:21', NULL),
(38, 'Adidas Yeezy V3', 'Yezzy', 'Y-38', 3000, 2, 'Initially released in February 2018 as a limited pre-order in New York and Los Angeles, the Yeezy 500 ‘Blush’ underwent a general release in April 2018. Its moniker is a fitting one, as the monochromatic light taupe finish barely registers as a color. The subdued palette is contrasted by a bold silhouette, featuring a paneled mesh and suede upper combined with a hefty midsole reminiscent of adidas’ Feet You Wear\' technology of the 1990s.', '1647511700-Adidas Yeezy V3..png', '2022-03-15 10:08:20', '2022-03-17 13:45:55', NULL),
(39, 'Adidas Yeezy High', 'Yezzy', 'Y-39', 4000, 1, 'Initially released in February 2018 as a limited pre-order in New York and Los Angeles, the Yeezy 500 ‘Blush’ underwent a general release in April 2018. Its moniker is a fitting one, as the monochromatic light taupe finish barely registers as a color. The subdued palette is contrasted by a bold silhouette, featuring a paneled mesh and suede upper combined with a hefty midsole reminiscent of adidas’ Feet You Wear\' technology of the 1990s.', '1647511804-Adidas Yeezy High..png', '2022-03-18 10:10:04', '2022-03-17 14:07:36', NULL),
(40, 'Lacoste Marice', 'Lacoste', 'L-40', 2500, 1, 'The Piloter Tassel is Lacoste\'s sport-inspired take on the classic driving shoe. This refined slip-on style is crafted from super-soft black leather, and embellished with stitch-work detailing on the vamp and a traditional double tassel. The collar has a debossed crocodile-effect texture for a sophisticated spin, and the embroidered crocodile sits on the heel. \r\nA symbol of summer sophistication, let it effortlessly transport you from day to evening looks', '1647511866-Lacoste Marice..png', '2022-03-19 10:11:06', '2022-03-17 13:53:58', NULL),
(41, 'Lacoste Carnaby', 'Lacoste', 'L-41', 3000, 2, 'The Piloter Tassel is Lacoste\'s sport-inspired take on the classic driving shoe. This refined slip-on style is crafted from super-soft black leather, and embellished with stitch-work detailing on the vamp and a traditional double tassel. The collar has a debossed crocodile-effect texture for a sophisticated spin, and the embroidered crocodile sits on the heel. \r\nA symbol of summer sophistication, let it effortlessly transport you from day to evening looks', '1647511911-Lacoste Carnaby..png', '2022-03-17 10:11:51', '2022-03-17 10:11:51', NULL),
(42, 'Lacoste Marthe', 'Lacoste', 'L-42', 4000, 2, 'The Piloter Tassel is Lacoste\'s sport-inspired take on the classic driving shoe. This refined slip-on style is crafted from super-soft black leather, and embellished with stitch-work detailing on the vamp and a traditional double tassel. The collar has a debossed crocodile-effect texture for a sophisticated spin, and the embroidered crocodile sits on the heel. \r\nA symbol of summer sophistication, let it effortlessly transport you from day to evening looks', '1647511956-Lacoste Marthe..png', '2022-03-17 10:12:36', '2022-03-17 10:12:36', NULL),
(43, 'Locoste Rey', 'Lacoste', 'L-43', 4000, 2, 'The Piloter Tassel is Lacoste\'s sport-inspired take on the classic driving shoe. This refined slip-on style is crafted from super-soft black leather, and embellished with stitch-work detailing on the vamp and a traditional double tassel. The collar has a debossed crocodile-effect texture for a sophisticated spin, and the embroidered crocodile sits on the heel. \r\nA symbol of summer sophistication, let it effortlessly transport you from day to evening looks', '1647512011-Locoste Rey..png', '2022-02-19 10:13:31', '2022-03-17 13:44:26', NULL),
(44, 'Locoste Chaymon', 'Lacoste', 'L-44', 5000, 2, 'The Piloter Tassel is Lacoste\'s sport-inspired take on the classic driving shoe. This refined slip-on style is crafted from super-soft black leather, and embellished with stitch-work detailing on the vamp and a traditional double tassel. The collar has a debossed crocodile-effect texture for a sophisticated spin, and the embroidered crocodile sits on the heel. \r\nA symbol of summer sophistication, let it effortlessly transport you from day to evening looks', '1647512052-Locoste Chaymon..png', '2022-03-17 10:14:12', '2022-03-17 10:14:12', NULL),
(45, 'Lacoste Europa', 'Lacoste', 'L-45', 6000, 2, 'The Piloter Tassel is Lacoste\'s sport-inspired take on the classic driving shoe. This refined slip-on style is crafted from super-soft black leather, and embellished with stitch-work detailing on the vamp and a traditional double tassel. The collar has a debossed crocodile-effect texture for a sophisticated spin, and the embroidered crocodile sits on the heel. \r\nA symbol of summer sophistication, let it effortlessly transport you from day to evening looks', '1647512113-Lacoste Europa..png', '2022-03-14 10:15:13', '2022-03-17 10:15:13', NULL),
(46, 'Lacoste Ampthill', 'Lacoste', 'L-46', 6000, 2, 'The Piloter Tassel is Lacoste\'s sport-inspired take on the classic driving shoe. This refined slip-on style is crafted from super-soft black leather, and embellished with stitch-work detailing on the vamp and a traditional double tassel. The collar has a debossed crocodile-effect texture for a sophisticated spin, and the embroidered crocodile sits on the heel. \r\nA symbol of summer sophistication, let it effortlessly transport you from day to evening looks', '1647512196-Lacoste Ampthill..png', '2022-03-17 10:16:36', '2022-03-17 10:16:36', NULL),
(47, 'Lacoste Carnaby', 'Lacoste', 'L-47', 6500, 3, 'The Piloter Tassel is Lacoste\'s sport-inspired take on the classic driving shoe. This refined slip-on style is crafted from super-soft black leather, and embellished with stitch-work detailing on the vamp and a traditional double tassel. The collar has a debossed crocodile-effect texture for a sophisticated spin, and the embroidered crocodile sits on the heel. \r\nA symbol of summer sophistication, let it effortlessly transport you from day to evening looks', '1647512244-Lacoste Carnaby..png', '2022-03-17 10:17:24', '2022-03-17 13:38:18', NULL),
(48, 'Lacoste Court', 'Lacoste', 'L-48', 4000, 1, 'The Piloter Tassel is Lacoste\'s sport-inspired take on the classic driving shoe. This refined slip-on style is crafted from super-soft black leather, and embellished with stitch-work detailing on the vamp and a traditional double tassel. The collar has a debossed crocodile-effect texture for a sophisticated spin, and the embroidered crocodile sits on the heel. \r\nA symbol of summer sophistication, let it effortlessly transport you from day to evening looks', '1647512294-Lacoste Court..png', '2022-03-21 10:18:14', '2022-03-17 10:18:14', NULL),
(49, 'Disruptor 2', 'Fila', 'F-49', 3000, 2, 'Fila has reached back into the archives and brought back this timeless heritage basketball shoe. The styling, material and colors make the look fashionable and contemporary. A true inspiration combining function and fashion.', '1647521214-Disruptor 2..png', '2022-03-22 12:46:54', '2022-03-17 12:46:54', NULL),
(50, 'Tennls 88', 'Fila', 'F-50', 4000, 1, 'Fila has reached back into the archives and brought back this timeless heritage basketball shoe. The styling, material and colors make the look fashionable and contemporary. A true inspiration combining function and fashion.', '1647521261-Tennls 88..png', '2022-03-17 12:47:41', '2022-03-17 12:47:41', NULL),
(51, 'Tactik 3 Nuceus', 'Fila', 'F-51', 4000, 1, 'Fila has reached back into the archives and brought back this timeless heritage basketball shoe. The styling, material and colors make the look fashionable and contemporary. A true inspiration combining function and fashion.', '1647521299-Tactik 3 Nuceus..png', '2022-03-17 12:48:19', '2022-03-17 12:48:19', NULL),
(52, 'Men\'s Mb', 'Fila', 'F-52', 5000, 2, 'Fila has reached back into the archives and brought back this timeless heritage basketball shoe. The styling, material and colors make the look fashionable and contemporary. A true inspiration combining function and fashion.', '1647521343-Men\'s Mb..png', '2022-03-23 12:49:03', '2022-03-17 12:49:03', NULL),
(53, 'Men\'s Sandenal', 'Fila', 'F-53', 6000, 1, 'Fila has reached back into the archives and brought back this timeless heritage basketball shoe. The styling, material and colors make the look fashionable and contemporary. A true inspiration combining function and fashion.', '1647521390-Men\'s Sandenal..png', '2022-03-17 12:49:50', '2022-03-17 12:49:50', NULL),
(54, 'Men\'s Renno', 'Fila', 'F-54', 6500, 1, 'Fila has reached back into the archives and brought back this timeless heritage basketball shoe. The styling, material and colors make the look fashionable and contemporary. A true inspiration combining function and fashion.', '1647521458-Men\'s Renno..png', '2022-02-07 12:50:58', '2022-03-17 13:46:29', NULL),
(55, 'Men\'s Mb', 'Fila', 'F-55', 7000, 1, 'Fila has reached back into the archives and brought back this timeless heritage basketball shoe. The styling, material and colors make the look fashionable and contemporary. A true inspiration combining function and fashion.', '1647521517-Men\'s Mb..png', '2022-03-17 12:51:57', '2022-03-17 14:06:15', NULL),
(56, 'Women\'s grant hill', 'Fila', 'F-56', 6000, 1, 'Fila has reached back into the archives and brought back this timeless heritage basketball shoe. The styling, material and colors make the look fashionable and contemporary. A true inspiration combining function and fashion.', '1647521572-Women\'s grant hill..png', '2022-02-06 12:52:52', '2022-03-17 13:46:29', NULL),
(57, 'Women\'s Oakmont Mid', 'Fila', 'F-57', 7000, 2, 'Fila has reached back into the archives and brought back this timeless heritage basketball shoe. The styling, material and colors make the look fashionable and contemporary. A true inspiration combining function and fashion.', '1647521605-Women\'s Oakmont Mid..png', '2022-03-17 12:53:25', '2022-03-17 12:53:25', NULL),
(58, 'Women\'s Oakmont Tr', 'Fila', 'F-59', 8000, 2, 'Fila has reached back into the archives and brought back this timeless heritage basketball shoe. The styling, material and colors make the look fashionable and contemporary. A true inspiration combining function and fashion.', '1647521639-Women\'s Oakmont Tr..png', '2022-03-16 12:53:59', '2022-03-17 13:34:43', NULL),
(59, 'Fresh Foam X 860v12', 'New Balance', 'N-59', 4000, 3, 'Whether you\'re hitting the gym or the streets, take your sporty style to a new level with the performance-driven Fresh Foam Roav v2 women\'s sneaker. The bold colors will add drive to your step, with breathable synthetic and mesh materials to keep you comfortable all day long. Fresh Foam midsole cushioning and rubber outsole pods are soft and plush to help you go the distance', '1647521711-Fresh Foam X 860v12..png', '2022-03-05 12:55:11', '2022-03-17 12:55:11', NULL),
(60, 'Fresh Foam cruzv1', 'New Balance', 'N-60', 5000, 2, 'Whether you\'re hitting the gym or the streets, take your sporty style to a new level with the performance-driven Fresh Foam Roav v2 women\'s sneaker. The bold colors will add drive to your step, with breathable synthetic and mesh materials to keep you comfortable all day long. Fresh Foam midsole cushioning and rubber outsole pods are soft and plush to help you go the distance', '1647521756-Fresh Foam cruzv1..png', '2022-03-27 12:55:56', '2022-03-17 12:55:56', NULL),
(61, 'Fresh Foam 1080v11', 'New Balance', 'N-61', 3000, 2, 'Whether you\'re hitting the gym or the streets, take your sporty style to a new level with the performance-driven Fresh Foam Roav v2 women\'s sneaker. The bold colors will add drive to your step, with breathable synthetic and mesh materials to keep you comfortable all day long. Fresh Foam midsole cushioning and rubber outsole pods are soft and plush to help you go the distance', '1647521788-Fresh Foam 1080v11..png', '2022-03-17 12:56:28', '2022-03-17 12:56:28', NULL),
(62, 'Fresh Foam Roav', 'New Balance', 'N-62', 4000, 3, 'Whether you\'re hitting the gym or the streets, take your sporty style to a new level with the performance-driven Fresh Foam Roav v2 women\'s sneaker. The bold colors will add drive to your step, with breathable synthetic and mesh materials to keep you comfortable all day long. Fresh Foam midsole cushioning and rubber outsole pods are soft and plush to help you go the distance', '1647521860-Fresh Foam Roav..png', '2022-03-27 12:57:40', '2022-03-17 12:57:40', NULL),
(63, 'Fresh Foam 880v11', 'New Balance', 'N-63', 5000, 0, 'Whether you\'re hitting the gym or the streets, take your sporty style to a new level with the performance-driven Fresh Foam Roav v2 women\'s sneaker. The bold colors will add drive to your step, with breathable synthetic and mesh materials to keep you comfortable all day long. Fresh Foam midsole cushioning and rubber outsole pods are soft and plush to help you go the distance', '1647521936-Fresh Foam 880v11..png', '2022-02-05 12:58:56', '2022-03-17 13:43:06', NULL),
(64, 'MX608V5', 'New Balance', 'N-64', 7000, 3, 'Whether you\'re hitting the gym or the streets, take your sporty style to a new level with the performance-driven Fresh Foam Roav v2 women\'s sneaker. The bold colors will add drive to your step, with breathable synthetic and mesh materials to keep you comfortable all day long. Fresh Foam midsole cushioning and rubber outsole pods are soft and plush to help you go the distance', '1647521981-MX608V5..png', '2022-02-27 12:59:41', '2022-03-17 12:59:41', NULL),
(65, 'XC-74', 'New Balance', 'N-65', 5000, 1, 'Whether you\'re hitting the gym or the streets, take your sporty style to a new level with the performance-driven Fresh Foam Roav v2 women\'s sneaker. The bold colors will add drive to your step, with breathable synthetic and mesh materials to keep you comfortable all day long. Fresh Foam midsole cushioning and rubber outsole pods are soft and plush to help you go the distance', '1647522022-XC-74..png', '2022-03-17 13:00:22', '2022-03-16 06:26:57', NULL),
(66, '754 Regged GTX', 'New Balance', 'N-66', 7000, 2, 'Whether you\'re hitting the gym or the streets, take your sporty style to a new level with the performance-driven Fresh Foam Roav v2 women\'s sneaker. The bold colors will add drive to your step, with breathable synthetic and mesh materials to keep you comfortable all day long. Fresh Foam midsole cushioning and rubber outsole pods are soft and plush to help you go the distance', '1647522056-754 Regged GTX..png', '2022-03-26 13:00:56', '2022-03-17 13:36:28', NULL),
(67, 'NB Numeric 425', 'New Balance', 'N-67', 8000, 1, 'Whether you\'re hitting the gym or the streets, take your sporty style to a new level with the performance-driven Fresh Foam Roav v2 women\'s sneaker. The bold colors will add drive to your step, with breathable synthetic and mesh materials to keep you comfortable all day long. Fresh Foam midsole cushioning and rubber outsole pods are soft and plush to help you go the distance', '1647522106-NB Numeric 425..png', '2022-03-17 13:01:46', '2022-03-17 13:50:11', NULL),
(68, 'Puma Future Rider', 'Puma', 'P-68', 5000, 4, 'Designed for style, engineered for performance and built for your lifestyle, PUMA men’s trainers are the best shoes for a workout routine, and for fashion. They prove that running shoes for men can be ultra-versatile, taking you from your desk to the gym, or to dinner with friends', '1647522176-Puma Future Rider..png', '2022-02-26 13:02:56', '2022-03-17 14:12:53', NULL),
(69, 'Puma Rs-X3', 'Puma', 'P-69', 4000, 2, 'Designed for style, engineered for performance and built for your lifestyle, PUMA men’s trainers are the best shoes for a workout routine, and for fashion. They prove that running shoes for men can be ultra-versatile, taking you from your desk to the gym, or to dinner with friends', '1647522211-Puma Rs-X3..png', '2022-03-17 13:03:31', '2022-03-17 14:07:36', NULL),
(70, 'Puma Suede Classic', 'Puma', 'P-70', 4000, 2, 'Designed for style, engineered for performance and built for your lifestyle, PUMA men’s trainers are the best shoes for a workout routine, and for fashion. They prove that running shoes for men can be ultra-versatile, taking you from your desk to the gym, or to dinner with friends', '1647522250-Puma Suede Classic..png', '2022-03-20 13:04:10', '2022-03-17 14:13:34', NULL),
(71, 'Puma Rs-x', 'Puma', 'P=71', 5000, 3, 'Designed for style, engineered for performance and built for your lifestyle, PUMA men’s trainers are the best shoes for a workout routine, and for fashion. They prove that running shoes for men can be ultra-versatile, taking you from your desk to the gym, or to dinner with friends', '1647522294-Puma Rs-x..png', '2022-03-17 13:04:54', '2022-03-17 13:04:54', NULL),
(72, 'Puma Rome', 'Puma', 'P-72', 7000, 2, 'Designed for style, engineered for performance and built for your lifestyle, PUMA men’s trainers are the best shoes for a workout routine, and for fashion. They prove that running shoes for men can be ultra-versatile, taking you from your desk to the gym, or to dinner with friends', '1647522331-Puma Rome..png', '2022-03-19 13:05:31', '2022-03-17 13:05:31', NULL),
(73, 'Puma Rebound LayUp', 'Puma', 'P-73', 6000, 3, 'Designed for style, engineered for performance and built for your lifestyle, PUMA men’s trainers are the best shoes for a workout routine, and for fashion. They prove that running shoes for men can be ultra-versatile, taking you from your desk to the gym, or to dinner with friends', '1647522368-Puma Rebound LayUp..png', '2022-03-17 13:06:08', '2022-03-17 14:04:18', NULL),
(74, 'Puma GV Special', 'Puma', 'P-74', 7500, 3, 'Designed for style, engineered for performance and built for your lifestyle, PUMA men’s trainers are the best shoes for a workout routine, and for fashion. They prove that running shoes for men can be ultra-versatile, taking you from your desk to the gym, or to dinner with friends', '1647522421-Puma GV Special..png', '2022-02-20 13:07:01', '2022-03-17 14:06:15', NULL),
(75, 'Puma RS-Fast', 'Puma', 'P-75', 9000, 3, 'Designed for style, engineered for performance and built for your lifestyle, PUMA men’s trainers are the best shoes for a workout routine, and for fashion. They prove that running shoes for men can be ultra-versatile, taking you from your desk to the gym, or to dinner with friends', '1647522458-Puma RS-Fast..png', '2022-03-14 13:07:38', '2022-03-17 13:47:51', NULL),
(76, 'Puma R78', 'Puma', 'P-76', 5500, 1, 'Designed for style, engineered for performance and built for your lifestyle, PUMA men’s trainers are the best shoes for a workout routine, and for fashion. They prove that running shoes for men can be ultra-versatile, taking you from your desk to the gym, or to dinner with friends', '1647522506-Puma R78..png', '2022-03-10 13:08:26', '2022-03-17 13:57:25', NULL),
(77, 'Timberland Redwood', 'Timberland', 'T-77', 5000, 1, 'Uppers made with 100% premium leather from an LWG Silver-rated tannery and 100% recycled CORDURA Ecomade canvas. 50% recycled PET Lining. 15% recycled rubber outsole. Gripstick rubber. Patented L7 lug design features multi-directional leading edges with beveled lug sidewalls. Imported.', '1647522593-Timberland Redwood..png', '2022-03-17 13:09:53', '2022-03-17 14:07:36', NULL),
(78, 'Timberland Reaxion', 'Timberland', 'T-78', 6000, 2, 'Uppers made with 100% premium leather from an LWG Silver-rated tannery and 100% recycled CORDURA Ecomade canvas. 50% recycled PET Lining. 15% recycled rubber outsole. Gripstick rubber. Patented L7 lug design features multi-directional leading edges with beveled lug sidewalls. Imported.', '1647522627-Timberland Reaxion..png', '2022-03-26 13:10:27', '2022-03-17 14:13:06', NULL),
(79, 'Timberland Ridgework', 'Timberland', 'T-79', 6000, 2, 'Uppers made with 100% premium leather from an LWG Silver-rated tannery and 100% recycled CORDURA Ecomade canvas. 50% recycled PET Lining. 15% recycled rubber outsole. Gripstick rubber. Patented L7 lug design features multi-directional leading edges with beveled lug sidewalls. Imported.', '1647522667-Timberland Ridgework..png', '2022-03-17 13:11:07', '2022-03-17 13:55:00', NULL),
(80, 'Men\'s Earthkeepers', 'Timberland', 'T-80', 4000, 1, 'Uppers made with 100% premium leather from an LWG Silver-rated tannery and 100% recycled CORDURA Ecomade canvas. 50% recycled PET Lining. 15% recycled rubber outsole. Gripstick rubber. Patented L7 lug design features multi-directional leading edges with beveled lug sidewalls. Imported.', '1647522708-Men\'s Earthkeepers..png', '2022-02-03 13:11:48', '2022-03-17 13:50:11', NULL),
(81, 'Men\'s Redwood', 'Timberland', 'T-81', 9000, 3, 'Uppers made with 100% premium leather from an LWG Silver-rated tannery and 100% recycled CORDURA Ecomade canvas. 50% recycled PET Lining. 15% recycled rubber outsole. Gripstick rubber. Patented L7 lug design features multi-directional leading edges with beveled lug sidewalls. Imported.', '1647522747-Men\'s Redwood..png', '2022-03-31 03:12:27', '2022-03-17 13:42:09', NULL),
(82, 'Men\'s Gridworks 6', 'Timberland', 'T-82', 8000, 1, 'Uppers made with 100% premium leather from an LWG Silver-rated tannery and 100% recycled CORDURA Ecomade canvas. 50% recycled PET Lining. 15% recycled rubber outsole. Gripstick rubber. Patented L7 lug design features multi-directional leading edges with beveled lug sidewalls. Imported.', '1647522784-Men\'s Gridworks 6..png', '2022-02-01 13:13:04', '2022-03-08 06:10:20', NULL),
(83, 'Timberland Redwood', 'Timberland', 'T-83', 5000, 2, 'Uppers made with 100% premium leather from an LWG Silver-rated tannery and 100% recycled CORDURA Ecomade canvas. 50% recycled PET Lining. 15% recycled rubber outsole. Gripstick rubber. Patented L7 lug design features multi-directional leading edges with beveled lug sidewalls. Imported.', '1647522824-Timberland Redwood..png', '2022-03-13 13:13:44', '2022-03-17 13:37:34', NULL),
(84, 'Timberland Pit', 'Timberland', 'T-84', 7000, 3, 'Uppers made with 100% premium leather from an LWG Silver-rated tannery and 100% recycled CORDURA Ecomade canvas. 50% recycled PET Lining. 15% recycled rubber outsole. Gripstick rubber. Patented L7 lug design features multi-directional leading edges with beveled lug sidewalls. Imported.', '1647522859-Timberland Pit..png', '2022-03-11 13:14:19', '2022-03-17 14:03:30', NULL),
(85, 'Timberland Boondock', 'Timberland', 'T-85', 8000, 1, 'Uppers made with 100% premium leather from an LWG Silver-rated tannery and 100% recycled CORDURA Ecomade canvas. 50% recycled PET Lining. 15% recycled rubber outsole. Gripstick rubber. Patented L7 lug design features multi-directional leading edges with beveled lug sidewalls. Imported.', '1647522892-Timberland Boondock..png', '2022-03-17 13:14:52', '2022-03-17 14:05:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item_categories`
--

CREATE TABLE `item_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_categories`
--

INSERT INTO `item_categories` (`id`, `item_id`, `category`) VALUES
(39, 1, 'K'),
(40, 2, 'K'),
(41, 2, 'A'),
(42, 2, 'T'),
(43, 3, 'K'),
(44, 3, 'A'),
(45, 3, 'T'),
(46, 4, 'K'),
(47, 4, 'C'),
(48, 5, 'K'),
(49, 5, 'A'),
(50, 6, 'K'),
(51, 6, 'A'),
(52, 6, 'T'),
(53, 7, 'K'),
(54, 7, 'C'),
(55, 8, 'M'),
(56, 8, 'A'),
(57, 8, 'T'),
(58, 9, 'M'),
(59, 9, 'C'),
(60, 10, 'M'),
(61, 10, 'A'),
(62, 10, 'T'),
(63, 11, 'M'),
(64, 11, 'A'),
(65, 11, 'T'),
(66, 12, 'M'),
(67, 12, 'A'),
(68, 12, 'T'),
(69, 13, 'M'),
(70, 13, 'C'),
(71, 14, 'M'),
(72, 14, 'A'),
(73, 14, 'T'),
(74, 15, 'W'),
(75, 15, 'A'),
(76, 15, 'T'),
(77, 16, 'W'),
(78, 16, 'A'),
(79, 17, 'W'),
(80, 18, 'W'),
(81, 18, 'C'),
(82, 19, 'W'),
(83, 19, 'C'),
(84, 20, 'W'),
(85, 21, 'W'),
(86, 21, 'C'),
(87, 22, 'W'),
(88, 22, 'C'),
(89, 23, 'K'),
(90, 24, 'K'),
(91, 24, 'A'),
(92, 25, 'K'),
(93, 25, 'C'),
(94, 26, 'M'),
(95, 26, 'A'),
(96, 27, 'M'),
(97, 27, 'C'),
(98, 27, 'T'),
(99, 28, 'M'),
(100, 29, 'W'),
(101, 29, 'A'),
(102, 30, 'W'),
(103, 30, 'A'),
(104, 31, 'K'),
(105, 31, 'T'),
(106, 32, 'K'),
(107, 32, 'C'),
(108, 33, 'K'),
(109, 33, 'C'),
(110, 34, 'M'),
(111, 34, 'A'),
(112, 35, 'M'),
(113, 35, 'A'),
(114, 36, 'M'),
(115, 36, 'C'),
(116, 37, 'W'),
(117, 37, 'C'),
(118, 38, 'W'),
(119, 38, 'C'),
(120, 39, 'W'),
(121, 39, 'C'),
(122, 40, 'K'),
(123, 40, 'A'),
(124, 41, 'K'),
(125, 41, 'T'),
(126, 42, 'K'),
(127, 42, 'A'),
(128, 43, 'M'),
(129, 43, 'C'),
(130, 44, 'M'),
(131, 44, 'A'),
(132, 45, 'M'),
(133, 45, 'C'),
(134, 46, 'W'),
(135, 46, 'T'),
(136, 47, 'W'),
(137, 47, 'C'),
(138, 48, 'W'),
(139, 48, 'A'),
(140, 49, 'K'),
(141, 49, 'A'),
(142, 50, 'K'),
(143, 50, 'T'),
(144, 51, 'K'),
(145, 51, 'A'),
(146, 52, 'M'),
(147, 52, 'A'),
(148, 53, 'M'),
(149, 53, 'T'),
(150, 54, 'M'),
(151, 54, 'C'),
(152, 55, 'M'),
(153, 55, 'C'),
(154, 56, 'W'),
(155, 56, 'C'),
(156, 57, 'W'),
(157, 57, 'T'),
(158, 58, 'W'),
(159, 58, 'T'),
(160, 59, 'K'),
(161, 59, 'A'),
(162, 60, 'K'),
(163, 60, 'A'),
(164, 61, 'K'),
(165, 61, 'T'),
(166, 62, 'M'),
(167, 62, 'A'),
(168, 63, 'M'),
(169, 63, 'C'),
(170, 64, 'M'),
(171, 64, 'T'),
(172, 65, 'W'),
(173, 65, 'C'),
(174, 66, 'W'),
(175, 66, 'T'),
(176, 67, 'W'),
(177, 67, 'A'),
(178, 68, 'K'),
(179, 68, 'A'),
(180, 69, 'K'),
(181, 69, 'T'),
(182, 70, 'K'),
(183, 70, 'A'),
(184, 71, 'M'),
(185, 71, 'A'),
(186, 72, 'M'),
(187, 72, 'T'),
(188, 73, 'M'),
(189, 73, 'C'),
(190, 74, 'W'),
(191, 74, 'C'),
(192, 75, 'W'),
(193, 75, 'A'),
(194, 76, 'W'),
(195, 76, 'C'),
(196, 77, 'K'),
(197, 78, 'K'),
(198, 78, 'A'),
(199, 79, 'K'),
(200, 79, 'T'),
(201, 80, 'M'),
(202, 80, 'A'),
(203, 81, 'M'),
(204, 81, 'C'),
(205, 82, 'M'),
(206, 82, 'T'),
(207, 83, 'W'),
(208, 83, 'A'),
(209, 84, 'W'),
(210, 84, 'C'),
(211, 85, 'W'),
(212, 85, 'T'),
(213, 23, 'T'),
(214, 28, 'T'),
(215, 29, 'T'),
(216, 68, 'T'),
(217, 78, 'T'),
(218, 70, 'T');

-- --------------------------------------------------------

--
-- Table structure for table `item_sizes`
--

CREATE TABLE `item_sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_sizes`
--

INSERT INTO `item_sizes` (`id`, `item_id`, `size`) VALUES
(38, 1, 17),
(39, 1, 18),
(40, 1, 19),
(41, 1, 20),
(42, 2, 18),
(43, 2, 19),
(44, 3, 18),
(45, 3, 20),
(46, 4, 17),
(47, 4, 18),
(48, 4, 19),
(49, 4, 20),
(50, 5, 18),
(51, 5, 19),
(52, 6, 18),
(53, 6, 19),
(54, 6, 20),
(55, 7, 18),
(56, 8, 38),
(57, 8, 39),
(58, 8, 40),
(59, 8, 41),
(60, 9, 38),
(61, 9, 39),
(62, 9, 41),
(63, 9, 42),
(64, 10, 38),
(65, 10, 39),
(66, 10, 40),
(67, 10, 41),
(68, 11, 38),
(69, 11, 39),
(70, 12, 38),
(71, 12, 39),
(72, 12, 40),
(73, 12, 41),
(74, 13, 38),
(75, 13, 39),
(76, 13, 40),
(77, 14, 38),
(78, 14, 39),
(79, 14, 40),
(80, 14, 43),
(81, 15, 38),
(82, 15, 39),
(83, 15, 41),
(84, 16, 38),
(85, 16, 39),
(86, 16, 41),
(87, 17, 38),
(88, 17, 39),
(89, 18, 38),
(90, 18, 39),
(91, 19, 38),
(92, 19, 40),
(93, 19, 41),
(94, 20, 38),
(95, 20, 39),
(96, 20, 42),
(97, 21, 38),
(98, 21, 39),
(99, 22, 38),
(100, 22, 41),
(101, 23, 17),
(102, 23, 18),
(103, 23, 19),
(104, 24, 17),
(105, 24, 18),
(106, 24, 19),
(107, 25, 17),
(108, 25, 18),
(109, 25, 19),
(110, 26, 40),
(111, 26, 42),
(112, 26, 43),
(113, 27, 40),
(114, 27, 42),
(115, 27, 43),
(116, 28, 39),
(117, 28, 41),
(118, 28, 42),
(119, 29, 42),
(120, 29, 43),
(121, 29, 44),
(122, 30, 42),
(123, 30, 44),
(124, 30, 38),
(125, 31, 17),
(126, 31, 18),
(127, 31, 19),
(128, 32, 17),
(129, 32, 18),
(130, 32, 19),
(131, 33, 17),
(132, 33, 18),
(133, 33, 19),
(134, 34, 40),
(135, 34, 41),
(136, 34, 42),
(137, 35, 41),
(138, 35, 44),
(139, 35, 45),
(140, 36, 39),
(141, 36, 40),
(142, 36, 45),
(143, 37, 39),
(144, 37, 44),
(145, 37, 45),
(146, 38, 40),
(147, 38, 42),
(148, 38, 43),
(149, 39, 42),
(150, 39, 45),
(151, 39, 38),
(152, 40, 17),
(153, 40, 18),
(154, 40, 19),
(155, 41, 17),
(156, 41, 18),
(157, 41, 19),
(158, 42, 17),
(159, 42, 18),
(160, 42, 19),
(161, 43, 39),
(162, 43, 43),
(163, 43, 45),
(164, 44, 42),
(165, 44, 43),
(166, 44, 44),
(167, 45, 43),
(168, 45, 44),
(169, 45, 45),
(170, 46, 40),
(171, 46, 44),
(172, 46, 45),
(173, 47, 39),
(174, 47, 40),
(175, 47, 45),
(176, 48, 39),
(177, 48, 42),
(178, 48, 38),
(179, 49, 17),
(180, 49, 18),
(181, 49, 19),
(182, 50, 17),
(183, 50, 18),
(184, 50, 19),
(185, 51, 17),
(186, 51, 18),
(187, 51, 19),
(188, 52, 40),
(189, 52, 43),
(190, 52, 44),
(191, 53, 39),
(192, 53, 45),
(193, 53, 38),
(194, 54, 39),
(195, 54, 40),
(196, 54, 45),
(197, 55, 40),
(198, 55, 41),
(199, 55, 45),
(200, 56, 39),
(201, 56, 45),
(202, 56, 38),
(203, 57, 40),
(204, 57, 43),
(205, 57, 45),
(206, 58, 43),
(207, 58, 44),
(208, 58, 45),
(209, 59, 17),
(210, 59, 18),
(211, 59, 19),
(212, 60, 17),
(213, 60, 18),
(214, 60, 19),
(215, 61, 17),
(216, 61, 18),
(217, 62, 17),
(218, 62, 18),
(219, 62, 19),
(220, 63, 40),
(221, 63, 42),
(222, 63, 43),
(223, 64, 43),
(224, 64, 45),
(225, 65, 39),
(226, 65, 40),
(227, 65, 45),
(228, 66, 44),
(229, 66, 45),
(230, 66, 38),
(231, 67, 39),
(232, 67, 42),
(233, 67, 45),
(234, 68, 17),
(235, 68, 18),
(236, 68, 19),
(237, 69, 17),
(238, 69, 18),
(239, 69, 19),
(240, 70, 17),
(241, 70, 18),
(242, 71, 39),
(243, 71, 42),
(244, 71, 45),
(245, 72, 43),
(246, 72, 44),
(247, 72, 45),
(248, 73, 40),
(249, 73, 44),
(250, 73, 38),
(251, 74, 43),
(252, 74, 44),
(253, 74, 45),
(254, 75, 39),
(255, 75, 40),
(256, 75, 43),
(257, 76, 40),
(258, 76, 42),
(259, 76, 43),
(260, 77, 17),
(261, 77, 19),
(262, 77, 20),
(263, 78, 17),
(264, 78, 18),
(265, 78, 20),
(266, 79, 17),
(267, 79, 18),
(268, 79, 20),
(269, 80, 42),
(270, 80, 43),
(271, 80, 45),
(272, 81, 41),
(273, 81, 44),
(274, 81, 38),
(275, 82, 40),
(276, 82, 43),
(277, 82, 45),
(278, 83, 39),
(279, 83, 41),
(280, 83, 43),
(281, 84, 41),
(282, 84, 43),
(283, 84, 44),
(284, 85, 42),
(285, 85, 44),
(286, 85, 38);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_11_22_103051_create_admins_table', 1),
(6, '2021_11_30_144326_create_items_table', 1),
(7, '2021_12_02_145554_create_item_sizes_table', 1),
(8, '2021_12_02_145632_create_item_categories_table', 1),
(9, '2021_12_06_190930_create_categories_table', 1),
(10, '2021_12_06_190946_create_sizes_table', 1),
(11, '2021_12_13_080337_create_brands_table', 1),
(12, '2021_12_15_153136_create_reviews_table', 1),
(13, '2021_12_15_174644_create_wishlists_table', 1),
(14, '2021_12_15_193853_create_wishlist_items_table', 1),
(15, '2021_12_16_124244_create_carts_table', 1),
(16, '2021_12_16_131921_create_cart_item_table', 1),
(18, '2021_12_31_075522_alter_table_users_change_phone_no', 2),
(19, '2021_12_31_145600_create_orders_table', 3),
(20, '2021_12_31_150236_create_order_item_table', 4),
(22, '2021_12_31_150734_create_invoices_table', 5),
(24, '2021_12_31_151723_create_delivers_table', 6),
(25, '2022_01_03_150410_add_bank_receipt_to_invoices_table', 7),
(26, '2022_01_05_173326_add_tax_discount_to_invoice_table', 8),
(31, '2022_01_11_205957_add_logout_at_to_admins_table', 9),
(32, '2022_02_04_201705_add_settlement_status_to_delivers_table', 10),
(33, '2022_02_17_000544_create_rates_table', 11),
(38, '2022_03_26_132503_create_returns_table', 12),
(39, '2022_03_26_133530_create_returns_item_table', 12),
(40, '2022_03_26_134433_create_invoice_item_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE `rates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rateName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`id`, `rateName`, `rate`, `created_at`, `updated_at`) VALUES
(1, 'Tax', 11, NULL, '2022-02-16 19:30:28'),
(2, 'Discount', 6, NULL, '2022-02-16 19:30:28');

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE `returns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `returned_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `returns_item`
--

CREATE TABLE `returns_item` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `returns_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int(11) NOT NULL,
  `reply_message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `size` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `size`, `created_at`, `updated_at`) VALUES
(2, 39, '2022-02-16 13:20:50', '2022-02-16 13:20:50'),
(3, 40, '2022-02-16 13:20:50', '2022-02-16 13:20:50'),
(4, 41, '2022-02-16 13:20:50', '2022-02-16 13:20:50'),
(5, 42, '2022-02-16 13:20:50', '2022-02-16 13:20:50'),
(6, 43, '2022-02-16 13:20:50', '2022-02-16 13:20:50'),
(7, 44, '2022-02-16 13:20:50', '2022-02-16 13:20:50'),
(8, 45, '2022-02-16 13:20:50', '2022-02-16 13:20:50'),
(9, 17, '2022-02-16 13:20:50', '2022-02-16 13:20:50'),
(10, 18, '2022-02-16 13:20:50', '2022-02-16 13:20:50'),
(11, 19, '2022-02-16 13:20:50', '2022-02-16 13:20:50'),
(12, 20, '2022-02-16 13:20:50', '2022-02-16 13:20:50'),
(13, 38, '2022-02-16 13:20:50', '2022-02-16 13:20:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `houseNo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipCode` int(11) NOT NULL,
  `phoneNo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist_items`
--

CREATE TABLE `wishlist_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `wishlist_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_item_cart_id_foreign` (`cart_id`),
  ADD KEY `cart_item_item_id_foreign` (`item_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivers`
--
ALTER TABLE `delivers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delivers_order_id_foreign` (`order_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_order_id_foreign` (`order_id`);

--
-- Indexes for table `invoice_item`
--
ALTER TABLE `invoice_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_item_invoice_id_foreign` (`invoice_id`),
  ADD KEY `invoice_item_item_id_foreign` (`item_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_categories`
--
ALTER TABLE `item_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_categories_item_id_foreign` (`item_id`);

--
-- Indexes for table `item_sizes`
--
ALTER TABLE `item_sizes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_sizes_item_id_foreign` (`item_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_item_order_id_foreign` (`order_id`),
  ADD KEY `order_item_item_id_foreign` (`item_id`);

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
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `returns_order_id_foreign` (`order_id`);

--
-- Indexes for table `returns_item`
--
ALTER TABLE `returns_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `returns_item_returns_id_foreign` (`returns_id`),
  ADD KEY `returns_item_item_id_foreign` (`item_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_item_id_foreign` (`item_id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`);

--
-- Indexes for table `wishlist_items`
--
ALTER TABLE `wishlist_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlist_items_wishlist_id_foreign` (`wishlist_id`),
  ADD KEY `wishlist_items_item_id_foreign` (`item_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `delivers`
--
ALTER TABLE `delivers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `invoice_item`
--
ALTER TABLE `invoice_item`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `item_categories`
--
ALTER TABLE `item_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;

--
-- AUTO_INCREMENT for table `item_sizes`
--
ALTER TABLE `item_sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=287;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `returns`
--
ALTER TABLE `returns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `returns_item`
--
ALTER TABLE `returns_item`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `wishlist_items`
--
ALTER TABLE `wishlist_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `cart_item_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_item_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `delivers`
--
ALTER TABLE `delivers`
  ADD CONSTRAINT `delivers_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoice_item`
--
ALTER TABLE `invoice_item`
  ADD CONSTRAINT `invoice_item_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_item_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_categories`
--
ALTER TABLE `item_categories`
  ADD CONSTRAINT `item_categories_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_sizes`
--
ALTER TABLE `item_sizes`
  ADD CONSTRAINT `item_sizes_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_item_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `returns`
--
ALTER TABLE `returns`
  ADD CONSTRAINT `returns_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `returns_item`
--
ALTER TABLE `returns_item`
  ADD CONSTRAINT `returns_item_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `returns_item_returns_id_foreign` FOREIGN KEY (`returns_id`) REFERENCES `returns` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wishlist_items`
--
ALTER TABLE `wishlist_items`
  ADD CONSTRAINT `wishlist_items_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wishlist_items_wishlist_id_foreign` FOREIGN KEY (`wishlist_id`) REFERENCES `wishlists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
