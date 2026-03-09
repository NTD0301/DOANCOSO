-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 23, 2025 at 05:42 PM
-- Server version: 10.11.10-MariaDB-log
-- PHP Version: 8.3.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoplaravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_small` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `image`, `url`, `sort_order`, `is_active`, `is_small`, `created_at`, `updated_at`) VALUES
(1, 'Bánh kem sinh nhật - Giảm giá đến 20%', 'banners/giam20%.png', '', 1, 1, 0, '2025-11-22 16:13:32', '2025-11-23 05:43:50'),
(2, 'Combo bánh ngọt cuối tuần - Mua 2 tặng 1', 'banners/2-tang-1.jpg', '', 2, 1, 0, '2025-11-22 16:13:32', '2025-11-23 05:45:34'),
(3, 'Mua 2 tặng 1 - Ưu đãi đặc biệt cho khách hàng thân thiết', 'banners/2-tang-1(1).png', '', 3, 1, 0, '2025-11-22 16:13:32', '2025-11-23 05:47:09'),
(4, 'Ưu đãi bánh ngọt cuối tuần', 'banners/uu-dai.png', NULL, 0, 1, 1, '2025-11-23 05:48:21', '2025-11-23 05:48:21'),
(5, 'Thế giới bánh ngọt - Hot trend năm nay', 'banners/hot-trend.png', NULL, 5, 1, 1, '2025-11-23 05:51:33', '2025-11-23 05:51:33');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `website`, `description`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'Tous Les Jours', 'tous-les-jours', 'https://tljus.com/', 'Chuỗi tiệm bánh nổi tiếng với bánh kem, bánh mì và bánh ngọt phong cách Hàn Quốc.', 'brands/TOUSLESJOURS.png', '2025-11-22 16:13:32', '2025-11-23 09:32:58'),
(2, 'Paris Baguette', 'paris-baguette', 'https://paris-baguette.com/', 'Chuỗi cửa hàng chuyên cung cấp các loại bánh và đồ uống ngon lành.', 'brands/images (1).png', '2025-11-22 16:13:32', '2025-11-23 09:30:58'),
(3, 'ABC Bakery', 'abc-bakery', 'https://abc-bakery.com/', 'Thương hiệu bánh ngọt nổi tiếng với các sản phẩm như bánh mì, bánh ngọt và bánh kem.', 'brands/cropped-LOGO_1000PX-01.png', '2025-11-22 16:13:32', '2025-11-23 09:35:39'),
(4, 'Givral Bakery', 'givral-bakery', 'https://givral.com/', 'Thương hiệu bánh ngọt nổi tiếng với các sản phẩm như bánh mì, bánh ngọt và bánh kem.', 'brands/images.png', '2025-11-22 16:13:32', '2025-11-23 09:31:41'),
(5, 'Brodard Bakery', 'brodard-bakery', '#', '', 'brands/5-banh-trung-thu-brodard-2016.png', '2025-11-22 16:13:32', '2025-11-22 16:13:32'),
(6, 'Hỷ Lâm Môn', 'hyy-lam-mon', '#', '', 'brands/images.jpg', '2025-11-22 16:13:32', '2025-11-22 16:13:32'),
(7, 'OEM', 'oem', '#', 'Original Equipment Manufacturer', '', '2025-11-22 16:13:32', '2025-11-23 09:26:59');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `commentable_type` varchar(255) NOT NULL,
  `commentable_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `content` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `approved_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `commentable_type`, `commentable_id`, `parent_id`, `content`, `status`, `approved_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'App\\Models\\Product', 8, NULL, 'Ngon lắm sẽ quay lại', 'pending', NULL, '2025-11-23 08:32:59', '2025-11-23 08:32:59'),
