# Rotary Club of Asokoro — 2027/2028 Officers Election Portal

[![Rotary International](https://img.shields.io/badge/Rotary%20International-District%209125-00246C?style=for-the-badge&logo=rotary)](https://rotary.org)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![SQLite](https://img.shields.io/badge/SQLite-3-003B57?style=for-the-badge&logo=sqlite&logoColor=white)](https://sqlite.org)
[![Responsive](https://img.shields.io/badge/Mobile-Optimized-10B981?style=for-the-badge)](https://github.com/Ixplorer/Rotary-Club-Election)

> **Official Notice, Guidelines, and Online Expression of Interest Portal for the 2027/2028 Rotary Year Officers Election.**  
> **Rotary Club of Asokoro — District 9125, Nigeria • "The Pace Setter"**  
> *"No preferred candidates, only preferred processes."*

---

## 🏛️ Overview

Pursuant to the **Rotary International Constitution**, the **Bye-Laws of the Rotary Club of Asokoro**, and the **Election Timetable approved by the Board**, this digital portal serves active members of the Rotary Club of Asokoro for signifying interest, submitting formal nominations, and managing the 2027/2028 officer election process.

Guided unconditionally by the **Rotary Four-Way Test**:
1. *Is it the TRUTH?*
2. *Is it FAIR to all concerned?*
3. *Will it build GOODWILL and BETTER FRIENDSHIPS?*
4. *Will it be BENEFICIAL to all concerned?*

---

## 📅 Official Election Timetable (Key Dates)

| S/N | Activity Description | Date & Time | Status |
|---|---|---|---|
| **1** | Collection and submission of nominations form commence | **Wednesday, 11th Nov 2026** | Ongoing |
| **2** | **Deadline for submission of nominations form** | **Friday, 20th Nov 2026 (5:00 PM prompt)** | **Strict Cut-Off** |
| **3** | Screening of nominated candidates | **Saturday, 21st Nov 2026 (11:00 AM – 2:00 PM)** | Scheduled |
| **4** | Publication of screening results & notice of appeal | **Sunday, 22nd Nov 2026** | Scheduled |
| **5** | Deadline for submission of appeal | **Monday, 23rd Nov 2026 (12:00 Noon)** | Scheduled |
| **6** | Hearing and resolution of appeal | **Monday, 23rd Nov 2026 (6:00 PM)** | Scheduled |
| **7** | Publication of final list of cleared candidates | **Tuesday, 24th Nov 2026** | Scheduled |
| **8** | Signing of Peace Pact by all cleared candidates | **Tuesday, 24th Nov 2026** | Scheduled |
| **9** | **Annual General Meeting & Officers Election** | **Wednesday, 25th Nov 2026 (5:00 PM)** | **Election Day** |
| **10** | **Venue** | **Stratton Suite, Asokoro, Abuja** | In-Person Only |

---

## 🗳️ Available Elective Offices (8 Positions)

1. **👑 President-nominee (for 2027/2028)** &mdash; Executive leadership succession. *Prerequisites: Past Board or club leadership service + Rotary Leadership Institute (RLI) training.*
2. **📜 Secretary** &mdash; Club records, minutes, official notices, and RI correspondence.
3. **💰 Treasurer** &mdash; Treasury management, dues administration, and financial reporting.
4. **🤝 Club Service Chair** &mdash; Fellowship, weekly meeting operations, member engagement and retention.
5. **📣 Public Image Chair** &mdash; Club branding, media presence, social media, and Rotary showcase.
6. **🌐 Rotary Foundation Chair** &mdash; TRF contributions, PolioPlus, and District/Global Grants.
7. **🌟 Youth Service Chair** &mdash; Rotaract, Interact, RYLA, and next-generation leadership development.
8. **🔨 Projects Chair** &mdash; Community needs assessments, project design, execution, and monitoring.

---

## ✨ Key Features & Architecture

### 1. Public Portal (`index.php`)
- **Animated Hero Section**: Ambient glowing light orbs, rotating background Rotary wheel, 3D card perspective, and running marquee ticker of available offices.
- **Real-Time Flip Countdown Timer**: High-precision countdown clock to the 20th November 5:00 PM nomination cut-off.
- **12-Stage Timetable & Guidelines**: Horizontal swipeable pill navigation on mobile devices with comprehensive guidelines.
- **5-Step Expression of Interest Form**:
  - *Step 1:* Personal profile & position selector (with dynamic President-nominee RLI & Board experience fields).
  - *Step 2:* Proposer & Seconder validation (with distinct endorser and self-nomination checks).
  - *Step 3:* Uploads (Passport headshot, Club dues evidence, Manifesto summary / PDF).
  - *Step 4:* Peace Pact & Four-Way Test affirmation + HTML5 Canvas Digital Signature Pad (touch-action enabled for smartphones).
  - *Step 5:* Full dossier review summary and instant submission.
- **Online Status Verification Tool**: Instant candidate lookup by Reference ID (`RCA-27-XXXXXX`), Rotary Member ID, or Email.

### 2. Standalone Acknowledgement Receipt (`receipt.php`)
- Generates an official, printable acknowledgment receipt with club seal.
- Displays candidate headshot, full profile, checklist items, and candidate digital signature.
- Dynamic offline QR Code encoding the direct verification URL for mobile scanning.

### 3. Electoral Committee Admin Portal (`admin.php`)
- Passkey-protected dashboard (**Passkey:** `asokoro2027`).
- Real-time nomination statistics (Total, Pending, Cleared, Disqualified, President Nominee).
- Search, filter by office, and filter by screening status.
- Candidate Dossier Modal: View complete applicant details, passport photo, dues receipt, and manifesto.
- Committee Screening Verdicts: Update status to `SCREENED_CLEARED`, `PROVISIONAL`, or `DISQUALIFIED` with official notes.
- One-click export to CSV / Excel for committee records.

### 4. Mobile View Optimization
- **Responsive Navigation**: Animated hamburger toggle morphing into an "✕" with glassmorphic slide-down drawer menu and backdrop blur overlay.
- **Form Usability**: `font-size: 16px` on all inputs to prevent iOS Safari auto-zoom; touch-optimized signature canvas; mobile step progress tracker.
- **Fluid Layouts**: 1-column responsive grids on mobile, stacked touch buttons, and horizontal momentum touch-scrolling tables.

---

## 🛠️ Technology Stack

- **Backend**: PHP 8.x (Vanilla, zero external framework dependencies)
- **Database**: SQLite3 (`PDO_SQLITE`) with automated schema migration on initial run
- **Frontend**: HTML5, Vanilla CSS3 (Custom Design System, CSS Variables, Flexbox, Grid), Vanilla JavaScript (ES6+)
- **Libraries**: `qrcode.min.js` (Pure client-side QR generation)
- **Typography**: Outfit & Plus Jakarta Sans via Google Fonts

---

## 🚀 Local Installation & Setup

1. **Prerequisites**:
   - XAMPP / WAMP / Apache server with PHP 8.0+ and `pdo_sqlite` enabled.

2. **Clone the repository**:
   ```bash
   git clone https://github.com/Ixplorer/Rotary-Club-Election.git
   ```

3. **Deploy to Web Root**:
   - Move or clone the directory into your server's web root (e.g., `c:/xampp/htdocs/rotary`).

4. **Directory Permissions**:
   - Ensure the `data/` and `uploads/` directories are writable by the web server.

5. **Access the Portal**:
   - **Public Portal:** `http://localhost/rotary/index.php`
   - **Committee Admin:** `http://localhost/rotary/admin.php` *(Default Passkey: `asokoro2027`)*
   - **Sample Receipt:** `http://localhost/rotary/receipt.php?ref=RCA-27-261112-B776E`

---

## 👥 Electoral Committee

- **Chairman:** Rotarian Adegoke, Saheed Adeyemi
- **Club President:** Impact President Ignatus Emeka
- **District:** Rotary District 9125, Nigeria

---

## 📜 License

Created for the **Rotary Club of Asokoro** (District 9125, Nigeria). All rights reserved.
Guided by the principle of *"Service Above Self"*.
