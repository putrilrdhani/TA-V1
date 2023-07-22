-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Bulan Mei 2023 pada 14.06
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tourism_village`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_activation_attempts`
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
-- Struktur dari tabel `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int(11) NOT NULL DEFAULT 0,
  `permission_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_logins`
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
-- Dumping data untuk tabel `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
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
(18, '::1', 'admin@laili.com', 2, '2023-05-30 06:35:19', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_reset_attempts`
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
-- Struktur dari tabel `auth_tokens`
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
-- Struktur dari tabel `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int(11) NOT NULL DEFAULT 0,
  `permission_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `culinary`
--

CREATE TABLE `culinary` (
  `id` varchar(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact_person` varchar(13) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `open` time DEFAULT NULL,
  `close` time DEFAULT NULL,
  `employee` int(11) DEFAULT NULL,
  `geom` geometry NOT NULL,
  `owner` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `culinary`
--

INSERT INTO `culinary` (`id`, `name`, `address`, `contact_person`, `capacity`, `open`, `close`, `employee`, `geom`, `owner`) VALUES
('CU1', 'Aura', 'Jl. Lodan, Kel. Tanah Garam, Kota Solok', '081261607150', 4, '08:00:00', '18:00:00', 2, 0x0000000001030000000100000005000000c662a15ca1265940f543551e082fe9bfc662e1cfa226594082736b1fdb2ee9bfc662a197a22659409d792f01922ee9bfc6622119a126594061153c60b92ee9bfc662a15ca1265940f543551e082fe9bf, 'Pera'),
('CU10', 'Pokat Kocok Aira', 'Tanah Garam, Kec. Lubuk Sikarah, Kota Solok, Sumatera Barat 27313', '', 4, '10:00:00', '21:00:00', 3, 0x0000000001030000000100000005000000f9729a45d928594059a381191635e9bff9723af1d8285940f55844143937e9bff9726a29da285940bc7b21b43e37e9bff972ba6fda285940c0588ab11435e9bff9729a45d928594059a381191635e9bf, 'Aira'),
('CU2', 'Warung Salmadi', 'Kel. Tanah Garam, Kec. Lubuk Sikarah, Kota Solok', '', 10, '08:00:00', '17:00:00', 3, 0x000000000103000000010000000500000045da86cf6b265940fdae68018750e9bf45da461e6c265940c7c2907d2451e9bf45dac6156d265940b0551dfe0d51e9bf45da06c76c265940e45c18e26a50e9bf45da86cf6b265940fdae68018750e9bf, 'Salmadi'),
('CU3', 'Warung Kopi Bu Nenen', 'Jl. Syekh Ismail Alkhalibi, Tanah Garam, Kec. Lubuk Sikarah, Kabupaten Solok, Sumatera Barat', '', 6, '07:00:00', '15:00:00', 2, 0x00000000010300000001000000050000004ca3b83d6e285940c29cdccc8f2de9bf4ca3f81b6e28594019f8f58ade2de9bf4ca3d83a6f285940794c7c3af22de9bf4ca3f8566f285940ab5574aca02de9bf4ca3b83d6e285940c29cdccc8f2de9bf, 'Nenen'),
('CU4', 'Baim Pizza', 'Tanah Garam, Kec. Lubuk Sikarah, Kota Solok, Sumatera Barat 27313', '085274825225', 10, '09:00:00', '17:00:00', 3, 0x00000000010300000001000000050000005a3db9a2b6285940153790fad133e9bf5a3d7997b628594009a764b5a734e9bf5a3d79e0b8285940ebfa1ef5b234e9bf5a3d790db928594012bc27dae233e9bf5a3db9a2b6285940153790fad133e9bf, 'Baim'),
('CU5', 'Bakso Beranak Mas Adi Barokah', 'Kel. Tanah Garam, Kec. Lubuk Sikarah, Kota Solok', '', 20, '15:00:00', '22:00:00', 6, 0x00000000010300000001000000050000005d34337ec828594085a80e661a32e9bf5d34339dc728594048fbc0c0f532e9bf5d34f39fc82859400886d97e4433e9bf5d34f380c9285940ccff1ac54132e9bf5d34337ec828594085a80e661a32e9bf, 'Mas Adi'),
('CU6', 'Warkop Simpang Tiga', 'Jl. Syekh Ismail Alkhalibi, Tanah Garam, Kec. Lubuk Sikarah, Kabupaten Solok, Sumatera Barat', '', 7, '08:00:00', '17:00:00', 0, 0x00000000010300000001000000050000004d6f173343285940db93e0f1a92ae9bf4d6f577944285940b11f9b31b52ae9bf4d6f179b442859408dd9ac750c2ae9bf4d6f573e432859401192cfd5062ae9bf4d6f173343285940db93e0f1a92ae9bf, ''),
('CU7', 'Palanta Uni Bulan', 'Tanah Garam, Kec. Lubuk Sikarah, Kota Solok, Sumatera Barat 27312', '082388371553', 10, '09:00:00', '17:30:00', 4, 0x000000000103000000010000000600000074ae5eccfb2759400d9c164e1c41e9bf74ae3e37fc27594061ed952c5a41e9bf74aefe39fd275940d5efe5c7d140e9bf74ae7e9cfc275940208589498e40e9bf74ae3eb0fb275940a34288060a41e9bf74ae5eccfb2759400d9c164e1c41e9bf, 'Bulan'),
('CU8', 'Rumah Makan Sawah Ladang', 'asrama 12, Simpang, Tanah Garam, Lubuk Sikarah, Solok City, West Sumatra', '085263009191', 40, '09:00:00', '22:00:00', 11, 0x000000000103000000010000000500000028cdaa1b0b295940952c5ddb9632e9bf28cdeaf90a295940dfd685720434e9bf28cd2ab60e295940000992d12b34e9bf28cd6aee0e2959400867bb59da32e9bf28cdaa1b0b295940952c5ddb9632e9bf, ''),
('CU9', 'Sate Madura Rina', 'Tanah Garam, Kec. Lubuk Sikarah, Kota Solok, Sumatera Barat 27313', '', 12, '15:00:00', '22:00:00', 3, 0x00000000010300000001000000050000001e3ec9ff1a2959400149ab168832e9bf1e3ec9d21a2959408a73dc922533e9bf1e3e49d81c295940495a2eb24133e9bf1e3e49051d2959400149ab168832e9bf1e3ec9ff1a2959400149ab168832e9bf, 'Rina');

-- --------------------------------------------------------

--
-- Struktur dari tabel `culinary_detail_facility`
--

CREATE TABLE `culinary_detail_facility` (
  `id_detail` int(5) NOT NULL,
  `id_facility` varchar(5) NOT NULL,
  `id` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `culinary_detail_facility`
--

INSERT INTO `culinary_detail_facility` (`id_detail`, `id_facility`, `id`) VALUES
(2, '2', 'CU2'),
(7, '2', 'CU4'),
(8, '1', 'CU5'),
(9, '2', 'CU5');

-- --------------------------------------------------------

--
-- Struktur dari tabel `culinary_facility`
--

CREATE TABLE `culinary_facility` (
  `id_facility` varchar(5) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `culinary_facility`
--

INSERT INTO `culinary_facility` (`id_facility`, `name`) VALUES
('1', 'Toilet'),
('2', 'Parkir'),
('3', 'Musholla');

-- --------------------------------------------------------

--
-- Struktur dari tabel `culinary_gallery`
--

CREATE TABLE `culinary_gallery` (
  `id_gallery` int(5) NOT NULL,
  `id` varchar(5) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `culinary_gallery`
--

INSERT INTO `culinary_gallery` (`id_gallery`, `id`, `url`) VALUES
(6, 'CU5', '1681106537_e3e2383ff32f684dc4d3.jpg'),
(18, 'CU2', '1681218736_99b07f9e5fd4e5145f28.png'),
(19, 'CU1', '1681896154_f28a7df16c764f21cf32.jpg'),
(20, 'CU4', '1681896411_6dbec0f9cb4969bd10a1.jpg'),
(21, 'CU3', '1684907331_80dff1563a7dcc7ee438.jpg'),
(22, 'CU6', '1684907546_b90f3e76b37b65635106.jpg'),
(23, 'CU7', '1684907793_758cb44801f7806a5804.png'),
(24, 'CU8', '1684908472_5e2183271e7ce7a2bef7.png'),
(25, 'CU9', '1684908798_223df15695a32acd6df4.jpg'),
(26, 'CU10', '1684909133_126238e555e410849ae4.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_menu`
--

CREATE TABLE `detail_menu` (
  `id` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_product`
--

CREATE TABLE `detail_product` (
  `id` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `event`
--

CREATE TABLE `event` (
  `id` varchar(5) NOT NULL,
  `id_category` varchar(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `ticket_price` int(11) DEFAULT NULL,
  `contact_person` varchar(13) DEFAULT NULL,
  `geom` geometry NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `event`
--

INSERT INTO `event` (`id`, `id_category`, `name`, `date_start`, `date_end`, `description`, `ticket_price`, `contact_person`, `geom`) VALUES
('1', '1', 'Bakaua', '2023-04-22', '2023-04-22', 'Kegiatan adat berupa permainan, tari, masak, dan makan bersama untuk warga sekitar', 0, '08388213556', 0x),
('E1', '1', 'Bersepedas', '2022-03-31', '2022-03-31', 'Bersepeda ria', 0, '081274876376', 0x),
('E3', '2', 'Berkemah', '2021-02-12', '2021-02-14', 'Berkemah Murid TK', 0, '080808', 0x);

-- --------------------------------------------------------

--
-- Struktur dari tabel `event_category`
--

CREATE TABLE `event_category` (
  `id_category` varchar(5) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `event_category`
--

INSERT INTO `event_category` (`id_category`, `name`) VALUES
('1', 'adat'),
('2', 'olahraga');

-- --------------------------------------------------------

--
-- Struktur dari tabel `event_gallery`
--

CREATE TABLE `event_gallery` (
  `id_event` int(5) NOT NULL,
  `id` varchar(5) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `event_gallery`
--

INSERT INTO `event_gallery` (`id_event`, `id`, `url`) VALUES
(1, 'E1', '1681026771_30f598eef57d4fccbcd3.jpg'),
(2, 'E1', '1681026867_43d2625bfd76a0de5b86.jpg'),
(3, 'E1', '1681027293_967b222db0e41cc59d65.jpg'),
(6, '1', '1681111025_2f290b447918b50a3ab5.jpg'),
(7, 'E3', '1681119165_18b7b84808a7018af43d.jpg'),
(8, '1', '1681219525_d6e19921d324baf69c15.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `event_video`
--

CREATE TABLE `event_video` (
  `id_video` int(5) NOT NULL,
  `id` varchar(5) NOT NULL,
  `url` varchar(255) NOT NULL,
  -- `duration` time DEFAULT NULL,
  -- `view` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id` varchar(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `menucol` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `id` varchar(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `souvenir_detail_facility`
--

CREATE TABLE `souvenir_detail_facility` (
  `id_detail` int(5) NOT NULL,
  `id_facility` varchar(5) NOT NULL,
  `id` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `souvenir_detail_facility`
--

INSERT INTO `souvenir_detail_facility` (`id_detail`, `id_facility`, `id`) VALUES
(2, '1', '1'),
(5, '2', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `souvenir_facility`
--

CREATE TABLE `souvenir_facility` (
  `id_facility` varchar(5) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `souvenir_facility`
--

INSERT INTO `souvenir_facility` (`id_facility`, `name`) VALUES
('1', 'Toilet'),
('12', 'satuuuu'),
('2', 'Sepeda');

-- --------------------------------------------------------

--
-- Struktur dari tabel `souvenir_gallery`
--

CREATE TABLE `souvenir_gallery` (
  `id_gallery` int(5) NOT NULL,
  `id` varchar(5) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `souvenir_gallery`
--

INSERT INTO `souvenir_gallery` (`id_gallery`, `id`, `url`) VALUES
(2, '1', '1681111278_f7b6595e9593dc8d89b3.jpg'),
(4, '1', '1681216527_b738ee5e41811cab9d95.jpg'),
(5, 'SP1', '1681897710_6b1525c752b238bbca8b.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `souvenir_place`
--

CREATE TABLE `souvenir_place` (
  `id` varchar(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `contact_person` varchar(13) DEFAULT NULL,
  `owner` varchar(255) DEFAULT NULL,
  `geom` geometry NOT NULL,
  `employee` int(11) DEFAULT NULL,
  `open` time DEFAULT NULL,
  `close` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `souvenir_place`
--

INSERT INTO `souvenir_place` (`id`, `name`, `address`, `capacity`, `contact_person`, `owner`, `geom`, `employee`, `open`, `close`) VALUES
('SP1', 'Kawispa Cenderamata', 'Payo, Kel. Tanah Garam, Kota Solok', 4, '0812767348749', 'Rama', 0x000000000103000000010000000500000036d3d29d68265940f4d1c6ce1152e9bf36d352e16826594040e5f38d3352e9bf36d39219692659407bf9e92e0c52e9bf36d332c568265940ac9df1ffe151e9bf36d3d29d68265940f4d1c6ce1152e9bf, 2, '08:00:00', '17:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tourism_category`
--

CREATE TABLE `tourism_category` (
  `id_category` int(11) NOT NULL,
  `name` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tourism_category`
--

INSERT INTO `tourism_category` (`id_category`, `name`) VALUES
(1, 'agro'),
(2, 'gen');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tourism_detail_facility`
--

CREATE TABLE `tourism_detail_facility` (
  `id_detail` int(5) NOT NULL,
  `id_facility` varchar(5) NOT NULL,
  `id` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tourism_facility`
--

CREATE TABLE `tourism_facility` (
  `id_facility` varchar(5) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tourism_facility`
--

INSERT INTO `tourism_facility` (`id_facility`, `name`) VALUES
('1', 'Toilet'),
('2', 'sfsds'),
('ber1', 'berhasil1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tourism_gallery`
--

CREATE TABLE `tourism_gallery` (
  `id_gallery` int(5) NOT NULL,
  `id` varchar(5) NOT NULL,
  `url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tourism_gallery`
--

INSERT INTO `tourism_gallery` (`id_gallery`, `id`, `url`) VALUES
(5, 'TO2', '1681390841_944bb7dc6de0c6e3314c.jpg'),
(6, 'TO1', '1681896679_97fd82d77c32140d796a.jpg'),
(7, '', '1681896947_6565a8e03056472ab60b.jpg'),
(8, 'TO3', '1681897165_f2fc8e6ae97270c1470a.jpg'),
(9, 'TO4', '1681897389_3c901134800ed02686f1.jpg'),
(10, 'TO4', '1681897412_482a921eccf5e482685c.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tourism_object`
--

CREATE TABLE `tourism_object` (
  `id` varchar(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `open` time DEFAULT NULL,
  `close` time DEFAULT NULL,
  `ticket_price` int(11) DEFAULT NULL,
  `geom` geometry DEFAULT NULL,
  `contact_person` varchar(13) DEFAULT NULL,
  `id_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tourism_object`
--

INSERT INTO `tourism_object` (`id`, `name`, `address`, `open`, `close`, `ticket_price`, `geom`, `contact_person`, `id_category`) VALUES
('TO1', 'Payo Nature', 'Payo, Kel. Tanah Garam, Kota Solok', '08:00:00', '15:00:00', 0, 0x0000000001030000000100000005000000a4159bb43c2659404ec9361f2848e9bfa415db653c265940475347045847e9bfa4153b173a265940300f52637f47e9bfa4153b443a2659408aa5cdfe3848e9bfa4159bb43c2659404ec9361f2848e9bf, '080808080808', 2),
('TO3', 'Agrowisata Batu Patah Payo', 'Payo, Kel. Tanah Garam, Kota Solok', '07:00:00', '18:00:00', 0, 0x00000000010300000001000000050000000be1d09c6926594031ddf0d21850e9bf0be1b08e6a265940c389a08c1b51e9bf0be1f0d768265940040496061352e9bf0be11005672659401e848ccecc50e9bf0be1d09c6926594031ddf0d21850e9bf, '', 1),
('TO4', 'Puncak Bidadari Payo', 'Payo, Kel. Tanah Garam, Kota Solok', '09:00:00', '17:00:00', 0, 0x000000000103000000010000000500000035e9edec3127594045c74f53190ee9bf35e9ada630275940cba01550a00ee9bf35e9ed6531275940515bccedff0ee9bf35e9edcd32275940699a06f1780ee9bf35e9edec3127594045c74f53190ee9bf, '', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tourism_video`
--

CREATE TABLE `tourism_video` (
  `id_video` int(5) NOT NULL,
  `id` varchar(5) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  -- `duration` time DEFAULT NULL,
  -- `view` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
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
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'polardhani17@gmail.com', 'adminputri', '$2y$10$8zCrQ4xGH1GvPB.YdiRm5OpTzcT6MSxgOS39vxhBQHTujigbM57bu', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-04-08 03:26:56', '2023-04-08 03:26:56', NULL),
(2, 'admin@laili.com', 'admin', '$2y$10$Eel4pTAq3XE6n3aGE1Q3e.syAu7kKr49cKNCCG2dnzAlEzPkd6YC.', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-05-20 05:03:47', '2023-05-20 05:03:47', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `village`
--

CREATE TABLE `village` (
  `id` varchar(15) NOT NULL,
  `name` varchar(255) NOT NULL,
  `district` varchar(255) DEFAULT NULL,
  `geom` geometry DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `village`
--

INSERT INTO `village` (`id`, `name`, `district`, `geom`) VALUES
('VIL01', 'Tanah Garam', 'Tanah Garam', 0x0000000001060000000100000001030000000100000067000000a7b7eb171f2859400c64e8733ca6e8bf9fb168d41e28594021eedd5ee9a9e8bf636037e82128594001ae7161ffabe8bfc94dc4e12628594006fa42a55eafe8bfd3f4bb4c28285940f7695466d2afe8bf0fd40ff93a285940d8c312f216b4e8bf748550f93a285940147e222f63b5e8bfcad67cfb3d285940150c08a4d1b7e8bf9e18fffc3d285940ed33b56e91bfe8bf7c2adb7f41285940e5d9e0ff6acfe8bf2d0293ff4828594001dc8aa60bd2e8bf5ead08cd502859400a008403cad3e8bf406a23ec522859402c029dd685d5e8bf733084d956285940f483ab1ce6d6e8bf10117a2a6128594013ba4793f4e0e8bfd431b8316428594019cae01ea3e3e8bf7d3406346428594029a61ecc5aefe8bfc76511b16b285940f76d0bf2b6f8e8bf57c09a73782859401f40163f63fbe8bfe6d977517c285940d9679438b3fbe8bf7711bf998d285940d65bd3652bfbe8bfc6a3845a9e285940e1d9d0eb5af8e8bf1915f446c0285940d0132554e200e9bfe9b60162c228594002b41c40e001e9bfcb5f49e3e6285940e2b1cc3d8e13e9bfc7418702f428594025dc75070019e9bfce2c485c0229594001f876f6741ee9bf0d4198a212295940f5c590167923e9bf3b6a614f16295940103ec3f49d24e9bf87bce1b517295940d81180dd9525e9bfc54335fb18295940f367024c6e27e9bf1d85a60f2629594000583eb88a2be9bfc93fc71026295940f6372e821e31e9bfd8045a1126295940e875a9d11334e9bf8034a226432959402102fa39b442e9bf8dce1e2b502959402aa2fdaca866e9bf9f68b29150295940f2958802c467e9bffcaf07fd50295940ed9f1676ec68e9bfd7452453512959401e369a4bda69e9bfed3cecb751295940eacf65a9f06ae9bf1729699051295940fe1f7660cc6be9bf983d5a54512959401d06e4621a6de9bf24791c265129594010de7a881b6ee9bfb939553a50295940e6addfbd3a73e9bfa0f3724e4f29594024dc25835a78e9bfe21d635d3a29594018b2a65ea480e9bf4e0c8dea352959400b02371d6782e9bf9d3b6f662d29594000841ffcc585e9bf4474ca1e22295940d39decc75783e9bf19ec8f45182959401a0c0c873881e9bfb8511584fa2859402400742ecf7ae9bfce108605db285940d89b43cbd07ae9bfe297d7acb62859401658028b4972e9bf0cd1e0785f285940f8218c102882e9bf8c49e09a2c285940eb0d9818248de9bfd4945fd905285940e48f5131af95e9bf0b790d58e6275940fd67a8084788e9bf7b6a788ad027594023368d4c8089e9bfd380892bbd275940ff270e0eeb96e9bfdcec52343f275940dd0584b703a8e9bfd97691702c275940f01577bb83aae9bf348b0110ec255940ecc170f132d5e9bfbb469b5e75255940e6d7ff68d4eee9bfe59e46964a255940f089805997f6e9bfbcd85fcf38255940ed49d2f5d0f9e9bfe285818c85245940058ec0abad14eabfdb8c029a172459400fa6c09f6b2ceabf828202f1ec235940f44323e7a135eabf28a8c6e2de23594019f8e681ed34eabf845f8841a4235940f3f35e08fd31eabf1c77d25e32235940e6737bce471deabf89ddf090dd225940d84f68a18a13eabf438973cea5225940ecdf66a4fee3e9bfb21cd80fad225940dc134edeebd2e9bf2fb87dcfd3225940eeffa60a2fbee9bf61e1ebe71e2359400c44297cc1b0e9bfe8281d9f7323594005feed8f8aafe9bf1adee5a684235940f01577bb83aae9bf557c04f2b923594019d430d4c69ae9bf00792d6c072459401f5cbab3b157e9bf380b135629245940e65759359751e9bf7e074bb83c245940286eb9990654e9bf4fea2bba3c245940f3bb3ef4c75de9bf92f1b01822245940d0394fcf6477e9bf0b81a074072459401caa35ce9783e9bf3a2e70e309245940d733e38d0191e9bf4fc49bb21f245940dee785541997e9bfbc6cd99a412459402b48a7a27588e9bf308031994124594013168273ec7fe9bf8a0fefa95e2459402228e8ad2976e9bffbf3e2267e24594011b667c9666ce9bf343420237e2459400ce6cf15e458e9bf126128bd6a24594026ce4afff142e9bf0d24e8d776245940fc49d4b8bf36e9bf794c8dcb87245940f0c1c38cfd2ce9bf9233ca063726594016ec4ba57e1fe9bfa66b165cc826594027bc2694e2fae8bf585ebcdf04275940d00b64535eb5e8bf86432689cb275940312cd13d35bae8bfdc64183ae7275940f203c27299b3e8bf9991c98ef92759401090d98739afe8bff1c853810a28594010e263c796a0e8bfa7b7eb171f2859400c64e8733ca6e8bf);

-- --------------------------------------------------------

--
-- Struktur dari tabel `worship_category`
--

CREATE TABLE `worship_category` (
  `id_category` varchar(5) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `worship_category`
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
-- Struktur dari tabel `worship_detail_facility`
--

CREATE TABLE `worship_detail_facility` (
  `id_detail` int(5) NOT NULL,
  `id_facility` varchar(5) NOT NULL,
  `id` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `worship_detail_facility`
--

INSERT INTO `worship_detail_facility` (`id_detail`, `id_facility`, `id`) VALUES
(8, '1', '1'),
(9, '1', 'WP1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `worship_facility`
--

CREATE TABLE `worship_facility` (
  `id_facility` varchar(5) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `worship_facility`
--

INSERT INTO `worship_facility` (`id_facility`, `name`) VALUES
('1', 'Toiletz'),
('WF1', 'Parkir');

-- --------------------------------------------------------

--
-- Struktur dari tabel `worship_gallery`
--

CREATE TABLE `worship_gallery` (
  `id_gallery` int(5) NOT NULL,
  `url` varchar(255) NOT NULL,
  `id` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `worship_gallery`
--

INSERT INTO `worship_gallery` (`id_gallery`, `url`, `id`) VALUES
(1, '1681018067_2c448056ec7a5206757f.jpg', 'WP2'),
(2, '1681021109_3d7de45685fd5c1e265e.jpg', 'WP2'),
(3, '1681024962_83ecf2711cbe4cce45b2.jpg', 'WP2'),
(4, '1681025384_05f6f54d75122eade2b2.jpg', 'WP2'),
(6, '1681216463_2f2732634631df978544.jpg', '1'),
(7, '1681894546_72677ed1bda5a66b8202.jpg', 'WP1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `worship_place`
--

CREATE TABLE `worship_place` (
  `id` varchar(5) NOT NULL,
  `id_category` varchar(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `area_size` int(11) DEFAULT NULL,
  `building_size` int(11) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `last_renovation` varchar(4) DEFAULT NULL,
  `geom` geometry NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `worship_place`
--

INSERT INTO `worship_place` (`id`, `id_category`, `name`, `address`, `area_size`, `building_size`, `capacity`, `last_renovation`, `geom`) VALUES
('1', '1', 'Masjid Nurul Ulya', 'Payo, Tanah Garam, Kec. Lubuk Sikarah, Kabupaten Solok, Sumatera Barat 27312', 30, 60, 750, '0000', 0x0000000001030000000100000005000000b1b916ea93265940609beee7872fe9bfb1b9f6549426594015179d718d30e9bfb1b9d6a095265940b1397fe26830e9bfb1b9d6199526594003d704e95a2fe9bfb1b916ea93265940609beee7872fe9bf),
('WP1', '1', 'Mushalla Nurul Abrar', 'Tanah Garam, Kec. Lubuk Sikarah, Kabupaten Solok, Sumatera Barat', 25, 20, 30, '-', 0x000000000101000000d1ecf316602659400c8ab9f03a4de9bf),
('WP2', '1', 'Ini Daerah Satu', 'sdfsdfs', 234, 234, 234, '0000', 0x000000000101000000d0383593c525594059f6f888db8be9bf);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`) USING BTREE,
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`) USING BTREE;

--
-- Indeks untuk tabel `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`) USING BTREE,
  ADD KEY `group_id_user_id` (`group_id`,`user_id`) USING BTREE;

--
-- Indeks untuk tabel `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`) USING BTREE,
  ADD KEY `user_id` (`user_id`) USING BTREE;

--
-- Indeks untuk tabel `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`) USING BTREE,
  ADD KEY `selector` (`selector`) USING BTREE;

--
-- Indeks untuk tabel `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`) USING BTREE,
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`) USING BTREE;

--
-- Indeks untuk tabel `culinary`
--
ALTER TABLE `culinary`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `culinary_detail_facility`
--
ALTER TABLE `culinary_detail_facility`
  ADD PRIMARY KEY (`id_detail`,`id_facility`),
  ADD KEY `culinary_facility_culinary_detail_facility_fk` (`id_facility`),
  ADD KEY `culinary_culinary_detail_facility_fk` (`id`);

--
-- Indeks untuk tabel `culinary_facility`
--
ALTER TABLE `culinary_facility`
  ADD PRIMARY KEY (`id_facility`);

--
-- Indeks untuk tabel `culinary_gallery`
--
ALTER TABLE `culinary_gallery`
  ADD PRIMARY KEY (`id_gallery`),
  ADD KEY `culinary_culinary_gallery_fk` (`id`);

--
-- Indeks untuk tabel `detail_menu`
--
ALTER TABLE `detail_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_product`
--
ALTER TABLE `detail_product`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_category_event_fk` (`id_category`);

--
-- Indeks untuk tabel `event_category`
--
ALTER TABLE `event_category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indeks untuk tabel `event_gallery`
--
ALTER TABLE `event_gallery`
  ADD PRIMARY KEY (`id_event`),
  ADD KEY `event_event_gallery_fk` (`id`);

--
-- Indeks untuk tabel `event_video`
--
ALTER TABLE `event_video`
  ADD PRIMARY KEY (`id_video`),
  ADD KEY `event_event_video_fk` (`id`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `souvenir_detail_facility`
--
ALTER TABLE `souvenir_detail_facility`
  ADD PRIMARY KEY (`id_detail`,`id_facility`),
  ADD KEY `souvenir_place_souvenir_detail_facility_fk` (`id`),
  ADD KEY `souvenir_facility_souvenir_detail_facility_fk` (`id_facility`);

--
-- Indeks untuk tabel `souvenir_facility`
--
ALTER TABLE `souvenir_facility`
  ADD PRIMARY KEY (`id_facility`);

--
-- Indeks untuk tabel `souvenir_gallery`
--
ALTER TABLE `souvenir_gallery`
  ADD PRIMARY KEY (`id_gallery`),
  ADD KEY `souvenir_place_souvenir_gallery_fk` (`id`);

--
-- Indeks untuk tabel `souvenir_place`
--
ALTER TABLE `souvenir_place`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tourism_category`
--
ALTER TABLE `tourism_category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indeks untuk tabel `tourism_detail_facility`
--
ALTER TABLE `tourism_detail_facility`
  ADD PRIMARY KEY (`id_detail`,`id_facility`),
  ADD KEY `tourism_object_tourism_detail_facility_fk` (`id`),
  ADD KEY `tourism_facility_tourism_detail_facility_fk` (`id_facility`);

--
-- Indeks untuk tabel `tourism_facility`
--
ALTER TABLE `tourism_facility`
  ADD PRIMARY KEY (`id_facility`);

--
-- Indeks untuk tabel `tourism_gallery`
--
ALTER TABLE `tourism_gallery`
  ADD PRIMARY KEY (`id_gallery`),
  ADD KEY `tourism_object_tourism_gallery_fk` (`id`);

--
-- Indeks untuk tabel `tourism_object`
--
ALTER TABLE `tourism_object`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`id_category`);

--
-- Indeks untuk tabel `tourism_video`
--
ALTER TABLE `tourism_video`
  ADD PRIMARY KEY (`id_video`),
  ADD KEY `tourism_object_tourism_video_fk` (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`) USING BTREE,
  ADD UNIQUE KEY `username` (`username`) USING BTREE;

--
-- Indeks untuk tabel `village`
--
ALTER TABLE `village`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `worship_category`
--
ALTER TABLE `worship_category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indeks untuk tabel `worship_detail_facility`
--
ALTER TABLE `worship_detail_facility`
  ADD PRIMARY KEY (`id_detail`,`id_facility`),
  ADD KEY `worship_facility_worship_detail_facility_fk` (`id_facility`),
  ADD KEY `worship_place_worship_detail_facility_fk1` (`id`);

--
-- Indeks untuk tabel `worship_facility`
--
ALTER TABLE `worship_facility`
  ADD PRIMARY KEY (`id_facility`);

--
-- Indeks untuk tabel `worship_gallery`
--
ALTER TABLE `worship_gallery`
  ADD PRIMARY KEY (`id_gallery`),
  ADD KEY `worship_place_worship_gallery_fk` (`id`);

--
-- Indeks untuk tabel `worship_place`
--
ALTER TABLE `worship_place`
  ADD PRIMARY KEY (`id`),
  ADD KEY `worship_category_worship_place_fk` (`id_category`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `culinary_detail_facility`
--
ALTER TABLE `culinary_detail_facility`
  MODIFY `id_detail` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `culinary_gallery`
--
ALTER TABLE `culinary_gallery`
  MODIFY `id_gallery` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `event_gallery`
--
ALTER TABLE `event_gallery`
  MODIFY `id_event` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `event_video`
--
ALTER TABLE `event_video`
  MODIFY `id_video` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `souvenir_detail_facility`
--
ALTER TABLE `souvenir_detail_facility`
  MODIFY `id_detail` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `souvenir_gallery`
--
ALTER TABLE `souvenir_gallery`
  MODIFY `id_gallery` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tourism_category`
--
ALTER TABLE `tourism_category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tourism_detail_facility`
--
ALTER TABLE `tourism_detail_facility`
  MODIFY `id_detail` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tourism_gallery`
--
ALTER TABLE `tourism_gallery`
  MODIFY `id_gallery` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tourism_video`
--
ALTER TABLE `tourism_video`
  MODIFY `id_video` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `worship_detail_facility`
--
ALTER TABLE `worship_detail_facility`
  MODIFY `id_detail` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `worship_gallery`
--
ALTER TABLE `worship_gallery`
  MODIFY `id_gallery` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `culinary_detail_facility`
--
ALTER TABLE `culinary_detail_facility`
  ADD CONSTRAINT `culinary_culinary_detail_facility_fk` FOREIGN KEY (`id`) REFERENCES `culinary` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `culinary_facility_culinary_detail_facility_fk` FOREIGN KEY (`id_facility`) REFERENCES `culinary_facility` (`id_facility`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `culinary_gallery`
--
ALTER TABLE `culinary_gallery`
  ADD CONSTRAINT `culinary_culinary_gallery_fk` FOREIGN KEY (`id`) REFERENCES `culinary` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_category_event_fk` FOREIGN KEY (`id_category`) REFERENCES `event_category` (`id_category`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `event_gallery`
--
ALTER TABLE `event_gallery`
  ADD CONSTRAINT `event_event_gallery_fk` FOREIGN KEY (`id`) REFERENCES `event` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `event_video`
--
ALTER TABLE `event_video`
  ADD CONSTRAINT `event_event_video_fk` FOREIGN KEY (`id`) REFERENCES `event` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `souvenir_detail_facility`
--
ALTER TABLE `souvenir_detail_facility`
  ADD CONSTRAINT `souvenir_facility_souvenir_detail_facility_fk` FOREIGN KEY (`id_facility`) REFERENCES `souvenir_facility` (`id_facility`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `souvenir_place_souvenir_detail_facility_fk` FOREIGN KEY (`id`) REFERENCES `souvenir_place` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `souvenir_gallery`
--
ALTER TABLE `souvenir_gallery`
  ADD CONSTRAINT `souvenir_place_souvenir_gallery_fk` FOREIGN KEY (`id`) REFERENCES `souvenir_place` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `tourism_detail_facility`
--
ALTER TABLE `tourism_detail_facility`
  ADD CONSTRAINT `tourism_facility_tourism_detail_facility_fk` FOREIGN KEY (`id_facility`) REFERENCES `tourism_facility` (`id_facility`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tourism_object_tourism_detail_facility_fk` FOREIGN KEY (`id`) REFERENCES `tourism_object` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `tourism_gallery`
--
ALTER TABLE `tourism_gallery`
  ADD CONSTRAINT `tourism_object_tourism_gallery_fk` FOREIGN KEY (`id`) REFERENCES `tourism_object` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `tourism_object`
--
ALTER TABLE `tourism_object`
  ADD CONSTRAINT `tourism_object_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `tourism_category` (`id_category`);

--
-- Ketidakleluasaan untuk tabel `tourism_video`
--
ALTER TABLE `tourism_video`
  ADD CONSTRAINT `tourism_object_tourism_video_fk` FOREIGN KEY (`id`) REFERENCES `tourism_object` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `worship_detail_facility`
--
ALTER TABLE `worship_detail_facility`
  ADD CONSTRAINT `worship_facility_worship_detail_facility_fk` FOREIGN KEY (`id_facility`) REFERENCES `worship_facility` (`id_facility`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `worship_place_worship_detail_facility_fk1` FOREIGN KEY (`id`) REFERENCES `worship_place` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `worship_gallery`
--
ALTER TABLE `worship_gallery`
  ADD CONSTRAINT `worship_place_worship_gallery_fk` FOREIGN KEY (`id`) REFERENCES `worship_place` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `worship_place`
--
ALTER TABLE `worship_place`
  ADD CONSTRAINT `worship_category_worship_place_fk` FOREIGN KEY (`id_category`) REFERENCES `worship_category` (`id_category`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
