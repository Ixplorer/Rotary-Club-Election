/**
 * Rotary Club of Asokoro - District 9125, Nigeria
 * 2027/2028 Officers Election Portal Application Script
 */

document.addEventListener("DOMContentLoaded", function () {
  initCountdown();
  initNoticeTabs();
  initOfficeSelectors();
  initStepperForm();
  initSignaturePad();
  initFileUploadPreviews();
  initFormSubmission();
  initLookupTool();
  initMobileNav();
  initLightbox();
  initScrollReveals();
  initHeroParallax();
  initAnimatedCounters();
});

// ============================================================================
// 1. COUNTDOWN TIMER TO NOMINATION DEADLINE
// Deadline: Friday, 20th November 2026, 17:00:00 (5:00 PM prompt)
// ============================================================================
function initCountdown() {
  const targetDate = new Date("2026-11-20T17:00:00").getTime();

  function update() {
    const now = new Date().getTime();
    const distance = targetDate - now;

    const daysEl = document.getElementById("cd-days");
    const hoursEl = document.getElementById("cd-hours");
    const minsEl = document.getElementById("cd-mins");
    const secsEl = document.getElementById("cd-secs");

    if (!daysEl) return;

    if (distance < 0) {
      document.querySelector(".countdown-header").innerHTML = "⚠️ NOMINATIONS CLOSED (5:00 PM Deadline Reached)";
      daysEl.textContent = "00";
      hoursEl.textContent = "00";
      minsEl.textContent = "00";
      secsEl.textContent = "00";
      return;
    }

    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    daysEl.textContent = String(days).padStart(2, "0");
    hoursEl.textContent = String(hours).padStart(2, "0");
    minsEl.textContent = String(minutes).padStart(2, "0");
    secsEl.textContent = String(seconds).padStart(2, "0");
  }

  update();
  setInterval(update, 1000);
}

// ============================================================================
// 2. NOTICE & TIMETABLE TABS
// ============================================================================
function initNoticeTabs() {
  const tabBtns = document.querySelectorAll(".notice-tab-btn");
  const tabContents = document.querySelectorAll(".notice-tab-content");

  tabBtns.forEach((btn) => {
    btn.addEventListener("click", () => {
      const targetId = btn.getAttribute("data-tab");

      tabBtns.forEach((b) => b.classList.remove("active"));
      tabContents.forEach((c) => c.classList.remove("active"));

      btn.classList.add("active");
      const target = document.getElementById(targetId);
      if (target) target.classList.add("active");
    });
  });
}

// ============================================================================
// 3. ELECTABLE OFFICES SELECTION & AUTO-FILL
// ============================================================================
function initOfficeSelectors() {
  const applyBtns = document.querySelectorAll(".select-office-btn");
  const positionSelect = document.getElementById("position-select");
  const presidentGroup = document.getElementById("president-conditional-fields");

  applyBtns.forEach((btn) => {
    btn.addEventListener("click", (e) => {
      e.preventDefault();
      const office = btn.getAttribute("data-office");
      if (positionSelect) {
        positionSelect.value = office;
        // Trigger change event
        positionSelect.dispatchEvent(new Event("change"));
        // Smooth scroll to form
        const formSection = document.getElementById("expression-form-section");
        if (formSection) {
          formSection.scrollIntoView({ behavior: "smooth", block: "start" });
        }
      }
    });
  });

  if (positionSelect && presidentGroup) {
    positionSelect.addEventListener("change", function () {
      if (this.value === "President nominee") {
        presidentGroup.style.display = "block";
        document.getElementById("board_experience").setAttribute("required", "required");
        document.getElementById("rli_status").setAttribute("required", "required");
      } else {
        presidentGroup.style.display = "none";
        document.getElementById("board_experience").removeAttribute("required");
        document.getElementById("rli_status").removeAttribute("required");
      }
    });
  }
}

// ============================================================================
// 4. MULTI-STEP FORM STEPPER & VALIDATION
// ============================================================================
let currentStep = 1;
const totalSteps = 5;

