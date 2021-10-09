-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2021 at 02:33 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saipraveen`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `body`, `created_at`, `updated_at`) VALUES
(2, 'Covid 2.0', 'Covid 19 corona virus', '2021-08-21 03:28:04', '2021-08-21 03:33:34'),
(3, 'Routes', 'Laravel routing', '2021-08-21 04:00:40', '2021-08-21 04:00:40'),
(4, 'controllers', 'Laravel controller is bridge between view and model', '2021-08-21 04:25:36', '2021-08-21 04:25:36'),
(5, 'Model', 'Laravel model deals with the database. class contains database related operations', '2021-08-21 04:26:19', '2021-08-21 04:26:19'),
(6, 'View', 'Views are html pages that are visible to users', '2021-08-21 04:26:57', '2021-08-21 04:26:57'),
(7, 'Middleware', 'Middware modify / filter the http request', '2021-08-21 04:28:46', '2021-08-21 04:28:46');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(200) NOT NULL,
  `color` varchar(200) NOT NULL,
  `datetime` datetime NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `user_id`, `product_id`, `size`, `color`, `datetime`, `quantity`) VALUES
(23, 1, 15, '64 GB', 'red', '2021-10-01 09:10:44', 3);

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `color` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `product_id`, `color`) VALUES
(1, 15, 'red'),
(2, 15, 'blue'),
(3, 15, 'greeen'),
(4, 16, 'white'),
(5, 16, 'yellow'),
(6, 17, 'yellow'),
(7, 17, 'red'),
(8, 18, 'pink'),
(9, 18, 'black'),
(10, 19, 'Blue');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `password`) VALUES
(1, 'sai', 'chsai.p13@gmail.com', '$2y$10$8McGlE8qhoA7gAGfxwR3n.EG54Lt3Og7hOUw/3bMxrju.onQsYGbq'),
(2, 'test user', 'testuser@gmail.com', '$2y$10$USmaUNR890rtdQ5J5YgMzOhnxa3UBZ8iYScvJqXsHDbnVl0kOTNI6');

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
(3, '2021_08_19_130024_create_questions_table', 2),
(4, '2021_08_20_095158_create_posts_table', 2),
(5, '2021_08_20_121425_create_articles_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('chsai.p13@gmail.com', '$2y$10$F9.Bc.Xn06W//9Ym1HQ/c.mYn0uaQrUzWu7KYVm7fZO2rPTA7FyZS', '2021-08-24 07:08:26');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `photo_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `photo_name`) VALUES
(6, 'apple-blue.jfif'),
(7, 'apple-red.jfif'),
(8, 'blue-shoe.jfif'),
(9, 'download (1).jfif'),
(10, 'lava.jpg'),
(26, 'apple-blue.jfif'),
(27, 'apple-blue.jfif');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `quantity` double NOT NULL,
  `price` double NOT NULL,
  `discount_price` double NOT NULL,
  `description` varchar(300) NOT NULL,
  `prod_img` text NOT NULL,
  `colors` varchar(300) DEFAULT NULL,
  `sizes` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `quantity`, `price`, `discount_price`, `description`, `prod_img`, `colors`, `sizes`) VALUES
(15, 'I Phone', 100, 50000, 80, 'I phone mobile 64 gb', '1632639873.jfif', NULL, '64 GB,126 GB'),
(16, 'shoes', 50, 5000, 1000, 'Shoes', '1632640782.jfif', NULL, '8,9,10'),
(17, 'T Shirt', 20, 1000, 80, 'T-shirts are best', '1632640890.jfif', NULL, 'S,m');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `prod_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `prod_image`) VALUES
(11, 8, '163238998049.jpg'),
(12, 8, '163238998066.jpg'),
(13, 8, '163238998027.png'),
(14, 8, '163238998078.jpg'),
(15, 9, '163239410614.jpg'),
(16, 9, '163239410639.jpg'),
(17, 9, '163239410661.jpg'),
(18, 10, '1632395320100.jpg'),
(19, 10, '163239532040.jpg'),
(20, 11, '163239578838.jpg'),
(21, 11, '163239578853.jpg'),
(22, 12, '163239701988.jpg'),
(23, 12, '163239701991.jpg'),
(24, 12, '163239701958.jpg'),
(25, 12, '163239701923.jpg'),
(26, 13, '163239765444.jpg'),
(27, 13, '163239765452.jpg'),
(28, 13, '163239765414.jpg'),
(29, 13, '163239765481.jpg'),
(30, 14, '163239781553.jpg'),
(31, 14, '163239781536.jpg'),
(32, 14, '163239781597.png'),
(33, 14, '163239781565.jpg'),
(34, 14, '163239781528.jpg'),
(35, 15, '163263987384.jpg'),
(36, 15, '163263987320.jpg'),
(37, 15, '16326398736.png'),
(38, 15, '16326398739.jpg'),
(39, 15, '163263987390.jpg'),
(40, 16, '163264078270.jpg'),
(41, 16, '16326407827.jpg'),
(42, 17, '163264089062.jpg'),
(43, 18, '163272113194.jpg'),
(44, 19, '163280657781.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'saipraveen', 'chsai.p13@gmail.com', '$2y$10$7WlX3WG5Kdt5cg4tg.G5sOpuA34.gNL2kgH9rGsZK7NIyZ5M0vzve', 'OsvpbsgUeMx93bKSy3wF5u97mn2iMi7bro6I3elqPc7Ur7iVbVN8szqylHMH', '2021-08-16 05:10:59', '2021-08-24 00:52:11'),
(13, 'Admin', 'admin@gmail.com', '$2y$10$XSFuixWzORu8xDVz0QsNUO2TzwwfeQTP5lGgf70H.loXFZe.zA1p.', NULL, '2021-08-19 00:30:59', '2021-08-24 01:19:11'),
(14, 'test user', 'test@gmail.com', '$2y$10$hU1tr2giXodqyUKLrefRguxn69b88P7T.gHS/4qBmA952iBSSZtwi', NULL, '2021-08-19 00:51:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `product_id`, `user_id`) VALUES
(7, 16, 1),
(8, 15, 1),
(9, 15, 1),
(10, 15, 1),
(11, 15, 1),
(12, 15, 1),
(13, 16, 1),
(14, 17, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
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
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
