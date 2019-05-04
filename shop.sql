-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 04, 2019 at 12:08 PM
-- Server version: 5.7.25
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `buy`
--

CREATE TABLE `buy` (
  `id` int(11) NOT NULL,
  `members_id` int(11) DEFAULT NULL,
  `items_id` int(11) DEFAULT NULL,
  `p_number` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buy`
--

INSERT INTO `buy` (`id`, `members_id`, `items_id`, `p_number`, `created`, `modified`) VALUES
(1, 1, 5, 1, '2019-04-28 10:46:45', '2019-04-28 03:46:45'),
(2, 1, 5, 3, '2019-04-28 10:51:07', '2019-04-29 03:32:11'),
(3, 1, 5, 1, '2019-04-28 11:45:25', '2019-04-28 04:45:25'),
(4, 3, 11, 3, '2019-04-29 11:34:20', '2019-04-29 04:34:20'),
(5, 3, 10, 5, '2019-04-29 11:58:25', '2019-04-29 04:58:25'),
(6, 2, 12, 1, '2019-04-29 13:28:19', '2019-04-29 08:20:17'),
(7, 2, 12, 10, '2019-04-29 13:57:51', '2019-04-29 08:20:21'),
(8, 3, 4, 3, '2019-04-29 15:22:21', '2019-04-29 08:22:21'),
(9, 5, 9, 5, '2019-04-29 15:28:12', '2019-04-29 08:31:41'),
(10, 5, 8, 2, '2019-04-29 15:28:22', '2019-04-29 08:31:43'),
(11, 6, 2, 5, '2019-04-29 15:28:35', '2019-04-29 08:31:46'),
(12, 6, 8, 4, '2019-04-29 15:28:57', '2019-04-29 08:31:48'),
(13, 7, 12, 4, '2019-04-29 15:29:05', '2019-04-29 08:31:51'),
(14, 7, 11, 6, '2019-04-29 15:29:15', '2019-04-29 08:31:54'),
(15, 8, 7, 6, '2019-04-29 15:29:25', '2019-04-29 08:32:11'),
(16, 8, 6, 12, '2019-04-29 15:29:47', '2019-04-29 08:32:14'),
(17, 9, 10, 14, '2019-04-29 15:30:03', '2019-04-29 08:32:16'),
(18, 9, 2, 1, '2019-04-29 15:30:12', '2019-04-29 08:32:18'),
(19, 10, 7, 6, '2019-04-29 15:30:31', '2019-04-29 08:32:21'),
(20, 10, 9, 5, '2019-04-29 15:30:39', '2019-04-29 08:32:24'),
(21, 1, 12, 6, '2019-04-29 15:30:52', '2019-04-29 08:32:29'),
(22, 5, 13, 6, '2019-04-29 15:30:52', '2019-04-29 08:32:29');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `vender_id` int(11) DEFAULT NULL,
  `item` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `info` text,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `vender_id`, `item`, `price`, `stock`, `info`, `created`, `modified`) VALUES
(1, 1, NULL, NULL, NULL, 'こんにちは', '2019-04-20 01:50:47', '2019-04-19 18:50:47'),
(2, 1, 'タイティ', 1200, 94, 'タイのお茶です。とっても甘いですが、やみつきになります。', '2019-04-20 02:28:16', '2019-04-29 08:30:12'),
(4, 1, NULL, NULL, NULL, 'love you', '2019-04-20 11:33:03', '2019-04-20 04:33:03'),
(5, 1, '印鑑', 5000, 4, 'とてもいい', '2019-04-20 11:58:31', '2019-04-28 04:45:25'),
(6, 1, 'マンゴー', 1000, 88, 'タイ産の完熟マンゴーです。みずみずしく、甘いジュースのような果肉をお楽しみいただけます。', '2019-04-20 12:26:45', '2019-04-29 08:29:47'),
(7, 1, 'マンゴスチン', 500, 188, '南国フルーツお試しあれ', '2019-04-20 12:27:17', '2019-04-29 08:30:31'),
(8, 1, 'Bento', 1200, 294, 'タイの昔ながらのお菓子。てりやきソースのようなタレのコーティングは日本人うけ抜群。友人へのプレゼントにどうぞ！', '2019-04-20 12:28:56', '2019-04-29 08:28:57'),
(9, 1, 'タイ米', 3000, 40, '細長くパサパサしたお米。そのまま食べてもよし、チャーハン等パラパラに仕上げたい料理には最高の食材です。', '2019-04-20 12:31:08', '2019-04-29 08:30:39'),
(10, 1, 'ヤードム', 300, 981, '集中力を高める匂い薬。勉強に、仕事にいつでもモチベーションを高めたい時に使えます。', '2019-04-20 12:33:14', '2019-04-29 08:30:03'),
(11, 1, 'ドラゴンフルーツ', 800, 491, '奇抜な見た目とは裏腹に、さっぱり甘い南国フルーツ。食べ方も半分に切るだけで簡単。おいしいよ', '2019-04-20 12:37:14', '2019-04-29 08:29:15'),
(12, 2, 'チョコレート', 100, 79, 'あまいチョコレートです。', '2019-04-29 12:15:32', '2019-04-29 08:30:52'),
(13, 2, 'キャンディ', 100, 100, 'ミルク味です', '2019-04-29 12:15:32', '2019-04-29 08:30:52');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` text,
  `tel` int(11) DEFAULT NULL,
  `card` int(11) DEFAULT NULL,
  `security_code` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `name`, `email`, `password`, `address`, `tel`, `card`, `security_code`, `created`, `modified`) VALUES
