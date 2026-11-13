<?php
/**
 * ROTARY CLUB OF ASOKORO — District 9125, Nigeria
 * 2027/2028 OFFICERS ELECTION PORTAL
 * Official Notice, Guidelines & Expression of Interest System
 */

require_once __DIR__ . '/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rotary Club of Asokoro — 2027/2028 Officers Election & Expression of Interest Portal</title>
  <meta name="description" content="Official Notice, Election Guidelines, and Expression of Interest / Nomination Portal for the 2027/2028 Rotary Club of Asokoro Officers Election, District 9125, Nigeria.">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet">

  <!-- Stylesheet -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="icon" type="image/svg+xml" href="assets/images/rotary-wheel.svg">
</head>
<body>

  <!-- =========================================================================
       NAVIGATION BAR
       ========================================================================= -->
  <header class="site-nav">
    <div class="container nav-inner">
      <a href="index.php" class="nav-brand">
        <img src="assets/images/rotary-wheel.svg" alt="Rotary Logo" class="nav-brand-logo">
        <div class="nav-brand-text">
          <span class="nav-brand-title">Rotary Club of Asokoro</span>
          <span class="nav-brand-sub">District 9125, Nigeria &bull; The Pace Setter</span>
        </div>
      </a>

      <nav>
        <ul class="nav-links">
          <li><a href="#home" class="nav-link active">Home</a></li>
          <li><a href="#offices" class="nav-link">Available Offices</a></li>
          <li><a href="#notice" class="nav-link">Official Notice</a></li>
          <li><a href="#timetable" class="nav-link">Election Timetable</a></li>
          <li><a href="flyer.php" target="_blank" class="nav-link" style="color: var(--rotary-gold); font-weight: 700;">Flyer (QR)</a></li>
          <li><a href="#lookup" class="nav-link">Check Status / Receipt</a></li>
          <li><a href="admin.php" class="nav-link" style="color: var(--rotary-cranberry); font-weight: 700;">Committee Portal</a></li>
          <li class="mobile-nav-cta">
            <a href="#form" class="btn btn-gold btn-block" style="width: 100%; justify-content: center; padding: 12px 18px; font-size: 0.95rem;">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
              Fill Expression Form
            </a>
          </li>
        </ul>
      </nav>

      <div class="nav-actions">
        <a href="#form" class="btn btn-gold btn-sm nav-header-cta">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
          Fill Expression Form
        </a>
        <button class="nav-toggle" aria-label="Toggle navigation" aria-expanded="false">
          <span class="hamburger-box">
            <span class="hamburger-inner"></span>
          </span>
        </button>
      </div>
    </div>
  </header>

  <!-- =========================================================================
       HERO SECTION (ANIMATED & STYLISH)
       ========================================================================= -->
  <section id="home" class="hero-section">
    <!-- Giant Slow-Rotating Rotary Wheel Background Element -->
    <div class="hero-bg-rotary-wheel">
      <img src="assets/images/rotary-wheel.svg" alt="" aria-hidden="true">
    </div>

    <!-- Ambient Glowing Light Orbs -->
    <div class="hero-pattern"></div>
    <div class="hero-orb hero-orb-1"></div>
    <div class="hero-orb hero-orb-2"></div>
    <div class="hero-orb hero-orb-3"></div>

    <div class="container hero-grid">
      <!-- Left Content Column -->
      <div class="hero-content-col">
        <!-- Live Status Pill -->
        <div class="hero-badge-pill">
          <span class="live-dot"></span>
          <span>District 9125 &bull; The Pace Setter</span>
          <span class="badge-separator">&bull;</span>
          <span class="badge-highlight">Nominations Portal Open</span>
        </div>

        <h1 class="hero-title">
          2027/2028 Officers Election 
          <span class="shimmer-text">Expression of Interest</span>
        </h1>

        <p class="hero-subtitle">
          In line with the Rotary International Constitution, Club Bye-Laws, and the approved Election Timetable, 
          members are invited to signify interest and submit nominations for constitutional offices.
          <br>
          <span class="hero-quote">"No preferred candidates, only preferred processes."</span>
        </p>

        <div class="hero-actions">
          <a href="#form" class="btn btn-gold btn-lg btn-shine">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
            Signify Interest / Fill Form
          </a>
          <a href="#notice" class="btn btn-secondary btn-lg">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
            Read Election Guidelines
          </a>
          <a href="#lookup" class="btn btn-glass btn-lg">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            Check Status / Receipt
          </a>
        </div>

        <div class="hero-stats">
          <div class="hero-stat-card">
            <div class="hero-stat-number"><span class="counter-num" data-target="8">8</span></div>
            <div class="hero-stat-label">Elective Offices</div>
          </div>
          <div class="hero-stat-card">
            <div class="hero-stat-number">20 Nov</div>
            <div class="hero-stat-label">Submission Deadline</div>
          </div>
          <div class="hero-stat-card">
            <div class="hero-stat-number">21 Nov</div>
            <div class="hero-stat-label">Candidate Screening</div>
          </div>
          <div class="hero-stat-card">
            <div class="hero-stat-number">25 Nov</div>
            <div class="hero-stat-label">Election Day (Stratton)</div>
          </div>
        </div>
      </div>

      <!-- Right Column: 3D Showcase Card & Countdown -->
      <div class="hero-flyer-col">
        <div class="hero-flyer-showcase" id="hero-3d-card">
          <!-- Floating Official Seal Badge -->
          <div class="floating-seal-badge">
            <span class="seal-icon">🗳️</span>
            <div>
              <div class="seal-title">EXPRESSION OF INTEREST</div>
              <div class="seal-sub">Rotary Club of Asokoro</div>
            </div>
          </div>

          <div class="flyer-card-inner">
            <div class="flyer-thumb-wrapper" title="Rotary Club of Asokoro — Expression of Interest">
              <img src="assets/images/hero-expression-of-interest.jpg" alt="Rotary Club of Asokoro Expression of Interest Illustration">
            </div>

            <!-- Elevated Digital Countdown Box -->
            <div class="countdown-box">
              <div class="countdown-header">
                <span class="pulse-clock-icon">⏱️</span>
                <span>Nomination Closes In:</span>
              </div>
              <div class="countdown-timer">
                <div class="time-unit">
                  <div class="time-box"><span class="time-num" id="cd-days">--</span></div>
                  <span class="time-label">Days</span>
                </div>
                <div class="time-separator">:</div>
                <div class="time-unit">
                  <div class="time-box"><span class="time-num" id="cd-hours">--</span></div>
                  <span class="time-label">Hours</span>
                </div>
                <div class="time-separator">:</div>
                <div class="time-unit">
                  <div class="time-box"><span class="time-num" id="cd-mins">--</span></div>
                  <span class="time-label">Mins</span>
                </div>
                <div class="time-separator">:</div>
                <div class="time-unit">
                  <div class="time-box"><span class="time-num" id="cd-secs">--</span></div>
                  <span class="time-label">Secs</span>
                </div>
              </div>
              <div class="countdown-footer-note">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                Strict Cut-off: Friday, 20th November, 2026 by 5:00pm prompt
              </div>
            </div>

            <!-- Quick Links to View Signed Notice & Guideline Flyer with QR -->
            <div style="margin-top: 14px; display: flex; flex-direction: column; gap: 8px;">
              <a href="flyer.php" target="_blank" class="btn btn-gold btn-sm" style="width: 100%; font-size: 0.82rem; padding: 9px 14px; display: flex; align-items: center; justify-content: center; gap: 8px; text-decoration: none;">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                Official Guideline Flyer (with QR)
              </a>
              <button type="button" class="btn btn-glass btn-sm" id="open-flyer-lightbox" style="width: 100%; font-size: 0.82rem; padding: 8px 14px; display: flex; align-items: center; justify-content: center; gap: 8px;">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                View Signed Notice Scan
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Animated Continuous Marquee Ticker of Elective Offices -->
    <div class="hero-offices-ticker">
      <div class="ticker-label">
        <span>Available Offices</span>
      </div>
      <div class="ticker-track-wrap">
        <div class="ticker-track">
          <span class="ticker-item"><span class="ticker-icon">👑</span> President-nominee</span>
          <span class="ticker-bullet">&bull;</span>
          <span class="ticker-item"><span class="ticker-icon">📜</span> Secretary</span>
          <span class="ticker-bullet">&bull;</span>
          <span class="ticker-item"><span class="ticker-icon">💰</span> Treasurer</span>
          <span class="ticker-bullet">&bull;</span>
          <span class="ticker-item"><span class="ticker-icon">🤝</span> Club Service Chair</span>
          <span class="ticker-bullet">&bull;</span>
          <span class="ticker-item"><span class="ticker-icon">📣</span> Public Image Chair</span>
          <span class="ticker-bullet">&bull;</span>
          <span class="ticker-item"><span class="ticker-icon">🌐</span> Rotary Foundation Chair</span>
          <span class="ticker-bullet">&bull;</span>
          <span class="ticker-item"><span class="ticker-icon">🌟</span> Youth Service Chair</span>
          <span class="ticker-bullet">&bull;</span>
          <span class="ticker-item"><span class="ticker-icon">🔨</span> Projects Chair</span>
          <span class="ticker-bullet">&bull;</span>
          <!-- Duplicate items for seamless continuous loop -->
          <span class="ticker-item"><span class="ticker-icon">👑</span> President-nominee</span>
          <span class="ticker-bullet">&bull;</span>
          <span class="ticker-item"><span class="ticker-icon">📜</span> Secretary</span>
          <span class="ticker-bullet">&bull;</span>
          <span class="ticker-item"><span class="ticker-icon">💰</span> Treasurer</span>
          <span class="ticker-bullet">&bull;</span>
          <span class="ticker-item"><span class="ticker-icon">🤝</span> Club Service Chair</span>
          <span class="ticker-bullet">&bull;</span>
          <span class="ticker-item"><span class="ticker-icon">📣</span> Public Image Chair</span>
          <span class="ticker-bullet">&bull;</span>
          <span class="ticker-item"><span class="ticker-icon">🌐</span> Rotary Foundation Chair</span>
          <span class="ticker-bullet">&bull;</span>
          <span class="ticker-item"><span class="ticker-icon">🌟</span> Youth Service Chair</span>
          <span class="ticker-bullet">&bull;</span>
          <span class="ticker-item"><span class="ticker-icon">🔨</span> Projects Chair</span>
        </div>
      </div>
    </div>
  </section>

  <!-- =========================================================================
       THE FOUR-WAY TEST BANNER
       ========================================================================= -->
  <section class="four-way-strip">
    <div class="container">
      <div class="four-way-header reveal-on-scroll">
        <h3>Of the things we think, say or do &bull; The Four-Way Test</h3>
      </div>
      <div class="four-way-grid">
        <div class="four-way-card reveal-on-scroll delay-1">
          <div class="four-way-num">1</div>
          <div class="four-way-text">Is it the <strong>TRUTH?</strong></div>
        </div>
        <div class="four-way-card reveal-on-scroll delay-2">
          <div class="four-way-num">2</div>
          <div class="four-way-text">Is it <strong>FAIR</strong> to all concerned?</div>
        </div>
        <div class="four-way-card reveal-on-scroll delay-3">
          <div class="four-way-num">3</div>
          <div class="four-way-text">Will it build <strong>GOODWILL</strong> and <strong>BETTER FRIENDSHIPS?</strong></div>
        </div>
        <div class="four-way-card reveal-on-scroll delay-4">
          <div class="four-way-num">4</div>
          <div class="four-way-text">Will it be <strong>BENEFICIAL</strong> to all concerned?</div>
        </div>
      </div>
    </div>
  </section>

  <!-- =========================================================================
       AVAILABLE ELECTABLE OFFICES
       ========================================================================= -->
  <section id="offices" class="section">
    <div class="container">
      <div class="section-head reveal-on-scroll">
        <span class="section-tag">2027/2028 Rotary Year</span>
        <h2 class="section-title">Available Elective Offices</h2>
        <p class="section-desc">
          Election shall be held for the following 8 constitutional offices. 
          Please review the qualifications and click on any office to begin your expression of interest.
        </p>
      </div>

      <div class="offices-grid">
        <?php 
        $cardIdx = 0;
        foreach ($ELECTABLE_OFFICES as $key => $office): 
          $isPresident = ($key === 'President nominee');
          $cardIdx++;
          $delayClass = 'delay-' . (($cardIdx % 4) + 1);
        ?>
          <div class="office-card <?php echo $isPresident ? 'featured' : ''; ?> reveal-on-scroll <?php echo $delayClass; ?>">
            <span class="office-badge"><?php echo htmlspecialchars($office['badge']); ?></span>
            
            <div class="office-icon">
              <?php if ($isPresident): ?>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
              <?php elseif ($key === 'Secretary'): ?>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
              <?php elseif ($key === 'Treasurer'): ?>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
              <?php elseif ($key === 'Club service chair'): ?>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
              <?php elseif ($key === 'Public image chair'): ?>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14M15.54 8.46a5 5 0 0 1 0 7.07"/></svg>
              <?php elseif ($key === 'Rotary foundation chair'): ?>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
              <?php elseif ($key === 'Youth service chair'): ?>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              <?php else: ?>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
              <?php endif; ?>
            </div>

            <h3 class="office-title"><?php echo htmlspecialchars($office['title']); ?></h3>
            <p class="office-desc"><?php echo htmlspecialchars($office['description']); ?></p>

            <button type="button" class="btn <?php echo $isPresident ? 'btn-gold btn-shine' : 'btn-outline'; ?> office-btn select-office-btn" data-office="<?php echo htmlspecialchars($key); ?>">
              Select &amp; Apply
            </button>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- =========================================================================
       TIMETABLE & OFFICIAL GUIDELINES
       ========================================================================= -->
  <section id="timetable" class="section" style="background: #F8FAFC; border-top: 1px solid var(--border-light); border-bottom: 1px solid var(--border-light);">
    <div class="container">
      <div class="section-head reveal-on-scroll" id="notice">
        <span class="section-tag">Election Guidelines</span>
        <h2 class="section-title">Official Notice &amp; Election Timetable</h2>
        <p class="section-desc">
          Issued by the Electoral Committee pursuant to the Rotary International Constitution, Club Bye-Laws, and Board approval.
        </p>
      </div>

      <div class="notice-tabs-wrapper reveal-scale">
        <div class="notice-tabs-nav">
          <button class="notice-tab-btn active" data-tab="tab-schedule">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            Election Timetable (10 Activities)
          </button>
          <button class="notice-tab-btn" data-tab="tab-eligibility">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><polyline points="16 11 18 13 22 9"/></svg>
            Eligibility &amp; Requirements
          </button>
          <button class="notice-tab-btn" data-tab="tab-rules">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            Screening, Voting &amp; Peace Pact
          </button>
          <button class="notice-tab-btn" data-tab="tab-committee">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
            Committee &amp; Contacts
          </button>
        </div>

        <!-- Tab 1: Timetable -->
        <div class="notice-tab-content active" id="tab-schedule">
          <div class="mobile-table-hint">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M8 7l-5 5 5 5M16 7l5 5-5 5"/></svg>
            Swipe horizontally to view complete schedule
          </div>
          <div class="schedule-table-wrap">
            <table class="schedule-table">
              <thead>
                <tr>
                  <th style="width: 70px;">S/N</th>
                  <th>Activity Description</th>
                  <th style="width: 280px;">Approved Date &amp; Time</th>
                  <th style="width: 140px;">Status</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><strong>1.</strong></td>
                  <td><strong>Collection and submission of nominations form commence</strong></td>
                  <td>Wednesday, 11th November, 2026</td>
                  <td><span class="schedule-badge active">Ongoing</span></td>
                </tr>
                <tr>
                  <td><strong>2.</strong></td>
                  <td><strong>Collection and submission of nominations form ends</strong></td>
                  <td><strong>Friday, 20th November, 2026 by 5:00pm prompt</strong></td>
                  <td><span class="schedule-badge urgent">Strict Deadline</span></td>
                </tr>
                <tr>
                  <td><strong>3.</strong></td>
                  <td><strong>Voters Register display &amp; financial standing cutoff</strong></td>
                  <td>Wednesday, 18th November, 2026</td>
                  <td><span class="schedule-badge upcoming">Upcoming</span></td>
                </tr>
                <tr>
                  <td><strong>4.</strong></td>
                  <td><strong>Screening of nominated candidates</strong> (Verification of membership, attendance &amp; dues)</td>
                  <td>Saturday, 21st November, 2026 &bull; 11:00am – 2:00pm</td>
                  <td><span class="schedule-badge upcoming">Upcoming</span></td>
                </tr>
                <tr>
                  <td><strong>5.</strong></td>
                  <td><strong>Publication of final successful candidates list</strong></td>
                  <td>Sunday, 22nd November, 2026</td>
                  <td><span class="schedule-badge upcoming">Upcoming</span></td>
                </tr>
                <tr>
                  <td><strong>6.</strong></td>
                  <td><strong>Accreditation of Voters</strong> (Physical presence &amp; Voters Register check)</td>
                  <td>Wednesday, 25th November, 2026 &bull; 5:00pm – 6:00pm</td>
                  <td><span class="schedule-badge upcoming">Election Day</span></td>
                </tr>
                <tr>
                  <td><strong>7.</strong></td>
                  <td><strong>Opening of Poll &amp; Secret Ballot Voting</strong> (Stratton Suite, Asokoro, Abuja)</td>
                  <td>Wednesday, 25th November, 2026 &bull; 6:00pm – 8:30pm</td>
                  <td><span class="schedule-badge upcoming">Election Day</span></td>
                </tr>
                <tr>
                  <td><strong>8.</strong></td>
                  <td><strong>Sorting, Open Counting &amp; Declaration of Results</strong></td>
                  <td>Wednesday, 25th November, 2026 (Immediately after Polls)</td>
                  <td><span class="schedule-badge upcoming">Election Day</span></td>
                </tr>
                <tr>
                  <td><strong>9.</strong></td>
                  <td><strong>Issuance of Certificates of Return to Elected Candidates</strong></td>
                  <td>Wednesday, 25th November, 2026 at AGM</td>
                  <td><span class="schedule-badge upcoming">Election Day</span></td>
                </tr>
                <tr>
                  <td><strong>10.</strong></td>
                  <td><strong>Electoral Committee Final Comprehensive Report</strong></td>
                  <td>Wednesday, 25th November, 2026</td>
                  <td><span class="schedule-badge upcoming">Election Day</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Tab 2: Eligibility -->
        <div class="notice-tab-content" id="tab-eligibility">
          <div class="guideline-article">
            <h3>General Aspirant Eligibility Criteria</h3>
            <p>To be eligible to contest for any elective office, an aspirant must satisfy all of the following constitutional requirements:</p>
            <ul>
              <li><strong>Financial Standing:</strong> Must be a member in good financial standing with club dues fully paid up to date.</li>
              <li><strong>Club Membership Tenure:</strong> Must have been a member of the Rotary Club of Asokoro for the minimum period prescribed in the Bye-Laws.</li>
              <li><strong>Attendance Record:</strong> Must maintain a satisfactory record of attendance at weekly Fellowship meetings and club service activities.</li>
              <li><strong>Disciplinary Standing:</strong> Must not be under any disciplinary sanction or suspension by the Club or Rotary International.</li>
              <li><strong>Integrity:</strong> Must be a person of proven integrity unconditionally committed to <em>"Service Above Self"</em>.</li>
              <li><strong>One Office Rule:</strong> <em>"No member shall contest for more than one office in the same election."</em></li>
            </ul>

            <div class="quote-highlight">
              <strong>Special Requirement for President-Nominee:</strong><br>
              An aspirant for the office of President-nominee must, in addition to the above, have served on the Board or in a recognized club leadership position, and must have attended Rotary Leadership Institute (RLI) training as required by the District.
            </div>

            <h3>Endorsement (Proposer &amp; Seconder)</h3>
            <p>
              Each nomination form must be duly endorsed by a <strong>Proposer</strong> and a <strong>Seconder</strong>, both of whom must be active members in good financial standing of the Rotary Club of Asokoro.
            </p>

            <h3>Required Accompanying Documents</h3>
            <ul>
              <li>Recent Passport Photograph (clear face headshot)</li>
              <li>Evidence of Payment of Club Dues (receipt, teller, or transfer confirmation)</li>
              <li>One-Page Manifesto Summary (vision and action plan for the Rotary Year 2027/2028)</li>
            </ul>
          </div>
        </div>

        <!-- Tab 3: Screening, Voting & Peace Pact -->
        <div class="notice-tab-content" id="tab-rules">
          <div class="guideline-article">
            <h3>Screening of Candidates</h3>
            <p>
              Screening of nominated candidates shall hold on <strong>Saturday, 21st November, 2026 between 11:00am and 2:00pm</strong>.
              Screening shall verify membership, attendance, financial standing, eligibility and character, and shall be conducted confidentially, fairly and without bias or favour.
              Any aspirant who fails screening shall be notified in writing with reasons, and the final list of successful candidates shall be published on <strong>Sunday, 22nd November, 2026</strong>.
            </p>

            <h3>Code of Conduct &amp; Peace Pact</h3>
            <p>
              No campaign shall take place before publication of the final list, and campaigns shall only take place during the Annual General Meeting of the club on 25th November, 2026.
              All aspirants shall sign a Peace Pact before the commencement of campaign.
            </p>
            <ul>
              <li><strong>Prohibited Conduct:</strong> Vote buying, inducement, gift sharing or financial gratification, character assassination, defamation or false publication, threat, intimidation or harassment of members or of the Committee.</li>
              <li><strong>Sanctions:</strong> Any aspirant found guilty of prohibited conduct may be immediately disqualified.</li>
            </ul>

            <h3>Voting Procedures on Election Day</h3>
            <p>
              Voting shall hold on <strong>Wednesday, 25th November, 2026 at Stratton Suite, Asokoro, Abuja</strong>.
              Accreditation takes place from 5:00pm to 6:00pm. 
              <strong>Voting shall be in person only. There shall be no proxy voting and no voting by representation.</strong>
              Voting shall be by secret ballot. Total ballots cast shall be openly sorted and counted in the presence of aspirants, agents, and observers.
            </p>
          </div>
        </div>

        <!-- Tab 4: Committee -->
        <div class="notice-tab-content" id="tab-committee">
          <div class="guideline-article">
            <h3>Electoral Committee Attestation</h3>
            <p>
              The Election Committee shall conduct a free, fair, credible and peaceful election, remain neutral and impartial at all times, ensure transparency at every stage, and protect the integrity of ballot materials and results.
            </p>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-top: 24px;">
              <div style="background: #F8FAFC; border: 1px solid #E2E8F0; padding: 20px; border-radius: var(--radius-md);">
                <div style="font-size: 0.75rem; text-transform: uppercase; color: #64748B; font-weight: 700;">Issued By:</div>
                <div style="font-family: 'Outfit', sans-serif; font-size: 1.2rem; font-weight: 700; color: #00246C; margin: 6px 0 2px 0;">
                  Rotarian Adegoke, Saheed Adeyemi
                </div>
                <div style="font-size: 0.88rem; color: #B45309; font-weight: 600;">Chairman, Electoral Committee</div>
                <div style="font-size: 0.82rem; color: #64748B;">Rotary Club of Asokoro</div>
                <div style="font-size: 0.78rem; color: #94A3B8; margin-top: 6px;">For and on behalf of the Electoral Committee</div>
              </div>

              <div style="background: #F8FAFC; border: 1px solid #E2E8F0; padding: 20px; border-radius: var(--radius-md);">
                <div style="font-size: 0.75rem; text-transform: uppercase; color: #64748B; font-weight: 700;">Approved By:</div>
                <div style="font-family: 'Outfit', sans-serif; font-size: 1.2rem; font-weight: 700; color: #00246C; margin: 6px 0 2px 0;">
                  Impact President Ignatus Emeka
                </div>
                <div style="font-size: 0.88rem; color: #B45309; font-weight: 600;">Club President</div>
                <div style="font-size: 0.82rem; color: #64748B;">Rotary Club of Asokoro (The Pace Setter)</div>
                <div style="font-size: 0.78rem; color: #94A3B8; margin-top: 6px;">District 9125, Nigeria</div>
              </div>
            </div>

            <div style="margin-top: 28px; background: #EBF4FF; padding: 16px 20px; border-radius: var(--radius-md); font-size: 0.9rem; color: #1E3A8A;">
              <strong>Enquiries &amp; Support:</strong> For clarifications regarding the election notice, voter accreditation, or form submission, please contact the Secretary, Electoral Committee.
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- =========================================================================
       THE EXPRESSION OF INTEREST FORM (CORE FEATURE)
       ========================================================================= -->
  <section id="form" class="form-section">
    <div class="container" id="expression-form-section">
      <div class="section-head reveal-on-scroll">
        <span class="section-tag">Official Expression of Interest</span>
        <h2 class="section-title">2027/2028 Nomination Form</h2>
        <p class="section-desc">
          Complete the form below in accordance with the Club Bye-Laws. 
          Upon submission, an official, verifiable Acknowledgement Receipt will be automatically issued.
        </p>
      </div>

      <div class="form-card reveal-scale">
        <!-- Stepper Indicators -->
        <div class="stepper-header">
          <div class="mobile-step-tracker">
            <span class="mobile-step-badge">Step <strong id="mobile-step-num">1</strong> of 5</span>
            <span class="mobile-step-name" id="mobile-step-name">Nominee Profile &amp; Office</span>
          </div>
          <div class="stepper-nav">
            <div class="step-indicator active" data-step="1">
              <div class="step-circle">1</div>
              <span class="step-label">Nominee Profile</span>
            </div>
            <div class="step-indicator" data-step="2">
              <div class="step-circle">2</div>
              <span class="step-label">Endorsements</span>
            </div>
            <div class="step-indicator" data-step="3">
              <div class="step-circle">3</div>
              <span class="step-label">Uploads &amp; Manifesto</span>
            </div>
            <div class="step-indicator" data-step="4">
              <div class="step-circle">4</div>
              <span class="step-label">Peace Pact &amp; Sig</span>
            </div>
            <div class="step-indicator" data-step="5">
              <div class="step-circle">5</div>
              <span class="step-label">Review &amp; Submit</span>
            </div>
          </div>
        </div>

        <form id="nomination-expression-form" enctype="multipart/form-data">
          <!-- Hidden Signature Data Field -->
          <input type="hidden" name="signature_data" id="signature_data">

          <!-- =================================================================
               STEP 1: NOMINEE PROFILE & OFFICE
               ================================================================= -->
          <div class="step-pane active" id="step-pane-1">
            <div class="pane-title-block">
              <h3 class="pane-title">Step 1: Aspirant Information &amp; Office Selection</h3>
              <p class="pane-desc">Provide your verified Rotary membership details and select the office you wish to contest.</p>
            </div>

            <div class="form-row three-col">
              <div class="form-group">
                <label class="form-label" for="title">Title <span class="req">*</span></label>
                <select name="title" id="title" class="form-control" required>
                  <option value="Rtn.">Rtn.</option>
                  <option value="PAG">PAG (Past Assistant Governor)</option>
                  <option value="PP">PP (Past President)</option>
                  <option value="CP">CP (Charter President)</option>
                  <option value="PDG">PDG (Past District Governor)</option>
                  <option value="AG">AG (Assistant Governor)</option>
                </select>
              </div>

              <div class="form-group" style="grid-column: span 2;">
                <label class="form-label" for="full_name">Full Name (Surname First) <span class="req">*</span></label>
                <input type="text" name="full_name" id="full_name" class="form-control" placeholder="e.g. Babatunde, Chukwuemeka Musa" required>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label class="form-label" for="rotary_id">
                  <span>Rotary Member ID <span class="req">*</span></span>
                  <span class="form-hint">From Rotary.org / My Rotary</span>
                </label>
                <input type="text" name="rotary_id" id="rotary_id" class="form-control" placeholder="e.g. 10842915" required>
              </div>

              <div class="form-group">
                <label class="form-label" for="position-select">Office Contesting For <span class="req">*</span></label>
                <select name="position" id="position-select" class="form-control" required>
                  <option value="" disabled selected>-- Select Electable Office --</option>
                  <?php foreach ($ELECTABLE_OFFICES as $pKey => $pObj): ?>
                    <option value="<?php echo htmlspecialchars($pKey); ?>">
                      <?php echo htmlspecialchars($pObj['title']); ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <!-- Conditional President-Nominee Requirements -->
            <div id="president-conditional-fields" style="display: none; background: #FFFBEB; border: 1.5px solid #FDE68A; border-radius: var(--radius-md); padding: 20px; margin-bottom: 24px;">
              <div style="display: flex; align-items: center; gap: 8px; font-weight: 700; color: #B45309; margin-bottom: 12px; font-size: 0.95rem;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                President-Nominee Specific Prerequisites
              </div>
              <p style="font-size: 0.85rem; color: #92400E; margin-bottom: 16px;">
                Per Election Guidelines: <em>"An aspirant for the office of President must have served on the Board or in a leadership position and must have attended Rotary Leadership training (RLI) as required by the District."</em>
              </p>

              <div class="form-group">
                <label class="form-label" for="board_experience">Past Board / Leadership Positions Held in Club <span class="req">*</span></label>
                <textarea name="board_experience" id="board_experience" class="form-control" rows="2" placeholder="List past Board offices held (e.g., Club Secretary 2024/2025, Projects Chair 2023/2024)..."></textarea>
              </div>

              <div class="form-group">
                <label class="form-label" for="rli_status">Rotary Leadership Institute (RLI) Training Status <span class="req">*</span></label>
                <select name="rli_status" id="rli_status" class="form-control">
                  <option value="" disabled selected>-- Select RLI Completion Level --</option>
                  <option value="RLI Graduate (Parts I, II &amp; III Completed)">RLI Graduate (Parts I, II &amp; III Completed)</option>
                  <option value="RLI Part II Completed">RLI Part II Completed</option>
                  <option value="RLI Part I Completed">RLI Part I Completed</option>
                  <option value="District Leadership Training Certificate">District Leadership Training Certificate</option>
                </select>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label class="form-label" for="email">Email Address <span class="req">*</span></label>
                <input type="email" name="email" id="email" class="form-control" placeholder="your.name@example.com" required>
              </div>

              <div class="form-group">
                <label class="form-label" for="phone">Mobile / WhatsApp Number <span class="req">*</span></label>
                <input type="tel" name="phone" id="phone" class="form-control" placeholder="+234 803 000 0000" required>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label class="form-label" for="classification">
                  <span>Rotary Classification / Occupation</span>
                  <span class="form-hint">e.g. Legal Practice, Banking, Civil Engineering</span>
                </label>
                <input type="text" name="classification" id="classification" class="form-control" placeholder="Your profession or vocation">
              </div>

              <div class="form-group">
                <label class="form-label" for="years_in_club">
                  <span>Tenure in Rotary Club of Asokoro</span>
                  <span class="form-hint">Years of active membership</span>
                </label>
                <input type="text" name="years_in_club" id="years_in_club" class="form-control" placeholder="e.g. 4 Years (Joined 2022)">
              </div>
            </div>
          </div>

          <!-- =================================================================
               STEP 2: PROPOSER & SECONDER ENDORSEMENTS
               ================================================================= -->
          <div class="step-pane" id="step-pane-2">
            <div class="pane-title-block">
              <h3 class="pane-title">Step 2: Proposer &amp; Seconder Endorsements</h3>
              <p class="pane-desc">
                Each nomination must be duly sponsored by two financial members in good standing of the Rotary Club of Asokoro.
              </p>
            </div>

            <div style="background: #EFF6FF; border: 1px solid #BFDBFE; border-radius: var(--radius-md); padding: 14px 18px; margin-bottom: 24px; font-size: 0.88rem; color: #1E40AF;">
              <strong>Endorsement Rule:</strong> Proposer and Seconder must be distinct members in good financial standing as at 18th November, 2026. Self-nomination as proposer or seconder is strictly prohibited.
            </div>

            <!-- Proposer Section -->
            <div style="background: #F8FAFC; border: 1px solid var(--border-light); border-radius: var(--radius-md); padding: 20px; margin-bottom: 24px;">
              <h4 style="font-size: 1.1rem; color: var(--rotary-blue); margin-bottom: 14px; display: flex; align-items: center; gap: 8px;">
                <span style="background: var(--rotary-blue); color: white; width: 24px; height: 24px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 0.8rem;">A</span>
                Proposer Details
              </h4>
              <div class="form-row">
                <div class="form-group">
                  <label class="form-label" for="proposer_name">Proposer Full Name <span class="req">*</span></label>
                  <input type="text" name="proposer_name" id="proposer_name" class="form-control" placeholder="e.g. Rtn. John Doe" required>
                </div>
                <div class="form-group">
                  <label class="form-label" for="proposer_rotary_id">Proposer Rotary Member ID <span class="req">*</span></label>
                  <input type="text" name="proposer_rotary_id" id="proposer_rotary_id" class="form-control" placeholder="e.g. 9876543" required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group">
                  <label class="form-label" for="proposer_phone">Proposer Phone Number</label>
                  <input type="tel" name="proposer_phone" id="proposer_phone" class="form-control" placeholder="+234 ...">
                </div>
                <div class="form-group">
                  <label class="form-label" for="proposer_email">Proposer Email</label>
                  <input type="email" name="proposer_email" id="proposer_email" class="form-control" placeholder="proposer@example.com">
                </div>
              </div>
            </div>

            <!-- Seconder Section -->
            <div style="background: #F8FAFC; border: 1px solid var(--border-light); border-radius: var(--radius-md); padding: 20px; margin-bottom: 20px;">
              <h4 style="font-size: 1.1rem; color: var(--rotary-blue); margin-bottom: 14px; display: flex; align-items: center; gap: 8px;">
                <span style="background: var(--rotary-blue); color: white; width: 24px; height: 24px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 0.8rem;">B</span>
                Seconder Details
              </h4>
              <div class="form-row">
                <div class="form-group">
                  <label class="form-label" for="seconder_name">Seconder Full Name <span class="req">*</span></label>
                  <input type="text" name="seconder_name" id="seconder_name" class="form-control" placeholder="e.g. Rtn. Jane Smith" required>
                </div>
                <div class="form-group">
                  <label class="form-label" for="seconder_rotary_id">Seconder Rotary Member ID <span class="req">*</span></label>
                  <input type="text" name="seconder_rotary_id" id="seconder_rotary_id" class="form-control" placeholder="e.g. 8765432" required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group">
                  <label class="form-label" for="seconder_phone">Seconder Phone Number</label>
                  <input type="tel" name="seconder_phone" id="seconder_phone" class="form-control" placeholder="+234 ...">
                </div>
                <div class="form-group">
                  <label class="form-label" for="seconder_email">Seconder Email</label>
                  <input type="email" name="seconder_email" id="seconder_email" class="form-control" placeholder="seconder@example.com">
                </div>
              </div>
            </div>
          </div>

          <!-- =================================================================
               STEP 3: UPLOADS & MANIFESTO
               ================================================================= -->
          <div class="step-pane" id="step-pane-3">
            <div class="pane-title-block">
              <h3 class="pane-title">Step 3: Document Attachments &amp; Manifesto</h3>
              <p class="pane-desc">
                Upload your passport photograph, evidence of dues payment, and your one-page manifesto.
              </p>
            </div>

            <!-- Upload Grid -->
            <div class="form-row">
              <!-- Passport Photo -->
              <div class="form-group">
                <label class="form-label">
                  <span>1. Passport Photograph <span class="req">*</span></span>
                  <span class="form-hint">JPG, PNG (Max 5MB)</span>
                </label>
                <div class="upload-card">
                  <div class="upload-icon">📷</div>
                  <div class="upload-title">Click or Drag &amp; Drop Passport Headshot</div>
                  <div class="upload-desc">Clear, front-facing portrait photograph</div>
                  <input type="file" name="passport_photo" id="passport_photo" class="upload-input" accept="image/jpeg,image/png,image/webp" required>
                </div>
                <div class="upload-preview" id="photo_preview">
                  <img src="" id="photo_preview_img" alt="Passport Thumbnail">
                  <div class="upload-preview-info">
                    <div class="upload-preview-name" id="photo_preview_name"></div>
                    <div class="upload-preview-size" id="photo_preview_size"></div>
                  </div>
                </div>
              </div>

              <!-- Dues Payment Evidence -->
              <div class="form-group">
                <label class="form-label">
                  <span>2. Evidence of Payment of Dues <span class="req">*</span></span>
                  <span class="form-hint">Receipt / Transfer slip (PDF, JPG)</span>
                </label>
                <div class="upload-card">
                  <div class="upload-icon">🧾</div>
                  <div class="upload-title">Click to Upload Dues Payment Evidence</div>
                  <div class="upload-desc">Verifies financial standing with the Club</div>
                  <input type="file" name="dues_evidence" id="dues_evidence" class="upload-input" accept="image/jpeg,image/png,application/pdf" required>
                </div>
                <div class="upload-preview" id="dues_preview">
                  <div class="upload-preview-info">
                    <div class="upload-preview-name" id="dues_preview_name"></div>
                    <div class="upload-preview-size" id="dues_preview_size"></div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Manifesto Section -->
            <div class="form-group">
              <label class="form-label" for="manifesto_summary">
                <span>3. One-Page Manifesto Summary / Vision for 2027/2028 <span class="req">*</span></span>
                <span class="form-hint">Brief outline of goals and priorities</span>
              </label>
              <textarea name="manifesto_summary" id="manifesto_summary" class="form-control" rows="4" placeholder="Summarize your key priorities, action plans, and vision for your chosen office during the 2027/2028 Rotary Year..."></textarea>
            </div>

            <div class="form-row">
              <!-- Full Manifesto Document Upload -->
              <div class="form-group">
                <label class="form-label">
                  <span>Full Manifesto Document Upload</span>
                  <span class="form-hint">PDF, DOC, DOCX (Optional if written above)</span>
                </label>
                <div class="upload-card">
                  <div class="upload-icon">📄</div>
                  <div class="upload-title">Upload One-Page Manifesto File</div>
                  <div class="upload-desc">Detailed document for Electoral Committee</div>
                  <input type="file" name="manifesto_file" id="manifesto_file" class="upload-input" accept=".pdf,.doc,.docx,image/*">
                </div>
                <div class="upload-preview" id="manifesto_preview">
                  <div class="upload-preview-info">
                    <div class="upload-preview-name" id="manifesto_preview_name"></div>
                    <div class="upload-preview-size" id="manifesto_preview_size"></div>
                  </div>
                </div>
              </div>

              <!-- Additional Certificate / File -->
              <div class="form-group">
                <label class="form-label">
                  <span>Additional Supporting Document</span>
                  <span class="form-hint">RLI Certificate, CV, or Awards (Optional)</span>
                </label>
                <div class="upload-card">
                  <div class="upload-icon">📎</div>
                  <div class="upload-title">Upload Supporting Credential</div>
                  <div class="upload-desc">Optional additional certificate or document</div>
                  <input type="file" name="additional_file" id="additional_file" class="upload-input" accept=".pdf,.doc,.docx,image/*">
                </div>
              </div>
            </div>
          </div>

          <!-- =================================================================
               STEP 4: PEACE PACT & DIGITAL SIGNATURE
               ================================================================= -->
          <div class="step-pane" id="step-pane-4">
            <div class="pane-title-block">
              <h3 class="pane-title">Step 4: Peace Pact, Four-Way Test &amp; Digital Signature</h3>
              <p class="pane-desc">
                Affirm your solemn commitment to the Rotary Code of Conduct and sign your nomination form.
              </p>
            </div>

            <!-- Affirmation Checkboxes -->
            <label class="checkbox-card">
              <input type="checkbox" name="peace_pact_accepted" id="peace_pact_accepted" value="1" required>
              <div class="checkbox-content">
                <strong>Rotary Peace Pact &amp; Anti-Inducement Declaration:</strong><br>
                I solemnly affirm that I shall conduct myself with dignity, maturity and love for Rotary. 
                I pledge not to engage in vote buying, inducement, gift sharing, character assassination, or harassment of members. 
                I agree that campaigns shall only take place at the AGM on 25th November 2026, and I commit to accept the outcome in good faith in the true spirit of Rotary fellowship.
              </div>
            </label>

            <label class="checkbox-card">
              <input type="checkbox" name="four_way_test_accepted" id="four_way_test_accepted" value="1" required>
              <div class="checkbox-content">
                <strong>Commitment to The Four-Way Test:</strong><br>
                I solemnly declare that all statements, facts, and documents submitted herein are the TRUTH, FAIR to all concerned, aimed to build GOODWILL and BETTER FRIENDSHIPS, and BENEFICIAL to the Rotary Club of Asokoro.
              </div>
            </label>

            <!-- Interactive Signature Pad -->
            <div class="form-group" style="margin-top: 24px;">
              <label class="form-label">
                <span>Aspirant's Digital Signature <span class="req">*</span></span>
                <span class="form-hint">Draw signature on screen using mouse or touchscreen</span>
              </label>
              
              <div class="signature-box">
                <canvas id="sig-canvas" class="signature-canvas"></canvas>
                <div class="signature-actions">
                  <span style="font-size: 0.76rem; color: #64748B;">Draw your signature inside the box above</span>
                  <button type="button" class="btn btn-secondary btn-sm" id="clear-sig-btn">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                    Clear Signature
                  </button>
                </div>
              </div>

              <!-- Or Typed Name Fallback -->
              <div style="margin-top: 14px;">
                <label class="form-label" for="typed_signature">
                  <span>Or Type Legal Signature Affirmation</span>
                  <span class="form-hint">Type your full legal name as official digital affirmation</span>
                </label>
                <input type="text" id="typed_signature" class="form-control" placeholder="Type your full legal name if unable to draw signature">
              </div>
            </div>
          </div>

          <!-- =================================================================
               STEP 5: REVIEW & SUBMIT
               ================================================================= -->
          <div class="step-pane" id="step-pane-5">
            <div class="pane-title-block">
              <h3 class="pane-title">Step 5: Review &amp; Confirm Submission</h3>
              <p class="pane-desc">
                Please carefully verify your information before submitting. Once submitted, your nomination will be recorded and an Acknowledgement Receipt generated immediately.
              </p>
            </div>

            <div class="review-summary-grid">
              <div class="review-photo-preview">
                <img src="assets/images/rotary-wheel.svg" id="review-passport-img" alt="Nominee Photo Preview">
              </div>

              <div>
                <h4 style="font-size: 1.35rem; color: var(--rotary-blue); margin-bottom: 4px;" id="rev-name">--</h4>
                <div style="margin-bottom: 14px;">
                  <span style="background: #FEF3C7; color: #B45309; font-weight: 700; padding: 3px 12px; border-radius: 6px; font-size: 0.9rem;" id="rev-position">--</span>
                </div>

                <div class="review-field-group">
                  <div class="review-item">
                    <span class="review-label">Rotary Member ID</span>
                    <span class="review-value" id="rev-rotary-id">--</span>
                  </div>
                  <div class="review-item">
                    <span class="review-label">Classification</span>
                    <span class="review-value" id="rev-classification">--</span>
                  </div>
                  <div class="review-item">
                    <span class="review-label">Email Address</span>
                    <span class="review-value" id="rev-email">--</span>
                  </div>
                  <div class="review-item">
                    <span class="review-label">Mobile / WhatsApp</span>
                    <span class="review-value" id="rev-phone">--</span>
                  </div>
                  <div class="review-item">
                    <span class="review-label">Proposer</span>
                    <span class="review-value" id="rev-proposer">--</span>
                  </div>
                  <div class="review-item">
                    <span class="review-label">Seconder</span>
                    <span class="review-value" id="rev-seconder">--</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- President Nominee Block in Review -->
            <div id="rev-president-block" style="display: none; background: #FFFBEB; border: 1px solid #FDE68A; border-radius: var(--radius-md); padding: 16px; margin-bottom: 20px; font-size: 0.88rem;">
              <div style="font-weight: 700; color: #B45309; margin-bottom: 6px;">President-Nominee Verification:</div>
              <div style="margin-bottom: 6px;"><strong>Past Board Leadership:</strong> <span id="rev-board-exp"></span></div>
              <div><strong>RLI Status:</strong> <span id="rev-rli-status"></span></div>
            </div>

            <div style="background: #F8FAFC; border: 1px solid var(--border-light); border-radius: var(--radius-md); padding: 16px 20px; font-size: 0.88rem; color: #334155; margin-bottom: 24px;">
              ✔ Passport photograph, evidence of dues payment, and manifesto summary are attached.<br>
              ✔ Peace Pact and The Four-Way Test are affirmed.<br>
              ✔ Digital signature is registered.
            </div>
          </div>

          <!-- Footer Navigation Buttons -->
          <div class="form-footer-actions">
            <button type="button" class="btn btn-secondary" id="form-prev-btn" style="display: none;">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
              Previous Step
            </button>

            <button type="button" class="btn btn-primary" id="form-next-btn">
              Next Step
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </button>

            <button type="submit" class="btn btn-gold btn-lg" id="form-submit-btn" style="display: none;">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
              Submit Expression Form &amp; Generate Receipt
            </button>
          </div>
        </form>
      </div>
    </div>
  </section>

  <!-- =========================================================================
       STATUS CHECKER / RECEIPT RETRIEVAL TOOL
       ========================================================================= -->
  <section id="lookup" class="lookup-section">
    <div class="container">
      <div class="lookup-card reveal-scale">
        <span class="section-tag" style="background: #EBF4FF; color: var(--rotary-blue);">Verification Portal</span>
        <h2 style="font-size: 1.8rem; margin: 10px 0;">Check Submission &amp; Screening Status</h2>
        <p style="color: var(--text-muted); font-size: 0.95rem;">
          Enter your Tracking Reference Number (e.g. <code>RCA-27-261112-XXXXX</code>), Rotary Member ID, or Email address to track screening progress or retrieve your printable Acknowledgement Receipt.
        </p>

        <div class="lookup-input-group">
          <input type="text" id="lookup-input" class="form-control" placeholder="Enter Ref Number (RCA-...) or Member ID or Email...">
          <button type="button" id="lookup-submit-btn" class="btn btn-primary">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            Check Status
          </button>
        </div>

        <div id="lookup-result-card" class="lookup-result"></div>
      </div>
    </div>
  </section>

  <!-- =========================================================================
       SUCCESS MODAL WITH INSTANT RECEIPT ACCESS
       ========================================================================= -->
  <div class="modal-backdrop" id="success-modal">
    <div class="modal-dialog">
      <div class="modal-body">
        <div class="modal-icon-success">✔</div>
        <h3 style="font-size: 1.6rem; color: var(--rotary-blue); margin-bottom: 6px;">Expression Form Received!</h3>
        <p style="color: var(--text-muted); font-size: 0.95rem;">
          Your Expression of Interest for the 2027/2028 Officers Election has been successfully logged with the Electoral Committee.
        </p>

        <div class="modal-ref-card">
          <div style="font-size: 0.75rem; text-transform: uppercase; color: #64748B; font-weight: 700; margin-bottom: 4px;">Official Tracking Reference ID</div>
          <div class="modal-ref-no" id="success-modal-ref">RCA-27-XXXXXX</div>
          <div style="font-size: 0.88rem; color: #0F172A; font-weight: 700; margin-top: 6px;">
            Candidate: <span id="success-modal-name"></span> &bull; Office: <span id="success-modal-position" style="color: #B45309;"></span>
          </div>
        </div>

        <div style="background: #EFF6FF; border-radius: var(--radius-md); padding: 14px; font-size: 0.84rem; color: #1E3A8A; margin-bottom: 24px; text-align: left;">
          <strong>Next Steps:</strong>
          <ul style="padding-left: 20px; margin-top: 4px;">
            <li>Print or download your official Acknowledgement Receipt below.</li>
            <li>Screening of nominated candidates holds on <strong>Saturday, 21st November, 2026</strong> between 11:00am and 2:00pm.</li>
          </ul>
        </div>

        <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
          <a href="#" id="view-receipt-btn" target="_blank" class="btn btn-gold btn-lg">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M6 9V2h12v7M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><path d="M6 14h12v8H6z"/></svg>
            View &amp; Print Official Receipt
          </a>
          <button type="button" class="btn btn-secondary close-lightbox">
            Close &amp; Return
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- =========================================================================
       FLYER LIGHTBOX MODAL
       ========================================================================= -->
  <div class="modal-backdrop" id="flyer-lightbox-modal">
    <div class="lightbox-dialog">
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; padding: 0 4px;">
        <h4 style="color: var(--rotary-blue);">Official Election Notice &amp; Timetable Flyer</h4>
        <button type="button" class="btn btn-secondary btn-sm close-lightbox">✕ Close</button>
      </div>
      <img src="assets/images/election-flyer.jpeg" alt="Official Rotary Asokoro Election Notice Flyer Full">
    </div>
  </div>

  <!-- =========================================================================
       FOOTER
       ========================================================================= -->
  <footer class="site-footer">
    <div class="container">
      <div class="footer-grid">
        <div>
          <div class="footer-brand">
            <img src="assets/images/rotary-wheel.svg" width="46" height="46" alt="Rotary International Wheel">
            <div>
              <h4>Rotary Club of Asokoro</h4>
              <div style="font-size: 0.78rem; color: var(--rotary-gold); font-weight: 700; letter-spacing: 0.5px;">
                DISTRICT 9125, NIGERIA &bull; THE PACE SETTER
              </div>
            </div>
          </div>
          <p style="font-size: 0.88rem; color: #94A3B8; max-width: 440px; line-height: 1.6;">
            Rotary brings together a global network of volunteer leaders dedicated to tackling the world’s most pressing humanitarian challenges. <em>Service Above Self</em>.
          </p>
        </div>

        <div class="footer-links">
          <h5>Quick Navigation</h5>
          <ul>
            <li><a href="#offices">Elective Offices</a></li>
            <li><a href="#timetable">Election Timetable</a></li>
            <li><a href="#form">Nomination Form</a></li>
            <li><a href="#lookup">Verify Receipt / Status</a></li>
            <li><a href="admin.php">Electoral Committee Admin</a></li>
          </ul>
        </div>

        <div class="footer-links">
          <h5>Election Information</h5>
          <ul>
            <li><strong>Election Day:</strong> 25th Nov 2026</li>
            <li><strong>Venue:</strong> Stratton Suite, Asokoro</li>
            <li><strong>Chairman:</strong> Rtn. Adegoke S. Adeyemi</li>
            <li><strong>President:</strong> Impact Pres. Ignatus Emeka</li>
          </ul>
        </div>
      </div>

      <div class="footer-bottom">
        &copy; 2026 Rotary Club of Asokoro (District 9125, Nigeria). All Rights Reserved. &bull; Guided by The Four-Way Test.
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="assets/js/app.js"></script>
</body>
</html>
