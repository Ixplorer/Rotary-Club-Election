<?php
/**
 * Standalone Official Acknowledgement Receipt Page
 * Rotary Club of Asokoro - District 9125, Nigeria
 */

require_once __DIR__ . '/config.php';

$ref = trim($_GET['ref'] ?? '');
$record = null;

if (!empty($ref)) {
    $pdo = getDbConnection();
    if ($pdo) {
        $stmt = $pdo->prepare("SELECT * FROM nominations WHERE UPPER(ref_no) = UPPER(:ref) LIMIT 1");
        $stmt->execute([':ref' => $ref]);
        $record = $stmt->fetch();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Acknowledgement Receipt — <?php echo htmlspecialchars($record ? $record['ref_no'] : 'Rotary Club of Asokoro'); ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
  <script src="assets/js/qrcode.min.js"></script>
  <style>
    body {
      background: #F1F5F9;
      padding: 30px 15px;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .receipt-container {
      max-width: 820px;
      width: 100%;
      margin: 0 auto;
    }
    .top-actions {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      gap: 12px;
      flex-wrap: wrap;
    }
    .receipt-paper {
      background: #FFFFFF;
      border-radius: 16px;
      padding: 48px;
      box-shadow: 0 20px 40px -10px rgba(0, 36, 108, 0.12), 0 0 0 1px rgba(0, 36, 108, 0.06);
      position: relative;
      overflow: hidden;
      border-top: 8px solid #00246C;
    }
    .receipt-paper::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(90deg, #F7A81B, #FFD363, #F7A81B);
    }
    .receipt-watermark {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%) rotate(-30deg);
      opacity: 0.035;
      pointer-events: none;
      width: 450px;
      height: 450px;
    }
    .receipt-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      border-bottom: 2px solid #E2E8F0;
      padding-bottom: 24px;
      margin-bottom: 28px;
      gap: 20px;
    }
    .receipt-title-block {
      text-align: center;
      margin-bottom: 28px;
    }
    .receipt-badge {
      display: inline-block;
      background: #EBF4FF;
      color: #00246C;
      font-weight: 700;
      font-size: 0.75rem;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      padding: 6px 16px;
      border-radius: 30px;
      margin-bottom: 8px;
      border: 1px solid #BFDBFE;
    }
    .receipt-title {
      font-family: 'Outfit', sans-serif;
      font-size: 1.6rem;
      font-weight: 800;
      color: #00246C;
      margin: 0;
    }
    .receipt-sub {
      color: #64748B;
      font-size: 0.95rem;
      margin-top: 4px;
    }
    .receipt-grid {
      display: grid;
      grid-template-columns: 140px 1fr 130px;
      gap: 24px;
      background: #F8FAFC;
      border: 1px solid #E2E8F0;
      border-radius: 12px;
      padding: 24px;
      margin-bottom: 28px;
    }
    .photo-frame {
      width: 140px;
      height: 160px;
      border-radius: 8px;
      overflow: hidden;
      border: 2px solid #CBD5E1;
      background: #E2E8F0;
      box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
    }
    .photo-frame img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .qr-frame {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
    }
    #receipt-qr {
      padding: 6px;
      background: white;
      border-radius: 8px;
      border: 1px solid #E2E8F0;
    }
    .qr-caption {
      font-size: 0.7rem;
      color: #64748B;
      margin-top: 6px;
      font-weight: 600;
    }
    .candidate-details {
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    .cand-name {
      font-family: 'Outfit', sans-serif;
      font-size: 1.35rem;
      font-weight: 800;
      color: #00246C;
      margin: 0 0 4px 0;
    }
    .cand-position {
      display: inline-block;
      font-size: 0.95rem;
      font-weight: 700;
      color: #B45309;
      background: #FEF3C7;
      padding: 3px 12px;
      border-radius: 6px;
      margin-bottom: 12px;
      border: 1px solid #FDE68A;
    }
    .info-list {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 8px 16px;
      font-size: 0.88rem;
    }
    .info-item {
      display: flex;
      flex-direction: column;
    }
    .info-label {
      font-size: 0.72rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      color: #64748B;
      font-weight: 600;
    }
    .info-val {
      color: #0F172A;
      font-weight: 600;
    }
    .section-title {
      font-family: 'Outfit', sans-serif;
      font-size: 1rem;
      font-weight: 700;
      color: #00246C;
      border-bottom: 1px solid #E2E8F0;
      padding-bottom: 6px;
      margin: 20px 0 12px 0;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .checklist-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 10px;
      margin-bottom: 24px;
    }
    .check-card {
      background: #F8FAFC;
      border: 1px solid #E2E8F0;
      border-radius: 8px;
      padding: 10px 14px;
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 0.85rem;
      font-weight: 600;
      color: #1E293B;
    }
    .check-icon {
      color: #16A34A;
      font-size: 1.1rem;
    }
    .endorsement-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
      background: #F8FAFC;
      border: 1px solid #E2E8F0;
      border-radius: 8px;
      padding: 14px;
      margin-bottom: 24px;
      font-size: 0.88rem;
    }
    .receipt-footer-signatures {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 16px;
      margin-top: 36px;
      padding-top: 20px;
      border-top: 2px dashed #CBD5E1;
      text-align: center;
    }
    .sig-block {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: flex-end;
    }
    .sig-line {
      width: 100%;
      height: 1px;
      background: #94A3B8;
      margin-bottom: 6px;
    }
    .sig-title {
      font-size: 0.78rem;
      font-weight: 700;
      color: #00246C;
    }
    .sig-sub {
      font-size: 0.7rem;
      color: #64748B;
    }
    .sig-img {
      max-height: 48px;
      max-width: 160px;
      margin-bottom: 4px;
    }
    .official-seal-badge {
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 10px 0;
    }
    .seal-circle {
      width: 80px;
      height: 80px;
      border: 3px double #00246C;
      border-radius: 50%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      color: #00246C;
      font-size: 0.65rem;
      font-weight: 800;
      text-align: center;
      line-height: 1.1;
      text-transform: uppercase;
      transform: rotate(-10deg);
      background: rgba(235, 244, 255, 0.4);
    }
    @media print {
      body {
        background: white;
        padding: 0;
      }
      .top-actions, .no-print {
        display: none !important;
      }
      .receipt-paper {
        box-shadow: none;
        border: 1px solid #CBD5E1;
        padding: 30px;
        page-break-inside: avoid;
      }
    }
    @media (max-width: 768px) {
      body {
        padding: 16px 10px;
      }
      .receipt-paper {
        padding: 24px 16px;
        border-radius: 12px;
      }
      .receipt-header {
        flex-direction: column;
        text-align: center;
        gap: 12px;
        padding-bottom: 18px;
        margin-bottom: 20px;
      }
      .receipt-title {
        font-size: 1.35rem;
      }
      .receipt-grid {
        grid-template-columns: 1fr;
        text-align: center;
        padding: 16px;
        gap: 16px;
      }
      .photo-frame {
        margin: 0 auto;
        width: 120px;
        height: 140px;
      }
      .info-list {
        grid-template-columns: 1fr;
        text-align: left;
      }
      .endorsement-row, .checklist-grid, .receipt-footer-signatures {
        grid-template-columns: 1fr;
        gap: 12px;
      }
      .top-actions {
        flex-direction: column;
        width: 100%;
        gap: 8px;
      }
      .top-actions .btn {
        width: 100%;
        min-height: 44px;
      }
    }
    @media (max-width: 480px) {
      body {
        padding: 10px 6px;
      }
      .receipt-paper {
        padding: 18px 12px;
      }
      .receipt-title {
        font-size: 1.2rem;
      }
      .receipt-sub {
        font-size: 0.85rem;
      }
      .check-card {
        font-size: 0.78rem;
        padding: 8px 10px;
      }
    }
  </style>
