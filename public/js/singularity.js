(() => {
  // 1,081 frames extracted at 20 fps strictly spanning 0:11.000 to 1:05.000
  const FRAME_COUNT = 1081;
  const START_TIME_SEC = 11.0;
  const DURATION_SEC = 54.0;
  const getFrameUrl = (index) => `/frames/frame_${String(index + 1).padStart(4, '0')}.webp`;

  // DOM Elements
  const videoCanvas = document.getElementById('videoCanvas');
  const kernelCanvas = document.getElementById('kernelCanvas');
  const tesseractCanvas = document.getElementById('tesseractCanvas');
  const stage = document.getElementById('stage');
  const kernelStage = document.getElementById('kernelStage');
  const tesseractStage = document.getElementById('tesseractStage');
  const ruptureFlash = document.getElementById('ruptureFlash');

  // Preloader Elements
  const preloader = document.getElementById('preloader');
  const preloaderBar = document.getElementById('preloaderBar');
  const preloaderPercent = document.getElementById('preloaderPercent');
  const preloaderStatus = document.getElementById('preloaderStatus');
  const preloaderBarWrap = document.getElementById('preloaderBarWrap');
  const launchBtn = document.getElementById('launchBtn');

  // Autopilot Elements
  const autopilotSkipBtn = document.getElementById('autopilotSkipBtn');

  // Interstellar Wormhole & Saturn Emergence Elements
  const wormholeStage = document.getElementById('wormholeStage');
  const wormholeVideo = document.getElementById('wormholeVideo');
  const saturnStage = document.getElementById('saturnStage');
  const saturnContent = document.getElementById('saturnContent');
  const enterSiteBtn = document.getElementById('enterSiteBtn');
  const replaySingularityBtn = document.getElementById('replaySingularityBtn');
  const identityModal = document.getElementById('identityModal');
  const identityYesBtn = document.getElementById('identityYesBtn');
  const identityNoBtn = document.getElementById('identityNoBtn');
  const hudControlsHint = document.getElementById('hudControlsHint');

  // Telemetry HUD Elements
  const hudStatus = document.getElementById('hudStatus');
  const telemetrySector = document.getElementById('telemetrySector');
  const telemetryMetric = document.getElementById('telemetryMetric');
  const telemetryCoord = document.getElementById('telemetryCoord');
  const telemetryTime = document.getElementById('telemetryTime');
  const telemetryBulk = document.getElementById('telemetryBulk');
  const hudScrollHint = document.getElementById('hudScrollHint');
  const timelineSteps = document.querySelectorAll('.timeline-step');
  const prevStepBtn = document.getElementById('prevStepBtn');
  const nextStepBtn = document.getElementById('nextStepBtn');

  // Audio HUD Elements
  const audioToggleBtn = document.getElementById('audioToggleBtn');
  const audioBtnText = document.getElementById('audioBtnText');
  const audioVolSlider = document.getElementById('audioVolSlider');
  const audioBanner = document.getElementById('audioBanner');
  const eqBars = [
    document.getElementById('eqBar1'),
    document.getElementById('eqBar2'),
    document.getElementById('eqBar3'),
    document.getElementById('eqBar4')
  ];

  // Modal Elements
  const modalBackdrop = document.getElementById('modalBackdrop');
  const modalCloseBtn = document.getElementById('modalCloseBtn');
  const modalTag = document.getElementById('modalTag');
  const modalTitle = document.getElementById('modalTitle');
  const modalSubtitle = document.getElementById('modalSubtitle');
  const modalFormula = document.getElementById('modalFormula');
  const modalBody = document.getElementById('modalBody');
  const modalActions = document.getElementById('modalActions');

  const videoCtx = videoCanvas.getContext('2d', { alpha: false });
  const kernelCtx = kernelCanvas.getContext('2d');

  // Progressive frame storage & tracking
  const images = new Array(FRAME_COUNT).fill(null);
  const requested = new Uint8Array(FRAME_COUNT);
  const loaded = new Uint8Array(FRAME_COUNT);
  let loadedFramesCount = 0;
  const READY_THRESHOLD = 30;

  let width = window.innerWidth;
  let height = window.innerHeight;
  let dpr = Math.min(window.devicePixelRatio || 1, 2);

  // Flight & State Management
  let currentProgress = 0;
  let targetProgress = 0;
  let currentFrame = 0;
  let lastTime = performance.now();
  let animationFrameId = null;
  let isRevealed = false;
  let audioUnlocked = false;

  // Auto-dive mechanism
  let isAutoDiving = false;
  let autoDiveStartTime = 0;
  const AUTO_DIVE_DURATION = 14.5;
  let hasRupturedSound = false;
  let isInSingularity = false;
  let isSaturnActive = false;
  let isWormholeActive = false;
  let isCollapsingCube = false;
  let collapseStartTime = 0;

  // Discrete Step Navigation in Singularity ("Sequel" style)
  // 0: Overview, 1: About, 2: Projects, 3: Publications, 4: My Playlist, 5: Favorite Books, 6: Contact
  let currentStep = 0;
  const MAX_STEP = 6;
  let isStepLocked = false;
  let stepLockTimeout = null;

  // -------------------------------------------------------------
  // INFINITE 5D SPACETIME FREE FLIGHT CONTROLS (NO LIMITS)
  // Unrestricted, unbounded navigation in all dimensions:
  // WASD / Arrows : Forward, Backward, Strafe Left, Strafe Right
  // E / Space / PageUp : Fly UP (+Y) with NO LIMIT
  // Q / Shift / C / PageDown : Fly DOWN (-Y) with NO LIMIT
  // Mouse Scroll : Old discrete step timeline navigation
  // Mouse Move : Smooth cinematic parallax tilt
  // -------------------------------------------------------------
  const keys = {
    forward: false,
    backward: false,
    left: false,
    right: false,
    up: false,
    down: false
  };

  let freeFlightPos = (typeof THREE !== 'undefined' && THREE.Vector3) ? new THREE.Vector3(0, 45, 1250) : { x: 0, y: 45, z: 1250, copy: () => {}, add: () => {}, lerp: () => {}, set: () => {} };
  let freeFlightVel = (typeof THREE !== 'undefined' && THREE.Vector3) ? new THREE.Vector3(0, 0, 0) : { x: 0, y: 0, z: 0, multiplyScalar: () => {}, addScaledVector: () => {}, set: () => {} };
  let targetStationPos = (typeof THREE !== 'undefined' && THREE.Vector3) ? new THREE.Vector3(0, 45, 1250) : { x: 0, y: 45, z: 1250 };
  let targetStationLook = (typeof THREE !== 'undefined' && THREE.Vector3) ? new THREE.Vector3(0, 0, -800) : { x: 0, y: 0, z: -800 };
  let isNavigatingToStation = false;

  // WHO AM I? Direct Climax Trigger Button
  const whoAmIBtn = document.getElementById('whoAmIBtn');

  // Mouse parallax coordinates
  let mouseX = 0;
  let mouseY = 0;
  let targetMouseX = 0;
  let targetMouseY = 0;

  window.addEventListener('mousemove', (e) => {
    targetMouseX = (e.clientX - width / 2) / (width / 2);
    targetMouseY = (e.clientY - height / 2) / (height / 2);
  }, { passive: true });

  window.addEventListener('keydown', (e) => {
    const k = e.key ? e.key.toLowerCase() : '';
    const code = e.code || '';

    let matched = false;
    if (k === 'w' || code === 'KeyW' || code === 'ArrowUp') { keys.forward = true; matched = true; }
    if (k === 's' || code === 'KeyS' || code === 'ArrowDown') { keys.backward = true; matched = true; }
    if (k === 'a' || code === 'KeyA' || code === 'ArrowLeft') { keys.left = true; matched = true; }
    if (k === 'd' || code === 'KeyD' || code === 'ArrowRight') { keys.right = true; matched = true; }
    if (k === 'e' || code === 'KeyE' || code === 'Space' || code === 'PageUp') { keys.up = true; matched = true; }
    if (k === 'q' || code === 'KeyQ' || code === 'ShiftLeft' || code === 'ShiftRight' || k === 'c' || code === 'KeyC' || code === 'PageDown') { keys.down = true; matched = true; }

    if (matched && isInSingularity) {
      isNavigatingToStation = false;
      startLoopIfNeeded();
    }
  });

  window.addEventListener('keyup', (e) => {
    const k = e.key ? e.key.toLowerCase() : '';
    const code = e.code || '';

    if (k === 'w' || code === 'KeyW' || code === 'ArrowUp') keys.forward = false;
    if (k === 's' || code === 'KeyS' || code === 'ArrowDown') keys.backward = false;
    if (k === 'a' || code === 'KeyA' || code === 'ArrowLeft') keys.left = false;
    if (k === 'd' || code === 'KeyD' || code === 'ArrowRight') keys.right = false;
    if (k === 'e' || code === 'KeyE' || code === 'Space' || code === 'PageUp') keys.up = false;
    if (k === 'q' || code === 'KeyQ' || code === 'ShiftLeft' || code === 'ShiftRight' || k === 'c' || code === 'KeyC' || code === 'PageDown') keys.down = false;
  });

  if (whoAmIBtn) {
    whoAmIBtn.addEventListener('click', () => {
      unlockAudio();
      executeInterstellarEmergence();
    });
  }


  // -------------------------------------------------------------
  // AUDIO & PRELOADER CONTROLLER
  // -------------------------------------------------------------
  audioUnlocked = false;

  const unlockEvents = ['click', 'pointerdown', 'keydown', 'touchstart'];
  function removeUnlockListeners() {
    unlockEvents.forEach(evt => {
      window.removeEventListener(evt, unlockAudio);
    });
  }

  function unlockAudio(e) {
    // If the click is directly on an audio control button, don't auto-unlock here; let the toggle button handle it!
    if (e && e.target && (e.target.closest('#taskbar-audio-toggle') || e.target.closest('#audioToggleBtn'))) {
      return;
    }

    if (audioUnlocked) return;
    if (window.spacetimeAudio && window.spacetimeAudio.userHasPaused) return;

    if (window.spacetimeAudio) {
      window.spacetimeAudio.resumeContext();
      if (window.spacetimeAudio.audioElement && !window.spacetimeAudio.audioElement.paused) {
        audioUnlocked = true;
        if (audioBanner) audioBanner.classList.add('is-dismissed');
        removeUnlockListeners();
      }
    }
  }

  unlockEvents.forEach(evt => {
    window.addEventListener(evt, unlockAudio, { passive: true });
  });

  if (audioBanner) {
    audioBanner.addEventListener('click', (e) => {
      e.stopPropagation();
      if (window.spacetimeAudio) window.spacetimeAudio.playTrack();
      if (audioBanner) audioBanner.classList.add('is-dismissed');
    });
  }

  if (audioToggleBtn) {
    audioToggleBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      if (window.spacetimeAudio) {
        const isPlaying = window.spacetimeAudio.togglePlayPause();
        if (audioBtnText) audioBtnText.textContent = isPlaying ? "HANS ZIMMER" : "PAUSED";
      }
    });
  }

  if (audioVolSlider) {
    audioVolSlider.addEventListener('input', (e) => {
      if (window.spacetimeAudio) {
        window.spacetimeAudio.setVolume(parseFloat(e.target.value));
      }
    });
  }

  // Soundtrack Copyright & Attribution Modal
  const audioCreditsBtn = document.getElementById('audioCreditsBtn');
  const creditsModal = document.getElementById('creditsModal');
  const creditsCloseBtn = document.getElementById('creditsCloseBtn');

  if (audioCreditsBtn && creditsModal) {
    audioCreditsBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      creditsModal.classList.add('is-open');
      creditsModal.setAttribute('aria-hidden', 'false');
    });
  }

  if (creditsCloseBtn && creditsModal) {
    creditsCloseBtn.addEventListener('click', () => {
      creditsModal.classList.remove('is-open');
      creditsModal.setAttribute('aria-hidden', 'true');
    });
  }

  if (creditsModal) {
    creditsModal.addEventListener('click', (e) => {
      if (e.target === creditsModal) {
        creditsModal.classList.remove('is-open');
        creditsModal.setAttribute('aria-hidden', 'true');
      }
    });
  }

  function updatePreloader() {
    loadedFramesCount++;
    const percent = Math.min(100, Math.round((loadedFramesCount / 65) * 100));
    if (preloaderBar) preloaderBar.style.width = `${percent}%`;
    if (preloaderPercent) preloaderPercent.textContent = `${percent}%`;

    if (loadedFramesCount >= READY_THRESHOLD && launchBtn && launchBtn.classList.contains('is-hidden')) {
      revealLaunchButton();
    }
  }

  function revealLaunchButton() {
    if (launchBtn && launchBtn.classList.contains('is-hidden')) {
      launchBtn.classList.remove('is-hidden');
      if (preloaderStatus) preloaderStatus.textContent = "SPACETIME METRIC READY • SCROLL MOUSE / CLICK DIVE ➔";
      if (preloaderBarWrap) preloaderBarWrap.style.opacity = '0.35';
    }
    if (stage) {
      stage.classList.add('is-ready');
      stage.style.opacity = '1';
    }
    renderVideo();
  }

  // Automatic failsafe: reveal launch button within 1.5s regardless of network or local caching
  setTimeout(() => {
    revealLaunchButton();
  }, 1500);

  // Launch Button: "GO TO SURFACE & DIVE"
  function startAutoDive() {
    unlockAudio();
    if (preloader) {
      preloader.classList.add('is-dismissed');
      setTimeout(() => { if (preloader) preloader.style.display = 'none'; }, 600);
    }
    isAutoDiving = true;
    autoDiveStartTime = performance.now();
    hasRupturedSound = false;
    isInSingularity = false;
    if (stage) {
      stage.style.display = 'block';
      stage.style.opacity = '1';
      stage.classList.add('is-ready');
    }
    if (kernelStage) kernelStage.style.display = 'block';
    if (autopilotSkipBtn) autopilotSkipBtn.classList.add('is-active');
    startLoopIfNeeded();
  }

  if (launchBtn) launchBtn.addEventListener('click', startAutoDive);
  if (preloader) {
    preloader.addEventListener('click', () => {
      if (launchBtn && !launchBtn.classList.contains('is-hidden')) {
        startAutoDive();
      }
    });
  }

  // Autopilot Skip Button: "SKIP TO WEBSITE"
  if (autopilotSkipBtn) {
    autopilotSkipBtn.addEventListener('click', () => {
      if (typeof window._triggerMainWebsiteTransition === 'function') {
        window._triggerMainWebsiteTransition();
      } else {
        enterSingularity();
      }
    });
  }

  /* =========================================================================
     1. REALITY CHAMBERS DATA SPECIFICATIONS (Parsa Besharat / parsabe.com)
     ========================================================================= */
  const REALITY_DATA = [
    {
      id: 'about',
      index: 0,
      stepNumber: 1,
      timelineCoord: 'ABOUT // AI RESEARCHER & ENGINEER',
      title: 'Parsa Besharat: AI Researcher & Engineer',
      subtitle: "Master's Degree in Data Science @ TU Bergakademie Freiberg • AI Engineer & Data Scientist",
      formula: 'TU FREIBERG, SAXONY, GERMANY  |  DATA SCIENCE & AGENTIC AI',
      photo: 'images/profile.jpg',
      frameColor: 0xffb700,
      body: `
        <p>I am a Persian AI Researcher, currently pursuing my MS.c degree in Data Science at the TU Bergakademie Freiberg in Sachsen, Germany. Bringing together Artificial Intelligence, Data Science, Software, and IT Engineering defines my professional vision.</p>
        <h4 style="color:#ffb700;margin:1rem 0 0.4rem;font-size:0.95rem;">Work Experience</h4>
        <ul>
          <li><strong>TU Bergakademie Freiberg (May 2025 – Present):</strong> Working Student AI Engineer — Local LLMs, Agentic AI, Azure Data Factory, Azure ML, Microsoft Fabric.</li>
          <li><strong>TU Bergakademie Freiberg (Jan 2025 – May 2025):</strong> Working Student Data Scientist — Deep Learning & NI LabVIEW.</li>
          <li><strong>TU Bergakademie Freiberg (Sep 2024 – Dec 2024):</strong> Working Student Software Engineer — DBT, Snowflake, Kali Linux.</li>
          <li><strong>SAPCO (Sep 2022 – Sep 2023):</strong> AI Engineer — Responsible AI, Generative AI, NLP, Local LLMs, Deep Learning.</li>
          <li><strong>SAPCO (Jan 2022 – Sep 2022):</strong> Data Scientist — Machine Learning, Power BI, Python.</li>
          <li><strong>ApexTeam (May 2020 – Jan 2022):</strong> Data Scientist & Software Engineer — Deep Learning, PostgreSQL, Laravel, Nginx.</li>
        </ul>
        <h4 style="color:#ffb700;margin:1rem 0 0.4rem;font-size:0.95rem;">Education & Certifications</h4>
        <ul>
          <li><strong>TU Bergakademie Freiberg:</strong> Master's Degree – Data Science and Data Processing & AI Technology (2023 – Present).</li>
          <li><strong>Islamic Azad University:</strong> Bachelor's Degree – Computer Engineering (2018 – 2023).</li>
          <li><strong>Certificates:</strong> PMI AI & Business Strategy • Microsoft AZ-900 Azure Fundamentals • Microsoft PL-300 Power BI Data Analyst Associate • Harvard CS50 AI with Python.</li>
        </ul>
      `,
      actions: [
        { label: 'View Profile on parsabe.com', href: 'https://parsabe.com/about', primary: true },
        { label: 'Connect on LinkedIn', href: 'https://www.linkedin.com/in/parsabe', primary: false }
      ],
      zCoord: 600,
      xCoord: -180,
      yCoord: 10
    },
    {
      id: 'projects',
      index: 1,
      stepNumber: 2,
      timelineCoord: 'PROJECTS // CUTTING-EDGE SYSTEMS',
      title: 'Featured Projects: Vision & Spatial Computing',
      subtitle: 'AquaPulse, Vectra Framework, VECTRA PC Game, BlackWall, MLMatrix & Tools',
      formula: 'YOLOv11 • BotSORT • EnKF • 3D GAUSSIAN SPLATTING • LLM RUNTIMES',
      photo: 'images/IMG_0490.jpg',
      frameColor: 0x00d2ff,
      body: `
        <p>A portfolio of engineering breakthroughs spanning physical AI, spatial computing, autonomous guardrails, and cryptographic gaming:</p>
        <ul>
          <li><strong>AquaPulse:</strong> Multi-model YOLO neural vision, BotSORT tracking, Ensemble Kalman Filtering stochastic data assimilation, and local generative AI reports for aquatic ecosystems.</li>
          <li><strong>Vectra Framework:</strong> An end-to-end spatial computing framework engineered to generate, extract, and simulate high-fidelity 3D objects directly from visual and textual data.</li>
          <li><strong>VECTRA: Matrix PC Game:</strong> An immersive first-person 3D cinematic Matrix game built in Unity C#, featuring Suno Bark AI voice generation, Ollama LLM Operator integration, and cryptographic mainframe puzzles.</li>
          <li><strong>BlackWall:</strong> A domain-aware and interpretable framework designed to identify, assess, and rank high-risk content across online platforms.</li>
          <li><strong>MLMatrix:</strong> In-depth articles covering cutting-edge AI architectures and their mathematical foundations.</li>
          <li><strong>Ceasar Toolkit & FunRoot:</strong> Open-source CLI cryptographic frameworks and experimental utilities.</li>
        </ul>
      `,
      actions: [
        { label: 'Explore AquaPulse Project', href: 'https://parsabe.com/projects/aquapulse', primary: true },
        { label: 'View GitHub Repositories', href: 'https://github.com/parsabe', primary: false }
      ],
      zCoord: 0,
      xCoord: 180,
      yCoord: -10
    },
    {
      id: 'publications',
      index: 2,
      stepNumber: 3,
      timelineCoord: 'PUBLICATIONS // SCIENTIFIC PAPERS',
      title: 'Scientific Papers & Research Publications',
      subtitle: 'AquaPulse (2026), Vectra: Quarantine Matrix (2026), BlackWall, Moodium, SciML',
      formula: 'RESEARCHGATE & TU FREIBERG ARCHIVES  |  AFFECTIVE & NEURAL VISION',
      photo: 'images/IMG_2464.jpg',
      frameColor: 0xffaa00,
      body: `
        <p>Published research exploring the frontiers of artificial intelligence, affective computing, and physics-informed models:</p>
        <ul>
          <li><strong>AquaPulse (Aug 2026):</strong> Robust Computer Vision and Uncertainty Estimation for Aquatic Ecosystems — Telemetry platform bridging YOLO neural vision, BotSORT, and Ensemble Kalman Filtering.</li>
          <li><strong>Vectra (Jun 2026):</strong> The Quarantine Matrix, Constraining Neural Hallucinations in 3D Gaussian Environments — Protocol bridging digital twins with localized generative AI pipelines.</li>
          <li><strong>BlackWall (Jan 2026):</strong> Protect an AI from going rogue via an AI — Domain-aware framework identifying and ranking high-risk conversational content.</li>
          <li><strong>Moodium: From Words to Feelings (Aug 2025):</strong> Culturally aware LLM-integrated framework fusing audio, visual, and textual data with staged attention mechanisms.</li>
          <li><strong>Financial Forecasting Equations with SciML (Jun 2025):</strong> Integrating SINDy algorithm and scientific machine learning with financial time series.</li>
          <li><strong>CAPTCHA Unmasked (Jan 2025):</strong> The Math That Outsmarts Bots — Image distortion analysis and adversarial neural network modeling.</li>
        </ul>
      `,
      actions: [
        { label: 'View ResearchGate Publications', href: 'https://www.researchgate.net/profile/Parsa-Besharat', primary: true },
        { label: 'Read Papers on parsabe.com', href: 'https://parsabe.com/publications', primary: false }
      ],
      zCoord: -650,
      xCoord: -180,
      yCoord: -12
    },
    {
      id: 'myplaylist',
      index: 3,
      stepNumber: 4,
      timelineCoord: 'MY PLAYLIST // SOUNDSCAPES & DEEP FLOW',
      title: 'Curated Tracks & Focus Soundscapes',
      subtitle: 'Favorite Spotify & YouTube Soundtracks for Deep Work, Physics & Spacetime Immersion',
      formula: 'SPOTIFY: 1wbC8swsFWpJalHbfq3yF6  |  YOUTUBE: PLDeaK_8P01I8Riyis-oppzFdIgbC7Wu79',
      photo: 'images/IMG_0213.jpg',
      frameColor: 0x1db954,
      body: `
        <p>Music is a vital catalyst for deep mental flow, research synthesis, and creative system design. These curated mixes accompany high-intensity coding and mathematical explorations:</p>
        <ul>
          <li><strong>Spotify Playlist:</strong> Carefully assembled collection of cinematic, synthwave, ambient, and electronic compositions.</li>
          <li><strong>YouTube Series:</strong> Video mixes curated by Parsa featuring cosmic themes, interstellar sound design, and driving electronic rhythms.</li>
        </ul>
        <div style="margin-top:1.2rem;display:flex;gap:0.75rem;flex-wrap:wrap;">
          <a href="https://open.spotify.com/playlist/1wbC8swsFWpJalHbfq3yF6" target="_blank" rel="noopener" style="padding:0.6rem 1.2rem;background:#1db954;color:#000;font-weight:700;border-radius:10px;text-decoration:none;font-size:0.8rem;">🎧 Open Spotify Playlist</a>
          <a href="https://youtube.com/playlist?list=PLDeaK_8P01I8Riyis-oppzFdIgbC7Wu79" target="_blank" rel="noopener" style="padding:0.6rem 1.2rem;background:#ff0000;color:#fff;font-weight:700;border-radius:10px;text-decoration:none;font-size:0.8rem;">▶️ Open YouTube Mix</a>
        </div>
      `,
      actions: [
        { label: 'Spotify Playlist', href: 'https://open.spotify.com/playlist/1wbC8swsFWpJalHbfq3yF6', primary: true },
        { label: 'YouTube Playlist', href: 'https://youtube.com/playlist?list=PLDeaK_8P01I8Riyis-oppzFdIgbC7Wu79', primary: false }
      ],
      zCoord: -1300,
      xCoord: 180,
      yCoord: 12
    },
    {
      id: 'books',
      index: 4,
      stepNumber: 5,
      timelineCoord: 'FAVORITE BOOKS // INFLUENTIAL LITERATURE',
      title: 'Favorite Books & Philosophical Influence',
      subtitle: 'Key Works on Human Evolution, Mindset, Artificial Intelligence & Discipline',
      formula: 'KNOWLEDGE ACQUISITION // SYSTEM MINDS & INTELLECTUAL DISCIPLINES',
      photo: 'images/IMG_0238.jpg',
      frameColor: 0xba7428,
      body: `
        <p>A curated selection of literature that has shaped Parsa's worldview, intellectual rigor, and scientific ambition:</p>
        <ul>
          <li><strong>Sapiens: A Brief History of Humankind</strong> by Yuval Noah Harari — The cognitive, agricultural, and scientific revolutions shaping humanity's future.</li>
          <li><strong>Artificial Intelligence</strong> literature & foundational machine learning texts.</li>
          <li><strong>Total Recall / Be Useful</strong> by Arnold Schwarzenegger — Unrelenting work ethic, vision, and mental resilience.</li>
          <li><strong>The Boy, the Mole, the Fox and the Horse</strong> by Charlie Mackesy — Empathy, vulnerability, and quiet human strength.</li>
          <li><strong>The Source</strong> — Unlocking neuroplasticity and the creative architecture of the brain.</li>
          <li><strong>Becoming</strong> — Transformation through discipline, focus, and authentic purpose.</li>
        </ul>
      `,
      actions: [
        { label: 'View Books on parsabe.com', href: 'https://parsabe.com/books', primary: true }
      ],
      zCoord: -1950,
      xCoord: -180,
      yCoord: -10
    },
    {
      id: 'contact',
      index: 5,
      stepNumber: 6,
      timelineCoord: 'CONTACT // TRANSMISSION CHANNELS',
      title: 'Get in Touch: Parsa Besharat',
      subtitle: 'Direct Communication Portal • Research Collaboration & AI Engineering Inquiries',
      formula: 'parsa.besharat@student.tu-freiberg.de  |  FREIBERG, SAXONY, GERMANY',
      photo: 'images/IMG_2139.jpg',
      frameColor: 0xff5500,
      body: `
        <p>I am always interested in discussing impactful research opportunities, artificial intelligence architectures, data science initiatives, and innovative technical projects.</p>
        <div style="background:rgba(255,255,255,0.06);padding:1rem 1.2rem;border-radius:14px;border:1px solid rgba(255,183,0,0.3);margin:1rem 0;">
          <p style="margin:0 0 0.5rem;font-weight:700;color:#ffb700;">📡 Direct Coordinates:</p>
          <p style="margin:0.25rem 0;"><strong>Email:</strong> <a href="mailto:parsa.besharat@student.tu-freiberg.de" style="color:#00d2ff;">parsa.besharat@student.tu-freiberg.de</a></p>
          <p style="margin:0.25rem 0;"><strong>Alternative:</strong> <a href="mailto:parsabe99@gmail.com" style="color:#00d2ff;">parsabe99@gmail.com</a></p>
          <p style="margin:0.25rem 0;"><strong>Location:</strong> Freiberg, Saxony, Germany</p>
        </div>
        <p>Connect across professional networks:</p>
        <ul>
          <li><strong>LinkedIn:</strong> <a href="https://www.linkedin.com/in/parsabe" target="_blank" style="color:#00d2ff;">linkedin.com/in/parsabe</a></li>
          <li><strong>GitHub:</strong> <a href="https://github.com/parsabe" target="_blank" style="color:#00d2ff;">github.com/parsabe</a></li>
          <li><strong>ResearchGate:</strong> <a href="https://www.researchgate.net/profile/Parsa-Besharat" target="_blank" style="color:#00d2ff;">researchgate.net/profile/Parsa-Besharat</a></li>
        </ul>
      `,
      actions: [
        { label: 'Transmit Email', href: 'mailto:parsa.besharat@student.tu-freiberg.de', primary: true },
        { label: 'Visit parsabe.com', href: 'https://parsabe.com', primary: false }
      ],
      zCoord: -2600,
      xCoord: 0,
      yCoord: 0
    }
  ];

  // -------------------------------------------------------------
  // STEP STATIONS SPECIFICATIONS (Camera Vantage Points)
  // -------------------------------------------------------------
  const STATIONS = [
    {
      step: 0,
      name: '5D BULK OVERVIEW',
      camPos: new THREE.Vector3(0, 45, 1250),
      camLook: new THREE.Vector3(0, 0, -800),
      status: '5D TESSERACT // ALL REALITY DIMENSIONS VISIBLE',
      coord: 'ALL CHAMBERS VISIBLE',
      bulk: 'x⁵ = +1.00c (BULK)',
      time: 'SPATIALIZED TIME'
    },
    {
      step: 1,
      name: '01 ABOUT',
      realityIndex: 0,
      camPos: new THREE.Vector3(-80, 20, 780),
      camLook: new THREE.Vector3(-180, 10, 600),
      status: '5D TESSERACT // ABOUT: PARSA BESHARAT',
      coord: 'CHAMBER 1/6 [ABOUT]',
      bulk: 'x⁵ = +1.80c (BULK)',
      time: 'TIMELINE 2026.1'
    },
    {
      step: 2,
      name: '02 PROJECTS',
      realityIndex: 1,
      camPos: new THREE.Vector3(80, 0, 180),
      camLook: new THREE.Vector3(180, -10, 0),
      status: '5D TESSERACT // PROJECTS: AQUAPULSE & VECTRA',
      coord: 'CHAMBER 2/6 [PROJECTS]',
      bulk: 'x⁵ = +2.40c (BULK)',
      time: 'TIMELINE 2026.2'
    },
    {
      step: 3,
      name: '03 PUBLICATIONS',
      realityIndex: 2,
      camPos: new THREE.Vector3(-80, 0, -470),
      camLook: new THREE.Vector3(-180, -12, -650),
      status: '5D TESSERACT // PUBLICATIONS: RESEARCH PAPERS',
      coord: 'CHAMBER 3/6 [PAPERS]',
      bulk: 'x⁵ = +3.20c (BULK)',
      time: 'TIMELINE 2026.3'
    },
    {
      step: 4,
      name: '04 MY PLAYLIST',
      realityIndex: 3,
      camPos: new THREE.Vector3(80, 20, -1120),
      camLook: new THREE.Vector3(180, 12, -1300),
      status: '5D TESSERACT // PLAYLIST: SOUNDSCAPES & MIXES',
      coord: 'CHAMBER 4/6 [PLAYLIST]',
      bulk: 'x⁵ = +4.00c (BULK)',
      time: 'TIMELINE 2026.4'
    },
    {
      step: 5,
      name: '05 FAVORITE BOOKS',
      realityIndex: 4,
      camPos: new THREE.Vector3(-80, 0, -1770),
      camLook: new THREE.Vector3(-180, -10, -1950),
      status: '5D TESSERACT // BOOKS: INFLUENTIAL LITERATURE',
      coord: 'CHAMBER 5/6 [BOOKS]',
      bulk: 'x⁵ = +4.80c (BULK)',
      time: 'TIMELINE 2026.5'
    },
    {
      step: 6,
      name: '06 CONTACT',
      realityIndex: 5,
      camPos: new THREE.Vector3(0, 10, -2420),
      camLook: new THREE.Vector3(0, 0, -2600),
      status: '5D TESSERACT // CONTACT: PARSA BESHARAT',
      coord: 'CHAMBER 6/6 [CONTACT]',
      bulk: 'x⁵ = +5.50c (BULK)',
      time: 'TIMELINE ∞'
    }
  ];

  let currentCamPos = new THREE.Vector3(0, 45, 1250);
  let currentCamLook = new THREE.Vector3(0, 0, -800);

  /* =========================================================================
     2. THREE.JS 5D TESSERACT & 3D REALITY CHAMBERS WITH IMAGES
     ========================================================================= */
  let scene, camera, renderer, raycaster, mouseVec;
  let tesseractGroup, stringGroup, parsaPhotoLatticeGroup, dustParticles;
  let realityGroups = [];
  let interactiveObjects = [];
  let allPhotoMeshes = [];
  let hoveredPhoto = null;
  let tesseractActive = false;

  function createHologramTexture(tag, title, formula, sub) {
    const cvs = document.createElement('canvas');
    cvs.width = 1024;
    cvs.height = 512;
    const ctx = cvs.getContext('2d');

    const grad = ctx.createLinearGradient(0, 0, 1024, 512);
    grad.addColorStop(0, 'rgba(16, 14, 10, 0.94)');
    grad.addColorStop(1, 'rgba(6, 8, 12, 0.96)');
    ctx.fillStyle = grad;
    ctx.fillRect(0, 0, 1024, 512);

    ctx.strokeStyle = '#ffb700';
    ctx.lineWidth = 6;
    ctx.strokeRect(10, 10, 1004, 492);

    ctx.strokeStyle = '#00d2ff';
    ctx.lineWidth = 4;
    const len = 40;
    ctx.beginPath(); ctx.moveTo(10, 10 + len); ctx.lineTo(10, 10); ctx.lineTo(10 + len, 10); ctx.stroke();
    ctx.beginPath(); ctx.moveTo(1014 - len, 10); ctx.lineTo(1014, 10); ctx.lineTo(1014, 10 + len); ctx.stroke();
    ctx.beginPath(); ctx.moveTo(10, 502 - len); ctx.lineTo(10, 502); ctx.lineTo(10 + len, 502); ctx.stroke();
    ctx.beginPath(); ctx.moveTo(1014 - len, 502); ctx.lineTo(1014, 502); ctx.lineTo(1014, 502 - len); ctx.stroke();

    ctx.fillStyle = '#ffb700';
    ctx.font = 'bold 26px "SF Mono", monospace';
    ctx.fillText(`✦ ${tag}`, 40, 65);

    ctx.fillStyle = '#ffffff';
    ctx.font = 'bold 44px -apple-system, sans-serif';
    ctx.fillText(title, 40, 140);

    ctx.fillStyle = 'rgba(255, 255, 255, 0.7)';
    ctx.font = '26px -apple-system, sans-serif';
    ctx.fillText(sub || '', 40, 195);

    ctx.fillStyle = 'rgba(255, 183, 0, 0.08)';
    ctx.fillRect(40, 240, 944, 90);
    ctx.strokeStyle = 'rgba(255, 183, 0, 0.4)';
    ctx.lineWidth = 2;
    ctx.strokeRect(40, 240, 944, 90);

    ctx.fillStyle = '#ffe082';
    ctx.font = '26px "SF Mono", monospace';
    ctx.fillText(formula, 65, 298);

    ctx.fillStyle = '#ffb700';
    ctx.fillRect(40, 390, 420, 65);
    ctx.fillStyle = '#000000';
    ctx.font = 'bold 26px "SF Mono", monospace';
    ctx.fillText('[ CLICK TO INSPECT ]', 90, 434);

    const texture = new THREE.CanvasTexture(cvs);
    texture.minFilter = THREE.LinearFilter;
    return texture;
  }

  function createInfoOverlayTexture(info, isPortrait) {
    const cvs = document.createElement('canvas');
    cvs.width = isPortrait ? 512 : 640;
    cvs.height = isPortrait ? 220 : 180;
    const ctx = cvs.getContext('2d');

    // Subtle dark glass gradient across bottom section of photo
    const grad = ctx.createLinearGradient(0, 0, 0, cvs.height);
    grad.addColorStop(0, 'rgba(4, 7, 14, 0.40)');
    grad.addColorStop(0.35, 'rgba(4, 7, 14, 0.82)');
    grad.addColorStop(1, 'rgba(4, 7, 14, 0.96)');
    ctx.fillStyle = grad;
    ctx.fillRect(0, 0, cvs.width, cvs.height);

    // Glowing cybernetic border
    const isProj = info.cat === 'PROJECT';
    const isPub = info.cat === 'PUBLICATION';
    const accentColor = isProj ? '#00e5ff' : (isPub ? '#ffb700' : '#b388ff');
    ctx.strokeStyle = accentColor;
    ctx.lineWidth = 3;
    ctx.strokeRect(6, 6, cvs.width - 12, cvs.height - 12);

    // Subtle top border highlight
    ctx.strokeStyle = '#ffffff';
    ctx.lineWidth = 1.5;
    ctx.beginPath();
    ctx.moveTo(6, 6);
    ctx.lineTo(cvs.width - 6, 6);
    ctx.stroke();

    // Corner accents
    const cSize = 14;
    ctx.strokeStyle = '#ffffff';
    ctx.lineWidth = 2.5;
    ctx.beginPath();
    ctx.moveTo(6, 6 + cSize); ctx.lineTo(6, 6); ctx.lineTo(6 + cSize, 6);
    ctx.moveTo(cvs.width - 6 - cSize, 6); ctx.lineTo(cvs.width - 6, 6); ctx.lineTo(cvs.width - 6, 6 + cSize);
    ctx.stroke();

    // Category Badge (NO LINKS)
    ctx.font = 'bold 20px "JetBrains Mono", monospace';
    ctx.fillStyle = accentColor;
    ctx.textAlign = 'left';
    ctx.fillText(`✦ ${info.cat}`, 20, 38);

    // Title
    ctx.font = 'bold 26px "Cinzel", "Space Grotesk", sans-serif';
    ctx.fillStyle = '#ffffff';
    ctx.fillText(info.title, 20, 78);

    // Description / Details
    ctx.font = '500 18px "Space Grotesk", sans-serif';
    ctx.fillStyle = '#e2e8f0';
    ctx.fillText(info.desc, 20, 118);

    const tex = new THREE.CanvasTexture(cvs);
    tex.minFilter = THREE.LinearFilter;
    return tex;
  }

  function initTesseract() {
    if (!window.THREE) return;

    scene = new THREE.Scene();
    scene.fog = null;

    const aspect = width / height;
    camera = new THREE.PerspectiveCamera(65, aspect, 1, 7500);
    camera.position.set(0, 45, 1250);

    renderer = new THREE.WebGLRenderer({
      canvas: tesseractCanvas,
      antialias: true,
      alpha: false,
      powerPreference: 'high-performance'
    });
    renderer.setPixelRatio(dpr);
    renderer.setSize(width, height);
    renderer.setClearColor(0x000000, 1.0);

    raycaster = new THREE.Raycaster();
    mouseVec = new THREE.Vector2();

    tesseractGroup = new THREE.Group();
    scene.add(tesseractGroup);

    // Bright ambient light ensures NO object or cube is ever dark or black
    const ambientLight = new THREE.AmbientLight(0xffffff, 0.95);
    scene.add(ambientLight);

    const coreLight = new THREE.PointLight(0xff9900, 2.2, 4500, 1.5);
    coreLight.position.set(0, 0, -500);
    scene.add(coreLight);

    const blueAccentLight = new THREE.PointLight(0x00a8e8, 1.8, 4000, 1.5);
    blueAccentLight.position.set(0, 400, -1200);
    scene.add(blueAccentLight);

    // Hypercube Wireframe Lattice
    const boxGeo = new THREE.BoxGeometry(260, 260, 260);
    const boxEdges = new THREE.EdgesGeometry(boxGeo);
    const boxMat = new THREE.LineBasicMaterial({
      color: 0xcc7700,
      transparent: true,
      opacity: 0.35,
      blending: THREE.NormalBlending
    });

    const gridX = 4, gridY = 3, gridZ = 12;
    const spacingX = 460, spacingY = 380, spacingZ = 480;

    // -------------------------------------------------------------
    // INFINITE 5D BULK: ALL CELLS POPULATED (NO BLACK SQUARES)
    // -------------------------------------------------------------
    parsaPhotoLatticeGroup = new THREE.Group();

    // 10 Personal High-Res Photos of Parsa Besharat spread across the 5D lattice
    const parsaPhotoDefs = [
      { src: 'images/profile.jpg', isPortrait: true },
      { src: 'images/IMG_0213.jpg', isPortrait: false },
      { src: 'images/IMG_0238.jpg', isPortrait: false },
      { src: 'images/IMG_0490.jpg', isPortrait: true },
      { src: 'images/IMG_0542.jpg', isPortrait: false },
      { src: 'images/IMG_0614.jpg', isPortrait: true },
      { src: 'images/IMG_0637.jpg', isPortrait: true },
      { src: 'images/IMG_2139.jpg', isPortrait: false },
      { src: 'images/IMG_2171.jpg', isPortrait: true },
      { src: 'images/IMG_2464.jpg', isPortrait: true }
    ];

    const portraitGeo = new THREE.PlaneGeometry(76, 100);
    const portraitBorderGeo = new THREE.EdgesGeometry(new THREE.PlaneGeometry(78, 102));
    const landscapeGeo = new THREE.PlaneGeometry(100, 75);
    const landscapeBorderGeo = new THREE.EdgesGeometry(new THREE.PlaneGeometry(102, 77));

    const portraitOverlayGeo = new THREE.PlaneGeometry(76, 36);
    const landscapeOverlayGeo = new THREE.PlaneGeometry(100, 28);

    const texLoader = new THREE.TextureLoader();
    // MeshBasicMaterial ensures photos are 100% self-illuminated and NEVER black
    const photoEntries = parsaPhotoDefs.map(def => {
      const tex = texLoader.load(def.src);
      tex.minFilter = THREE.LinearFilter;
      const mat = new THREE.MeshBasicMaterial({
        map: tex,
        side: THREE.DoubleSide
      });
      return {
        mat: mat,
        geo: def.isPortrait ? portraitGeo : landscapeGeo,
        borderGeo: def.isPortrait ? portraitBorderGeo : landscapeBorderGeo,
        isPortrait: def.isPortrait,
        src: def.src
      };
    });

    // Parsa Besharat Info Cards (Clean categories, NO links, from main website)
    const parsaInfoCards = [
      { cat: 'PROJECT', title: 'AquaPulse Telemetry', desc: 'YOLO neural vision, BotSORT tracking & EnKF assimilation' },
      { cat: 'PUBLICATION', title: 'AquaPulse (2026)', desc: 'Robust computer vision & uncertainty estimation in aquatic telemetry' },
      { cat: 'PROJECT', title: 'Vectra Framework', desc: 'End-to-end 3D Gaussian spatial computing & simulation' },
      { cat: 'PUBLICATION', title: 'Vectra: Quarantine Matrix (2026)', desc: 'Constraining neural hallucinations in 3D Gaussian environments' },
      { cat: 'PROJECT', title: 'BlackWall Safeguard', desc: 'Autonomous guardrail framework preventing AI systems going rogue' },
      { cat: 'PUBLICATION', title: 'BlackWall Paper (2026)', desc: 'Domain-aware interpretable assessment for high-risk online content' },
      { cat: 'PROJECT', title: 'VECTRA: Matrix Game', desc: 'First-person Unity C# AI game with Suno Bark voice & Ollama LLM' },
      { cat: 'PUBLICATION', title: 'Moodium: Affective AI (2025)', desc: 'Multimodal emotion recognition using adaptive attention gating' },
      { cat: 'PROJECT', title: 'Ceasar Toolkit', desc: 'High-performance cryptographic CLI framework for ciphers' },
      { cat: 'PUBLICATION', title: 'SciML Time Series (2025)', desc: 'Financial forecasting equations using SINDy & Scientific ML' },
      { cat: 'PROJECT', title: 'SCP Pipeline', desc: 'Modular deep learning pipeline for neural image classification' },
      { cat: 'PUBLICATION', title: 'CAPTCHA Unmasked (2025)', desc: 'Mathematical foundations & neural vision outsmarting bots' },
      { cat: 'PROJECT', title: 'MLMatrix Research', desc: 'Neural architectures, embedded agentic systems & ML runtimes' },
      { cat: 'RESEARCHER', title: 'Parsa Besharat', desc: 'M.Sc. Data Science & AI Engineer • TU Bergakademie Freiberg' }
    ];

    const infoTexturesPortrait = parsaInfoCards.map(info => createInfoOverlayTexture(info, true));
    const infoTexturesLandscape = parsaInfoCards.map(info => createInfoOverlayTexture(info, false));

    const infoMaterialsPortrait = infoTexturesPortrait.map(tex => new THREE.MeshBasicMaterial({
      map: tex,
      transparent: true,
      opacity: 0.88,
      side: THREE.DoubleSide
    }));

    const infoMaterialsLandscape = infoTexturesLandscape.map(tex => new THREE.MeshBasicMaterial({
      map: tex,
      transparent: true,
      opacity: 0.88,
      side: THREE.DoubleSide
    }));

    allPhotoMeshes = [];

    // Populate EVERY cell across all coordinates (no empty or black boxes!)
    for (let x = -gridX; x <= gridX; x++) {
      for (let y = -gridY; y <= gridY; y++) {
        for (let z = -gridZ; z <= gridZ; z++) {
          const posX = x * spacingX;
          const posY = y * spacingY;
          const posZ = z * spacingZ;

          const frame = new THREE.LineSegments(boxEdges, boxMat);
          frame.position.set(posX, posY, posZ);
          tesseractGroup.add(frame);

          // Select photo deterministically with duplication so every cell has a photo
          const photoIdx = Math.abs(x * 13 + y * 7 + z * 3) % photoEntries.length;
          const photoEntry = photoEntries[photoIdx];

          const photoSlice = new THREE.Mesh(photoEntry.geo, photoEntry.mat);
          photoSlice.position.set(posX, posY - 10, posZ);

          const borderSlice = new THREE.LineSegments(
            photoEntry.borderGeo,
            new THREE.LineBasicMaterial({
              color: 0xffb700,
              transparent: true,
              opacity: 0.85
            })
          );
          borderSlice.position.set(posX, posY - 10, posZ);

          // Text overlay directly ON THE IMAGE plane (front & back faces, NOT under the image on a box!)
          const cardIdx = Math.abs(x * 17 + y * 11 + z * 5) % parsaInfoCards.length;
          const overlayMat = photoEntry.isPortrait ? infoMaterialsPortrait[cardIdx] : infoMaterialsLandscape[cardIdx];
          const overlayGeo = photoEntry.isPortrait ? portraitOverlayGeo : landscapeOverlayGeo;
          const overlayY = photoEntry.isPortrait ? -32 : -23;

          const frontOverlay = new THREE.Mesh(overlayGeo, overlayMat);
          frontOverlay.position.set(0, overlayY, 1.2);
          photoSlice.add(frontOverlay);

          const backOverlay = new THREE.Mesh(overlayGeo, overlayMat);
          backOverlay.position.set(0, overlayY, -1.2);
          backOverlay.rotation.y = Math.PI;
          photoSlice.add(backOverlay);

          // In Interstellar, slices of time repeat along orthogonal corridors
          if (Math.abs(x) % 2 === 1) {
            photoSlice.rotation.y = Math.PI / 2;
            borderSlice.rotation.y = Math.PI / 2;
          }

          photoSlice.userData = {
            borderSlice: borderSlice,
            overlayMat: overlayMat,
            cardInfo: parsaInfoCards[cardIdx]
          };

          allPhotoMeshes.push(photoSlice);
          parsaPhotoLatticeGroup.add(photoSlice);
          parsaPhotoLatticeGroup.add(borderSlice);
        }
      }
    }
    tesseractGroup.add(parsaPhotoLatticeGroup);

    // Gravitational Strings (NormalBlending prevents white color burnout)
    stringGroup = new THREE.Group();
    const stringPoints = [];
    const stringColors = [];
    const colorGold = new THREE.Color(0xd48817);
    const colorAmber = new THREE.Color(0xb85610);

    for (let i = 0; i < 280; i++) {
      const sx = (Math.random() - 0.5) * 5500;
      const sy = (Math.random() - 0.5) * 4500;
      stringPoints.push(
        new THREE.Vector3(sx, -5500, (Math.random() - 0.5) * 12000),
        new THREE.Vector3(sx, 5500, (Math.random() - 0.5) * 12000)
      );
      const col = Math.random() > 0.4 ? colorGold : colorAmber;
      stringColors.push(col.r, col.g, col.b, col.r, col.g, col.b);

      stringPoints.push(
        new THREE.Vector3(sx, sy, -7500),
        new THREE.Vector3(sx, sy, 7500)
      );
      stringColors.push(colorGold.r, colorGold.g, colorGold.b, colorGold.r, colorGold.g, colorGold.b);
    }

    const stringGeo = new THREE.BufferGeometry().setFromPoints(stringPoints);
    stringGeo.setAttribute('color', new THREE.Float32BufferAttribute(stringColors, 3));
    stringGroup.add(new THREE.LineSegments(stringGeo, new THREE.LineBasicMaterial({
      vertexColors: true,
      transparent: true,
      opacity: 0.48,
      blending: THREE.NormalBlending
    })));
    tesseractGroup.add(stringGroup);

    // Dust motes: subtle, crisp quantum motes (no cloudy haze)
    const pGeo = new THREE.BufferGeometry();
    const pPos = new Float32Array(2400 * 3);
    for (let p = 0; p < 2400; p++) {
      pPos[p * 3] = (Math.random() - 0.5) * 6000;
      pPos[p * 3 + 1] = (Math.random() - 0.5) * 5000;
      pPos[p * 3 + 2] = (Math.random() - 0.5) * 10000;
    }
    pGeo.setAttribute('position', new THREE.BufferAttribute(pPos, 3));
    dustParticles = new THREE.Points(pGeo, new THREE.PointsMaterial({
      color: 0xcc8800,
      size: 1.2,
      transparent: true,
      opacity: 0.25,
      blending: THREE.NormalBlending
    }));
    tesseractGroup.add(dustParticles);

    buildRealityChambers();
    tesseractCanvas.addEventListener('click', onTesseractClick);
    tesseractCanvas.addEventListener('pointermove', onTesseractPointerMove);

    // Identity Modal Action Listeners
    if (identityYesBtn) {
      identityYesBtn.addEventListener('click', () => {
        executeInterstellarEmergence();
      });
    }
    if (identityNoBtn) {
      identityNoBtn.addEventListener('click', () => {
        if (identityModal) identityModal.classList.remove('is-open');
      });
    }
    if (replaySingularityBtn) {
      replaySingularityBtn.addEventListener('click', () => {
        reopenSingularity();
      });
    }
  }

  function highlightPhotoHover(photo) {
    if (!photo) return;
    photo.scale.set(1.15, 1.15, 1.15);
    if (photo.userData.borderSlice) {
      photo.userData.borderSlice.scale.set(1.15, 1.15, 1.15);
      photo.userData.borderSlice.material.color.setHex(0x00ffff);
      photo.userData.borderSlice.material.opacity = 1.0;
    }
    if (photo.userData.overlayMat) {
      photo.userData.overlayMat.opacity = 1.0;
    }
    tesseractCanvas.style.cursor = 'pointer';
  }

  function resetPhotoHover(photo) {
    if (!photo) return;
    photo.scale.set(1.0, 1.0, 1.0);
    if (photo.userData.borderSlice) {
      photo.userData.borderSlice.scale.set(1.0, 1.0, 1.0);
      photo.userData.borderSlice.material.color.setHex(0xffb700);
      photo.userData.borderSlice.material.opacity = 0.85;
    }
    if (photo.userData.overlayMat) {
      photo.userData.overlayMat.opacity = 0.88;
    }
    tesseractCanvas.style.cursor = 'default';
  }

  function onTesseractPointerMove(e) {
    if (!tesseractActive || !camera || !raycaster) return;

    mouseVec.x = (e.clientX / width) * 2 - 1;
    mouseVec.y = -(e.clientY / height) * 2 + 1;

    raycaster.setFromCamera(mouseVec, camera);
    const intersects = raycaster.intersectObjects(allPhotoMeshes, false);

    if (intersects.length > 0) {
      const hit = intersects[0].object;
      if (hoveredPhoto !== hit) {
        if (hoveredPhoto) resetPhotoHover(hoveredPhoto);
        hoveredPhoto = hit;
        highlightPhotoHover(hoveredPhoto);
      }
    } else if (hoveredPhoto) {
      resetPhotoHover(hoveredPhoto);
      hoveredPhoto = null;
    }
  }

  /* =========================================================================
     BUILD REALITY CHAMBERS WITH USER IMAGES (NO PROCEDURAL SHAPES)
     ========================================================================= */
  function buildRealityChambers() {
    const texLoader = new THREE.TextureLoader();

    REALITY_DATA.forEach((d, idx) => {
      const ch = new THREE.Group();
      ch.position.set(d.xCoord, d.yCoord, d.zCoord);

      // 1. 3D Photo Plane of Parsa (Self-illuminating, never dark)
      const photoTex = texLoader.load(d.photo);
      photoTex.minFilter = THREE.LinearFilter;

      const photoGeo = new THREE.PlaneGeometry(130, 130);
      const photoMat = new THREE.MeshBasicMaterial({
        map: photoTex,
        side: THREE.DoubleSide
      });
      const photoMesh = new THREE.Mesh(photoGeo, photoMat);
      photoMesh.position.set(0, 45, 0);

      // 2. Cybernetic Golden Beveled Frame
      const frameGeo = new THREE.BoxGeometry(138, 138, 6);
      const frameEdges = new THREE.EdgesGeometry(frameGeo);
      const frameLine = new THREE.LineSegments(frameEdges, new THREE.LineBasicMaterial({
        color: d.frameColor || 0xffb700,
        linewidth: 2,
        transparent: true,
        opacity: 0.85,
        blending: THREE.AdditiveBlending
      }));
      frameLine.position.set(0, 45, 0);

      // 3. Backing Glass Shield
      const glassBacking = new THREE.Mesh(
        new THREE.BoxGeometry(136, 136, 4),
        new THREE.MeshBasicMaterial({
          color: 0x0a0c10,
          transparent: true,
          opacity: 0.9
        })
      );
      glassBacking.position.set(0, 45, -2.5);

      // 4. Glowing Corner Brackets
      const bracketGeo = new THREE.BoxGeometry(14, 14, 8);
      const bracketMat = new THREE.MeshBasicMaterial({
        color: d.frameColor || 0xffb700
      });
      const corners = [
        [-69, -24], [69, -24], [-69, 114], [69, 114]
      ];
      corners.forEach(([cx, cy]) => {
        const b = new THREE.Mesh(bracketGeo, bracketMat);
        b.position.set(cx, cy, 0);
        ch.add(b);
      });

      // 5. Hologram Dossier Plaque
      const tex = createHologramTexture(d.timelineCoord, d.title, d.formula, d.subtitle);
      const plaque = new THREE.Mesh(
        new THREE.PlaneGeometry(160, 80),
        new THREE.MeshBasicMaterial({ map: tex, transparent: true, side: THREE.DoubleSide })
      );
      plaque.position.set(0, -78, 15);

      photoMesh.userData = { realityIndex: idx };
      plaque.userData = { realityIndex: idx };
      interactiveObjects.push(photoMesh, plaque);

      ch.add(photoMesh, frameLine, glassBacking, plaque);
      ch.userData = { photoMesh, frameLine, baseY: 45, index: idx };

      tesseractGroup.add(ch);
      realityGroups.push(ch);
    });
  }

  function onTesseractClick(e) {
    if (!tesseractActive || !camera || !raycaster) return;

    mouseVec.x = (e.clientX / width) * 2 - 1;
    mouseVec.y = -(e.clientY / height) * 2 + 1;

    raycaster.setFromCamera(mouseVec, camera);
    const intersects = raycaster.intersectObjects(interactiveObjects, false);

    if (intersects.length > 0) {
      const hit = intersects[0].object;
      const idx = hit.userData.realityIndex;
      if (idx !== undefined) {
        openRealityModal(idx);
        return;
      }
    }

    const latticeIntersects = raycaster.intersectObjects(allPhotoMeshes, false);
    if (latticeIntersects.length > 0) {
      openRealityModal(0);
    }
  }

  /* =========================================================================
     3. SINGULARITY KERNEL ("هسته") PROCEDURAL RENDERER
     ========================================================================= */
  let kernelTime = 0;
  function renderKernel(progress, dt) {
    kernelTime += dt;
    kernelCtx.clearRect(0, 0, width, height);

    if (progress < 0.42 || progress > 0.85) return;

    let intensity = 0;
    if (progress >= 0.45 && progress < 0.72) {
      intensity = (progress - 0.45) / (0.72 - 0.45);
    } else if (progress >= 0.72 && progress <= 0.82) {
      intensity = 1.0 - (progress - 0.72) / (0.82 - 0.72);
    }
    intensity = Math.max(0, Math.min(1, intensity));

    const cx = width * 0.5;
    const cy = height * 0.5;
    const maxR = Math.min(width, height) * 0.48;

    const growth = progress >= 0.60 ? 1.0 + Math.pow((progress - 0.60) / 0.16, 2.5) * 4.5 : 1.0;
    const currentR = maxR * (0.35 + intensity * 0.4) * growth;

    kernelCtx.save();
    kernelCtx.translate(cx, cy);

    // Relativistic Lensing Glow
    const haloGrad = kernelCtx.createRadialGradient(0, 0, currentR * 0.2, 0, 0, currentR * 1.5);
    haloGrad.addColorStop(0.0, `rgba(255, 240, 200, ${0.85 * intensity})`);
    haloGrad.addColorStop(0.25, `rgba(255, 175, 40, ${0.65 * intensity})`);
    haloGrad.addColorStop(0.55, `rgba(255, 90, 10, ${0.35 * intensity})`);
    haloGrad.addColorStop(0.85, `rgba(0, 180, 255, ${0.15 * intensity})`);
    haloGrad.addColorStop(1.0, 'rgba(0, 0, 0, 0)');

    kernelCtx.fillStyle = haloGrad;
    kernelCtx.beginPath();
    kernelCtx.arc(0, 0, currentR * 1.5, 0, Math.PI * 2);
    kernelCtx.fill();

    // Spacetime Metric Ripples
    for (let w = 0; w < 5; w++) {
      const phase = (kernelTime * 1.2 + w * (1 / 5)) % 1;
      const waveRadius = currentR * (0.3 + phase * 1.2);
      const waveAlpha = (1 - phase) * 0.55 * intensity;

      kernelCtx.strokeStyle = `rgba(255, 215, 120, ${waveAlpha})`;
      kernelCtx.lineWidth = 2 + (1 - phase) * 4;
      kernelCtx.beginPath();
      kernelCtx.ellipse(0, 0, waveRadius, waveRadius * 0.65, -0.25, 0, Math.PI * 2);
      kernelCtx.stroke();
    }

    // Swirling Quantum Filaments
    for (let f = 0; f < 18; f++) {
      const baseAngle = (f / 18) * Math.PI * 2 + kernelTime * 0.8;
      kernelCtx.beginPath();
      for (let s = 0; s <= 20; s++) {
        const t = s / 20;
        const r = currentR * (0.15 + t * 0.95);
        const theta = baseAngle + t * 2.8;
        const px = Math.cos(theta) * r;
        const py = Math.sin(theta) * r * 0.65;
        if (s === 0) kernelCtx.moveTo(px, py);
        else kernelCtx.lineTo(px, py);
      }
      kernelCtx.strokeStyle = `rgba(255, 185, 70, ${0.45 * intensity})`;
      kernelCtx.lineWidth = 1.5;
      kernelCtx.stroke();
    }

    // Event Horizon Black Core
    const coreRadius = currentR * 0.32;
    kernelCtx.fillStyle = '#000000';
    kernelCtx.beginPath();
    kernelCtx.arc(0, 0, coreRadius, 0, Math.PI * 2);
    kernelCtx.fill();

    kernelCtx.strokeStyle = `rgba(255, 255, 255, ${0.9 * intensity})`;
    kernelCtx.lineWidth = 3.5 * growth;
    kernelCtx.shadowColor = '#ffc83b';
    kernelCtx.shadowBlur = 25 * growth;
    kernelCtx.beginPath();
    kernelCtx.arc(0, 0, coreRadius, 0, Math.PI * 2);
    kernelCtx.stroke();
    kernelCtx.shadowBlur = 0;

    kernelCtx.restore();
  }

  /* =========================================================================
     4. VIDEO FRAME SCRUBBING & CANVAS RENDERING
     ========================================================================= */
  function getNearestLoadedImage(targetIdx) {
    if (loaded[targetIdx] === 1 && images[targetIdx]) {
      return images[targetIdx];
    }
    for (let offset = 1; offset < FRAME_COUNT; offset++) {
      const prev = targetIdx - offset;
      if (prev >= 0 && loaded[prev] === 1 && images[prev]) return images[prev];
      const next = targetIdx + offset;
      if (next < FRAME_COUNT && loaded[next] === 1 && images[next]) return images[next];
    }
    return null;
  }

  function drawCover(image, targetW, targetH) {
    if (!image) return;
    const imgW = image.naturalWidth || image.width;
    const imgH = image.naturalHeight || image.height;
    if (!imgW || !imgH) return;

    const ratio = Math.max(targetW / imgW, targetH / imgH);
    const drawW = imgW * ratio;
    const drawH = imgH * ratio;
    const drawX = (targetW - drawW) * 0.5;
    const drawY = (targetH - drawH) * 0.5;

    videoCtx.drawImage(image, drawX, drawY, drawW, drawH);
  }

  function renderVideo() {
    const baseIdx = Math.floor(currentFrame);
    const nextIdx = Math.min(baseIdx + 1, FRAME_COUNT - 1);
    const fraction = currentFrame - baseIdx;

    const baseImg = getNearestLoadedImage(baseIdx);
    const nextImg = getNearestLoadedImage(nextIdx);

    videoCtx.fillStyle = '#000000';
    videoCtx.fillRect(0, 0, width, height);

    if (baseImg) {
      videoCtx.globalAlpha = 1.0;
      drawCover(baseImg, width, height);
    }

    if (nextImg && nextImg !== baseImg && fraction > 0.002) {
      videoCtx.globalAlpha = fraction;
      drawCover(nextImg, width, height);
    }
    videoCtx.globalAlpha = 1.0;
  }

  function loadFrame(index) {
    if (requested[index]) return;
    requested[index] = 1;

    const img = new Image();
    img.src = getFrameUrl(index);

    img.onload = () => {
      images[index] = img;
      loaded[index] = 1;
      updatePreloader();

      if (!isRevealed && index === 0) {
        isRevealed = true;
        renderVideo();
        if (stage) {
          stage.classList.add('is-ready');
          stage.style.opacity = '1';
        }
      }
    };
    img.onerror = () => {
      loaded[index] = 2;
      updatePreloader();
    };
  }

  function prioritizeNearbyFrames(centerIdx) {
    const radius = 30;
    const min = Math.max(0, centerIdx - radius);
    const max = Math.min(FRAME_COUNT - 1, centerIdx + radius);
    for (let i = min; i <= max; i++) {
      if (!requested[i]) loadFrame(i);
    }
  }

  function progressiveLoad() {
    loadFrame(0);
    for (let i = 0; i < 35; i++) loadFrame(i);
    for (let i = 35; i < FRAME_COUNT; i += 8) loadFrame(i);
    loadFrame(FRAME_COUNT - 1);

    let remainderIndex = 0;
    function queueRemaining(deadline) {
      while (remainderIndex < FRAME_COUNT && (!deadline || deadline.timeRemaining() > 1)) {
        if (!requested[remainderIndex]) loadFrame(remainderIndex);
        remainderIndex++;
      }
      if (remainderIndex < FRAME_COUNT) {
        if ('requestIdleCallback' in window) requestIdleCallback(queueRemaining);
        else setTimeout(() => queueRemaining(null), 16);
      }
    }
    if ('requestIdleCallback' in window) requestIdleCallback(queueRemaining);
    else setTimeout(() => queueRemaining(null), 50);
  }

  /* =========================================================================
     5. TRANSITION INTO 5D SINGULARITY
     ========================================================================= */
  function enterSingularity() {
    isAutoDiving = false;
    isInSingularity = true;
    currentStep = 0;

    if (autopilotSkipBtn) autopilotSkipBtn.classList.remove('is-active');
    if (whoAmIBtn) whoAmIBtn.classList.add('is-active');

    // Smoothly ensure Tesseract is fully visible and 2D video/kernel canvases are hidden
    if (stage) {
      stage.style.opacity = '0';
      stage.style.display = 'none';
    }
    if (kernelStage) {
      kernelStage.style.opacity = '0';
      kernelStage.style.display = 'none';
    }
    if (tesseractStage) {
      tesseractStage.style.opacity = '1';
      tesseractStage.style.display = 'block';
      tesseractStage.style.backgroundColor = '#000000';
    }
    // Guarantee ruptureFlash is completely hidden with 0 opacity
    if (ruptureFlash) {
      ruptureFlash.style.opacity = '0';
      ruptureFlash.style.display = 'none';
    }
    tesseractActive = true;

    // Reset camera to Step 0 (Overview of all elements)
    const st0 = STATIONS[0];
    freeFlightPos.copy(st0.camPos);
    freeFlightVel.set(0, 0, 0);
    isNavigatingToStation = false;

    currentCamPos.copy(st0.camPos);
    currentCamLook.copy(st0.camLook);
    camera.position.copy(currentCamPos);
    camera.lookAt(currentCamLook);

    if (hudScrollHint) {
      hudScrollHint.style.opacity = '1';
      hudScrollHint.querySelector('span').textContent = 'SCROLL MOUSE / WASD FREE FLIGHT';
    }
    if (hudControlsHint) {
      hudControlsHint.classList.add('is-visible');
    }
    updateTelemetryHUD();
    startLoopIfNeeded();
  }

  /* =========================================================================
     6. DISCRETE STEP SCROLLING ("SEQUEL" STYLE) & WASD FLIGHT
     ========================================================================= */
  function changeStep(newStep) {
    if (newStep < 0 || newStep > MAX_STEP) return;
    currentStep = newStep;
    updateTelemetryHUD();

    const targetStation = STATIONS[currentStep];
    const isMobile = width < 768;
    const xMult = isMobile ? 0.35 : 1.0;

    targetStationPos = targetStation.camPos.clone();
    targetStationPos.x *= xMult;
    targetStationLook = targetStation.camLook.clone();
    targetStationLook.x *= xMult;

    isNavigatingToStation = true;
    startLoopIfNeeded();

    // When reaching Contact station, trigger the identity prompt
    if (currentStep === MAX_STEP) {
      setTimeout(() => {
        if (isInSingularity && !isSaturnActive && identityModal) {
          identityModal.classList.add('is-open');
          identityModal.setAttribute('aria-hidden', 'false');
        }
      }, 1500);
    }
  }

  function handleWheelNavigation(deltaY) {
    if (!isInSingularity || isStepLocked) return;
    if (Math.abs(deltaY) < 18) return;

    if (deltaY > 0) {
      if (currentStep < MAX_STEP) {
        changeStep(currentStep + 1);
        lockStepGesture();
      }
    } else {
      if (currentStep > 0) {
        changeStep(currentStep - 1);
        lockStepGesture();
      }
    }
  }

  function lockStepGesture() {
    isStepLocked = true;
    clearTimeout(stepLockTimeout);
    stepLockTimeout = setTimeout(() => {
      isStepLocked = false;
    }, 600);
  }

  // -------------------------------------------------------------
  // MOUSE WHEEL, SCROLLBAR & TOUCH NAVIGATION (Driven by User Scroll)
  // -------------------------------------------------------------
  window.addEventListener('wheel', (e) => {
    // Stage 0 Descent: Mouse wheel scrubs through 1,081 frames and drives black hole descent!
    if (!isInSingularity) {
      if (preloader && !preloader.classList.contains('is-dismissed')) {
        unlockAudio();
        preloader.classList.add('is-dismissed');
        setTimeout(() => { if (preloader) preloader.style.display = 'none'; }, 600);
        if (stage) {
          stage.style.display = 'block';
          stage.style.opacity = '1';
          stage.classList.add('is-ready');
        }
        if (kernelStage) kernelStage.style.display = 'block';
        if (autopilotSkipBtn) autopilotSkipBtn.classList.add('is-active');
      }

      // Smooth scroll sensitivity (scrubs forward when scrolling down, backward when scrolling up)
      const scrubAmount = (e.deltaY / 1000) * 0.055;
      targetProgress = Math.max(0, Math.min(0.77, targetProgress + scrubAmount));
      if (isAutoDiving && e.deltaY > 0) {
        autoDiveStartTime -= 180;
      }
      startLoopIfNeeded();
      return;
    }

    // Stage 1 Singularity: Mouse wheel moves through 3D stations
    if (isInSingularity) {
      e.preventDefault();
      handleWheelNavigation(e.deltaY);
    }
  }, { passive: false });

  // Native Window Scroll Handling (for page scrolling / scroll-container)
  window.addEventListener('scroll', () => {
    if (!isInSingularity && document.body.classList.contains('singularity-active')) {
      const scrollHeight = document.documentElement.scrollHeight - window.innerHeight;
      if (scrollHeight > 100) {
        const ratio = window.scrollY / scrollHeight;
        targetProgress = Math.max(targetProgress, Math.min(0.77, ratio * 0.77));
        if (preloader && !preloader.classList.contains('is-dismissed')) {
          unlockAudio();
          preloader.classList.add('is-dismissed');
          setTimeout(() => { if (preloader) preloader.style.display = 'none'; }, 600);
          if (stage) {
            stage.style.display = 'block';
            stage.style.opacity = '1';
            stage.classList.add('is-ready');
          }
          if (kernelStage) kernelStage.style.display = 'block';
          if (autopilotSkipBtn) autopilotSkipBtn.classList.add('is-active');
        }
        startLoopIfNeeded();
      }
    }
  }, { passive: true });

  // Touch Swipe for Mobile
  let touchStartX = 0;
  let touchStartY = 0;
  let touchLastY = 0;

  window.addEventListener('touchstart', (e) => {
    if (e.touches && e.touches[0]) {
      touchStartX = e.touches[0].clientX;
      touchStartY = e.touches[0].clientY;
      touchLastY = touchStartY;
    }
  }, { passive: true });

  window.addEventListener('touchmove', (e) => {
    if (!e.touches || !e.touches[0]) return;
    const curY = e.touches[0].clientY;
    const dy = touchLastY - curY;
    touchLastY = curY;

    if (!isInSingularity) {
      if (preloader && !preloader.classList.contains('is-dismissed')) {
        unlockAudio();
        preloader.classList.add('is-dismissed');
        setTimeout(() => { if (preloader) preloader.style.display = 'none'; }, 600);
        if (stage) {
          stage.style.display = 'block';
          stage.style.opacity = '1';
          stage.classList.add('is-ready');
        }
        if (kernelStage) kernelStage.style.display = 'block';
        if (autopilotSkipBtn) autopilotSkipBtn.classList.add('is-active');
      }
      targetProgress = Math.max(0, Math.min(0.77, targetProgress + (dy / 500) * 0.055));
      if (isAutoDiving && dy > 0) autoDiveStartTime -= dy * 4;
      startLoopIfNeeded();
      return;
    }

    if (isInSingularity) {
      const totalDy = touchStartY - curY;
      if (Math.abs(totalDy) > 42 && !isStepLocked) {
        if (totalDy > 0 && currentStep < MAX_STEP) {
          changeStep(currentStep + 1);
          lockStepGesture();
          touchStartY = curY;
        } else if (totalDy < 0 && currentStep > 0) {
          changeStep(currentStep - 1);
          lockStepGesture();
          touchStartY = curY;
        }
      }
    }
  }, { passive: true });

  // Timeline Step Button Click Handlers
  timelineSteps.forEach(btn => {
    btn.addEventListener('click', () => {
      unlockAudio();
      if (!isInSingularity) {
        enterSingularity();
      }
      const st = parseInt(btn.dataset.step, 10);
      if (!isNaN(st)) changeStep(st);
    });
  });

  if (prevStepBtn) {
    prevStepBtn.addEventListener('click', () => {
      unlockAudio();
      if (currentStep > 0) changeStep(currentStep - 1);
    });
  }

  if (nextStepBtn) {
    nextStepBtn.addEventListener('click', () => {
      unlockAudio();
      if (!isInSingularity) enterSingularity();
      else if (currentStep < MAX_STEP) changeStep(currentStep + 1);
    });
  }

  /* =========================================================================
     7. INTERSTELLAR CLIMAX: TESSERACT CUBE COLLAPSE -> FLASH -> WORMHOLE VIDEO -> FLASH -> SATURN
     ========================================================================= */
  function executeInterstellarEmergence() {
    if (isCollapsingCube || isWormholeActive || isSaturnActive) return;
    if (identityModal) {
      identityModal.classList.remove('is-open');
      identityModal.setAttribute('aria-hidden', 'true');
    }

    isCollapsingCube = true;

    // Immediately hide all HUD overlays so user experiences pure cinematic immersion
    if (hudTimeline) hudTimeline.style.opacity = '0';
    if (hudControlsHint) hudControlsHint.style.opacity = '0';
    if (whoAmIBtn) whoAmIBtn.style.opacity = '0';
    if (autopilotSkipBtn) autopilotSkipBtn.style.opacity = '0';
    const hudAudio = document.getElementById('hudAudio');
    if (hudAudio) hudAudio.style.opacity = '0.35';

    // Trigger dimensional acoustic shockwave
    if (window.spacetimeAudio) {
      window.spacetimeAudio.triggerRuptureBoom();
    }

    // -------------------------------------------------------------
    // STAGE 1: 3D CUBE & SPATIAL BULK IMPLOSIVE COLLAPSE
    // -------------------------------------------------------------
    const initialGroupScale = tesseractGroup ? tesseractGroup.scale.x : 1.0;
    const initialCamZ = camera ? camera.position.z : 1250;
    const collapseStartTime = performance.now();
    const collapseDuration = 1400; // 1.4 seconds of dramatic spatial implosion

    // Cache initial transforms of all tesseract geometry if not already saved
    if (tesseractGroup && !tesseractGroup._cachedTransforms) {
      tesseractGroup._cachedTransforms = tesseractGroup.children.map(child => ({
        pos: child.position.clone(),
        scale: child.scale.clone(),
        rot: child.rotation.clone()
      }));
    }

    function animateCubeCollapse(now) {
      const elapsed = now - collapseStartTime;
      const progress = Math.min(1.0, elapsed / collapseDuration);
      // Exponential gravitational collapse curve
      const easeCollapse = Math.pow(progress, 2.6);

      if (tesseractGroup) {
        // Master hypercube scale shrinks down into a geometric singularity
        const scaleVal = Math.max(0.0001, initialGroupScale * (1.0 - easeCollapse));
        tesseractGroup.scale.set(scaleVal, scaleVal, scaleVal);
        tesseractGroup.rotation.z += 0.08 * (1.0 + progress * 2.5); // Accretion vortex swirl
        tesseractGroup.rotation.y += 0.05 * (1.0 + progress * 2.5);

        // Implode each individual 3D cube & floating image plane inward toward (0,0,0)
        tesseractGroup.children.forEach(child => {
          child.position.multiplyScalar(0.91);
          child.scale.multiplyScalar(0.91);
        });
      }

      if (camera) {
        // High-velocity forward camera plunge into the collapsing core
        camera.position.z = initialCamZ - easeCollapse * 1400;
      }

      // First blinding white flash starts building up in the final 35% of collapse
      if (progress > 0.65 && ruptureFlash) {
        const flashIntensity = (progress - 0.65) / 0.35;
        ruptureFlash.style.display = 'block';
        ruptureFlash.style.opacity = flashIntensity;
      }

      if (progress < 1.0) {
        requestAnimationFrame(animateCubeCollapse);
      } else {
        // -------------------------------------------------------------
        // STAGE 2: FIRST BLINDING FLASH & TRANSITION TO WORMHOLE VIDEO
        // -------------------------------------------------------------
        if (ruptureFlash) {
          ruptureFlash.style.display = 'block';
          ruptureFlash.style.opacity = '1';
        }

        // Hide 3D canvas stage completely under the white flash
        tesseractActive = false;
        if (tesseractStage) tesseractStage.style.display = 'none';

        // -------------------------------------------------------------
        // STAGE 3: WORMHOLE TRAVERSAL VIDEO (INTERSTELLAR CINEMA)
        // -------------------------------------------------------------
        if (wormholeStage && wormholeVideo) {
          isWormholeActive = true;
          wormholeStage.classList.add('is-active');
          wormholeVideo.currentTime = 0;
          wormholeVideo.muted = false; // Video unmuted; user can adjust volume or mute via HUD
          wormholeVideo.volume = 0.9;
          wormholeVideo.play().catch(e => {
            console.log("Wormhole video autoplay with sound restricted, playing muted:", e);
            wormholeVideo.muted = true;
            wormholeVideo.play().catch(err => console.log("Video play error:", err));
          });

          // Dissolve the first flash away to reveal the high-speed wormhole throat
          setTimeout(() => {
            if (ruptureFlash) {
              ruptureFlash.style.opacity = '0';
              setTimeout(() => {
                if (ruptureFlash && !isSaturnActive) ruptureFlash.style.display = 'none';
              }, 400);
            }
          }, 180);

          // -------------------------------------------------------------
          // STAGE 4: SECOND BLINDING FLASH (WORMHOLE EXIT) -> PERSONAL WEBSITE
          // -------------------------------------------------------------
          let hasTriggeredMainWebsiteTransition = false;

          function triggerMainWebsiteTransition() {
            if (hasTriggeredMainWebsiteTransition) return;
            hasTriggeredMainWebsiteTransition = true;

            // Second blinding flash bursts across screen
            if (ruptureFlash) {
              ruptureFlash.style.display = 'block';
              ruptureFlash.style.opacity = '1';
            }
            if (window.spacetimeAudio) {
              window.spacetimeAudio.triggerRuptureBoom();
            }

            setTimeout(() => {
              // Pause and hide wormhole video under the second flash
              if (wormholeVideo) wormholeVideo.pause();
              if (wormholeStage) {
                wormholeStage.classList.remove('is-active');
                wormholeStage.style.display = 'none';
              }
              isWormholeActive = false;

              // Hide Section 1 (Singularity Experience) completely
              const singularitySection = document.getElementById('singularitySection');
              if (singularitySection) {
                singularitySection.style.display = 'none';
              }

              // Reveal Section 2 (The Personal Website Blade)
              const personalWebsiteSection = document.getElementById('personalWebsiteSection');
              if (personalWebsiteSection) {
                personalWebsiteSection.classList.add('is-active');
                personalWebsiteSection.style.display = 'flex';
                // Trigger any home feed or UI initializers
                if (typeof fetchHomePublicFeed === 'function') {
                  fetchHomePublicFeed();
                }
              }

              // Reset window scroll to top
              window.scrollTo(0, 0);

              // Remove singularity-active from body so personal website wallpaper and page scroll turn on smoothly
              document.body.classList.remove('singularity-active');
              document.body.classList.remove('is-loading');

              // Ensure audio unlock listeners are deactivated and transition audio engine to website mode
              if (typeof removeUnlockListeners === 'function') {
                removeUnlockListeners();
              }
              audioUnlocked = true;
              if (window.spacetimeAudio && typeof window.spacetimeAudio.transitionToWebsite === 'function') {
                window.spacetimeAudio.transitionToWebsite();
              }

              // Sync taskbar audio state
              if (window.syncTaskbarAudioState) {
                window.syncTaskbarAudioState();
              }

              // Smoothly dissolve the second white flash away over 1.2s to reveal the personal website
              setTimeout(() => {
                if (ruptureFlash) {
                  ruptureFlash.style.transition = 'opacity 1.2s cubic-bezier(0.16, 1, 0.3, 1)';
                  ruptureFlash.style.opacity = '0';
                  setTimeout(() => {
                    if (ruptureFlash) ruptureFlash.style.display = 'none';
                  }, 1200);
                }
              }, 250);

            }, 350); // 350ms flash peak duration
          }

          window._triggerMainWebsiteTransition = triggerMainWebsiteTransition;

          // Pure Interstellar cinema: video plays fully to the end, then emerges directly into personal website
          wormholeVideo.onended = () => {
            triggerMainWebsiteTransition();
          };

          // User click during wormhole provides optional immediate exit to personal website
          wormholeStage.onclick = () => {
            triggerMainWebsiteTransition();
          };
        } else {
          // Fallback if video element is unavailable: reveal personal website directly
          const singularitySection = document.getElementById('singularitySection');
          if (singularitySection) singularitySection.style.display = 'none';
          const personalWebsiteSection = document.getElementById('personalWebsiteSection');
          if (personalWebsiteSection) {
            personalWebsiteSection.classList.add('is-active');
            personalWebsiteSection.style.display = 'flex';
          }
          if (ruptureFlash) ruptureFlash.style.opacity = '0';
        }
      }
    }

    requestAnimationFrame(animateCubeCollapse);
  }

  function reopenSingularity() {
    const personalWebsiteSection = document.getElementById('personalWebsiteSection');
    if (personalWebsiteSection) {
      personalWebsiteSection.classList.remove('is-active');
      personalWebsiteSection.style.display = 'none';
    }
    const singularitySection = document.getElementById('singularitySection');
    if (singularitySection) {
      singularitySection.style.display = 'block';
    }
    isWormholeActive = false;
    isCollapsingCube = false;

    // Restore tesseract master group scale and rotation
    if (tesseractGroup) {
      tesseractGroup.scale.set(1, 1, 1);
      tesseractGroup.rotation.set(0, 0, 0);

      // Restore child 3D transforms from cache
      if (tesseractGroup._cachedTransforms) {
        tesseractGroup.children.forEach((child, idx) => {
          const cached = tesseractGroup._cachedTransforms[idx];
          if (cached) {
            child.position.copy(cached.pos);
            child.scale.copy(cached.scale);
            child.rotation.copy(cached.rot);
          }
        });
      }
    }

    if (camera) {
      camera.position.set(0, 45, 1250);
    }

    if (tesseractStage) {
      tesseractStage.style.display = 'block';
      tesseractStage.style.opacity = '1';
    }
    tesseractActive = true;

    // Restore HUD elements
    if (hudTimeline) {
      hudTimeline.style.display = 'flex';
      hudTimeline.style.opacity = '1';
    }
    if (hudControlsHint) {
      hudControlsHint.style.display = 'flex';
      hudControlsHint.style.opacity = '1';
    }
    if (whoAmIBtn) {
      whoAmIBtn.style.display = 'flex';
      whoAmIBtn.style.opacity = '1';
    }
    const hudAudio = document.getElementById('hudAudio');
    if (hudAudio) hudAudio.style.opacity = '1';

    enterSingularity();
    startLoopIfNeeded();
  }

  window.reenterSingularity = reopenSingularity;

  /* =========================================================================
     8. COORDINATED RENDER LOOP
     ========================================================================= */
  function resize() {
    width = window.innerWidth;
    height = window.innerHeight;
    dpr = Math.min(window.devicePixelRatio || 1, 2);

    videoCanvas.width = Math.round(width * dpr);
    videoCanvas.height = Math.round(height * dpr);
    videoCanvas.style.width = `${width}px`;
    videoCanvas.style.height = `${height}px`;
    videoCtx.setTransform(dpr, 0, 0, dpr, 0, 0);

    kernelCanvas.width = Math.round(width * dpr);
    kernelCanvas.height = Math.round(height * dpr);
    kernelCanvas.style.width = `${width}px`;
    kernelCanvas.style.height = `${height}px`;
    kernelCtx.setTransform(dpr, 0, 0, dpr, 0, 0);

    if (renderer && camera) {
      const aspect = width / height;
      camera.aspect = aspect;

      // Mobile Portrait FOV Adjustment: ensures chambers are NEVER cropped horizontally
      if (aspect < 1.0) {
        const targetHFOV = 70; // degrees
        camera.fov = 2 * Math.atan(Math.tan((targetHFOV * Math.PI) / 360) / aspect) * (180 / Math.PI);
      } else {
        camera.fov = 65;
      }
      camera.updateProjectionMatrix();
      renderer.setSize(width, height);
      renderer.setPixelRatio(dpr);
    }

    renderVideo();
  }

  function loop(now) {
    const dt = Math.min((now - lastTime) / 1000, 0.1);
    lastTime = now;

    // Mouse parallax
    mouseX += (targetMouseX - mouseX) * 0.06;
    mouseY += (targetMouseY - mouseY) * 0.06;

    // 1. Descent Flight (Smoothly Driven by Scroll Wheel, Window Scroll, or Auto-Dive)
    if (!isInSingularity) {
      if (isAutoDiving) {
        const elapsed = (now - autoDiveStartTime) / 1000;
        const autoP = Math.min(1.0, elapsed / AUTO_DIVE_DURATION) * 0.77;
        targetProgress = Math.max(targetProgress, autoP);
      }

      // Smooth buttery interpolation towards targetProgress
      currentProgress += (targetProgress - currentProgress) * Math.min(1, dt * 9.0);
      currentFrame = (currentProgress / 0.74) * (FRAME_COUNT - 1);
      currentFrame = Math.max(0, Math.min(FRAME_COUNT - 1, currentFrame));
      prioritizeNearbyFrames(Math.round(currentFrame));

      // Smooth layer opacities
      let videoOpacity = 1.0;
      if (currentProgress > 0.72) {
        videoOpacity = Math.max(0, 1.0 - (currentProgress - 0.72) / 0.05);
      }
      if (stage) stage.style.opacity = isRevealed ? videoOpacity : 0;

      let kernelOpacity = 0.0;
      if (currentProgress >= 0.44 && currentProgress <= 0.74) {
        kernelOpacity = Math.min(1.0, (currentProgress - 0.44) / 0.16);
      } else if (currentProgress > 0.74) {
        kernelOpacity = Math.max(0, 1.0 - (currentProgress - 0.74) / 0.05);
      }
      if (kernelStage) kernelStage.style.opacity = kernelOpacity;

      if (currentProgress >= 0.73) {
        tesseractActive = true;
        const tessOp = Math.min(1.0, (currentProgress - 0.73) / 0.04);
        if (tesseractStage) tesseractStage.style.opacity = tessOp;
      }

      // Metric Rupture Flash
      let flashOpacity = 0.0;
      if (currentProgress >= 0.73 && currentProgress <= 0.78) {
        const peak = 0.755;
        if (currentProgress < peak) {
          flashOpacity = (currentProgress - 0.73) / (peak - 0.73);
        } else {
          flashOpacity = (0.78 - currentProgress) / (0.78 - peak);
        }
      }
      if (ruptureFlash && !isCollapsingCube) {
        ruptureFlash.style.opacity = flashOpacity * 0.9;
      }

      if (currentProgress >= 0.74 && !hasRupturedSound) {
        hasRupturedSound = true;
        if (window.spacetimeAudio) window.spacetimeAudio.triggerRuptureBoom();
      }

      if (currentProgress >= 0.765 && !isInSingularity) {
        enterSingularity();
      }

      if (videoOpacity > 0.01) renderVideo();
      if (kernelOpacity > 0.01) renderKernel(currentProgress, dt);

      // Real-time telemetry HUD descent updates
      if (hudStatus) {
        hudStatus.textContent = isAutoDiving ? 'AUTOPILOT TRAJECTORY // COLLAPSING' : 'MANUAL SCROLL ORBIT // DESCENT';
      }
      if (telemetrySector) {
        const fNum = Math.min(FRAME_COUNT, Math.round(currentFrame) + 1);
        telemetrySector.textContent = `00 // FRAME ${fNum} OF ${FRAME_COUNT}`;
      }
      if (telemetryCoord) {
        const rVal = Math.max(1.0, (12.45 - (currentProgress / 0.74) * 10.45)).toFixed(2);
        telemetryCoord.textContent = `r = ${rVal} M // EVENT HORIZON`;
      }
    }

    // 2. 5D Tesseract Three.js Scene: Unbounded Free Flight & Infinite Photo/Term Bulk
    if (tesseractActive && scene && camera && renderer && !isCollapsingCube) {
      // 1. Keyboard Free Flight (NO LIMITS: WASD / Arrows / EQ / Space / Shift)
      const flightSpeed = 820 * dt;
      const thrust = new THREE.Vector3(0, 0, 0);

      // Directions: Z for forward/backward, X for strafe left/right, Y for vertical UP/DOWN
      if (keys.forward) thrust.z -= 1;
      if (keys.backward) thrust.z += 1;
      if (keys.right) thrust.x += 1;
      if (keys.left) thrust.x -= 1;
      if (keys.up) thrust.y += 1;
      if (keys.down) thrust.y -= 1;

      if (thrust.lengthSq() > 0) {
        thrust.normalize();
        freeFlightVel.addScaledVector(thrust, flightSpeed);
        isNavigatingToStation = false;
      }

      // Smooth zero-g inertia and drift
      freeFlightVel.multiplyScalar(0.91);
      freeFlightPos.add(freeFlightVel);

      // 2. Station navigation interpolation (from mouse scroll wheel or timeline buttons)
      if (isNavigatingToStation) {
        freeFlightPos.lerp(targetStationPos, dt * 4.0);
        if (freeFlightPos.distanceTo(targetStationPos) < 2.0) {
          isNavigatingToStation = false;
        }
      }

      // 3. Smooth mouse parallax tilt (old intuitive mouse look)
      const parallaxX = mouseX * 28;
      const parallaxY = -mouseY * 20;

      // Position camera with parallax
      camera.position.set(
        freeFlightPos.x + parallaxX,
        freeFlightPos.y + parallaxY,
        freeFlightPos.z
      );

      // Camera look direction smoothly tracks forward with subtle mouse tilt
      const lookTarget = new THREE.Vector3(
        targetStationLook.x + mouseX * 18,
        targetStationLook.y - mouseY * 14,
        targetStationLook.z
      );
      camera.lookAt(lookTarget);

      animateRealityChambers(now);

      if (stringGroup) stringGroup.rotation.z = Math.sin(now * 0.0004) * 0.02;
      if (dustParticles) dustParticles.rotation.y = now * 0.00008;

      renderer.render(scene, camera);
    }

    // 3. Audio update
    if (window.spacetimeAudio) {
      window.spacetimeAudio.update(currentProgress, 0, dt);
      updateAudioVisualizer();
    }

    // Continuously schedule next frame for 60fps smooth frame scrubbing, interpolation & 3D parallax
    animationFrameId = requestAnimationFrame(loop);
  }

  function animateRealityChambers(now) {
    realityGroups.forEach((ch, idx) => {
      const u = ch.userData;
      if (u && u.photoMesh) {
        // Floating levitation
        const floatY = u.baseY + Math.sin(now * 0.0018 + idx * 1.1) * 6.5;
        u.photoMesh.position.y = floatY;
        if (u.frameLine) u.frameLine.position.y = floatY;

        // Subtle tilting
        const tilt = Math.sin(now * 0.001 + idx * 0.8) * 0.06;
        u.photoMesh.rotation.y = tilt;
        if (u.frameLine) u.frameLine.rotation.y = tilt;
      }
    });
  }

  function updateAudioVisualizer() {
    if (!window.spacetimeAudio) return;
    const wave = window.spacetimeAudio.getWaveformData();
    if (!wave || !eqBars[0]) return;

    for (let i = 0; i < 4; i++) {
      const val = wave[i * 4] || 10;
      const heightPercent = Math.max(15, (val / 255) * 100);
      eqBars[i].style.height = `${heightPercent}%`;
    }
  }

  function updateTelemetryHUD() {
    if (!isInSingularity) return;
    const st = STATIONS[currentStep];

    if (hudStatus) hudStatus.textContent = st.status;
    if (telemetrySector) telemetrySector.textContent = `${currentStep} / ${MAX_STEP} • ${st.name}`;
    if (telemetryMetric) telemetryMetric.textContent = "5D BULK LATTICE";
    if (telemetryCoord) telemetryCoord.textContent = st.coord;
    if (telemetryTime) telemetryTime.textContent = st.time;
    if (telemetryBulk) telemetryBulk.textContent = st.bulk;

    timelineSteps.forEach(btn => {
      const stepIdx = parseInt(btn.dataset.step, 10);
      if (stepIdx === currentStep) btn.classList.add('active');
      else btn.classList.remove('active');
    });

    if (hudScrollHint) {
      const hintText = hudScrollHint.querySelector('span');
      if (currentStep === 0) {
        hintText.textContent = "SCROLL / SWIPE TO ENTER 01 ABOUT";
      } else if (currentStep === MAX_STEP) {
        hintText.textContent = "END OF TIMELINE // CONTACT ARCHITECT";
      } else {
        hintText.textContent = `SCROLL TO ADVANCE TO ${STATIONS[currentStep + 1]?.name || 'NEXT'}`;
      }
    }
  }

  function startLoopIfNeeded() {
    if (!animationFrameId) {
      lastTime = performance.now();
      animationFrameId = requestAnimationFrame(loop);
    }
  }

  // -------------------------------------------------------------
  // REALITY MODAL CONTROLLER
  // -------------------------------------------------------------
  function openRealityModal(index) {
    const data = REALITY_DATA[index];
    if (!data) return;

    modalTag.textContent = data.timelineCoord;
    modalTitle.textContent = data.title;
    modalSubtitle.textContent = data.subtitle;
    modalFormula.textContent = data.formula;
    modalBody.innerHTML = data.body;

    modalActions.innerHTML = '';
    data.actions.forEach(act => {
      const a = document.createElement('a');
      a.className = act.primary ? 'modal-btn-primary' : 'modal-btn-secondary';
      a.textContent = act.label;
      a.href = act.href;
      if (act.href.startsWith('http') || act.href.startsWith('mailto')) {
        a.target = '_blank';
        a.rel = 'noopener noreferrer';
      }
      modalActions.appendChild(a);
    });

    modalBackdrop.classList.add('is-open');
    modalBackdrop.setAttribute('aria-hidden', 'false');
  }

  function closeRealityModal() {
    modalBackdrop.classList.remove('is-open');
    modalBackdrop.setAttribute('aria-hidden', 'true');
  }

  if (modalCloseBtn) modalCloseBtn.addEventListener('click', closeRealityModal);
  if (modalBackdrop) {
    modalBackdrop.addEventListener('click', (e) => {
      if (e.target === modalBackdrop) closeRealityModal();
    });
  }
  window.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      if (modalBackdrop && modalBackdrop.classList.contains('is-open')) closeRealityModal();
      if (identityModal && identityModal.classList.contains('is-open')) identityModal.classList.remove('is-open');
    }
  });

  window.addEventListener('resize', resize, { passive: true });

  initTesseract();
  resize();
  progressiveLoad();
  startLoopIfNeeded();
})();
