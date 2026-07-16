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
          <span class="brand__mark">E</span>
          <span class="brand__text"><span class="brand__name">EDI Hochbau GmbH</span><span class="brand__tagline">Rohbau · Berlin · Brandenburg</span></span>
        </a>
        <p>Stahlbeton- und Massivbau-Subunternehmer für Generalunternehmer. PQ-VOB präqualifiziert, VOB/B-konform, eigene Kolonnen.</p>
      </div>
      <div class="footer__col">
        <h4>Leistungen</h4>
        <ul><li><a href="#leistungen">Stahlbeton & Sichtbeton</a></li><li><a href="#leistungen">Mauerwerksbau</a></li><li><a href="#leistungen">Schalung</a></li><li><a href="#leistungen">Bewehrung</a></li><li><a href="#leistungen">Schlüsselfertiger Rohbau</a></li></ul>
      </div>
      <div class="footer__col">
        <h4>Compliance</h4>
        <ul><li>PQ-VOB Nr. 12345</li><li>VOB/B Vertragsbasis</li><li>BG BAU Unbedenklichkeit</li><li>SOKA-BAU aktiv</li><li>§ 48b EStG Freistellung</li><li>10 Mio € Haftpflicht</li></ul>
      </div>
    </div>
    <div class="footer__bottom"><span>© 2026 EDI Hochbau GmbH</span><span><a href="#">Impressum</a> · <a href="#">Datenschutz</a></span></div>
  </div>
</footer>

<script>
const header=document.getElementById('site-header');
window.addEventListener('scroll',()=>{header.classList.toggle('is-scrolled',window.scrollY>12)},{passive:true});
const io=new IntersectionObserver(es=>es.forEach(e=>{if(e.isIntersecting){e.target.classList.add('is-visible');io.unobserve(e.target)}}),{threshold:0.12,rootMargin:'0px 0px -8% 0px'});
document.querySelectorAll('.reveal').forEach(el=>io.observe(el));
document.querySelector('form').addEventListener('submit',e=>{e.preventDefault();alert('Demo — Form-Backend nicht verdrahtet.')});
</script>
<?php wp_footer(); ?>
</body>
</html>
