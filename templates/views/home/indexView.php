<?php require_once INCLUDES.'inc_header.php'; ?>
<?php require_once INCLUDES.'inc_navbar.php'; ?>

<section class="hero is-danger is-large" style="background-size: cover; background-image: url(<?php echo URL.'assets/images/bg.jpg'; ?>);">
  <div class="hero-body">
    <div class="">
      <p class="title is-size-1">
        Bienvenido
      </p>
      <p class="subtitle">
        El mejor equipo para tus encuentros de Airsoft.
      </p>
    </div>
  </div>
</section>


<div class="has-background-light">
  <div class="container py-3">
    <div class="columns">
      <div class="column"><?php echo Flasher::flash(); ?></div>
    </div>
  </div>
  <div class="container">
    <div class="columns is-multiline py-6">
      <div class="column is-full mb-4">
        <h1 class="title">Productos destacados</h1>
      </div>
      <?php if (!empty($d->productos)): ?>
        <?php foreach ($d->productos as $i => $p): ?>
          <div class="column is-4">
            <div class="card mb-3">
              <div class="card-image p-5">
                <figure class="image is-4by3">
                  <a href="#">
                    <img src="<?php echo $p->imagen; ?>" alt="<?php echo $p->titulo; ?>">
                  </a>
                </figure>
              </div>
              <div class="card-content">
                <div class="media">
                  <div class="media-content">
                    <p class="title is-4"><?php echo $p->titulo; ?></p>
                    <p class="subtitle is-6">Cupón 50% OFF <span class="has-text-danger">hotsale2021</span></p>
                  </div>
                </div>
  
                <div class="content">
                  <h2 class="has-text-success"><?php echo money($p->precio); ?></h2>
                  <a class="button is-black is-small" href="<?php echo buildURL(URL.'carrito/agregar', ['id_producto' => $p->id]); ?>"><i class="fas fa-shopping-cart fa-fw mr-2"></i> <?php echo Carrito::dentro($p->id) ? 'Agregar más' : 'Agregar al carrito'; ?></a>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>

        <div class="column is-full">
          <nav class="pagination" role="navigation" aria-label="pagination">
            <a class="pagination-previous" title="This is the first page" disabled>Anterior</a>
            <a class="pagination-next">Siguiente</a>
            <ul class="pagination-list">
              <li>
                <a class="pagination-link is-current" aria-label="Page 1" aria-current="page">1</a>
              </li>
              <li>
                <a class="pagination-link" aria-label="Goto page 2">2</a>
              </li>
              <li>
                <a class="pagination-link" aria-label="Goto page 3">3</a>
              </li>
            </ul>
          </nav>
        </div>
      <?php else: ?>
        <div class="column">
          <article class="message is-danger">
            <div class="message-header">
              <p>¡Upps!</p>
              <button class="delete" aria-label="delete"></button>
            </div>
            <div class="message-body">
              Por el momento no hay productos para mostrar en esta página.
            </div>
          </article>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php require_once INCLUDES.'inc_footer.php'; ?>