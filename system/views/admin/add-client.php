<link rel="stylesheet" type="text/css" href="/css/form.css"/>
<script src="/js/tinymce/tinymce.min.js"></script>
<section class="content">
	<h1>Dodaj novog klijenta</h1>
	<?php if (isset($success) && $success == true) : ?>
		<div class="alert alert-success">Uspešno ste dodali klijenta <a href="/admin/edit-client/<?php echo $id; ?>"><?php echo $title; ?></a></div>
	<?php endif; ?>
	<form action="/admin/add-client" method="post" enctype="multipart/form-data">
		<div class="tabbed-form sr" data-role="tabbed_form">
			<div class="tab_title sr" data-role="tab" data-value="sr">Srpski</div>
			<div class="tab_title en" data-role="tab" data-value="en">English</div>
			<div class="tab sr_tab">
				<?php generate_form_field("text", "name_sr", "Ime", "", $errors, "Ime klijenta"); ?>
			</div>
			<div class="tab en_tab">
				<?php generate_form_field("text", "name_en", "Name", "", $errors, "Name of the client"); ?>
			</div>
		</div>
		<?php generate_form_field("file", "logo_path", "Logo", "", $errors); ?>
		<div class="form-field">
			<label for="published">Status:</label>
			<select id="published" name="published">
				<option value="false">Skriven</option>
				<option value="true">Objavljen</option>
			</select>
		</div>
		<div class="form-field">
			<input type="submit" name="submit" value="Sačuvaj">
		</div>
	</form>
</section>