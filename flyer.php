<?php
/**
 * Rotary Club of Asokoro — District 9125, Nigeria
 * 2027/2028 Officers Election — Official Election Guideline & Procedure Infographic Flyer
 * Modeled after the official election procedure infographic format with a central serpentine roadmap,
 * alternating numbered step nodes, QR code, and direct link to https://bit.ly/4AjHI16.
 */
require_once __DIR__ . '/config.php';

$shortUrl = "https://bit.ly/4AjHI16";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Election Guideline & Procedure Flyer — Rotary Club of Asokoro</title>
  <meta name="description" content="Official Step-by-Step Election Guideline and Voting Procedure Infographic for the 2027/2028 Rotary Club of Asokoro Officers Election. Scan QR code or visit https://bit.ly/4AjHI16 to fill the form.">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700;800;900&family=Outfit:wght@500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- QRCode.js & html2canvas for instant export -->
  <script src="assets/js/qrcode.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

  <style>
    :root {
      --rc-navy: #00246C;
      --rc-navy-dark: #071530;
      --rc-navy-light: #0A328C;
      --rc-gold: #F7A81B;
      --rc-gold-light: #FFD15C;
      --rc-gold-dark: #C88500;
      --rc-gold-grad: linear-gradient(135deg, #FFE899 0%, #F7A81B 50%, #D48800 100%);
      --rc-green: #059669;
      --rc-cranberry: #D91B5C;
      --rc-slate-dark: #0F172A;
      --rc-slate-body: #1E293B;
      --rc-slate-muted: #64748B;
      --rc-bg-light: #F8FAFC;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      background: #0B132B;
      font-family: 'Plus Jakarta Sans', sans-serif;
      color: #0F172A;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 24px 16px 50px 16px;
      -webkit-font-smoothing: antialiased;
    }

    /* TOP ACTION TOOLBAR */
    .flyer-toolbar {
      max-width: 880px;
      width: 100%;
      background: rgba(7, 21, 48, 0.9);
      backdrop-filter: blur(14px);
      border: 1px solid rgba(247, 168, 27, 0.35);
      border-radius: 14px;
      padding: 12px 20px;
      margin-bottom: 24px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
      flex-wrap: wrap;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
      z-index: 50;
    }

    .toolbar-brand {
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 0.92rem;
      font-weight: 800;
      color: var(--rc-gold);
    }

    .toolbar-actions {
      display: flex;
      align-items: center;
      gap: 10px;
      flex-wrap: wrap;
    }

    .btn-tool {
      background: #00246C;
      color: #FFFFFF;
      border: 1px solid rgba(247, 168, 27, 0.4);
      padding: 8px 16px;
      border-radius: 8px;
      font-size: 0.84rem;
      font-weight: 700;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 7px;
      text-decoration: none;
      transition: all 0.2s ease;
    }
    .btn-tool:hover {
      background: #07359E;
      border-color: var(--rc-gold);
      transform: translateY(-1px);
    }
    .btn-tool.primary {
      background: var(--rc-gold-grad);
      color: #071530;
      border: none;
      font-weight: 900;
    }
    .btn-tool.primary:hover {
      filter: brightness(1.08);
      box-shadow: 0 4px 15px rgba(247, 168, 27, 0.4);
    }

    /* THE FLYER CANVAS (Clean White Infographic Poster) */
    .flyer-poster {
      width: 100%;
      max-width: 880px;
      background: #FFFFFF;
      border-radius: 16px;
      box-shadow: 0 25px 60px -10px rgba(0, 0, 0, 0.6), 0 0 0 1px rgba(247, 168, 27, 0.25);
      position: relative;
      overflow: hidden;
      display: flex;
      flex-direction: column;
    }

    /* TOP CURVED HERO HEADER (Matching Reference Style) */
    .flyer-hero-header {
      background: linear-gradient(135deg, #071530 0%, #00246C 70%, #05338E 100%);
      color: #FFFFFF;
      padding: 32px 36px 36px 36px;
      position: relative;
      overflow: hidden;
    }
    .flyer-hero-header::after {
      content: "";
      position: absolute;
      bottom: -30px;
      right: -30px;
      width: 220px;
      height: 220px;
      background: radial-gradient(circle, rgba(247, 168, 27, 0.18) 0%, transparent 70%);
      border-radius: 50%;
      pointer-events: none;
    }

    /* Header decorative yellow road dash stripe */
    .header-dash-stripe {
      display: flex;
      gap: 8px;
      margin-top: 14px;
    }
    .header-dash-stripe span {
      height: 4px;
      width: 28px;
      background: var(--rc-gold);
      border-radius: 2px;
    }

    .hero-top-row {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      gap: 20px;
    }

    .hero-title-group {
      flex: 1;
    }
    .hero-tag {
      font-size: 0.85rem;
      font-weight: 800;
      color: var(--rc-gold);
      letter-spacing: 2px;
      text-transform: uppercase;
      margin-bottom: 6px;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .hero-main-title {
      font-family: 'Outfit', sans-serif;
      font-size: 2.35rem;
      font-weight: 900;
      color: #FFFFFF;
      line-height: 1.1;
      letter-spacing: 0.5px;
      text-transform: uppercase;
    }
    .hero-main-title span {
      color: var(--rc-gold);
    }
    .hero-sub-title {
      font-size: 0.95rem;
      color: #E2E8F0;
      margin-top: 6px;
      font-weight: 600;
      letter-spacing: 0.3px;
    }

    /* Rotary Brand Badge Top Right */
    .hero-brand-badge {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(8px);
      border: 1px solid rgba(247, 168, 27, 0.4);
      padding: 12px 16px;
      border-radius: 12px;
      min-width: 140px;
    }
    .hero-brand-badge img {
      width: 58px;
      height: 58px;
      filter: drop-shadow(0 2px 8px rgba(0, 0, 0, 0.4));
      margin-bottom: 6px;
    }
    .hero-club-name {
      font-size: 0.76rem;
      font-weight: 800;
      color: #FFFFFF;
      letter-spacing: 0.5px;
      text-transform: uppercase;
      line-height: 1.2;
    }
    .hero-district {
      font-size: 0.65rem;
      color: var(--rc-gold);
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    /* FOUR-WAY TEST SLOGAN STRIP */
    .hero-fwt-strip {
      background: #F1F5F9;
      border-bottom: 1px solid #E2E8F0;
      padding: 10px 36px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
      flex-wrap: wrap;
      font-size: 0.8rem;
      color: #334155;
    }
    .fwt-lead {
      font-weight: 800;
      color: var(--rc-navy);
      display: flex;
      align-items: center;
      gap: 6px;
      text-transform: uppercase;
      font-size: 0.76rem;
      letter-spacing: 0.8px;
    }
    .fwt-item-pill {
      display: flex;
      align-items: center;
      gap: 4px;
      font-weight: 600;
    }
    .fwt-num {
      background: var(--rc-gold);
      color: #071530;
      font-weight: 900;
      font-size: 0.7rem;
      width: 18px;
      height: 18px;
      border-radius: 50%;
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }

    /* =========================================================================
       CENTRAL SERPENTINE ROADMAP (Matching the Reference Infographic Flow)
       ========================================================================= */
    .infographic-body {
      padding: 36px 36px 28px 36px;
      background: #FFFFFF;
      position: relative;
    }

    /* Subtle background watermark */
    .infographic-watermark {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 480px;
      height: 480px;
      opacity: 0.03;
      pointer-events: none;
      z-index: 0;
    }

    /* Roadmap Container */
    .serpentine-roadmap {
      position: relative;
      z-index: 2;
      display: flex;
      flex-direction: column;
      gap: 18px;
      max-width: 800px;
      margin: 0 auto;
    }

    /* Central Connecting Line (Visible between nodes on desktop) */
    .serpentine-roadmap::before {
      content: "";
      position: absolute;
      top: 30px;
      bottom: 30px;
      left: 50%;
      transform: translateX(-50%);
      width: 6px;
      background: linear-gradient(180deg, #F7A81B 0%, #00246C 50%, #F7A81B 100%);
      border-radius: 3px;
      z-index: 1;
    }

    /* Step Row (Alternating Left & Right) */
    .step-row {
      display: grid;
      grid-template-columns: 1fr 90px 1fr;
      align-items: center;
      position: relative;
      z-index: 2;
    }

    /* Text Card */
    .step-text-card {
      padding: 12px 18px;
      border-radius: 12px;
      background: #FFFFFF;
      border: 1px solid #E2E8F0;
      box-shadow: 0 4px 15px -3px rgba(0, 36, 108, 0.07);
      transition: all 0.2s ease;
      position: relative;
    }
    .step-text-card:hover {
      box-shadow: 0 8px 25px -4px rgba(0, 36, 108, 0.12);
      border-color: var(--rc-gold);
    }
    .step-text-card.left-card {
      text-align: right;
      margin-right: 12px;
    }
    .step-text-card.right-card {
      text-align: left;
      margin-left: 12px;
    }

    .step-main-title {
      font-family: 'Outfit', sans-serif;
      font-size: 1.05rem;
      font-weight: 800;
      color: #071530;
      line-height: 1.25;
      margin-bottom: 4px;
    }
    .step-main-title span.highlight-deadline {
      color: #DC2626;
    }
    .step-main-title span.highlight-election {
      color: #00246C;
    }

    .step-date-badge {
      display: inline-block;
      font-size: 0.74rem;
      font-weight: 800;
      color: var(--rc-navy);
      background: rgba(0, 36, 108, 0.08);
      padding: 3px 9px;
      border-radius: 4px;
      margin-bottom: 4px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    .step-date-badge.urgent {
      background: #FEE2E2;
      color: #DC2626;
      font-weight: 900;
    }
    .step-date-badge.election {
      background: #FEF3C7;
      color: #B45309;
      font-weight: 900;
    }

    .step-desc {
      font-size: 0.82rem;
      color: #475569;
      line-height: 1.35;
    }
    .step-desc strong {
      color: #0F172A;
    }

    /* Central Node Circle with Icon & Number */
    .step-node-center {
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      z-index: 3;
    }

    .step-circle {
      width: 72px;
      height: 72px;
      background: #FFFFFF;
      border: 3px solid #E2E8F0;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 8px 20px rgba(0, 36, 108, 0.12);
      position: relative;
      transition: transform 0.2s ease;
    }
    .step-row:hover .step-circle {
      transform: scale(1.06);
    }
    .step-circle.gold-border {
      border-color: var(--rc-gold);
    }
    .step-circle.blue-border {
      border-color: var(--rc-navy);
    }
    .step-circle.red-border {
      border-color: var(--rc-cranberry);
    }

    .step-icon-svg {
      width: 32px;
      height: 32px;
    }

    /* Number badge attached to node */
    .step-num-badge {
      position: absolute;
      width: 26px;
      height: 26px;
      border-radius: 50%;
      color: #FFFFFF;
      font-weight: 900;
      font-size: 0.72rem;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 3px 8px rgba(0, 0, 0, 0.25);
      border: 2px solid #FFFFFF;
    }
    .num-pos-left {
      bottom: -2px;
      left: -2px;
    }
    .num-pos-right {
      bottom: -2px;
      right: -2px;
    }

    .bg-gold { background: var(--rc-gold-dark); }
    .bg-navy { background: var(--rc-navy); }
    .bg-red { background: #DC2626; }
    .bg-green { background: #059669; }

    /* Empty Column Placeholders */
    .step-empty-col {
      visibility: hidden;
    }

    /* =========================================================================
       BOTTOM SECTION: QR CODE & DATES PILLS (Matching the Reference)
       ========================================================================= */
    .infographic-bottom {
      border-top: 2px dashed #E2E8F0;
      padding-top: 24px;
      margin-top: 18px;
      display: grid;
      grid-template-columns: 1fr 1.15fr;
      gap: 24px;
      align-items: center;
      position: relative;
      z-index: 2;
    }

    /* QR Code Card (Left) */
    .qr-card-box {
      background: linear-gradient(135deg, #071530 0%, #00246C 100%);
      color: #FFFFFF;
      border-radius: 14px;
      padding: 16px 18px;
      border: 2px solid var(--rc-gold);
      display: flex;
      align-items: center;
      gap: 16px;
      box-shadow: 0 10px 25px rgba(0, 36, 108, 0.25);
    }

    .qr-render-frame {
      background: #FFFFFF;
      padding: 6px;
      border-radius: 8px;
      border: 2px solid var(--rc-gold);
      display: inline-block;
      flex-shrink: 0;
      position: relative;
    }
    #infographic-qr img,
    #infographic-qr canvas {
      display: block;
    }
    .qr-center-logo {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 24px;
      height: 24px;
      background: #FFFFFF;
      border-radius: 50%;
      padding: 2px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }
    .qr-center-logo img {
      width: 100%;
      height: 100%;
    }

    .qr-content-col {
      display: flex;
      flex-direction: column;
      gap: 4px;
    }
    .qr-title-badge {
      font-size: 0.68rem;
      font-weight: 800;
      color: #071530;
      background: var(--rc-gold);
      padding: 2px 8px;
      border-radius: 12px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      display: inline-block;
      align-self: flex-start;
    }
    .qr-subtext {
      font-size: 0.8rem;
      color: #E2E8F0;
      line-height: 1.3;
    }
    .qr-link-btn {
      font-family: 'Outfit', sans-serif;
      font-size: 1.05rem;
      font-weight: 900;
      color: #FFFFFF;
      background: rgba(255, 255, 255, 0.12);
      border: 1px dashed var(--rc-gold);
      padding: 4px 10px;
      border-radius: 6px;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      margin-top: 4px;
      width: fit-content;
      transition: all 0.2s ease;
    }
    .qr-link-btn:hover {
      background: var(--rc-gold);
      color: #071530;
      border-color: #FFFFFF;
    }

    /* Key Dates Pill Cards (Right, Matching Reference Style) */
    .date-pills-col {
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    .date-pill {
      display: flex;
      align-items: center;
      gap: 14px;
      padding: 12px 18px;
      border-radius: 40px;
      color: #FFFFFF;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
      position: relative;
      overflow: hidden;
    }
    .date-pill.pill-red {
      background: linear-gradient(135deg, #991B1B 0%, #DC2626 100%);
    }
    .date-pill.pill-navy {
      background: linear-gradient(135deg, #071530 0%, #00246C 100%);
      border: 1.5px solid var(--rc-gold);
    }

    .pill-icon-box {
      width: 44px;
      height: 44px;
      background: rgba(255, 255, 255, 0.2);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }
    .pill-title {
      font-size: 0.72rem;
      text-transform: uppercase;
      letter-spacing: 0.8px;
      opacity: 0.9;
      font-weight: 700;
    }
    .pill-date {
      font-family: 'Outfit', sans-serif;
      font-size: 1.15rem;
      font-weight: 900;
      letter-spacing: 0.3px;
      line-height: 1.15;
    }

    /* FOOTER SIGN-OFF */
    .infographic-footer {
      background: #F1F5F9;
      border-top: 1px solid #E2E8F0;
      padding: 14px 36px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      flex-wrap: wrap;
      font-size: 0.78rem;
      color: #64748B;
    }
    .footer-left {
      display: flex;
      flex-direction: column;
      gap: 2px;
    }
    .footer-left strong {
      color: #0F172A;
      font-size: 0.82rem;
    }
    .footer-right {
      text-align: right;
    }
    .footer-right .motto {
      font-family: 'Cinzel', serif;
      font-weight: 800;
      color: var(--rc-navy);
      font-size: 0.82rem;
    }

    /* Toast Notification */
    .toast-msg {
      position: fixed;
      bottom: 24px;
      background: var(--rc-gold-grad);
      color: #071530;
      font-weight: 900;
      padding: 10px 24px;
      border-radius: 30px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.4);
      z-index: 1000;
      display: none;
      transform: translateY(20px);
      transition: all 0.3s ease;
    }
    .toast-msg.show {
      display: block;
      transform: translateY(0);
    }

    /* PRINT STYLES */
    @media print {
      body {
        background: #FFFFFF !important;
        padding: 0 !important;
        margin: 0 !important;
      }
      .flyer-toolbar, .toast-msg {
        display: none !important;
      }
      .flyer-poster {
        max-width: 100% !important;
        box-shadow: none !important;
        border: none !important;
        border-radius: 0 !important;
        page-break-inside: avoid;
      }
      @page {
        size: A4 portrait;
        margin: 6mm;
      }
    }

    /* MOBILE RESPONSIVE (Switch to clean linear stack) */
    @media (max-width: 768px) {
      .flyer-hero-header {
        padding: 24px 20px;
      }
      .hero-main-title {
        font-size: 1.65rem;
      }
      .hero-top-row {
        flex-direction: column;
      }
      .hero-brand-badge {
        flex-direction: row;
        width: 100%;
        justify-content: flex-start;
        text-align: left;
        gap: 12px;
      }
      .infographic-body {
        padding: 24px 16px;
      }
      .serpentine-roadmap::before {
        left: 36px;
      }
      .step-row {
        grid-template-columns: 72px 1fr;
        gap: 12px;
        align-items: flex-start;
      }
      .step-empty-col {
        display: none;
      }
      .step-text-card.left-card,
      .step-text-card.right-card {
        text-align: left;
        margin: 0;
      }
      .step-row:nth-child(even) .step-text-card {
        order: 2;
      }
      .step-row:nth-child(even) .step-node-center {
        order: 1;
      }
      .infographic-bottom {
        grid-template-columns: 1fr;
      }
      .infographic-footer {
        padding: 14px 20px;
        flex-direction: column;
        align-items: flex-start;
      }
      .footer-right {
        text-align: left;
      }
    }
  </style>
</head>
<body>

  <!-- Floating Action Toolbar -->
  <div class="flyer-toolbar">
    <div class="toolbar-brand">
      <img src="assets/images/rotary-wheel.svg" width="28" height="28" alt="Rotary Wheel">
      <span>Election Procedure Infographic Flyer</span>
    </div>

    <div class="toolbar-actions">
      <button class="btn-tool primary" onclick="downloadFlyerPNG()" id="downloadBtn">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
        Download PNG Flyer
      </button>

      <button class="btn-tool" onclick="window.print()">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9V2h12v7M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><path d="M6 14h12v8H6z"/></svg>
        Print / PDF
      </button>

      <button class="btn-tool" onclick="copyShortLink()">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
        Copy Link
      </button>

      <a href="<?php echo htmlspecialchars($shortUrl); ?>" target="_blank" rel="noopener noreferrer" class="btn-tool">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6M15 3h6v6M10 14L21 3"/></svg>
        Open Form Link
      </a>

      <a href="index.php" class="btn-tool">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
        Portal
      </a>
    </div>
  </div>

  <!-- THE INFOGRAPHIC FLYER (Modeled after Election Procedure Reference) -->
  <div class="flyer-poster" id="flyerCapture">
    
    <!-- HEADER SECTION -->
    <header class="flyer-hero-header">
      <div class="hero-top-row">
        <div class="hero-title-group">
          <div class="hero-tag">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
            2027/2028 Officers Election
          </div>
          <h1 class="hero-main-title">ELECTION &amp; VOTING <span>PROCEDURE</span></h1>
          <p class="hero-sub-title">Official Step-by-Step Guidelines &bull; Rotary Club of Asokoro, District 9125 Nigeria</p>

          <div class="header-dash-stripe">
            <span></span><span></span><span></span><span></span><span></span><span></span>
          </div>
        </div>

        <div class="hero-brand-badge">
          <img src="assets/images/rotary-wheel.svg" alt="Rotary Wheel">
          <div class="hero-club-name">Rotary Club of Asokoro</div>
          <div class="hero-district">"The Pace Setter"</div>
        </div>
      </div>
    </header>

    <!-- FOUR-WAY TEST BANNER -->
    <div class="hero-fwt-strip">
      <div class="fwt-lead">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
        The Four-Way Test:
      </div>
      <div class="fwt-item-pill"><span class="fwt-num">1</span> Is it the TRUTH?</div>
      <div class="fwt-item-pill"><span class="fwt-num">2</span> FAIR to all concerned?</div>
      <div class="fwt-item-pill"><span class="fwt-num">3</span> Goodwill &amp; Better Friendships?</div>
      <div class="fwt-item-pill"><span class="fwt-num">4</span> BENEFICIAL to all concerned?</div>
    </div>

    <!-- INFOGRAPHIC ROADMAP BODY -->
    <div class="infographic-body">
      <!-- Watermark -->
      <img src="assets/images/rotary-wheel.svg" class="infographic-watermark" alt="Rotary Emblem">

      <div class="serpentine-roadmap">
        
        <!-- STEP 01 (Left) -->
        <div class="step-row">
          <div class="step-text-card left-card">
            <span class="step-date-badge">Wed, 11th Nov 2026</span>
            <h3 class="step-main-title">Form Submissions Commence</h3>
            <p class="step-desc">Official notice issued and online Expression of Interest opens for all <strong>8 Elective Offices</strong> via portal.</p>
          </div>
          <div class="step-node-center">
            <div class="step-circle gold-border">
              <!-- Megaphone / Announce Icon -->
              <svg class="step-icon-svg" viewBox="0 0 24 24" fill="none" stroke="#F7A81B" stroke-width="2.2"><path d="M11 5L6 9H2v6h4l5 4V5z"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14M15.54 8.46a5 5 0 0 1 0 7.07"/></svg>
              <div class="step-num-badge bg-gold num-pos-left">01</div>
            </div>
          </div>
          <div class="step-empty-col"></div>
        </div>

        <!-- STEP 02 (Right) -->
        <div class="step-row">
          <div class="step-empty-col"></div>
          <div class="step-node-center">
            <div class="step-circle blue-border">
              <!-- Register / List Check Icon -->
              <svg class="step-icon-svg" viewBox="0 0 24 24" fill="none" stroke="#00246C" stroke-width="2.2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><path d="M9 15l2 2 4-4"/></svg>
              <div class="step-num-badge bg-navy num-pos-right">02</div>
            </div>
          </div>
          <div class="step-text-card right-card">
            <span class="step-date-badge">Wed, 18th Nov 2026</span>
            <h3 class="step-main-title">Voters Register &amp; Dues Cutoff</h3>
            <p class="step-desc">Club financial standing cutoff. Members must have <strong>all club dues fully paid</strong> to endorse or vote.</p>
          </div>
        </div>

        <!-- STEP 03 (Left - URGENT DEADLINE) -->
        <div class="step-row">
          <div class="step-text-card left-card" style="border-left: 3px solid #DC2626;">
            <span class="step-date-badge urgent">Strict Cut-Off &bull; 5:00 PM Prompt</span>
            <h3 class="step-main-title"><span class="highlight-deadline">Nominations Submission Ends</span></h3>
            <p class="step-desc">Strict deadline for submission of nomination forms, passport photos, dues evidence, and manifestos.</p>
          </div>
          <div class="step-node-center">
            <div class="step-circle red-border">
              <!-- Clock / Alarm Icon -->
              <svg class="step-icon-svg" viewBox="0 0 24 24" fill="none" stroke="#DC2626" stroke-width="2.2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
              <div class="step-num-badge bg-red num-pos-left">03</div>
            </div>
          </div>
          <div class="step-empty-col"></div>
        </div>

        <!-- STEP 04 (Right) -->
        <div class="step-row">
          <div class="step-empty-col"></div>
          <div class="step-node-center">
            <div class="step-circle gold-border">
              <!-- Magnifying Glass / Vetting Icon -->
              <svg class="step-icon-svg" viewBox="0 0 24 24" fill="none" stroke="#F7A81B" stroke-width="2.2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><path d="M11 8v6M8 11h6"/></svg>
              <div class="step-num-badge bg-gold num-pos-right">04</div>
            </div>
          </div>
          <div class="step-text-card right-card">
            <span class="step-date-badge">Sat, 21st Nov 2026 &bull; 11:00 AM – 2:00 PM</span>
            <h3 class="step-main-title">Candidate Screening</h3>
            <p class="step-desc">Confidential vetting of aspirants: membership tenure, meeting attendance, financial status, and RLI training.</p>
          </div>
        </div>

        <!-- STEP 05 (Left) -->
        <div class="step-row">
          <div class="step-text-card left-card">
            <span class="step-date-badge">Sun, 22nd Nov 2026</span>
            <h3 class="step-main-title">Publication of Cleared Candidates</h3>
            <p class="step-desc">Electoral Committee officially publishes the final list of cleared and qualified candidates across club channels.</p>
          </div>
          <div class="step-node-center">
            <div class="step-circle blue-border">
              <!-- User Check / Publication Icon -->
              <svg class="step-icon-svg" viewBox="0 0 24 24" fill="none" stroke="#00246C" stroke-width="2.2"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><polyline points="17 11 19 13 23 9"/></svg>
              <div class="step-num-badge bg-navy num-pos-left">05</div>
            </div>
          </div>
          <div class="step-empty-col"></div>
        </div>

        <!-- STEP 06 (Right) -->
        <div class="step-row">
          <div class="step-empty-col"></div>
          <div class="step-node-center">
            <div class="step-circle green-border" style="border-color: #059669;">
              <!-- ID Card / Accreditation Icon -->
              <svg class="step-icon-svg" viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2.2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
              <div class="step-num-badge bg-green num-pos-right">06</div>
            </div>
          </div>
          <div class="step-text-card right-card">
            <span class="step-date-badge election">Wed, 25th Nov 2026 &bull; 5:00 PM – 6:00 PM</span>
            <h3 class="step-main-title">Accreditation of Eligible Voters</h3>
            <p class="step-desc">Physical accreditation at <strong>Stratton Suite, Asokoro, Abuja</strong>. Verification against the Voters Register. <em>No proxy voting</em>.</p>
          </div>
        </div>

        <!-- STEP 07 (Left) -->
        <div class="step-row">
          <div class="step-text-card left-card" style="border-left: 3px solid #00246C;">
            <span class="step-date-badge election">Wed, 25th Nov 2026 &bull; 6:00 PM – 8:30 PM</span>
            <h3 class="step-main-title"><span class="highlight-election">Secret Ballot Voting</span></h3>
            <p class="step-desc">Accredited voters cast secret ballots inside the voting cubicle and deposit them into the transparent ballot box.</p>
          </div>
          <div class="step-node-center">
            <div class="step-circle blue-border">
              <!-- Ballot Box Icon -->
              <svg class="step-icon-svg" viewBox="0 0 24 24" fill="none" stroke="#00246C" stroke-width="2.2"><path d="M19 11v9H5v-9"/><path d="M21 4H3v7h18V4z"/><path d="M10 4V1h4v3"/></svg>
              <div class="step-num-badge bg-navy num-pos-left">07</div>
            </div>
          </div>
          <div class="step-empty-col"></div>
        </div>

        <!-- STEP 08 (Right) -->
        <div class="step-row">
          <div class="step-empty-col"></div>
          <div class="step-node-center">
            <div class="step-circle gold-border">
              <!-- Certificate / Return Award Icon -->
              <svg class="step-icon-svg" viewBox="0 0 24 24" fill="none" stroke="#F7A81B" stroke-width="2.2"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/></svg>
              <div class="step-num-badge bg-gold num-pos-right">08</div>
            </div>
          </div>
          <div class="step-text-card right-card">
            <span class="step-date-badge election">Wed, 25th Nov 2026 &bull; Immediately after Polls</span>
            <h3 class="step-main-title">Counting &amp; Declaration</h3>
            <p class="step-desc">Open sorting and counting in presence of agents. Official declaration of winners &amp; <strong>Certificates of Return</strong> presented.</p>
          </div>
        </div>

      </div>

      <!-- BOTTOM CALLOUT: QR CODE & KEY DATES PILLS -->
      <div class="infographic-bottom">
        
        <!-- Left: QR Code Card -->
        <div class="qr-card-box">
          <div class="qr-render-frame">
            <div id="infographic-qr"></div>
            <div class="qr-center-logo">
              <img src="assets/images/rotary-wheel.svg" alt="R">
            </div>
          </div>

          <div class="qr-content-col">
            <span class="qr-title-badge">Online Submission Form</span>
            <p class="qr-subtext">Scan with your smartphone camera to access the official Expression of Interest portal:</p>
            <a href="<?php echo htmlspecialchars($shortUrl); ?>" target="_blank" rel="noopener noreferrer" class="qr-link-btn">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
              <?php echo htmlspecialchars($shortUrl); ?>
            </a>
          </div>
        </div>

        <!-- Right: 2 Key Date Pills (Matching Reference Style) -->
        <div class="date-pills-col">
          <!-- Cut-Off Pill -->
          <div class="date-pill pill-red">
            <div class="pill-icon-box">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            </div>
            <div>
              <div class="pill-title">Strict Nomination Cut-off</div>
              <div class="pill-date">Friday 20th Nov 2026 (5:00 PM)</div>
            </div>
          </div>

          <!-- Election Day Pill -->
          <div class="date-pill pill-navy">
            <div class="pill-icon-box">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#F7A81B" stroke-width="2.5"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            </div>
            <div>
              <div class="pill-title">AGM &amp; Officers Election Day</div>
              <div class="pill-date">Wednesday 25th Nov 2026 (Stratton Suite)</div>
            </div>
          </div>
        </div>

      </div>

    </div>

    <!-- FOOTER SECTION -->
    <footer class="infographic-footer">
      <div class="footer-left">
        <div><strong>Electoral Committee Chairman:</strong> <?php echo htmlspecialchars(COMMITTEE_CHAIRMAN); ?></div>
        <div><strong>Club President:</strong> <?php echo htmlspecialchars(CLUB_PRESIDENT); ?> &bull; Venue: Stratton Suite, Asokoro, Abuja</div>
      </div>
      <div class="footer-right">
        <div class="motto">"Service Above Self"</div>
        <div>No preferred candidates, only preferred processes.</div>
      </div>
    </footer>

  </div>

  <div class="toast-msg" id="toastMsg">✔ Link copied to clipboard!</div>

  <script>
    // 1. Render Scannable QR Code for https://bit.ly/4AjHI16
    document.addEventListener("DOMContentLoaded", function() {
      const qrTarget = "<?php echo $shortUrl; ?>";
      const qrContainer = document.getElementById("infographic-qr");
      
      new QRCode(qrContainer, {
        text: qrTarget,
        width: 105,
        height: 105,
        colorDark: "#00246C",
        colorLight: "#FFFFFF",
        correctLevel: QRCode.CorrectLevel.H // High error correction
      });
    });

    // 2. Copy Link to clipboard
    function copyShortLink() {
      const url = "<?php echo $shortUrl; ?>";
      navigator.clipboard.writeText(url).then(function() {
        showToast("✔ Link copied: " + url);
      }).catch(function() {
        showToast("Link: " + url);
      });
    }

    function showToast(text) {
      const toast = document.getElementById("toastMsg");
      toast.innerText = text;
      toast.classList.add("show");
      setTimeout(function() {
        toast.classList.remove("show");
      }, 3000);
    }

    // 3. Download Flyer as High-Res PNG
    function downloadFlyerPNG() {
      const btn = document.getElementById("downloadBtn");
      const origHtml = btn.innerHTML;
      btn.innerHTML = `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="spin"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg> Generating PNG...`;
      btn.disabled = true;

      const element = document.getElementById("flyerCapture");

      html2canvas(element, {
        scale: 2.2, // 2.2x crisp resolution
        useCORS: true,
        allowTaint: true,
        backgroundColor: "#FFFFFF",
        logging: false
      }).then(function(canvas) {
        const link = document.createElement("a");
        link.download = "Rotary-Club-Asokoro-Election-Procedure-Flyer.png";
        link.href = canvas.toDataURL("image/png");
        link.click();

        btn.innerHTML = `✔ Download Complete!`;
        setTimeout(function() {
          btn.innerHTML = origHtml;
          btn.disabled = false;
        }, 2500);
      }).catch(function(err) {
        console.error(err);
        btn.innerHTML = origHtml;
        btn.disabled = false;
        alert("Could not generate PNG automatically. You can use 'Print / PDF' to save.");
      });
    }
  </script>

</body>
</html>
