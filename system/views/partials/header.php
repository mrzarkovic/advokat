<header class="header">
	<div class="wrapper content clearfix">
		<a href="/<?php echo $this->get_language(); ?>" class="logo">
			<?php echo $this->site_name; ?>
		</a>
		<div id="header-contact-info">
			<h1>Kontakt</h1>
			<b>Tel:</b> 063 453 835<br>
			<b>Adresa:</b> Ustanička 12 ulaz 1<br>Beograd
		</div>
	</div>
	<nav class="navigation" id="navigation">
		<ul class="wrapper clearfix">
			<?php foreach ($pages as $page) : ?>
				<li>
					<?php
					$title_field = "title_" . $this->get_language();
					$this->get_menu_link($page->$title_field); ?>
				</li>
			<?php endforeach; ?>
			<li>
				<?php $this->get_menu_link($this->language_titles["services"][$this->get_language()]); ?>
			</li>
			<li>
				<?php $this->get_menu_link($this->language_titles["clients"][$this->get_language()]); ?>
			</li>
			<li>
				<?php $this->get_menu_link($this->language_titles["contact"][$this->get_language()]); ?>
			</li>
			<li class="language-item">
				<a href="/en">En</a>
			</li>
			<li class="language-item">
				<a href="/sr">Sr</a>
			</li>
			<?php
			if (user_logged_in()) {
				?>
				<li class="admin-login">
					<a href="/logout">Odjavi se</a>
				</li>
				<?php
			}
			?>
			<li class="clearfix"></li>
			<li class="mobile-nav" id="mobile-menu"><a href="javascript:;">Meni</a></li>
		</ul>
	</nav>
</header>
<script type="text/javascript">
$("#navigation").click(function() {
	$("#navigation").toggleClass("open");
});
</script>
