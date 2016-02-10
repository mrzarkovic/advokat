<link rel="stylesheet" type="text/css" href="/css/form.css"/>
<script src="/js/tinymce/tinymce.min.js"></script>
<section class="content">
	<h1>Izmeni klijenta '<?php echo $client->name_sr; ?>'</h1>
	<?php if (isset($success) && $success == true) : ?>
		<div class="alert alert-success">Uspešno ste izmenili klijenta.</div>
	<?php endif; ?>
	<form action="/admin/edit-client/<?php echo $client->id; ?>" method="post" enctype="multipart/form-data">
		<div class="tabbed-form sr" data-role="tabbed_form">
			<div class="tab_title sr" data-role="tab" data-value="sr">Srpski</div>
			<div class="tab_title en" data-role="tab" data-value="en">English</div>
			<div class="tab sr_tab">
				<?php generate_form_field("text", "name_sr", "Ime", $client->name_sr, $errors, "Ime klijenta"); ?>
			</div>
			<div class="tab en_tab">
				<?php generate_form_field("text", "name_en", "Name", $client->name_en, $errors, "Name of the client"); ?>
			</div>
		</div>
		<?php generate_form_field("file", "logo_path", "Logo", $client->logo_path, $errors); ?>
		<div class="form-field">
			<label for="published">Status:</label>
			<select id="published" name="published">
				<option value="false" <?php echo (!$client->published) ? "selected" : ""; ?>>Skriven</option>
				<option value="true"<?php echo ($client->published) ? "selected" : ""; ?>>Objavljen</option>
			</select>
		</div>
		<div class="form-field">
			<input type="submit" name="submit" value="Sačuvaj">
		</div>
	</form>
</section>