<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $this->title; ?> </title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="/css/style.css"/>
	<link rel="stylesheet" type="text/css" href="/css/admin-style.css"/>
	<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
	<script src="/js/main.js"></script>
</head>
<body>
<div id="page">
	<?php $this->load_template('partials/admin-header'); ?>
	<div class="wrapper">
		<div class="fluid-holder admin-page">
			<section class="cell admin-menu">
				<?php require_once(BASEPATH . '/views/partials/admin-menu.php'); ?>
			</section>
			<section class="cell admin-content">
				<?php $this->load_template($this->template); ?>
			</section>
		</div>

	</div>
</div>
</body>
</html>
