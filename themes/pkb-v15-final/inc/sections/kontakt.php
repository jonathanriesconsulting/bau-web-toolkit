<?php
/**
 * Kontakt — dunkle Kontrast-Insel #5 (rahmt den Abschluss). KEINE Gratis-Versprechen.
 */
?>
<section class="section section--dark" id="kontakt" data-theme="dark">
	<div class="container">
		<header class="section-marker section-marker--on-dark reveal">
			<span class="mono mono--on-dark">05 · Kontakt</span>
			<span class="mono" style="color:var(--c-white);">Bauanfrage</span>
			<span class="section-marker__rule"></span>
		</header>

		<h2 class="contact__display reveal">Sprechen wir über Ihr Bauvorhaben.</h2>
		<p class="contact__lead reveal">Beschreiben Sie Objektart, Standort, geplante Wohn- oder Nutzfläche und Zeitrahmen. Liegt ein Leistungsverzeichnis oder eine Planung vor, senden Sie diese direkt mit. Antwort mit erster Machbarkeits-Einschätzung innerhalb von 48&nbsp;Stunden.</p>

		<div class="contact">
			<div class="contact__info reveal">
				<div class="contact__row">
					<span class="mono mono--on-dark">Firma</span>
					<div class="contact__value" style="font-size:1.125rem;line-height:1.4;font-weight:400;">Pascal Kacemer<br>Bauunternehmung GmbH</div>
				</div>
				<div class="contact__row">
					<span class="mono mono--on-dark">Register</span>
					<div class="contact__value" style="font-size:1.125rem;line-height:1.4;font-weight:400;">HRB 286721 B<br>HWK 150096</div>
				</div>
				<div class="contact__row">
					<span class="mono mono--on-dark">Sitz</span>
					<div class="contact__value" style="font-size:1.125rem;line-height:1.4;font-weight:400;">Alt-Buch 57<br>13125 Berlin</div>
				</div>
			</div>

			<form class="contact__form reveal" method="post" action="" novalidate>
				<div class="field">
					<label for="kontakt-name">Name / Firma</label>
					<input id="kontakt-name" name="name" type="text" required>
				</div>
				<div class="field">
					<label for="kontakt-email">E-Mail</label>
					<input id="kontakt-email" name="email" type="email" required>
				</div>
				<div class="field">
					<label for="kontakt-phone">Telefon (optional)</label>
					<input id="kontakt-phone" name="phone" type="tel">
				</div>
				<div class="field">
					<label for="kontakt-message">Ihr Bauvorhaben</label>
					<textarea id="kontakt-message" name="message" rows="5" placeholder="Objektart, Standort, Wohn-/Nutzfläche, Zeitrahmen …" required></textarea>
				</div>
				<button class="btn btn--invert contact__submit" type="submit">Bauanfrage senden</button>
				<p class="contact__note">Form-Versand wird per Plugin verbunden.</p>
			</form>
		</div>
	</div>
</section>
