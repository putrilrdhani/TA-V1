-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2023 at 09:10 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tourism_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `name`, `description`) VALUES
(1, 'administrator', 'Administrator'),
(2, 'user', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int(11) NOT NULL DEFAULT 0,
  `permission_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`group_id`, `user_id`) VALUES
(1, 2),
(1, 2),
(2, 3),
(2, 3),
(2, 4),
(2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(0, '182.4.70.76', 'user1@testing.com', 3, '2023-07-17 11:07:34', 1),
(1, '::1', 'jesi1', NULL, '2023-04-08 03:26:24', 0),
(2, '::1', 'polardhani17@gmail.com', 1, '2023-04-08 03:27:00', 1),
(3, '::1', 'polardhani17@gmail.com', 1, '2023-04-08 23:41:10', 1),
(4, '::1', 'polardhani17@gmail.com', 1, '2023-04-10 00:46:23', 1),
(5, '::1', 'polardhani17@gmail.com', 1, '2023-04-11 04:54:58', 1),
(6, '::1', 'polardhani17@gmail.com', 1, '2023-04-12 03:11:39', 1),
(7, '::1', 'polardhani17@gmail.com', 1, '2023-04-12 22:03:24', 1),
(8, '::1', 'polardhani17@gmail.com', 1, '2023-04-13 05:15:30', 1),
(9, '::1', 'polardhani17@gmail.com', 1, '2023-04-13 05:43:29', 1),
(10, '::1', 'polardhani17@gmail.com', 1, '2023-04-15 07:23:36', 1),
(11, '::1', 'polardhani17@gmail.com', 1, '2023-04-16 02:14:25', 1),
(12, '::1', 'polardhani17@gmail.com', 1, '2023-04-19 03:24:10', 1),
(13, '::1', 'polardhani17@gmail.com', 1, '2023-04-19 03:50:31', 1),
(14, '::1', 'polardhani17@gmail.com', 1, '2023-05-08 01:54:34', 1),
(15, '::1', 'admin@laili.com', 2, '2023-05-20 05:04:01', 1),
(16, '::1', 'admin@laili.com', 2, '2023-05-24 00:16:18', 1),
(17, '::1', 'admin@laili.com', 2, '2023-05-29 06:58:18', 1),
(18, '::1', 'admin@laili.com', 2, '2023-05-30 06:35:19', 1),
(19, '::1', 'admin@laili.com', 2, '2023-05-31 09:08:23', 1),
(20, '::1', 'admin@laili.com', 2, '2023-06-01 09:01:42', 1),
(21, '::1', 'admin@laili.com', 2, '2023-06-02 01:20:44', 1),
(22, '::1', 'admin@laili.com', 2, '2023-06-02 03:25:17', 1),
(23, '::1', 'admin@laili.com', 2, '2023-06-04 03:11:48', 1),
(24, '::1', 'admin@laili.com', 2, '2023-06-05 00:32:42', 1),
(25, '::1', 'admin@laili.com', 2, '2023-06-05 22:32:17', 1),
(26, '::1', 'admin@laili.com', 2, '2023-06-05 22:59:59', 1),
(27, '::1', 'admin@laili.com', 2, '2023-06-06 04:22:56', 1),
(28, '::1', 'admin@laili.com', 2, '2023-06-07 00:19:14', 1),
(29, '::1', 'admin@laili.com', 2, '2023-06-08 21:19:31', 1),
(30, '::1', 'admin@laili.com', 2, '2023-06-10 00:25:16', 1),
(31, '::1', 'admin@laili.com', 2, '2023-06-11 04:34:17', 1),
(32, '::1', 'admin@laili.com', 2, '2023-06-11 22:55:49', 1),
(33, '::1', 'admin@laili.com', 2, '2023-06-13 21:30:21', 1),
(34, '::1', 'admin@laili.com', 2, '2023-06-13 23:47:16', 1),
(35, '::1', 'admin@laili.com', 2, '2023-06-15 07:16:26', 1),
(36, '::1', 'admin@laili.com', 2, '2023-06-15 07:53:07', 1),
(37, '::1', 'admin@laili.com', 2, '2023-06-16 04:03:28', 1),
(38, '::1', 'admin@laili.com', 2, '2023-06-18 01:33:37', 1),
(39, '::1', 'admin@laili.com', 2, '2023-06-23 03:22:58', 1),
(40, '::1', 'admin@laili.com', 2, '2023-06-24 03:34:22', 1),
(41, '::1', 'admin@laili.com', 2, '2023-06-24 23:05:45', 1),
(42, '::1', 'admin@laili.com', 2, '2023-06-24 23:19:46', 1),
(43, '::1', 'admin@laili.com', 2, '2023-06-24 23:21:21', 1),
(44, '::1', 'admin@laili.com', 2, '2023-06-24 23:27:23', 1),
(45, '::1', 'admin@laili.com', 2, '2023-06-24 23:28:29', 1),
(46, '::1', 'admin@laili.com', 2, '2023-06-24 23:29:32', 1),
(47, '::1', 'admin@laili.com', 2, '2023-06-30 00:47:41', 1),
(48, '::1', 'admin@laili.com', 2, '2023-06-30 21:42:57', 1),
(49, '::1', 'admin@laili.com', 2, '2023-07-02 19:49:11', 1),
(50, '::1', 'admin@laili.com', 2, '2023-07-02 23:14:12', 1),
(51, '::1', 'admin@laili.com', NULL, '2023-07-04 01:05:03', 0),
(52, '::1', 'admin@laili.com', 2, '2023-07-04 01:06:31', 1),
(53, '::1', 'admin@laili.com', 2, '2023-07-04 08:10:13', 1),
(54, '::1', 'admin@laili.com', 2, '2023-07-04 12:00:27', 1),
(55, '::1', 'admin@laili.com', 2, '2023-07-04 13:09:14', 1),
(56, '::1', 'admin@laili.com', 2, '2023-07-04 22:19:43', 1),
(57, '::1', 'admin@laili.com', 2, '2023-07-05 05:38:48', 1),
(58, '::1', 'admin@laili.com', 2, '2023-07-05 21:42:10', 1),
(59, '::1', 'admin@laili.com', 2, '2023-07-06 21:36:30', 1),
(60, '::1', 'admin@laili.com', 2, '2023-07-07 21:33:15', 1),
(61, '::1', 'polardhani17@gmail.com', 1, '2023-07-07 22:24:56', 1),
(62, '::1', 'admin@laili.com', 2, '2023-07-08 03:14:18', 1),
(63, '::1', 'admin@laili.com', 2, '2023-07-08 07:25:35', 1),
(64, '::1', 'admin@laili.com', 2, '2023-07-08 21:01:36', 1),
(65, '::1', 'admin@laili.com', 2, '2023-07-09 03:55:41', 1),
(66, '::1', 'admin@laili.com', 2, '2023-07-10 00:28:17', 1),
(67, '::1', 'admin@laili.com', 2, '2023-07-10 22:30:34', 1),
(68, '::1', 'admin@laili.com', 2, '2023-07-11 07:02:01', 1),
(69, '::1', 'admin@laili.com', 2, '2023-07-11 21:28:31', 1),
(70, '::1', 'admin@laili.com', 2, '2023-07-12 02:14:21', 1),
(71, '::1', 'admin@laili.com', 2, '2023-07-13 04:17:01', 1),
(72, '::1', 'admin@laili.com', 2, '2023-07-13 06:45:03', 1),
(73, '::1', 'admin@laili.com', 2, '2023-07-14 03:11:41', 1),
(74, '::1', 'admin@laili.com', 2, '2023-07-14 19:47:31', 1),
(75, '::1', 'admin@laili.com', 2, '2023-07-15 05:15:16', 1),
(76, '::1', 'admin@laili.com', 2, '2023-07-16 03:52:01', 1),
(77, '::1', 'user1@testing.com', 3, '2023-07-16 03:59:34', 1),
(78, '::1', 'admin@laili.com', NULL, '2023-07-16 04:09:14', 0),
(79, '::1', 'admin@laili.com', 2, '2023-07-16 04:10:22', 1),
(80, '::1', 'user1', NULL, '2023-07-16 04:10:52', 0),
(81, '::1', 'user2@testing.com', 4, '2023-07-16 04:13:11', 1),
(82, '::1', 'user2@testing.com', 4, '2023-07-16 04:22:40', 1),
(83, '::1', 'admin@laili.com', 2, '2023-07-16 04:27:56', 1),
(84, '::1', 'admin@laili.com', 2, '2023-07-16 10:19:12', 1),
(85, '::1', 'user2@testing.com', 4, '2023-07-16 21:10:45', 1),
(86, '::1', 'admin@laili.com', 2, '2023-07-16 22:25:42', 1),
(87, '::1', 'admin@laili.com', 2, '2023-07-17 00:13:11', 1),
(88, '::1', 'user2@testing.com', 4, '2023-07-17 01:15:52', 1),
(89, '::1', 'user2@testing.com', 4, '2023-07-17 01:21:59', 1),
(90, '::1', 'user2@testing.com', 4, '2023-07-17 01:22:56', 1),
(91, '::1', 'user2@testing.com', 4, '2023-07-17 01:24:41', 1),
(92, '::1', 'user2@testing.com', 4, '2023-07-17 01:25:05', 1),
(93, '::1', 'user2@testing.com', 4, '2023-07-17 01:26:12', 1),
(94, '::1', 'user2@testing.com', 4, '2023-07-17 01:27:53', 1),
(95, '::1', 'user2@testing.com', 4, '2023-07-17 01:28:25', 1),
(96, '::1', 'user2@testing.com', 4, '2023-07-17 01:28:50', 1),
(97, '::1', 'user2@testing.com', 4, '2023-07-17 01:30:09', 1),
(98, '::1', 'user2@testing.com', 4, '2023-07-17 01:30:47', 1),
(99, '::1', 'user2@testing.com', 4, '2023-07-17 01:31:22', 1),
(100, '::1', 'admin@laili.com', 2, '2023-07-17 03:42:05', 1),
(101, '::1', 'admin@laili.com', 2, '2023-07-17 03:50:44', 1),
(102, '::1', 'admin@laili.com', 2, '2023-07-17 03:53:50', 1),
(103, '::1', 'admin@laili.com', 2, '2023-07-17 04:05:33', 1),
(104, '::1', 'admin@laili.com', 2, '2023-07-17 06:12:42', 1),
(105, '::1', 'user1@testing.com', 3, '2023-07-17 08:57:01', 1),
(106, '::1', 'admin@laili.com', 2, '2023-07-17 09:26:05', 1),
(107, '182.4.69.48', 'admin@laili.com', 2, '2023-07-17 23:31:45', 1),
(108, '182.4.69.86', 'admin@laili.com', 2, '2023-07-17 23:34:15', 1),
(109, '182.4.69.86', 'admin@laili.com', 2, '2023-07-17 23:34:17', 1),
(110, '182.1.20.134', 'user1@testing.com', 3, '2023-07-18 00:14:45', 1),
(111, '110.137.82.217', 'admin@laili.com', 2, '2023-07-18 00:22:46', 1),
(112, '110.137.82.217', 'admin@laili.com', 2, '2023-07-18 00:23:27', 1),
(113, '182.4.68.144', 'admin@laili.com', 2, '2023-07-18 00:39:47', 1),
(114, '182.4.68.140', 'admin@laili.com', 2, '2023-07-18 00:50:18', 1),
(115, '182.4.68.140', 'user1@testing.com', 3, '2023-07-18 01:07:02', 1),
(116, '182.4.69.48', 'admin@laili.com', 2, '2023-07-18 01:11:15', 1),
(117, '182.4.69.44', 'user1@testing.com', 3, '2023-07-18 01:11:56', 1),
(118, '182.4.69.44', 'admin@laili.com', 2, '2023-07-18 01:12:51', 1),
(119, '182.4.69.44', 'user1@testing.com', 3, '2023-07-18 01:13:03', 1),
(120, '182.4.71.96', 'user1@testing.com', 3, '2023-07-18 01:26:50', 1),
(121, '182.4.71.96', 'admin@laili.com', 2, '2023-07-18 01:50:23', 1),
(122, '182.4.71.96', 'user1@testing.com', 3, '2023-07-18 04:08:31', 1),
(123, '182.4.71.96', 'user1@testing.com', 3, '2023-07-18 04:29:57', 1),
(124, '182.4.71.96', 'user1@testing.com', 3, '2023-07-18 04:46:23', 1),
(125, '182.4.69.194', 'user1@testing.com', 3, '2023-07-19 21:28:40', 1),
(126, '::1', 'admin@laili.com', 2, '2023-07-21 02:46:22', 1),
(127, '::1', 'user1@testing.com', 3, '2023-07-21 02:52:34', 1),
(128, '::1', 'admin@laili.com', 2, '2023-07-21 03:17:42', 1),
(129, '::1', 'admin@laili.com', 2, '2023-07-21 08:05:51', 1),
(130, '::1', 'admin@laili.com', 2, '2023-07-21 09:00:48', 1),
(131, '::1', 'admin@laili.com', 2, '2023-07-21 12:53:24', 1),
(132, '::1', 'admin@laili.com', 2, '2023-07-21 22:06:25', 1),
(133, '::1', 'admin@laili.com', 2, '2023-07-21 22:29:35', 1),
(134, '::1', 'admin@laili.com', 2, '2023-07-21 22:34:12', 1),
(135, '::1', 'admin@laili.com', 2, '2023-07-21 22:36:43', 1),
(136, '::1', 'admin@laili.com', 2, '2023-07-21 22:38:48', 1),
(137, '::1', 'user2@testing.com', 4, '2023-07-22 01:46:53', 1),
(138, '::1', 'admin@laili.com', 2, '2023-07-22 01:49:10', 1),
(139, '::1', 'user2@testing.com', 4, '2023-07-22 01:52:26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int(11) NOT NULL DEFAULT 0,
  `permission_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `date` date NOT NULL,
  `id` int(11) NOT NULL,
  `id_package` varchar(5) NOT NULL,
  `purchase_date` date NOT NULL,
  `purchase_time` time NOT NULL,
  `total_member` int(11) NOT NULL,
  `status` varchar(1) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`date`, `id`, `id_package`, `purchase_date`, `purchase_time`, `total_member`, `status`, `comment`) VALUES
