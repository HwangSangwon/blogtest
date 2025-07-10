-- --------------------------------------------------------
-- Supabase (PostgreSQL)용 테이블 스키마
-- --------------------------------------------------------

-- 테이블 구조: posts
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS posts (
  id SERIAL PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  slug VARCHAR(255) NOT NULL UNIQUE,
  body TEXT NOT NULL,
  thumbnail VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT NULL,
  updated_at TIMESTAMP DEFAULT NULL,
  deleted_at TIMESTAMP DEFAULT NULL
);
