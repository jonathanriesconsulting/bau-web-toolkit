/**
 * PKB v16 — interaction layer (NATIVES Scrollen + NATIVER Mauszeiger).
 *
 *   · Preloader — Counter, NUR Erstbesuch (sessionStorage)
 *   · GSAP 3.15 SplitText line-mask Reveals (seit 3.13 lizenzfrei)
 *   · Reveal-on-scroll, Hero Ken-Burns, Count-up (data-count) — auf NATIVEM Scroll
 *
 * BEWUSST ENTFERNT: Smooth-Scroll (Lenis), Custom-Cursor, Magnetic-Buttons.
 * Scrollen & Maus sind nativ/normal. ScrollTrigger läuft direkt auf nativem Scroll.
 * HARD GUARD: prefers-reduced-motion → Animationen aus, Inhalt voll sichtbar.
 */
(function () {
  'use strict';

  var root   = document.documentElement;
  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var hasGSAP  = typeof window.gsap !== 'undefined';
  var hasST    = hasGSAP && typeof window.ScrollTrigger !== 'undefined';
  var hasSplit = hasGSAP && typeof window.SplitText !== 'undefined';

  root.classList.add('pkb-js');
  if (hasGSAP) {
    var plugins = [];
    if (hasST) plugins.push(window.ScrollTrigger);
    if (hasSplit) plugins.push(window.SplitText);
    if (plugins.length) gsap.registerPlugin.apply(gsap, plugins);
  }

  // ----------------------------------------------------------------
  // PRELOADER — nur Erstbesuch. Scroll bleibt nativ; während Intro kurz gesperrt.
  // ----------------------------------------------------------------
  var pre = document.getElementById('pkb-preloader');
  var seen = false;
  try { seen = sessionStorage.getItem('pkb-seen') === '1'; } catch (e) {}

  function finishReady() { root.classList.add('pkb-ready'); document.body.style.overflow = ''; }

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
    document.body.style.overflow = 'hidden'; // Scroll nur während des kurzen Intros sperren
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
    // Hero-Headline BEWUSST ausgenommen: sie ist das LCP-Element → sofort scharf sichtbar (gut für SEO/Seriosität).
    var targets = document.querySelectorAll('.intro-band__claim, .about__display, .faq-head__title, .contact__display, .cta-bridge__claim');
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

  // ---- HERO Ken-Burns (subtiler Zoom, an nativen Scroll gekoppelt) ----
  function initHero() {
    var bg = document.querySelector('.hero__bg img');
    var hero = document.querySelector('.hero');
    if (!bg || !hero) return;
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

  if (hasST) addEventListener('load', function () { setTimeout(function () { ScrollTrigger.refresh(); }, 250); });
})();
