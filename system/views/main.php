<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $this->title; ?> </title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="/css/style.css"/>
	<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
	<script src="/js/main.js"></script>
</head>
<body>
<div id="page">
	<?php $this->load_template('partials/header'); ?>
	<div class="wrapper">
		<?php $this->load_template($this->template); ?>
	</div>
	<?php $this->load_template('partials/footer'); ?>
</div>
</body>
</html>
