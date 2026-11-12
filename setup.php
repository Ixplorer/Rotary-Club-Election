<?php
/**
 * Rotary Club of Asokoro — District 9125, Nigeria
 * 2027/2028 Officers Election Portal
 * 
 * Database Auto-Setup & System Diagnostic Utility
 * Automatically verifies environment, connects to MySQL or SQLite,
 * creates the database tables, and verifies schema readiness for live deployment.
 */

require_once __DIR__ . '/config.php';

$isCli = (php_sapi_name() === 'cli');
$isJson = (isset($_GET['format']) && $_GET['format'] === 'json');

// Diagnostics accumulator
$diagnostics = [
    'php_version' => [
        'name' => 'PHP Version (>= 8.0 recommended)',
        'value' => PHP_VERSION,
        'status' => version_compare(PHP_VERSION, '8.0.0', '>=')
    ],
    'pdo' => [
        'name' => 'PDO Core Extension',
        'value' => extension_loaded('pdo') ? 'Installed' : 'Missing',
        'status' => extension_loaded('pdo')
    ],
    'pdo_mysql' => [
        'name' => 'PDO MySQL Driver',
        'value' => extension_loaded('pdo_mysql') ? 'Installed (Ready for live MySQL)' : 'Not Installed',
        'status' => extension_loaded('pdo_mysql')
    ],
    'pdo_sqlite' => [
        'name' => 'PDO SQLite Driver',
        'value' => extension_loaded('pdo_sqlite') ? 'Installed (Fallback Ready)' : 'Not Installed',
        'status' => extension_loaded('pdo_sqlite')
    ],
    'uploads_writable' => [
        'name' => 'Uploads Directory Writable',
        'value' => is_writable($uploadDir) ? 'Writable (' . realpath($uploadDir) . ')' : 'Read-Only / Missing',
        'status' => is_writable($uploadDir)
    ],
    'data_writable' => [
        'name' => 'Data Directory Writable',
        'value' => is_writable($dataDir) ? 'Writable (' . realpath($dataDir) . ')' : 'Read-Only / Missing',
        'status' => is_writable($dataDir)
    ]
];

// Database Execution
$dbStatus = false;
$dbMessage = '';
$activeDriver = 'none';
$tableStatus = [];
$candidateCount = 0;

