-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2022 at 12:33 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `printer`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', 1661355508),
('operator', '2', 1662276366);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('/*', 2, NULL, NULL, NULL, 1661351626, 1661351626),
('/debug/*', 2, NULL, NULL, NULL, 1661355473, 1661355473),
('/debug/default/*', 2, NULL, NULL, NULL, 1661355474, 1661355474),
('/debug/user/*', 2, NULL, NULL, NULL, 1661355474, 1661355474),
('/gii/*', 2, NULL, NULL, NULL, 1661355475, 1661355475),
('/gii/default/*', 2, NULL, NULL, NULL, 1661355476, 1661355476),
('/gridview/*', 2, NULL, NULL, NULL, 1661355477, 1661355477),
('/gridview/export/*', 2, NULL, NULL, NULL, 1661355478, 1661355478),
('/gridview/grid-edited-row/*', 2, NULL, NULL, NULL, 1661355478, 1661355478),
('/item/*', 2, NULL, NULL, NULL, 1661355479, 1661355479),
('/item/index', 2, NULL, NULL, NULL, 1662276343, 1662276343),
('/item/runningdelete', 2, NULL, NULL, NULL, 1662276346, 1662276346),
('/item/update', 2, NULL, NULL, NULL, 1662276348, 1662276348),
('/itemk/index', 2, NULL, NULL, NULL, 1662474470, 1662474470),
('/itemk/view', 2, NULL, NULL, NULL, 1662474473, 1662474473),
('/itemp/index', 2, NULL, NULL, NULL, 1662474475, 1662474475),
('/itemp/view', 2, NULL, NULL, NULL, 1662474473, 1662474473),
('/mimin/*', 2, NULL, NULL, NULL, 1661355480, 1661355480),
('/mimin/role/*', 2, NULL, NULL, NULL, 1661355481, 1661355481),
('/mimin/route/*', 2, NULL, NULL, NULL, 1661355482, 1661355482),
('/mimin/user/*', 2, NULL, NULL, NULL, 1661355482, 1661355482),
('/site/*', 2, NULL, NULL, NULL, 1661355484, 1661355484),
('/site/camera', 2, NULL, NULL, NULL, 1662653074, 1662653074),
('/site/eksekusi', 2, NULL, NULL, NULL, 1662277257, 1662277257),
('/site/hitung', 2, NULL, NULL, NULL, 1662277259, 1662277259),
('/site/info', 2, NULL, NULL, NULL, 1662277262, 1662277262),
('/site/scanm', 2, NULL, NULL, NULL, 1662653081, 1662653081),
('/site/settingcamera', 2, NULL, NULL, NULL, 1662653078, 1662653078),
('/site/settingsave', 2, NULL, NULL, NULL, 1662653087, 1662653087),
('admin', 1, NULL, NULL, NULL, 1661351471, 1661355489),
('operator', 1, NULL, NULL, NULL, 1662276323, 1662474484);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', '/*'),
('admin', '/debug/*'),
('admin', '/debug/default/*'),
('admin', '/debug/user/*'),
('admin', '/gii/*'),
('admin', '/gii/default/*'),
('admin', '/gridview/*'),
('admin', '/gridview/export/*'),
('admin', '/gridview/grid-edited-row/*'),
('admin', '/item/*'),
('admin', '/mimin/*'),
('admin', '/mimin/role/*'),
('admin', '/mimin/route/*'),
('admin', '/mimin/user/*'),
('admin', '/site/*'),
('operator', '/site/camera'),
('operator', '/site/eksekusi'),
('operator', '/site/hitung'),
('operator', '/site/info'),
('operator', '/site/scanm'),
('operator', '/site/settingcamera'),
('operator', '/site/settingsave');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `var_1` varchar(200) DEFAULT NULL,
  `var_2` varchar(200) DEFAULT NULL,
  `biner` varchar(500) DEFAULT NULL,
  `var_3` varchar(100) DEFAULT NULL,
  `status` tinyint(2) DEFAULT 0,
  `ulang` int(11) NOT NULL DEFAULT 0,
  `hitung` int(11) NOT NULL DEFAULT 0,
  `var_4` varchar(100) DEFAULT NULL,
  `var_5` varchar(100) DEFAULT NULL,
  `gagal` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `tanggal`, `var_1`, `var_2`, `biner`, `var_3`, `status`, `ulang`, `hitung`, `var_4`, `var_5`, `gagal`) VALUES
(483, '2022-09-08 21:00:56', '29041840281048', '09284092180940', '00 00 00 00 00 53 00 64 00 4f 00 cf 00 00 00 00 0e 32 39 30 34 31 38 34 30 32 38 31 30 34 38 0e 30 39 32 38 34 30 39 32 31 38 30 39 34 30 05 30 31 32 38 39 06 32 30 32 30 32 35 0e 39 30 32 31 38 34 30 32 38 31 39 30 34 39  00 00 00 00 00 00 00 00 00 00 00 00 00 00 00 ', '01289', 0, 1, 0, '202025', '90218402819049', 0);

-- --------------------------------------------------------

--
-- Table structure for table `itemcamera`
--

CREATE TABLE `itemcamera` (
  `id` int(11) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `var_1` varchar(200) DEFAULT NULL,
  `var_2` varchar(200) DEFAULT NULL,
  `var_3` varchar(100) DEFAULT NULL,
  `var_4` varchar(100) DEFAULT NULL,
  `var_5` varchar(100) DEFAULT NULL,
  `status` tinyint(2) DEFAULT 0,
  `hitung` int(11) DEFAULT 0,
  `gagal` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `itemcamera`
--

INSERT INTO `itemcamera` (`id`, `tanggal`, `var_1`, `var_2`, `var_3`, `var_4`, `var_5`, `status`, `hitung`, `gagal`) VALUES
(1, '2022-09-06 22:07:13', '90834098320958', '02948092184092', '003', '020222', '480921843000010', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `itemkardus`
--

CREATE TABLE `itemkardus` (
  `id` int(11) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `var_1` varchar(200) DEFAULT NULL,
  `var_2` varchar(200) DEFAULT NULL,
  `biner` varchar(500) DEFAULT NULL,
  `var_3` varchar(100) DEFAULT NULL,
  `status` tinyint(2) DEFAULT 0,
  `ulang` int(11) NOT NULL DEFAULT 0,
  `var_4` varchar(100) DEFAULT NULL,
  `var_5` varchar(100) DEFAULT NULL,
  `var_6` int(11) DEFAULT NULL,
  `var_7` varchar(100) DEFAULT NULL,
  `var_8` int(11) DEFAULT NULL,
  `var_9` varchar(100) DEFAULT NULL,
  `var_10` varchar(100) DEFAULT NULL,
  `hitung` int(11) DEFAULT 0,
  `gagal` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `itemkardus`
--

INSERT INTO `itemkardus` (`id`, `tanggal`, `var_1`, `var_2`, `biner`, `var_3`, `status`, `ulang`, `var_4`, `var_5`, `var_6`, `var_7`, `var_8`, `var_9`, `var_10`, `hitung`, `gagal`) VALUES
(2, '2022-09-04 09:55:51', '90210492184082', '76812648712684', NULL, 'B101902-109', 0, 10, '02.02.25', '82178947291874921', 1, 'MEDICINE 400MG/16ML 1VIAL', 105, '', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `itemmaster`
--

CREATE TABLE `itemmaster` (
  `id` int(11) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `nama` varchar(100) DEFAULT NULL,
  `status` int(2) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `itemmaster`
--
DELIMITER $$
CREATE TRIGGER `delete` AFTER DELETE ON `itemmaster` FOR EACH ROW DELETE from itemmasterd where idmaster=old.id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `itemmasterd`
--

CREATE TABLE `itemmasterd` (
  `id` int(11) NOT NULL,
  `idmaster` int(11) DEFAULT NULL,
  `iddetail` int(11) DEFAULT NULL,
  `status` int(2) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `itemmasterd`
--
DELIMITER $$
CREATE TRIGGER `deletem` AFTER DELETE ON `itemmasterd` FOR EACH ROW delete from item where id=old.iddetail
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `itempallet`
--

CREATE TABLE `itempallet` (
  `id` int(11) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `var_1` varchar(200) DEFAULT NULL,
  `var_2` varchar(200) DEFAULT NULL,
  `biner` varchar(500) DEFAULT NULL,
  `var_3` varchar(100) DEFAULT NULL,
  `var_6` int(11) DEFAULT NULL,
  `var_7` varchar(100) DEFAULT NULL,
  `var_8` int(11) DEFAULT NULL,
  `var_9` varchar(100) DEFAULT NULL,
  `var_10` varchar(100) DEFAULT NULL,
  `status` tinyint(2) DEFAULT 0,
  `ulang` int(11) NOT NULL DEFAULT 0,
  `var_4` varchar(100) DEFAULT NULL,
  `var_5` varchar(100) DEFAULT NULL,
  `hitung` int(11) DEFAULT 0,
  `gagal` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `itempallet`
--

INSERT INTO `itempallet` (`id`, `tanggal`, `var_1`, `var_2`, `biner`, `var_3`, `var_6`, `var_7`, `var_8`, `var_9`, `var_10`, `status`, `ulang`, `var_4`, `var_5`, `hitung`, `gagal`) VALUES
(1, '2022-09-04 09:53:41', '90809808098908', '90809890809890', NULL, '080908', 1, '091208042109480221', 16, '19.90', NULL, 0, 10, '20.08.2025', '09808980890', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `nama` varchar(100) DEFAULT NULL,
  `nie` varchar(100) DEFAULT NULL,
  `gtin` varchar(100) DEFAULT NULL,
  `status` int(2) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `tanggal`, `nama`, `nie`, `gtin`, `status`) VALUES
(3, '2022-09-04 22:27:48', 'Panadol 15 Mg', '90821482901849', '90284018204809', 0),
(4, '2022-09-04 22:28:03', 'Panadol 25 Mg', '79879217498712', '98472391847980', 0);

-- --------------------------------------------------------

--
-- Table structure for table `logitem`
--

CREATE TABLE `logitem` (
  `id` int(11) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `status` int(2) DEFAULT 0,
  `logbaca` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logitem`
--

INSERT INTO `logitem` (`id`, `tanggal`, `status`, `logbaca`) VALUES
(1, '2022-09-03 17:11:51', 0, ''),
(2, '2022-09-03 18:28:02', 0, 'hexapengiriman00000000004e0064004a00cf000000000e39303238393032313830313238300e39303238313930333839303238340430303139063230323032330a39313230303932313839000000000000000000000000000000'),
(3, '2022-09-03 18:29:43', 0, 'hexapengiriman00000000004e0064004a00cf000000000e39303238393032313830313238300e39303238313930333839303238340430303139063230323032330a39313230303932313839000000000000000000000000000000'),
(4, '2022-09-03 18:29:53', 0, 'hexapengiriman00000000004e0064004a00cf000000000e39303238393032313830313238300e39303238313930333839303238340430303139063230323032330a39313230303932313839000000000000000000000000000000'),
(5, '2022-09-03 18:30:03', 0, 'hexapengiriman00000000004e0064004a00cf000000000e39303238393032313830313238300e39303238313930333839303238340430303139063230323032330a39313230303932313839000000000000000000000000000000'),
(6, '2022-09-03 20:21:28', 0, 'hexapengiriman00000000004e0064004a00cf000000000e39303238393032313830313238300e39303238313930333839303238340430303139063230323032330a39313230303932313839000000000000000000000000000000'),
(7, '2022-09-04 13:40:27', 0, 'hexapengiriman00000000004e0064004a00cf000000000e39303238393032313830313238300e39303238313930333839303238340430303139063230323032330a39313230303932313839000000000000000000000000000000'),
(8, '2022-09-04 13:40:37', 0, 'hexapengiriman00000000004e0064004a00cf000000000e39303238393032313830313238300e39303238313930333839303238340430303139063230323032330a39313230303932313839000000000000000000000000000000'),
(9, '2022-09-04 13:43:01', 0, 'hexapengiriman00000000004e0064004a00cf000000000e39303238393032313830313238300e39303238313930333839303238340430303139063230323032330a39313230303932313839000000000000000000000000000000'),
(10, '2022-09-04 13:43:11', 0, 'hexapengiriman00000000004e0064004a00cf000000000e39303238393032313830313238300e39303238313930333839303238340430303139063230323032330a39313230303932313839000000000000000000000000000000'),
(11, '2022-09-04 13:43:21', 0, 'hexapengiriman00000000004e0064004a00cf000000000e39303238393032313830313238300e39303238313930333839303238340430303139063230323032330a39313230303932313839000000000000000000000000000000'),
(12, '2022-09-04 13:43:30', 0, 'hexapengiriman00000000004e0064004a00cf000000000e39303238393032313830313238300e39303238313930333839303238340430303139063230323032330a39313230303932313839000000000000000000000000000000'),
(13, '2022-09-04 13:43:41', 0, 'hexapengiriman00000000004e0064004a00cf000000000e39303238393032313830313238300e39303238313930333839303238340430303139063230323032330a39313230303932313839000000000000000000000000000000'),
(14, '2022-09-04 13:43:51', 0, 'hexapengiriman00000000004e0064004a00cf000000000e39303238393032313830313238300e39303238313930333839303238340430303139063230323032330a39313230303932313839000000000000000000000000000000'),
(15, '2022-09-04 13:44:01', 0, 'hexapengiriman00000000004e0064004a00cf000000000e39303238393032313830313238300e39303238313930333839303238340430303139063230323032330a39313230303932313839000000000000000000000000000000'),
(16, '2022-09-04 13:44:11', 0, 'hexapengiriman00000000004e0064004a00cf000000000e39303238393032313830313238300e39303238313930333839303238340430303139063230323032330a39313230303932313839000000000000000000000000000000'),
(17, '2022-09-04 13:44:20', 0, 'hexapengiriman00000000004e0064004a00cf000000000e39303238393032313830313238300e39303238313930333839303238340430303139063230323032330a39313230303932313839000000000000000000000000000000'),
(18, '2022-09-04 13:44:31', 0, 'hexapengiriman00000000004e0064004a00cf000000000e39303238393032313830313238300e39303238313930333839303238340430303139063230323032330a39313230303932313839000000000000000000000000000000'),
(19, '2022-09-04 13:44:40', 0, 'hexapengiriman00000000004e0064004a00cf000000000e39303238393032313830313238300e39303238313930333839303238340430303139063230323032330a39313230303932313839000000000000000000000000000000'),
(20, '2022-09-04 13:44:50', 0, 'hexapengiriman00000000004e0064004a00cf000000000e39303238393032313830313238300e39303238313930333839303238340430303139063230323032330a39313230303932313839000000000000000000000000000000'),
(21, '2022-09-04 13:45:16', 0, 'hexapengiriman00000000004e0064004a00cf000000000e39303238393032313830313238300e39303238313930333839303238340430303139063230323032330a39313230303932313839000000000000000000000000000000'),
(22, '2022-09-04 14:30:43', 0, 'hexapengiriman00000000004e0064004a00cf000000000e33393032383039353830333238350e39303332383530393332383539300439303332063230323032340a33323935373339323835000000000000000000000000000000'),
(23, '2022-09-04 14:31:03', 0, 'hexapengiriman00000000004e0064004a00cf000000000e33393032383039353830333238350e39303332383530393332383539300439303332063230323032340a33323935373339323835000000000000000000000000000000'),
(24, '2022-09-04 14:31:22', 0, 'hexapengiriman00000000004e0064004a00cf000000000e33393032383039353830333238350e39303332383530393332383539300439303332063230323032340a33323935373339323835000000000000000000000000000000'),
(25, '2022-09-04 14:31:43', 0, 'hexapengiriman00000000004e0064004a00cf000000000e33393032383039353830333238350e39303332383530393332383539300439303332063230323032340a33323935373339323835000000000000000000000000000000'),
(26, '2022-09-04 14:32:10', 0, 'hexapengiriman00000000004e0064004a00cf000000000e33393032383039353830333238350e39303332383530393332383539300439303332063230323032340a33323935373339323835000000000000000000000000000000'),
(27, '2022-09-04 14:32:32', 0, 'hexapengiriman00000000004e0064004a00cf000000000e33393032383039353830333238350e39303332383530393332383539300439303332063230323032340a33323935373339323835000000000000000000000000000000'),
(28, '2022-09-04 14:32:37', 0, 'hexapengiriman00000000004e0064004a00cf000000000e33393032383039353830333238350e39303332383530393332383539300439303332063230323032340a33323935373339323835000000000000000000000000000000'),
(29, '2022-09-04 14:32:57', 0, 'hexapengiriman00000000004e0064004a00cf000000000e33393032383039353830333238350e39303332383530393332383539300439303332063230323032340a33323935373339323835000000000000000000000000000000');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1661179198),
('m130524_201442_init', 1661179200),
('m140506_102106_rbac_init', 1661179447),
('m151024_072453_create_route_table', 1661179246),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1661179447),
('m180523_151638_rbac_updates_indexes_without_prefix', 1661179447),
('m190124_110200_add_verification_token_column_to_user_table', 1661179200),
('m200409_110543_rbac_update_mssql_trigger', 1661179447);

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan`
--

CREATE TABLE `perusahaan` (
  `id` int(11) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `nama` varchar(100) DEFAULT NULL,
  `telp` varchar(100) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `status` int(2) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `perusahaan`
--

INSERT INTO `perusahaan` (`id`, `tanggal`, `nama`, `telp`, `alamat`, `status`) VALUES
(1, '2022-09-03 18:50:05', 'OPAL Assosiates Holding AG', '021209083109830', 'Parma Serialization', 0);

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE `route` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`name`, `alias`, `type`, `status`) VALUES
('/*', '*', '', 1),
('/debug/*', '*', 'debug', 1),
('/debug/default/*', '*', 'debug/default', 1),
('/debug/default/db-explain', 'db-explain', 'debug/default', 1),
('/debug/default/download-mail', 'download-mail', 'debug/default', 1),
('/debug/default/index', 'index', 'debug/default', 1),
('/debug/default/toolbar', 'toolbar', 'debug/default', 1),
('/debug/default/view', 'view', 'debug/default', 1),
('/debug/user/*', '*', 'debug/user', 1),
('/debug/user/reset-identity', 'reset-identity', 'debug/user', 1),
('/debug/user/set-identity', 'set-identity', 'debug/user', 1),
('/gii/*', '*', 'gii', 1),
('/gii/default/*', '*', 'gii/default', 1),
('/gii/default/action', 'action', 'gii/default', 1),
('/gii/default/diff', 'diff', 'gii/default', 1),
('/gii/default/index', 'index', 'gii/default', 1),
('/gii/default/preview', 'preview', 'gii/default', 1),
('/gii/default/view', 'view', 'gii/default', 1),
('/gridview/*', '*', 'gridview', 1),
('/gridview/export/*', '*', 'gridview/export', 1),
('/gridview/export/download', 'download', 'gridview/export', 1),
('/gridview/grid-edited-row/*', '*', 'gridview/grid-edited-row', 1),
('/gridview/grid-edited-row/back', 'back', 'gridview/grid-edited-row', 1),
('/item/*', '*', 'item', 1),
('/item/bulkdelete', 'bulkdelete', 'item', 1),
('/item/create', 'create', 'item', 1),
('/item/delete', 'delete', 'item', 1),
('/item/index', 'index', 'item', 1),
('/item/runningdelete', 'runningdelete', 'item', 1),
('/item/update', 'update', 'item', 1),
('/item/uploadcsv', 'uploadcsv', 'item', 1),
('/item/uploadcsv1', 'uploadcsv1', 'item', 1),
('/item/view', 'view', 'item', 1),
('/itemk/*', '*', 'itemk', 1),
('/itemk/bulkdelete', 'bulkdelete', 'itemk', 1),
('/itemk/create', 'create', 'itemk', 1),
('/itemk/delete', 'delete', 'itemk', 1),
('/itemk/index', 'index', 'itemk', 1),
('/itemk/update', 'update', 'itemk', 1),
('/itemk/view', 'view', 'itemk', 1),
('/itemp/*', '*', 'itemp', 1),
('/itemp/bulkdelete', 'bulkdelete', 'itemp', 1),
('/itemp/create', 'create', 'itemp', 1),
('/itemp/delete', 'delete', 'itemp', 1),
('/itemp/index', 'index', 'itemp', 1),
('/itemp/update', 'update', 'itemp', 1),
('/itemp/view', 'view', 'itemp', 1),
('/job/*', '*', 'job', 1),
('/job/bulkdelete', 'bulkdelete', 'job', 1),
('/job/create', 'create', 'job', 1),
('/job/delete', 'delete', 'job', 1),
('/job/index', 'index', 'job', 1),
('/job/print', 'print', 'job', 1),
('/job/runningdelete', 'runningdelete', 'job', 1),
('/job/update', 'update', 'job', 1),
('/job/view', 'view', 'job', 1),
('/jobs/*', '*', 'jobs', 1),
('/jobs/bulkdelete', 'bulkdelete', 'jobs', 1),
('/jobs/create', 'create', 'jobs', 1),
('/jobs/delete', 'delete', 'jobs', 1),
('/jobs/index', 'index', 'jobs', 1),
('/jobs/subcatuser', 'subcatuser', 'jobs', 1),
('/jobs/subcatuser1', 'subcatuser1', 'jobs', 1),
('/jobs/update', 'update', 'jobs', 1),
('/jobs/view', 'view', 'jobs', 1),
('/log/*', '*', 'log', 1),
('/log/bulkdelete', 'bulkdelete', 'log', 1),
('/log/create', 'create', 'log', 1),
('/log/delete', 'delete', 'log', 1),
('/log/index', 'index', 'log', 1),
('/log/update', 'update', 'log', 1),
('/log/view', 'view', 'log', 1),
('/mimin/*', '*', 'mimin', 1),
('/mimin/role/*', '*', 'mimin/role', 1),
('/mimin/role/create', 'create', 'mimin/role', 1),
('/mimin/role/delete', 'delete', 'mimin/role', 1),
('/mimin/role/index', 'index', 'mimin/role', 1),
('/mimin/role/permission', 'permission', 'mimin/role', 1),
('/mimin/role/update', 'update', 'mimin/role', 1),
('/mimin/role/view', 'view', 'mimin/role', 1),
('/mimin/route/*', '*', 'mimin/route', 1),
('/mimin/route/create', 'create', 'mimin/route', 1),
('/mimin/route/delete', 'delete', 'mimin/route', 1),
('/mimin/route/generate', 'generate', 'mimin/route', 1),
('/mimin/route/index', 'index', 'mimin/route', 1),
('/mimin/route/update', 'update', 'mimin/route', 1),
('/mimin/route/view', 'view', 'mimin/route', 1),
('/mimin/user/*', '*', 'mimin/user', 1),
('/mimin/user/create', 'create', 'mimin/user', 1),
('/mimin/user/delete', 'delete', 'mimin/user', 1),
('/mimin/user/index', 'index', 'mimin/user', 1),
('/mimin/user/update', 'update', 'mimin/user', 1),
('/mimin/user/view', 'view', 'mimin/user', 1),
('/perusahaan/*', '*', 'perusahaan', 1),
('/perusahaan/bulkdelete', 'bulkdelete', 'perusahaan', 1),
('/perusahaan/create', 'create', 'perusahaan', 1),
('/perusahaan/delete', 'delete', 'perusahaan', 1),
('/perusahaan/index', 'index', 'perusahaan', 1),
('/perusahaan/update', 'update', 'perusahaan', 1),
('/perusahaan/view', 'view', 'perusahaan', 1),
('/site/*', '*', 'site', 1),
('/site/about', 'about', 'site', 1),
('/site/camera', 'camera', 'site', 1),
('/site/captcha', 'captcha', 'site', 1),
('/site/contact', 'contact', 'site', 1),
('/site/eksekusi', 'eksekusi', 'site', 1),
('/site/error', 'error', 'site', 1),
('/site/hitung', 'hitung', 'site', 1),
('/site/index', 'index', 'site', 1),
('/site/info', 'info', 'site', 1),
('/site/login', 'login', 'site', 1),
('/site/logout', 'logout', 'site', 1),
('/site/request-password-reset', 'request-password-reset', 'site', 1),
('/site/resend-verification-email', 'resend-verification-email', 'site', 1),
('/site/reset-password', 'reset-password', 'site', 1),
('/site/scan', 'scan', 'site', 1),
('/site/scanm', 'scanm', 'site', 1),
('/site/settingcamera', 'settingcamera', 'site', 1),
('/site/settingsave', 'settingsave', 'site', 1),
('/site/signup', 'signup', 'site', 1),
('/site/verify-email', 'verify-email', 'site', 1),
('/userk/*', '*', 'userk', 1),
('/userk/bulkdelete', 'bulkdelete', 'userk', 1),
('/userk/create', 'create', 'userk', 1),
('/userk/delete', 'delete', 'userk', 1),
('/userk/index', 'index', 'userk', 1),
('/userk/update', 'update', 'userk', 1),
('/userk/updatep', 'updatep', 'userk', 1),
('/userk/view', 'view', 'userk', 1);

-- --------------------------------------------------------

--
-- Table structure for table `scanlog`
--

CREATE TABLE `scanlog` (
  `id` int(11) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `scan` varchar(300) DEFAULT NULL,
  `status` int(2) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `scanlog`
--

INSERT INTO `scanlog` (`id`, `tanggal`, `scan`, `status`) VALUES
(8, '2022-09-06 21:38:33', '(90)90834098320958(01)02948092184092(10)003(17)020222(21)480921843000010', 1),
(9, '2022-09-07 01:23:36', 'dakdaldjalkjd', 1),
(10, '2022-09-07 01:31:34', 'b\'\\x00\\x00\\x00\\x00\\x00?\\x01d\\x00;\\x01E\\x01\\x00\\x00\\x00\\x00\\x00\\x00\\x00\\x00\\x00\\x00\\x00\\x00\\x00\\x00\\x00\\x00\\x00\\x00\\x00\\x00\\x00\\x00\\x00\\x00\\x00\\x01\\x83\\x00\\x00\\x00\\x00@0gy\\x9d\\xe6w\\x9a@$\\xae\\x14z\\xe1G\\xae\\x00\\x02\\x03\\xc5\\x00\\x00\\x00\'', 1),
(11, '2022-09-08 21:06:09', 'b\'\\x00\\x00\\x00\\x00\\x00\\x06\\x01d\\x00\\x02\\x01O\'', 0),
(12, '2022-09-08 21:53:22', 'testdata', 0),
(13, '2022-09-08 21:53:45', 'testdata4', 0),
(14, '2022-09-08 21:58:16', '(90)90834098320958(01)02948092184092(10)003(17)020222(21)480921843000010', 0),
(15, '2022-09-08 23:13:48', 'b\'\\x00\\x00\\x00\\x00\\x00?\\x01d\\x00;\\x01E\\x01\\x00\\x00\\x00\\x00\\x00\\x00\\x00\\x00\\x00\\x00\\x00\\x00\\x00\\x00\\x00\\x00\\x00\\x00\\x00\\x00\\x00\\x00\\x00\\x0c\\x00\\x01\\x83\\xbb\\x00\\x00\\x00\\x00@0gy\\x9d\\xe6w\\x9a@\\x03\\x85\\x1e\\xb8Q\\xeb\\x85\\x00\\x02\\x04\\x97\\x00\\x00\\x00\\x06\'', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'admin', 'f2NbneBvr8nHa7M1-7-rpeC1Jvnr1a0R', '$2y$13$GGRKp2c2iWCP2ZDyqukReOGNcDqm.MWhUkZzIvH6bMV9kMD25czEq', NULL, 'admin@admin.com', 10, 1661206530, 1661206530, 'p6YXY2L12AEAChvrC8dDuqZEsb7J8_L8_1661206530'),
(2, 'operator', 'dcewydiD3KmSpx-1IqkuiQx_9CFNaRbi', '$2y$13$I05aedoxtMb5cLwClIoJPOXg3Ntfd9dirTNNOwl4EjeKqKidTG.hm', NULL, 'operator@gmail.com', 10, 1661206700, 1662653102, '4_fkRU2L4YlnMPAaKautmalEk77cOcGx_1661206700'),
(3, 'admiz', 'NsKWs8ni5Os2GaRVHV_3HBPLyCoEtsmq', '$2y$13$pRNf.QVjrEthjWibt.xGhuDM674TSxT/qgwQLZwzPrjUBdy2nteD2', NULL, 'adminwebz@gmail.com', 9, 1661206932, 1661206932, 'IdVv6MI9cnpdOVsLlEDEpD8KokkoVAPc_1661206932');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itemcamera`
--
ALTER TABLE `itemcamera`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itemkardus`
--
ALTER TABLE `itemkardus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itemmaster`
--
ALTER TABLE `itemmaster`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itemmasterd`
--
ALTER TABLE `itemmasterd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itempallet`
--
ALTER TABLE `itempallet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logitem`
--
ALTER TABLE `logitem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `scanlog`
--
ALTER TABLE `scanlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=484;

--
-- AUTO_INCREMENT for table `itemcamera`
--
ALTER TABLE `itemcamera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `itemkardus`
--
ALTER TABLE `itemkardus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `itemmaster`
--
ALTER TABLE `itemmaster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `itemmasterd`
--
ALTER TABLE `itemmasterd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=491;

--
-- AUTO_INCREMENT for table `itempallet`
--
ALTER TABLE `itempallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `logitem`
--
ALTER TABLE `logitem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `scanlog`
--
ALTER TABLE `scanlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
