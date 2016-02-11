<link rel="stylesheet" type="text/css" href="/css/clients.css"/>
<section class="main content clearfix">
	<?php if(isset($clients) && !empty($clients)) : ?>
		<section class="clients-holder">
		<?php $i = 0; foreach ($clients as $client) : $i++; ?>
			<article class="client">
				<div class="logo-holder"><img src="/<?php echo $client->logo_path; ?>"></div>
				<h1 class="client-name">
					<?php echo $client->get_language_name($this->get_language()); ?>
				</h1>
			</article>
		<?php endforeach; ?>
		</section>
	<?php else : ?>
		<p>Trenutno nema dodatih klijenata.</p>
	<?php endif; ?>
</section>