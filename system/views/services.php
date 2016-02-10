<link rel="stylesheet" type="text/css" href="/css/services.css"/>
<section class="main content clearfix">
	<?php if(isset($services) && !empty($services)) : ?>
	<div class="fluid-holder">
		<section id="bookmarks" class="cell">
			<ul>
				<?php $i = 0; foreach ($services as $service) : $i++; ?>
				<li>
					<a class="bookmark <?php if ($i == 1) echo "current"; ?>" data-target="<?php echo generate_permalink($service->get_language_title($lang)); ?>" href="#"><?php echo $service->get_language_title($lang); ?></a>
				</li>
				<?php endforeach; ?>
			</ul>
		</section>
		<?php foreach ($services as $service) : ?>
			<article class="cell collapsable" data-value="<?php echo generate_permalink($service->get_language_title($lang)); ?>" style="display: none;">
				<h1><?php echo $service->get_language_title($lang); ?></h1>
				<p><?php echo $service->get_language_body($lang); ?></p>
			</article>
		<?php endforeach; ?>
	</div>
	<?php else : ?>
		<p>Trenutno nema dodatih usluga.</p>
	<?php endif; ?>
</section>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('.collapsable').hide();
		$('.collapsable').first().show();
		$('.bookmark').click(function(e){
			e.preventDefault();
			var target = $(this).data("target");
			$('.collapsable').hide();
			$('.bookmark').removeClass("current");
			$(this).addClass("current");
			$("[data-value='"+target+"']").show();
		});
	});
</script>