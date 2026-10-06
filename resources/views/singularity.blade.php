<!-- Preloader Screen -->
<div class="preloader" id="preloader">
  <div class="preloader-content">
    <div class="preloader-singularity-glyph"></div>
    <div class="preloader-title">SINGULARITY KERNEL</div>
    <div class="preloader-sub" id="preloaderStatus">WARPING SPACETIME COORDINATES</div>
    <div class="preloader-bar-wrap" id="preloaderBarWrap">
      <div class="preloader-bar" id="preloaderBar"></div>
    </div>
    <div class="preloader-percent" id="preloaderPercent">0%</div>
    <button class="launch-btn is-hidden" id="launchBtn">
      <span>GO TO SURFACE & DIVE ➔</span>
    </button>
  </div>
</div>

<!-- Main Viewport Canvas Stages -->
<div class="canvas-viewport" id="canvasViewport">
  <!-- Stage 1: Exterior Black Hole Video Canvas -->
  <div id="stage" class="stage">
    <canvas id="videoCanvas"></canvas>
  </div>

  <!-- Stage 2: Deep Interior Singularity Kernel Canvas -->
  <div id="kernelStage" class="kernel-stage">
    <canvas id="kernelCanvas"></canvas>
  </div>

  <!-- Stage 3: Transcendent 5D Tesseract Hypercube (Three.js WebGL) -->
  <div id="tesseractStage" class="tesseract-stage">
    <canvas id="tesseractCanvas"></canvas>
  </div>

  <!-- Pure Cinematic Wormhole Traversal Stage (NO TEXTS, NO BUTTONS) -->
  <div id="wormholeStage" class="wormhole-stage" aria-hidden="true">
    <video id="wormholeVideo" class="wormhole-video" preload="auto" playsinline>
      <source src="{{ asset('videos/wormhole_warp.mp4') }}" type="video/mp4">
    </video>
  </div>

  <!-- Spacetime Metric Rupture Flash (Top-most transition flash directly into Main Website) -->
  <div id="ruptureFlash" class="rupture-flash"></div>
</div>

<!-- Minimal Sleek Skip Pill during descent straight to personal website -->
<button class="autopilot-skip-pill" id="autopilotSkipBtn" title="Skip descent straight to Personal Website">
  <span class="skip-pill-dot"></span>
  <span class="skip-pill-text">SKIP TO WEBSITE ⏭</span>
</button>

<!-- WHO AM I? Direct Identity Climax Trigger (Active inside Singularity) -->
<button class="who-am-i-hud-btn" id="whoAmIBtn" title="Decode Identity & Trigger Wormhole Climax">
  <span class="who-pulse-dot"></span>
  <span class="who-text">WHO AM I? ✦</span>
</button>


<!-- Audio Acoustic Controller (Top-Right) -->
<div class="hud-audio" id="hudAudio">
  <button class="audio-btn" id="audioToggleBtn" title="Hans Zimmer - Organ Variation (Toggle)">
    <div class="audio-equalizer" id="audioEqualizer">
      <div class="eq-bar" id="eqBar1"></div>
      <div class="eq-bar" id="eqBar2"></div>
      <div class="eq-bar" id="eqBar3"></div>
      <div class="eq-bar" id="eqBar4"></div>
    </div>
    <span id="audioBtnText">HANS ZIMMER</span>
  </button>
  <input type="range" min="0" max="1" step="0.05" value="0.85" class="audio-vol-slider" id="audioVolSlider" title="Master Audio Gain">
  <button class="audio-credits-btn" id="audioCreditsBtn" title="Soundtrack Copyright & Attribution Rights">
    <span>© CREDITS</span>
  </button>
</div>

<!-- Audio Unlock Prompt Banner -->
<div class="audio-banner" id="audioBanner">
  <span>✦ ACTIVATE TRANSMISSION (HANS ZIMMER - ORGAN VARIATION)</span>
</div>

<!-- WASD / Space / Q Navigation Controls Indicator -->
<div class="hud-controls-hint" id="hudControlsHint">
  <div class="wasd-keys">
    <div class="key-row">
      <span class="key-badge" title="Ascend UP">E</span>
      <span class="key-badge" title="Move Forward">W</span>
      <span class="key-badge" title="Descend DOWN">Q</span>
    </div>
    <div class="key-row">
      <span class="key-badge" title="Strafe Left">A</span>
      <span class="key-badge" title="Move Back">S</span>
      <span class="key-badge" title="Strafe Right">D</span>
    </div>
  </div>
  <div class="controls-label">
    <span>FREE SPACETIME FLIGHT (NO LIMITS)</span>
    <span class="controls-sub">MOUSE SCROLL: SECTIONS • KEYS: FREE 5D TRAVEL</span>
  </div>
</div>

<!-- Scientific Telemetry HUD (Bottom-Left) -->
<div class="hud-telemetry" id="hudTelemetry">
  <div class="telemetry-row">
    <span class="telemetry-label">HORIZON STATUS:</span>
    <span class="telemetry-value" id="hudStatus">ACCRETION ORBIT // STABLE</span>
  </div>
  <div class="telemetry-row">
    <span class="telemetry-label">SECTOR:</span>
    <span class="telemetry-value" id="telemetrySector">00 // GARGANTUA ERGOSPHERE</span>
  </div>
  <div class="telemetry-row">
    <span class="telemetry-label">METRIC TENSOR:</span>
    <span class="telemetry-value" id="telemetryMetric">g_μν = diag(-1, 1, 1, 1)</span>
  </div>
  <div class="telemetry-row">
    <span class="telemetry-label">GEODESIC COORD:</span>
    <span class="telemetry-value" id="telemetryCoord">r = 12.45 M // θ = 90.0°</span>
  </div>
  <div class="telemetry-row">
    <span class="telemetry-label">TIME DILATION:</span>
    <span class="telemetry-value" id="telemetryTime">dτ/dt = 0.985 (OBSERVER REF)</span>
  </div>
  <div class="telemetry-row">
    <span class="telemetry-label">5D BULK PROJECTION:</span>
    <span class="telemetry-value" id="telemetryBulk">DIM_5 = COLLAPSED // COMPACTIFIED</span>
  </div>
