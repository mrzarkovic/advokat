<link rel="stylesheet" type="text/css" href="/css/form.css"/>
<script src="/js/tinymce/tinymce.min.js"></script>
<section class="content">
	<h1>Izmeni uslugu '<?php echo $service->title_sr; ?>'</h1>
	<?php if (isset($success) && $success == true) : ?>
		<div class="alert alert-success">Uspešno ste izmenili uslugu.</div>
	<?php endif; ?>
	<form action="/admin/edit-service/<?php echo $service->id; ?>" method="post">
		<div class="tabbed-form sr" data-role="tabbed_form">
			<div class="tab_title sr" data-role="tab" data-value="sr">Srpski</div>
			<div class="tab_title en" data-role="tab" data-value="en">English</div>
			<div class="tab sr_tab">
				<?php generate_form_field("text", "title_sr", "Naziv", $service->title_sr, $errors, "Naslov stranice"); ?>
				<?php generate_form_field("textarea", "body_sr", "Opis usluge", $service->body_sr, $errors); ?>
			</div>
			<div class="tab en_tab">
				<?php generate_form_field("text", "title_en", "Title", $service->title_en, $errors, "Title of the page"); ?>
				<?php generate_form_field("textarea", "body_en", "Description", $service->body_en, $errors); ?>
			</div>
		</div>
		<div class="form-field">
			<label for="published">Status:</label>
			<select id="published" name="published">
				<option value="false" <?php echo (!$service->published) ? "selected" : ""; ?>>Skrivena</option>
				<option value="true"<?php echo ($service->published) ? "selected" : ""; ?>>Objavljena</option>
			</select>
		</div>
		<div class="form-field">
			<input type="submit" name="submit" value="Sačuvaj">
		</div>
	</form>
</section>
<script>
	tinymce.init({
		selector: "textarea",
		plugins: "image jbimages paste",
		menubar: "edit format insert",
		toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright | image jbimages",
		image_list: "/admin/list-of-images",
		image_description: false,
		image_dimensions: false,
		relative_urls: false,
		oninit : "setPlainText",
		height : 200
	});
</script>