<section class="admin content">
	<h1>Lista usluga:</h1>
	<?php if(isset($service_deleted) && $service_deleted == true) : ?>
		<div class="alert alert-success">Usluga je obrisana.</div>
	<?php endif; ?>
	<?php if (isset($services) && !empty($services)) : ?>
	<ol class="pages-list">
		<?php foreach ($services as $service) : ?>
			<li><a href="/admin/edit-service/<?php echo $service->id; ?>"><?php echo $service->title_sr; ?></a> (<?php echo ($service->published) ? "Objavljena" : "Skrivena"; ?>)<div class="admin-controls"><a href="/admin/delete-service/<?php echo $service->id; ?>" data-role="del">Obriši</a> | <a href="/admin/edit-service/<?php echo $service->id; ?>">Izmeni</a></div></li>
		<?php endforeach; ?>
	</ol>
	<?php else : ?>
		<p>Trenutno nema dodatih usluga.</p>
	<?php endif; ?>
</section>