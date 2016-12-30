<link rel="stylesheet" type="text/css" href="/css/services.css"/>
<section class="clearfix">
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
				<h1><a href="javascript:;" class="trigger"><?php echo $service->get_language_title($lang); ?></a></h1>
				<div><?php echo $service->get_language_body($lang); ?></div>
			</article>
		<?php endforeach; ?>
	</div>
</section>
<script type="text/javascript">
	$(window).resize(function() {
		var collapsable = $('.collapsable');
		if ($(window).width() < 768) {
			collapsable.show();
			//collapsable.find("div").hide();
			/*collapsable.on("touchend", function(){
				$(this).find("div").toggle();
			});*/
			$(".trigger").click(function() {
				$(this).closest(".cell").toggleClass("open");
			});
		} else {
			collapsable.hide();
			collapsable.first().show();
			collapsable.find("div").show();
			$('.bookmark').click(function(e){
				e.preventDefault();
				var target = $(this).data("target");
				$('.collapsable').hide();
				$('.bookmark').removeClass("current");
				$(this).addClass("current");
				$("[data-value='"+target+"']").show();
			});
		}
	});
	$(window).trigger('resize');
	/*	jQuery(document).ready(function($) {

	 });
	 */
</script>
<?php else : ?>
<section class="main content">
	<p>Trenutno nema dodatih usluga.</p>
</section>
<?php endif; ?>
