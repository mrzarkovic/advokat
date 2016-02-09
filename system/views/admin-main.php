<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $this->title; ?> </title>
	<link rel="stylesheet" type="text/css" href="/css/style.css"/>
	<link rel="stylesheet" type="text/css" href="/css/admin-style.css"/>
	<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
	<script src="/js/main.js"></script>
</head>
<body>
<div class="wrapper">
	<?php
	require_once(BASEPATH . '/views/partials/admin-header.php');
	?>
	<div class="fluid-holder">
		<section class="cell admin-menu">
			<?php require_once(BASEPATH . '/views/partials/admin-menu.php'); ?>
		</section>
		<section class="cell admin-content">
			<?php $this->load_template($this->template); ?>
		</section>
	</div>
	<?php
	require_once(BASEPATH . '/views/partials/footer.php');
	?>
</div>
</body>
</html>
