/**
 * EDI Hochbau — Frontend JS.
 *
 *  - Header scroll state (background lift + border)
 *  - Mobile nav toggle
 *  - Reveal-on-scroll (IntersectionObserver fallback when animation-timeline isn't supported)
 *  - Smooth-scroll for anchor links (closes mobile nav after click)
 *  - FAQ: optional behavior to close other open items in the same group
 */
(function () {
	'use strict';

	const supportsScrollTimeline = CSS.supports && CSS.supports('animation-timeline: view()');
	const $ = (sel, ctx = document) => ctx.querySelector(sel);
	const $$ = (sel, ctx = document) => Array.from(ctx.querySelectorAll(sel));

	/* ----------------------------------------
	   Header scroll state
	   ---------------------------------------- */
	const header = $('#site-header');
	if (header) {
		const onScroll = () => {
			if (window.scrollY > 8) header.classList.add('is-scrolled');
			else header.classList.remove('is-scrolled');
		};
		onScroll();
		window.addEventListener('scroll', onScroll, { passive: true });
	}

	/* ----------------------------------------
	   Mobile nav toggle
	   ---------------------------------------- */
	const toggle = $('#nav-toggle');
	if (toggle && header) {
		toggle.addEventListener('click', () => {
			const open = header.classList.toggle('nav-open');
			toggle.setAttribute('aria-expanded', String(open));
			toggle.setAttribute('aria-label', open ? 'Menü schließen' : 'Menü öffnen');
		});
		$$('.nav a').forEach((a) => {
			a.addEventListener('click', () => {
				header.classList.remove('nav-open');
				toggle.setAttribute('aria-expanded', 'false');
			});
		});
	}

	/* ----------------------------------------
	   Reveal-on-scroll (JS fallback for non-Chromium / Safari)
	   ---------------------------------------- */
	if (!supportsScrollTimeline && 'IntersectionObserver' in window) {
		const io = new IntersectionObserver(
			(entries) => {
				entries.forEach((entry) => {
					if (entry.isIntersecting) {
						entry.target.classList.add('is-visible');
						io.unobserve(entry.target);
					}
				});
			},
			{ rootMargin: '0px 0px -10% 0px', threshold: 0.05 }
		);
		$$('.reveal').forEach((el) => io.observe(el));
	} else if (supportsScrollTimeline) {
		// Native animation-timeline handles it — but add a safety net so above-the-fold reveals are visible
		setTimeout(() => {
			$$('.reveal').forEach((el) => {
				const rect = el.getBoundingClientRect();
				if (rect.top < window.innerHeight) el.classList.add('is-visible');
			});
		}, 60);
	}

	/* ----------------------------------------
	   FAQ — close siblings on open (one-open-per-group UX)
	   ---------------------------------------- */
	$$('.faq__group').forEach((group) => {
		const items = $$('details.faq-item', group);
		items.forEach((d) => {
			d.addEventListener('toggle', () => {
				if (d.open) {
					items.forEach((other) => {
						if (other !== d && other.open) other.open = false;
					});
				}
			});
		});
	});

	/* ----------------------------------------
	   File input — show filename in drop label
	   ---------------------------------------- */
	$$('.field--file input[type="file"]').forEach((input) => {
		input.addEventListener('change', () => {
			const label = input.closest('.file-drop')?.querySelector('span');
			if (!label) return;
			if (input.files && input.files.length > 0) {
				const name = input.files[0].name;
				const more = input.files.length > 1 ? ` (+${input.files.length - 1})` : '';
				label.textContent = '✓ ' + name + more;
			} else {
				label.textContent = '↑ LV / Pläne anhängen (PDF, ZIP — max 20 MB)';
			}
		});
	});
})();

/* ============================================================
   EDI MegaCinema — Scroll-driven Canvas Frame Renderer
   Portiert aus PKB V11 mit EDI-spezifischen Sub-Gewerke-Mappings.
   ============================================================ */