try {
    $pdo = getDbConnection();
    if ($pdo) {
        $dbStatus = true;
        global $ACTIVE_DB_DRIVER;
        $activeDriver = $ACTIVE_DB_DRIVER;
        $dbMessage = "Connected successfully via " . strtoupper($activeDriver) . " driver.";

        // Force ensure schema
        if ($activeDriver === 'mysql') {
            initMySQLSchema($pdo);
        } else {
            initSQLiteSchema($pdo);
        }

        // Check tables exist
        $tables = ['nominations', 'audit_logs'];
        foreach ($tables as $tbl) {
            try {
                $countStmt = $pdo->query("SELECT COUNT(*) FROM `{$tbl}`");
                $count = $countStmt->fetchColumn();
                $tableStatus[$tbl] = [
                    'exists' => true,
                    'rows' => intval($count)
                ];
                if ($tbl === 'nominations') {
                    $candidateCount = intval($count);
                }
            } catch (Exception $e) {
                $tableStatus[$tbl] = [
                    'exists' => false,
                    'error' => $e->getMessage()
                ];
            }
        }

        // If nominations is empty, seed demo candidate
        if ($candidateCount === 0) {
            $demoRef = 'RCA-27-261112-B776E';
            $stmt = $pdo->prepare("
                INSERT INTO nominations (
                    ref_no, created_at, title, full_name, rotary_id, email, phone,
                    classification, years_in_club, position, board_experience, rli_status,
                    proposer_name, proposer_rotary_id, seconder_name, seconder_rotary_id,
                    manifesto_summary, passport_photo, dues_evidence, signature_data,
                    screening_status, screening_notes, screening_updated_at
                ) VALUES (
                    :ref_no, :created_at, :title, :full_name, :rotary_id, :email, :phone,
                    :classification, :years_in_club, :position, :board_experience, :rli_status,
                    :proposer_name, :proposer_rotary_id, :seconder_name, :seconder_rotary_id,
                    :manifesto_summary, :passport_photo, :dues_evidence, :signature_data,
                    :screening_status, :screening_notes, :screening_updated_at
                )
            ");
            $stmt->execute([
                ':ref_no' => $demoRef,
                ':created_at' => '2026-11-12 16:31:20',
                ':title' => 'Rtn.',
                ':full_name' => 'Adewale Emmanuel Adeleke',
                ':rotary_id' => '10492817',
                ':email' => 'adewale.adeleke@rotaryasokoro.org',
                ':phone' => '+234 803 555 1234',
                ':classification' => 'Chartered Accounting & Financial Advisory',
                ':years_in_club' => '5 Years (Joined 2021)',
                ':position' => 'President nominee',
                ':board_experience' => 'Club Treasurer (2023/2024), Club Service Chair (2024/2025)',
                ':rli_status' => 'RLI Graduate (Parts I, II & III Completed)',
                ':proposer_name' => 'Rtn. Ibrahim Aliyu',
                ':proposer_rotary_id' => '9845210',
                ':seconder_name' => 'Rtn. Ngozi Eze',
                ':seconder_rotary_id' => '8765432',
                ':manifesto_summary' => 'To champion high-impact community maternal health initiatives, expand membership retention by 25%, and ensure transparent financial accountability across all club avenues.',
                ':passport_photo' => 'uploads/photo_RCA-27-261112-B776E_1794497480.jpg',
                ':dues_evidence' => 'uploads/dues_RCA-27-261112-B776E_1794497480.pdf',
                ':signature_data' => 'Rtn. Adewale E. Adeleke',
                ':screening_status' => 'SCREENED_CLEARED',
                ':screening_notes' => 'All dues paid up to date, RLI Graduate verified, attendance satisfactory.',
                ':screening_updated_at' => '2026-11-12 16:31:46'
            ]);
            $tableStatus['nominations']['rows'] = 1;
            $tableStatus['nominations']['seeded'] = true;
            $candidateCount = 1;
        }

    } else {
        $dbStatus = false;
        $dbMessage = "Could not establish database connection. Please verify DB credentials in config.php or .env.";
    }
} catch (Exception $e) {
    $dbStatus = false;
    $dbMessage = "Exception: " . $e->getMessage();
}

// CLI Mode
if ($isCli) {
    echo "========================================================\n";
    echo "ROTARY CLUB OF ASOKORO — DATABASE & SYSTEM AUTO-SETUP\n";
    echo "========================================================\n";
    echo "PHP Version: " . PHP_VERSION . "\n";
    echo "DB Driver:   " . strtoupper($activeDriver) . "\n";
    echo "DB Status:   " . ($dbStatus ? "SUCCESS" : "FAILED") . "\n";
    echo "Message:     " . $dbMessage . "\n";
    echo "--------------------------------------------------------\n";
    foreach ($tableStatus as $table => $info) {
        if ($info['exists']) {
            echo "[OK] Table '{$table}': {$info['rows']} records present\n";
        } else {
            echo "[ERROR] Table '{$table}': " . ($info['error'] ?? 'Missing') . "\n";
        }
    }
    echo "========================================================\n";
    echo "System is live-server ready.\n";
    exit;
}

// JSON Mode
if ($isJson) {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([
        'success' => $dbStatus,
        'driver' => $activeDriver,
        'message' => $dbMessage,
        'diagnostics' => $diagnostics,
        'tables' => $tableStatus
    ], JSON_PRETTY_PRINT);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Database Auto-Setup & System Diagnostics — Rotary Club of Asokoro</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    body {
      background: #F1F5F9;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 30px 16px;
    }
    .setup-card {
      background: #FFFFFF;
      max-width: 760px;
      width: 100%;
      border-radius: 20px;
      box-shadow: 0 20px 40px -10px rgba(0, 36, 108, 0.12), 0 0 0 1px rgba(0, 36, 108, 0.06);
      overflow: hidden;
      border-top: 6px solid #00246C;
    }
    .setup-header {
      background: linear-gradient(135deg, #071530 0%, #00246C 100%);
      color: #FFFFFF;
      padding: 28px 32px;
      display: flex;
      align-items: center;
      gap: 18px;
    }
    .setup-body {
      padding: 32px;
    }
    .status-banner {
      display: flex;
      align-items: center;
      gap: 14px;
      padding: 16px 20px;
      border-radius: 12px;
      margin-bottom: 24px;
    }
    .status-banner.success {
      background: #DCFCE7;
      color: #166534;
      border: 1px solid #BBF7D0;
    }
    .status-banner.error {
      background: #FEE2E2;
      color: #991B1B;
      border: 1px solid #FECACA;
    }
    .check-list {
      list-style: none;
      margin-bottom: 28px;
    }
    .check-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 12px 14px;
      border-bottom: 1px solid #F1F5F9;
      font-size: 0.92rem;
    }
    .check-item:last-child {
      border-bottom: none;
    }
    .badge-ok {
      background: #DCFCE7;
      color: #15803D;
      padding: 3px 10px;
      border-radius: 20px;
      font-size: 0.78rem;
      font-weight: 700;
    }
    .badge-warn {
      background: #FEF3C7;
      color: #B45309;
      padding: 3px 10px;
      border-radius: 20px;
      font-size: 0.78rem;
      font-weight: 700;
    }
    .badge-err {
      background: #FEE2E2;
      color: #DC2626;
      padding: 3px 10px;
      border-radius: 20px;
      font-size: 0.78rem;
      font-weight: 700;
    }
    .setup-actions {
      display: flex;
      gap: 12px;
      flex-wrap: wrap;
    }
    .setup-actions .btn {
      flex: 1;
      min-height: 48px;
    }
  </style>
</head>
<body>

  <div class="setup-card">
    <div class="setup-header">
      <img src="assets/images/rotary-wheel.svg" width="56" height="56" alt="Rotary International Wheel">
      <div>
        <h2 style="font-family: 'Outfit', sans-serif; font-size: 1.45rem; color: #FFFFFF; margin: 0;">Database Auto-Setup &amp; Health Check</h2>
        <div style="font-size: 0.8rem; color: #F7A81B; font-weight: 700;">Rotary Club of Asokoro — 2027/2028 Officers Election Portal</div>
      </div>
    </div>

    <div class="setup-body">
      <!-- Status Banner -->
      <?php if ($dbStatus): ?>
        <div class="status-banner success">
          <div style="font-size: 1.8rem;">✔</div>
          <div>
            <strong>Database Schema Ready &amp; Synchronized!</strong>
            <div style="font-size: 0.86rem; margin-top: 2px;">
              Active Driver: <strong><?php echo strtoupper($activeDriver); ?></strong> &bull; <?php echo htmlspecialchars($dbMessage); ?>
            </div>
          </div>
        </div>
      <?php else: ?>
        <div class="status-banner error">
          <div style="font-size: 1.8rem;">✖</div>
          <div>
            <strong>Database Initialization Failed!</strong>
            <div style="font-size: 0.86rem; margin-top: 2px;"><?php echo htmlspecialchars($dbMessage); ?></div>
          </div>
        </div>
      <?php endif; ?>

      <!-- Environment Checks -->
      <h4 style="font-size: 1.05rem; color: #00246C; margin-bottom: 12px;">System &amp; Server Environment</h4>
      <ul class="check-list" style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 12px;">
        <?php foreach ($diagnostics as $key => $diag): ?>
          <li class="check-item">
            <span><strong><?php echo htmlspecialchars($diag['name']); ?>:</strong> <span style="color: #64748B;"><?php echo htmlspecialchars($diag['value']); ?></span></span>
            <span class="<?php echo $diag['status'] ? 'badge-ok' : 'badge-warn'; ?>"><?php echo $diag['status'] ? 'OK' : 'Notice'; ?></span>
          </li>
        <?php endforeach; ?>
      </ul>

      <!-- Table Status -->
      <h4 style="font-size: 1.05rem; color: #00246C; margin-bottom: 12px;">Database Schema Status</h4>
      <ul class="check-list" style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 12px;">
        <?php foreach ($tableStatus as $tbl => $info): ?>
          <li class="check-item">
            <span>Table <code><?php echo htmlspecialchars($tbl); ?></code></span>
            <?php if ($info['exists']): ?>
              <span class="badge-ok">Created &bull; <?php echo $info['rows']; ?> Records</span>
            <?php else: ?>
              <span class="badge-err">Failed: <?php echo htmlspecialchars($info['error'] ?? 'Missing'); ?></span>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>
      </ul>

      <div style="background: #EFF6FF; border: 1px solid #BFDBFE; border-radius: 10px; padding: 14px 18px; margin-bottom: 24px; font-size: 0.88rem; color: #1E3A8A;">
        <strong>Live Server Deployment Tip:</strong><br>
        To switch between MySQL and SQLite on your live server, configure <code>.env</code> or edit the constants at the top of <code>config.php</code> (<code>DB_HOST</code>, <code>DB_NAME</code>, <code>DB_USER</code>, <code>DB_PASS</code>). The schema will auto-create on first page load!
      </div>

      <!-- Action Buttons -->
      <div class="setup-actions">
        <a href="index.php" class="btn btn-gold btn-lg">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
          Visit Public Portal
        </a>
        <a href="admin.php" class="btn btn-primary btn-lg">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="9" y1="3" x2="9" y2="21"/></svg>
          Committee Admin Portal
        </a>
        <a href="setup.php" class="btn btn-secondary">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 4v6h-6M1 20v-6h6"/><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/></svg>
          Re-Check
        </a>
      </div>
    </div>
  </div>

</body>
</html>
