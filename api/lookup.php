<?php
/**
 * API: Lookup Nomination & Status by Ref No or Rotary ID / Email
 */

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../config.php';

$query = trim($_GET['q'] ?? '');

if (empty($query)) {
    echo json_encode(['success' => false, 'error' => 'Please provide a Reference Number, Rotary Member ID, or Email.']);
    exit;
}

$pdo = getDbConnection();
if (!$pdo) {
    echo json_encode(['success' => false, 'error' => 'Database connection failed.']);
    exit;
}

try {
    $stmt = $pdo->prepare("
        SELECT id, ref_no, title, full_name, rotary_id, email, phone, classification,
               years_in_club, position, board_experience, rli_status,
               proposer_name, proposer_rotary_id, seconder_name, seconder_rotary_id,
               manifesto_summary, passport_photo, dues_evidence, manifesto_file,
               signature_data, screening_status, screening_notes, created_at, screening_updated_at
        FROM nominations
        WHERE UPPER(ref_no) = UPPER(:q) 
           OR UPPER(rotary_id) = UPPER(:q) 
           OR LOWER(email) = LOWER(:q)
        ORDER BY id DESC LIMIT 1
    ");
    $stmt->execute([':q' => $query]);
    $record = $stmt->fetch();

    if (!$record) {
        echo json_encode(['success' => false, 'error' => 'No nomination submission found matching "' . htmlspecialchars($query) . '". Please check your Reference Number or Member ID.']);
        exit;
    }

    echo json_encode([
        'success' => true,
        'data' => $record
    ]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => 'Query error: ' . $e->getMessage()]);
}
