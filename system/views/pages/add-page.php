<link rel="stylesheet" type="text/css" href="/css/form.css"/>
<script src="/js/tinymce/tinymce.min.js"></script>
<section class="content">
	<h1>Dodaj novu stranicu</h1>
	<?php if (isset($success) && $success == true) : ?>
		<div class="alert alert-success">Uspešno ste dodali stranicu.</div>
	<?php endif; ?>
	<form action="/admin/add-page" method="post">
		<div class="tabbed-form sr" data-role="tabbed_form">
			<div class="tab_title sr" data-role="tab" data-value="sr">Srpski</div>
			<div class="tab_title en" data-role="tab" data-value="en">English</div>
			<div class="tab sr_tab">
				<?php generate_form_field("text", "title_sr", "Naslov", "", $errors, "Naslov stranice"); ?>
				<?php generate_form_field("textarea", "body_sr", "Sadržaj stranice", "", $errors); ?>
			</div>
			<div class="tab en_tab">
				<div class="form-field">
					<label for="title_en">Title:</label>
					<input type="text" name="title_en" id="title_en" placeholder="Title">
				</div>
				<div class="form-field">
					<label for="body_en">Page content:</label>
					<textarea name="body_en" id="body_en"></textarea>
				</div>
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
	$(document).ready(function(){
		$("[data-role='tab']").click(function(){
			var val = $(this).data("value");
			if (val == "sr")
				showSrTab();
			else if (val == "en")
				showEnTab();
		});
	});
	function showSrTab() {
		$("[data-role='tabbed_form']").removeClass("en").addClass("sr");
	}
	function showEnTab() {
		$("[data-role='tabbed_form']").removeClass("sr").addClass("en");
	}
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