</div>

<!-- Discrete Scroll Section Timeline Navigation -->
<nav class="hud-timeline" id="hudTimeline" aria-label="Spacetime Chronology Navigation">
  <button class="nav-arrow-btn" id="prevStepBtn" title="Previous Section">‹</button>
  @foreach($sections as $sec)
    <button class="timeline-step tesseract-step {{ $sec['step'] === 0 ? 'is-active' : '' }}" data-step="{{ $sec['step'] }}" id="step{{ $sec['step'] }}">{{ $sec['title'] }}</button>
  @endforeach
  <button class="nav-arrow-btn" id="nextStepBtn" title="Next Section">›</button>
</nav>

<!-- Interactive "Do you now know who I am?" Modal Prompt -->
<div class="identity-modal-backdrop" id="identityModal" role="dialog" aria-modal="true" aria-hidden="true">
  <div class="identity-card">
    <div class="identity-pulse-ring"></div>
    <div class="identity-avatar-wrap">
      <img src="{{ $author['avatar'] }}" alt="{{ $author['name'] }}" class="identity-avatar">
    </div>
    <span class="identity-tag">QUANTUM TELEMETRY DECODED</span>
    <h2 class="identity-question">Do you now know who I am?</h2>
    <p class="identity-desc">You have traversed the 5D spacetime singularity and decrypted all memory chambers.</p>
    <div class="identity-actions">
      <button class="identity-btn-yes" id="identityYesBtn">
        <span>YES, ENTER MAIN WEBSITE ➔</span>
      </button>
      <button class="identity-btn-no" id="identityNoBtn">
        <span>CONTINUE EXPLORING TESSERACT</span>
      </button>
    </div>
  </div>
</div>

<!-- Reality Chamber Detailed Dossier Modal -->
<div class="modal-backdrop" id="modalBackdrop" role="dialog" aria-modal="true" aria-hidden="true">
  <div class="modal-card">
    <button class="modal-close-btn" id="modalCloseBtn" aria-label="Close Dossier">&times;</button>
    <div class="modal-timeline-tag" id="modalTag">TIMELINE COORD // 2026.1</div>
    <h2 class="modal-title" id="modalTitle">Section Title</h2>
    <div class="modal-subtitle" id="modalSubtitle">Subsystem description & purpose</div>
    <div class="modal-formula-box" id="modalFormula">Formula or technical specification</div>
    <div class="modal-body" id="modalBody">
      <!-- Injected via JavaScript -->
    </div>
    <div class="modal-actions" id="modalActions">
      <!-- Injected via JavaScript -->
    </div>
  </div>
</div>

<!-- Music Copyright & Licensing Attribution Modal -->
<div class="modal-backdrop" id="creditsModal" role="dialog" aria-modal="true" aria-hidden="true">
  <div class="modal-card credits-card">
    <button class="modal-close-btn" id="creditsCloseBtn" aria-label="Close Credits">&times;</button>
    <div class="modal-timeline-tag">INTELLECTUAL PROPERTY & ATTRIBUTION</div>
    <h2 class="modal-title">"{{ $soundtrack['track'] }}"</h2>
    <div class="modal-subtitle">Master Recording & Musical Composition Notice</div>
    
    <div class="credits-meta-grid">
      <div class="credits-meta-item">
        <span class="c-label">COMPOSER</span>
        <span class="c-val"><strong>{{ $soundtrack['composer'] }}</strong></span>
      </div>
      <div class="credits-meta-item">
        <span class="c-label">ORIGINAL ALBUM</span>
        <span class="c-val">{{ $soundtrack['album'] }}</span>
      </div>
      <div class="credits-meta-item">
        <span class="c-label">RECORD LABEL</span>
        <span class="c-val">{{ $soundtrack['label'] }} ({{ $soundtrack['year'] }})</span>
      </div>
      <div class="credits-meta-item">
        <span class="c-label">PUBLISHING RIGHTS</span>
        <span class="c-val">{{ $soundtrack['publishing'] }}</span>
      </div>
      <div class="credits-meta-item full-width">
        <span class="c-label">COPYRIGHT REGISTRATION</span>
        <span class="c-val highlight-gold">{{ $soundtrack['copyright'] }}</span>
      </div>
    </div>

    <div class="credits-disclaimer-box">
      <strong>FAIR USE / PORTFOLIO DEMONSTRATION NOTICE:</strong>
      <p>{{ $soundtrack['fair_use_notice'] }}</p>
    </div>

    <div class="modal-actions">
      <a href="{{ $soundtrack['official_stream_url'] }}" target="_blank" rel="noopener noreferrer" class="credits-official-btn">
        <span>VISIT OFFICIAL WATERTOWER MUSIC RELEASE ↗</span>
      </a>
    </div>
  </div>
</div>

<!-- Ambient Cinematic Grain & Vignette Layer -->
<div class="vignette-overlay" aria-hidden="true"></div>

<!-- Deep Scroll Distance -->
<div class="scroll-container"></div>
