/**
 * PKB Theme — client JS.
 *  - Header background when scrolled
 *  - Header color when over dark section
 *  - Reveal-on-scroll fallback for browsers without animation-timeline
 *  - Slideshow: scroll-driven via triggers, manual click jumps to trigger
 */
(function () {
	'use strict';

	const header = document.querySelector('[data-pkb-header]');

	// --- Sticky header background -------------------------------------
	const onScroll = () => {
		if (!header) return;
		header.classList.toggle('is-scrolled', window.scrollY > 8);
	};
	window.addEventListener('scroll', onScroll, { passive: true });
	onScroll();

	// --- Mobile nav toggle (Hamburger / Off-Canvas) -------------------
	const navToggle  = document.getElementById('nav-toggle');
	const primaryNav = document.getElementById('primary-nav');
	if (navToggle && header) {
		const closeNav = () => {
			header.classList.remove('nav-open');
			navToggle.setAttribute('aria-expanded', 'false');
			navToggle.setAttribute('aria-label', 'Menü öffnen');
			document.body.classList.remove('nav-lock');
		};
		navToggle.addEventListener('click', () => {
			const open = header.classList.toggle('nav-open');
			navToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
			navToggle.setAttribute('aria-label', open ? 'Menü schließen' : 'Menü öffnen');
			document.body.classList.toggle('nav-lock', open);
		});
		if (primaryNav) {
			primaryNav.querySelectorAll('a').forEach((a) => a.addEventListener('click', closeNav));
		}
		window.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeNav(); });
	}

	// --- Header colour over dark sections -----------------------------
	const themedSections = document.querySelectorAll('[data-theme]');
	if (themedSections.length && 'IntersectionObserver' in window) {
		const themeObs = new IntersectionObserver(
			(entries) => {
				entries.forEach((entry) => {
					if (!entry.isIntersecting || !header) return;
					const theme = entry.target.getAttribute('data-theme');
					header.classList.toggle('is-on-dark', theme === 'dark');
				});
			},
			{ rootMargin: '-1px 0px -98% 0px', threshold: 0 }
		);
		themedSections.forEach((s) => themeObs.observe(s));
	}

	// --- Reveal-on-scroll fallback ------------------------------------
	if (!CSS.supports('animation-timeline: view()') && 'IntersectionObserver' in window) {
		const revealEls = document.querySelectorAll('.reveal');
		const revealObs = new IntersectionObserver(
			(entries) => {
				entries.forEach((entry) => {
					if (entry.isIntersecting) {
						entry.target.classList.add('is-visible');
						revealObs.unobserve(entry.target);
					}
				});
			},
			{ rootMargin: '0px 0px -10% 0px', threshold: 0.05 }
		);
		revealEls.forEach((el) => revealObs.observe(el));
	}

	// --- Bauphasen Canvas Scroll (Step 3 inside Slideshow) -----------
	// Renders construction phase frames onto a canvas, mapped to scroll
	// progress through an extended trigger. Loader stays on poster image
	// until enough frames are decoded.
	function initBauphasen(figure, trigger) {
		const canvas       = figure.querySelector('.slides__bauphasen-canvas');
		const poster       = figure.querySelector('.slides__bauphasen-poster');
		if (!canvas || !trigger) return null;

		const frameCount   = Number(figure.dataset.frameCount) || 0;
		const framesUrl    = figure.dataset.framesUrl || '';
		const padded       = (n) => String(n).padStart(3, '0');
		const frameSrc     = (i) => `${framesUrl}/frame_${padded(i + 1)}.jpg`;
		const eager        = Math.min(8, frameCount);
		const ctx          = canvas.getContext('2d', { alpha: false });
		const dpr          = Math.min(window.devicePixelRatio || 1, 2);
		const frames       = new Array(frameCount);
		let loaded         = 0;
		let currentFrame   = -1;
		let pending        = false;
		let started        = false;

		function resizeCanvas() {
			const rect = canvas.getBoundingClientRect();
			canvas.width  = Math.max(1, Math.round(rect.width  * dpr));
			canvas.height = Math.max(1, Math.round(rect.height * dpr));
			ctx.imageSmoothingEnabled = true;
			ctx.imageSmoothingQuality = 'high';
			currentFrame = -1;
			requestRender();
		}

		function loadFrame(i) {
			return new Promise((resolve) => {
				const img = new Image();
				img.decoding = 'async';
				img.onload = () => {
					const finish = () => { frames[i] = img; loaded++; resolve(img); };
					if (img.decode) img.decode().then(finish).catch(finish);
					else finish();
				};
				img.onerror = () => { loaded++; resolve(null); };
				img.src = frameSrc(i);
			});
		}

		async function preload() {
			if (started) return;
			started = true;
			const eagerJobs = [];
			for (let i = 0; i < eager; i++) eagerJobs.push(loadFrame(i));
			await Promise.all(eagerJobs);
			figure.classList.add('is-bauphasen-ready');
			resizeCanvas();
			requestRender();
			// Rest progressiv im Hintergrund
			for (let i = eager; i < frameCount; i++) loadFrame(i);
		}

		function drawCover(img) {
			if (!img) return;
			const cw = canvas.width, ch = canvas.height;
			const iw = img.naturalWidth, ih = img.naturalHeight;
			const scale = Math.max(cw / iw, ch / ih);
			const dw = iw * scale, dh = ih * scale;
			const dx = (cw - dw) * 0.5, dy = (ch - dh) * 0.5;
			ctx.clearRect(0, 0, cw, ch);
			ctx.drawImage(img, dx, dy, dw, dh);
		}

		function calcFrameIndex() {
			const rect = trigger.getBoundingClientRect();
			const total = rect.height - window.innerHeight;
			if (total <= 0) return 0;
			const scrolled = Math.min(Math.max(-rect.top, 0), total);
			const progress = scrolled / total;
			return Math.min(Math.max(Math.round(progress * (frameCount - 1)), 0), frameCount - 1);
		}

		function render() {
			const target = calcFrameIndex();
			let frame = frames[target];
			if (!frame) {
				for (let i = target; i >= 0; i--) {
					if (frames[i]) { frame = frames[i]; break; }
				}
			}
			if (!frame || target === currentFrame) return;
			drawCover(frame);
			currentFrame = target;
		}

		function requestRender() {
			if (pending) return;
			pending = true;
			requestAnimationFrame(() => { pending = false; render(); });
		}

		// Resize handling
		let resizeRaf = 0;
		window.addEventListener('resize', () => {
			cancelAnimationFrame(resizeRaf);
			resizeRaf = requestAnimationFrame(resizeCanvas);
		}, { passive: true });

		// Scroll handler — only active when figure is visible
		window.addEventListener('scroll', requestRender, { passive: true });

		// Start preload when trigger gets close to viewport
		if ('IntersectionObserver' in window) {
			const preObs = new IntersectionObserver((entries) => {
				entries.forEach((e) => {
					if (e.isIntersecting) {
						preload();
						preObs.disconnect();
					}
				});
			}, { rootMargin: '200% 0px 200% 0px' });
			preObs.observe(trigger);
		} else {
			preload();
		}

		// Respect reduced motion: only show poster, skip canvas rendering
		if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
			poster.style.opacity = '1';
			return { preload: () => {} };
		}

		return { preload };
	}

	// --- Slideshow (scroll-driven) ------------------------------------
	document.querySelectorAll('[data-pkb-slides]').forEach((root) => {
		const slides   = root.querySelectorAll('.slides__slide');
		const captions = root.querySelectorAll('.slides__caption');
		const navBtns  = root.querySelectorAll('.slides__nav-btn');
		const triggers = root.querySelectorAll('.slides__trigger');
		const indexEl  = root.querySelector('[data-pkb-slides-index]');
		const total    = Number(root.dataset.total) || slides.length;
		const padded   = (n) => String(n).padStart(2, '0');

		let current = 0;

		// Wire up Bauphasen canvas, if any step uses it
		const bauphasenFigures = root.querySelectorAll('[data-pkb-bauphasen]');
		bauphasenFigures.forEach((figure) => {
			const step = Number(figure.dataset.step);
			const trigger = root.querySelector(`.slides__trigger[data-step="${step}"]`);
			initBauphasen(figure, trigger);
		});

		const setActive = (step) => {
			if (step === current || step < 0 || step >= total) return;
			current = step;
			slides.forEach((el, i) => el.classList.toggle('is-active', i === step));
			captions.forEach((el, i) => el.classList.toggle('is-active', i === step));
			navBtns.forEach((el, i) => {
				const on = i === step;
				el.classList.toggle('is-active', on);
				el.setAttribute('aria-selected', on ? 'true' : 'false');
			});
			if (indexEl) indexEl.textContent = `${padded(step + 1)} / ${padded(total)}`;
		};

		// Scroll-driven: each trigger represents one step. When a trigger's
		// centre crosses the viewport centre, set its step active.
		if (triggers.length && 'IntersectionObserver' in window) {
			const obs = new IntersectionObserver(
				(entries) => {
					entries.forEach((entry) => {
						if (entry.isIntersecting) {
							setActive(Number(entry.target.dataset.step));
						}
					});
				},
				{ rootMargin: '-50% 0px -50% 0px', threshold: 0 }
			);
			triggers.forEach((t) => obs.observe(t));
		}

		// Manual nav: clicking a tab scrolls to its trigger position
		navBtns.forEach((btn) => {
			btn.addEventListener('click', () => {
				const step = Number(btn.dataset.step);
				const trigger = triggers[step];
				// Auf Mobile sind die Trigger display:none (offsetParent === null)
				// → direkt umschalten statt zu einer ungültigen Position zu scrollen.
				if (trigger && trigger.offsetParent !== null) {
					const rect = trigger.getBoundingClientRect();
					const targetY = window.scrollY + rect.top - (window.innerHeight - rect.height) / 2;
					window.scrollTo({ top: targetY, behavior: 'smooth' });
				} else {
					setActive(step);
				}
			});
		});
	});
})();
