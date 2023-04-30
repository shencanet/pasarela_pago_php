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
      <!-- Resumen del carrito -->
      <div class="column is-4 is-sticky">
        <h1 class="title mb-0">Carrito de compras</h1>
        <div class="has-text-muted mb-6">Inicio / Tienda / Carro de compras</div>

        <?php if (!empty($d->carrito->productos)): ?>
          <div class="columns is-multiline">
            <?php foreach ($d->carrito->productos as $i => $p): ?>
              <div class="column is-12">
                <div class="columns">
                  <div class="column is-2">
                    <img class="image is-64x64" src="<?php echo $p->imagen; ?>" alt="<?php echo $p->titulo; ?>">
                  </div>
                  <div class="column">
                    <a class="is-pulled-right delete" href="<?php echo buildURL('carrito/borrar', ['id_producto' => $p->id]); ?>" class="delete"></a>
                    <p class="has-text-black has-text-weight-semibold"><?php echo $p->titulo; ?></p>
                    <p><?php echo sprintf('Cantidad: %s', $p->cantidad); ?></p>
                    <p class="has-text-black has-text-right has-text-weight-medium"><?php echo money($p->precio); ?></p>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
          <a href="<?php echo buildURL('carrito/vaciar'); ?>" class="button is-small is-outline is-warning">Vaciar</a>
        <?php else: ?>
          <div class="column">
            <article class="message is-danger">
              <div class="message-header">
                <p>¡Upps!</p>
                <button class="delete" aria-label="delete"></button>
              </div>
              <div class="message-body">
                Por el momento no hay productos en tu carrito.
              </div>
            </article>
          </div>
        <?php endif; ?>
        
        <hr>

        <table class="table is-borderless is-fullwidth is-vmiddle has-background-light mb-2">
          <tr>
            <td>Subtotal</td>
            <td class="has-text-right"><?php echo money($d->carrito->subtotal); ?></td>
          </tr>
          <tr>
            <td><?php echo sprintf('Envío (%s)', $d->carrito->tipo_env); ?></td>
            <td class="has-text-right"><?php echo money($d->carrito->envio); ?></td>
          </tr>
        </table>

        <table class="table is-borderless is-fullwidth is-vmiddle has-background-light mb-1">
          <tr>
            <td>Total con impuestos excluidos</td>
            <td class="has-text-right"><?php echo money($d->carrito->total - $d->carrito->impuestos); ?></td>
          </tr>
          <tr>
            <td>IVA (16%)</td>
            <td class="has-text-right"><?php echo money($d->carrito->impuestos); ?></td>
          </tr>
        </table>

        <table class="table is-borderless is-fullwidth is-vmiddle has-background-light">
          <tr>
            <td>
              <h2 class="is-size-4"><b>TOTAL</b></h2>
            </td>
            <td class="has-text-right is-size-4"><b><?php echo money($d->carrito->total); ?></b></td>
          </tr>
        </table>

        <table class="table is-borderless is-fullwidth is-vmiddle has-background-light">
          <tr>
            <td>
              ¿Falta un producto? <a href="home">Seguir comprando</a>
            </td>
          </tr>
        </table>
      </div>

      <!-- Formulario y pago -->
      <div class="column is-8">
      </div>
    </div>
  </div>
</div>

<?php require_once INCLUDES.'inc_footer.php'; ?>