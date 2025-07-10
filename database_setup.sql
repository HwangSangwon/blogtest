-- CodeIgniter 4 프로젝트용 MySQL 테이블 생성 스크립트
-- 웹호스팅 MySQL 데이터베이스에서 직접 실행하세요

-- posts 테이블 생성
CREATE TABLE IF NOT EXISTS `posts` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `title` varchar(255) NOT NULL,
    `slug` varchar(255) NOT NULL,
    `content` text NOT NULL,
    `thumbnail` varchar(255) DEFAULT NULL,
    `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
    `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 마이그레이션 테이블 생성 (CodeIgniter가 사용)
CREATE TABLE IF NOT EXISTS `migrations` (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `version` varchar(255) NOT NULL,
    `class` varchar(255) NOT NULL,
    `group` varchar(255) NOT NULL,
    `namespace` varchar(255) NOT NULL,
    `time` int(11) NOT NULL,
    `batch` int(11) unsigned NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 샘플 데이터 삽입 (선택사항)
INSERT INTO `posts` (`title`, `slug`, `content`, `thumbnail`) VALUES
('첫 번째 포스트', 'first-post', '이것은 첫 번째 포스트의 내용입니다.', NULL),
('두 번째 포스트', 'second-post', '이것은 두 번째 포스트의 내용입니다.', NULL),
('세 번째 포스트', 'third-post', '이것은 세 번째 포스트의 내용입니다.', NULL);
