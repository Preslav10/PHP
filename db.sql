 CREATE TABLE `admin` (
  `ad_id` int(11) NOT NULL,
  `ad_name` varchar(20) NOT NULL,
  `ad_email` varchar(100) NOT NULL,
  `ad_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `admin` (`ad_id`, `ad_name`, `ad_email`, `ad_password`) VALUES
(1, 'admin', 'admin@mail.com', 'admin');

CREATE TABLE `slider` ( 
  `id` int(11) NOT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `status` enum('visible','hidden') DEFAULT 'visible'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci; 

CREATE TABLE `men_shoes_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `men_shoes_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `men_shoes_photos_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `men_shoes_products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `men_pants_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `men_pants_photos`(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `men_pants_photos_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `men_pants_products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `men_shirts_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `men_shirts_photos`(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `men_shirts_photos_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `men_shirts_products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `women_shoes_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `women_shoes_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `women_shoes_photos_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `women_shoes_products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `women_pants_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `women_pants_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `women_pants_photos_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `women_pants_products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `women_shirts_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `women_shirts_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `women_shirts_photos_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `women_shirts_products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `kids_shoes_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `kids_shoes_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `kids_shoes_photos_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `kids_shoes_products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `kids_pants_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `kids_pants_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `kids_pants_photos_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `kids_pants_products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `kids_shirts_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `kids_shirts_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL, 
  `photo_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `kids_shirts_photos_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `kids_shirts_products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `favoriteproduct` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `men_shoes_id` int(11) DEFAULT NULL,
  `men_pants_id` int(11) DEFAULT NULL,
  `men_shirts_id` int(11) DEFAULT NULL,
  `women_shoes_id` int(11) DEFAULT NULL,
  `women_pants_id` int(11) DEFAULT NULL,
  `women_shirts_id` int(11) DEFAULT NULL,
  `kids_shoes_id` int(11) DEFAULT NULL,
  `kids_pants_id` int(11) DEFAULT NULL,
  `kids_shirts_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`men_shoes_id`) REFERENCES `men_shoes_products` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`men_pants_id`) REFERENCES `men_pants_products` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`men_shirts_id`) REFERENCES `men_shirts_products` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`women_shoes_id`) REFERENCES `women_shoes_products` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`women_pants_id`) REFERENCES `women_pants_products` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`women_shirts_id`) REFERENCES `women_shirts_products` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`kids_shoes_id`) REFERENCES `kids_shoes_products` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`kids_pants_id`) REFERENCES `kids_pants_products` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`kids_shirts_id`) REFERENCES `kids_shirts_products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `favoriteproduct`
  ADD CONSTRAINT `favoriteproduct_men_shoes_fk` FOREIGN KEY (`men_shoes_id`) REFERENCES `men_shoes_products` (`id`) ON DELETE CASCADE;

ALTER TABLE `favoriteproduct`
  ADD CONSTRAINT `favoriteproduct_men_pants_fk` FOREIGN KEY (`men_pants_id`) REFERENCES `men_pants_products` (`id`) ON DELETE CASCADE;

ALTER TABLE `favoriteproduct`
  ADD CONSTRAINT `favoriteproduct_men_shirts_fk` FOREIGN KEY (`men_shirts_id`) REFERENCES `men_shirts_products` (`id`) ON DELETE CASCADE;

ALTER TABLE `favoriteproduct`
  ADD CONSTRAINT `favoriteproduct_women_shoes_fk` FOREIGN KEY (`women_shoes_id`) REFERENCES `women_shoes_products` (`id`) ON DELETE CASCADE;

ALTER TABLE `favoriteproduct`
  ADD CONSTRAINT `favoriteproduct_women_pants_fk` FOREIGN KEY (`women_pants_id`) REFERENCES `women_pants_products` (`id`) ON DELETE CASCADE;

ALTER TABLE `favoriteproduct`
  ADD CONSTRAINT `favoriteproduct_women_shirts_fk` FOREIGN KEY (`women_shirts_id`) REFERENCES `women_shirts_products` (`id`) ON DELETE CASCADE;

ALTER TABLE `favoriteproduct`
  ADD CONSTRAINT `favoriteproduct_kids_shoes_fk` FOREIGN KEY (`kids_shoes_id`) REFERENCES `kids_shoes_products` (`id`) ON DELETE CASCADE;

ALTER TABLE `favoriteproduct`
  ADD CONSTRAINT `favoriteproduct_kids_pants_fk` FOREIGN KEY (`kids_pants_id`) REFERENCES `kids_pants_products` (`id`) ON DELETE CASCADE;

ALTER TABLE `favoriteproduct`
  ADD CONSTRAINT `favoriteproduct_kids_shirts_fk` FOREIGN KEY (`kids_shirts_id`) REFERENCES `kids_shirts_products` (`id`) ON DELETE CASCADE;