(function () {
	'use strict';

	const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

	document.addEventListener('DOMContentLoaded', initMegaCinema);

	function initMegaCinema() {
		const cinema = document.querySelector('[data-edi-megacinema]');
		if (!cinema) return;

		const total = parseInt(cinema.dataset.total, 10) || 1;
		const masters = cinema.querySelectorAll('.edi-master');
		const steps = cinema.querySelectorAll('.edi-mc__progress-step');
		const counter = cinema.querySelector('[data-edi-phase-counter]');
		const label = cinema.querySelector('[data-edi-phase-label]');

		const frameHost = cinema.querySelector('[data-edi-bauframes]');
		const canvas = frameHost ? frameHost.querySelector('.edi-mc__canvas') : null;
		const ctx = canvas ? canvas.getContext('2d', { alpha: false }) : null;
		const frameCount = frameHost ? (parseInt(frameHost.dataset.frameCount, 10) || 0) : 0;
		const framesUrl = frameHost ? (frameHost.dataset.framesUrl || '') : '';
		const frames = new Array(frameCount);
		const eagerCount = Math.min(10, frameCount);
		const dpr = Math.min(window.devicePixelRatio || 1, 2);
		let currentFrame = -1;
		let preloadStarted = false;

		// EDI Sub-Gewerke → Frame-Range Mapping (5 Phasen, 75 Frames)
		// Da Video subtile Kran-Animation zeigt (kein echter Bauphasen-Wechsel),
		// gleichmäßige Verteilung 15 Frames pro Sub-Gewerk
		const phaseFrameMap = [
			{ start:  0, end: 14 }, // 01 Stahlbetonbau
			{ start: 15, end: 29 }, // 02 Mauerwerksbau
			{ start: 30, end: 44 }, // 03 Schalungsarbeiten
			{ start: 45, end: 59 }, // 04 Bewehrungsarbeiten
			{ start: 60, end: 74 }, // 05 Schlüsselfertiger Rohbau
		];
		const HOLD_RATIO = 0.08; // 8% Scroll-Hold am Anfang

		const padFrame = (n) => String(n).padStart(3, '0');
		const frameSrc = (i) => `${framesUrl}/frame_${padFrame(i + 1)}.jpg`;

		function resizeCanvas() {
			if (!canvas) return;
			const rect = canvas.getBoundingClientRect();
			canvas.width = Math.max(1, Math.round(rect.width * dpr));
			canvas.height = Math.max(1, Math.round(rect.height * dpr));
			ctx.imageSmoothingEnabled = true;
			ctx.imageSmoothingQuality = 'high';
			currentFrame = -1;
		}

		function loadFrame(i) {
			return new Promise((resolve) => {
				const img = new Image();
				img.decoding = 'async';
				img.onload = () => {
					const done = () => { frames[i] = img; resolve(img); };
					if (img.decode) img.decode().then(done).catch(done);
					else done();
				};
				img.onerror = () => resolve(null);
				img.src = frameSrc(i);
			});
		}

		async function startPreload() {
			if (preloadStarted || !frameCount || reduceMotion) return;
			preloadStarted = true;
			const eagerJobs = [];
			for (let i = 0; i < eagerCount; i++) eagerJobs.push(loadFrame(i));
			await Promise.all(eagerJobs);
			if (frameHost) frameHost.classList.add('is-ready');
			resizeCanvas();
			renderFrame(0);
			for (let i = eagerCount; i < frameCount; i++) loadFrame(i);
		}

		function drawCover(img) {
			if (!img || !canvas || !ctx) return;
			const cw = canvas.width, ch = canvas.height;
			const iw = img.naturalWidth, ih = img.naturalHeight;
			const scale = Math.max(cw / iw, ch / ih);
			const dw = iw * scale, dh = ih * scale;
			const dx = (cw - dw) * 0.5, dy = (ch - dh) * 0.5;
			ctx.clearRect(0, 0, cw, ch);
			ctx.drawImage(img, dx, dy, dw, dh);
		}

		function renderFrame(target) {
			if (!canvas || !frameCount) return;
			target = Math.max(0, Math.min(frameCount - 1, target));
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

		const progressToFrame = (p) => {
			if (!frameCount) return 0;
			if (p < HOLD_RATIO) return 0;
			const remapped = (p - HOLD_RATIO) / (1 - HOLD_RATIO);
			return Math.round(remapped * (frameCount - 1));
		};

		const frameToPhase = (frameIdx) => {
			for (let i = phaseFrameMap.length - 1; i >= 0; i--) {
				if (frameIdx >= phaseFrameMap[i].start) return i;
			}
			return 0;
		};

		const phaseSegmentProgress = (frameIdx, phaseIdx) => {
			const range = phaseFrameMap[phaseIdx];
			if (!range) return 0;
			const span = range.end - range.start;
			if (span <= 0) return 1;
			return Math.max(0, Math.min(1, (frameIdx - range.start) / span));
		};

		const phaseTitles = Array.from(masters).map((el) => {
			const t = el.querySelector('.edi-master__title');
			return t ? t.textContent.trim() : '';
		});

		let currentPhase = -1;

		const setPhase = (i, segmentProgress = 0) => {
			i = Math.max(0, Math.min(total - 1, i));
			if (i !== currentPhase) {
				currentPhase = i;
				masters.forEach((el, idx) => el.classList.toggle('is-active', idx === i));
				steps.forEach((el, idx) => {
					el.classList.toggle('is-active', idx === i);
					el.classList.toggle('is-passed', idx < i);
				});
				const padNum = String(i + 1).padStart(2, '0');
				const padTotal = String(total).padStart(2, '0');
				if (counter) counter.textContent = `${padNum} / ${padTotal}`;
				if (label) label.textContent = phaseTitles[i];
			}
			steps.forEach((el, idx) => {
				if (idx === i) el.style.setProperty('--p', String(segmentProgress));
				else el.style.removeProperty('--p');
			});
		};

		const onScroll = () => {
			const rect = cinema.getBoundingClientRect();
			const stageH = window.innerHeight;
			const scrollable = cinema.offsetHeight - stageH;
			if (scrollable <= 0) return;
			const raw = (-rect.top) / scrollable;
			const p = Math.max(0, Math.min(1, raw));

			const frameIdx = progressToFrame(p);
			if (frameCount) renderFrame(frameIdx);

			const phaseIndex = frameToPhase(frameIdx);
			const segmentProgress = phaseSegmentProgress(frameIdx, phaseIndex);
			setPhase(phaseIndex, segmentProgress);
		};

		let ticking = false;
		const onScrollThrottled = () => {
			if (!ticking) {
				ticking = true;
				requestAnimationFrame(() => {
					onScroll();
					ticking = false;
				});
			}
		};

		// Preload-Trigger sobald cinema in der Nähe
		if (frameCount && 'IntersectionObserver' in window) {
			const preObs = new IntersectionObserver((entries) => {
				entries.forEach((e) => {
					if (e.isIntersecting) {
						startPreload();
						preObs.disconnect();
					}
				});
			}, { rootMargin: '300% 0px 300% 0px' });
			preObs.observe(cinema);
		} else if (frameCount) {
			startPreload();
		}

		window.addEventListener('scroll', onScrollThrottled, { passive: true });
		window.addEventListener('resize', () => {
			resizeCanvas();
			onScrollThrottled();
		});
		onScroll();

		// Click on progress step → scroll to that phase
		steps.forEach((step) => {
			step.addEventListener('click', () => {
				const i = parseInt(step.dataset.phase, 10);
				if (isNaN(i)) return;
				const rect = cinema.getBoundingClientRect();
				const cinemaTop = window.scrollY + rect.top;
				const stageH = window.innerHeight;
				const scrollable = cinema.offsetHeight - stageH;
				const targetY = cinemaTop + (scrollable * (i / total)) + 8;
				window.scrollTo({ top: targetY, behavior: reduceMotion ? 'auto' : 'smooth' });
			});
		});
	}
})();
