<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $this->title; ?> </title>
	<link rel="stylesheet" type="text/css" href="/css/style.css"/>
	<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
	<script src="/js/main.js"></script>
</head>
<body>
<div class="wrapper">
	<?php
	require_once(BASEPATH . '/views/partials/header.php');

	$this->load_template($this->template);

	require_once(BASEPATH . '/views/partials/footer.php');
	?>
</div>
</body>
</html>
