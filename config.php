<?php
/**
 * Rotary Club of Asokoro - District 9125, Nigeria
 * 2027/2028 Officers Election Portal Configuration & Database Setup
 */

// Error reporting for production stability
error_reporting(E_ALL);
ini_set('display_errors', '0');

// App Constants
define('CLUB_NAME', 'Rotary Club of Asokoro');
define('DISTRICT_NAME', 'District 9125, Nigeria');
define('CLUB_MOTTO', 'The Pace Setter');
define('ROTARY_MOTTO', 'Service Above Self');
define('ROTARY_YEAR', '2027/2028');
define('ELECTION_DATE', 'Wednesday, 25th November, 2026');
define('ELECTION_VENUE', 'Stratton Suite, Asokoro, Abuja');
define('NOMINATION_DEADLINE', '2026-11-20 17:00:00');
define('NOMINATION_DEADLINE_TEXT', 'Friday, 20th November, 2026 by 5:00pm prompt');

define('COMMITTEE_CHAIRMAN', 'Rotarian Adegoke, Saheed Adeyemi');
define('CLUB_PRESIDENT', 'Impact President Ignatus Emeka');

// Admin Passkey for Electoral Committee Portal
define('ADMIN_PASSKEY', 'asokoro2027');

// Electable Offices List
$ELECTABLE_OFFICES = [
    'President nominee' => [
        'title' => 'President-nominee (for 2027/2028)',
        'category' => 'Executive Leadership',
        'badge' => 'Special Board & RLI Prerequisite',
        'description' => 'Serves as President-nominee, preparing for presidency in line with Rotary International leadership succession. Must have served on the Board or in club leadership and attended Rotary Leadership Institute (RLI) training.',
        'icon' => 'crown'
    ],
    'Secretary' => [
        'title' => 'Secretary',
        'category' => 'Executive Office',
        'badge' => 'Club Records & Governance',
        'description' => 'Maintains club records, records minutes of club meetings and Board meetings, handles RI correspondence, reports membership changes, and manages official club notices.',
        'icon' => 'file-text'
    ],
    'Treasurer' => [
        'title' => 'Treasurer',
        'category' => 'Financial Governance',
        'badge' => 'Club Treasury & Accounts',
        'description' => 'Responsible for all club funds, accounts, budgeting, collection of club dues, disbursement of funds approved by Board, and statutory financial reporting.',
        'icon' => 'credit-card'
    ],
    'Club service chair' => [
        'title' => 'Club Service Chair',
        'category' => 'Avenue of Service',
        'badge' => 'Fellowship & Membership',
        'description' => 'Oversees club operations, fellowship activities, weekly meeting logistics, member engagement, retention, and club social harmony.',
        'icon' => 'users'
    ],
    'Public image chair' => [
        'title' => 'Public Image Chair',
        'category' => 'Communication & Media',
        'badge' => 'Brand & External Relations',
        'description' => 'Promotes Rotary and the club’s projects across media, coordinates press relations, social media, flyers, website updates, and brand compliance.',
        'icon' => 'megaphone'
    ],
    'Rotary foundation chair' => [
        'title' => 'Rotary Foundation Chair',
        'category' => 'TRF Grants & Giving',
        'badge' => 'Foundation Programs',
        'description' => 'Educates members on The Rotary Foundation (TRF), encourages Paul Harris Fellow (PHF) giving, PolioPlus support, and coordinates District & Global Grants.',
        'icon' => 'heart-handshake'
    ],
    'Youth service chair' => [
        'title' => 'Youth Service Chair',
        'category' => 'New Generations',
        'badge' => 'Rotaract & Interact',
        'description' => 'Coordinates youth programs, liaises with Rotaract and Interact clubs sponsored by the club, and oversees youth leadership awards (RYLA).',
        'icon' => 'sparkles'
    ],
    'Project chair' => [
        'title' => 'Projects Chair',
        'category' => 'Community Service',
        'badge' => 'Impactful Community Projects',
        'description' => 'Identifies community needs, plans, executes and monitors humanitarian service projects within the 7 areas of focus of Rotary International.',
        'icon' => 'hammer'
    ]
];

// =============================================================================
// ENVIRONMENT & DATABASE CONFIGURATION (LIVE SERVER READY)
// =============================================================================

// Load .env file if present in project root
$envFile = __DIR__ . DIRECTORY_SEPARATOR . '.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || strpos($line, '#') === 0) continue;
        if (strpos($line, '=') !== false) {
            list($key, $val) = explode('=', $line, 2);
            $key = trim($key);
            $val = trim($val, " \t\n\r\0\x0B\"'");
            if (!getenv($key)) {
                putenv("{$key}={$val}");
                $_ENV[$key] = $val;
            }
        }
    }
}

// Database Connection Drivers: 'auto' (Try MySQL, fallback to SQLite), 'mysql', or 'sqlite'
define('DB_DRIVER', getenv('DB_DRIVER') ?: 'auto');
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_PORT', getenv('DB_PORT') ?: '3306');
define('DB_NAME', getenv('DB_NAME') ?: 'rotary_election');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') !== false ? getenv('DB_PASS') : '');
define('DB_CHARSET', 'utf8mb4');

// Directories setup
$baseDir = __DIR__;
$uploadDir = $baseDir . DIRECTORY_SEPARATOR . 'uploads';
$dataDir = $baseDir . DIRECTORY_SEPARATOR . 'data';

if (!is_dir($uploadDir)) {
    @mkdir($uploadDir, 0777, true);
}
if (!is_dir($dataDir)) {
    @mkdir($dataDir, 0777, true);
}

