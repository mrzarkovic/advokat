<section class="main content">
	<?php if (isset($page) && !empty($page)) : ?>
		<?php $body_field = "body_" . $this->get_language(); ?>
	<article class="page-text"><?php echo $page->$body_field; ?></article>
	<?php else : ?>
		<p>Stranica nije pronadjena</p>
	<?php endif; ?>
</section>
