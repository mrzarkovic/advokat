<section class="admin content">
	<h1>Lista stranica:</h1>
	<?php if(isset($page_deleted) && $page_deleted == true) : ?>
		<div class="alert alert-success">Stranica je obrisana.</div>
	<?php endif; ?>
	<?php if (isset($pages) && !empty($pages)) : ?>
	<ol class="pages-list">
		<?php foreach ($pages as $page) : ?>
			<li><a href="/admin/edit-page/<?php echo $page->id; ?>"><?php echo $page->title_sr; ?></a> (<?php echo ($page->published) ? "Objavljena" : "Skrivena"; ?>)<div class="admin-controls"><a href="/admin/delete-page/<?php echo $page->id; ?>" data-role="del">Obriši</a> | <a href="/admin/edit-page/<?php echo $page->id; ?>">Izmeni</a></div></li>
		<?php endforeach; ?>
	</ol>
	<?php else : ?>
		<p>Trenutno nema napravljenih stranica.</p>
	<?php endif; ?>
</section>