function initStepperForm() {
  const nextBtn = document.getElementById("form-next-btn");
  const prevBtn = document.getElementById("form-prev-btn");

  if (nextBtn) {
    nextBtn.addEventListener("click", () => {
      if (validateStep(currentStep)) {
        if (currentStep === 4) {
          populateReviewSummary();
        }
        if (currentStep < totalSteps) {
          goToStep(currentStep + 1);
        }
      }
    });
  }

  if (prevBtn) {
    prevBtn.addEventListener("click", () => {
      if (currentStep > 1) {
        goToStep(currentStep - 1);
      }
    });
  }

  // Stepper indicator clicks (allow navigating back to completed steps)
  document.querySelectorAll(".step-indicator").forEach((el) => {
    el.addEventListener("click", () => {
      const stepNum = parseInt(el.getAttribute("data-step"));
      if (stepNum < currentStep) {
        goToStep(stepNum);
      } else if (stepNum === currentStep + 1 && validateStep(currentStep)) {
        if (stepNum === 5) populateReviewSummary();
        goToStep(stepNum);
      }
    });
  });
}

const stepNames = [
  "Nominee Profile & Office",
  "Proposer & Seconder Endorsements",
  "Required Uploads & Manifesto",
  "Peace Pact & Digital Signature",
  "Review Application & Submit"
];

function goToStep(step) {
  currentStep = step;

  // Update panes
  document.querySelectorAll(".step-pane").forEach((pane) => {
    pane.classList.remove("active");
  });
  const currentPane = document.getElementById(`step-pane-${step}`);
  if (currentPane) currentPane.classList.add("active");

  // Update indicators
  document.querySelectorAll(".step-indicator").forEach((ind) => {
    const indStep = parseInt(ind.getAttribute("data-step"));
    ind.classList.remove("active", "completed");
    if (indStep === step) {
      ind.classList.add("active");
    } else if (indStep < step) {
      ind.classList.add("completed");
    }
  });

  // Update mobile step tracker
  const mobileStepNum = document.getElementById("mobile-step-num");
  const mobileStepName = document.getElementById("mobile-step-name");
  if (mobileStepNum) mobileStepNum.textContent = step;
  if (mobileStepName && stepNames[step - 1]) mobileStepName.textContent = stepNames[step - 1];

  // If entering signature step, ensure canvas is resized to rendered container width
  if (step === 4 && typeof window.refreshSigCanvas === "function") {
    setTimeout(() => {
      window.refreshSigCanvas();
    }, 60);
  }

  // Footer Buttons
  const prevBtn = document.getElementById("form-prev-btn");
  const nextBtn = document.getElementById("form-next-btn");
  const submitBtn = document.getElementById("form-submit-btn");

  if (prevBtn) prevBtn.style.display = step > 1 ? "inline-flex" : "none";
  if (nextBtn) nextBtn.style.display = step < totalSteps ? "inline-flex" : "none";
  if (submitBtn) submitBtn.style.display = step === totalSteps ? "inline-flex" : "none";

  // Scroll to stepper top (smooth on mobile)
  const formCard = document.querySelector(".form-card");
  if (formCard) {
    const yOffset = -80;
    const y = formCard.getBoundingClientRect().top + window.pageYOffset + yOffset;
    window.scrollTo({ top: y, behavior: "smooth" });
  }
}