(1, 'ab', 'a', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '兵庫県西脇市和布町', 12345678, NULL, NULL, '2019-04-18 20:37:10', '2019-04-29 03:38:18'),
(2, 'pen', 'shiko.tamai@icloud.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', NULL, NULL, NULL, NULL, '2019-04-19 14:10:04', '2019-04-29 08:23:34'),
(3, 'shiko', 'shiko.tamai@icloud.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', NULL, NULL, NULL, NULL, '2019-04-20 21:08:04', '2019-04-20 14:08:04'),
(4, 'kwang', 'kwang', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', NULL, NULL, NULL, NULL, '2019-04-20 23:48:20', '2019-04-20 16:48:20'),
(5, 'ichiro', '1', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', NULL, NULL, NULL, NULL, '2019-04-29 15:25:43', '2019-04-29 08:27:26'),
(6, 'jiro', '2', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', NULL, NULL, NULL, NULL, '2019-04-29 15:25:56', '2019-04-29 08:25:56'),
(7, 'sabro', '3', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', NULL, NULL, NULL, NULL, '2019-04-29 15:26:11', '2019-04-29 08:26:11'),
(8, 'shiro', '4', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', NULL, NULL, NULL, NULL, '2019-04-29 15:26:23', '2019-04-29 08:26:23'),
(9, 'goro', '5', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', NULL, NULL, NULL, NULL, '2019-04-29 15:26:37', '2019-04-29 08:26:37'),
(10, 'rokuro', '6', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', NULL, NULL, NULL, NULL, '2019-04-29 15:26:58', '2019-04-29 08:26:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `venders`
--

CREATE TABLE `venders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `tel` int(11) DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `venders`
--

INSERT INTO `venders` (`id`, `name`, `email`, `password`, `address`, `tel`, `bank`, `created`, `modified`) VALUES
(1, 'a', 'a', '3da541559918a808c2402bba5012f6c60b27661c', NULL, NULL, NULL, '2019-04-19 20:49:37', '2019-04-19 13:49:37'),
(2, 'shiko', 'shiko.tamai@icloud.com', '3da541559918a808c2402bba5012f6c60b27661c', '兵庫県加東市福吉', 12345678, NULL, '2019-04-29 12:12:08', '2019-04-29 08:00:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buy`
--
ALTER TABLE `buy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venders`
--
ALTER TABLE `venders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buy`
--
ALTER TABLE `buy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `venders`
--
ALTER TABLE `venders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