</head>
<body>

<div class="receipt-container">
  <div class="top-actions">
    <a href="index.php" class="btn btn-secondary">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
      Return to Election Portal
    </a>
    <div style="display: flex; gap: 10px;">
      <button onclick="window.print()" class="btn btn-primary">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9V2h12v7M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><path d="M6 14h12v8H6z"/></svg>
        Print Official Receipt
      </button>
      <button onclick="copyRefLink()" class="btn btn-outline" id="copyBtn">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
        Copy Tracking Link
      </button>
    </div>
  </div>

  <?php if (!$record): ?>
    <div class="receipt-paper" style="text-align: center; padding: 60px 20px;">
      <div style="font-size: 3rem; margin-bottom: 16px;">🔍</div>
      <h2 style="color: #00246C; font-family: 'Outfit', sans-serif;">Submission Not Found</h2>
      <p style="color: #64748B; max-width: 480px; margin: 0 auto 24px auto;">
        No active nomination was found with the specified reference number. Please check the reference or look up using your Rotary Member ID.
      </p>
      <a href="index.php#lookup" class="btn btn-primary">Go to Status Tracker</a>
    </div>
  <?php else: ?>
    <div class="receipt-paper" id="printableReceipt">
      <!-- Watermark Background -->
      <img src="assets/images/rotary-wheel.svg" class="receipt-watermark" alt="Rotary Seal Watermark">

      <!-- Official Letterhead Header -->
      <div class="receipt-header">
        <div style="display: flex; align-items: center; gap: 16px;">
          <img src="assets/images/rotary-wheel.svg" width="68" height="68" alt="Rotary International Wheel">
          <div>
            <h1 style="font-family: 'Outfit', sans-serif; font-size: 1.45rem; font-weight: 800; color: #00246C; margin: 0; line-height: 1.2;">
              ROTARY CLUB OF ASOKORO
            </h1>
            <div style="font-size: 0.85rem; font-weight: 700; color: #F7A81B; letter-spacing: 1px; margin-top: 2px;">
              DISTRICT 9125, NIGERIA &bull; THE PACE SETTER
            </div>
            <div style="font-size: 0.78rem; color: #64748B;">
              Chartered Club &bull; Service Above Self
            </div>
          </div>
        </div>

        <div style="text-align: right;">
          <div style="font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.5px; color: #64748B; font-weight: 600;">Tracking Reference</div>
          <div style="font-family: monospace; font-size: 1.15rem; font-weight: 800; color: #00246C; background: #F1F5F9; padding: 4px 10px; border-radius: 6px; display: inline-block; border: 1px solid #CBD5E1;">
            <?php echo htmlspecialchars($record['ref_no']); ?>
          </div>
          <div style="font-size: 0.75rem; color: #64748B; margin-top: 4px;">
            Submitted: <?php echo date('d M Y, h:i A', strtotime($record['created_at'])); ?>
          </div>
        </div>
      </div>

      <!-- Title Block -->
      <div class="receipt-title-block">
        <div class="receipt-badge">Official Election Committee Document</div>
        <h2 class="receipt-title">ACKNOWLEDGEMENT RECEIPT</h2>
        <div class="receipt-sub">Expression of Interest & Nomination for 2027/2028 Officers Election</div>
      </div>

      <!-- Candidate Main Card Grid -->
      <div class="receipt-grid">
        <!-- Photo -->
        <div class="photo-frame">
          <?php if (!empty($record['passport_photo']) && file_exists(__DIR__ . '/' . $record['passport_photo'])): ?>
            <img src="<?php echo htmlspecialchars($record['passport_photo']); ?>" alt="Nominee Photo">
          <?php else: ?>
            <div style="display: flex; height: 100%; align-items: center; justify-content: center; color: #94A3B8; font-size: 2rem;">👤</div>
          <?php endif; ?>
        </div>

        <!-- Details -->
        <div class="candidate-details">
          <h3 class="cand-name"><?php echo htmlspecialchars($record['title'] . ' ' . $record['full_name']); ?></h3>
          <div>
            <span class="cand-position">Office: <?php echo htmlspecialchars($record['position']); ?></span>
          </div>

          <div class="info-list">
            <div class="info-item">
              <span class="info-label">Rotary Member ID</span>
              <span class="info-val"><?php echo htmlspecialchars($record['rotary_id']); ?></span>
            </div>
            <div class="info-item">
              <span class="info-label">Classification / Profession</span>
              <span class="info-val"><?php echo htmlspecialchars($record['classification'] ?: 'Not Specified'); ?></span>
            </div>
            <div class="info-item">
              <span class="info-label">Mobile / WhatsApp</span>
              <span class="info-val"><?php echo htmlspecialchars($record['phone']); ?></span>
            </div>
            <div class="info-item">
              <span class="info-label">Email Address</span>
              <span class="info-val"><?php echo htmlspecialchars($record['email']); ?></span>
            </div>
            <div class="info-item">
              <span class="info-label">Years in Club</span>
              <span class="info-val"><?php echo htmlspecialchars($record['years_in_club'] ?: 'Active'); ?></span>
            </div>
            <div class="info-item">
              <span class="info-label">Screening Status</span>
              <span class="info-val" style="color: <?php 
                echo $record['screening_status'] === 'SCREENED_CLEARED' ? '#16A34A' : 
                    ($record['screening_status'] === 'DISQUALIFIED' ? '#DC2626' : '#D97706'); 
              ?>; font-weight: 700;">
                <?php 
                  switch ($record['screening_status']) {
                    case 'SCREENED_CLEARED': echo 'CLEARED & APPROVED'; break;
                    case 'PROVISIONAL': echo 'PROVISIONALLY CLEARED'; break;
                    case 'DISQUALIFIED': echo 'DISQUALIFIED'; break;
                    default: echo 'SUBMITTED (Awaiting Screening)'; break;
                  }
                ?>
              </span>
            </div>
          </div>
        </div>

        <!-- QR Code -->
        <div class="qr-frame">
          <div id="receipt-qr"></div>
          <div class="qr-caption">Scan to Verify Authenticity</div>
        </div>
      </div>

      <?php if ($record['position'] === 'President nominee'): ?>
        <div class="section-title">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
          President-Nominee Specific Eligibility Credentials
        </div>
        <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 12px 16px; margin-bottom: 24px; font-size: 0.88rem;">
          <div style="margin-bottom: 8px;"><strong>Past Board / Leadership Experience:</strong> <?php echo nl2br(htmlspecialchars($record['board_experience'])); ?></div>
          <div><strong>Rotary Leadership Training (RLI):</strong> <?php echo htmlspecialchars($record['rli_status']); ?></div>
        </div>
      <?php endif; ?>

      <!-- Proposer and Seconder -->
      <div class="section-title">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        Proposer &amp; Seconder Attestation (Members in Good Standing)
      </div>
      <div class="endorsement-row">
        <div>
          <div class="info-label">Proposer</div>
          <div style="font-weight: 700; color: #00246C; font-size: 1rem;"><?php echo htmlspecialchars($record['proposer_name']); ?></div>
          <div style="color: #64748B; font-size: 0.82rem;">Rotary ID: <strong><?php echo htmlspecialchars($record['proposer_rotary_id']); ?></strong></div>
          <div style="color: #16A34A; font-size: 0.78rem; font-weight: 600; margin-top: 4px;">✔ Good Financial Standing Verified</div>
        </div>
        <div>
          <div class="info-label">Seconder</div>
          <div style="font-weight: 700; color: #00246C; font-size: 1rem;"><?php echo htmlspecialchars($record['seconder_name']); ?></div>
          <div style="color: #64748B; font-size: 0.82rem;">Rotary ID: <strong><?php echo htmlspecialchars($record['seconder_rotary_id']); ?></strong></div>
          <div style="color: #16A34A; font-size: 0.78rem; font-weight: 600; margin-top: 4px;">✔ Good Financial Standing Verified</div>
        </div>
      </div>

      <!-- Checklist of Documents -->
      <div class="section-title">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
        Submitted Materials &amp; Compliance Checklist
      </div>
      <div class="checklist-grid">
        <div class="check-card">
          <span class="check-icon">✔</span>
          <span>Duly Completed Expression Form</span>
        </div>
        <div class="check-card">
          <span class="check-icon">✔</span>
          <span>Passport Photograph Uploaded</span>
        </div>
        <div class="check-card">
          <span class="check-icon">✔</span>
          <span>Evidence of Dues Payment Attached</span>
        </div>
        <div class="check-card">
          <span class="check-icon">✔</span>
          <span>One-Page Manifesto / Vision Summary</span>
        </div>
        <div class="check-card">
          <span class="check-icon">✔</span>
          <span>Rotary Peace Pact Affirmation</span>
        </div>
        <div class="check-card">
          <span class="check-icon">✔</span>
          <span>Adherence to The Four-Way Test</span>
        </div>
      </div>

      <!-- Election Day Reminder Notice -->
      <div style="background: #EFF6FF; border-left: 4px solid #00246C; padding: 14px 18px; border-radius: 0 8px 8px 0; font-size: 0.85rem; color: #1E3A8A; margin-bottom: 24px;">
        <strong>Important Timetable Note:</strong>
        Screening of nominated candidates shall hold on <strong>Saturday, 21st November, 2026</strong> between 11:00am and 2:00pm. 
        Final list of cleared candidates will be published on Sunday, 22nd November, 2026.
        Election takes place on <strong>Wednesday, 25th November, 2026</strong> at <strong>Stratton Suite, Asokoro, Abuja</strong> (Accreditation: 5:00pm – 6:00pm).
      </div>

      <!-- Official Signatures Block -->
      <div class="receipt-footer-signatures">
        <!-- Aspirant Signature -->
        <div class="sig-block">
          <?php if (!empty($record['signature_data']) && strpos($record['signature_data'], 'data:image') === 0): ?>
            <img src="<?php echo htmlspecialchars($record['signature_data']); ?>" class="sig-img" alt="Candidate Signature">
          <?php else: ?>
            <div style="font-family: 'Playfair Display', cursive; font-size: 1.1rem; color: #00246C; padding-bottom: 6px;">
              <?php echo htmlspecialchars($record['signature_data'] ?: $record['full_name']); ?>
            </div>
          <?php endif; ?>
          <div class="sig-line"></div>
          <div class="sig-title"><?php echo htmlspecialchars($record['full_name']); ?></div>
          <div class="sig-sub">Aspirant / Nominee Signature</div>
        </div>

        <!-- Official Seal -->
        <div class="sig-block">
          <div class="official-seal-badge">
            <div class="seal-circle">
              <span>Rotary<br>Asokoro<br>Electoral<br>Committee</span>
            </div>
          </div>
          <div class="sig-sub" style="font-weight: 700; color: #00246C;">OFFICIAL SEAL</div>
          <div class="sig-sub">Valid without Alteration</div>
        </div>

        <!-- Committee Chairman Signature -->
        <div class="sig-block">
          <div style="font-family: 'Playfair Display', cursive; font-size: 1.15rem; color: #00246C; padding-bottom: 6px; font-weight: 700;">
            Adegoke, S. A.
          </div>
          <div class="sig-line"></div>
          <div class="sig-title"><?php echo htmlspecialchars(COMMITTEE_CHAIRMAN); ?></div>
          <div class="sig-sub">Chairman, Electoral Committee</div>
        </div>
      </div>
    </div>
  <?php endif; ?>
</div>

<script>
  // Render verification QR Code
  document.addEventListener("DOMContentLoaded", function() {
    <?php if ($record): ?>
      const qrEl = document.getElementById("receipt-qr");
      if (qrEl) {
        const verifyUrl = window.location.origin + window.location.pathname + "?ref=<?php echo urlencode($record['ref_no']); ?>";
        new QRCode(qrEl, {
          text: verifyUrl,
          width: 90,
          height: 90,
          colorDark : "#00246C",
          colorLight : "#ffffff",
          correctLevel : QRCode.CorrectLevel.M
        });
      }
    <?php endif; ?>
  });

  function copyRefLink() {
    const url = window.location.href;
    navigator.clipboard.writeText(url).then(() => {
      const btn = document.getElementById("copyBtn");
      const orig = btn.innerHTML;
      btn.innerHTML = "✔ Link Copied!";
      setTimeout(() => { btn.innerHTML = orig; }, 2500);
    });
  }
</script>
</body>
</html>
