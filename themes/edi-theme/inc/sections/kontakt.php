<?php
/**
 * Kontakt — XXL-Telefon + Infoblock + Anfrage-Formular (Frontend only, kein Backend wired).
 */
?>
<section class="section kontakt" id="kontakt" aria-label="Kontakt und Anfrage">
	<div class="container">

		<header class="section-marker reveal">
			<span class="mono mono--gold">07 · Kontakt</span>
			<span class="mono">Direkt anrufen oder LV hochladen</span>
			<span class="section-marker__rule" aria-hidden="true"></span>
		</header>

		<div class="kontakt__grid">

			<!-- LEFT — Phone + info -->
			<div class="reveal">
				<h2 class="kontakt__title">
					Rufen Sie<br>
					den <strong>Bauleiter</strong> an.
				</h2>
				<p class="kontakt__lead">
					Kein Sales-Slot, kein Callback-Formular. Direkt zur Person, die Ihre Baustelle verantwortet.
				</p>

				<a href="tel:+493012345678" class="kontakt__phone" aria-label="Bauleiter anrufen">
					030 / 123 456 78
				</a>
				<div class="kontakt__phone-note">Mo – Fr 6 – 19 Uhr · außerhalb: 0151 / 1234 5678</div>

				<dl class="kontakt__info" aria-label="Kontaktdaten und Standort">
					<div class="kontakt__info-item">
						<small>Anschrift</small>
						<p>
							EDI Hochbau GmbH<br>
							Musterstraße 12<br>
							10115 Berlin
						</p>
					</div>
					<div class="kontakt__info-item">
						<small>E-Mail</small>
						<p>
							<a href="mailto:info@edi-hochbau.de">info@edi-hochbau.de</a><br>
							<a href="mailto:kalkulation@edi-hochbau.de">kalkulation@edi-hochbau.de</a>
						</p>
					</div>
					<div class="kontakt__info-item">
						<small>WhatsApp</small>
						<p>
							<a href="https://wa.me/4915112345678" target="_blank" rel="noopener">+49 151 1234 5678</a><br>
							Direkter Draht zum Bauleiter
						</p>
					</div>
					<div class="kontakt__info-item">
						<small>Vergabe / PQ</small>
						<p>
							PQ-VOB-Nr. 12345<br>
							HRB 123456 B · USt-ID DE123456789
						</p>
					</div>
				</dl>
			</div>

			<!-- RIGHT — Anfrage-Formular -->
			<div class="reveal">
				<form class="kontakt__form-card" action="#" method="post" enctype="multipart/form-data" novalidate>
					<div class="kontakt__form-head">
						<span class="mono">Anfrage GU-Vergabe</span>
						<div class="kontakt__form-title">LV hochladen — Antwort in 5 Werktagen.</div>
					</div>

					<div class="field--row">
						<div class="field">
							<label for="f-firma">Firma / GU</label>
							<input type="text" id="f-firma" name="firma" required autocomplete="organization">
						</div>
						<div class="field">
							<label for="f-rolle">Rolle</label>
							<select id="f-rolle" name="rolle">
								<option>Bauleiter</option>
								<option>Projektleiter</option>
								<option>Einkauf / NU-Vergabe</option>
								<option>Geschäftsführung</option>
								<option>Sonstige</option>
							</select>
						</div>
					</div>

					<div class="field--row">
						<div class="field">
							<label for="f-name">Name</label>
							<input type="text" id="f-name" name="name" required autocomplete="name">
						</div>
						<div class="field">
							<label for="f-tel">Telefon</label>
							<input type="tel" id="f-tel" name="tel" autocomplete="tel" placeholder="0151 …">
						</div>
					</div>

					<div class="field">
						<label for="f-mail">E-Mail</label>
						<input type="email" id="f-mail" name="mail" required autocomplete="email">
					</div>

					<div class="field--row">
						<div class="field">
							<label for="f-projekt">Projektort</label>
							<input type="text" id="f-projekt" name="projekt" placeholder="Berlin · Cottbus · …">
						</div>
						<div class="field">
							<label for="f-bri">BRI / Größenordnung</label>
							<input type="text" id="f-bri" name="bri" placeholder="z. B. 12.000 m³">
						</div>
					</div>

					<div class="field">
						<label for="f-msg">Nachricht / Eckdaten</label>
						<textarea id="f-msg" name="msg" rows="4" placeholder="Geplanter Baustart, Gewerk-Umfang, Vergabe-Termin …"></textarea>
					</div>

					<div class="field field--file">
						<label for="f-file" class="file-drop">
							<span>↑ LV / Pläne anhängen (PDF, ZIP — max 20 MB)</span>
							<input type="file" id="f-file" name="lv" accept=".pdf,.zip,.dwg,.ifc,.xls,.xlsx">
						</label>
					</div>

					<div class="form-actions">
						<button type="submit" class="btn btn--gold">
							Festpreis anfragen
							<span class="btn__arrow" aria-hidden="true">→</span>
						</button>
						<p class="form-actions__note">
							Ihre Daten gehen direkt an die Kalkulation. Antwort in 5 Werktagen. Keine Newsletter, kein Sales-Funnel.
						</p>
					</div>
				</form>
			</div>

		</div>
	</div>
</section>
