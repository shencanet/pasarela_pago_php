<?php require_once INCLUDES.'inc_header.php'; ?>
<?php require_once INCLUDES.'inc_navbar.php'; ?>

<div class="has-background-light">
  <div class="container py-3">
    <div class="columns">
      <div class="column"><?php echo Flasher::flash(); ?></div>
    </div>
  </div>
  <div class="container">
    <div class="columns is-multiline py-6">
      <div class="column is-full mb-4">
        <h1 class="title"><?php echo $d->title; ?></h1>
      </div>
      <?php if (!empty($d->compras)): ?>
        <table class="table is-fullwidth">
          <thead>
            <tr>
              <th>#</th>
              <th>Fecha</th>
              <th>Pago</th>
              <th>Estado</th>
              <th>Total</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($d->compras as $c): ?>
              <tr>
                <td><?php echo $c->numero; ?></td>
                <td><?php echo format_date($c->creado); ?></td>
                <td><?php echo $c->status_pago; ?></td>
                <td><?php echo $c->status; ?></td>
                <td><?php echo money($c->total); ?></td>
                <td>
                  ...
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php else: ?>
        <div class="column">
          <img src="<?php echo get_image('empty.svg'); ?>" alt="No hay registros." class="image mb-5" style="width: 600px; margin: 0px auto;">

          <article class="message is-danger">
            <div class="message-header">
              <p>¡Upps!</p>
              <button class="delete" aria-label="delete"></button>
            </div>
            <div class="message-body">
              Por el momento no hay compras para mostrar en esta página.
            </div>
          </article>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php require_once INCLUDES.'inc_footer.php'; ?>