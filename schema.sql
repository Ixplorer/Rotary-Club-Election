-- =============================================================================
-- ROTARY CLUB OF ASOKORO — DISTRICT 9125, NIGERIA
-- 2027/2028 Officers Election Portal Database Schema
-- Compatible with MySQL 5.7+, MySQL 8.x, and MariaDB 10.x+
-- =============================================================================

-- Optional: Create and select database if not existing
CREATE DATABASE IF NOT EXISTS `rotary_election` 
  CHARACTER SET utf8mb4 
  COLLATE utf8mb4_unicode_ci;

USE `rotary_election`;

-- -----------------------------------------------------------------------------
-- Table structure for `nominations`
-- Stores all Expressions of Interest submitted by club aspirants
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `nominations` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `ref_no` VARCHAR(64) NOT NULL COMMENT 'Unique official tracking reference, e.g. RCA-27-261112-B776E',
  `created_at` DATETIME NOT NULL COMMENT 'Submission timestamp',
  `title` VARCHAR(32) DEFAULT 'Rtn.' COMMENT 'Rotarian Title (Rtn., PAG, PP, AG, PDG, etc.)',
  `full_name` VARCHAR(191) NOT NULL COMMENT 'Full Legal / Membership Name',
  `rotary_id` VARCHAR(64) NOT NULL COMMENT 'Official Rotary Member ID',
  `email` VARCHAR(191) NOT NULL COMMENT 'Primary contact email address',
  `phone` VARCHAR(64) NOT NULL COMMENT 'Phone / WhatsApp contact number',
  `classification` VARCHAR(191) DEFAULT NULL COMMENT 'Vocational classification in Rotary',
  `years_in_club` VARCHAR(64) DEFAULT NULL COMMENT 'Tenure of membership in Rotary Club of Asokoro',
  `position` VARCHAR(128) NOT NULL COMMENT 'Elective constitutional office contested',
  `board_experience` TEXT DEFAULT NULL COMMENT 'Past Board / leadership positions held (Mandatory for President-nominee)',
  `rli_status` VARCHAR(128) DEFAULT NULL COMMENT 'Rotary Leadership Institute level completed',
  `proposer_name` VARCHAR(191) NOT NULL COMMENT 'Full name of financial member proposing nomination',
  `proposer_rotary_id` VARCHAR(64) NOT NULL COMMENT 'Rotary Member ID of Proposer',
  `proposer_phone` VARCHAR(64) DEFAULT NULL COMMENT 'Phone number of Proposer',
  `proposer_email` VARCHAR(191) DEFAULT NULL COMMENT 'Email address of Proposer',
  `seconder_name` VARCHAR(191) NOT NULL COMMENT 'Full name of financial member seconding nomination',
  `seconder_rotary_id` VARCHAR(64) NOT NULL COMMENT 'Rotary Member ID of Seconder',
  `seconder_phone` VARCHAR(64) DEFAULT NULL COMMENT 'Phone number of Seconder',
  `seconder_email` VARCHAR(191) DEFAULT NULL COMMENT 'Email address of Seconder',
  `manifesto_summary` TEXT DEFAULT NULL COMMENT 'Executive summary of one-page manifesto',
  `passport_photo` VARCHAR(255) DEFAULT NULL COMMENT 'Relative file path to passport headshot image',
  `dues_evidence` VARCHAR(255) DEFAULT NULL COMMENT 'Relative file path to dues payment evidence document',
  `manifesto_file` VARCHAR(255) DEFAULT NULL COMMENT 'Relative file path to uploaded manifesto document',
  `additional_file` VARCHAR(255) DEFAULT NULL COMMENT 'Relative file path to supporting credentials',
  `signature_data` MEDIUMTEXT DEFAULT NULL COMMENT 'Base64 PNG signature or legal typed declaration',
  `peace_pact_accepted` TINYINT(1) DEFAULT 1 COMMENT 'Affirmation of Peace Pact and Code of Conduct',
  `four_way_test_accepted` TINYINT(1) DEFAULT 1 COMMENT 'Affirmation of The Four-Way Test',
  `screening_status` VARCHAR(32) DEFAULT 'PENDING' COMMENT 'PENDING, SCREENED_CLEARED, PROVISIONAL, or DISQUALIFIED',
  `screening_notes` TEXT DEFAULT NULL COMMENT 'Official notes and remarks by the Electoral Committee',
  `screening_updated_at` DATETIME DEFAULT NULL COMMENT 'Timestamp when screening verdict was last updated',
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
-- Audit trail for committee security and action verification
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `audit_logs` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `timestamp` DATETIME NOT NULL COMMENT 'Action timestamp',
  `action` VARCHAR(128) NOT NULL COMMENT 'Action tag, e.g. NOMINATION_SUBMITTED, STATUS_UPDATED',
  `details` TEXT DEFAULT NULL COMMENT 'JSON or text metadata of action',
  `ip_address` VARCHAR(45) DEFAULT NULL COMMENT 'Client IP address',
  PRIMARY KEY (`id`),
  KEY `idx_action` (`action`),
  KEY `idx_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- Sample Verified Seed Record (Optional reference demonstration)
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
