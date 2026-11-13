<?php
/**
 * Rotary Club of Asokoro — District 9125, Nigeria
 * 2027/2028 Officers Election — Official Election Guideline Flyer
 * Features scannable QR Code & direct link to https://bit.ly/4AjHI16
 */
require_once __DIR__ . '/config.php';

$shortUrl = "https://bit.ly/4AjHI16";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Official Election Guidelines Flyer — Rotary Club of Asokoro</title>
  <meta name="description" content="Official Notice and Guidelines Flyer for the 2027/2028 Rotary Club of Asokoro Officers Election. Scan QR code or visit https://bit.ly/4AjHI16 to apply.">
  
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700;800;900&family=Outfit:wght@500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@1,600&display=swap" rel="stylesheet">
  
  <!-- QRCode.js & html2canvas for instant export -->
  <script src="assets/js/qrcode.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

  <style>
    :root {
      --rc-navy: #00246C;
      --rc-navy-dark: #071530;
      --rc-navy-deeper: #030B1A;
      --rc-gold: #F7A81B;
      --rc-gold-light: #FFD15C;
      --rc-gold-dark: #C88500;
      --rc-gold-metallic: linear-gradient(135deg, #FFE899 0%, #F7A81B 45%, #D48800 80%, #FFF2B2 100%);
      --rc-cranberry: #D91B5C;
      --rc-sky: #0099FF;
      --rc-white: #FFFFFF;
      --rc-text-muted: #94A3B8;
      --rc-border-gold: rgba(247, 168, 27, 0.45);
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      background: #0B132B;
      font-family: 'Plus Jakarta Sans', sans-serif;
      color: #FFFFFF;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 24px 16px 40px 16px;
      -webkit-font-smoothing: antialiased;
    }

    /* Floating Toolbar */
    .flyer-toolbar {
      max-width: 860px;
      width: 100%;
      background: rgba(7, 21, 48, 0.85);
      backdrop-filter: blur(12px);
      border: 1px solid rgba(247, 168, 27, 0.3);
      border-radius: 14px;
      padding: 12px 20px;
      margin-bottom: 24px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
      flex-wrap: wrap;
      box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.5);
      z-index: 50;
    }

    .toolbar-brand {
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 0.9rem;
      font-weight: 700;
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
      font-weight: 600;
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
      background: var(--rc-gold-metallic);
      color: #071530;
      border: none;
      font-weight: 800;
    }
    .btn-tool.primary:hover {
      filter: brightness(1.08);
      box-shadow: 0 4px 15px rgba(247, 168, 27, 0.35);
    }

    /* THE FLYER CANVAS (Standard A4 / Poster Aspect Ratio) */
    .flyer-poster {
      width: 100%;
      max-width: 860px;
      background: radial-gradient(circle at 50% 20%, #0F2D6B 0%, #071530 50%, #030B1A 100%);
      border: 2px solid #D4AF37;
      border-radius: 12px;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.8), 0 0 40px rgba(0, 36, 108, 0.5);
      position: relative;
      overflow: hidden;
      padding: 32px 36px;
    }

    /* Ornate Gold Framing */
    .flyer-inner-frame {
      border: 1px solid rgba(247, 168, 27, 0.5);
      border-radius: 8px;
      padding: 24px 28px;
      position: relative;
      background: rgba(3, 11, 26, 0.35);
    }
    .flyer-inner-frame::before {
      content: "";
      position: absolute;
      top: 4px; left: 4px; right: 4px; bottom: 4px;
      border: 1px dashed rgba(247, 168, 27, 0.25);
      border-radius: 6px;
      pointer-events: none;
    }

    /* Corner Flourishes */
    .corner-dec {
      position: absolute;
      width: 24px;
      height: 24px;
      border-color: #F7A81B;
      border-style: solid;
      pointer-events: none;
    }
    .corner-tl { top: -2px; left: -2px; border-width: 3px 0 0 3px; }
    .corner-tr { top: -2px; right: -2px; border-width: 3px 3px 0 0; }
    .corner-bl { bottom: -2px; left: -2px; border-width: 0 0 3px 3px; }
    .corner-br { bottom: -2px; right: -2px; border-width: 0 3px 3px 0; }

    /* Watermark */
    .flyer-watermark {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 520px;
      height: 520px;
      opacity: 0.04;
      pointer-events: none;
      z-index: 1;
    }

    /* FLYER HEADER */
    .flyer-header {
      position: relative;
      z-index: 2;
      text-align: center;
      margin-bottom: 20px;
      padding-bottom: 16px;
      border-bottom: 1px solid rgba(247, 168, 27, 0.25);
    }

    .flyer-top-brand {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 16px;
      margin-bottom: 12px;
    }
    .flyer-logo {
      width: 64px;
      height: 64px;
      filter: drop-shadow(0 0 12px rgba(247, 168, 27, 0.5));
    }
    .flyer-org-sub {
      font-size: 0.78rem;
      letter-spacing: 2.5px;
      text-transform: uppercase;
      color: #94A3B8;
      font-weight: 700;
    }
    .flyer-club-title {
      font-family: 'Cinzel', serif;
      font-size: 1.85rem;
      font-weight: 800;
      color: #FFFFFF;
      letter-spacing: 1px;
      text-shadow: 0 2px 10px rgba(0, 0, 0, 0.6);
      line-height: 1.15;
    }
    .flyer-club-badge {
      display: inline-block;
      font-size: 0.76rem;
      font-weight: 800;
      letter-spacing: 1.5px;
      color: var(--rc-gold);
      background: rgba(247, 168, 27, 0.12);
      border: 1px solid rgba(247, 168, 27, 0.35);
      padding: 3px 14px;
      border-radius: 20px;
      margin-top: 4px;
      text-transform: uppercase;
    }

    /* Main Ribbon Title */
    .flyer-notice-badge {
      display: inline-block;
      margin: 12px auto 6px auto;
      background: var(--rc-gold-metallic);
      color: #071530;
      padding: 6px 26px;
      font-family: 'Outfit', sans-serif;
      font-weight: 900;
      font-size: 1.05rem;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      border-radius: 4px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
    }
    .flyer-election-title {
      font-family: 'Outfit', sans-serif;
      font-size: 1.55rem;
      font-weight: 800;
      color: #FFFFFF;
      margin-top: 4px;
      letter-spacing: 0.5px;
    }
    .flyer-preamble {
      font-style: italic;
      color: #CBD5E1;
      font-size: 0.84rem;
      margin-top: 6px;
      max-width: 680px;
      margin-left: auto;
      margin-right: auto;
    }
    .flyer-preamble strong {
      color: var(--rc-gold);
    }

    /* FOUR-WAY TEST MINI-STRIP */
    .four-way-strip {
      background: rgba(0, 36, 108, 0.5);
      border: 1px solid rgba(247, 168, 27, 0.3);
      border-radius: 6px;
      padding: 8px 14px;
      margin: 12px 0 18px 0;
      display: flex;
      align-items: center;
      justify-content: space-around;
      gap: 8px;
      flex-wrap: wrap;
      font-size: 0.74rem;
      color: #E2E8F0;
      position: relative;
      z-index: 2;
    }
    .fwt-title {
      font-weight: 800;
      color: var(--rc-gold);
      letter-spacing: 0.8px;
      text-transform: uppercase;
    }
    .fwt-item {
      display: flex;
      align-items: center;
      gap: 4px;
    }
    .fwt-item span {
      color: var(--rc-gold);
      font-weight: 700;
    }

    /* 2-COLUMN MAIN CONTENT */
    .flyer-grid {
      position: relative;
      z-index: 2;
      display: grid;
      grid-template-columns: 1.15fr 0.85fr;
      gap: 20px;
      margin-bottom: 20px;
    }

    /* Section Boxes */
    .flyer-box {
      background: rgba(7, 21, 48, 0.65);
      border: 1px solid rgba(247, 168, 27, 0.3);
      border-radius: 8px;
      padding: 14px 16px;
      box-shadow: inset 0 0 15px rgba(0, 36, 108, 0.2);
    }

    .box-title {
      font-family: 'Outfit', sans-serif;
      font-size: 0.96rem;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 0.8px;
      color: var(--rc-gold);
      display: flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 10px;
      padding-bottom: 6px;
      border-bottom: 1px solid rgba(247, 168, 27, 0.2);
    }
    .box-title svg {
      color: var(--rc-gold);
    }

    /* Elective Offices List */
    .offices-list {
      list-style: none;
      display: grid;
      grid-template-columns: 1fr;
      gap: 6px;
    }
    .office-item {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 5px 8px;
      background: rgba(255, 255, 255, 0.04);
      border-radius: 5px;
      border-left: 3px solid var(--rc-gold);
      font-size: 0.8rem;
    }
    .office-name {
      font-weight: 700;
      color: #FFFFFF;
      display: flex;
      align-items: center;
      gap: 7px;
    }
    .office-tag {
      font-size: 0.68rem;
      color: var(--rc-gold);
      background: rgba(247, 168, 27, 0.15);
      padding: 2px 6px;
      border-radius: 4px;
      font-weight: 600;
    }

    /* Key Dates Timeline */
    .timeline-list {
      list-style: none;
      display: flex;
      flex-direction: column;
      gap: 8px;
    }
    .timeline-item {
      display: flex;
      gap: 10px;
      align-items: flex-start;
      font-size: 0.78rem;
      padding: 6px 8px;
      background: rgba(255, 255, 255, 0.03);
      border-radius: 6px;
    }
    .timeline-item.urgent {
      background: rgba(217, 27, 92, 0.18);
      border-left: 3px solid var(--rc-cranberry);
    }
    .timeline-item.election-day {
      background: rgba(247, 168, 27, 0.15);
      border-left: 3px solid var(--rc-gold);
    }
    .tl-date {
      font-weight: 800;
      color: var(--rc-gold);
      min-width: 90px;
      line-height: 1.25;
      font-size: 0.74rem;
    }
    .timeline-item.urgent .tl-date {
      color: #FF6B8B;
    }
    .tl-desc {
      color: #E2E8F0;
      line-height: 1.25;
    }
    .tl-desc strong {
      color: #FFFFFF;
    }

    /* Aspirant Requirements Summary */
    .req-list {
      list-style: none;
      display: flex;
      flex-direction: column;
      gap: 4px;
      font-size: 0.76rem;
      color: #CBD5E1;
      margin-top: 6px;
    }
    .req-list li {
      display: flex;
      align-items: flex-start;
      gap: 6px;
    }
    .req-list li::before {
      content: "✔";
      color: var(--rc-gold);
      font-weight: 800;
    }

    /* DIGITAL SUBMISSION CALLOUT & QR CODE (HERO ELEMENT) */
    .qr-callout-card {
      background: linear-gradient(145deg, #071530 0%, #00246C 100%);
      border: 2px solid var(--rc-gold);
      border-radius: 10px;
      padding: 16px 14px;
      text-align: center;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5), 0 0 20px rgba(247, 168, 27, 0.2);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100%;
    }

    .qr-badge-title {
      font-family: 'Outfit', sans-serif;
      font-size: 0.88rem;
      font-weight: 900;
      text-transform: uppercase;
      letter-spacing: 1px;
      color: #071530;
      background: var(--rc-gold-metallic);
      padding: 4px 16px;
      border-radius: 20px;
      margin-bottom: 12px;
      display: inline-block;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    }

    /* QR Code Display Frame */
    .qr-frame {
      background: #FFFFFF;
      padding: 10px;
      border-radius: 10px;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.4);
      display: inline-block;
      margin-bottom: 12px;
      border: 3px solid #D4AF37;
      position: relative;
    }
    #flyer-qrcode img,
    #flyer-qrcode canvas {
      display: block;
      margin: 0 auto;
    }
    .qr-center-badge {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 32px;
      height: 32px;
      background: #FFFFFF;
      border-radius: 50%;
      padding: 3px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.3);
    }
    .qr-center-badge img {
      width: 100%;
      height: 100%;
    }

    .qr-url-display {
      font-family: 'Outfit', sans-serif;
      font-size: 1.15rem;
      font-weight: 800;
      color: #FFFFFF;
      background: rgba(0, 0, 0, 0.35);
      border: 1px dashed var(--rc-gold);
      padding: 6px 14px;
      border-radius: 6px;
      letter-spacing: 0.5px;
      margin-bottom: 6px;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      transition: all 0.2s ease;
    }
    .qr-url-display:hover {
      background: rgba(247, 168, 27, 0.15);
      border-color: #FFFFFF;
      color: var(--rc-gold);
    }
    .qr-instructions {
      font-size: 0.74rem;
      color: #CBD5E1;
      line-height: 1.3;
      max-width: 220px;
      margin: 0 auto;
    }

    /* FLYER FOOTER SIGN-OFF */
    .flyer-footer {
      position: relative;
      z-index: 2;
      border-top: 1px solid rgba(247, 168, 27, 0.3);
      padding-top: 14px;
      display: grid;
      grid-template-columns: 1fr auto 1fr;
      align-items: center;
      gap: 16px;
      text-align: center;
    }

    .footer-signer {
      text-align: center;
    }
    .signer-name {
      font-family: 'Outfit', sans-serif;
      font-size: 0.88rem;
      font-weight: 800;
      color: var(--rc-gold);
    }
    .signer-title {
      font-size: 0.72rem;
      color: #94A3B8;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .footer-motto-seal {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 4px;
    }
    .seal-circle-mini {
      width: 44px;
      height: 44px;
      border: 2px dashed var(--rc-gold);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.55rem;
      font-weight: 900;
      text-align: center;
      color: var(--rc-gold);
      background: rgba(247, 168, 27, 0.1);
      line-height: 1;
    }
    .motto-text {
      font-family: 'Playfair Display', serif;
      font-style: italic;
      font-size: 0.8rem;
      color: #FFFFFF;
      letter-spacing: 0.5px;
    }

    /* Toast Notification */
    .toast-msg {
      position: fixed;
      bottom: 24px;
      background: var(--rc-gold-metallic);
      color: #071530;
      font-weight: 800;
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

    /* PRINT STYLING (A4 Clean Fit) */
    @media print {
      body {
        background: #FFFFFF !important;
        color: #071530 !important;
        padding: 0 !important;
        margin: 0 !important;
      }
      .flyer-toolbar, .toast-msg {
        display: none !important;
      }
      .flyer-poster {
        max-width: 100% !important;
        width: 100% !important;
        border: 2px solid #00246C !important;
        border-radius: 0 !important;
        box-shadow: none !important;
        padding: 20px 24px !important;
        background: #FFFFFF !important;
        color: #071530 !important;
        page-break-inside: avoid;
      }
      .flyer-inner-frame {
        border-color: #00246C !important;
        background: transparent !important;
      }
      .flyer-club-title, .flyer-election-title {
        color: #00246C !important;
        text-shadow: none !important;
      }
      .flyer-preamble {
        color: #334155 !important;
      }
      .flyer-preamble strong, .fwt-title, .box-title, .signer-name {
        color: #00246C !important;
      }
      .four-way-strip {
        background: #F1F5F9 !important;
        color: #071530 !important;
        border-color: #CBD5E1 !important;
      }
      .flyer-box {
        background: #F8FAFC !important;
        border-color: #CBD5E1 !important;
        color: #071530 !important;
      }
      .office-item {
        background: #FFFFFF !important;
        color: #071530 !important;
        border-left-color: #00246C !important;
      }
      .office-name {
        color: #071530 !important;
      }
      .timeline-item {
        background: #FFFFFF !important;
        color: #071530 !important;
      }
      .timeline-item.urgent {
        background: #FEE2E2 !important;
        border-left-color: #DC2626 !important;
      }
      .timeline-item.election-day {
        background: #FEF3C7 !important;
        border-left-color: #D97706 !important;
      }
      .tl-date, .tl-desc strong {
        color: #00246C !important;
      }
      .timeline-item.urgent .tl-date {
        color: #DC2626 !important;
      }
      .qr-callout-card {
        background: #F8FAFC !important;
        border-color: #00246C !important;
        color: #071530 !important;
      }
      .qr-url-display {
        color: #00246C !important;
        background: #FFFFFF !important;
        border-color: #00246C !important;
      }
      .qr-instructions {
        color: #475569 !important;
      }
      @page {
        size: A4 portrait;
        margin: 8mm;
      }
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
      .flyer-poster {
        padding: 20px 14px;
      }
      .flyer-inner-frame {
        padding: 16px 12px;
      }
      .flyer-club-title {
        font-size: 1.45rem;
      }
      .flyer-election-title {
        font-size: 1.25rem;
      }
      .flyer-grid {
        grid-template-columns: 1fr;
        gap: 16px;
      }
      .four-way-strip {
        flex-direction: column;
        align-items: flex-start;
      }
      .flyer-footer {
        grid-template-columns: 1fr;
        gap: 12px;
      }
    }
  </style>
</head>
<body>

  <!-- Floating Action Toolbar -->
  <div class="flyer-toolbar">
    <div class="toolbar-brand">
      <img src="assets/images/rotary-wheel.svg" width="28" height="28" alt="Rotary Wheel">
      <span>Official Election Flyer</span>
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

  <!-- THE OFFICIAL PRINTABLE & EXPORTABLE FLYER -->
  <div class="flyer-poster" id="flyerCapture">
    <!-- Watermark Background -->
    <img src="assets/images/rotary-wheel.svg" class="flyer-watermark" alt="Rotary Seal">

    <div class="flyer-inner-frame">
      <div class="corner-dec corner-tl"></div>
      <div class="corner-dec corner-tr"></div>
      <div class="corner-dec corner-bl"></div>
      <div class="corner-dec corner-br"></div>

      <!-- HEADER -->
      <header class="flyer-header">
        <div class="flyer-top-brand">
          <img src="assets/images/rotary-wheel.svg" class="flyer-logo" alt="Rotary Wheel">
          <div>
            <div class="flyer-org-sub">Rotary International &bull; District 9125, Nigeria</div>
            <h1 class="flyer-club-title">ROTARY CLUB OF ASOKORO</h1>
            <div class="flyer-club-badge">Chartered Club &bull; "The Pace Setter"</div>
          </div>
        </div>

        <div class="flyer-notice-badge">Official Notice &amp; Election Guidelines</div>
        <h2 class="flyer-election-title">2027/2028 OFFICERS ELECTION</h2>

        <p class="flyer-preamble">
          The embargo on election activities is hereby lifted pursuant to the Rotary International Constitution &amp; Club Bye-Laws.
          <strong>"No preferred candidates, only preferred processes."</strong>
        </p>
      </header>

      <!-- FOUR-WAY TEST BANNER -->
      <div class="four-way-strip">
        <div class="fwt-title">The Four-Way Test:</div>
        <div class="fwt-item"><span>1.</span> Is it the TRUTH?</div>
        <div class="fwt-item"><span>2.</span> Is it FAIR to all concerned?</div>
        <div class="fwt-item"><span>3.</span> Goodwill &amp; Better Friendships?</div>
        <div class="fwt-item"><span>4.</span> BENEFICIAL to all concerned?</div>
      </div>

      <!-- 2-COLUMN BALANCED CONTENT -->
      <div class="flyer-grid">
        <!-- LEFT COLUMN: Elective Offices & Eligibility -->
        <div style="display: flex; flex-direction: column; gap: 16px;">
          <!-- Available Offices -->
          <div class="flyer-box">
            <h3 class="box-title">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
              Available Elective Offices (8)
            </h3>
            <ul class="offices-list">
              <li class="office-item">
                <span class="office-name">👑 President-nominee</span>
                <span class="office-tag">Board &amp; RLI Prereq</span>
              </li>
              <li class="office-item">
                <span class="office-name">📜 Secretary</span>
                <span class="office-tag">Club Records</span>
              </li>
              <li class="office-item">
                <span class="office-name">💰 Treasurer</span>
                <span class="office-tag">Treasury &amp; Dues</span>
              </li>
              <li class="office-item">
                <span class="office-name">🤝 Club Service Chair</span>
                <span class="office-tag">Fellowship &amp; Meetings</span>
              </li>
              <li class="office-item">
                <span class="office-name">📣 Public Image Chair</span>
                <span class="office-tag">Brand &amp; Media</span>
              </li>
              <li class="office-item">
                <span class="office-name">🌐 Rotary Foundation Chair</span>
                <span class="office-tag">TRF &amp; Giving</span>
              </li>
              <li class="office-item">
                <span class="office-name">🌟 Youth Service Chair</span>
                <span class="office-tag">Rotaract &amp; RYLA</span>
              </li>
              <li class="office-item">
                <span class="office-name">🔨 Projects Chair</span>
                <span class="office-tag">Community Service</span>
              </li>
            </ul>
          </div>

          <!-- Aspirant Eligibility Checklist -->
          <div class="flyer-box">
            <h3 class="box-title">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
              Aspirant Guidelines Checklist
            </h3>
            <ul class="req-list">
              <li><strong>Financial Standing:</strong> Fully paid club dues up to date.</li>
              <li><strong>Club Membership:</strong> Minimum tenure prescribed in club Bye-Laws.</li>
              <li><strong>Endorsement:</strong> Form duly signed by an eligible Proposer &amp; Seconder.</li>
              <li><strong>Required Uploads:</strong> Passport photo, dues evidence &amp; manifesto.</li>
              <li><strong>President-nominee:</strong> Past Board service + RLI Graduate required.</li>
            </ul>
          </div>
        </div>

        <!-- RIGHT COLUMN: Timetable & Scannable QR Code -->
        <div style="display: flex; flex-direction: column; gap: 16px;">
          <!-- Key Timetable Dates -->
          <div class="flyer-box">
            <h3 class="box-title">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
              Key Election Timetable
            </h3>
            <ul class="timeline-list">
              <li class="timeline-item">
                <div class="tl-date">Wed 11 Nov</div>
                <div class="tl-desc">Collection &amp; submission of forms commence</div>
              </li>
              <li class="timeline-item urgent">
                <div class="tl-date">Fri 20 Nov<br><span style="font-size: 0.68rem; font-weight: normal;">5:00 PM Prompt</span></div>
                <div class="tl-desc"><strong>STRICT DEADLINE:</strong> Submissions close</div>
              </li>
              <li class="timeline-item">
                <div class="tl-date">Wed 18 Nov</div>
                <div class="tl-desc">Voters Register display &amp; dues cutoff</div>
              </li>
              <li class="timeline-item">
                <div class="tl-date">Sat 21 Nov<br><span style="font-size: 0.68rem; font-weight: normal;">11 AM – 2 PM</span></div>
                <div class="tl-desc">Screening of nominated candidates</div>
              </li>
              <li class="timeline-item">
                <div class="tl-date">Sun 22 Nov</div>
                <div class="tl-desc">Publication of final cleared candidates</div>
              </li>
              <li class="timeline-item election-day">
                <div class="tl-date">Wed 25 Nov<br><span style="font-size: 0.68rem; font-weight: normal;">5:00 PM Prompt</span></div>
                <div class="tl-desc"><strong>ELECTION DAY &amp; AGM:</strong> Stratton Suite, Asokoro, Abuja (In-Person Secret Ballot)</div>
              </li>
            </ul>
          </div>

          <!-- PROMINENT QR CODE & SHORT LINK CALLOUT -->
          <div class="qr-callout-card">
            <span class="qr-badge-title">Scan or Click to Submit Form</span>
            
            <div class="qr-frame">
              <div id="flyer-qrcode"></div>
              <div class="qr-center-badge">
                <img src="assets/images/rotary-wheel.svg" alt="R">
              </div>
            </div>

            <a href="<?php echo htmlspecialchars($shortUrl); ?>" target="_blank" rel="noopener noreferrer" class="qr-url-display">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
              <?php echo htmlspecialchars($shortUrl); ?>
            </a>

            <div class="qr-instructions">
              Point your smartphone camera at the QR code or click the link above to submit your Expression of Interest.
            </div>
          </div>
        </div>
      </div>

      <!-- FOOTER SIGN-OFF -->
      <footer class="flyer-footer">
        <div class="footer-signer">
          <div class="signer-name"><?php echo htmlspecialchars(COMMITTEE_CHAIRMAN); ?></div>
          <div class="signer-title">Chairman, Electoral Committee</div>
        </div>

        <div class="footer-motto-seal">
          <div class="seal-circle-mini">
            OFFICIAL<br>SEAL
          </div>
          <div class="motto-text">"Service Above Self"</div>
        </div>

        <div class="footer-signer">
          <div class="signer-name"><?php echo htmlspecialchars(CLUB_PRESIDENT); ?></div>
          <div class="signer-title">Club President (2026/2027)</div>
        </div>
      </footer>
    </div>
  </div>

  <div class="toast-msg" id="toastMsg">✔ Link copied to clipboard!</div>

  <script>
    // 1. Generate High-Precision QR Code for https://bit.ly/4AjHI16
    document.addEventListener("DOMContentLoaded", function() {
      const qrTarget = "<?php echo $shortUrl; ?>";
      const qrContainer = document.getElementById("flyer-qrcode");
      
      new QRCode(qrContainer, {
        text: qrTarget,
        width: 140,
        height: 140,
        colorDark: "#00246C",
        colorLight: "#FFFFFF",
        correctLevel: QRCode.CorrectLevel.H // High error correction so center badge works seamlessly
      });
    });

    // 2. Copy Short URL to clipboard
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
        scale: 2.5, // 2.5x retina quality for ultra-sharp print
        useCORS: true,
        allowTaint: true,
        backgroundColor: "#071530",
        logging: false
      }).then(function(canvas) {
        const link = document.createElement("a");
        link.download = "Rotary-Club-Asokoro-Election-Guideline-Flyer.png";
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
