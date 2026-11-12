<?php
/**
 * API: Handle Expression of Interest / Nomination Form Submission
 */

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Invalid request method. Only POST allowed.']);
    exit;
}

$pdo = getDbConnection();
if (!$pdo) {
    echo json_encode(['success' => false, 'error' => 'Database connection failed. Please contact the administrator.']);
    exit;
}

// Sanitize & collect inputs
$title = trim($_POST['title'] ?? 'Rtn.');
$fullName = trim($_POST['full_name'] ?? '');
$rotaryId = trim($_POST['rotary_id'] ?? '');
$email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
$phone = trim($_POST['phone'] ?? '');
$classification = trim($_POST['classification'] ?? '');
$yearsInClub = trim($_POST['years_in_club'] ?? '');
$position = trim($_POST['position'] ?? '');
$boardExperience = trim($_POST['board_experience'] ?? '');
$rliStatus = trim($_POST['rli_status'] ?? '');

$proposerName = trim($_POST['proposer_name'] ?? '');
$proposerRotaryId = trim($_POST['proposer_rotary_id'] ?? '');
$proposerPhone = trim($_POST['proposer_phone'] ?? '');
$proposerEmail = trim($_POST['proposer_email'] ?? '');

$seconderName = trim($_POST['seconder_name'] ?? '');
$seconderRotaryId = trim($_POST['seconder_rotary_id'] ?? '');
$seconderPhone = trim($_POST['seconder_phone'] ?? '');
$seconderEmail = trim($_POST['seconder_email'] ?? '');

$manifestoSummary = trim($_POST['manifesto_summary'] ?? '');
$signatureData = trim($_POST['signature_data'] ?? '');
$peacePact = isset($_POST['peace_pact_accepted']) ? 1 : 0;
$fourWayTest = isset($_POST['four_way_test_accepted']) ? 1 : 0;

// Validation
$errors = [];

if (empty($fullName)) $errors[] = "Aspirant's Full Name is required.";
if (empty($rotaryId)) $errors[] = "Rotary Member ID is required.";
if (!$email) $errors[] = "A valid Email Address is required.";
if (empty($phone)) $errors[] = "Phone / WhatsApp Number is required.";
if (empty($position) || !array_key_exists($position, $ELECTABLE_OFFICES)) {
    $errors[] = "Please select a valid electable office.";
}

// Special check for President nominee
if ($position === 'President nominee') {
    if (empty($boardExperience)) {
        $errors[] = "President-nominee aspirants must provide history of Board or leadership service in the Club.";
    }
    if (empty($rliStatus)) {
        $errors[] = "President-nominee aspirants must specify Rotary Leadership Institute (RLI) training status.";
    }
}

if (empty($proposerName) || empty($proposerRotaryId)) {
    $errors[] = "Proposer's Full Name and Rotary ID are required.";
}
if (empty($seconderName) || empty($seconderRotaryId)) {
    $errors[] = "Seconder's Full Name and Rotary ID are required.";
}
if (!$peacePact) {
    $errors[] = "You must agree to the Rotary Peace Pact and Election Code of Conduct.";
}
if (!$fourWayTest) {
    $errors[] = "You must affirm adherence to the Rotary Four-Way Test.";
}
if (empty($signatureData)) {
    $errors[] = "Digital signature or affirmation signature is required.";
}

// Rule: "No member shall contest for more than one office in the same election."
$checkStmt = $pdo->prepare("SELECT id, position, ref_no FROM nominations WHERE (rotary_id = :rotary_id OR email = :email) AND screening_status != 'DISQUALIFIED' LIMIT 1");
$checkStmt->execute([':rotary_id' => $rotaryId, ':email' => $email]);
$existing = $checkStmt->fetch();

if ($existing) {
    $errors[] = "According to Election Guidelines, no member shall contest for more than one office in the same election. An active nomination ({$existing['ref_no']}) has already been registered for Rotary ID {$rotaryId} for the office of '{$existing['position']}'.";
}

// File uploads handling
$uploadBase = __DIR__ . '/../uploads';
$refNo = generateReferenceNumber();

function handleUpload($fileKey, $prefix, $allowedExts, $maxSizeMb = 10, $isRequired = false) {
    global $errors, $uploadBase, $refNo;

    if (!isset($_FILES[$fileKey]) || $_FILES[$fileKey]['error'] === UPLOAD_ERR_NO_FILE) {
        if ($isRequired) {
            $errors[] = "Required document '{$fileKey}' was not uploaded.";
        }
        return null;
    }

    $file = $_FILES[$fileKey];

    if ($file['error'] !== UPLOAD_ERR_OK) {
        $errors[] = "Error uploading {$fileKey}. Code: " . $file['error'];
        return null;
    }

    if ($file['size'] > ($maxSizeMb * 1024 * 1024)) {
        $errors[] = "File {$fileKey} exceeds maximum allowed size of {$maxSizeMb}MB.";
        return null;
    }

    $origExt = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($origExt, $allowedExts)) {
        $errors[] = "Invalid file type for {$fileKey}. Allowed extensions: " . implode(', ', $allowedExts);
        return null;
    }

    $cleanExt = $origExt;
    $filename = $prefix . '_' . preg_replace('/[^a-zA-Z0-9_-]/', '', $refNo) . '_' . time() . '.' . $cleanExt;
    $destination = $uploadBase . DIRECTORY_SEPARATOR . $filename;

    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        $errors[] = "Failed to store uploaded file for {$fileKey}.";
        return null;
    }

    return 'uploads/' . $filename;
}

