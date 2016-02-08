<section class="main content">
  <h1>Prijava na sistem</h1>
  <p class="notice">
    <?php echo $this->msg_to_user; ?>
  </p>
  <form action="/login" method="post">
    <div class="form-field">
      <label for="username">Korisničko ime</label>
      <input type="text" name="username" id="username" />
    </div>
    <div class="form-field">
      <label for="password">Lozinka</label>
      <input type="password" name="password" id="password" />
    </div>
    <div class="form-field">
      <input type="submit" name="submit" value="Prijavi se" />
    </div>
  </form>
</section>
