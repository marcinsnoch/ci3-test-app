-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Wersja serwera:               10.5.15-MariaDB-0ubuntu0.21.10.1 - Ubuntu 21.10
-- Serwer OS:                    debian-linux-gnu
-- HeidiSQL Wersja:              11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Zrzut struktury bazy danych ci_base
DROP DATABASE IF EXISTS `ci_base`;
CREATE DATABASE IF NOT EXISTS `ci_base` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `ci_base`;

-- Zrzut struktury tabela ci_base.accounts
DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Zrzucanie danych dla tabeli ci_base.accounts: ~0 rows (około)
DELETE FROM `accounts`;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;

-- Zrzut struktury tabela ci_base.ci_sessions
DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT 0,
  `data` blob NOT NULL,
  PRIMARY KEY (`id`,`ip_address`) USING BTREE,
  KEY `ci_sessions_timestamp` (`timestamp`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Zrzucanie danych dla tabeli ci_base.ci_sessions: ~9 rows (około)
DELETE FROM `ci_sessions`;
/*!40000 ALTER TABLE `ci_sessions` DISABLE KEYS */;
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
	('2vulfdct6o3tum80v38fgmpghh045or8', '127.0.0.1', 1655638405, _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313635353633383236303b757365725f69647c693a323b66756c6c5f6e616d657c733a343a2255736572223b69735f61646d696e7c693a303b6c6173745f61637469766974797c733a31393a22323032322d30362d31392031333a31353a3034223b6c6f676765645f696e7c623a313b),
	('58qvdq46npsp6ev0r6gk2pkq1oq077p5', '127.0.0.1', 1655504181, _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313635353530333933363b757365725f69647c693a313b66756c6c5f6e616d657c733a31333a2241646d696e6973747261746f72223b69735f61646d696e7c693a313b6c6173745f61637469766974797c733a31393a22323032322d30362d31372032303a33333a3532223b6c6f676765645f696e7c623a313b),
	('a6j2stepj2uegg254bgcu5gu1smrc29p', '127.0.0.1', 1655584783, _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313635353538343530353b757365725f69647c693a313b66756c6c5f6e616d657c733a31333a2241646d696e6973747261746f72223b69735f61646d696e7c693a303b6c6173745f61637469766974797c733a31393a22323032322d30362d31382032323a30343a3539223b6c6f676765645f696e7c623a313b),
	('e9s55f5utlqcfs2j8ral905mfmacdgld', '127.0.0.1', 1655563009, _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313635353536323834343b757365725f69647c693a313b66756c6c5f6e616d657c733a31333a2241646d696e6973747261746f72223b69735f61646d696e7c693a313b6c6173745f61637469766974797c733a31393a22323032322d30362d31382031363a32363a3232223b6c6f676765645f696e7c623a313b),
	('i263lf7vebvfepaeivt1v96jscto5rnk', '127.0.0.1', 1655563007, _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313635353536323833303b757365725f69647c693a323b66756c6c5f6e616d657c733a343a2255736572223b69735f61646d696e7c693a303b6c6173745f61637469766974797c733a31393a22323032322d30362d31382031363a32363a3334223b6c6f676765645f696e7c623a313b),
	('io3krpuht9aca0ebpdde9pm2e5hpj5ar', '127.0.0.1', 1655637261, _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313635353633373231323b),
	('ogflmtf6sa830issp69ob5r7u0bgqq7a', '127.0.0.1', 1655643306, _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313635353634333238353b616c6572747c613a333a7b733a343a2274797065223b733a373a2273756363657373223b733a333a226d7367223b733a33303a22506c6561736520636865636b20796f757220656d61696c20696e626f782e223b733a353a227469746c65223b4e3b7d5f5f63695f766172737c613a313a7b733a353a22616c657274223b733a333a226f6c64223b7d),
	('qlbmicrpo87ljvkiofg8ln4vvla33lo4', '127.0.0.1', 1655665841, _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313635353636353739383b757365725f69647c693a313b66756c6c5f6e616d657c733a353a2241646d696e223b69735f61646d696e7c693a313b6c6173745f61637469766974797c733a31393a22323032322d30362d31392032303a35383a3531223b6c6f676765645f696e7c623a313b),
	('vmsfp25g4vj20788rsftpm0jdsdobifp', '127.0.0.1', 1655537773, _binary 0x5f5f63695f6c6173745f726567656e65726174657c693a313635353533373638323b757365725f69647c693a313b66756c6c5f6e616d657c733a31333a2241646d696e6973747261746f72223b69735f61646d696e7c693a313b6c6173745f61637469766974797c733a31393a22323032322d30362d31382030383a35353a3033223b6c6f676765645f696e7c623a313b);
/*!40000 ALTER TABLE `ci_sessions` ENABLE KEYS */;

-- Zrzut struktury tabela ci_base.deliveries
DROP TABLE IF EXISTS `deliveries`;
CREATE TABLE IF NOT EXISTS `deliveries` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Zrzucanie danych dla tabeli ci_base.deliveries: ~0 rows (około)
DELETE FROM `deliveries`;
/*!40000 ALTER TABLE `deliveries` DISABLE KEYS */;
/*!40000 ALTER TABLE `deliveries` ENABLE KEYS */;

-- Zrzut struktury tabela ci_base.locations
DROP TABLE IF EXISTS `locations`;
CREATE TABLE IF NOT EXISTS `locations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Zrzucanie danych dla tabeli ci_base.locations: ~4 rows (około)
DELETE FROM `locations`;
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;
/*!40000 ALTER TABLE `locations` ENABLE KEYS */;

-- Zrzut struktury tabela ci_base.products
DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '0',
  `quantity` bigint(20) DEFAULT NULL,
  `location_id` int(11) unsigned DEFAULT NULL,
  `warehouse_id` int(11) unsigned DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_products_locations` (`location_id`),
  KEY `FK_products_warehouses` (`warehouse_id`),
  CONSTRAINT `FK_products_locations` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `FK_products_warehouses` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Zrzucanie danych dla tabeli ci_base.products: ~0 rows (około)
DELETE FROM `products`;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Zrzut struktury tabela ci_base.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(150) NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `is_admin` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `token` varchar(150) DEFAULT NULL,
  `remember_me` varchar(150) DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Zrzucanie danych dla tabeli ci_base.users: ~3 rows (około)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `email`, `full_name`, `password`, `is_admin`, `token`, `remember_me`, `last_activity`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'admin@admin.pl', 'Admin', '$2y$10$3q2JX232uQTHx/N2DUarIO1p6RnYnJiLQxGgOhBz8JN3yNGNHk.xa', 1, NULL, NULL, '2022-06-19 21:10:41', NULL, '2020-12-10 10:05:57', '2022-06-19 21:10:41'),
	(2, 'user@user.pl', 'User', '$2y$10$3q2JX232uQTHx/N2DUarIO1p6RnYnJiLQxGgOhBz8JN3yNGNHk.xa', 0, NULL, NULL, '2022-06-19 14:54:03', NULL, '2020-12-10 10:16:05', '2022-06-19 14:54:03');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Zrzut struktury tabela ci_base.warehouses
DROP TABLE IF EXISTS `warehouses`;
CREATE TABLE IF NOT EXISTS `warehouses` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Zrzucanie danych dla tabeli ci_base.warehouses: ~2 rows (około)
DELETE FROM `warehouses`;
/*!40000 ALTER TABLE `warehouses` DISABLE KEYS */;
/*!40000 ALTER TABLE `warehouses` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