(2, 8, 'App\\Models\\Product', 1, NULL, '10 điểm', 'pending', NULL, '2025-11-23 09:20:58', '2025-11-23 09:20:58'),
(3, 8, 'App\\Models\\Product', 7, NULL, 'ăn vào là mê', 'pending', NULL, '2025-11-23 09:21:14', '2025-11-23 09:21:14'),
(4, 8, 'App\\Models\\Product', 8, NULL, 'ngon', 'approved', '2025-11-23 09:22:48', '2025-11-23 09:21:27', '2025-11-23 09:22:48'),
(5, 8, 'App\\Models\\Product', 4, NULL, 'xuất sắc', 'approved', '2025-11-23 09:25:33', '2025-11-23 09:22:25', '2025-11-23 09:25:33');

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2024_01_01_000000_create_products_table', 1),
(5, '2024_01_01_000050_create_product_categories_table', 1),
(6, '2024_01_01_000060_create_brands_table', 1),
(7, '2024_01_01_000070_create_post_categories_table', 1),
(8, '2024_01_01_000080_create_comments_table', 1),
(9, '2024_01_01_000090_add_category_and_brand_to_products_table', 1),
(10, '2024_01_01_000100_create_posts_table', 1),
(11, '2024_01_01_000110_add_post_category_id_to_posts_table', 1),
(12, '2024_01_01_000120_add_sale_and_gallery_to_products_table', 1),
(13, '2024_01_01_000200_create_banners_table', 1),
(14, '2024_01_01_000300_create_orders_table', 1),
(15, '2024_01_01_000400_create_order_items_table', 1),
(16, '2024_01_01_000500_create_failed_jobs_table', 1),
(17, '2024_01_01_000600_create_jobs_table', 1),
(18, '2024_01_01_000700_create_product_reviews_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `full_name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `note` text DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('pending','paid','processing','completed','cancelled') NOT NULL DEFAULT 'pending',
  `payment_method` varchar(255) NOT NULL DEFAULT 'qr_code',
  `payment_reference` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `full_name`, `phone`, `address`, `note`, `total_amount`, `status`, `payment_method`, `payment_reference`, `created_at`, `updated_at`) VALUES
(1, 1, 'Nguyễn Hoàng Kha', '0939643264', '123 Tân Lập, Tân Phước, Đồng Tháp', NULL, 1611000.00, 'completed', 'qr_code', NULL, '2025-11-23 08:31:41', '2025-11-23 09:25:51'),
(2, 7, 'Trần Thị Ngọc Huyền', '0939643264', 'Tiền giang', NULL, 314000.00, 'completed', 'qr_code', NULL, '2025-11-23 08:59:59', '2025-11-23 09:07:33'),
(3, 8, 'Minh Quang', '0358993264', '123 Tân Lập, Tân Phước, Đồng Tháp', NULL, 675000.00, 'pending', 'qr_code', NULL, '2025-11-23 09:21:49', '2025-11-23 09:21:49'),
(4, 9, 'ngọc huyền', '0939643264', '123, vĩnh long', 'giao nhanh nha shop', 296400.00, 'pending', 'qr_code', NULL, '2025-11-23 09:22:38', '2025-11-23 09:22:38');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 8, 5, 225000.00, '2025-11-23 08:31:41', '2025-11-23 08:31:41'),
(2, 1, 7, 9, 54000.00, '2025-11-23 08:31:41', '2025-11-23 08:31:41'),
(3, 2, 7, 5, 54000.00, '2025-11-23 08:59:59', '2025-11-23 08:59:59'),
(4, 2, 4, 4, 11000.00, '2025-11-23 08:59:59', '2025-11-23 08:59:59'),
(5, 3, 8, 3, 225000.00, '2025-11-23 09:21:49', '2025-11-23 09:21:49'),
(6, 4, 1, 6, 41800.00, '2025-11-23 09:22:38', '2025-11-23 09:22:38'),
(7, 4, 9, 4, 11400.00, '2025-11-23 09:22:38', '2025-11-23 09:22:38');

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
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `excerpt` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `post_category_id`, `title`, `content`, `author`, `excerpt`, `image`, `published_at`, `created_at`, `updated_at`) VALUES
(5, 1, 'Thế Giới Bánh Ngọt – Hương Vị Ngọt Ngào', 
'<div class="content"><p>Tiệm bánh mang đến nhiều loại bánh hấp dẫn như croissant, muffin, bánh kem và nhiều loại bánh ngọt khác. Mỗi chiếc bánh được làm từ nguyên liệu tươi, mềm xốp và thơm ngon.</p><p>Đây là lựa chọn hoàn hảo cho bữa sáng, buổi trà chiều hoặc những buổi gặp gỡ bạn bè.</p></div>', 
'Quản trị viên', 
'Khám phá nhiều loại bánh ngọt thơm ngon như croissant, muffin và bánh kem.', 
'posts/tgb1.jpg', 
'2025-11-25 00:00:00', 
'2025-11-23 16:00:00', 
'2025-11-23 16:00:00'),