// 1. Passport Photo (Mandatory)
$passportPhotoPath = handleUpload('passport_photo', 'photo', ['jpg', 'jpeg', 'png', 'webp'], 5, true);

// 2. Evidence of Payment of Dues (Mandatory)
$duesEvidencePath = handleUpload('dues_evidence', 'dues', ['jpg', 'jpeg', 'png', 'pdf'], 10, true);

// 3. Manifesto File (Optional if summary provided, but recommended)
$manifestoFilePath = handleUpload('manifesto_file', 'manifesto', ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png'], 10, false);

// 4. Additional File (Optional)
$additionalFilePath = handleUpload('additional_file', 'doc', ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png'], 10, false);

if (empty($manifestoSummary) && empty($manifestoFilePath)) {
    $errors[] = "Please provide either a One-Page Manifesto upload or enter a Manifesto Summary.";
}

if (!empty($errors)) {
    // Clean up any uploaded files if form had errors
    if ($passportPhotoPath && file_exists(__DIR__ . '/../' . $passportPhotoPath)) @unlink(__DIR__ . '/../' . $passportPhotoPath);
    if ($duesEvidencePath && file_exists(__DIR__ . '/../' . $duesEvidencePath)) @unlink(__DIR__ . '/../' . $duesEvidencePath);
    if ($manifestoFilePath && file_exists(__DIR__ . '/../' . $manifestoFilePath)) @unlink(__DIR__ . '/../' . $manifestoFilePath);
    if ($additionalFilePath && file_exists(__DIR__ . '/../' . $additionalFilePath)) @unlink(__DIR__ . '/../' . $additionalFilePath);

    echo json_encode([
        'success' => false,
        'errors' => $errors,
        'message' => 'Validation failed. Please review the highlighted issues.'
    ]);
    exit;
}

// Save to Database
try {
    $stmt = $pdo->prepare("
        INSERT INTO nominations (
            ref_no, title, full_name, rotary_id, email, phone, classification, years_in_club,
            position, board_experience, rli_status,
            proposer_name, proposer_rotary_id, proposer_phone, proposer_email,
            seconder_name, seconder_rotary_id, seconder_phone, seconder_email,
            manifesto_summary, passport_photo, dues_evidence, manifesto_file, additional_file,
            signature_data, peace_pact_accepted, four_way_test_accepted, screening_status, created_at
        ) VALUES (
            :ref_no, :title, :full_name, :rotary_id, :email, :phone, :classification, :years_in_club,
            :position, :board_experience, :rli_status,
            :proposer_name, :proposer_rotary_id, :proposer_phone, :proposer_email,
            :seconder_name, :seconder_rotary_id, :seconder_phone, :seconder_email,
            :manifesto_summary, :passport_photo, :dues_evidence, :manifesto_file, :additional_file,
            :signature_data, :peace_pact_accepted, :four_way_test_accepted, 'PENDING', datetime('now', 'localtime')
        )
    ");

    $stmt->execute([
        ':ref_no' => $refNo,
        ':title' => $title,
        ':full_name' => $fullName,
        ':rotary_id' => $rotaryId,
        ':email' => $email,
        ':phone' => $phone,
        ':classification' => $classification,
        ':years_in_club' => $yearsInClub,
        ':position' => $position,
        ':board_experience' => $boardExperience,
        ':rli_status' => $rliStatus,
        ':proposer_name' => $proposerName,
        ':proposer_rotary_id' => $proposerRotaryId,
        ':proposer_phone' => $proposerPhone,
        ':proposer_email' => $proposerEmail,
        ':seconder_name' => $seconderName,
        ':seconder_rotary_id' => $seconderRotaryId,
        ':seconder_phone' => $seconderPhone,
        ':seconder_email' => $seconderEmail,
        ':manifesto_summary' => $manifestoSummary,
        ':passport_photo' => $passportPhotoPath,
        ':dues_evidence' => $duesEvidencePath,
        ':manifesto_file' => $manifestoFilePath,
        ':additional_file' => $additionalFilePath,
        ':signature_data' => $signatureData,
        ':peace_pact_accepted' => $peacePact,
        ':four_way_test_accepted' => $fourWayTest
    ]);

    $insertedId = $pdo->lastInsertId();

    echo json_encode([
        'success' => true,
        'message' => 'Expression of Interest Form successfully submitted!',
        'ref_no' => $refNo,
        'id' => $insertedId,
        'nominee' => [
            'name' => "{$title} {$fullName}",
            'rotary_id' => $rotaryId,
            'position' => $position,
            'email' => $email,
            'phone' => $phone,
            'created_at' => date('Y-m-d H:i:s'),
            'passport_photo' => $passportPhotoPath,
            'proposer' => $proposerName,
            'seconder' => $seconderName,
            'screening_status' => 'PENDING'
        ]
    ]);
} catch (Exception $e) {
    error_log("Insert error: " . $e->getMessage());
    echo json_encode([
        'success' => false,
        'error' => 'Database error occurred while processing submission: ' . $e->getMessage()
    ]);
}
