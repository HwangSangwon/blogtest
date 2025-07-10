-- --------------------------------------------------------
-- 데이터베이스: `emtec2004`
-- --------------------------------------------------------

-- 데이터베이스가 존재하지 않으면 생성합니다.
CREATE DATABASE IF NOT EXISTS `emtec2004` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `emtec2004`;

-- --------------------------------------------------------
-- 테이블 구조: `posts`
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- 사용자 생성 및 권한 부여
-- --------------------------------------------------------

-- 'emtec2004' 사용자를 생성하고 비밀번호를 설정합니다.
-- CREATE USER 'emtec2004'@'localhost' IDENTIFIED BY 'Scc0006!Won';

-- 'emtec2004' 데이터베이스에 대한 모든 권한을 'emtec2004'@'localhost' 사용자에게 부여합니다.
-- GRANT ALL PRIVILEGES ON `emtec2004`.* TO 'emtec2004'@'localhost';

-- 권한을 즉시 적용합니다.
-- FLUSH PRIVILEGES;
