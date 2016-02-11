<section class="main content">
	<?php if (isset($page) && !empty($page)) : ?>
	<article class="page-text"><?php echo $page->get_language_body($lang); ?></article>
	<?php else : ?>
		<p>Stranica nije pronadjena</p>
	<?php endif; ?>
</section>