(6, 1, 'Bánh Kem Sinh Nhật – Ngọt Ngào Cho Ngày Đặc Biệt', 
'<div class="content"><p>Bánh kem sinh nhật được trang trí đẹp mắt với nhiều hương vị như socola, dâu và vani.</p><p>Lớp bánh mềm mịn kết hợp với lớp kem béo nhẹ giúp bữa tiệc sinh nhật trở nên đặc biệt và đáng nhớ.</p></div>', 
'Quản trị viên', 
'Những mẫu bánh kem sinh nhật đẹp và ngon cho mọi bữa tiệc.', 
'posts/bk.jpg', 
'2025-11-26 00:00:00', 
'2025-11-23 16:00:00', 
'2025-11-23 16:00:00'),

(7, 1, 'Tiramisu – Món Bánh Ý Được Yêu Thích', 
'<div class="content"><p>Tiramisu là sự kết hợp giữa lớp kem mascarpone béo mịn, bánh mềm và bột cacao thơm nhẹ.</p><p>Đây là món bánh tráng miệng nổi tiếng, phù hợp cho những ai yêu thích hương vị cà phê.</p></div>', 
'Quản trị viên', 
'Tiramisu – món bánh tráng miệng nổi tiếng với vị béo và thơm cacao.', 
'posts/trms.jpg', 
'2025-11-27 00:00:00', 
'2025-11-23 16:00:00', 
'2025-11-23 16:00:00'),

(8, 1, 'Pudding – Món Tráng Miệng Mát Lạnh', 
'<div class="content"><p>Các loại bánh lạnh như flan, pudding hay tiramisu mang lại cảm giác mát lạnh và béo ngậy.</p><p>Đây là món tráng miệng lý tưởng sau bữa ăn hoặc trong những ngày thời tiết nóng.</p></div>', 
'Quản trị viên', 
'Pudding là món tráng miệng mát lạnh và dễ ăn.', 
'posts/pd.jpg', 
'2025-11-28 00:00:00', 
'2025-11-23 16:00:00', 
'2025-11-23 16:00:00');
-- --------------------------------------------------------

--
-- Table structure for table `post_categories`
--

CREATE TABLE `post_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_categories`
--

INSERT INTO `post_categories` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Bộ sưu tập', 'bo-suu-tap', 'Bộ sưu tập', '2025-11-22 16:13:32', '2025-11-23 06:35:44'),
(2, 'Chia sẻ', 'chia-se', NULL, '2025-11-22 16:13:32', '2025-11-23 07:57:04');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `sale_percentage` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `stock` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `image_1` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image_2` varchar(255) DEFAULT NULL,
  `image_3` varchar(255) DEFAULT NULL,
  `image_4` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products`
