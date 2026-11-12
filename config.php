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

// Database Connection (SQLite PDO)
function getDbConnection() {
    global $dataDir;
    $dbFile = $dataDir . DIRECTORY_SEPARATOR . 'election.db';
    
    try {
        $pdo = new PDO("sqlite:" . $dbFile);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        
        // Initialize tables
        initDbSchema($pdo);
        
        return $pdo;
    } catch (Exception $e) {
        error_log("DB Connection Error: " . $e->getMessage());
        return null;
    }
}

function initDbSchema($pdo) {
    $schema = "
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
    ";
    $pdo->exec($schema);
}

// Helper to generate unique reference number
function generateReferenceNumber() {
    $timestamp = date('ymd');
    $random = strtoupper(substr(bin2hex(random_bytes(3)), 0, 5));
    return "RCA-27-{$timestamp}-{$random}";
}
