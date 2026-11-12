-- =============================================================================
-- ROTARY CLUB OF ASOKORO — DISTRICT 9125, NIGERIA
-- 2027/2028 Officers Election Portal Database Schema
-- Compatible with MySQL 5.7+, MySQL 8.x, and MariaDB 10.x+
-- =============================================================================

CREATE DATABASE IF NOT EXISTS `rotary_election` 
  CHARACTER SET utf8mb4 
  COLLATE utf8mb4_unicode_ci;

USE `rotary_election`;

-- -----------------------------------------------------------------------------
-- Table structure for `nominations`
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `nominations` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `ref_no` VARCHAR(64) NOT NULL,
  `created_at` DATETIME NOT NULL,
  `title` VARCHAR(32) DEFAULT 'Rtn.',
  `full_name` VARCHAR(191) NOT NULL,
  `rotary_id` VARCHAR(64) NOT NULL,
  `email` VARCHAR(191) NOT NULL,
  `phone` VARCHAR(64) NOT NULL,
  `classification` VARCHAR(191) DEFAULT NULL,
  `years_in_club` VARCHAR(64) DEFAULT NULL,
  `position` VARCHAR(128) NOT NULL,
  `board_experience` TEXT DEFAULT NULL,
  `rli_status` VARCHAR(128) DEFAULT NULL,
  `proposer_name` VARCHAR(191) NOT NULL,
  `proposer_rotary_id` VARCHAR(64) NOT NULL,
  `proposer_phone` VARCHAR(64) DEFAULT NULL,
  `proposer_email` VARCHAR(191) DEFAULT NULL,
  `seconder_name` VARCHAR(191) NOT NULL,
  `seconder_rotary_id` VARCHAR(64) NOT NULL,
  `seconder_phone` VARCHAR(64) DEFAULT NULL,
  `seconder_email` VARCHAR(191) DEFAULT NULL,
  `manifesto_summary` TEXT DEFAULT NULL,
  `passport_photo` VARCHAR(255) DEFAULT NULL,
  `dues_evidence` VARCHAR(255) DEFAULT NULL,
  `manifesto_file` VARCHAR(255) DEFAULT NULL,
  `additional_file` VARCHAR(255) DEFAULT NULL,
  `signature_data` MEDIUMTEXT DEFAULT NULL,
  `peace_pact_accepted` TINYINT(1) DEFAULT 1,
  `four_way_test_accepted` TINYINT(1) DEFAULT 1,
  `screening_status` VARCHAR(32) DEFAULT 'PENDING',
  `screening_notes` TEXT DEFAULT NULL,
  `screening_updated_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_ref_no` (`ref_no`),
  KEY `idx_rotary_id` (`rotary_id`),
  KEY `idx_email` (`email`),
  KEY `idx_position` (`position`),
  KEY `idx_screening_status` (`screening_status`),
  KEY `idx_created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- Table structure for `audit_logs`
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `audit_logs` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `timestamp` DATETIME NOT NULL,
  `action` VARCHAR(128) NOT NULL,
  `details` TEXT DEFAULT NULL,
  `ip_address` VARCHAR(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_action` (`action`),
  KEY `idx_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- Seed Sample Candidate Record
-- -----------------------------------------------------------------------------
INSERT INTO `nominations` (
  `ref_no`, `created_at`, `title`, `full_name`, `rotary_id`, `email`, `phone`,
  `classification`, `years_in_club`, `position`, `board_experience`, `rli_status`,
  `proposer_name`, `proposer_rotary_id`, `seconder_name`, `seconder_rotary_id`,
  `manifesto_summary`, `passport_photo`, `dues_evidence`, `signature_data`,
  `screening_status`, `screening_notes`, `screening_updated_at`
) 
SELECT 
  'RCA-27-261112-B776E', '2026-11-12 16:31:20', 'Rtn.', 'Adewale Emmanuel Adeleke', '10492817', 
  'adewale.adeleke@rotaryasokoro.org', '+234 803 555 1234', 'Chartered Accounting & Financial Advisory', 
  '5 Years (Joined 2021)', 'President nominee', 'Club Treasurer (2023/2024), Club Service Chair (2024/2025)', 
  'RLI Graduate (Parts I, II & III Completed)', 'Rtn. Ibrahim Aliyu', '9845210', 
  'Rtn. Ngozi Eze', '8765432', 
  'To champion high-impact community maternal health initiatives, expand membership retention by 25%, and ensure transparent financial accountability across all club avenues.',
  'uploads/photo_RCA-27-261112-B776E_1794497480.jpg', 'uploads/dues_RCA-27-261112-B776E_1794497480.pdf',
  'Rtn. Adewale E. Adeleke', 'SCREENED_CLEARED', 'All dues paid up to date, RLI Graduate verified, attendance satisfactory.', 
  '2026-11-12 16:31:46'
FROM DUAL
WHERE NOT EXISTS (
  SELECT 1 FROM `nominations` WHERE `ref_no` = 'RCA-27-261112-B776E'
);
