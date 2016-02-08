<header class="header">
  <div class="content clearfix">
	  <a href="/" class="logo">
        <?php echo $this->site_name; ?> <small><?php echo $this->page_name; ?></small>
	  </a>
  </div>
  <nav class="navigation">
    <div class="content">
      <ul class="clearfix">
        <li>
          <a href="/">Početna</a>
        </li>
        <?php
          if (!user_logged_in())
          {
        ?>
        <li class="admin-login">
          <a href="/login">Administracija</a>
        </li>
        <?php
          }
          else
          {
        ?>
        <li class="admin-login">
          <a href="/logout">Odjavi se</a>
        </li>
        <?php
          }
        ?>
      </ul>
    </div>
  </nav>
</header>
