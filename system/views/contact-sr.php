<link rel="stylesheet" type="text/css" href="/css/form.css"/>
<section class="main content">
	<b>Telefon:</b> +38111 3442717<br>
	<b>Mobilni tel.:</b> +38163 453 835<br>
	<b>Adresa:</b> Ustanička 12 ulaz 1, 11000 Beograd<br>
	<b>E mail:</b> <img src="http://www.advokatmarinkovic.rs/wp-content/uploads/2014/08/mail-w.png" alt="mail-w" width="211" height="14" class="email-img">
	<form action="/sr/kontakt" method="post">
		<?php generate_form_field("text", "name", "Vaše ime", "", $errors, "Vaše ime"); ?>
		<?php generate_form_field("text", "email", "Vaš email", "", $errors, "Vaša email adresa"); ?>
		<?php generate_form_field("textarea", "message", "Vaša poruka", "", $errors, "", "contact-message"); ?>
		<div class="form-field">
			<input type="submit" name="submit" value="Pošalji">
		</div>
	</form>
</section>