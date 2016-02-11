<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="/js/sortable-list.js"></script>
<section class="admin content">
	<h1>Lista klijenata:</h1>
	<?php if (isset($client_deleted) && $client_deleted == true) : ?>
		<div class="alert alert-success">Klijent je obrisan.</div>
	<?php endif; ?>
	<?php if (isset($clients) && !empty($clients)) : ?>
		<div data-role="order-options" class="order-options">
			<a href="#" data-role="change-order" class="admin-btn change-order">Izmeni raspored</a>
			<a href="#" data-role="save-order" class="admin-btn save-order">Sačuvaj raspored</a>
			<a href="#" data-role="cancel-order" class="admin-btn cancel-order">Poništi izmene rasporeda</a>
		</div>
		<ul class="pages-list" id="sortable">
			<?php $i = 0;
			foreach ($clients as $client) : $i++; ?>
				<li data-role="sortable-item" data-id="<?php echo $client->id; ?>"><span data-role="order"><?php echo $i; ?></span>. <a
						href="/admin/edit-client/<?php echo $client->id; ?>"><?php echo $client->name_sr; ?></a>
					(<?php echo ($client->published) ? "Objavljen" : "Skriven"; ?>)
					<div class="admin-controls"><a href="/admin/delete-client/<?php echo $client->id; ?>"
					                               data-role="del">Obriši</a> | <a
							href="/admin/edit-client/<?php echo $client->id; ?>">Izmeni</a></div>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php else : ?>
		<p>Trenutno nema dodatih klijenata.</p>
	<?php endif; ?>
</section>