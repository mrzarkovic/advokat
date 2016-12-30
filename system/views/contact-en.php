<link rel="stylesheet" type="text/css" href="/css/form.css"/>
<section class="main content">
	<b>Telephone:</b> +38111 3442717<br>
	<b>Mobile tel.:</b> +38163 453 835<br>
	<b>Address:</b> Ustanicka street, 12 entrance 1, 11000 Belgrade<br>
	<b>E mail:</b> <img src="/img/mail-w.png" alt="mail-w" width="211" height="14" class="email-img">
	<?php if (isset($success) && $success == true) : ?>
		<div class="alert alert-success">Message has been sent. Thank you!</div>
	<?php endif; ?>
	<div class="map-holder">
		<iframe width="100%" height="100%" frameborder="0" style="border:0; float: right;" src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJV63M3G5wWkcR2YFAgdRsdts&key=AIzaSyCGfEpgpr93uSckvlwiUU9FLbLbgdpuO0o" allowfullscreen></iframe>
	</div>
	<form name="contact" action="/sr/kontakt" method="post">
		<input type="hidden" name="token" value="<?php echo $token; ?>">
		<?php generate_form_field("text", "name", "Your name", "", $errors, "Your name"); ?>
		<?php generate_form_field("text", "email", "Your email", "", $errors, "Your email address"); ?>
		<?php generate_form_field("textarea", "message", "Your message", "", $errors, "", "contact-message"); ?>
		<div class="form-field">
			<input type="submit" name="submit" value="Send">
		</div>
	</form>
</section>
