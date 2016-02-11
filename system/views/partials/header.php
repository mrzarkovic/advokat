<header class="header">
	<div class="wrapper content clearfix">
		<a href="/" class="logo">
			<?php echo $this->site_name; ?>
		</a>
		<div id="header-contact-info">
			<h1>Kontakt</h1>
			<b>Tel:</b> 063 453 835<br>
			<b>Adresa:</b> Ustanička 12 ulaz 1<br>Beograd
		</div>
	</div>
	<nav class="navigation main">
		<ul class="wrapper clearfix">
			<?php foreach ($pages as $page) : ?>
				<li>
					<a href="<?php echo $page->get_language_url($this->get_language()); ?>" class="<?php current_menu($page->id, $this->get_current_menu()); ?>"><?php echo $page->get_language_title($this->get_language()); ?></a>
				</li>
			<?php endforeach; ?>
			<li>
				<a href="<?php echo $this->services_url[$this->get_language()]; ?>" class="<?php current_menu("services", $this->get_current_menu()); ?>"><?php echo $this->services_title[$this->get_language()]; ?></a>
			</li>
			<li>
				<a href="<?php echo $this->clients_url[$this->get_language()]; ?>" class="<?php current_menu("clients", $this->get_current_menu()); ?>"><?php echo $this->clients_title[$this->get_language()]; ?></a>
			</li>
			<li>
				<a href="<?php echo $this->contact_url[$this->get_language()]; ?>" class="<?php current_menu("contact", $this->get_current_menu()); ?>"><?php echo $this->contact_title[$this->get_language()]; ?></a>
			</li>
			<li class="language-item">
				<a href="/sr">Sr</a>
			</li>
			<li class="language-item">
				<a href="/en">En</a>
			</li>
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
