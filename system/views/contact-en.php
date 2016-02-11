<link rel="stylesheet" type="text/css" href="/css/form.css"/>
<section class="main content">
	<b>Telephone:</b> +38111 3442717<br>
	<b>Mobile tel.:</b> +38163 453 835<br>
	<b>Address:</b> Ustanicka street, 12 entrance 1, 11000 Belgrade<br>
	<b>E mail:</b> <img src="http://www.advokatmarinkovic.rs/wp-content/uploads/2014/08/mail-w.png" alt="mail-w" width="211" height="14" class="email-img">
	<form action="/sr/kontakt" method="post">
		<?php generate_form_field("text", "name", "Your name", "", $errors, "Your name"); ?>
		<?php generate_form_field("text", "email", "Your email", "", $errors, "Your email address"); ?>
		<?php generate_form_field("textarea", "message", "Your message", "", $errors, "", "contact-message"); ?>
		<div class="form-field">
			<input type="submit" name="submit" value="Send">
		</div>
	</form>
</section>