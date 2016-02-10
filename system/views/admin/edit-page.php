<link rel="stylesheet" type="text/css" href="/css/form.css"/>
<script src="/js/tinymce/tinymce.min.js"></script>
<section class="content">
	<h1>Izmeni stranicu '<?php echo $page->title_sr; ?>'</h1>
	<?php if (isset($success) && $success == true) : ?>
		<div class="alert alert-success">Uspešno ste izmenili stranicu.</div>
	<?php endif; ?>
	<form action="/admin/edit-page/<?php echo $page->id; ?>" method="post">
		<div class="tabbed-form sr" data-role="tabbed_form">
			<div class="tab_title sr" data-role="tab" data-value="sr">Srpski</div>
			<div class="tab_title en" data-role="tab" data-value="en">English</div>
			<div class="tab sr_tab">
				<?php generate_form_field("text", "title_sr", "Naslov", $page->title_sr, $errors, "Naslov stranice"); ?>
				<?php generate_form_field("textarea", "body_sr", "Sadržaj stranice", $page->body_sr, $errors); ?>
			</div>
			<div class="tab en_tab">
				<?php generate_form_field("text", "title_en", "Title", $page->title_en, $errors, "Title of the page"); ?>
				<?php generate_form_field("textarea", "body_en", "Content", $page->body_en, $errors); ?>
			</div>
		</div>
		<div class="form-field">
			<label for="published">Status:</label>
			<select id="published" name="published">
				<option value="false" <?php echo (!$page->published) ? "selected" : ""; ?>>Skrivena</option>
				<option value="true"<?php echo ($page->published) ? "selected" : ""; ?>>Objavljena</option>
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
		image_list: "/list-of-images",
		image_description: false,
		image_dimensions: false,
		relative_urls: false,
		oninit : "setPlainText",
		height : 400
	});
</script>