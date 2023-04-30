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
      <div class="column is-4">
        <h1 class="title"><?php echo $d->title; ?></h1>

        <?php if ($d->c->status_pago === 'in_process'): ?>
          <article class="message is-danger">
            <div class="message-header">
              <p>¡Atención!</p>
              <button class="delete" aria-label="delete"></button>
            </div>
            <div class="message-body">
              Tu pago está siendo verificado, te informaremos por correo electrónico si es aprobado.
            </div>
          </article>
        <?php elseif ($d->c->status_pago === 'cancelled'): ?>
          <article class="message is-danger">
            <div class="message-header">
              <p>¡Atención!</p>
              <button class="delete" aria-label="delete"></button>
            </div>
            <div class="message-body">
              Tu pago ha sido cancelado y reembolsado.
            </div>
          </article>
        <?php endif; ?>

        <div class="mb-5">
          <p><?php echo sprintf('Número de compra <b>#%s</b>', $d->c->numero); ?></p>
          <span><?php echo ($d->c->status); ?></span>
        </div>

        <div class="columns is-multiline">
          <?php foreach ($d->c->items as $i => $p): ?>
            <div class="column is-12">
              <div class="columns">
                <div class="column is-2">
                  <img class="image is-64x64" src="<?php echo get_producto($p->id_producto)['imagen']; ?>" alt="<?php echo $p->titulo; ?>">
                </div>
                <div class="column">
                  <p class="has-text-black has-text-weight-semibold"><?php echo $p->titulo; ?></p>
                  <p><?php echo sprintf('Cantidad: %s', $p->cantidad); ?></p>
                  <p class="has-text-black has-text-right has-text-weight-medium"><?php echo money($p->precio); ?></p>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <hr>

        <table class="table is-borderless is-fullwidth is-vmiddle has-background-light mb-2">
          <tr>
            <td>Subtotal</td>
            <td class="has-text-right"><?php echo money($d->c->subtotal); ?></td>
          </tr>
          <tr>
            <td><?php echo sprintf('Envío (%s)', $d->c->tipo_env); ?></td>
            <td class="has-text-right"><?php echo money($d->c->envio); ?></td>
          </tr>
        </table>

        <table class="table is-borderless is-fullwidth is-vmiddle has-background-light mb-1">
          <tr>
            <td>Total con impuestos excluidos</td>
            <td class="has-text-right"><?php echo money($d->c->total - $d->c->impuestos); ?></td>
          </tr>
          <tr>
            <td>IVA (16%)</td>
            <td class="has-text-right"><?php echo money($d->c->impuestos); ?></td>
          </tr>
        </table>

        <table class="table is-borderless is-fullwidth is-vmiddle has-background-light">
          <tr>
            <td>
              <h2 class="is-size-4"><b>TOTAL</b></h2>
            </td>
            <td class="has-text-right is-size-4"><b><?php echo money($d->c->total); ?></b></td>
          </tr>
        </table>

        <table class="table is-borderless is-fullwidth is-vmiddle has-background-light">
          <tr>
            <td>
              <a href="home">Seguir comprando</a>
            </td>
          </tr>
        </table>
      </div>
      <div class="column is-8 is-centered">
        <img src="<?php echo get_image('confirmed.svg'); ?>" alt="No hay registros." class="image mb-5" style="width: 400px; margin: 0px auto;">
      </div>
    </div>
  </div>
</div>

<?php require_once INCLUDES.'inc_footer.php'; ?>