function validateStep(step) {
  let isValid = true;
  const errorContainer = document.getElementById("form-global-errors");
  if (errorContainer) errorContainer.style.display = "none";

  if (step === 1) {
    const fullName = document.getElementById("full_name");
    const rotaryId = document.getElementById("rotary_id");
    const email = document.getElementById("email");
    const phone = document.getElementById("phone");
    const position = document.getElementById("position-select");

    if (!fullName.value.trim()) { alertField(fullName, "Please enter your Full Name."); return false; }
    if (!rotaryId.value.trim()) { alertField(rotaryId, "Please enter your Rotary Member ID."); return false; }
    if (!email.value.trim() || !validateEmail(email.value)) { alertField(email, "Please enter a valid Email Address."); return false; }
    if (!phone.value.trim()) { alertField(phone, "Please enter your Mobile / WhatsApp Number."); return false; }
    if (!position.value) { alertField(position, "Please select an Electable Office."); return false; }

    if (position.value === "President nominee") {
      const boardExp = document.getElementById("board_experience");
      const rliStatus = document.getElementById("rli_status");
      if (!boardExp.value.trim()) { alertField(boardExp, "Please state your past Board / leadership positions."); return false; }
      if (!rliStatus.value) { alertField(rliStatus, "Please select your Rotary Leadership Institute (RLI) training status."); return false; }
    }
  }

  if (step === 2) {
    const pName = document.getElementById("proposer_name");
    const pId = document.getElementById("proposer_rotary_id");
    const sName = document.getElementById("seconder_name");
    const sId = document.getElementById("seconder_rotary_id");

    if (!pName.value.trim()) { alertField(pName, "Please provide your Proposer's full name."); return false; }
    if (!pId.value.trim()) { alertField(pId, "Please enter your Proposer's Rotary Member ID."); return false; }
    if (!sName.value.trim()) { alertField(sName, "Please provide your Seconder's full name."); return false; }
    if (!sId.value.trim()) { alertField(sId, "Please enter your Seconder's Rotary Member ID."); return false; }

    if (pId.value.trim() === sId.value.trim()) {
      alert("Proposer and Seconder cannot be the same member. Please provide distinct endorsers.");
      return false;
    }
    const myRotaryId = document.getElementById("rotary_id").value.trim();
    if (pId.value.trim() === myRotaryId || sId.value.trim() === myRotaryId) {
      alert("You cannot propose or second your own nomination. Proposer and Seconder must be other financial members.");
      return false;
    }
  }

  if (step === 3) {
    const photoInput = document.getElementById("passport_photo");
    const duesInput = document.getElementById("dues_evidence");
    const manifestoSummary = document.getElementById("manifesto_summary");
    const manifestoFile = document.getElementById("manifesto_file");

    if (!photoInput.files || photoInput.files.length === 0) {
      alert("Please upload your recent Passport Photograph (headshot).");
      return false;
    }
    if (!duesInput.files || duesInput.files.length === 0) {
      alert("Please upload Evidence of Payment of Club Dues (receipt or transfer slip).");
      return false;
    }
    if (!manifestoSummary.value.trim() && (!manifestoFile.files || manifestoFile.files.length === 0)) {
      alert("Please either write a Manifesto Summary or upload your One-Page Manifesto document.");
      return false;
    }
  }

  if (step === 4) {
    const peacePact = document.getElementById("peace_pact_accepted");
    const fourWay = document.getElementById("four_way_test_accepted");
    const sigInput = document.getElementById("signature_data");

    if (!peacePact.checked) {
      alert("You must agree to the Peace Pact and abide by the Code of Conduct.");
      return false;
    }
    if (!fourWay.checked) {
      alert("You must formally affirm adherence to the Rotary Four-Way Test.");
      return false;
    }

    // Check canvas signature
    const sigData = getSignatureData();
    if (!sigData) {
      alert("Please provide your digital signature using the signature pad or type your full legal name.");
      return false;
    }
    sigInput.value = sigData;
  }

  return isValid;
}

function alertField(el, msg) {
  alert(msg);
  el.focus();
}

