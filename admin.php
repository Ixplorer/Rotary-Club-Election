<?php
/**
 * ROTARY CLUB OF ASOKORO — District 9125, Nigeria
 * 2027/2028 OFFICERS ELECTION COMMITTEE ADMIN PORTAL
 */

session_start();
require_once __DIR__ . '/config.php';

// Passkey verification
$isLoggedIn = false;
$loginError = '';

if (isset($_POST['admin_passkey'])) {
    if (trim($_POST['admin_passkey']) === ADMIN_PASSKEY) {
        $_SESSION['admin_auth'] = ADMIN_PASSKEY;
        $isLoggedIn = true;
    } else {
        $loginError = 'Invalid Electoral Committee Passkey. Please try again.';
    }
} elseif (isset($_SESSION['admin_auth']) && $_SESSION['admin_auth'] === ADMIN_PASSKEY) {
    $isLoggedIn = true;
}

if (isset($_GET['logout'])) {
    unset($_SESSION['admin_auth']);
    header('Location: admin.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Electoral Committee Administration Portal — Rotary Club of Asokoro</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    body {
      background: #F8FAFC;
    }
    .admin-header {
      background: #00246C;
      color: white;
      padding: 20px 0;
      border-bottom: 3px solid #F7A81B;
    }
    .admin-stats-grid {
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      gap: 16px;
      margin: 30px 0;
    }
    .stat-box {
      background: white;
      border-radius: var(--radius-md);
      padding: 20px;
      border: 1px solid var(--border-light);
      box-shadow: var(--shadow-sm);
    }
    .stat-val {
      font-family: 'Outfit', sans-serif;
      font-size: 2rem;
      font-weight: 800;
      color: var(--rotary-blue);
      line-height: 1;
    }
    .stat-lbl {
      font-size: 0.78rem;
      font-weight: 700;
      color: var(--text-muted);
      text-transform: uppercase;
      margin-top: 6px;
    }
    .data-table-card {
      background: white;
      border-radius: var(--radius-lg);
      border: 1px solid var(--border-light);
      box-shadow: var(--shadow-md);
      overflow: hidden;
      margin-bottom: 40px;
    }
    .table-toolbar {
      padding: 18px 24px;
      background: #FFFFFF;
      border-bottom: 1px solid var(--border-light);
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 16px;
      flex-wrap: wrap;
    }
    .candidate-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 0.88rem;
    }
    .candidate-table th {
      background: #F8FAFC;
      color: #475569;
      font-weight: 700;
      text-transform: uppercase;
      font-size: 0.74rem;
      letter-spacing: 0.5px;
      padding: 12px 18px;
      text-align: left;
      border-bottom: 1px solid var(--border-light);
    }
    .candidate-table td {
      padding: 14px 18px;
      border-bottom: 1px solid var(--border-light);
      vertical-align: middle;
    }
    .candidate-table tr:hover td {
      background: #F8FAFC;
    }
    .cand-thumb {
      width: 44px;
      height: 48px;
      border-radius: 6px;
      object-fit: cover;
      background: #E2E8F0;
    }
    .login-container {
      max-width: 440px;
      margin: 80px auto;
      background: white;
      border-radius: var(--radius-xl);
      padding: 40px;
      box-shadow: var(--shadow-lg);
      border: 1px solid var(--border-light);
      text-align: center;
    }
    @media (max-width: 1024px) {
      .admin-stats-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }
    @media (max-width: 768px) {
      .admin-nav-inner {
        flex-direction: column !important;
        gap: 12px;
        text-align: center;
      }
      .admin-brand {
        flex-direction: column !important;
        gap: 8px !important;
        align-items: center !important;
        text-align: center !important;
      }
      .admin-stats-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
      }
      .table-toolbar {
        flex-direction: column;
        align-items: stretch !important;
        gap: 12px;
      }
      .table-toolbar select, .table-toolbar input {
        max-width: 100% !important;
        width: 100% !important;
      }
      .candidate-table {
        min-width: 680px;
      }
      .login-container {
        margin: 40px auto;
        padding: 24px 18px;
      }
    }
    @media (max-width: 480px) {
      .admin-stats-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>

  <!-- Admin Navigation -->
  <header class="admin-header">
    <div class="container admin-nav-inner" style="display: flex; justify-content: space-between; align-items: center;">
      <div class="admin-brand" style="display: flex; align-items: center; gap: 14px;">
        <img src="assets/images/rotary-wheel.svg" width="48" height="48" alt="Rotary International Wheel">
        <div>
          <h2 style="font-size: 1.2rem; color: white; margin: 0; line-height: 1.15;">Rotary Club of Asokoro</h2>
          <div style="font-size: 0.76rem; color: #F7A81B; font-weight: 700;">Electoral Committee Administration &amp; Screening Portal</div>
        </div>
      </div>

      <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap; justify-content: center;">
        <a href="index.php" class="btn btn-secondary btn-sm" style="background: rgba(255,255,255,0.15); color: white; border-color: rgba(255,255,255,0.3);">
          &larr; Public Portal
        </a>
        <?php if ($isLoggedIn): ?>
          <a href="admin.php?logout=1" class="btn btn-secondary btn-sm">Log Out</a>
        <?php endif; ?>
      </div>
    </div>
  </header>

  <?php if (!$isLoggedIn): ?>
    <!-- Passkey Login Box -->
    <div class="container">
      <div class="login-container">
        <img src="assets/images/rotary-wheel.svg" width="64" height="64" style="margin: 0 auto 16px auto;" alt="Rotary Emblem">
        <h3 style="font-size: 1.45rem; color: #00246C; margin-bottom: 6px;">Committee Access</h3>
        <p style="font-size: 0.88rem; color: #64748B; margin-bottom: 24px;">
          This portal is restricted to members of the Electoral Committee for screening and verification.
        </p>

        <?php if (!empty($loginError)): ?>
          <div style="background: #FEE2E2; color: #DC2626; padding: 10px 14px; border-radius: 6px; font-size: 0.85rem; margin-bottom: 18px;">
            <?php echo htmlspecialchars($loginError); ?>
          </div>
        <?php endif; ?>

        <form method="POST" action="admin.php">
          <div class="form-group" style="text-align: left;">
            <label class="form-label" for="admin_passkey">Committee Passkey</label>
            <input type="password" name="admin_passkey" id="admin_passkey" class="form-control" placeholder="Enter passkey (default: asokoro2027)" required autofocus>
          </div>
          <button type="submit" class="btn btn-primary btn-lg" style="width: 100%; margin-top: 10px;">
            Unlock Committee Portal
          </button>
        </form>
      </div>
    </div>
  <?php else: ?>
    <!-- Logged in Admin Dashboard -->
    <main class="container" style="padding-top: 24px;">
      
      <!-- Welcome Header -->
      <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 16px; margin-bottom: 10px;">
        <div>
          <h1 style="font-size: 1.8rem; color: #00246C;">Candidate Screening &amp; Nominations Roster</h1>
          <p style="color: #64748B; font-size: 0.95rem;">
            Official Registry of Expressions of Interest for the 2027/2028 Rotary Year.
          </p>
        </div>

        <div style="display: flex; gap: 10px;">
          <a href="api/admin_actions.php?action=export_csv" class="btn btn-secondary">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
            Export to Excel / CSV
          </a>
          <button onclick="window.print()" class="btn btn-primary">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9V2h12v7M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><path d="M6 14h12v8H6z"/></svg>
            Print Screening Roster
          </button>
        </div>
      </div>

      <!-- Quick Stats -->
      <div class="admin-stats-grid" id="stats-grid">
        <div class="stat-box">
          <div class="stat-val" id="stat-total">0</div>
          <div class="stat-lbl">Total Submissions</div>
        </div>
        <div class="stat-box">
          <div class="stat-val" id="stat-pending" style="color: #D97706;">0</div>
          <div class="stat-lbl">Pending Screening</div>
        </div>
        <div class="stat-box">
          <div class="stat-val" id="stat-cleared" style="color: #16A34A;">0</div>
          <div class="stat-lbl">Cleared Candidates</div>
        </div>
        <div class="stat-box">
          <div class="stat-val" id="stat-disqualified" style="color: #DC2626;">0</div>
          <div class="stat-lbl">Disqualified</div>
        </div>
        <div class="stat-box">
          <div class="stat-val" id="stat-pres" style="color: #B45309;">0</div>
          <div class="stat-lbl">President Nominee</div>
        </div>
      </div>

      <!-- Main Table Card -->
      <div class="data-table-card">
        <!-- Toolbar Filters -->
        <div class="table-toolbar">
          <div style="display: flex; gap: 12px; flex-wrap: wrap; flex-grow: 1;">
            <select id="filter-position" class="form-control" style="max-width: 240px;">
              <option value="">All Offices (All 8)</option>
              <?php foreach ($ELECTABLE_OFFICES as $oKey => $oVal): ?>
                <option value="<?php echo htmlspecialchars($oKey); ?>"><?php echo htmlspecialchars($oKey); ?></option>
              <?php endforeach; ?>
            </select>

            <select id="filter-status" class="form-control" style="max-width: 200px;">
              <option value="">All Statuses</option>
              <option value="PENDING">Pending Screening</option>
              <option value="SCREENED_CLEARED">Screened &amp; Cleared</option>
              <option value="PROVISIONAL">Provisionally Cleared</option>
              <option value="DISQUALIFIED">Disqualified</option>
            </select>

            <input type="text" id="admin-search" class="form-control" placeholder="Search candidate, ID, ref no..." style="max-width: 280px;">
          </div>

          <div>
            <button id="refresh-btn" class="btn btn-secondary btn-sm">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 4v6h-6M1 20v-6h6"/><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/></svg>
              Refresh
            </button>
          </div>
        </div>

        <!-- Table -->
        <div style="overflow-x: auto;">
          <table class="candidate-table">
            <thead>
              <tr>
                <th style="width: 50px;">Photo</th>
                <th>Candidate Details</th>
                <th>Office Contesting</th>
                <th>Proposer / Seconder</th>
                <th>Submitted</th>
                <th>Status</th>
                <th style="text-align: right;">Screening Actions</th>
              </tr>
            </thead>
            <tbody id="candidate-table-body">
              <tr>
                <td colspan="7" style="text-align: center; padding: 40px; color: #64748B;">Loading candidates...</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </main>

    <!-- Detail / Screening Modal -->
    <div class="modal-backdrop" id="detail-modal">
      <div class="modal-dialog" style="max-width: 760px; text-align: left;">
        <div class="modal-body" style="text-align: left; padding: 30px;">
          <div style="display: flex; justify-content: space-between; align-items: flex-start; border-bottom: 1px solid var(--border-light); padding-bottom: 14px; margin-bottom: 20px;">
            <div>
              <span id="m-ref" style="font-family: monospace; font-size: 0.85rem; font-weight: 700; color: #64748B;"></span>
              <h3 id="m-name" style="font-size: 1.4rem; color: #00246C; margin: 4px 0 0 0;"></h3>
            </div>
            <button type="button" class="btn btn-secondary btn-sm close-modal">✕ Close</button>
          </div>

          <div style="display: grid; grid-template-columns: 120px 1fr; gap: 20px; margin-bottom: 20px;">
            <img id="m-photo" src="" alt="Candidate Photo" style="width: 120px; height: 140px; object-fit: cover; border-radius: 8px; border: 1px solid #CBD5E1;">
            
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; font-size: 0.88rem;">
              <div><strong>Office:</strong> <span id="m-pos" style="color: #B45309; font-weight: 700;"></span></div>
              <div><strong>Rotary ID:</strong> <span id="m-rotary-id"></span></div>
              <div><strong>Email:</strong> <span id="m-email"></span></div>
              <div><strong>Phone:</strong> <span id="m-phone"></span></div>
              <div><strong>Classification:</strong> <span id="m-class"></span></div>
              <div><strong>Tenure:</strong> <span id="m-tenure"></span></div>
              <div><strong>Proposer:</strong> <span id="m-prop"></span></div>
              <div><strong>Seconder:</strong> <span id="m-sec"></span></div>
            </div>
          </div>

          <!-- President Specific Info -->
          <div id="m-president-info" style="display: none; background: #FFFBEB; border: 1px solid #FDE68A; border-radius: 6px; padding: 12px; margin-bottom: 16px; font-size: 0.85rem;">
            <div><strong>Past Board Roles:</strong> <span id="m-board"></span></div>
            <div style="margin-top: 4px;"><strong>RLI Training:</strong> <span id="m-rli"></span></div>
          </div>

          <!-- Documents Links -->
          <div style="background: #F8FAFC; border: 1px solid var(--border-light); border-radius: 6px; padding: 12px 16px; margin-bottom: 20px; display: flex; gap: 14px; flex-wrap: wrap;">
            <a id="m-dues-link" href="#" target="_blank" class="btn btn-secondary btn-sm">📄 View Dues Receipt</a>
            <a id="m-manifesto-link" href="#" target="_blank" class="btn btn-secondary btn-sm">📝 View Full Manifesto</a>
            <a id="m-receipt-link" href="#" target="_blank" class="btn btn-primary btn-sm">🖨️ View Official Receipt</a>
          </div>

          <!-- Manifesto Text Summary -->
          <div style="margin-bottom: 20px;">
            <div style="font-size: 0.8rem; font-weight: 700; color: #64748B; text-transform: uppercase;">Manifesto Summary</div>
            <div id="m-manifesto-summary" style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 6px; padding: 10px 14px; font-size: 0.88rem; max-height: 120px; overflow-y: auto; margin-top: 4px;"></div>
          </div>

          <!-- Screening Decision Form -->
          <form id="screening-decision-form" style="background: #F1F5F9; border-radius: 8px; padding: 18px;">
            <input type="hidden" id="screening-candidate-id">
            <h4 style="font-size: 1rem; color: #00246C; margin-bottom: 10px;">Electoral Committee Screening Verdict</h4>

            <div class="form-row">
              <div class="form-group">
                <label class="form-label" for="decision-status">Screening Decision</label>
                <select id="decision-status" class="form-control" required>
                  <option value="PENDING">PENDING (Awaiting Review)</option>
                  <option value="SCREENED_CLEARED">CLEARED (Eligible to Contest)</option>
                  <option value="PROVISIONAL">PROVISIONAL (Conditional Clearance)</option>
                  <option value="DISQUALIFIED">DISQUALIFIED (Ineligible)</option>
                </select>
              </div>

              <div class="form-group">
                <label class="form-label" for="decision-notes">Committee Notes / Reasons</label>
                <input type="text" id="decision-notes" class="form-control" placeholder="e.g. Cleared after dues &amp; attendance check">
              </div>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 8px;">
              <button type="button" class="btn btn-secondary close-modal">Cancel</button>
              <button type="submit" class="btn btn-primary" id="save-decision-btn">Save Screening Verdict</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Admin JS -->
    <script>
      let currentRecords = [];

      document.addEventListener("DOMContentLoaded", function() {
        loadCandidates();

        document.getElementById("filter-position").addEventListener("change", loadCandidates);
        document.getElementById("filter-status").addEventListener("change", loadCandidates);
        document.getElementById("admin-search").addEventListener("input", debounce(loadCandidates, 300));
        document.getElementById("refresh-btn").addEventListener("click", loadCandidates);

        // Modal handlers
        document.querySelectorAll(".close-modal").forEach(b => {
          b.addEventListener("click", () => {
            document.getElementById("detail-modal").classList.remove("active");
          });
        });

        // Save screening verdict
        document.getElementById("screening-decision-form").addEventListener("submit", function(e) {
          e.preventDefault();
          const id = document.getElementById("screening-candidate-id").value;
          const status = document.getElementById("decision-status").value;
          const notes = document.getElementById("decision-notes").value;

          const fd = new FormData();
          fd.append("action", "update_status");
          fd.append("id", id);
          fd.append("status", status);
          fd.append("notes", notes);

          fetch("api/admin_actions.php", {
            method: "POST",
            body: fd
          })
          .then(r => r.json())
          .then(res => {
            if (res.success) {
              alert("Verdict updated successfully!");
              document.getElementById("detail-modal").classList.remove("active");
              loadCandidates();
            } else {
              alert(res.error || "Failed to update status.");
            }
          });
        });
      });

      function debounce(fn, ms) {
        let timer;
        return function(...args) {
          clearTimeout(timer);
          timer = setTimeout(() => fn.apply(this, args), ms);
        };
      }

      function loadCandidates() {
        const pos = document.getElementById("filter-position").value;
        const status = document.getElementById("filter-status").value;
        const search = document.getElementById("admin-search").value;

        const url = `api/admin_actions.php?action=list&position=${encodeURIComponent(pos)}&status=${encodeURIComponent(status)}&search=${encodeURIComponent(search)}`;

        fetch(url)
          .then(r => r.json())
          .then(res => {
            if (res.success) {
              currentRecords = res.records;
              updateStats(res.stats);
              renderTable(res.records);
            }
          });
      }

      function updateStats(stats) {
        if (!stats) return;
        document.getElementById("stat-total").textContent = stats.total || 0;
        document.getElementById("stat-pending").textContent = stats.pending || 0;
        document.getElementById("stat-cleared").textContent = stats.cleared || 0;
        document.getElementById("stat-disqualified").textContent = stats.disqualified || 0;
        document.getElementById("stat-pres").textContent = stats.pres_nominee || 0;
      }

      function renderTable(records) {
        const tbody = document.getElementById("candidate-table-body");
        if (!records || records.length === 0) {
          tbody.innerHTML = `<tr><td colspan="7" style="text-align: center; padding: 40px; color: #64748B;">No nominations found matching criteria.</td></tr>`;
          return;
        }

        tbody.innerHTML = records.map(c => {
          let statusBadge = "";
          if (c.screening_status === 'SCREENED_CLEARED') {
            statusBadge = `<span style="background: #DCFCE7; color: #16A34A; padding: 3px 10px; border-radius: 12px; font-weight: 700; font-size: 0.76rem;">✔ CLEARED</span>`;
          } else if (c.screening_status === 'DISQUALIFIED') {
            statusBadge = `<span style="background: #FEE2E2; color: #DC2626; padding: 3px 10px; border-radius: 12px; font-weight: 700; font-size: 0.76rem;">✖ DISQUALIFIED</span>`;
          } else if (c.screening_status === 'PROVISIONAL') {
            statusBadge = `<span style="background: #EFF6FF; color: #2563EB; padding: 3px 10px; border-radius: 12px; font-weight: 700; font-size: 0.76rem;">⏳ PROVISIONAL</span>`;
          } else {
            statusBadge = `<span style="background: #FEF3C7; color: #D97706; padding: 3px 10px; border-radius: 12px; font-weight: 700; font-size: 0.76rem;">PENDING</span>`;
          }

          const photoSrc = c.passport_photo || 'assets/images/rotary-wheel.svg';

          return `
            <tr>
              <td>
                <img src="${photoSrc}" class="cand-thumb" alt="Thumb">
              </td>
              <td>
                <div style="font-weight: 700; color: #00246C;">${c.title || ''} ${c.full_name}</div>
                <div style="font-size: 0.75rem; color: #64748B;">ID: <strong>${c.rotary_id}</strong> &bull; Ref: ${c.ref_no}</div>
                <div style="font-size: 0.74rem; color: #94A3B8;">${c.email} &bull; ${c.phone}</div>
              </td>
              <td>
                <span style="font-weight: 700; color: #B45309; background: #FEF3C7; padding: 2px 8px; border-radius: 4px; font-size: 0.8rem;">
                  ${c.position}
                </span>
              </td>
              <td style="font-size: 0.82rem;">
                <div><strong>P:</strong> ${c.proposer_name} (${c.proposer_rotary_id})</div>
                <div><strong>S:</strong> ${c.seconder_name} (${c.seconder_rotary_id})</div>
              </td>
              <td style="font-size: 0.8rem; color: #64748B;">
                ${c.created_at}
              </td>
              <td>${statusBadge}</td>
              <td style="text-align: right; white-space: nowrap;">
                <button onclick="openDetailModal(${c.id})" class="btn btn-secondary btn-sm" style="margin-right: 6px;">
                  Screen / Inspect
                </button>
                <a href="receipt.php?ref=${encodeURIComponent(c.ref_no)}" target="_blank" class="btn btn-outline btn-sm">
                  Receipt
                </a>
              </td>
            </tr>
          `;
        }).join("");
      }

      function openDetailModal(id) {
        const c = currentRecords.find(x => x.id == id);
        if (!c) return;

        document.getElementById("screening-candidate-id").value = c.id;
        document.getElementById("m-ref").textContent = c.ref_no;
        document.getElementById("m-name").textContent = `${c.title || ''} ${c.full_name}`;
        document.getElementById("m-pos").textContent = c.position;
        document.getElementById("m-rotary-id").textContent = c.rotary_id;
        document.getElementById("m-email").textContent = c.email;
        document.getElementById("m-phone").textContent = c.phone;
        document.getElementById("m-class").textContent = c.classification || 'N/A';
        document.getElementById("m-tenure").textContent = c.years_in_club || 'Active';
        document.getElementById("m-prop").textContent = `${c.proposer_name} (${c.proposer_rotary_id})`;
        document.getElementById("m-sec").textContent = `${c.seconder_name} (${c.seconder_rotary_id})`;

        document.getElementById("m-photo").src = c.passport_photo || 'assets/images/rotary-wheel.svg';

        // Links
        const duesLink = document.getElementById("m-dues-link");
        if (c.dues_evidence) {
          duesLink.href = c.dues_evidence;
          duesLink.style.display = "inline-flex";
        } else {
          duesLink.style.display = "none";
        }

        const manLink = document.getElementById("m-manifesto-link");
        if (c.manifesto_file) {
          manLink.href = c.manifesto_file;
          manLink.style.display = "inline-flex";
        } else {
          manLink.style.display = "none";
        }

        document.getElementById("m-receipt-link").href = "receipt.php?ref=" + encodeURIComponent(c.ref_no);
        document.getElementById("m-manifesto-summary").textContent = c.manifesto_summary || "No written summary provided.";

        // President conditional
        const presBox = document.getElementById("m-president-info");
        if (c.position === "President nominee") {
          presBox.style.display = "block";
          document.getElementById("m-board").textContent = c.board_experience || 'None specified';
          document.getElementById("m-rli").textContent = c.rli_status || 'None specified';
        } else {
          presBox.style.display = "none";
        }

        // Screening fields
        document.getElementById("decision-status").value = c.screening_status || 'PENDING';
        document.getElementById("decision-notes").value = c.screening_notes || '';

        document.getElementById("detail-modal").classList.add("active");
      }
    </script>
  <?php endif; ?>
</body>
</html>
