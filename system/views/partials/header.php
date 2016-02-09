<header class="header">
	<div class="content clearfix">
		<a href="/" class="logo">
			<?php echo $this->site_name; ?>
			<small><?php echo $this->page_name; ?></small>
		</a>
	</div>
	<nav class="navigation">
		<ul class="clearfix">
			<li>
				<a href="/">Početna</a>
			</li>
			<?php foreach ($pages as $page) : ?>
				<li>
					<a href="<?php echo $page->getLanguageUrl(); ?>"><?php echo $page->getLanguageTitle(); ?></a>
				</li>
			<?php endforeach; ?>
			<?php
			if (!user_logged_in()) {
				?>
				<li class="admin-login">
					<a href="/login">Administracija</a>
				</li>
				<?php
			} else {
				?>
				<li class="admin-login">
					<a href="/logout">Odjavi se</a>
				</li>
				<?php
			}
			?>
		</ul>
	</nav>
</header>
