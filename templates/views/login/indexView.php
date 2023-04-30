<?php require_once INCLUDES.'inc_header.php'; ?>

<section class="hero is-primary is-fullheight">
  <div class="hero-body">
    <div class="container">
      <div class="columns is-centered">
        <div class="column is-5-tablet is-4-desktop is-3-widescreen">
          <?php echo Flasher::flash(); ?>
          <form action="login/post_login" method="post" class="box">
            <?php echo insert_inputs(); ?>
            <div class="field">
              <label for="" class="label">Usuario</label>
              <div class="control has-icons-left">
                <input type="text" placeholder="e.g. walterwhite" class="input" name="usuario" required>
                <span class="icon is-small is-left">
                  <i class="fas fa-user"></i>
                </span>
              </div>
            </div>
            <div class="field">
              <label for="" class="label">Contraseña</label>
              <div class="control has-icons-left">
                <input type="password" placeholder="*******" class="input" name="password" required>
                <span class="icon is-small is-left">
                  <i class="fa fa-lock"></i>
                </span>
              </div>
            </div>
            <div class="field">
              <button class="button is-success">
                Ingresar
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require_once INCLUDES.'inc_footer.php'; ?>

