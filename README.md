# Rotary Club of Asokoro — 2027/2028 Officers Election Portal

[![Rotary International](https://img.shields.io/badge/Rotary%20International-District%209125-00246C?style=for-the-badge&logo=rotary)](https://rotary.org)
[![PHP](https://img.shields.io/badge/PHP-8.0+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-5.7%20%2F%208.x-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)
[![MariaDB](https://img.shields.io/badge/MariaDB-10.x+-003545?style=for-the-badge&logo=mariadb&logoColor=white)](https://mariadb.org)
[![SQLite](https://img.shields.io/badge/SQLite-3-003B57?style=for-the-badge&logo=sqlite&logoColor=white)](https://sqlite.org)
[![Mobile Optimized](https://img.shields.io/badge/Mobile-Optimized-10B981?style=for-the-badge)](https://github.com/Ixplorer/Rotary-Club-Election)

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
| **3** | Voters Register display & financial standing cutoff | **Wednesday, 18th Nov 2026** | Scheduled |
| **4** | Screening of nominated candidates | **Saturday, 21st Nov 2026 (11:00 AM – 2:00 PM)** | Scheduled |
| **5** | Publication of final successful candidates list | **Sunday, 22nd Nov 2026** | Scheduled |
| **6** | Accreditation of Voters (Physical presence & Voters Register check) | **Wednesday, 25th Nov 2026 (5:00 PM – 6:00 PM)** | Scheduled |
| **7** | Opening of Poll & Secret Ballot Voting (Stratton Suite, Asokoro) | **Wednesday, 25th Nov 2026 (6:00 PM – 8:30 PM)** | **Election Day** |
| **8** | Sorting, Open Counting & Declaration of Results | **Wednesday, 25th Nov 2026 (Immediately after Polls)** | **Election Day** |
| **9** | Issuance of Certificates of Return to Elected Candidates | **Wednesday, 25th Nov 2026 at AGM** | **Election Day** |
| **10** | Electoral Committee Final Comprehensive Report | **Wednesday, 25th Nov 2026** | **Election Day** |

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

## ⚡ Self-Healing Database Engine (Zero-Friction Live Deployment)

The portal features an **Intelligent Multi-Driver Auto-Creating Database Engine** designed specifically so that when you upload the files to any live web host (cPanel, Plesk, VPS, Shared Hosting, or Cloud), **everything works immediately without manual database setup**:

### 1. Automatic Schema Creation On First Run
- When any user visits the site or makes a submission, `config.php` checks if the database and required tables (`nominations`, `audit_logs`) exist.
- If not found, it **automatically runs the DDL schema creation** with full `InnoDB` engine, `utf8mb4_unicode_ci` collation, indexes, foreign integrity checks, and auto-seeding.
- Even if the MySQL database has not been created yet in phpMyAdmin, `config.php` will attempt `CREATE DATABASE IF NOT EXISTS \`rotary_election\`` automatically.

### 2. Dual-Driver Architecture (`DB_DRIVER='auto'|'mysql'|'sqlite'`)
- **Live Servers (MySQL / MariaDB)**: Default choice for production. High concurrency, ACID compliance, and standard phpMyAdmin access.
- **Plug-and-Play Fallback (SQLite3)**: If MySQL is unavailable or offline, the system seamlessly falls back to a standalone file database in `data/election.db` with zero configuration.

### 3. Standalone SQL Dump Files
For administrators who prefer manual 1-click import into phpMyAdmin:
- [`database.sql`](database.sql): Complete database creation script with table schemas and indexes.
- [`schema.sql`](schema.sql): Table DDL scripts for existing databases.

### 4. Interactive Diagnostic & Verification Utility (`setup.php`)
- Visit `https://your-domain.com/setup.php` (or run `php setup.php` in CLI) for a live visual health check verifying PHP version, PDO drivers, directory write permissions, table record counts, and database connectivity.

---

## 🌐 Live Server Deployment Guide (cPanel / Plesk / Apache / Nginx)

### Step 1: Upload Files
Upload all repository files to your live server document root (e.g., `public_html/` or a subdirectory like `public_html/rotary/`).

### Step 2: Configure MySQL Credentials (Optional)
If using MySQL / MariaDB on your live host, copy `.env.example` to `.env` in the project root:
```ini
DB_DRIVER=mysql
DB_HOST=localhost
DB_PORT=3306
DB_NAME=your_cpanel_dbname
DB_USER=your_cpanel_dbuser
DB_PASS=your_cpanel_dbpass
ADMIN_PASSKEY=asokoro2027
```
*(Alternatively, you can edit the fallback constants directly inside `config.php`.)*

### Step 3: Set Directory Permissions
Ensure the following directories are writable by the web server (chmod `755` or `775`):
- `uploads/` (for applicant passport photographs, dues receipts, and manifestos)
- `data/` (for SQLite database fallback)

### Step 4: Verify Deployment
Open your browser and navigate to:
```
https://your-domain.com/setup.php
```
`setup.php` will auto-create the tables, verify directory permissions, and confirm:
`[OK] Database Schema Ready & Synchronized!`

---

## ✨ Application Architecture & Features

### 1. Public Portal (`index.php`)
- **Dynamic Animated Hero Section**: Ambient glowing light orbs, rotating 3D Rotary wheel, smooth hover perspectives, and running ticker of available offices.
- **Real-Time Countdown Timer**: High-precision flip countdown clock to the 20th November 5:00 PM nomination cut-off.
- **10-Stage Timetable & Guidelines**: Interactive guidelines with swipeable pill navigation on mobile devices.
- **5-Step Expression of Interest Form**:
  - *Step 1:* Personal profile & position selector (with dynamic President-nominee RLI & Board experience fields).
  - *Step 2:* Proposer & Seconder validation (with distinct endorser and self-nomination checks).
  - *Step 3:* Document uploads (Passport photo, Club dues evidence, Manifesto summary / PDF).
  - *Step 4:* Peace Pact & Four-Way Test affirmation + HTML5 Canvas Digital Signature Pad.
  - *Step 5:* Dossier review summary and instant submission.
- **Online Status Verification Tool**: Instant candidate lookup by Reference ID (`RCA-27-XXXXXX`), Rotary Member ID, or Email.

### 2. Standalone Acknowledgement Receipt (`receipt.php`)
- Generates an official, printable acknowledgment receipt with club seal.
- Displays candidate headshot, full profile, checklist items, and candidate digital signature.
- Dynamic offline QR Code encoding the direct verification URL for smartphone scanning.

### 3. Electoral Committee Admin Portal (`admin.php`)
- Passkey-protected dashboard (**Default Passkey:** `asokoro2027`).
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

- **Backend**: PHP 8.0+ (Vanilla, zero external framework dependencies)
- **Database**: MySQL 5.7+ / MySQL 8.x / MariaDB 10.x+ / SQLite 3
- **Frontend**: HTML5, Vanilla CSS3 (Custom Design System, CSS Variables, Flexbox, Grid), Vanilla JavaScript (ES6+)
- **Libraries**: `qrcode.min.js` (Pure client-side QR generation)
- **Typography**: Outfit & Plus Jakarta Sans via Google Fonts

---

## 👥 Electoral Committee

- **Chairman:** Rotarian Adegoke, Saheed Adeyemi
- **Club President:** Impact President Ignatus Emeka
- **District:** Rotary District 9125, Nigeria

---

## 📜 License

Created for the **Rotary Club of Asokoro** (District 9125, Nigeria). All rights reserved.  
Guided by the principle of *"Service Above Self"*.
