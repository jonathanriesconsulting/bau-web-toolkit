<?php
/**
 * Footer template.
 */
?>
<footer class="footer">
  <div class="container">
    <div class="footer__top">
      <div class="footer__brand">
        <a href="#top" class="brand">
          <span class="brand__mark"><span>E</span></span>
          <span class="brand__text">
            <span class="brand__name">EDI Hochbau GmbH</span>
            <span class="brand__tagline">Rohbau · Berlin · Brandenburg</span>
          </span>
        </a>
        <p>Stahlbeton- und Massivbau-Subunternehmer für Generalunternehmer. PQ-VOB präqualifiziert, VOB/B-konform, eigene Kolonnen und Geräte. Rohbau, der auf Termin steht.</p>
      </div>
      <div class="footer__col">
        <h4>Leistungen</h4>
        <ul>
          <li><a href="#leistungen">Stahlbeton & Sichtbeton</a></li>
          <li><a href="#leistungen">Mauerwerk & Massivbau</a></li>
          <li><a href="#leistungen">Schalungsarbeiten</a></li>
          <li><a href="#leistungen">Bewehrungsarbeiten</a></li>
          <li><a href="#leistungen">Schlüsselfertiger Rohbau</a></li>
        </ul>
      </div>
      <div class="footer__col">
        <h4>Compliance</h4>
        <ul>
          <li>PQ-VOB Nr. 12345</li>
          <li>VOB/B Vertragsbasis</li>
          <li>BG BAU Unbedenklichkeit</li>
          <li>SOKA-BAU aktiv</li>
          <li>§ 48b EStG Freistellung</li>
          <li>10 Mio € Betriebshaftpflicht</li>
        </ul>
      </div>
    </div>
    <div class="footer__bottom">
      <span>© 2026 EDI Hochbau GmbH</span>
      <span><a href="#">Impressum</a> · <a href="#">Datenschutz</a> · <a href="#">AGB</a></span>
    </div>
  </div>
</footer>
<div class="mobile-callbar">
  <a href="tel:+493000000000">📞 +49 30 0000 0000</a>
  <a href="https://wa.me/493000000000" style="color:var(--c-text)">WhatsApp →</a>
</div>
<script>
(function(){
  'use strict';

  // Header scroll-state
  const header = document.getElementById('site-header');
  const onScroll = () => {
    if (window.scrollY > 12) header.classList.add('is-scrolled');
    else header.classList.remove('is-scrolled');
  };
  window.addEventListener('scroll', onScroll, {passive:true});
  onScroll();

  // Reveal on scroll
  const io = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        e.target.classList.add('is-visible');
        io.unobserve(e.target);
      }
    });
  }, {threshold:0.12, rootMargin:'0px 0px -8% 0px'});
  document.querySelectorAll('.reveal').forEach(el => io.observe(el));

  // FAQ — one open per group
  document.querySelectorAll('.faq__group').forEach(group => {
    const items = group.querySelectorAll('.faq__item');
    items.forEach(d => {
      d.addEventListener('toggle', () => {
        if (d.open) items.forEach(o => { if (o !== d) o.removeAttribute('open'); });
      });
    });
  });

  // File-Drop label update
  const fileInput = document.querySelector('.kontakt__file input');
  if (fileInput) {
    fileInput.addEventListener('change', (e) => {
      const span = e.target.parentElement.querySelector('span');
      if (e.target.files.length) {
        span.textContent = `✓ ${e.target.files.length} Datei(en) angehängt`;
      }
    });
  }

  // Form safety
  document.querySelector('form').addEventListener('submit', (e) => {
    e.preventDefault();
    alert('Showcase-Demo — Form-Backend nicht verdrahtet. In WP via Contact Form 7 oder Forminator anbinden.');
  });

})();
</script>
<?php wp_footer(); ?>
</body>
</html>