(`id`,`product_category_id`,`brand_id`,`name`,`description`,`price`,`sale_percentage`,`stock`,`image`,`image_1`,`is_featured`,`created_at`,`updated_at`,`image_2`,`image_3`,`image_4`)
VALUES
(1,9,2,'Bánh kem','Bánh kem mềm mịn, phù hợp sinh nhật và tiệc nhỏ.',44000,10,194,NULL,'products/banh-kem-trai-cay.jpg',1,'2025-11-23 06:10:55','2025-11-23 09:23:47',NULL,NULL,NULL),
(2,10,2,'Croissant','Bánh sừng bò giòn xốp, thơm bơ.',12000,5,150,NULL,'products/croissant.jpg',1,'2025-11-23 06:16:42','2025-11-23 06:16:42',NULL,NULL,NULL),
(3,5,2,'Doughnuts','Bánh doughnuts phủ đường hoặc socola.',155000,10,100,NULL,'products/doughnuts.jpg',1,'2025-11-23 06:19:20','2025-11-23 06:19:20',NULL,NULL,NULL),
(4,13,2,'Flan','Bánh flan mềm mịn, vị caramel.',11000,0,517,NULL,'products/flan.webp',1,'2025-11-23 06:23:22','2025-11-23 08:59:59',NULL,NULL,NULL),
(5,8,1,'Pudding','Pudding trứng sữa béo nhẹ.',65000,5,125,NULL,'products/pudding.jpg',0,'2025-11-23 06:25:55','2025-11-23 06:28:24',NULL,NULL,NULL),
(6,8,4,'Su kem','Bánh su kem nhân kem tươi.',55000,5,120,NULL,'products/su-kem.jpg',0,'2025-11-23 06:29:37','2025-11-23 06:29:37',NULL,NULL,NULL),
(7,6,5,'Tiramisu','Bánh tiramisu vị cà phê cacao.',60000,10,198,NULL,'products/tiramisu.webp',1,'2025-11-23 06:31:35','2025-11-23 08:59:59',NULL,NULL,NULL),
(8,11,7,'Phụ kiện bóng bay','Bóng bay trang trí bánh sinh nhật.',250000,10,144,NULL,'products/bong-so.jpg',1,'2025-11-23 06:33:11','2025-11-23 09:21:49',NULL,NULL,NULL),
(9,5,7,'Chồng tầng bánh','Phụ kiện chồng tầng cho bánh kem.',12000,5,116,NULL,'products/khac1.webp',0,'2025-11-23 08:57:22','2025-11-23 09:22:38',NULL,NULL,NULL),
(10,2,2,'Nến dài','Nến trang trí bánh sinh nhật.',250000,5,100,NULL,'products/nen-dai.jpg',1,'2025-11-23 09:28:09','2025-11-23 09:28:09',NULL,NULL,NULL);
-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `depth` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `slug`, `description`, `parent_id`, `depth`, `created_at`, `updated_at`) VALUES
(1, 'Bánh nướng', 'banh-nuong', '...', NULL, 1, '2025-11-22 23:13:32', '2025-11-22 23:13:32'),
(2, 'Khác', 'khac', '...', NULL, 1, '2025-11-22 23:13:32', '2025-11-22 23:13:32'),
(3, 'Bánh ngọt', 'banh-ngot', '...', NULL, 1, '2025-11-22 23:13:32', '2025-11-22 23:13:32'),
(4, 'Bánh lạnh', 'banh-lanh', '...', NULL, 1, '2025-11-22 23:13:32', '2025-11-22 23:13:32'),
(5, 'Croissant', 'croissant', '...', 1, 2, '2025-11-22 23:13:32', '2025-11-22 23:13:32'),
(6, 'Doughnut', 'doughnut', '...', 1, 2, '2025-11-22 23:13:32', '2025-11-22 23:13:32'),
(7, 'Muffin', 'muffin', '...', 1, 2, '2025-11-22 23:13:32', '2025-11-22 23:13:32'),
(8, 'Bánh kem', 'banh-kem', '...', 3, 2, '2025-11-22 23:13:32', '2025-11-22 23:13:32'),
(9, 'Bánh su kem', 'banh-su-kem', '...', 3, 2, '2025-11-22 23:13:32', '2025-11-22 23:13:32'),
(10, 'Tiramisu', 'tiramisu', '...', 3, 2, '2025-11-22 23:13:32', '2025-11-22 23:13:32'),
(11, 'Flan', 'flan', '...', 4, 2, '2025-11-22 23:13:32', '2025-11-22 23:13:32'),
(12, 'Pudding', 'pudding', '...', 4, 2, '2025-11-22 23:13:32', '2025-11-22 23:13:32');
-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `order_item_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rating` tinyint(3) UNSIGNED NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_reviews`
--

INSERT INTO `product_reviews` (`id`, `order_id`, `order_item_id`, `product_id`, `user_id`, `rating`, `comment`, `created_at`, `updated_at`) VALUES
(1, 2, 4, 4, 7, 5, 'đẹp', '2025-11-23 09:08:46', '2025-11-23 09:08:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Quản trị viên', 'admin@gmail.com', NULL, '$2y$10$C0uByj5P9LQKu5KZvBqEoeTsHsoSgxJsQovOoeTQ5Y.u2LgTo8ErK', 'admin', 'EI9FIJQZOwgeYu5CgT5zeYXsaGhA8uEBHs73Pn3DSxC26VgaoZoaqClER279', '2025-11-22 16:13:30', '2025-11-22 16:13:30'),
(2, 'Bác. Mẫn Huyền Vũ', 'ha.dien@example.org', '2025-11-22 16:13:30', '$2y$10$c9uO/chXuJoyfa/jxcaCGO50X/UQ4pdx3cp1pA3BrRmdwrPMq8n0a', 'user', 'n9svINvhJM', '2025-11-22 16:13:32', '2025-11-22 16:13:32'),
(3, 'Vương Hồ Thọ', 'giang41@example.com', '2025-11-22 16:13:31', '$2y$10$dv0uoEK8M2aRbpo3x/1Xa.7bjrjvosgd7bprrGer6lx58PlDpTZFS', 'user', '3NRVQLeAY2', '2025-11-22 16:13:32', '2025-11-22 16:13:32'),
(4, 'Em. Kiều Lệ', 'nhi.thao@example.com', '2025-11-22 16:13:31', '$2y$10$i1NWTz9FMbnBopFLJ735y.F6ZOwkybcNw4shwbKIy0SvkHZdlH17u', 'user', 'e44xHISCnr', '2025-11-22 16:13:32', '2025-11-22 16:13:32'),
(5, 'Bình Thảo', 'bien.triet@example.com', '2025-11-22 16:13:31', '$2y$10$UR3nqRLT33wg1DeAOBQuRuXcZI8JpGK21itnNefRt.Rntah6s3kl2', 'user', 'GVWXQtXUQG', '2025-11-22 16:13:32', '2025-11-22 16:13:32'),
(6, 'Tôn An', 'thuan.dau@example.net', '2025-11-22 16:13:31', '$2y$10$EdA5S5fKL11.zYjEgD81K.D5fEAv8MTzX6iGX7ADyPTbEvTunE7CW', 'user', 'FrIPEliB7R', '2025-11-22 16:13:32', '2025-11-22 16:13:32'),
(7, 'Trần Thị Ngọc Huyền', 'huyenit200x@gmail.com', NULL, '$2y$10$FTnh65n0KaKbuls.8QwD5eYWYDRzeX3fGR4uJwf.0Jqbjy80T3kw6', 'user', NULL, '2025-11-23 08:58:48', '2025-11-23 08:58:48'),
(8, 'Minh Quang', 'hanh.dien@example.org', NULL, '$2y$10$Rrd1xxsBCw7n4avWZT9OGumjLuEWTNBH84x6cGtBA5whfCy3wxW3O', 'user', NULL, '2025-11-23 09:20:22', '2025-11-23 09:20:22'),
(9, 'ngọc huyền', 'ngochuyen@gmail.com', NULL, '$2y$10$Zj5qYdJHKBxDW8VaxMzOWOknySPDHLWqoxAalofB0MiJeFgzsHbTq', 'user', NULL, '2025-11-23 09:21:20', '2025-11-23 09:21:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_slug_unique` (`slug`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_commentable_type_commentable_id_index` (`commentable_type`,`commentable_id`),
  ADD KEY `comments_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

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
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_post_category_id_foreign` (`post_category_id`);

--
-- Indexes for table `post_categories`
--
ALTER TABLE `post_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `post_categories_slug_unique` (`slug`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_product_category_id_foreign` (`product_category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_categories_slug_unique` (`slug`),
  ADD KEY `product_categories_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_reviews_order_item_id_unique` (`order_item_id`),
  ADD KEY `product_reviews_order_id_foreign` (`order_id`),
  ADD KEY `product_reviews_product_id_foreign` (`product_id`),
  ADD KEY `product_reviews_user_id_foreign` (`user_id`),
  ADD KEY `product_reviews_rating_index` (`rating`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `post_categories`
--
ALTER TABLE `post_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_post_category_id_foreign` FOREIGN KEY (`post_category_id`) REFERENCES `post_categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_product_category_id_foreign` FOREIGN KEY (`product_category_id`) REFERENCES `product_categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD CONSTRAINT `product_categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `product_categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_reviews_order_item_id_foreign` FOREIGN KEY (`order_item_id`) REFERENCES `order_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