('1111-11-11', 3, 'P1', '2023-07-21', '14:59:49', 12, '2', 'NO COMMENT'),
('1111-11-11', 4, 'P2', '2023-07-22', '13:53:07', 43, '0', 'Putri'),
('2222-02-22', 4, 'P3', '2023-07-22', '13:55:03', 3, '0', 'Putrei');

-- --------------------------------------------------------

--
-- Table structure for table `culinary`
--

CREATE TABLE `culinary` (
  `id` varchar(3) NOT NULL,
  `name` varchar(30) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `contact_person` varchar(13) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `open` time DEFAULT NULL,
  `close` time DEFAULT NULL,
  `employee` int(11) DEFAULT NULL,
  `geom` geometry NOT NULL,
  `owner` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `culinary`
--

INSERT INTO `culinary` (`id`, `name`, `address`, `contact_person`, `capacity`, `open`, `close`, `employee`, `geom`, `owner`) VALUES
('C1', 'Aura', 'Jl. Lodan, Kel. Tanah Garam, Kota Solok', '081261607150', 4, '08:00:00', '18:00:00', 1, 0x0000000001030000000100000005000000c662a15ca1265940f543551e082fe9bfc662e1cfa226594082736b1fdb2ee9bfc662a197a22659409d792f01922ee9bfc6622119a126594061153c60b92ee9bfc662a15ca1265940f543551e082fe9bf, 'Pera'),
('C10', 'Pokat Kocok Aira', 'Tanah Garam, Kec. Lubuk Sikarah, Kota Solok, Sumatera Barat 27313', '081267876631', 4, '10:00:00', '21:00:00', 3, 0x0000000001030000000100000005000000f9729a45d928594059a381191635e9bff9723af1d8285940f55844143937e9bff9726a29da285940bc7b21b43e37e9bff972ba6fda285940c0588ab11435e9bff9729a45d928594059a381191635e9bf, 'Aira'),
('C11', 'Sup Ceker Ayam', '', '', 3, '08:00:00', '13:00:00', 0, 0x00000000010300000001000000050000001eada291d52859404def30298137e9bf1eada237d5285940afc948e7cf37e9bf1eada218d628594064d331e6fc37e9bf1ead225cd62859407d43d467b937e9bf1eada291d52859404def30298137e9bf, ''),
('C13', 'Warung Nikmat Nai', 'Perumahan altarindo blok B 08 kelurahan, Tanah Garam, Kec. Lubuk Sikarah, Kota Solok, Sumatera Barat', '', 6, '08:00:00', '12:00:00', 2, 0x0000000001030000000100000005000000a5b010c6eb275940202d6ae82b0be9bfa5b010c6eb2759409aed43e6850be9bfa5b05085ec2759409a7ecd666f0be9bfa5b0d06eec275940202d6ae82b0be9bfa5b010c6eb275940202d6ae82b0be9bf, 'Nai'),
('C14', 'Ampera Karupuak Jangek', 'Tanah Garam, Kec. Lubuk Sikarah, Kota Solok, Sumatera Barat', '', 24, '11:00:00', '20:00:00', 4, 0x00000000010300000001000000050000009dc9c529502859409230823077dae8bf9dc9c5645128594026ea4de8d3dbe8bf9dc945e352285940ea9bc20996dbe8bf9dc945a8512859403b9718b233dae8bf9dc9c529502859409230823077dae8bf, ''),
('C15', 'Warung Sarapan Pagi Uncu ', 'Tj. Bingkung, Kec. Lubuk Sikarah, Kota Solok, Sumatera Barat 27311', '', 10, '07:00:00', '13:00:00', 3, 0x000000000103000000010000000500000054c39baf0e285940e449572be3a7e8bf54c3db140f285940e6ee79e85ea8e8bf54c39bea0f2859406d4ac7a926a8e8bf54c3db6e0f28594006f0612cb6a7e8bf54c39baf0e285940e449572be3a7e8bf, 'Titi'),
('C16', 'Pecel Lele Khas Lamongan', 'Jl. Raya Padang - Solok, Tanah Garam, Kec. Lubuk Sikarah, Kota Solok, Sumatera Barat 27311', '', 30, '10:00:00', '23:00:00', 5, 0x0000000001030000000100000005000000c27cca5f2a2859409cfe74ddf0bee8bfc27c8aae2a285940a097181b56bfe8bfc27ccac72b28594084d7311dfcbee8bfc27cca6d2b28594030084b1fa2bee8bfc27cca5f2a2859409cfe74ddf0bee8bf, ''),
('C17', 'Lapau A', 'Banda panduang, Tanah Garam, Kec. Lubuk Sikarah, Kota Solok, Sumatera Barat 27316', '081261275797', 16, '13:00:00', '22:00:00', 5, 0x0000000001030000000100000005000000c7816415472859401f83d2b2becfe8bfc781642645285940d158a8af45d0e8bfc78164804528594095ecad0d9ad0e8bfc781a47a47285940df335f91fccfe8bfc7816415472859401f83d2b2becfe8bf, ''),
('C18', 'Es.Teh', 'Tanah Garam, Kec. Lubuk Sikarah, Kota Solok, Sumatera Barat 27311', '', 18, '10:00:00', '22:00:00', 4, 0x00000000010300000001000000050000009648f1c8422859403efe0d9d54d3e8bf9648f125402859400b519fd9e6d3e8bf9648716940285940a550a4373bd4e8bf9648710c432859401f1513fba8d3e8bf9648f1c8422859403efe0d9d54d3e8bf, ''),
('C19', 'Ckck Booth', 'Jl banda panduang, Tanah Garam, Kec. Lubuk Sikarah, Kabupaten Solok, Sumatera Barat 27312', '085363314635', 13, '10:00:00', '23:00:00', 3, 0x0000000001030000000100000005000000bde949af462859404114a4f437d2e8bfbde909fe46285940349087f291d2e8bfbde9c92d482859406b84603443d2e8bfbde909df472859403e345bd6eed1e8bfbde949af462859404114a4f437d2e8bf, ''),
('C2', 'Warung Salmadi', 'Kel. Tanah Garam, Kec. Lubuk Sikarah, Kota Solok', '', 10, '08:00:00', '17:00:00', 3, 0x000000000103000000010000000500000045da86cf6b265940fdae68018750e9bf45da461e6c265940c7c2907d2451e9bf45dac6156d265940b0551dfe0d51e9bf45da06c76c265940e45c18e26a50e9bf45da86cf6b265940fdae68018750e9bf, 'Salmadi'),
('C20', 'Warung Singgah PPTI', 'Tanah Garam, Kec. Lubuk Sikarah, Kabupaten Solok, Sumatera Barat 27311', '', 0, '00:00:00', '12:00:00', 0, 0x0000000001030000000100000005000000f9e37314482859403858c51cb4d5e8bff9e3b33e472859405b28735becd5e8bff9e3b3984728594099d577b940d6e8bff9e333904828594067e0ebda02d6e8bff9e37314482859403858c51cb4d5e8bf, ''),
('C21', 'Kedai Uni Yen', 'Tanah Garam, Kec. Lubuk Sikarah, Kabupaten Solok, Sumatera Barat 27311', '081993436931', 8, '06:00:00', '18:00:00', 4, 0x0000000001030000000100000005000000fb9e7d7554285940e9aa47daf1e0e8bffb9efdb854285940a4b3067851e1e8bffb9efd1255285940ff57d2b82fe1e8bffb9e3dc454285940102857dbc4e0e8bffb9e7d7554285940e9aa47daf1e0e8bf, 'Yen'),
('C22', 'Sate Uniang Pariaman', 'Jl. Imam Bonjol, Tanah Garam, Kec. Lubuk Sikarah, Kota Solok, Sumatera Barat 27311', '', 24, '09:00:00', '20:00:00', 3, 0x00000000010300000001000000050000005e8a681466285940da3a23b474f2e8bf5e8a68f5662859405002bd4f2ef3e8bf5e8a28cb672859404c0ece5001f3e8bf5e8a68c866285940f2f100f625f2e8bf5e8a681466285940da3a23b474f2e8bf, 'Uniang'),
('C23', 'Konevi', 'Jl. Imam Bonjol, Tanah Garam, Kec. Lubuk Sikarah, Kota Solok, Sumatera Barat', '', 8, '07:00:00', '22:00:00', 3, 0x0000000001030000000100000005000000576ed1ca90285940b1053203720fe9bf576e11c88f2859402b0a0b01cc0fe9bf576e9165902859400e3a5a7e3c10e9bf576e510e912859402b9ae8a0d10fe9bf576ed1ca90285940b1053203720fe9bf, ''),
('C24', 'RM Lima Saudara', 'Jl. Imam Bonjol, Tanah Garam, Kec. Lubuk Sikarah, Kota Solok, Sumatera Barat', '', 30, '11:00:00', '22:00:00', 5, 0x00000000010300000001000000050000005f15abe2902859409b3b7196de0fe9bf5f15ab7a8f285940ced8e2734910e9bf5f15ab889028594087e2fb8fec10e9bf5f15abf091285940b1d8ac127c10e9bf5f15abe2902859409b3b7196de0fe9bf, ''),
('C25', 'Sup Abang', 'Jl. Imam Bonjol, Tanah Garam, Kec. Lubuk Sikarah, Kota Solok, Sumatera Barat 27317', '082385159699', 8, '08:00:00', '16:00:00', 3, 0x0000000001030000000100000005000000307a006ea6285940afaa2891851fe9bf307a00e7a52859403931f12fb81fe9bf307aa046a6285940b52a63def81fe9bf307a60c2a628594011e3dfffba1fe9bf307a006ea6285940afaa2891851fe9bf, ''),
('C26', 'Sarapan Pagi', 'Tanah Garam, Kec. Lubuk Sikarah, Kota Solok, Sumatera Barat 27313', '082385840582', 8, '07:00:00', '17:00:00', 2, 0x00000000010300000001000000050000006eca9953b028594013a6572fd623e9bf6ecad9d7af2859401dbd535e0024e9bf6eca9926b02859406a2fc50c4124e9bf6eca59a2b02859404771da0d1424e9bf6eca9953b028594013a6572fd623e9bf, 'Erik'),
('C27', 'Rumah Makan Rahmaa', 'Tanah Garam, Kec. Lubuk Sikarah, Kota Solok, Sumatera Barat', '', 12, '10:00:00', '22:00:00', 3, 0x000000000103000000010000000500000011d420b3b32859403c1eb79f2c28e9bf11d440eeb228594015c04aae6728e9bf11d44075b32859401f69eb1bca28e9bf11d48034b4285940f4867a6d8928e9bf11d420b3b32859403c1eb79f2c28e9bf, 'Rahma'),
('C28', 'Sarapan Pagi Yanti', 'Tanah Garam, Kec. Lubuk Sikarah, Kota Solok, Sumatera Barat', '', 0, '06:00:00', '13:00:00', 2, 0x000000000103000000010000000500000010d29b72d72859405d24f5cb2833e9bf10d2bbe8d72859409c43dbb6fb33e9bf10d23b4bd728594041b51ba61a34e9bf10d29bbed62859408067012b5033e9bf10d29b72d72859405d24f5cb2833e9bf, 'Yanti'),
('C29', 'Ampera Sawah Piyai', 'Rajin Sawah Piai No.38, Tanah Garam, Kec. Lubuk Sikarah, Kota Solok, Sumatera Barat 27312', '082385611155', 12, '08:00:00', '10:00:00', 3, 0x0000000001030000000100000005000000dfce6c7da7285940240c24cd0148e9bfdfceace2a728594052298aaa6c48e9bfdfcecc0ca92859409ed274ec1d48e9bfdfceec74a82859403b15da7ebb47e9bfdfce6c7da7285940240c24cd0148e9bf, ''),
('C3', 'Warung Kopi Bu Nenen', 'Jl. Syekh Ismail Alkhalibi, Tanah Garam, Kec. Lubuk Sikarah, Kabupaten Solok, Sumatera Barat', '', 6, '07:00:00', '15:00:00', 2, 0x00000000010300000001000000050000004ca3b83d6e285940c29cdccc8f2de9bf4ca3f81b6e28594019f8f58ade2de9bf4ca3d83a6f285940794c7c3af22de9bf4ca3f8566f285940ab5574aca02de9bf4ca3b83d6e285940c29cdccc8f2de9bf, 'Nenen'),
('C30', 'Mie Palak', 'Jl. Swadaya No.24, Selayo, Kec. Kubung, Kabupaten Solok, Sumatera Barat 27361', '081267795012', 6, '09:00:00', '21:00:00', 2, 0x0000000001030000000100000005000000476973ee852859407ae83a7b615ae9bf4769f37d85285940c43d10d8e25ae9bf4769734886285940c3bcaf161b5be9bf476933c486285940353244da885ae9bf476973ee852859407ae83a7b615ae9bf, ''),
('C4', 'Baim Pizza', 'Tanah Garam, Kec. Lubuk Sikarah, Kota Solok, Sumatera Barat 27313', '085274825225', 10, '09:00:00', '17:00:00', 3, 0x00000000010300000001000000050000005a3db9a2b6285940153790fad133e9bf5a3d7997b628594009a764b5a734e9bf5a3d79e0b8285940ebfa1ef5b234e9bf5a3d790db928594012bc27dae233e9bf5a3db9a2b6285940153790fad133e9bf, 'Baim'),
('C5', 'Bakso Beranak Mas Adi Bar', 'Kel. Tanah Garam, Kec. Lubuk Sikarah, Kota Solok', '', 20, '15:00:00', '22:00:00', 6, 0x00000000010300000001000000050000005d34337ec828594085a80e661a32e9bf5d34339dc728594048fbc0c0f532e9bf5d34f39fc82859400886d97e4433e9bf5d34f380c9285940ccff1ac54132e9bf5d34337ec828594085a80e661a32e9bf, 'Mas Adi'),
('C6', 'Warkop Simpang Tiga', 'Jl. Syekh Ismail Alkhalibi, Tanah Garam, Kec. Lubuk Sikarah, Kabupaten Solok, Sumatera Barat', '', 7, '08:00:00', '17:00:00', 0, 0x00000000010300000001000000050000004d6f173343285940db93e0f1a92ae9bf4d6f577944285940b11f9b31b52ae9bf4d6f179b442859408dd9ac750c2ae9bf4d6f573e432859401192cfd5062ae9bf4d6f173343285940db93e0f1a92ae9bf, ''),
('C7', 'Palanta Uni Bulan', 'Tanah Garam, Kec. Lubuk Sikarah, Kota Solok, Sumatera Barat 27312', '082388371553', 10, '09:00:00', '17:30:00', 4, 0x000000000103000000010000000600000074ae5eccfb2759400d9c164e1c41e9bf74ae3e37fc27594061ed952c5a41e9bf74aefe39fd275940d5efe5c7d140e9bf74ae7e9cfc275940208589498e40e9bf74ae3eb0fb275940a34288060a41e9bf74ae5eccfb2759400d9c164e1c41e9bf, 'Bulan'),
('C8', 'Rumah Makan Sawah Ladang', 'asrama 12, Simpang, Tanah Garam, Lubuk Sikarah, Solok City, West Sumatra', '085263009191', 40, '09:00:00', '22:00:00', 11, 0x000000000103000000010000000500000028cdaa1b0b295940952c5ddb9632e9bf28cdeaf90a295940dfd685720434e9bf28cd2ab60e295940000992d12b34e9bf28cd6aee0e2959400867bb59da32e9bf28cdaa1b0b295940952c5ddb9632e9bf, ''),
('C9', 'Sate Madura Rina', 'Tanah Garam, Kec. Lubuk Sikarah, Kota Solok, Sumatera Barat 27313', '', 12, '15:00:00', '22:00:00', 3, 0x00000000010300000001000000050000001e3ec9ff1a2959400149ab168832e9bf1e3ec9d21a2959408a73dc922533e9bf1e3e49d81c295940495a2eb24133e9bf1e3e49051d2959400149ab168832e9bf1e3ec9ff1a2959400149ab168832e9bf, 'Rina'),
('CU1', 'tes delete f', 'tanah garam', '081266637489', 5, '11:11:00', '23:11:00', 3, 0x0000000001030000000100000005000000d038359bf9255940edd593ba8ddee8bfd03835c3ef255940d105973d201de9bfd038351b3d26594067f3527e9412e9bfd038352b4b26594040bee19c79e3e8bfd038359bf9255940edd593ba8ddee8bf, 'upik');

-- --------------------------------------------------------

--
-- Table structure for table `culinary_facility`
--

CREATE TABLE `culinary_facility` (
  `id_facility` varchar(3) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `culinary_facility`
--

INSERT INTO `culinary_facility` (`id_facility`, `name`) VALUES
('1', 'Toilet'),
('2', 'Parkir'),
('3', 'Mushalla');

-- --------------------------------------------------------

--
-- Table structure for table `culinary_gallery`
--

CREATE TABLE `culinary_gallery` (
  `id_gallery` int(11) NOT NULL,
  `id` varchar(3) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `culinary_gallery`
--

INSERT INTO `culinary_gallery` (`id_gallery`, `id`, `url`) VALUES
(6, 'C5', '1681106537_e3e2383ff32f684dc4d3.jpg'),
(18, 'C2', '1681218736_99b07f9e5fd4e5145f28.png'),
(20, 'C4', '1681896411_6dbec0f9cb4969bd10a1.jpg'),
(21, 'C3', '1684907331_80dff1563a7dcc7ee438.jpg'),
(22, 'C6', '1684907546_b90f3e76b37b65635106.jpg'),
(23, 'C7', '1684907793_758cb44801f7806a5804.png'),
(24, 'C8', '1684908472_5e2183271e7ce7a2bef7.png'),
(25, 'C9', '1684908798_223df15695a32acd6df4.jpg'),
(26, 'C10', '1684909133_126238e555e410849ae4.jpg'),
(35, 'C11', '1686710479_0ae6d53b077cc04c90db.jpg'),
(36, 'C13', '1686718354_92bfa06954f6554ea58a.jpg'),
(37, 'C14', '1686719404_628b459c66b15d761304.jpg'),
(38, 'C15', '1686719781_0f4c7e28416e14b8e3a6.jpg'),
(39, 'C16', '1686720164_de76fe16f92ed8f4ec32.jpg'),
(40, 'C17', '1686720655_da15777854cc49be77c7.jpg'),
(41, 'C18', '1686720992_9977c672d198097ef854.jpg'),
(42, 'C19', '1686721214_c618648776089d3f992d.jpg'),
(43, 'C20', '1686721530_bb767642a4d9845efa8a.jpg'),
(44, 'C21', '1686721788_35b086f9a6917b74001f.jpg'),
(45, 'C22', '1686721978_a59e4a0f0d6b3fdc447d.jpg'),
(46, 'C23', '1686722570_1ea9d014b08f5e3f187c.jpg'),
(47, 'C24', '1686722701_1ec33ba9e0973cc0ee2d.jpg'),
(48, 'C25', '1686723041_463ae28f25f19dddd75b.jpg'),
(49, 'C26', '1686723216_9168781bb2af0c4fc70d.jpg'),
(50, 'C27', '1686723411_ba3224d2b89f5a5fe561.jpg'),
(51, 'C28', '1686723784_a6af2a432d26feecc88a.jpg'),
(52, 'C29', '1686724197_2d95158cc481b64e1ef5.jpg'),
(53, 'C1', '1687595735_849a9743176df0fb25be.jpg'),
(55, 'CU1', '1688971934_60dc1b9023eb824554a5.png');

-- --------------------------------------------------------

--
-- Table structure for table `detail_package`
--

CREATE TABLE `detail_package` (
  `id_package` varchar(5) NOT NULL,
  `day` varchar(1) NOT NULL,
  `activity` varchar(1) NOT NULL,
  `activity_type` varchar(1) DEFAULT NULL,
  `id_object` varchar(3) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_package`
--

INSERT INTO `detail_package` (`id_package`, `day`, `activity`, `activity_type`, `id_object`, `description`) VALUES
('P1', '1', '1', NULL, 'T1', 'Payo Nature'),
('P1', '1', '2', NULL, 'C13', 'Warung Nikmat Nai'),
('P1', '2', '3', NULL, 'C29', 'Ampera Sawah Piyai'),
('P1', '2', '4', NULL, 'E2', 'Bakaua'),
('P2', '1', '1', NULL, 'T1', 'Payo Nature'),
('P2', '2', '2', NULL, 'C24', 'RM Lima Saudara'),
('P3', '1', '1', NULL, 'T1', 'Payo Nature'),
('P3', '1', '2', NULL, 'C17', 'Lapau A'),
('P3', '2', '3', NULL, 'W4', 'Mushalla Nurul Islam');

-- --------------------------------------------------------

--
-- Table structure for table `detail_service_package`
--

CREATE TABLE `detail_service_package` (
  `id_service_package` varchar(3) NOT NULL,
  `id_package` varchar(5) NOT NULL,
  `status` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_service_package`
--

INSERT INTO `detail_service_package` (`id_service_package`, `id_package`, `status`) VALUES
('S1', 'P1', NULL),
('S1', 'P2', NULL),
('S1', 'P3', NULL),
('S2', 'P1', NULL),
('S2', 'P2', NULL),
('S2', 'P3', NULL),
('S3', 'P1', NULL),
('S3', 'P3', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` varchar(3) NOT NULL,
  `id_category` varchar(3) NOT NULL,
  `name` varchar(30) NOT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `ticket_price` int(11) DEFAULT NULL,
  `contact_person` varchar(13) DEFAULT NULL,
  `geom` geometry NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `id_category`, `name`, `date_start`, `date_end`, `description`, `ticket_price`, `contact_person`, `geom`) VALUES
('E1', '2', 'Bersepeda', '2022-03-31', '2022-03-31', 'Bersepeda ria', 0, '081274876376', 0x00000000010300000001000000050000000be1d09c6926594031ddf0d21850e9bf0be1b08e6a265940c389a08c1b51e9bf0be1f0d768265940040496061352e9bf0be11005672659401e848ccecc50e9bf0be1d09c6926594031ddf0d21850e9bf),
('E2', '1', 'Bakaua', '2023-08-05', '2023-08-05', 'acara makan basamo', 0, '080808080808', 0x0000000001030000000100000005000000d03835eb3f26594044eff0d7c656e9bfd038358b9f265940528691319199e9bfd03835e3462759400f9beeed4253e9bfd03835637c265940c964f2e62f2be9bfd03835eb3f26594044eff0d7c656e9bf),
('E3', '2', 'Latihan Paralayang', '2023-06-18', '2023-06-18', 'latihan paralayang', 400000, '081374215555', 0x000000000103000000010000000500000035e9edec3127594045c74f53190ee9bf35e9ada630275940cba01550a00ee9bf35e9ed6531275940515bccedff0ee9bf35e9edcd32275940699a06f1780ee9bf35e9edec3127594045c74f53190ee9bf),
('E4', '2', 'Sunrise Payo', '0000-00-00', '0000-00-00', 'Menikmati keindahan alam Payo di pagi hari', 0, '083833313556', 0x000000000103000000010000000500000035e9edec3127594045c74f53190ee9bf35e9ada630275940cba01550a00ee9bf35e9ed6531275940515bccedff0ee9bf35e9edcd32275940699a06f1780ee9bf35e9edec3127594045c74f53190ee9bf),
('E5', '1', 'Memanen padi', '0000-00-00', '0000-00-00', 'kegiatan memanen padi saat musim panen tiba', 0, '082388313556', 0x00000000010300000001000000050000000be1d09c6926594031ddf0d21850e9bf0be1b08e6a265940c389a08c1b51e9bf0be1f0d768265940040496061352e9bf0be11005672659401e848ccecc50e9bf0be1d09c6926594031ddf0d21850e9bf),
('E6', '1', 'Panen Krisan', '0000-00-00', '0000-00-00', 'Kegiatan memanen bunga krisan saat bunga siap dipetik', 0, '082388313556', 0x00000000010300000001000000050000000be1d09c6926594031ddf0d21850e9bf0be1b08e6a265940c389a08c1b51e9bf0be1f0d768265940040496061352e9bf0be11005672659401e848ccecc50e9bf0be1d09c6926594031ddf0d21850e9bf),
('E7', '1', 'Malamang', '0000-00-00', '0000-00-00', 'Kegiatan adat membuat lamang yang diadakan warga lokal secara gotong royong', 0, '082388313556', 0x00000000010300000001000000050000000be1d09c6926594031ddf0d21850e9bf0be1b08e6a265940c389a08c1b51e9bf0be1f0d768265940040496061352e9bf0be11005672659401e848ccecc50e9bf0be1d09c6926594031ddf0d21850e9bf),
('E8', '1', 'Tari di Atas Kelapa', '0000-00-00', '0000-00-00', 'Kegiatan seni lokal berupa tarian yang dilakukan untuk menyambut tamu di Payo', 0, '082383313556', 0x00000000010300000001000000050000000be1d09c6926594031ddf0d21850e9bf0be1b08e6a265940c389a08c1b51e9bf0be1f0d768265940040496061352e9bf0be11005672659401e848ccecc50e9bf0be1d09c6926594031ddf0d21850e9bf);

-- --------------------------------------------------------

--
-- Table structure for table `event_category`
--

CREATE TABLE `event_category` (
  `id_category` varchar(3) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_category`
--

INSERT INTO `event_category` (`id_category`, `name`) VALUES
('1', 'Adat'),
('2', 'Olahraga'),
('3', 'Alam');

-- --------------------------------------------------------

--
-- Table structure for table `event_gallery`
--

CREATE TABLE `event_gallery` (
  `id_gallery` int(11) NOT NULL,
  `id` varchar(3) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_gallery`
--

INSERT INTO `event_gallery` (`id_gallery`, `id`, `url`) VALUES
(3, 'E1', '1681027293_967b222db0e41cc59d65.jpg'),
(12, 'E3', '1686725872_443db417260778816f74.jpg'),
(13, 'E4', '1689149394_60d612e3fc1e2ea217fa.jpg'),
(14, 'E5', '1689149691_0b91e5d620d53f54f436.jpg'),
(15, 'E6', '1689149770_9a349d6bf75bc9555425.jpg'),
(16, 'E7', '1689149842_56afe7a2bc5dc755a06a.jpg'),
(17, 'E8', '1689149972_b5b8de21fd1643c3b5f6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `event_video`
--

CREATE TABLE `event_video` (
  `id_video` int(11) NOT NULL,
  `id` varchar(3) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_video`
--

INSERT INTO `event_video` (`id_video`, `id`, `url`) VALUES
(5, 'E2', '1686120631_0ab30ceabc335f71c2d1.mp4'),
(6, 'E1', '1686136127_f410114e443ae81b7523.mp4');

-- --------------------------------------------------------

--
-- Table structure for table `homestay`
--

CREATE TABLE `homestay` (
  `id` varchar(3) NOT NULL,
  `name` varchar(25) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `contact_person` varchar(13) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `open` time DEFAULT NULL,
  `close` time DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `geom` geometry NOT NULL,
  `owner` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `homestay`
--

INSERT INTO `homestay` (`id`, `name`, `address`, `contact_person`, `capacity`, `open`, `close`, `price`, `geom`, `owner`) VALUES
('H1', 'Piai Homestay', 'Rajin Sawah Piai No.38, Tanah Garam, Kec. Lubuk Sikarah, Kota Solok, Sumatera Barat 27312', '082181752250', 14, '00:00:00', '12:00:00', 250000, 0x0000000001030000000100000005000000383402999c28594044b1a826224ee9bf383442399e2859405fe52a48e44de9bf383402c69c285940140d8c73114ce9bf3834821a9b28594003843711714ce9bf383402999c28594044b1a826224ee9bf, ''),
('H2', 'Nesta Homestay', 'Payo, kelurahan tanah garam, kecamatan lubuk sikarah, kota solok, sumatera barat', '082286325256', 4, '00:00:00', '12:00:00', 150000, 0x000000000103000000010000000500000098513c3c70265940be83cb820455e9bf9851fcd66f265940621a6fdddf55e9bf98513ca4712659409cbfc85b2356e9bf98517c097226594013b5bbe05855e9bf98513c3c70265940be83cb820455e9bf, ''),
('H3', 'Vikyo Homestay', 'Payo, kelurahan tanah garam, kecamatan lubuk sikarah, kota solok, sumatera barat', '085271696064', 4, '00:00:00', '12:00:00', 150000, 0x000000000103000000010000000500000094e2f71e692659406961ee2e6c56e9bf94e23749682659408fe8e7ebe756e9bf94e2773569265940b851e1a86357e9bf94e2f7ff69265940111d0b4ce256e9bf94e2f71e692659406961ee2e6c56e9bf, 'Viki');

-- --------------------------------------------------------

--
-- Table structure for table `homestay_detail_facility`
--

CREATE TABLE `homestay_detail_facility` (
  `id` varchar(3) NOT NULL,
  `id_facility` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `homestay_facility`
--

CREATE TABLE `homestay_facility` (
  `id_facility` varchar(3) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `homestay_facility`
--

INSERT INTO `homestay_facility` (`id_facility`, `name`) VALUES
('1', 'Kamar'),
('10', 'Air Mandi Panas'),
('2', 'Dapur'),
('3', 'Ruang Tamu'),
('4', 'Wifi'),
('5', 'Sarapan'),
('6', 'TV'),
('7', 'AC'),
('8', 'Ruang Makan'),
('9', 'Kamar Mandi');

-- --------------------------------------------------------

--
-- Table structure for table `homestay_gallery`
--

CREATE TABLE `homestay_gallery` (
  `id_gallery` int(11) NOT NULL,
  `id` varchar(3) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) NOT NULL,
  `versions` varchar(255) DEFAULT NULL,
  `class` varchar(255) DEFAULT NULL,
  `group` varchar(255) DEFAULT NULL,
  `namespace` varchar(255) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `batch` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `id_package` varchar(5) NOT NULL,
  `name` varchar(25) NOT NULL,
  `min_capaity` int(11) NOT NULL,
  `contact_person` varchar(13) NOT NULL,
  `description` text NOT NULL,
  `brosur_url` char(255) NOT NULL,
  `price` int(11) NOT NULL,
  `custom` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`id_package`, `name`, `min_capaity`, `contact_person`, `description`, `brosur_url`, `price`, `custom`) VALUES
('P1', '3', 0, '0', 'CUSTOM BY USER', '', 0, '1'),
('P2', 'user2', 0, '0', 'CUSTOM BY USER', '', 0, '1'),
('P3', 'user2', 0, '0', 'Custom order by user2', '', 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `package_day`
--

CREATE TABLE `package_day` (
  `id_package` varchar(5) NOT NULL,
  `day` varchar(1) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `package_day`
--

INSERT INTO `package_day` (`id_package`, `day`, `description`) VALUES
('P1', '1', 'USER INPUT'),
('P1', '2', 'USER INPUT'),
('P2', '1', 'USER INPUT'),
('P2', '2', 'USER INPUT'),
('P3', '1', 'USER INPUT'),
('P3', '2', 'USER INPUT');

-- --------------------------------------------------------

--
-- Table structure for table `service_package`
--

CREATE TABLE `service_package` (
  `id_service_package` varchar(3) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service_package`
--

INSERT INTO `service_package` (`id_service_package`, `name`) VALUES
('S1', 'Paralayang'),
('S2', 'Transportasi'),
('S3', 'Makan'),
('S4', 'Guide'),
('S6', 'Malamang'),
('S7', 'Cetak Foto');

-- --------------------------------------------------------

--
-- Table structure for table `souvenir_detail_facility`
--

CREATE TABLE `souvenir_detail_facility` (
  `id` varchar(3) NOT NULL,
  `id_facility` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `souvenir_detail_facility`
--

INSERT INTO `souvenir_detail_facility` (`id`, `id_facility`) VALUES
('S1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `souvenir_facility`
--

CREATE TABLE `souvenir_facility` (
  `id_facility` varchar(3) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `souvenir_facility`
--

INSERT INTO `souvenir_facility` (`id_facility`, `name`) VALUES
('1', 'Toilet'),
('12', 'satuuuu'),
('13', 'iyakah'),
('14', 'test page2'),
('15', 'tp3'),
('16', 'tp4'),
('17', 'tp5'),
('18', 'tp6'),
('19', 'tp7'),
('2', 'Sepeda'),
('20', 'tp8');

-- --------------------------------------------------------

--
-- Table structure for table `souvenir_gallery`
--

CREATE TABLE `souvenir_gallery` (
  `id_gallery` int(11) NOT NULL,
  `id` varchar(3) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `souvenir_gallery`
--

INSERT INTO `souvenir_gallery` (`id_gallery`, `id`, `url`) VALUES
(1, 'S1', '1689152743_e4c57ce0f045238b6050.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `souvenir_place`
--

CREATE TABLE `souvenir_place` (
  `id` varchar(3) NOT NULL,
  `name` varchar(25) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `contact_person` varchar(13) DEFAULT NULL,
  `owner` varchar(25) DEFAULT NULL,
  `geom` geometry NOT NULL,
  `employee` int(11) DEFAULT NULL,
  `open` time DEFAULT NULL,
  `close` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `souvenir_place`
--

INSERT INTO `souvenir_place` (`id`, `name`, `address`, `capacity`, `contact_person`, `owner`, `geom`, `employee`, `open`, `close`) VALUES
('S1', 'Kawispa Cenderamata', 'Payo, Kel. Tanah Garam, Kota Solok', 4, '0812767348749', 'Rama', 0x000000000103000000010000000500000036d3d29d68265940f4d1c6ce1152e9bf36d352e16826594040e5f38d3352e9bf36d39219692659407bf9e92e0c52e9bf36d332c568265940ac9df1ffe151e9bf36d3d29d68265940f4d1c6ce1152e9bf, 2, '08:00:00', '17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tourism_category`
--

CREATE TABLE `tourism_category` (
  `id_category` varchar(3) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tourism_category`
--

INSERT INTO `tourism_category` (`id_category`, `name`) VALUES
('1', 'Agrowisata'),
('2', 'Pendukung');

-- --------------------------------------------------------

--
-- Table structure for table `tourism_detail_facility`
--

CREATE TABLE `tourism_detail_facility` (
  `id` varchar(3) NOT NULL,
  `id_facility` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tourism_detail_facility`
--

INSERT INTO `tourism_detail_facility` (`id`, `id_facility`) VALUES
('T3', '1'),
('T3', '10'),
('T3', '2'),
('T3', '3'),
('T3', '4'),
('T3', '5'),
('T3', '6'),
('T3', '8'),
('T4', '10');

-- --------------------------------------------------------

--
-- Table structure for table `tourism_facility`
--

CREATE TABLE `tourism_facility` (
  `id_facility` varchar(3) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tourism_facility`
--

INSERT INTO `tourism_facility` (`id_facility`, `name`) VALUES
('1', 'Toilet'),
('10', 'Musholla'),
('2', 'Gazebo'),
('3', 'Menara Pandang'),
('4', 'Taman bermain anak'),
('5', 'Kebun Bunga'),
('6', 'Parkir'),
('7', 'Paralayang'),
('8', 'Spot Foto');

-- --------------------------------------------------------

--
-- Table structure for table `tourism_gallery`
--

CREATE TABLE `tourism_gallery` (
  `id_gallery` int(11) NOT NULL,
  `id` varchar(3) NOT NULL,
  `url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tourism_gallery`
--

INSERT INTO `tourism_gallery` (`id_gallery`, `id`, `url`) VALUES
(6, 'T1', '1681896679_97fd82d77c32140d796a.jpg'),
(8, 'T3', '1681897165_f2fc8e6ae97270c1470a.jpg'),
(9, 'T4', '1681897389_3c901134800ed02686f1.jpg'),
(11, 'T1', '1685871519_564699f851375d416cca.jpg'),
(14, 'T3', '1688104263_87afc1ac347cb0dec8f4.jpg'),
(16, 'T3', '1688104330_fe501d869c11c82e6c34.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tourism_object`
--

CREATE TABLE `tourism_object` (
  `id` varchar(3) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `open` time DEFAULT NULL,
  `close` time DEFAULT NULL,
  `ticket_price` int(11) DEFAULT NULL,
  `geom` geometry DEFAULT NULL,
  `contact_person` varchar(13) DEFAULT NULL,
  `id_category` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tourism_object`
--

INSERT INTO `tourism_object` (`id`, `name`, `address`, `open`, `close`, `ticket_price`, `geom`, `contact_person`, `id_category`) VALUES
('T1', 'Payo Nature', 'Payo, Kel. Tanah Garam, Kota Solok', '08:00:00', '15:00:00', 0, 0x000000000103000000010000000600000046334aad38265940e7ce24ae5047e9bf46330acf3826594066dadbaad747e9bf4633ca903e265940e2dc1fbee249e9bf46338a2b3e265940a37a2644eb48e9bf46334abb39265940fdd7470e4b47e9bf46334aad38265940e7ce24ae5047e9bf, '082388313556', '2'),
('T3', 'Agrowisata Batu Patah Payo', '', '07:00:00', '18:00:00', 0, 0x000000000103000000010000000b00000027061230672659407b7228786f4fe9bf2706d21963265940793eceab6951e9bf270652b763265940c6e8a8fdac53e9bf2706929e5a265940d049940d3f56e9bf270692335c265940354e099eba58e9bf2706125263265940c3179d612858e9bf270692f76a26594036e1d5bcce53e9bf2706120e6b2659407f0b2d465052e9bf270612d369265940c07ee2909950e9bf270612c56826594079c54695e54fe9bf27061230672659407b7228786f4fe9bf, '082388313556', '1'),
('T4', 'Puncak Bidadari Payo', 'Payo, Kel. Tanah Garam, Kota Solok', '09:00:00', '17:00:00', 0, 0x000000000103000000010000000500000035e9edec3127594045c74f53190ee9bf35e9ada630275940cba01550a00ee9bf35e9ed6531275940515bccedff0ee9bf35e9edcd32275940699a06f1780ee9bf35e9edec3127594045c74f53190ee9bf, '081374215555', '2');

-- --------------------------------------------------------

--
-- Table structure for table `tourism_video`
--

CREATE TABLE `tourism_video` (
  `id_video` int(11) NOT NULL,
  `id` varchar(3) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tourism_video`
--

INSERT INTO `tourism_video` (`id_video`, `id`, `name`, `url`) VALUES
(3, 'T1', NULL, '1686135773_3cc2317df709576ef105.mp4'),
(4, 'T3', NULL, 'Agrowisata2.mp4');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 0,
  `force_pass_reset` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'polardhani17@gmail.com', 'adminputri', '$2y$10$8zCrQ4xGH1GvPB.YdiRm5OpTzcT6MSxgOS39vxhBQHTujigbM57bu', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-04-08 03:26:56', '2023-04-08 03:26:56', NULL),
(2, 'admin@laili.com', 'admin', '$2y$10$Eel4pTAq3XE6n3aGE1Q3e.syAu7kKr49cKNCCG2dnzAlEzPkd6YC.', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-05-20 05:03:47', '2023-05-20 05:03:47', NULL),
(3, 'user1@testing.com', 'user1', '$2y$10$cmQdrZrnyX4IzExXF8Mm5.W6dgcU4LEMJ3RE.eLXF6S3rrWqja.MC', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-07-16 03:56:04', '2023-07-16 03:56:04', NULL),
(4, 'user2@testing.com', 'user2', '$2y$10$tP.ad4RU7/hXGw6wWZ9arOfk1X5UNCqSXZ.TKgSfzkv3bMm1siz6C', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-07-16 04:12:11', '2023-07-16 04:12:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `village`
--

CREATE TABLE `village` (
  `id` varchar(3) NOT NULL,
  `name` varchar(255) NOT NULL,
  `district` varchar(255) DEFAULT NULL,
  `geom` geometry DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `village`
--

INSERT INTO `village` (`id`, `name`, `district`, `geom`) VALUES
('V01', 'Tanah Garam', 'Tanah Garam', 0x0000000001060000000100000001030000000100000067000000a7b7eb171f2859400c64e8733ca6e8bf9fb168d41e28594021eedd5ee9a9e8bf636037e82128594001ae7161ffabe8bfc94dc4e12628594006fa42a55eafe8bfd3f4bb4c28285940f7695466d2afe8bf0fd40ff93a285940d8c312f216b4e8bf748550f93a285940147e222f63b5e8bfcad67cfb3d285940150c08a4d1b7e8bf9e18fffc3d285940ed33b56e91bfe8bf7c2adb7f41285940e5d9e0ff6acfe8bf2d0293ff4828594001dc8aa60bd2e8bf5ead08cd502859400a008403cad3e8bf406a23ec522859402c029dd685d5e8bf733084d956285940f483ab1ce6d6e8bf10117a2a6128594013ba4793f4e0e8bfd431b8316428594019cae01ea3e3e8bf7d3406346428594029a61ecc5aefe8bfc76511b16b285940f76d0bf2b6f8e8bf57c09a73782859401f40163f63fbe8bfe6d977517c285940d9679438b3fbe8bf7711bf998d285940d65bd3652bfbe8bfc6a3845a9e285940e1d9d0eb5af8e8bf1915f446c0285940d0132554e200e9bfe9b60162c228594002b41c40e001e9bfcb5f49e3e6285940e2b1cc3d8e13e9bfc7418702f428594025dc75070019e9bfce2c485c0229594001f876f6741ee9bf0d4198a212295940f5c590167923e9bf3b6a614f16295940103ec3f49d24e9bf87bce1b517295940d81180dd9525e9bfc54335fb18295940f367024c6e27e9bf1d85a60f2629594000583eb88a2be9bfc93fc71026295940f6372e821e31e9bfd8045a1126295940e875a9d11334e9bf8034a226432959402102fa39b442e9bf8dce1e2b502959402aa2fdaca866e9bf9f68b29150295940f2958802c467e9bffcaf07fd50295940ed9f1676ec68e9bfd7452453512959401e369a4bda69e9bfed3cecb751295940eacf65a9f06ae9bf1729699051295940fe1f7660cc6be9bf983d5a54512959401d06e4621a6de9bf24791c265129594010de7a881b6ee9bfb939553a50295940e6addfbd3a73e9bfa0f3724e4f29594024dc25835a78e9bfe21d635d3a29594018b2a65ea480e9bf4e0c8dea352959400b02371d6782e9bf9d3b6f662d29594000841ffcc585e9bf4474ca1e22295940d39decc75783e9bf19ec8f45182959401a0c0c873881e9bfb8511584fa2859402400742ecf7ae9bfce108605db285940d89b43cbd07ae9bfe297d7acb62859401658028b4972e9bf0cd1e0785f285940f8218c102882e9bf8c49e09a2c285940eb0d9818248de9bfd4945fd905285940e48f5131af95e9bf0b790d58e6275940fd67a8084788e9bf7b6a788ad027594023368d4c8089e9bfd380892bbd275940ff270e0eeb96e9bfdcec52343f275940dd0584b703a8e9bfd97691702c275940f01577bb83aae9bf348b0110ec255940ecc170f132d5e9bfbb469b5e75255940e6d7ff68d4eee9bfe59e46964a255940f089805997f6e9bfbcd85fcf38255940ed49d2f5d0f9e9bfe285818c85245940058ec0abad14eabfdb8c029a172459400fa6c09f6b2ceabf828202f1ec235940f44323e7a135eabf28a8c6e2de23594019f8e681ed34eabf845f8841a4235940f3f35e08fd31eabf1c77d25e32235940e6737bce471deabf89ddf090dd225940d84f68a18a13eabf438973cea5225940ecdf66a4fee3e9bfb21cd80fad225940dc134edeebd2e9bf2fb87dcfd3225940eeffa60a2fbee9bf61e1ebe71e2359400c44297cc1b0e9bfe8281d9f7323594005feed8f8aafe9bf1adee5a684235940f01577bb83aae9bf557c04f2b923594019d430d4c69ae9bf00792d6c072459401f5cbab3b157e9bf380b135629245940e65759359751e9bf7e074bb83c245940286eb9990654e9bf4fea2bba3c245940f3bb3ef4c75de9bf92f1b01822245940d0394fcf6477e9bf0b81a074072459401caa35ce9783e9bf3a2e70e309245940d733e38d0191e9bf4fc49bb21f245940dee785541997e9bfbc6cd99a412459402b48a7a27588e9bf308031994124594013168273ec7fe9bf8a0fefa95e2459402228e8ad2976e9bffbf3e2267e24594011b667c9666ce9bf343420237e2459400ce6cf15e458e9bf126128bd6a24594026ce4afff142e9bf0d24e8d776245940fc49d4b8bf36e9bf794c8dcb87245940f0c1c38cfd2ce9bf9233ca063726594016ec4ba57e1fe9bfa66b165cc826594027bc2694e2fae8bf585ebcdf04275940d00b64535eb5e8bf86432689cb275940312cd13d35bae8bfdc64183ae7275940f203c27299b3e8bf9991c98ef92759401090d98739afe8bff1c853810a28594010e263c796a0e8bfa7b7eb171f2859400c64e8733ca6e8bf);

-- --------------------------------------------------------

--
-- Table structure for table `worship_category`
--

CREATE TABLE `worship_category` (
  `id_category` varchar(3) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `worship_category`
--

INSERT INTO `worship_category` (`id_category`, `name`) VALUES
('1', 'Islam'),
('2', 'Kristen'),
('3', 'Hindu'),
('4', 'Budha'),
('5', 'Konghucu'),
('7', 'Katolik');

-- --------------------------------------------------------

--
-- Table structure for table `worship_facility`
--

CREATE TABLE `worship_facility` (
  `id_facility` varchar(3) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `worship_facility`
--

INSERT INTO `worship_facility` (`id_facility`, `name`) VALUES
('1', 'Toilet'),
('WF1', 'Parkir');

-- --------------------------------------------------------

--
-- Table structure for table `worship_gallery`
--

CREATE TABLE `worship_gallery` (
  `id_gallery` int(11) NOT NULL,
  `id` varchar(3) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `worship_gallery`
--

INSERT INTO `worship_gallery` (`id_gallery`, `id`, `url`) VALUES
(7, 'W1', '1681894546_72677ed1bda5a66b8202.jpg'),
(9, 'W2', '1686727263_6f11b4d752a562c4a9e4.jpg'),
(10, 'W1', '1686727329_b2a3653964497762e90d.jpg'),
(11, 'W3', '1686727432_1f7bcbb2e201694e163a.jpg'),
(12, 'W4', '1686833910_8119734eb3d1a804be05.jpg'),
(13, 'W5', '1686834198_49029f2e5a7a7c6695f9.png'),
(14, 'W6', '1686834495_bf8022cb4c33aa63082c.jpg'),
(15, 'W7', '1686906652_379198cd94e3b149b260.jpg'),
(16, 'W8', '1686907862_7bc6acf4a35f3ebec3e4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `worship_place`
--

CREATE TABLE `worship_place` (
  `id` varchar(3) NOT NULL,
  `id_category` varchar(3) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `area_size` int(11) DEFAULT NULL,
  `building_size` int(11) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `last_renovation` varchar(4) DEFAULT NULL,
  `geom` geometry NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `worship_place`
--

INSERT INTO `worship_place` (`id`, `id_category`, `name`, `address`, `area_size`, `building_size`, `capacity`, `last_renovation`, `geom`) VALUES
('W1', '1', 'Mushalla Nurul Ulya', 'Tanah Garam, Kec. Lubuk Sikarah, Kabupaten Solok, Sumatera Barat', 100, 100, 90, '2023', 0x00000000010300000001000000050000005cafe9aa922659403142c8eeae2ee9bf5caf69489326594067a5dac7cd2fe9bf5cafa942952659403a1ece68a62fe9bf5caf69dd94265940e11b76cf922ee9bf5cafe9aa922659403142c8eeae2ee9bf),
('W2', '1', 'Mushalla Nurul Abrar', 'Payo, Tanah Garam, Kec. Lubuk Sikarah, Kabupaten Solok, Sumatera Barat 27312', 20, 20, 15, '', 0x00000000010300000001000000050000008a7adebf5e26594059a246d0934de9bf8a7ade195f26594070d4b50c264ee9bf8a7a5ee45f2659405545428d0f4ee9bf8a7a1eac5f265940f90cd3507d4de9bf8a7adebf5e26594059a246d0934de9bf),
('W3', '1', 'Masjid Jabal Nur', 'Tanah Garam, Kec. Lubuk Sikarah, Kabupaten Solok, Sumatera Barat 27312', 100, 100, 90, '', 0x0000000001030000000100000005000000e657b9ebfa275940fdcb1cb78b5de9bfe65779d2f9275940d34e1590aa5ee9bfe6573997fc275940cd16390c485fe9bfe657f9f3fd27594028a21dd32e5ee9bfe657b9ebfa275940fdcb1cb78b5de9bf),
('W4', '1', 'Mushalla Nurul Islam', 'Jl. Kaili, Tanah Garam, Kec. Lubuk Sikarah, Kota Solok, Sumatera Barat 27312', 225, 48, 100, '', 0x0000000001030000000100000005000000f7388f67102859406251fba69406e9bff7380f430f28594055347b417b07e9bff7388fcf11285940563c33dfda07e9bff7384f7812285940c7e23cc5dd06e9bff7388f67102859406251fba69406e9bf),
('W5', '1', 'Masjid Al Aqsa', 'Jl. Sersan Basir, Tanah Garam, Kec. Lubuk Sikarah, Kota Solok, Sumatera Barat 27313', 0, 0, 0, '', 0x00000000010300000001000000080000001a7ab4bd1d295940a81afb901758e9bf1a7af4521b295940ea5b0b33c357e9bf1a7af4441a29594056b6a112d457e9bf1a7af4ea19295940261c446daf58e9bf1a7af4cb1a2959401535b7ecc558e9bf1a7ab4ed1a2959404dc9a64a1a59e9bf1a7a34201d295940e0f08c494759e9bf1a7ab4bd1d295940a81afb901758e9bf),
('W6', '1', 'Masjid Nurul Iman', 'Jl. Ki Hajar Dewantoro No.164, Tanah Garam, Kec. Lubuk Sikarah, Kota Solok, Sumatera Barat 27313', 500, 400, 300, '', 0x0000000001030000000100000005000000fbac8a0c0e295940cad87f90b82ee9bffbac0a6f0d295940c4476824ad30e9bffbacaaea0f2959401d8697e3ce30e9bffbac4a4a102959404193de0efc2ee9bffbac8a0c0e295940cad87f90b82ee9bf),
('W7', '1', 'Surau Kapalo Koto', 'Jl. Syech Ismail Alkhalibi, Kel. Tanah Garam', 120, 50, 20, '', 0x00000000010300000001000000050000002e83b5116c285940da0dc105742ce9bf2e8335ce6b285940640ef481112de9bf2e8375416d28594046882341332de9bf2e83759b6d2859400792f0c4952ce9bf2e83b5116c285940da0dc105742ce9bf),
('W8', '1', 'Mushalla Tauhid', 'Jl. Lodan, Tanah Garam, Kec. Lubuk Sikarah, Kota Solok, Sumatera Barat 27312', 30, 30, 15, '', 0x000000000103000000010000000500000068307b513726594033d4255db43fe9bf6830bb0237265940cdcf01ba3540e9bf6830bb893726594071f875394c40e9bf6830fbee3726594029f7bc3cc53fe9bf68307b513726594033d4255db43fe9bf),
('W9', '1', 'Masjid Al Huda', 'Wisma Solok Nan Indah, Tanah Garam, Kec. Lubuk Sikarah, Kota Solok, Sumatera Barat 27312', 200, 160, 250, '', 0x000000000103000000010000000500000040cf0cb32e285940f85badfc9a7be9bf40cfccf32d285940a1b8d536877ce9bf40cf0c48302859404ffc3014f27ce9bf40cf4c343128594070d008da057ce9bf40cf0cb32e285940f85badfc9a7be9bf);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`) USING BTREE,
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`) USING BTREE;

--
-- Indexes for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`) USING BTREE,
  ADD KEY `group_id_user_id` (`group_id`,`user_id`) USING BTREE;

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`) USING BTREE,
  ADD KEY `user_id` (`user_id`) USING BTREE;

--
-- Indexes for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`) USING BTREE,
  ADD KEY `selector` (`selector`) USING BTREE;

--
-- Indexes for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`) USING BTREE,
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`) USING BTREE;

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`date`,`id`,`id_package`) USING BTREE,
  ADD KEY `id` (`id`),
  ADD KEY `id_package` (`id_package`);

--
-- Indexes for table `culinary`
--
ALTER TABLE `culinary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `culinary_facility`
--
ALTER TABLE `culinary_facility`
  ADD PRIMARY KEY (`id_facility`);

--
-- Indexes for table `culinary_gallery`
--
ALTER TABLE `culinary_gallery`
  ADD PRIMARY KEY (`id_gallery`,`id`) USING BTREE,
  ADD KEY `culinary_culinary_gallery_fk` (`id`) USING BTREE;

--
-- Indexes for table `detail_package`
--
ALTER TABLE `detail_package`
  ADD PRIMARY KEY (`id_package`,`day`,`activity`);

--
-- Indexes for table `detail_service_package`
--
ALTER TABLE `detail_service_package`
  ADD PRIMARY KEY (`id_service_package`,`id_package`) USING BTREE,
  ADD KEY `package_detail_service_package_fk` (`id_package`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_category_event_fk` (`id_category`) USING BTREE;

--
-- Indexes for table `event_category`
--
ALTER TABLE `event_category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `event_gallery`
--
ALTER TABLE `event_gallery`
  ADD PRIMARY KEY (`id_gallery`,`id`) USING BTREE,
  ADD KEY `event_event_gallery_fk` (`id`) USING BTREE;

--
-- Indexes for table `event_video`
--
ALTER TABLE `event_video`
  ADD PRIMARY KEY (`id_video`),
  ADD KEY `event_event_video_fk` (`id`) USING BTREE;

--
-- Indexes for table `homestay`
--
ALTER TABLE `homestay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homestay_detail_facility`
--
ALTER TABLE `homestay_detail_facility`
  ADD PRIMARY KEY (`id`,`id_facility`),
  ADD KEY `facility_detail_facility_culinary_fk` (`id_facility`,`id`) USING BTREE;

--
-- Indexes for table `homestay_facility`
--
ALTER TABLE `homestay_facility`
  ADD PRIMARY KEY (`id_facility`);

--
-- Indexes for table `homestay_gallery`
--
ALTER TABLE `homestay_gallery`
  ADD PRIMARY KEY (`id_gallery`,`id`) USING BTREE,
  ADD KEY `cullinary_place_gallery_cullinary_fk` (`id`) USING BTREE;

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`id_package`);

--
-- Indexes for table `package_day`
--
ALTER TABLE `package_day`
  ADD PRIMARY KEY (`id_package`,`day`);

--
-- Indexes for table `service_package`
--
ALTER TABLE `service_package`
  ADD PRIMARY KEY (`id_service_package`);
ALTER TABLE `service_package` ADD FULLTEXT KEY `id_service_package` (`id_service_package`,`name`);

--
-- Indexes for table `souvenir_detail_facility`
--
ALTER TABLE `souvenir_detail_facility`
  ADD PRIMARY KEY (`id`,`id_facility`),
  ADD KEY `souvenir_facility_souvenir_detail_facility_fk` (`id_facility`,`id`) USING BTREE;

--
-- Indexes for table `souvenir_facility`
--
ALTER TABLE `souvenir_facility`
  ADD PRIMARY KEY (`id_facility`);

--
-- Indexes for table `souvenir_gallery`
--
ALTER TABLE `souvenir_gallery`
  ADD PRIMARY KEY (`id_gallery`,`id`) USING BTREE,
  ADD KEY `souvenir_place_souvenir_gallery_fk` (`id`) USING BTREE;

--
-- Indexes for table `souvenir_place`
--
ALTER TABLE `souvenir_place`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tourism_category`
--
ALTER TABLE `tourism_category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `tourism_detail_facility`
--
ALTER TABLE `tourism_detail_facility`
  ADD PRIMARY KEY (`id`,`id_facility`),
  ADD KEY `tourism_facility_tourism_detail_facility_fk` (`id_facility`,`id`) USING BTREE;

--
-- Indexes for table `tourism_facility`
--
ALTER TABLE `tourism_facility`
  ADD PRIMARY KEY (`id_facility`);

--
-- Indexes for table `tourism_gallery`
--
ALTER TABLE `tourism_gallery`
  ADD PRIMARY KEY (`id_gallery`,`id`) USING BTREE,
  ADD KEY `tourism_object_tourism_gallery_fk` (`id`) USING BTREE;

--
-- Indexes for table `tourism_object`
--
ALTER TABLE `tourism_object`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`id_category`) USING BTREE;

--
-- Indexes for table `tourism_video`
--
ALTER TABLE `tourism_video`
  ADD PRIMARY KEY (`id_video`,`id`) USING BTREE,
  ADD KEY `tourism_object_tourism_video_fk` (`id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`) USING BTREE,
  ADD UNIQUE KEY `username` (`username`) USING BTREE;

--
-- Indexes for table `village`
--
ALTER TABLE `village`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `worship_category`
--
ALTER TABLE `worship_category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `worship_facility`
--
ALTER TABLE `worship_facility`
  ADD PRIMARY KEY (`id_facility`);

--
-- Indexes for table `worship_gallery`
--
ALTER TABLE `worship_gallery`
  ADD PRIMARY KEY (`id_gallery`,`id`) USING BTREE,
  ADD KEY `worship_place_worship_gallery_fk` (`id`);

--
-- Indexes for table `worship_place`
--
ALTER TABLE `worship_place`
  ADD PRIMARY KEY (`id`),
  ADD KEY `worship_category_worship_place_fk` (`id_category`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `culinary_gallery`
--
ALTER TABLE `culinary_gallery`
  MODIFY `id_gallery` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `event_gallery`
--
ALTER TABLE `event_gallery`
  MODIFY `id_gallery` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `event_video`
--
ALTER TABLE `event_video`
  MODIFY `id_video` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `souvenir_gallery`
--
ALTER TABLE `souvenir_gallery`
  MODIFY `id_gallery` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tourism_gallery`
--
ALTER TABLE `tourism_gallery`
  MODIFY `id_gallery` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tourism_video`
--
ALTER TABLE `tourism_video`
  MODIFY `id_video` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `worship_gallery`
--
ALTER TABLE `worship_gallery`
  MODIFY `id_gallery` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`id_package`) REFERENCES `package` (`id_package`);

--
-- Constraints for table `culinary_gallery`
--
ALTER TABLE `culinary_gallery`
  ADD CONSTRAINT `culinary_culinary_gallery_fk` FOREIGN KEY (`id`) REFERENCES `culinary` (`id`);

--
-- Constraints for table `detail_package`
--
ALTER TABLE `detail_package`
  ADD CONSTRAINT `package_day_detail_package_fk` FOREIGN KEY (`id_package`,`day`) REFERENCES `package_day` (`id_package`, `day`);

--
-- Constraints for table `detail_service_package`
--
ALTER TABLE `detail_service_package`
  ADD CONSTRAINT `package_detail_service_package_fk` FOREIGN KEY (`id_package`) REFERENCES `package` (`id_package`),
  ADD CONSTRAINT `service_package_detail_service_package_fk` FOREIGN KEY (`id_service_package`) REFERENCES `service_package` (`id_service_package`);

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_category_event_fk` FOREIGN KEY (`id_category`) REFERENCES `event_category` (`id_category`);

--
-- Constraints for table `event_gallery`
--
ALTER TABLE `event_gallery`
  ADD CONSTRAINT `event_event_gallery_fk` FOREIGN KEY (`id`) REFERENCES `event` (`id`);

--
-- Constraints for table `event_video`
--
ALTER TABLE `event_video`
  ADD CONSTRAINT `event_event_video_fk` FOREIGN KEY (`id`) REFERENCES `event` (`id`);

--
-- Constraints for table `homestay_detail_facility`
--
ALTER TABLE `homestay_detail_facility`
  ADD CONSTRAINT `cullinary_place_detail_facility_culinary_fk` FOREIGN KEY (`id`) REFERENCES `homestay` (`id`),
  ADD CONSTRAINT `facility_detail_facility_culinary_fk` FOREIGN KEY (`id_facility`) REFERENCES `homestay_facility` (`id_facility`);

--
-- Constraints for table `homestay_gallery`
--
ALTER TABLE `homestay_gallery`
  ADD CONSTRAINT `cullinary_place_gallery_cullinary_fk` FOREIGN KEY (`id`) REFERENCES `homestay` (`id`);

--
-- Constraints for table `package_day`
--
ALTER TABLE `package_day`
  ADD CONSTRAINT `package_epackage_day_fk` FOREIGN KEY (`id_package`) REFERENCES `package` (`id_package`);

--
-- Constraints for table `souvenir_detail_facility`
--
ALTER TABLE `souvenir_detail_facility`
  ADD CONSTRAINT `souvenir_facility_souvenir_detail_facility_fk` FOREIGN KEY (`id_facility`) REFERENCES `souvenir_facility` (`id_facility`),
  ADD CONSTRAINT `souvenir_place_souvenir_detail_facility_fk` FOREIGN KEY (`id`) REFERENCES `souvenir_place` (`id`);

--
-- Constraints for table `souvenir_gallery`
--
ALTER TABLE `souvenir_gallery`
  ADD CONSTRAINT `souvenir_place_souvenir_gallery_fk` FOREIGN KEY (`id`) REFERENCES `souvenir_place` (`id`);

--
-- Constraints for table `tourism_detail_facility`
--
ALTER TABLE `tourism_detail_facility`
  ADD CONSTRAINT `tourism_facility_tourism_detail_facility_fk` FOREIGN KEY (`id_facility`) REFERENCES `tourism_facility` (`id_facility`),
  ADD CONSTRAINT `tourism_object_tourism_detail_facility_fk` FOREIGN KEY (`id`) REFERENCES `tourism_object` (`id`);

--
-- Constraints for table `tourism_gallery`
--
ALTER TABLE `tourism_gallery`
  ADD CONSTRAINT `tourism_object_tourism_gallery_fk` FOREIGN KEY (`id`) REFERENCES `tourism_object` (`id`);

--
-- Constraints for table `tourism_object`
--
ALTER TABLE `tourism_object`
  ADD CONSTRAINT `tourism_object_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `tourism_category` (`id_category`);

--
-- Constraints for table `tourism_video`
--
ALTER TABLE `tourism_video`
  ADD CONSTRAINT `tourism_object_tourism_video_fk` FOREIGN KEY (`id`) REFERENCES `tourism_object` (`id`);

--
-- Constraints for table `worship_gallery`
--
ALTER TABLE `worship_gallery`
  ADD CONSTRAINT `worship_place_worship_gallery_fk` FOREIGN KEY (`id`) REFERENCES `worship_place` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