// Global active driver tracking ('mysql' or 'sqlite')
$ACTIVE_DB_DRIVER = 'sqlite';

/**
 * Get or create unified PDO Database Connection
 * Auto-detects driver, auto-creates database and schema on live servers or local setups.
 */
function getDbConnection() {
    static $pdoInstance = null;
    if ($pdoInstance !== null) {
        return $pdoInstance;
    }

    global $dataDir, $ACTIVE_DB_DRIVER;
    $driver = strtolower(DB_DRIVER);

    // 1. Attempt MySQL / MariaDB connection (Standard for live hosting / cPanel)
    if ($driver === 'mysql' || $driver === 'auto') {
        try {
            $dsnWithDb = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
            $dsnNoDb   = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";charset=" . DB_CHARSET;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_TIMEOUT => 3 // Quick timeout so 'auto' falls back gracefully if MySQL service is offline
            ];

            try {
                // Try direct database connection
                $pdo = new PDO($dsnWithDb, DB_USER, DB_PASS, $options);
            } catch (PDOException $ex) {
                // If database doesn't exist (error code 1049), attempt auto-creation
                if ($ex->getCode() == 1049 || strpos($ex->getMessage(), 'Unknown database') !== false) {
                    $serverPdo = new PDO($dsnNoDb, DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
                    $dbSafe = preg_replace('/[^a-zA-Z0-9_]/', '', DB_NAME);
                    $serverPdo->exec("CREATE DATABASE IF NOT EXISTS `{$dbSafe}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
                    $serverPdo->exec("USE `{$dbSafe}`");
                    $pdo = $serverPdo;
                    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                } else {
                    throw $ex;
                }
            }

            // Auto-create MySQL Schema if tables are missing
            initMySQLSchema($pdo);

            $ACTIVE_DB_DRIVER = 'mysql';
            $pdoInstance = $pdo;
            return $pdoInstance;

        } catch (Exception $e) {
            if ($driver === 'mysql') {
                error_log("MySQL Connection Error: " . $e->getMessage());
                return null;
            }
            // In 'auto' mode, fall through to SQLite
        }
    }

    // 2. Fallback to SQLite (Guaranteed 100% plug-and-play local/shared host operation)
    try {
        if (!is_dir($dataDir)) {
            @mkdir($dataDir, 0777, true);
        }
        $dbFile = $dataDir . DIRECTORY_SEPARATOR . 'election.db';
        $pdo = new PDO("sqlite:" . $dbFile, null, null, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);

        // Auto-create SQLite Schema if tables are missing
        initSQLiteSchema($pdo);

        $ACTIVE_DB_DRIVER = 'sqlite';
        $pdoInstance = $pdo;
        return $pdoInstance;

    } catch (Exception $e) {
        error_log("SQLite Connection Error: " . $e->getMessage());
        return null;
    }
}

/**
 * Auto-creates MySQL Schema & Indexes
 */
function initMySQLSchema($pdo) {
    static $done = false;
    if ($done) return;

    $sql = "
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
      KEY `idx_screening_status` (`screening_status`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
    ";

    $pdo->exec($sql);
    $done = true;
}

/**
 * Auto-creates SQLite Schema & Indexes
 */
function initSQLiteSchema($pdo) {
    static $done = false;
    if ($done) return;

    $sql = "
    CREATE TABLE IF NOT EXISTS nominations (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        ref_no TEXT UNIQUE NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        title TEXT,
        full_name TEXT NOT NULL,
        rotary_id TEXT NOT NULL,
        email TEXT NOT NULL,
        phone TEXT NOT NULL,
        classification TEXT,
        years_in_club TEXT,
        position TEXT NOT NULL,
        board_experience TEXT,
        rli_status TEXT,
        proposer_name TEXT NOT NULL,
        proposer_rotary_id TEXT NOT NULL,
        proposer_phone TEXT,
        proposer_email TEXT,
        seconder_name TEXT NOT NULL,
        seconder_rotary_id TEXT NOT NULL,
        seconder_phone TEXT,
        seconder_email TEXT,
        manifesto_summary TEXT,
        passport_photo TEXT,
        dues_evidence TEXT,
        manifesto_file TEXT,
        additional_file TEXT,
        signature_data TEXT,
        peace_pact_accepted INTEGER DEFAULT 1,
        four_way_test_accepted INTEGER DEFAULT 1,
        screening_status TEXT DEFAULT 'PENDING',
        screening_notes TEXT,
        screening_updated_at DATETIME
    );

    CREATE TABLE IF NOT EXISTS audit_logs (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
        action TEXT,
        details TEXT,
        ip_address TEXT
    );

    CREATE INDEX IF NOT EXISTS idx_nom_rotary_id ON nominations(rotary_id);
    CREATE INDEX IF NOT EXISTS idx_nom_email ON nominations(email);
    CREATE INDEX IF NOT EXISTS idx_nom_position ON nominations(position);
    CREATE INDEX IF NOT EXISTS idx_nom_status ON nominations(screening_status);
    ";

    $pdo->exec($sql);
    $done = true;
}

/**
 * Backward compatibility alias
 */
function initDbSchema($pdo, $driver = null) {
    if ($driver === 'mysql') {
        initMySQLSchema($pdo);
    } else {
        initSQLiteSchema($pdo);
    }
}

// Helper to generate unique reference number
function generateReferenceNumber() {
    $timestamp = date('ymd');
    $random = strtoupper(substr(bin2hex(random_bytes(3)), 0, 5));
    return "RCA-27-{$timestamp}-{$random}";
}
