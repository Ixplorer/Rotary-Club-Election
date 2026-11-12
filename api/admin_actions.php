<?php
/**
 * API: Electoral Committee Administration Actions
 */

session_start();
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../config.php';

$action = $_GET['action'] ?? $_POST['action'] ?? 'list';
$passkey = $_POST['passkey'] ?? $_GET['passkey'] ?? ($_SESSION['admin_auth'] ?? '');

// Simple secure committee authentication
if ($passkey !== ADMIN_PASSKEY) {
    echo json_encode(['success' => false, 'error' => 'Unauthorized. Invalid Electoral Committee passkey.']);
    exit;
}
$_SESSION['admin_auth'] = ADMIN_PASSKEY;

$pdo = getDbConnection();
if (!$pdo) {
    echo json_encode(['success' => false, 'error' => 'Database connection failed.']);
    exit;
}

// 1. LIST ACTION
if ($action === 'list') {
    $filterPosition = trim($_GET['position'] ?? '');
    $filterStatus = trim($_GET['status'] ?? '');
    $search = trim($_GET['search'] ?? '');

    $sql = "SELECT * FROM nominations WHERE 1=1";
    $params = [];

    if (!empty($filterPosition)) {
        $sql .= " AND position = :pos";
        $params[':pos'] = $filterPosition;
    }
    if (!empty($filterStatus)) {
        $sql .= " AND screening_status = :status";
        $params[':status'] = $filterStatus;
    }
    if (!empty($search)) {
        $sql .= " AND (full_name LIKE :s OR rotary_id LIKE :s OR email LIKE :s OR ref_no LIKE :s)";
        $params[':s'] = "%{$search}%";
    }

    $sql .= " ORDER BY id DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $records = $stmt->fetchAll();

    // Compute stats
    $statsStmt = $pdo->query("
        SELECT 
            COUNT(*) as total,
            SUM(CASE WHEN screening_status = 'PENDING' THEN 1 ELSE 0 END) as pending,
            SUM(CASE WHEN screening_status = 'SCREENED_CLEARED' THEN 1 ELSE 0 END) as cleared,
            SUM(CASE WHEN screening_status = 'DISQUALIFIED' THEN 1 ELSE 0 END) as disqualified,
            SUM(CASE WHEN position = 'President nominee' THEN 1 ELSE 0 END) as pres_nominee
        FROM nominations
    ");
    $stats = $statsStmt->fetch();

    // Position breakdown
    $posStmt = $pdo->query("SELECT position, COUNT(*) as count FROM nominations GROUP BY position");
    $positions = $posStmt->fetchAll(PDO::FETCH_KEY_PAIR);

    echo json_encode([
        'success' => true,
        'stats' => $stats,
        'positions_breakdown' => $positions,
        'records' => $records
    ]);
    exit;
}

// 2. UPDATE STATUS ACTION
if ($action === 'update_status') {
    $id = intval($_POST['id'] ?? 0);
    $newStatus = trim($_POST['status'] ?? '');
    $notes = trim($_POST['notes'] ?? '');

    $allowedStatuses = ['PENDING', 'SCREENED_CLEARED', 'PROVISIONAL', 'DISQUALIFIED'];
    if (!$id || !in_array($newStatus, $allowedStatuses)) {
        echo json_encode(['success' => false, 'error' => 'Invalid ID or status value.']);
        exit;
    }

    $stmt = $pdo->prepare("
        UPDATE nominations 
        SET screening_status = :status, screening_notes = :notes, screening_updated_at = datetime('now', 'localtime')
        WHERE id = :id
    ");
    $stmt->execute([':status' => $newStatus, ':notes' => $notes, ':id' => $id]);

    echo json_encode([
        'success' => true,
        'message' => "Candidate screening status updated to {$newStatus}."
    ]);
    exit;
}

// 3. EXPORT CSV
if ($action === 'export_csv') {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=Rotary_Asokoro_2027_2028_Nominations_' . date('Ymd_His') . '.csv');

    $output = fopen('php://output', 'w');
    // UTF-8 BOM for Excel
    fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

    fputcsv($output, [
        'ID', 'Reference No', 'Date Submitted', 'Title', 'Full Name', 'Rotary Member ID',
        'Email', 'Phone', 'Classification', 'Years in Club', 'Office Contesting',
        'Board Experience', 'RLI Status', 'Proposer Name', 'Proposer Rotary ID',
        'Seconder Name', 'Seconder Rotary ID', 'Screening Status', 'Screening Notes',
        'Passport Photo Link', 'Dues Receipt Link', 'Manifesto Link'
    ]);

    $stmt = $pdo->query("SELECT * FROM nominations ORDER BY position ASC, full_name ASC");
    while ($row = $stmt->fetch()) {
        fputcsv($output, [
            $row['id'],
            $row['ref_no'],
            $row['created_at'],
            $row['title'],
            $row['full_name'],
            $row['rotary_id'],
            $row['email'],
            $row['phone'],
            $row['classification'],
            $row['years_in_club'],
            $row['position'],
            $row['board_experience'],
            $row['rli_status'],
            $row['proposer_name'],
            $row['proposer_rotary_id'],
            $row['seconder_name'],
            $row['seconder_rotary_id'],
            $row['screening_status'],
            $row['screening_notes'],
            $row['passport_photo'] ? 'http://' . $_SERVER['HTTP_HOST'] . '/rotary/' . $row['passport_photo'] : '',
            $row['dues_evidence'] ? 'http://' . $_SERVER['HTTP_HOST'] . '/rotary/' . $row['dues_evidence'] : '',
            $row['manifesto_file'] ? 'http://' . $_SERVER['HTTP_HOST'] . '/rotary/' . $row['manifesto_file'] : ''
        ]);
    }
    fclose($output);
    exit;
}

echo json_encode(['success' => false, 'error' => 'Unknown action.']);
