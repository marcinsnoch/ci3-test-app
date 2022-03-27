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
CREATE DATABASE IF NOT EXISTS `ci_base` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `ci_base`;

-- Zrzut struktury tabela ci_base.ci_sessions
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT 0,
  `data` blob NOT NULL,
  PRIMARY KEY (`id`,`ip_address`) USING BTREE,
  KEY `ci_sessions_timestamp` (`timestamp`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Zrzucanie danych dla tabeli ci_base.ci_sessions: ~0 rows (około)
DELETE FROM `ci_sessions`;
/*!40000 ALTER TABLE `ci_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `ci_sessions` ENABLE KEYS */;

-- Zrzut struktury tabela ci_base.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(150) NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `token` varchar(150) DEFAULT NULL,
  `remember_me` varchar(150) DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Zrzucanie danych dla tabeli ci_base.users: ~2 rows (około)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `email`, `full_name`, `password`, `token`, `remember_me`, `last_activity`, `created_at`, `updated_at`) VALUES
	(1, 'admin@admin.pl', 'Administrator', '$2y$10$3q2JX232uQTHx/N2DUarIO1p6RnYnJiLQxGgOhBz8JN3yNGNHk.xa', NULL, NULL, NULL, '2020-12-10 10:05:57', '2022-03-27 17:38:43'),
	(2, 'user@user.pl', 'User', '$2y$10$3q2JX232uQTHx/N2DUarIO1p6RnYnJiLQxGgOhBz8JN3yNGNHk.xa', NULL, NULL, NULL, '2020-12-10 10:16:05', '2020-12-10 10:16:05');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
