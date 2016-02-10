<section class="admin content">
	<h1>Lista klijenata:</h1>
	<?php if(isset($client_deleted) && $client_deleted == true) : ?>
		<div class="alert alert-success">Klijent je obrisan.</div>
	<?php endif; ?>
	<?php if (isset($clients) && !empty($clients)) : ?>
	<ol class="pages-list">
		<?php foreach ($clients as $client) : ?>
			<li><a href="/admin/edit-client/<?php echo $client->id; ?>"><?php echo $client->name_sr; ?></a> (<?php echo ($client->published) ? "Objavljen" : "Skriven"; ?>)<div class="admin-controls"><a href="/admin/delete-client/<?php echo $client->id; ?>" data-role="del">Obriši</a> | <a href="/admin/edit-client/<?php echo $client->id; ?>">Izmeni</a></div></li>
		<?php endforeach; ?>
	</ol>
	<?php else : ?>
		<p>Trenutno nema dodatih klijenata.</p>
	<?php endif; ?>
</section>