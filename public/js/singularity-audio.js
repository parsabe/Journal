/**
 * Interstellar Spacetime Acoustic Engine
 * Master Soundtrack: "Hans Zimmer - Organ Variation"
 * 
 * Features:
 * - 100% Reliable HTML5 Audio Engine (No Web Audio CORS lockouts or file:// restrictions)
 * - Black Hole Physical Synthesizer (Infrasonic sub-bass & relativistic accretion vortex)
 * - Relativistic Quantum Clock (Time dilation ticking)
 * - Metric Rupture Shockwave Boom
 * - Dynamic Equalizer Waveform Synthesizer for HUD Visualizer
 */

class SpacetimeAudioEngine {
  constructor() {
    this.ctx = null;
    this.isInitialized = false;
    this.isMuted = false;
    this.masterVolume = 0.85;
    this.isPlayingMusic = false;
    this.hasRuptured = false;
    this.lastPluckTime = 0;
    this.lastTickTime = 0;
    this.tickInterval = 0.8;
    this.userHasPaused = false;

    this.audioElement = null;
    this.setupAudioElement();
  }

  setupAudioElement() {
    // Try grabbing preloaded DOM element first, otherwise instantiate Audio
    const existing = document.getElementById('bgMusic');
    if (existing) {
      this.audioElement = existing;
    } else {
      this.audioElement = new Audio('/audio/hans_zimmer.mp3');
      this.audioElement.loop = true;
      this.audioElement.preload = 'auto';
    }

    this.audioElement.volume = this.masterVolume;
    this.audioElement.loop = true;

    // Track playback state & synchronize across HUD and Taskbar
    const onPlay = () => {
      this.isPlayingMusic = true;
      const banner = document.getElementById('audioBanner');
      if (banner) banner.classList.add('is-dismissed');
      const btnText = document.getElementById('audioBtnText');
      if (btnText && !this.isMuted) btnText.textContent = "HANS ZIMMER";
      if (typeof window.syncTaskbarAudioState === 'function') {
        window.syncTaskbarAudioState();
      }
    };

    const onPause = () => {
      this.isPlayingMusic = false;
      const btnText = document.getElementById('audioBtnText');
      if (btnText && !this.isMuted) btnText.textContent = "PAUSED";
      if (typeof window.syncTaskbarAudioState === 'function') {
        window.syncTaskbarAudioState();
      }
    };

    this.audioElement.addEventListener('playing', onPlay);
    this.audioElement.addEventListener('play', onPlay);
    this.audioElement.addEventListener('pause', onPause);

    this.audioElement.addEventListener('error', (e) => {
      console.warn("Audio element error on primary path, attempting secondary fallback:", e);
      if (this.audioElement.currentSrc && this.audioElement.currentSrc.indexOf('hans_zimmer.mp3') !== -1) {
        this.audioElement.src = '/audio/Hans Zimmer - Organ Variation.mp3';
        this.audioElement.load();
        if (!this.userHasPaused) this.playTrack();
      }
    });
  }

  playTrack() {
    if (this.userHasPaused) return;
    if (!this.audioElement || !document.contains(this.audioElement)) {
      this.setupAudioElement();
    }
    if (!this.audioElement) return;

    if (this.ctx && this.ctx.state === 'suspended') {
      this.ctx.resume().catch(() => {});
    }

    this.audioElement.muted = this.isMuted;
    this.audioElement.volume = this.masterVolume;

    const promise = this.audioElement.play();
    if (promise !== undefined) {
      promise.then(() => {
        this.isPlayingMusic = true;
        const banner = document.getElementById('audioBanner');
        if (banner) banner.classList.add('is-dismissed');
        const btnText = document.getElementById('audioBtnText');
        if (btnText && !this.isMuted) btnText.textContent = "HANS ZIMMER";
        if (typeof window.syncTaskbarAudioState === 'function') {
          window.syncTaskbarAudioState();
        }
      }).catch(err => {
        console.log("Audio waiting for user gesture:", err);
      });
    }
  }

  pauseTrack() {
    this.userHasPaused = true;
    if (this.audioElement) {
      this.audioElement.pause();
      this.isPlayingMusic = false;
    }
    if (this.ctx && this.ctx.state === 'running') {
      this.ctx.suspend().catch(() => {});
    }
    const btnText = document.getElementById('audioBtnText');
    if (btnText) btnText.textContent = "PAUSED";
    if (typeof window.syncTaskbarAudioState === 'function') {
      window.syncTaskbarAudioState();
    }
  }

  togglePlayPause() {
    if (!this.audioElement || !document.contains(this.audioElement)) {
      this.setupAudioElement();
    }
    if (!this.audioElement) return false;

    if (!this.audioElement.paused) {
      this.pauseTrack();
      return false; // now paused
    } else {
      this.userHasPaused = false;
      if (this.ctx && this.ctx.state === 'suspended') {
        this.ctx.resume().catch(() => {});
      }
      this.playTrack();
      return true; // now playing
    }
  }

