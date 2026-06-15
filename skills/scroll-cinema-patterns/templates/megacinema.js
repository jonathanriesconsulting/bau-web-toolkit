/**
 * Scroll-Cinema — full-viewport sticky stage, N phases, scroll-driven.
 * Validated on PKB V5 (9 Bauphasen) + PKB V11 (4 Master-Phasen).
 *
 * HTML structure expected:
 *   <div data-cinema data-total="N">
 *     <div class="cinema__stage">
 *       <div class="cinema__images">
 *         <img data-phase="0" class="is-active">
 *         <img data-phase="1">
 *         ...
 *       </div>
 *       <div class="cinema__overlay">
 *         <article class="master is-active" data-phase="0">...</article>
 *         <article class="master" data-phase="1">...</article>
 *         ...
 *       </div>
 *       <footer>
 *         <div class="cinema__progress">
 *           <button class="step is-active" data-phase="0"></button>
 *           ...
 *         </div>
 *         <span data-phase-label>Beraten</span>
 *         <span data-phase-counter>01 / 04</span>
 *       </footer>
 *     </div>
 *   </div>
 */
(function () {
	'use strict';

	const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
	const ready = (fn) => (document.readyState !== 'loading')
		? fn()
		: document.addEventListener('DOMContentLoaded', fn);

	ready(() => {
		document.querySelectorAll('[data-cinema]').forEach(initCinema);
	});

	function initCinema(cinema) {
		const total = parseInt(cinema.dataset.total, 10) || 1;
		const images = cinema.querySelectorAll('.cinema__images img');
		const masters = cinema.querySelectorAll('.master');
		const steps = cinema.querySelectorAll('.cinema__progress .step');
		const counter = cinema.querySelector('[data-phase-counter]');
		const label = cinema.querySelector('[data-phase-label]');

		const phaseTitles = Array.from(masters).map((el) => {
			const t = el.querySelector('h3, .master__title');
			return t ? t.textContent.trim() : '';
		});

		let currentPhase = -1;

		const setPhase = (i, segmentProgress = 0) => {
			i = Math.max(0, Math.min(total - 1, i));
			if (i !== currentPhase) {
				currentPhase = i;
				images.forEach((el, idx) => el.classList.toggle('is-active', idx === i));
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
			const phaseFloat = p * total;
			const phaseIndex = Math.min(total - 1, Math.floor(phaseFloat));
			const segmentProgress = Math.max(0, Math.min(1, phaseFloat - phaseIndex));
			setPhase(phaseIndex, segmentProgress);
		};

		let ticking = false;
		const onScrollThrottled = () => {
			if (!ticking) {
				ticking = true;
				requestAnimationFrame(() => { onScroll(); ticking = false; });
			}
		};

		window.addEventListener('scroll', onScrollThrottled, { passive: true });
		window.addEventListener('resize', onScrollThrottled);
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
				window.scrollTo({
					top: targetY,
					behavior: reduceMotion ? 'auto' : 'smooth'
				});
			});
		});
	}
})();