function validateEmail(email) {
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

// ============================================================================
// 5. SIGNATURE PAD (HTML5 Canvas + Text Fallback)
// ============================================================================
let canvas, ctx, isDrawing = false, hasDrawn = false;

function initSignaturePad() {
  canvas = document.getElementById("sig-canvas");
  if (!canvas) return;
  ctx = canvas.getContext("2d");

  // Resize canvas to match display width and maintain drawing
  function resizeCanvas() {
    if (!canvas) return;
    const rect = canvas.getBoundingClientRect();
    if (rect.width === 0) return;
    const temp = hasDrawn ? canvas.toDataURL() : null;
    canvas.width = rect.width;
    canvas.height = 150;
    ctx.lineWidth = 2.5;
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    ctx.strokeStyle = "#00246C";
    if (temp) {
      const img = new Image();
      img.onload = () => ctx.drawImage(img, 0, 0);
      img.src = temp;
    }
  }
  resizeCanvas();
  window.addEventListener("resize", resizeCanvas);
  window.refreshSigCanvas = resizeCanvas;

  function getCoords(e) {
    const rect = canvas.getBoundingClientRect();
    if (e.touches && e.touches[0]) {
      return {
        x: e.touches[0].clientX - rect.left,
        y: e.touches[0].clientY - rect.top
      };
    }
    return {
      x: e.clientX - rect.left,
      y: e.clientY - rect.top
    };
  }

  function startDraw(e) {
    isDrawing = true;
    hasDrawn = true;
    const { x, y } = getCoords(e);
    ctx.beginPath();
    ctx.moveTo(x, y);
    e.preventDefault();
  }

  function draw(e) {
    if (!isDrawing) return;
    const { x, y } = getCoords(e);
    ctx.lineTo(x, y);
    ctx.stroke();
    e.preventDefault();
  }

  function endDraw() {
    if (isDrawing) {
      isDrawing = false;
    }
  }

  canvas.addEventListener("mousedown", startDraw);
  canvas.addEventListener("mousemove", draw);
  canvas.addEventListener("mouseup", endDraw);
  canvas.addEventListener("mouseleave", endDraw);

  canvas.addEventListener("touchstart", startDraw, { passive: false });
  canvas.addEventListener("touchmove", draw, { passive: false });
  canvas.addEventListener("touchend", endDraw);

  const clearBtn = document.getElementById("clear-sig-btn");
  if (clearBtn) {
    clearBtn.addEventListener("click", () => {
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      hasDrawn = false;
      document.getElementById("typed_signature").value = "";
    });
  }
}

function getSignatureData() {
  const typed = document.getElementById("typed_signature").value.trim();
  if (hasDrawn && canvas) {
    return canvas.toDataURL("image/png");
  } else if (typed) {
    return typed;
  }
  return null;
}

// ============================================================================
// 6. FILE UPLOAD PREVIEWS
// ============================================================================
function initFileUploadPreviews() {
  setupFilePreview("passport_photo", "photo_preview", "photo_preview_img", "photo_preview_name", "photo_preview_size", true);
  setupFilePreview("dues_evidence", "dues_preview", null, "dues_preview_name", "dues_preview_size", false);
  setupFilePreview("manifesto_file", "manifesto_preview", null, "manifesto_preview_name", "manifesto_preview_size", false);
}

function setupFilePreview(inputId, previewBoxId, previewImgId, nameId, sizeId, isImageOnly) {
  const input = document.getElementById(inputId);
  const box = document.getElementById(previewBoxId);
  if (!input || !box) return;

  input.addEventListener("change", function () {
    if (this.files && this.files[0]) {
      const file = this.files[0];
      const nameEl = document.getElementById(nameId);
      const sizeEl = document.getElementById(sizeId);

      if (nameEl) nameEl.textContent = file.name;
      if (sizeEl) sizeEl.textContent = (file.size / (1024 * 1024)).toFixed(2) + " MB";

      if (isImageOnly && previewImgId) {
        const reader = new FileReader();
        reader.onload = function (e) {
          const img = document.getElementById(previewImgId);
          if (img) img.src = e.target.result;
          // Also set review photo preview
          const revImg = document.getElementById("review-passport-img");
          if (revImg) revImg.src = e.target.result;
        };
        reader.readAsDataURL(file);
      }

      box.style.display = "flex";
    } else {
      box.style.display = "none";
    }
  });
}

// ============================================================================
// 7. REVIEW SUMMARY POPULATION
// ============================================================================
function populateReviewSummary() {
  const title = document.getElementById("title").value;
  const fullName = document.getElementById("full_name").value.trim();
  const rotaryId = document.getElementById("rotary_id").value.trim();
  const position = document.getElementById("position-select").value;
  const email = document.getElementById("email").value.trim();
  const phone = document.getElementById("phone").value.trim();
  const classification = document.getElementById("classification").value.trim() || "Not Specified";
  const yearsInClub = document.getElementById("years_in_club").value.trim() || "Active Member";

  const proposerName = document.getElementById("proposer_name").value.trim();
  const proposerId = document.getElementById("proposer_rotary_id").value.trim();
  const seconderName = document.getElementById("seconder_name").value.trim();
  const seconderId = document.getElementById("seconder_rotary_id").value.trim();

  document.getElementById("rev-name").textContent = `${title} ${fullName}`;
  document.getElementById("rev-position").textContent = position;
  document.getElementById("rev-rotary-id").textContent = rotaryId;
  document.getElementById("rev-classification").textContent = classification;
  document.getElementById("rev-email").textContent = email;
  document.getElementById("rev-phone").textContent = phone;
  document.getElementById("rev-proposer").textContent = `${proposerName} (ID: ${proposerId})`;
  document.getElementById("rev-seconder").textContent = `${seconderName} (ID: ${seconderId})`;

  // President nominee conditional fields
  const presRev = document.getElementById("rev-president-block");
  if (position === "President nominee") {
    presRev.style.display = "block";
    document.getElementById("rev-board-exp").textContent = document.getElementById("board_experience").value;
    document.getElementById("rev-rli-status").textContent = document.getElementById("rli_status").value;
  } else {
    presRev.style.display = "none";
  }
}

// ============================================================================
// 8. FORM SUBMISSION VIA AJAX
// ============================================================================
function initFormSubmission() {
  const form = document.getElementById("nomination-expression-form");
  const submitBtn = document.getElementById("form-submit-btn");

  if (!form || !submitBtn) return;

  form.addEventListener("submit", function (e) {
    e.preventDefault();

    // Ensure signature data is populated
    const sigData = getSignatureData();
    if (sigData) {
      document.getElementById("signature_data").value = sigData;
    }

    const formData = new FormData(form);

    submitBtn.disabled = true;
    const origText = submitBtn.innerHTML;
    submitBtn.innerHTML = `
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="animation: spin 1s linear infinite;"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>
      Submitting Expression Form...
    `;

    fetch("api/submit.php", {
      method: "POST",
      body: formData
    })
      .then((res) => res.json())
      .then((data) => {
        submitBtn.disabled = false;
        submitBtn.innerHTML = origText;

        if (data.success) {
          // Open Success Modal with official receipt action
          showSuccessModal(data);
        } else {
          let errorMsg = data.message || data.error || "An error occurred during submission.";
          if (data.errors && Array.isArray(data.errors)) {
            errorMsg = data.errors.join("\n• ");
          }
          alert("Submission Issue:\n\n• " + errorMsg);
        }
      })
      .catch((err) => {
        submitBtn.disabled = false;
        submitBtn.innerHTML = origText;
        console.error("Submission error:", err);
        alert("Network error: Could not complete submission. Please verify your connection or try again.");
      });
  });
}

function showSuccessModal(data) {
  const modal = document.getElementById("success-modal");
  if (!modal) return;

  document.getElementById("success-modal-ref").textContent = data.ref_no;
  document.getElementById("success-modal-name").textContent = data.nominee.name;
  document.getElementById("success-modal-position").textContent = data.nominee.position;

  const receiptLink = document.getElementById("view-receipt-btn");
  if (receiptLink) {
    receiptLink.href = "receipt.php?ref=" + encodeURIComponent(data.ref_no);
  }

  modal.classList.add("active");
}

// ============================================================================
// 9. STATUS CHECKER / SUBMISSION LOOKUP TOOL
// ============================================================================
function initLookupTool() {
  const lookupBtn = document.getElementById("lookup-submit-btn");
  const lookupInput = document.getElementById("lookup-input");
  const resultCard = document.getElementById("lookup-result-card");

  if (!lookupBtn || !lookupInput || !resultCard) return;

  function performLookup() {
    const q = lookupInput.value.trim();
    if (!q) {
      alert("Please enter a Tracking Reference Number, Rotary Member ID, or Email.");
      lookupInput.focus();
      return;
    }

    lookupBtn.disabled = true;
    lookupBtn.textContent = "Searching...";

    fetch("api/lookup.php?q=" + encodeURIComponent(q))
      .then((res) => res.json())
      .then((res) => {
        lookupBtn.disabled = false;
        lookupBtn.textContent = "Check Status";

        if (res.success && res.data) {
          renderLookupResult(res.data);
        } else {
          resultCard.style.display = "block";
          resultCard.innerHTML = `
            <div style="text-align: center; color: #DC2626; padding: 16px;">
              <div style="font-size: 2rem; margin-bottom: 8px;">❌</div>
              <strong>No Submission Found</strong>
              <p style="font-size: 0.88rem; color: #64748B; margin-top: 4px;">${res.error || "Please verify your input and try again."}</p>
            </div>
          `;
        }
      })
      .catch((err) => {
        lookupBtn.disabled = false;
        lookupBtn.textContent = "Check Status";
        console.error("Lookup error:", err);
        alert("Network error while searching. Please try again.");
      });
  }

  lookupBtn.addEventListener("click", performLookup);
  lookupInput.addEventListener("keypress", (e) => {
    if (e.key === "Enter") performLookup();
  });
}

function renderLookupResult(item) {
  const card = document.getElementById("lookup-result-card");
  if (!card) return;

  let statusBadge = "";
  if (item.screening_status === "SCREENED_CLEARED") {
    statusBadge = `<span style="background: #DCFCE7; color: #16A34A; padding: 4px 12px; border-radius: 20px; font-weight: 700; font-size: 0.82rem;">✔ SCREENED & CLEARED</span>`;
  } else if (item.screening_status === "DISQUALIFIED") {
    statusBadge = `<span style="background: #FEE2E2; color: #DC2626; padding: 4px 12px; border-radius: 20px; font-weight: 700; font-size: 0.82rem;">✖ DISQUALIFIED</span>`;
  } else {
    statusBadge = `<span style="background: #FEF3C7; color: #D97706; padding: 4px 12px; border-radius: 20px; font-weight: 700; font-size: 0.82rem;">⏳ PENDING SCREENING</span>`;
  }

  card.style.display = "block";
  card.innerHTML = `
    <div style="display: flex; justify-content: space-between; align-items: flex-start; border-bottom: 1px solid #E2E8F0; padding-bottom: 12px; margin-bottom: 16px; flex-wrap: wrap; gap: 8px;">
      <div>
        <div style="font-size: 0.75rem; color: #64748B; text-transform: uppercase; font-weight: 700;">Nominee Verification</div>
        <h4 style="font-size: 1.25rem; color: #00246C; margin: 2px 0 0 0;">${item.title || ""} ${item.full_name}</h4>
      </div>
      <div>${statusBadge}</div>
    </div>

    <div class="lookup-grid" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; font-size: 0.88rem; margin-bottom: 18px;">
      <div><span style="color: #64748B;">Reference No:</span> <strong>${item.ref_no}</strong></div>
      <div><span style="color: #64748B;">Office Contesting:</span> <strong style="color: #B45309;">${item.position}</strong></div>
      <div><span style="color: #64748B;">Rotary ID:</span> <strong>${item.rotary_id}</strong></div>
      <div><span style="color: #64748B;">Date Submitted:</span> <strong>${item.created_at}</strong></div>
      <div><span style="color: #64748B;">Proposer:</span> <strong>${item.proposer_name}</strong></div>
      <div><span style="color: #64748B;">Seconder:</span> <strong>${item.seconder_name}</strong></div>
    </div>

    ${item.screening_notes ? `
      <div style="background: #FEF2F2; border-left: 3px solid #EF4444; padding: 10px 14px; border-radius: 4px; font-size: 0.85rem; color: #991B1B; margin-bottom: 16px;">
        <strong>Committee Note:</strong> ${item.screening_notes}
      </div>
    ` : ''}

    <div style="display: flex; gap: 10px; justify-content: flex-end;">
      <a href="receipt.php?ref=${encodeURIComponent(item.ref_no)}" target="_blank" class="btn btn-primary btn-sm">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9V2h12v7M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><path d="M6 14h12v8H6z"/></svg>
        View &amp; Print Official Receipt
      </a>
    </div>
  `;
}

// ============================================================================
// 10. LIGHTBOX FOR NOTICE FLYER
// ============================================================================
function initLightbox() {
  const trigger = document.getElementById("open-flyer-lightbox");
  const modal = document.getElementById("flyer-lightbox-modal");
  const closeBtns = document.querySelectorAll(".close-lightbox");

  if (trigger && modal) {
    trigger.addEventListener("click", () => modal.classList.add("active"));
  }

  closeBtns.forEach((btn) => {
    btn.addEventListener("click", () => {
      document.querySelectorAll(".modal-backdrop").forEach((m) => m.classList.remove("active"));
    });
  });

  // Close on backdrop click
  document.querySelectorAll(".modal-backdrop").forEach((m) => {
    m.addEventListener("click", (e) => {
      if (e.target === m) m.classList.remove("active");
    });
  });
}

// ============================================================================
// 11. MOBILE NAVIGATION DRAWER
// ============================================================================
function initMobileNav() {
  const toggle = document.querySelector(".nav-toggle");
  const navLinks = document.querySelector(".nav-links");

  if (!toggle || !navLinks) return;

  // Create mobile overlay backdrop if not present
  let overlay = document.querySelector(".nav-mobile-overlay");
  if (!overlay) {
    overlay = document.createElement("div");
    overlay.className = "nav-mobile-overlay";
    document.body.appendChild(overlay);
  }

  function openMenu() {
    navLinks.classList.add("menu-open");
    toggle.classList.add("is-active");
    toggle.setAttribute("aria-expanded", "true");
    overlay.classList.add("active");
    document.body.style.overflow = "hidden";
  }

  function closeMenu() {
    navLinks.classList.remove("menu-open");
    toggle.classList.remove("is-active");
    toggle.setAttribute("aria-expanded", "false");
    overlay.classList.remove("active");
    document.body.style.overflow = "";
  }

  toggle.addEventListener("click", (e) => {
    e.stopPropagation();
    if (navLinks.classList.contains("menu-open")) {
      closeMenu();
    } else {
      openMenu();
    }
  });

  overlay.addEventListener("click", closeMenu);

  // Auto-close when tapping any navigation link
  navLinks.querySelectorAll("a").forEach((link) => {
    link.addEventListener("click", () => {
      closeMenu();
    });
  });

  // Close on Escape key
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && navLinks.classList.contains("menu-open")) {
      closeMenu();
    }
  });

  // Close if window resized to desktop
  window.addEventListener("resize", () => {
    if (window.innerWidth > 768 && navLinks.classList.contains("menu-open")) {
      closeMenu();
    }
  });
}