  init() {
    if (this.isInitialized) return;

    try {
      const AudioContext = window.AudioContext || window.webkitAudioContext;
      this.ctx = new AudioContext();
    } catch (e) {
      console.warn("Web Audio API not supported for physical SFX", e);
      this.isInitialized = true;
      return;
    }

    // Master bus for physical acoustic effects
    this.masterGain = this.ctx.createGain();
    this.masterGain.gain.setValueAtTime(this.masterVolume, this.ctx.currentTime);

    this.compressor = this.ctx.createDynamicsCompressor();
    this.compressor.threshold.setValueAtTime(-14, this.ctx.currentTime);
    this.compressor.knee.setValueAtTime(12, this.ctx.currentTime);
    this.compressor.ratio.setValueAtTime(6, this.ctx.currentTime);
    this.compressor.attack.setValueAtTime(0.003, this.ctx.currentTime);
    this.compressor.release.setValueAtTime(0.25, this.ctx.currentTime);

    this.masterGain.connect(this.compressor);
    this.compressor.connect(this.ctx.destination);

    // Physical ambient layers (Infrasonic singularity drone, accretion vortex, tesseract chimes)
    this.initSingularityPhysics();
    this.initTesseractAtmosphere();

    this.isInitialized = true;
  }

  resumeContext() {
    if (this.userHasPaused) return;
    this.playTrack();

    if (!this.ctx) {
      this.init();
    }
    if (this.ctx && this.ctx.state === 'suspended') {
      this.ctx.resume().catch(() => {});
    }
  }

  // -------------------------------------------------------------
  // SINGULARITY PHYSICAL ACOUSTICS (Drone & Vortex)
  // -------------------------------------------------------------
  initSingularityPhysics() {
    if (!this.ctx) return;

    this.singularityGain = this.ctx.createGain();
    this.singularityGain.gain.setValueAtTime(0.001, this.ctx.currentTime);

    // Infrasonic Sub-Bass (35-45 Hz gravitational wave drone)
    this.subOsc = this.ctx.createOscillator();
    this.subOsc.type = 'sine';
    this.subOsc.frequency.setValueAtTime(42, this.ctx.currentTime);

    this.subGain = this.ctx.createGain();
    this.subGain.gain.setValueAtTime(0.35, this.ctx.currentTime);
    this.subOsc.connect(this.subGain);
    this.subGain.connect(this.singularityGain);
    this.subOsc.start();

    // Accretion Vortex Noise (Brownian filtered rumble)
    const bufferSize = this.ctx.sampleRate * 2;
    const noiseBuffer = this.ctx.createBuffer(1, bufferSize, this.ctx.sampleRate);
    const output = noiseBuffer.getChannelData(0);
    let lastOut = 0.0;
    for (let i = 0; i < bufferSize; i++) {
      const white = Math.random() * 2 - 1;
      output[i] = (lastOut + (0.02 * white)) / 1.02;
      lastOut = output[i];
      output[i] *= 2.5;
    }

    this.vortexNoise = this.ctx.createBufferSource();
    this.vortexNoise.buffer = noiseBuffer;
    this.vortexNoise.loop = true;

    this.vortexFilter = this.ctx.createBiquadFilter();
    this.vortexFilter.type = 'bandpass';
    this.vortexFilter.frequency.setValueAtTime(140, this.ctx.currentTime);
    this.vortexFilter.Q.setValueAtTime(3.2, this.ctx.currentTime);

    this.vortexGain = this.ctx.createGain();
    this.vortexGain.gain.setValueAtTime(0.25, this.ctx.currentTime);

    this.vortexNoise.connect(this.vortexFilter);
    this.vortexFilter.connect(this.vortexGain);
    this.vortexGain.connect(this.singularityGain);
    this.vortexNoise.start();

    this.singularityGain.connect(this.masterGain);
  }

  initTesseractAtmosphere() {
    if (!this.ctx) return;
    this.tesseractGain = this.ctx.createGain();
    this.tesseractGain.gain.setValueAtTime(0.001, this.ctx.currentTime);
    this.tesseractGain.connect(this.masterGain);
  }

  // -------------------------------------------------------------
  // QUANTUM CLOCK TICK (Time Dilation)
  // -------------------------------------------------------------
  playQuantumTick(timeDilationRatio) {
    if (!this.ctx || this.isMuted) return;

    const osc = this.ctx.createOscillator();
    const gain = this.ctx.createGain();
    const filter = this.ctx.createBiquadFilter();

    osc.type = 'triangle';
    osc.frequency.setValueAtTime(1600 * (1 / Math.max(0.4, timeDilationRatio)), this.ctx.currentTime);

    filter.type = 'bandpass';
    filter.frequency.setValueAtTime(1400, this.ctx.currentTime);
    filter.Q.setValueAtTime(4.0, this.ctx.currentTime);

    const tickVol = 0.05 * Math.min(1.0, 1.8 - timeDilationRatio);
    gain.gain.setValueAtTime(tickVol, this.ctx.currentTime);
    gain.gain.exponentialRampToValueAtTime(0.0001, this.ctx.currentTime + 0.04);

    osc.connect(filter);
    filter.connect(gain);
    gain.connect(this.masterGain);

    osc.start();
    osc.stop(this.ctx.currentTime + 0.05);
  }

