-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.25-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for shoppingcart
DROP DATABASE IF EXISTS `shoppingcart`;
CREATE DATABASE IF NOT EXISTS `shoppingcart` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `shoppingcart`;

-- Dumping structure for table shoppingcart.ban_ips
DROP TABLE IF EXISTS `ban_ips`;
CREATE TABLE IF NOT EXISTS `ban_ips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table shoppingcart.ban_ips: ~2 rows (approximately)
/*!40000 ALTER TABLE `ban_ips` DISABLE KEYS */;
INSERT INTO `ban_ips` (`id`, `ip_address`) VALUES
	(1, '172.16.0.1'),
	(2, '172.16.0.2'),
	(3, '172.16.0.3');
/*!40000 ALTER TABLE `ban_ips` ENABLE KEYS */;

-- Dumping structure for table shoppingcart.carts
DROP TABLE IF EXISTS `carts`;
CREATE TABLE IF NOT EXISTS `carts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `paid` tinyint(1) NOT NULL,
  `contact_id` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4E004AACA76ED395` (`user_id`),
  KEY `IDX_4E004AACE7A1254A` (`contact_id`),
  CONSTRAINT `FK_4E004AACA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `FK_4E004AACE7A1254A` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table shoppingcart.carts: ~0 rows (approximately)
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;

-- Dumping structure for table shoppingcart.categories
DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_3AF346685E237E06` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table shoppingcart.categories: ~4 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `name`) VALUES
	(1, 'Admin Category Editor'),
	(2, 'AdminCategory'),
	(3, 'Test test');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table shoppingcart.contacts
DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table shoppingcart.contacts: ~0 rows (approximately)
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;

-- Dumping structure for table shoppingcart.migration_versions_1
DROP TABLE IF EXISTS `migration_versions_1`;
CREATE TABLE IF NOT EXISTS `migration_versions_1` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table shoppingcart.migration_versions_1: ~0 rows (approximately)
/*!40000 ALTER TABLE `migration_versions_1` DISABLE KEYS */;
/*!40000 ALTER TABLE `migration_versions_1` ENABLE KEYS */;

-- Dumping structure for table shoppingcart.order_products
DROP TABLE IF EXISTS `order_products`;
CREATE TABLE IF NOT EXISTS `order_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `cart_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5242B8EB4584665A` (`product_id`),
  KEY `IDX_5242B8EB1AD5CDBF` (`cart_id`),
  CONSTRAINT `FK_5242B8EB1AD5CDBF` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`),
  CONSTRAINT `FK_5242B8EB4584665A` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table shoppingcart.order_products: ~0 rows (approximately)
/*!40000 ALTER TABLE `order_products` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_products` ENABLE KEYS */;

-- Dumping structure for table shoppingcart.products
DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` longtext COLLATE utf8_unicode_ci,
  `stock` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `IDX_B3BA5A5A12469DE2` (`category_id`),
  KEY `IDX_B3BA5A5A19EB6921` (`client_id`),
  CONSTRAINT `FK_B3BA5A5A12469DE2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `FK_B3BA5A5A19EB6921` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table shoppingcart.products: ~6 rows (approximately)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `category_id`, `client_id`, `name`, `description`, `price`, `image`, `stock`, `quantity`) VALUES
	(1, 1, 1, 'Product Admin', 'gfdfgd', 33.00, 'photo nn', 1, 5),
	(6, 2, 1, 'Nov zapis', 'rrr', 3.00, 'rr', 1, 3),
	(9, 2, 1, 'dell', 'ddddddd', 333.00, 'ddddd', 0, 3),
	(11, 1, 11, 'Doncho Product', 'fff', 3.00, 'rrr', 1, 4),
	(12, 2, 1, 'Test 1', 'ggg', 44.00, 'gg', 1, 5),
	(14, 1, 2, 'Editor Product', 'hhhh', 4.00, 'hhhhh', 1, 555);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Dumping structure for table shoppingcart.reviews
DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6970EB0F4584665A` (`product_id`),
  KEY `IDX_6970EB0FA76ED395` (`user_id`),
  CONSTRAINT `FK_6970EB0F4584665A` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `FK_6970EB0FA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table shoppingcart.reviews: ~0 rows (approximately)
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;

-- Dumping structure for table shoppingcart.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_B63E2EC75E237E06` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table shoppingcart.roles: ~2 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`) VALUES
	(1, 'ROLE_ADMIN'),
	(2, 'ROLE_EDITOR'),
	(3, 'ROLE_USER');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table shoppingcart.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `wallet` decimal(10,2) DEFAULT NULL,
  `ban` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1483A5E9E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table shoppingcart.users: ~9 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `wallet`, `ban`) VALUES
	(1, 'Admin', 'admin@abv.bg', '$2y$13$dAx6gacoEB168z.M6vBVFuiXljVWV60yizzoh3V6288cClsr5H//y', 255.66, 0),
	(2, 'Editor', 'editor@abv.bg', '$2y$13$ie1iBVVu/Es6kKLmhnnU5Oo.mB0OkAjycVLg6ccGCk3Hqk489ekBq', 255.66, 0),
	(3, 'Pesho', 'pesho@abv.bg', '$2y$13$RIWdee3gB9oE63OEIlAkV.xBM.Mai.WjeTr/cgzfgATHi1JEHjNj2', 255.66, 0),
	(4, 'Minka', 'minka@abv.bg', '$2y$13$8vS6YLmlUxBjxnCjB1vhauiQo3YX9fy78y3eMLkHkCVsUeELH4MQq', 255.66, 1),
	(5, 'Gosho', 'gosho@abv.bg', '$2y$13$Yq54.Ve9jVuvN/CInOVele73vIsOWQiP6vqE99dyQEFBHrdgrbsk6', 255.66, 1),
	(6, 'Goshka', 'goshka@abv.bg', '$2y$13$nK77RUy.2RihvDdQos2nweTOm.OZw2Gngt3Ot4Bidc.dpETJNCQDe', 255.66, 0),
	(9, 'Novija', 'nov@abv.bg', '$2y$13$/zeoI4sGzBezQyTgkUizCOY9yZTaHiLE0mqC5/hYifPX3z9vbGHKa', 255.66, 0),
	(11, 'Doncho', 'doncho@abv.bg', '$2y$13$l0BwrTjC8WNVNxG2pWWapujf52NFVSP2bT49c.3SZoBjtdI7MBhgu', 255.66, 0),
	(13, 'New', 'new@abv.bg', '$2y$13$0NHdk4VqXwihF/fSinVm8urIFzMa8IKvItfv.f/Ax.6P5QgdMQa4.', 255.66, 0),
	(14, 'aaaa', 'a@a.a', '$2y$13$K79NbcI3zdoQmaQIUIaEQuG5FHlkUpvSMgdpPzVTbxOpxc2/8co52', 255.66, 0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table shoppingcart.users_roles
DROP TABLE IF EXISTS `users_roles`;
CREATE TABLE IF NOT EXISTS `users_roles` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `IDX_51498A8EA76ED395` (`user_id`),
  KEY `IDX_51498A8ED60322AC` (`role_id`),
  CONSTRAINT `FK_51498A8EA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `FK_51498A8ED60322AC` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table shoppingcart.users_roles: ~9 rows (approximately)
/*!40000 ALTER TABLE `users_roles` DISABLE KEYS */;
INSERT INTO `users_roles` (`user_id`, `role_id`) VALUES
	(1, 1),
	(2, 2),
	(3, 3),
	(4, 3),
	(5, 3),
	(6, 3),
	(9, 3),
	(11, 3),
	(13, 3),
	(14, 3);
/*!40000 ALTER TABLE `users_roles` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
