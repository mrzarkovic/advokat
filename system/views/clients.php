<link rel="stylesheet" type="text/css" href="/css/clients.css"/>
<section class="main content clearfix">
	<?php if(isset($clients) && !empty($clients)) : ?>
		<?php $i = 0; foreach ($clients as $client) : $i++; ?>
			<article class="client">
				<img src="/<?php echo $client->logo_path; ?>">
				<h1 class="client-name">
					<?php echo $client->get_language_name($this->get_language()); ?>
				</h1>
			</article>
		<?php endforeach; ?>
	<?php else : ?>
		<p>Trenutno nema dodatih klijenata.</p>
	<?php endif; ?>
</section>