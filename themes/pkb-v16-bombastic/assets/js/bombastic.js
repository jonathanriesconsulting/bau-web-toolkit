/**
 * PKB v16 — BOMBASTIC interaction layer (research-refined).
 *
 * Disziplin: EIN Signature-Move-Layer, "Massivbau statt Jahrmarkt".
 *   · Preloader — Counter, NUR Erstbesuch (sessionStorage), lenis.stop während Intro
 *   · Lenis 1.3.23 (lerp 0.09, schwer/kontrolliert) → EINE rAF via gsap.ticker
 *   · GSAP 3.15 SplitText line-mask Reveals (seit 3.13 lizenzfrei)
 *   · Custom-Cursor (Dot + Lerp-Ring, mix-blend difference) — nur hover+fine
 *   · Magnetic — NUR CTAs, strength 0.15 (dezent)
 *   · Reveal-on-scroll, Hero Ken-Burns + Parallax, Count-up (data-count)
 *
 * HARD GUARDS: prefers-reduced-motion → alles aus, Inhalt voll sichtbar, nativer Scroll.
 *              coarse/touch → kein Cursor, kein Magnet. Fehlende Lib → graceful degrade.
 */
(function () {
  'use strict';

  var root  = document.documentElement;
  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var fine   = window.matchMedia('(hover: hover) and (pointer: fine)').matches;
  var hasGSAP  = typeof window.gsap !== 'undefined';
  var hasST    = hasGSAP && typeof window.ScrollTrigger !== 'undefined';
  var hasSplit = hasGSAP && typeof window.SplitText !== 'undefined';
  var hasLenis = typeof window.Lenis !== 'undefined';

  root.classList.add('pkb-js');
  if (hasGSAP) {
    var plugins = [];
    if (hasST) plugins.push(window.ScrollTrigger);
    if (hasSplit) plugins.push(window.SplitText);
    if (plugins.length) gsap.registerPlugin.apply(gsap, plugins);
  }

  // ----------------------------------------------------------------
  // LENIS — schwer/kontrolliert, EINE rAF via gsap.ticker
  // ----------------------------------------------------------------
  var lenis = null;
  if (hasLenis && !reduce) {
    lenis = new Lenis({
      lerp: 0.12,          // 0.09 war zu träge → "schwammig". 0.12 koppelt eng an die Eingabe, bremst entschieden.
      smoothWheel: true,
      wheelMultiplier: 1,
      syncTouch: false,    // Mobile nutzt natives OS-Momentum (sauberer als Lenis-Touch-Glättung)
      overscroll: false,   // kein Gummiband am Seitenrand — harter, kontrollierter Stopp
      autoRaf: false,
    });
    if (hasST) {
      lenis.on('scroll', ScrollTrigger.update);
      gsap.ticker.add(function (t) { lenis.raf(t * 1000); });
      gsap.ticker.lagSmoothing(0);
    } else {
      var raf = function (t) { lenis.raf(t); requestAnimationFrame(raf); };
      requestAnimationFrame(raf);
    }
    document.querySelectorAll('a[href^="#"]').forEach(function (a) {
      a.addEventListener('click', function (e) {
        var id = a.getAttribute('href');
        if (id.length < 2) return;
        var target = document.querySelector(id);
        if (!target) return;
        e.preventDefault();
        lenis.scrollTo(target, { offset: -72, duration: 0.9, easing: function (t) { return 1 - Math.pow(1 - t, 3); } });
      });
    });
  }

  // ----------------------------------------------------------------
  // PRELOADER — nur Erstbesuch; lenis gestoppt während Intro
  // ----------------------------------------------------------------
  var pre = document.getElementById('pkb-preloader');
  var seen = false;
  try { seen = sessionStorage.getItem('pkb-seen') === '1'; } catch (e) {}

  function finishReady() { root.classList.add('pkb-ready'); if (lenis) lenis.start(); }

  function killPreloader(animated) {
    if (!pre || pre.dataset.done) { finishReady(); return; }
    pre.dataset.done = '1';
    try { sessionStorage.setItem('pkb-seen', '1'); } catch (e) {}
    if (!animated || reduce || !hasGSAP) {
      pre.style.transition = 'opacity .35s ease';
      pre.style.opacity = '0';
      setTimeout(function () { if (pre.parentNode) pre.remove(); finishReady(); }, 380);
      return;
    }
    var tl = gsap.timeline({ onComplete: function () { if (pre.parentNode) pre.remove(); finishReady(); } });
    tl.to('#pkb-preloader .pkb-pre__count', { opacity: 0, duration: 0.25 })
      .to('#pkb-preloader .pkb-pre__bar', { scaleX: 1, duration: 0.5, ease: 'power3.inOut' }, '<')
      .to('#pkb-preloader', { yPercent: -100, duration: 0.8, ease: 'power4.inOut' }, '+=0.05');
  }

  function startPreloader() {
    if (!pre) { finishReady(); return; }
    if (seen || reduce || !hasGSAP) { killPreloader(false); return; }
    if (lenis) lenis.stop();
    var countEl = pre.querySelector('.pkb-pre__count');
    var obj = { v: 0 };
    gsap.to(obj, {
      v: 100, duration: 1.15, ease: 'power2.out',
      onUpdate: function () { if (countEl) countEl.textContent = String(Math.round(obj.v)).padStart(3, '0'); },
      onComplete: function () { killPreloader(true); },
    });
  }

  window.addEventListener('load', function () { setTimeout(function () { killPreloader(false); }, 50); });
  setTimeout(function () { killPreloader(false); }, 4500); // Failsafe

  // ----------------------------------------------------------------
  function ready(fn) { if (document.readyState !== 'loading') fn(); else document.addEventListener('DOMContentLoaded', fn); }

  ready(function () {
    startPreloader();
    if (reduce) { document.querySelectorAll('.reveal').forEach(function (el) { el.classList.add('is-visible'); }); return; }
    if (hasGSAP && hasST) { initReveals(); initSplit(); initHero(); initCounters(); }
    if (fine) { initCursor(); initMagnetic(); }
  });

  // ---- REVEAL ----
  function initReveals() {
    gsap.utils.toArray('.reveal').forEach(function (el) {
      gsap.fromTo(el, { opacity: 0, y: 18 }, {
        opacity: 1, y: 0, duration: 0.6, ease: 'power3.out',
        scrollTrigger: { trigger: el, start: 'top 90%', once: true },
        onStart: function () { el.classList.add('is-visible'); },
      });
    });
    document.querySelectorAll('.services, .trust-bar__inner, .about__facts').forEach(function (group) {
      if (!group.children.length) return;
      gsap.fromTo(group.children, { opacity: 0, y: 16 }, {
        opacity: 1, y: 0, duration: 0.55, ease: 'power3.out', stagger: 0.06,
        scrollTrigger: { trigger: group, start: 'top 88%', once: true },
      });
    });
  }

  // ---- SPLITTEXT line-mask (GSAP 3.15, frei) ----
  function initSplit() {
    if (!hasSplit) return;
    var targets = document.querySelectorAll('.hero__title, .intro-band__claim, .about__display, .faq-head__title, .contact__display, .cta-bridge__claim');
    targets.forEach(function (el) {
      if (!el || !el.textContent.trim()) return;
      try {
        SplitText.create(el, {
          type: 'lines', mask: 'lines', autoSplit: true,
          onSplit: function (self) {
            return gsap.from(self.lines, {
              yPercent: 100, opacity: 0, duration: 0.7, ease: 'power3.out', stagger: 0.07,
              scrollTrigger: { trigger: el, start: 'top 88%', once: true },
            });
          },
        });
      } catch (e) { /* SplitText API-Variante? still readable */ }
    });
  }

  // ---- HERO Ken-Burns + Parallax ----
  function initHero() {
    var bg = document.querySelector('.hero__bg img');
    var hero = document.querySelector('.hero');
    if (!bg || !hero) return;
    // Reines Ken-Burns-Zoom (kein yPercent-Slide → kein "Schwimmen"), gebremster scrub statt unbounded.
    gsap.fromTo(bg, { scale: 1.0 }, {
      scale: 1.05, ease: 'none',
      scrollTrigger: { trigger: hero, start: 'top top', end: 'bottom top', scrub: 0.3, invalidateOnRefresh: true },
    });
  }

  // ---- COUNT-UP ([data-count]) ----
  function initCounters() {
    document.querySelectorAll('[data-count]').forEach(function (el) {
      var end = parseFloat(el.getAttribute('data-count'));
      if (isNaN(end)) return;
      var suffix = el.getAttribute('data-count-suffix') || '';
      var pad = el.getAttribute('data-count-pad');
      var obj = { v: 0 };
      ScrollTrigger.create({
        trigger: el, start: 'top 90%', once: true,
        onEnter: function () {
          gsap.to(obj, { v: end, duration: 1.2, ease: 'power2.out',
            onUpdate: function () {
              var n = Math.round(obj.v);
              el.textContent = (pad ? String(n).padStart(parseInt(pad, 10), '0') : n) + suffix;
            } });
        },
      });
    });
  }

  // ---- CUSTOM CURSOR ----
  function initCursor() {
    var dot = document.createElement('div'); dot.className = 'pkb-cursor__dot';
    var ring = document.createElement('div'); ring.className = 'pkb-cursor__ring';
    document.body.appendChild(dot); document.body.appendChild(ring);
    root.classList.add('pkb-has-cursor');
    var mx = innerWidth / 2, my = innerHeight / 2, rx = mx, ry = my;
    addEventListener('mousemove', function (e) { mx = e.clientX; my = e.clientY; });
    (function tick() {
      rx += (mx - rx) * 0.18; ry += (my - ry) * 0.18;
      if (hasGSAP) { gsap.set(dot, { x: mx, y: my }); gsap.set(ring, { x: rx, y: ry }); }
      else { dot.style.transform = 'translate3d(' + mx + 'px,' + my + 'px,0)'; ring.style.transform = 'translate3d(' + rx + 'px,' + ry + 'px,0)'; }
      requestAnimationFrame(tick);
    })();
    var sel = 'a, button, .btn, summary, input, textarea, select, [data-cursor]';
    document.addEventListener('mouseover', function (e) { if (e.target.closest(sel)) root.classList.add('pkb-cursor-hover'); });
    document.addEventListener('mouseout',  function (e) { if (e.target.closest(sel)) root.classList.remove('pkb-cursor-hover'); });
    document.addEventListener('mouseleave', function () { root.classList.add('pkb-cursor-hidden'); });
    document.addEventListener('mouseenter', function () { root.classList.remove('pkb-cursor-hidden'); });
  }

  // ---- MAGNETIC (nur CTAs, dezent 0.15) ----
  function initMagnetic() {
    document.querySelectorAll('.btn--invert, .header-cta, .mobilebar__cta, .btn--primary').forEach(function (el) {
      var s = 0.15;
      el.addEventListener('mousemove', function (e) {
        var r = el.getBoundingClientRect();
        var x = (e.clientX - (r.left + r.width / 2)) * s;
        var y = (e.clientY - (r.top + r.height / 2)) * s;
        if (hasGSAP) gsap.to(el, { x: x, y: y, duration: 0.4, ease: 'power3.out' });
        else el.style.transform = 'translate(' + x + 'px,' + y + 'px)';
      });
      el.addEventListener('mouseleave', function () {
        if (hasGSAP) gsap.to(el, { x: 0, y: 0, duration: 0.5, ease: 'power2.out' });
        else el.style.transform = '';
      });
    });
  }

  if (hasST) addEventListener('load', function () { setTimeout(function () { ScrollTrigger.refresh(); }, 250); });
})();