// ============================================================================
// 12. SCROLL-DRIVEN REVEAL SYSTEM
// ============================================================================
function initScrollReveals() {
  const elements = document.querySelectorAll('.reveal-on-scroll, .reveal-scale, .reveal-left, .reveal-right');
  if (!elements.length) return;

  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-revealed');
          observer.unobserve(entry.target);
        }
      });
    }, {
      root: null,
      rootMargin: '0px 0px -40px 0px',
      threshold: 0.1
    });

    elements.forEach(el => observer.observe(el));
  } else {
    elements.forEach(el => el.classList.add('is-revealed'));
  }
}

// ============================================================================
// 13. INTERACTIVE 3D HERO PARALLAX
// ============================================================================
function initHeroParallax() {
  const hero = document.getElementById('home');
  const card3d = document.getElementById('hero-3d-card');
  const bgWheel = document.querySelector('.hero-bg-rotary-wheel');
  const orb1 = document.querySelector('.hero-orb-1');
  const orb2 = document.querySelector('.hero-orb-2');

  if (!hero || !card3d) return;

  // Disable 3D tilt tracking on mobile / touchscreens for smooth scrolling & performance
  if (window.innerWidth < 768 || window.matchMedia("(hover: none) and (pointer: coarse)").matches) {
    return;
  }

  let mouseX = 0, mouseY = 0;
  let targetX = 0, targetY = 0;
  let isMoving = false;

  hero.addEventListener('mousemove', (e) => {
    const rect = hero.getBoundingClientRect();
    const x = e.clientX - rect.left - rect.width / 2;
    const y = e.clientY - rect.top - rect.height / 2;

    targetX = x / (rect.width / 2); // -1 to 1
    targetY = y / (rect.height / 2); // -1 to 1

    if (!isMoving) {
      isMoving = true;
      requestAnimationFrame(updateParallax);
    }
  });

  hero.addEventListener('mouseleave', () => {
    targetX = 0;
    targetY = 0;
  });

  function updateParallax() {
    mouseX += (targetX - mouseX) * 0.08;
    mouseY += (targetY - mouseY) * 0.08;

    // 3D card tilt
    const rotateY = mouseX * 7;
    const rotateX = -mouseY * 7;
    card3d.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;

    // Background wheel shift
    if (bgWheel) {
      bgWheel.style.transform = `translate(${mouseX * -18}px, ${mouseY * -18}px)`;
    }

    // Floating orbs shift
    if (orb1) {
      orb1.style.transform = `translate(${mouseX * 22}px, ${mouseY * 22}px)`;
    }
    if (orb2) {
      orb2.style.transform = `translate(${mouseX * -25}px, ${mouseY * -25}px)`;
    }

    if (Math.abs(targetX - mouseX) > 0.001 || Math.abs(targetY - mouseY) > 0.001) {
      requestAnimationFrame(updateParallax);
    } else {
      isMoving = false;
    }
  }
}

// ============================================================================
// 14. ANIMATED COUNTER FOR STATS
// ============================================================================
function initAnimatedCounters() {
  const counters = document.querySelectorAll('.counter-num');
  if (!counters.length) return;

  counters.forEach(counter => {
    const target = parseInt(counter.getAttribute('data-target') || counter.textContent);
    if (isNaN(target)) return;

    let count = 0;
    const speed = 40;
    const step = Math.max(1, Math.floor(target / 15));

    counter.textContent = '0';
    const timer = setInterval(() => {
      count += step;
      if (count >= target) {
        counter.textContent = target;
        clearInterval(timer);
      } else {
        counter.textContent = count;
      }
    }, speed);
  });
}

