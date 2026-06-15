// V10 Hybrid — interactions

// Header scroll
const header = document.querySelector('.site-header');
const onScroll = () => {
  if (window.scrollY > 20) header.classList.add('is-scrolled');
  else header.classList.remove('is-scrolled');
};
window.addEventListener('scroll', onScroll, { passive: true });
onScroll();

// Burger
const burger = document.querySelector('.burger');
const navList = document.querySelector('.nav-list');
if (burger) {
  burger.addEventListener('click', () => {
    burger.classList.toggle('is-open');
    navList.classList.toggle('is-open');
    document.body.style.overflow = navList.classList.contains('is-open') ? 'hidden' : '';
  });
  navList.querySelectorAll('a').forEach(a => a.addEventListener('click', () => {
    burger.classList.remove('is-open');
    navList.classList.remove('is-open');
    document.body.style.overflow = '';
  }));
}

// Reveal on scroll
const revealObs = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('is-visible');
      revealObs.unobserve(entry.target);
    }
  });
}, { threshold: 0.12, rootMargin: '0px 0px -60px 0px' });
document.querySelectorAll('.reveal').forEach(el => revealObs.observe(el));

// Counter animation
const animateCount = (el) => {
  const target = parseInt(el.dataset.count, 10);
  const suffix = el.dataset.suffix || '';
  const duration = 1800;
  const start = performance.now();
  const step = (now) => {
    const p = Math.min((now - start) / duration, 1);
    const eased = 1 - Math.pow(1 - p, 4);
    el.textContent = Math.floor(target * eased) + suffix;
    if (p < 1) requestAnimationFrame(step);
  };
  requestAnimationFrame(step);
};
const statObs = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      animateCount(entry.target);
      statObs.unobserve(entry.target);
    }
  });
}, { threshold: 0.5 });
document.querySelectorAll('[data-count]').forEach(el => statObs.observe(el));

// Bento spotlight (V9 trick)
document.querySelectorAll('.bento-card').forEach(card => {
  card.addEventListener('mousemove', (e) => {
    const rect = card.getBoundingClientRect();
    const x = ((e.clientX - rect.left) / rect.width) * 100;
    const y = ((e.clientY - rect.top) / rect.height) * 100;
    card.style.setProperty('--mx', `${x}%`);
    card.style.setProperty('--my', `${y}%`);
  });
});

// Hero chart line-draw animation
const chart = document.querySelector('.hero-card-chart svg path:last-of-type');
if (chart) {
  try {
    const len = chart.getTotalLength();
    chart.style.strokeDasharray = len;
    chart.style.strokeDashoffset = len;
    chart.style.transition = 'stroke-dashoffset 2.4s cubic-bezier(0.22, 1, 0.36, 1) 0.4s';
    requestAnimationFrame(() => { chart.style.strokeDashoffset = '0'; });
  } catch (e) {}
}

// Code-snippet line-by-line reveal
document.querySelectorAll('.bento-feature-visual').forEach(code => {
  const lines = code.querySelectorAll('.line');
  lines.forEach((line, i) => {
    line.style.opacity = '0';
    line.style.transform = 'translateX(-6px)';
    line.style.transition = `opacity .35s ease ${0.1 + i * 0.08}s, transform .35s ease ${0.1 + i * 0.08}s`;
  });
  const codeObs = new IntersectionObserver(([entry]) => {
    if (entry.isIntersecting) {
      lines.forEach(line => {
        line.style.opacity = '1';
        line.style.transform = 'translateX(0)';
      });
      codeObs.unobserve(entry.target);
    }
  }, { threshold: 0.3 });
  codeObs.observe(code);
});

// Form
const form = document.querySelector('#contact-form form');
if (form) {
  form.addEventListener('submit', (e) => {
    e.preventDefault();
    const status = document.querySelector('#form-status');
    if (status) {
      status.textContent = '✓ Vielen Dank — wir melden uns innerhalb von 24 Stunden.';
      status.style.color = 'var(--accent)';
    }
    form.reset();
  });
}
