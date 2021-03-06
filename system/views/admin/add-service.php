<link rel="stylesheet" type="text/css" href="/css/form.css"/>
<script src="/js/tinymce/tinymce.min.js"></script>
<section class="content">
	<h1>Dodaj novu uslugu</h1>
	<?php if (isset($success) && $success == true) : ?>
		<div class="alert alert-success">Uspešno ste dodali uslugu <a href="/admin/edit-service/<?php echo $id; ?>"><?php echo $title; ?></a></div>
	<?php endif; ?>
	<form action="/admin/add-service" method="post">
		<div class="tabbed-form sr" data-role="tabbed_form">
			<div class="tab_title sr" data-role="tab" data-value="sr">Srpski</div>
			<div class="tab_title en" data-role="tab" data-value="en">English</div>
			<div class="tab sr_tab">
				<?php generate_form_field("text", "title_sr", "Naziv", "", $errors, "Naziv usluge"); ?>
				<?php generate_form_field("textarea", "body_sr", "Opis usluge", "", $errors); ?>
			</div>
			<div class="tab en_tab">
				<?php generate_form_field("text", "title_en", "Title", "", $errors, "Title of the page"); ?>
				<?php generate_form_field("textarea", "body_en", "Description", "", $errors); ?>
			</div>
		</div>
		<div class="form-field">
			<label for="published">Status:</label>
			<select id="published" name="published">
				<option value="false">Skrivena</option>
				<option value="true">Objavljena</option>
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