  // -------------------------------------------------------------
  // METRIC RUPTURE SONIC BOOM
  // -------------------------------------------------------------
  triggerRuptureBoom() {
    if (!this.ctx || this.hasRuptured) return;
    this.hasRuptured = true;
    const now = this.ctx.currentTime;

    const subOsc = this.ctx.createOscillator();
    const subGain = this.ctx.createGain();
    subOsc.type = 'sine';
    subOsc.frequency.setValueAtTime(110, now);
    subOsc.frequency.exponentialRampToValueAtTime(28, now + 1.4);

    subGain.gain.setValueAtTime(0.65, now);
    subGain.gain.exponentialRampToValueAtTime(0.0001, now + 2.0);

    subOsc.connect(subGain);
    subGain.connect(this.masterGain);
    subOsc.start(now);
    subOsc.stop(now + 2.2);
  }

  // -------------------------------------------------------------
  // REAL-TIME PHYSICAL UPDATES (Bound to Scroll & Singularity Physics)
  // -------------------------------------------------------------
  update(progress, scrollVelocity, dt) {
    // 1. Subtle Quantum Clock Ticking
    if (this.ctx && this.ctx.state === 'running') {
      const timeDilation = Math.max(0.2, 1.0 - progress * 0.85);
      const currentTickInterval = this.tickInterval * (0.6 + timeDilation * 0.6);
      if (this.ctx.currentTime - this.lastTickTime > currentTickInterval) {
        this.lastTickTime = this.ctx.currentTime;
        this.playQuantumTick(timeDilation);
      }

      // 2. Accretion Rumble Dynamics
      if (progress >= 0.45 && progress < 0.74) {
        const kernelIntensity = (progress - 0.45) / (0.74 - 0.45);
        const singVol = Math.min(0.4, kernelIntensity * 0.45);
        if (this.singularityGain) {
          this.singularityGain.gain.linearRampToValueAtTime(singVol, this.ctx.currentTime + 0.1);
        }
        if (progress < 0.70) {
          this.hasRuptured = false;
        }
      } else {
        if (this.singularityGain) {
          this.singularityGain.gain.linearRampToValueAtTime(0.001, this.ctx.currentTime + 0.2);
        }
        if (progress >= 0.74 && !this.hasRuptured) {
          this.triggerRuptureBoom();
        }
      }
    }
  }

  // -------------------------------------------------------------
  // CONTROLS & HUD INTEGRATION
  // -------------------------------------------------------------
  toggleMute() {
    this.isMuted = !this.isMuted;
    if (this.audioElement) {
      this.audioElement.muted = this.isMuted;
      if (!this.isMuted && this.audioElement.paused) {
        this.playTrack();
      }
    }
    if (this.masterGain && this.ctx) {
      if (this.isMuted) {
        this.masterGain.gain.setValueAtTime(0.0001, this.ctx.currentTime);
      } else {
        this.masterGain.gain.setValueAtTime(this.masterVolume, this.ctx.currentTime);
      }
    }
    return this.isMuted;
  }

  setVolume(vol) {
    this.masterVolume = Math.max(0, Math.min(1, vol));
    if (this.audioElement) {
      this.audioElement.volume = this.masterVolume;
    }
    if (!this.isMuted && this.masterGain && this.ctx) {
      this.masterGain.gain.setValueAtTime(this.masterVolume, this.ctx.currentTime);
    }
  }

  transitionToWebsite() {
    // Silence cosmic physics and synthesizers so only the pure soundtrack plays on the personal site
    if (this.singularityGain && this.ctx) {
      try {
        this.singularityGain.gain.setValueAtTime(0, this.ctx.currentTime);
      } catch (e) {}
    }
    if (this.tesseractGain && this.ctx) {
      try {
        this.tesseractGain.gain.setValueAtTime(0, this.ctx.currentTime);
      } catch (e) {}
    }
  }

  getWaveformData() {
    // When music is playing and not paused, generate responsive animated equalizer pulses
    if (this.audioElement && !this.audioElement.paused && !this.isMuted && !this.userHasPaused) {
      const t = performance.now() * 0.005;
      return [
        Math.floor(130 + Math.sin(t * 3.1) * 75 + Math.cos(t * 1.7) * 35),
        Math.floor(190 + Math.cos(t * 2.3) * 60 + Math.sin(t * 4.2) * 45),
        Math.floor(165 + Math.sin(t * 2.9) * 80 + Math.cos(t * 3.5) * 30),
        Math.floor(140 + Math.cos(t * 3.7) * 70 + Math.sin(t * 1.9) * 40)
      ];
    }
    return [0, 0, 0, 0];
  }
}

// Export singleton instance
window.spacetimeAudio = new SpacetimeAudioEngine();
