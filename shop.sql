-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 2019 年 4 月 21 日 14:17
-- サーバのバージョン： 5.7.25
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
-- テーブルの構造 `buy`
--

CREATE TABLE `buy` (
  `id` int(11) NOT NULL,
  `members_id` int(11) NOT NULL,
  `items_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `items`
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
-- テーブルのデータのダンプ `items`
--

INSERT INTO `items` (`id`, `vender_id`, `item`, `price`, `stock`, `info`, `created`, `modified`) VALUES
(1, 1, NULL, NULL, NULL, 'こんにちは', '2019-04-20 01:50:47', '2019-04-19 18:50:47'),
(2, 1, 'タイティ', 1200, 100, 'タイのお茶です。とっても甘いですが、やみつきになります。', '2019-04-20 02:28:16', '2019-04-19 19:28:16'),
(4, 1, NULL, NULL, NULL, 'love you', '2019-04-20 11:33:03', '2019-04-20 04:33:03'),
(5, 1, '印鑑', 5000, 2, 'とてもいい', '2019-04-20 11:58:31', '2019-04-20 04:58:31'),
(6, 1, 'マンゴー', 1000, 100, 'タイ産の完熟マンゴーです。みずみずしく、甘いジュースのような果肉をお楽しみいただけます。', '2019-04-20 12:26:45', '2019-04-20 05:26:45'),
(7, 1, 'マンゴスチン', 500, 200, '南国フルーツお試しあれ', '2019-04-20 12:27:17', '2019-04-20 05:27:17'),
(8, 1, 'Bento', 1200, 300, 'タイの昔ながらのお菓子。てりやきソースのようなタレのコーティングは日本人うけ抜群。友人へのプレゼントにどうぞ！', '2019-04-20 12:28:56', '2019-04-20 05:28:56'),
(9, 1, 'タイ米', 3000, 50, '細長くパサパサしたお米。そのまま食べてもよし、チャーハン等パラパラに仕上げたい料理には最高の食材です。', '2019-04-20 12:31:08', '2019-04-20 05:31:08'),
(10, 1, 'ヤードム', 300, 1000, '集中力を高める匂い薬。勉強に、仕事にいつでもモチベーションを高めたい時に使えます。', '2019-04-20 12:33:14', '2019-04-20 05:33:14'),
(11, 1, 'ドラゴンフルーツ', 800, 50, '奇抜な見た目とは裏腹に、さっぱり甘い南国フルーツ。食べ方も半分に切るだけで簡単。おいしいよ', '2019-04-20 12:37:14', '2019-04-21 13:57:49');

-- --------------------------------------------------------

--
-- テーブルの構造 `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `add` varchar(255) DEFAULT NULL,
  `tel` int(11) DEFAULT NULL,
  `card` int(11) DEFAULT NULL,
  `security_code` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `members`
--

INSERT INTO `members` (`id`, `email`, `password`, `name`, `add`, `tel`, `card`, `security_code`, `created`, `modified`) VALUES
(1, 'a', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'a', NULL, NULL, NULL, NULL, '2019-04-18 20:37:10', '2019-04-19 04:11:51'),
(2, 'shiko.tamai@icloud.com', 'd2f75e8204fedf2eacd261e2461b2964e3bfd5be', 'pen', NULL, NULL, NULL, NULL, '2019-04-19 14:10:04', '2019-04-19 07:10:04'),
(3, 'shiko.tamai@icloud.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'shiko', NULL, NULL, NULL, NULL, '2019-04-20 21:08:04', '2019-04-20 14:08:04'),
(4, 'kwang', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'kwang', NULL, NULL, NULL, NULL, '2019-04-20 23:48:20', '2019-04-20 16:48:20');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `venders`
--

CREATE TABLE `venders` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `add` varchar(255) DEFAULT NULL,
  `tel` int(11) DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `venders`
--

INSERT INTO `venders` (`id`, `email`, `password`, `name`, `add`, `tel`, `bank`, `created`, `modified`) VALUES
(1, 'a', '3da541559918a808c2402bba5012f6c60b27661c', 'a', NULL, NULL, NULL, '2019-04-19 20:49:37', '2019-04-19 13:49:37');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `venders`
--
ALTER TABLE `venders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
