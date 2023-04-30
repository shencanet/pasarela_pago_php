<div class="container">
  <div class="columns">
    <div class="column">
      <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
          <a class="navbar-item" href="<?php echo URL; ?>">
            <img src="<?php echo get_logo(); ?>" width="112" height="28">
          </a>
      
          <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
          </a>
        </div>
      
        <div id="navbarBasicExample" class="navbar-menu">
          <div class="navbar-start">
            <a class="navbar-item" href="home">Inicio</a>
            <a class="navbar-item" href="carrito">Carrito</a>
            <div class="navbar-item has-dropdown is-hoverable">
              <a class="navbar-link">Mi cuenta</a>
      
              <div class="navbar-dropdown">
                <a class="navbar-item" href="usuario">Perfil</a>
                <a class="navbar-item" href="usuario/compras">Compras</a>
                <a class="navbar-item">Contacto</a>

                <hr class="navbar-divider">

                <a class="navbar-item">Rastrear envío</a>
              </div>
            </div>
          </div>
      
          <div class="navbar-end">
            <div class="navbar-item">
              <div class="buttons">
                <?php if (Auth::validate()): ?>
                  <a class="button is-warning" href="logout">
                    <strong>Salir</strong>
                  </a>
                <?php else: ?>
                  <a class="button is-light" href="login">
                    Ingresar
                  </a>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </nav>
    </div>
  </div>
</div>