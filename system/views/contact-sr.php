<link rel="stylesheet" type="text/css" href="/css/form.css"/>
<section class="main content">
	<b>Telefon:</b> +38111 3442717<br>
	<b>Mobilni tel.:</b> +38163 453 835<br>
	<b>Adresa:</b> Ustanička 12 ulaz 1, 11000 Beograd<br>
	<b>E mail:</b> <img src="/img/mail-w.png" alt="mail-w" width="211" height="14" class="email-img">
	<?php if (isset($success) && $success == true) : ?>
		<div class="alert alert-success">Poruka je uspešno poslata. Hvala!</div>
	<?php endif; ?>
	<div class="map-holder">
		<iframe width="100%" height="100%" frameborder="0" style="border:0; float: right;" src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJV63M3G5wWkcR2YFAgdRsdts&key=AIzaSyCGfEpgpr93uSckvlwiUU9FLbLbgdpuO0o" allowfullscreen></iframe>
	</div>
	<form name="contact" action="/sr/kontakt" method="post">
		<input type="hidden" name="token" value="<?php echo $token; ?>">
		<?php generate_form_field("text", "name", "Vaše ime", "", $errors, "Vaše ime"); ?>
		<?php generate_form_field("text", "email", "Vaš email", "", $errors, "Vaša email adresa"); ?>
		<?php generate_form_field("textarea", "message", "Vaša poruka", "", $errors, "", "contact-message"); ?>
		<div class="form-field">
			<input type="submit" name="submit" value="Pošalji">
		</div>
	</form>
</section>

